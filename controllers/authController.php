<?php

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
        $token_url = "https://oauth2.googleapis.com/token";
        $userinfo_url = "https://www.googleapis.com/oauth2/v3/userinfo";

        $curl = curl_init($token_url);
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
        if (!$_ENV['production']) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $response = curl_exec($curl);
        curl_close($curl);
        $token = json_decode($response, true);


        $curl = curl_init($userinfo_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $token["access_token"]
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
    }
}
