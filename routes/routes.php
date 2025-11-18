<?php
require_once  "lib/routes.php";
$Route = new Routes();

$Route->GET("/", "MainController@index");

$Route->GET("/auth/google", "GoogleController@redirect");
$Route->GET("/auth/google/callback", "GoogleController@callback");


$Route->GET("/google", "authController@login");
$Route->GET("/google/callback", "authController@callback");

$Route->JalankanRouting();
