<?php 
$currentPage = 'master';
$title = 'Master Harga & Jenis Layanan';
require 'views/admin/components/header.php'; 
?>

<div class="container-fluid">

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

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card table-card">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-0 fw-bold">Master Harga & Jenis Layanan</h5>
                        <p class="text-muted mb-0 small">Atur opsi layanan (CK, CB, CKS) yang muncul di menu pelanggan.</p>
                    </div>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Layanan
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">id_cucian</th>
                                <th width="35%">nama_cucian</th>
                                <th width="25%">harga_perkg</th>
                                <th width="20%">estimate</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            if (isset($data) && count($data) > 0) {
                                foreach ($data as $row) : 
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <span class="fw-bold text-dark"><?= $row['nama_cucian']; ?></span>
                                    </td>
                                    <td class="fw-bold text-success">
                                        Rp <?= number_format($row['harga_perkg'], 0, ',', '.'); ?> <small class="text-muted text-dark fw-normal">/kg</small>
                                    </td>
                                    <td>
                                        <i class="bi bi-clock me-1 text-muted"></i> <?= $row['estimate']; ?> Hari
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning text-white btn-edit" 
                                            data-id="<?= $row['id_cucian']; ?>"
                                            data-nama="<?= $row['nama_cucian']; ?>"
                                            data-harga="<?= $row['harga_perkg']; ?>"
                                            data-estimate="<?= $row['estimate']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        
                                        <!-- <a href="<?= URL('/admin/hapus_layanan/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?');">
                                            <i class="bi bi-trash"></i>
                                        </a> -->
                                    </td>
                                </tr>
                            <?php 
                                endforeach; 
                            } else { 
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted fst-italic">
                                        Data layanan belum tersedia.
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Jenis Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= URL('/admin/masterharga/tambah/process') ?>" method="POST">
                <div class="modal-body">
                    <div class="alert alert-info py-2 small mb-3">
                        <i class="bi bi-info-circle me-1"></i> Masukkan jenis seperti Cuci Komplit, Cuci Basah, dsb.
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Cucian</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Cuci Komplit" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Harga per Kg</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" class="form-control" placeholder="0" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Estimasi (Hari)</label>
                            <input type="number" name="estimate" class="form-control" placeholder="2" min="1" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark bg-opacity-10">
                <h5 class="modal-title fw-bold">Edit Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= URL('/admin/update_layanan') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama / Kode Jenis</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Harga per Kg</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" id="edit_harga" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Estimasi (Hari)</label>
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

<?php require 'views/admin/components/footer.php'; ?>
