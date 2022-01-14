<?php
session_start();
$userid = $_SESSION['userid'];
$nim = $_SESSION['nim'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
if ($role != 'mahasiswa') {
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
            <h1 class="h3 mb-0 text-gray-800">Proses Skripsi</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Proses Skripsi</li>
            </ol>
          </div>
          <!-- ujian hari ini -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Proses Ujian</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center" width="5%">No</th>
                        <th class="text-center">Proses</th>
                        <th class="text-center">Waktu</th>
                        <th class="text-center">Tempat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- ambil data pengajuan judul-->
                      <?php
                      $no = 1;
                      $stmt = $conn->prepare("SELECT * FROM pengajuanjudul WHERE nim=?");
                      $stmt->bind_param("s", $nim);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        $dhasil = $result->fetch_assoc();
                        $tanggal = $dhasil['tanggal'];
                        $pembimbing = $dhasil['pembimbing'];
                        $verifikasifile = $dhasil['verifikasifile'];
                        $status = $dhasil['status'];
                        $token = $dhasil['token'];
                        $keterangan = $dhasil['keterangan'];
                      ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td>Pengajuan Judul</td>
                          <td><?= tgljam_indo($tanggal); ?></td>
                          <td>-</td>
                          <td>
                            <?php
                            if ($verifikasifile == 0 and $status == 0) {
                              echo 'Menunggu verifikasi Admin';
                            } elseif ($verifikasifile == 1 and $status == 0) {
                              echo 'Menunggu verifikasi Sekprodi';
                            } elseif ($verifikasifile == 1 and $status == 1) {
                              echo 'Disetujui';
                            } elseif ($verifikasifile == 2 and $status == 0) {
                              echo 'Berkas tidak lengkap';
                            } elseif ($verifikasifile == 1 and $status == 2) {
                              echo 'Ditolak prodi';
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($verifikasifile == 0 and $status == 0) {
                            ?>
                              <a href="pengajuanjudul-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php
                            } elseif ($verifikasifile == 1 and $status == 0) {
                            ?>
                              <a href="#" class="btn btn-secondary" type="button" onclick="alert('Menunggu verifikasi Sekprodi');"><i class="fa fa-spinner" aria-hidden="true"></i></a>
                            <?php
                            } elseif ($verifikasifile == 1 and $status == 1) {
                            ?>
                              <a href="pengajuanjudul-detail.php?token=<?= $token; ?>" class="btn btn-success" type="button"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                            <?php
                            } elseif ($verifikasifile == 2 and $status == 0) {
                            ?>
                              <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <a href="pengajuanjudul-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php
                            } elseif ($verifikasifile == 1 and $status == 2) {
                            ?>
                              <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <a href="pengajuanjudul-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php
                            }
                            ?>
                          </td>
                        </tr>
                      <?php
                      }
                      $no++;
                      ?>

                      <!-- ambil sempro-->
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE nim=?");
                      $stmt->bind_param("s", $nim);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        while ($dhasil = $result->fetch_assoc()) {
                          $jadwalujian = $dhasil['jadwalujian'];
                          $ruang = $dhasil['ruang'];
                          $pembimbing = $dhasil['pembimbing'];
                          $verifikasifile = $dhasil['verifikasifile'];
                          $status = $dhasil['status'];
                          $token = $dhasil['token'];
                          $keterangan = $dhasil['keterangan'];
                      ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td>Ujian Proposal</td>
                            <td><?php if (isset($jadwalujian)) {
                                  echo tgljam_indo($jadwalujian);
                                } else {
                                  echo '-';
                                } ?>
                            </td>
                            <td><?= $ruang; ?></td>
                            <td>
                              <?php
                              if ($verifikasifile == 0 and $status == 0) {
                                echo 'Menunggu verifikasi Admin';
                              } elseif ($verifikasifile == 1 and $status == 0) {
                                echo 'Menunggu verifikasi Sekprodi';
                              } elseif ($verifikasifile == 1 and $status == 1) {
                                echo 'Menunggu penjadwalan';
                              } elseif ($verifikasifile == 1 and $status == 3) {
                                echo 'Terjadwal';
                              } elseif ($verifikasifile == 2 and $status == 0) {
                                echo 'Berkas tidak lengkap';
                              } elseif ($verifikasifile == 1 and $status == 2) {
                                echo 'Ditolak prodi';
                              } elseif ($verifikasifile == 1 and $status == 4) {
                                echo 'Sudah dinilai';
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              if ($verifikasifile == 0 and $status == 0) {
                              ?>
                                <a href="ujianproposal-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-secondary" type="button" onclick="alert('Menunggu verifikasi Sekprodi');"><i class="fa fa-spinner" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and ($status == 1 || $status == 3)) {
                              ?>
                                <a href="ujianproposal-detail.php?token=<?= $token; ?>" class="btn btn-success" type="button"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 2 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                <a href="ujianproposal-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 2) {
                              ?>
                                <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                <a href="ujianproposal-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 4) {
                              ?>
                                <a href="ujianproposal-cetak.php?token=<?= $token; ?>" class="btn btn-success" type="button" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                              <?php
                              }
                              ?>
                            </td>
                          </tr>
                      <?php
                          $no++;
                        }
                      }
                      ?>

                      <!-- ambil kompre-->
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE nim=?");
                      $stmt->bind_param("s", $nim);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        while ($dhasil = $result->fetch_assoc()) {
                          $jadwalujian = $dhasil['jadwalujian'];
                          $ruang = $dhasil['ruang'];
                          $pembimbing = $dhasil['pembimbing'];
                          $verifikasifile = $dhasil['verifikasifile'];
                          $status = $dhasil['status'];
                          $token = $dhasil['token'];
                          $keterangan = $dhasil['keterangan'];
                      ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td>Ujian Komprehensif</td>
                            <td><?php if (isset($jadwalujian)) {
                                  echo tgljam_indo($jadwalujian);
                                } else {
                                  echo '-';
                                } ?>
                            </td>
                            <td><?= $ruang; ?></td>
                            <td>
                              <?php
                              if ($verifikasifile == 0 and $status == 0) {
                                echo 'Menunggu verifikasi Admin';
                              } elseif ($verifikasifile == 1 and $status == 0) {
                                echo 'Menunggu verifikasi Sekprodi';
                              } elseif ($verifikasifile == 1 and ($status == 1 || $status == 3)) {
                                echo 'Disetujui';
                              } elseif ($verifikasifile == 2 and $status == 0) {
                                echo 'Berkas tidak lengkap';
                              } elseif ($verifikasifile == 1 and $status == 2) {
                                echo 'Ditolak prodi';
                              } elseif ($verifikasifile == 1 and $status == 4) {
                                echo 'Sudah dinilai';
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              if ($verifikasifile == 0 and $status == 0) {
                              ?>
                                <a href="ujiankompre-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-secondary" type="button" onclick="alert('Menunggu verifikasi Sekprodi');"><i class="fa fa-spinner" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and ($status == 1 || $status == 3)) {
                              ?>
                                <a href="ujiankompre-detail.php?token=<?= $token; ?>" class="btn btn-success" type="button"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 2 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                <a href="ujiankompre-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 2) {
                              ?>
                                <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                <a href="ujiankompre-hapus.php?token=<?= $token; ?>" class="btn btn-danger" type="button" onclick="return confirm ('Menghapus pengajuan ini ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 4) {
                              ?>
                                <a href="ujiankompre-cetak.php?token=<?= $token; ?>" class="btn btn-success" type="button" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                              <?php
                              }
                              ?>
                            </td>
                          </tr>
                      <?php
                          $no++;
                        }
                      }
                      ?>

                      <!-- ambil semhas-->
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM semhas WHERE nim=?");
                      $stmt->bind_param("s", $nim);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        while ($dhasil = $result->fetch_assoc()) {
                          $jadwalujian = $dhasil['jadwalujian'];
                          $ruang = $dhasil['ruang'];
                          $pembimbing = $dhasil['pembimbing'];
                          $verifikasifile = $dhasil['verifikasifile'];
                          $status = $dhasil['status'];
                          $token = $dhasil['token'];
                          $keterangan = $dhasil['keterangan'];
                      ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td>Ujian Seminar Hasil</td>
                            <td><?php if (isset($jadwalujian)) {
                                  echo tgljam_indo($jadwalujian);
                                } else {
                                  echo '-';
                                } ?>
                            </td>
                            <td><?= $ruang; ?></td>
                            <td>
                              <?php
                              if ($verifikasifile == 0 and $status == 0) {
                                echo 'Menunggu verifikasi Admin';
                              } elseif ($verifikasifile == 1 and $status == 0) {
                                echo 'Menunggu verifikasi Sekprodi';
                              } elseif ($verifikasifile == 1 and ($status == 1 || $status == 3)) {
                                echo 'Disetujui';
                              } elseif ($verifikasifile == 2 and $status == 0) {
                                echo 'Berkas tidak lengkap';
                              } elseif ($verifikasifile == 1 and $status == 2) {
                                echo 'Ditolak prodi';
                              } elseif ($verifikasifile == 1 and $status == 4) {
                                echo 'Sudah dinilai';
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              if ($verifikasifile == 0 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-secondary" type="button" onclick="alert('Menunggu verifikasi Admin');"><i class="fa fa-spinner" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-secondary" type="button" onclick="alert('Menunggu verifikasi Sekprodi');"><i class="fa fa-spinner" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and ($status == 1 || $status == 3)) {
                              ?>
                                <a href="seminarhasil-detail.php?token=<?= $token; ?>" class="btn btn-success" type="button"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 2 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 2) {
                              ?>
                                <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 4) {
                              ?>
                                <a href="seminarhasil-detail.php?token=<?= $token; ?>" class="btn btn-success" type="button"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              }
                              ?>
                            </td>
                          </tr>
                      <?php
                          $no++;
                        }
                      }
                      ?>

                      <!-- ambil data skripsi-->
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE nim=?");
                      $stmt->bind_param("s", $nim);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $juser = $result->num_rows;
                      if ($juser > 0) {
                        while ($dhasil = $result->fetch_assoc()) {
                          $jadwalujian = $dhasil['jadwalujian'];
                          $ruang = $dhasil['ruang'];
                          $pembimbing = $dhasil['pembimbing'];
                          $verifikasifile = $dhasil['verifikasifile'];
                          $status = $dhasil['status'];
                          $token = $dhasil['token'];
                          $keterangan = $dhasil['keterangan'];
                      ?>
                          <tr>
                            <td><?= $no; ?></td>
                            <td>Ujian Skripsi</td>
                            <td><?php if (isset($jadwalujian)) {
                                  echo tgljam_indo($jadwalujian);
                                } else {
                                  echo '-';
                                } ?>
                            </td>
                            <td><?= $ruang; ?></td>
                            <td>
                              <?php
                              if ($verifikasifile == 0 and $status == 0) {
                                echo 'Menunggu verifikasi Admin';
                              } elseif ($verifikasifile == 1 and $status == 0) {
                                echo 'Menunggu verifikasi Sekprodi';
                              } elseif ($verifikasifile == 1 and ($status == 1 || $status == 3)) {
                                echo 'Disetujui';
                              } elseif ($verifikasifile == 2 and $status == 0) {
                                echo 'Berkas tidak lengkap';
                              } elseif ($verifikasifile == 1 and $status == 2) {
                                echo 'Ditolak prodi';
                              } elseif ($verifikasifile == 1 and $status == 4) {
                                echo 'Sudah dinilai';
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              if ($verifikasifile == 0 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-secondary" type="button" onclick="alert('Menunggu verifikasi Admin');"><i class="fa fa-spinner" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-secondary" type="button" onclick="alert('Menunggu verifikasi Sekprodi');"><i class="fa fa-spinner" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and ($status == 1 || $status == 3)) {
                              ?>
                                <a href="ujianskripsi-detail.php?token=<?= $token; ?>" class="btn btn-success" type="button"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 2 and $status == 0) {
                              ?>
                                <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 2) {
                              ?>
                                <a href="#" class="btn btn-danger" type="button" onclick="alert('Alasan <?= $keterangan; ?>');"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              } elseif ($verifikasifile == 1 and $status == 4) {
                              ?>
                                <a href="ujianskripsi-detail.php?token=<?= $token; ?>" class="btn btn-success" type="button"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                              <?php
                              }
                              ?>
                            </td>
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