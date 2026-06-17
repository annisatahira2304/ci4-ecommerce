<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProdukModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class CheckoutController extends BaseController
{
    public function index()
    {
        $cartModel = new CartModel();
        $produkModel = new ProdukModel();

        $cart = $cartModel->findAll();

        foreach ($cart as $key => $item) {

            $cart[$key]['produk'] =
                $produkModel->find($item['product_id']);
        }

        return view('checkout', [
            'cart' => $cart
        ]);
    }

    public function store()
{
    $cartModel = new CartModel();
    $produkModel = new ProdukModel();

    $transactionModel = new TransactionModel();
    $detailModel = new TransactionDetailModel();

    $cart = $cartModel->findAll();

    if (empty($cart)) {

        return redirect()->to('/cart');
    }

    $total = 0;

    foreach ($cart as $item) {

        $produk = $produkModel->find(
            $item['product_id']
        );

        $total +=
            $produk['harga']
            * $item['qty'];
    }

    // sementara ongkir simulasi

    $ongkir = 15000;

    // kode invoice

    $kode = 'INV-' . date('YmdHis');

    // simpan transaksi

    $transactionModel->save([

        'kode_transaksi' => $kode,

        'nama_penerima' =>
            $this->request->getPost('nama_penerima'),

        'telepon' =>
            $this->request->getPost('telepon'),

        'alamat' =>
            $this->request->getPost('alamat'),

        'ongkir' =>
            $ongkir,

        'total_harga' =>
            $total + $ongkir

    ]);

    $transactionId =
        $transactionModel->getInsertID();

    // simpan detail transaksi

    foreach ($cart as $item) {

        $produk = $produkModel->find(
            $item['product_id']
        );

        $subtotal =
            $produk['harga']
            * $item['qty'];

        $detailModel->save([

            'transaction_id' =>
                $transactionId,

            'product_id' =>
                $produk['id'],

            'jumlah' =>
                $item['qty'],

            'subtotal' =>
                $subtotal
        ]);
    }

    // kosongkan keranjang

    $cartModel->truncate();

    return redirect()->to('/checkout/success');
}
}