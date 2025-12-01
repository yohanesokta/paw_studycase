<?php 
$currentPage = 'pesanan';
$title = 'Manajemen Pesanan';
require 'views/admin/components/header.php'; 
?>

<link rel="stylesheet" href="../public/css/pesanan.css">
<!-- FLASH MESSAGE -->
<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?> flash-box d-flex align-items-center">
        <i class="bi bi-check-circle-fill"></i>
        <span><?= htmlspecialchars($_SESSION['flash']['message']) ?></span>
        <div class="progress-bar-timer"></div>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.querySelector(".flash-box");
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            }
        }, 3000);
    </script>
<?php unset($_SESSION['flash']); endif; ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h4>
            <i class="bi bi-receipt me-2"></i>
            Manajemen Pesanan
        </h4>
        <p>Kelola pesanan masuk, verifikasi berat, dan update status pesanan</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <?php
        $totalPesanan = count($data ?? []);
        $belumVerif = 0;
        $pending = 0;
        $selesai = 0;

        if (!empty($data)) {
            foreach ($data as $v) {
                $berat = $v['berat'] ?? null;
                $status = $v['status'] ?? 'pending';
                
                if (is_null($berat) || $berat === '') {
                    $belumVerif++;
                } else {
                    if ($status === 'pending') $pending++;
                    if ($status === 'diambil') $selesai++;
                }
            }
        }
        ?>

        <div class="stat-card process">
            <div class="icon">
                <i class="bi bi-gear-fill"></i>
            </div>
            <div class="value"><?= $pending ?></div>
            <div class="label">Sedang Diproses</div>
        </div>

        <div class="stat-card done">
            <div class="icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="value"><?= $selesai ?></div>
            <div class="label">Selesai Diambil</div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card table-card">
        <div class="table-header">
            <h5>
                <i class="bi bi-table me-2"></i>
                Daftar Semua Pesanan
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 60px;">NO</th>
                        <th>TANGGAL</th>
                        <th>PELANGGAN</th>
                        <th>JENIS LAYANAN</th>
                        <th>BERAT</th>
                        <th>STATUS</th>
                        <th>PEMBAYARAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data) && count($data) > 0): ?>
                        <?php $no = 1; 
                        ?>
                        <?php foreach ($data as $value): ?>

                        <?php 
                            $berat = array_key_exists('berat', $value) ? $value['berat'] : null;
                            $harga = array_key_exists('harga', $value) ? $value['harga'] : 0;
                            $statusOrder = array_key_exists('status', $value) ? $value['status'] : 'pending';
                            $statusBayar = $value['status_bayar'];
                            
                            $sudahVerif = $value['verifed'] == '1';

                            $nama_user = htmlspecialchars($value['nama_user'] ?? '-');
                            $no_telepon = htmlspecialchars($value['no_telepon'] ?? '-');
                            $nama_cucian = htmlspecialchars($value['nama_cucian'] ?? '-');
                        ?>

                        <tr>
                            <!-- NOMOR URUT -->
                            <td>
                                <span class="order-id">
                                    <?= $no++ ?>
                                </span>
                            </td>

                            <!-- TANGGAL -->
                            <td>
                                <span class="date-badge">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    <?= htmlspecialchars($value['tanggal'] ?? '-') ?>
                                </span>
                            </td>

                            <!-- PELANGGAN -->
                            <td class="customer-cell">
                                <div class="customer-name"><?= $nama_user ?></div>
                                <div class="customer-phone">
                                    <i class="bi bi-telephone-fill"></i>
                                    <?= $no_telepon ?>
                                </div>
                            </td>

                            <!-- JENIS LAYANAN -->
                            <td>
                                <span class="service-badge">
                                    <i class="bi bi-droplet-fill me-1"></i>
                                    <?= $nama_cucian ?>
                                </span>
                            </td>

                            <!-- BERAT -->
                            <td>
                                <?php if ($sudahVerif): ?>
                                    <span class="weight-verified">
                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        <?= htmlspecialchars($berat) ?> kg
                                    </span>
                                <?php else: ?>
                                    <form action="<?= URL("/admin/pesanan") ?>" method="POST" class="weight-form">
                                        <input type="hidden" name="id_pesanan" value="<?= htmlspecialchars($value['id_pesanan'] ?? '') ?>">
                                        <input type="number" name="berat" step="0.1" min="0" class="form-control weight-input" placeholder="0.0" required value="<?= $berat ?>">
                                        <button type="submit" class="btn btn-verify">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>

                            <!-- STATUS ORDER -->
                            <td>
                                <?php if (!$sudahVerif): ?>
                                    <span class="status-badge status-not-verified">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        Belum Verifikasi
                                    </span>
                                <?php else: ?>
                                    <?php
                                    $statusClass = match($statusOrder) {
                                        'pending' => 'status-pending',
                                        'belum_diambil' => 'status-ready',
                                        'diambil' => 'status-done',
                                        default => 'status-not-verified'
                                    };

                                    $statusIcon = match($statusOrder) {
                                        'pending' => 'bi-gear-fill',
                                        'belum_diambil' => 'bi-box-seam',
                                        'diambil' => 'bi-check-circle-fill',
                                        default => 'bi-exclamation-circle'
                                    };

                                    $statusText = ucfirst(str_replace('_',' ', htmlspecialchars($statusOrder)));
                                    ?>
                                    <span class="status-badge <?= $statusClass ?>">
                                        <i class="<?= $statusIcon ?> me-1"></i>
                                        <?= $statusText ?>
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- PEMBAYARAN -->
                            <td class="payment-cell">
                                <?php if ($sudahVerif): ?>
                                    <div class="price-badge">
                                        <i class="bi bi-cash me-1"></i>
                                        Rp <?= number_format((float)$harga, 0, ',', '.') ?>
                                    </div>
                                    <div>
                                        <span class="payment-status <?= $statusBayar === 'dibayar' ? 'payment-paid' : 'payment-unpaid' ?>">
                                            <i class="bi bi-<?= $statusBayar === 'dibayar'? 'check-circle-fill' : 'x-circle-fill' ?> me-1"></i>
                                            <?= implode(" ", explode('_',$statusBayar)); ?>
                                        </span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                            <!-- AKSI -->
                            <td>
                                <?php if ($sudahVerif): ?>
                                    <button class="btn btn-action" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalUpdateStatus" 
                                            onclick="setModalData(<?= (int)$value['id_pesanan'] ?>, '<?= htmlspecialchars($statusOrder) ?>', <?= ( $statusBayar  == 'belum_dibayar') ? 1 : 2 ?>)"
                                            title="Update Status">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <h5>Belum Ada Pesanan</h5>
                                    <p>Pesanan yang masuk akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL UPDATE STATUS -->
