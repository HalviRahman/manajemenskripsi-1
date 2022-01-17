<?php
session_start();
$userid = $_SESSION['userid'];
global $userid;
$role = $_SESSION['role'];
$jabatan = $_SESSION['jabatan'];
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
    <link href="../img/logo/uinlogo.png" rel="icon">
    <title>Manajemen Skripsi</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require('sidebar.php'); ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php require('topbar.php'); ?>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Email Setting</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Email Setting</li>
                        </ol>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Email Setting</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($_GET['pesan'])) {
                                        $pesan = $_GET['pesan'];
                                        if ($pesan == 'success') {
                                    ?>
                                            <div class="alert alert-success" role="alert">
                                                Berhasil Edit Email!
                                            </div>
                                        <?php
                                        } elseif ($pesan == 'gagal') {
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                <b>ERROR!!</b> Gagal Edit Email
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    $qemail = mysqli_query($conn, "SELECT * FROM email");
                                    $demail = mysqli_fetch_array($qemail);
                                    $host = $demail['host'];
                                    $username = $demail['username'];
                                    $password = $demail['password'];
                                    $smtpsecure = $demail['smtpsecure'];
                                    $port = $demail['port'];
                                    $from = $demail['emailpengirim'];
                                    $fromname = $demail['fromname'];
                                    ?>
                                    <div class="card-body">
                                        <form class="user" action="email-simpan.php" method="POST">
                                            <div class="form-group">
                                                <label>Host</label>
                                                <input type="text" class="form-control" name="host" value="<?= $host; ?>" placeholder="alamat mail server menggunakan protokol tls/ssl" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" value="<?= $username; ?>" placeholder="username email" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" value="<?= $password; ?>" placeholder="password email" required>
                                            </div>
                                            <div class="form-group">
                                                <label>SMTP Secure</label>
                                                <input type="text" class="form-control" name="smtpsecure" value="<?= $smtpsecure; ?>" placeholder="ssl/tls" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Port</label>
                                                <input type="number" class="form-control" name="port" value="<?= $port; ?>" placeholder="995/587" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Email Pengirim (untuk reply)</label>
                                                <input type="text" class="form-control" name="from" value="<?= $from; ?>" placeholder="email yang dituju untuk membalas" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pengirim</label>
                                                <input type="text" class="form-control" name="fromname" value="<?= $fromname; ?>" placeholder="nama pengirim email" required>
                                            </div>
                                            <br />
                                            <button type="submit" class="btn btn-primary btn-block" onclick="return confirm ('Ubah data Email ?')"> <i class="fas fa-save"></i><b> Simpan Perubahan Data</b></button>
                                            <hr>
                                        </form>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                </div>
            </div>

            <!-- Footer -->
            <?php require('footer.php'); ?>
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
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
</body>

</html>