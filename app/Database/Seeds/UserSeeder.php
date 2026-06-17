<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'username' => 'admin',
                'password' => md5('123'),
                'role'     => 'admin'
            ],

            [
                'username' => 'user',
                'password' => md5('123'),
                'role'     => 'customer'
            ]

        ];

        $this->db->table('users')->insertBatch($data);
    }
}