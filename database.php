<?php
$host = "127.0.0.1";  // atau localhost
$user = "root";
$pass = "";           // jangan isi apa-apa kalau default XAMPP
$db   = "psp";

$conn = mysqli_connect($host, $user, $pass, $db, 3307);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
