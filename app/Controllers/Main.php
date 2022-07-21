<?php


namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\mainModel;

class Main extends BaseController
{
    protected $mainModel;

    public function __construct()
    {
      $this->mainModel = new mainModel();
      helper('form');
    }

    public function index()
    {
      $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
      return view('pages/index', $data);
    }

    public function download($id_proposal)
    {
      $data['files'] = $this->mainModel->get_id_proposal($id_proposal);
      foreach($data['files'] as $file)
      {
        $file_path = $file['file'];
      }
      echo $file_path;
      return $this->response->download('public/uploads/proposal/' . $file_path, null);
    }

    // proposal
    public function submit_proposal()
    {
      $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
      return view('pages/dokumen_proposal/submit_proposal', $data);
    }

    public function save_proposal()
    {
      if (!$this->validate([
        'judul' => [
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Tidak boleh kosong'
          ]
        ],
        'pengajuan_anggaran' => [
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Tidak boleh kosong'
          ]
        ],
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
        return redirect()->to(base_url('/submit_proposal'));
      }

      $judul = $this->request->getPost('judul');
      $id_lembaga = $this->request->getPost('id_lembaga');
      $anggaran = $this->request->getPost('pengajuan_anggaran');
      $pengajuan_anggaran = str_replace(",", "", $anggaran);
      $file = $this->request->getfile('file');
      $file_name = $file->getRandomName();
      $status = 0;
      $created_at = date('Y-m-d H:i:s');
      $file->move(ROOTPATH . 'public/uploads/proposal/', $file_name);
      
      $kirimdata = [
        'id_lembaga' => $id_lembaga,
        'judul_kegiatan' => $judul,
        'pengajuan_anggaran' => $pengajuan_anggaran,
        'file' => $file_name,
        'status' => $status,
        'created_at' => $created_at
      ];
      
      $success = $this->mainModel->save_proposal($kirimdata);
      if ($success){
        session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
        return redirect()->to(base_url('/list_proposal'));
      } else {
        session()->setFlashdata('gagal', 'Data Gagal Disimpan');
        return redirect()->to(base_url('/list_proposal'));
      }
    }

    public function edit_proposal()
    {
      if (!$this->validate([
        'judul' => [
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Tidak boleh kosong'
          ]
        ],
        'pengajuan_anggaran' => [
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Tidak boleh kosong'
          ]
        ],
        'file' => [
          'rules' => 'mime_in[file,application/pdf]|max_size[file,5048]',
          'errors' => [
            'mime_in' => 'File Extention Harus Berupa pdf',
            'max_size' => 'Ukuran File Maksimal 5 MB'
          ]
   
        ]
      ])) {
        session()->setFlashdata('gagal', 'Data Gagal Disimpan, Silahkan cek kembali input data Anda');
        return redirect()->to(base_url('/list_proposal'));
      }

      $file = $this->request->getfile('file');
      if ($file->getError() == 4) {
        $file_name = $this->request->getPost('file_lama');
      } else {
        $file_name = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/proposal/', $file_name);
        unlink(ROOTPATH . 'public/uploads/proposal/' . $this->request->getPost('file_lama'));
      }

      $judul = $this->request->getPost('judul');
      $id_lembaga = $this->request->getPost('id_lembaga');
      $id_proposal = $this->request->getPost('id_proposal');
      $anggaran = $this->request->getPost('pengajuan_anggaran');
      $pengajuan_anggaran = str_replace(",", "", $anggaran);

      $kirimdata = [
        'id_proposal' => $id_proposal,
        'id_lembaga' => $id_lembaga,
        'judul_kegiatan' => $judul,
        'pengajuan_anggaran' => $pengajuan_anggaran,
        'file' => $file_name,
      ];
      $success = $this->mainModel->update_proposal($kirimdata);
      if ($success){
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('/list_proposal'));
      } else {
        session()->setFlashdata('gagal', 'Data Gagal Dihapus');
        return redirect()->to(base_url('/list_proposal'));
      }
    }

    public function delete_proposal($id_proposal)
    {
      unlink(ROOTPATH . 'public/uploads/proposal/' . $this->request->getPost('file'));
      $success = $this->mainModel->delete_proposal($id_proposal);
      if ($success){
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('/list_proposal'));
      } else {
        session()->setFlashdata('gagal', 'Data Gagal Dihapus');
        return redirect()->to(base_url('/list_proposal'));
      }
    }

    public function list_proposal()
    {
      $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
      $data['get_proposal'] = $this->mainModel->user_get_proposal();
      return view('pages/dokumen_proposal/list_proposal', $data);
    }
    
    public function approve_proposal()
    {
      $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
      $data['list_approval'] = $this->mainModel->list_approval();
      return view('pages/dokumen_proposal/approve_proposal', $data);
    }

    public function update_approval()
    {
      $id_proposal = $this->request->getPost('id_proposal');
      $id_lembaga = $this->request->getPost('id_lembaga');
      $status = $this->request->getPost('status');
      $anggaran = $this->request->getPost('anggaran_diberikan');
      $anggaran_diberikan = str_replace(",", "", $anggaran);

      $success = $this->mainModel->update_approval($status, $anggaran_diberikan, $id_proposal);
      if ($success){
        session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
        return redirect()->to(base_url('/approve_proposal'));
      } else {
        session()->setFlashdata('gagal', 'Data Gagal Disimpan');
        return redirect()->to(base_url('/approve_proposal'));
      }
    }

    // laporan hasil kegiatan
    public function submit_laporan_hasil_kegiatan()
    {
      $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
      return view('pages/laporan_hasil_kegiatan/submit_laporan_hasil_kegiatan', $data);
    }

    public function list_laporan_hasil_kegiatan()
    {
      $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
      return view('pages/laporan_hasil_kegiatan/list_laporan_hasil_kegiatan', $data);
    }

  // persuratan
  public function submit_surat()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/surat/submit_surat', $data);
  }

  public function list_surat_masuk()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/surat/list_surat_masuk', $data);
  }

  public function list_surat_keluar()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/surat/list_surat_keluar', $data);
  }

  // pelaksanaan
  public function realisasi_kegiatan()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/pelaksanaan/realisasi_kegiatan', $data);
  }

  public function detail_realisasi_kegiatan()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/pelaksanaan/detail_realisasi_kegiatan', $data);
  }

  // manajemen user
  public function list_admin()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/manajemen_user/list_admin', $data);
  }

  public function add_admin()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/manajemen_user/add_admin', $data);
  }

  public function list_user()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/manajemen_user/list_user', $data);
  }

  public function add_user()
  {
    $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
    return view('pages/manajemen_user/add_user', $data);
  }
}
