<?php
$HOST = $_ENV['MYSQL_HOST'] ?? "localhost";
$USERNAME = $_ENV["MYSQL_DB_USER"] ?? "root";
$PASSWORD = $_ENV["MYSQL_ROOT_PASSWORD"] ?? "";
$DATABASE = $_ENV["MYSQL_DATABASE"] ?? "";

try {
    $conn =  mysqli_connect($HOST, $USERNAME, $PASSWORD, $DATABASE);
    $GLOBALS['connection'] = $conn;
} catch (Exception $e) {
    die("500 Internal Server Errror <br><br>" . $e->getMessage());
}

class DatabaseConnection{ 
    private static $instance = null;
    public static function getConnection() {
        $HOST = $_ENV['MYSQL_HOST'] ?? "localhost";
        $USERNAME = $_ENV["MYSQL_DB_USER"] ?? "root";
        $PASSWORD = $_ENV["MYSQL_ROOT_PASSWORD"] ?? "";
        $DATABASE = $_ENV["MYSQL_DATABASE"] ?? "";
        try {
            self::$instance = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DATABASE);
        } catch (Exception $e) { 
            die("Koneksi gagal: " . $e->getMessage());
        }
        return self::$instance;
    }
}