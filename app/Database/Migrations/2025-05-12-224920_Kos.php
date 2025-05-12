<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_jenis' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'available' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'coordinat' => [
                'type' => 'TEXT',
            ],
            'photo' => [
                'type' => 'TEXT',
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'bathroom' => [
                'type' => 'ENUM',
                'constraint' => ['Didalam', 'Diluar'],
            ],
            'air_conditioner' => [
                'type' => 'ENUM',
                'constraint' => ['Tersedia', 'Tidak Tersedia'],
            ],
            'wifi' => [
                'type' => 'ENUM',
                'constraint' => ['Tersedia', 'Tidak Tersedia'],
            ],
            'id_wilayah' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'flood_info' => [
                'type' => 'ENUM',
                'constraint' => ['Aman', 'Siaga', 'Rawan'],
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Verified', 'Unverified'],
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        // Primary Key
        $this->forge->addKey('id', true);

        // Foreign Key
        $this->forge->addForeignKey('id_jenis', 'jenis_kos', 'id');
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_wilayah', 'wilayah', 'id');

        // Create Table
        $this->forge->createTable('kos');

    }

    public function down()
    {
        $this->forge->dropTable('kos');
    }
}
