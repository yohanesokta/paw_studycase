<?php
require "models/admin_models.php";

class adminController extends Controllers
{

    private $adminModels;

    public function __construct()
    {
        $this->adminModels = new AdminModels();
    }

    public function dashboard()
    {
        $orderMasuk      = $this->adminModels->countOrderMasuk();
        $pendapatan      = $this->adminModels->totalPendapatan();
        $verifikasi      = $this->adminModels->countPerluVerifikasi();
        $belumSelesai    = $this->adminModels->countOrderBelumSelesai();

        $this->view('admin/dashboard', [
            'orderMasuk'   => $orderMasuk,
            'pendapatan'   => $pendapatan,
            'verifikasi'   => $verifikasi,
            'belumSelesai' => $belumSelesai
        ]);
    }

    public function pesanan()
    {
        $data = $this->adminModels->getPesanan();
        $this->view('admin/pesanan', ['data' => $data]);
    }

    public function updateBerat()
    {
        $id = $_POST['id_pesanan'];
        $berat = $_POST['berat'];

        if (empty($berat) || empty($id)) {
            die('Empty Parameters Error 402');
        }

        $this->adminModels->updateBerat($id, $berat);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Berat pesanan berhasil diperbarui!'
        ];

        Redirect("/admin/pesanan");
    }

    public function updatePesanan()
    {
        $id = $_POST['id_pesanan'];
        $status_order = $_POST['status_order'];
        $status_bayar = $_POST['status_bayar'];

        if (empty($status_order) || empty($id) || empty($status_bayar)) {
            die('Empty Parameters Error 402');
        }

        $this->adminModels->updatePesanan($id, $status_order, $status_bayar);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Status pesanan berhasil diperbarui!'
        ];

        Redirect("/admin/pesanan");
    }

    // Pelanggan methods

    public function pelanggan()
    {
        $data = $this->adminModels->getPelanggan();
        $this->view('admin/pelanggan', ['data' => $data]);
    }

    public function updatePelanggan()
    {
        $id     = $_POST['id'] ?? null;
        $nama   = $_POST['nama'] ?? null;
        $email  = $_POST['email'] ?? null;
        $telp   = $_POST['no_telepon'] ?? null;
        $alamat = $_POST['alamat'] ?? null;

        if (!$id || !$nama || !$email || !$telp || !$alamat) {
            die("Empty Parameters Error 402");
        }

        $this->adminModels->updatePelanggan($id, $nama, $email, $telp, $alamat);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Pelanggan berhasil diperbarui!'
        ];

        Redirect("/admin/pelanggan");
    }

    public function hapusPelanggan()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            die("Empty Parameters Error 402");
        }

        $this->adminModels->deletePelanggan($id);

        $_SESSION['flash'] = [
            'type' => 'danger',
            'message' => 'Pelanggan berhasil dihapus!'
        ];

        Redirect("/admin/pelanggan");
    }

    // LAPORAN PENGHASILAN & PELANGGAN
    public function laporan()
    {
        $tahunDipilih = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

        // DAFTAR TAHUN
        $tahunList = $this->adminModels->getTahunTransaksi();

        // LAPORAN PENGHASILAN (TABEL)
        $laporanBulanan = $this->adminModels->getLaporanBulananByTahun($tahunDipilih);

        // LAPORAN PELANGGAN (DIAGRAM)
        $rows = $this->adminModels->getLaporanHarianByTahun($tahunDipilih);

        $labels = [];
        $values = [];

        foreach ($rows as $r) {
            $labels[] = $r['bulan'];
            $values[] = $r['total'];
        }

        // ini untuk bagian tab order belum selesai
        $pesananBelumDiambil = $this->adminModels->getOrderBelumSelesai();

        $this->view('admin/laporan', [
            'tahunList' => $tahunList,
            'tahunDipilih' => $tahunDipilih,
            'laporanBulanan' => $laporanBulanan,
            'labels' => $labels,
            'values' => $values,
            'dataPending' => $pesananBelumDiambil
        ]);
    }

    public function exportExcel()
    {
        $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

        // MEMANGGIL MODEL YANG DIPERLUKAN
        $laporanBulanan = $this->adminModels->getLaporanBulananByTahun($tahun);
        $laporanHarian = $this->adminModels->getLaporanHarianByTahun($tahun);

        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=laporan_$tahun.xls");

        // TABEL PEMASUKAN BULAN
        $total_trans = $total_terbayar = $total_piutang = $total_omset = 0;

        echo "<h3>Pemasukan Bulanan Tahun $tahun</h3>";
        echo "<table border='1'>";
        echo "<thead>
                <tr>
                    <th>Bulan</th>
                    <th>Jml Transaksi</th>
                    <th>Terbayar</th>
                    <th>Belum Dibayar (Piutang)</th>
                    <th>Total Omset</th>
                </tr>
            </thead>";
        echo "<tbody>";

        foreach ($laporanBulanan as $row) {
            $total_trans += $row['jumlah_transaksi'];
            $total_terbayar += $row['terbayar'];
            $total_piutang += $row['piutang'];
            $total_omset += $row['total_omset'];

            echo "<tr>
                    <td>{$row['bulan']}</td>
                    <td>{$row['jumlah_transaksi']}</td>
                    <td>Rp " . number_format($row['terbayar'],0,',','.') . "</td>
                    <td>Rp " . number_format($row['piutang'],0,',','.') . "</td>
                    <td>Rp " . number_format($row['total_omset'],0,',','.') . "</td>
                </tr>";
        }

        echo "</tbody>";
        echo "<tfoot>
                <tr>
                    <td>TOTAL TAHUN INI</td>
                    <td>$total_trans</td>
                    <td>Rp " . number_format($total_terbayar,0,',','.') . "</td>
                    <td>Rp " . number_format($total_piutang,0,',','.') . "</td>
                    <td>Rp " . number_format($total_omset,0,',','.') . "</td>
                </tr>
            </tfoot>";
        echo "</table><br><br>";

        // TABEL LAPORAN PELANGGAN
        $laporanPelangganPerBulan = [];
        foreach ($laporanHarian as $row) {
            $bulan = $row['bulan'];
            if (!isset($laporanPelangganPerBulan[$bulan])) {
                $laporanPelangganPerBulan[$bulan] = 0;
            }
            $laporanPelangganPerBulan[$bulan] += $row['total'];
        }

        $labels = array_keys($laporanPelangganPerBulan);
        $values = array_values($laporanPelangganPerBulan);

        echo "<h3>Tabel Laporan Pelanggan Tahun $tahun</h3>";
        echo "<table border='1'>";
        echo "<thead>
                <tr>
                    <th>Bulan</th>
                    <th>Jumlah Pelanggan</th>
                </tr>
            </thead>";
        echo "<tbody>";

        foreach ($labels as $i => $label) {
            $value = $values[$i];
            echo "<tr>
                    <td>$label</td>
                    <td>$value</td>
                </tr>";
        }

        echo "</tbody>";
        echo "</table>";

        exit;
    }


    
    public function masterharga() 
    {
        $this->view('admin/masterharga');
    }

}


