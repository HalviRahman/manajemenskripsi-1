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
$target_file = $target_dir . $nim . "-proposal" . ".pdf";
$uploadOk = 1;
$extfileproposal = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//hapus apabila file sudah ada
//unlink($target_file);

// Check file size
if ($_FILES["fileproposal"]["size"] > 5242880) {
    $uploadOk = 0;
}

//check format file
if ($extfileproposal != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi file proposal';
}


if ($uploadOk == 0) {
    header("location:ujiankompre-isi.php?pesan=gagal");
    //echo 'something wrong';
} else {
    if (move_uploaded_file($_FILES["fileproposal"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO ujiankompre (tanggal,nama,nim,bidang,judul,fileproposal,pembimbing,token)
        VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $tanggal, $nama, $nim, $bidang, $judul, $target_file, $pembimbing, $token);
        $stmt->execute();
        header("location:index.php?pesan=success");
        //echo 'success';
    } else {
        header("location:index.php?pesan=gagal");
        //echo 'failed upload';
    }
}
