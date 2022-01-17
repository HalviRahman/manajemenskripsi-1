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
<table table style="width:90%; margin-left:50;margin-right:auto;" cellspacing="0" border="0">
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
      <td style="text-align:center">No.</td>
      <td style="text-align:center">Nama</td>
      <td style="text-align:center">NIM</td>
      <td style="text-align:center">Judul Skripsi</td>
      <td style="text-align:center">Pembimbing</td>
      <td style="text-align:center">Ketua Penguji</td>
      <td style="text-align:center">Anggota</td>
      <td style="text-align:center">Tanggal</td>
      <td style="text-align:center">Ruang</td>
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
<br />

<table table style="width:90%; margin-left:auto;margin-right:auto;" cellspacing="0" border="1">
  <thead>
    <tr>
      <td style="text-align:center" colspan="7"><b>Rekap Dosen Penguji & Pembimbing</b></td>
    </tr>
    <tr>
      <td style="text-align:center">No.</td>
      <td style="text-align:center">Ketua Penguji</td>
      <td style="text-align:center">Jumlah</td>
      <td style="text-align:center">Penguji Anggota</td>
      <td style="text-align:center">Jumlah</td>
      <td style="text-align:center">Pembimbing</td>
      <td style="text-align:center">Jumlah</td>
    </tr>
  </thead>
  <tbody>
    <?php
    //get data penelitian
    $no = 1;
    $stmt = $conn->prepare("SELECT penguji1 AS penguji1,count(penguji1) AS frekuensi_penguji1,
                                  penguji2 AS penguji2,count(penguji2) AS frekuensi_penguji2,
                                  pembimbing AS pembimbing,count(pembimbing) AS frekuensi_pembimbing
                            FROM ujianproposal WHERE status=4 AND month(jadwalujian) = {$bulan} group by penguji1");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($dhasil = $result->fetch_assoc()) {
      $penguji1 = $dhasil['penguji1'];
      $frekuensi1 = $dhasil['frekuensi_penguji1'];
      $penguji2 = $dhasil['penguji2'];
      $frekuensi2 = $dhasil['frekuensi_penguji2'];
      $pembimbing = $dhasil['pembimbing'];
      $frekuensi_pembimbing = $dhasil['frekuensi_pembimbing'];
    ?>
      <tr>
        <td><?= $no; ?></td>
        <td><?= $penguji1; ?></td>
        <td style="text-align:center"><?= $frekuensi1; ?></td>
        <td><?= $penguji2; ?></td>
        <td style="text-align:center"><?= $frekuensi2; ?></td>
        <td><?= $pembimbing; ?></td>
        <td style="text-align:center"><?= $frekuensi_pembimbing; ?></td>
      </tr>
    <?php
      $no++;
    }
    ?>
  </tbody>
</table>

<!-- tanda tangan -->
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