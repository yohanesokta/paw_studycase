<?php 
$currentPage = 'pesanan';
$title = 'Manajemen Pesanan';
require 'views/admin/components/header.php'; 
?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold">Daftar Pesanan</h4>
            <p class="text-muted mb-0">Kelola pesanan masuk, verifikasi berat, dan status.</p>
        </div>
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahOrder">
            <i class="bi bi-plus-lg me-2"></i>Buat Pesanan Baru
        </button>
    </div>

    <div class="card table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Jenis Layanan</th>
                        <th>Berat (Kg)</th>
                        <th>Status Order</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data) > 0) { 
                        var_dump($data);
                            foreach ($data as $value) {
                        ?>
                    <tr>
                        <td class="fw-bold"><?= $value['id_pesanan'] ?> </td>
                        <td>
                            <div class="fw-semibold"><?= $value['nama_user'] ?></div>
                            <small class="text-muted"><?= $value['no_telepon'] ?></small>
                        </td>
                        <td><?= $value['nama_cucian'] ?></td>
                        <td>
                            <?php if ($value['berat']) { echo $value['berat']." kg"; } else { ?>
                            <form action="proses/update_berat.php" method="POST" class="d-flex align-items-center gap-2">
                                <input type="hidden" name="id_pesanan" value="1">
                                <input type="number" step="0.1" class="form-control form-control-sm text-center" style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-outline-success" title="Simpan Berat"><i class="bi bi-check-lg"></i></button>
                            </form>
                           <?php }?>
                        </td>
                        <td><span class="badge bg-warning text-dark rounded-pill"><?= $value['status'] ?></span></td>
                        <td><span class="badge bg-danger rounded-pill"><?=  ($value['harga']) ? "Rp ".$value['harga'] : ""  ?></span></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdateStatus" onclick="setModalData(1, 'pending', 'belum_dibayar')">
                                <i class="bi bi-pencil-square"></i> Update
                            </button>
                            <a href="cetak_nota.php?id=1" class="btn btn-sm btn-outline-secondary" target="_blank">
                                <i class="bi bi-printer"></i>
                            </a>
                        </td>
                    </tr>

                    <?php } 
                } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahOrder" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Buat Pesanan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="proses/tambah_pesanan.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Pelanggan</label>
                        <select name="id_user" class="form-select" required>
                            <option value="">-- Cari Pelanggan --</option>
                            <option value="usr001">Budi Santoso</option>
                            <option value="usr002">Siti Aminah</option>
                        </select>
                        <div class="form-text text-end"><a href="pelanggan.php" class="text-decoration-none small">+ Tambah Pelanggan Baru</a></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Layanan (Master Harga)</label>
                        <select name="jenis_cucian" class="form-select" required>
                            <option value="kering">Cuci Kering (Rp 6.000/kg)</option>
                            <option value="basah">Cuci Basah (Rp 4.000/kg)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estimasi Berat (Kg)</label>
                        <input type="number" name="berat" step="0.1" class="form-control" value="0">
                        <small class="text-muted">*Isi 0 jika belum ditimbang.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpdateStatus" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Update Status Pesanan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="proses/update_status.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_pesanan" id="edit_id">
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">STATUS PROSES</label>
                        <select name="status_order" class="form-select form-select-sm">
                            <option value="pending">Pending (Diproses)</option>
                            <option value="belum_diambil">Selesai (Belum Diambil)</option>
                            <option value="diambil">Sudah Diambil (Selesai)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">STATUS PEMBAYARAN</label>
                        <select name="status_bayar" class="form-select form-select-sm">
                            <option value="belum_dibayar" class="text-danger">Belum Dibayar</option>
                            <option value="dibayar" class="text-success fw-bold">Lunas (Dibayar)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function setModalData(id, status, bayar) {
    document.getElementById('edit_id').value = id;
}
</script>

<?php require 'views/admin/components/footer.php'; ?>