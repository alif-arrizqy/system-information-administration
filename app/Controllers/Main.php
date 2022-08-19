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
}
