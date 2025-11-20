<?php 
$currentPage = 'dashboard';
$title = 'Dashboard Overview';
require 'views/admin/components/header.php'; 
?>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card card-stat p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 small text-uppercase fw-bold">Order Masuk</p>
                    <h3 class="mb-0 fw-bold">12</h3>
                </div>
                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-bag-plus"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card card-stat p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 small text-uppercase fw-bold">Pendapatan</p>
                    <h3 class="mb-0 fw-bold text-success">Rp 4.5jt</h3>
                </div>
                <div class="icon-box bg-success bg-opacity-10 text-success">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card card-stat p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 small text-uppercase fw-bold">Perlu Verifikasi</p>
                    <h3 class="mb-0 fw-bold text-warning">4</h3>
                </div>
                <div class="icon-box bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card table-card mt-4">
    <h5 class="card-title mb-3">Order Terbaru</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#ORD001</td>
                <td>Budi Santoso</td>
                <td><span class="badge bg-warning text-dark">Pending</span></td>
            </tr>
        </tbody>
    </table>
</div>

<?php require 'components/footer.php'; ?>