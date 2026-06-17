<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();

        $data['produkUnggulan'] = $produkModel
            ->orderBy('id', 'DESC')
            ->findAll(3);

        return view('home', $data);
    }
}