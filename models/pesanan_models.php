<?php

class PesananModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllCucian()
    {
        $sql = "SELECT * FROM cucian ORDER BY nama ASC";
        $result = mysqli_query($this->conn, $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function findCucianById($id)
    {
        $id = intval($id);
        $sql = "SELECT * FROM cucian WHERE id = $id LIMIT 1";
        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_assoc($result);
    }

    public function createPesanan($id_user, $id_cucian, $berat, $harga)
    {
        $id_user = mysqli_real_escape_string($this->conn, $id_user);
        $id_cucian = intval($id_cucian);
        $berat = $berat !== null ? floatval($berat) : "NULL";
        $harga = $harga !== null ? intval($harga) : "NULL";

        $sql = "INSERT INTO pesanan (berat, harga, id_cucian, id_user, status)
                VALUES ($berat, $harga, $id_cucian, '$id_user', 'pending')";

        return mysqli_query($this->conn, $sql);
    }

    public function getPesananByUser($id_user)
    {
        $id_user = mysqli_real_escape_string($this->conn, $id_user);

        $sql = "SELECT p.*, c.nama AS nama_layanan, c.harga AS harga_perkg
            FROM pesanan p
            JOIN cucian c ON p.id_cucian = c.id
            WHERE p.id_user = '$id_user'
            ORDER BY p.id DESC";

        $result = mysqli_query($this->conn, $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
