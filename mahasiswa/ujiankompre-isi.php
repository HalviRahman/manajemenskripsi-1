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
                        <h1 class="h3 mb-0 text-gray-800">Pendaftaran Ujian Komprehensif</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ujian Komprehensif</li>
                        </ol>
                    </div>
                    <?php
                    $no = 1;
                    // ambil data pengajuan judul
                    $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE nim=? and status=4");
                    $stmt->bind_param("s", $nim);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $dhasil = $result->fetch_assoc();
                    $nim = $dhasil['nim'];
                    $nama = $dhasil['nama'];
                    $bidang = $dhasil['bidang'];
                    $judul = $dhasil['judul'];
                    $pembimbing = $dhasil['pembimbing'];
                    $fileproposal = $dhasil['proposal'];
                    $token = $dhasil['token'];
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pengajuan Ujian Komprehensif</h6>
                                </div>
                                <div class="card-body">
                                    <form action="ujiankompre-simpan.php" enctype="multipart/form-data" method="POST">
                                        <input type="hidden" name="bidang" value="<?= $bidang; ?>">
                                        <input type="hidden" name="judul" value="<?= $judul; ?>">
                                        <div class="form-group">
                                            <label>Surat Keterangan Lulus Ujian Seminar Proposal</label>
                                            <input type="file" name="sklsempro" class="form-control" accept=".pdf">
                                            <small style="color: red;">
                                                <li>Silahkan download dari dashboard</li>
                                                <li>Format file PDF ukuran maksimal 1MB</li>
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Berkas File Proposal (revisi)</label>
                                            <input type="file" name="fileproposal" class="form-control" accept=".pdf">
                                            <small style="color: red;">
                                                <li>Revisi File Proposal yang telah disetujui pembimbing</li>
                                                <li>Format file PDF ukuran maksimal 10MB</li>
                                            </small>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">AJUKAN</button>
                                    </form>
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

</body>

</html>