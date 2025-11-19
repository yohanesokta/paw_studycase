<?php
function URL($url) {
    return $_ENV['proyekname'].$url;
}
function Redirect($url) {
    header("Location: ".URL($url));
    exit;
}


class Controllers {
    public function view($view) {
        require "views/$view.php";
    }
}