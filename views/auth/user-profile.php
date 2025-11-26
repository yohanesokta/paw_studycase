<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lengkapi Data - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, #6A73E5 0%, #5D6FE5 40%, #536DFE 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
            max-width: 550px;
            margin: auto;
        }

        .logo-title {
            font-size: 30px;
            font-weight: 700;
            color: #0d6efd;
        }

        .subtitle {
            font-size: 15px;
            color: #555;
        }

        label {
            font-weight: 600;
        }

        .form-control,
        textarea {
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 18px;
            background: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background: #0056d6;
        }

        .navbar {
            background: rgba(255, 255, 255, 0);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 23px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="profile-card">

            <!-- Logo & Title -->
            <h3 class="text-center mb-3 logo-title">
                <i class="fas fa-droplet me-2"></i> Fresh Laundry
            </h3>
            <p class="text-center subtitle">Lengkapi data Anda terlebih dahulu</p>

            <form action="<?= URL('/google/user-profile/save') ?>" method="POST">

                <div class="mb-3">
                    <label for="no_telepon">Nomor Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon"
                        class="form-control" placeholder="Masukkan nomor telepon Anda" required>
                </div>

                <div class="mb-3">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" rows="4"
                        class="form-control" placeholder="Masukkan alamat lengkap Anda" required></textarea>
                </div>

                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save me-2"></i> Simpan
                </button>
            </form>

        </div>
    </div>

</body>

</html>