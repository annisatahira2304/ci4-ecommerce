<?php

namespace App\Controllers;

class TransaksiController extends BaseController
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('COST_KEY');
    }

    public function index()
    {
        return view('keranjang');
    }

    public function checkout()
    {
        $cartModel = new \App\Models\CartModel();
        $produkModel = new \App\Models\ProdukModel();

        $cart = $cartModel->where('user_id', session()->get('id'))->findAll();

        foreach ($cart as $key => $item) {
            $produk = $produkModel->find($item['product_id']);
            $cart[$key]['produk'] = $produk;
        }

        return view('checkout', ['cart' => $cart]);
    }

    // ========================================================================
    // AMBIL DATA PROVINSI (Endpoint baru Komerce)
    // ========================================================================
    public function getProvinsi()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/province",
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
            return $this->response->setJSON([]);
        }

        $body = json_decode($response, true);
        return $this->response->setJSON($body['data'] ?? []);
    }

    public function getLocation()
    {
        $search = $this->request->getGet('search');

        if (!$search) {
            return $this->response->setJSON([]);
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=" . urlencode($search) . "&limit=50",
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
            return $this->response->setJSON([]);
        }

        $body = json_decode($response, true);
        return $this->response->setJSON($body['data'] ?? []);
    }

    // ========================================================================
    // HITUNG ONGKOS KIRIM (Endpoint baru Komerce)
    // ========================================================================
    public function getCost()
    {
        $origin = "64999";

        $destination = $this->request->getPost('destination');
        $weight      = $this->request->getPost('weight') ?? 1000;
        $courier     = $this->request->getPost('courier') ?? 'jne';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'origin'      => $origin,
                'destination' => $destination,
                'weight'      => $weight,
                'courier'     => $courier,
            ),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->response->setJSON([]);
        }

        $body = json_decode($response, true);
        return $this->response->setJSON($body['data'] ?? []);
    }

    public function penjualan()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $transactionModel = new \App\Models\TransactionModel();
        $transactions = $transactionModel->orderBy('created_at', 'DESC')->findAll();

        $chartData = $transactionModel
            ->select("DATE(created_at) as tanggal, SUM(total_harga + ongkir) as revenue, COUNT(*) as total_transaksi")
            ->where('status >=', 1)
            ->where('created_at >=', date('Y-m-d', strtotime('-30 days')))
            ->groupBy('DATE(created_at)')
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        $chartLabels = [];
        $chartRevenue = [];
        $chartCount = [];

        foreach ($chartData as $row) {
            $chartLabels[] = date('d M', strtotime($row['tanggal']));
            $chartRevenue[] = (int) $row['revenue'];
            $chartCount[] = (int) $row['total_transaksi'];
        }

        return view('v_penjualan', [
            'transactions' => $transactions,
            'chartLabels'  => json_encode($chartLabels),
            'chartRevenue' => json_encode($chartRevenue),
            'chartCount'   => json_encode($chartCount),
        ]);
    }

    public function updateStatus($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $status = $this->request->getPost('status');
        $transactionModel = new \App\Models\TransactionModel();
        if ($transactionModel->updateStatus($id, $status)) {
            return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui status transaksi.');
        }
    }

    public function uploadBukti()
    {
        $id   = $this->request->getPost('id_pembelian');
        $file = $this->request->getFile('bukti');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/bukti/', $newName);

            $transactionModel = new \App\Models\TransactionModel();
            $transactionModel->update($id, [
                'bukti_pembayaran' => $newName,
                'status'           => 1,
            ]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Upload bukti gagal.');
    }
}
