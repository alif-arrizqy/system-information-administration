<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lembaga extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_lembaga' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_lembaga' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tingkat_lembaga' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'id_fakultas' => [
                'type'       => 'INT',
                'constraint' => '11',
				'Null'		 => true,
			],
            'id_prodi' => [
                'type'       => 'INT',
                'constraint' => '11',
				'Null'		 => true,
            ],
        ]);
        $this->forge->addKey('id_lembaga', true);
        $this->forge->createTable('lembaga');
	}

	public function down()
	{
		$this->forge->dropTable('lembaga');
	}
}
