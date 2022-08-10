<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProgramStudi extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id_prodi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_prodi', true);
        $this->forge->createTable('program_studi');
	}

	public function down()
	{
		$this->forge->dropTable('program_studi');
	}
}
