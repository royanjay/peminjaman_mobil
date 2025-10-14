-- =====================================================
-- 1. BUAT DATABASE
-- =====================================================
CREATE DATABASE IF NOT EXISTS sewa_mobil;
USE sewa_mobil;

-- =====================================================
-- 2. TABEL ADMIN
-- =====================================================
-- Tabel ini untuk login admin (yang mengatur data di dashboard admin)
CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tambahkan akun admin default
INSERT INTO admin (username, password)
VALUES ('admin', MD5('admin123'));

-- =====================================================
-- 3. TABEL MOBIL
-- =====================================================
-- Menyimpan data mobil yang bisa disewa
CREATE TABLE mobil (
    id_mobil INT AUTO_INCREMENT PRIMARY KEY,
    nama_mobil VARCHAR(100) NOT NULL,
    tahun YEAR NOT NULL,
    kapasitas INT NOT NULL,
    bahan_bakar VARCHAR(50) NOT NULL,
    transmisi VARCHAR(50) NOT NULL,
    harga_per_hari INT NOT NULL,
    gambar VARCHAR(255),
    status ENUM('tersedia','disewa') DEFAULT 'tersedia'
);

-- Contoh data awal mobil
INSERT INTO mobil (nama_mobil, tahun, kapasitas, bahan_bakar, transmisi, harga_per_hari, gambar, status) VALUES
('Toyota Avanza', 2022, 7, 'Bensin', 'Manual', 350000, 'avanza.jpg', 'tersedia'),
('Honda Brio', 2023, 5, 'Bensin', 'Automatic', 300000, 'brio.jpg', 'tersedia'),

-- =====================================================
-- 4. TABEL PEMINJAMAN
-- =====================================================
-- Menyimpan data transaksi penyewaan mobil
CREATE TABLE IF NOT EXISTS peminjaman (
  id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
  id_mobil INT NOT NULL,
  nama_peminjam VARCHAR(100) NOT NULL,
  no_hp VARCHAR(20) NOT NULL,
  tanggal_pinjam DATE NOT NULL,
  tanggal_kembali DATE NOT NULL,
  lama_pinjam INT NOT NULL,
  total_harga INT NOT NULL,
  status ENUM('diproses','disewa','selesai') DEFAULT 'diproses',
  FOREIGN KEY (id_mobil) REFERENCES mobil(id_mobil)
);


-- =====================================================
-- 5. VIEW (opsional)
-- =====================================================
-- View ini untuk menampilkan data peminjaman + nama mobil dan nama peminjam
CREATE VIEW view_peminjaman AS
SELECT 
    p.id_peminjaman,
    pm.nama AS nama_peminjam,
    m.nama_mobil,
    p.tanggal_pinjam,
    p.tanggal_kembali,
    p.lama_pinjam,
    p.total_bayar,
    p.status
FROM peminjaman p
JOIN mobil m ON p.id_mobil = m.id_mobil
JOIN peminjam pm ON p.id_peminjam = pm.id_peminjam;
