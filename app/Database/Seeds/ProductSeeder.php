<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'nama'  => 'Laptop Asus',
                'harga' => 7000000,
                'stok'  => 10,
                'foto'  => 'laptop.jpg'
            ],

            [
                'nama'  => 'Mouse Logitech',
                'harga' => 150000,
                'stok'  => 20,
                'foto'  => 'mouse.jpg'
            ]

        ];

        $this->db->table('products')->insertBatch($data);
    }
}