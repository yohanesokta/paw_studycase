<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lengkapi Data - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: white !important;
        }

        .nav-link {
            color: white !important;
        }

        .form-container {
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            margin-top: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-weight: 600;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-droplet"></i> Fresh Laundry
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#mengapa">Mengapa Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#harga">Harga</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form Section -->
    <div class="container">
        <div class="form-container mx-auto">
            <h2>Lengkapi Data Anda</h2>

            <form action="<?= URL("/google/user-profile/save") ?>" method="POST">

                <div class="mb-3">
                    <label for="no_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telepon" id="no_telepon"
                        placeholder="Masukkan nomor telepon" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="4"
                        placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
        </div>
    </div>

</body>

</html>