<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['kode_transaksi', 'username', 'nama_penerima', 'telepon', 'total_harga', 'alamat', 'ongkir', 'status', 'bukti_pembayaran'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }
}
