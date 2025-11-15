<?php
$_ENV['proyekname'] = "paw_studycase";

if (!isset($_ENV['production'])) { 
    $_ENV['production'] = false;
    require "env.php";
}

require_once "routes/routes.php";