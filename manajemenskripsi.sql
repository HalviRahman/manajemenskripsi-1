-- --------------------------------------------------------
-- Host:                         narayaitsolution.web.id
-- Server version:               10.3.32-MariaDB-cll-lve - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table narayait_manajemenskripsi.bidangminat
CREATE TABLE IF NOT EXISTS `bidangminat` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(50) DEFAULT NULL,
  KEY `no` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.bidangminat: ~5 rows (approximately)
DELETE FROM `bidangminat`;
/*!40000 ALTER TABLE `bidangminat` DISABLE KEYS */;
INSERT INTO `bidangminat` (`no`, `bidang`) VALUES
	(1, 'Biofisika');
INSERT INTO `bidangminat` (`no`, `bidang`) VALUES
	(2, 'Fisika Material');
INSERT INTO `bidangminat` (`no`, `bidang`) VALUES
	(3, 'Elekronika dan Instrumentasi');
INSERT INTO `bidangminat` (`no`, `bidang`) VALUES
	(4, 'GeoFisika');
INSERT INTO `bidangminat` (`no`, `bidang`) VALUES
	(5, 'Fisika Teori');
INSERT INTO `bidangminat` (`no`, `bidang`) VALUES
	(9, 'Meta Fisika');
/*!40000 ALTER TABLE `bidangminat` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.email
CREATE TABLE IF NOT EXISTS `email` (
  `host` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `smtpsecure` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `emailpengirim` varchar(100) DEFAULT NULL,
  `fromname` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table narayait_manajemenskripsi.email: 1 rows
DELETE FROM `email`;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` (`host`, `username`, `password`, `smtpsecure`, `port`, `emailpengirim`, `fromname`) VALUES
	('tls://smtp.gmail.com', 'fis@uin-malang.ac.id', 'jurusanfisika', 'tls', 587, 'fis@uin-malang.ac.id', 'Jurusan FISIKA UIN Malang');
/*!40000 ALTER TABLE `email` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.kaprodi
CREATE TABLE IF NOT EXISTS `kaprodi` (
  `nama` varchar(200) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `ttd` varchar(200) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.kaprodi: ~0 rows (approximately)
DELETE FROM `kaprodi`;
/*!40000 ALTER TABLE `kaprodi` DISABLE KEYS */;
INSERT INTO `kaprodi` (`nama`, `nip`, `ttd`, `token`) VALUES
	('Dr. Imam Tazi, M.Si', '197407302003121002', '../img/ttd/ttdkaprodi.png', '1');
/*!40000 ALTER TABLE `kaprodi` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.nilaiskripsi
CREATE TABLE IF NOT EXISTS `nilaiskripsi` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) DEFAULT NULL,
  `penguji` varchar(200) DEFAULT NULL,
  `pentingnyamasalah` tinyint(4) DEFAULT 0,
  `keselarasan` tinyint(4) DEFAULT 0,
  `analisadata` tinyint(4) DEFAULT 0,
  `kajianpustaka` tinyint(4) DEFAULT 0,
  `paparandata` tinyint(4) DEFAULT 0,
  `alurpembahasan` tinyint(4) DEFAULT 0,
  `kesimpulan` tinyint(4) DEFAULT 0,
  `penguasaanmateri` tinyint(4) DEFAULT 0,
  `sikap` tinyint(4) DEFAULT 0,
  `penulisan` tinyint(4) DEFAULT 0,
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.nilaiskripsi: ~15 rows (approximately)
DELETE FROM `nilaiskripsi`;
/*!40000 ALTER TABLE `nilaiskripsi` DISABLE KEYS */;
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(1, '18640009', 'Rusli, M.Si', 3, 2, 1, 4, 1, 3, 1, 4, 1, 2);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(2, '18640009', 'Dr. Imam Tazi, M.Si', 5, 5, 5, 5, 5, 5, 5, 5, 5, 5);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(4, '18640009', 'Irjan, M.Si', 4, 2, 4, 2, 4, 2, 4, 2, 4, 2);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(5, '18640009', 'Erika Rani, M.Si', 5, 5, 5, 5, 5, 5, 5, 5, 5, 5);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(6, '19640123', 'Erika Rani, M.Si', 5, 4, 3, 2, 1, 5, 4, 3, 2, 1);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(7, '19640123', 'Dr. M. Tirono, M.Si', 1, 2, 3, 4, 5, 1, 2, 3, 4, 5);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(8, '19640123', 'Drs. Abdul Basid, M.Si', 3, 4, 3, 2, 3, 4, 3, 2, 3, 4);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(9, '19640123', 'Dr. Imam Tazi, M.Si', 2, 1, 2, 1, 2, 3, 4, 5, 4, 3);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(10, '15640011', 'dr. Avin Ainur F, M. Biomed', 3, 4, 2, 4, 1, 4, 3, 1, 3, 4);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(11, '15640011', 'Dr. Erna Hastuti, M.Si', 1, 4, 4, 2, 3, 4, 1, 3, 4, 3);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(12, '15640011', 'Ahmad Luthfin, S.Si., M.Si', 3, 1, 5, 2, 2, 5, 3, 3, 1, 5);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(13, '15640011', 'Arista Romadani, M.Sc', 5, 5, 5, 5, 5, 5, 5, 5, 5, 5);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(14, '11112222', 'Ahmad Abtokhi, M.Pd', 4, 3, 4, 5, 5, 5, 5, 4, 3, 4);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(15, '11112222', 'Dr. Imam Tazi, M.Si', 5, 5, 5, 5, 5, 5, 4, 4, 3, 5);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(16, '11112222', 'Ahmad Luthfin, S.Si., M.Si', 5, 5, 5, 3, 3, 4, 3, 3, 3, 5);
INSERT INTO `nilaiskripsi` (`no`, `nim`, `penguji`, `pentingnyamasalah`, `keselarasan`, `analisadata`, `kajianpustaka`, `paparandata`, `alurpembahasan`, `kesimpulan`, `penguasaanmateri`, `sikap`, `penulisan`) VALUES
	(17, '11112222', 'Wiwis Sasmitaninghidayah, M.Si', 4, 5, 5, 5, 5, 5, 5, 3, 2, 3);
/*!40000 ALTER TABLE `nilaiskripsi` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.pengajuanjudul
CREATE TABLE IF NOT EXISTS `pengajuanjudul` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `judul` varchar(1000) DEFAULT NULL,
  `fileproposal` varchar(200) DEFAULT NULL,
  `verifikasifile` tinyint(4) DEFAULT 0,
  `pembimbing` varchar(200) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `keterangan` varchar(500) DEFAULT NULL,
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.pengajuanjudul: ~7 rows (approximately)
DELETE FROM `pengajuanjudul`;
/*!40000 ALTER TABLE `pengajuanjudul` DISABLE KEYS */;
INSERT INTO `pengajuanjudul` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `fileproposal`, `verifikasifile`, `pembimbing`, `token`, `status`, `keterangan`) VALUES
	(3, '2022-01-05 11:05:33', 'markonah', '111222333', 'Biofisika', 'Pengaruh Cahaya LED (Light Emite Dioda) Biru, Merah, dan Putih Terhadap Kadar Klorofil Tanaman Sawi Hijau (Brassica Juncea L)', '../lampiran/111222333-pengajuanjudul.jpg', 1, 'Irjan, M.Si', '42689801c7abf0dc4005b402fb1f1229', 1, NULL);
INSERT INTO `pengajuanjudul` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `fileproposal`, `verifikasifile`, `pembimbing`, `token`, `status`, `keterangan`) VALUES
	(4, '2022-01-06 10:23:37', 'Bunali', '1233333', 'Fisika Material', 'STUDI EFEK GRAVITASI PARTIKEL FERMION DAN BOSON DALAM RUANGWAKTU MELENGKUNG', '../lampiran/1233333-pengajuanjudul.jpg', 1, 'Dr. Imam Tazi, M.Si', '8760b357f7002ae8f2511648afec80b8', 1, NULL);
