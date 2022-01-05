<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$token = $_POST['token'];
if ($role != 'admin') {
    header("location:../deauth.php");
}
require('../config.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE ujianproposal
                        SET verifikasifile=1
                        WHERE token=?");
$stmt->bind_param("s", $token);
$stmt->execute();
header('location:index.php?pesan=adminsetujui');
