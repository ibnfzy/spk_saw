<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RankDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rank_detail' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'id_rank' => [
                'type' => 'INT'
            ],
            'id_siswa' => [
                'type' => 'INT'
            ],
            'id_mapel' => [
                'type' => 'INT'
            ],
            'nilai_alt' => [
                'type' => 'INT'
            ]
        ]);

        $this->forge->addKey('id_rank_detail', true);

        $this->forge->createTable('rank_detail');
    }

    public function down()
    {
        $this->forge->dropTable('rank_detail');
    }
}