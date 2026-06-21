<!-- FOOTER -->

<footer>
    © <?= date('Y') ?> Buah Tangan Gaharu.
    All Rights Reserved.
</footer>

<!-- BOOTSTRAP JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
async function refreshCartBadge() {
    try {
        const res = await fetch('<?= base_url('cart/count') ?>');
        const data = await res.json();
        const badge = document.getElementById('cartBadge');
        if (data.count > 0) {
            badge.textContent = data.count;
            badge.classList.remove('d-none');
            badge.style.display = 'flex';
        } else {
            badge.classList.add('d-none');
        }
    } catch (e) {}
}

document.addEventListener('DOMContentLoaded', refreshCartBadge);

// ============ CART MODAL (AJAX) ============

function formatRupiah(n) {
    return 'Rp ' + Number(n).toLocaleString('id-ID');
}

async function loadCartModal() {
    var body = document.getElementById('cartModalBody');
    body.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-secondary" role="status"></div></div>';
    try {
        var res = await fetch('<?= base_url('cart/items-ajax') ?>');
        var data = await res.json();
        renderCartModal(data.items || [], data.total || 0);
    } catch (e) {
        body.innerHTML = '<div class="text-center py-4 text-muted">Gagal memuat keranjang.</div>';
    }
}

function renderCartModal(items, total) {
    var body = document.getElementById('cartModalBody');
    if (!items || items.length === 0) {
        body.innerHTML = '<div class="text-center py-4 text-muted">' +
            '<i class="bi bi-cart-x fs-2 d-block mb-2" style="color: var(--secondary);"></i>' +
            'Keranjang masih kosong.</div>';
        return;
    }
    var html = '<div class="table-responsive"><table class="table table-sm align-middle">' +
        '<thead><tr style="font-size: 13px; color: #8b7a70;">' +
        '<th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th><th>Aksi</th></tr></thead><tbody>';
    items.forEach(function(item) {
        html += '<tr data-cart-id="' + item.id + '">' +
            '<td><div class="d-flex align-items-center gap-2">' +
            '<img src="<?= base_url('uploads/') ?>' + item.foto + '" width="40" height="40" style="object-fit:cover; border-radius:8px;">' +
            '<span class="fw-semibold" style="font-size:14px;">' + escapeHtml(item.nama) + '</span>' +
            '</div></td>' +
            '<td>' + formatRupiah(item.harga) + '</td>' +
            '<td><div class="d-flex align-items-center gap-2">' +
            '<button class="btn btn-outline-secondary btn-sm rounded-circle btn-qty-minus">-</button>' +
            '<span class="fw-bold qty-num">' + item.qty + '</span>' +
            '<button class="btn btn-outline-secondary btn-sm rounded-circle btn-qty-plus">+</button>' +
            '</div></td>' +
            '<td class="fw-semibold subtotal-text" style="color:#8B4513;">' + formatRupiah(item.subtotal) + '</td>' +
            '<td><button class="btn btn-danger btn-sm rounded-pill btn-cart-delete"><i class="bi bi-trash"></i></button></td>' +
            '</tr>';
    });
    html += '</tbody></table></div>' +
        '<div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">' +
        '<h5 class="fw-bold mb-0">Total: <span id="cartModalTotal">' + formatRupiah(total) + '</span></h5>' +
        '<a href="<?= base_url('cart') ?>" class="btn text-white rounded-3 btn-sm px-4" style="background-color: var(--primary);">Lihat Keranjang Lengkap</a>' +
        '</div>';
    body.innerHTML = html;
}

function escapeHtml(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
}

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('cartModal');
    if (!modal) return;

    modal.addEventListener('show.bs.modal', loadCartModal);

    modal.addEventListener('click', async function(e) {
        var btn = e.target.closest('button');
        if (!btn) return;
        var row = btn.closest('tr[data-cart-id]');
        if (!row) return;
        var cartId = row.getAttribute('data-cart-id');

        if (btn.classList.contains('btn-qty-plus')) {
            await updateQtyAjax(cartId, 'increase', row);
        } else if (btn.classList.contains('btn-qty-minus')) {
            await updateQtyAjax(cartId, 'decrease', row);
        } else if (btn.classList.contains('btn-cart-delete')) {
            if (!confirm('Hapus item ini dari keranjang?')) return;
            await deleteItemAjax(cartId, row);
        }
    });
});

