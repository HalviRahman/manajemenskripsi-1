<?php
session_start();
require('../config.php');
require('../vendor/phpmailer/sendmail.php');
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
$sklsempro = $target_dir . $nim . "-sklsempro" . ".pdf";

$uploadOk = 1;

$extproposal = strtolower(pathinfo($proposal, PATHINFO_EXTENSION));
$extsklsempro = strtolower(pathinfo($sklsempro, PATHINFO_EXTENSION));

//check format file
if ($extproposal != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi file proposal salah';
}
if ($extsklsempro != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi SKL Sempro salah';
}

// Check file size
if ($_FILES["fileproposal"]["size"] > 10485760) {
    $uploadOk = 0;
    echo 'file proposal oversize';
}
if ($_FILES["sklsempro"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'file SKL Sempro oversize';
}


if ($uploadOk == 0) {
    header("location:ujiankompre-isi.php?pesan=gagal");
    //echo 'something wrong';
} else {
    move_uploaded_file($_FILES["fileproposal"]["tmp_name"], $proposal);
    move_uploaded_file($_FILES["sklsempro"]["tmp_name"], $sklsempro);
    $stmt = $conn->prepare("INSERT INTO ujiankompre (tanggal,nama,nim,bidang,judul,judulskripsi,sklsempro,fileproposal,pembimbing,token)
                            VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssss", $tanggal, $nama, $nim, $bidang, $judul, $judulskripsi, $sklsempro, $proposal, $pembimbing, $token);
    $stmt->execute();

    //kirim email notifikasi ke admin
    $stmt = $conn->prepare("SELECT * FROM pengguna WHERE role='admin'");
    $stmt->execute();
    $result = $stmt->get_result();
    $dhasil = $result->fetch_assoc();
    $emailfak = $dhasil['email'];
    $namaadmin = $dhasil['nama'];
    $actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
    $subject = "Pengajuan Ujian Komprehensif";
    $pesan = "Yth. " . $namaadmin . "
                                <br/>
                                Assalamualaikum Wr. Wb.
                                <br/>
                                Terdapat pengajuan <b>Ujian Komprehensif</b> atas nama " . $nama . " NIM " . $nim . ".
                                <br/>
                                Silahkan klik tombol berikut ini untuk melakukan verifikasi dokumen.
                                <br/>
                                <a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
                                <br/>
                                Wassalamualaikum Wr. Wb.
                                ";
    sendmail($emailfak, $namaadmin, $subject, $pesan);

    header("location:index.php?pesan=success");
    //echo 'success';
}
