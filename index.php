<?php
$repo = new BookRepository($pdo);
$buku = $repo->getAll();
?>
<html>
<head>
    <title>Daftar Buku</title>
</head>
