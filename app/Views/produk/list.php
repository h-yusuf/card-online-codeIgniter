<?= $this->extend('template/layout') ?>

<?= $this->section('judul') ?>
    List Produk
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<h3>Pencarian Produk : <?= $pencarian_id_produk==''?'Tidak ada pencarian':$pencarian_id_produk ?></h3>
<hr/>

<form>
    <label>Masukkan ID</label>
    <input type="text" name="cari">
    <input type="submit" value="Cari ID">
</form>

<table border="1">
    <tr>
        <th>No.</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
        <th>OPSI</th>
    </tr>
    <?php foreach ($data as $index => $row) { ?>

            <tr>
                <td><?= $index+1 ?></td>
                <td><?= $row->kode_produk ?></td>
                <td><?= $row->nama_produk ?></td>
                <td><?= $row->stok ?></td>
                <td><?= $row->harga ?></td>
                <td><?= $row->deskripsi ?></td>
                <td>
                    <img width="150" src="<?= base_url('foto_produk/'.$row->foto_produk) ?>">
                </td>
                <td>
                    <a href="<?= base_url('keranjang/proses?aksi=add&id_produk='.$row->id_produk); ?>">Tambahkan Ke Keranjang</a>
                    | 
                    <a href="<?= base_url('produk/ubah?aksi=add&id_produk='.$row->id_produk); ?>">Ubah</a>
                    | 
                    <a href="<?= base_url('produk/hapus?id_produk='.$row->id_produk); 
                    ?>">Hapus Produk</a>

                </td>
            </tr>

    <?php 
    
    }

    if (count($data) == 0) {
    
        echo ' <tr><td colspan="7"><b>Data Produk Tidak Ditemukan</b></td></tr>';

    }
    ?>

</table>

<?= $this->endSection() ?>