<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h3 class="fw-bold" style="color:#8B4513;">
    Data Produk
</h3>

<p class="text-muted">
    Home / Produk
</p>

<?php if (session()->get('role') == 'admin') : ?>

<div class="card-custom mt-3">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
                <i class="bi bi-plus-circle"></i>
                Tambah Data
            </button>
            <a href="<?= base_url('produk/download') ?>" class="btn btn-success btn-sm">
                <i class="bi bi-download"></i>
                Download Data
            </a>
        </div>
        <form action="<?= base_url('produk') ?>" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control" placeholder="Search..." style="max-width:250px;" value="<?= esc($search ?? '') ?>">
        </form>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($produk as $p) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?php if (!empty($p['foto'])) : ?>
                            <img src="<?= base_url('uploads/' . $p['foto']) ?>" width="80" height="60" class="rounded-3 border">
                        <?php else : ?>
                            <span class="text-muted">Tidak ada foto</span>
                        <?php endif; ?>
                    </td>
                    <td><?= esc($p['nama']) ?></td>
                    <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                    <td><?= $p['stok'] ?></td>
                    <td>
                        <div class="d-flex gap-1">
                            <button type="button" class="btn btn-warning btn-sm d-flex align-items-center justify-content-center btn-add-to-cart" style="border-radius: 10px; width: 32px; height: 32px;" data-id="<?= $p['id'] ?>" data-nama="<?= esc($p['nama']) ?>" title="Masukkan Keranjang">
                                <i class="bi bi-cart-plus fs-6 text-dark"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm d-flex align-items-center justify-content-center" style="border-radius: 10px; width: 32px; height: 32px;" data-bs-toggle="modal" data-bs-target="#editProdukModal<?= $p['id'] ?>" title="Ubah Data">
                                <i class="bi bi-pencil-square fs-6"></i>
                            </button>
                            <form action="<?= base_url('produk/delete/' . $p['id']) ?>" method="post" id="form-hapus-<?= $p['id'] ?>" class="d-inline form-hapus">
                                <?= csrf_field(); ?>
                                <button type="button" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center btn-delete-trigger" data-id="<?= $p['id'] ?>" style="border-radius: 10px; width: 32px; height: 32px;" title="Hapus Data">
                                    <i class="bi bi-trash fs-6"></i>
                                </button>
                            </form>
                        </div>
                        <div class="modal fade" id="editProdukModal<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0" style="border-radius: 20px; background: #FCFAF7; text-align: left;">
                                    <div class="modal-header border-0 px-4 pt-4">
                                        <div>
                                            <h5 class="modal-title fw-bold" style="color:#8B4513;">Ubah Data Produk</h5>
                                            <small class="text-muted">Edit informasi untuk <?= esc($p['nama']) ?></small>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-4 pb-4">
                                        <form action="<?= base_url('produk/update/' . $p['id']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold" style="font-size: 14px;">Nama Produk</label>
                                                <input type="text" name="nama" value="<?= esc($p['nama']) ?>" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold" style="font-size: 14px;">Harga</label>
                                                <input type="number" name="harga" value="<?= $p['harga'] ?>" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold" style="font-size: 14px;">Stok</label>
                                                <input type="number" name="stok" value="<?= $p['stok'] ?>" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold" style="font-size: 14px;">Foto Produk (Kosongkan jika tidak diganti)</label>
                                                <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                                                <?php if (!empty($p['foto'])) : ?>
                                                <small class="text-muted d-block mt-1">Foto saat ini: <?= $p['foto'] ?></small>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-end mt-4">
                                                <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #0d8a5a;">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0" style="border-radius: 24px; background: #FCFAF7;">
            <div class="modal-header border-0 px-4 pt-4">
                <div>
                    <h4 class="modal-title fw-bold" id="tambahProdukModalLabel" style="color:#8B4513;">Tambah Produk</h4>
                    <small class="text-muted">Home / Produk / Tambah Produk</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger border-0 shadow-sm b-2">
                    <div class="fw-semibold mb-2"><i class="bi bi-exclamation-triangle-fill"></i> Periksa kembali data yang diinput</div>
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <form id="formTambahProduk" action="<?= base_url('produk/simpan') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="nama" value="<?= old('nama') ?>" class="form-control form-control-lg fs-6 rounded-3" placeholder="Masukkan nama produk" style="border-color: #EFE7DE;" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="number" name="harga" value="<?= old('harga') ?>" class="form-control form-control-lg fs-6 rounded-3" placeholder="Masukkan harga produk" style="border-color: #EFE7DE;" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Stok</label>
                        <input type="number" name="stok" value="<?= old('stok') ?>" class="form-control form-control-lg fs-6 rounded-3" placeholder="Masukkan jumlah stok" style="border-color: #EFE7DE;" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto Produk</label>
                        <input type="file" name="foto" class="form-control form-control-lg fs-6 rounded-3" accept="image/*" style="border-color: #EFE7DE;">
                        <small class="text-muted">Format yang disarankan: JPG, PNG, atau WEBP.</small>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-3" data-bs-dismiss="modal"><i class="bi bi-arrow-left"></i> Kembali</button>
                        <button type="submit" class="btn text-white px-4 py-2 rounded-3" style="background-color: #0d8a5a;"><i class="bi bi-check-circle"></i> Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php else : ?>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-4">
    <?php foreach ($produk as $p) : ?>
    <div class="col">
        <div class="card-custom p-0 overflow-hidden product-card h-100 d-flex flex-column" style="border-radius: 20px;">
            <div class="ratio ratio-1x1 bg-light overflow-hidden">
                <?php if (!empty($p['foto'])) : ?>
                    <img src="<?= base_url('uploads/' . $p['foto']) ?>" class="w-100 h-100 object-fit-cover" alt="<?= esc($p['nama']) ?>">
                <?php else : ?>
                    <img src="<?= base_url('assets/img/Home.jpg') ?>" class="w-100 h-100 object-fit-cover" alt="Default Image">
                <?php endif; ?>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
                <h5 class="fw-bold mb-2 text-truncate" style="color: var(--text); font-size: 16px;">
                    <?= esc($p['nama']) ?>
                </h5>
                <p class="text-muted small mb-3 text-line-clamp flex-grow-1">
                    Produk premium Buah Tangan Gaharu dengan kualitas rasa terbaik, dibuat segar melayani kebahagiaan Anda.
                </p>
                <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                    <span class="fw-bold" style="color: var(--primary); font-size: 18px;">
                        Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                    </span>
                    <button type="button" class="btn d-flex align-items-center gap-1 px-3 py-2 rounded-pill text-white btn-keranjang btn-add-cart" data-id="<?= $p['id'] ?>" style="background-color: var(--secondary); font-size: 13px; font-weight: 500; border: none;">
                        <i class="bi bi-cart-plus fs-6"></i>
                        <span>+ Keranjang</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<style>
.text-line-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease !important;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(161, 92, 47, 0.08) !important;
}
.product-card img {
    transition: transform 0.4s ease;
}
.product-card:hover img {
    transform: scale(1.04);
}
.btn-keranjang:hover {
    background-color: #b96000 !important;
    color: white !important;
}
</style>

<script>
document.querySelectorAll('.btn-add-cart, .btn-add-to-cart').forEach(function(btn) {
    btn.addEventListener('click', async function() {
        var id = this.getAttribute('data-id');
        if (!id) return;

        try {
            var res = await fetch('<?= base_url('cart/add-ajax') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'product_id=' + id + '&<?= csrf_token() ?>=<?= csrf_hash() ?>'
            });
            var data = await res.json();

            if (data.success) {
                var badge = document.getElementById('cartBadge');
                if (data.cart_count > 0) {
                    badge.textContent = data.cart_count;
                    badge.classList.remove('d-none');
                    badge.style.display = 'flex';
                } else {
                    badge.classList.add('d-none');
                }
            } else {
                alert(data.message);
            }
        } catch (e) {
            alert('Gagal menambahkan produk ke keranjang.');
        }
    });
});
</script>

<?= $this->endSection() ?>
