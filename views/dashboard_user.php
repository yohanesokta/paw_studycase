<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/home.css">
    <!-- pastikan path menuju public/css dari folder views -->

    <style>
        .dashboard-nav {
            background: #6a5af9;
            padding: 12px 0;
        }

        .dashboard-nav .nav-link,
        .dashboard-nav .navbar-brand {
            color: #fff !important;
            font-weight: 600;
        }

        .dashboard-hero {
            background: linear-gradient(135deg, #6a5af9, #836fff);
            padding: 60px 0;
            color: #fff;
            text-align: center;
        }

        .transaction-card {
            background: #fff;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease;
        }

        .transaction-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        .transaction-status {
            font-size: 14px;
            padding: 5px 12px;
            border-radius: 10px;
            font-weight: 600;
        }

        .status-proses {
            background: #ffd66b;
        }

        .status-selesai {
            background: #73e47b;
            color: #fff;
        }

        .status-diambil {
            background: #4da3ff;
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- NAVBAR DASHBOARD -->
    <nav class="navbar navbar-expand-lg dashboard-nav">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-user-circle"></i> Dashboard User
            </a>

            <!-- Tombol kembali -->
            <a href="home.php" class="btn btn-light ms-auto">
                <i class="fas fa-arrow-left"></i> Kembali ke Home
            </a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="dashboard-hero">
        <div class="container">
            <h1>Status Pakaian & Transaksi Anda</h1>
            <p>Lihat progres lengkap laundry Anda di sini.</p>
        </div>
    </section>

    <!-- DAFTAR TRANSAKSI -->
    <section class="py-5">
        <div class="container">
            <h3 class="mb-4"><i class="fas fa-list"></i> Daftar Transaksi Anda</h3>

            <div class="row g-4">

                <!-- Transaksi 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="transaction-card">
                        <h5><i class="fas fa-receipt"></i> Kode: TRX-001</h5>
                        <p><b>Tanggal:</b> -</p>
                        <p><b>Layanan:</b> Cuci Reguler</p>
                        <p><b>Berat:</b> 4 Kg</p>
                        <span class="transaction-status status-proses">Sedang Diproses</span>
                    </div>
                </div>

                <!-- Transaksi 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="transaction-card">
                        <div class="d-flex align-items-start">
                            <h5 class="mb-2"><i class="fas fa-receipt"></i> Kode: TRX-002</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary ms-auto btn-print"
                                data-kode="TRX-002" data-tanggal="-" data-layanan="Cuci Express" data-berat="2 Kg"
                                data-status="Selesai" title="Print Transaksi">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                        <p><b>Tanggal:</b> -</p>
                        <p><b>Layanan:</b> Cuci Express</p>
                        <p><b>Berat:</b> 2 Kg</p>
                        <span class="transaction-status status-selesai">Selesai</span>
                    </div>
                </div>

                <!-- Transaksi 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="transaction-card">
                        <div class="d-flex align-items-start">
                            <h5 class="mb-2"><i class="fas fa-receipt"></i> Kode: TRX-003</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary ms-auto btn-print"
                                data-kode="TRX-003" data-tanggal="-" data-layanan="Cuci Premium" data-berat="5 Kg"
                                data-status="Sudah Diambil" title="Print Transaksi">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                        <p><b>Tanggal:</b> -</p>
                        <p><b>Layanan:</b> Cuci Premium</p>
                        <p><b>Berat:</b> 5 Kg</p>
                        <span class="transaction-status status-diambil">Sudah Diambil</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <script>
        document.querySelectorAll('.btn-print').forEach(btn => {
            btn.addEventListener('click', () => {
                const data = {
                    kode: btn.dataset.kode,
                    tanggal: btn.dataset.tanggal,
                    layanan: btn.dataset.layanan,
                    berat: btn.dataset.berat,
                    status: btn.dataset.status
                };
                const win = window.open('', '_blank', 'width=800,height=600');
                const html = `
                    <!doctype html><html><head><meta charset="utf-8"><title>Print ${data.kode}</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>body{padding:20px;font-family:Arial,Helvetica,sans-serif} .card{padding:20px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.08)}</style>
                    </head><body>
                    <div class="card">
                        <h3>Transaksi ${data.kode}</h3>
                        <p><strong>Tanggal:</strong> ${data.tanggal}</p>
                        <p><strong>Layanan:</strong> ${data.layanan}</p>
                        <p><strong>Berat:</strong> ${data.berat}</p>
                        <p><strong>Status:</strong> ${data.status}</p>
                    </div>
                    <script>window.onload=function(){window.print(); setTimeout(()=>window.close(),500);}</` + `script>
                    </body></html>
                `;
                win.document.write(html);
                win.document.close();
            });
        });
    </script>

</body>

</html>
