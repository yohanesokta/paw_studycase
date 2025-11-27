<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/home.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* --- Font & Variables --- */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        :root {
            /* Menyesuaikan gradient tombol dengan warna Navbar Biru */
            --primary-gradient: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);
            --surface-color: #ffffff;
            --background-color: #f8f9fa;
            --input-bg: #f1f3f5;
            --text-main: #212529;
            --text-muted: #6c757d;
            --border-radius-xl: 20px;
            --border-radius-md: 12px;
            --shadow-soft: 0 10px 40px -10px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--background-color);
            /* Background pattern halus */
            background-image: radial-gradient(circle at 10% 20%, rgba(13, 110, 253, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(13, 110, 253, 0.05) 0%, transparent 20%);
        }

        /* --- Navbar Styles (Dari Desain Sebelumnya) --- */
        .navbar.bg-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link.dropdown-toggle img {
            border: 2px solid #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* --- Card Container Utama --- */
        .modern-profile-card {
            background: var(--surface-color);
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        /* --- Sisi Kiri (Sidebar Profile) --- */
        .profile-sidebar {
            background: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding: 3rem 2rem;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .avatar-container {
            position: relative;
            width: 130px;
            height: 130px;
            margin-bottom: 1.5rem;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .avatar-badge {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--primary-gradient);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: 2px solid white;
            cursor: pointer;
            transition: transform 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .avatar-badge:hover {
            transform: scale(1.1);
        }

        /* --- Sisi Kanan (Form Area) --- */
        .profile-content {
            padding: 3rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .section-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        /* --- Form Input Modern --- */
        .form-group-modern {
            margin-bottom: 1.5rem;
        }

        .form-label-modern {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-modern {
            width: 100%;
            background-color: var(--input-bg);
            border: 1px solid transparent;
            /* Border transparan default */
            border-radius: var(--border-radius-md);
            padding: 0.8rem 1.2rem;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: all 0.3s ease;
        }

        .input-modern:focus {
            background-color: #fff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            outline: none;
        }

        /* --- Buttons --- */
        .btn-action-container {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-modern-primary {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-modern-primary:hover {
            opacity: 0.95;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        }

        .btn-modern-secondary {
            background: white;
            color: var(--text-muted);
            border: 1px solid #dee2e6;
            padding: 0.8rem 2rem;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-modern-secondary:hover {
            background: #f8f9fa;
            color: var(--text-main);
        }
    </style>
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
                            <img src="<?= $_SESSION['userdata']['profile'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($_SESSION['userdata']['nama']); ?>"
                                class="rounded-circle me-2"
                                width="35" height="35" style="object-fit: cover;">

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
                                    <div class="avatar-container">
                                        <img src="<?= $_SESSION['userdata']['profile'] ?? 'https://ui-avatars.com/api/?background=random&name=' . urlencode($_SESSION['userdata']['nama']); ?>"
                                            class="avatar-img" alt="Profile Picture">

                                        <input type="file" id="upload-photo" name="profile_pic" style="display: none;">
                                    </div>

                                    <h5 class="fw-bold mb-1 text-dark"><?= explode(' ', $_SESSION['userdata']['nama'])[0]; ?></h5>
        
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
                                            <img src="<?= $_SESSION['userdata']['profile'] ?? 'https://ui-avatars.com/api/?background=random&name=' . urlencode($_SESSION['userdata']['nama']); ?>"
                                                class="rounded-circle" width="50" height="50">
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