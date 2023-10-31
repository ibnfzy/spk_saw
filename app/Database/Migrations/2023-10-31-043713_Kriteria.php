<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
{
    // bobot merupakan persen, 
    public function up()
    {
        $this->forge->addField([
            'id_kriteria' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nama_kriteria' => [
                'type' => 'TEXT'
            ],
            'bobot' => [
                'type' => 'INT'
            ]
        ]);

        $this->forge->addKey('id_kriteria', true);

        $this->forge->createTable('kriteria');
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}