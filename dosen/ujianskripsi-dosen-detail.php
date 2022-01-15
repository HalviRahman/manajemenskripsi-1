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
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col">
                                                <table class="table table-bordered table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center" colspan="2"><b>1. Isi Skripsi</b></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="70%">a. Pentingnya masalah</td>
                                                            <td><select name="pentingnyamasalah" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>b. Keselarasan rumusan masalah, tujuan, dan metode penelitian</td>
                                                            <td><select name="keselarasan" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>c. Ketepatan teknik analisa data</td>
                                                            <td><select name="analisadata" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>d. Relevansi Kajian Pustaka</td>
                                                            <td><select name="kajianpustaka" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>e. Paparan Data</td>
                                                            <td><select name="paparandata" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>f. Keteraturan alur pembahasan</td>
                                                            <td><select name="alurpembahasan" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>g. Kesesuaian kesimpulan dengan masalah penelitian</td>
                                                            <td><select name="kesimpulan" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col">
                                                <table class="table table-bordered table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center" colspan="2"><b>2. Pelaksanaan Ujian</b></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="70%">a. Penguasaan materi</td>
                                                            <td><select name="penguasaanmateri" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>b. Sikap</td>
                                                            <td><select name="sikap" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br />
                                                <table class="table table-bordered table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center" colspan="2"><b>3. Penulisan</b></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="70%">a. Ketepatan teknik penulisan dan tata bahasa</td>
                                                            <td><select name="penulisan" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="4">4</option>
                                                                    <option value="3">3</option>
                                                                    <option value="2">2</option>
                                                                    <option value="1">1</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br />
                                                <table class="table table-bordered table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center" colspan="2"><b>Revisi</b></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <textarea name="revisi" class="form-control" rows="4"></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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