<?php
session_start();
$userid = $_SESSION['userid'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
global $userid;
$email = $_SESSION['email'];
$nohp = $_SESSION['nohp'];
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
if ($role != 'dosen') {
  header("location:../deauth.php");
}
require('../config.php');
require('../vendor/myfunc.php');
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
                <div class="card-body">
                  <form action="" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" value="<?= $nama; ?>" name="nama" disabled>
                    </div>
                    <div class="form-group">
                      <label>NIM / NIP / NIPT</label>
                      <input type="number" class="form-control" value="<?= $nim; ?>" name="nim" disabled>
                    </div>
                    <div class="form-group">
                      <label>No. HP / Whatsapp</label>
                      <input type="number" class="form-control" value="<?= $nohp; ?>" name="nohp">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" value="<?= $email; ?>" name="nohp">
                    </div>
                    <div class="form-group">
                      <label>User ID</label>
                      <input type="text" class="form-control" value="<?= $userid; ?>" name="userid">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                      </div>
                      <div class="col-sm-6">
                        <label>Ulangi Password</label>
                        <input type="password" class="form-control" name="password2">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">EDIT</button>
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