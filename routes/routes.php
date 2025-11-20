<?php
require_once  "lib/routes.php";
$Route = new Routes();

$Route->GET("/", "MainController@index");

$Route->GET("/google", "authController@login");
$Route->GET("/google/callback", "authController@callback");

// $Route->GET("/admin","MainController@index","user"); contoh penggunaan middleware

$Route->GET("/admin/dashboard","adminController@dashboard");
$Route->GET("/admin/pesanan","adminController@pesanan");
$Route->GET("/admin/harga","adminController@harga");
$Route->GET("/admin/pelanggan","adminController@pelanggan");
$Route->GET("/admin/laporan","adminController@laporan");
$Route->GET("/admin/logout","adminController@logout");


$Route->JalankanRouting();
