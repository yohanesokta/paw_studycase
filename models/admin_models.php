<?php

class AdminModels
{
    private $db;
    public function __construct()
    {
        $this->db = DatabaseConnection::getConnection();
    }

    public function getPesanan($id = null)
    {
        $SELECT = ($id) ? " WHERE p.id='$id';" : ";";
        $SQL = "SELECT 
                p.id AS id_pesanan,
                p.tanggal,
                p.berat,
                p.harga,
                p.status,
                p.verifed,

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
                JOIN cucian c ON p.id_cucian = c.id" . $SELECT;

        $result = $this->db->query($SQL);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateBerat($id, $berat) {
        try {
            $harga = $this->getPesanan($id);
            $harga = (int) floatval($harga[0]["harga_perkg"]) * $berat;

            $SQL = "UPDATE pesanan SET berat=?, harga=?, verifed='1' WHERE id=?";
            $SQL = $this->db->prepare($SQL);
            $SQL->bind_param("iii", $berat, $harga, $id);
            $SQL->execute();
        } catch (Exception $e) { 
            die($e->getMessage());
        }
    }

    public function updatePesanan($id, $status_order, $status_bayar) {
        try {
            $SQL = "UPDATE pesanan SET status=?, verifed=? WHERE id=?";
            $SQL = $this->db->prepare($SQL);
            $SQL->bind_param("sii", $status_order, $status_bayar, $id);
            $SQL->execute();
        } catch (Exception $e) { 
            die($e->getMessage());
        }
    }


    public function getPelanggan()
    {
        $SQL = "SELECT id, nama, email, no_telepon, alamat, role FROM user WHERE role='pelanggan'";
        $result = $this->db->query($SQL);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Ambil 1 pelanggan
    public function getPelangganById($id)
    {
        $SQL = "SELECT id, nama, email, no_telepon, alamat, role FROM user WHERE id=?";
        $stmt = $this->db->prepare($SQL);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    // Tambah pelanggan baru
    public function addPelanggan($nama, $email, $telp, $alamat)
    {
        $role = "pelanggan";
        $SQL = "INSERT INTO user (nama, email, no_telepon, alamat, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($SQL);
        $stmt->bind_param("sssss", $nama, $email, $telp, $alamat, $role);
        return $stmt->execute();
    }

    // Hapus pelanggan
    public function deletePelanggan($id)
    {
        $SQL = "DELETE FROM user WHERE id=?";
        $stmt = $this->db->prepare($SQL);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
