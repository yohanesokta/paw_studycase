<?php 
$currentPage = 'master';
$title = 'Master Harga Layanan';
require 'views/admin/components/header.php'; 
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card table-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 fw-bold">Daftar Paket Cucian</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalLayanan">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Layanan
                    </button>
                </div>

                <table class="table table-hover align-middle table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="10%">ID</th>
                            <th>Nama Layanan</th>
                            <th width="25%">Harga / Satuan</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Cuci Kering (Setrika)</td>
                            <td class="fw-bold text-success">Rp 6.000</td>
                            <td>
                                <button class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Bedcover Besar</td>
                            <td class="fw-bold text-success">Rp 25.000</td>
                            <td>
                                <button class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLayanan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="proses/simpan_layanan.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" value=""> <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" name="nama" class="form-control" placeholder="Cth: Cuci Komplit" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" class="form-control" placeholder="0" required>
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

<?php require 'views/admin/components/footer.php'; ?>