<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $allowedFields = [

    'kode_transaksi',
    'nama_penerima',
    'telepon',
    'alamat',
    'ongkir',
    'total_harga'
];

    protected $useTimestamps = true;
}