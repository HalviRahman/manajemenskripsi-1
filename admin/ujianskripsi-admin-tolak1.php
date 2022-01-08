<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$token = $_POST['token'];
$keterangan = $_POST['keterangan'];
if ($role != 'admin') {
    header("location:../deauth.php");
}
require('../config.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE ujianskripsi
                        SET verifikasifile=2,
                            keterangan=?
                        WHERE token=?");
$stmt->bind_param("ss", $keterangan, $token);
$stmt->execute();
header('location:index.php?pesan=admintolak');
