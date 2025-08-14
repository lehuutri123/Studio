<?php
session_start();
if ($_SESSION['role'] != 'admin') die("Không có quyền truy cập");
require 'db.php';
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$link = $_POST['link'];
$email = $_POST['email_contact'];
$sql = "UPDATE projects SET name='$name', description='$description', link='$link', email_contact='$email' WHERE id=$id";
$conn->query($sql);
header("Location: ../admin.html");
?>