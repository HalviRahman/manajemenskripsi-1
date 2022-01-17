<?php
require('../config.php');
require('../vendor/phpmailer/sendmail.php');
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$bidang = $_POST['bidang'];
$judul = mysqli_real_escape_string($conn, $_POST['judul']);
$token = md5(microtime());
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

//upload file
$target_dir = "../lampiran/";
$target_file = $target_dir . $nim . "-pengajuanjudul" . ".jpg";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//hapus apabila file sudah ada
unlink($target_file);

// Check file size
if ($_FILES["proposal"]["size"] > 1048576) {
    $uploadOk = 0;
}

// check file extention
if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
    $uploadOk = 0;
}

// check file MIME
$mimetype = mime_content_type($_FILES['proposal']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    header("location:pengajuanjudul-isi.php?pesan=gagal");
    //echo 'something wrong';
} else {
    if (move_uploaded_file($_FILES["proposal"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO pengajuanjudul (tanggal,nama,nim,bidang,judul,fileproposal,token)
        VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $tanggal, $nama, $nim, $bidang, $judul, $target_file, $token);
        $stmt->execute();

        //kirim email notifikasi ke admin
        $stmt = $conn->prepare("SELECT * FROM pengguna WHERE role='admin'");
        $stmt->execute();
        $result = $stmt->get_result();
        $dhasil = $result->fetch_assoc();
        $emailfak = $dhasil['email'];
        $namaadmin = $dhasil['nama'];
        $actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
        $subject = "Pengajuan Judul Skripsi";
        $pesan = "Yth. " . $namaadmin . "
									<br/>
									Assalamualaikum Wr. Wb.
									<br/>
									Terdapat pengajuan judul skripsi atas nama " . $nama . " NIM " . $nim . ".
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
    } else {
        header("location:index.php?pesan=gagal");
        //echo 'failed upload';
    }
}
