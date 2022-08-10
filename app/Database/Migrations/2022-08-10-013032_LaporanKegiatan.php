<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanKegiatan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_laporan_keg' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_lembaga' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'id_proposal' => [
				'type'       => 'INT',
				'constraint' => '11',
			],
			'realisasi_anggaran' => [
				'type'	   	=> 'INT',
				'constraint' => '11',
			],
			'file' => [
				'type'	   	=> 'TEXT',
			],
			'created_at' => [
				'type'	   	=> 'TIMESTAMP'
			],
			'updated_at' => [
				'type'	   	=> 'TIMESTAMP',
				'attributes' => ['DEFAULT', 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP']
			]
		]);
		$this->forge->addKey('id_laporan_keg', true);
		$this->forge->createTable('laporan_kegiatan');
	}

	public function down()
	{
		$this->forge->dropTable('laporan_kegiatan');
	}
}
