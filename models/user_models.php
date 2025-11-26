<?php

class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function findByGoogleId($googleId)
    {
        $googleId = mysqli_real_escape_string($this->conn, $googleId);
        $sql = "SELECT * FROM user WHERE google_id = '$googleId'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }


    public function createUserGoogle($googleId, $nama, $email, $foto)
    {
        $googleId = mysqli_real_escape_string($this->conn, $googleId);
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $email = mysqli_real_escape_string($this->conn, $email);
        $foto = mysqli_real_escape_string($this->conn, $foto);

        $sql = "INSERT INTO user (google_id, nama, email, profile, role)
            VALUES ('$googleId', '$nama', '$email', '$foto', 'pelanggan')";

        return mysqli_query($this->conn, $sql);
    }


    public function updateProfile($google_id, $telp, $alamat)
    {
        $google_id = mysqli_real_escape_string($this->conn, $google_id);
        $telp = mysqli_real_escape_string($this->conn, $telp);
        $alamat = mysqli_real_escape_string($this->conn, $alamat);

        $sql = "UPDATE user SET no_telepon='$telp', alamat='$alamat'
                WHERE google_id='$google_id'";

        return mysqli_query($this->conn, $sql);
    }

    public function findByEmail($email)
    {
        $email = mysqli_real_escape_string($this->conn, $email);
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function registerManual($nama, $email, $password, $no_telepon, $alamat)
    {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $email = mysqli_real_escape_string($this->conn, $email);
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $no_telepon = mysqli_real_escape_string($this->conn, $no_telepon);
        $alamat = mysqli_real_escape_string($this->conn, $alamat);


        $sql = "INSERT INTO user (nama, email, password, role, no_telepon, alamat)
            VALUES ('$nama', '$email', '$passwordHash', 'pelanggan', '$no_telepon', '$alamat')";
        return mysqli_query($this->conn, $sql);
    }

    public function loginManual($email, $password)
    {
        $user = $this->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // login berhasil
        }

        return false;
    }
}
