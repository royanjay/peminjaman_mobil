<?php
include '../config/config.php';
include 'header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Data Mobil</h3>
  <a href="tambah_mobil.php" class="btn btn-primary">+ Tambah Mobil</a>
</div>

<table class="table table-bordered table-striped">
  <thead class="table-dark text-center">
    <tr>
      <th width="5%">No</th>
      <th width="15%">Gambar</th>
      <th>Nama Mobil</th>
      <th>Merk</th>
      <th>Tahun</th>
      <th>Bahan Bakar</th>
      <th>Transmisi</th>
      <th>Kapasitas</th>
      <th>Harga/Hari</th>
      <th>Status</th>
      <th width="15%">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $query = mysqli_query($conn, "SELECT * FROM mobil ORDER BY id_mobil DESC");
    if (mysqli_num_rows($query) > 0) {
      while ($row = mysqli_fetch_assoc($query)) {
    ?>
        <tr class="text-center align-middle">
          <td><?= $no++ ?></td>
          <td>
            <?php if (!empty($row['gambar'])): ?>
              <img src="../assets/img/upload/<?= htmlspecialchars($row['gambar']) ?>" width="100" class="rounded">
            <?php else: ?>
              <span class="text-muted">Tidak ada gambar</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row['nama_mobil']) ?></td>
          <td><?= htmlspecialchars($row['merk']) ?></td>
          <td><?= htmlspecialchars($row['tahun']) ?></td>
          <td><?= htmlspecialchars($row['bahan_bakar']) ?></td>
          <td><?= htmlspecialchars($row['transmisi']) ?></td>
          <td><?= htmlspecialchars($row['kapasitas']) ?> Orang</td>
          <td>Rp<?= number_format($row['harga_per_hari'], 0, ',', '.') ?></td>
          <td>
            <?php if ($row['status'] == 'tersedia'): ?>
              <span class="badge bg-success">Tersedia</span>
            <?php else: ?>
              <span class="badge bg-danger">Disewa</span>
            <?php endif; ?>
          </td>
          <td>
            <a href="edit_mobil.php?id=<?= $row['id_mobil'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="hapus_mobil.php?id=<?= $row['id_mobil'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus mobil ini?')">Hapus</a>
          </td>
        </tr>
    <?php
      }
    } else {
      echo "<tr><td colspan='11' class='text-center text-muted'>Belum ada data mobil</td></tr>";
    }
    ?>
  </tbody>
</table>

<?php include 'footer.php'; ?>
