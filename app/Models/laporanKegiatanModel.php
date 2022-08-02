<?php

namespace App\Models;

use CodeIgniter\Model;

class laporanKegiatanModel extends Model
{

    public function get_info_login_lembaga()
    {
        $id = session()->get('id_lembaga');
        $query = $this->db->query("SELECT * FROM lembaga WHERE id_lembaga = '$id' ORDER BY id_lembaga DESC LIMIT 1");
        return $query;
    }

    public function get_info_kegiatan()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT * FROM proposal WHERE id_lembaga = '$id_lembaga' AND status = '1' ORDER BY status ASC")->getResultArray();
    }

    public function get_info_proposal($id_proposal)
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT * FROM proposal WHERE id_lembaga = '$id_lembaga' AND id_proposal = '$id_proposal'")->getResultArray();
    }

    public function save_laporan_hasil_kegiatan($kirimdata)
    {
        return $this->db->table('laporan_kegiatan')->insert($kirimdata);
    }

    public function save_anggaran($kirimdata)
    {
        return $this->db->table('anggaran')->insert($kirimdata);
    }

    public function get_info_laporan_kegiatan($id_lembaga)
    {
        // $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT proposal.judul_kegiatan, proposal.pengajuan_anggaran, proposal.anggaran_diterima, lembaga.nama_lembaga, laporan_kegiatan.files, 
        laporan_kegiatan.id_laporan_keg, laporan_kegiatan.realisasi_anggaran
        FROM laporan_kegiatan INNER JOIN proposal ON laporan_kegiatan.id_proposal = proposal.id_proposal
        INNER JOIN lembaga ON laporan_kegiatan.id_lembaga = lembaga.id_lembaga
        WHERE lembaga.id_lembaga = '$id_lembaga'")->getResultArray();
    }

    public function get_id_laporan_keg($id_laporan_keg)
    {
        return $this->db->query("SELECT file FROM laporan_kegiatan WHERE id_laporan_keg = '$id_laporan_keg'")->getResultArray();
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

    public function delete_laporan_keg($id_laporan_keg)
    {
        return $this->db->query("DELETE FROM laporan_kegiatan WHERE id_laporan_keg = '$id_laporan_keg'");
    }

    public function update_laporan_keg($kirimdata)
    {
        return $this->db->table('laporan_kegiatan')->where('id_laporan_keg', $kirimdata['id_laporan_keg'])->update($kirimdata);
    }
}