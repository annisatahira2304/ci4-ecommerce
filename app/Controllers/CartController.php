<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProdukModel;

class CartController extends BaseController
{
    public function index()
    {
        $cartModel = new CartModel();

        $produkModel = new ProdukModel();

        $cart = $cartModel->findAll();

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

    $existing = $cartModel
        ->where('product_id', $id)
        ->first();

    if ($existing) {

        $cartModel->update($existing['id'], [

            'qty' => $existing['qty'] + 1

        ]);

    } else {

        $cartModel->save([

            'product_id' => $id,
            'qty' => 1

        ]);
    }

    return redirect()->to('/cart');
}
    public function delete($id)
{
    $cartModel = new CartModel();

    $cartModel->delete($id);

    return redirect()->to('/cart');
}
public function increase($id)
{
    $cartModel = new CartModel();

    $item = $cartModel->find($id);

    $cartModel->update($id, [

        'qty' => $item['qty'] + 1

    ]);

    return redirect()->to('/cart');
}
public function decrease($id)
{
    $cartModel = new CartModel();

    $item = $cartModel->find($id);

    if ($item['qty'] > 1) {

        $cartModel->update($id, [

            'qty' => $item['qty'] - 1

        ]);
    }

    return redirect()->to('/cart');
}
}