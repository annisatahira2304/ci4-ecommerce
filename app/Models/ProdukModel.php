<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama',
        'harga',
        'stok',
        'foto'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}