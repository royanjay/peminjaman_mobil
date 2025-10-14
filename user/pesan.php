<?php
include '../config/config.php';

if (!isset($_GET['id_mobil'])) {
    header("Location: index.php");
    exit;
}

$id_mobil = $_GET['id_mobil'];
$query = mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil='$id_mobil'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_penyewa'];
    $telepon = $_POST['no_telp'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    // Simpan ke tabel peminjaman
    $insert = mysqli_query($conn, "INSERT INTO peminjaman (id_mobil, nama_penyewa, no_telp, tgl_pinjam, tgl_kembali, status_pinjam)
                                   VALUES ('$id_mobil', '$nama', '$telepon', '$tgl_pinjam', '$tgl_kembali', 'dipinjam')");

    // Ubah status mobil jadi disewa
    if ($insert) {
        mysqli_query($conn, "UPDATE mobil SET status='disewa' WHERE id_mobil='$id_mobil'");
        echo "<script>alert('Pemesanan berhasil!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memesan.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Mobil | <?php echo $data['nama_mobil']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Rental Mobil</a>
  </div>
</nav>

<div class="container mt-5">
    <h3 class="mb-4">Form Pemesanan Mobil</h3>

    <div class="card p-4 shadow-sm">
        <h5>Mobil: <?php echo $data['nama_mobil']; ?></h5>
        <form method="POST">
            <div class="mb-3">
                <label>Nama Penyewa</label>
                <input type="text" name="nama_penyewa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nomor Telepon</label>
                <input type="text" name="no_telp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success w-100">Pesan Sekarang</button>
        </form>
    </div>
</div>

<footer class="text-center p-3 bg-dark text-white mt-4">
    &copy; <?php echo date('Y'); ?> Rental Mobil. All rights reserved.
</footer>

</body>
</html>
