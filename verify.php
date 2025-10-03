<?php
include "database.php";
echo "<pre>";
echo "Connected: " . (mysqli_ping($conn) ? "YES" : "NO") . "\n";
echo "Host info: " . mysqli_get_host_info($conn) . "\n\n";

$username = 'tesuser';
$password = '123456';

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
echo "Rows found for '{$username}': " . $stmt->num_rows . "\n";

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $db_username, $db_password);
    $stmt->fetch();
    echo "DB username: " . $db_username . "\n";
    echo "DB password hash: " . $db_password . "\n";
    echo "CHAR LENGTH of hash: " . strlen($db_password) . "\n";
    echo "password_verify('{$password}', db_hash) => ";
    var_export(password_verify($password, $db_password));
    echo "\n";
} else {
    echo "User not found.\n";
}
echo "</pre>";
