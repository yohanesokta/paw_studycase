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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll untuk link (diaktifkan kembali)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#login' && href !== '#buat-transaksi') {
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
    </script>
</body>
</html>