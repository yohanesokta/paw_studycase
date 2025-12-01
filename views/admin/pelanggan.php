<?php
$currentPage = 'pelanggan';
$title = 'Data Pelanggan';
require 'views/admin/components/header.php';

// helper anti-XSS + aman untuk null
function h($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>

<link rel="stylesheet" href="../public/css/admin-pelanggan.css">

<div class="container-fluid">

    <?php if (isset($_SESSION['flash'])): ?>
        <?php
        $flashType = $_SESSION['flash']['type'];
        $flashClass = match ($flashType) {
            'success' => 'flash-success',
            'danger'  => 'flash-danger',
            'warning' => 'flash-warning',
            default   => 'flash-info'
        };
        ?>

        <div id="flashAlert"
            class="alert alert-<?= $flashType ?> alert-dismissible fade show position-relative"
            role="alert"
            style="border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">

            <i class="bi bi-check-circle-fill me-2"></i>
            <?= h($_SESSION['flash']['message']) ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            <div class="flash-progress">
                <div class="flash-progress-bar <?= $flashClass ?>"></div>
            </div>
        </div>

        <script>
            setTimeout(() => {
                let flash = document.getElementById('flashAlert');
                if (flash) {
                    flash.classList.remove('show');
                    setTimeout(() => flash.remove(), 500);
                }
            }, 3000);
        </script>

        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div class="table-card">
        <div class="card-header-custom">
            <h5><i class="bi bi-people-fill me-2"></i>Database Pelanggan</h5>
            <div class="subtitle">Kelola data pelanggan Anda dengan mudah</div>
        </div>

        <div class="action-bar">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="search-box" style="flex: 1; max-width: 400px;">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama, email, atau no telepon...">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 80px;">No</th>
                        <th>Informasi Pelanggan</th>
                        <th>Alamat</th>
                        <th style="width: 120px;">Role</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (!empty($data)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $p): ?>
                            <tr>
                                <td><span class="id-badge"><?= $no++; ?></span></td>

                                <td>
                                    <div class="customer-info">
                                        <div class="customer-avatar">
                                            <?= strtoupper(substr(h($p['nama']), 0, 1)) ?>
                                        </div>
                                        <div class="customer-details">
                                            <div class="name"><?= h($p['nama']) ?></div>
                                            <div class="contact">
                                                <i class="bi bi-telephone-fill"></i>
                                                <span><?= h($p['no_telepon']) ?></span>
                                            </div>
                                            <div class="contact">
                                                <i class="bi bi-envelope-fill"></i>
                                                <span><?= h($p['email']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <i class="bi bi-geo-alt-fill text-muted me-1"></i>
                                    <?= h($p['alamat']) ?>
                                </td>

                                <td>
                                    <span class="badge badge-role <?= $p['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>">
                                        <?= h(ucfirst($p['role'])) ?>
                                    </span>
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-action btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPelanggan"
                                            data-id="<?= h($p['id']) ?>"
                                            data-nama="<?= h($p['nama']) ?>"
                                            data-no="<?= h($p['no_telepon']) ?>"
                                            data-email="<?= h($p['email']) ?>"
                                            data-alamat="<?= h($p['alamat']) ?>"
                                            title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <form method="POST" action="<?= URL('/admin/pelanggan/hapus') ?>" style="display: inline;"
                                            onsubmit="return confirm('⚠️ Yakin ingin menghapus pelanggan ini?\n\nData yang sudah dihapus tidak dapat dikembalikan.');">
                                            <input type="hidden" name="id" value="<?= h($p['id']) ?>">
                                            <button type="submit" class="btn btn-action btn-delete" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <h5>Belum Ada Data Pelanggan</h5>
                                    <p>Data pelanggan akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEditPelanggan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Data Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= URL('/admin/pelanggan/update') ?>" method="POST">
                <input type="hidden" name="id" id="edit-id">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-person me-1"></i> Nama Lengkap</label>
                        <input type="text" name="nama" id="edit-nama" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="bi bi-telephone me-1"></i> No. Telepon</label>
                            <input type="text" name="no_telepon" id="edit-no" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="bi bi-envelope me-1"></i> Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-geo-alt me-1"></i> Alamat Lengkap</label>
                        <textarea name="alamat" id="edit-alamat" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit text-white">
                        <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-nama').value = this.dataset.nama;
        document.getElementById('edit-no').value = this.dataset.no;
        document.getElementById('edit-email').value = this.dataset.email;
        document.getElementById('edit-alamat').value = this.dataset.alamat;
    });
});

document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});
</script>

<?php require 'views/admin/components/footer.php'; ?>
