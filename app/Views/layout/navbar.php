<!-- TOPBAR -->

<div class="topbar d-flex justify-content-between align-items-center">

    <!-- LEFT -->

    <div class="search-area d-flex align-items-center gap-3">

        <button class="icon-btn">
            <i class="bi bi-list"></i>
        </button>

        <form action="<?= base_url('produk') ?>" method="GET" class="d-flex">
            <input type="text" name="search"
class="form-control search-box"
placeholder="Cari produk bakery..."
style="width:420px;"
value="<?= esc(service('request')->getGet('search') ?? '') ?>">
        </form>

    </div>

    <!-- RIGHT -->

    <div class="topbar-right d-flex align-items-center gap-3">

<button class="icon-btn">
    <i class="bi bi-bell"></i>
</button>

<a href="#" data-bs-toggle="modal" data-bs-target="#cartModal" class="icon-btn position-relative text-decoration-none">
    <i class="bi bi-cart3"></i>
    <span id="cartBadge" style="display: none;">0</span>
</a>

        <div class="d-flex align-items-center gap-2">

           <img src="<?= base_url('assets/img/admin.jpg') ?>"
                 class="profile-img">

            <div>
                <div class="fw-semibold" style="font-size:14px;">
                    <?= esc(session()->get('username') ?? 'Guest') ?>
                </div>

                <small class="text-muted">
                    <?= session()->get('role') == 'admin' ? 'Administrator' : 'Customer' ?>
                </small>
            </div>

        </div>

        <a href="<?= base_url('logout') ?>"
class="btn btn-outline-danger rounded-4 px-3">
            Logout
        </a>

    </div>

</div>
