<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h3 class="fw-bold" style="color:#8B4513;">
    Data Produk
</h3>

<p class="text-muted">
    Home / Produk
</p>

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

        <input type="text" class="form-control" placeholder="Search..." style="max-width:250px;">
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
   <td>
    <div class="d-flex gap-1">
        
        <button type="button" 
                class="btn btn-warning btn-sm d-flex align-items-center justify-content-center btn-add-to-cart" 
                style="border-radius: 10px; width: 32px; height: 32px;" 
                data-id="<?= $p['id'] ?>"
                data-nama="<?= esc($p['nama']) ?>"
                title="Masukkan Keranjang">
            <i class="bi bi-cart-plus fs-6 text-dark"></i>
        </button>

        <button type="button" 
                class="btn btn-success btn-sm d-flex align-items-center justify-content-center" 
                style="border-radius: 10px; width: 32px; height: 32px;" 
                data-bs-toggle="modal" 
                data-bs-target="#editProdukModal<?= $p['id'] ?>" 
                title="Ubah Data">
            <i class="bi bi-pencil-square fs-6"></i>
        </button>

        <form action="<?= base_url('produk/delete/' . $p['id']) ?>" method="post" id="form-hapus-<?= $p['id'] ?>" class="d-inline form-hapus">
    <?= csrf_field(); ?>
    <button type="button" 
            class="btn btn-danger btn-sm d-flex align-items-center justify-content-center btn-delete-trigger" 
            data-id="<?= $p['id'] ?>"
            style="border-radius: 10px; width: 32px; height: 32px;"
            title="Hapus Data">
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
                        <div class="fw-semibold mb-2">
                            <i class="bi bi-exclamation-triangle-fill"></i> Periksa kembali data yang diinput
                        </div>
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
                        <button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-3" data-bs-dismiss="modal">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </button>
                        <button type="submit" class="btn text-white px-4 py-2 rounded-3" style="background-color: #0d8a5a;">
                            <i class="bi bi-check-circle"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // 1. OTOMATIS BUKA POP-UP JIKA ADA ERROR VALIDASI
        <?php if (session()->getFlashdata('errors')) : ?>
            var myModal = new bootstrap.Modal(document.getElementById('tambahProdukModal'));
            myModal.show();
        <?php endif; ?>

        // 2. LOGIKA TAMBAH KERANJANG
        const cartButtons = document.querySelectorAll('.btn-add-to-cart');
        cartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const produkId = this.getAttribute('data-id');
                const namaProduk = this.getAttribute('data-nama');
                
                // Eksekusi penambahan ke keranjang
                fetch(`<?= base_url('cart/add') ?>/${produkId}`, {
                    method: 'GET',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: `${namaProduk} masuk keranjang!`,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        iconColor: '#d9a406'
                    });
                    
                    // Refresh halaman untuk memperbarui angka badge di kanan atas
                    setTimeout(() => { location.reload(); }, 1200);
                })
                .catch(error => {
                    // Jika AJAX gagal, cadangan: lempar langsung lewat URL biasa
                    window.location.href = `<?= base_url('cart/add') ?>/${produkId}`;
                });
            });
        });

        // 3. FIX ANIMASI & SUBMIT SEBELUM HAPUS DATA
        const deleteButtons = document.querySelectorAll('.btn-delete-trigger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                // Mencari form spesifik berdasarkan ID produk masing-masing baris
                const form = document.getElementById(`form-hapus-${id}`);
                
                if (!form) return;

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data produk ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#c2410c',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Dihapus!',
                            text: 'Produk telah dihapus dari database.',
                            showConfirmButton: false,
                            timer: 1000,
                            iconColor: '#c2410c'
                        }).then(() => {
                            form.submit(); // Mengirimkan instruksi hapus ke backend
                        });
                    }
                });
            });
        });
    });
</script>

<?= $this->endSection() ?>