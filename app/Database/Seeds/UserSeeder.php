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
                'email'    => 'admin@toko.com',
                'password' => '$2y$10$B5K8JQ8ZNxff.fwXApZ37unlLfBhxbsZDpocA6rVeaCk8KJ7nhWpm',
                'role'     => 'admin',
            ],
            [
                'username' => 'user',
                'email'    => 'user@toko.com',
                'password' => '$2y$10$m0G2.aZYCe2bYl1MGHRdcOYFwvaA.9FyD90J7eieznOX5oeXGEQla',
                'role'     => 'customer',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
