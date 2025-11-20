<?php
session_start();
require "config/koneksi.php";
require_once "models/pesanan_models.php";

class userController extends Controllers
{

    private $conn;

    public function __construct()
    {
        require "config/koneksi.php";
        $this->conn = $conn;
    }

    public function index()
    {
        $pesananModel = new PesananModel($this->conn);

        $layanan = $pesananModel->getAllCucian();

        // Riwayat pesanan user
        $id_user = $_SESSION['userdata']['id'];
        $riwayat = $pesananModel->getPesananByUser($id_user);

        $this->view("dashboard_user", [
            "layanan" => $layanan,
            "riwayat" => $riwayat
        ]);
    }


    public function pesanan()
    {
        if (!isset($_SESSION['userdata']['id'])) {
            Redirect("/google");
            exit();
        }

        $id_user  = $_SESSION['userdata']['id'];
        $id_cucian = $_POST['id_cucian'];
        $berat = !empty($_POST['berat']) ? floatval($_POST['berat']) : NULL;

        $pesananModel = new PesananModel($this->conn);
        $cucian = $pesananModel->findCucianById($id_cucian);

        if (!$cucian) die("Layanan tidak ditemukan!");

        $harga_perkg = $cucian['harga'];
        $harga_total = ($berat !== NULL) ? ($harga_perkg * $berat) : NULL;

        $pesananModel->createPesanan($id_user, $id_cucian, $berat, $harga_total);

       $_SESSION['success_message'] = "Pesanan berhasil dibuat!";


        Redirect("/user/dashboard");
    }
}
