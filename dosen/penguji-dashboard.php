<?php
session_start();
$userid = $_SESSION['userid'];
$nama = $_SESSION['nama'];
global $userid;
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
                        <h1 class="h3 mb-0 text-gray-800">Daftar Ujian Mahasiswa</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Ujian Mahasiswa</li>
                        </ol>
                    </div>

                    <!-- Data table -->
                    <div class="row">
                        <!-- Pengajuan Ujian -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Ujian Mahasiswa</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Jadwal Ujian</th>
                                                <th class="text-center">Ujian</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">NIM</th>
                                                <th class="text-center">Judul</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            // ambil data pengajuan ujian proposal
                                            $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE (penguji1=? OR penguji2=?) ORDER BY jadwalujian DESC");
                                            $stmt->bind_param("ss", $nama, $nama);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($dhasil = $result->fetch_assoc()) {
                                                $nimmhs = $dhasil['nim'];
                                                $namamhs = $dhasil['nama'];
                                                $judul = $dhasil['judul'];
                                                $jadwalujian = $dhasil['jadwalujian'];
                                                $ujian = 'Seminar Proposal';
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= tgljam_indo($jadwalujian); ?></td>
                                                    <td><?= $ujian; ?></td>
                                                    <td><?= $namamhs; ?></td>
                                                    <td><?= $nimmhs; ?></td>
                                                    <td><?= $judul; ?></td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>
                                            <?php
                                            // ambil data pengajuan ujian kompre
                                            $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE (penguji1=? OR penguji2=?) ORDER BY jadwalujian DESC");
                                            $stmt->bind_param("ss", $nama, $nama);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($dhasil = $result->fetch_assoc()) {
                                                $nimmhs = $dhasil['nim'];
                                                $namamhs = $dhasil['nama'];
                                                $judul = $dhasil['judul'];
                                                $jadwalujian = $dhasil['jadwalujian'];
                                                $ujian = 'Ujian Komprehensif';
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= tgljam_indo($jadwalujian); ?></td>
                                                    <td><?= $ujian; ?></td>
                                                    <td><?= $namamhs; ?></td>
                                                    <td><?= $nimmhs; ?></td>
                                                    <td><?= $judul; ?></td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>
                                            <?php
                                            // ambil data pengajuan ujian seminar hasil
                                            $stmt = $conn->prepare("SELECT * FROM semhas WHERE (penguji1=? OR penguji2=?) ORDER BY jadwalujian DESC");
                                            $stmt->bind_param("ss", $nama, $nama);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($dhasil = $result->fetch_assoc()) {
                                                $nimmhs = $dhasil['nim'];
                                                $namamhs = $dhasil['nama'];
                                                $judul = $dhasil['judul'];
                                                $jadwalujian = $dhasil['jadwalujian'];
                                                $ujian = 'Seminar Hasil';
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= tgljam_indo($jadwalujian); ?></td>
                                                    <td><?= $ujian; ?></td>
                                                    <td><?= $namamhs; ?></td>
                                                    <td><?= $nimmhs; ?></td>
                                                    <td><?= $judul; ?></td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>
                                            <?php
                                            // ambil data pengajuan ujian skripsi
                                            $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE (penguji1=? OR penguji2=? OR penguji3=?) ORDER BY jadwalujian DESC");
                                            $stmt->bind_param("sss", $nama, $nama, $nama);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($dhasil = $result->fetch_assoc()) {
                                                $nimmhs = $dhasil['nim'];
                                                $namamhs = $dhasil['nama'];
                                                $judul = $dhasil['judul'];
                                                $jadwalujian = $dhasil['jadwalujian'];
                                                $ujian = 'Seminar Hasil';
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= tgljam_indo($jadwalujian); ?></td>
                                                    <td><?= $ujian; ?></td>
                                                    <td><?= $namamhs; ?></td>
                                                    <td><?= $nimmhs; ?></td>
                                                    <td><?= $judul; ?></td>
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