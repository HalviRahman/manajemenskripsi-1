<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$nim = $_SESSION['nim'];
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
                        <h1 class="h3 mb-0 text-gray-800">Pengajuan Ujian Skripsi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ujian Skripsi</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
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
                                                <input type="text" class="form-control" name="judul" value="<?= $judul; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group text-break">
                                                <label>Dosen Pembimbing</label>
                                                <input type="text" class="form-control" name="pembimbing" value="<?= $pembimbing; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col">
                                                <label>Penguji Ketua</label>
                                                <select name="penguji1" class="form-control">
                                                    <option value="<?= $penguji1; ?>"><?= $penguji1; ?></option>
                                                    <?php
                                                    $stmt = $conn->prepare("SELECT * FROM pengguna WHERE role='dosen' and nama <> '$pembimbing'");
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($dhasil = $result->fetch_assoc()) {
                                                        $nama = $dhasil['nama'];
                                                        $stmt2 = $conn->prepare("SELECT * FROM ujianproposal WHERE penguji1='$nama' OR penguji2='$nama'");
                                                        $stmt2->execute();
                                                        $result2 = $stmt2->get_result();
                                                        $jbimbingan = $result2->num_rows;
                                                    ?>
                                                        <option value="<?= $nama; ?>"><?= $nama; ?> (<?= $jbimbingan; ?>)</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label>Penguji Anggota</label>
                                                <select name="penguji2" class="form-control">
                                                    <option value="<?= $penguji2; ?>"><?= $penguji2; ?></option>
                                                    <?php
                                                    $stmt = $conn->prepare("SELECT * FROM pengguna WHERE role='dosen' and nama <> '$pembimbing'");
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($dhasil = $result->fetch_assoc()) {
                                                        $nama = $dhasil['nama'];
                                                        $stmt2 = $conn->prepare("SELECT * FROM ujianproposal WHERE penguji1='$nama' OR penguji2='$nama'");
                                                        $stmt2->execute();
                                                        $result2 = $stmt2->get_result();
                                                        $jbimbingan = $result2->num_rows;
                                                    ?>
                                                        <option value="<?= $nama; ?>"><?= $nama; ?> (<?= $jbimbingan; ?>)</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col" align="center">
                                                    <label>FORM A, A-1, A-2</label>
                                                    <br />
                                                    <a href="<?= $forma; ?>" target="_blank"><img src="<?= '../img/pdficon.jpg'; ?>" width="100px" class="img-thumbnail" name="sklproposal"></a>
                                                    <br />
                                                    <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                                </div>
                                                <div class="col" align="center">
                                                    <label>Foto</label>
                                                    <br />
                                                    <a href="<?= $foto; ?>" target="_blank"><img src="<?= $foto; ?>" width="100px" class="img-thumbnail" name="sklkompre"></a>
                                                    <br />
                                                    <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                                </div>
                                                <!--
                                                <div class="col" align="center">
                                                    <label>SKL Seminar Hasil</label>
                                                    <br />
                                                    <a href="<?= $sklsemhas; ?>" target="_blank"><img src="<?= $sklsemhas; ?>" width="100px" class="img-thumbnail" name="sklkompre"></a>
                                                    <br />
                                                    <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                                </div>
                                                -->
                                                <div class="col" align="center">
                                                    <label>Transkrip Nilai</label>
                                                    <br />
                                                    <a href="<?= $transkripnilai; ?>" target="_blank"><img src="../img/pdficon.jpg" width="100px" class="img-thumbnail" name="fileproposal"></a>
                                                    <br />
                                                    <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col" align="center">
                                                    <label>Sertifikat TOEFL</label>
                                                    <br />
                                                    <a href="<?= $toefl; ?>" target="_blank"><img src="<?= $toefl; ?>" width="100px" class="img-thumbnail" name="sklproposal"></a>
                                                    <br />
                                                    <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                                </div>
                                                <div class="col" align="center">
                                                    <label>Sertifikat TOAFL</label>
                                                    <br />
                                                    <a href="<?= $toafl; ?>" target="_blank"><img src="<?= $toafl; ?>" width="100px" class="img-thumbnail" name="sklkompre"></a>
                                                    <br />
                                                    <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                                </div>
                                                <div class="col" align="center">
                                                    <label>Form Alumni</label>
                                                    <br />
                                                    <a href="<?= $alumni; ?>" target="_blank"><img src="../img/pdficon.jpg" width="100px" class="img-thumbnail" name="sklkompre"></a>
                                                    <br />
                                                    <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                                </div>
                                                <div class="col" align="center">
                                                    <label>Laporan Skripsi</label>
                                                    <br />
                                                    <a href="<?= $skripsi; ?>" target="_blank"><img src="../img/pdficon.jpg" width="100px" class="img-thumbnail" name="fileproposal"></a>
                                                    <br />
                                                    <small style="color: blue">Klik pada gambar untuk membuka file</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <input type="hidden" name="token" value="<?= $token; ?>">
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="btn btn-success btn-lg btn-block" formaction="ujianskripsi-sekprodi-setujui.php" onclick="return confirm('Menyetujui pengajuan ini ?')">SETUJUI</button>
                                            </div>
                                            <div class="col">
                                                <button type="button" data-toggle="modal" data-target="#modal-tolak" class="btn btn-danger btn-lg btn-block">TOLAK</button>
                                            </div>
                                        </div>
                                        <!-- modal tolak -->
                                        <div class="modal fade" id="modal-tolak">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Alasan Penolakan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea class="form-control" rows="3" name="keterangan"></textarea>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                        <button name="aksi" value="tolak" type="submit" formaction="ujianskripsi-sekprodi-tolak.php" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menolak pengajuan ini ?')"> <i class="fa fa-times"></i> Tolak</button>
                                                    </div>
                                                </div>
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