<?php 
$currentPage = 'laporan';
$title = 'Laporan & Analitik';
require 'views/admin/components/header.php';
?>

<div class="container-fluid">
    
    <ul class="nav nav-tabs mb-4" id="reportTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="uang-tab" data-bs-toggle="tab" data-bs-target="#uang" type="button">
                <i class="bi bi-cash-coin me-2"></i>Laporan Keuangan dan Pelanggan
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">
                <i class="bi bi-exclamation-triangle me-2"></i>Order Belum Selesai
            </button>
        </li>
    </ul>

    <div class="tab-content" id="reportTabContent">
        
        <div class="tab-pane fade show active" id="uang" role="tabpanel">
            <div class="card table-card mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-bold">Pemasukan Bulanan</h5>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width: 120px;">
                            <option>Tahun 2023</option>
                            <option>Tahun 2022</option>
                        </select>
                        <button class="btn btn-sm btn-success"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
                    </div>
                </div>
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
                        <tr>
                            <td>Oktober</td>
                            <td>150</td>
                            <td>Rp 10.000.000</td>
                            <td class="text-danger">Rp 500.000</td>
                            <td class="fw-bold">Rp 10.500.000</td>
                        </tr>
                        <tr>
                            <td>September</td>
                            <td>120</td>
                            <td>Rp 8.000.000</td>
                            <td class="text-danger">Rp 0</td>
                            <td class="fw-bold">Rp 8.000.000</td>
                        </tr>
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td>TOTAL TAHUN INI</td>
                            <td>270</td>
                            <td>Rp 18.000.000</td>
                            <td>Rp 500.000</td>
                            <td>Rp 18.500.000</td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Laporan data Pelanggan -->
                <div>
                    <h5 class="card-title fw-bold">Laporan Pelanggan</h5>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <button onclick="window.print()" class="#">
                        Cetak Halaman
                    </button>
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
                            labels: ["27-11-2025", "28-11-2025", "29-11-2025",],
                            datasets: [{
                                label: 'Total Pelanggan',
                                data: [10, 15, 5],
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
                                        text: 'Banyak Pelanggan'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Tanggal Transaksi'
                                    }
                                }
                            }
                        }
                    });
                    </script>
                </div>
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