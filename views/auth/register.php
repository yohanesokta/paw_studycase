<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .register-container {
            max-width: 500px;
            width: 100%;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.6s ease;
            margin: 30px 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .logo-icon i {
            color: white;
            font-size: 32px;
        }

        .logo-title {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .logo-subtitle {
            color: #718096;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 15px;
            color: #a0aec0;
            font-size: 18px;
            z-index: 1;
        }

        .form-control {
            padding: 13px 15px 13px 45px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            padding-top: 15px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #718096;
            font-size: 14px;
        }

        .login-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .alert-danger {
            background: #fed7d7;
            color: #c53030;
        }
    </style>
</head>

<body>

    <div class="register-container">
        <div class="register-card">

            <div class="logo-section">
                <div class="logo-icon">
                    <i class="bi bi-droplet-fill"></i>
                </div>
                <h3 class="logo-title">Fresh Laundry</h3>
                <p class="logo-subtitle">Daftar akun pelanggan baru</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= URL('/auth/register/process') ?>">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-wrapper">
                        <i class="bi bi-person-fill input-icon"></i>
                        <input required type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrapper">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input required type="email" name="email" class="form-control" placeholder="nama@email.com">
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input required type="password" name="password" class="form-control" placeholder="Buat password">
                    </div>
                </div>

                <div class="form-group">
                    <label>No Telepon</label>
                    <div class="input-wrapper">
                        <i class="bi bi-telephone-fill input-icon"></i>
                        <input required type="tel" name="no_telepon" class="form-control" placeholder="08xxxxxxxxxx">
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <div class="input-wrapper">
                        <i class="bi bi-geo-alt-fill input-icon"></i>
                        <textarea required name="alamat" class="form-control" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
                </button>

            </form>

            <div class="login-link">
                Sudah punya akun? <a href="<?= URL('/auth/login') ?>">Login sekarang</a>
            </div>

        </div>
    </div>

</body>

</html>