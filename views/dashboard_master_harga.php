<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Harga - Admin Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL('/public/css/home.css') ?>"> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

    <?php if (isset($_SESSION['success_message'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= $_SESSION['success_message']; ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-user-shield me-2"></i>Admin Panel
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= URL('/admin/dashboard') ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Master Harga</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= URL('/admin/transaksi') ?>">Transaksi</a></li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-light btn-sm" href="<?= URL('/logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2><i class="fas fa-tags text-primary"></i> Master Data Harga & Layanan</h2>
                <p class="text-muted">Kelola jenis layanan, harga per kilogram, dan estimasi waktu pengerjaan.</p>
            </div>
            <div class="col-md-4 text-end align-self-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fas fa-plus me-1"></i> Tambah Layanan
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4" width="5%">No</th>
                            <th width="30%">Nama Layanan</th>
                            <th width="20%">Harga / Kg</th>
                            <th width="20%">Estimasi (Hari)</th>
                            <th class="text-center" width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($data['layanan'] as $row) : 
                        ?>
                            <tr>
                                <td class="ps-4"><?= $no++; ?></td>
                                <td class="fw-bold"><?= $row['nama']; ?></td>
                                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <i class="fas fa-clock me-1"></i> <?= $row['estimate']; ?> Hari
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning me-1 btn-edit" 
                                        data-id="<?= $row['id']; ?>"
                                        data-nama="<?= $row['nama']; ?>"
                                        data-harga="<?= $row['harga']; ?>"
                                        data-estimate="<?= $row['estimate']; ?>"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <a href="<?= URL('/admin/hapus_layanan/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus layanan ini?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($data['layanan'])): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data layanan.</td>
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
                    <h5 class="modal-title">Tambah Layanan Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= URL('/admin/tambah_layanan') ?>" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Layanan</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Cuci Sepatu" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga per Kg (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 8000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estimasi Waktu (Hari)</label>
                            <input type="number" name="estimate" class="form-control" placeholder="Contoh: 2" required>
                            <small class="text-muted">Masukkan angka saja (misal: 1 untuk 24 jam/1 hari).</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">Edit Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= URL('/admin/update_layanan') ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Layanan</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga per Kg (Rp)</label>
                            <input type="number" name="harga" id="edit_harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estimasi Waktu (Hari)</label>
                            <input type="number" name="estimate" id="edit_estimate" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Update Data</button>
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
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const harga = this.getAttribute('data-harga');
                const estimate = this.getAttribute('data-estimate');
                
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_nama').value = nama;
                document.getElementById('edit_harga').value = harga;
                document.getElementById('edit_estimate').value = estimate;
            });
        });
    </script>
</body>
</html>
