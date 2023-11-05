<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Mapel extends Seeder
{
    public function run()
    {
        $this->db->table("mata_pelajaran")->insertBatch([
            [
                'nama_mapel' => 'IPA'
            ],
            [
                'nama_mapel' => 'IPS'
            ],
            [
                'nama_mapel' => 'Bahasa Inggris'
            ],
            [
                'nama_mapel' => 'Matematika'
            ],
        ]);
    }
}