<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kelas extends Seeder
{
    public function run()
    {
        $this->db->table("kelas")->insert([
            'nama_kelas' => 'X A'
        ]);
    }
}