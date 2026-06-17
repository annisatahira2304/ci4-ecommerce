<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h3 class="fw-bold text-primary">Data Tables</h3>

<p class="text-secondary">
    Home / Keranjang
</p>

<div class="card-custom mt-3">

    <h5 class="fw-bold mb-4">Keranjang</h5>

    <div class="d-flex justify-content-between mb-3">

        <select class="form-select w-auto">
            <option>10</option>
        </select>

        <input type="text"
            class="form-control w-25"
            placeholder="Search...">
    </div>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Nama</th>
                <th>Foto</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td colspan="6"
                    class="text-center text-secondary py-4">
                    No entries found
                </td>
            </tr>
        </tbody>

    </table>

    <div class="alert alert-info mt-4">
        Total = IDR 0
    </div>

    <button class="btn btn-primary btn-sm">
        Perbarui Keranjang
    </button>

    <button class="btn btn-warning btn-sm">
        Kosongkan Keranjang
    </button>

</div>

<?= $this->endSection() ?>