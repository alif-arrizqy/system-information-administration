<?php

namespace App\Models;

use CodeIgniter\Model;

class mainModel extends Model
{

    public function get_info_login_lembaga()
    {
        $id = session()->get('id_lembaga');
        $query = $this->db->query("SELECT * FROM lembaga WHERE id_lembaga = '$id' ORDER BY id_lembaga DESC LIMIT 1");
        return $query;
    }

    // proposal
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
        return $this->db->query("SELECT * FROM proposal ORDER BY status ASC")->getResultArray();
    }

    public function update_approval($status, $anggaran_diberikan, $id_proposal)
    {
        return $this->db->query("UPDATE proposal SET status = '$status', anggaran_diterima = '$anggaran_diberikan' WHERE id_proposal = '$id_proposal'");
    }

    // lembaga
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

    // laporan hasil kegiatan
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
        return $this->db->query("SELECT proposal.pengajuan_anggaran, proposal.anggaran_diterima, lembaga.nama_lembaga, laporan_kegiatan.files, 
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
        FROM anggaran INNER JOIN lembaga ON anggaran.id_lembaga = lembaga.id_lembaga WHERE lembaga.tingkat_lembaga = 1 OR lembaga.tingkat_lembaga = 2")->getResultArray();
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
