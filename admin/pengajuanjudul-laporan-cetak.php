<html>

<script>
    //window.print();
</script>

<head>
    <script>
        var css = '@page { size: landscape; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);

        window.print();
    </script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<!-- connect to db -->
<?php
require('../config.php');
require('../vendor/myfunc.php');
?>

<?php
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
?>

<table table style="width:90%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
    <tbody>
        <td align="center"><img src="../img/uinlogo.png" width="100px"></td>
        <td colspan="5" align="center">
            KEMENTERIAN AGAMA<br />
            UNIVERSITAS ISLAM NEGERI MAULANA MALIK IBRAHIM MALANG<br />
            FAKULTAS SAINS DAN TEKNOLOGI<br />
            JURUSAN FISIKA<br />
            Gedung B.J. Habibie Lt. 2 Jl. Gajayana No. 50 Malang<br />
            Telp / Faks. (0341)-558933<br />
        </td>
    </tbody>
</table>
<hr>
<!-- header surat -->
<table table style="width:90%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td colspan="6" align="center">
                <h1>REKAP PENGAJUAN JUDUL</h1>
                <h2>Bulan <?= bulan($bulan); ?> Semester <?= semester($tahun, $bulan); ?></h2>
            </td>
        </tr>
    </tbody>
</table>
<br />
<!-- isi surat -->
<table table style="width:90%; margin-left:50;margin-right:auto;" cellspacing="0" border="1">
    <thead>
        <tr>
            <td align="center">No.</td>
            <td align="center">Nama</td>
            <td align="center">NIM</td>
            <td align="center">Judul Skripsi</td>
            <td align="center">Pembimbing</td>
        </tr>
    </thead>
    <tbody>
        <?php
        //get data penelitian
        $no = 1;
        $stmt = $conn->prepare("SELECT * FROM pengajuanjudul WHERE status=1 AND month(tanggal) = {$bulan}");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($dhasil = $result->fetch_assoc()) {
            $nim = $dhasil['nim'];
            $nama = $dhasil['nama'];
            $judul = $dhasil['judul'];
            $pembimbing = $dhasil['pembimbing'];
            $token = $dhasil['token'];
            $tanggal = $dhasil['tanggal'];
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $nama; ?></td>
                <td><?= $nim; ?></td>
                <td><?= $judul; ?></td>
                <td><?= $pembimbing; ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>
<br />
<!-- rekap pembimbing -->
<table table style="width:40%; margin-left:50;margin-right:auto;" cellspacing="0" border="1">
    <thead>
        <tr>
            <td align="center">No.</td>
            <td align="center">Nama Pembimbing</td>
            <td align="center">Jumlah Bimbingan</td>
        </tr>
    </thead>
    <tbody>
        <?php
        //get data penelitian
        $no = 1;
        $stmt = $conn->prepare("SELECT pembimbing AS pembimbing,count(pembimbing) AS frekuensi_pembimbing from pengajuanjudul WHERE status=1  AND month(tanggal) = {$bulan} group by pembimbing");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($dhasil = $result->fetch_assoc()) {
            $pembimbing = $dhasil['pembimbing'];
            $frekuensi = $dhasil['frekuensi_pembimbing'];
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $pembimbing; ?></td>
                <td><?= $frekuensi; ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>
<table table style="width:40%; margin-left:auto;margin-right:55;" cellspacing="0" border="0">
    <tr>
        <td style="text-align:right">
            <div class="container">
                <div>Malang,<?= tgl_indo($tanggal); ?></div>
                <div class="jabatan">Ketua Jurusan Fisika,</div>
                <img src="../img/ttdkaprodi.png" style="width:250px;">
                <div class="nama">
                    <u>Dr. Imam Tazi, M.Si</u><br />
                    NIP.197407302003121002
                </div>
            </div>
        </td>
    </tr>
</table>

</html>