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

if ($penguji == 'Penguji Ketua') {
    $stmt = $conn->prepare("UPDATE ujianskripsi
                            SET status=4,
                                nilai1=?,
                                revisi1=?
                            WHERE token=?");
    $stmt->bind_param("iss", $nilai, $revisi, $token);
    $stmt->execute();
} elseif ($penguji == 'PENGUJI ANGGOTA') {
    $stmt = $conn->prepare("UPDATE ujianskripsi
                            SET status=4,
                                nilai2=?,
                                revisi2=?
                            WHERE token=?");
    $stmt->bind_param("iss", $nilai, $revisi, $token);
    $stmt->execute();
} elseif ($penguji == 'PENGUJI INTEGRASI') {
    $stmt = $conn->prepare("UPDATE ujianskripsi
                        SET status=4,
                            nilai3=?,
                            revisi3=?
                        WHERE token=?");
    $stmt->bind_param("iss", $nilai, $revisi, $token);
    $stmt->execute();
} elseif ($penguji == 'PEMBIMBING') {
    $stmt = $conn->prepare("UPDATE ujianskripsi
                        SET status=4,
                            nilaipembimbing=?,
                            revisipembimbing=?
                        WHERE token=?");
    $stmt->bind_param("iss", $nilai, $revisi, $token);
    $stmt->execute();
}
header('location:index.php?pesan=nilaiok');
