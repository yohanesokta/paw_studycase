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
        $SELECT = ($id) ? " WHERE p.id='$id'" : "";

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
                c.estimate,
                t.status AS status_bayar

                FROM pesanan p
                JOIN user u ON p.id_user = u.id
                JOIN cucian c ON p.id_cucian = c.id
                LEFT JOIN transaksi t ON p.id = t.id_pesanan
                $SELECT";

        $result = $this->db->query($SQL);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateBerat($id, $berat)
    {
        try {
            // Ambil harga per kilogram
            $hargaData = $this->getPesanan($id);
            $harga = intval($hargaData[0]["harga_perkg"]) * floatval($berat);

            $SQL = "UPDATE pesanan SET berat=?, harga=?, verifed=1 WHERE id=?";
            $stmt = $this->db->prepare($SQL);
            $stmt->bind_param("ddi", $berat, $harga, $id);
            $stmt->execute();
            $id_user = $hargaData[0]['id_user'];
            $id_admin = $_SESSION['userdata']['id'];
            $SQL_TRANSAKSI = "INSERT INTO transaksi (berat, harga, id_user, id_pesanan, id_admin, status) VALUES ('$berat', '$harga' , '$id_user', $id, '$id_admin','belum_dibayar')";
            $this->db->query($SQL_TRANSAKSI);
        } catch (Exception $e) {
            die($e);
        }
    }


    public function updatePesanan($id, $status_order, $status_bayar)
    {
        try {
            // update status pesanan
            $SQL = "UPDATE pesanan SET status=? WHERE id=?";
            $stmt = $this->db->prepare($SQL);
            $stmt->bind_param("si", $status_order, $id);
            $stmt->execute();
            $status = ($status_bayar == '1') ? "belum_dibayar" : "dibayar";
            $SQL_TRANSAKSI = "UPDATE transaksi SET status='$status' WHERE id_pesanan='$id'";
            $this->db->query($SQL_TRANSAKSI);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    /* ------------------ PELANGGAN ------------------ */

    public function getPelanggan()
    {
        $SQL = "SELECT id, nama, email, no_telepon, alamat, role 
                FROM user 
                WHERE role='pelanggan'";

        $result = $this->db->query($SQL);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPelangganById($id)
    {
        $SQL = "SELECT id, nama, email, no_telepon, alamat, role 
                FROM user WHERE id=?";

        $stmt = $this->db->prepare($SQL);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function updatePelanggan($id, $nama, $email, $telp, $alamat)
    {
        $SQL = "UPDATE user 
                SET nama=?, email=?, no_telepon=?, alamat=? 
                WHERE id=?";
        $stmt = $this->db->prepare($SQL);
        $stmt->bind_param("sssss", $nama, $email, $telp, $alamat, $id);
        return $stmt->execute();
    }

    public function deletePelanggan($id)
    {
        $SQL = "DELETE FROM user WHERE id=?";
        $stmt = $this->db->prepare($SQL);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function countOrderMasuk()
    {
        $sql = "SELECT COUNT(*) AS total FROM pesanan";
        return $this->db->query($sql)->fetch_assoc()['total'];
    }

    public function totalPendapatan()
    {
        $sql = "SELECT SUM(harga) AS total 
            FROM transaksi 
            WHERE status = 'dibayar'";

        return $this->db->query($sql)->fetch_assoc()['total'] ?? 0;
    }

    public function countPerluVerifikasi()
    {
        $sql = "SELECT COUNT(*) AS total 
            FROM pesanan 
            WHERE status = 'pending'";

        return $this->db->query($sql)->fetch_assoc()['total'];
    }

    public function countOrderBelumSelesai()
    {
        $sql = "SELECT COUNT(*) AS total 
            FROM pesanan
            WHERE status IN ('belum_diambil', 'pending')
            AND DATEDIFF(NOW(), tanggal) > 3";

        return $this->db->query($sql)->fetch_assoc()['total'];
    }


    // FORMAT TANGGAL PADA KOLOM TRANSAKSI DIUBAH JADI FORMAT TAHUN
    public function getTahunTransaksi()
    {
        $sql = "SELECT DISTINCT YEAR(tanggal) AS tahun
                FROM transaksi
                ORDER BY tahun DESC";

        $result = $this->db->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row['tahun'];
        }
        return $data;
    }

    // LAPORAN PENGHASILAN UNTUK TABEL
    public function getLaporanBulananByTahun($tahun)
    {
        $sql = "SELECT 
                    DATE_FORMAT(tanggal, '%M') AS bulan,
                    COUNT(id_user) AS jumlah_transaksi,
                    SUM(CASE WHEN status='dibayar' THEN harga ELSE 0 END) AS terbayar,
                    SUM(CASE WHEN status='belum_dibayar' THEN harga ELSE 0 END) AS piutang,
                    SUM(harga) AS total_omset
                FROM transaksi
                WHERE YEAR(tanggal) = '$tahun'
                GROUP BY MONTH(tanggal)
                ORDER BY MONTH(tanggal) ASC";

        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // LAPORAN PELANGGAN UNTUK DIAGRAM
    public function getLaporanHarianByTahun($tahun)
    {
        $sql = "SELECT 
        DATE_FORMAT(tanggal, '%M') AS bulan, COUNT(id_user) AS total 
        FROM transaksi WHERE YEAR(tanggal) = '$tahun' 
        GROUP BY tanggal 
        ORDER BY tanggal ASC";

        $result = $this->db->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function getOrderBelumSelesai()
    {
        $sql = "SELECT 
                p.id AS id_pesanan,
                p.tanggal,
                p.status,
                p.berat,
                p.harga,
                DATEDIFF(NOW(), p.tanggal) AS lama_hari,

                u.nama AS nama_user,
                u.no_telepon,
                u.id AS id_user,

                c.nama AS nama_cucian
            FROM pesanan p
            JOIN user u ON p.id_user = u.id
            JOIN cucian c ON p.id_cucian = c.id
            WHERE p.status IN ('belum_diambil', 'pending')
            HAVING lama_hari > 3
            ORDER BY p.tanggal ASC";

        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}