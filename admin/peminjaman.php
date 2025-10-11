<?php include 'header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Data Peminjaman Mobil</h3>
  <a href="tambah_peminjam.php" class="btn btn-success">+ Tambah Peminjam</a>

</div>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>No</th>
      <th>Nama Peminjam</th>
      <th>Mobil</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
      <th>Total Harga</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include '../config/config.php';
    $no = 1;
    $query = mysqli_query($conn, "SELECT p.*, m.nama_mobil FROM peminjaman p JOIN mobil m ON p.id_mobil = m.id_mobil ORDER BY p.id_peminjaman DESC");
    while ($row = mysqli_fetch_assoc($query)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['nama_peminjam'] ?></td>
      <td><?= $row['nama_mobil'] ?></td>
      <td><?= $row['tanggal_pinjam'] ?></td>
      <td><?= $row['tanggal_kembali'] ?></td>
      <td>Rp<?= number_format($row['total_harga']) ?></td>
      <td><?= ucfirst($row['status']) ?></td>
      <td>
        <a href="edit_peminjaman.php?id=<?= $row['id_peminjaman'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="hapus_peminjaman.php?id=<?= $row['id_peminjaman'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include 'footer.php'; ?>
