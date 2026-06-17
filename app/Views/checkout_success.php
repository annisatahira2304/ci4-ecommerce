<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="card-custom text-center">
    <div class="py-5">
        <i class="bi bi-check-circle-fill text-success" style="font-size:80px;"></i>
        <h2 class="mt-4 fw-bold">
            Pesanan Berhasil Dibuat
        </h2>
        <p class="text-muted">
            Terima kasih telah berbelanja di Buah Tangan Gaharu.
        </p>
        <a href="<?= base_url('/') ?>" class="btn btn-primary mt-3">
            Kembali ke Beranda
        </a>
    </div>
</div>

<?= $this->endSection() ?>