INSERT INTO `pengajuanjudul` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `fileproposal`, `verifikasifile`, `pembimbing`, `token`, `status`, `keterangan`) VALUES
	(5, '2022-01-09 20:24:08', 'Bunga Bukan Nama Sebenarnya', '123123123', 'Biofisika', 'Pengaruh Paparan Medan Magnet Extremely Low Frequency (ELF) terhadap Pertumbuhan Bakteri Asam Laktat, Sifat Organoleptik, dan pH Susu Kambing', '../lampiran/123123123-pengajuanjudul.jpg', 1, 'Drs. M. Triono, M.Si', '7bdce7b7754bac741d855a64fcaf2dcb', 1, NULL);
INSERT INTO `pengajuanjudul` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `fileproposal`, `verifikasifile`, `pembimbing`, `token`, `status`, `keterangan`) VALUES
	(6, '2022-01-11 14:23:23', 'halvi rahman', '19640001', 'Fisika Material', 'Pengaruh Cahaya LED (Light Emite Dioda) Biru, Merah, dan Putih Terhadap Kadar Klorofil Tanaman Sawi Hijau (Brassica Juncea L)', '../lampiran/19640001-pengajuanjudul.jpg', 1, 'Erika Rani, M.Si', 'b6057ec7fe6a19d8b35e4b04c079d138', 1, NULL);
INSERT INTO `pengajuanjudul` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `fileproposal`, `verifikasifile`, `pembimbing`, `token`, `status`, `keterangan`) VALUES
	(8, '2022-01-14 09:23:01', 'LINDA SARI', '18640009', 'Biofisika', 'PENGARUH LAMA PAPARAN MEDAN MAGNET EXTREMELY LOW FREQUENCY (ELF) TERHADAP PRODUKTIVITAS TANAMAN KEDELAI (Glycine max(L.) Merril)', '../lampiran/18640009-pengajuanjudul.jpg', 1, 'Rusli, M.Si', '7d8abac3e74c30552d3f83f0ac60eb32', 1, NULL);
INSERT INTO `pengajuanjudul` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `fileproposal`, `verifikasifile`, `pembimbing`, `token`, `status`, `keterangan`) VALUES
	(11, '2022-01-17 20:59:11', 'Pairun Saklitunov', '19640123', 'Elekronika dan Instrumentasi', 'RANCANG BANGUN ALAT PENDETEKSI PENCEMARAN UDARA BERBASIS ARDUINO MENGGUNAKAN TEKNOLOGI WIRELESS FIDELITY (Wi-Fi)', '../lampiran/19640123-pengajuanjudul.jpg', 1, 'Drs. Abdul Basid, M.Si', 'b8673686d2d2a47714771cedd3375ef5', 1, NULL);
INSERT INTO `pengajuanjudul` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `fileproposal`, `verifikasifile`, `pembimbing`, `token`, `status`, `keterangan`) VALUES
	(16, '2022-01-20 12:53:09', 'Johan Ericka', '15640011', 'Elekronika dan Instrumentasi', 'Disinfektan otomatis berbasis IoT', '../lampiran/15640011-pengajuanjudul.jpg', 1, 'Ahmad Luthfin, S.Si., M.Si', '5fd6aba61fae235e719aae2d5ee6d586', 1, NULL);
INSERT INTO `pengajuanjudul` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `fileproposal`, `verifikasifile`, `pembimbing`, `token`, `status`, `keterangan`) VALUES
	(17, '2022-01-22 14:13:19', 'User Mahasiswa', '11112222', 'Biofisika', 'Pengaruh Pemaparan Sinar UV-C Terhadap Pertumbuhan Bakteri Listeria Monocytogenes, Ph Dan Organoleptik Pada Sari Buah Apel', '../lampiran/11112222-pengajuanjudul.jpg', 1, 'Dr. Imam Tazi, M.Si', '44cf1fbef44a7d7df224fae7222517d6', 1, NULL);
