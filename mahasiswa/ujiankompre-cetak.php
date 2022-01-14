<html>

<script>
    window.print();
</script>

<head>
    <link rel="stylesheet" media="print" href="../css/print.css" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<!-- connect to db -->
<?php
require('../config.php');
require('../vendor/myfunc.php');
$tahun = date('Y');
$bulan = date('m');
$token = $_GET['token'];
?>

<?php
//get data penelitian
$no = 1;
$stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE token='$token'");
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nim = $dhasil['nim'];
$nama = $dhasil['nama'];
$jadwalujian = $dhasil['jadwalujian'];
$nilai1 = $dhasil['nilai1'];
$nilai2 = $dhasil['nilai2'];
$status = $dhasil['status'];
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
                <b>SURAT KETERANGAN LULUS</b><br />
                <b>UJIAN KOMPREHENSIF</b></br />
                <b><u>Semester <?= semester($tahun, $bulan); ?></u></b>
            </td>
        </tr>
    </tbody>
</table>
<br />
<!-- isi surat -->
<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
    <tr>
        <td colspan="2">
            Berdasarkan hasil keputusan dewan penguji seminar Komprehensif pada Bulan <?= bulan(date('m', strtotime($jadwalujian))); ?> <?= date('Y', strtotime($jadwalujian)); ?>, dengan ini menerangkan bahwa :
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="30%">Nama</td>
        <td>: <?= $nama; ?></td>
    </tr>
    <tr>
        <td>NIM</td>
        <td>: <?= $nim; ?></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">Nilai</td>
    </tr>
    <tr>
        <td>Bidang Fisika</td>
        <td>: <?= nilai($nilai1); ?></td>
    </tr>
    <tr>
        <td>Bidang Keagamaan</td>
        <td>: <?= nilai($nilai2); ?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <?php
    $total = ($nilai1 + $nilai2) / 2;
    if ($total > 59) {
        $kelulusan = 'LULUS';
    } else {
        $kelulusan = 'TIDAK LULUS';
    }
    ?>
    <tr>
        <td colspan="2">
            telah melaksanakan seminar proposal skripsi dan dinyatakan <b><?= $kelulusan; ?></b>.
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">
            Demikian surat keterangan ini dibuat agar dapat digunakan sebagaimana mestinya.
        </td>
    </tr>
</table>
<br>
<!-- table bawah -->
<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
    <tr>
        <td width="40%"></td>
        <td style="text-align:right">
            <div class="container">
                <div>Malang,<?= tgl_indo($jadwalujian); ?></div>
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