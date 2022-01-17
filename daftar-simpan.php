<?php
require('config.php');
require('vendor/phpmailer/sendmail.php');
$kunci = mysqli_real_escape_string($conn, $_POST['kunci']);
$hasil = mysqli_real_escape_string($conn, $_POST['hasil']);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$nim = mysqli_real_escape_string($conn, $_POST['nim']);
$nohp = mysqli_real_escape_string($conn, $_POST['nohp']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$userid = mysqli_real_escape_string($conn, $_POST['userid']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password2 = mysqli_real_escape_string($conn, $_POST['password2']);
$passmd5 = md5($password);
$token = md5(microtime());
if ($kunci == $hasil) {
	$stmt = $conn->prepare("SELECT * FROM pengguna WHERE nim=? OR email=? OR nohp=? OR userid=?");
	$stmt->bind_param("ssss", $nim, $email, $nohp, $userid);
	$stmt->execute();
	$result = $stmt->get_result();
	$juser = $result->num_rows;

	if ($juser > 0) {
		header('location: index.php?pesan=exist');
	} else {
		if ($password == $password2) {
			$stmt = $conn->prepare("INSERT INTO pengguna (nama,nim,nohp,email,userid,pass,token)
									VALUES (?,?,?,?,?,?,?)");
			$stmt->bind_param("sssssss", $nama, $nim, $nohp, $email, $userid, $passmd5, $token);
			$stmt->execute();

			//cari email admin
			$stmt = $conn->prepare("SELECT * FROM pengguna WHERE role='admin'");
			$stmt->execute();
			$result = $stmt->get_result();
			$dhasil = $result->fetch_assoc();
			$emailfak = $dhasil['email'];
			$namaadmin = $dhasil['nama'];

			$actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi";
			$subject = "Notifikasi Pendaftaran Pengguna Baru";
			$pesan = "Yth. " . $namaadmin . "
									<br/>
									Assalamualaikum Wr. Wb.
									<br/>
									Terdapat pendaftar baru atas nama " . $nama . ".
									<br/>
									Silahkan klik tombol berikut ini untuk melakukan aktivasi pengguna.
									<br/>
									<a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
									<br/>
									Wassalamualaikum Wr. Wb.
									";
			sendmail($emailfak, $namaadmin, $subject, $pesan);

			$subject = "Pendaftaran Sistem Manajemen Skripsi Prodi FISIKA UIN Malang";
			$pesan = "Yth. " . $nama . "
									<br/>
									Assalamualaikum Wr. Wb.
									<br/>
									Pendaftaran anda sedang menunggu aktivasi dari Bagian Administrasi Program Studi.
									<br/>
									Akan ada email pemberitahuan selanjutnya apabila akun anda sudah di aktivasi.
									<br/>
									Wassalamualaiakum Wr. Wb.
									";
			sendmail($email, $nama, $subject, $pesan);

			header('location:index.php?pesan=success');
		} else {
			header('location:daftar.php?pesan=passsalah');
		}
	}
} else {
	header('location: daftar.php?pesan=hitungsalah');
}
