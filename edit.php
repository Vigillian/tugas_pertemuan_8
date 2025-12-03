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
?>
<html>
<head>
    <title>Edit Buku</title>
</head>
<body>

<h1>Edit Buku</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <label>Judul:</label><br>
    <input type="text" name="judul" value="<?= $data['judul'] ?>" required><br><br>
    <label>Penulis:</label><br>
    <input type="text" name="penulis" value="<?= $data['penulis'] ?>" required><br><br>
    <label>Tahun Terbit:</label><br>
    <input type="number" name="tahun_terbit" value="<?= $data['tahun_terbit'] ?>" required><br><br>
    <label>Kategori:</label><br>
    <input type="text" name="kategori" value="<?= $data['kategori'] ?>" required><br><br>
    <label>Status:</label><br>
<select name="status" required>
        <option value="tersedia" <?= $data['status'] == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
        <option value="habis" <?= $data['status'] == 'habis' ? 'selected' : '' ?>>Habis</option>
    </select>
    <br><br>
    <label>Cover Buku (opsional):</label><br>
    <img src="../uploads/<?= $data['cover'] ?>" width="120"><br><br>
    <input type="file" name="cover" accept="image/*"><br><br>
    <button type="submit">Update</button>
</form>
<br>
<a href="index.php">← Kembali</a>
</body>
</html>
