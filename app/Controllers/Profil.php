<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\ProdukModel;

class Profil extends BaseController
{
    protected $transaction;
    protected $transactionDetail;
    protected $produk;

    public function __construct()
    {
        helper('number');
        $this->transaction = new TransactionModel();
        $this->transactionDetail = new TransactionDetailModel();
        $this->produk = new ProdukModel();
    }

    public function index()
    {
        $username = session()->get('username');

        $buy = $this->transaction
            ->where('username', $username)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $product = [];
        foreach ($buy as $item) {
            $details = $this->transactionDetail
                ->where('transaction_id', $item['id'])
                ->findAll();

            foreach ($details as $d) {
                $p = $this->produk->find($d['product_id']);
                $d['nama'] = $p['nama'] ?? '';
                $d['harga'] = $p['harga'] ?? 0;
                $d['foto'] = $p['foto'] ?? '';
                $product[$item['id']][] = $d;
            }
        }

        return view('profil', [
            'username' => $username,
            'buy'      => $buy,
            'product'  => $product,
        ]);
    }
}
