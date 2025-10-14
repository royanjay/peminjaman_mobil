<?php
include '../config/config.php';
if (!isset($_GET['id_mobil'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id_mobil'];
$query = mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil='$id'");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "<script>alert('Mobil tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Mobil | <?php echo $data['nama_mobil']; ?></title>
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
    <div class="row">
        <div class="col-md-6">
            <img src="../assets/img/upload/<?php echo $data['gambar']; ?>" class="img-fluid rounded shadow"
                 onerror="this.src='../assets/img/car-placeholder.jpg'">
        </div>
        <div class="col-md-6">
            <h2><?php echo $data['nama_mobil']; ?></h2>
            <p><strong>Plat Nomor:</strong> <?php echo $data['plat_nomor']; ?></p>
            <p><strong>Harga Sewa:</strong> Rp<?php echo number_format($data['harga_sewa']); ?>/hari</p>
            <p><strong>Status:</strong> <?php echo ucfirst($data['status']); ?></p>
            <?php if ($data['status'] == 'tersedia') { ?>
                <a href="pesan.php?id_mobil=<?php echo $data['id_mobil']; ?>" class="btn btn-success mt-3">Sewa Sekarang</a>
            <?php } else { ?>
                <button class="btn btn-secondary mt-3" disabled>Sudah Disewa</button>
            <?php } ?>
        </div>
    </div>
</div>

<footer class="text-center p-3 bg-dark text-white mt-4">
    &copy; <?php echo date('Y'); ?> Rental Mobil. All rights reserved.
</footer>

</body>
</html>
