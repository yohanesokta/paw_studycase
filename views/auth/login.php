<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg,
                    rgba(106, 115, 229, 1) 0%,
                    rgba(93, 111, 229, 0.95) 35%,
                    rgba(83, 109, 254, 0.90) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }


        .login-card {
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

        

        .btn-google {
            background: #dd4b39;
            color: white;
            border-radius: 10px;
            padding: 12px;
            font-size: 17px;
            font-weight: 600;
        }

        .form-control {
            padding: 12px;
            border-radius: 10px;
            font-size: 16px;
        }

        label {
            font-weight: 600;
        }

        .link-register {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="login-card">

                    <h3 class="text-center mb-3 logo-title">
                        <i class="fas fa-bubble fa-droplet me-2"></i> Fresh Laundry
                    </h3>

                    <p class="text-center text-muted mb-4">Silakan login untuk melanjutkan</p>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= URL('/auth/login/process') ?>">

                        <div class="mb-3">
                            <label>Email</label>
                            <input required type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email Anda">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input required type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password">
                        </div>

                        <button class="btn btn-primary w-100 my-2">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </button>

                        <p class="text-center mt-3">
                            <a href="<?= URL('/auth/register') ?>" class="text-primary link-register">
                                Belum punya akun? Daftar sekarang
                            </a>
                        </p>

                        <hr>

                        <a href="<?= URL('/google') ?>" class="btn btn-google w-100">
                            <i class="fab fa-google me-2"></i> Login dengan Google
                        </a>

                    </form>

                </div>

            </div>
        </div>
    </div>

</body>

</html>