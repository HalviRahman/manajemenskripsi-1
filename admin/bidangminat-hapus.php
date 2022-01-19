<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$no = $_GET['no'];
$keterangan = $_POST['keterangan'];
if ($role != 'admin') {
  header("location:../deauth.php");
}
require('../config.php');

//update status file proposal
$stmt = $conn->prepare("DELETE FROM bidangminat
                        WHERE no=?");
$stmt->bind_param("i", $no);
$stmt->execute();
header('location:bidangminat.php?pesan=success');