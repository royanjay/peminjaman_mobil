<!-- Windows -->

<?php
// $host = "localhost";
// $user = "root";
// $pass = "";
// $db   = "sewa_mobil";

// $conn = mysqli_connect($host, $user, $pass, $db);

// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }

// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }


// <!-- Linux -->


$host = "127.0.0.1";
$user = "admin";     // ganti sesuai user MySQL
$pass = "royhanganteng123";         // password MySQL kamu
$db   = "sewa_mobil";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
