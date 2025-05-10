<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'account' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'account_username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'account_id' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],            
            'level' => [
                'type' => 'ENUM',
                'constraint' => ['Admin', 'Pencari Kos', 'Pemilik Kos'],
                'null' => false,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Verified', 'Unverified'],
                'null' => false,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
