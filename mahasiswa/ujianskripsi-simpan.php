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
$forma = $target_dir . $nim . "-forma" . ".pdf";
$foto = $target_dir . $nim . "-foto" . ".jpg";
$sklsemhas = $target_dir . $nim . "-sklsemhas" . ".jpg";
$transkripnilai = $target_dir . $nim . "-transkripnilai" . ".pdf";
$toefl = $target_dir . $nim . "-toefl" . ".jpg";
$toafl = $target_dir . $nim . "-toafl" . ".jpg";
$alumni = $target_dir . $nim . "-alumni" . ".pdf";
$skripsi = $target_dir . $nim . "-skripsi" . ".pdf";
$uploadOk = 1;

//ambil extensi file
$extforma = strtolower(pathinfo($forma, PATHINFO_EXTENSION));
$extfoto = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
$extsklsemhas = strtolower(pathinfo($sklsemhas, PATHINFO_EXTENSION));
$exttranskripnilai = strtolower(pathinfo($transkripnilai, PATHINFO_EXTENSION));
$exttoefl = strtolower(pathinfo($toefl, PATHINFO_EXTENSION));
$exttoafl = strtolower(pathinfo($toafl, PATHINFO_EXTENSION));
$extalumni = strtolower(pathinfo($alumni, PATHINFO_EXTENSION));
$extskripsi = strtolower(pathinfo($skripsi, PATHINFO_EXTENSION));

// check file extention
if ($extforma != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi form A salah';
}
if ($extfoto != "jpg" && $extfoto != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi khs';
}
if ($extsklsemhas != "jpg" && $extsklsemhas != "jpeg") {
    $uploadOk = 0;
    echo 'ekstensi SKL Semhas salah';
}
if ($exttranskripnilai != "pdf") {
    $uploadOk = 0;
    echo 'ekstensi transkrip nilai salah';
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
if ($_FILES["transkripnilai"]["size"] > 1048576) {
    $uploadOk = 0;
    echo 'filesize transkripnilai over';
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
if ($_FILES["skripsi"]["size"] > 5242880) {
    $uploadOk = 0;
    echo 'filesize Form Alumni over';
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
$mimetype = mime_content_type($_FILES['sklsemhas']['tmp_name']);
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
    move_uploaded_file($_FILES["transkripnilai"]["tmp_name"], $transkripnilai);
    move_uploaded_file($_FILES["toefl"]["tmp_name"], $toefl);
    move_uploaded_file($_FILES["toafl"]["tmp_name"], $toafl);
    move_uploaded_file($_FILES["alumni"]["tmp_name"], $alumni);
    move_uploaded_file($_FILES["skripsi"]["tmp_name"], $skripsi);
    $stmt = $conn->prepare("INSERT INTO ujianskripsi (tanggal,nama,nim,bidang,judul,forma,foto,sklsemhas,transkripnilai,toefl,toafl,alumni,skripsi,pembimbing,penguji1,penguji2,token)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssssssssss", $tanggal, $nama, $nim, $bidang, $judul, $forma, $foto, $sklsemhas, $transkripnilai, $toefl, $toafl, $alumni, $skripsi, $pembimbing, $penguji1, $penguji2, $token);
    $stmt->execute();
    header("location:index.php?pesan=success");
    //echo 'success';
}
