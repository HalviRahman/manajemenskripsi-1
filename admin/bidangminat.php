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
            <h1 class="h3 mb-0 text-gray-800">Daftar Bidang Minat</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Daftar Bidang Minat</li>
            </ol>
          </div>
          <div class="col">
            <a href="bidangminat-tambah.php" class="btn btn-success"><i class="fa fa-plus-circle"
                aria-hidden="true"></i>
              TAMBAH</a>
          </div>
          <br>
          <!-- pengajuan ujian -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">

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
                    } else if ($pesan == 'gagal') {
                    ?>
                  <div class="alert alert-danger" role="alert">
                    ERRORR!! Gagal menambahkan data Bidang Minat!
                  </div>
                  <?php
                    }
                  }
                  ?>
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Bidang Minat</th>
                        <th class="text-center">Aksi</th>
                        <!--<th class="text-center">Aksi</th>-->
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      $nomer = 1;
                      $stmt = $conn->prepare("SELECT * FROM bidangminat");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $bidangminat = $dhasil['bidang'];
                        $no = $dhasil['no'];
                      ?>
                      <tr>
                        <td><?= $nomer; ?></td>
                        <td><?= $bidangminat; ?></td>
                        <td class="text-center">
                          <a href="" class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                            data-target="#hapusModal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                      <?php
                        $nomer++;
                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="table-responsive p-3">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Logout -->
        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelHapus"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelHapus">Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Hapus Bidang Minat dari sistem?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                <a href="bidangminat-hapus.php?no=<?= $no; ?>" class="btn btn-danger">Hapus</a>
              </div>
            </div>
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