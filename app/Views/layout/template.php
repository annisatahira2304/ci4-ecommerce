<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buah Tangan Gaharu</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- FONT PREMIUM -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {

            --primary: #A15C2F;
            --secondary: #D9A05B;
            --bg: #F9F6F2;
            --white: #ffffff;
            --text: #2D2D2D;
            --soft: #FFFFFF;
            --border: #EFE7DE;
        }

        body {
    background: var(--bg);
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
    color: var(--text);
    scroll-behavior: smooth;
}

        a {
            text-decoration: none;
        }

        /* ======================
           SIDEBAR
        ====================== */

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg,
                    #fffdfb 0%,
                    #f7efe7 100%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
            padding: 25px 18px;
            border-right: 1px solid #eee;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .logo {
            font-size: 30px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 45px;
            font-family: 'Playfair Display', serif;
            line-height: 1.2;
        }

        .logo i {
            color: var(--secondary);
        }

        .sidebar .nav-link {
    color: #5B4A42;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 10px;
    font-size: 14px;
    font-weight: 500;
    transition: .3s;
}

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar .nav-link:hover {
            background: var(--secondary);
            color: white;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
    background: #A15C2F;
    color: white !important;
    box-shadow: 0 8px 20px rgba(161, 92, 47, .18);
}

        /* ======================
           MAIN CONTENT
        ====================== */

        .main-content {
            margin-left: 240px;
            padding: 28px;
            min-height: 100vh;
        }

        /* ======================
           TOPBAR
        ====================== */

        .topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 18px 22px;
            margin-bottom: 28px;
            border: 1px solid #f0e5db;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        }

        .search-box {
            border-radius: 14px;
            border: 1px solid var(--border);
            height: 48px;
            padding-left: 18px;
            background: #fff;
            color: var(--text);
        }

        .search-box:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(217, 119, 6, 0.10);
        }

        .icon-btn {
            width: 45px;
            height: 45px;
            border-radius: 14px;
            border: none;
            background: #fff4eb;
            color: var(--primary);
            transition: 0.3s;
        }

        .icon-btn:hover {
            background: var(--secondary);
            color: white;
            transform: translateY(-2px);
        }

        .profile-img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        /* ======================
           CARD
        ====================== */

        .card-custom {
            background: white;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid #f0e5db;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .product-card img {
    transition: .4s;
}

