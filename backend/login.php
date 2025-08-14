<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Kiểm tra dữ liệu hợp lệ
  if (!$username || !$password) {
    die("Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.");
  }

  // Mã hoá mật khẩu (nếu bạn dùng md5 trong database)
  $password_hashed = md5($password);

  // Truy vấn
  $stmt = $conn->prepare("SELECT * FROM quan_tri_vien WHERE ten_dang_nhap = ? AND mat_khau = ? LIMIT 1");
  $stmt->bind_param("ss", $username, $password_hashed);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $user['ten_dang_nhap'];
    $_SESSION['role'] = 'admin';
    header("Location: ../admin/dashboard.php");
    exit();
  } else {
    echo "<script>alert('Sai tài khoản hoặc mật khẩu');window.location.href='../login.html';</script>";
  }
} else {
  echo "Truy cập không hợp lệ!";
}
?>

