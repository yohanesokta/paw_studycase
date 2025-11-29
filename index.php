<?php
if (!isset($_ENV['production'])) { 
    $_ENV['production'] = false;
    $_ENV['proyekname'] = "/paw_studycase";
    require "env.php";
}
require_once "lib/loader.php";
require_once "routes/routes.php";

