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