.product-card:hover img {
    transform: scale(1.05);
}

        /* ======================
           TABLE
        ====================== */

        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table thead th {
            border: none;
            color: #8b7a70;
            font-size: 14px;
            font-weight: 600;
        }

        .table tbody tr {
            background: white;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.03);
        }

        .table tbody td {
            border: none;
            vertical-align: middle;
            padding: 18px 15px;
            color: #4d3b33;
        }

        /* ======================
           BUTTON
        ====================== */

        .btn-primary {
            background: var(--secondary);
            border: none;
            border-radius: 14px;
            padding: 11px 20px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: #b96000;
        }

        .btn-danger {
            border-radius: 14px;
            background: #c2410c;
            border: none;
            padding: 10px 18px;
        }

        .btn-danger:hover {
            background: #9a3412;
        }

        /* ======================
           FOOTER
        ====================== */

        footer {
            margin-top: 35px;
            text-align: center;
            color: #8b7a70;
            font-size: 14px;
        }

        /* ======================
           MOBILE
        ====================== */

        @media(max-width: 991px) {

            .sidebar {
                width: 90px;
                padding: 20px 10px;
            }

            .logo span {
                display: none;
            }

            .sidebar .nav-link span {
                display: none;
            }

            .sidebar .nav-link i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 90px;
            }
        }

        @media(max-width:768px) {

            .topbar {
                flex-direction: column;
                gap: 15px;
            }

            .search-area {
                width: 100%;
            }

            .search-box {
                width: 100% !important;
            }

            .topbar-right {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>

    <!-- ======================
         SIDEBAR
    ====================== -->

    <div class="sidebar">

        <h3 class="logo">
            <i class="bi bi-shop"></i>
            <span>Buah Tangan Gaharu</span>
        </h3>

        <ul class="nav flex-column">

            <!-- HOME -->

            <li class="nav-item">
                <a href="<?= base_url('/') ?>"
                    class="nav-link <?= uri_string() == '' ? 'active' : '' ?>">

                    <i class="bi bi-house-door-fill"></i>
                    <span>Home</span>

                </a>
            </li>

            <!-- PRODUK -->

            <li class="nav-item">
                <a href="<?= base_url('produk') ?>"
                    class="nav-link <?= uri_string() == 'produk' ? 'active' : '' ?>">

                    <i class="bi bi-box-seam"></i>
                    <span>Produk</span>

                </a>
            </li>

            <!-- KERANJANG -->

            <li class="nav-item">
                <a href="<?= base_url('cart') ?>" class="nav-link">

    <i class="bi bi-cart3"></i>

    Keranjang

</a>

            <!-- KONTAK -->

            <li class="nav-item">
                <a href="<?= base_url('kontak') ?>"
                    class="nav-link <?= uri_string() == 'kontak' ? 'active' : '' ?>">

                    <i class="bi bi-person-fill"></i>
                    <span>Kontak</span>

                </a>
            </li>

        </ul>

    </div>

    <!-- ======================
         MAIN CONTENT
    ====================== -->

    <div class="main-content">

        <!-- TOPBAR -->

        <div class="topbar d-flex justify-content-between align-items-center">

            <!-- LEFT -->

            <div class="search-area d-flex align-items-center gap-3">

                <button class="icon-btn">
                    <i class="bi bi-list"></i>
                </button>

                <input type="text"
    class="form-control search-box"
    placeholder="Cari produk bakery..."
    style="width:420px;">

            </div>

            <!-- RIGHT -->

            <div class="topbar-right d-flex align-items-center gap-3">

    <button class="icon-btn">
        <i class="bi bi-bell"></i>
    </button>

    <button class="icon-btn position-relative" data-bs-toggle="modal" data-bs-target="#cartModalGlobal">
        <i class="bi bi-cart3"></i>
        <?php 
        // Hitung total item di session keranjang jika ada
        $sessionCart = session()->get('cart') ?? [];
        $totalItems = is_array($sessionCart) ? count($sessionCart) : 0;
        if ($totalItems > 0) : 
        ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px; padding: 4px 6px;">
                <?= $totalItems ?>
            </span>
        <?php endif; ?>
    </button>

                <div class="d-flex align-items-center gap-2">

                   <img src="<?= base_url('assets/img/admin.jpg') ?>"
                        class="profile-img">

                    <div>
                        <div class="fw-semibold" style="font-size:14px;">
                            Admin
                        </div>

                        <small class="text-muted">
                            Administrator
                        </small>
                    </div>

                </div>

                <a href="<?= base_url('logout') ?>"
   class="btn btn-outline-danger rounded-4 px-3">
                    Logout
                </a>

            </div>

        </div>

        <!-- PAGE CONTENT -->

        <?= $this->renderSection('content') ?>

        <!-- FOOTER -->

        <footer>
            © <?= date('Y') ?> Buah Tangan Gaharu.
            All Rights Reserved.
        </footer>

    </div>

    <!-- BOOTSTRAP JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="modal fade" id="cartModalGlobal" tabindex="-1" aria-labelledby="cartModalGlobalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px; background: #FCFAF7;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold" id="cartModalGlobalLabel" style="color:#8B4513;">
                    <i class="bi bi-cart3"></i> Keranjang Belanja
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <?php if (!empty(session()->get('cart'))) : ?>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr style="font-size: 13px; color: #8b7a70;">
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (session()->get('cart') as $id => $item) : ?>
                                    <tr style="font-size: 14px;">
                                        <td><?= esc($item['nama'] ?? 'Produk') ?></td>
                                        <td><?= $item['qty'] ?? 1 ?>x</td>
                                        <td class="fw-semibold">Rp <?= number_format(($item['harga'] ?? 0) * ($item['qty'] ?? 1), 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid mt-3">
                        <a href="<?= base_url('cart') ?>" class="btn text-white rounded-3 btn-sm" style="background-color: var(--primary);">
                            Lihat Detail & Checkout
                        </a>
                    </div>
                <?php else : ?>
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-cart-x fs-2 d-block mb-2" style="color: var(--secondary);"></i>
                        Keranjangmu masih kosong nih.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>