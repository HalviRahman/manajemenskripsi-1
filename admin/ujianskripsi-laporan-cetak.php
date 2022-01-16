<html>

<script>
    //window.print();
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
$token = $_POST['token'];
?>

<?php
//get data penelitian
$no = 1;
$stmt = $conn->prepare("SELECT * FROM ujianskripsi WHERE token='$token'");
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nim = $dhasil['nim'];
$nama = $dhasil['nama'];
$judul = $dhasil['judul'];
$pembimbing = $dhasil['pembimbing'];
$penguji1 = $dhasil['penguji1'];
$penguji2 = $dhasil['penguji2'];
$penguji3 = $dhasil['penguji3'];
$nilai1 = $dhasil['nilai1'];
$nilai2 = $dhasil['nilai2'];
$nilaipembimbing = $dhasil['nilaipembimbing'];
$jadwalujian = $dhasil['jadwalujian'];
$ruang = $dhasil['ruang'];
$status = $dhasil['status'];
?>

<?php
//detail nilai
$totalnilai = 0;
$ratanilai = 0;
$totalpenguji = 0;
$totalpentingnyamasalah = 0;
$totalkeselarasan = 0;
$totalanalisadata = 0;
$totalkajianpustaka = 0;
$totalpaparandata = 0;
$totalalurpembahasan = 0;
$totalkesimpulan = 0;
$totalpenguasaanmateri = 0;
$totalsikap = 0;
$totalpenulisan = 0;
$stmt = $conn->prepare("SELECT * FROM nilaiskripsi WHERE nim=?");
$stmt->bind_param("s", $nim);
$stmt->execute();
$result = $stmt->get_result();
while ($dhasil = $result->fetch_assoc()) {
    $penguji = $dhasil['penguji'];
    $pentingnyamasalah = $dhasil['pentingnyamasalah'];
    $totalpentingnyamasalah = $totalpentingnyamasalah + $pentingnyamasalah;
    $keselarasan = $dhasil['keselarasan'];
    $totalkeselarasan = $totalkeselarasan + $keselarasan;
    $analisadata = $dhasil['analisadata'];
    $totalanalisadata = $totalanalisadata + $analisadata;
    $kajianpustaka = $dhasil['kajianpustaka'];
    $totalkajianpustaka = $totalkajianpustaka + $kajianpustaka;
    $paparandata = $dhasil['paparandata'];
    $totalpaparandata = $totalpaparandata + $paparandata;
    $alurpembahasan = $dhasil['alurpembahasan'];
    $totalalurpembahasan = $totalalurpembahasan + $alurpembahasan;
    $kesimpulan = $dhasil['kesimpulan'];
    $totalkesimpulan = $totalkesimpulan + $kesimpulan;
    $penguasaanmateri = $dhasil['penguasaanmateri'];
    $totalpenguasaanmateri = $totalpenguasaanmateri + $penguasaanmateri;
    $sikap = $dhasil['sikap'];
    $totalsikap = $totalsikap + $sikap;
    $penulisan = $dhasil['penulisan'];
    $totalpenulisan = $totalpenulisan + $penulisan;
    $totalnilai = ($pentingnyamasalah + $keselarasan + $analisadata + $kajianpustaka + $paparandata + $alurpembahasan + $kesimpulan + $penguasaanmateri + $sikap + $penulisan) * 2;
    $ratanilai = ($ratanilai + $totalnilai);
}
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
                <b>BERITA ACARA PELAKSANAAN UJIAN SKRIPSI JURUSAN FISIKA</b><br />
                <b><u>Semester <?= semester($tahun, $bulan); ?></u></b>
            </td>
        </tr>
    </tbody>
