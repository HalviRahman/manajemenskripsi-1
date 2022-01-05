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
$filepersetujuanpembimbing = $target_dir . $nim . "-persetujuanpembimbing" . ".jpg";
$filekhs = $target_dir . $nim . "-khs" . ".jpg";
$fileproposal = $target_dir . $nim . "-proposal" . ".pdf";
$uploadOk = 1;

//ambil extensi file
$extpersetujuanpembimbing = strtolower(pathinfo($filepersetujuanpembimbing, PATHINFO_EXTENSION));
$extkhs = strtolower(pathinfo($filekhs, PATHINFO_EXTENSION));
$extfileproposal = strtolower(pathinfo($fileproposal, PATHINFO_EXTENSION));

//hapus apabila file sudah ada
/*
unlink($filepersetujuanpembimbing);
unlink($filekhs);
unlink($fileproposal);
*/

// Check file size
if ($_FILES["persetujuanpembimbing"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize persetujuan pembimbing over';
}
if ($_FILES["khs"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize khs over';
}
if ($_FILES["fileproposal"]["size"] > 5242880) {
    $uploadOk = 0;
    echo 'filesize proposal over';
}


// check file extention
if ($extpersetujuanpembimbing != "jpg" && $imageFileType != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi persetujuan pembimbing';
}
if ($extkhs != "jpg" && $imageFileType != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi khs';
}
if ($extfileproposal != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi file proposal';
}

// check file MIME
$mimetype = mime_content_type($_FILES['persetujuanpembimbing']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}
$mimetype = mime_content_type($_FILES['khs']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    header("location:ujianproposal-isi.php?pesan=gagal");
    //echo 'something wrong';
} else {
    move_uploaded_file($_FILES["persetujuanpembimbing"]["tmp_name"], $filepersetujuanpembimbing);
    move_uploaded_file($_FILES["khs"]["tmp_name"], $filekhs);
    move_uploaded_file($_FILES["fileproposal"]["tmp_name"], $fileproposal);
    $stmt = $conn->prepare("INSERT INTO ujianproposal (tanggal,nama,nim,bidang,judul,persetujuanpembimbing,khs,proposal,pembimbing,token)
        VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssss", $tanggal, $nama, $nim, $bidang, $judul, $filepersetujuanpembimbing, $filekhs, $fileproposal, $pembimbing, $token);
    $stmt->execute();
    header("location:index.php?pesan=success");
    //echo 'success';
}
