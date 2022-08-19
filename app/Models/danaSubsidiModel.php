<?php

namespace App\Models;

use CodeIgniter\Model;

class danaSubsidiModel extends Model
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

    public function save_dana_subsidi($kirimdata)
    {
        return $this->db->table('dana_subsidi')->insert($kirimdata);
    }

    public function user_get_dana_subsidi()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT * FROM dana_subsidi WHERE id_lembaga = '$id_lembaga' ORDER BY status ASC")->getResultArray();
    }

    public function get_id_subsidi($id_subsidi)
    {
        return $this->db->query("SELECT file FROM dana_subsidi WHERE id_subsidi = '$id_subsidi'")->getResultArray();
    }

    public function update_dana_subsidi($kirimdata)
    {
        return $this->db->table('dana_subsidi')->where('id_subsidi', $kirimdata['id_subsidi'])->update($kirimdata);
    }

    public function delete_dana_subsidi($id_subsidi)
    {
        return $this->db->query("DELETE FROM dana_subsidi WHERE id_subsidi = '$id_subsidi'");
    }

    public function list_approval()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT * FROM dana_subsidi WHERE lembaga_penerima = '$id_lembaga' ORDER BY status ASC")->getResultArray();
    }

    public function update_approval($status, $anggaran_diberikan, $id_subsidi)
    {
        return $this->db->query("UPDATE dana_subsidi SET status = '$status', anggaran_diterima = '$anggaran_diberikan' WHERE id_subsidi = '$id_subsidi'");
    }
}
