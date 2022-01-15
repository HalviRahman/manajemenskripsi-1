<?php
session_start();
require('../config.php');
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
if ($role != 'dosen') {
    header("location:../deauth.php");
}

$nama = $_SESSION['nama'];
$nip = $_SESSION['nim'];
$token = $_POST['token'];

$nilai = $_POST['nilai'];
$revisi = $_POST['revisi'];
$penguji = $_POST['penguji'];
if ($nilai > 100 or $nilai < 0) {
    header("location:semhas-dosen-detail.php?token=$token&pesan=nilaierror");
} else {
    if ($penguji == 'KETUA PENGUJI') {
        $stmt = $conn->prepare("UPDATE semhas
                            SET status=4,
                                nilai1=?,
                                revisi1=?
                            WHERE token=?");
        $stmt->bind_param("iss", $nilai, $revisi, $token);
        $stmt->execute();
    } elseif ($penguji == 'PENGUJI ANGGOTA') {
        $stmt = $conn->prepare("UPDATE semhas
                            SET status=4,
                                nilai2=?,
                                revisi2=?
                            WHERE token=?");
        $stmt->bind_param("iss", $nilai, $revisi, $token);
        $stmt->execute();
    } elseif ($penguji == 'PEMBIMBING') {
        $stmt = $conn->prepare("UPDATE semhas
                            SET status=4,
                                nilaipembimbing=?,
                                revisipembimbing=?
                            WHERE token=?");
        $stmt->bind_param("iss", $nilai, $revisi, $token);
        $stmt->execute();
    }
    header('location:index.php?pesan=nilaiok');
}
