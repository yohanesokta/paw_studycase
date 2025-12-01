<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil - Fresh Laundry</title>
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

    <section class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-10">

                <form action="<?= URL('/user/update-profile-process') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modern-profile-card">
                        <div class="row g-0">

                            <div class="col-lg-4 d-none d-lg-block">
                                <div class="profile-sidebar">
                                    <?php if ($_SESSION['userdata']['profile']) : ?>
                                        <div class="avatar-container">
                                            <img src="<?= $_SESSION['userdata']['profile'] ?>"
                                                class="avatar-img" alt="Profile Picture">
                                        </div>
                                    <?php else : ?>
                                        <div class="avatar-container">
                                            <div class="avatar-profile avatar-container" style="font-size: 50px; background-color: #ffffffff;"><?= strtoupper($_SESSION['userdata']['nama'][0] .  $_SESSION['userdata']['nama'][1]); ?></div>

                                        </div>
                                    <?php endif; ?>



                                    <h5 class="fw-bold mb-1 text-dark"><?= $_SESSION['userdata']['nama']; ?></h5>

                                </div>
                            </div>


                            <div class="col-lg-8">
                                <div class="profile-content">

                                    <div class="d-flex mb-4 text-start">
                                        <div>
                                            <h2 class="section-titlee text-start">Edit Profil</h2>
                                            <p class="section-subtitle">Perbarui informasi pribadi dan akun Anda.</p>
                                        </div>
                                        <div class="d-lg-none">
                                            <img src="<?= $_SESSION['userdata']['profile'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($_SESSION['userdata']['nama']) . '&background=0d6efd&color=fff'; ?>"
                                                class="avatar-img" alt="Profile Picture">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="fas fa-user me-1 text-primary"></i> Nama Lengkap
                                            </label>
                                            <input type="text" name="nama" class="input-modern"
                                                value="<?= $_SESSION['userdata']['nama'] ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group-modern">
                                            <label class="form-label-modern">
                                                <i class="fas fa-phone me-1 text-primary"></i> Nomor Telepon
                                            </label>
                                            <input type="text" name="no_telepon" class="input-modern"
                                                value="<?= $_SESSION['userdata']['no_telepon'] ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group-modern">
                                        <label class="form-label-modern">
                                            <i class="fas fa-envelope me-1 text-primary"></i> Alamat Email
                                        </label>
                                        <input type="email" name="email" class="input-modern"
                                            value="<?= $_SESSION['userdata']['email'] ?>" required>
                                    </div>

                                    <div class="form-group-modern">
                                        <label class="form-label-modern">
                                            <i class="fas fa-map-marker-alt me-1 text-primary"></i> Alamat Lengkap
                                        </label>
                                        <textarea name="alamat" class="input-modern" rows="3"
                                            required><?= $_SESSION['userdata']['alamat'] ?></textarea>
                                    </div>

                                    <hr class="my-4 text-muted opacity-25">

                                    <div class="btn-action-container">
                                        <button type="button" onclick="window.location.href = '<?= URL('/user/dashboard') ?>'" class="btn-modern-secondary">
                                            Batal
                                        </button>
                                        <button type="submit" class="btn-modern-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>