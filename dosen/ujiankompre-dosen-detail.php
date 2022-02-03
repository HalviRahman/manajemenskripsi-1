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
                        <h1 class="h3 mb-0 text-gray-800">Ujian Komprehensif</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ujian Komprehensif</li>
                        </ol>
                    </div>

                    <?php
                    $no = 1;
                    $token = $_GET['token'];
                    // ambil data pengajuan judul
                    $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE token=?");
                    $stmt->bind_param("s", $token);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $dhasil = $result->fetch_assoc();
                    $nimmhs = $dhasil['nim'];
                    $namamhs = $dhasil['nama'];
                    $bidang = $dhasil['bidang'];
                    $judul = $dhasil['judul'];
                    $proposal = $dhasil['fileproposal'];
                    $jadwalujian = $dhasil['jadwalujian'];
                    $ruang = $dhasil['ruang'];
                    $linkzoom = $dhasil['linkzoom'];
                    $pembimbing = $dhasil['pembimbing'];
                    $penguji1 = $dhasil['penguji1'];
                    $nilai1 = $dhasil['nilai1'];
                    $revisi1 = $dhasil['revisi1'];
                    $penguji2 = $dhasil['penguji2'];
                    $nilai2 = $dhasil['nilai2'];
                    $revisi2 = $dhasil['revisi2'];
                    $token = $dhasil['token'];
                    if ($penguji1 == $nama) {
                        $penguji = 'Penguji Ketua';
                    } elseif ($penguji2 == $nama) {
                        $penguji = 'PENGUJI ANGGOTA';
                    }

                    if ($penguji1 == $nama) {
                        $revisi = $revisi1;
                        $nilai = $nilai1;
                    } else {
                        $revisi = $revisi2;
                        $nilai = $nilai2;
                    }
                    ?>
                    <?php
                    if (isset($_GET['pesan'])) {
                        $pesan = $_GET['pesan'];
                    ?>
                        <div class="alert alert-danger">
                            <strong>ERROR!!</strong> nilai bilangan bulat diantara 0 s/d 100.
                        </div>
                    <?php
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
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Jadwal Ujian</label>
                                                <input type="text" class="form-control" name="jadwalujian" value="<?= tgljam_indo($jadwalujian); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Ruangan</label>
                                                        <input type="text" class="form-control" name="ruangan" value="<?= $ruang; ?>" readonly>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($ruang == 'Zoom') {
                                                ?>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>Link</label>
                                                            <input type="text" class="form-control" name="linkzoom" value="<?= urldecode($linkzoom); ?>" readonly>
                                                            <a href="<?= urldecode($linkzoom); ?>" type="button" class="btn btn-success" target="_blank">BUKA</a>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
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
                                            <div class="col">
                                                <label>Nilai (0 - 100)</label>
                                                <input type="number" name="nilai" class="form-control" value="<?= $nilai; ?>" required>
                                                <label>Revisi</label>
                                                <textarea name="revisi" class="form-control" rows="5"><?php if (isset($revisi)) {
                                                                                                            echo $revisi;
                                                                                                        } ?></textarea>
                                            </div>
                                        </div>
                                        <br />
                                        <input type="hidden" name="token" value="<?= $token; ?>">
                                        <input type="hidden" name="penguji" value="<?= $penguji; ?>">
                                        <div class="col">
                                            <button type="submit" class="btn btn-success btn-lg btn-block" formaction="ujiankompre-dosen-nilai.php" onclick="return confirm('Menyimpan Nilai ?')">NILAI</button>
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