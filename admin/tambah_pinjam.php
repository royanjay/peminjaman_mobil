<?php include 'header.php'; ?>

<?php
// ambil mobil yang tersedia
$mobil_tersedia = mysqli_query($conn, "SELECT * FROM mobil WHERE status='tersedia' ORDER BY nama_mobil");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_peminjam']);
    $id_mobil = (int) $_POST['id_mobil'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    // validasi tanggal
    if (strtotime($tgl_kembali) < strtotime($tgl_pinjam)) {
        $error = 'Tanggal kembali harus sama atau setelah tanggal pinjam.';
    } else {
        // ambil harga mobil
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga_per_hari FROM mobil WHERE id_mobil=$id_mobil"));
        $harga = (int) $data['harga_per_hari'];

        // hitung selisih hari (minimal 1 hari)
        $diff = (strtotime($tgl_kembali) - strtotime($tgl_pinjam)) / (60*60*24);
        $hari = max(1, (int)$diff);
        $total = $hari * $harga;

        // simpan peminjaman
        mysqli_query($conn, "INSERT INTO peminjaman (nama_peminjam, id_mobil, tanggal_pinjam, tanggal_kembali, total_harga, status) VALUES ('{$nama}', {$id_mobil}, '{$tgl_pinjam}', '{$tgl_kembali}', {$total}, 'dipinjam')");

        // update status mobil
        mysqli_query($conn, "UPDATE mobil SET status='dipinjam' WHERE id_mobil={$id_mobil}");

        header('Location: peminjaman.php');
        exit;
    }
}
?>

<h3>Tambah Peminjaman</h3>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
  <div class="mb-3">
    <label class="form-label">Nama Peminjam</label>
    <input type="text" name="nama_peminjam" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Pilih Mobil (hanya yang tersedia)</label>
    <select name="id_mobil" class="form-select" required>
      <option value="">-- Pilih Mobil --</option>
      <?php while ($m = mysqli_fetch_assoc($mobil_tersedia)): ?>
        <option value="<?= $m['id_mobil'] ?>"><?= htmlspecialchars($m['nama_mobil']) ?> - <?= htmlspecialchars($m['merk']) ?> (<?= number_format($m['harga_per_hari']) ?> / hari)</option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Tanggal Kembali</label>
    <input type="date" name="tanggal_kembali" class="form-control" required>
  </div>

  <button type="submit" name="simpan" class="btn btn-success">Simpan Peminjaman</button>
  <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
</form>

<?php include 'footer.php'; ?>