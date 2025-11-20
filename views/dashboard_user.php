<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Fresh Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/home.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-droplet me-2"></i>Fresh Laundry User
            </a>
        </div>
    </nav>

    <section class="py-4 bg-white shadow-sm mb-4">
        <div class="container">
            <h2>Halo, Pelanggan Setia!</h2>
            <p class="text-muted">Silakan buat pesanan baru. Data diri Anda sudah kami simpan.</p>
        </div>
    </section>

    <section class="container mb-5">
        <div class="row g-4">
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-plus-circle me-2"></i>Buat Pesanan</h5>
                    </div>
                    <div class="card-body p-4">
                        <form id="orderForm" method="POST" action="proses_pesanan.php">
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Pilih Jenis Layanan</label>
                                <select class="form-select form-select-lg" id="inputLayanan" name="jenis_layanan" required>
                                    <option value="" data-harga="0" selected disabled>-- Pilih Layanan --</option>
                                    <option value="Cuci Reguler" data-harga="5000">Cuci Reguler (Rp 5.000/kg)</option>
                                    <option value="Cuci Express" data-harga="8000">Cuci Express (Rp 8.000/kg)</option>
                                    <option value="Cuci Premium" data-harga="10000">Cuci Premium (Rp 10.000/kg)</option>
                                </select>
                                <div class="form-text">Estimasi waktu selesai menyesuaikan layanan.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Perkiraan Berat (Kg)</label>
                                <div class="input-group input-group-lg">
                                    <input type="number" class="form-control" id="inputBerat" name="berat" placeholder="Contoh: 3" min="1">
                                    <span class="input-group-text">Kg</span>
                                </div>
                                <div class="form-text text-danger">*Opsional. Jika kosong, akan ditimbang oleh petugas.</div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm bg-primary text-white h-100">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4 border-bottom border-white pb-3">
                            <i class="fas fa-clipboard-list me-2"></i>Overview Pesanan
                        </h4>
                        
                        <div class="mb-3">
                            <small class="text-white-50">Nama Pemesan</small>
                            <h5 class="fw-bold">Agus Susanto</h5> </div>

                        <div class="mb-3">
                            <small class="text-white-50">Alamat & Kontak</small>
                            <p class="mb-0">Jl. Telang Indah No. 12, Kamal</p> <p class="mb-0"><i class="fas fa-phone-alt me-1"></i> 0812-3456-7890</p> </div>

                        <div class="row mt-4">
                            <div class="col-6">
                                <small class="text-white-50">Tanggal Masuk</small>
                                <p id="viewTglMasuk" class="fw-bold fs-5">-</p>
                            </div>
                            <div class="col-6">
                                <small class="text-white-50">Estimasi Selesai</small>
                                <p id="viewTglSelesai" class="fw-bold fs-5 text-warning">-</p>
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-top border-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-white-50">Estimasi Biaya</small>
                                    <h2 id="viewHarga" class="fw-bold mb-0">Rp 0</h2>
                                </div>
                                <div class="text-end">
                                    <small class="d-block text-white-50">Layanan</small>
                                    <span id="viewLayananBadge" class="badge bg-white text-primary">-</span>
                                </div>
                            </div>
                            <p class="mt-2 small fst-italic text-white-50">
                                *Biaya pasti akan dikonfirmasi setelah penimbangan outlet.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <h3 class="mb-4"><i class="fas fa-history"></i> Riwayat Transaksi</h3>
            <div class="alert alert-info">Belum ada riwayat transaksi terbaru.</div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // === LOGIC UPDATE OVERVIEW ===
        const inputLayanan = document.getElementById('inputLayanan');
        const inputBerat = document.getElementById('inputBerat');
        
        const viewTglMasuk = document.getElementById('viewTglMasuk');
        const viewTglSelesai = document.getElementById('viewTglSelesai');
        const viewHarga = document.getElementById('viewHarga');
        const viewLayananBadge = document.getElementById('viewLayananBadge');

        // 1. Fungsi Update Tanggal
        function updateDates() {
            const today = new Date();
            // Default selesai 2 hari, tapi bisa diubah logika-nya misal Express = 1 hari
            let hariPengerjaan = 2; 
            
            // Cek jika layanan express (opsional logic)
            const layanan = inputLayanan.value;
            if(layanan === 'Cuci Express') hariPengerjaan = 1;

            const completionDate = new Date(today);
            completionDate.setDate(today.getDate() + hariPengerjaan);

            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            viewTglMasuk.innerText = today.toLocaleDateString('id-ID', options);
            viewTglSelesai.innerText = completionDate.toLocaleDateString('id-ID', options);
        }

        // 2. Fungsi Update Harga
        function updatePrice() {
            // Ambil harga dari data-harga
            const hargaPerKg = inputLayanan.selectedOptions[0].getAttribute('data-harga') || 0;
            const berat = parseFloat(inputBerat.value) || 0; // Jika kosong dianggap 0
            
            const total = hargaPerKg * berat;
            
            viewHarga.innerText = "Rp " + total.toLocaleString('id-ID');
            
            // Update Badge Nama Layanan di Overview
            viewLayananBadge.innerText = inputLayanan.value || "Belum Dipilih";
            
            // Update tanggal juga (karena Express mungkin beda hari)
            updateDates();
        }

        // Event Listeners
        inputLayanan.addEventListener('change', updatePrice);
        inputBerat.addEventListener('input', updatePrice);

        // Jalankan sekali saat load
        updateDates();
    </script>

</body>
</html>