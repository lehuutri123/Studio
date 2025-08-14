<?php
require 'db.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.html");
  exit();
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM du_an WHERE id = $id";
  $conn->query($sql);
}

header("Location: ../admin/dashboard.php");
exit();
