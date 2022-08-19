<?php


namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\loginModel;


class Login extends BaseController
{
	protected $loginModel;
  public function __construct()
  {
	$this->loginModel = new loginModel();
    helper('form');
  }

  public function index()
  {
    return view('pages/login/login');
  }

  public function cek_login()
	{

		$session = session();
		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');
		$data = $this->loginModel->where('username', $username, 'password', md5($password))->first();
		if ($data) {
			$pass = $data['password'];
			if (md5($password) == $pass) {
				$ses_data = [
					'id_user'	=> $data['id_user'],
					'username'	=> $data['username'],
					'fullname'	=> $data['fullname'],
					'status'	=> $data['status'],
					'id_lembaga'=> $data['id_lembaga'],
					'logged_in'	=> TRUE
				];
				$session->set($ses_data);
				return redirect()->to(base_url('Home'));
			} else {
				$session->setFlashdata('error', 'Password Kamu Salah');
				return redirect()->to('Login');
			}
		} else {
			$session->setFlashdata('error', 'Username Kamu Salah');
			return redirect()->to('Login');
		}
	}

  public function logout()
	{
		$session = session();
		$session->destroy();
		session()->setFlashdata('success', 'Anda telah berhasil logout');
		return redirect()->to(base_url('Login'));
	}
}