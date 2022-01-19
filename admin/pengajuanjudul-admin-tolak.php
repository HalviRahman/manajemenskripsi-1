<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$namamhs = $_POST['namamhs'];
$nimmhs = $_POST['nimmhs'];
$token = $_POST['token'];
$keterangan = $_POST['keterangan'];
if ($role != 'admin') {
    header("location:../deauth.php");
}
require('../config.php');
require('../vendor/phpmailer/sendmail.php');
require('../vendor/myfunc.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE pengajuanjudul
                        SET verifikasifile=2,
                            keterangan=?
                        WHERE token=?");
$stmt->bind_param("ss", $keterangan, $token);
$stmt->execute();

//kirim email notifikasi ke mahasiswa
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $namamhs);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailmhs = $dhasil['email'];
$namamhs = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Notifikasi Penolakan Pengajuan Judul";
$pesan = "Yth. " . $namamhs . "
        <br/>
        Assalamualaikum Wr. Wb.
        <br/>
        Mohon maaf pengajuan judul skripsi anda <b>di tolak</b> oleh Program Studi dengan alasan <b>" . $keterangan . "</b>.
        <br/>
        Informasi detail terkait pengajuan tersebut silahkan klik tombol berikut ini
        <br/>
        <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
        <br/>
        Wassalamualaikum Wr. Wb.
        ";
sendmail($emailmhs, $namamhs, $subject, $pesan);

header('location:index.php?pesan=admintolak');
