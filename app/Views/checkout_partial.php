<?php
$total = 0;
foreach ($cart as $c) {
    $total += ($c['produk']['harga'] * $c['qty']);
}
?>
<div id="checkoutFormWrapper" data-total="<?= $total ?>">
<form id="checkoutForm" action="<?= base_url('checkout/store') ?>" method="post">
    <div class="row">
        <div class="col-lg-7">
            <div class="card-custom mb-3 p-4 border rounded">
                <h4 class="fw-bold mb-3" style="color:#8B4513;">Alamat Pengiriman</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Penerima</label>
                        <input type="text" name="nama_penerima" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Provinsi</label>
                        <select id="chkProvinsi" name="provinsi" class="form-select" required>
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kota / Kabupaten</label>
                        <select id="chkKota" name="kota" class="form-select" required>
                            <option value="">-- Pilih Provinsi Dahulu --</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kurir Pengiriman</label>
                        <select id="chkKurir" name="kurir" class="form-select" required>
                            <option value="">-- Pilih Kurir --</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS Indonesia</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Layanan Ongkir</label>
                        <select id="chkLayanan" name="layanan" class="form-select" required>
                            <option value="">-- Pilih Kurir Dahulu --</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card-custom p-4 border rounded">
                <h4 class="fw-bold mb-3" style="color:#8B4513;">Ringkasan</h4>
                <div class="d-flex justify-content-between mb-2">
                    <span>Total Belanja</span>
                    <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Ongkos Kirim</span>
                    <strong id="chkOngkirText">Rp 0</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <h5>Total Bayar</h5>
                    <h5 id="chkTotalBayarText" style="color:#8B4513;">Rp <?= number_format($total, 0, ',', '.') ?></h5>
                </div>
                <input type="hidden" id="chkBerat" name="weight" value="1000">
                <input type="hidden" id="chkOngkirVal" name="ongkir" value="0">
                <input type="hidden" id="chkTotalVal" name="total_harga" value="<?= $total ?>">
                <div id="chkSubmitArea">
                    <button type="submit" class="btn btn-success w-100 mt-4 py-2">Selesaikan Pesanan</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
