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
            <h1 class="h3 mb-0 text-gray-800">Ujian Skripsi</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ujian Skripsi</li>
            </ol>
          </div>

          <div class="row">
            <form action="ujianskripsi-laporan-cetak2.php" method="POST">
              <label>Cetak Laporan Bulan</label>
              <div class="row">
                <div class="col">
                  <select class="form-control" name="bulan">
                    <option value="01" selected>Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
                <div class="col">
                  <select class="form-control" name="tahun">
                    <option value="<?= date('Y'); ?>"><?= date('Y'); ?></option>
                    <option value="<?= date('Y', strtotime("-1 year")); ?>"><?= date('Y', strtotime("-1 year")); ?>
                    </option>
                    <option value="<?= date('Y', strtotime("-2 year")); ?>"><?= date('Y', strtotime("-2 year")); ?>
                    </option>
                  </select>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i>
                    CETAK</button>
                </div>
            </form>
          </div>

          <!-- ujian hari ini -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Ujian Skripsi</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tgl. Ujian</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Pembimbing</th>
                        <th class="text-center">Ketua Penguji</th>
                        <th class="text-center">Penguji Anggota 1</th>
                        <th class="text-center">Penguji Anggota 2</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE status=4");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $jadwalujian = $dhasil['jadwalujian'];
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $pembimbing = $dhasil['pembimbing'];
                        $penguji1 = $dhasil['penguji1'];
                        $penguji2 = $dhasil['penguji2'];
                        $penguji3 = $dhasil['penguji3'];
                        $token = $dhasil['token'];
                      ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= tgljam_indo($jadwalujian); ?></td>
                        <td><?= $nama; ?></td>
                        <td><?= $nim; ?></td>
                        <td><?= $pembimbing; ?></td>
                        <td><?= $penguji1; ?></td>
                        <td><?= $penguji2; ?></td>
                        <td><?= $penguji3; ?></td>
                        <td class="text-center">
                          <a href="ujianskripsi-laporan-detail.php?token=<?= $token; ?>" class="btn btn-info"
                            type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
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