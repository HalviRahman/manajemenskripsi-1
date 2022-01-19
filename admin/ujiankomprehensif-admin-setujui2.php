<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$token = $_POST['token'];
$pembimbing = $_POST['pembimbing'];
$penguji1 = $_POST['penguji1'];
$penguji2 = $_POST['penguji2'];
$namamhs = $_POST['nama'];
$nimmhs = $_POST['nim'];
$jadwalujian = $_POST['jadwalujian'];
$ruangan = $_POST['ruangan'];
$linkzoom = urlencode($_POST['linkzoom']);
if ($role != 'admin') {
        header("location:../deauth.php");
}
require('../config.php');
require('../vendor/phpmailer/sendmail.php');
require('../vendor/myfunc.php');

//update status file proposal
$stmt = $conn->prepare("UPDATE ujiankompre
                        SET jadwalujian=?,
                            ruang=?,
                            linkzoom=?,
                            status=3
                        WHERE token=?");
$stmt->bind_param("ssss", $jadwalujian, $ruangan, $linkzoom, $token);
$stmt->execute();

//kirim email notifikasi ke pembimbing
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $pembimbing);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailpembimbing = $dhasil['email'];
$namapembimbing = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Notifikasi Pelaksanaan Ujian Komprehensif";
$pesan = "Yth. " . $namapembimbing . "
        <br/>
        Assalamualaikum Wr. Wb.
        <br/>
        Anda dijadwalkan untuk <b>Ujian Komprehensif</b> Mahasiswa atas nama " . $namamhs . " NIM " . $nimmhs . " <b>sebagai PEMBIMBING</b> pada :
        <br/>
        Hari : " . hari(date('N', strtotime($jadwalujian))) . "
        <br/>
        Tanggal : " . tgljam_indo($jadwalujian) . "
        <br/>
        Tempat : " . $ruangan . "
        <br/>
        Dimohon hadir tepat waktu.
        <br/>
        Informasi detail terkait ujian tersebut silahkan klik tombol berikut ini
        <br/>
        <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
        <br/>
        Wassalamualaikum Wr. Wb.
        ";
sendmail($emailpembimbing, $namapembimbing, $subject, $pesan);

//kirim email notifikasi ke penguji1
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $penguji1);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailpenguji1 = $dhasil['email'];
$namapenguji1 = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Notifikasi Pelaksanaan Ujian Komprehensif";
$pesan = "Yth. " . $namapenguji1 . "
        <br/>
        Assalamualaikum Wr. Wb.
        <br/>
        Anda dijadwalkan untuk <b>Ujian Komprehensif</b> Mahasiswa atas nama " . $namamhs . " NIM " . $nimmhs . " <b>sebagai KETUA PENGUJI</b> pada :
        <br/>
        Hari : " . hari(date('N', strtotime($jadwalujian))) . "
        <br/>
        Tanggal : " . tgljam_indo($jadwalujian) . "
        <br/>
        Tempat : " . $ruangan . "
        <br/>
        Dimohon hadir tepat waktu.
        <br/>
        Informasi detail terkait ujian tersebut silahkan klik tombol berikut ini
        <br/>
        <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
        <br/>
        Wassalamualaikum Wr. Wb.
        ";
sendmail($emailpenguji1, $namapenguji1, $subject, $pesan);

//kirim email notifikasi ke penguji2
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $penguji2);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailpenguji2 = $dhasil['email'];
$namapenguji2 = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Notifikasi Pelaksanaan Ujian Komprehensif";
$pesan = "Yth. " . $namapenguji2 . "
        <br/>
        Assalamualaikum Wr. Wb.
        <br/>
        Anda dijadwalkan untuk <b>Ujian Komprehensif</b> Mahasiswa atas nama " . $namamhs . " NIM " . $nimmhs . " <b>sebagai KETUA PENGUJI</b> pada :
        <br/>
        Hari : " . hari(date('N', strtotime($jadwalujian))) . "
        <br/>
        Tanggal : " . tgljam_indo($jadwalujian) . "
        <br/>
        Tempat : " . $ruangan . "
        <br/>
        Dimohon hadir tepat waktu.
        <br/>
        Informasi detail terkait ujian tersebut silahkan klik tombol berikut ini
        <br/>
        <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
        <br/>
        Wassalamualaikum Wr. Wb.
        ";
sendmail($emailpenguji2, $namapenguji2, $subject, $pesan);

//kirim email notifikasi ke mahasiswa
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $namamhs);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$emailmhs = $dhasil['email'];
$namamhs = $dhasil['nama'];
$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
$subject = "Notifikasi Pelaksanaan Ujian Komprehensif";
$pesan = "Yth. " . $namamhs . "
        <br/>
        Assalamualaikum Wr. Wb.
        <br/>
        Anda dijadwalkan untuk <b>Ujian Komprehensif</b> Mahasiswa pada :
        <br/>
        Hari : " . hari(date('N', strtotime($jadwalujian))) . "
        <br/>
        Tanggal : " . tgljam_indo($jadwalujian) . "
        <br/>
        Tempat : " . $ruangan . "
        <br/>
        Dimohon hadir tepat waktu.
        <br/>
        Informasi detail terkait ujian tersebut silahkan klik tombol berikut ini
        <br/>
        <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
        <br/>
        Wassalamualaikum Wr. Wb.
        ";
sendmail($emailmhs, $namamhs, $subject, $pesan);

header('location:index.php?pesan=adminsetujui');
