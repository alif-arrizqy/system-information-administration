<?php


namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\pelaksanaanModel;

class Pelaksanaan extends BaseController
{
    protected $pelaksanaanModel;

    public function __construct()
    {
      $this->pelaksanaanModel = new pelaksanaanModel();
      helper('form');
    }

    // rekap
    public function realisasi_kegiatan()
    {
        $data['get_lembaga'] = $this->pelaksanaanModel->get_info_login_lembaga();
        $data['get_pagu'] = $this->pelaksanaanModel->get_all_pagu_anggaran();
        $data['sum_realisasi'] = $this->pelaksanaanModel->sum_all_realisasi_anggaran();
        $data['get_anggaran'] = $this->pelaksanaanModel->get_all_anggaran_lembaga();
        return view('pages/pelaksanaan/rekap/realisasi_kegiatan', $data);
    }

    public function detail_realisasi_kegiatan($id_lembaga)
    {
        $data['get_lembaga'] = $this->pelaksanaanModel->get_info_login_lembaga();
        $data['get_laporan'] = $this->pelaksanaanModel->get_info_laporan_kegiatan($id_lembaga);
        $data['get_pagu'] = $this->pelaksanaanModel->get_pagu_anggaran($id_lembaga);
        $data['sum_realisasi'] = $this->pelaksanaanModel->sum_realisasi_anggaran($id_lembaga);
        return view('pages/pelaksanaan/rekap/detail_realisasi_kegiatan', $data);
    }

    public function realisasi_kegiatan_kelembagaan($jenis_lembaga)
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

        $data['get_lembaga'] = $this->pelaksanaanModel->get_info_login_lembaga();
        $data['get_pagu'] = $this->pelaksanaanModel->get_pagu_anggaran_lembaga($tingkat_lembaga);
        $data['sum_realisasi'] = $this->pelaksanaanModel->sum_realisasi_anggaran_lembaga($tingkat_lembaga);
        $data['get_anggaran'] = $this->pelaksanaanModel->get_anggaran_lembaga($tingkat_lembaga);
        return view('pages/pelaksanaan/lembaga/realisasi_kegiatan', $data);
    }

    public function detail_realisasi_kegiatan_kelembagaan($id_lembaga)
    {
        $data['get_lembaga'] = $this->pelaksanaanModel->get_info_login_lembaga();
        $data['get_laporan'] = $this->pelaksanaanModel->get_info_laporan_kegiatan($id_lembaga);
        $data['get_pagu'] = $this->pelaksanaanModel->get_pagu_anggaran($id_lembaga);
        $data['sum_realisasi'] = $this->pelaksanaanModel->sum_realisasi_anggaran($id_lembaga);
        return view('pages/pelaksanaan/lembaga/detail_realisasi_kegiatan', $data);
    }
}