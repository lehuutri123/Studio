<?php
session_start();
require '../backend/db.php';
require 'partials/check_login.php';

// Lấy danh sách dự án
$sql = "SELECT * FROM du_an ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản Trị Dự Án - STUDIO</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f6f9fc;
      margin: 0; padding: 0;
    }
    header {
      background: #111827;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .container {
      max-width: 1000px;
      margin: 30px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #111827;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #e5e7eb;
      text-align: left;
    }
    th {
      background: #f3f4f6;
      color: #374151;
    }
    tr:hover {
      background-color: #f9fafb;
    }
    .actions a {
      text-decoration: none;
      padding: 6px 12px;
      border-radius: 6px;
      margin-right: 6px;
      font-size: 0.9rem;
    }
    .edit {
      background: #3b82f6;
      color: white;
    }
    .delete {
      background: #ef4444;
      color: white;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .top-bar a {
      text-decoration: none;
      background: #10b981;
      color: white;
      padding: 10px 16px;
      border-radius: 8px;
    }
    .logout {
      background: #6b7280 !important;
    }
  </style>
</head>
<body>
  <header>STUDIO NỘI THẤT - QUẢN TRỊ DỰ ÁN</header>
  <div class="container">
    <div class="top-bar">
      <a href="project_from.php">+ Thêm Dự Án Mới</a>
      <a class="logout" href="logout.php">Đăng xuất</a>
    </div>

    <h2>Danh Sách Dự Án</h2>
    <table>
      <thead>
        <tr>
          <th>Tên Dự Án</th>
          <th>Danh Mục</th>
          <th>Ngày Hoàn Thành</th>
          <th>Thao Tác</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['ten_du_an']) ?></td>
            <td><?= htmlspecialchars($row['danh_muc']) ?></td>
            <td><?= htmlspecialchars($row['ngay_hoan_thanh']) ?></td>
            <td class="actions">
              <a href="project_from.php?id=<?= $row['id'] ?>" class="edit">Sửa</a>
              <a href="../backend/delete_project.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Xác nhận xoá dự án này?')">Xoá</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>