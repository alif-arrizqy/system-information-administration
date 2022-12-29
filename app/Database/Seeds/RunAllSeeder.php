<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunAllSeeder extends Seeder
{
    public function run()
    {
        $this->call('FakultasLembagaSeeder');
        $this->call('FakultasSeeder');
        $this->call('ProdiSeeder');
        $this->call('UserSeeder');
    }
}