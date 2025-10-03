<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "psp";

$conn = mysqli_connect($host, $user, $pass, $db, 3307);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

