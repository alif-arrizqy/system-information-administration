<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_fakultas' => 'Fakultas Hukum'],
            ['nama_fakultas' => 'Fakultas Ekonomi dan Bisnis'],
            ['nama_fakultas' => 'Fakultas Keguruan dan Ilmu Pendidikan'],
            ['nama_fakultas' => 'Fakultas Ilmu Sosial dan Ilmu Budaya'],
            ['nama_fakultas' => 'Fakultas Teknik'],
            ['nama_fakultas' => 'Fakultas Matematika & Ilmu Pengetahuan Alam'],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('fakultas')->insertBatch($data);
    }
}