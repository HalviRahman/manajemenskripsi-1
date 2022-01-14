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

$keputusan = $_POST['keputusan'];
$revisi = $_POST['revisi'];
$penguji = $_POST['penguji'];

if ($keputusan == 'DITOLAK') {
    $status = 2;
} else {
    $tatus = 4;
}

if ($penguji == 'PENGUJI KETUA') {
    $stmt = $conn->prepare("UPDATE ujianproposal
                            SET status=?,
                                nilai1=?,
                                revisi1=?
                            WHERE token=?");
    $stmt->bind_param("isss", $status, $keputusan, $revisi, $token);
    $stmt->execute();
} elseif ($penguji == 'PENGUJI ANGGOTA') {
    $stmt = $conn->prepare("UPDATE ujianproposal
                            SET status=?,
                                nilai2=?,
                                revisi2=?
                            WHERE token=?");
    $stmt->bind_param("isss", $status, $keputusan, $revisi, $token);
    $stmt->execute();
} elseif ($penguji == 'PEMBIMBING') {
    $stmt = $conn->prepare("UPDATE ujianproposal
                            SET status=?,
                                nilaipembimbing=?,
                                revisipembimbing=?
                            WHERE token=?");
    $stmt->bind_param("isss", $status, $keputusan, $revisi, $token);
    $stmt->execute();
}
header('location:index.php?pesan=nilaiok');
