<?php


namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\kelembagaanAnggaranModel;

class KelembagaanAnggaran extends BaseController
{
    protected $kelembagaanAnggaranModel;

    public function __construct()
    {
      $this->kelembagaanAnggaranModel = new kelembagaanAnggaranModel();
      helper('form');
    }

    // lembaga dan anggaran
    public function submit_lembaga($jenis_lembaga)
    {
        if ($jenis_lembaga == 'univ'){
            $tingkat_lembaga = 1;
        } else if ($jenis_lembaga == 'ukm'){
            $tingkat_lembaga = 2;
        } else if ($jenis_lembaga == 'fak'){
            $tingkat_lembaga = 3;
        } else {
            $tingkat_lembaga = 4;
        }

        $data['get_lembaga'] = $this->kelembagaanAnggaranModel->get_info_login_lembaga();
        $data['get_no_anggaran'] = $this->kelembagaanAnggaranModel->get_lembaga_no_anggaran($tingkat_lembaga);
        $data['get_fakultas'] = $this->kelembagaanAnggaranModel->get_fakultas();
        $data['get_prodi'] = $this->kelembagaanAnggaranModel->get_prodi();
        $data['tingkat_lembaga'] = $tingkat_lembaga;
        return view('pages/kelembagaan_anggaran/submit_lembaga_anggaran', $data);
    }

    public function list_lembaga($jenis_lembaga)
    {
        if ($jenis_lembaga == 'univ'){
            $tingkat_lembaga = 1;
        } else if ($jenis_lembaga == 'ukm'){
            $tingkat_lembaga = 2;
        } else if ($jenis_lembaga == 'fak'){
            $tingkat_lembaga = 3;
        } else {
            $tingkat_lembaga = 4;
        }

        $data['get_lembaga'] = $this->kelembagaanAnggaranModel->get_info_login_lembaga();
        $data['get_pagu'] = $this->kelembagaanAnggaranModel->get_anggaran($tingkat_lembaga);
        $data['tingkat_lembaga'] = $tingkat_lembaga;
        return view('pages/kelembagaan_anggaran/list_lembaga_anggaran', $data);
    }

    public function add_anggaran()
    {
        $tingkat_lembaga = $this->request->getPost('tingkat_lembaga');
        if ($tingkat_lembaga == 1){
            $jenis_lembaga = "univ";
        } else if ($tingkat_lembaga == 2){
            $jenis_lembaga = "ukm";
        } else if ($tingkat_lembaga == 3){
            $jenis_lembaga = "fak";
        } else if ($tingkat_lembaga == 4){
            $jenis_lembaga = "prodi";
        }

        $id_lembaga = $this->request->getPost('id_lembaga');
        $pagu_anggaran = $this->request->getPost('anggaran');
        $pagu_anggaran = str_replace(",", "", $pagu_anggaran);

        $kirimdata = [
            'id_lembaga' => $id_lembaga,
            'pagu_anggaran' => $pagu_anggaran
        ];
        
        $success = $this->kelembagaanAnggaranModel->add_anggaran($kirimdata);
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
            return redirect()->to(base_url('/list_lembaga/'.$jenis_lembaga));
        } else {
            session()->setFlashdata('gagal', 'Data Gagal Disimpan');
            return redirect()->to(base_url('/list_lembaga/'.$jenis_lembaga));
        }
    }

    public function save_lembaga()
    {
        $tingkat_lembaga = $this->request->getPost('tingkat_lembaga');
        if ($tingkat_lembaga == 1){
            $jenis_lembaga = "univ";
        } else if ($tingkat_lembaga == 2){
            $jenis_lembaga = "ukm";
        } else if ($tingkat_lembaga == 3){
            $jenis_lembaga = "fak";
        } else if ($tingkat_lembaga == 4){
            $jenis_lembaga = "prodi";
        }
        
        $id_fakultas = $this->request->getPost('fakultas');
        if (!empty($id_fakultas)) {
            $id_fakultas = $this->request->getPost('fakultas');
        } else {
            $id_fakultas = Null;
        }
        $id_prodi = $this->request->getPost('prodi');
        if (!empty($id_prodi)) {
            $id_prodi = $this->request->getPost('prodi');
        } else {
            $id_prodi = Null;
        }

        $kirimdata = [
            'nama_lembaga' => strtoupper($this->request->getPost('nama_lembaga')),
            'tingkat_lembaga' => $tingkat_lembaga,
            'id_fakultas' => $id_fakultas,
            'id_prodi' => $id_prodi,
        ];
        $success = $this->kelembagaanAnggaranModel->save_lembaga($kirimdata);
        
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
            return redirect()->to(base_url('/submit_lembaga/'.$jenis_lembaga));
        } else {
            session()->setFlashdata('gagal', 'Data Gagal Disimpan');
            return redirect()->to(base_url('/submit_lembaga/'.$jenis_lembaga));
        }
    }

    public function update_lembaga($id_lembaga)
    {
        $tingkat_lembaga = $this->request->getPost('tingkat_lembaga');
        $nama_lembaga = $this->request->getPost('nama_lembaga');
        $pagu_anggaran = $this->request->getPost('anggaran');
        $pagu_anggaran = str_replace(",", "", $pagu_anggaran);

        if ($tingkat_lembaga == 1){
            $jenis_lembaga = "univ";
        } else if ($tingkat_lembaga == 2){
            $jenis_lembaga = "ukm";
        } else if ($tingkat_lembaga == 3){
            $jenis_lembaga = "fak";
        } else if ($tingkat_lembaga == 4){
            $jenis_lembaga = "prodi";
        }
        $kirimdata = [
            'id_lembaga' => $id_lembaga,
            'nama_lembaga' => $nama_lembaga,
            'pagu_anggaran' => $pagu_anggaran,
        ];

        $success = $this->kelembagaanAnggaranModel->update_lembaga($kirimdata);
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Disimpan');
            return redirect()->to(base_url('/list_lembaga/'.$jenis_lembaga));
        } else {
            session()->setFlashdata('gagal', 'Data Gagal Disimpan');
            return redirect()->to(base_url('/list_lembaga/'.$jenis_lembaga));
        }
    }

    public function delete_lembaga($id_lembaga)
    {
        $tingkat_lembaga = $this->request->getPost('tingkat_lembaga');
        if ($tingkat_lembaga == 1){
            $jenis_lembaga = "univ";
        } else if ($tingkat_lembaga == 2){
            $jenis_lembaga = "ukm";
        } else if ($tingkat_lembaga == 3){
            $jenis_lembaga = "fak";
        } else if ($tingkat_lembaga == 4){
            $jenis_lembaga = "prodi";
        }

        $success = $this->kelembagaanAnggaranModel->delete_lembaga($id_lembaga);
        if ($success){
            session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
            return redirect()->to(base_url('/list_lembaga/'.$jenis_lembaga));
        } else {
            session()->setFlashdata('gagal', 'Data Gagal Dihapus');
            return redirect()->to(base_url('/list_lembaga/'.$jenis_lembaga));
        }
    }
}