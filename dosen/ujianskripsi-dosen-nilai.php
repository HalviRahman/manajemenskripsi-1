<?php
session_start();
require('../config.php');
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
if ($role != 'dosen') {
    header("location:../deauth.php");
}

$nama = $_SESSION['nama'];
$nip = $_SESSION['nim'];
$nimmhs = $_POST['nimmhs'];
$token = $_POST['token'];

$pentingnyamasalah = $_POST['pentingnyamasalah'];
$keselarasan = $_POST['keselarasan'];
$analisadata = $_POST['analisadata'];
$kajianpustaka = $_POST['kajianpustaka'];
$paparandata = $_POST['paparandata'];
$alurpembahasan = $_POST['alurpembahasan'];
$kesimpulan = $_POST['kesimpulan'];
$penguasaanmateri = $_POST['penguasaanmateri'];
$sikap = $_POST['sikap'];
$penulisan = $_POST['penulisan'];

$stmt = $conn->prepare("SELECT * FROM nilaiskripsi WHERE nim=? AND penguji=?");
$stmt->bind_param("ss", $nimmhs, $nama);
$stmt->execute();
$result = $stmt->get_result();
$jdata = $result->num_rows;
if ($jdata > 0) {
    $stmt = $conn->prepare("UPDATE nilaiskripsi 
                            SET pentingnyamasalah=?,
                                keselarasan=?,
                                analisadata=?,
                                kajianpustaka=?,
                                paparandata=?,
                                alurpembahasan=?,
                                kesimpulan=?,
                                penguasaanmateri=?,
                                sikap=?,
                                penulisan=?
                                WHERE nim=? AND penguji=?");
    $stmt->bind_param("iiiiiiiiiiss", $pentingnyamasalah, $keselarasan, $analisadata, $kajianpustaka, $paparandata, $alurpembahasan, $kesimpulan, $penguasaanmateri, $sikap, $penulisan, $nimmhs, $nama);
    $stmt->execute();
} else {
    $stmt = $conn->prepare("INSERT INTO nilaiskripsi (nim,penguji,pentingnyamasalah,keselarasan,analisadata,kajianpustaka,paparandata,alurpembahasan,kesimpulan,penguasaanmateri,sikap,penulisan)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssiiiiiiiiii", $nimmhs, $nama, $pentingnyamasalah, $keselarasan, $analisadata, $kajianpustaka, $paparandata, $alurpembahasan, $kesimpulan, $penguasaanmateri, $sikap, $penulisan);
    $stmt->execute();
}

$nilai = ($pentingnyamasalah + $keselarasan + $analisadata + $kajianpustaka +
    $paparandata + $alurpembahasan + $kesimpulan + $penguasaanmateri +
    $sikap + $penulisan) * 2;
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
