<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h2 class="fw-bold mb-2" style="color:#8B4513;">Checkout</h2>
<p class="text-muted mb-4">Lengkapi data pengiriman pesanan Anda</p>

<?php
$total = 0;
foreach ($cart as $c) {
    $total += ($c['produk']['harga'] * $c['qty']);
}
?>

<form action="<?= base_url('checkout/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-lg-8">
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
                        <select id="provinsi" name="provinsi" class="form-select" required>
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kota / Kabupaten</label>
                        <select id="kota" name="kota" class="form-select" required>
                            <option value="">-- Pilih Provinsi Dahulu --</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Kurir Pengiriman</label>
                        <select id="kurir" name="kurir" class="form-select" required>
                            <option value="">-- Pilih Kurir --</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS Indonesia</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Layanan Ongkir</label>
                        <select id="layanan" name="layanan" class="form-select" required>
                            <option value="">-- Pilih Kurir Dahulu --</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-custom p-4 border rounded">
                <h4 class="fw-bold mb-3" style="color:#8B4513;">Ringkasan</h4>
                
                <div class="d-flex justify-content-between mb-2">
                    <span>Total Belanja</span>
                    <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Ongkos Kirim</span>
                    <strong id="ongkirText">Rp 0</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <h5>Total Bayar</h5>
                    <h5 id="totalBayarText" style="color:#8B4513;">Rp <?= number_format($total, 0, ',', '.') ?></h5>
                </div>

                <input type="hidden" id="berat" name="weight" value="1000"> <input type="hidden" id="ongkir_val" name="ongkir" value="0">
                <input type="hidden" id="total_val" name="total_harga" value="<?= $total ?>">

                <button type="submit" class="btn btn-success w-100 mt-4 py-2">Selesaikan Pesanan</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    const totalBelanja = <?= $total ?>;

    // 1. LOAD PROVINSI SAAT HALAMAN DIBUKA
    $.ajax({
        url: "<?= base_url('api/provinsi') ?>",
        type: "GET",
        dataType: "json",
        success: function(response) {
            let res = JSON.parse(response);
            if(res.rajaongkir.status.code === 200) {
                let data = res.rajaongkir.results;
                $.each(data, function(key, value) {
                    $('#provinsi').append(`<option value="${value.province_id}">${value.province}</option>`);
                });
            }
        }
    });

    // 2. LOAD KOTA JIKA PROVINSI DIPILIH
    $('#provinsi').on('change', function() {
        let id_provinsi = $(this).val();
        $('#kota').html('<option value="">⏳ Loading Kota...</option>');
        
        if(id_provinsi) {
            $.ajax({
                url: "<?= base_url('api/kota') ?>/" + id_provinsi,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let res = JSON.parse(response);
                    let html = '<option value="">-- Pilih Kota --</option>';
                    if(res.rajaongkir.status.code === 200) {
                        $.each(res.rajaongkir.results, function(key, value) {
                            html += `<option value="${value.city_id}">${value.type} ${value.city_name}</option>`;
                        });
                    }
                    $('#kota').html(html);
                }
            });
        }
    });

    // 3. CEK ONGKIR JIKA KOTA & KURIR DIPILIH
    $('#kurir, #kota').on('change', function() {
        let kurir = $('#kurir').val();
        let kota = $('#kota').val();
        let berat = $('#berat').val();

        if(kurir && kota) {
            $('#layanan').html('<option value="">⏳ Cek Ongkir...</option>');
            $.ajax({
                url: "<?= base_url('api/cost') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    destination: kota,
                    weight: berat,
                    courier: kurir
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    let html = '<option value="">-- Pilih Layanan --</option>';
                    if(res.rajaongkir.status.code === 200) {
                        let costs = res.rajaongkir.results[0].costs;
                        if(costs.length > 0) {
                            $.each(costs, function(key, val) {
                                html += `<option value="${val.cost[0].value}">
                                    ${val.service} - Rp ${val.cost[0].value.toLocaleString('id-ID')} (${val.cost[0].etd} Hari)
                                </option>`;
                            });
                        } else {
                            html = '<option value="">Layanan tidak tersedia</option>';
                        }
                    }
                    $('#layanan').html(html);
                }
            });
        }
    });

    // 4. HITUNG TOTAL SAAT LAYANAN DIPILIH
    $('#layanan').on('change', function() {
        let ongkir = parseInt($(this).val()) || 0;
        let totalAkhir = totalBelanja + ongkir;

        $('#ongkirText').text('Rp ' + ongkir.toLocaleString('id-ID'));
        $('#totalBayarText').text('Rp ' + totalAkhir.toLocaleString('id-ID'));
        
        $('#ongkir_val').val(ongkir);
        $('#total_val').val(totalAkhir);
    });
});
</script>
<?= $this->endSection() ?>