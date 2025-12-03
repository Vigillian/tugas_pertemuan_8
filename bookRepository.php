<?php
class BookRepository
{
    private PDO $db;
    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }
public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM buku ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
