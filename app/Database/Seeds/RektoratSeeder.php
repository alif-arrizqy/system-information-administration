<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RektoratSeeder extends Seeder
{
	public function run()
	{
		$data = [
            [
				'nama_lembaga' => 'WAREK 1',
				'tingkat_lembaga' => 0,
				'id_fakultas' => Null,
				'id_prodi' => Null,
			],
            [
				'nama_lembaga' => 'WAREK 2',
				'tingkat_lembaga' => 0,
				'id_fakultas' => Null,
				'id_prodi' => Null,
			],
            [
				'nama_lembaga' => 'WAREK 3',
				'tingkat_lembaga' => 0,
				'id_fakultas' => Null,
				'id_prodi' => Null,
			],
            [
				'nama_lembaga' => 'DIRMAWA',
				'tingkat_lembaga' => 0,
				'id_fakultas' => Null,
				'id_prodi' => Null,
			],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('lembaga')->insertBatch($data);
	}
}
