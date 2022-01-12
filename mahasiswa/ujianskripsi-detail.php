<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
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
                        <h1 class="h3 mb-0 text-gray-800">Seminar Hasil</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Seminar Hasil</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Seminar Hasil</h6>
                                </div>
                                <?php
                                $no = 1;
                                $token = $_GET['token'];
                                // ambil data pengajuan judul
                                $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE token=?");
                                $stmt->bind_param("s", $token);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $dhasil = $result->fetch_assoc();
                                $nim = $dhasil['nim'];
                                $nama = $dhasil['nama'];
                                $bidang = $dhasil['bidang'];
                                $judul = $dhasil['judul'];
                                $pembimbing = $dhasil['pembimbing'];
                                $penguji1 = $dhasil['penguji1'];
                                $penguji2 = $dhasil['penguji2'];
                                $forma = $dhasil['forma'];
                                $foto = $dhasil['foto'];
                                $sklsemhas = $dhasil['sklsemhas'];
                                $transkripnilai = $dhasil['transkripnilai'];
                                $toefl = $dhasil['toefl'];
                                $toafl = $dhasil['toafl'];
                                $alumni = $dhasil['alumni'];
                                $skripsi = $dhasil['skripsi'];
                                $jadwalujian = $dhasil['jadwalujian'];
                                $ruang = $dhasil['ruang'];
                                $linkzoom = $dhasil['linkzoom'];
                                $nilai1 = $dhasil['nilai1'];
                                $nilai2 = $dhasil['nilai2'];
                                $revisi1 = $dhasil['revisi1'];
                                $revisi2 = $dhasil['revisi2'];
                                $token = $dhasil['token'];
                                ?>
                                <div class="card-body">
                                    <input type="hidden" class="form-control" value="<?= $nama; ?>" name="nama">
                                    <input type="hidden" class="form-control" value="<?= $nim; ?>" name="nim">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="nama" value="<?= $nama; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>NIM</label>
                                                <input type="text" class="form-control" name="nim" value="<?= $nim; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Bidang Minat</label>
                                                <input type="text" class="form-control" name="bidang" value="<?= $bidang; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Dosen Pembimbing</label>
                                                <input type="text" class="form-control" name="pembimbing" value="<?= $pembimbing; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Judul Proposal</label>
                                        <input type="text" class="form-control" name="judul" value="<?= $judul; ?>" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Jadwal Ujian</label>
                                                <input type="text" class="form-control" name="jadwalujian" value="<?= tgljam_indo($jadwalujian); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Ruangan</label>
                                                <input type="text" class="form-control" name="ruangan" value="<?= $ruang; ?>" readonly>
                                            </div>
                                            <?php
                                            if ($ruang == 'Zoom') {
                                            ?>
                                                <div class="form-group">
                                                    <label>Link</label>
                                                    <input type="text" class="form-control" name="linkzoom" value="<?= urldecode($linkzoom); ?>" readonly>
                                                    <a href="<?= urldecode($linkzoom); ?>" type="button" class="btn btn-success" target="_blank">BUKA</a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Dosen Penguji Fisika</label>
                                                <input type="text" class="form-control" name="penguji1" value="<?= $penguji1; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Revisi Penguji Fisika</label>
                                                <textarea name="revisi1" class="form-control" rows="5" disabled><?php if (isset($revisi1)) {
                                                                                                                    echo $revisi1;
                                                                                                                } ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Dosen Penguji Integrasi</label>
                                                <input type="text" class="form-control" name="penguji2" value="<?= $penguji2; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Revisi Penguji Integrasi</label>
                                                <textarea name="revisi2" class="form-control" rows="5" disabled><?php if (isset($revisi2)) {
                                                                                                                    echo $revisi2;
                                                                                                                } ?></textarea>
                                            </div>
                                        </div>
                                    </div>
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