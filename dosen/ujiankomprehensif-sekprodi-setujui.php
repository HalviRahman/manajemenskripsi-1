<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$nimmhs = $_POST['nimmhs'];
$namamhs = $_POST['namamhs'];
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
require('../vendor/phpmailer/sendmail.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE ujiankompre
                        SET status=1,
                            penguji1=?,
                            penguji2=?
                        WHERE token=?");
$stmt->bind_param("sss", $penguji1, $penguji2, $token);
$stmt->execute();

//kirim email notifikasi ke admin untuk penjadwalan
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE role='admin'");
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailadmin = $dhasil['email'];
$namaadmin = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Notifikasi Pengajuan Ujian Komprehensif";
$pesan = "Yth. " . $namaadmin . "
        <br/>
        Assalamualaikum Wr. Wb.
        <br/>
        Pengajuan <b>Ujian Komprehensif</b> atas nama " . $namamhs . " NIM " . $nimmhs . " telah di setujui oleh sekprodi.
        <br/>
        Silahkan klik tombol berikut ini menjadwalkan ujian tersebut.
        <br/>
        <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
        <br/>
        Wassalamualaikum Wr. Wb.
        ";
sendmail($emailadmin, $namaadmin, $subject, $pesan);

header('location:index.php?pesan=pengajuankompresetujui');
