<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Seed extends Seeder
{
    public function run()
    {
        $this->call('Admin');
        $this->call('KepalaSekolah');
        $this->call('Siswa');
        $this->call('Kelas');
    }
}