<?php
session_start();
require('../config.php');

$token = $_GET['token'];

$stmt = $conn->prepare("SELECT * FROM pengguna WHERE token=?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
$juser = $result->num_rows;

//jika data ditemukan
if ($juser > 0) {
    //ambil data
    $dhasil = $result->fetch_assoc();
    $nama = $dhasil['nama'];
    $nim = $dhasil['nim'];
    $role = $dhasil['role'];
    $jabatan = $dhasil['jabatan'];
    $email = $dhasil['email'];
    $token = $dhasil['token'];

    //set settion
    $_SESSION['userid'] = $userid;
    $_SESSION['nim'] = $nim;
    $_SESSION['nama'] = $nama;
    $_SESSION['role'] = $role;
    $_SESSION['jabatan'] = $jabatan;
    $_SESSION['email'] = $email;
    $_SESSION['token'] = $token;

    if ($role == 'admin') {
        header('location:../admin/index.php');
    } elseif ($role == 'dosen') {
        header('location:../dosen/index.php');
    } elseif ($role == 'mahasiswa') {
        header('location:../mahasiswa/index.php');
    }
} else {
    header('location:index.php?pesan=gagal');
}