</table>
<br />
<!-- isi surat -->
<table table style="width:90%; margin-left:auto;margin-right:auto;" cellspacing="0" border="1">
    <tr>
        <td width="50%" colspan="2"><b>I. IDENTITAS MAHASISWA</b></td>
        <td width="50%" colspan="2"><b>IV. UNSUR YANG DINILAI</b></td>
    </tr>
    <tr>
        <td>a. Nama</td>
        <td>: <?= $nama; ?></td>
        <td><b>1. Isi Skripsi</b></td>
        <td width="15%"><b>Skor</b></td>
    </tr>
    <tr>
        <td>b. NIM</td>
        <td>: <?= $nim; ?></td>
        <td>a. Pentingnya Masalah</td>
        <td>: <?= $totalpentingnyamasalah / 4; ?></td>
    </tr>
    <tr>
        <td>c. Jurusan</td>
        <td>: Fisika</td>
        <td>b. Keselarasan rumusan masalah, tujuan, dan metode penelitian</td>
        <td>: <?= $totalkeselarasan / 4; ?></td>
    </tr>
    <tr>
        <td colspan="2"><b>II. SKRIPSI</b></td>
        <td>c. Ketepatan teknik analisa data</td>
        <td>: <?= $totalanalisadata / 4; ?></td>
    </tr>
    <tr>
        <td colspan="2">a. Judul Skripsi</td>
        <td>d. Relevansi kajian pustaka</td>
        <td>: <?= $totalkajianpustaka / 4; ?></td>
    </tr>
    <tr>
        <td colspan="2" rowspan="3"><?= $judul; ?></td>
        <td>e. Paparan Data</td>
        <td>: <?= $totalpaparandata / 4; ?></td>
    </tr>
    <tr>
        <td>f. Keteraturan alur pembahasan</td>
        <td>: <?= $totalalurpembahasan / 4; ?></td>
    </tr>
    <tr>
        <td>g. Kesesuaian kesimpulan dengan masalah penelitian</td>
        <td>: <?= $totalkesimpulan / 4; ?></td>
    </tr>
    <tr>
        <td colspan="2">b. Dosen Pembimbing</td>
        <td colspan="2"><b>2. Pelaksanaan Ujian</b></td>
    </tr>
    <tr>
        <td>Fisika<br />Integrasi</td>
        <td>: <?= $pembimbing; ?><br />: <?= $penguji3; ?></td>
        <td>a. Penguasaan Materi</td>
        <td>: <?= $totalpenguasaanmateri / 4; ?></td>
    </tr>
    <tr>
        <td colspan="2"><b>III. UJIAN SKRIPSI</b></td>
        <td>b. Sikap</td>
        <td>: <?= $totalsikap / 4; ?></td>
    </tr>
    <tr>
        <td>a. Hari</td>
        <td>: <?= hari(date("N", strtotime($jadwalujian))); ?></td>
        <td colspan="2"><b>3. Penulisan</b></td>
    </tr>
    <tr>
        <td>b. Tanggal Ujian</td>
        <td>: <?= tgl_indo($jadwalujian); ?></td>
        <td>a. Ketepatan teknik penulisan dan tata bahasa</td>
        <td>: <?= $totalpenulisan / 4; ?></td>
    </tr>
    <tr>
        <td>c. Jam</td>
        <td>: <?= date("H:i", strtotime($jadwalujian)); ?> - <?= date("H:i", strtotime($jadwalujian . "+2 hours")); ?></td>
        <td colspan="2"><b>V. NILAI AKHIR</b></td>
    </tr>
    <?php
    $totalskor = ($totalpentingnyamasalah / 4) + ($totalkeselarasan / 4) + ($totalanalisadata / 4) + ($totalkajianpustaka / 4) +
        ($totalpaparandata / 4) + ($totalalurpembahasan / 4) + ($totalkesimpulan / 4) + ($totalpenguasaanmateri / 4) +
        ($totalsikap / 4) + ($totalpenulisan / 4);
    ?>
    <tr>
        <td>d. Ruang</td>
        <td>: <?= $ruang; ?></td>
        <td>Total Skor x 2 = Nilai Akhir</td>
        <td>: <?= $totalskor; ?> x 2 = <?= $totalskor * 2; ?></td>
    </tr>
    <tr>
        <td rowspan="2" style="vertical-align:bottom">e. Ttd. Mahasiswa</td>
        <td rowspan="2" style="vertical-align:bottom">: ..........................................</td>
        <td colspan="2"><b>VI. HASIL SKRIPSI</b></td>
    </tr>
    <?php
    if (($totalskor * 2) > 59) {
        $ket = 'LULUS';
    } else {
        $ket = 'TIDAK LULUS';
    }
    ?>
    <tr>
        <td><b><?= $ket; ?></b></td>
        <td>: <b><?= nilai($totalskor * 2); ?></b></td>
    </tr>
</table>
<br>
<!-- table bawah -->
<p style="text-align: center;"><b>Tim Penguji Skripsi</b></p>
<table table style="width:90%; margin-left:auto;margin-right:auto;" cellspacing="0" border="1">
    <tr>
        <td style="text-align: center;">No.</td>
        <td style="text-align: center;">Jabatan</td>
        <td style="text-align: center;">Nama Penguji</td>
        <td style="text-align: center;">Tanda Tangan</td>
    </tr>
    <tr>
        <td style="height:40">1.</td>
        <td>Penguji Utama / Ketua</td>
        <td><?= $penguji1; ?></td>
        <td></td>
    </tr>
    <tr>
        <td style="height:40">2.</td>
        <td>Penguji 1 / Anggota 1</td>
        <td><?= $penguji2; ?></td>
        <td></td>
    </tr>
    <tr>
        <td style="height:40">3.</td>
        <td>Sekretaris Penguji / Anggota 2</td>
        <td><?= $pembimbing; ?></td>
        <td></td>
    </tr>
    <tr>
        <td style="height:40">4.</td>
        <td>Anggota Penguji / Anggota 3</td>
        <td><?= $penguji3; ?></td>
        <td></td>
    </tr>
</table>

</html>