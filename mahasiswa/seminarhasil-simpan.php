<?php
session_start();
require('../config.php');
require('../vendor/phpmailer/sendmail.php');
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$bidang = $_POST['bidang'];
$judul = $_POST['judul'];
$pembimbing = $_POST['pembimbing'];
$penguji1 = $_POST['penguji1'];
$penguji2 = $_POST['penguji2'];
$namamhs = $_POST['namamhs'];
$nimmhs = $_POST['nimmhs'];

$token = md5(microtime());

date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

//upload file
$target_dir = "../lampiran/";
$sklproposal = $target_dir . $nim . "-sklproposal" . ".pdf";
$sklkompre = $target_dir . $nim . "-sklkompre" . ".pdf";
$kartukendali = $target_dir . $nim . "-kartukendali" . ".jpg";
$lembarpersetujuan = $target_dir . $nim . "-lembarpersetujuan" . ".jpg";
$fileproposal = $target_dir . $nim . "-laporansemhas" . ".pdf";
$uploadOk = 1;

//ambil extensi file
$extsklproposal = strtolower(pathinfo($sklproposal, PATHINFO_EXTENSION));
$extsklkompre = strtolower(pathinfo($sklkompre, PATHINFO_EXTENSION));
$extkartukendali = strtolower(pathinfo($kartukendali, PATHINFO_EXTENSION));
$extlembarpersetujuan = strtolower(pathinfo($lembarpersetujuan, PATHINFO_EXTENSION));
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
if ($_FILES["kartukendali"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize kartukendali over';
}
if ($_FILES["lembarpersetujuan"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize lembarpersetujuan over';
}
if ($_FILES["fileproposal"]["size"] > 10485760) {
    $uploadOk = 0;
    echo 'filesize proposal over';
}

// check file extention
if ($extsklproposal != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi persetujuan pembimbing';
}
if ($extsklkompre != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi persetujuan pembimbing';
}
if ($extkartukendali != "jpg" && $extkartukendali != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi kartu kendali';
}
if ($extlembarpersetujuan != "jpg" && $extlembarpersetujuan != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi lembar persetujuan';
}
if ($extfileproposal != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi file proposal';
}

// check file MIME
$mimetype = mime_content_type($_FILES['kartukendali']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}
$mimetype = mime_content_type($_FILES['lembarpersetujuan']['tmp_name']);
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
    move_uploaded_file($_FILES["kartukendali"]["tmp_name"], $kartukendali);
    move_uploaded_file($_FILES["lembarpersetujuan"]["tmp_name"], $lembarpersetujuan);
    move_uploaded_file($_FILES["fileproposal"]["tmp_name"], $fileproposal);
    $stmt = $conn->prepare("INSERT INTO semhas (tanggal,nama,nim,bidang,judul,sklproposal,sklkompre,kartukendali,lembarpersetujuan,proposal,pembimbing,penguji1,penguji2,token)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssssss", $tanggal, $nama, $nim, $bidang, $judul, $sklproposal, $sklkompre, $kartukendali, $lembarpersetujuan, $fileproposal, $pembimbing, $penguji1, $penguji2, $token);
    $stmt->execute();

    //kirim email notifikasi ke admin
    $stmt = $conn->prepare("SELECT * FROM pengguna WHERE role='admin'");
    $stmt->execute();
    $result = $stmt->get_result();
    $dhasil = $result->fetch_assoc();
    $emailfak = $dhasil['email'];
    $namaadmin = $dhasil['nama'];
    $actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
    $subject = "Pengajuan Ujian Seminar Hasil";
    $pesan = "Yth. " . $namaadmin . "
                            <br/>
                            Assalamualaikum Wr. Wb.
                            <br/>
                            Terdapat pengajuan <b>Ujian Seminar Hasil</b> atas nama " . $namamhs . " NIM " . $nimmhs . ".
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
