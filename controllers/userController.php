<?php
require_once "models/pesanan_models.php";

class userController extends Controllers
{

    private $conn;

    public function __construct()
    {
        $this->conn = $GLOBALS['connection'];
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

    public function updateProfile()
    {

        $this->view("update_profile");
    }

    public function updateProfileProcess() {
        // session_start();

        $userModel = new UserModel($GLOBALS['connection']);

        $id = $_SESSION['userdata']['id'];
        $no_telepon = $_POST['no_telepon'];
        $alamat = $_POST['alamat'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];


        $userModel->updateProfileProcess($id, $no_telepon, $alamat, $nama, $email);

        $_SESSION['userdata']['no_telepon'] = $no_telepon;
        $_SESSION['userdata']['alamat'] = $alamat;
        $_SESSION['userdata']['nama'] = $nama;
        $_SESSION['userdata']['email'] = $email;
        // $_SESSION['userdata']['google_id'] = $google_id;

        $_SESSION['success_message'] = "Update profil berhasil!";

        Redirect("/user/update-profile");
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
