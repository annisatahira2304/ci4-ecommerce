<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h2 class="fw-bold mb-2" style="color:#8B4513;">
    Keranjang Belanja
</h2>

<p class="text-muted mb-4">
    Produk yang akan Anda beli
</p>

<?php if (empty($cart)) : ?>

    <div class="card-custom text-center py-5">

        <i class="bi bi-cart-x"
            style="font-size:60px;color:#8B4513;"></i>

        <h4 class="mt-3">
            Keranjang Masih Kosong
        </h4>

        <p class="text-muted">
            Silakan pilih produk terlebih dahulu.
        </p>

        <a href="<?= base_url('produk') ?>"
            class="btn btn-warning rounded-pill px-4">

            Belanja Sekarang

        </a>

    </div>

<?php else : ?>

    <div class="card-custom">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Foto</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th width="180">Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $total = 0; ?>

                    <?php foreach ($cart as $c) : ?>

                        <?php

                        $subtotal =
                            $c['produk']['harga']
                            * $c['qty'];

                        $total += $subtotal;

                        ?>

                        <tr>

                            <!-- FOTO -->

                            <td>

                                <img src="<?= base_url('uploads/' . $c['produk']['foto']) ?>"
                                    width="80"
                                    height="60"
                                    style="object-fit:cover;"
                                    class="rounded-3 border">

                            </td>

                            <!-- NAMA -->

                            <td>

                                <strong>
                                    <?= esc($c['produk']['nama']) ?>
                                </strong>

                            </td>

                            <!-- HARGA -->

                            <td>

                                Rp <?= number_format(
                                        $c['produk']['harga'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                            </td>

                            <!-- QTY -->

                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <a href="<?= base_url('cart/decrease/' . $c['id']) ?>"
                                        class="btn btn-outline-secondary btn-sm rounded-circle">

                                        -

                                    </a>

                                    <span class="fw-bold">

                                        <?= $c['qty'] ?>

                                    </span>

                                    <a href="<?= base_url('cart/increase/' . $c['id']) ?>"
                                        class="btn btn-outline-secondary btn-sm rounded-circle">

                                        +

                                    </a>

                                </div>

                            </td>

                            <!-- SUBTOTAL -->

                            <td>

                                <strong style="color:#8B4513;">

                                    Rp <?= number_format(
                                            $subtotal,
                                            0,
                                            ',',
                                            '.'
                                        ) ?>

                                </strong>

                            </td>

                            <!-- HAPUS -->

                            <td>

                                <a href="<?= base_url('cart/delete/' . $c['id']) ?>"
                                    class="btn btn-danger btn-sm rounded-pill"
                                    onclick="return confirm('Hapus dari keranjang?')">

                                    <i class="bi bi-trash"></i>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- TOTAL -->

    <div class="card-custom mt-4">

        <div class="row align-items-center">

            <div class="col-md-6">

                <h5 class="mb-1">
                    Ringkasan Belanja
                </h5>

                <p class="text-muted mb-0">
                    Total produk yang akan dibeli.
                </p>

            </div>

            <div class="col-md-6 text-end">

                <h2 class="fw-bold mb-3"
                    style="color:#8B4513;">

                    Rp <?= number_format(
                            $total,
                            0,
                            ',',
                            '.'
                        ) ?>

                </h2>

                <a href="<?= base_url('checkout') ?>"
                    class="btn btn-success px-4 py-2 rounded-pill">

                    <i class="bi bi-credit-card"></i>
                    Checkout

                </a>

            </div>

        </div>

    </div>

<?php endif; ?>

<?= $this->endSection() ?>