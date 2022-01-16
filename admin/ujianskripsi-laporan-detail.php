<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
if ($role != 'admin') {
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
                        <h1 class="h3 mb-0 text-gray-800">Data Ujian Skripsi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Ujian Skripsi</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Ujian Skripsi</h6>
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
                                $penguji3 = $dhasil['penguji3'];
                                $jadwalujian = $dhasil['jadwalujian'];
                                $ruang = $dhasil['ruang'];
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
                                            <div class="form-group text-break">
                                                <label>Judul Proposal</label>
                                                <textarea class="form-control" name="judul" rows="3" readonly><?= $judul; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group text-break">
                                                <label>Dosen Pembimbing</label>
                                                <input type="text" class="form-control" name="pembimbing" value="<?= $pembimbing; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group text-break">
                                                <label>Penguji Ketua</label>
                                                <input type="text" class="form-control" name="penguji1" value="<?= $penguji1; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group text-break">
                                                <label>Penguji Anggota</label>
                                                <input type="text" class="form-control" name="penguji2" value="<?= $penguji2; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group text-break">
                                                <label>Penguji Integrasi</label>
                                                <input type="text" class="form-control" name="penguji3" value="<?= $penguji3; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group text-break">
                                                <label>Jadwal Ujian</label>
                                                <input type="text" class="form-control" name="jadwalujian" value="<?= tgljam_indo($jadwalujian); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group text-break">
                                                <label>Ruang</label>
                                                <input type="text" class="form-control" name="jadwalujian" value="<?= $ruang; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <label>Nilai</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">Penilai</th>
                                                    <th style="text-align:center">Pentingnya masalah</th>
                                                    <th style="text-align:center">Keselarasan</th>
                                                    <th style="text-align:center">Analisa Data</th>
                                                    <th style="text-align:center">Kajian Pustaka</th>
                                                    <th style="text-align:center">Paparan Data</th>
                                                    <th style="text-align:center">Alur Pembahasan</th>
                                                    <th style="text-align:center">Kesesuaian Kesimpulan dengan Masalah Penelitian</th>
                                                    <th style="text-align:center">Penguasaan Materi</th>
                                                    <th style="text-align:center">Sikap</th>
                                                    <th style="text-align:center">Penulisan</th>
                                                    <th style="text-align:center">Nilai (x2)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $totalnilai = 0;
                                                $ratanilai = 0;
                                                $stmt = $conn->prepare("SELECT * FROM nilaiskripsi WHERE nim=?");
                                                $stmt->bind_param("s", $nim);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while ($dhasil = $result->fetch_assoc()) {
                                                    $penguji = $dhasil['penguji'];
                                                    $pentingnyamasalah = $dhasil['pentingnyamasalah'];
                                                    $keselarasan = $dhasil['keselarasan'];
                                                    $analisadata = $dhasil['analisadata'];
                                                    $kajianpustaka = $dhasil['kajianpustaka'];
                                                    $paparandata = $dhasil['paparandata'];
                                                    $alurpembahasan = $dhasil['alurpembahasan'];
                                                    $kesimpulan = $dhasil['kesimpulan'];
                                                    $penguasaanmateri = $dhasil['penguasaanmateri'];
                                                    $sikap = $dhasil['sikap'];
                                                    $penulisan = $dhasil['penulisan'];
                                                    $totalnilai = ($pentingnyamasalah + $keselarasan + $analisadata + $kajianpustaka + $paparandata + $alurpembahasan + $kesimpulan + $penguasaanmateri + $sikap + $penulisan) * 2;
                                                    $ratanilai = ($ratanilai + $totalnilai);
                                                ?>
                                                    <tr>
                                                        <td style="width:30%"><?= $penguji; ?></td>
                                                        <td style="text-align:center"><?= $pentingnyamasalah; ?></td>
                                                        <td style="text-align:center"><?= $keselarasan; ?></td>
                                                        <td style="text-align:center"><?= $analisadata; ?></td>
                                                        <td style="text-align:center"><?= $kajianpustaka; ?></td>
                                                        <td style="text-align:center"><?= $paparandata; ?></td>
                                                        <td style="text-align:center"><?= $alurpembahasan; ?></td>
                                                        <td style="text-align:center"><?= $kesimpulan; ?></td>
                                                        <td style="text-align:center"><?= $penguasaanmateri; ?></td>
                                                        <td style="text-align:center"><?= $sikap; ?></td>
                                                        <td style="text-align:center"><?= $penulisan; ?></td>
                                                        <td style="text-align:center"><?= $totalnilai; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <label>Rata - Rata Nilai Penguji = <?= $ratanilai / 4; ?></label>
                                    <?php
                                    if (($ratanilai / 4) > 60) {
                                        $keterangan = 'LULUS';
                                    } else {
                                        $keterangan = 'TIDAK LULUS';
                                    }
                                    ?>
                                    <br />
                                    <label>Keterangan <b><?= $keterangan; ?></b> dengan nilai <?= nilai($ratanilai / 4); ?></label>

                                    <hr>
                                    <form method="POST">
                                        <input type="hidden" name="token" value="<?= $token; ?>">
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="btn btn-success btn-lg btn-block" formaction="ujianskripsi-laporan-cetak.php" onclick="return confirm('Cetak Berita Acara Ujian Skripsi ?')">Cetak</button>
                                            </div>
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