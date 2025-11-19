<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Laundry - Service Laundry Terpercaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            margin-left: 15px;
            transition: opacity 0.3s ease;
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        .btn-login {
            background-color: white;
            color: #667eea;
            font-weight: 600;
            padding: 8px 25px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0;
            min-height: 700px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -50px;
            animation: float 6s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -50px;
            left: -100px;
            animation: float 8s ease-in-out infinite reverse;
        }

        .hero-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
            position: relative;
            z-index: 2;
            width: 100%;
        }

        .hero-content {
            animation: slideInLeft 0.8s ease;
        }

        .hero-image {
            animation: slideInRight 0.8s ease 0.2s both;
        }

        .hero-image img {
            width: 100%;
            max-width: 500px;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));
            border-radius: 20px;
        }

        .hero h1 {
            font-size: 64px;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1.2;
            background: linear-gradient(135deg, #ffffff 0%, #f0f0ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero .subtitle {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
            opacity: 0.95;
            animation: slideUp 0.8s ease 0.3s both;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.9;
            line-height: 1.8;
            animation: slideUp 0.8s ease 0.5s both;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            animation: slideUp 0.8s ease 0.7s both;
            flex-wrap: wrap;
        }

        .hero-icon {
            font-size: 80px;
            margin-bottom: 20px;
            animation: bounce 3s ease-in-out infinite;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(30px);
            }
        }

        .btn-hero {
            padding: 15px 35px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-hero-primary {
            background-color: white;
            color: #667eea;
        }

        .btn-hero-primary:hover {
            background-color: #f0f0f0;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .btn-hero-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-hero-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        /* Services Section */
        .services-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 50px;
            color: #333;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            margin: 15px auto 0;
            border-radius: 2px;
        }

        .service-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border: none;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.2);
        }

        .service-icon {
            font-size: 50px;
            color: #667eea;
            margin-bottom: 20px;
        }

        .service-card h5 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }

        .service-card p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Why Choose Us Section */
        .why-choose {
            padding: 80px 0;
            background: white;
        }

        .why-choose h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 40px;
            color: #333;
        }

        .why-choose h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            margin: 15px 0;
            border-radius: 2px;
        }

        .benefit-item {
            margin-bottom: 30px;
            display: flex;
            align-items: flex-start;
        }

        .benefit-icon {
            font-size: 30px;
            color: #667eea;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .benefit-content h5 {
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
        }

        .benefit-content p {
            color: #666;
            margin: 0;
        }

        /* Pricing Section */
        .pricing-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .pricing-card {
            background: white;
            border-radius: 10px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .pricing-card:hover {
            border-color: #667eea;
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.2);
        }

        .pricing-card h5 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
        }

        .price {
            font-size: 36px;
            font-weight: 700;
            color: #667eea;
            margin: 20px 0;
        }

        .price span {
            font-size: 16px;
            color: #666;
        }

        .pricing-features {
            list-style: none;
            margin: 25px 0;
            text-align: left;
        }

        .pricing-features li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            color: #666;
        }

        .pricing-features li::before {
            content: '✓ ';
            color: #667eea;
            font-weight: 700;
            margin-right: 10px;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0 20px;
        }

        .footer-section h5 {
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #bbb;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            color: #bbb;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #667eea;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            color: white;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: #764ba2;
            transform: translateY(-5px);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .hero h1 {
                font-size: 48px;
            }

            .hero .subtitle {
                font-size: 24px;
            }

            .hero-image {
                order: -1;
            }

            .hero-image img {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .hero {
                min-height: auto;
                padding: 40px 0;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero .subtitle {
                font-size: 20px;
            }

            .hero p {
                font-size: 16px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn-hero {
                width: 100%;
                text-align: center;
            }

            .section-title {
                font-size: 28px;
            }

            .nav-link {
                margin-left: 0;
                margin-top: 10px;
            }

            .navbar-brand {
                font-size: 20px;
            }
        }

        @media (max-width: 576px) {
            .hero {
                padding: 30px 0;
                min-height: auto;
            }

            .hero h1 {
                font-size: 28px;
            }

            .hero .subtitle {
                font-size: 18px;
            }

            .hero p {
                font-size: 14px;
            }

            .hero-icon {
                font-size: 60px;
            }

            .section-title {
                font-size: 24px;
            }

            .service-card {
                padding: 20px;
            }

            .pricing-card {
                padding: 25px 20px;
            }

            .price {
                font-size: 28px;
            }

            .cta-section h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-droplet"></i> Fresh Laundry
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mengapa">Mengapa Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#harga">Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-login btn-sm" href="<?php echo "/".$_ENV["proyekname"];?>/google">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="container">
            <div class="hero-container">
                <div class="hero-content">
                    <h1>Fresh Laundry</h1>
                    <div class="subtitle">Layanan Laundry Terpercaya dengan Kualitas Terbaik</div>
                    <p>Kami siap membuat pakaian Anda tetap bersih dan wangi sepanjang waktu. Dengan tim profesional dan teknologi terkini, kami memberikan hasil terbaik untuk kepuasan Anda.</p>
                    <div class="hero-buttons">
                        <a href="#layanan" class="btn btn-hero btn-hero-primary">
                            <i class="fas fa-star"></i> Lihat Layanan
                        </a>
                        <a href="#kontak" class="btn btn-hero btn-hero-secondary">
                            <i class="fas fa-phone"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="./public/Service_laudry.jpeg" alt="Layanan Laundry Fresh">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="layanan">
        <div class="container">
            <h2 class="section-title">Layanan Kami</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <h5>Cuci Reguler</h5>
                        <p>Layanan mencuci standar untuk pakaian sehari-hari dengan harga terjangkau dan hasil maksimal.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h5>Cuci Express</h5>
                        <p>Layanan cepat untuk kebutuhan mendesak. Pakaian Anda siap dalam waktu 24 jam.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h5>Cuci Premium</h5>
                        <p>Layanan premium untuk pakaian eksklusif dengan perawatan khusus dan parfum pilihan.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-iron"></i>
                        </div>
                        <h5>Setrika & Lipat</h5>
                        <p>Layanan setrika profesional dengan lipatan rapi untuk penampilan yang sempurna.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-spray-can"></i>
                        </div>
                        <h5>Dry Cleaning</h5>
                        <p>Pembersihan khusus untuk jas, gaun, dan pakaian formal dengan teknologi terkini.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <h5>Cuci Sprei & Selimut</h5>
                        <p>Layanan khusus untuk bedding dengan desinfeksi dan aroma kesegaran alami.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-couch"></i>
                        </div>
                        <h5>Cuci Sofa & Karpet</h5>
                        <p>Pembersihan mendalam untuk furniture dengan teknologi steam cleaning profesional.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h5>Antar Jemput</h5>
                        <p>Layanan gratis antar jemput untuk area tertentu. Kemudahan tanpa harus keluar rumah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose" id="mengapa">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Mengapa Memilih Fresh Laundry?</h2>

                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Kualitas Terjamin</h5>
                            <p>Proses pencucian dengan standar internasional menggunakan mesin modern dan deterjen berkualitas tinggi.</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Harga Kompetitif</h5>
                            <p>Kami menawarkan harga terbaik di pasaran tanpa mengorbankan kualitas layanan.</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Layanan Cepat</h5>
                            <p>Waktu pengerjaan yang singkat dengan hasil maksimal, sesuai jadwal yang Anda inginkan.</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Tim Profesional</h5>
                            <p>Staf terlatih dan berpengalaman yang siap memberikan pelayanan terbaik untuk kepuasan Anda.</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Antar Jemput Gratis</h5>
                            <p>Kami menjemput dan mengantar pakaian Anda dengan aman dan profesional.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img src="./public/gambar1.jpeg" alt="Layanan Laundry" class="img-fluid rounded-3" style="box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section" id="harga">
        <div class="container">
            <h2 class="section-title">Harga Layanan</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="pricing-card">
                        <h5>Cuci Reguler</h5>
                        <div class="price">Rp 5.000<span>/kg</span></div>
                        <ul class="pricing-features">
                            <li>Waktu 3-5 hari</li>
                            <li>Detergent standar</li>
                            <li>Gratis softener</li>
                        </ul>
                        <a href="<?php echo "/".$_ENV["proyekname"];?>/google" class="btn btn-outline-primary btn-sm">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pricing-card">
                        <h5>Cuci Express</h5>
                        <div class="price">Rp 8.000<span>/kg</span></div>
                        <ul class="pricing-features">
                            <li>Waktu 24 jam</li>
                            <li>Detergent premium</li>
                            <li>Parfum pilihan</li>
                        </ul>
                        <a href="#login" class="btn btn-primary btn-sm">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pricing-card">
                        <h5>Cuci Premium</h5>
                        <div class="price">Rp 12.000<span>/kg</span></div>
                        <ul class="pricing-features">
                            <li>Waktu 1 hari</li>
                            <li>Detergent imported</li>
                            <li>Pelayanan VIP</li>
                        </ul>
                        <a href="#login" class="btn btn-primary btn-sm">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pricing-card">
                        <h5>Paket Bulanan</h5>
                        <div class="price">Rp 150.000<span>/bulan</span></div>
                        <ul class="pricing-features">
                            <li>Unlimited 50kg</li>
                            <li>Gratis antar jemput</li>
                            <li>Diskon 20%</li>
                        </ul>
                        <a href="#login" class="btn btn-primary btn-sm">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="kontak">
        <div class="container">
            <h2>Siap Mempercayakan Laundry Anda?</h2>
            <p>Hubungi kami sekarang dan nikmati pengalaman laundry yang luar biasa</p>
            <div>
                <a href="tel:+628123456789" class="btn btn-light btn-lg me-2 mb-2">
                    <i class="fas fa-phone"></i> Hubungi Kami
                </a>
                <a href="#login" class="btn btn-outline-light btn-lg mb-2">
                    <i class="fas fa-user"></i> Login Akun
                </a>
            </div>
            <div class="social-links mt-4">
                <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-section">
                    <h5><i class="fas fa-droplet"></i> Fresh Laundry</h5>
                    <p>Layanan laundry terpercaya dengan kualitas terbaik untuk kebutuhan Anda sehari-hari.</p>
                </div>

                <div class="col-md-3 footer-section">
                    <h5>Layanan</h5>
                    <ul>
                        <li><a href="#layanan">Cuci Reguler</a></li>
                        <li><a href="#layanan">Cuci Express</a></li>
                        <li><a href="#layanan">Dry Cleaning</a></li>
                        <li><a href="#layanan">Antar Jemput</a></li>
                    </ul>
                </div>

                <div class="col-md-3 footer-section">
                    <h5>Informasi</h5>
                    <ul>
                        <li><a href="#mengapa">Tentang Kami</a></li>
                        <li><a href="#harga">Harga</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div class="col-md-3 footer-section">
                    <h5>Hubungi Kami</h5>
                    <p>
                        <i class="fas fa-phone"></i> +62 812 3456 789<br>
                        <i class="fas fa-envelope"></i> info@freshlaundry.com<br>
                        <i class="fas fa-map-marker-alt"></i> Jl. Merdeka No. 123, Jakarta
                    </p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 24-181_Rizki, 24-095_Yohannes, 24-139_M Andri, 24-200_Anas, 24-160_Surya. Semua hak cipta dilindungi. Dibuat dengan <i class="fas fa-heart" style="color: #e74c3c;"></i> untuk Anda.</p>
            </div>
        </div>
    </footer>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll untuk link
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#login') {
                    e.preventDefault();
                    const element = document.querySelector(href);
                    if (element) {
                        element.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script> -->
</body>
</html>
