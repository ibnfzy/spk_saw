<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kriteria extends Seeder
{
    public function run()
    {
        $this->db->table('kriteria')->insertBatch([
            [
                'nama_kriteria' => 'UTS',
                'bobot' => 30
            ],
            [
                'nama_kriteria' => 'UAS',
                'bobot' => 30
            ],
            [
                'nama_kriteria' => 'Tugas',
                'bobot' => 40
            ],
        ]);
    }
}