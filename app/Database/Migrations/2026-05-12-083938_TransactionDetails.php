<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransactionDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'transaction_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'subtotal' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],

            'created_at datetime default current_timestamp',

            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('transaction_details');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_details');
    }
}