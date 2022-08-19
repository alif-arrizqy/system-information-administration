<?php

namespace App\Models;

use CodeIgniter\Model;

class proposalModel extends Model
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

    public function save_proposal($kirimdata)
    {
        return $this->db->table('proposal')->insert($kirimdata);
    }

    public function user_get_proposal()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT * FROM proposal WHERE id_lembaga = '$id_lembaga' ORDER BY status ASC")->getResultArray();
    }

    public function get_id_proposal($id_proposal)
    {
        return $this->db->query("SELECT file FROM proposal WHERE id_proposal = '$id_proposal'")->getResultArray();
    }

    public function update_proposal($kirimdata)
    {
        return $this->db->table('proposal')->where('id_proposal', $kirimdata['id_proposal'])->update($kirimdata);
    }

    public function delete_proposal($id_proposal)
    {
        return $this->db->query("DELETE FROM proposal WHERE id_proposal = '$id_proposal'");
    }

    public function list_approval()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT * FROM proposal WHERE lembaga_penerima = '$id_lembaga' or lembaga_disposisi = '$id_lembaga' or lembaga_mengetahui = '$id_lembaga' ORDER BY status ASC")->getResultArray();
    }

    public function update_approval($status, $anggaran_diberikan, $id_proposal)
    {
        return $this->db->query("UPDATE proposal SET status = '$status', anggaran_diterima = '$anggaran_diberikan' WHERE id_proposal = '$id_proposal'");
    }

    public function get_pagu_anggaran($id_lembaga)
    {
        return $this->db->query("SELECT lembaga.nama_lembaga, anggaran.pagu_anggaran FROM lembaga INNER JOIN anggaran ON lembaga.id_lembaga = anggaran.id_lembaga
        WHERE lembaga.id_lembaga = '$id_lembaga'")->getResultArray();
    }

    public function sum_realisasi_anggaran($id_lembaga)
    {
        return $this->db->query("SELECT SUM(realisasi_anggaran) AS realisasi_anggaran FROM laporan_kegiatan WHERE id_lembaga = '$id_lembaga'")->getRowArray();
    }
}