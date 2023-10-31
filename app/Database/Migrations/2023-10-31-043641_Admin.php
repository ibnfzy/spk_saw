<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'password' => [
                'type' => 'TEXT'
            ]
        ]);

        $this->forge->addKey('id_admin', true);

        $this->forge->createTable('admin');
    }

    public function down()
    {
        //
    }
}