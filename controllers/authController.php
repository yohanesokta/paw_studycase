<?php
require_once "models/user_models.php";

class authController extends Controllers
{
    public function login()
    {
        $data = [
            "client_id" => $_ENV['google_client_id'],
            "redirect_uri" => $_ENV['rederict_url'],
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

        $userModel = new UserModel($GLOBALS['connection']);

        $curl = curl_init("https://oauth2.googleapis.com/token");

        $data = [
            "client_id" => $_ENV['google_client_id'],
            "client_secret" => $_ENV["google_client_secret"],
            "code" => $_GET['code'],
            "grant_type" => "authorization_code",
            "redirect_uri" => $_ENV['rederict_url']
        ];

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $token_response = curl_exec($curl);
        curl_close($curl);

        $token = json_decode($token_response, true);


        $curl = curl_init("https://www.googleapis.com/oauth2/v3/userinfo");

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $token["access_token"]
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $userinfo = curl_exec($curl);
        curl_close($curl);

        $user = json_decode($userinfo, true);

        // data google
        $google_id = $user["sub"];
        $nama      = $user["name"];
        $foto      = $user["picture"];
        $email     = $user["email"];

        // cek user di db
        $userData = $userModel->findById($google_id);

        if (!$userData) {
            // user baru, dan insert
            $userModel->createUser($google_id, $nama, $email, $foto);

            // ambil ulang data user
            $userData = $userModel->findById($google_id);
        }

        // simpan ke session
        $_SESSION['userdata'] = [
            "id"      => $userData["id"],
            "profile" => $foto,
            "nama"    => $userData["nama"],

            "role" => $userData["role"],
        ];

        // jika data belum lengkap
        if (empty($userData["no_telepon"]) || empty($userData["alamat"])) {
            Redirect("/google/user-profile");
        }

        if ($userData["role"] == "admin") {
            Redirect("/admin/dashboard");
            exit();
        } else {
            Redirect("/user/dashboard");
            exit();
        }
    }

    public function userProfile()
    {
        $this->view("auth/user-profile");
    }

    public function userProfileSave()
    {
        session_start();

        $userModel = new UserModel($GLOBALS['connection']);

        $id = $_SESSION['userdata']['id'];
        $no_telepon = $_POST['no_telepon'];
        $alamat = $_POST['alamat'];


        $userModel->updateProfile($id, $no_telepon, $alamat);

        $_SESSION['userdata']['no_telepon'] = $no_telepon;
        $_SESSION['userdata']['alamat'] = $alamat;

        Redirect("/user/dashboard");
    }

    public function logout()
    {
        session_start();

        session_unset();
        session_destroy();

        Redirect("/");
    }

    public function cek()
    {
        $this->view("cek");
    }
}
