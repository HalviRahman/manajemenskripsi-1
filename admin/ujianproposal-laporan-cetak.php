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
        <h1>JADWAL SEMINAR PROPOSAL</h1>
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
      <td align="center">Nama</td>
      <td align="center">NIM</td>
      <td align="center">Judul Skripsi</td>
      <td align="center">Pembimbing</td>
      <td align="center">Ketua Penguji</td>
      <td align="center">Anggota</td>
      <td align="center">Tanggal</td>
      <td align="center">Ruang</td>
    </tr>
  </thead>
  <tbody>
    <?php
    //get data penelitian
    $no = 1;
    $stmt = $conn->prepare("SELECT * FROM ujianproposal WHERE status=4 AND month(jadwalujian) = {$bulan}");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($dhasil = $result->fetch_assoc()) {
      $nim = $dhasil['nim'];
      $nama = $dhasil['nama'];
      $judul = $dhasil['judul'];
      $jadwalujian = $dhasil['jadwalujian'];
      $ruang = $dhasil['ruang'];
      $penguji1 = $dhasil['penguji1'];
      $penguji2 = $dhasil['penguji2'];
      $pembimbing = $dhasil['pembimbing'];
      $token = $dhasil['token'];
    ?>
    <tr>
      <td><?= $no; ?></td>
      <td><?= $nama; ?></td>
      <td><?= $nim; ?></td>
      <td><?= $judul; ?></td>
      <td><?= $pembimbing; ?></td>
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
<table table style="width:40%; margin-left:68;margin-right:auto;" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center">No.</td>
      <td align="center">Nama</td>
      <td align="center">Pembimbing Anggota 2</td>
    </tr>
  </thead>
  <tbody>
    <?php
    //get data penelitian
    $no = 1;
    // $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE status=4 AND month(jadwalujian) = {$bulan}");
    $stmt = $conn->prepare("SELECT pembimbing AS pembimbing,count(pembimbing) AS frekuensi_pembimbing from ujianproposal WHERE status=4 AND month(jadwalujian) = {$bulan} group by pembimbing");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($dhasil = $result->fetch_assoc()) {
      $pembimbing = $dhasil['pembimbing'];
      $frekuensi = $dhasil['frekuensi_pembimbing'];
      // $token = $dhasil['token'];
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
<br />
<table table style="width:40%; margin-left:68;margin-right:auto;" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center">No.</td>
      <td align="center">Nama</td>
      <td align="center">Ketua Penguji</td>
    </tr>
  </thead>
  <tbody>
    <?php
    //get data penelitian
    $no = 1;
    // $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE status=4 AND month(jadwalujian) = {$bulan}");
    $stmt = $conn->prepare("SELECT penguji1 AS penguji1,count(penguji1) AS frekuensi_penguji1 from ujianproposal WHERE status=4 AND month(jadwalujian) = {$bulan} group by penguji1");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($dhasil = $result->fetch_assoc()) {
      $pembimbing = $dhasil['penguji1'];
      $frekuensi = $dhasil['frekuensi_penguji1'];
      // $token = $dhasil['token'];
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
<br />
<table table style="width:40%; margin-left:68;margin-right:auto;" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center">No.</td>
      <td align="center">Nama</td>
      <td align="center">Anggota Penguji</td>
    </tr>
  </thead>
  <tbody>
    <?php
    //get data penelitian
    $no = 1;
    // $stmt = $conn->prepare("SELECT * FROM ujiankompre WHERE status=4 AND month(jadwalujian) = {$bulan}");
    $stmt = $conn->prepare("SELECT penguji2 AS penguji2,count(penguji2) AS frekuensi_penguji2 from ujianproposal WHERE status=4 AND month(jadwalujian) = {$bulan} group by penguji2");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($dhasil = $result->fetch_assoc()) {
      $pembimbing = $dhasil['penguji2'];
      $frekuensi = $dhasil['frekuensi_penguji2'];
      // $token = $dhasil['token'];
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