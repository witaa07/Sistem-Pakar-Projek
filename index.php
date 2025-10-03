<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beranda - Sistem Diagnosis</title>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <h1 class="logo">Layanan Diagnosis</h1>
      <ul class="nav-links">
        <?php if (isset($_SESSION['username'])): ?>
          <li><a href="logout.php">Logout (<?= $_SESSION['username']; ?>)</a></li>
        <?php else: ?>
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <section class="hero">
    <div class="hero-text">
      <h2>Selamat datang di Sistem Pakar Diagnosis Penyakit Pernapasan</h2>
      <p>Di sini kamu bisa melakukan pengecekan awal kondisi kesehatan pernapasan dengan mudah, cepat, dan akurat.</p>
      <?php if (isset($_SESSION['username'])): ?>
        <a href="diagnosis.php" class="btn">Mulai Diagnosis</a>
      <?php else: ?>
        <a href="login.php" class="btn">Periksa Sekarang</a>
      <?php endif; ?>
    </div>
    <div class="hero-image">
      <img src="img/Diagnosis.png" alt="Ilustrasi Diagnosis">
    </div>
  </section>
</body>
</html>
