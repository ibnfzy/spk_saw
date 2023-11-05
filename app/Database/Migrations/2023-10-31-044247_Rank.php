<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rank extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rank' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_kelas' => [
                'type' => 'INT'
            ],
            'id_siswa' => [
                'type' => 'INT'
            ],
            'rank' => [
                'type' => 'INT',
                'null' => true
            ],
        ]);

        $this->forge->addKey('id_rank', true);

        $this->forge->createTable('rank');
    }

    public function down()
    {
        $this->forge->dropTable('rank');
    }
}