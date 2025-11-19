<?php
require_once "models/user_models.php";

class authController extends Controllers
{
    public function login()
    {
        $data = [
            "client_id" => $_ENV['google_client_id'],
            "redirect_uri" => "http://localhost/paw_studycase/google/callback",
            "response_type" => "code",
            "scope" => "openid email profile",
            "prompt" => "consent"
        ];

        $url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query($data);
        header("Location: $url");
        exit();
    }

    public function callback()
    {
        session_start();
        require "config/koneksi.php";

        $userModel = new UserModel($conn);

        // ---------- Ambil TOKEN ----------
        $curl = curl_init("https://oauth2.googleapis.com/token");

        $data = [
            "client_id" => $_ENV['google_client_id'],
            "client_secret" => $_ENV["google_client_secret"],
            "code" => $_GET['code'],
            "grant_type" => "authorization_code",
            "redirect_uri" => "http://localhost/paw_studycase/google/callback"
        ];

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $token_response = curl_exec($curl);
        curl_close($curl);

        $token = json_decode($token_response, true);


        // ---------- Ambil DATA USER ----------
        $curl = curl_init("https://www.googleapis.com/oauth2/v3/userinfo");

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $token["access_token"]
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $userinfo = curl_exec($curl);
        curl_close($curl);

        $user = json_decode($userinfo, true);

        // ---------- Data Google ----------
        $google_id = $user["sub"];
        $nama      = $user["name"];
        $foto      = $user["picture"];

        // ---------- Cek User di DB ----------
        $userData = $userModel->findById($google_id);

        if (!$userData) {
            // user baru → insert
            $userModel->createUser($google_id, $nama);

            // ambil ulang data user
            $userData = $userModel->findById($google_id);
        }

        // ---------- Simpan ke Session ----------
        $_SESSION['userdata'] = [
            "id"      => $userData["id"],
            "profile" => $foto,
            "nama"    => $userData["nama"]
        ];

        // ---------- Jika data belum lengkap ----------
        if (empty($userData["no_telepon"]) || empty($userData["alamat"])) {
            header("Location: /paw_studycase/google/user-profile");
            exit();
        }

        // ---------- Jika lengkap → dashboard ----------
        header("Location: /paw_studycase/dashboard");
        exit();
    }

    public function userProfile()
    {
        $this->view("user-profile");
    }

    public function userProfileSave()
    {
        session_start();
        require "config/koneksi.php";

        $userModel = new UserModel($conn);

        $id = $_SESSION['userdata']['id'];
        $no_telepon = $_POST['no_telepon'];
        $alamat = $_POST['alamat'];

        // update via model
        $userModel->updateProfile($id, $no_telepon, $alamat);

        // update session
        $_SESSION['userdata']['no_telepon'] = $no_telepon;
        $_SESSION['userdata']['alamat'] = $alamat;

        header("Location: /paw_studycase/dashboard");
        exit();
    }
}
