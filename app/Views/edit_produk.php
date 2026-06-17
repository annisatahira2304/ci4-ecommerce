<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1" style="color:#8B4513;">
            Edit Produk
        </h3>

        <p class="text-muted mb-0">
            Home / Produk / Edit Produk
        </p>
    </div>

</div>

<div class="card-custom p-4">

    <form action="<?= base_url('produk/update/' . $produk['id']) ?>"
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
                value="<?= esc($produk['nama']) ?>"
                class="form-control">

        </div>

        <!-- Harga -->

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Harga
            </label>

            <input type="number"
                name="harga"
                value="<?= $produk['harga'] ?>"
                class="form-control">

        </div>

        <!-- Stok -->

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Stok
            </label>

            <input type="number"
                name="stok"
                value="<?= $produk['stok'] ?>"
                class="form-control">

        </div>

        <!-- Foto Saat Ini -->

        <?php if (!empty($produk['foto'])) : ?>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Foto Saat Ini
                </label>

                <div>
                    <img src="<?= base_url('uploads/' . $produk['foto']) ?>"
                        width="120"
                        class="rounded border shadow-sm">
                </div>

            </div>

        <?php endif; ?>

        <!-- Upload Foto Baru -->

        <div class="mb-4">

            <label class="form-label fw-semibold">
                Ganti Foto Produk
            </label>

            <input type="file"
                name="foto"
                class="form-control"
                accept="image/*">

            <small class="text-muted">
                Kosongkan jika tidak ingin mengganti foto.
            </small>

        </div>

        <!-- Tombol -->

        <div class="d-flex gap-2">

            <button type="submit"
                class="btn btn-success">

                <i class="bi bi-check-circle"></i>
                Update

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