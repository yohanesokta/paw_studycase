<?php
require_once './lib/routes.php';
require_once './routes/routes.php';   
$Route = new Routes();

$Route->GET("/", "MainController@index");

// routing autentikasi google
$Route->GET("/google", "authController@login");
$Route->GET("/google/callback", "authController@callback");
$Route->GET("/google/user-profile", "authController@userProfile");
$Route->POST("/google/user-profile/save", "authController@userProfileSave");

// routing autentikasi manual
$Route->GET('/auth/login', 'authController@loginManual');
$Route->POST('/auth/login/process', 'authController@loginProcess');
$Route->GET('/auth/register', 'authController@register');
$Route->POST('/auth/register/process', 'authController@registerProcess');



// $Route->GET("/admin","MainController@index","user"); contoh penggunaan middleware

$Route->GET("/admin/dashboard","adminController@dashboard","admin");
$Route->GET("/admin/pesanan","adminController@pesanan",'admin');

$Route->POST('/admin/pesanan','adminController@updateBerat','admin');
$Route->POST('/admin/pesanan/update','adminController@updatePesanan','admin');

$Route->GET("/admin/harga","adminController@harga","admin");
$Route->GET("/admin/pelanggan","adminController@pelanggan", "admin");
$Route->POST("/admin/pelanggan/hapus","adminController@hapusPelanggan","admin");
$Route->GET("/admin/pelanggan/edit","adminController@editPelanggan","admin");
$Route->POST("/admin/pelanggan/update","adminController@updatePelanggan","admin");
$Route->GET("/admin/laporan","adminController@laporan", "admin");
// $Route->GET('/admin/laporan/export', 'adminController@exportExcel', "admin");
$Route->GET("/admin/harga","adminController@harga", "admin");

$Route->GET("/user/dashboard", "userController@index", "pelanggan");
$Route->POST("/user/pesanan", "userController@pesanan", "pelanggan");
$Route->GET('/user/update-profile', 'userController@updateProfile', 'pelanggan');
$Route->POST('/user/update-profile-process', 'userController@updateProfileProcess', 'pelanggan');
// $Route->POST('/auth/register/process', 'authController@registerProcess');

$Route->GET("/logout","authController@logout");
$Route->GET("/cek","authController@cek");


$Route->JalankanRouting();

