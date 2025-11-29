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

    public function laporan()
    {
        $this->view('admin/laporan');
    }
    
    public function masterharga() 
    {
        $this->view('admin/masterharga');
    }

}