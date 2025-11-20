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
        $data = $this->adminModels->getPesananAll();

        $this->view('admin/pesanan',['data'=> $data]);
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
}