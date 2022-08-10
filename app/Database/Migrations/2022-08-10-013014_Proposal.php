<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Proposal extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_proposal' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_lembaga' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'lembaga_penerima' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'lembaga_disposisi' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'lembaga_mengetahui' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'judul_kegiatan' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'pengajuan_anggaran' => [
				'type'	   	=> 'INT',
				'constraint' => '11',
			],
			'anggaran_diterima' => [
				'type'	   	=> 'INT',
				'constraint' => '11',
			],
			'file' => [
				'type'	   	=> 'TEXT',
			],
			'status' => [
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
		$this->forge->addKey('id_proposal', true);
		$this->forge->createTable('proposal');
	}

	public function down()
	{
		$this->forge->dropTable('proposal');
	}
}
