<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- HERO SECTION -->
<div class="card-custom p-0 overflow-hidden mb-4">
    <div class="row g-0 align-items-center">
        <!-- FOTO -->
        <div class="col-lg-8">
            <img src="<?= base_url('assets/img/Home.jpg') ?>"
                class="img-fluid w-100"
                style="height:620px; object-fit:cover;">
        </div>

        <!-- DESKRIPSI -->
        <div class="col-lg-4">
            <div class="p-5">
                <p style="color:#D97706; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:20px;">
                    Premium Bakery & Oleh-Oleh
                </p>

                <h1 style="font-size:48px; line-height:1.15; font-weight:700; color:#8B4513; margin-bottom:25px;">
                    Fresh Bakery,<br>Cake &<br>Traditional Pastry
                </h1>

                <p style="font-size:16px; line-height:1.9; color:#6B7280; margin-bottom:35px;">
                    Buah Tangan Gaharu menghadirkan berbagai pilihan roti premium, pastry lembut, kue tradisional, dan oleh-oleh berkualitas tinggi untuk keluarga, tamu, maupun acara spesial Anda.
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?= base_url('produk') ?>" class="btn btn-primary px-4 py-3">
                        Lihat Produk
                    </a>
                    <a href="<?= base_url('kontak') ?>" class="btn btn-outline-dark px-4 py-3 rounded-4">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- STATISTIK -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card-custom text-center">
            <h2 class="fw-bold mb-2" style="color:#A15C2F;">120+</h2>
            <p class="text-muted mb-0">Produk</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-custom text-center">
            <h2 class="fw-bold mb-2" style="color:#A15C2F;">85+</h2>
            <p class="text-muted mb-0">Pesanan</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-custom text-center">
            <h2 class="fw-bold mb-2" style="color:#A15C2F;">20+</h2>
            <p class="text-muted mb-0">Stok Menipis</p>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-custom text-center">
            <h2 class="fw-bold mb-2" style="color:#A15C2F;">Rp 12 JT</h2>
            <p class="text-muted mb-0">Penjualan</p>
        </div>
    </div>
</div>

<!-- KATEGORI -->
<h3 class="fw-bold mb-4" style="color:#8B4513; font-family: 'Playfair Display', serif;">
    Kategori Produk
</h3>

<div class="row mb-5">
    <!-- CARD 1 -->
    <div class="col-md-4 mb-4">
        <div class="card-custom text-center py-4 h-100">
            <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" width="50" class="mb-3">
            <h5 class="fw-semibold mb-3">Roti Premium</h5>
            <p class="text-muted mb-0">Roti fresh dengan bahan pilihan dan kualitas terbaik setiap hari.</p>
        </div>
    </div>
    <!-- CARD 2 -->
    <div class="col-md-4 mb-4">
        <div class="card-custom text-center py-4 h-100">
            <img src="https://cdn-icons-png.flaticon.com/512/685/685352.png" width="50" class="mb-3">
            <h5 class="fw-semibold mb-3">Kue Tradisional</h5>
            <p class="text-muted mb-0">Kue khas nusantara dengan rasa autentik dan tampilan premium.</p>
        </div>
    </div>
    <!-- CARD 3 -->
    <div class="col-md-4 mb-4">
        <div class="card-custom text-center py-4 h-100">
            <img src="https://cdn-icons-png.flaticon.com/512/5787/5787016.png" width="50" class="mb-3">
            <h5 class="fw-semibold mb-3">Pastry & Cake</h5>
            <p class="text-muted mb-0">Pilihan pastry modern dan cake untuk semua acara spesial.</p>
        </div>
    </div>
</div>

<!-- ==========================================
     PRODUK UNGGULAN (REVISI MODERN & MINIMALIS)
     ========================================== -->
<div class="d-flex justify-content-between align-items-center mb-4 mt-5">
    <h3 class="fw-bold m-0" style="color:#8B4513; font-family: 'Playfair Display', serif;">
        Produk Unggulan
    </h3>
    <a href="<?= base_url('produk') ?>" class="text-decoration-none fw-semibold" style="color: var(--primary); font-size: 14px;">
        Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
    </a>
</div>

<!-- Grid Responsive Adaptif untuk Area Main Content -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-4">

    <?php if (!empty($produkUnggulan)) : ?>
        <?php foreach ($produkUnggulan as $produk) : ?>
            <div class="col">
                <div class="card-custom p-0 overflow-hidden product-card h-100 d-flex flex-column" style="border-radius: 20px;">
                    
                    <!-- Wadah Gambar Proporsional Kotak (1:1) -->
                    <div class="ratio ratio-1x1 bg-light overflow-hidden">
                        <?php if (!empty($produk['foto'])) : ?>
                            <img src="<?= base_url('uploads/' . $produk['foto']) ?>" class="w-100 h-100 object-fit-cover" alt="<?= esc($produk['nama']) ?>">
                        <?php else : ?>
                            <img src="<?= base_url('assets/img/Home.jpg') ?>" class="w-100 h-100 object-fit-cover" alt="Default Image">
                        <?php endif; ?>
                    </div>

                    <!-- Konten Teks -->
                    <div class="p-4 d-flex flex-column flex-grow-1">
                        <h5 class="fw-bold mb-2 text-truncate" style="color: var(--text); font-size: 16px;">
                            <?= esc($produk['nama']) ?>
                        </h5>
                        
                        <p class="text-muted small mb-3 text-line-clamp flex-grow-1">
                            Produk premium Buah Tangan Gaharu dengan kualitas rasa terbaik, dibuat segar melayani kebahagiaan Anda.
                        </p>
                        
                        <!-- Harga & Action Button -->
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                            <span class="fw-bold" style="color: var(--primary); font-size: 18px;">
                                Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
                            </span>
                            
                            <a href="<?= base_url('cart/add/' . $produk['id']) ?>" 
                               class="btn d-flex align-items-center gap-1 px-3 py-2 rounded-pill text-white btn-keranjang" 
                               style="background-color: var(--secondary); font-size: 13px; font-weight: 500; border: none;">
                                <i class="bi bi-cart-plus fs-6"></i>
                                <span>+ Keranjang</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="col-12">
            <div class="alert alert-light border rounded-4 text-center py-4 text-muted">
                <i class="bi bi-box-seam d-block fs-2 mb-2 text-secondary"></i>
                Belum ada produk unggulan yang tersedia saat ini.
            </div>
        </div>
    <?php endif; ?>

</div>

<!-- CSS INTERNAL KHUSUS HALAMAN BERANDA -->
<style>
    /* Memotong deskripsi jika lebih dari 2 baris agar tinggi card tetap seimbang */
    .text-line-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }

    /* Efek hover dinamis & smooth */
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

<?= $this->endSection() ?>