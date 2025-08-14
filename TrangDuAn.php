<?php
// Nhúng file kết nối CSDL từ thư mục backend
require_once 'backend/db.php';

// Câu lệnh SQL để lấy tất cả dự án
$sql = "SELECT id, ten_du_an, mo_ta, hinh_anh_url, danh_muc FROM du_an ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự Án - Studio Trang Trí Nội Thất</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .project-hero {
            background-size: cover;
            background-position: center center;
            padding: 100px 0;
            color: white;
            text-align: center;
        }
        .project-hero h1 {
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        }
        .project-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        .project-card .card-img-top {
            height: 250px;
            object-fit: cover;
        }
        .project-card .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>
        <!-- Lưu ý: tên thư mục của bạn là 'assests' chứ không phải 'assets' -->
        <img class="logo" src="./assests/img/logo.jpg" alt="Logo Studio">
        <div class="text-center">
            <h1>STUDIO TRANG TRÍ NỘI THẤT</h1>
            <p>Khơi nguồn cảm hứng không gian sống</p>
        </div>
    </header>
    
    <nav>
        <a href="trangchu.html"><strong>TRANG CHỦ</strong></a>
        <a href="lienhe.html"><strong>GIỚI THIỆU</strong></a>
        <a href="TrangDuAn.php"><strong>DỰ ÁN</strong></a>
        <a href="ThemDuAn.html"><strong>THÊM DỰ ÁN TỪ NGƯỜI DÙNG</strong></a>
        <a href="lienhe.html"><strong>LIÊN HỆ</strong></a>
    </nav>

    <section class="project-hero" style="background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070&auto=format&fit=crop');">
        <div class="container">
            <h1 class="display-4">Các Dự Án Tiêu Biểu</h1>
            <p class="lead">Nơi những ý tưởng sáng tạo được hiện thực hóa.</p>
        </div>
    </section>

    <main class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <a href="login.html" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i> Thêm Dự Án Mới
                </a>
            </div>
            <div class="row g-4">
                <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 project-card shadow-sm">
                            <img src="<?php echo htmlspecialchars($row['hinh_anh_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['ten_du_an']); ?>">
                            <span class="badge bg-primary"><?php echo htmlspecialchars($row['danh_muc']); ?></span>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['ten_du_an']); ?></h5>
                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($row['mo_ta']); ?></p>
                                <a href="#" class="btn btn-outline-primary mt-auto">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center col-12'>Chưa có dự án nào để hiển thị. Hãy thêm một dự án mới!</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </main>

    <footer class="text-center p-4 bg-dark text-white">
        <p class="mb-0">© 2024 Design Studio. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>