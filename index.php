<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/BookRepository.php';
$repo = new BookRepository($pdo);
$buku = $repo->getAll();
?>
<html>
<head>
    <title>Daftar Buku</title>
</head>
    <body>
    <h1>Daftar Buku</h1>
    <a href="tambah.php">Tambah Buku</a>
    <br><br>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($buku as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['penulis'] ?></td>
            <td><?= $row['tahun_terbit'] ?></td>
            <td><?= $row['kategori'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id'] ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
