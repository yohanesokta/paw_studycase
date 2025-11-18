<?php
require_once  "lib/routes.php";
$Route = new Routes();

$Route->GET("/" , "MainController@index");

$Route->JalankanRouting();