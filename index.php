<?php
$repo = new BookRepository($pdo);
$buku = $repo->getAll();
?>
