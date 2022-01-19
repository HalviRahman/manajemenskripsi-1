<?php
session_start();
require('../config.php');
require('../vendor/myfunc.php');
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

//ambil data dosen penguji integrasi
$stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE nim=?");
$stmt->bind_param("s", $nim,);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$penguji3 = $dhasil['penguji2'];

//upload file
$target_dir = "../lampiran/";
$forma = $target_dir . $nim . "-forma" . ".pdf";
$foto = $target_dir . $nim . "-foto" . ".jpg";
$sklsemhas = $target_dir . $nim . "-sklsemhas" . ".pdf";
$buktibayar = $target_dir . $nim . "-buktibayar" . ".jpg";
$khs = $target_dir . $nim . "-khs" . ".jpg";
$transkripnilai = $target_dir . $nim . "-transkripnilai" . ".pdf";
$ijazah = $target_dir . $nim . "-ijazah" . ".pdf";
$toefl = $target_dir . $nim . "-toefl" . ".jpg";
$toafl = $target_dir . $nim . "-toafl" . ".jpg";
$alumni = $target_dir . $nim . "-alumni" . ".pdf";
$skripsi = $target_dir . $nim . "-skripsi" . ".pdf";
$turnitin = $target_dir . $nim . "-turnitin" . ".pdf";
$uploadOk = 1;

//ambil extensi file
$extforma = strtolower(pathinfo($forma, PATHINFO_EXTENSION));
$extfoto = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
$extsklsemhas = strtolower(pathinfo($sklsemhas, PATHINFO_EXTENSION));
$extbuktibayar = strtolower(pathinfo($buktibayar, PATHINFO_EXTENSION));
$extkhs = strtolower(pathinfo($khs, PATHINFO_EXTENSION));
$exttranskripnilai = strtolower(pathinfo($transkripnilai, PATHINFO_EXTENSION));
$extijazah = strtolower(pathinfo($ijazah, PATHINFO_EXTENSION));
$exttoefl = strtolower(pathinfo($toefl, PATHINFO_EXTENSION));
$exttoafl = strtolower(pathinfo($toafl, PATHINFO_EXTENSION));
$extalumni = strtolower(pathinfo($alumni, PATHINFO_EXTENSION));
$extskripsi = strtolower(pathinfo($skripsi, PATHINFO_EXTENSION));
$extturnitin = strtolower(pathinfo($turnitin, PATHINFO_EXTENSION));

// check file extention
if ($extforma != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi form A salah';
}
if ($extfoto != "jpg" && $extfoto != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi khs';
}
if ($extsklsemhas != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi SKL Semhas salah';
}
if ($extbuktibayar != "jpg" && $extbuktibayar != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi buktibayar salah';
}
if ($extkhs != "jpg" && $extkhs != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi khs';
}
if ($exttranskripnilai != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi transkrip nilai salah';
}
if ($extijazah != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi ijazah salah';
}
if ($exttoefl != "jpg" && $exttoefl != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi TOEFL salah';
}
if ($exttoafl != "jpg" && $exttoafl != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi TOAFL salah';
}
if ($extalumni != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi alumni salah';
}
if ($extskripsi != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi skripsi  salah';
}
if ($extturnitin != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi bukti turnitin  salah';
}

// Check file size
if ($_FILES["forma"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize form A over';
}
if ($_FILES["foto"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize foto over';
}
if ($_FILES["sklsemhas"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize sklsemhas over';
}
if ($_FILES["buktibayar"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize bukti bayar over';
}
if ($_FILES["khs"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize khs over';
}
if ($_FILES["transkripnilai"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize transkripnilai over';
}
if ($_FILES["ijazah"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize ijazah over';
}
if ($_FILES["toefl"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize TOEFL over';
}
if ($_FILES["toafl"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize TOAFL over';
}
if ($_FILES["alumni"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize Form Alumni over';
}
if ($_FILES["skripsi"]["size"] > 10485760) {
    $uploadOk = 0;
    echo 'filesize Form Alumni over';
}
if ($_FILES["turnitin"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize bukti turnitin over';
}

// check file MIME
$mimetype = mime_content_type($_FILES['toefl']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}
$mimetype = mime_content_type($_FILES['toafl']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}
$mimetype = mime_content_type($_FILES['foto']['tmp_name']);
if (in_array($mimetype, array('image/jpeg', 'image/jpeg'))) {
} else {
    $uploadOk = 0;
}
$mimetype = mime_content_type($_FILES['buktibayar']['tmp_name']);
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
    header("location:ujianskripsi-isi.php?pesan=gagal");
    //echo 'something wrong';
} else {
    move_uploaded_file($_FILES["forma"]["tmp_name"], $forma);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
    move_uploaded_file($_FILES["sklsemhas"]["tmp_name"], $sklsemhas);
    move_uploaded_file($_FILES["buktibayar"]["tmp_name"], $buktibayar);
    move_uploaded_file($_FILES["khs"]["tmp_name"], $khs);
    move_uploaded_file($_FILES["transkripnilai"]["tmp_name"], $transkripnilai);
    move_uploaded_file($_FILES["ijazah"]["tmp_name"], $ijazah);
    move_uploaded_file($_FILES["toefl"]["tmp_name"], $toefl);
    move_uploaded_file($_FILES["toafl"]["tmp_name"], $toafl);
    move_uploaded_file($_FILES["alumni"]["tmp_name"], $alumni);
    move_uploaded_file($_FILES["skripsi"]["tmp_name"], $skripsi);
    move_uploaded_file($_FILES["turnitin"]["tmp_name"], $turnitin);
    $stmt = $conn->prepare("INSERT INTO ujianskripsi (tanggal,nama,nim,bidang,judul,forma,foto,sklsemhas,buktibayar,khs,transkripnilai,ijazah,toefl,toafl,alumni,skripsi,turnitin,pembimbing,penguji1,penguji2,penguji3,token)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssssssssssssss", $tanggal, $nama, $nim, $bidang, $judul, $forma, $foto, $sklsemhas, $buktibayar, $khs, $transkripnilai, $ijazah, $toefl, $toafl, $alumni, $skripsi, $turnitin, $pembimbing, $penguji1, $penguji2, $penguji3, $token);
    $stmt->execute();

    //kirim email notifikasi ke admin
    $stmt = $conn->prepare("SELECT * FROM pengguna WHERE role='admin'");
    $stmt->execute();
    $result = $stmt->get_result();
    $dhasil = $result->fetch_assoc();
    $emailfak = $dhasil['email'];
    $namaadmin = $dhasil['nama'];
    $actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
    $subject = "Pengajuan Ujian Skripsi";
    $pesan = "Yth. " . $namaadmin . "
                            <br/>
                            Assalamualaikum Wr. Wb.
                            <br/>
                            Terdapat pengajuan <b>Ujian Skripsi</b> atas nama " . $namamhs . " NIM " . $nimmhs . ".
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
