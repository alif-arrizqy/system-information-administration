<?php

namespace App\Models;

use CodeIgniter\Model;

class kelembagaanAnggaranModel extends Model
{
    public function get_info_login_lembaga()
    {
        $id = session()->get('id_lembaga');
        $query = $this->db->query("SELECT * FROM lembaga WHERE id_lembaga = '$id' ORDER BY id_lembaga DESC LIMIT 1");
        return $query;
    }

    public function get_lembaga_no_anggaran()
    {
        return $this->db->query("SELECT lembaga.id_lembaga, lembaga.nama_lembaga, anggaran.id_anggaran, anggaran.pagu_anggaran
        FROM lembaga INNER JOIN anggaran ON lembaga.id_lembaga = anggaran.id_lembaga
        WHERE anggaran.pagu_anggaran = 0 or anggaran.pagu_anggaran = NULL")->getResultArray();       
    }

    public function get_anggaran($tingkat_lembaga)
    {
        return $this->db->query("SELECT lembaga.id_lembaga, lembaga.nama_lembaga, anggaran.pagu_anggaran
        FROM lembaga INNER JOIN anggaran ON lembaga.id_lembaga = anggaran.id_lembaga
        WHERE lembaga.tingkat_lembaga = '$tingkat_lembaga'")->getResultArray();
    }

    public function update_pagu_anggaran($kirimdata)
    {
        return $this->db->table('anggaran')->where('id_lembaga', $kirimdata['id_lembaga'])->update($kirimdata);
    }

    public function save_lembaga($kirimdata)
    {
        $this->db->table('lembaga')->insert($kirimdata);
        $datas = $this->db->insertID();
        return $this->db->table('anggaran')->insert(['id_lembaga' => $datas, 'pagu_anggaran' => 0]);
    }

}