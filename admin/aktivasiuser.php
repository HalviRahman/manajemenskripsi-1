<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
if ($role != 'admin') {
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
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Daftar Pengguna Sistem</li>
            </ol>
          </div>

          <!-- ujian hari ini -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Penguna Sistem</h6>
                </div>

                <div class="table-responsive p-3">
                  <?php
                  //ambil nilai variabel pesan di URL
                  if (isset($_GET['pesan'])) {
                    $pesan = $_GET['pesan'];
                    if ($pesan == 'success') {
                  ?>
                      <div class="alert alert-success" role="alert">
                        Berhasil!
                      </div>
                  <?php
                    }
                  }
                  ?>
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <!-- <th class="text-center">No. Hp</th> -->
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      // ambil data pengajuan judul
                      $stmt = $conn->prepare("SELECT * FROM pengguna");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $email = $dhasil['email'];
                        $status = $dhasil['aktif'];
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $nim; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $email; ?></td>
                          <td class="text-center">
                            <?php
                            if ($status == 0) {
                            ?>
                              <a href="aktivasiuser-detail.php?token=<?= $token; ?>" type="button" class="btn btn-danger btn-sm">Nonaktif</a>
                            <?php
                            } elseif ($status == 1) {
                            ?>
                              <a href="aktivasiuser-detail.php?token=<?= $token; ?>" type="button" class="btn btn-success btn-sm">Aktif</a>
                            <?php } ?>
                          </td>
                          <td class="text-center">
                            <a href="aktivasiuser-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm('Hapus data ini ?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>
                    </tbody>
                  </table>
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
  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>