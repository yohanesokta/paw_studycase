<?php
require_once  "lib/routes.php";
$Route = new Routes();

$Route->GET("/", "MainController@index");

// routing autentikasi
$Route->GET("/google", "authController@login");
$Route->GET("/google/callback", "authController@callback");
$Route->GET("/google/user-profile", "authController@userProfile");
$Route->POST("/google/user-profile/save", "authController@userProfileSave");


// $Route->GET("/admin","MainController@index","user"); contoh penggunaan middleware
$Route->GET("/user/dashboard", "userController@index", "pelanggan");
$Route->POST("/user/pesanan", "userController@pesanan", "pelanggan");

$Route->GET("/admin/dashboard","adminController@dashboard");
$Route->GET("/admin/pesanan","adminController@pesanan");
$Route->GET("/admin/harga","adminController@harga");
$Route->GET("/admin/pelanggan","adminController@pelanggan");
$Route->GET("/admin/laporan","adminController@laporan");
$Route->GET("/logout","authController@logout");
$Route->GET("/cek","authController@cek");



$Route->JalankanRouting();
