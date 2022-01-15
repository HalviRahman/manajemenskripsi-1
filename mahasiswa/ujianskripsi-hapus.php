<?php
session_start();
require('../config.php');
$nim = $_SESSION['nim'];
$token = $_GET['token'];
$stmt = $conn->prepare("DELETE FROM ujianskripsi WHERE nim=? AND token=?");
$stmt->bind_param("ss", $nim, $token);
$stmt->execute();
header("location:index.php?pesan=success");
