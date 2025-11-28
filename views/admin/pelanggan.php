<?php 
$currentPage = 'pelanggan';
$title = 'Data Pelanggan';
require 'views/admin/components/header.php';
?>

<div class="container-fluid">
    <div class="card table-card">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <h5 class="mb-0 fw-bold">Database Pelanggan</h5>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" placeholder="Cari nama/no hp..." style="width: 200px;">
                <button class="btn btn-primary btn-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#modalPelanggan">
                    <i class="bi bi-person-plus me-2"></i>Pelanggan Baru
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Info Pelanggan</th>
                        <th>Alamat</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $p): ?>
                            <tr>
                                <td><?= $p['id']; ?></td>

                                <td>
                                    <div class="fw-bold"><?= $p['nama']; ?></div>
                                    <div class="text-muted small">
                                        <i class="bi bi-telephone me-1"></i> <?= $p['no_telepon']; ?>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-envelope me-1"></i> <?= $p['email']; ?>
                                    </div>
                                </td>

                                <td><?= $p['alamat']; ?></td>

                                <td>
                                    <span class="badge bg-secondary"><?= ucfirst($p['role']); ?></span>
                                </td>

                                <td class="d-flex gap-1">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <form method="POST" action="/admin/pelanggan/hapus" 
                                          onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?');">
                                        <input type="hidden" name="id" value="<?= $p['id']; ?>">
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="modalPelanggan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan Manual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="/admin/pelanggan/tambah" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php require 'views/admin/components/footer.php'; ?>
