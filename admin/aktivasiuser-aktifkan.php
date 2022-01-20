<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];

if ($role != 'admin') {
    header("location:../deauth.php");
}
require('../config.php');
require('../vendor/myfunc.php');
require('../vendor/phpmailer/sendmail.php');
$aktif = mysqli_real_escape_string($conn, $_POST['aktif']);
$token = mysqli_real_escape_string($conn, $_POST['token']);
$namamhs = mysqli_real_escape_string($conn, $_POST['namamhs']);
$email = $_POST['email'];

$stmt = $conn->prepare("UPDATE pengguna
                              SET aktif=?
                              WHERE token=?");
$stmt->bind_param("ss", $aktif, $token);
$stmt->execute();

$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi/";
$subject = "Aktivasi Akun Sistem Manajemen Skripsi Jurusan FISIKA UIN Malang";
$pesan = "Yth. " . $namamhs . "
				<br/>
				Assalamualaikum Wr. Wb.
				<br/>
				Akun anda di sistem Manajemen Skripsi Jurusan FISIKA UIN Malang telah di aktifkan.
				<br/>
				Silahkan klik tombol berikut ini untuk mengakses sistem. 
				<br/>
				<a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
				<br/>
				atau klik <a href='" . $actual_link . "'>" . $actual_link . "</a>
                <br/>
				Wassalamualaiakum Wr. Wb.
				";
sendmail($email, $nama, $subject, $pesan);

header('location:aktivasiuser.php?pesan=success');
