<?php

class Controllers {
    public function view($view) {
        require "views/$view.php";
    }
}