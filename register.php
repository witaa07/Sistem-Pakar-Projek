<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "includes/database.php";

$error = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $error = "Terjadi kesalahan, coba lagi!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <h1>Diagnosis Penyakit Pernapasan</h1>
    </div>
  </nav>

  <div class="login-box">
    <h2>Daftar</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      <div class="input-group">
        <label>Username:</label>
        <input type="text" name="username" required>
      </div>
      <div class="input-group">
        <label>Password:</label>
        <input type="password" name="password" required>
      </div>
      <button type="submit" name="register">Daftar</button>
    </form>
    <div class="register-link">
      Sudah punya akun? <a href="login.php">Masuk disini</a>
    </div>
  </div>
</body>
</html>

