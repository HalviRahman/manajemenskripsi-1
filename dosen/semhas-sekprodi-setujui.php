<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$pembimbing = $_POST['pembimbing'];
$penguji1 = $_POST['penguji1'];
$penguji2 = $_POST['penguji2'];
$token = $_POST['token'];
if ($role != 'dosen') {
    if ($jabatan != 'kaprodi' || $jabatan != 'sekprodi') {
        header("location:../deauth.php");
    }
}
require('../config.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE semhas
                        SET status=1,
                            penguji1=?,
                            penguji2=?
                        WHERE token=?");
$stmt->bind_param("sss", $penguji1, $penguji2, $token);
$stmt->execute();
header('location:index.php?pesan=semhassetujui');
