<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Harga & Jenis Layanan - Admin</title>
   
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shield-alt me-2"></i>Admin Panel
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= URL('/admin/dashboard') ?>">Dashboard</a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="<?= URL('/admin/transaksi') ?>">Manage Order</a></li> 
                    
                    <li class="nav-item"><a class="nav-link active" href="#">Master Harga</a></li>
                    
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-light btn-sm" href="<?= URL('/logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2><i class="fas fa-tags text-primary"></i> Master Harga & Jenis Layanan</h2>
                <p class="text-muted">
                    Atur opsi jenis layanan (CK, CB, CKS, dll) yang akan muncul saat pelanggan melakukan order.
                </p>
            </div>
            <div class="col-md-4 text-end">
                <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Jenis Layanan
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="ps-4" width="5%">No</th>
                            <th width="35%">Jenis Layanan (Kode)</th>
                            <th width="25%">Harga Dasar</th>
                            <th width="20%">Estimasi Selesai</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($data['layanan'] as $row) : 
                        ?>
                            <tr>
                                <td class="ps-4"><?= $no++; ?></td>
                                <td>
                                    <span class="fw-bold text-dark"><?= $row['nama']; ?></span>
                                    </td>
                                <td>
                                    Rp <?= number_format($row['harga'], 0, ',', '.'); ?> <small class="text-muted">/kg</small>
                                </td>
                                <td>
                                    <i class="far fa-clock me-1 text-muted"></i> <?= $row['estimate']; ?> Hari
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning me-1 btn-edit" 
                                        data-id="<?= $row['id']; ?>"
                                        data-nama="<?= $row['nama']; ?>"
                                        data-harga="<?= $row['harga']; ?>"
                                        data-estimate="<?= $row['estimate']; ?>"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    
                                    <a href="<?= URL('/admin/hapus_layanan/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus jenis layanan ini? Data order lama mungkin terpengaruh.');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($data['layanan'])): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted fst-italic">
                                    Belum ada Master Harga (CK, CB, CKS, dll). Silakan tambah data.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Jenis Layanan Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= URL('/admin/tambah_layanan') ?>" method="POST">
                    <div class="modal-body">
                        <div class="alert alert-info py-2 small">
                            <i class="fas fa-info-circle me-1"></i> Sesuai spesifikasi, masukkan jenis seperti CK, CB, CKS.
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama / Kode Jenis</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Cuci Komplit (CK)" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga per Kg (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" class="form-control" placeholder="5000" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Estimasi (Hari)</label>
                                <input type="number" name="estimate" class="form-control" placeholder="Contoh: 2" min="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Master Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">Edit Jenis Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= URL('/admin/update_layanan') ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama / Kode Jenis</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga per Kg</label>
                                <input type="number" name="harga" id="edit_harga" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Estimasi (Hari)</label>
                                <input type="number" name="estimate" id="edit_estimate" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Update Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editBtns = document.querySelectorAll('.btn-edit');
        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('edit_id').value = this.getAttribute('data-id');
                document.getElementById('edit_nama').value = this.getAttribute('data-nama');
                document.getElementById('edit_harga').value = this.getAttribute('data-harga');
                document.getElementById('edit_estimate').value = this.getAttribute('data-estimate');
            });
        });
    </script>
</body>
</html>
