<?php
session_start();
require('../config.php');
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$bidang = $_POST['bidang'];
$judul = $_POST['judul'];
$pembimbing = $_POST['pembimbing'];
$penguji1 = $_POST['penguji1'];
$penguji2 = $_POST['penguji2'];

$token = md5(microtime());

date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

//upload file
$target_dir = "../lampiran/";
$sklproposal = $target_dir . $nim . "-sklproposal" . ".jpg";
$sklkompre = $target_dir . $nim . "-sklkompre" . ".jpg";
$fileproposal = $target_dir . $nim . "-laporansemhas" . ".pdf";
$uploadOk = 1;

//ambil extensi file
$extsklproposal = strtolower(pathinfo($sklproposal, PATHINFO_EXTENSION));
$extsklkompre = strtolower(pathinfo($sklkompre, PATHINFO_EXTENSION));
$extfileproposal = strtolower(pathinfo($fileproposal, PATHINFO_EXTENSION));

// Check file size
if ($_FILES["sklproposal"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize persetujuan pembimbing over';
}
if ($_FILES["sklkompre"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize khs over';
}
if ($_FILES["fileproposal"]["size"] > 5242880) {
    $uploadOk = 0;
    echo 'filesize proposal over';
}


// check file extention
if ($extsklproposal != "jpg" && $extsklproposal != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi persetujuan pembimbing';
}
if ($extsklkompre != "jpg" && $extsklkompre != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi khs';
}
if ($extfileproposal != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi file proposal';
}

// check file MIME
$mimetype = mime_content_type($_FILES['sklproposal']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}
$mimetype = mime_content_type($_FILES['sklkompre']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    header("location:ujianproposal-isi.php?pesan=gagal");
    //echo 'something wrong';
} else {
    move_uploaded_file($_FILES["sklproposal"]["tmp_name"], $sklproposal);
    move_uploaded_file($_FILES["sklkompre"]["tmp_name"], $sklkompre);
    move_uploaded_file($_FILES["fileproposal"]["tmp_name"], $fileproposal);
    $stmt = $conn->prepare("INSERT INTO semhas (tanggal,nama,nim,bidang,judul,sklproposal,sklkompre,proposal,pembimbing,penguji1,penguji2,token)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssss", $tanggal, $nama, $nim, $bidang, $judul, $sklproposal, $sklkompre, $fileproposal, $pembimbing, $penguji1, $penguji2, $token);
    $stmt->execute();
    header("location:index.php?pesan=success");
    //echo 'success';
}
