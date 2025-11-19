<?php
require_once  "lib/routes.php";
$Route = new Routes();

$Route->GET("/", "MainController@index");

// routing autentikasi
$Route->GET("/google", "authController@login");
$Route->GET("/google/callback", "authController@callback");
$Route->GET("/google/user-profile", "authController@userProfile");
$Route->POST("/google/user-profile/save", "authController@userProfileSave");


$Route->JalankanRouting();