<div class="modal fade" id="modalUpdateStatus" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i>
                    Update Status Pesanan
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= URL("/admin/pesanan/update") ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_pesanan" id="edit_id">

                    <div class="mb-4">
                        <label class="form-label-custom">
                            <i class="bi bi-gear-fill me-1"></i>
                            Status Proses
                        </label>
                        <select name="status_order" id="status_order" class="form-select form-select-custom">
                            <option value="pending">🕐 Pending (Sedang Diproses)</option>
                            <option value="belum_diambil">📦 Selesai (Siap Diambil)</option>
                            <option value="diambil">✅ Sudah Diambil (Selesai)</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label-custom">
                            <i class="bi bi-credit-card-fill me-1"></i>
                            Status Pembayaran
                        </label>
                        <select name="status_bayar" id="status_bayar" class="form-select form-select-custom">
                            <option value="1">❌ Belum Dibayar</option>
                            <option value="2">✅ Lunas (Sudah Dibayar)</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-modal-submit text-white">
                        <i class="bi bi-check-circle me-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function setModalData(id, status, bayar) {
    document.getElementById('edit_id').value = id;
    var selStatus = document.getElementById('status_order');
    if (selStatus) selStatus.value = status || 'pending';
    var selBayar = document.getElementById('status_bayar');
    if (selBayar) selBayar.value = (typeof bayar !== 'undefined') ? bayar : 1;
}
</script>

<?php require 'views/admin/components/footer.php'; ?>