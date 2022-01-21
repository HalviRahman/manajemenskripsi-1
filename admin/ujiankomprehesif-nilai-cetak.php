<html>

<head>
    <script>
        var css = '@page { size: landscape; margin:0 }',
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
                <h1>REKAP NILAI UJIAN KOMPREHENSIF</h1>
                <h2>Bulan <?= bulan($bulan); ?> Semester <?= semester($tahun, $bulan); ?></h2>
            </td>
        </tr>
    </tbody>
</table>
<br />
<!-- isi surat -->
<table table style="width:90%; margin-left:auto;margin-right:auto;" cellspacing="0" border="1">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Jadwal Ujian</th>
            <th class="text-center">Nama</th>
            <th class="text-center">NIM</th>
            <th class="text-center">Nilai Penguji FISIKA</th>
            <th class="text-center">Nilai Penguji INTEGRASI</th>
            <th class="text-center">Rata - Rata Nilai Penguji</th>
            <th class="text-center">Grade</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //get data penelitian
        $no = 1;
        $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE status=4 ORDER BY jadwalujian");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($dhasil = $result->fetch_assoc()) {
            $nim = $dhasil['nim'];
            $nama = $dhasil['nama'];
            $bidang = $dhasil['bidang'];
            $jadwalujian = $dhasil['jadwalujian'];
            $ruang = $dhasil['ruang'];
            $nilai1 = $dhasil['nilai1'];
            $nilai2 = $dhasil['nilai2'];
            $token = $dhasil['token'];
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td width="15%"><?= tgl_indo($jadwalujian); ?></td>
                <td><?= $nama; ?></td>
                <td><?= $nim; ?></td>
                <td align="center" width="12%"><?= $nilai1; ?></td>
                <td align="center" width="12%"><?= $nilai2; ?></td>
                <td align="center" width="12%"><?= number_format(($nilai1 + $nilai2) / 2, 2) + 0; ?></td>
                <td width="5%"><?= nilai(($nilai1 + $nilai2) / 2); ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>
<br />

<!-- tanda tangan -->
<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
    <tr>
        <td width="40%"></td>
        <td style="text-align:right">
            <div class="container">
                <div>Malang,<?= tgl_indo($jadwalujian); ?></div>
                <div class="jabatan">Ketua Jurusan Fisika,</div>
                <img src="../img/ttd/ttdkaprodi.png" style="width:250px;">
                <div class="nama">
                    <u>Dr. Imam Tazi, M.Si</u><br />
                    NIP.197407302003121002
                </div>
            </div>
        </td>
    </tr>
</table>

</html>