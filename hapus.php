<?php
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
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
 $repo->delete($id);
 // opsional hapus file cover
    $filePath = "../uploads/" . $data['cover'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    header("Location: index.php");
    exit;
}
