<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$token = $_POST['token'];
$jadwalujian = $_POST['jadwalujian'];
$ruangan = $_POST['ruangan'];
$linkzoom = urlencode($_POST['linkzoom']);
if ($role != 'admin') {
    header("location:../deauth.php");
}
require('../config.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE ujiankompre
                        SET jadwalujian=?,
                            ruang=?,
                            linkzoom=?,
                            status=3
                        WHERE token=?");
$stmt->bind_param("ssss", $jadwalujian, $ruangan, $linkzoom, $token);
$stmt->execute();
header('location:index.php?pesan=adminsetujui');
