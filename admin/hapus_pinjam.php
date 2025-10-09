<?php include 'header.php'; ?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    // sebelum hapus, kembalikan status mobil jika perlu
    $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_mobil, status FROM peminjaman WHERE id_pinjam=$id"));
    if ($r) {
        if ($r['status'] == 'dipinjam') {
            mysqli_query($conn, "UPDATE mobil SET status='tersedia' WHERE id_mobil={$r['id_mobil']}");   
        }
    }
    mysqli_query($conn, "DELETE FROM peminjaman WHERE id_pinjam=$id");
}
header('Location: peminjaman.php');
exit;
?>