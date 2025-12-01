<?php
require "models/admin_models.php";


class adminController extends Controllers {
    private $adminModels;
  
    public function __construct()
    {
       $this->adminModels = new AdminModels();

    }
    public function dashboard() {
        $this->view('admin/dashboard');
    }
    public function pesanan() {
        $data = $this->adminModels->getPesanan();

        $this->view('admin/pesanan',['data'=> $data]);
    }
    public function updateBerat() { 
        $id = $_POST['id_pesanan'];
        $berat = $_POST['berat'];
        if (empty($berat) || empty($id)) { 
            die('Empty Paramaters Error 402');
        }
        $this->adminModels->updateBerat($id,$berat);
        Redirect("/admin/pesanan");
    }

     public function updatePesanan() { 
        $id = $_POST['id_pesanan'];
        $status_order = $_POST['status_order'];
        $status_bayar = $_POST['status_bayar']; 
        if (empty($status_order) || empty($id) || empty($status_bayar)) { 
            die('Empty Paramaters Error 402');
        }
        $this->adminModels->updatePesanan($id,$status_order,$status_bayar);
        Redirect("/admin/pesanan");
    }
    public function harga() {
        $this->view('admin/harga');
    }
     public function pelanggan() {
        $this->view('admin/pelanggan');
    }
     public function laporan() {
        $this->view('admin/laporan');
    }
     public function masterharga() {
        $this->view('admin/masterharga');
    }
}