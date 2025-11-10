<?php
require "lib/controllers.php";

class MainController extends Controllers {
    public function index() {
        $this->view("main");
    }
}