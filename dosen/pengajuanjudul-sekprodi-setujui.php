<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$pembimbing = $_POST['pembimbing'];
$token = $_POST['token'];
if ($role != 'dosen') {
    if ($jabatan != 'kaprodi' || $jabatan != 'sekprodi') {
        header("location:../deauth.php");
    }
}
require('../config.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE pengajuanjudul
                        SET status=1,
                            pembimbing=?
                        WHERE token=?");
$stmt->bind_param("ss", $pembimbing, $token);
$stmt->execute();
header('location:index.php?pesan=pengajuanjudulsetujui');
