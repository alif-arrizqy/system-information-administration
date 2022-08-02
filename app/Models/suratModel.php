<?php

namespace App\Models;

use CodeIgniter\Model;

class suratModel extends Model
{

    public function get_info_login_lembaga()
    {
        $id = session()->get('id_lembaga');
        $query = $this->db->query("SELECT * FROM lembaga WHERE id_lembaga = '$id' ORDER BY id_lembaga DESC LIMIT 1");
        return $query;
    }

    public function get_all_lembaga()
    {
        return $this->db->query("SELECT * FROM lembaga")->getResultArray();       
    }

    public function get_id_surat($id_surat)
    {
        return $this->db->query("SELECT file FROM surat WHERE id_surat = '$id_surat'")->getResultArray();
    }

    public function save_surat($kirimdata)
    {
        return $this->db->table('surat')->insert($kirimdata); 
    }

    public function get_surat_keluar()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT * FROM surat WHERE id_lembaga = '$id_lembaga' ORDER BY status ASC")->getResultArray();
    }

    public function get_surat_masuk()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT * FROM surat WHERE lembaga_penerima = '$id_lembaga' ORDER BY status ASC")->getResultArray();
    }

    public function status_baca($id_surat)
    {
        return $this->db->query("UPDATE surat SET status = '1' WHERE id_surat = '$id_surat'");
    }

    public function delete_surat($id_surat)
    {
        return $this->db->query("DELETE FROM surat WHERE id_surat = '$id_surat'");
    }
}