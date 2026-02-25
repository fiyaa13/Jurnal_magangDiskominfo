<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Mentor 1',
                'email' => 'mentor@gmail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => 'mentor'
            ],
            [
                'name' => 'Mahasiswa 1',
                'email' => 'mahasiswa@gmail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => 'mahasiswa'
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
