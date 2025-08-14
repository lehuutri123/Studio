<?php
session_start();
require 'partials/check_login.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang Quản Trị</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f3f4f6;
      margin: 0;
    }
    header {
      background: #1f2937;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .container {
      max-width: 800px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.05);
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
      color: #111827;
    }
    a {
      display: inline-block;
      margin: 10px;
      padding: 12px 24px;
      background: #3b82f6;
      color: white;
      text-decoration: none;
      border-radius: 8px;
    }
    a:hover {
      background: #2563eb;
    }
    .logout {
      background: #6b7280;
    }
  </style>
</head>
<body>
  <header>STUDIO NỘI THẤT - TRANG QUẢN TRỊ</header>
  <div class="container">
    <h2>Chào quản trị viên: <?= htmlspecialchars($_SESSION['username']) ?></h2>
    <a href="dashboard.php">Quản lý dự án</a>
    <a href="project_from.php">Thêm dự án mới</a>
    <a href="logout.php" class="logout">Đăng xuất</a>
  </div>
</body>
</html>
