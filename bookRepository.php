<?php
class BookRepository
{
    private PDO $db;
    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }
