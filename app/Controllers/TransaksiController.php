<?php

namespace App\Controllers;

class TransaksiController extends BaseController
{
    // 1. MASUKKAN API KEY RAJAONGKIR STARTER ANDA DI SINI
    // Ganti teks di dalam tanda kutip dengan API Key asli dari akun RajaOngkir Anda
    protected $apiKey = 'UmtaaQtB8ae8effb001be1bbuT4SYkEr'; 

    public function index()
    {
        return view('keranjang');
    }

    public function checkout()
    {
        // Jika halaman checkout Anda membutuhkan data keranjang, silakan masukkan di sini
        return view('checkout'); 
    }

    // ========================================================================
    // 2. FUNGSI AMBIL DATA PROVINSI
    // ========================================================================
    public function getProvinsi()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'cURL Error: ' . $err]);
        }

        // Mengirimkan data JSON mentah dari RajaOngkir langsung ke browser
        return $this->response->setContentType('application/json')->setBody($response);
    }

    // ========================================================================
    // 3. FUNGSI AMBIL DATA KOTA BERDASARKAN PROVINSI
    // ========================================================================
    public function getKota($id_provinsi)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'cURL Error: ' . $err]);
        }

        return $this->response->setContentType('application/json')->setBody($response);
    }

    // ========================================================================
    // 4. FUNGSI HITUNG ONGKOS KIRIM (COST)
    // ========================================================================
    public function getCost()
    {
        // Sesuaikan ID Kota asal toko Anda (Contoh: 113 untuk Kabupaten Demak)
        $origin = "113"; 
        
        // Ambil data POST yang dikirimkan oleh AJAX dari halaman Checkout
        $destination = $this->request->getPost('destination');
        $weight      = $this->request->getPost('weight');
        $courier     = $this->request->getPost('courier');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'cURL Error: ' . $err]);
        }

        return $this->response->setContentType('application/json')->setBody($response);
    }
}