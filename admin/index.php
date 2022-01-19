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
            <h1 class="h3 mb-0 text-gray-800">Jadwal Ujian</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Jadwal Ujian</li>
            </ol>
          </div>
          <!-- ujian hari ini -->
          <?php
          $tglhariini = date('Y-m-d');
          ?>
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Jadwal Ujian Hari Ini <?= tgl_indo($tglhariini); ?></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Ujian</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Jadwal</th>
                        <th class="text-center">Tempat</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- ambil data ujian proposal-->
                      <?php
                      $no = 1;
                      $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE DATE(jadwalujian)='$tglhariini'");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        while ($dhasil = $result->fetch_assoc()) {
                          $ujian = 'Seminar Proposal';
                          $nama = $dhasil['nama'];
                          $nim = $dhasil['nim'];
                          $pembimbing = $dhasil['pembimbing'];
                          $ketuapenguji = $dhasil['penguji1'];
                          $anggotapenguji = $dhasil['penguji2'];
                          $jadwalujian = $dhasil['jadwalujian'];
                          $ruang = $dhasil['ruang'];
                          $token = $dhasil['token'];
                      ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ujian; ?></td>
                            <td><?= $nama; ?></td>
                            <td><?= $nim; ?></td>
                            <td><?= jam($jadwalujian); ?> WIB</td>
                            <td><?= $ruang; ?></td>
                          </tr>
                      <?php
                          $no++;
                        }
                      }
                      ?>

                      <!-- ujian komprehensif-->
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE DATE(jadwalujian)='$tglhariini'");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        while ($dhasil = $result->fetch_assoc()) {
                          $ujian = 'Ujian Komprehensif';
                          $nama = $dhasil['nama'];
                          $nim = $dhasil['nim'];
                          $pembimbing = $dhasil['pembimbing'];
                          $ketuapenguji = $dhasil['penguji1'];
                          $anggotapenguji = $dhasil['penguji2'];
                          $jadwalujian = $dhasil['jadwalujian'];
                          $ruang = $dhasil['ruang'];
                          $token = $dhasil['token'];
                      ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ujian; ?></td>
                            <td><?= $nama; ?></td>
                            <td><?= $nim; ?></td>
                            <td><?= jam($jadwalujian); ?> WIB</td>
                            <td><?= $ruang; ?></td>
                          </tr>
                      <?php
                          $no++;
                        }
                      }
                      ?>

                      <!-- ujian seminar hasil-->
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM semhas WHERE DATE(jadwalujian)='$tglhariini'");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        while ($dhasil = $result->fetch_assoc()) {
                          $ujian = 'Seminar Hasil';
                          $nama = $dhasil['nama'];
                          $nim = $dhasil['nim'];
                          $pembimbing = $dhasil['pembimbing'];
                          $ketuapenguji = $dhasil['penguji1'];
                          $anggotapenguji = $dhasil['penguji2'];
                          $jadwalujian = $dhasil['jadwalujian'];
                          $ruang = $dhasil['ruang'];
                          $token = $dhasil['token'];
                      ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ujian; ?></td>
                            <td><?= $nama; ?></td>
                            <td><?= $nim; ?></td>
                            <td><?= jam($jadwalujian); ?> WIB</td>
                            <td><?= $ruang; ?></td>
                          </tr>
                      <?php
                          $no++;
                        }
                      }
                      ?>

                      <!-- ujian skripsi-->
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE DATE(jadwalujian)='$tglhariini'");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        while ($dhasil = $result->fetch_assoc()) {
                          $ujian = 'Ujian Skripsi';
                          $nama = $dhasil['nama'];
                          $nim = $dhasil['nim'];
                          $pembimbing = $dhasil['pembimbing'];
                          $ketuapenguji = $dhasil['penguji1'];
                          $anggotapenguji = $dhasil['penguji2'];
                          $anggotapenguji2 = $dhasil['penguji3'];
                          $jadwalujian = $dhasil['jadwalujian'];
                          $ruang = $dhasil['ruang'];
                          $token = $dhasil['token'];
                      ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ujian; ?></td>
                            <td><?= $nama; ?></td>
                            <td><?= $nim; ?></td>
                            <td><?= jam($jadwalujian); ?> WIB</td>
                            <td><?= $ruang; ?></td>
                          </tr>
                      <?php
                          $no++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- pengajuan ujian -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pengajuan Mahasiswa</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Ujian</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      // ambil data pengajuan judul
                      $stmt = $conn->prepare("SELECT * FROM pengajuanjudul WHERE verifikasifile=0");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Pengajuan Judul';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="pengajuanjudul-admin-detail.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>

                      <?php
                      // ambil data pengajuan proposal
                      $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE verifikasifile=0");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Ujian Seminar Proposal';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="ujianproposal-admin-detail1.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>

                      <?php
                      // ambil data pengajuan proposal setelah verifikasi sekprodi
                      $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE status=1");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Ujian Proposal';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="ujianproposal-admin-detail2.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>

                      <?php
                      // ambil data pengajuan ujian komprehensif
                      $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE verifikasifile=0");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Ujian Komprehensif';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="ujiankomprehensif-admin-detail1.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>

                      <?php
                      // ambil data pengajuan proposal setelah verifikasi sekprodi
                      $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE status=1");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Ujian Komprehensif';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="ujiankomprehensif-admin-detail2.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>

                      <?php
                      // ambil data seminar hasil
                      $stmt = $conn->prepare("SELECT * FROM semhas WHERE verifikasifile=0");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Ujian Seminar Hasil';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="seminarhasil-admin-detail2.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>

                      <?php
                      // ambil data pengajuan seminar hasil setelah verifikasi kaprodi
                      $stmt = $conn->prepare("SELECT * FROM semhas WHERE status=1");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Ujian Komprehensif';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="seminarhasil-admin-detail2.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>

                      <?php
                      // ambil data ujian skripsi
                      $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE verifikasifile=0");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Ujian Skripsi';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="ujianskripsi-admin-detail2.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php
                        $no++;
                      }
                      ?>

                      <?php
                      // ambil data pengajuan ujian skripsi setelah verifikasi kaprodi
                      $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE status=1");
                      $stmt->execute();
                      $result = $stmt->get_result();
                      while ($dhasil = $result->fetch_assoc()) {
                        $nim = $dhasil['nim'];
                        $nama = $dhasil['nama'];
                        $ujian = 'Ujian Skripsi';
                        $token = $dhasil['token'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $ujian; ?></td>
                          <td><?= $nama; ?></td>
                          <td><?= $nim; ?></td>
                          <td class="text-center">
                            <a href="ujianskripsi-admin-detail2.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
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