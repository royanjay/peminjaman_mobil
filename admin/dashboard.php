<?php include 'header.php'; ?>

<h3>Selamat Datang di Dashboard Admin</h3>
<p>Gunakan menu di atas untuk mengelola data mobil dan peminjaman.</p>

<?php
$jumlahMobil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mobil"))['total'] ?? 0;
$jumlahPinjam = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM peminjaman"))['total'] ?? 0;
$dipinjam = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mobil WHERE status='dipinjam'"))['total'] ?? 0;
?>

<div class="row mt-4">
  <div class="col-md-4">
    <div class="card mb-3">
      <div class="card-body text-center">
        <h4><?= $jumlahMobil ?></h4>
        <p>Jumlah Mobil</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card mb-3">
      <div class="card-body text-center">
        <h4><?= $jumlahPinjam ?></h4>
        <p>Total Peminjaman</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card mb-3">
      <div class="card-body text-center">
        <h4><?= $dipinjam ?></h4>
        <p>Sedang Dipinjam</p>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>