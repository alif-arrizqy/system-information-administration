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

    // download
  //   public function download_proposal($id_proposal)
  //   {
  //     $data['files'] = $this->mainModel->get_id_proposal($id_proposal);
  //     foreach($data['files'] as $file)
  //     {
  //       $file_path = $file['file'];
  //     }
  //     try{
  //       echo $file_path;
  //       return $this->response->download('public/uploads/proposal/' . $file_path, null);
  //     } catch (\Exception $e) {
  //       session()->setFlashdata('gagal', 'Data Tidak Ditemukan');
  //       return redirect()->to(base_url('/list_proposal'));
  //     }
  //   }
    
  //   public function download_surat($id_surat)
  //   {
  //     $data['files'] = $this->mainModel->get_id_surat($id_surat);
  //     foreach($data['files'] as $file)
  //     {
  //       $file_path = $file['file'];
  //     }
  //     try {
  //       echo $file_path;
  //       return $this->response->download('public/uploads/surat/' . $file_path, null);
  //     } catch (\Exception $e) {
  //       session()->setFlashdata('gagal', 'Data Tidak Ditemukan');
  //       return redirect()->to(base_url('/list_surat_masuk'));
  //     }
  //   }

  //   public function download_laporan_kegiatan($id_laporan_keg)
  //   {
  //     $data['files'] = $this->mainModel->get_id_laporan_keg($id_laporan_keg);
  //     foreach($data['files'] as $file)
  //     {
  //       $file_path = $file['file'];
  //     }
  //     try {
  //       echo $file_path;
  //       return $this->response->download('public/uploads/laporan_hasil_kegiatan/' . $file_path, null);
  //     } catch (\Exception $e) {
  //         session()->setFlashdata('gagal', 'Data Tidak Ditemukan');
  //         return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
  //     }
  //   }

  //   // proposal
  //   public function submit_proposal()
  //   {
  //     $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //     return view('pages/dokumen_proposal/submit_proposal', $data);
  //   }

  //   public function save_proposal()
  //   {
  //     if (!$this->validate([
  //       'judul' => [
  //         'rules' => 'required',
  //         'errors' => [
  //           'required' => '{field} Tidak boleh kosong'
  //         ]
  //       ],
  //       'pengajuan_anggaran' => [
  //         'rules' => 'required',
  //         'errors' => [
  //           'required' => '{field} Tidak boleh kosong'
  //         ]
  //       ],
  //       'file' => [
  //         'rules' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,5048]',
  //         'errors' => [
  //           'uploaded' => 'Harus Ada File yang diupload',
  //           'mime_in' => 'File Extention Harus Berupa pdf',
  //           'max_size' => 'Ukuran File Maksimal 5 MB'
  //         ]
   
  //       ]
  //     ])) {
  //       session()->setFlashdata('gagal', 'Data Gagal Disimpan, Silahkan cek kembali input data Anda');
  //       return redirect()->to(base_url('/submit_proposal'));
  //     }

  //     $judul = $this->request->getPost('judul');
  //     $id_lembaga = $this->request->getPost('id_lembaga');
  //     $anggaran = $this->request->getPost('pengajuan_anggaran');
  //     $pengajuan_anggaran = str_replace(",", "", $anggaran);
  //     $file = $this->request->getfile('file');
  //     $file_name = $file->getRandomName();
  //     $status = 0;
  //     $created_at = date('Y-m-d H:i:s');
  //     $file->move(ROOTPATH . 'public/uploads/proposal/', $file_name);
      
  //     $kirimdata = [
  //       'id_lembaga' => $id_lembaga,
  //       'judul_kegiatan' => $judul,
  //       'pengajuan_anggaran' => $pengajuan_anggaran,
  //       'file' => $file_name,
  //       'status' => $status,
  //       'created_at' => $created_at
  //     ];
      
  //     $success = $this->mainModel->save_proposal($kirimdata);
  //     if ($success){
  //       session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
  //       return redirect()->to(base_url('/list_proposal'));
  //     } else {
  //       session()->setFlashdata('gagal', 'Data Gagal Disimpan');
  //       return redirect()->to(base_url('/list_proposal'));
  //     }
  //   }

  //   public function edit_proposal()
  //   {
  //     if (!$this->validate([
  //       'judul' => [
  //         'rules' => 'required',
  //         'errors' => [
  //           'required' => '{field} Tidak boleh kosong'
  //         ]
  //       ],
  //       'pengajuan_anggaran' => [
  //         'rules' => 'required',
  //         'errors' => [
  //           'required' => '{field} Tidak boleh kosong'
  //         ]
  //       ],
  //       'file' => [
  //         'rules' => 'mime_in[file,application/pdf]|max_size[file,5048]',
  //         'errors' => [
  //           'mime_in' => 'File Extention Harus Berupa pdf',
  //           'max_size' => 'Ukuran File Maksimal 5 MB'
  //         ]
   
  //       ]
  //     ])) {
  //       session()->setFlashdata('gagal', 'Data Gagal Disimpan, Silahkan cek kembali input data Anda');
  //       return redirect()->to(base_url('/list_proposal'));
  //     }

  //     $file = $this->request->getfile('file');
  //     if ($file->getError() == 4) {
  //       $file_name = $this->request->getPost('file_lama');
  //     } else {
  //       $file_name = $file->getRandomName();
  //       $file->move(ROOTPATH . 'public/uploads/proposal/', $file_name);
  //       unlink(ROOTPATH . 'public/uploads/proposal/' . $this->request->getPost('file_lama'));
  //     }

  //     $judul = $this->request->getPost('judul');
  //     $id_lembaga = $this->request->getPost('id_lembaga');
  //     $id_proposal = $this->request->getPost('id_proposal');
  //     $anggaran = $this->request->getPost('pengajuan_anggaran');
  //     $pengajuan_anggaran = str_replace(",", "", $anggaran);

  //     $kirimdata = [
  //       'id_proposal' => $id_proposal,
  //       'id_lembaga' => $id_lembaga,
  //       'judul_kegiatan' => $judul,
  //       'pengajuan_anggaran' => $pengajuan_anggaran,
  //       'file' => $file_name,
  //     ];
  //     $success = $this->mainModel->update_proposal($kirimdata);
  //     if ($success){
  //       session()->setFlashdata('sukses', 'Data Berhasil Di Update');
  //       return redirect()->to(base_url('/list_proposal'));
  //     } else {
  //       session()->setFlashdata('gagal', 'Data Gagal Di Update');
  //       return redirect()->to(base_url('/list_proposal'));
  //     }
  //   }

  //   public function delete_proposal($id_proposal)
  //   {
  //     unlink(ROOTPATH . 'public/uploads/proposal/' . $this->request->getPost('file'));
  //     $success = $this->mainModel->delete_proposal($id_proposal);
  //     if ($success){
  //       session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
  //       return redirect()->to(base_url('/list_proposal'));
  //     } else {
  //       session()->setFlashdata('gagal', 'Data Gagal Dihapus');
  //       return redirect()->to(base_url('/list_proposal'));
  //     }
  //   }

  //   public function list_proposal()
  //   {
  //     $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //     $data['get_proposal'] = $this->mainModel->user_get_proposal();
  //     return view('pages/dokumen_proposal/list_proposal', $data);
  //   }
    
  //   public function approve_proposal()
  //   {
  //     $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //     $data['list_approval'] = $this->mainModel->list_approval();
  //     return view('pages/dokumen_proposal/approve_proposal', $data);
  //   }

  //   public function update_approval()
  //   {
  //     $id_proposal = $this->request->getPost('id_proposal');
  //     $id_lembaga = $this->request->getPost('id_lembaga');
  //     $status = $this->request->getPost('status');
  //     $anggaran = $this->request->getPost('anggaran_diberikan');
  //     $anggaran_diberikan = str_replace(",", "", $anggaran);

  //     $success = $this->mainModel->update_approval($status, $anggaran_diberikan, $id_proposal);
  //     if ($success){
  //       session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
  //       return redirect()->to(base_url('/approve_proposal'));
  //     } else {
  //       session()->setFlashdata('gagal', 'Data Gagal Disimpan');
  //       return redirect()->to(base_url('/approve_proposal'));
  //     }
  //   }

  //   // laporan hasil kegiatan
  //   public function submit_laporan_hasil_kegiatan()
  //   {
  //     $id_proposal = $this->request->getPost('search_kegiatan');
  //     $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //     $data['get_kegiatan'] = $this->mainModel->get_info_kegiatan();
  //     $data['get_proposal'] = $this->mainModel->get_info_proposal($id_proposal);
  //     return view('pages/laporan_hasil_kegiatan/submit_laporan_hasil_kegiatan', $data);
  //   }

  //   public function list_laporan_hasil_kegiatan()
  //   {
  //     $id_lembaga = session()->get('id_lembaga');
  //     $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //     $data['get_laporan'] = $this->mainModel->get_info_laporan_kegiatan($id_lembaga);
  //     $data['get_pagu'] = $this->mainModel->get_pagu_anggaran($id_lembaga);
  //     $data['sum_realisasi'] = $this->mainModel->sum_realisasi_anggaran($id_lembaga);
  //     return view('pages/laporan_hasil_kegiatan/list_laporan_hasil_kegiatan', $data);
  //   }

  //   public function save_laporan_hasil_kegiatan()
  //   {
  //     if (!$this->validate([
  //       'file' => [
  //         'rules' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,5048]',
  //         'errors' => [
  //           'uploaded' => 'Harus Ada File yang diupload',
  //           'mime_in' => 'File Extention Harus Berupa pdf',
  //           'max_size' => 'Ukuran File Maksimal 5 MB'
  //         ]
   
  //       ]
  //     ])) {
  //       session()->setFlashdata('gagal', 'Data Gagal Disimpan, Silahkan cek kembali input data Anda');
  //       return redirect()->to(base_url('/submit_laporan_hasil_kegiatan'));
  //     }

  //     $id_proposal = $this->request->getPost('id_proposal');
  //     $id_lembaga = $this->request->getPost('id_lembaga');
  //     $anggaran = $this->request->getPost('realisasi_anggaran');
  //     $realisasi_anggaran = str_replace(",", "", $anggaran);
  //     $file = $this->request->getfile('file');
  //     $file_name = $file->getRandomName();
  //     $created_at = date('Y-m-d H:i:s');
  //     $file->move(ROOTPATH . 'public/uploads/laporan_hasil_kegiatan/', $file_name);

  //     $kirimdata = [
  //       'id_lembaga' => $id_lembaga,
  //       'id_proposal' => $id_proposal,
  //       'realisasi_anggaran' => $realisasi_anggaran,
  //       'files' => $file_name,
  //       'created_at' => $created_at,
  //     ];

  //     $success = $this->mainModel->save_laporan_hasil_kegiatan($kirimdata);
  //     if ($success){
  //       session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
  //       return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
  //     } else {
  //       session()->setFlashdata('gagal', 'Data Gagal Disimpan');
  //       return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
  //     }
  //   }

  //   public function delete_laporan_keg($id_laporan_keg)
  //   {
  //     unlink(ROOTPATH . 'public/uploads/laporan_hasil_kegiatan/' . $this->request->getPost('file'));
  //     $success = $this->mainModel->delete_laporan_keg($id_laporan_keg);
  //     if ($success){
  //       session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
  //         return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
  //     } else {
  //       session()->setFlashdata('gagal', 'Data Gagal Dihapus');
  //       return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
  //     }
  //   }

  //   public function edit_laporan_keg()
  //   {
  //     if (!$this->validate([
  //       'file' => [
  //         'rules' => 'mime_in[file,application/pdf]|max_size[file,5048]',
  //         'errors' => [
  //           'mime_in' => 'File Extention Harus Berupa pdf',
  //           'max_size' => 'Ukuran File Maksimal 5 MB'
  //         ]
   
  //       ]
  //     ])) {
  //       session()->setFlashdata('gagal', 'Data Gagal Disimpan, Silahkan cek kembali input data Anda');
  //       return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
  //     }

  //     $file = $this->request->getfile('file');
  //     if ($file->getError() == 4) {
  //       $file_name = $this->request->getPost('file_lama');
  //     } else {
  //       $file_name = $file->getRandomName();
  //       $file->move(ROOTPATH . 'public/uploads/laporan_hasil_kegiatan/', $file_name);
  //       unlink(ROOTPATH . 'public/uploads/laporan_hasil_kegiatan/' . $this->request->getPost('file_lama'));
  //     }

  //     $id_laporan_keg = $this->request->getPost('id_laporan_keg');
  //     $realisasi_anggaran = $this->request->getPost('realisasi_anggaran');
  //     $realisasi_anggaran = str_replace(",", "", $realisasi_anggaran);

  //     $kirimdata = [
  //       'id_laporan_keg' => $id_laporan_keg,
  //       'realisasi_anggaran' => $realisasi_anggaran,
  //       'files' => $file_name,
  //     ];

  //     $success = $this->mainModel->update_laporan_keg($kirimdata);
  //     // $success = $this->mainModel->update_laporan_keg($id_laporan_keg, $realisasi_anggaran, $file_name);
  //     if ($success){
  //       session()->setFlashdata('sukses', 'Data Berhasil Di Update');
  //       return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
  //     } else {
  //       session()->setFlashdata('gagal', 'Data Gagal Di Update');
  //       return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
  //     }
  //   }

  // // persuratan
  // public function submit_surat()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   $data['get_all_lembaga'] = $this->mainModel->get_all_lembaga();
  //   return view('pages/surat/submit_surat', $data);
  // }

  // public function save_surat()
  // {
  //   if (!$this->validate([
  //     'file' => [
  //       'rules' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,5048]',
  //       'errors' => [
  //         'uploaded' => 'Harus Ada File yang diupload',
  //         'mime_in' => 'File Extention Harus Berupa pdf',
  //         'max_size' => 'Ukuran File Maksimal 5 MB'
  //       ]
 
  //     ]
  //   ])) {
  //     session()->setFlashdata('gagal', 'Data Gagal Disimpan, Silahkan cek kembali input data Anda');
  //     return redirect()->to(base_url('/submit_surat'));
  //   }

  //   $tgl_surat = $this->request->getPost('tgl_surat');
  //   $tanggal_surat = date('Y-m-d', strtotime($tgl_surat));
  //   $file = $this->request->getfile('file');
  //   $file_name = $file->getRandomName();
  //   $status = 0;
  //   $created_at = date('Y-m-d H:i:s');
  //   $file->move(ROOTPATH . 'public/uploads/surat/', $file_name);
    
  //   $kirimdata = [
  //     'id_lembaga' => $this->request->getPost('id_lembaga'),
  //     'no_surat' => $this->request->getPost('no_surat'),
  //     'tanggal_surat' => $tanggal_surat,
  //     'jenis_surat' => $this->request->getPost('jenis_surat'),
  //     'nama_penerima' => $this->request->getPost('nama_penerima'),
  //     'lembaga_penerima' => $this->request->getPost('lembaga_penerima'),
  //     'nama_pengirim' => $this->request->getPost('nama_pengirim'),
  //     'jabatan' => $this->request->getPost('jabatan'),
  //     'file' => $file_name,
  //     'perihal' => $this->request->getPost('perihal'),
  //     'status' => $status,
  //     'created_at' => $created_at
  //   ];
    
  //   $success = $this->mainModel->save_surat($kirimdata);
  //   if ($success){
  //     session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
  //     return redirect()->to(base_url('/list_surat_keluar'));
  //   } else {
  //     session()->setFlashdata('gagal', 'Data Gagal Disimpan');
  //     return redirect()->to(base_url('/list_surat_keluar'));
  //   }
  // }

  // public function list_surat_masuk()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   $data['surat_masuk'] = $this->mainModel->get_surat_masuk();
  //   return view('pages/surat/list_surat_masuk', $data);
  // }

  // public function list_surat_keluar()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   $data['surat_keluar'] = $this->mainModel->get_surat_keluar();
  //   return view('pages/surat/list_surat_keluar', $data);
  // }

  // public function status_baca($id_surat)
  // {
  //   $success = $this->mainModel->status_baca($id_surat);
  //   if ($success){
  //     session()->setFlashdata('sukses', 'Status Baca Berhasil Diubah');
  //     return redirect()->to(base_url('/list_surat_masuk'));
  //   } else {
  //     session()->setFlashdata('gagal', 'Data Gagal Disimpan');
  //     return redirect()->to(base_url('/list_surat_masuk'));
  //   }
  // }
  
  // public function delete_surat($id_surat)
  // {
  //   unlink(ROOTPATH . 'public/uploads/surat/' . $this->request->getPost('file'));
  //   $success = $this->mainModel->delete_surat($id_surat);
  //   if ($success){
  //     session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
  //     return redirect()->to(base_url('/list_surat_keluar'));
  //   } else {
  //     session()->setFlashdata('gagal', 'Data Gagal Dihapus');
  //     return redirect()->to(base_url('/list_surat_keluar'));
  //   }
  // }

  // // pelaksanaan
  // public function realisasi_kegiatan()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   $data['get_pagu'] = $this->mainModel->get_all_pagu_anggaran();
  //   $data['sum_realisasi'] = $this->mainModel->sum_all_realisasi_anggaran();
  //   $data['get_anggaran'] = $this->mainModel->get_all_anggaran_lembaga();
  //   return view('pages/pelaksanaan/realisasi_kegiatan', $data);
  // }

  // public function detail_realisasi_kegiatan($id_lembaga)
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   $data['get_laporan'] = $this->mainModel->get_info_laporan_kegiatan($id_lembaga);
  //   $data['get_pagu'] = $this->mainModel->get_pagu_anggaran($id_lembaga);
  //   $data['sum_realisasi'] = $this->mainModel->sum_realisasi_anggaran($id_lembaga);
  //   return view('pages/pelaksanaan/detail_realisasi_kegiatan', $data);
  // }

  // // anggaran
  // public function submit_pagu_anggaran()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   $data['get_no_anggaran'] = $this->mainModel->get_lembaga_no_anggaran();
  //   return view('pages/pagu_anggaran/submit_pagu_anggaran', $data);
  // }

  // public function list_pagu_anggaran()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   $data['get_pagu'] = $this->mainModel->get_anggaran();
  //   return view('pages/pagu_anggaran/list_pagu_anggaran', $data);
  // }

  // public function edit_pagu_anggaran()
  // {
  //   $id_lembaga = $this->request->getPost('id_lembaga');
  //   $pagu_anggaran = $this->request->getPost('pagu_anggaran');
  //   $pagu_anggaran = str_replace(",", "", $pagu_anggaran);

  //   $kirimdata = [
  //     'id_lembaga' => $id_lembaga,
  //     'pagu_anggaran' => $pagu_anggaran
  //   ];
    
  //   $success = $this->mainModel->update_pagu_anggaran($kirimdata);
  //   if ($success){
  //     session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
  //     return redirect()->to(base_url('/list_pagu_anggaran'));
  //   } else {
  //     session()->setFlashdata('gagal', 'Data Gagal Disimpan');
  //     return redirect()->to(base_url('/list_pagu_anggaran'));
  //   }
  // }


  // // manajemen user
  // public function list_admin()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   return view('pages/manajemen_user/list_admin', $data);
  // }

  // public function add_admin()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   return view('pages/manajemen_user/add_admin', $data);
  // }

  // public function list_user()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   return view('pages/manajemen_user/list_user', $data);
  // }

  // public function add_user()
  // {
  //   $data['get_lembaga'] = $this->mainModel->get_info_login_lembaga();
  //   return view('pages/manajemen_user/add_user', $data);
  // }
}
