<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
if ($role != 'admin') {
  header("location:../deauth.php");
}
require('../config.php');
$token = $_GET['token'];
echo $token;
//update status file proposal
$stmt = $conn->prepare("DELETE FROM pengguna
                        WHERE token=?");
$stmt->bind_param("s", $token);
$stmt->execute();
header('location:aktivasiuser.php?pesan=success');
