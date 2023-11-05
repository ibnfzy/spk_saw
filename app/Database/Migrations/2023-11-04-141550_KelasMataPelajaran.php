<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelasMataPelajaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelas_mapel' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_kelas' => [
                'type' => 'INT'
            ],
            'id_mapel' => [
                'type' => 'INT'
            ]
        ]);

        $this->forge->addKey('id_kelas_mapel', true);

        $this->forge->createTable('kelas_mapel');
    }

    public function down()
    {
        $this->forge->dropTable('kelas_mapel');
    }
}