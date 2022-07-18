<?php

namespace App\Models;

use CodeIgniter\Model;

class mainModel extends Model
{

    public function get_lembaga()
    {
        $id = session()->get('id_lembaga');
        $query = $this->db->query("SELECT * FROM lembaga WHERE id_lembaga = '$id' ORDER BY id_lembaga DESC LIMIT 1");
        return $query;
    }

    // profile -----------------------------------------------------------
    public function myprofile()
    {
        return $this->db->table('users')
            ->where('id_user', session()->get('id_user'))->get();
    }

    public function list_user()
    {
        $query = $this->db->query("SELECT * FROM users WHERE status='2' ORDER BY id_user ASC")->getResultArray();
        return $query;
    }

    public function saveUser($kirimdata)
    {
        $query = $this->db->table('users')->insert($kirimdata);
        return $query;
    }

    // Monitoring -------------------------------------------------------

    // cek relay aktif atau tidak
    public function cek_relay($id_token)
    {
        $query = $this->db->query("SELECT * FROM relay WHERE id_token = '$id_token'");
        return $query;
    }

    // untuk mendapatkan nilai waterflow dari tabel data_sensor
    public function get_wf($id_token, $id_user)
    {
        $query = $this->db->query("SELECT * FROM data_sensor WHERE id_token = '$id_token' AND id_user = '$id_user' ORDER BY id_token = '$id_token' DESC LIMIT 1");
        return $query;
    }

    // get id token
    public function get_idtoken()
    {
        $id = session()->get('id_user');
        $query = $this->db->query("SELECT * FROM token WHERE id_user = '$id' ORDER BY id DESC LIMIT 1");
        return $query;
    }


    // get harga beli token
    public function get_harga_beli($bulan, $id_user)
    {
        $query = $this->db->query("SELECT id_token, id_user, SUM(harga) AS hrg, SUM(jumlah_air) AS jml_air FROM token WHERE id_user='$id_user'
        AND bulan='$bulan'");
        return $query;
    }

    // get jumlah keseluruhan waterflow per idtoken
    public function get_jumlah_wf($id_token, $id_user)
    {
        $query = $this->db->query("SELECT SUM(waterflow) AS total_wf FROM data_sensor 
        WHERE id_token = '$id_token' AND id_user = '$id_user'");
        return $query;
    }

    // get jumlah keseluruhan waterflow per bulan
    public function get_jumlah_wf_bulan($bulan, $id_user)
    {
        $query = $this->db->query("SELECT SUM(waterflow) AS total_wf_bulan FROM data_sensor 
        WHERE bulan = '$bulan' AND id_user = '$id_user'");
        return $query;
    }


    // Token ------------------------------------------------------------------
    public function addToken($kirimdata)
    {
        $query = $this->db->table('token')->insert($kirimdata);
        return $query;
    }

    // get data token per bulan
    public function getTokenBulanan($id_user, $bulan)
    {
        $query = $this->db->query("SELECT a.*, b.* FROM token AS a INNER JOIN rekap_data AS b
        ON a.id_token = b.id_token WHERE a.id_user = '$id_user' AND a.bulan='$bulan'")->getResultArray();
        return $query;
    }


    // relay ----------------------------------------------------------------
    public function findKode($kirimdata)
    {
        $query = $this->db->query("SELECT * FROM relay WHERE kode = '$kirimdata'");
        return $query;
    }

    // menambahkan data id user dan id token, pada saat pengisian token di web
    public function addRelay($kirimdata2)
    {
        $query = $this->db->table('relay')->insert($kirimdata2);
        return $query;
    }

    // cari relay aktif untuk dikirimkan ke nodemcu
    public function getRelayAktif($token_id, $user_id, $relay_akt)
    {
        $query = $this->db->query("SELECT * FROM relay 
        WHERE id_token='$token_id' AND id_user='$user_id' AND relay_status='$relay_akt'");
        return $query;
    }

    // cari update relay jadi 0
    public function sendRelayMati($token_id, $relay_mati)
    {
        $query = $this->db->query("UPDATE relay SET relay_status = '$relay_mati' WHERE id_token = '$token_id'");
        return $query;
    }


    // save data sensor waterflow
    public function add_data_waterflow($kirimdata)
    {
        $query = $this->db->table('data_sensor')->insert($kirimdata);
        return $query;
    }

    // cek data di tabel rekap udah atau belum
    public function cek_rekap_wf($bulan, $id_user)
    {
        $query = $this->db->query("SELECT * FROM rekap_data 
        WHERE bulan = '$bulan' AND id_user = '$id_user'");
        return $query->getNumRows();
    }

    // save data idtoken iduser bulan ke tabel rekap
    function add_rekap_wf($kirimdata2)
    {
        $query = $this->db->table('rekap_data')->insert($kirimdata2);
        return $query;
    }

    // 
    public function total_air($bulan)
    {
        // $query = $this->db->query("SELECT SUM(jumlah) AS total_jumlah FROM token WHERE bulan = '$bulan'");
        // return $query;
    }

    // laporan ----------------------------------------------------------------
    public function user_detail_laporan($id_user)
    {
        $query = $this->db->query("SELECT * FROM users WHERE id_user = '$id_user'");
        return $query;
    }
}
