<?php
session_start();
require('../config.php');
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$bidang = $_POST['bidang'];
$judul = $_POST['judul'];
$token = md5(microtime());
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

//ambil data dosen pembimbing
$stmt = $conn->prepare("SELECT * FROM pengajuanjudul WHERE nim=?");
$stmt->bind_param("s", $nim,);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$pembimbing = $dhasil['pembimbing'];


//upload file
$target_dir = "../lampiran/";
$proposal = $target_dir . $nim . "-proposal" . ".pdf";
$judulskripsi = $target_dir . $nim . "-judulskripsi" . ".jpg";
$transkrip = $target_dir . $nim . "-transkrip" . ".jpg";
$ijazah = $target_dir . $nim . "-ijazah" . ".jpg";

$uploadOk = 1;

$extproposal = strtolower(pathinfo($proposal, PATHINFO_EXTENSION));
$extjudulskripsi = strtolower(pathinfo($judulskripsi, PATHINFO_EXTENSION));
$exttranskrip = strtolower(pathinfo($transkrip, PATHINFO_EXTENSION));
$extijazah = strtolower(pathinfo($ijazah, PATHINFO_EXTENSION));

//check format file
if ($extproposal != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi file proposal salah';
}
if ($extjudulskripsi != "jpg" && $extjudulskripsi != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi file judul skripsi salah';
}
if ($exttranskrip != "jpg" && $exttranskrip != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi file transkrip salah';
}
if ($extijazah != "jpg" && $extijazah != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi file ijazah salah';
}

// Check file size
if ($_FILES["fileproposal"]["size"] > 5242880) {
    $uploadOk = 0;
    echo 'file proposal oversize';
}
if ($_FILES["judulskripsi"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'file judul skripsi oversize';
}
if ($_FILES["transkrip"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'file transkrip oversize';
}
if ($_FILES["ijazah"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'file ijazah oversize';
}

if ($uploadOk == 0) {
    header("location:ujiankompre-isi.php?pesan=gagal");
    echo 'something wrong';
} else {
    move_uploaded_file($_FILES["fileproposal"]["tmp_name"], $proposal);
    move_uploaded_file($_FILES["judulskripsi"]["tmp_name"], $judulskripsi);
    move_uploaded_file($_FILES["transkrip"]["tmp_name"], $transkrip);
    move_uploaded_file($_FILES["ijazah"]["tmp_name"], $ijazah);
    $stmt = $conn->prepare("INSERT INTO ujiankompre (tanggal,nama,nim,bidang,judul,judulskripsi,transkrip,ijazah,fileproposal,pembimbing,token)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssss", $tanggal, $nama, $nim, $bidang, $judul, $judulskripsi, $transkrip, $ijazah, $proposal, $pembimbing, $token);
    $stmt->execute();
    header("location:index.php?pesan=success");
    echo 'success';
}
