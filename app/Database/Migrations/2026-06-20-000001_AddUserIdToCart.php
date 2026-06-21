<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToCart extends Migration
{
    public function up()
    {
        $this->forge->addColumn('cart', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'after'      => 'id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('cart', 'user_id');
    }
}
