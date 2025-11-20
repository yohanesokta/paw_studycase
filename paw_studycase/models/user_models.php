<?php

class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function findById($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function createUser($id, $nama,$email,$foto)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $email = mysqli_real_escape_string($this->conn, $email);


        $sql = "INSERT INTO user (id, nama, email, profile, role)
                VALUES ('$id', '$nama', '$email', '$foto', 'pelanggan')";
        return mysqli_query($this->conn, $sql);
    }

    public function updateProfile($id, $telp, $alamat)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $telp = mysqli_real_escape_string($this->conn, $telp);
        $alamat = mysqli_real_escape_string($this->conn, $alamat);

        $sql = "UPDATE user SET no_telepon='$telp', alamat='$alamat'
                WHERE id='$id'";

        return mysqli_query($this->conn, $sql);
    }
}
