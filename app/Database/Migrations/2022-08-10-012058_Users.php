<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'fullname' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
			],
            'status' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'id_lembaga' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
			],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
