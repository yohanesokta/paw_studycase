<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Data - Fresh Laundry</title>
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

        .profile-container {
            max-width: 550px;
            width: 100%;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.6s ease;
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
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .logo-icon i {
            color: white;
            font-size: 38px;
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

        .info-banner {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .info-banner i {
            color: #667eea;
            font-size: 20px;
            margin-right: 10px;
        }

        .info-banner p {
            margin: 0;
            color: #4a5568;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
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

        .form-control,
        textarea.form-control {
            padding: 13px 15px 13px 45px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            padding-top: 15px;
        }

        .form-control:focus,
        textarea.form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .btn-save {
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

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
            gap: 10px;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #a0aec0;
        }

        .step.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .step-line {
            width: 50px;
            height: 2px;
            background: #e2e8f0;
        }
    </style>
</head>

<body>

    <div class="profile-container">
        <div class="profile-card">

            <div class="logo-section">
                <div class="logo-icon">
                    <i class="bi bi-droplet-fill"></i>
                </div>
                <h3 class="logo-title">Fresh Laundry</h3>
                <p class="logo-subtitle">Selamat datang! Mari lengkapi data Anda</p>
            </div>

            <div class="step-indicator">
                <div class="step active">
                    <i class="bi bi-check-lg"></i>
                </div>
                <div class="step-line"></div>
                <div class="step active">2</div>
            </div>

            <div class="info-banner">
                <i class="bi bi-info-circle-fill"></i>
                <p><strong>Langkah Terakhir!</strong> Lengkapi nomor telepon dan alamat Anda untuk melanjutkan.</p>
            </div>

            <form action="<?= URL('/google/user-profile/save') ?>" method="POST">

                <div class="form-group">
                    <label for="no_telepon">
                        <i class="bi bi-telephone me-1"></i>
                        Nomor Telepon
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-telephone-fill input-icon"></i>
                        <input type="tel"
                            id="no_telepon"
                            name="no_telepon"
                            class="form-control"
                            placeholder="08xxxxxxxxxx"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">
                        <i class="bi bi-geo-alt me-1"></i>
                        Alamat Lengkap
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-geo-alt-fill input-icon"></i>
                        <textarea id="alamat"
                            name="alamat"
                            class="form-control"
                            placeholder="Masukkan alamat lengkap (Jalan, RT/RW, Kelurahan, Kecamatan, Kota)"
                            required></textarea>
                    </div>
                </div>

                <button class="btn-save" type="submit">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Simpan & Lanjutkan
                </button>
            </form>

        </div>
    </div>

</body>

</html>