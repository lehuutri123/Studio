<?php
session_start();
require '../backend/db.php';
require 'partials/check_login.php';

// Nếu sửa: lấy dữ liệu dự án
$editMode = false;
$du_an = [
  'ten_du_an' => '',
  'mo_ta' => '',
  'hinh_anh_url' => '',
  'danh_muc' => '',
  'ngay_hoan_thanh' => ''
];

if (isset($_GET['id'])) {
  $editMode = true;
  $id = intval($_GET['id']);
  $query = $conn->query("SELECT * FROM du_an WHERE id = $id");
  if ($query && $query->num_rows > 0) {
    $du_an = $query->fetch_assoc();
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title><?= $editMode ? 'Chỉnh Sửa Dự Án' : 'Thêm Dự Án Mới' ?></title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f3f4f6;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 700px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #111827;
    }
    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }
    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 18px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 1rem;
    }
    button {
      width: 100%;
      background: #3b82f6;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background: #2563eb;
    }
    .back {
      display: block;
      text-align: center;
      margin-bottom: 20px;
      text-decoration: none;
      color: #6b7280;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="dashboard.php" class="back">&larr; Quay về danh sách</a>
    <h2><?= $editMode ? 'Chỉnh Sửa Dự Án' : 'Thêm Dự Án Mới' ?></h2>
    <form action="../backend/project_actions.php" method="POST">
      <?php if ($editMode): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="action" value="update">
      <?php else: ?>
        <input type="hidden" name="action" value="create">
      <?php endif; ?>

      <label for="ten">Tên Dự Án</label>
      <input type="text" name="ten_du_an" value="<?= htmlspecialchars($du_an['ten_du_an']) ?>" required>

      <label for="mo_ta">Mô Tả</label>
      <textarea name="mo_ta" rows="5" required><?= htmlspecialchars($du_an['mo_ta']) ?></textarea>

      <label for="hinh">URL Hình Ảnh</label>
      <input type="url" name="hinh_anh_url" value="<?= htmlspecialchars($du_an['hinh_anh_url']) ?>" required>

      <label for="danh_muc">Danh Mục</label>
      <select name="danh_muc" required>
        <option value="" disabled <?= $du_an['danh_muc'] == '' ? 'selected' : '' ?>>-- Chọn danh mục --</option>
        <?php
          $options = ['Biệt Thự', 'Căn Hộ', 'Văn Phòng', 'Nhà Phố', 'Showroom'];
          foreach ($options as $option):
        ?>
          <option value="<?= $option ?>" <?= $du_an['danh_muc'] == $option ? 'selected' : '' ?>><?= $option ?></option>
        <?php endforeach; ?>
      </select>

      <label for="ngay">Ngày Hoàn Thành</label>
      <input type="date" name="ngay_hoan_thanh" value="<?= htmlspecialchars($du_an['ngay_hoan_thanh']) ?>">

      <button type="submit"><?= $editMode ? 'Cập Nhật Dự Án' : 'Lưu Dự Án' ?></button>
    </form>
  </div>
</body>
</html>
