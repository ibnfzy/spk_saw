<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KepalaSekolah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kepala_sekolah' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nama_lengkap_kepala_sekolah' => [
                'type' => 'TEXT'
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 60
            ],
            'password' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addKey('id_kepala_sekolah', true);

        $this->forge->createTable('kepala_sekolah');
    }

    public function down()
    {
        $this->forge->dropTable('kepala_sekolah');
    }
}