<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Seeders extends Seeder
{
    public function run()
    {

        // User Seeder
        $usersSeeder = [
            [
                'name' => 'admin',
                'email' => 'admin@carikos.test',
                'phone' => '081234567890',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'level' => 'Admin',
                'status' => 'Verified',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'pencari',
                'email' => 'pencari@carikos.test',
                'phone' => '081234567891',
                'password' => password_hash('pencari123', PASSWORD_DEFAULT),
                'level' => 'Pencari Kos',
                'status' => 'Verified',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'pemilik',
                'email' => 'pemilik@carikos.test',
                'phone' => '081234567892',
                'password' => password_hash('pemilik123', PASSWORD_DEFAULT),
                'level' => 'Pemilik Kos',
                'status' => 'Verified',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert
        $this->db->table('users')->insertBatch($usersSeeder);

    }
}
