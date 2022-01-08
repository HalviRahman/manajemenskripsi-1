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
                        <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Mahasiswa</li>
                        </ol>
                    </div>

                    <!-- Data table -->
                    <div class="row">
                        <!-- mahasiswa bimbingan-->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Mahasiswa Bimbingan</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">NIM</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            // ambil data pengajuan judul
                                            $stmt = $conn->prepare("SELECT * FROM pengajuanjudul WHERE pembimbing=?");
                                            $stmt->bind_param("s", $nama);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($dhasil = $result->fetch_assoc()) {
                                                $nimmhs = $dhasil['nim'];
                                                $namamhs = $dhasil['nama'];
                                                $tokenmhs = $dhasil['token'];
                                                //cek status pengajuan judul
                                                $stmt2 = $conn->prepare("SELECT * FROM pengajuanjudul WHERE nim=?");
                                                $stmt2->bind_param("s", $nimmhs);
                                                $stmt2->execute();
                                                $result2 = $stmt2->get_result();
                                                $dhasil2 = $result2->fetch_assoc();
                                                $pengajuanjudul_status = $dhasil2['status'];
                                                if ($pengajuanjudul_status == 0) {
                                                    $pengajuanjudul = 'Pengajuan Judul = Menunggu verifikasi';
                                                } elseif ($pengajuanjudul_status == 1) {
                                                    $pengajuanjudul = 'Pengajuan Judul = Disetujui';
                                                } elseif ($pengajuanjudul_status == 2) {
                                                    $pengajuanjudul = 'Pengajuan Judul = Ditolak';
                                                }

                                                //cek status ujian proposal
                                                $stmt3 = $conn->prepare("SELECT * FROM ujianproposal WHERE nim=? ORDER BY tanggal DESC");
                                                $stmt3->bind_param("s", $nimmhs);
                                                $stmt3->execute();
                                                $result3 = $stmt3->get_result();
                                                $dhasil3 = $result3->fetch_assoc();
                                                $ujianproposal_status = $dhasil3['status'];
                                                if ($ujianproposal_status == 0) {
                                                    $ujianproposal = 'Ujian Proposal = Menunggu verifikasi';
                                                } elseif ($ujianproposal_status == 1) {
                                                    $ujianproposal = 'Ujian Proposal = Menunggu jadwal';
                                                } elseif ($ujianproposal_status == 2) {
                                                    $ujianproposal = 'Ujian Proposal = Ditolak';
                                                } elseif ($ujianproposal_status == 3) {
                                                    $ujianproposal = 'Ujian Proposal = Terjadwal';
                                                }

                                                //cek status ujian komprehensif
                                                $stmt4 = $conn->prepare("SELECT * FROM ujiankompre WHERE nim=? ORDER BY tanggal DESC");
                                                $stmt4->bind_param("s", $nimmhs);
                                                $stmt4->execute();
                                                $result4 = $stmt4->get_result();
                                                $dhasil4 = $result4->fetch_assoc();
                                                $ujiankompre_status = $dhasil4['status'];
                                                if ($ujiankompre_status == 0) {
                                                    $ujiankompre = 'Ujian Komprehensif = Menunggu verifikasi';
                                                } elseif ($ujiankompre_status == 1) {
                                                    $ujiankompre = 'Ujian Komprehensif = Menunggu jadwal';
                                                } elseif ($ujiankompre_status == 2) {
                                                    $ujiankompre = 'Ujian Komprehensif = Ditolak';
                                                } elseif ($ujiankompre_status == 3) {
                                                    $ujiankompre = 'Ujian Komprehensif = Terjadwal';
                                                }
                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $namamhs; ?></td>
                                                    <td><?= $nimmhs; ?></td>
                                                    <td><?= $pengajuanjudul; ?><br />
                                                        <?= $ujianproposal; ?><br />
                                                        <?= $ujiankompre; ?><br />
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="bimbingan-dosen-detail.php?token=<?= $token; ?>" class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></a>
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