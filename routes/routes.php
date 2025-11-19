<?php
require_once  "lib/routes.php";
$Route = new Routes();

$Route->GET("/", "MainController@index");

$Route->GET("/google", "authController@login");
$Route->GET("/google/callback", "authController@callback");

$Route->JalankanRouting();
