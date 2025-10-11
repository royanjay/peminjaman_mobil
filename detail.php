<?php
include 'config/config.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil='$id'");
$mobil = mysqli_fetch_assoc($data);
if (!$mobil) {
    echo "<script>alert('Mobil tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Mobil - <?= htmlspecialchars($mobil['nama_mobil']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f5f7fa; padding: 40px; }
        .detail-container { max-width: 800px; margin: auto; background: white; border-radius: 10px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        img { width: 100%; border-radius: 10px; margin-bottom: 20px; }
        h2 { color: #2563eb; margin-bottom: 10px; }
        p { margin: 5px 0; color: #555; }
        .buttons { margin-top: 20px; display: flex; gap: 15px; }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
        .btn-sewa { background: #2563eb; color: white; }
        .btn-batal { background: #dc3545; color: white; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
<div class="detail-container">
    <img src="assets/img/upload/<?= htmlspecialchars($mobil['gambar']) ?>" alt="<?= htmlspecialchars($mobil['nama_mobil']) ?>">
    <h2><?= htmlspecialchars($mobil['nama_mobil']) ?></h2>
    <p><strong>Merk:</strong> <?= htmlspecialchars($mobil['merk']) ?></p>
    <p><strong>Tahun:</strong> <?= htmlspecialchars($mobil['tahun']) ?></p>
    <p><strong>Bahan Bakar:</strong> <?= htmlspecialchars($mobil['bahan_bakar']) ?></p>
    <p><strong>Transmisi:</strong> <?= htmlspecialchars($mobil['transmisi']) ?></p>
    <p><strong>Kapasitas:</strong> <?= htmlspecialchars($mobil['kapasitas']) ?> Orang</p>
    <p><strong>Harga per Hari:</strong> Rp <?= number_format($mobil['harga_per_hari'], 0, ',', '.') ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($mobil['status']) ?></p>

    <div class="buttons">
        <a href="form_sewa.php?id=<?= $mobil['id_mobil'] ?>" class="btn btn-sewa">Sewa Sekarang</a>
        <a href="index.php" class="btn btn-batal">Batal</a>
    </div>
</div>
</body>
</html>
