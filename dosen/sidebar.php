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
        Mahasiswa
    </div>
    <li class="nav-item">
        <a class="nav-link" href="pembimbing-dashboard.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Bimbingan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="penguji-dashboard.php">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Penguji</span>
        </a>
    </li>
    <?php
    if ($_SESSION['jabatan'] == 'kaprodi' || $_SESSION['jabatan'] == 'sekprodi') {
    ?>
        <li class="nav-item">
            <a class="nav-link" href="ujian.php">
                <i class="fa fa-user"></i>
                <span>Data Ujian Mahasiswa</span></a>
        </li>
    <?php
    }
    ?>
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="../uploads/Dosen.pdf" target="_blank">
            <i class="fa fa-book"></i>
            <span>Panduan Dosen</span></a>
    </li>
    <?php
    if ($_SESSION['jabatan'] == 'kaprodi' || $_SESSION['jabatan'] == 'sekprodi') {
    ?>
        <li class="nav-item active">
            <a class="nav-link" href="../uploads/Sekprodi.pdf" target="_blank">
                <i class="fa fa-book"></i>
                <span>Panduan Pimpinan Prodi</span></a>
        </li>
    <?php
    }
    ?>
</ul>