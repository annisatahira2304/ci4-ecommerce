<?= $this->extend('layout_clear') ?>

<?= $this->section('content') ?>

<div class="container">

    <section class="min-vh-100 d-flex justify-content-center align-items-center">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h3 class="text-center text-primary mb-4">
                        Toko Defani
                    </h3>

                    <!-- Flashdata Error -->
                    <?php if(session()->getFlashdata('failed')) : ?>

                        <div class="alert alert-danger">

                            <?= session()->getFlashdata('failed') ?>

                        </div>

                    <?php endif; ?>

                    <!-- Form Login -->
                    <?= form_open('login') ?>

                        <div class="mb-3">

                            <label class="form-label">
                                Username
                            </label>

                            <?= form_input([
                                'type'        => 'text',
                                'name'        => 'username',
                                'class'       => 'form-control',
                                'placeholder' => 'Masukkan Username'
                            ]) ?>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <?= form_password([
                                'name'        => 'password',
                                'class'       => 'form-control',
                                'placeholder' => 'Masukkan Password'
                            ]) ?>

                        </div>

                        <?= form_submit(
                            '',
                            'Login',
                            [
                                'class' => 'btn btn-primary w-100'
                            ]
                        ) ?>

                    <?= form_close() ?>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->endSection() ?>