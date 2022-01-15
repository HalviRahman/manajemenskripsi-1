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
                        <h1 class="h3 mb-0 text-gray-800">Ujian Skripsi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ujian Skripsi</li>
                        </ol>
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
                    $nimmhs = $dhasil['nim'];
                    $namamhs = $dhasil['nama'];
                    $bidang = $dhasil['bidang'];
                    $judul = $dhasil['judul'];
                    $pembimbing = $dhasil['pembimbing'];
                    $nilaipembimbing = $dhasil['nilaipembimbing'];
                    $revisipembimbing = $dhasil['revisipembimbing'];
                    $skripsi = $dhasil['skripsi'];
                    $penguji1 = $dhasil['penguji1'];
                    $nilai1 = $dhasil['nilai1'];
                    $revisi1 = $dhasil['revisi1'];
                    $penguji2 = $dhasil['penguji2'];
                    $nilai2 = $dhasil['nilai2'];
                    $revisi2 = $dhasil['revisi2'];
                    $penguji3 = $dhasil['penguji3'];
                    $nilai3 = $dhasil['nilai3'];
                    $revisi3 = $dhasil['revisi3'];
                    $token = $dhasil['token'];
                    if ($penguji1 == $nama) {
                        $penguji = 'Penguji Ketua';
                    } elseif ($penguji2 == $nama) {
                        $penguji = 'PENGUJI ANGGOTA';
                    } elseif ($penguji3 == $nama) {
                        $penguji = 'PENGUJI INTEGRASI';
                    } elseif ($pembimbing == $nama) {
                        $penguji = 'PEMBIMBING';
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
                                        <textarea class="form-control" name="judul" readonly><?= $judul; ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Ketua Penguji</label>
                                                <input type="text" class="form-control" name="penguji1" value="<?= $penguji1; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Penguji Anggota</label>
                                                <input type="text" class="form-control" name="penguji2" value="<?= $penguji2; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Penguji Integrasi</label>
                                                <input type="text" class="form-control" name="penguji3" value="<?= $penguji3; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col" align="center">
                                                <label>File Laporan Skripsi</label>
                                                <br />
                                                <a href="<?= $skripsi; ?>" target="_blank"><img src="../img/pdficon.jpg" width="100px" class="img-thumbnail" name="fileproposal"></a>
                                                <br />
                                                <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-bordered table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <td class="text-center">Rentang Nilai</td>
                                                        <td class="text-center">Nilai Huruf</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">85 - 100</td>
                                                        <td class="text-center">A</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">75 - 84</td>
                                                        <td class="text-center">B+</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">70 - 74</td>
                                                        <td class="text-center">B</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">65 - 69</td>
                                                        <td class="text-center">C+</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">60 - 64</td>
                                                        <td class="text-center">C</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">50 - 59</td>
                                                        <td class="text-center">D</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">0 - 49</td>
                                                        <td class="text-center">E</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br />
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
                                            <button type="submit" class="btn btn-success btn-lg btn-block" formaction="ujianskripsi-dosen-nilai.php" onclick="return confirm('Menyimpan Nilai ?')">NILAI</button>
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