async function updateQtyAjax(cartId, action, row) {
    try {
        var res = await fetch('<?= base_url('cart/') ?>' + action + '-ajax/' + cartId, { method: 'POST' });
        var data = await res.json();
        if (data.success) {
            row.querySelector('.qty-num').textContent = data.qty;
            row.querySelector('.subtotal-text').textContent = formatRupiah(data.subtotal);
            document.getElementById('cartModalTotal').textContent = formatRupiah(data.total);
            if (typeof refreshCartBadge === 'function') refreshCartBadge();
        } else {
            alert(data.message);
        }
    } catch (e) {
        alert('Gagal memperbarui jumlah.');
    }
}

async function deleteItemAjax(cartId, row) {
    try {
        var res = await fetch('<?= base_url('cart/delete-ajax/') ?>' + cartId, { method: 'POST' });
        var data = await res.json();
        if (data.success) {
            row.remove();
            loadCartModal();
            if (typeof refreshCartBadge === 'function') refreshCartBadge();
        } else {
            alert(data.message);
        }
    } catch (e) {
        alert('Gagal menghapus item.');
    }
}

// ============ CHECKOUT MODAL ============

async function loadCheckoutModal() {
    var body = document.getElementById('checkoutModalBody');
    body.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-secondary" role="status"></div></div>';
    document.getElementById('checkoutModalFooter').style.display = 'none';
    try {
        var res = await fetch('<?= base_url('checkout/partial') ?>');
        var html = await res.text();
        body.innerHTML = html;
        initCheckoutForm();
    } catch (e) {
        body.innerHTML = '<div class="text-center py-4 text-muted">Gagal memuat form checkout.</div>';
    }
}

