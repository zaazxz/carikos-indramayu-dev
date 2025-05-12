<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisKos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'marker' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis_kos');
    }

    public function down()
    {
        $this->forge->dropTable('jenis_kos');
    }
}
