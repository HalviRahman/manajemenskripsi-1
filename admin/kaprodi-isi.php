<?php
session_start();
// $userid = $_SESSION['userid'];
// global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
$nama = $_SESSION['nama'];
$token = $_SESSION['token'];
if ($role != 'admin') {
    if ($jabatan != 'admin') {
        header("location:../deauth.php");
    }
}
require('../config.php');
require('../vendor/myfunc.php');


if (isset($_POST['edit'])) {

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);

    //upload file
    $target_dir = "../img/ttd/";
    $ttd = $target_dir . "ttdkaprodi" . ".png";
    $uploadOk = 1;

    // Check file size
    if ($_FILES["ttd"]["size"] > 1048576) {
        $uploadOk = 0;
        echo 'file ttd oversize';
    }
    if ($uploadOk == 0) {
        header("location:kaprodi-isi.php?pesan=gagal");
        //echo 'something wrong';
    } else {
        move_uploaded_file($_FILES["ttd"]["tmp_name"], $ttd);
        $stmt = $conn->prepare("UPDATE kaprodi
                              SET nama=?, nip=?, ttd=?");
        $stmt->bind_param("sss", $nama, $nip, $ttd);
        $stmt->execute();
        header("location:kaprodi-isi.php?pesan=success");
        //echo 'success';
    }
}
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
                        <h1 class="h3 mb-0 text-gray-800">Update Kaprodi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Kaprodi</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Update Kaprodi</h6>
                                </div>

                                <?php
                                // ambil data pengajuan judul
                                $stmt = $conn->prepare("SELECT * FROM kaprodi WHERE token=1");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $dhasil = $result->fetch_assoc();
                                $nama = $dhasil['nama'];
                                $nip = $dhasil['nip'];
                                $ttd = $dhasil['ttd'];
                                ?>
                                <div class="card-body">
                                    <?php
                                    //ambil nilai variabel pesan di URL
                                    if (isset($_GET['pesan'])) {
                                        $pesan = $_GET['pesan'];
                                        if ($pesan == 'success') {
                                    ?>
                                            <div class="alert alert-success" role="alert">
                                                Berhasil Edit Profil!
                                            </div>
                                        <?php
                                        } elseif ($pesan == 'gagal') {
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                <b>ERROR!!</b> Update data gagal
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <form action="" enctype="multipart/form-data" method="POST">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="<?= $nama; ?>" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input type="number" class="form-control" value="<?= $nip; ?>" name="nip">
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Foto tanda tangan</label>
                                                    <input type="file" name="ttd" class="form-control" accept=".png">
                                                    <small style="color: red;">Format file PNG ukuran maksimal 1MB</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <img src="<?= $ttd; ?>" width="300px">
                                            </div>
                                        </div>
                                        <button type="submit" name="edit" class="btn btn-primary btn-lg btn-block" onclick="return confirm ('Update data ?')">UPDATE</button>
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