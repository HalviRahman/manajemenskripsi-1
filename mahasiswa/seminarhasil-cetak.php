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
$stmt = $conn->prepare("SELECT * FROM semhas WHERE token='$token'");
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nim = $dhasil['nim'];
$nama = $dhasil['nama'];
$judul = $dhasil['judul'];
$nilai1 = $dhasil['nilai1'];
$nilai2 = $dhasil['nilai2'];
$nilaipembimbing = $dhasil['nilaipembimbing'];
$jadwalujian = $dhasil['jadwalujian'];
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
                <b>SEMINAR HASIL SKRIPSI</b></br />
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
            Berdasarkan hasil keputusan dewan penguji seminar hasil pada Bulan <?= bulan(date('m', strtotime($jadwalujian))); ?> <?= date('Y', strtotime($jadwalujian)); ?>, dengan ini menerangkan bahwa:
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">
            Nama
        </td>
        <td>
            : <?= $nama; ?>
        </td>
    </tr>
    <tr>
        <td>
            NIM
        </td>
        <td>
            : <?= $nim; ?>
        </td>
    </tr>
    <tr>
        <td style="vertical-align:top">
            Judul Proposal
        </td>
        <td>
            : <?= $judul; ?>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <?php
    $total = ($nilai1 + $nilai2 + $nilaipembimbing) / 3;
    if ($total > 59) {
        $kelulusan = 'LULUS';
    } else {
        $kelulusan = 'TIDAK LULUS';
    }
    ?>
    <tr>
        <td colspan="2">
            telah melaksanakan seminar hasil dan dinyatakan <b><?= $kelulusan; ?></b>.
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
<!-- tanda tangan -->
<?php
$stmt = $conn->prepare("SELECT * FROM kaprodi");
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nip = $dhasil['nip'];
$nama = $dhasil['nama'];
$ttd = $dhasil['ttd'];
?>
<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
    <tr>
        <td width="40%"></td>
        <td style="text-align:right">
            <div class="container">
                <div><b>Malang,<?= tgl_indo($jadwalujian); ?></b></div>
                <div class="jabatan"><b>Ketua Jurusan Fisika,</b></div>
                <img src="<?= $ttd; ?>" style="width:250px;">
                <div class="nama">
                    <u><b><?= $nama; ?></b></u><br />
                    <b>NIP.<?= $nip; ?></b>
                </div>
            </div>
        </td>
    </tr>
</table>

</html>