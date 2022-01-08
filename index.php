<?php
require('config.php');
require('vendor/myfunc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/uinlogo-small.png" rel="icon">
    <title>Manajemen Skripsi</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
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
                    </div>
                    <!-- ujian hari ini -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ujian Proposal</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush display">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" width="5%">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">NIM</th>
                                                <th class="text-center">Jadwal Ujian</th>
                                                <th class="text-center">Ruang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- ambil data ujian proposal-->
                                            <?php
                                            $no = 1;
                                            $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE status=3");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $juser = $result->num_rows;
                                            if ($juser > 0) {
                                                $dhasil = $result->fetch_assoc();
                                                $nama = $dhasil['nama'];
                                                $nim = $dhasil['nim'];
                                                $jadwalujian = $dhasil['jadwalujian'];
                                                $ruang = $dhasil['ruang'];
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $nama; ?></td>
                                                    <td><?= $nim; ?></td>
                                                    <td><?= tgljam_indo($jadwalujian); ?></td>
                                                    <td><?= $ruang; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            $no++;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tabel ujian komprehensif-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ujian Komprehensif</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush display">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" width="5%">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">NIM</th>
                                                <th class="text-center">Jadwal Ujian</th>
                                                <th class="text-center">Ruang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- ambil data ujian proposal-->
                                            <?php
                                            $no = 1;
                                            $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE status=3");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $juser = $result->num_rows;
                                            if ($juser > 0) {
                                                $dhasil = $result->fetch_assoc();
                                                $nama = $dhasil['nama'];
                                                $nim = $dhasil['nim'];
                                                $jadwalujian = $dhasil['jadwalujian'];
                                                $ruang = $dhasil['ruang'];
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $nama; ?></td>
                                                    <td><?= $nim; ?></td>
                                                    <td><?= tgljam_indo($jadwalujian); ?></td>
                                                    <td><?= $ruang; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            $no++;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tabel seminar hasil -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Seminar Hasil</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush display">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" width="5%">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">NIM</th>
                                                <th class="text-center">Jadwal Ujian</th>
                                                <th class="text-center">Ruang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- ambil data ujian proposal-->
                                            <?php
                                            $no = 1;
                                            $stmt = $conn->prepare("SELECT * FROM semhas WHERE status=3");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $juser = $result->num_rows;
                                            if ($juser > 0) {
                                                $dhasil = $result->fetch_assoc();
                                                $nama = $dhasil['nama'];
                                                $nim = $dhasil['nim'];
                                                $jadwalujian = $dhasil['jadwalujian'];
                                                $ruang = $dhasil['ruang'];
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $nama; ?></td>
                                                    <td><?= $nim; ?></td>
                                                    <td><?= tgljam_indo($jadwalujian); ?></td>
                                                    <td><?= $ruang; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            $no++;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tabel ujian skripsi -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ujian Skripsi</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush display">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" width="5%">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">NIM</th>
                                                <th class="text-center">Jadwal Ujian</th>
                                                <th class="text-center">Ruang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- ambil data ujian proposal-->
                                            <?php
                                            $no = 1;
                                            $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE status=3");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $juser = $result->num_rows;
                                            if ($juser > 0) {
                                                $dhasil = $result->fetch_assoc();
                                                $nama = $dhasil['nama'];
                                                $nim = $dhasil['nim'];
                                                $jadwalujian = $dhasil['jadwalujian'];
                                                $ruang = $dhasil['ruang'];
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $nama; ?></td>
                                                    <td><?= $nim; ?></td>
                                                    <td><?= tgljam_indo($jadwalujian); ?></td>
                                                    <td><?= $ruang; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            $no++;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            $('table.display').DataTable();
        });
    </script>

</body>

</html>