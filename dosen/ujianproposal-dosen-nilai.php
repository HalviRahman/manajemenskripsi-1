<?php
session_start();
require('../config.php');
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
if ($role != 'dosen') {
    if ($jabatan != 'kaprodi' || $jabatan != 'sekprodi') {
        header("location:../deauth.php");
    }
}

$nama = $_SESSION['nama'];
$nip = $_SESSION['nim'];
$token = $_POST['token'];

$nilai = $_POST['nilai'];
$revisi = $_POST['revisi'];
$penguji = $_POST['penguji'];

if ($penguji == 'PENGUJI KETUA') {
    $stmt = $conn->prepare("UPDATE ujianproposal
                            SET status=4,
                                nilai1=?,
                                revisi1=?
                            WHERE token=?");
    $stmt->bind_param("iss", $nilai, $revisi, $token);
    $stmt->execute();
} elseif ($penguji == 'PENGUJI ANGGOTA') {
    $stmt = $conn->prepare("UPDATE ujianproposal
                            SET status=4,
                                nilai2=?,
                                revisi2=?
                            WHERE token=?");
    $stmt->bind_param("iss", $nilai, $revisi, $token);
    $stmt->execute();
}
header('location:index.php?pesan=nilaiok');
