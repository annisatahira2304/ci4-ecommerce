<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'  => 'Croissant',
                'harga' => 150000,
                'stok'  => 100,
                'foto'  => '1781861848_2a73ce47ccead78ac910.png',
            ],
            [
                'nama'  => 'Japanese Cake Roll',
                'harga' => 27000,
                'stok'  => 80,
                'foto'  => '1781861875_4758b4196714f72ec9ef.jpg',
            ],
            [
                'nama'  => 'Triple Layer Chocolate Mousse Cake',
                'harga' => 35000,
                'stok'  => 70,
                'foto'  => '1781861885_b584eb4d9e2f56d4343b.jpg',
            ],
            [
                'nama'  => 'Apple Pie',
                'harga' => 120000,
                'stok'  => 20,
                'foto'  => '1781864138_acf13b5f63bdab7914fa.jpg',
            ],
            [
                'nama'  => 'Wild Blueberry Ricotta Sweet Buns',
                'harga' => 40000,
                'stok'  => 45,
                'foto'  => '1781864236_bbb7fe53bbcef0f8c328.jpg',
            ],
            [
                'nama'  => 'chocolate cake tiramisu',
                'harga' => 35000,
                'stok'  => 30,
                'foto'  => '1781864412_7e35a0494bf1cf367b4c.jpg',
            ],
        ];

        $this->db->table('products')->insertBatch($data);
    }
}
