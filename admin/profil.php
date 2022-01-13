<?php
session_start();
// $userid = $_SESSION['userid'];
// global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
$token = $_SESSION['token'];
if ($role != 'admin') {
  header("location:../deauth.php");
}
require('../config.php');
require('../vendor/myfunc.php');


if (isset($_POST['edit'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $nohp = mysqli_real_escape_string($conn, $_POST['nohp']);
  $userid = mysqli_real_escape_string($conn, $_POST['userid']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
  $pass = md5($password);
  $kunci = mysqli_real_escape_string($conn, strtolower($_POST['kunci']));
  $hasil = mysqli_real_escape_string($conn, strtolower($_POST['hasil']));


  if ($kunci == $hasil) {
    if ($juser > 0) {
      header('location: profil.php?pesan=exist');
    } else {
      if ($password == $password2) {
        $stmt = $conn->prepare("UPDATE pengguna
                              SET nohp=?, email=?, userid=?, pass=?
                              WHERE token=?");
        $stmt->bind_param("sssss", $nohp, $email, $userid, $pass, $token);
        $stmt->execute();
        header('location:profil.php?pesan=success');
      } else {
        header('location:profil.php?pesan=passtidaksama');
      }
    }
  } else {
    header('location:profil.php?hitungsalah');
  }
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
            <h1 class="h3 mb-0 text-gray-800">Edit Profil</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
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
                ?>

                <div class="card-body">
                  <?php
                  //ambil nilai variabel pesan di URL
                  if (isset($_GET['pesan'])) {
                    $pesan = $_GET['pesan'];
                    if ($pesan == 'success') {
                  ?>
                  <div class="alert alert-success" role="alert">
                    Berhasil Edit Profil!
                  </div>
                  <?php
                    } elseif ($pesan == 'exist') {
                    ?>
                  <div class="alert alert-danger" role="alert">
                    <b>ERROR!!</b> Pengguna telah terdaftar
                  </div>
                  <?php
                    } elseif ($pesan == 'passtidaksama') {
                    ?>
                  <div class="alert alert-danger" role="alert">
                    <b>ERROR!!</b> Konfirmasi password tidak sama
                  </div>
                  <?php
                    } elseif ($pesan == 'hitungsalah') {
                    ?>
                  <div class="alert alert-danger" role="alert">
                    <b>ERROR!!</b> Perhitungan salah
                  </div>
                  <?php
                    }
                  }
                  ?>
                  <form action="" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" value="<?= $nama; ?>" name="nama" readonly>
                    </div>
                    <div class="form-group">
                      <label>NIM / NIP / NIPT</label>
                      <input type="number" class="form-control" value="<?= $nim; ?>" name="nim" readonly>
                    </div>
                    <div class="form-group">
                      <label>No. HP / Whatsapp</label>
                      <input type="number" class="form-control" value="<?= $nohp; ?>" name="nohp">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" value="<?= $email; ?>" name="email">
                    </div>
                    <div class="form-group">
                      <label>User ID</label>
                      <input type="text" class="form-control" value="<?= $userid; ?>" name="userid">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required>
                      </div>
                      <div class="col-sm-6">
                        <label>Ulangi Password</label>
                        <input type="password" class="form-control" name="password2" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <?php
                      $angka1 = rand(1, 5);
                      $angka2 = rand(1, 5);
                      $kunci = $angka1 + $angka2;
                      ?>
                      <label>Berapakah <b><u><?= huruf($angka1); ?> ditambah <?= huruf($angka2); ?></u></b> (angka)
                        ?</label>
                      <input type="number" class="form-control" name="hasil" id="hasil" required>
                      <input type="hidden" name="kunci" value="<?= $kunci; ?>">
                    </div>
                    <button type="submit" name="edit" class="btn btn-warning btn-lg btn-block">UPDATE</button>
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

</body>

</html>
