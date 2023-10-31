<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MataPelajaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mapel' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nama_mapel' => [
                'type' => 'TEXT'
            ],
        ]);

        $this->forge->addKey('id_mapel', true);

        $this->forge->createTable('mata_pelajaran');
    }

    public function down()
    {
        $this->forge->dropTable('mata_pelajaran');
    }
}