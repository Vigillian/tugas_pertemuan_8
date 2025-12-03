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
public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM buku WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }
 public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO buku (judul, penulis, tahun_terbit, kategori, cover, status)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['judulbuku'],
            $data['penulis'],
            $data['tahun_terbit'],
            $data['kategori'],
            $data['coverbuku'],
            $data['status']
        ]);
    }
public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE buku 
            SET judul = ?, penulis = ?, tahun_terbit = ?, kategori = ?, cover = ?, status = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['judulbuku'],
            $data['penulis'],
            $data['tahun_terbit'],
            $data['kategori'],
            $data['coverbuku'],
            $data['status'],
            $id
        ]);
    }
 public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM buku WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
