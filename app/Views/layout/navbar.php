<div class="topbar d-flex justify-content-between align-items-center px-4">

    <div class="d-flex align-items-center gap-3">

        <i class="bi bi-list fs-4 text-primary"></i>

        <div class="input-group">

            <input type="text"
                class="form-control"
                placeholder="Search">

            <span class="input-group-text">
                <i class="bi bi-search"></i>
            </span>

        </div>
    </div>

    <div class="d-flex align-items-center gap-4">

        <i class="bi bi-bell fs-5 text-primary"></i>

        <div class="d-flex align-items-center">

            <img src="https://i.pravatar.cc/40"
                class="rounded-circle me-2">

            <span class="fw-bold text-secondary">
                <?= session()->get('username') ?>
            </span>

            <a href="/logout"
                class="btn btn-danger btn-sm ms-3">

                Logout

            </a>

        </div>
    </div>
</div>