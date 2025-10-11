<?php
include '../config/config.php';
include 'header.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama_mobil = $_POST['nama_mobil'];
    $merk = $_POST['merk'];
    $tahun = $_POST['tahun'];
    $bahan_bakar = $_POST['bahan_bakar'];
    $transmisi = $_POST['transmisi'];
    $kapasitas = $_POST['kapasitas'];
    $harga = $_POST['harga_per_hari'];
    $status = $_POST['status'];

    $gambar = $row['gambar']; // default lama

    // Cek jika upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $newImage = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $path = "../assets/img/upload/" . $newImage;

        if (move_uploaded_file($tmp, $path)) {
            unlink("../assets/img/upload/" . $row['gambar']); // hapus gambar lama
            $gambar = $newImage;
        }
    }

    $update = "UPDATE mobil SET 
                nama_mobil='$nama_mobil',
                merk='$merk',
                harga_per_hari='$harga',
                tahun='$tahun',
                bahan_bakar='$bahan_bakar',
                transmisi='$transmisi',
                kapasitas='$kapasitas',
                gambar='$gambar',
                status='$status'
               WHERE id_mobil='$id'";
    mysqli_query($conn, $update);

    echo "<script>alert('Data mobil berhasil diperbarui'); window.location='mobil.php';</script>";
}
?>

<div class="card">
  <div class="card-header bg-warning">
    <h5>Edit Mobil</h5>
  </div>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Nama Mobil</label>
        <input type="text" name="nama_mobil" class="form-control" value="<?= $row['nama_mobil'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Merk</label>
        <input type="text" name="merk" class="form-control" value="<?= $row['merk'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Tahun</label>
        <input type="number" name="tahun" class="form-control" value="<?= $row['tahun'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Bahan Bakar</label>
        <input type="text" name="bahan_bakar" class="form-control" value="<?= $row['bahan_bakar'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Transmisi</label>
        <input type="text" name="transmisi" class="form-control" value="<?= $row['transmisi'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Kapasitas (Orang)</label>
        <input type="number" name="kapasitas" class="form-control" value="<?= $row['kapasitas'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Harga per Hari</label>
        <input type="number" name="harga_per_hari" class="form-control" value="<?= $row['harga_per_hari'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
          <option value="tersedia" <?= ($row['status'] == 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
          <option value="disewa" <?= ($row['status'] == 'disewa') ? 'selected' : '' ?>>Disewa</option>
        </select>
      </div>
      <div class="mb-3">
        <label>Gambar Mobil</label><br>
        <img src="../assets/img/upload/<?= $row['gambar'] ?>" width="120" class="rounded mb-2"><br>
        <input type="file" name="gambar" class="form-control" accept="image/*">
      </div>
      <button type="submit" name="update" class="btn btn-success">Update</button>
      <a href="mobil.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
