<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ten_du_an = trim($_POST['ten_du_an']);
    $mo_ta = trim($_POST['mo_ta']);
    $hinh_anh_url = trim($_POST['hinh_anh_url']);
    $danh_muc = trim($_POST['danh_muc']);
    $ngay_hoan_thanh = !empty($_POST['ngay_hoan_thanh']) ? trim($_POST['ngay_hoan_thanh']) : NULL;

    if (!empty($ten_du_an) && !empty($mo_ta) && !empty($hinh_anh_url) && !empty($danh_muc)) {
        
        $sql = "INSERT INTO du_an (ten_du_an, mo_ta, hinh_anh_url, danh_muc, ngay_hoan_thanh) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $ten_du_an, $mo_ta, $hinh_anh_url, $danh_muc, $ngay_hoan_thanh);
            
            if ($stmt->execute()) {
                header("location: ../TrangDuAn.php");
                exit();
            } else {
                echo "Lỗi: Không thể thực thi. " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Lỗi: Không thể chuẩn bị. " . $conn->error;
        }

    } else {
        echo "Lỗi: Vui lòng điền đầy đủ thông tin.";
    }

    $conn->close();
} else {
    header("location: ../ThemDuAn.html");
    exit();
}
?>