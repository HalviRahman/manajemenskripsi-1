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
                <h1>REKAP NILAI UJIAN SEMINAR HASIL</h1>
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
            <th class="text-center">Nilai Ujian Komprehensif</th>
            <th class="text-center">Nilai Seminar Hasil</th>
            <th class="text-center">Nilai Ujian Skripsi</th>
            <th class="text-center">Nilai Akhir</th>
            <th class="text-center">Grade</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //get data penelitian
        $no = 1;
        $stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE status=4");
        $stmt->execute();
        $result = $stmt->get_result();
        $jhasil = $result->num_rows;
        while ($dhasil = $result->fetch_assoc()) {
            $jadwalujian = $dhasil['jadwalujian'];
            $nim = $dhasil['nim'];
            $nama = $dhasil['nama'];
            $pembimbing = $dhasil['pembimbing'];
            $nilai1 = $dhasil['nilai1'];
            $nilai2 = $dhasil['nilai2'];
            $nilaipembimbing = $dhasil['nilaipembimbing'];
            $nilai3 = $dhasil['nilai3'];
            $nilaiskripsi = (($nilai1 + $nilai2 + $nilai3 + $nilaipembimbing) / 4);

            //ambil nilai semhas
            $stmt2 = $conn->prepare("SELECT * FROM semhas WHERE nim='$nim'");
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $dhasil = $result2->fetch_assoc();
            $nilaisemhas1 = $dhasil['nilai1'];
            $nilaisemhas2 = $dhasil['nilai2'];
            $nilaisemhaspembimbing = $dhasil['nilaipembimbing'];
            $nilaisemhas = (($nilaisemhas1 + $nilaisemhas2 + $nilaisemhaspembimbing) / 3);

            //ambil nilai kompre
            $stmt3 = $conn->prepare("SELECT * FROM ujiankompre WHERE nim='$nim'");
            $stmt3->execute();
            $result3 = $stmt3->get_result();
            $dhasil = $result3->fetch_assoc();
            $nilaikompre1 = $dhasil['nilai1'];
            $nilaikompre2 = $dhasil['nilai2'];
            $nilaikompre = (($nilaikompre1 + $nilaikompre2) / 2);

            //nilai akhir
            $nilaiakhir = ($nilaikompre * 0.1) + ($nilaisemhas * 0.2) + ($nilaikompre * 0.7);

        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= tgl_indo($jadwalujian); ?></td>
                <td><?= $nama; ?></td>
                <td><?= $nim; ?></td>
                <td align="center" width="12%"><?= number_format($nilaikompre, 2) + 0; ?></td>
                <td align="center" width="12%"><?= number_format($nilaisemhas, 2) + 0; ?></td>
                <td align="center" width="12%"><?= number_format($nilaiskripsi, 2) + 0; ?></td>
                <td align="center" width="10%"><?= number_format($nilaiakhir, 2) + 0; ?></td>
                <td align="center" width="5%"><?= nilai($nilaiakhir); ?></td>
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