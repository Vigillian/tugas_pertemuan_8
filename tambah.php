<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun_terbit'];
    $kategori = $_POST['kategori'];
    $cover = $_FILES['cover'];
 if ($cover['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 2 * 1024 * 1024;
        if (!in_array($cover['type'], $allowedTypes)) {
            echo "Tipe file tidak didukung.";
            exit;
        }
        if ($cover['size'] > $maxSize) {
            echo "Ukuran file terlalu besar.";
            exit;
        }
        $fileName = time() . "_" . $cover['name'];
        $uploadPath = "../uploads/" . $fileName;
        move_uploaded_file($cover['tmp_name'], $uploadPath);
        $stmt = $pdo->prepare("
            INSERT INTO buku (judul, penulis, tahun_terbit, kategori, cover, status)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
