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

        $cart = $cartModel->where('user_id', session()->get('id'))->findAll();

        foreach ($cart as $key => $item) {
            $cart[$key]['produk'] =
                $produkModel->find($item['product_id']);
        }

        return view('checkout', [
            'cart' => $cart
        ]);
    }

    public function getCheckoutPartial()
    {
        $cartModel = new CartModel();
        $produkModel = new ProdukModel();

        $cart = $cartModel->where('user_id', session()->get('id'))->findAll();

        if (empty($cart)) {
            return '<div class="text-center py-4 text-muted">Keranjang kosong.</div>';
        }

        foreach ($cart as $key => $item) {
            $cart[$key]['produk'] = $produkModel->find($item['product_id']);
        }

        return view('checkout_partial', ['cart' => $cart]);
    }

    private function getCheckoutTotal($cart)
    {
        $total = 0;
        foreach ($cart as $c) {
            $p = (new ProdukModel())->find($c['product_id']);
            if ($p) $total += $p['harga'] * $c['qty'];
        }
        return $total;
    }

    public function store()
    {
        $cartModel = new CartModel();
        $produkModel = new ProdukModel();
        $transactionModel = new TransactionModel();
        $detailModel = new TransactionDetailModel();

        $cart = $cartModel->where('user_id', session()->get('id'))->findAll();

        if (empty($cart)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Keranjang kosong.']);
            }
            return redirect()->to('/cart');
        }

        // Validasi
        $errors = [];
        $nama   = $this->request->getPost('nama_penerima');
        $telp   = $this->request->getPost('telepon');
        $alamat = $this->request->getPost('alamat');
        $prov   = $this->request->getPost('provinsi');
        $kota   = $this->request->getPost('kota');
        $kurir  = $this->request->getPost('kurir');
        $layanan = $this->request->getPost('layanan');

        if (!$nama) $errors[] = 'Nama penerima harus diisi.';
        if (!$telp) $errors[] = 'Telepon harus diisi.';
        if (!$alamat) $errors[] = 'Alamat harus diisi.';
        if (!$prov) $errors[] = 'Pilih provinsi.';
        if (!$kota) $errors[] = 'Pilih kota.';
        if (!$kurir) $errors[] = 'Pilih kurir.';
        if (!$layanan) $errors[] = 'Pilih layanan pengiriman.';

        if (!empty($errors)) {
            $msg = implode(' ', $errors);
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => $msg]);
            }
            return redirect()->back()->with('error', $msg);
        }

        // Cek stok
        $stockErrors = [];
        foreach ($cart as $item) {
            $produk = $produkModel->find($item['product_id']);
            if ($produk && $item['qty'] > $produk['stok']) {
                $stockErrors[] = $produk['nama'] . ' hanya tersedia ' . $produk['stok'] . ' pcs.';
            }
        }
        if (!empty($stockErrors)) {
            $msg = implode(' ', $stockErrors);
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => $msg]);
            }
            return redirect()->back()->with('error', $msg);
        }

        $kodeTransaksi = 'INV-' . date('YmdHis');
        $ongkir = (int) ($this->request->getPost('ongkir') ?? 0);
        $total  = $this->getCheckoutTotal($cart) + $ongkir;

        $transactionId = $transactionModel->insert([
            'kode_transaksi' => $kodeTransaksi,
            'username'       => session()->get('username'),
            'nama_penerima'  => $nama,
            'telepon'        => $telp,
            'total_harga'    => $total,
            'alamat'         => $alamat,
            'ongkir'         => $ongkir,
            'status'         => 0,
        ]);

        foreach ($cart as $item) {
            $produk = $produkModel->find($item['product_id']);
            $subtotal = $produk['harga'] * $item['qty'];
            $detailModel->insert([
                'transaction_id' => $transactionId,
                'product_id'     => $produk['id'],
                'jumlah'         => $item['qty'],
                'subtotal'       => $subtotal,
            ]);
        }

        $cartModel->where('user_id', session()->get('id'))->delete();

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success'        => true,
                'transaction_id' => $transactionId,
                'kode_transaksi' => $kodeTransaksi,
                'total'          => $total,
            ]);
        }

        return redirect()->to('/profil')->with('success', 'Pesanan berhasil dibuat!');
    }
}
