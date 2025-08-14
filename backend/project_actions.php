<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';

  $ten = $conn->real_escape_string($_POST['ten_du_an']);
  $mo_ta = $conn->real_escape_string($_POST['mo_ta']);
  $hinh = $conn->real_escape_string($_POST['hinh_anh_url']);
  $danh_muc = $conn->real_escape_string($_POST['danh_muc']);
  $ngay = $conn->real_escape_string($_POST['ngay_hoan_thanh']);

  if ($action === 'create') {
    $sql = "INSERT INTO du_an (ten_du_an, mo_ta, hinh_anh_url, danh_muc, ngay_hoan_thanh)
            VALUES ('$ten', '$mo_ta', '$hinh', '$danh_muc', '$ngay')";
  } elseif ($action === 'update') {
    $id = intval($_POST['id']);
    $sql = "UPDATE du_an SET 
              ten_du_an = '$ten',
              mo_ta = '$mo_ta',
              hinh_anh_url = '$hinh',
              danh_muc = '$danh_muc',
              ngay_hoan_thanh = '$ngay'
            WHERE id = $id";
  }

  if ($conn->query($sql)) {
    header("Location: ../admin/dashboard.php");
  } else {
    echo "Lỗi: " . $conn->error;
  }
}
?>
