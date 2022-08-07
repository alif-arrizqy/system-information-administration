<?php

namespace App\Models;

use CodeIgniter\Model;

class pelaksanaanModel extends Model
{

    public function get_info_login_lembaga()
    {
        $id = session()->get('id_lembaga');
        $query = $this->db->query("SELECT * FROM lembaga WHERE id_lembaga = '$id' ORDER BY id_lembaga DESC LIMIT 1");
        return $query;
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

    public function get_pagu_anggaran($id_lembaga)
    {
        return $this->db->query("SELECT lembaga.nama_lembaga, anggaran.pagu_anggaran FROM lembaga INNER JOIN anggaran ON lembaga.id_lembaga = anggaran.id_lembaga
        WHERE lembaga.id_lembaga = '$id_lembaga'")->getResultArray();
    }

    public function sum_realisasi_anggaran($id_lembaga)
    {
        return $this->db->query("SELECT SUM(realisasi_anggaran) AS realisasi_anggaran FROM laporan_kegiatan WHERE id_lembaga = '$id_lembaga'")->getRowArray();
    }

    // realisasi anggaran
    // dirmawa
    public function get_all_pagu_anggaran()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT SUM(pagu_anggaran) AS pagu_anggaran FROM anggaran")->getResultArray();
    }

    public function sum_all_realisasi_anggaran()
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT SUM(realisasi_anggaran) AS realisasi_anggaran FROM laporan_kegiatan")->getRowArray();
    }

    public function get_all_anggaran_lembaga()
    {
        return $this->db->query("SELECT lembaga.nama_lembaga, anggaran.pagu_anggaran, anggaran.id_lembaga
        FROM anggaran INNER JOIN lembaga ON anggaran.id_lembaga = lembaga.id_lembaga")->getResultArray();
    }

    // lembaga
    public function get_pagu_anggaran_lembaga($tingkat_lembaga)
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT SUM(pagu_anggaran) AS pagu_anggaran FROM anggaran
        INNER JOIN lembaga ON anggaran.id_lembaga = lembaga.id_lembaga
        WHERE lembaga.tingkat_lembaga = '$tingkat_lembaga'")->getResultArray();
    }

    public function sum_realisasi_anggaran_lembaga($tingkat_lembaga)
    {
        $id_lembaga = session()->get('id_lembaga');
        return $this->db->query("SELECT SUM(laporan_kegiatan.realisasi_anggaran) AS realisasi_anggaran FROM laporan_kegiatan
        INNER JOIN lembaga ON laporan_kegiatan.id_lembaga = lembaga.id_lembaga
        WHERE lembaga.tingkat_lembaga = '$tingkat_lembaga'")->getRowArray();
    }

    public function get_anggaran_lembaga($tingkat_lembaga)
    {
        return $this->db->query("SELECT lembaga.nama_lembaga, anggaran.pagu_anggaran, anggaran.id_lembaga
        FROM anggaran INNER JOIN lembaga ON anggaran.id_lembaga = lembaga.id_lembaga WHERE lembaga.tingkat_lembaga = '$tingkat_lembaga'")->getResultArray();
    }

    // pagu anggaran
    public function get_lembaga_no_anggaran()
    {
        return $this->db->query("SELECT lembaga.id_lembaga, lembaga.nama_lembaga, anggaran.id_anggaran, anggaran.pagu_anggaran
        FROM lembaga INNER JOIN anggaran ON lembaga.id_lembaga = anggaran.id_lembaga
        WHERE anggaran.pagu_anggaran = 0")->getResultArray();       
    }

    public function get_anggaran()
    {
        return $this->db->query("SELECT * FROM anggaran")->getResultArray();
    }

    public function update_pagu_anggaran($kirimdata)
    {
        return $this->db->table('anggaran')->where('id_lembaga', $kirimdata['id_lembaga'])->update($kirimdata);
    }
}
