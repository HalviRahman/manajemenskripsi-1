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
        <h1>JADWAL UJIAN KOMPREHENSIF</h1>
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
      <td align="center">No.</td>
      <td align="center">Nama Mahasiswa</td>
      <td align="center">NIM</td>
      <td align="center">Bidang Minat</td>
      <td align="center">Penguji I (FISIKA)</td>
      <td align="center">Penguji II (INTEGRASI)</td>
      <td align="center">Tanggal</td>
      <td align="center">Ruang</td>
    </tr>
  </thead>
  <tbody>
    <?php
    //get data penelitian
    $no = 1;
    $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE status=4 AND month(jadwalujian) = {$bulan}");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($dhasil = $result->fetch_assoc()) {
      $nim = $dhasil['nim'];
      $nama = $dhasil['nama'];
      $bidang = $dhasil['bidang'];
      $penguji1 = $dhasil['penguji1'];
      $penguji2 = $dhasil['penguji2'];
      $ruang = $dhasil['ruang'];
      $jadwalujian = $dhasil['jadwalujian'];
      $token = $dhasil['token'];
    ?>
    <tr>
      <td><?= $no; ?></td>
      <td><?= $nama; ?></td>
      <td><?= $nim; ?></td>
      <td><?= $bidang; ?></td>
      <td><?= $penguji1; ?></td>
      <td><?= $penguji2; ?></td>
      <td><?= tgljam_indo($jadwalujian); ?></td>
      <td><?= $ruang; ?></td>
    </tr>
    <?php
      $no++;
    }
    ?>
  </tbody>
</table>
<br>
<table table style="width:90%; margin-left:auto;margin-right:auto;" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center">No.</td>
      <td align="center">Penguji I (FISIKA)</td>
      <td align="center">Penguji II (INTEGRASI)</td>
    </tr>
  </thead>
  <tbody>
    <?php
    //get data penelitian
    $no = 1;
    $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE status=4 AND month(jadwalujian) = {$bulan}");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($dhasil = $result->fetch_assoc()) {
      $penguji1 = $dhasil['penguji1'];
      $penguji2 = $dhasil['penguji2'];
      $token = $dhasil['token'];
    ?>
    <tr>
      <td><?= $no; ?></td>
      <td><?= $penguji1; ?></td>
      <td><?= $penguji2; ?></td>
    </tr>
    <?php
      $no++;
    }
    ?>
  </tbody>
</table>
<br />
<!-- table bawah -->
<table table style="width:90%; margin-left:auto;margin-right:auto;" cellspacing="0" border="1">
  <tbody>
    <tr>
      <td colspan="5"></td>
      <td>TTD</td>
    </tr>
  </tbody>
</table>

</html>