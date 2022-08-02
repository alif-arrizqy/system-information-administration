<?php


namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\suratModel;

class Surat extends BaseController
{
    protected $suratModel;

    public function __construct()
    {
      $this->suratModel = new suratModel();
      helper('form');
    }

    public function download_surat($id_surat)
    {
      $data['files'] = $this->suratModel->get_id_surat($id_surat);
      foreach($data['files'] as $file)
      {
        $file_path = $file['file'];
      }
      try {
        echo $file_path;
        return $this->response->download('public/uploads/surat/' . $file_path, null);
      } catch (\Exception $e) {
        session()->setFlashdata('gagal', 'Data Tidak Ditemukan');
        return redirect()->to(base_url('/list_surat_masuk'));
      }
    }

    public function submit_surat()
    {
        $data['get_lembaga'] = $this->suratModel->get_info_login_lembaga();
        $data['get_all_lembaga'] = $this->suratModel->get_all_lembaga();
        return view('pages/surat/submit_surat', $data);
    }

    public function save_surat()
    {
        if (!$this->validate([
        'file' => [
            'rules' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,5048]',
            'errors' => [
            'uploaded' => 'Harus Ada File yang diupload',
            'mime_in' => 'File Extention Harus Berupa pdf',
            'max_size' => 'Ukuran File Maksimal 5 MB'
            ]
    
        ]
        ])) {
        session()->setFlashdata('gagal', 'Data Gagal Disimpan, Silahkan cek kembali input data Anda');
        return redirect()->to(base_url('/submit_surat'));
        }

        $tgl_surat = $this->request->getPost('tgl_surat');
        $tanggal_surat = date('Y-m-d', strtotime($tgl_surat));
        $file = $this->request->getfile('file');
        $file_name = $file->getRandomName();
        $status = 0;
        $created_at = date('Y-m-d H:i:s');
        $file->move(ROOTPATH . 'public/uploads/surat/', $file_name);
        
        $kirimdata = [
        'id_lembaga' => $this->request->getPost('id_lembaga'),
        'no_surat' => $this->request->getPost('no_surat'),
        'tanggal_surat' => $tanggal_surat,
        'jenis_surat' => $this->request->getPost('jenis_surat'),
        'nama_penerima' => $this->request->getPost('nama_penerima'),
        'lembaga_penerima' => $this->request->getPost('lembaga_penerima'),
        'nama_pengirim' => $this->request->getPost('nama_pengirim'),
        'jabatan' => $this->request->getPost('jabatan'),
        'file' => $file_name,
        'perihal' => $this->request->getPost('perihal'),
        'status' => $status,
        'created_at' => $created_at
        ];
        
        try {
            $this->suratModel->save_surat($kirimdata);
            session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
            return redirect()->to(base_url('/list_surat_keluar'));
        } catch (\Throwable $th) {
            session()->setFlashdata('gagal', 'Data Gagal Disimpan');
            return redirect()->to(base_url('/list_surat_keluar'));
        }
    }

    public function list_surat_masuk()
    {
        $data['get_lembaga'] = $this->suratModel->get_info_login_lembaga();
        $data['surat_masuk'] = $this->suratModel->get_surat_masuk();
        return view('pages/surat/list_surat_masuk', $data);
    }

    public function list_surat_keluar()
    {
        $data['get_lembaga'] = $this->suratModel->get_info_login_lembaga();
        $data['surat_keluar'] = $this->suratModel->get_surat_keluar();
        return view('pages/surat/list_surat_keluar', $data);
    }

    public function status_baca($id_surat)
    {
        $success = $this->suratModel->status_baca($id_surat);
        if ($success){
            session()->setFlashdata('sukses', 'Status Baca Berhasil Diubah');
            return redirect()->to(base_url('/list_surat_masuk'));
        } else {
            session()->setFlashdata('gagal', 'Data Gagal Disimpan');
            return redirect()->to(base_url('/list_surat_masuk'));
        }
    }
    
    public function delete_surat($id_surat)
    {
        unlink(ROOTPATH . 'public/uploads/surat/' . $this->request->getPost('file'));
        $success = $this->suratModel->delete_surat($id_surat);
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
            return redirect()->to(base_url('/list_surat_keluar'));
        } else {
            session()->setFlashdata('gagal', 'Data Gagal Dihapus');
            return redirect()->to(base_url('/list_surat_keluar'));
        }
    }
}