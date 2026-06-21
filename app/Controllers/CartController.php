<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProdukModel;

class CartController extends BaseController
{
    private function getUserId()
    {
        return session()->get('id');
    }

    public function index()
    {
        $cartModel = new CartModel();
        $produkModel = new ProdukModel();

        $cart = $cartModel->where('user_id', $this->getUserId())->findAll();

        foreach ($cart as $key => $item) {
            $produk = $produkModel->find($item['product_id']);
            $cart[$key]['produk'] = $produk;
        }

        return view('cart', [
            'cart' => $cart
        ]);
    }

    public function add($id)
    {
        $cartModel = new CartModel();
        $userId = $this->getUserId();

        $existing = $cartModel
            ->where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        if ($existing) {
            $cartModel->update($existing['id'], [
                'qty' => $existing['qty'] + 1
            ]);
        } else {
            $cartModel->save([
                'user_id'    => $userId,
                'product_id' => $id,
                'qty'        => 1
            ]);
        }

        return redirect()->to('/cart');
    }

    public function addAjax()
    {
        if (!$this->getUserId()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu.',
            ]);
        }

        $id = $this->request->getPost('product_id');
        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Produk tidak ditemukan.',
            ]);
        }

        $cartModel = new CartModel();
        $userId = $this->getUserId();

        $existing = $cartModel
            ->where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        if ($existing) {
            $cartModel->update($existing['id'], [
                'qty' => $existing['qty'] + 1,
            ]);
        } else {
            $cartModel->save([
                'user_id'    => $userId,
                'product_id' => $id,
                'qty'        => 1,
            ]);
        }

        $cartCount = $cartModel->where('user_id', $userId)->countAllResults();

        return $this->response->setJSON([
            'success'    => true,
            'message'    => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => $cartCount,
        ]);
    }

    public function getCount()
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return $this->response->setJSON(['count' => 0]);
        }

        $cartModel = new CartModel();
        $count = $cartModel->where('user_id', $userId)->countAllResults();

        return $this->response->setJSON(['count' => $count]);
    }

    public function delete($id)
    {
        $cartModel = new CartModel();
        $item = $cartModel->where('id', $id)->where('user_id', $this->getUserId())->first();

        if ($item) {
            $cartModel->delete($id);
        }

        return redirect()->to('/cart');
    }

    public function increase($id)
    {
        $cartModel = new CartModel();
        $item = $cartModel->where('id', $id)->where('user_id', $this->getUserId())->first();

        if ($item) {
            $cartModel->update($id, [
                'qty' => $item['qty'] + 1
            ]);
        }

        return redirect()->to('/cart');
    }

    public function decrease($id)
    {
        $cartModel = new CartModel();
        $item = $cartModel->where('id', $id)->where('user_id', $this->getUserId())->first();

        if ($item && $item['qty'] > 1) {
            $cartModel->update($id, [
                'qty' => $item['qty'] - 1
            ]);
        }

        return redirect()->to('/cart');
    }

    // ============ AJAX ENDPOINTS FOR CART MODAL ============

    public function getItemsAjax()
    {
        $cartModel = new CartModel();
        $produkModel = new ProdukModel();
        $userId = $this->getUserId();

        if (!$userId) {
            return $this->response->setJSON(['items' => [], 'total' => 0, 'count' => 0]);
        }

        $cart = $cartModel->where('user_id', $userId)->findAll();
        $items = [];
        $total = 0;

        foreach ($cart as $c) {
            $produk = $produkModel->find($c['product_id']);
            if (!$produk) continue;
            $subtotal = $produk['harga'] * $c['qty'];
            $total += $subtotal;
            $items[] = [
                'id'         => $c['id'],
                'product_id' => $produk['id'],
                'nama'       => $produk['nama'],
                'harga'      => (int) $produk['harga'],
                'stok'       => (int) $produk['stok'],
                'foto'       => $produk['foto'],
                'qty'        => (int) $c['qty'],
                'subtotal'   => $subtotal,
            ];
        }

        return $this->response->setJSON([
            'items' => $items,
            'total' => $total,
            'count' => count($items),
        ]);
    }

    public function increaseAjax($id)
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
        }

        $cartModel = new CartModel();
        $produkModel = new ProdukModel();

        $item = $cartModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$item) {
            return $this->response->setJSON(['success' => false, 'message' => 'Item tidak ditemukan.']);
        }

        $produk = $produkModel->find($item['product_id']);
        if ($item['qty'] >= $produk['stok']) {
            return $this->response->setJSON(['success' => false, 'message' => 'Stok tidak mencukupi.']);
        }

        $cartModel->update($id, ['qty' => $item['qty'] + 1]);
        $newItem = $cartModel->find($id);
        $subtotal = $produk['harga'] * $newItem['qty'];

        $allItems = $cartModel->where('user_id', $userId)->findAll();
        $total = 0;
        foreach ($allItems as $ci) {
            $p = $produkModel->find($ci['product_id']);
            if ($p) $total += $p['harga'] * $ci['qty'];
        }

        return $this->response->setJSON([
            'success'    => true,
            'qty'        => (int) $newItem['qty'],
            'subtotal'   => $subtotal,
            'total'      => $total,
            'cart_count' => count($allItems),
        ]);
    }

    public function decreaseAjax($id)
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
        }

        $cartModel = new CartModel();
        $produkModel = new ProdukModel();

        $item = $cartModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$item) {
            return $this->response->setJSON(['success' => false, 'message' => 'Item tidak ditemukan.']);
        }

        if ($item['qty'] <= 1) {
            return $this->response->setJSON(['success' => false, 'message' => 'Minimal jumlah adalah 1.']);
        }

        $cartModel->update($id, ['qty' => $item['qty'] - 1]);
        $produk = $produkModel->find($item['product_id']);
        $newItem = $cartModel->find($id);
        $subtotal = $produk['harga'] * $newItem['qty'];

        $allItems = $cartModel->where('user_id', $userId)->findAll();
        $total = 0;
        foreach ($allItems as $ci) {
            $p = $produkModel->find($ci['product_id']);
            if ($p) $total += $p['harga'] * $ci['qty'];
        }

        return $this->response->setJSON([
            'success'    => true,
            'qty'        => (int) $newItem['qty'],
            'subtotal'   => $subtotal,
            'total'      => $total,
            'cart_count' => count($allItems),
        ]);
    }

    public function deleteAjax($id)
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
        }

        $cartModel = new CartModel();

        $item = $cartModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$item) {
            return $this->response->setJSON(['success' => false, 'message' => 'Item tidak ditemukan.']);
        }

        $cartModel->delete($id);
        $cartCount = $cartModel->where('user_id', $userId)->countAllResults();

        return $this->response->setJSON([
            'success'    => true,
            'cart_count' => $cartCount,
        ]);
    }
}
