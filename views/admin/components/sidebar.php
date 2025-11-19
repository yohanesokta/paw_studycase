<div class="sidebar d-flex flex-column">
    <div class="brand">
        <i class="bi bi-droplet-fill text-primary me-2"></i> LAUNDRY<span class="text-primary">Admin</span>
    </div>
    
    <div class="nav flex-column mt-3">
        <a href="<?=URL("/admin/dashboard")?>" class="nav-link <?= ($currentPage == 'dashboard') ? 'active' : '' ?>">
            <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
        </a>
        
        <a href="<?=URL("/admin/pesanan")?>" class="nav-link <?= ($currentPage == 'pesanan') ? 'active' : '' ?>">
            <i class="bi bi-basket-fill me-2"></i> Manajemen Order
        </a>
        
        <a href="<?=URL("/admin/harga")?>" class="nav-link <?= ($currentPage == 'master') ? 'active' : '' ?>">
            <i class="bi bi-tags-fill me-2"></i> Master Harga
        </a>
        
        <a href="<?=URL("/admin/pelanggan")?>" class="nav-link <?= ($currentPage == 'pelanggan') ? 'active' : '' ?>">
            <i class="bi bi-people-fill me-2"></i> Data Pelanggan
        </a>
        
        <a href="<?=URL("/admin/laporan")?>" class="nav-link <?= ($currentPage == 'laporan') ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan
        </a>
    </div>

    <div class="mt-auto p-3">
        <a href="logout.php" class="btn btn-danger w-100 btn-sm">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </div>
</div>