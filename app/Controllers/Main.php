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
      if (session()->get('username') == '') {
        session()->setFlashdata('gagal', 'Anda belum login !');
        return redirect()->to(base_url('/Login'));
      }
      
      $data['get_lembaga'] = $this->mainModel->get_lembaga();
      return view('pages/index', $data);
    }

    // proposal
    public function submit_proposal()
    {
      return view('pages/dokumen_proposal/submit_proposal');
    }

    public function list_proposal()
    {
      return view('pages/dokumen_proposal/list_proposal');
    }
    
    public function approve_proposal()
    {
      if (session()->get('username') == '') {
        session()->setFlashdata('gagal', 'Anda belum login !');
        return redirect()->to(base_url('/Login'));
      }
      
      return view('pages/dokumen_proposal/approve_proposal');
    }

    // laporan hasil kegiatan
    public function submit_laporan_hasil_kegiatan()
    {
      return view('pages/laporan_hasil_kegiatan/submit_laporan_hasil_kegiatan');
    }

    public function list_laporan_hasil_kegiatan()
    {
      return view('pages/laporan_hasil_kegiatan/list_laporan_hasil_kegiatan');
    }

  // persuratan
  public function submit_surat()
  {
    return view('pages/surat/submit_surat');
  }

  public function list_surat_masuk()
  {
    return view('pages/surat/list_surat_masuk');
  }

  public function list_surat_keluar()
  {
    return view('pages/surat/list_surat_keluar');
  }

  // pelaksanaan
  public function realisasi_kegiatan()
  {
    return view('pages/pelaksanaan/realisasi_kegiatan');
  }

  public function detail_realisasi_kegiatan()
  {
    return view('pages/pelaksanaan/detail_realisasi_kegiatan');
  }

  // manajemen user
  public function list_admin()
  {
    return view('pages/manajemen_user/list_admin');
  }

  public function add_admin()
  {
    return view('pages/manajemen_user/add_admin');
  }

  public function list_user()
  {
    return view('pages/manajemen_user/list_user');
  }

  public function add_user()
  {
    return view('pages/manajemen_user/add_user');
  }
}
