<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
	public function run()
	{
		$data = [
            [
				'fullname' => 'Andi Chairunnas',
				'username' => 'admin',
				'password' => md5('admin'),
				'status' => 0,
				'id_lembaga' => 4,
				'foto' => NULL
			]
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
	}
}
