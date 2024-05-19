<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
        // Do something here
		if(!session()->get("LoggedUserData")){
			session()->setFlashData("msg", "Anda Belum Login, Login Terlebih Dahulu");
			return redirect()->to(base_url('login'));
		}
	}
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
        // Do something here
	}
}
