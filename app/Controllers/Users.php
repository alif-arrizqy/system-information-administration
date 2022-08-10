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
        $data['get_all_lembaga'] = $this->usersModel->get_all_lembaga();
        return view('pages/manajemen_user/list_users', $data);
    }

    public function submit_users()
    {
        $data['get_lembaga'] = $this->usersModel->get_info_login_lembaga();
        $data['get_all_lembaga'] = $this->usersModel->get_all_lembaga();
        return view('pages/manajemen_user/submit_users', $data);
    }

    public function save_users()
    {
        if (!$this->validate([
          'file' => [
            'rules' => 'uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/png]|max_size[file,5048]',
            'errors' => [
              'uploaded' => 'Harus Ada File yang diupload',
              'mime_in' => 'File Extention Harus Berupa jpg/png',
              'max_size' => 'Ukuran File Maksimal 5 MB'
            ]
    
          ]
        ])) {
          session()->setFlashdata('gagal', 'Data Gagal Disimpan: '.$this->validator->listErrors());
          return redirect()->to(base_url('/submit_users'));
        }

        $id_lembaga = $this->request->getPost('id_lembaga');
        $passwd = md5($this->request->getPost('password'));
        $file = $this->request->getfile('file');
        $file_name = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/images/', $file_name);

        $kirimdata = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'password' => $passwd,
            'status' => $this->request->getPost('status'),
            'id_lembaga' => $id_lembaga,
            'foto' => $file_name
        ];

        $check_duplicate = $this->usersModel->check_lembaga($id_lembaga);
        if ($check_duplicate) {
            session()->setFlashdata('gagal', 'Data Gagal Disimpan: Lembaga Sudah Memiliki User');
            return redirect()->to(base_url('/submit_users'));
        } else {
            $this->usersModel->save_users($kirimdata);
            session()->setFlashdata('berhasil', 'Data Berhasil Disimpan');
            return redirect()->to(base_url('/list_users'));
        }
    }

    public function update_users($id_user)
    {
        if (!$this->validate([
          'file' => [
            'rules' => 'mime_in[file,image/jpg,image/jpeg,image/png]|max_size[file,5048]',
            'errors' => [
              'mime_in' => 'File Extention Harus Berupa jpg/jpeg/png',
              'max_size' => 'Ukuran File Maksimal 5 MB'
            ]
          ]
        ])) {
          session()->setFlashdata('gagal', 'Data Gagal Disimpan: '.$this->validator->listErrors());
          return redirect()->to(base_url('/list_users'));
        }

        $file = $this->request->getfile('file');
        if ($file->getError() == 4) {
          $file_name = $this->request->getPost('file_lama');
        } else {
          $file_name = $file->getRandomName();
          $file->move(ROOTPATH . 'public/uploads/images/', $file_name);
          unlink(ROOTPATH . 'public/uploads/images/' . $this->request->getPost('file_lama'));
        }
        $passwd = $this->request->getPost('password');
        if ($passwd == '') {
          $kirimdata = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'status' => $this->request->getPost('status'),
            'id_lembaga' => $this->request->getPost('id_lembaga'),
            'foto' => $file_name
          ];
        } else {
          $passwd = md5($this->request->getPost('password'));
          $kirimdata = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'password' => $passwd,
            'status' => $this->request->getPost('status'),
            'id_lembaga' => $this->request->getPost('id_lembaga'),
            'foto' => $file_name
          ];
        }

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
        unlink(ROOTPATH . 'public/uploads/images/' . $this->request->getPost('file'));
        $success = $this->usersModel->delete_users($id_user);
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
            return redirect()->to(base_url('/list_users'));
          } else {
            session()->setFlashdata('gagal', 'Data Gagal Dihapus');
            return redirect()->to(base_url('/list_users'));
          }
    }
}