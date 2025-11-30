<?php 
$currentPage = 'laporan';
$title = 'Laporan & Analitik';
require 'views/admin/components/header.php';
?>

<div class="container-fluid">
    
    <ul class="nav nav-tabs mb-4" id="reportTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="uang-tab" data-bs-toggle="tab" data-bs-target="#uang" type="button">
                <i class="bi bi-cash-coin me-2"></i>Laporan Keuangan
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">
                <i class="bi bi-exclamation-triangle me-2"></i>Order Belum Selesai
            </button>
        </li>
    </ul>

    <div class="tab-content" id="reportTabContent">
        
        <!-- MEMANGGIL FILE CSS KHUSUS PRINT AREA     -->
        <link rel="stylesheet" href="../public/css/print.css">

        <!-- AREA YANG AKAN DI PRINT/CETAK -->
        <div id="print-area" class="tab-pane fade show active" id="uang" role="tabpanel">
            <div class="card table-card mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-bold">Pemasukan Bulanan</h5>

                    <div class="d-flex gap-2">
                        <!-- FILTER TAHUN -->
                        <form method="GET" action="" class="d-flex gap-2">
                            <select name="tahun" class="form-select form-select-sm" style="width: 120px;"
                                    onchange="this.form.submit()">
                                <?php foreach ($tahunList as $th): ?>
                                    <option value="<?= $th ?>" <?= $th == $tahunDipilih ? 'selected' : '' ?>>
                                        Tahun <?= $th ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <!-- CETAK HALAMAN -->
                        <button onclick="window.print()" style="background-color: orange;">
                            Cetak Halaman
                        </button>

                        <!-- EXPORT EXCEL -->
                        <a href="/admin/laporan/export?tahun=<?= $tahunDipilih ?>"
                        class="btn btn-sm btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </a>
                    </div>
                </div>

                <!-- TABLE -->
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Bulan</th>
                            <th>Jml Transaksi</th>
                            <th>Terbayar</th>
                            <th>Belum Dibayar (Piutang)</th>
                            <th>Total Omset</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_trans = 0;
                        $total_terbayar = 0;
                        $total_piutang = 0;
                        $total_omset = 0;
                        ?>

                        <?php foreach ($laporanBulanan as $row): ?>
                            <?php
                            $total_trans += $row['jumlah_transaksi'];
                            $total_terbayar += $row['terbayar'];
                            $total_piutang += $row['piutang'];
                            $total_omset += $row['total_omset'];
                            ?>
                            <tr>
                                <td><?= $row['bulan'] ?></td>
                                <td><?= $row['jumlah_transaksi'] ?></td>

                                <td>Rp <?= number_format($row['terbayar'], 0, ',', '.') ?></td>

                                <td class="<?= $row['piutang'] > 0 ? 'text-danger' : '' ?>">
                                    Rp <?= number_format($row['piutang'], 0, ',', '.') ?>
                                </td>

                                <td class="fw-bold">
                                    Rp <?= number_format($row['total_omset'], 0, ',', '.') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td>TOTAL TAHUN INI</td>
                            <td><?= $total_trans ?></td>
                            <td>Rp <?= number_format($total_terbayar, 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($total_piutang, 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($total_omset, 0, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>

                <!-- DIAGRAM LAPORAN PELANGGAN -->
                <h5 class="card-title fw-bold">Diagram Laporan Pelanggan</h5>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <div class="diagram">
                    <div style="width: 60%; margin-top:20px;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

                <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labels); ?>,
                        datasets: [{
                            label: 'Banyaknya Pelanggan',
                            data: <?= json_encode($values); ?>,
                            borderWidth: 2,
                            borderColor: 'black',
                            backgroundColor: 'pink'
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display:true,
                                    text: 'Total Pelanggan'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Bulan'
                                }
                            }
                        }
                    }
                });
                </script>

                <!-- TABEL LAPORAN PELANGGAN -->

                <h5 class="card-title fw-bold">Tabel Laporan Pelanggan</h5>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Bulan</th>
                            <th>Jumlah Pelanggan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($labels as $i => $label): ?>
                        <tr>
                            <td><?= $label ?></td>
                            <td><?= $values[$i] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="pending" role="tabpanel">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>
                <div>Daftar cucian yang statusnya <b>belum diambil</b> atau <b>pending</b> lebih dari 3 hari. Segera hubungi pelanggan!</div>
            </div>
            <div class="card table-card">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tgl Masuk</th>
                            <th>ID Order</th>
                            <th>Pelanggan</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>Lama Hari</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20 Okt 2023</td>
                            <td>#ORD-005</td>
                            <td>Siti Aminah</td>
                            <td><a href="https://wa.me/628123456789" target="_blank" class="text-decoration-none">08123456789</a></td>
                            <td><span class="badge bg-info">Selesai (Belum Diambil)</span></td>
                            <td class="text-danger fw-bold">5 Hari</td>
                            <td><a href="#" class="btn btn-sm btn-success"><i class="bi bi-whatsapp"></i> Ingatkan</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php require 'views/admin/components/footer.php'; ?>