<?php $uri = service('uri'); ?>

<div class="sidebar p-3">

    <h4 class="fw-bold text-primary">
        <i class="bi bi-shop"></i> Toko Defani
    </h4>

    <hr>

    <ul class="nav flex-column mt-4">

        <li class="nav-item">
            <a class="nav-link <?= ($uri->getSegment(1) == '') ? 'active' : '' ?>"
                href="/">

                <i class="bi bi-house-door-fill me-2"></i>
                Home

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($uri->getSegment(1) == 'keranjang') ? 'active' : '' ?>"
                href="/keranjang">

                <i class="bi bi-cart-fill me-2"></i>
                Keranjang

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($uri->getSegment(1) == 'produk') ? 'active' : '' ?>"
                href="/produk">

                <i class="bi bi-box-seam me-2"></i>
                Produk

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($uri->getSegment(1) == 'kontak') ? 'active' : '' ?>"
                href="/kontak">

                <i class="bi bi-person-fill me-2"></i>
                Profile

            </a>
        </li>

    </ul>

</div>