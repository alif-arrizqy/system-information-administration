<?php


namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\laporanKegiatanModel;

class LaporanKegiatan extends BaseController
{
    protected $laporanKegiatanModel;

    public function __construct()
    {
      $this->laporanKegiatanModel = new laporanKegiatanModel();
      helper('form');
    }

    public function download_laporan_kegiatan($id_laporan_keg)
    {
      $data['files'] = $this->laporanKegiatanModel->get_id_laporan_keg($id_laporan_keg);
      foreach($data['files'] as $file)
      {
        $file_path = $file['file'];
      }
      try {
        echo $file_path;
        return $this->response->download('public/uploads/laporan_hasil_kegiatan/' . $file_path, null);
      } catch (\Exception $e) {
          session()->setFlashdata('gagal', 'Data Tidak Ditemukan');
          return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
      }
    }

    public function submit_laporan_hasil_kegiatan()
    {
      $id_proposal = $this->request->getPost('search_kegiatan');
      $data['get_lembaga'] = $this->laporanKegiatanModel->get_info_login_lembaga();
      $data['get_kegiatan'] = $this->laporanKegiatanModel->get_info_kegiatan();
      $data['get_proposal'] = $this->laporanKegiatanModel->get_info_proposal($id_proposal);
      return view('pages/laporan_hasil_kegiatan/submit_laporan_hasil_kegiatan', $data);
    }

    public function list_laporan_hasil_kegiatan()
    {
      $id_lembaga = session()->get('id_lembaga');
      $data['get_lembaga'] = $this->laporanKegiatanModel->get_info_login_lembaga();
      $data['get_laporan'] = $this->laporanKegiatanModel->get_info_laporan_kegiatan($id_lembaga);
      $data['get_pagu'] = $this->laporanKegiatanModel->get_pagu_anggaran($id_lembaga);
      $data['sum_realisasi'] = $this->laporanKegiatanModel->sum_realisasi_anggaran($id_lembaga);
      return view('pages/laporan_hasil_kegiatan/list_laporan_hasil_kegiatan', $data);
    }

    public function save_laporan_hasil_kegiatan()
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
        session()->setFlashdata('gagal', 'Data Gagal Disimpan: '.$this->validator->listErrors());
        return redirect()->to(base_url('/submit_laporan_hasil_kegiatan'));
      }

      $id_proposal = $this->request->getPost('id_proposal');
      $id_lembaga = $this->request->getPost('id_lembaga');
      $anggaran = $this->request->getPost('realisasi_anggaran');
      $realisasi_anggaran = str_replace(",", "", $anggaran);
      $file = $this->request->getfile('file');
      $file_name = $file->getRandomName();
      $created_at = date('Y-m-d H:i:s');
      $file->move(ROOTPATH . 'public/uploads/laporan_hasil_kegiatan/', $file_name);

      $kirimdata = [
        'id_lembaga' => $id_lembaga,
        'id_proposal' => $id_proposal,
        'realisasi_anggaran' => $realisasi_anggaran,
        'files' => $file_name,
        'created_at' => $created_at,
      ];

      $success = $this->laporanKegiatanModel->save_laporan_hasil_kegiatan($kirimdata);
      if ($success){
        session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
        return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
      } else {
        session()->setFlashdata('gagal', 'Data Gagal Disimpan');
        return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
      }
    }

    public function delete_laporan_keg($id_laporan_keg)
    {
      unlink(ROOTPATH . 'public/uploads/laporan_hasil_kegiatan/' . $this->request->getPost('file'));
      $success = $this->laporanKegiatanModel->delete_laporan_keg($id_laporan_keg);
      if ($success){
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
          return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
      } else {
        session()->setFlashdata('gagal', 'Data Gagal Dihapus');
        return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
      }
    }

    public function edit_laporan_keg()
    {
      if (!$this->validate([
        'file' => [
          'rules' => 'mime_in[file,application/pdf]|max_size[file,5048]',
          'errors' => [
            'mime_in' => 'File Extention Harus Berupa pdf',
            'max_size' => 'Ukuran File Maksimal 5 MB'
          ]
   
        ]
      ])) {
        session()->setFlashdata('gagal', 'Data Gagal Disimpan: '.$this->validator->listErrors());
        return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
      }

      $file = $this->request->getfile('file');
      if ($file->getError() == 4) {
        $file_name = $this->request->getPost('file_lama');
      } else {
        $file_name = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/laporan_hasil_kegiatan/', $file_name);
        unlink(ROOTPATH . 'public/uploads/laporan_hasil_kegiatan/' . $this->request->getPost('file_lama'));
      }

      $id_laporan_keg = $this->request->getPost('id_laporan_keg');
      $realisasi_anggaran = $this->request->getPost('realisasi_anggaran');
      $realisasi_anggaran = str_replace(",", "", $realisasi_anggaran);

      $kirimdata = [
        'id_laporan_keg' => $id_laporan_keg,
        'realisasi_anggaran' => $realisasi_anggaran,
        'files' => $file_name,
      ];

      $success = $this->laporanKegiatanModel->update_laporan_keg($kirimdata);
      // $success = $this->laporanKegiatanModel->update_laporan_keg($id_laporan_keg, $realisasi_anggaran, $file_name);
      if ($success){
        session()->setFlashdata('sukses', 'Data Berhasil Di Update');
        return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
      } else {
        session()->setFlashdata('gagal', 'Data Gagal Di Update');
        return redirect()->to(base_url('/list_laporan_hasil_kegiatan'));
      }
    }
}