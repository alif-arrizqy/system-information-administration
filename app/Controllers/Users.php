<?php


namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\usersModel;

class Users extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
      $this->usersModel = new usersModel();
      helper('form');
    }

    public function list_users()
    {
        $data['get_lembaga'] = $this->usersModel->get_info_login_lembaga();
        $data['get_users'] = $this->usersModel->get_all_users();
        return view('pages/manajemen_user/list_users', $data);
    }

    public function submit_users()
    {
        $data['get_lembaga'] = $this->usersModel->get_info_login_lembaga();
        return view('pages/manajemen_user/submit_users', $data);
    }

    public function save_users()
    {
        $passwd = md5($this->request->getPost('password'));
        $kirimdata = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'password' => $passwd,
            'status' => $this->request->getPost('status'),
            'id_lembaga' => $this->request->getPost('id_lembaga')
        ];
        $success = $this->usersModel->save_users($kirimdata);
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
            return redirect()->to(base_url('/list_users'));
          } else {
            session()->setFlashdata('gagal', 'Data Gagal Disimpan');
            return redirect()->to(base_url('/list_users'));
          }
    }

    public function update_users($id_user)
    {
        $kirimdata = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            // 'password' => $this->request->getPost('password'),
            'status' => $this->request->getPost('status'),
            'id_lembaga' => $this->request->getPost('id_lembaga')
        ];
        $success = $this->usersModel->update_users($kirimdata, $id_user);
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Diubah');
            return redirect()->to(base_url('/list_users'));
          } else {
            session()->setFlashdata('gagal', 'Data Gagal Diubah');
            return redirect()->to(base_url('/list_users'));
          }
    }

    public function delete_users($id_user)
    {
        $success = $this->usersModel->delete_users($id_user);
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
            return redirect()->to(base_url('/list_users'));
          } else {
            session()->setFlashdata('gagal', 'Data Gagal Dihapus');
            return redirect()->to(base_url('/list_users'));
          }
    }


    // public function list_users()
    // {
    //     $data['get_lembaga'] = $this->usersModel->get_info_login_lembaga();
    //     $data['get_user'] = $this->usersModel->get_all_user();
    //     return view('pages/surat/list_surat_masuk', $data);
    // }

}