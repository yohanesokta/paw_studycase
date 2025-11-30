<?php
require "models/admin_models.php";

class adminController extends Controllers
{

    private $adminModels;

    public function __construct()
    {
        $this->adminModels = new AdminModels();
    }

    public function dashboard()
    {
        $this->view('admin/dashboard');
    }

    public function pesanan()
    {
        $data = $this->adminModels->getPesanan();
        $this->view('admin/pesanan', ['data' => $data]);
    }

    public function updateBerat()
    {
        $id = $_POST['id_pesanan'];
        $berat = $_POST['berat'];

        if (empty($berat) || empty($id)) {
            die('Empty Parameters Error 402');
        }

        $this->adminModels->updateBerat($id, $berat);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Berat pesanan berhasil diperbarui!'
        ];

        Redirect("/admin/pesanan");
    }

    public function updatePesanan()
    {
        $id = $_POST['id_pesanan'];
        $status_order = $_POST['status_order'];
        $status_bayar = $_POST['status_bayar'];

        if (empty($status_order) || empty($id) || empty($status_bayar)) {
            die('Empty Parameters Error 402');
        }

        $this->adminModels->updatePesanan($id, $status_order, $status_bayar);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Status pesanan berhasil diperbarui!'
        ];

        Redirect("/admin/pesanan");
    }

// Pelanggan methods

    public function pelanggan()
    {
        $data = $this->adminModels->getPelanggan();
        $this->view('admin/pelanggan', ['data' => $data]);
    }

    public function tambahPelanggan()
    {
        $nama   = $_POST['nama'] ?? null;
        $email  = $_POST['email'] ?? null;
        $telp   = $_POST['no_telepon'] ?? null;
        $alamat = $_POST['alamat'] ?? null;

        if (!$nama || !$email || !$telp || !$alamat) {
            die("Empty Parameters Error 402");
        }

        $this->adminModels->addPelanggan($nama, $email, $telp, $alamat);

        // ---- FLASH MESSAGE ----
        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Pelanggan berhasil ditambahkan!'
        ];

        Redirect("/admin/pelanggan");
    }

    public function updatePelanggan()
    {
        $id     = $_POST['id'] ?? null;
        $nama   = $_POST['nama'] ?? null;
        $email  = $_POST['email'] ?? null;
        $telp   = $_POST['no_telepon'] ?? null;
        $alamat = $_POST['alamat'] ?? null;

        if (!$id || !$nama || !$email || !$telp || !$alamat) {
            die("Empty Parameters Error 402");
        }

        $this->adminModels->updatePelanggan($id, $nama, $email, $telp, $alamat);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Pelanggan berhasil diperbarui!'
        ];

        Redirect("/admin/pelanggan");
    }

    public function hapusPelanggan()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            die("Empty Parameters Error 402");
        }

        $this->adminModels->deletePelanggan($id);

        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Pelanggan berhasil dihapus!'
        ];

        Redirect("/admin/pelanggan");
    }

    // LAPORAN PELANGGAN
    public function laporan()
    {
        $tahunDipilih = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

        // daftar tahun
        $tahunList = $this->adminModels->getTahunTransaksi();

        // laporan bulanan
        $laporanBulanan = $this->adminModels->getLaporanBulananByTahun($tahunDipilih);

        // laporan harian (grafik)
        $rows = $this->adminModels->getLaporanHarianByTahun($tahunDipilih);

        $labels = [];
        $values = [];

        foreach ($rows as $r) {
            $labels[] = $r['bulan'];
            $values[] = $r['total'];
        }

        $this->view('admin/laporan', [
            'tahunList' => $tahunList,
            'tahunDipilih' => $tahunDipilih,
            'laporanBulanan' => $laporanBulanan,
            'labels' => $labels,
            'values' => $values
        ]);
    }



    public function masterharga() {
        $this->view('admin/masterharga');
    }

}
