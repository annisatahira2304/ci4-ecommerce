<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();

        // Ditambahkan fallback ?? [] agar aman jika database kosong
        $data['produk'] = $produkModel->findAll() ?? [];

        return view('produk', $data);
    }

    public function create()
    {
        return view('tambah_produk');
    }

    public function store()
    {
        $rules = [
            'nama'  => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'stok'  => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $namaFoto = ''; // Default string kosong jika user tidak upload foto

        // Cek dengan ketat apakah file benar-benar diunggah
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads', $namaFoto);
        }

        $produkModel = new ProdukModel();
        $produkModel->save([
            'nama'  => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'stok'  => $this->request->getPost('stok'),
            'foto'  => $namaFoto
        ]);

        // Ditambahkan flashdata 'success' agar memicu animasi centang SweetAlert2
        return redirect()->to('/produk')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->find($id);

        return view('edit_produk', $data);
    }

    public function update($id)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        $foto = $this->request->getFile('foto');
        
        // Default gunakan nama foto lama jika tidak ada foto baru yang diupload
        $namaFoto = $produk['foto'] ?? ''; 

        // Cek jika user mengupload file baru
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads', $namaFoto);
        }

        $produkModel->update($id, [
            'nama'  => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'stok'  => $this->request->getPost('stok'),
            'foto'  => $namaFoto
        ]);

        // Ditambahkan flashdata 'success' untuk pop-up edit berhasil
        return redirect()->to('/produk')->with('success', 'Data produk berhasil diperbarui!');
    }

    public function delete($id)
    {
        $produkModel = new ProdukModel();
        $produkModel->delete($id);

        // Ditambahkan flashdata 'message' agar memicu pop-up setelah terhapus di backend
        return redirect()->to('/produk')->with('message', 'Produk berhasil dihapus dari sistem.');
    }
}