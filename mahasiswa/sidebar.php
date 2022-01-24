<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img src="../img/uinlogo-small.png">
        </div>
        <div class="sidebar-brand-text mx-3">Manajemen SKRIPSI</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fa fa-desktop"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Pendaftaran
    </div>
    <?php
    $stmt = $conn->prepare("SELECT * FROM pengajuanjudul WHERE nim=?");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    $juser = $result->num_rows;
    if ($juser > 0) {
        $dhasil = $result->fetch_assoc();
        $status = $dhasil['status'];
        $verifikasifile = $dhasil['verifikasifile'];
        if ($verifikasifile == 2 or $status == 2) {
    ?>
            <li class="nav-item">
                <a class="nav-link" href="pengajuanjudul-isi.php">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Pengajuan Judul</span>
                </a>
            </li>
        <?php
        }
    } else {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="pengajuanjudul-isi.php">
                <i class="fas fa-fw fa-file"></i>
                <span>Pengajuan Judul</span>
            </a>
        </li>
    <?php
    }
    ?>

    <?php
    $stmt = $conn->prepare("SELECT * FROM pengajuanjudul WHERE nim=? AND status=1");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    $juser = $result->num_rows;
    if ($juser > 0) {
        $stmt2 = $conn->prepare("SELECT * FROM ujianproposal WHERE nim=?");
        $stmt2->bind_param("s", $nim);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $juser2 = $result2->num_rows;
        if ($juser2 == 0) {
    ?>
            <li class="nav-item">
                <a class="nav-link" href="ujianproposal-isi.php">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Ujian Seminar Proposal</span>
                </a>
            </li>
    <?php
        }
    }
    ?>

    <?php
    $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE nim=? AND status=4");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    $juser = $result->num_rows;
    if ($juser > 0) {
        $stmt3 = $conn->prepare("SELECT * FROM ujiankompre WHERE nim=?");
        $stmt3->bind_param("s", $nim);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $juser3 = $result3->num_rows;
        if ($juser3 == 0) {
    ?>
            <li class="nav-item">
                <a class="nav-link" href="ujiankompre-isi.php">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Ujian Komprehensif</span>
                </a>
            </li>
    <?php
        }
    }
    ?>

    <?php
    $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE nim=? AND status=4");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    $juser = $result->num_rows;
    if ($juser > 0) {
        $stmt4 = $conn->prepare("SELECT * FROM semhas WHERE nim=?");
        $stmt4->bind_param("s", $nim);
        $stmt4->execute();
        $result4 = $stmt4->get_result();
        $juser4 = $result4->num_rows;
        if ($juser4 == 0) {
    ?>
            <li class="nav-item">
                <a class="nav-link" href="seminarhasil-isi.php">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Seminar Hasil</span>
                </a>
            </li>
    <?php
        }
    }
    ?>

    <?php
    $stmt = $conn->prepare("SELECT * FROM semhas WHERE nim=? AND status=4");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    $juser = $result->num_rows;
    if ($juser > 0) {
        $stmt5 = $conn->prepare("SELECT * FROM ujianskripsi WHERE nim=?");
        $stmt5->bind_param("s", $nim);
        $stmt5->execute();
        $result5 = $stmt5->get_result();
        $juser5 = $result5->num_rows;
        if ($juser5 == 0) {
    ?>
            <li class="nav-item">
                <a class="nav-link" href="ujianskripsi-isi.php">
                    <i class="fas fa-fw fa-gavel"></i>
                    <span>Ujian Skripsi</span>
                </a>
            </li>
    <?php
        }
    }
    ?>
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="../uploads/Mahasiswa.pdf" target="_blank">
            <i class="fa fa-book"></i>
            <span>Panduan</span></a>
    </li>
</ul>