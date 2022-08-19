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

    public function view_users()
    {
        $data['get_lembaga'] = $this->usersModel->get_info_login_lembaga();
        $data['get_profile'] = $this->usersModel->get_info_users();
        return view('pages/manajemen_user/view_users', $data);
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
          session()->setFlashdata('error', 'Gagal Menyimpan! File extention harus berupa pdf dan ukuran maksimal 5 MB');
          return redirect()->to(base_url('/submit_users'));
        }

        $id_lembaga = $this->request->getPost('id_lembaga');
        $passwd = md5($this->request->getPost('password'));

        $file = $this->request->getFile('file');
        $file_name = pathinfo($file->getName(), PATHINFO_FILENAME);
        $file_name = preg_replace('/\s+/', '_', $file_name);
        $file_name = $file_name . '_' . $file->getRandomName();
        try {
          $img = \Config\Services::image()
          ->withFile($file)
          ->resize(128, 128, true, 'heigth')
          ->save(ROOTPATH . 'public/uploads/images/'. $file_name);
        } catch (\Exception $e) {
          $file->move(ROOTPATH . 'public/uploads/images/', $file_name);
        }

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
            session()->setFlashdata('error', 'Data Gagal Disimpan: Lembaga Sudah Memiliki User');
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
          session()->setFlashdata('error', 'Gagal Menyimpan! File extention harus berupa pdf dan ukuran maksimal 5 MB');
          return redirect()->to(base_url('/list_users'));
        }

        $file = $this->request->getfile('file');
        if ($file->getError() == 4) {
          $file_name = $this->request->getPost('file_lama');
        } else {
          $file_name = pathinfo($file->getName(), PATHINFO_FILENAME);
          $file_name = preg_replace('/\s+/', '_', $file_name);
          $file_name = $file_name . '_' . $file->getRandomName();
          try {
            $img = \Config\Services::image()
                ->withFile($file)
                ->resize(128, 128, true, 'heigth')
                ->save(ROOTPATH . 'public/uploads/images/'. $file_name);
          } catch (\Exception $e) {
            $file->move(ROOTPATH . 'public/uploads/images/', $file_name);
          }
          try {
            unlink(ROOTPATH . 'public/uploads/images/' . $this->request->getPost('file_lama'));
          } catch (\Exception $e) {
          }
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
            session()->setFlashdata('success', 'Data Berhasil Diubah');
            return redirect()->to(base_url('/list_users'));
          } else {
            session()->setFlashdata('error', 'Data Gagal Diubah');
            return redirect()->to(base_url('/list_users'));
          }
    }

    public function update_profile($id_user)
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
          session()->setFlashdata('error', 'Gagal Menyimpan! File extention harus berupa pdf dan ukuran maksimal 5 MB');
          return redirect()->to(base_url('/list_users'));
        }

        $file = $this->request->getfile('file');
        if ($file->getError() == 4) {
          $file_name = $this->request->getPost('file_lama');
        } else {
          $file_name = pathinfo($file->getName(), PATHINFO_FILENAME);
          $file_name = preg_replace('/\s+/', '_', $file_name);
          $file_name = $file_name . '_' . $file->getRandomName();
          try {
            $img = \Config\Services::image()
                ->withFile($file)
                ->resize(128, 128, true, 'heigth')
                ->save(ROOTPATH . 'public/uploads/images/'. $file_name);
          } catch (\Exception $e) {
            $file->move(ROOTPATH . 'public/uploads/images/', $file_name);
          }
          try {
            unlink(ROOTPATH . 'public/uploads/images/' . $this->request->getPost('file_lama'));
          } catch (\Exception $e) {
          }
        }
        
        $passwd = $this->request->getPost('password');
        if ($passwd == '') {
          $kirimdata = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'foto' => $file_name
          ];
        } else {
          $passwd = md5($this->request->getPost('password'));
          $kirimdata = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'password' => $passwd,
            'foto' => $file_name
          ];
        }

        $success = $this->usersModel->update_profile($kirimdata, $id_user);
        if ($success){
            session()->setFlashdata('success', 'Data Berhasil Diubah');
            return redirect()->to(base_url('/view_users'));
          } else {
            session()->setFlashdata('error', 'Data Gagal Diubah');
            return redirect()->to(base_url('/view_users'));
          }
    }

    public function delete_users($id_user)
    {
        try {
            unlink(ROOTPATH . 'public/uploads/images/' . $this->request->getPost('file'));
            $this->usersModel->delete_users($id_user);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
            return redirect()->to(base_url('/list_users'));
        } catch (\Exception $e) {
            $this->usersModel->delete_users($id_user);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
            return redirect()->to(base_url('/list_users'));
          }
    }
}