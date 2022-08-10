<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Surat extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_surat' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_lembaga' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'no_surat' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'tanggal_surat' => [
				'type'       => 'DATE',
			],
			'jenis_surat' => [
				'type'	   	=> 'INT',
				'constraint' => '11',
			],
			'nama_penerima' => [
				'type'	   	=> 'VARCHAR',
				'constraint' => '100',
			],
			'lembaga_penerima' => [
				'type'	   	=> 'INT',
				'constraint' => '11',
			],
			'nama_disposisi' => [
				'type'	   	=> 'VARCHAR',
				'constraint' => '100',
			],
			'lembaga_disposisi' => [
				'type'	   	=> 'INT',
				'constraint' => '11',
			],
			'nama_pengirim' => [
				'type'	   	=> 'VARCHAR',
				'constraint' => '100',
			],
			'jabatan' => [
				'type'	   	=> 'VARCHAR',
				'constraint' => '100',
			],
			'file' => [
				'type'	   	=> 'TEXT',
			],
			'perihal' => [
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
				'type'	   	=> 'TIMESTAMP'
			]
		]);
		$this->forge->addKey('id_surat', true);
		$this->forge->addUniqueKey('no_surat');
		$this->forge->createTable('surat');
	}

	public function down()
	{
		$this->forge->dropTable('surat');
	}
}