/*!40000 ALTER TABLE `pengajuanjudul` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `nohp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `userid` varchar(200) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `role` varchar(200) DEFAULT 'mahasiswa',
  `jabatan` varchar(100) DEFAULT 'mahasiswa',
  `token` varchar(50) DEFAULT NULL,
  `ttd` varchar(200) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`nama`),
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.pengguna: ~29 rows (approximately)
DELETE FROM `pengguna`;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(8, 'Ahmad Abtokhi, M.Pd', '197610032003121004', '085111222333', 'narayaitsolution@gmail.com', '197610032003121004', 'e71cd91742abaf0390ab963c363ef0c4', 'dosen', 'dosen', 'a2cc08c1fa0a10c1e77abfe54a68eee7', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(38, 'Ahmad Luthfin, S.Si., M.Si', '198605042019031009', '0812352524246', 'narayaitsolution@gmail.com', '198605042019031009', '0516458c072e27887a5c33c70076a269', 'dosen', 'dosen', 'f35fbd686266062aad159ca9824b767f', '../img/ttd/198605042019031009-ttd.png', 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(37, 'Arista Romadani, M.Sc', '199009052019031018', '082134768562', 'narayaitsolution@gmail.com', '199009052019031018', '3a4fa074a57e520b5ea03b9f71dd54b0', 'dosen', 'dosen', '99c2639a3deb2de1542cd680e49dab54', '../img/ttd/199009052019031018-ttd.png', 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(6, 'Bunali', '1233333', '081123213', 'narayaitsolution@gmail.com', 'bunali', '5239751bbf6e532cc27e1a47c4d123e2', 'mahasiswa', 'mahasiswa', 'fee2602558b17239118e0ad5994197c6', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(50, 'Dosen Fisika', '09090911', '0829988112233', 'dosenuin@gmail.com', 'dosenfisika', 'e10adc3949ba59abbe56e057f20f883e', 'mahasiswa', 'mahasiswa', '6a64ee5d959bcd9ed59b70706ccfd502', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(14, 'dr. Avin Ainur F, M. Biomed', '198002032009122002', '08123273532', 'narayaitsolution@gmail.com', '198002032009122002', '2cb7ff112f8fb5fd5be42fd70893304b', 'dosen', 'dosen', 'd860a02cb046f6f5d9bb6e2a9352c957', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(13, 'Dr. Erna Hastuti, M.Si', '198111192008012009', '082830239840', 'narayaitsolution@gmail.com', '198111192008012009', '9adc47daa2977111371fb76fcbbed7fe', 'dosen', 'dosen', '26b59bb99c917eea452a8e1a579b7b0e', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(11, 'Dr. H. Agus Mulyono, M.Kes', '197508081999031003', '08123123457', 'narayaitsolution@gmail.com', '197508081999031003', '15508f0dfe22ef6773e76b6e85339139', 'dosen', 'dosen', 'e3412c1b082cb6be5c565ca88a86060a', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(3, 'Dr. Imam Tazi, M.Si', '197407302003121002', '081212323144', 'narayaitsolution@gmail.com', '197407302003121002', '3a86b585946b95b176de6c165037942c', 'dosen', 'kaprodi', '9d0ea13738a7613dc92feaa8aeff0431', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(10, 'Dr. M. Tirono, M.Si', '196412111991111001', '0812123134', 'narayaitsolution@gmail.com', '196412111991111001', '62b0658c89a9bff28e3ade8180647e98', 'dosen', 'dosen', '73cb384bbf4c56708bf85297b232adab', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(7, 'Drs. Abdul Basid, M.Si', '196505041990031003', '0812321321', 'narayaitsolution@gmail.com', '196505041990031003', 'cd0449a8fc6747faec2df63b1dca0ca6', 'dosen', 'dosen', 'd1fb5bf2089cb6d70c370193735ff0ff', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(43, 'Drs. Cecep Rustana, B.Sc(Hons), Ph.D', '195907291986021001', '08298359238951', 'narayaitsolution@gmail.com', '195907291986021001', '995ac10d893ce844a008a942a5ce9136', 'dosen', 'dosen', '212fc1fc2add461e9fdfdd4920ae3696', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(9, 'Erika Rani, M.Si', '198106132006042002', '08123123123', 'narayaitsolution@gmail.com', '198106132006042002', 'baef99d331ae19b549c687f4db751d4b', 'dosen', 'dosen', '4c8be409f93196e54e48bb357702750f', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(12, 'Farid Samsu Hananto, M.T', '197405132003121001', '0856346346', 'narayaitsolution@gmail.com', '197405132003121001', '15ad49c0b4487b552033900550f41e03', 'dosen', 'dosen', 'c0598c13dfaedad6865d7d18f9097a9f', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(44, 'Fikriyatul Azizah Su’ud, M.Si', '199306172020122003', '08292375923235', 'narayaitsolution@gmail.com', '199306172020122003', '7bed6703d45eeaecd9378b7fe782dc5e', 'dosen', 'dosen', 'c775f30cd2945377f6ece8fb66ff52fa', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(4, 'Irjan, M.Si', '196912312006041003', '1231231', 'narayaitsolution@gmail.com', '196912312006041003', '9505d95a4d366ac558340345eeac6465', 'dosen', 'sekprodi', '82f2f481d0e953b132c771cfc627c1cf', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(47, 'Johan Ericka', '15640011', '08123456454', 'johan@uin-malang.ac.id', 'johanericka', 'ac43724f16e9241d990427ab7c8f4228', 'mahasiswa', 'mahasiswa', '0199d50b6d1bd0a56dc2b4ff8930f7e0', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(36, 'Khusnul Yakin, M.Si', '199101032019031009', '082917343251', 'narayaitsolution@gmail.com', '199101032019031009', '6dd02a229a9a8d731d43d39d0e57b65b', 'dosen', 'dosen', 'c343eff7ce256f906b1e9da132c5ec9e', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(33, 'LINDA SARI', '18640009', '081232323', 'narayaitsolution@gmail.com', 'lindasari', '54dafb6eb725970c060d3bccdfe1108f', 'mahasiswa', 'mahasiswa', '2ac72aba1883e2383c7b2498a9c9c993', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(5, 'markonah', '111222333', '081232131', 'narayaitsolution@gmail.com', 'markonah', '21431d4c1129efb8f79162d4a61a75c6', 'mahasiswa', 'mahasiswa', '2624d613207f273dda5ea1c24a2c0171', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(35, 'Muthmainnah, M.Si', '198603252019032009', '082339848927', 'narayaitsolution@gmail.com', '198603252019032009', '9bec9b230608f61b52f5763ea3e2904c', 'dosen', 'dosen', 'eb371d7e750ba12021218a173a2b3858', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(39, 'Naqiibatin Nadliriyah, S.Si. M.Si', '199202212019032020', '0824654756751', 'narayaitsolution@gmail.com', '199202212019032020', '22c1049b7190b8006b9ac1366cc80172', 'dosen', 'dosen', 'fa7c411cd53f723aab443d0a71003da8', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(1, 'Ninik', '123123', '081231999233', 'narayaitsolution@gmail.com', 'adminprodi', '23d477dba23c4c1aca817817a3f410fe', 'admin', 'admin', 'bcfdf4f515e6c7eaba8c34b49b507da52', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(32, 'Pairun Saklitunov', '19640123', '081234321', 'pairunsaklitunov@gmail.com', 'pairun', '4cb1855ed62962b8aad97d2e1b7b5af1', 'mahasiswa', 'mahasiswa', '714721ddc51b1d14a0c0618c693be3a9', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(41, 'Rusli, M.Si', '198807152020121003', '08298236592355', 'narayaitsolution@gmail.com', '198807152020121003', 'd3ec92f15ab18c1e29f4143d13f4ed55', 'dosen', 'dosen', '7df6a4fa1e7b0df6341e748191741c6b', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(15, 'Umaiyatus Syarifah, M.A.', '198209252009012005', '081956756723', 'narayaitsolution@gmail.com', '198209252009012005', '62555f582077f6256c70c5dc97cda9fb', 'dosen', 'dosen', '46e2c8c752406b965a3579c3da43cbe2', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(51, 'User', '19882291', '082991828211', 'user@yahoo.com', 'User2', 'ee11cbb19052e40b07aac0ca060c23ee', 'mahasiswa', 'mahasiswa', '8ac7d79412fc83665233fa6e61b38bed', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(52, 'User 3', '199191311', '082912781133', 'user3@gmail.com', 'User3', '6ad14ba9986e3615423dfca256d04e3f', 'mahasiswa', 'mahasiswa', '9969ac8ab0fee638e2c931e9d162650f', NULL, 0);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(49, 'User Mahasiswa', '11112222', '081222333999', 'usermahasiswa@gmail.com', 'usermahasiswa', 'e10adc3949ba59abbe56e057f20f883e', 'mahasiswa', 'mahasiswa', '10a27397afe52d4dc611d08a93fa97f4', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(42, 'Utiya Hikmah, M.Si', '19880605201802012242', '0813578935298', 'narayaitsolution@gmail.com', '19880605201802012242', 'eecc2330b332ad56754e93db35c7e217', 'dosen', 'dosen', '19d3aecf17d8fa1cdbd73d6fb4b9044a', NULL, 1);
INSERT INTO `pengguna` (`no`, `nama`, `nim`, `nohp`, `email`, `userid`, `pass`, `role`, `jabatan`, `token`, `ttd`, `aktif`) VALUES
	(40, 'Wiwis Sasmitaninghidayah, M.Si', '19870215201802012233', '081234235348786', 'narayaitsolution@gmail.com', '19870215201802012233', '44de06e8583b2ed3e9b93f89e0b34f3f', 'dosen', 'dosen', 'ead9c44a8aa650d230d3b585eecfb4e2', NULL, 1);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.ruangan
CREATE TABLE IF NOT EXISTS `ruangan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `namaruangan` varchar(100) DEFAULT NULL,
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.ruangan: ~4 rows (approximately)
DELETE FROM `ruangan`;
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
INSERT INTO `ruangan` (`no`, `namaruangan`) VALUES
	(1, 'Ruang Sidang');
INSERT INTO `ruangan` (`no`, `namaruangan`) VALUES
	(2, 'Ruang Geofisika');
INSERT INTO `ruangan` (`no`, `namaruangan`) VALUES
	(3, 'Ruang Kuliah / Diskusi');
INSERT INTO `ruangan` (`no`, `namaruangan`) VALUES
	(4, 'Zoom');
/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.semhas
CREATE TABLE IF NOT EXISTS `semhas` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `judul` varchar(1000) DEFAULT NULL,
  `sklproposal` varchar(200) DEFAULT NULL,
  `sklkompre` varchar(200) DEFAULT NULL,
  `kartukendali` varchar(200) DEFAULT NULL,
  `lembarpersetujuan` varchar(200) DEFAULT NULL,
  `proposal` varchar(200) DEFAULT NULL,
  `verifikasifile` tinyint(4) DEFAULT 0,
  `pembimbing` varchar(200) DEFAULT NULL,
  `penguji1` varchar(200) DEFAULT NULL,
  `penguji2` varchar(200) DEFAULT NULL,
  `nilai1` tinyint(4) DEFAULT 0,
  `nilai2` tinyint(4) DEFAULT 0,
  `nilaipembimbing` tinyint(4) DEFAULT 0,
  `revisi1` text DEFAULT NULL,
  `revisi2` text DEFAULT NULL,
  `revisipembimbing` text DEFAULT NULL,
  `jadwalujian` datetime DEFAULT NULL,
  `ruang` varchar(100) DEFAULT NULL,
  `linkzoom` varchar(500) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `keterangan` varchar(1000) DEFAULT NULL,
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.semhas: ~5 rows (approximately)
DELETE FROM `semhas`;
/*!40000 ALTER TABLE `semhas` DISABLE KEYS */;
INSERT INTO `semhas` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `sklproposal`, `sklkompre`, `kartukendali`, `lembarpersetujuan`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(8, '2022-01-08 10:47:21', 'Bunali', '1233333', 'Fisika Material', 'STUDI EFEK GRAVITASI PARTIKEL FERMION DAN BOSON DALAM RUANGWAKTU MELENGKUNG', '../lampiran/1233333-sklproposal.jpg', '../lampiran/1233333-sklkompre.jpg', NULL, NULL, '../lampiran/1233333-laporansemhas.pdf', 1, 'Dr. Imam Tazi, M.Si', 'Ahmad Abtokhi, M.Pd', 'Erika Rani, M.Si', 80, 90, 80, 'tambahkan referensi pendukung maks 5 tahun terakhir', 'tambahkan hadits / ayat Al-Qur\'an yang berhubungan dengan penelitian anda', '', '2022-01-10 11:00:00', 'Ruang Geofisika', '', '485273e017d22aaa30a085051904875e', 4, NULL);
INSERT INTO `semhas` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `sklproposal`, `sklkompre`, `kartukendali`, `lembarpersetujuan`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(9, '2022-01-10 19:49:31', 'Bunga Bukan Nama Sebenarnya', '123123123', 'Biofisika', 'Pengaruh Paparan Medan Magnet Extremely Low Frequency (ELF) terhadap Pertumbuhan Bakteri Asam Laktat, Sifat Organoleptik, dan pH Susu Kambing', '../lampiran/123123123-sklproposal.jpg', '../lampiran/123123123-sklkompre.jpg', NULL, NULL, '../lampiran/123123123-laporansemhas.pdf', 1, 'Drs. M. Triono, M.Si', 'Dr. H. Agus Mulyono, M.Kes', 'Drs. Abdul Basid, M.Si', 80, 90, 0, 'perbaiki struktur penulisan. ikuti aturan yang telah ditetapkan prodi', 'tambahkan referensi terkait hadist / ayat Al-Qur\'an yang mendukung penelitian anda ', NULL, '2022-01-11 09:00:00', 'Ruang Kuliah / Diskusi', '', 'dcb6c4b5e312187cd51b851f60254775', 4, NULL);
INSERT INTO `semhas` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `sklproposal`, `sklkompre`, `kartukendali`, `lembarpersetujuan`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(10, '2022-01-11 15:12:54', 'halvi rahman', '19640001', 'Fisika Material', 'Pengaruh Cahaya LED (Light Emite Dioda) Biru, Merah, dan Putih Terhadap Kadar Klorofil Tanaman Sawi Hijau (Brassica Juncea L)', '../lampiran/19640001-sklproposal.jpg', '../lampiran/19640001-sklkompre.jpg', NULL, NULL, '../lampiran/19640001-laporansemhas.pdf', 1, 'Erika Rani, M.Si', 'Drs. M. Triono, M.Si', 'Erna Hastuti, M.Si', 80, 100, 0, '', '', NULL, '2022-01-18 09:00:00', 'Ruang Geofisika', '', 'e2eed5800983f5e5eafe95225c2c3104', 4, NULL);
INSERT INTO `semhas` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `sklproposal`, `sklkompre`, `kartukendali`, `lembarpersetujuan`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(12, '2022-01-15 09:22:46', 'LINDA SARI', '18640009', 'Biofisika', 'PENGARUH LAMA PAPARAN MEDAN MAGNET EXTREMELY LOW FREQUENCY (ELF) TERHADAP PRODUKTIVITAS TANAMAN KEDELAI (Glycine max(L.) Merril)', '../lampiran/18640009-sklproposal.pdf', '../lampiran/18640009-sklkompre.pdf', '../lampiran/18640009-kartukendali.jpg', '../lampiran/18640009-lembarpersetujuan.jpg', '../lampiran/18640009-laporansemhas.pdf', 1, 'Rusli, M.Si', 'Dr. Imam Tazi, M.Si', 'Irjan, M.Si', 80, 60, 100, 'tambahkan referensi ilmiah minimal 10 referensi dengan terbitan maksimal 5 tahun terakhir', 'data yang disajikan belum di olah (masih data mentah).\r\nsilahkan di olah terlebih dahulu dan sajikan dalam bentuk grafik untuk memudahkan pembacaan data', 'sip', '2022-01-18 10:00:00', 'Ruang Sidang', '', 'd665452ae532c4347cc649471d8eba03', 4, NULL);
INSERT INTO `semhas` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `sklproposal`, `sklkompre`, `kartukendali`, `lembarpersetujuan`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(13, '2022-01-19 10:33:35', 'Pairun Saklitunov', '19640123', 'Elekronika dan Instrumentasi', 'RANCANG BANGUN ALAT PENDETEKSI PENCEMARAN UDARA BERBASIS ARDUINO MENGGUNAKAN TEKNOLOGI WIRELESS FIDELITY (Wi-Fi)', '../lampiran/19640123-sklproposal.pdf', '../lampiran/19640123-sklkompre.pdf', '../lampiran/19640123-kartukendali.jpg', '../lampiran/19640123-lembarpersetujuan.jpg', '../lampiran/19640123-laporansemhas.pdf', 1, 'Drs. Abdul Basid, M.Si', 'Erika Rani, M.Si', 'Dr. M. Tirono, M.Si', 90, 100, 100, 'sesuaikan dengan format laporan skripsi yang berlaku', 'lanjutkan', '', '2022-01-20 10:45:00', 'Ruang Sidang', '', '12441cd3986400663f424643c04a2de2', 4, NULL);
INSERT INTO `semhas` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `sklproposal`, `sklkompre`, `kartukendali`, `lembarpersetujuan`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(15, '2022-01-20 13:23:53', 'Johan Ericka', '15640011', 'Elekronika dan Instrumentasi', 'Disinfektan otomatis berbasis IoT', '../lampiran/15640011-sklproposal.pdf', '../lampiran/15640011-sklkompre.pdf', '../lampiran/15640011-kartukendali.jpg', '../lampiran/15640011-lembarpersetujuan.jpg', '../lampiran/15640011-laporansemhas.pdf', 1, 'Ahmad Luthfin, S.Si., M.Si', 'dr. Avin Ainur F, M. Biomed', 'Dr. Erna Hastuti, M.Si', 75, 80, 90, 'perbaiki landasan teori', '', '', '2022-01-21 10:00:00', 'Ruang Sidang', '', 'bc5ae767da773316c9d7d5c70285ea49', 4, NULL);
INSERT INTO `semhas` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `sklproposal`, `sklkompre`, `kartukendali`, `lembarpersetujuan`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(16, '2022-01-23 10:14:10', 'User Mahasiswa', '11112222', 'Biofisika', 'Pengaruh Pemaparan Sinar UV-C Terhadap Pertumbuhan Bakteri Listeria Monocytogenes, Ph Dan Organoleptik Pada Sari Buah Apel', '../lampiran/11112222-sklproposal.pdf', '../lampiran/11112222-sklkompre.pdf', '../lampiran/11112222-kartukendali.jpg', '../lampiran/11112222-lembarpersetujuan.jpg', '../lampiran/11112222-laporansemhas.pdf', 1, 'Dr. Imam Tazi, M.Si', 'Ahmad Abtokhi, M.Pd', 'Ahmad Luthfin, S.Si., M.Si', 80, 80, 78, 'lanjutkan', 'lanjutkan', 'lanjutkan', '2022-02-05 10:30:00', 'Ruang Sidang', '', 'd9079f5ce13e15c5909beb4efd834f97', 4, NULL);
/*!40000 ALTER TABLE `semhas` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.ujiankompre
CREATE TABLE IF NOT EXISTS `ujiankompre` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `judul` varchar(1000) DEFAULT NULL,
  `judulskripsi` varchar(200) DEFAULT NULL,
  `sklsempro` varchar(200) DEFAULT NULL,
  `fileproposal` varchar(200) DEFAULT NULL,
  `verifikasifile` tinyint(4) DEFAULT 0,
  `pembimbing` varchar(200) DEFAULT NULL,
  `penguji1` varchar(200) DEFAULT NULL,
  `penguji2` varchar(200) DEFAULT NULL,
  `nilai1` tinyint(4) DEFAULT 0,
  `nilai2` tinyint(4) DEFAULT 0,
  `revisi1` text DEFAULT NULL,
  `revisi2` text DEFAULT NULL,
  `jadwalujian` datetime DEFAULT NULL,
  `ruang` varchar(100) DEFAULT NULL,
  `linkzoom` varchar(500) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `keterangan` varchar(500) DEFAULT NULL,
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.ujiankompre: ~6 rows (approximately)
DELETE FROM `ujiankompre`;
/*!40000 ALTER TABLE `ujiankompre` DISABLE KEYS */;
INSERT INTO `ujiankompre` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `judulskripsi`, `sklsempro`, `fileproposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `revisi1`, `revisi2`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(5, '2022-01-06 11:44:17', 'Bunali', '1233333', 'Fisika Material', 'STUDI EFEK GRAVITASI PARTIKEL FERMION DAN BOSON DALAM RUANGWAKTU MELENGKUNG', NULL, NULL, '../lampiran/1233333-proposal.pdf', 1, 'Dr. Imam Tazi, M.Si', 'Irjan, M.Si', 'Drs. Abdul Basid, M.Si', 80, 90, 'perkuat kembali tentang pemahaman konsep fisika dasar', '', '2022-01-10 15:00:00', 'Ruang Kuliah / Diskusi', '', '1c32d0072cb594fbf59fb72cd76fdf48', 4, NULL);
INSERT INTO `ujiankompre` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `judulskripsi`, `sklsempro`, `fileproposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `revisi1`, `revisi2`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(6, '2022-01-10 06:15:06', 'Bunga Bukan Nama Sebenarnya', '123123123', 'Biofisika', 'Pengaruh Paparan Medan Magnet Extremely Low Frequency (ELF) terhadap Pertumbuhan Bakteri Asam Laktat, Sifat Organoleptik, dan pH Susu Kambing', '../lampiran/123123123-judulskripsi.jpg', '../lampiran/123123123-transkrip.jpg', '../lampiran/123123123-proposal.pdf', 2, 'Drs. M. Triono, M.Si', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 'e7baae95b0a72a27d4925f338bed9d00', 0, 'file lampiran tidak lengkap');
INSERT INTO `ujiankompre` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `judulskripsi`, `sklsempro`, `fileproposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `revisi1`, `revisi2`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(7, '2022-01-10 06:26:06', 'Bunga Bukan Nama Sebenarnya', '123123123', 'Biofisika', 'Pengaruh Paparan Medan Magnet Extremely Low Frequency (ELF) terhadap Pertumbuhan Bakteri Asam Laktat, Sifat Organoleptik, dan pH Susu Kambing', '../lampiran/123123123-judulskripsi.jpg', '../lampiran/123123123-transkrip.jpg', '../lampiran/123123123-proposal.pdf', 1, 'Drs. M. Triono, M.Si', 'Dr. H. Agus Mulyono, M.Kes', 'Ahmad Abtokhi, M.Pd', 80, 80, 'pelajari kembali konsep fisika dasar', 'perbaiki tajwid bacaan ayat\r\nperbaiki hafalan', '2022-01-11 08:00:00', 'Ruang Sidang', '', 'b7b95ad56f0a75df5b436b911c6ff9bc', 4, NULL);
INSERT INTO `ujiankompre` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `judulskripsi`, `sklsempro`, `fileproposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `revisi1`, `revisi2`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(8, '2022-01-11 15:00:37', 'halvi rahman', '19640001', 'Fisika Material', 'Pengaruh Cahaya LED (Light Emite Dioda) Biru, Merah, dan Putih Terhadap Kadar Klorofil Tanaman Sawi Hijau (Brassica Juncea L)', '../lampiran/19640001-judulskripsi.jpg', '../lampiran/19640001-transkrip.jpg', '../lampiran/19640001-proposal.pdf', 1, 'Erika Rani, M.Si', 'Dr. Imam Tazi, M.Si', 'Ahmad Abtokhi, M.Pd', 0, 0, NULL, NULL, '2022-01-18 08:01:00', 'Zoom', 'https%3A%2F%2Fvmeet.uin-malang.ac.id', 'bdb497d6e2b44e60cf79b8e6787701e0', 3, NULL);
INSERT INTO `ujiankompre` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `judulskripsi`, `sklsempro`, `fileproposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `revisi1`, `revisi2`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(11, '2022-01-14 20:31:44', 'LINDA SARI', '18640009', 'Biofisika', 'PENGARUH LAMA PAPARAN MEDAN MAGNET EXTREMELY LOW FREQUENCY (ELF) TERHADAP PRODUKTIVITAS TANAMAN KEDELAI (Glycine max(L.) Merril)', NULL, '../lampiran/18640009-sklsempro.pdf', '../lampiran/18640009-proposal.pdf', 1, 'Rusli, M.Si', 'Dr. Imam Tazi, M.Si', 'Erika Rani, M.Si', 80, 70, 'pelajari kembali konspe dasar fisika teori', 'perkuat hafalan', '2022-01-17 09:00:00', 'Ruang Kuliah / Diskusi', '', '2f4c5dd13de1a37ca99977f0131078b1', 4, NULL);
INSERT INTO `ujiankompre` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `judulskripsi`, `sklsempro`, `fileproposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `revisi1`, `revisi2`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(13, '2022-01-19 09:56:39', 'Pairun Saklitunov', '19640123', 'Elekronika dan Instrumentasi', 'RANCANG BANGUN ALAT PENDETEKSI PENCEMARAN UDARA BERBASIS ARDUINO MENGGUNAKAN TEKNOLOGI WIRELESS FIDELITY (Wi-Fi)', NULL, '../lampiran/19640123-sklsempro.pdf', '../lampiran/19640123-proposal.pdf', 1, 'Drs. Abdul Basid, M.Si', 'Erika Rani, M.Si', 'Dr. Imam Tazi, M.Si', 80, 80, 'pelajari kembali tentang konsep fisika dasar', 'perbaiki hafalan', '2022-01-20 12:30:00', 'Ruang Geofisika', '', '01fcd30740a7e73119bcc6ffaf5dc2cf', 4, NULL);
INSERT INTO `ujiankompre` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `judulskripsi`, `sklsempro`, `fileproposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `revisi1`, `revisi2`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(15, '2022-01-20 13:13:42', 'Johan Ericka', '15640011', 'Elekronika dan Instrumentasi', 'Disinfektan otomatis berbasis IoT', NULL, '../lampiran/15640011-sklsempro.pdf', '../lampiran/15640011-proposal.pdf', 1, 'Ahmad Luthfin, S.Si., M.Si', 'dr. Avin Ainur F, M. Biomed', 'Arista Romadani, M.Sc', 80, 90, 'pelajari kembali konsep dasar fisika', 'perbaiki hafalan', '2022-01-21 08:00:00', 'Ruang Sidang', '', '62d93c0ae839eb59dee91ebed5b074a5', 4, NULL);
INSERT INTO `ujiankompre` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `judulskripsi`, `sklsempro`, `fileproposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `revisi1`, `revisi2`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(16, '2022-01-23 00:22:02', 'User Mahasiswa', '11112222', 'Biofisika', 'Pengaruh Pemaparan Sinar UV-C Terhadap Pertumbuhan Bakteri Listeria Monocytogenes, Ph Dan Organoleptik Pada Sari Buah Apel', NULL, '../lampiran/11112222-sklsempro.pdf', '../lampiran/11112222-proposal.pdf', 1, 'Dr. Imam Tazi, M.Si', 'Utiya Hikmah, M.Si', 'Wiwis Sasmitaninghidayah, M.Si', 85, 75, 'lanjutkan', 'pelajari kembali konsep dasar fisika', '2022-02-02 09:00:00', 'Ruang Geofisika', '', '6628c00d609ba88a2a17427db2a513e7', 4, NULL);
/*!40000 ALTER TABLE `ujiankompre` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.ujianproposal
CREATE TABLE IF NOT EXISTS `ujianproposal` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `judul` varchar(1000) DEFAULT NULL,
  `persetujuanpembimbing` varchar(200) DEFAULT NULL,
  `khs` varchar(200) DEFAULT NULL,
  `proposal` varchar(200) DEFAULT NULL,
  `verifikasifile` tinyint(4) DEFAULT 0,
  `pembimbing` varchar(200) DEFAULT NULL,
  `penguji1` varchar(200) DEFAULT NULL,
  `penguji2` varchar(200) DEFAULT NULL,
  `nilai1` char(10) DEFAULT NULL,
  `nilai2` char(10) DEFAULT NULL,
  `nilaipembimbing` char(10) DEFAULT NULL,
  `revisi1` text DEFAULT NULL,
  `revisi2` text DEFAULT NULL,
  `revisipembimbing` text DEFAULT NULL,
  `jadwalujian` datetime DEFAULT NULL,
  `ruang` varchar(100) DEFAULT NULL,
  `linkzoom` varchar(500) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `keterangan` varchar(1000) DEFAULT NULL,
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.ujianproposal: ~6 rows (approximately)
DELETE FROM `ujianproposal`;
/*!40000 ALTER TABLE `ujianproposal` DISABLE KEYS */;
INSERT INTO `ujianproposal` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `persetujuanpembimbing`, `khs`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(4, '2022-01-05 13:07:56', 'markonah', '111222333', 'Biofisika', 'Pengaruh Cahaya LED (Light Emite Dioda) Biru, Merah, dan Putih Terhadap Kadar Klorofil Tanaman Sawi Hijau (Brassica Juncea L)', '../lampiran/111222333-persetujuanpembimbing.jpg', '../lampiran/111222333-khs.jpg', '../lampiran/111222333-proposal.pdf', 1, 'Irjan, M.Si', NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '2264ae930a09fc185d4fea54fda7faad', 2, 'topik penelitian diluar keilmuan prodi');
INSERT INTO `ujianproposal` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `persetujuanpembimbing`, `khs`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(7, '2022-01-06 10:35:51', 'Bunali', '1233333', 'Fisika Material', 'STUDI EFEK GRAVITASI PARTIKEL FERMION DAN BOSON DALAM RUANGWAKTU MELENGKUNG', '../lampiran/1233333-persetujuanpembimbing.jpg', '../lampiran/1233333-khs.jpg', '../lampiran/1233333-proposal.pdf', 1, 'Dr. Imam Tazi, M.Si', 'Irjan, M.Si', 'Drs. Abdul Basid, M.Si', '85', '75', '0', 'perbaiki pada bagian latar belakang masalah harus jelas, metode penelitian yang digunakna harus dijelaskan, latar belakang masalah harus memuat tentang penelitian terkait dan rencana pelaksanaan penelitian pada bab 3 harus jelas', '1. perbaiki pada latar belakan masalah\r\n2. landasan teori harus berisi tentang penelitian sebelumnya\r\n3. referensi maksimal 5 tahun terakhir\r\n4. tidak boleh referensi dari blog / website / wikipedia', NULL, '2022-01-10 10:00:00', 'Ruang Geofisika', '', '727e1fd52771428560501d5508d66922', 4, NULL);
INSERT INTO `ujianproposal` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `persetujuanpembimbing`, `khs`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(9, '2022-01-09 20:38:28', 'Bunga Bukan Nama Sebenarnya', '123123123', 'Biofisika', 'Pengaruh Paparan Medan Magnet Extremely Low Frequency (ELF) terhadap Pertumbuhan Bakteri Asam Laktat, Sifat Organoleptik, dan pH Susu Kambing', '../lampiran/123123123-persetujuanpembimbing.jpg', '../lampiran/123123123-khs.jpg', '../lampiran/123123123-proposal.pdf', 1, 'Drs. M. Triono, M.Si', 'Dr. H. Agus Mulyono, M.Kes', 'Drs. Abdul Basid, M.Si', NULL, NULL, '0', NULL, NULL, NULL, '2022-01-10 09:00:00', 'Ruang Geofisika', '', 'b5433c374d4a6871498f45872ef21f7f', 3, NULL);
INSERT INTO `ujianproposal` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `persetujuanpembimbing`, `khs`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(10, '2022-02-11 14:41:21', 'halvi rahman', '19640001', 'Fisika Material', 'Pengaruh Cahaya LED (Light Emite Dioda) Biru, Merah, dan Putih Terhadap Kadar Klorofil Tanaman Sawi Hijau (Brassica Juncea L)', '../lampiran/19640001-persetujuanpembimbing.jpg', '../lampiran/19640001-khs.jpg', '../lampiran/19640001-proposal.pdf', 1, 'Erika Rani, M.Si', 'Drs. M. Triono, M.Si', 'Erna Hastuti, M.Si', NULL, NULL, 'DITERIMA', 'tambahkan referensi maksimal 5 tahun terakhir', 'silahkan dilanjutkan', NULL, '2022-01-11 08:00:00', 'Ruang Kuliah / Diskusi', '', '5d2462269a6fc8de69ffdb8f3ed99848', 4, NULL);
INSERT INTO `ujianproposal` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `persetujuanpembimbing`, `khs`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(13, '2022-01-14 13:20:38', 'LINDA SARI', '18640009', 'Biofisika', 'PENGARUH LAMA PAPARAN MEDAN MAGNET EXTREMELY LOW FREQUENCY (ELF) TERHADAP PRODUKTIVITAS TANAMAN KEDELAI (Glycine max(L.) Merril)', '../lampiran/18640009-persetujuanpembimbing.jpg', '../lampiran/18640009-khs.pdf', '../lampiran/18640009-proposal.pdf', 1, 'Rusli, M.Si', 'Dr. Imam Tazi, M.Si', 'Irjan, M.Si', 'DITERIMA', 'DITERIMA', 'DITERIMA', 'latar belakang masalah, rumusan masalah dan solusi harus selaras', 'bab 2 harus berisi tentang penelitian serupa yang telah dilakukan', 'lanjutkan', '2022-01-18 13:00:00', 'Ruang Sidang', '', 'a7c52e7a500b5d621afba4123093adca', 4, NULL);
INSERT INTO `ujianproposal` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `persetujuanpembimbing`, `khs`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(15, '2022-01-19 08:17:00', 'Pairun Saklitunov', '19640123', 'Elekronika dan Instrumentasi', 'RANCANG BANGUN ALAT PENDETEKSI PENCEMARAN UDARA BERBASIS ARDUINO MENGGUNAKAN TEKNOLOGI WIRELESS FIDELITY (Wi-Fi)', '../lampiran/19640123-persetujuanpembimbing.jpg', '../lampiran/19640123-khs.pdf', '../lampiran/19640123-proposal.pdf', 1, 'Drs. Abdul Basid, M.Si', 'Erika Rani, M.Si', 'Dr. M. Tirono, M.Si', 'DITERIMA', 'DITERIMA', 'DITERIMA', 'latar belakang penelitian, rumusan masalah dan solusi harus selaras', 'integrasi islam harus terlihat sejak bab 1, minimal hubungkan dengan 1 ayat / hadist', 'lanjutkan', '2022-01-19 10:00:00', 'Ruang Kuliah / Diskusi', '', 'b73e32a4b8bd3942d47b9fb1673fe2b0', 4, NULL);
INSERT INTO `ujianproposal` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `persetujuanpembimbing`, `khs`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(17, '2022-01-20 12:57:27', 'Johan Ericka', '15640011', 'Elekronika dan Instrumentasi', 'Disinfektan otomatis berbasis IoT', '../lampiran/15640011-persetujuanpembimbing.jpg', '../lampiran/15640011-khs.pdf', '../lampiran/15640011-proposal.pdf', 1, 'Ahmad Luthfin, S.Si., M.Si', 'dr. Avin Ainur F, M. Biomed', 'Dr. Erna Hastuti, M.Si', NULL, 'DITERIMA', 'DITOLAK', 'lanjutkan', 'ok', '', '2022-01-20 15:00:00', 'Zoom', 'https%3A%2F%2Fus02web.zoom.us%2Fj%2F83105879814%3Fpwd%3DVTJORkhiUnp1dDhaNlBGRm1BZFpYUT09', '7e44e3cf1bf5285e32b9485dd61351a7', 4, NULL);
INSERT INTO `ujianproposal` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `persetujuanpembimbing`, `khs`, `proposal`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `nilai1`, `nilai2`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(18, '2022-01-22 16:06:18', 'User Mahasiswa', '11112222', 'Biofisika', 'Pengaruh Pemaparan Sinar UV-C Terhadap Pertumbuhan Bakteri Listeria Monocytogenes, Ph Dan Organoleptik Pada Sari Buah Apel', '../lampiran/11112222-persetujuanpembimbing.jpg', '../lampiran/11112222-khs.pdf', '../lampiran/11112222-proposal.pdf', 1, 'Dr. Imam Tazi, M.Si', 'Ahmad Abtokhi, M.Pd', 'Ahmad Luthfin, S.Si., M.Si', 'DITERIMA', 'DITERIMA', 'DITERIMA', '-', '---', '----', '2022-01-31 10:00:00', 'Ruang Kuliah / Diskusi', '', 'b570f78e1af3d0ed7c4c4a5c2c1a2b2b', 4, NULL);
/*!40000 ALTER TABLE `ujianproposal` ENABLE KEYS */;

