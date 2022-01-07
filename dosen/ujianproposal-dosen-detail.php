<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nip = $_SESSION['nim'];
if ($role != 'dosen') {
    if ($jabatan != 'kaprodi' || $jabatan != 'sekprodi') {
        header("location:../deauth.php");
    }
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
                        <h1 class="h3 mb-0 text-gray-800">Ujian Proposal</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengajuan Ujian Proposal</li>
                        </ol>
                    </div>

                    <?php
                    $no = 1;
                    $token = $_GET['token'];
                    // ambil data pengajuan judul
                    $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE token=?");
                    $stmt->bind_param("s", $token);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $dhasil = $result->fetch_assoc();
                    $nimmhs = $dhasil['nim'];
                    $namamhs = $dhasil['nama'];
                    $bidang = $dhasil['bidang'];
                    $judul = $dhasil['judul'];
                    $persetujuanpembimbing = $dhasil['persetujuanpembimbing'];
                    $khs = $dhasil['khs'];
                    $proposal = $dhasil['proposal'];
                    $pembimbing = $dhasil['pembimbing'];
                    $penguji1 = $dhasil['penguji1'];
                    $nilai1 = $dhasil['nilai1'];
                    $revisi1 = $dhasil['revisi1'];
                    $penguji2 = $dhasil['penguji2'];
                    $nilai2 = $dhasil['nilai2'];
                    $revisi2 = $dhasil['revisi2'];
                    $token = $dhasil['token'];
                    if ($penguji1 == $nama) {
                        $penguji = 'PENGUJI UTAMA';
                    } elseif ($penguji2 == $nama) {
                        $penguji = 'PENGUJI ANGGOTA';
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $penguji; ?></h6>
                                </div>

                                <div class="card-body">
                                    <input type="hidden" class="form-control" value="<?= $nama; ?>" name="nama">
                                    <input type="hidden" class="form-control" value="<?= $nim; ?>" name="nim">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="nama" value="<?= $namamhs; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>NIM</label>
                                                <input type="text" class="form-control" name="nim" value="<?= $nimmhs; ?>" readonly>
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
                                                <label>Pembimbing</label>
                                                <input type="text" class="form-control" name="pembimbing" value="<?= $pembimbing; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Judul Proposal</label>
                                        <input type="text" class="form-control" name="judul" value="<?= $judul; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col" align="center">
                                                <label>File Proposal</label>
                                                <br />
                                                <a href="<?= $proposal; ?>" target="_blank"><img src="../img/pdficon.jpg" width="100px" class="img-thumbnail" name="fileproposal"></a>
                                                <br />
                                                <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST">
                                        <div class="row">
                                            <label>Nilai</label>
                                            <input type="number" name="nilai" class="form-control" required>
                                            <label>Revisi</label>
                                            <textarea name="revisi" class="form-control" rows="5"></textarea>
                                        </div>
                                        <br />
                                        <input type="hidden" name="token" value="<?= $token; ?>">
                                        <input type="hidden" name="penguji" value="<?= $penguji; ?>">
                                        <div class="col">
                                            <button type="submit" class="btn btn-success btn-lg btn-block" formaction="ujianproposal-dosen-nilai.php" onclick="return confirm('Menyimpan Nilai ?')">NILAI</button>
                                        </div>
                                    </form>
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