<?php
$host = 'localhost';
$dbname = 'crud_buku' ;
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=localhost;dbname=crud_buku;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
