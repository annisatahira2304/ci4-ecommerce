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
            <a href="<?= base_url('cart') ?>"
                class="nav-link <?= uri_string() == 'cart' ? 'active' : '' ?>">
                <i class="bi bi-cart3"></i>
                <span>Keranjang</span>
            </a>
        </li>

        <?php if (session()->get('role') == 'admin') : ?>

        <!-- LAPORAN PENDAPATAN (ADMIN ONLY) -->
        <li class="nav-item">
            <a href="<?= base_url('laporan/pendapatan') ?>"
                class="nav-link <?= uri_string() == 'laporan/pendapatan' ? 'active' : '' ?>">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Laporan Pendapatan</span>
            </a>
        </li>

        <!-- PENJUALAN (ADMIN ONLY) -->
        <li class="nav-item">
            <a href="<?= base_url('penjualan') ?>"
                class="nav-link <?= uri_string() == 'penjualan' ? 'active' : '' ?>">
                <i class="bi bi-receipt"></i>
                <span>Penjualan</span>
            </a>
        </li>

        <?php endif; ?>

        <!-- PROFIL -->
        <li class="nav-item">
            <a href="<?= base_url('profil') ?>"
                class="nav-link <?= uri_string() == 'profil' ? 'active' : '' ?>">
                <i class="bi bi-person-fill"></i>
                <span>Profil</span>
            </a>
        </li>

    </ul>

</div>
