<?php include 'header.php'; ?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_mobil FROM peminjaman WHERE id_pinjam=$id"));
    if ($r) {
        mysqli_query($conn, "UPDATE peminjaman SET status='dikembalikan' WHERE id_pinjam=$id");
        mysqli_query($conn, "UPDATE mobil SET status='tersedia' WHERE id_mobil={$r['id_mobil']}");   
    }
}
header('Location: peminjaman.php');
exit;
?>