<?php
// hash.php — jalankan di browser untuk menghasilkan hash
$password_plain = "123456"; // ganti sesuai password yang mau kamu buat
$hash = password_hash($password_plain, PASSWORD_DEFAULT);
echo "Plain: " . htmlspecialchars($password_plain) . "<br>";
echo "Hash : " . $hash . "<br>";

// Optional: cek kembali
echo "<br>Verifikasi: ";
if (password_verify($password_plain, $hash)) {
    echo "OK — password_verify returned true";
} else {
    echo "NOT OK";
}
?>
