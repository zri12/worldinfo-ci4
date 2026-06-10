<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * UserSeeder
 * Mengisi data default admin user.
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'       => 'Administrator',
                'email'      => 'admin@worldinfo.test',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);

        echo "UserSeeder: Akun admin default berhasil ditambahkan.\n";
        echo "  Email   : admin@worldinfo.test\n";
        echo "  Password: admin123\n";
    }
}
