<?php
include '../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama gambar dulu
    $query = mysqli_query($conn, "SELECT gambar FROM mobil WHERE id_mobil='$id'");
    $row = mysqli_fetch_assoc($query);

    // Hapus gambar fisik
    if ($row && file_exists("../assets/img/upload/" . $row['gambar'])) {
        unlink("../assets/img/upload/" . $row['gambar']);
    }

    // Hapus data dari database
    mysqli_query($conn, "DELETE FROM mobil WHERE id_mobil='$id'");

    echo "<script>alert('Data mobil berhasil dihapus'); window.location='mobil.php';</script>";
}
?>
