CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    tahun_terbit INT NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    cover VARCHAR(255) NOT NULL,
    status ENUM('tersedia','habis') NOT NULL DEFAULT 'tersedia'
);

