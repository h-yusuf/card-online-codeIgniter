<?php

namespace App\Controllers;

class Login extends BaseController
{
    protected $session;
	protected $userModel;

	function __construct()
	{
		$this->userModel = new \App\Models\UserModel();
		$this->session = \Config\Services::session();
	}

    public function index()
    {
    	if ($this->session->get('LoggedUserData')) {
			return redirect()->to(base_url('produk'));
		} else {
			$data_temp = $this->session->getFlashdata('msg');

			if ($data_temp != null && $data_temp != '') {
				$error_msg = $data_temp;
			} else {
				$error_msg = "";
			}

			$data_view = [
				'error_msg' => $error_msg
			];
       		
       		return view('login/form', $data_view);
       	}
    }

    public function proses_login()
	{
		$username = $this->request->getPost('username');
		$pass = $this->request->getPost('password');

		$validasi = $this->userModel
		->where('username', $username)
		->where('password', sha1($pass))
		->first();

		if ($validasi == null) {
			$pesan = 'Kesalahan : Data pengguna tidak ada';
			$this->session->setFlashdata('msg', $pesan);

			return redirect()->to(base_url('login'));
		} else {
			$userdata = [
				'nama' => $validasi['nama'],
				'username' => $validasi['username'],
				'id_user' => $validasi['id_user'],
			];
			$this->session->set("LoggedUserData", $userdata);

			$data_update = ['last_login' => date("Y-m-d H:i:s")];

			$update_login = $this->userModel->update($validasi['id_user'], $data_update);

			return redirect()->to(base_url('produk'));
		}

	}
}
