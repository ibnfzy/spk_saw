<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Siswa extends Seeder
{
    public function run()
    {
        $this->db->table("siswa")->insert([
            'id_kelas' => 1,
            'nama_siswa' => 'Agung',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
        ]);
    }
}