function initCheckoutForm() {
    var wrapper = document.getElementById('checkoutFormWrapper');
    if (!wrapper) return;
    var totalBelanja = parseInt(wrapper.dataset.total) || 0;

    // 1. Load provinsi
    fetch('<?= base_url('api/provinsi') ?>')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var sel = document.getElementById('chkProvinsi');
            if (data && data.length) {
                data.forEach(function(p) {
                    sel.innerHTML += '<option value="' + p.id + '">' + p.name + '</option>';
                });
            }
        });

    // 2. Provinsi change -> fetch kota
    document.getElementById('chkProvinsi').addEventListener('change', function() {
        var nama = this.options[this.selectedIndex].text;
        var kotaSel = document.getElementById('chkKota');
        kotaSel.innerHTML = '<option value="">Loading Kota...</option>';
        if (nama && nama !== '-- Pilih Provinsi --') {
            fetch('<?= base_url('get-location') ?>?search=' + encodeURIComponent(nama))
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var html = '<option value="">-- Pilih Kota --</option>';
                    if (data && data.length) {
                        data.forEach(function(k) {
                            html += '<option value="' + k.id + '">' + k.label + '</option>';
                        });
                    }
                    kotaSel.innerHTML = html;
                });
        }
    });

    // 3. Kurir / Kota change -> fetch ongkir
    function ongkirChanged() {
        var kurir = document.getElementById('chkKurir').value;
        var kota = document.getElementById('chkKota').value;
        var berat = document.getElementById('chkBerat').value;
        var layananSel = document.getElementById('chkLayanan');
        if (kurir && kota) {
            layananSel.innerHTML = '<option value="">Cek Ongkir...</option>';
            fetch('<?= base_url('api/cost') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'destination=' + encodeURIComponent(kota) + '&weight=' + berat + '&courier=' + encodeURIComponent(kurir)
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var html = '<option value="">-- Pilih Layanan --</option>';
                if (data && data.length) {
                    data.forEach(function(v) {
                        html += '<option value="' + v.cost + '">' + v.service + ' - Rp ' + Number(v.cost).toLocaleString('id-ID') + ' (' + v.etd + ' Hari)</option>';
                    });
                } else {
                    html = '<option value="">Layanan tidak tersedia</option>';
                }
                layananSel.innerHTML = html;
            });
        }
    }
    document.getElementById('chkKurir').addEventListener('change', ongkirChanged);
    document.getElementById('chkKota').addEventListener('change', ongkirChanged);

    // 4. Layanan change -> update total
    document.getElementById('chkLayanan').addEventListener('change', function() {
        var ongkir = parseInt(this.value) || 0;
        var totalAkhir = totalBelanja + ongkir;
        document.getElementById('chkOngkirText').textContent = 'Rp ' + ongkir.toLocaleString('id-ID');
        document.getElementById('chkTotalBayarText').textContent = 'Rp ' + totalAkhir.toLocaleString('id-ID');
        document.getElementById('chkOngkirVal').value = ongkir;
        document.getElementById('chkTotalVal').value = totalAkhir;
    });

    // 5. Form submit via AJAX (no manual Content-Type - let browser set multipart/form-data)
    document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        var submitArea = document.getElementById('chkSubmitArea');
        submitArea.innerHTML = '<button class="btn btn-success w-100 mt-4 py-2" disabled>Memproses...</button>';

        try {
            var res = await fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            var data = await res.json();
            if (data.success) {
                var body = document.getElementById('checkoutModalBody');
                body.innerHTML = '' +
                    '<div class="text-center py-4">' +
                    '<i class="bi bi-check-circle-fill" style="font-size: 64px; color: #28a745;"></i>' +
                    '<h4 class="fw-bold mt-3" style="color:#8B4513;">Pesanan Berhasil Dibuat!</h4>' +
                    '<p class="text-muted">Kode Transaksi: <strong>' + data.kode_transaksi + '</strong></p>' +
                    '<p class="text-muted">Total Pembayaran: <strong style="color:#8B4513;">Rp ' + Number(data.total).toLocaleString('id-ID') + '</strong></p>' +
                    '<div class="d-flex justify-content-center gap-3 mt-4">' +
                    '<a href="<?= base_url('profil') ?>" class="btn btn-primary px-4 py-2 rounded-pill">Lihat Riwayat Pesanan</a>' +
                    '<button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-pill" data-bs-dismiss="modal">Tutup</button>' +
                    '</div>' +
                    '</div>';
                document.getElementById('checkoutModalFooter').style.display = '';
                if (typeof refreshCartBadge === 'function') refreshCartBadge();
            } else {
                submitArea.innerHTML = '<div class="alert alert-danger mt-3 py-2 small">' + escapeHtml(data.message || 'Gagal memproses pesanan.') + '</div>' +
                    '<button type="submit" class="btn btn-success w-100 mt-2 py-2">Selesaikan Pesanan</button>';
            }
        } catch (e) {
            submitArea.innerHTML = '<div class="alert alert-danger mt-3 py-2 small">Terjadi kesalahan. Silakan coba lagi.</div>' +
                '<button type="submit" class="btn btn-success w-100 mt-2 py-2">Selesaikan Pesanan</button>';
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var chkModal = document.getElementById('checkoutModal');
    if (chkModal) {
        chkModal.addEventListener('show.bs.modal', function() {
            document.getElementById('checkoutModalFooter').style.display = 'none';
            loadCheckoutModal();
        });
    }
});
</script>

<!-- CART MODAL -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0" style="border-radius: 20px; background: #FCFAF7;">
        <div class="modal-header border-0 px-4 pt-4">
            <h5 class="modal-title fw-bold" id="cartModalLabel" style="color:#8B4513;">
                <i class="bi bi-cart3"></i> Keranjang Belanja
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 pb-4" id="cartModalBody">
            <div class="text-center py-4">
                <div class="spinner-border text-secondary" role="status"></div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- CHECKOUT MODAL -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0" style="border-radius: 20px; background: #FCFAF7;">
        <div class="modal-header border-0 px-4 pt-4">
            <h5 class="modal-title fw-bold" id="checkoutModalLabel" style="color:#8B4513;">
                <i class="bi bi-credit-card"></i> Checkout
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 pb-4" id="checkoutModalBody">
            <div class="text-center py-4">
                <div class="spinner-border text-secondary" role="status"></div>
            </div>
        </div>
        <div class="modal-footer border-0 px-4 pb-4" id="checkoutModalFooter" style="display:none;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
</div>
