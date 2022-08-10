<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdiSeeder extends Seeder
{
	public function run()
	{
		$data = [
            ['nama_prodi' => 'Hukum'],
            ['nama_prodi' => 'Manajemen'],
            ['nama_prodi' => 'Akuntansi'],
            ['nama_prodi' => 'Bisnis Digital'],
            ['nama_prodi' => 'Bahasa Sastra Indonesia'],
            ['nama_prodi' => 'Bahasa Inggris'],
            ['nama_prodi' => 'Bahasa Pendidikan Biologi'],
            ['nama_prodi' => 'Bahasa Pendidikan IPA'],
            ['nama_prodi' => 'PGSD'],
            ['nama_prodi' => 'PPG FKIP'],
            ['nama_prodi' => 'Bahasa & Sastra Inggris'],
            ['nama_prodi' => 'Bahasa & Sastra Jepang'],
            ['nama_prodi' => 'Bahasa & Sastra Indonesia'],
            ['nama_prodi' => 'Ilmu Komunikasi'],
            ['nama_prodi' => 'Geologi'],
            ['nama_prodi' => 'Perencanaan Wilayah & Kota'],
            ['nama_prodi' => 'Sipil'],
            ['nama_prodi' => 'Teknik Elektro'],
            ['nama_prodi' => 'Teknik Geodesi'],
            ['nama_prodi' => 'Biologi'],
            ['nama_prodi' => 'Kimia'],
            ['nama_prodi' => 'Matematika'],
            ['nama_prodi' => 'Ilmu Komputer'],
            ['nama_prodi' => 'Farmasi'],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('program_studi')->insertBatch($data);
	}
}
