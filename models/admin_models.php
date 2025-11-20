<?php

class AdminModels
{
    private $db;
    public function __construct()
    {
        $this->db = DatabaseConnection::getConnection();
    }
    public function getPesananAll()
    {
        $SQL = "SELECT 
                p.id AS id_pesanan,
                p.tanggal,
                p.berat,
                p.harga,
                p.status,

                u.id AS id_user,
                u.nama AS nama_user,
                u.no_telepon,
                u.alamat,
                u.email,

                c.id AS id_cucian,
                c.nama AS nama_cucian,
                c.harga AS harga_perkg,
                c.estimate

                FROM pesanan p
                JOIN user u ON p.id_user = u.id
                JOIN cucian c ON p.id_cucian = c.id;
                ";
        $result = $this->db->query($SQL);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
