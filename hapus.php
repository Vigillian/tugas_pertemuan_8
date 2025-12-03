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
?>
<html>
<head>
    <title>Konfirmasi Hapus</title>
</head>
<body>
<h1>Apakah kamu yakin ingin menghapus buku ini?</h1>
<p><strong><?= $data['judul']; ?></strong></p>
<p>Penulis: <?= $data['penulis']; ?></p>
<br>
<a href="hapus.php?id=<?= $id ?>&confirm=yes">Ya, hapus</a> |
<a href="index.php">Batal</a>
</body>
</html>
