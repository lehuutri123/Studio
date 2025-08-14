<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Không có quyền truy cập");
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Trị Dự Án - Studio Nội Thất</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;600;700&family=Montserrat:wght@300;400;600;700&display=swap');

        :root {
            --primary-color: #007bff;
            --primary-dark: #0056b3;
            --accent-color: #20c997;
            --accent-dark: #1aa07f;
            --dark-bg: #1a202c;
            --light-bg-gradient-start: #f5f7fa;
            --light-bg-gradient-end: #e0e6ee;
            --text-color-dark: #2d3748;
            --text-color-light: #edf2f7;
            --card-bg: #ffffff;
            --border-radius-xl: 1.25rem;
            --border-radius-lg: 0.8rem;
            --border-radius-sm: 0.5rem;
            --box-shadow-subtle: 0 0.6rem 1.5rem rgba(0, 0, 0, 0.08);
            --box-shadow-elevated: 0 1rem 2.5rem rgba(0, 0, 0, 0.15);
            --transition-speed: 0.3s;
            --transition-ease: cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.8;
            color: var(--text-color-dark);
            background: linear-gradient(135deg, var(--light-bg-gradient-start) 0%, var(--light-bg-gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'IBM Plex Sans', sans-serif;
            color: var(--text-color-dark);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        header {
            background: var(--dark-bg);
            color: var(--text-color-light);
            padding: 3rem 0;
            text-align: center;
            box-shadow: var(--box-shadow-elevated);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.8rem;
            position: relative;
            overflow: hidden;
            border-bottom-left-radius: var(--border-radius-xl);
            border-bottom-right-radius: var(--border-radius-xl);
            animation: fadeInDown 0.8s var(--transition-ease);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 20% 20%, rgba(0, 123, 255, 0.2) 0%, transparent 30%),
                        radial-gradient(circle at 80% 80%, rgba(32, 201, 151, 0.2) 0%, transparent 30%);
            opacity: 0.8;
            z-index: 0;
            animation: headerBgPan 20s infinite alternate ease-in-out;
        }

        @keyframes headerBgPan {
            from {
                transform: translate(0, 0);
            }
            to {
                transform: translate(-10%, -10%);
            }
        }

        header .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid var(--accent-color);
            box-shadow: 0 0 30px rgba(32, 201, 151, 0.8), 0 0 50px rgba(32, 201, 151, 0.5);
            position: relative;
            z-index: 1;
            transition: transform var(--transition-speed) var(--transition-ease);
        }

        header .logo:hover {
            transform: scale(1.1);
        }

        header .text-center {
            position: relative;
            z-index: 1;
        }

        header h1 {
            color: var(--accent-color);
            margin-bottom: 0.8rem;
            font-size: 3.8rem;
            text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.6);
            letter-spacing: 0.1rem;
            transition: color var(--transition-speed) var(--transition-ease);
        }

        header h1:hover {
            color: #4df0c3;
        }

        header p {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 300;
            letter-spacing: 0.02rem;
        }

        nav {
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            text-align: center;
            padding: 1.5rem 0;
            box-shadow: 0 0.8rem 1.8rem rgba(0, 0, 0, 0.25);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 5px solid var(--accent-color);
            animation: slideInDown 0.8s var(--transition-ease) 0.2s forwards;
            opacity: 0;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        nav a {
            color: var(--text-color-light);
            text-decoration: none;
            padding: 1.2rem 2.5rem;
            font-weight: 600;
            transition: all var(--transition-speed) var(--transition-ease);
            border-radius: var(--border-radius-lg);
            margin: 0 1rem;
            display: inline-block;
            letter-spacing: 0.04rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.15);
            transition: left 0.4s ease-out;
            z-index: -1;
        }

        nav a:hover::before {
            left: 0;
        }

        nav a:hover,
        nav a:focus {
            background-color: var(--primary-dark);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            color: white;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        main {
            flex: 1;
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        .card {
            border: none;
            border-radius: var(--border-radius-xl);
            box-shadow: var(--box-shadow-elevated);
            transition: transform 0.4s var(--transition-ease), box-shadow 0.4s var(--transition-ease);
            background-color: var(--card-bg);
            overflow: hidden;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(0, 123, 255, 0.02), transparent 50%, rgba(32, 201, 151, 0.02));
            z-index: 0;
            pointer-events: none;
        }

        .card:hover {
            transform: translateY(-12px) scale(1.01);
            box-shadow: 0 1.5rem 3.5rem rgba(0, 0, 0, 0.25);
        }

        .card-img-top {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-top-left-radius: var(--border-radius-xl) !important;
            border-top-right-radius: var(--border-radius-xl) !important;
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            padding: 2rem !important;
            position: relative;
            z-index: 1;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color-dark);
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .card-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
            border: none;
            padding: 1.2rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: var(--border-radius-lg);
            transition: all 0.4s var(--transition-ease);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
            letter-spacing: 0.05rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
            text-transform: uppercase;
            width: 100%;
            margin-top: auto;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -120%;
            width: 50%;
            height: 100%;
            background: rgba(255, 255, 255, 0.4);
            transform: skewX(-20deg);
            transition: all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
            z-index: -1;
        }

        .btn-primary:hover::before {
            left: 120%;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
            transform: translateY(-7px) scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.6);
            color: white;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.7);
        }

        footer {
            background: var(--dark-bg);
            color: var(--text-color-light);
            padding: 3rem 0;
            margin-top: auto;
            box-shadow: 0 -0.8rem 1.8rem rgba(0, 0, 0, 0.25);
            border-top: 5px solid var(--accent-color);
            border-top-left-radius: var(--border-radius-xl);
            border-top-right-radius: var(--border-radius-xl);
            animation: fadeInUp 0.8s var(--transition-ease) 0.4s forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        footer p {
            margin-bottom: 0;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 300;
            letter-spacing: 0.01rem;
        }

        @media (max-width: 992px) {
            header {
                padding: 2rem 0;
                border-bottom-left-radius: var(--border-radius-lg);
                border-bottom-right-radius: var(--border-radius-lg);
            }
            header .logo {
                width: 100px;
                height: 100px;
            }
            header h1 {
                font-size: 3rem;
            }
            header p {
                font-size: 1.2rem;
            }
            nav {
                padding: 1rem 0;
                border-bottom: 4px solid var(--accent-color);
            }
            nav a {
                padding: 0.9rem 1.8rem;
                margin: 0 0.6rem;
                font-size: 1rem;
            }
            main {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }
            .card {
                border-radius: var(--border-radius-lg);
            }
            .card-body {
                padding: 1.8rem !important;
            }
            .card-title {
                font-size: 1.3rem;
            }
            .card-text {
                font-size: 0.95rem;
            }
            .btn-primary {
                font-size: 1.1rem;
                padding: 1rem 2.2rem;
            }
            footer {
                padding: 2rem 0;
                border-top-left-radius: var(--border-radius-lg);
                border-top-right-radius: var(--border-radius-lg);
            }
            footer p {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            header {
                padding: 1.5rem 0;
            }
            header .logo {
                width: 80px;
                height: 80px;
            }
            header h1 {
                font-size: 2.5rem;
            }
            header p {
                font-size: 1.1rem;
            }
            nav {
                flex-direction: column;
                padding: 0.8rem;
            }
            nav a {
                display: block;
                margin: 0.6rem auto;
                width: calc(100% - 2rem);
                font-size: 1rem;
            }
            .card-body {
                padding: 1.5rem !important;
            }
            .card-title {
                font-size: 1.2rem;
            }
            .card-text {
                font-size: 0.9rem;
            }
            .btn-primary {
                font-size: 1rem;
                padding: 0.9rem 1.8rem;
            }
        }

        @media (max-width: 576px) {
            main.container {
                padding-left: 1rem;
                padding-right: 1rem;
                padding-top: 3rem;
                padding-bottom: 3rem;
            }
            .card-img-top {
                height: 200px;
            }
            .card-body {
                padding: 1.2rem !important;
            }
            .card-title {
                font-size: 1.1rem;
            }
            .card-text {
                font-size: 0.85rem;
            }
            .btn-primary {
                font-size: 0.9rem;
                padding: 0.8rem 1.5rem;
            }
            footer {
                padding: 1.8rem 0;
            }
            footer p {
                font-size: 0.9rem;
            }
        }

        /* Specific styles for Admin Page (originally from AdminPage.css) */
        .admin-header {
            background: var(--dark-bg);
            color: var(--text-color-light);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--box-shadow-subtle);
            border-bottom: 3px solid var(--accent-color);
        }

        .admin-header .welcome-text {
            font-size: 1.1rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.9);
        }

        .admin-header .welcome-text strong {
            color: var(--accent-color);
            font-weight: 600;
        }

        .admin-header .btn-outline-light {
            color: var(--text-color-light);
            border-color: rgba(255, 255, 255, 0.5);
            transition: all var(--transition-speed) var(--transition-ease);
            border-radius: var(--border-radius-sm);
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .admin-header .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        main.container {
            flex: 1;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .admin-section {
            background-color: var(--card-bg);
            border-radius: var(--border-radius-xl);
            box-shadow: var(--box-shadow-elevated);
            padding: 2.5rem;
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            display: block;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }

        .modern-form .form-control,
        .modern-form textarea {
            border-radius: var(--border-radius-sm);
            border: 1px solid #cdd4df;
            padding: 0.9rem 1.2rem;
            font-size: 1.1rem;
            transition: all var(--transition-speed) var(--transition-ease);
            background-color: #fcfdff;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .modern-form .form-control:focus,
        .modern-form textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.35rem rgba(0, 123, 255, 0.4), inset 0 1px 3px rgba(0, 0, 0, 0.1);
            outline: none;
            background-color: white;
        }

        .modern-form textarea {
            min-height: 120px;
            resize: vertical;
        }

        .modern-form .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
            border: none;
            padding: 1.1rem 2.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: var(--border-radius-lg);
            transition: all 0.4s var(--transition-ease);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
            letter-spacing: 0.05rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
            text-transform: uppercase;
            width: 100%;
        }

        .modern-form .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -120%;
            width: 50%;
            height: 100%;
            background: rgba(255, 255, 255, 0.4);
            transform: skewX(-20deg);
            transition: all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
            z-index: -1;
        }

        .modern-form .btn-primary:hover::before {
            left: 120%;
        }

        .modern-form .btn-primary:hover {
            background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.6);
            color: white;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.7);
        }

        .project-list {
            display: grid;
            gap: 2rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .project-item {
            background-color: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--box-shadow-subtle);
            padding: 2rem;
            transition: all 0.3s var(--transition-ease);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .project-item:hover {
            transform: translateY(-8px);
            box-shadow: var(--box-shadow-elevated);
        }

        .project-item h3 {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.8rem;
        }

        .project-item p {
            font-size: 1rem;
            color: var(--text-color-dark);
            margin-bottom: 0.8rem;
            line-height: 1.6;
        }

        .project-item a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .project-item a:hover {
            color: var(--accent-dark);
            text-decoration: underline;
        }

        .project-item form {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .project-item form input[type="text"],
        .project-item form input[type="email"],
        .project-item form textarea {
            width: 100%;
            padding: 0.7rem 1rem;
            margin-bottom: 0.8rem;
            border: 1px solid #dcdcdc;
            border-radius: var(--border-radius-sm);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .project-item form input:focus,
        .project-item form textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .project-item form button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        .project-item form button[type="submit"]:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .project-item .delete-btn {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: var(--border-radius-sm);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
            text-align: center;
        }

        .project-item .delete-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        hr {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 123, 255, 0.75), rgba(0, 0, 0, 0));
            margin: 4rem 0;
        }

        @media (max-width: 992px) {
            .admin-header {
                padding: 0.8rem 1.5rem;
            }
            .admin-header .welcome-text {
                font-size: 1rem;
            }
            .admin-section {
                padding: 2rem;
            }
            .section-title {
                font-size: 2rem;
            }
            .project-item {
                padding: 1.5rem;
            }
            .project-item h3 {
                font-size: 1.4rem;
            }
            .project-item p {
                font-size: 0.95rem;
            }
            .project-item form button[type="submit"],
            .project-item .delete-btn {
                padding: 0.7rem 1.2rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 0.5rem;
                padding: 1rem;
            }
            .admin-header .btn-outline-light {
                width: 100%;
                text-align: center;
            }
            .admin-section {
                padding: 1.5rem;
                margin-bottom: 2rem;
            }
            .section-title {
                font-size: 1.8rem;
                margin-bottom: 1.5rem;
            }
            .project-list {
                grid-template-columns: 1fr;
            }
            .project-item {
                padding: 1.2rem;
            }
            .project-item h3 {
                font-size: 1.2rem;
            }
            .project-item p {
                font-size: 0.9rem;
            }
            .project-item form {
                margin-top: 1rem;
                padding-top: 1rem;
            }
            hr {
                margin: 3rem 0;
            }
        }
    </style>
</head>

<body>
    <div class="admin-header">
        <a href="backend/logout.php" class="btn btn-sm btn-outline-light">Đăng xuất</a>
        <span class="welcome-text">Xin chào <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
    </div>

    <main class="container my-5">
        <div class="admin-section">
            <h2 class="section-title">Thêm Dự Án Mới</h2>
            <form action="backend/add_project.php" method="POST" class="modern-form">
                <div class="mb-3">
                    <input type="text" name="name" placeholder="Tên dự án" required class="form-control">
                </div>
                <div class="mb-3">
                    <textarea name="description" placeholder="Mô tả dự án" required class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <input type="text" name="link" placeholder="Link dự án" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="email" name="email_contact" placeholder="Email liên hệ" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Thêm dự án</button>
            </form>
        </div>

        <hr>

        <div class="admin-section">
            <h2 class="section-title">Danh Sách Dự Án</h2>
            <div class="project-list">
                <?php
                require 'backend/db.php';

                // Truy vấn danh sách dự án
                $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");

                // Kiểm tra lỗi truy vấn
                if (!$result) {
                    die("Lỗi truy vấn: " . $conn->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "<div class='project-item'>";
                    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<p><a href='" . htmlspecialchars($row['link']) . "' target='_blank'>Xem dự án</a></p>";
                    echo "<p>Liên hệ: " . htmlspecialchars($row['email_contact']) . "</p>";

                    // Form sửa dự án
                    echo "<form action='backend/update_project.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                    echo "<input type='text' name='name' value='" . htmlspecialchars($row['name']) . "' placeholder='Tên dự án'><br>";
                    echo "<textarea name='description' placeholder='Mô tả dự án'>" . htmlspecialchars($row['description']) . "</textarea><br>";
                    echo "<input type='text' name='link' value='" . htmlspecialchars($row['link']) . "' placeholder='Link dự án'><br>";
                    echo "<input type='email' name='email_contact' value='" . htmlspecialchars($row['email_contact']) . "' placeholder='Email liên hệ'><br>";
                    echo "<button type='submit'>Sửa</button>";
                    echo "</form>";

                    // Nút xoá
                    echo "<a href='backend/delete_project.php?id=" . htmlspecialchars($row['id']) . "' class='delete-btn' onclick=\"return confirm('Bạn có chắc muốn xoá dự án này không?')\">Xoá</a>";

                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </main>

    <footer class="text-center p-4 bg-dark text-white">
        <p class="mb-0">© 2024 Design Studio. All Rights Reserved.</p>
    </footer>
</body>

</html>