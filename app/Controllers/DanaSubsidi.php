<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\danaSubsidiModel;

class DanaSubsidi extends BaseController
{
	protected $danaSubsidiModel;

	public function __construct()
    {
      $this->danaSubsidiModel = new danaSubsidiModel();
      helper('form');
    }

    public function download_subsidi($id_subsidi)
    {
      $data['files'] = $this->danaSubsidiModel->get_id_subsidi($id_subsidi);
      foreach($data['files'] as $file)
      {
        $file_path = $file['file'];
      }
      try{
        echo $file_path;
        return $this->response->download('public/uploads/dana_subsidi/' . $file_path, null);
      } catch (\Exception $e) {
        session()->setFlashdata('error', 'Data Tidak Ditemukan');
        return redirect()->to(base_url('/list_dana_subsidi'));
      }
    }

    public function submit_dana_subsidi()
    {
      $id_subsidi = session()->get('id_subsidi');
      $data['get_lembaga'] = $this->danaSubsidiModel->get_info_login_lembaga();
      $data['get_all_lembaga'] = $this->danaSubsidiModel->get_all_lembaga();
      return view('pages/dana_subsidi/submit_subsidi', $data);
    }

    public function save_dana_subsidi()
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
        session()->setFlashdata('error', 'error Menyimpan! File extention harus berupa pdf dan ukuran maksimal 5 MB');
        return redirect()->to(base_url('/submit_dana_subsidi'));
      }

      $id_lembaga = $this->request->getPost('id_lembaga');
      $lembaga_penerima = $this->request->getPost('lembaga_penerima');
      $judul = $this->request->getPost('judul');
      $anggaran = $this->request->getPost('pengajuan_anggaran');
      $pengajuan_anggaran = str_replace(",", "", $anggaran);
      $file = $this->request->getfile('file');
      $file_name = $file->getRandomName();
      $status = 0;
      $created_at = date('Y-m-d H:i:s');
      $file->move(ROOTPATH . 'public/uploads/dana_subsidi/', $file_name);
      
      $kirimdata = [
        'id_lembaga' => $id_lembaga,
        'lembaga_penerima' => $lembaga_penerima,
        'judul_kegiatan' => $judul,
        'pengajuan_anggaran' => $pengajuan_anggaran,
        'file' => $file_name,
        'status' => $status,
        'created_at' => $created_at
      ];
      
      $success = $this->danaSubsidiModel->save_dana_subsidi($kirimdata);
      if ($success){
        session()->setFlashdata('success', 'Data Berhasil Disimpan');
        return redirect()->to(base_url('/list_dana_subsidi'));
      } else {
        session()->setFlashdata('error', 'Data error Disimpan');
        return redirect()->to(base_url('/list_dana_subsidi'));
      }
    }

    public function edit_dana_subsidi()
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
        session()->setFlashdata('error', 'error Menyimpan! File extention harus berupa pdf dan ukuran maksimal 5 MB');
        return redirect()->to(base_url('/list_dana_subsidi'));
      }

      $file = $this->request->getfile('file');
      if ($file->getError() == 4) {
        $file_name = $this->request->getPost('file_lama');
      } else {
        $file_name = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/dana_subsidi/', $file_name);
        unlink(ROOTPATH . 'public/uploads/dana_subsidi/' . $this->request->getPost('file_lama'));
      }

      $judul = $this->request->getPost('judul');
      $id_lembaga = $this->request->getPost('id_lembaga');
      $id_subsidi = $this->request->getPost('id_subsidi');
      $anggaran = $this->request->getPost('pengajuan_anggaran');
      $pengajuan_anggaran = str_replace(",", "", $anggaran);

      $kirimdata = [
        'id_subsidi' => $id_subsidi,
        'id_lembaga' => $id_lembaga,
        'judul_kegiatan' => $judul,
        'pengajuan_anggaran' => $pengajuan_anggaran,
        'file' => $file_name,
      ];
      $success = $this->danaSubsidiModel->update_dana_subsidi($kirimdata);
      if ($success){
        session()->setFlashdata('success', 'Data Berhasil Di Update');
        return redirect()->to(base_url('/list_dana_subsidi'));
      } else {
        session()->setFlashdata('error', 'Data error Di Update');
        return redirect()->to(base_url('/list_dana_subsidi'));
      }
    }

    public function delete_dana_subsidi($id_subsidi)
    {
      unlink(ROOTPATH . 'public/uploads/dana_subsidi/' . $this->request->getPost('file'));
      $success = $this->danaSubsidiModel->delete_dana_subsidi($id_subsidi);
      if ($success){
        session()->setFlashdata('success', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('/list_dana_subsidi'));
      } else {
        session()->setFlashdata('error', 'Data error Dihapus');
        return redirect()->to(base_url('/list_dana_subsidi'));
      }
    }

    public function list_dana_subsidi()
    {
      $data['get_lembaga'] = $this->danaSubsidiModel->get_info_login_lembaga();
      $data['get_dana_subsidi'] = $this->danaSubsidiModel->user_get_dana_subsidi();
      return view('pages/dana_subsidi/list_subsidi', $data);
    }
    
    public function approve_dana_subsidi()
    {
      $data['get_lembaga'] = $this->danaSubsidiModel->get_info_login_lembaga();
      $data['list_approval'] = $this->danaSubsidiModel->list_approval();
      return view('pages/dana_subsidi/approve_subsidi', $data);
    }

    public function update_approval()
    {
      $id_subsidi = $this->request->getPost('id_subsidi');
      $id_lembaga = $this->request->getPost('id_lembaga');
      $status = $this->request->getPost('status');
      $anggaran = $this->request->getPost('anggaran_diberikan');
      $anggaran_diberikan = str_replace(",", "", $anggaran);

      $success = $this->danaSubsidiModel->update_approval($status, $anggaran_diberikan, $id_subsidi);
      if ($success){
        session()->setFlashdata('success', 'Data Berhasil Disimpan');
        return redirect()->to(base_url('/approve_dana_subsidi'));
      } else {
        session()->setFlashdata('error', 'Data error Disimpan');
        return redirect()->to(base_url('/approve_dana_subsidi'));
      }
    }
}