-- Dumping structure for table narayait_manajemenskripsi.ujianskripsi
CREATE TABLE IF NOT EXISTS `ujianskripsi` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `bidang` varchar(100) DEFAULT NULL,
  `judul` varchar(1000) DEFAULT NULL,
  `forma` varchar(200) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `sklsemhas` varchar(200) DEFAULT NULL,
  `buktibayar` varchar(200) DEFAULT NULL,
  `khs` varchar(200) DEFAULT NULL,
  `transkripnilai` varchar(200) DEFAULT NULL,
  `ijazah` varchar(200) DEFAULT NULL,
  `toefl` varchar(200) DEFAULT NULL,
  `toafl` varchar(200) DEFAULT NULL,
  `alumni` varchar(200) DEFAULT NULL,
  `skripsi` varchar(200) DEFAULT NULL,
  `turnitin` varchar(200) DEFAULT NULL,
  `verifikasifile` tinyint(4) DEFAULT 0,
  `pembimbing` varchar(200) DEFAULT NULL,
  `penguji1` varchar(200) DEFAULT NULL,
  `penguji2` varchar(200) DEFAULT NULL,
  `penguji3` varchar(200) DEFAULT NULL,
  `nilai1` tinyint(4) DEFAULT 0,
  `nilai2` tinyint(4) DEFAULT 0,
  `nilai3` tinyint(4) DEFAULT 0,
  `nilaipembimbing` tinyint(4) DEFAULT 0,
  `revisi1` text DEFAULT NULL,
  `revisi2` text DEFAULT NULL,
  `revisi3` text DEFAULT NULL,
  `revisipembimbing` text DEFAULT NULL,
  `jadwalujian` datetime DEFAULT NULL,
  `ruang` varchar(100) DEFAULT NULL,
  `linkzoom` varchar(500) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `keterangan` varchar(1000) DEFAULT NULL,
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table narayait_manajemenskripsi.ujianskripsi: ~6 rows (approximately)
DELETE FROM `ujianskripsi`;
/*!40000 ALTER TABLE `ujianskripsi` DISABLE KEYS */;
INSERT INTO `ujianskripsi` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `forma`, `foto`, `sklsemhas`, `buktibayar`, `khs`, `transkripnilai`, `ijazah`, `toefl`, `toafl`, `alumni`, `skripsi`, `turnitin`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `penguji3`, `nilai1`, `nilai2`, `nilai3`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisi3`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(9, '2022-01-08 14:58:50', 'Bunali', '1233333', 'Fisika Material', 'STUDI EFEK GRAVITASI PARTIKEL FERMION DAN BOSON DALAM RUANGWAKTU MELENGKUNG', '../lampiran/1233333-forma.pdf', '../lampiran/1233333-foto.jpg', '../lampiran/1233333-sklsemhas.jpg', NULL, NULL, '../lampiran/1233333-transkripnilai.pdf', NULL, '../lampiran/1233333-toefl.jpg', '../lampiran/1233333-toafl.jpg', '../lampiran/1233333-alumni.pdf', '../lampiran/1233333-skripsi.pdf', NULL, 1, 'Dr. Imam Tazi, M.Si', 'Irjan, M.Si', 'Drs. Abdul Basid, M.Si', NULL, 80, 90, 0, 0, 'perbaiki penulisan pada bab 4', 'urutkan referensi berdasarkan tahun\r\nubah style sitasi menggunakan APA', NULL, NULL, '2022-01-11 08:00:00', 'Ruang Kuliah / Diskusi', '', '7fb630511187317005f418d0c9d34621', 4, NULL);
INSERT INTO `ujianskripsi` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `forma`, `foto`, `sklsemhas`, `buktibayar`, `khs`, `transkripnilai`, `ijazah`, `toefl`, `toafl`, `alumni`, `skripsi`, `turnitin`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `penguji3`, `nilai1`, `nilai2`, `nilai3`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisi3`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(10, '2022-01-10 20:26:51', 'Bunga Bukan Nama Sebenarnya', '123123123', 'Biofisika', 'Pengaruh Paparan Medan Magnet Extremely Low Frequency (ELF) terhadap Pertumbuhan Bakteri Asam Laktat, Sifat Organoleptik, dan pH Susu Kambing', '../lampiran/123123123-forma.pdf', '../lampiran/123123123-foto.jpg', '../lampiran/123123123-sklsemhas.jpg', NULL, NULL, '../lampiran/123123123-transkripnilai.pdf', NULL, '../lampiran/123123123-toefl.jpg', '../lampiran/123123123-toafl.jpg', '../lampiran/123123123-alumni.pdf', '../lampiran/123123123-skripsi.pdf', NULL, 1, 'Drs. M. Triono, M.Si', 'Dr. H. Agus Mulyono, M.Kes', 'Drs. Abdul Basid, M.Si', NULL, 0, 0, 0, 0, '', NULL, NULL, NULL, '2022-01-12 09:29:00', 'Zoom', 'https%3A%2F%2Fvmeet.uin-malang.ac.id', '2edfe00a3d0de53bbbca37381cb015ed', 3, NULL);
INSERT INTO `ujianskripsi` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `forma`, `foto`, `sklsemhas`, `buktibayar`, `khs`, `transkripnilai`, `ijazah`, `toefl`, `toafl`, `alumni`, `skripsi`, `turnitin`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `penguji3`, `nilai1`, `nilai2`, `nilai3`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisi3`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(11, '2022-01-11 15:26:43', 'halvi rahman', '19640001', 'Fisika Material', 'Pengaruh Cahaya LED (Light Emite Dioda) Biru, Merah, dan Putih Terhadap Kadar Klorofil Tanaman Sawi Hijau (Brassica Juncea L)', '../lampiran/19640001-forma.pdf', '../lampiran/19640001-foto.jpg', '../lampiran/19640001-sklsemhas.jpg', NULL, NULL, '../lampiran/19640001-transkripnilai.pdf', NULL, '../lampiran/19640001-toefl.jpg', '../lampiran/19640001-toafl.jpg', '../lampiran/19640001-alumni.pdf', '../lampiran/19640001-skripsi.pdf', NULL, 1, 'Erika Rani, M.Si', 'Drs. M. Triono, M.Si', 'Erna Hastuti, M.Si', NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-01-20 09:00:00', 'Zoom', 'https%3A%2F%2Fsaintek.uin-malang.ac.id', '37fe707680064be614425b6d7b14259b', 3, NULL);
INSERT INTO `ujianskripsi` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `forma`, `foto`, `sklsemhas`, `buktibayar`, `khs`, `transkripnilai`, `ijazah`, `toefl`, `toafl`, `alumni`, `skripsi`, `turnitin`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `penguji3`, `nilai1`, `nilai2`, `nilai3`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisi3`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(13, '2022-01-15 12:23:19', 'LINDA SARI', '18640009', 'Biofisika', 'PENGARUH LAMA PAPARAN MEDAN MAGNET EXTREMELY LOW FREQUENCY (ELF) TERHADAP PRODUKTIVITAS TANAMAN KEDELAI (Glycine max(L.) Merril)', '../lampiran/18640009-forma.pdf', '../lampiran/18640009-foto.jpg', '../lampiran/18640009-sklsemhas.pdf', '../lampiran/18640009-buktibayar.jpg', '../lampiran/18640009-khs.jpg', '../lampiran/18640009-transkripnilai.pdf', '../lampiran/18640009-ijazah.pdf', '../lampiran/18640009-toefl.jpg', '../lampiran/18640009-toafl.jpg', '../lampiran/18640009-alumni.pdf', '../lampiran/18640009-skripsi.pdf', '../lampiran/18640009-turnitin.pdf', 1, 'Rusli, M.Si', 'Dr. Imam Tazi, M.Si', 'Irjan, M.Si', 'Erika Rani, M.Si', 100, 60, 100, 44, 'lanjutkan', 'perbaiki latar belakang pastikan selaras dengan masalah yang akan dipecahkan', 'tidak ada revisi', 'lanjutkan', '2022-01-18 13:30:00', 'Ruang Kuliah / Diskusi', '', '0f4b7cd6c85206a5f58c52c1b63a00f4', 4, NULL);
INSERT INTO `ujianskripsi` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `forma`, `foto`, `sklsemhas`, `buktibayar`, `khs`, `transkripnilai`, `ijazah`, `toefl`, `toafl`, `alumni`, `skripsi`, `turnitin`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `penguji3`, `nilai1`, `nilai2`, `nilai3`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisi3`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(14, '2022-01-19 18:46:45', 'Pairun Saklitunov', '19640123', 'Elekronika dan Instrumentasi', 'RANCANG BANGUN ALAT PENDETEKSI PENCEMARAN UDARA BERBASIS ARDUINO MENGGUNAKAN TEKNOLOGI WIRELESS FIDELITY (Wi-Fi)', '../lampiran/19640123-forma.pdf', '../lampiran/19640123-foto.jpg', '../lampiran/19640123-sklsemhas.pdf', '../lampiran/19640123-buktibayar.jpg', '../lampiran/19640123-khs.jpg', '../lampiran/19640123-transkripnilai.pdf', '../lampiran/19640123-ijazah.pdf', '../lampiran/19640123-toefl.jpg', '../lampiran/19640123-toafl.jpg', '../lampiran/19640123-alumni.pdf', '../lampiran/19640123-skripsi.pdf', '../lampiran/19640123-turnitin.pdf', 1, 'Drs. Abdul Basid, M.Si', 'Erika Rani, M.Si', 'Dr. M. Tirono, M.Si', 'Dr. Imam Tazi, M.Si', 60, 60, 54, 62, 'lanjutgan', 'ok silahkan di lajut', 'bungkus', 'sip', '2022-01-20 10:10:00', 'Ruang Kuliah / Diskusi', '', '2b2b731f6e580d6afdda94204b81c927', 4, NULL);
INSERT INTO `ujianskripsi` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `forma`, `foto`, `sklsemhas`, `buktibayar`, `khs`, `transkripnilai`, `ijazah`, `toefl`, `toafl`, `alumni`, `skripsi`, `turnitin`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `penguji3`, `nilai1`, `nilai2`, `nilai3`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisi3`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(16, '2022-01-20 13:39:42', 'Johan Ericka', '15640011', 'Elekronika dan Instrumentasi', 'Disinfektan otomatis berbasis IoT', '../lampiran/15640011-forma.pdf', '../lampiran/15640011-foto.jpg', '../lampiran/15640011-sklsemhas.pdf', '../lampiran/15640011-buktibayar.jpg', '../lampiran/15640011-khs.jpg', '../lampiran/15640011-transkripnilai.pdf', '../lampiran/15640011-ijazah.pdf', '../lampiran/15640011-toefl.jpg', '../lampiran/15640011-toafl.jpg', '../lampiran/15640011-alumni.pdf', '../lampiran/15640011-skripsi.pdf', '../lampiran/15640011-turnitin.pdf', 1, 'Ahmad Luthfin, S.Si., M.Si', 'dr. Avin Ainur F, M. Biomed', 'Dr. Erna Hastuti, M.Si', 'Arista Romadani, M.Sc', 0, 58, 100, 60, '', '', '', '', '2022-01-21 16:30:00', 'Ruang Sidang', '', '405e4063d3982ce8126b1182c1513d56', 4, NULL);
INSERT INTO `ujianskripsi` (`no`, `tanggal`, `nama`, `nim`, `bidang`, `judul`, `forma`, `foto`, `sklsemhas`, `buktibayar`, `khs`, `transkripnilai`, `ijazah`, `toefl`, `toafl`, `alumni`, `skripsi`, `turnitin`, `verifikasifile`, `pembimbing`, `penguji1`, `penguji2`, `penguji3`, `nilai1`, `nilai2`, `nilai3`, `nilaipembimbing`, `revisi1`, `revisi2`, `revisi3`, `revisipembimbing`, `jadwalujian`, `ruang`, `linkzoom`, `token`, `status`, `keterangan`) VALUES
	(17, '2022-01-23 15:19:40', 'User Mahasiswa', '11112222', 'Biofisika', 'Pengaruh Pemaparan Sinar UV-C Terhadap Pertumbuhan Bakteri Listeria Monocytogenes, Ph Dan Organoleptik Pada Sari Buah Apel', '../lampiran/11112222-forma.pdf', '../lampiran/11112222-foto.jpg', '../lampiran/11112222-sklsemhas.pdf', '../lampiran/11112222-buktibayar.jpg', '../lampiran/11112222-khs.jpg', '../lampiran/11112222-transkripnilai.pdf', '../lampiran/11112222-ijazah.pdf', '../lampiran/11112222-toefl.jpg', '../lampiran/11112222-toafl.jpg', '../lampiran/11112222-alumni.pdf', '../lampiran/11112222-skripsi.pdf', '../lampiran/11112222-turnitin.pdf', 1, 'Dr. Imam Tazi, M.Si', 'Ahmad Abtokhi, M.Pd', 'Ahmad Luthfin, S.Si., M.Si', 'Wiwis Sasmitaninghidayah, M.Si', 84, 78, 84, 92, 'Mantab', 'Mantab', 'MANTAB!', 'Mantab!', '2022-02-10 09:30:00', 'Ruang Sidang', '', '40ae40af09eba5899b9742a55ffc8d3d', 4, NULL);
/*!40000 ALTER TABLE `ujianskripsi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
