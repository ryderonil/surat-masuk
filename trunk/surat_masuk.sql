-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2012 at 04:34 
-- Server version: 5.0.45
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `surat_masuk`
--

-- --------------------------------------------------------

--
-- Table structure for table `dinas`
--

CREATE TABLE IF NOT EXISTS `dinas` (
  `DINAS_ID` int(11) NOT NULL auto_increment,
  `NAMA_DINAS` varchar(255) collate latin1_general_ci default NULL,
  `SINGKATAN` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_DINAS` smallint(6) default NULL,
  PRIMARY KEY  (`DINAS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dinas`
--

INSERT INTO `dinas` (`DINAS_ID`, `NAMA_DINAS`, `SINGKATAN`, `STATUS_DINAS`) VALUES
(1, 'Bagian Tata Pemerintahan', 'Batapem', 1),
(2, 'KELOMPOK SEKRETARIAT DAERAH', 'Kel. Sekda', 1);

-- --------------------------------------------------------

--
-- Table structure for table `disposisi_surat_masuk`
--

CREATE TABLE IF NOT EXISTS `disposisi_surat_masuk` (
  `DISPOSISI_ID` int(11) NOT NULL auto_increment,
  `SURAT_MASUK_ID` int(11) NOT NULL,
  `DINAS_ID` int(11) NOT NULL,
  `CATATAN_DISPOSISI` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`DISPOSISI_ID`),
  KEY `SURAT_MASUK_ID` (`SURAT_MASUK_ID`),
  KEY `DINAS_ID` (`DINAS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `disposisi_surat_masuk`
--


-- --------------------------------------------------------

--
-- Table structure for table `file_surat_masuk`
--

CREATE TABLE IF NOT EXISTS `file_surat_masuk` (
  `FILE_SURAT_MASUK_ID` int(11) NOT NULL auto_increment,
  `SURAT_MASUK_ID` int(11) NOT NULL,
  `NAMA_FILE` varchar(255) collate latin1_general_ci NOT NULL,
  `PATH_FILE` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`FILE_SURAT_MASUK_ID`),
  KEY `SURAT_MASUK_ID` (`SURAT_MASUK_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `file_surat_masuk`
--

INSERT INTO `file_surat_masuk` (`FILE_SURAT_MASUK_ID`, `SURAT_MASUK_ID`, `NAMA_FILE`, `PATH_FILE`) VALUES
(1, 2, 'alamat_email_job1.txt', 'uploads/surat/alamat_email_job1.txt'),
(2, 3, 'pertanyaan_ke_apotek.docx', 'uploads/surat/pertanyaan_ke_apotek.docx'),
(3, 3, 'alur_surat_masuk.docx', 'uploads/surat/alur_surat_masuk.docx'),
(4, 3, 'proposal_mas_agung.docx', 'uploads/surat/proposal_mas_agung.docx'),
(5, 3, 'proposal_versi_2.1_(_anggi_)_.docx', 'uploads/surat/proposal_versi_2.1_(_anggi_)_.docx'),
(6, 3, 'Enclosure.docx', 'uploads/surat/Enclosure.docx'),
(7, 4, '217.pdf', 'uploads/surat/217.pdf'),
(8, 6, 'notulensi.txt', 'uploads/surat/notulensi.txt');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE IF NOT EXISTS `instansi` (
  `INSTANSI_ID` int(11) NOT NULL auto_increment,
  `NAMA_INSTANSI` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_INSTANSI` smallint(6) default NULL,
  PRIMARY KEY  (`INSTANSI_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`INSTANSI_ID`, `NAMA_INSTANSI`, `STATUS_INSTANSI`) VALUES
(1, 'Kapolda Jatim 2', 1),
(2, 'Gubernur Jawa Barat', 1),
(3, 'Dinas perhutanan', 1),
(4, 'Kapolda kutub utara', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `JABATAN_ID` int(11) NOT NULL auto_increment,
  `NAMA_JABATAN` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_JABATAN` smallint(6) default NULL,
  PRIMARY KEY  (`JABATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`JABATAN_ID`, `NAMA_JABATAN`, `STATUS_JABATAN`) VALUES
(1, 'sekretaris', 1),
(2, 'Dinas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE IF NOT EXISTS `jenis_surat` (
  `JENIS_SURAT_ID` int(11) NOT NULL auto_increment,
  `NAMA_JENIS_SURAT` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_JENIS_SURAT` smallint(6) default NULL,
  PRIMARY KEY  (`JENIS_SURAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`JENIS_SURAT_ID`, `NAMA_JENIS_SURAT`, `STATUS_JENIS_SURAT`) VALUES
(1, 'Surat Dinas', 1),
(2, 'Surat Nota', 1),
(3, 'Surat pemecatan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `LOG_ID` int(11) NOT NULL auto_increment,
  `USER_ID` int(11) default NULL,
  `SURAT_MASUK_ID` int(11) default NULL,
  `ROLE` decimal(1,0) default NULL,
  `JENIS_ALIH_POSISI` decimal(1,0) default NULL,
  `TIMESTAMP` datetime default NULL,
  PRIMARY KEY  (`LOG_ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `SURAT_MASUK_ID` (`SURAT_MASUK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=FIXED AUTO_INCREMENT=1 ;

--
-- Dumping data for table `log`
--


-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `SURAT_MASUK_ID` int(11) NOT NULL auto_increment,
  `INSTANSI_ID` int(11) default NULL,
  `JENIS_SURAT_ID` int(11) default NULL,
  `NOMOR` varchar(255) collate latin1_general_ci default NULL,
  `TGL_TERIMA` date default NULL,
  `LAMPIRAN` varchar(255) collate latin1_general_ci default NULL,
  `KEPADA` int(11) default NULL,
  `TGL_SURAT` date default NULL,
  `PERIHAL` varchar(255) collate latin1_general_ci default NULL,
  `SIFAT` smallint(6) default NULL,
  `KOMENTAR` text collate latin1_general_ci,
  `DATE_CREATED` datetime default NULL,
  `DATE_EDITED` datetime default NULL,
  `CATATAN_TERIMA_SURAT_MASUK` text collate latin1_general_ci,
  `DISPOSISI` decimal(1,0) default NULL,
  `KIRIM` decimal(1,0) default NULL,
  `STATUS_TERIMA` decimal(1,0) default NULL,
  PRIMARY KEY  (`SURAT_MASUK_ID`),
  KEY `INSTANSI_ID` (`INSTANSI_ID`),
  KEY `JENIS_SURAT_ID` (`JENIS_SURAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`SURAT_MASUK_ID`, `INSTANSI_ID`, `JENIS_SURAT_ID`, `NOMOR`, `TGL_TERIMA`, `LAMPIRAN`, `KEPADA`, `TGL_SURAT`, `PERIHAL`, `SIFAT`, `KOMENTAR`, `DATE_CREATED`, `DATE_EDITED`, `CATATAN_TERIMA_SURAT_MASUK`, `DISPOSISI`, `KIRIM`, `STATUS_TERIMA`) VALUES
(2, 1, 1, '15315', '2012-04-04', NULL, NULL, NULL, 'undangan', 2, NULL, '2012-04-29 22:12:54', NULL, NULL, NULL, 0, NULL),
(3, 1, 1, '23', '2012-04-03', '2', 4, '0000-00-00', 'ijin', 1, NULL, '2012-04-29 23:03:10', NULL, 'ini catatan surat masuk', NULL, 1, NULL),
(4, 1, 1, '12', '2012-04-02', '3', 5, '0000-00-00', 'rapat umum', 1, NULL, '2012-04-29 23:07:14', NULL, 'ini adalah catatan surat masuk', NULL, 2, NULL),
(5, 1, 1, '56', '2012-04-11', '9', 2, '2012-04-24', 'rapat umum', 1, NULL, '2012-04-29 23:10:14', NULL, 'catatan lagi', NULL, 2, NULL),
(6, 4, 3, '67', '2012-04-03', '5', 1, '2012-04-13', 'di baca dong', 1, NULL, '2012-04-30 11:57:16', NULL, 'tes', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `te`
--

CREATE TABLE IF NOT EXISTS `te` (
  `NAMA_JENIS_SURAT` varchar(255) collate latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `te`
--

INSERT INTO `te` (`NAMA_JENIS_SURAT`) VALUES
('Sumpah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL auto_increment,
  `JABATAN_ID` int(11) NOT NULL,
  `USERNAME` varchar(255) collate latin1_general_ci default NULL,
  `PASSWORD` varchar(255) collate latin1_general_ci default NULL,
  `NAMA` varchar(255) collate latin1_general_ci default NULL,
  `EMAIL` varchar(255) collate latin1_general_ci default NULL,
  `NO_HP` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_USER` smallint(6) default NULL,
  `ROLE` decimal(1,0) default NULL,
  PRIMARY KEY  (`USER_ID`),
  KEY `JABATAN_ID` (`JABATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `JABATAN_ID`, `USERNAME`, `PASSWORD`, `NAMA`, `EMAIL`, `NO_HP`, `STATUS_USER`, `ROLE`) VALUES
(5, 1, 'yoga', '0192023a7bbd73250516f069df18b500', 'yoga kurniawan', 'yoga_kurn@yahoo.co.id', '085731139293', 2, 1),
(6, 1, 'ozil', '827ccb0eea8a706c4c34a16891f84e7b', 'mesut ozil', 'mesut.ozil@gmail.com', '098765456887', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi_surat_masuk`
--
ALTER TABLE `disposisi_surat_masuk`
  ADD CONSTRAINT `disposisi_surat_masuk_ibfk_1` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_surat_masuk_ibfk_2` FOREIGN KEY (`DINAS_ID`) REFERENCES `dinas` (`DINAS_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `file_surat_masuk`
--
ALTER TABLE `file_surat_masuk`
  ADD CONSTRAINT `file_surat_masuk_ibfk_1` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_ibfk_2` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_2` FOREIGN KEY (`INSTANSI_ID`) REFERENCES `instansi` (`INSTANSI_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_masuk_ibfk_3` FOREIGN KEY (`JENIS_SURAT_ID`) REFERENCES `jenis_surat` (`JENIS_SURAT_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`JABATAN_ID`) REFERENCES `jabatan` (`JABATAN_ID`) ON UPDATE CASCADE;
