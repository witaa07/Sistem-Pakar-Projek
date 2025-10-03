<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "includes/database.php";

$error = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    if (!$stmt) {
        $error = "Prepare failed: " . $conn->error;
    } else {
        $stmt->bind_param("s", $username);
        $ok = $stmt->execute();
        if (!$ok) {
            $error = "Execute failed: " . $stmt->error;
        } else {
            $stmt->store_result();
            if ($stmt->num_rows === 1) {
                $stmt->bind_result($id, $db_username, $db_password);
                $stmt->fetch();
                if (password_verify($password, $db_password)) {
                    $_SESSION['username'] = $db_username;
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Username atau Password salah!";
                }
            } else {
                $error = "Username atau Password salah!";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <h1>Diagnosis Penyakit Pernapasan</h1>
    </div>
  </nav>

  <div class="login-box">
    <h2>Masuk</h2>
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
      <button type="submit" name="login">Masuk</button>
    </form>
    <div class="register-link">
      Belum punya akun? <a href="register.php">Daftar disini</a>
    </div>
  </div>
</body>
</html>

