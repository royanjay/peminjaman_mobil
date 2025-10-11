<?php
include '../config/config.php';
include 'header.php';

if (isset($_POST['simpan'])) {
    $nama_mobil = $_POST['nama_mobil'];
    $merk = $_POST['merk'];
    $tahun = $_POST['tahun'];
    $bahan_bakar = $_POST['bahan_bakar'];
    $transmisi = $_POST['transmisi'];
    $kapasitas = $_POST['kapasitas'];
    $harga = $_POST['harga_per_hari'];
    $status = 'tersedia';

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "../assets/img/upload/" . $gambar;

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO mobil (nama_mobil, merk, harga_per_hari, tahun, bahan_bakar, transmisi, kapasitas, gambar, status)
                  VALUES ('$nama_mobil', '$merk', '$harga', '$tahun', '$bahan_bakar', '$transmisi', '$kapasitas', '$gambar', '$status')";
        mysqli_query($conn, $query);
        echo "<script>alert('Data mobil berhasil ditambahkan'); window.location='mobil.php';</script>";
    } else {
        echo "<script>alert('Gagal upload gambar');</script>";
    }
}
?>

<div class="card">
  <div class="card-header bg-primary text-white">
    <h5>Tambah Mobil</h5>
  </div>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Nama Mobil</label>
        <input type="text" name="nama_mobil" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Merk</label>
        <input type="text" name="merk" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Tahun</label>
        <input type="number" name="tahun" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Bahan Bakar</label>
        <input type="text" name="bahan_bakar" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Transmisi</label>
        <input type="text" name="transmisi" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Kapasitas (Orang)</label>
        <input type="number" name="kapasitas" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Harga per Hari</label>
        <input type="number" name="harga_per_hari" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Gambar Mobil</label>
        <input type="file" name="gambar" class="form-control" accept="image/*" required>
      </div>
      <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
      <a href="mobil.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
