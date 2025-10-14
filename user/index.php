<?php
include '../config/config.php'; // koneksi ke database
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mobil | Sewa Mobil</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Rental Mobil</a>
  </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center mb-4">Daftar Mobil Tersedia</h2>
    <div class="row">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM mobil WHERE status='tersedia'");
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="../assets/img/upload/<?php echo $data['gambar']; ?>" class="card-img-top" alt="Mobil"
                     onerror="this.src='../assets/img/car-placeholder.jpg'">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['nama_mobil']; ?></h5>
                    <p class="card-text">Harga Sewa: Rp<?php echo number_format($data['harga_sewa']); ?>/hari</p>
                    <a href="detail.php?id_mobil=<?php echo $data['id_mobil']; ?>" class="btn btn-primary w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<footer class="text-center p-3 bg-dark text-white mt-4">
    &copy; <?php echo date('Y'); ?> Rental Mobil. All rights reserved.
</footer>

</body>
</html>
