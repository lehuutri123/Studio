CREATE DATABASE IF NOT EXISTS qlda;
USE qlda;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  role ENUM('admin', 'user') DEFAULT 'user'
);
INSERT INTO users (username, password, role) VALUES ('admin', MD5('123'), 'admin');

CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  description TEXT,
  link VARCHAR(255),
  email_contact VARCHAR(100)
);


 quản lý dụ án COMMENT(đang sử dụng)
 -- Tạo bảng để lưu thông tin quản trị viên
CREATE TABLE `quan_tri_vien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_dang_nhap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm một tài khoản admin mẫu
-- Mật khẩu là 'admin123' đã được mã hóa an toàn
INSERT INTO `quan_tri_vien` (`ho_ten`, `ten_dang_nhap`, `mat_khau`) VALUES
('Quản Trị Viên', 'admin', '$2y$10$WkG.15i3p/.NVI2.y4i/Ue3LzXG53T3uGNcUvj25/QjB.zSwnoZq6');