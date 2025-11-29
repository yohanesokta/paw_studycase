<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, #6A73E5 0%, #5D6FE5 40%, #536DFE 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.15);
        }

        .logo-title {
            font-size: 32px;
            font-weight: 700;
            color: #0d6efd;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-radius: 10px;
            padding: 12px;
            font-size: 18px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0056d6;
        }

        .form-control {
            padding: 12px;
            border-radius: 10px;
            font-size: 16px;
        }

        label {
            font-weight: 600;
        }

        .link-login {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="register-card mt-5 mb-5">

                    <h3 class="text-center mb-3 logo-title">
                        <i class="fas fa-droplet me-2"></i> Fresh Laundry
                    </h3>

                    <p class="text-center text-muted mb-4">Daftar akun pelanggan baru</p>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= URL('/auth/register/process') ?>">

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input required type="text" name="nama" class="form-control form-control-lg" placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input required type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input required type="password" name="password" class="form-control form-control-lg" placeholder="Buat password">
                        </div>
                        <div class="mb-3">
                            <label>No Telepon</label>
                            <input required type="number" name="no_telepon" class="form-control form-control-lg" placeholder="Masukan No Telepon">
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control form-control-lg" placeholder="Masukan alamat"></textarea>
                        </div>

                        <button class="btn btn-primary w-100 my-2">
                            <i class="fas fa-user-plus me-1"></i> Daftar
                        </button>

                        <p class="text-center mt-3">
                            <a href="<?= URL('/auth/login') ?>" class="text-primary link-login">
                                Sudah punya akun? Login sekarang
                            </a>
                        </p>

                    </form>

                </div>

            </div>
        </div>
    </div>

</body>

</html>