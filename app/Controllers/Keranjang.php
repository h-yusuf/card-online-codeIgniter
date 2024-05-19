<?php

namespace App\Controllers;

class Keranjang extends BaseController
{
    protected $session;
    protected $keranjangModel;

    function __construct()
    {
        $this->keranjangModel = new \App\Models\KeranjangModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $sess_user = $this->session->get('LoggedUserData'); 

        $data_keranjang = $this->keranjangModel
            ->join('produk', 'produk.id_produk = keranjang.id_produk', 'LEFT')
            ->where('id_user', $sess_user['id_user'])
            ->get();

        $data_view = [
            'data_keranjang' => $data_keranjang->getResult()
        ];

        return view('keranjang/list', $data_view);
    }

    public function proses()
    {
        if ($_GET['aksi'] == 'hapus') {
            $this->hapus_keranjang($_GET['id_keranjang']);
        } else {
            $this->tambahkan_keranjang();
        }

        // untuk redirect menggantikan header location
        return redirect()->to(base_url('keranjang'));
    }

    private function tambahkan_keranjang()
    {
        $produkModel = new \App\Models\ProdukModel();

        // cek id produk valid atau tidak
        $cek_data_produk = $produkModel
        ->where('id_produk', $_GET['id_produk'])
        ->first();

        if ($cek_data_produk == null) {
            $proses_db = null;
        } else {
            $sess_user = $this->session->get('LoggedUserData'); 

            // cek produk sudah ada di keranjang user atau tidak
            $cek_keranjang = $this->keranjangModel
            ->where('id_user', $sess_user['id_user'])
            ->where('id_produk', $_GET['id_produk'])
            ->first();

            if ($cek_keranjang == null) {
                // insert data produk ke keranjang
                $data_inputan_keranjang = [
                    'id_produk' => $_GET['id_produk'],
                    'id_user' => $sess_user['id_user'],
                    'jumlah_beli' => 1
                ];

                $proses_db = $this->keranjangModel->insert($data_inputan_keranjang);
            } else {
                // update jumlah keranjang jika sebelumnya produk sudah ada
                $data_inputan_keranjang = [
                    'jumlah_beli' => $cek_keranjang['jumlah_beli'] + 1
                ];

                $proses_db = $this->keranjangModel->update($cek_keranjang['id_keranjang'], $data_inputan_keranjang);
            }
        }

        return $proses_db;
              
    }

    private function hapus_keranjang($id_keranjang)
    {
        $sess_user = $this->session->get('LoggedUserData'); 

        $cek_keranjang = $this->keranjangModel
            ->where('id_user', $sess_user['id_user'])
            ->where('id_keranjang', $_GET['id_keranjang'])
            ->first();

        $id = $cek_keranjang['id_keranjang'];
        $proses_db = $this->keranjangModel->delete($id);

        return $proses_db;
    }

    public function checkout()
    {
        return view('keranjang/form_cekout');
    }

    public function checkout_proses()
    {
        $transModel = new \App\Models\TransaksiModel();
        $detailTransModel = new \App\Models\DetailTransModel();

        $sess_user = $this->session->get('LoggedUserData'); 

        // mengambil data keranjang milik user
        $data_keranjang = $this->keranjangModel
            ->join('produk', 'produk.id_produk = keranjang.id_produk', 'LEFT')
            ->where('id_user', $sess_user['id_user'])
            ->get();

        $total_harga = 0;
        $id_transaksi = null;

       
 
        // perulangan untuk setiap produk di keranjang
        foreach ($data_keranjang->getResult() as $key => $value) {
          
            $total_harga += ($value->harga*$value->jumlah_beli);

            // jika id transaksi belum ada, maka akan diinsertkan terlebih dahulu (transaksi baru)
            if ($id_transaksi == null) {
                $data_transaksi = [
                    'id_user' => $sess_user['id_user'],
                    'tgl_transaksi' => date("Y-m-d"),
                    'total_bayar' => $total_harga,
                    'nama' => $this->request->getPost('nama'),
                    'alamat_jalan' => $this->request->getPost('alamat_jalan'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kota' => $this->request->getPost('kota'),
                    'provinsi' => $this->request->getPost('provinsi'),
                ];

                $proses_db_trans = $transModel->insert($data_transaksi);
                $id_transaksi = $transModel->insertID();
            } else {
                // jika id transaksi sudah ada maka data transaksi hanya mengupdate total bayar
                $data_transaksi = [
                    'total_bayar' => $total_harga
                ];

                $proses_db_trans = $transModel->update($id_transaksi, $data_transaksi);
            }

            // proses insert detail transaksi
            
            $data_detail = [
                'id_transaksi' => $id_transaksi,
                'id_produk' => $value->id_produk,
                'harga' => $value->harga,
                'jumlah_beli' => $value->jumlah_beli
            ];

            $proses_db_trans = $detailTransModel->insert($data_detail);
        }

        // setelah semua dimasukkan ke tabel transaki dan detail, data keranjang user dihapus / direset
        $proses_db_keranjang = $this->keranjangModel
        ->where('id_user', $sess_user['id_user'])
        ->delete();

        return redirect()->to(base_url('keranjang/transaksi'));
    }

    public function transaksi()
    {
        $transModel = new \App\Models\TransaksiModel();

        $sess_user = $this->session->get('LoggedUserData'); 

        $data_trans = $transModel
            ->where('id_user', $sess_user['id_user'])
            ->get();

        $data_view = [
            'data_trans' => $data_trans->getResult()
        ];

        return view('keranjang/list_trans', $data_view);
    }
    
}
