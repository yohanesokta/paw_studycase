<?php

class adminController extends Controllers {
    public function dashboard() {
        $this->view('admin/dashboard');
    }
    public function pesanan() {
        $this->view('admin/pesanan');
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