<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/BookRepository.php';
$repo = new BookRepository($pdo);
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}
$id = (int) $_GET['id'];
$data = $repo->getById($id);
if (!$data) {
    die("Data buku tidak ditemukan.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun_terbit'];
    $kategori = $_POST['kategori'];
    $status = $_POST['status'];
    $coverName = $data['cover']; 
}
 if (!empty($_FILES['cover']['name'])) {
        $cover = $_FILES['cover'];
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 2 * 1024 * 1024;
        if (!in_array($cover['type'], $allowedTypes)) {
        echo "Tipe file tidak valid.";
        exit;
        if ($cover['size'] > $maxSize) {
        echo "File terlalu besar.";
        exit;
        }
$newName = time() . "_" . $cover['name'];
    $uploadPath = "../uploads/" . $newName;
    move_uploaded_file($cover['tmp_name'], $uploadPath);
  $repo->update($id, [ 
        "judul" => $judul,
        "penulis" => $penulis,
        "tahun_terbit" => $tahun,
        "kategori" => $kategori,
        "cover" => $coverName,
        "status" => $status
    ]);
 header("Location: index.php");
    exit;
}
