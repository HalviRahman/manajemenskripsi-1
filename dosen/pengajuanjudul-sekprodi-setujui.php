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
$nimmhs = $_POST['nimmhs'];
if ($role != 'dosen') {
    if ($jabatan != 'kaprodi' || $jabatan != 'sekprodi') {
        header("location:../deauth.php");
    }
}
require('../config.php');
require('../vendor/phpmailer/sendmail.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE pengajuanjudul
                        SET status=1,
                            pembimbing=?
                        WHERE token=?");
$stmt->bind_param("ss", $pembimbing, $token);
$stmt->execute();

//kirim email notifikasi ke mahasiswa
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE nim=?");
$stmt->bind_param("s", $nimmhs);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailmhs = $dhasil['email'];
$namamhs = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Pengajuan Judul Skripsi Disetujui";
$pesan = "Yth. " . $namamhs . "
                            <br/>
                            Assalamualaikum Wr. Wb.
                            <br/>
                            Selamat!! Pengajuan judul skripsi anda telah disetujui dengan dosen pembimbing " . $pembimbing . ".
                            <br/>
                            Silahkan klik tombol berikut ini untuk melakukan proses selanjutnya.
                            <br/>
                            <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
                            <br/>
                            Wassalamualaikum Wr. Wb.
                            ";
sendmail($emailmhs, $namamhs, $subject, $pesan);

//kirim email notifikasi ke dosen pembimbing
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $pembimbing);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailpembimbing = $dhasil['email'];
$namapembimbing = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Notifikasi Mahasiswa Bimbingan";
$pesan = "Yth. " . $namapembimbing . "
        <br/>
        Assalamualaikum Wr. Wb.
        <br/>
        Anda di tugaskan sebagai Dosen Pembimbing untuk Skripsi Mahasiswa atas nama " . $namamhs . ".
        <br/>
        Silahkan klik tombol berikut ini untuk melihat detail pengajuan judul mahasiswa tersebut.
        <br/>
        <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
        <br/>
        Wassalamualaikum Wr. Wb.
        ";
sendmail($emailpembimbing, $namapembimbing, $subject, $pesan);

header('location:index.php?pesan=pengajuanjudulsetujui');
