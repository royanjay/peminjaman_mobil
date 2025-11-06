<?php
include '../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama gambar dulu
    $query = mysqli_query($conn, "SELECT gambar FROM mobil WHERE id_mobil='$id'");
    $row = mysqli_fetch_assoc($query);

    if ($row) {
        // Hapus gambar fisik
        $gambarPath = "../assets/img/upload/" . $row['gambar'];
        if (file_exists($gambarPath) && is_file($gambarPath)) {
            unlink($gambarPath);
        }

        // Hapus data peminjaman terkait supaya tidak terjadi error foreign key
        mysqli_query($conn, "DELETE FROM peminjaman WHERE id_mobil='$id'");

        // Hapus data mobil
        mysqli_query($conn, "DELETE FROM mobil WHERE id_mobil='$id'");

        echo "<script>alert('Data mobil berhasil dihapus'); window.location='mobil.php';</script>";
        exit;
    } else {
        echo "<script>alert('Mobil tidak ditemukan'); window.location='mobil.php';</script>";
        exit;
    }
}
?>
