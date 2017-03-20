-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20 Mar 2017 pada 08.47
-- Versi Server: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carikos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitaskamar`
--

CREATE TABLE IF NOT EXISTS `fasilitaskamar` (
`idFasilitasKamar` int(100) NOT NULL,
  `namaFasilitasKamar` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fasilitaskamar`
--

INSERT INTO `fasilitaskamar` (`idFasilitasKamar`, `namaFasilitasKamar`) VALUES
(1, 'Kasur'),
(2, 'Lemari'),
(3, 'Meja dan Kursi'),
(4, 'Kamar Mandi'),
(5, 'TV'),
(6, 'AC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitaskos`
--

CREATE TABLE IF NOT EXISTS `fasilitaskos` (
`idFasilitasKos` int(100) NOT NULL,
  `namaFasilitasKos` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fasilitaskos`
--

INSERT INTO `fasilitaskos` (`idFasilitasKos`, `namaFasilitasKos`) VALUES
(1, 'Internet/Wi-Fi'),
(2, 'Cucian'),
(3, 'Akses Kunci 24 Jam'),
(4, 'Penjaga Kos');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fotokamar`
--

CREATE TABLE IF NOT EXISTS `fotokamar` (
`idFotoKamar` int(100) NOT NULL,
  `namaFileKamar` varchar(200) NOT NULL,
  `idKamar` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fotokamar`
--

INSERT INTO `fotokamar` (`idFotoKamar`, `namaFileKamar`, `idKamar`) VALUES
(1, '1-1-21.PNG', 1),
(2, '1-1-22.PNG', 1),
(3, '1-2-albi.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fotokos`
--

CREATE TABLE IF NOT EXISTS `fotokos` (
`idFotoKos` int(100) NOT NULL,
  `namaFile` varchar(200) NOT NULL,
  `idKos` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fotokos`
--

INSERT INTO `fotokos` (`idFotoKos`, `namaFile`, `idKos`) VALUES
(1, '1-2.PNG', 1),
(2, '1-4.PNG', 1),
(3, '2-1.PNG', 2),
(4, '3-1.PNG', 3),
(5, '4-1.PNG', 4),
(6, '5-1.jpg', 5),
(7, '6-1.jpg', 6),
(8, '6-1.PNG', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE IF NOT EXISTS `kamar` (
`idKamar` int(100) NOT NULL,
  `jenisKamar` varchar(200) NOT NULL,
  `hargaKamar` varchar(100) NOT NULL,
  `jumlahKamar` int(100) NOT NULL,
  `idKos` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`idKamar`, `jenisKamar`, `hargaKamar`, `jumlahKamar`, `idKos`) VALUES
(1, 'Besar', '1500000', 5, 1),
(2, 'Kecil', '750000', 7, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar_fasilitaskamar`
--

CREATE TABLE IF NOT EXISTS `kamar_fasilitaskamar` (
`idKamarFasilitasKamar` int(100) NOT NULL,
  `idKamar` int(100) NOT NULL,
  `idFasilitasKamar` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar_fasilitaskamar`
--

INSERT INTO `kamar_fasilitaskamar` (`idKamarFasilitasKamar`, `idKamar`, `idFasilitasKamar`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 6),
(6, 2, 1),
(7, 2, 2),
(8, 2, 3),
(9, 2, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kos`
--

CREATE TABLE IF NOT EXISTS `kos` (
`idKos` int(100) NOT NULL,
  `namaKos` varchar(200) NOT NULL,
  `alamatKos` varchar(500) NOT NULL,
  `latLngKos` varchar(200) NOT NULL,
  `teleponKos` varchar(15) NOT NULL,
  `idTipeKos` int(100) NOT NULL,
  `idParkiranKos` int(100) NOT NULL,
  `usernamePemilik` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kos`
--

INSERT INTO `kos` (`idKos`, `namaKos`, `alamatKos`, `latLngKos`, `teleponKos`, `idTipeKos`, `idParkiranKos`, `usernamePemilik`) VALUES
(1, 'Kos Mewah', 'Jalan Bhaskara Utara D10', '(-7.265753999999999, 112.79346099999998)', '4514205', 1, 1, 'luwandino'),
(2, 'Kos Melati', 'Jalan Raya Dharmahusada Indah A30', '(-7.2718601, 112.77134090000004)', '4514204', 2, 4, 'luwandino'),
(3, 'Kos Mawar', 'Jalan Bhaskara Utara D10', '(-7.265753999999999, 112.79346099999998)', '4514204', 2, 2, 'luwandino'),
(4, 'Kos Mawar', 'Jalan Raya Dharmahusada Indah A30', '(-7.2718601, 112.77134090000004)', '4514204', 3, 3, 'luwandino'),
(5, 'Kos Mewah', 'Jalan Balai Pustaka Raya 20, Jakarta', '(-6.196854, 106.88442199999997)', '4895205', 1, 1, 'luwandino'),
(6, 'Kos Baru', 'Teknik Informatika ITS', '(-7.279810399999999, 112.79760920000001)', '60111', 3, 2, 'luwandino');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kos_fasilitaskos`
--

CREATE TABLE IF NOT EXISTS `kos_fasilitaskos` (
`idKosFasilitasKos` int(100) NOT NULL,
  `idKos` int(100) NOT NULL,
  `idFasilitasKos` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kos_fasilitaskos`
--

INSERT INTO `kos_fasilitaskos` (`idKosFasilitasKos`, `idKos`, `idFasilitasKos`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 5),
(5, 2, 1),
(6, 2, 2),
(7, 2, 4),
(8, 3, 1),
(9, 3, 2),
(10, 3, 4),
(11, 4, 1),
(12, 4, 2),
(13, 4, 4),
(14, 5, 1),
(15, 5, 2),
(16, 5, 3),
(17, 5, 6),
(18, 6, 1),
(19, 6, 3),
(20, 6, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kos_tipekos`
--

CREATE TABLE IF NOT EXISTS `kos_tipekos` (
`idKosTipeKos` int(100) NOT NULL,
  `idKos` int(100) NOT NULL,
  `idTipeKos` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kos_tipekos`
--

INSERT INTO `kos_tipekos` (`idKosTipeKos`, `idKos`, `idTipeKos`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 3, 1),
(5, 3, 2),
(6, 4, 1),
(7, 4, 2),
(8, 5, 1),
(9, 6, 1),
(10, 6, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkirankos`
--

CREATE TABLE IF NOT EXISTS `parkirankos` (
`idParkiranKos` int(100) NOT NULL,
  `luasParkiran` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parkirankos`
--

INSERT INTO `parkirankos` (`idParkiranKos`, `luasParkiran`) VALUES
(1, '> 23'),
(2, '15,1 - 23'),
(3, '7,6 - 15'),
(4, '1,6 - 7,5'),
(5, '0 - 1,5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik`
--

CREATE TABLE IF NOT EXISTS `pemilik` (
  `usernamePemilik` varchar(50) NOT NULL,
  `passwordPemilik` varchar(50) NOT NULL,
  `namaPemilik` varchar(100) NOT NULL,
  `emailPemilik` varchar(100) NOT NULL,
  `teleponPemilik` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemilik`
--

INSERT INTO `pemilik` (`usernamePemilik`, `passwordPemilik`, `namaPemilik`, `emailPemilik`, `teleponPemilik`) VALUES
('luwandino', '12345', 'Luwandino Wismar', 'luwandino@hotmail.com', '081288281196');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipekos`
--

CREATE TABLE IF NOT EXISTS `tipekos` (
`idTipeKos` int(100) NOT NULL,
  `tipeKos` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipekos`
--

INSERT INTO `tipekos` (`idTipeKos`, `tipeKos`) VALUES
(1, 'Pria'),
(2, 'Wanita'),
(3, 'Campur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitaskamar`
--
ALTER TABLE `fasilitaskamar`
 ADD PRIMARY KEY (`idFasilitasKamar`);

--
-- Indexes for table `fasilitaskos`
--
ALTER TABLE `fasilitaskos`
 ADD PRIMARY KEY (`idFasilitasKos`);

--
-- Indexes for table `fotokamar`
--
ALTER TABLE `fotokamar`
 ADD PRIMARY KEY (`idFotoKamar`);

--
-- Indexes for table `fotokos`
--
ALTER TABLE `fotokos`
 ADD PRIMARY KEY (`idFotoKos`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
 ADD PRIMARY KEY (`idKamar`);

--
-- Indexes for table `kamar_fasilitaskamar`
--
ALTER TABLE `kamar_fasilitaskamar`
 ADD PRIMARY KEY (`idKamarFasilitasKamar`);

--
-- Indexes for table `kos`
--
ALTER TABLE `kos`
 ADD PRIMARY KEY (`idKos`);

--
-- Indexes for table `kos_fasilitaskos`
--
ALTER TABLE `kos_fasilitaskos`
 ADD PRIMARY KEY (`idKosFasilitasKos`);

--
-- Indexes for table `kos_tipekos`
--
ALTER TABLE `kos_tipekos`
 ADD PRIMARY KEY (`idKosTipeKos`);

--
-- Indexes for table `parkirankos`
--
ALTER TABLE `parkirankos`
 ADD PRIMARY KEY (`idParkiranKos`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
 ADD PRIMARY KEY (`usernamePemilik`);

--
-- Indexes for table `tipekos`
--
ALTER TABLE `tipekos`
 ADD PRIMARY KEY (`idTipeKos`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitaskamar`
--
ALTER TABLE `fasilitaskamar`
MODIFY `idFasilitasKamar` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `fasilitaskos`
--
ALTER TABLE `fasilitaskos`
MODIFY `idFasilitasKos` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fotokamar`
--
ALTER TABLE `fotokamar`
MODIFY `idFotoKamar` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fotokos`
--
ALTER TABLE `fotokos`
MODIFY `idFotoKos` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
MODIFY `idKamar` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kamar_fasilitaskamar`
--
ALTER TABLE `kamar_fasilitaskamar`
MODIFY `idKamarFasilitasKamar` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kos`
--
ALTER TABLE `kos`
MODIFY `idKos` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kos_fasilitaskos`
--
ALTER TABLE `kos_fasilitaskos`
MODIFY `idKosFasilitasKos` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `kos_tipekos`
--
ALTER TABLE `kos_tipekos`
MODIFY `idKosTipeKos` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `parkirankos`
--
ALTER TABLE `parkirankos`
MODIFY `idParkiranKos` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tipekos`
--
ALTER TABLE `tipekos`
MODIFY `idTipeKos` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
