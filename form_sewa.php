<?php
include 'config/config.php';
$id_mobil = $_GET['id'];
$mobil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil='$id_mobil'"));

if (isset($_POST['sewa'])) {
    $nama = $_POST['nama_peminjam'];
    $no_hp = $_POST['no_hp'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    $tanggal1 = new DateTime($tgl_pinjam);
    $tanggal2 = new DateTime($tgl_kembali);
    $selisih = $tanggal2->diff($tanggal1)->days;
    if ($selisih == 0) $selisih = 1;

    $total = $mobil['harga_per_hari'] * $selisih;

    $query = "INSERT INTO peminjaman (id_mobil, lama_pinjam, nama_peminjam, no_hp, tanggal_pinjam, tanggal_kembali, total_harga, status)
              VALUES ('$id_mobil', '$selisih', '$nama', '$no_hp', '$tgl_pinjam', '$tgl_kembali', '$total', 'diproses')";
    
    if (mysqli_query($conn, $query)) {
        mysqli_query($conn, "UPDATE mobil SET status='disewa' WHERE id_mobil='$id_mobil'");
        echo "<script>alert('Peminjaman berhasil!');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sewa Mobil - <?= htmlspecialchars($mobil['nama_mobil']) ?></title>
    <style>
        body { background: #f5f7fa; font-family: 'Segoe UI', sans-serif; padding: 40px; }
        form { max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #2563eb; margin-bottom: 20px; }
        label { display: block; margin-top: 10px; color: #333; }
        input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; margin-top: 5px; }
        button { width: 100%; margin-top: 20px; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; }
        a { display: block; text-align: center; margin-top: 10px; color: #dc3545; text-decoration: none; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Sewa Mobil: <?= htmlspecialchars($mobil['nama_mobil']) ?></h2>
        <label>Nama Peminjam</label>
        <input type="text" name="nama_peminjam" required>

        <label>No HP</label>
        <input type="text" name="no_hp" required>

        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" required>

        <label>Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" required>

        <button type="submit" name="sewa">Sewa Sekarang</button>
        <a href="detail.php?id=<?= $id_mobil ?>">Batal</a>
    </form>
</body>
</html>
