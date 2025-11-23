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
        
    </div>

    <div class="card table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Jenis Layanan</th>
                        <th>Berat (Kg)</th>
                        <th>Status Order</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (count($data) > 0) { 
                            foreach ($data as $value) {
                        ?>
                    <tr>
                        <td class="fw-bold"><?= $value['id_pesanan'] ?> </td>
                        <td class="fw-bold"><?= $value['tanggal'] ?> </td>

                        <td>
                            <div class="fw-semibold"><?= $value['nama_user'] ?></div>
                            <small class="text-muted"><?= $value['no_telepon'] ?></small>
                        </td>
                        <td><?= $value['nama_cucian'] ?></td>
                        <td>
                            <?php if ($value['verifed']) { echo $value['berat']." kg"; } else { ?>
                            <form action="<?= URL("/admin/pesanan") ?>" method="POST" class="d-flex align-items-center gap-2">
                                <input type="hidden" name="id_pesanan" value="<?= $value['id_pesanan'] ?>">
                                <input type="number" name="berat" step="0.1" class="form-control form-control-sm text-center" style="width: 70px;" value="<?= $value['berat'] ?? 0 ?>">
                                <button type="submit" class="btn btn-sm btn-outline-success" title="Simpan Berat"><i class="bi bi-check-lg"></i></button>
                            </form>
                           <?php }?>
                        </td>
                        <?php if ($value['verifed'])  {?>
                        <td><span class="badge bg-warning text-dark rounded-pill"><?= $value['status'] ?></span></td>
                        <?php } else { ?>
                        <td><span class="badge bg-warning text-dark rounded-pill">Unverifed</span></td>

                        <?php } ?>
                        <?php if ($value['verifed'])  {?>
                        <td>
                            <span class="badge <?= ($value['verifed'] == 1) ? "bg-danger" : "bg-success"?> rounded-pill"><?=  ($value['harga']) ? "Rp ".number_format($value['harga'], 0, ',', '.') : ""  ?></span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdateStatus" onclick="setModalData(<?= $value['id_pesanan'] ?>, 'pending', 'belum_dibayar')">
                                <i class="bi bi-pencil-square"></i> Update
                            </button>
                            
                        </td>
                        <?php } else { echo "<td></td><td></td><td></td>";} ?>
                    </tr>

                    <?php } 
                } ?>
                    </tbody>
            </table>
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
            <form action="<?= URL("/admin/pesanan/update") ?>" method="POST">
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
                            <option value="1" class="text-danger">Belum Dibayar</option>
                            <option value="2" class="text-success fw-bold">Lunas (Dibayar)</option>
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