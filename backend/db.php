
<?php
$conn = new mysqli("localhost", "root", "", "db_noithat_studio");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
