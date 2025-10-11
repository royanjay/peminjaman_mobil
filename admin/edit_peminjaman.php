<?php
include 'header.php';
include '../config/config.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'"));

if (isset($_POST['update'])) {
  $status = $_POST['status'];
  mysqli_query($conn, "UPDATE peminjaman SET status='$status' WHERE id_peminjaman='$id'");
  echo "<script>alert('Status peminjaman diperbarui');window.location='peminjaman.php';</script>";
}
?>

<h3>Edit Status Peminjaman</h3>
<form method="post">
  <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-select">
      <option value="diproses" <?= $data['status']=='diproses'?'selected':'' ?>>Diproses</option>
      <option value="disewa" <?= $data['status']=='disewa'?'selected':'' ?>>Disewa</option>
      <option value="selesai" <?= $data['status']=='selesai'?'selected':'' ?>>Selesai</option>
      <option value="batal" <?= $data['status']=='batal'?'selected':'' ?>>Batal</option>
    </select>
  </div>
  <button type="submit" name="update" class="btn btn-primary">Update</button>
  <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
</form>

<?php include 'footer.php'; ?>
