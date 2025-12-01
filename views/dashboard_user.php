<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL('/public/css/home.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">

            <a class="navbar-brand" href="#">
                <i class="fas fa-droplet me-2"></i>Fresh Laundry User
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">

                <ul class="navbar-nav align-items-center">

                    <!-- Dropdown User -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                            href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <!-- Foto profile -->
                            <?php if ($_SESSION['userdata']['profile']) : ?>
                                <img src="<?= $_SESSION['userdata']['profile'] ?>"
                                    class="avatar-img me-2" alt="Profile Picture" style="width: 35px; height: 35px;">
                            <?php else : ?>
                                <div class="avatar-profile me-2"><?= $_SESSION['userdata']['nama'][0]; ?></div>
                            <?php endif; ?>

                            <!-- Nama user -->
                            <span class="fw-semibold">
                                <?= $_SESSION['userdata']['nama']; ?>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            <li><a class="dropdown-item" href="<?= URL('/user/update-profile') ?>">
                                    <i class="fas fa-user-edit me-2"></i>Update Profil
                                </a></li>
                            <hr class="dropdown-divider">
                    </li>

                    <li><a class="dropdown-item text-danger" href="<?= URL('/logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a></li>
                </ul>
                </li>

                </ul>
            </div>

        </div>
    </nav>


    <section class="py-4 bg-white shadow-sm mb-4">
        <div class="container">
            <h2>Halo, <?= $_SESSION['userdata']['nama'] ?></h2>
            <p class="text-muted">Silakan buat pesanan baru. Data diri Anda sudah kami simpan.</p>
        </div>
    </section>

    <section class="container mb-5">
        <div class="row g-4">

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Buat Pesanan</h5>
                    </div>
                    <div class="card-body p-4">
                        <form id="orderForm" method="POST" action="<?= URL("/user/pesanan") ?>">

                            <div class="mb-4">
                                <label class="form-label fw-bold">Pilih Jenis Layanan</label>
                                <select class="form-select form-select-lg" name="id_cucian" id="idCucian" required>
                                    <option value="" disabled selected>-- Pilih Layanan --</option>

                                    <?php foreach ($data['layanan'] as $c) : ?>
                                        <option value="<?= $c['id']; ?>"
                                            data-harga="<?= $c['harga']; ?>"
                                            data-estimate="<?= $c['estimate']; ?>"
                                            data-nama="<?= $c['nama']; ?>">
                                            <?= $c['nama']; ?> (Rp <?= number_format($c['harga'], 0, ',', '.'); ?>/kg)
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <div class="form-text">Estimasi waktu selesai menyesuaikan layanan.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Perkiraan Berat (Kg)</label>
                                <div class="input-group input-group-lg">
                                    <input type="number" class="form-control" id="inputBerat" name="berat" placeholder="Contoh: 3" min="1">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesanan
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm bg-primary text-white h-100">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4 border-bottom border-white pb-3">
                            <i class="fas fa-clipboard-list me-2"></i>Overview Pesanan
                        </h4>

                        <div class="mb-3">
                            <small class="text-white-50">Nama Pemesan</small>
                            <h5 class="fw-bold"><?= $_SESSION['userdata']['nama']; ?></h5>
                        </div>

                        <div class="mb-3">
                            <small class="text-white-50">Alamat & Kontak</small>
                            <p class="mb-0"><?= $_SESSION['userdata']['alamat']; ?></p>
                            <p class="mb-0"><i class="fas fa-phone-alt me-1"></i><?= $_SESSION['userdata']['no_telepon']; ?></p>
                        </div>

                        <div class="row mt-4">
                            <div class="col-6">
                                <small class="text-white-50">Tanggal Masuk</small>
                                <p id="viewTglMasuk" class="fw-bold fs-5">-</p>
                            </div>
                            <div class="col-6">
                                <small class="text-white-50">Estimasi Selesai</small>
                                <p id="viewTglSelesai" class="fw-bold fs-5 text-warning">-</p>
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-top border-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-white-50">Estimasi Biaya</small>
                                    <h2 id="viewHarga" class="fw-bold mb-0">Rp 0</h2>
                                </div>
                                <div class="text-end">
                                    <small class="d-block text-white-50">Layanan</small>
                                    <span id="viewLayananBadge" class="badge bg-white text-primary">-</span>
                                </div>
                            </div>
                            <p class="mt-2 small fst-italic text-white-50">
                                *Biaya pasti akan dikonfirmasi setelah penimbangan outlet.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <h3 class="mb-4"><i class="fas fa-history"></i> Riwayat Transaksi</h3>
            <?php if (empty($riwayat)) : ?>

                <div class="alert alert-info">Belum ada riwayat transaksi terbaru.</div>

            <?php else : ?>

                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Layanan</th>
                            <th>Berat (Kg)</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($riwayat as $r) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $r['nama_layanan']; ?></td>
                                <td><?= $r['berat'] ?? '-' ?></td>
                                <td>Rp <?= number_format($r['harga'] ?? 0, 0, ',', '.'); ?></td>
                                <td>
                                    <?php if ($r['status'] == 'pending') : ?>
                                        <span class="badge bg-warning text-dark">Pending</span>

                                    <?php elseif ($r['status'] == 'belum_diambil') : ?>
                                        <span class="badge bg-primary">Belum Diambil</span>

                                    <?php else : ?>
                                        <span class="badge bg-success">Diambil</span>

                                    <?php endif; ?>
                                </td>
                                <td><?= date("d M Y", strtotime($r['tanggal'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>

        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        const inputLayanan = document.getElementById('idCucian');
        const inputBerat = document.getElementById('inputBerat');

        const viewTglMasuk = document.getElementById('viewTglMasuk');
        const viewTglSelesai = document.getElementById('viewTglSelesai');
        const viewHarga = document.getElementById('viewHarga');
        const viewLayananBadge = document.getElementById('viewLayananBadge');

        // Update tanggal masuk & estimasi selesai
        function updateDates() {

            if (inputLayanan.selectedIndex < 1) return;

            const today = new Date();
            const hariEstimate = parseInt(inputLayanan.selectedOptions[0].getAttribute('data-estimate'));

            const selesai = new Date();
            selesai.setDate(today.getDate() + hariEstimate);

            const opt = {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            };

            viewTglMasuk.innerText = today.toLocaleDateString('id-ID', opt);
            viewTglSelesai.innerText = selesai.toLocaleDateString('id-ID', opt);
        }

        // Update harga
        function updatePrice() {

            if (inputLayanan.selectedIndex < 1) return;

            const hargaPerKg = parseInt(inputLayanan.selectedOptions[0].getAttribute('data-harga'));
            const namaLayanan = inputLayanan.selectedOptions[0].getAttribute('data-nama');

            const berat = parseFloat(inputBerat.value) || 0;
            const total = hargaPerKg * berat;

            viewHarga.innerText = "Rp " + total.toLocaleString('id-ID');
            viewLayananBadge.innerText = namaLayanan;

            updateDates();
        }

        inputLayanan.addEventListener('change', updatePrice);
        inputBerat.addEventListener('input', updatePrice);

        updateDates();
    </script>


</body>

</html>