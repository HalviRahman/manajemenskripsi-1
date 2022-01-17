<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];

if ($role != 'admin') {
  header("location:../deauth.php");
}
require('../config.php');
require('../vendor/myfunc.php');
require('../vendor/phpmailer/sendmail.php');


if (isset($_POST['edit'])) {

  $aktif = mysqli_real_escape_string($conn, $_POST['aktif']);
  $token = mysqli_real_escape_string($conn, $_POST['token']);
  $email = $_POST['email'];

  $stmt = $conn->prepare("UPDATE pengguna
                              SET aktif=?
                              WHERE token=?");
  $stmt->bind_param("ss", $aktif, $token);
  $stmt->execute();

  $actual_link = "https://$_SERVER[HTTP_HOST]/manajemenskripsi/";
  $subject = "Aktivasi Akun Sistem Manajemen Skripsi Jurusan FISIKA UIN Malang";
  $pesan = "Yth. " . $nama . "
				<br/>
				Assalamualaikum Wr. Wb.
				<br/>
				Akun anda di sistem Manajemen Skripsi Jurusan FISIKA UIN Malang telah di aktifkan.
				<br/>
				Silahkan klik tombol berikut ini untuk mengakses sistem. 
				<br/>
				<a href='" . $actual_link . "' style=' background-color: #0000FF;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Manajemen Skripsi</a> 
				<br/>
				atau klik <a href='" . $actual_link . "'>" . $actual_link . "</a>
				Wassalamualaiakum Wr. Wb.
				";
  sendmail($email, $nama, $subject, $pesan);

  //header('location:aktivasiuser.php?pesan=success');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Manajemen Skripsi</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
    require('sidebar.php');
    ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php
        require('topbar.php');
        ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Pengguna Sistem</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Pengguna Sistem</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-12">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Profil</h6>
                </div>

                <?php
                // ambil data pengajuan judul
                $token = $_GET['token'];
                $stmt = $conn->prepare("SELECT * FROM pengguna WHERE token=?");
                $stmt->bind_param("s", $token);
                $stmt->execute();
                $result = $stmt->get_result();
                $dhasil = $result->fetch_assoc();
                $nama = $dhasil['nama'];
                $nim = $dhasil['nim'];
                $nohp = $dhasil['nohp'];
                $email = $dhasil['email'];
                $userid = $dhasil['userid'];
                $aktif = $dhasil['aktif'];
                $token = $dhasil['token'];
                ?>

                <div class="card-body">

                  <form action="" enctype="multipart/form-data" method="POST" id="my-form">
                    <input type="hidden" name="token" value="<?= $token; ?>">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" value="<?= $nama; ?>" name="nama" readonly>
                    </div>
                    <div class="form-group">
                      <label>NIM / NIP / NIPT</label>
                      <input type="number" class="form-control" value="<?= $nim; ?>" name="nim" readonly>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>No. HP / Whatsapp</label>
                        <input type="number" class="form-control" value="<?= $nohp; ?>" name="nohp" readonly>
                      </div>
                      <div class="col-sm-6">
                        <label>Email</label>
                        <input type="email" class="form-control" value="<?= $email; ?>" name="email" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>User ID</label>
                      <input type="text" class="form-control" value="<?= $userid; ?>" name="userid" readonly>
                    </div>
                    <div class="form-group">
                      <label>Status User</label>
                      <select name="aktif" class="form-control">
                        <option value="0" selected>Tidak Aktif</option>
                        <option value="1">Aktif</option>
                      </select>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary btn-lg btn-block">Aktifkan Akun</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
        </div>
      </div>
      <!-- Footer -->
      <?php
      require('footer.php');
      ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>

  <!-- disable button once it clicked -->
  <script type="text/javascript">
    $(document).ready(function() {
      $("#my-form").submit(function(e) {
        $("#btn-submit").attr("disabled", true);
        return true;
      });
    });
  </script>
</body>

</html>