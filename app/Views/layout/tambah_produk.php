<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1" style="color:#8B4513;">
            Tambah Produk
        </h3>

        <p class="text-muted mb-0">
            Home / Produk / Tambah Produk
        </p>
    </div>

</div>

<div class="card-custom p-4">

    <?php if (session()->getFlashdata('errors')) : ?>

        <div class="alert alert-danger border-0 shadow-sm">

            <div class="fw-semibold mb-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                Periksa kembali data yang diinput
            </div>

            <ul class="mb-0">

                <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                    <li><?= $error ?></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>

    <form action="<?= base_url('produk/simpan') ?>"
        method="post"
        enctype="multipart/form-data">

        <?= csrf_field() ?>

        <!-- Nama Produk -->

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Nama Produk
            </label>

            <input type="text"
                name="nama"
                value="<?= old('nama') ?>"
                class="form-control"
                placeholder="Masukkan nama produk">

        </div>

        <!-- Harga -->

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Harga
            </label>

            <input type="number"
                name="harga"
                value="<?= old('harga') ?>"
                class="form-control"
                placeholder="Masukkan harga produk">

        </div>

        <!-- Stok -->

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Stok
            </label>

            <input type="number"
                name="stok"
                value="<?= old('stok') ?>"
                class="form-control"
                placeholder="Masukkan jumlah stok">

        </div>

        <!-- Upload Foto -->

        <div class="mb-4">

            <label class="form-label fw-semibold">
                Foto Produk
            </label>

            <input type="file"
                name="foto"
                class="form-control"
                accept="image/*">

            <small class="text-muted">
                Format yang disarankan: JPG, PNG, atau WEBP.
            </small>

        </div>

        <!-- Tombol -->

        <div class="d-flex gap-2">

            <button type="submit"
                class="btn btn-success">

                <i class="bi bi-check-circle"></i>
                Simpan Produk

            </button>

            <a href="<?= base_url('produk') ?>"
                class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

        </div>

    </form>

</div>

<?= $this->endSection() ?>