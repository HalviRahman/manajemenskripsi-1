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
                        <h1 class="h3 mb-0 text-gray-800">Pendaftaran Ujian Skripsi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pendaftaran Ujian Skripsi</li>
                        </ol>
                    </div>
                    <?php
                    $no = 1;
                    $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE nim=? and status=4");
                    $stmt->bind_param("s", $nim);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $jhasil = $result->num_rows;
                    if ($jhasil > 0) {
                        $dhasil = $result->fetch_assoc();
                        $bidang = $dhasil['bidang'];
                        $judul = $dhasil['judul'];
                        $pembimbing = $dhasil['pembimbing'];
                        $penguji1 = $dhasil['penguji1'];
                        $penguji2 = $dhasil['penguji2'];
                        $token = $dhasil['token'];
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Ujian Skripsi</h6>
                                </div>
                                <div class="card-body">
                                    <form action="ujianskripsi-simpan.php" enctype="multipart/form-data" method="POST">
                                        <input type="hidden" name="bidang" value="<?= $bidang; ?>">
                                        <input type="hidden" name="judul" value="<?= $judul; ?>">
                                        <input type="hidden" name="pembimbing" value="<?= $pembimbing; ?>">
                                        <input type="hidden" name="penguji1" value="<?= $penguji1; ?>">
                                        <input type="hidden" name="penguji2" value="<?= $penguji2; ?>">
                                        <div class="form-group">
                                            <label>Form A, A1 dan A2 yang sudah di tanda tangani (1 file)</label>
                                            <input type="file" name="forma" class="form-control" accept=".pdf" required>
                                            <small style="color: red;">Format file PDF ukuran maksimal 1MB</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto Resmi </label>
                                            <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg" required>
                                            <small style="color: red;">Format file JPG ukuran maksimal 1MB</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Surat Keterangan Lulus Seminar Hasil</label>
                                            <input type="file" name="sklsemhas" class="form-control" accept=".pdf" required>
                                            <small style="color: red;">Download dari dashboard</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Bukti pembayaran semester terakhir</label>
                                            <input type="file" name="buktibayar" class="form-control" accept=".jpg,.jpeg" required>
                                            <small style="color: red;">Format file JPG ukuran maksimal 1MB</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Kartu Hasil Studi</label>
                                            <input type="file" name="khs" class="form-control" accept=".jpg,.jpeg" required>
                                            <small style="color: red;">
                                                <li>KHS Lengkap (semester awal s/d akhir)</li>
                                                <li>Format file JPG ukuran maksimal 1MB</li>
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label>Transkrip Nilai (fix)</label>
                                            <input type="file" name="transkripnilai" class="form-control" accept=".pdf" required>
                                            <small style="color: red;">
                                                <li>Sudah di koreksi SKS dan Kode Matakuliah</li>
                                                <li>Format File PDF ukuran maksimal 1MB</li>
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label>Scan Ijazah Terakhir</label>
                                            <input type="file" name="ijazah" class="form-control" accept=".pdf" required>
                                            <small style="color: red;">
                                                <li>Ijazah Terakhir</li>
                                                <li>Format File PDF ukuran maksimal 1MB</li>
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label>Sertifikat TOEFL</label>
                                            <input type="file" name="toefl" class="form-control" accept=".jpg,.jpeg" required>
                                            <small style="color: red;">Format file JPG ukuran maksimal 1MB</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Sertifikat TOAFL</label>
                                            <input type="file" name="toafl" class="form-control" accept=".jpg,.jpeg" required>
                                            <small style="color: red;">Format file JPG ukuran maksimal 1MB</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Form Alumni</label>
                                            <input type="file" name="alumni" class="form-control" accept=".pdf" required>
                                            <small style="color: red;">
                                                <li>Sudah di tanda tangani</li>
                                                <li>Format file PDF ukuran maksimal 1MB</li>
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label>File Laporan Skripsi</label>
                                            <input type="file" name="skripsi" class="form-control" accept=".pdf" required>
                                            <small style="color: red;">Format file PDF ukuran maksimal 10MB</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Bukti cek plagiarisme</label>
                                            <input type="file" name="turnitin" class="form-control" accept=".pdf">
                                            <small style="color: red;">
                                                <li>Format file PDF ukuran maksimal 1MB</li>
                                                <li>Similarity maksimal 30%</li>
                                            </small>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="return confirm ('Dengan ini saya menyatakan kebenaran dokumen yang saya upload')">AJUKAN</button>
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