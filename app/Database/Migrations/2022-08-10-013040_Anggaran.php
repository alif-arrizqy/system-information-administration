<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggaran extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_anggaran' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_lembaga' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'pagu_anggaran' => [
				'type'	   	=> 'INT',
				'constraint' => '11',
			],
			'created_at' => [
				'type'	   	=> 'TIMESTAMP'
			],
			'updated_at' => [
				'type'	   	=> 'TIMESTAMP',
				'attributes' => ['DEFAULT', 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP']
			]
		]);
		$this->forge->addKey('id_anggaran', true);
		$this->forge->createTable('anggaran');
	}

	public function down()
	{
		$this->forge->dropTable('anggaran');
	}
}
