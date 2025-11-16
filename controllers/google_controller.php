<?php
class GoogleController extends Controllers
{
    public $GOOGLE_CLIENT_ID;
    public $GOOGLE_CLIENT_SECRET;
    public $REDIRECTED_URI;
    public function __construct()
    {
        $this->GOOGLE_CLIENT_ID = $_ENV['google_client_id'] ?? "";
        $this->GOOGLE_CLIENT_SECRET = $_ENV["google_client_secret"] ?? "";
        $this->REDIRECTED_URI = $_ENV["redirect_uri"] ?? "http://localhost/paw_studycase/auth/google/callback";
    }
    public function redirect()
    {
        $params = http_build_query([
            "client_id" => $this->GOOGLE_CLIENT_ID,
            "redirect_uri" => $this->REDIRECTED_URI,
            "response_type" => "code",
            "scope" => "openid email profile",
            "prompt" => "consent",
        ]);

        header("Location: https://accounts.google.com/o/oauth2/v2/auth?$params");
        exit;
    }
    public function callback()
    {
        if (!isset($_GET["code"])) {
            die("500 Internal Server Error (Mana Boleee Tanpa Code Token)");
        }
        $code = $_GET["code"];
        $token_url = "https://oauth2.googleapis.com/token";
        $userinfo_url = "https://www.googleapis.com/oauth2/v3/userinfo";


        $curl = curl_init($token_url);
        $data = [
            "code" => $code,
            "client_id" => $this->GOOGLE_CLIENT_ID,
            "client_secret" => $this->GOOGLE_CLIENT_SECRET,
            "redirect_uri" => $this->REDIRECTED_URI,
            "grant_type" => "authorization_code"
        ];
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if (!$_ENV['production']) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $response = curl_exec($curl);
        curl_close($curl);
        $token = json_decode($response, true);
        if (!isset($token["access_token"])) {
            die("Gagal dapat akses token");
        }

        $curl = curl_init($userinfo_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $token["access_token"],
        ]);
        if (!$_ENV['production']) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $userinfo = curl_exec($curl);
        curl_close($curl);
        $user = json_decode($userinfo, true);
        var_dump($user);
        var_dump($_SERVER);
    }
}
