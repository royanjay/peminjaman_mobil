<?php include 'header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Data Peminjaman</h3>
  <a href="tambah_pinjam.php" class="btn btn-primary">+ Tambah Peminjaman</a>
</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Peminjam</th>
      <th>Mobil</th>
      <th>Tgl Pinjam</th>
      <th>Tgl Kembali</th>
      <th>Total Harga</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $q = mysqli_query($conn, "SELECT p.*, m.nama_mobil FROM peminjaman p JOIN mobil m ON p.id_mobil=m.id_mobil ORDER BY p.id_pinjam DESC");
    while ($r = mysqli_fetch_assoc($q)) {
    ?>
    <tr>
      <td><?= $r['id_pinjam'] ?></td>
      <td><?= htmlspecialchars($r['nama_peminjam']) ?></td>
      <td><?= htmlspecialchars($r['nama_mobil']) ?></td>
      <td><?= $r['tanggal_pinjam'] ?></td>
      <td><?= $r['tanggal_kembali'] ?></td>
      <td><?= number_format($r['total_harga']) ?></td>
      <td><?= $r['status'] ?></td>
      <td>
        <?php if ($r['status'] == 'dipinjam'): ?>
          <a href="kembalikan.php?id=<?= $r['id_pinjam'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Tandai dikembalikan?')">Kembalikan</a>
        <?php endif; ?>
        <a href="hapus_pinjam.php?id=<?= $r['id_pinjam'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus peminjaman ini?')">Hapus</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<?php include 'footer.php'; ?>