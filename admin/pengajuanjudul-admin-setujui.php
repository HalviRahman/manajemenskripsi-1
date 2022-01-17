<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$namamhs = $_POST['nama'];
$nimmhs = $_POST['nim'];
$token = $_POST['token'];
if ($role != 'admin') {
    header("location:../deauth.php");
}
require('../config.php');
require('../vendor/phpmailer/sendmail.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE pengajuanjudul
                        SET verifikasifile=1
                        WHERE token=?");
$stmt->bind_param("s", $token);
$stmt->execute();

//kirim email notifikasi ke sekprodi
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE jabatan='sekprodi'");
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailfak = $dhasil['email'];
$namaadmin = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Pengajuan Judul Skripsi";
$pesan = "Yth. " . $namaadmin . "
                            <br/>
                            Assalamualaikum Wr. Wb.
                            <br/>
                            Terdapat pengajuan judul skripsi atas nama " . $namamhs . " NIM " . $nimmhs . ".
                            <br/>
                            Admin prodi telah melakukan verifikasi dokumen pada pengajuan judul ini dan dokumen dinyatakan valid.
                            <br/>
                            Silahkan klik tombol berikut ini untuk melakukan verifikasi.
                            <br/>
                            <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
                            <br/>
                            Wassalamualaikum Wr. Wb.
                            ";
sendmail($emailfak, $namaadmin, $subject, $pesan);

header('location:index.php?pesan=adminsetujui');
