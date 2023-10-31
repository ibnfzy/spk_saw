<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa' => [
                'type' => 'INT',
                'auto_incremenet' => true
            ],
            'id_kelas' => [
                'type' => 'INT'
            ],
            'nama_siswa' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
            'password' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addKey('id_siswa', true);

        $this->forge->createTable('siswa');
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}