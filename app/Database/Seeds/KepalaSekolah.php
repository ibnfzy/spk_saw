<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KepalaSekolah extends Seeder
{
    public function run()
    {
        $this->db->table("kepala_sekolah")->insert([
            'nama_lengkap_kepala_sekolah' => 'Kepala Sekolah',
            'username' => 'kepala',
            'password' => password_hash('sekolah', PASSWORD_DEFAULT),
        ]);
    }
}