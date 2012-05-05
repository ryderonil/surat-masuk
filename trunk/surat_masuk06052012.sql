-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2012 at 01:10 
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
-- Table structure for table `daemons`
--

CREATE TABLE IF NOT EXISTS `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daemons`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `dinas`
--

INSERT INTO `dinas` (`DINAS_ID`, `NAMA_DINAS`, `SINGKATAN`, `STATUS_DINAS`) VALUES
(0, '-', '-', 1),
(1, 'Bagian Tata Pemerintahan', 'Batapem', 1),
(2, 'KELOMPOK SEKRETARIAT DAERAH', 'Kel. Sekda', 1),
(6, 'dinas perikanan', '-', 1),
(7, 'dinas perhutanan', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `disposisi_surat_masuk`
--

CREATE TABLE IF NOT EXISTS `disposisi_surat_masuk` (
  `DISPOSISI_ID` int(11) NOT NULL auto_increment,
  `SURAT_MASUK_ID` int(11) NOT NULL,
  `DINAS_ID` int(11) NOT NULL,
  `CATATAN_DISPOSISI` text collate latin1_general_ci NOT NULL,
  `USER_ID` int(11) NOT NULL,
  PRIMARY KEY  (`DISPOSISI_ID`),
  KEY `SURAT_MASUK_ID` (`SURAT_MASUK_ID`),
  KEY `DINAS_ID` (`DINAS_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `disposisi_surat_masuk`
--

INSERT INTO `disposisi_surat_masuk` (`DISPOSISI_ID`, `SURAT_MASUK_ID`, `DINAS_ID`, `CATATAN_DISPOSISI`, `USER_ID`) VALUES
(1, 1, 2, 'tes', 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `file_surat_masuk`
--

INSERT INTO `file_surat_masuk` (`FILE_SURAT_MASUK_ID`, `SURAT_MASUK_ID`, `NAMA_FILE`, `PATH_FILE`) VALUES
(1, 1, 'Peserta_Kuliah_-_Kls_A.pdf', 'uploads/surat/Peserta_Kuliah_-_Kls_A.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `gammu`
--

CREATE TABLE IF NOT EXISTS `gammu` (
  `Version` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gammu`
--

INSERT INTO `gammu` (`Version`) VALUES
(10);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `UpdatedInDB` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL default '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL default '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL default 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL default '',
  `Class` int(11) NOT NULL default '-1',
  `TextDecoded` varchar(160) NOT NULL default '',
  `ID` int(10) unsigned NOT NULL auto_increment,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL default 'false',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2012-05-05 19:55:16', '2011-02-16 14:55:31', '0054006500720069006D00610020006B0061007300690068002E002000420069006100790061002000480061007200690061006E00200052007000390039002F006800610072006900200075006E00740075006B0020006D0065006E0069006B006D006100740069002000700072006F006700720061006D000D000A005400610072006900660020004500640061006E002C00200052007000390039002F006D0065006E006900740020006B0065002000730065006D007500610020006F00700065007200610074006F0072002C002000740065006C0061006800200062006500720068006100730069006C0020006B0061006D0069000D000A006B0065006E0061006B0061006E002000640061007200690020006E006F006D006F007200200061006E00640061002E00200049006E0066006F0020003200300030', '3', 'Default_No_Compression', '', '+628964011092', -1, 'Terima kasih. Biaya Harian Rp99/hari untuk menikmati program\r\nTarif Edan, Rp99/menit ke semua operator, telah berhasil kami\r\nkenakan dari nomor anda. Info 200', 1, '', 'false'),
('2012-05-05 19:55:16', '2011-02-21 17:40:16', '004B0061006D0075002000740065006C00610068002000690073006900200075006C0061006E006700200052007000200035003000300030002E002000500075006C007300610020006B0061006D007500200052007000200037003800300030002C00200061006B00740069006600200073002E0064002000300031002F00300034002F0032003000310031002E0020004400700074006B0061006E00200074006100620075006E00670061006E00200052007000350030006A0074002E0020004B006500740069006B0020005900410020006B006900720069006D0020006B006500200039003900380037', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Kamu telah isi ulang Rp 5000. Pulsa kamu Rp 7800, aktif s.d 01/04/2011. Dptkan tabungan Rp50jt. Ketik YA kirim ke 9987', 2, '', 'false'),
('2012-05-05 19:55:16', '2011-02-28 22:07:09', '00500061006B0065007400200069006E007400650072006E006500740020003500300030004D006200200028005200700032003900720062002F0062006C006E002C00200062006C006D002000500050004E002900200061006B0061006E00200064006900700065007200700061006E006A0061006E006700200035002000680061007200690020006C006100670069002E002000550074006B0020007400650074006100700020006D0065006E0069006B006D006100740069006E00790061002C002000700061007300740069006B0061006E0020006B0061006D00750020006D0065006D0069006C0069006B0069002000700075006C00730061002F006B00720065006400690074002000630075006B00750070002E', '234', 'Default_No_Compression', '', '+628964011092', -1, 'Paket internet 500Mb (Rp29rb/bln, blm PPN) akan diperpanjang 5 hari lagi. Utk tetap menikmatinya, pastikan kamu memiliki pulsa/kredit cukup.', 3, '', 'false'),
('2012-05-05 19:55:16', '2011-05-06 16:33:48', '00530065006C0061006D0061007400210020004B0061006D00750020006D0065006E006400700074006B0061006E0020004700520041005400490053002000310030004D0042002E0020004E0069006B006D0061007400690020006800610072006900200069006E006900200073002E006400200070006B002000320033002E00350039002E0020004E0069006B006D0061007400690020006A0067002000700061006B00650074002000700065006E00610077006100720061006E00200069006E007400650072006E006500740020007400650072006200610069006B0020006C00610069006E006E007900610020006400610072006900200041005800490053002000640067006E0020006D0065006E0065006C0070006F006E0020002A003100320033002A00320023002E00200049006E0066006F003800330038', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Selamat! Kamu mendptkan GRATIS 10MB. Nikmati hari ini s.d pk 23.59. Nikmati jg paket penawaran internet terbaik lainnya dari AXIS dgn menelpon *123*2#. Info838', 4, '', 'false'),
('2012-05-05 19:55:16', '2011-05-07 00:58:02', '00530065006C0061006D0061007400210020004B0061006D00750020006D0065006E006400700074006B0061006E0020004700520041005400490053002000310030004D0042002E0020004E0069006B006D0061007400690020006800610072006900200069006E006900200073002E006400200070006B002000320033002E00350039002E0020004E0069006B006D0061007400690020006A0067002000700061006B00650074002000700065006E00610077006100720061006E00200069006E007400650072006E006500740020007400650072006200610069006B0020006C00610069006E006E007900610020006400610072006900200041005800490053002000640067006E0020006D0065006E0065006C0070006F006E0020002A003100320033002A00320023002E00200049006E0066006F003800330038', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Selamat! Kamu mendptkan GRATIS 10MB. Nikmati hari ini s.d pk 23.59. Nikmati jg paket penawaran internet terbaik lainnya dari AXIS dgn menelpon *123*2#. Info838', 5, '', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE IF NOT EXISTS `instansi` (
  `INSTANSI_ID` int(11) NOT NULL auto_increment,
  `NAMA_INSTANSI` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_INSTANSI` smallint(6) default NULL,
  PRIMARY KEY  (`INSTANSI_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`INSTANSI_ID`, `NAMA_INSTANSI`, `STATUS_INSTANSI`) VALUES
(1, 'Kapolda Jatim 2', 1),
(3, 'Dinas perhutanan', 1),
(4, 'Kapolda kutub utara', 1),
(5, 'Bos Kapak Merah', 1),
(6, 'Kapolda Jabar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `JABATAN_ID` int(11) NOT NULL auto_increment,
  `NAMA_JABATAN` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_JABATAN` smallint(6) default NULL,
  PRIMARY KEY  (`JABATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`JABATAN_ID`, `NAMA_JABATAN`, `STATUS_JABATAN`) VALUES
(1, 'sekretaris', 1),
(3, 'bos besar', 1),
(4, 'tess', 1),
(5, 'staff', 1),
(6, 'bupati', 1),
(7, 'wakil bupati', 1),
(8, 'asisten', 1),
(9, 'dinas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE IF NOT EXISTS `jenis_surat` (
  `JENIS_SURAT_ID` int(11) NOT NULL auto_increment,
  `NAMA_JENIS_SURAT` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_JENIS_SURAT` smallint(6) default NULL,
  PRIMARY KEY  (`JENIS_SURAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`JENIS_SURAT_ID`, `NAMA_JENIS_SURAT`, `STATUS_JENIS_SURAT`) VALUES
(1, 'Surat Dinas', 1),
(2, 'Surat Nota', 1),
(3, 'Surat pemecatan', 1),
(4, 'Surat perintah', 1),
(5, 'Surat Ijin', 1);

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
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `UpdatedInDB` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL default '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL default '0000-00-00 00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL default '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL default 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) default '-1',
  `TextDecoded` varchar(160) NOT NULL default '',
  `ID` int(10) unsigned NOT NULL auto_increment,
  `MultiPart` enum('false','true') default 'false',
  `RelativeValidity` int(11) default '-1',
  `SenderID` varchar(255) default NULL,
  `SendingTimeOut` timestamp NULL default '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') default 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `outbox`
--


-- --------------------------------------------------------

--
-- Table structure for table `outbox_multipart`
--

CREATE TABLE IF NOT EXISTS `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL default 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) default '-1',
  `TextDecoded` varchar(160) default NULL,
  `ID` int(10) unsigned NOT NULL default '0',
  `SequencePosition` int(11) NOT NULL default '1',
  PRIMARY KEY  (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `outbox_multipart`
--


-- --------------------------------------------------------

--
-- Table structure for table `pbk`
--

CREATE TABLE IF NOT EXISTS `pbk` (
  `GroupID` int(11) NOT NULL default '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pbk`
--


-- --------------------------------------------------------

--
-- Table structure for table `pbk_groups`
--

CREATE TABLE IF NOT EXISTS `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pbk_groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE IF NOT EXISTS `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL default '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL default '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL default 'no',
  `Receive` enum('yes','no') NOT NULL default 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL default '0',
  `Signal` int(11) NOT NULL default '0',
  `Sent` int(11) NOT NULL default '0',
  `Received` int(11) NOT NULL default '0',
  PRIMARY KEY  (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`ID`, `UpdatedInDB`, `InsertIntoDB`, `TimeOut`, `Send`, `Receive`, `IMEI`, `Client`, `Battery`, `Signal`, `Sent`, `Received`) VALUES
('', '2012-05-06 04:23:41', '2012-05-06 01:22:28', '2012-05-06 04:23:51', 'yes', 'yes', '864593004053236', 'Gammu 1.24.92, Windows Server 2007, GCC 4.3, MinGW 3.15', 100, 48, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sentitems`
--

CREATE TABLE IF NOT EXISTS `sentitems` (
  `UpdatedInDB` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL default '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL default '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL default NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL default '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL default 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL default '',
  `Class` int(11) NOT NULL default '-1',
  `TextDecoded` varchar(160) NOT NULL default '',
  `ID` int(10) unsigned NOT NULL default '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL default '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL default 'SendingOK',
  `StatusError` int(11) NOT NULL default '-1',
  `TPMR` int(11) NOT NULL default '-1',
  `RelativeValidity` int(11) NOT NULL default '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY  (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sentitems`
--

INSERT INTO `sentitems` (`UpdatedInDB`, `InsertIntoDB`, `SendingDateTime`, `DeliveryDateTime`, `Text`, `DestinationNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `SenderID`, `SequencePosition`, `Status`, `StatusError`, `TPMR`, `RelativeValidity`, `CreatorID`) VALUES
('2012-05-05 21:58:10', '2012-05-05 16:58:04', '2012-05-05 21:58:10', NULL, '0069006E006900200075006E00740075006B0020006100730069007300740065006E', '087740225564', 'Default_No_Compression', '', '+6281100000', -1, 'ini untuk asisten', 1, '', 1, 'SendingOKNoReport', -1, 11, 255, ' '),
('2012-05-05 21:58:12', '2012-05-05 16:58:04', '2012-05-05 21:58:12', NULL, '0069006E006900200075006E00740075006B002000730065006B0072006500740061007200690073', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini untuk sekretaris', 2, '', 1, 'SendingOKNoReport', -1, 12, 255, ' '),
('2012-05-06 00:14:19', '2012-05-05 19:13:55', '2012-05-06 00:14:19', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E00610073002000420061006700690061006E00200054006100740061002000500065006D006500720069006E0074006100680061006E', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas Bagian Tata Pemerintahan', 3, '', 1, 'SendingError', -1, -1, 255, ' '),
('2012-05-06 00:16:02', '2012-05-05 19:15:42', '2012-05-06 00:16:02', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E00610073002000420061006700690061006E00200054006100740061002000500065006D006500720069006E0074006100680061006E', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas Bagian Tata Pemerintahan', 4, '', 1, 'SendingError', -1, -1, 255, ' '),
('2012-05-06 00:18:51', '2012-05-05 19:18:33', '2012-05-06 00:18:51', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E00610073002000640069006E0061007300200070006500720069006B0061006E0061006E', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas dinas perikanan', 5, '', 1, 'SendingError', -1, -1, 255, ' '),
('2012-05-06 00:25:40', '2012-05-05 19:25:16', '2012-05-06 00:25:40', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E006100730020', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas ', 6, '', 1, 'SendingError', -1, -1, 255, ' '),
('2012-05-06 01:27:39', '2012-05-05 20:27:34', '2012-05-06 01:27:39', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E006100730020', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas ', 7, '', 1, 'SendingOKNoReport', -1, 17, 255, ' ');

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
  `DISPOSISI` decimal(1,0) NOT NULL default '0',
  `KIRIM_SEKRETARIS` decimal(1,0) NOT NULL default '0',
  `KIRIM_BUPATI` decimal(1,0) NOT NULL default '0',
  `STATUS_TERIMA_DINAS` decimal(1,0) NOT NULL default '0',
  `STATUS_TERIMA_SEKRETARIS` decimal(1,0) NOT NULL default '0',
  `STATUS_TERIMA_BUPATI` decimal(1,0) NOT NULL default '0',
  PRIMARY KEY  (`SURAT_MASUK_ID`),
  KEY `INSTANSI_ID` (`INSTANSI_ID`),
  KEY `JENIS_SURAT_ID` (`JENIS_SURAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`SURAT_MASUK_ID`, `INSTANSI_ID`, `JENIS_SURAT_ID`, `NOMOR`, `TGL_TERIMA`, `LAMPIRAN`, `KEPADA`, `TGL_SURAT`, `PERIHAL`, `SIFAT`, `KOMENTAR`, `DATE_CREATED`, `DATE_EDITED`, `CATATAN_TERIMA_SURAT_MASUK`, `DISPOSISI`, `KIRIM_SEKRETARIS`, `KIRIM_BUPATI`, `STATUS_TERIMA_DINAS`, `STATUS_TERIMA_SEKRETARIS`, `STATUS_TERIMA_BUPATI`) VALUES
(1, 1, 1, '1', '2012-05-02', '1', 2, '2012-05-09', 'Undangan', 1, 'tes', '2012-05-06 00:31:52', NULL, 'halo', 1, 1, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL auto_increment,
  `JABATAN_ID` int(11) NOT NULL,
  `DINAS_ID` int(11) NOT NULL,
  `USERNAME` varchar(255) collate latin1_general_ci default NULL,
  `PASSWORD` varchar(255) collate latin1_general_ci default NULL,
  `NAMA` varchar(255) collate latin1_general_ci default NULL,
  `EMAIL` varchar(255) collate latin1_general_ci default NULL,
  `NO_HP` varchar(255) collate latin1_general_ci default NULL,
  `STATUS_USER` smallint(6) default NULL,
  `ROLE` decimal(1,0) default NULL,
  PRIMARY KEY  (`USER_ID`),
  KEY `JABATAN_ID` (`JABATAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `JABATAN_ID`, `DINAS_ID`, `USERNAME`, `PASSWORD`, `NAMA`, `EMAIL`, `NO_HP`, `STATUS_USER`, `ROLE`) VALUES
(5, 5, 0, 'yoga', '7d6805ee1c2ddfbd75f951edd438e675', 'yoga kurniawan', 'yoga_kurn@yahoo.co.id', '085731139293', 1, 1),
(6, 8, 0, 'asisten', '81dc9bdb52d04dc20036dbd8313ed055', 'asisten', 'asisten@gmail.com', '087740225564', 1, 2),
(7, 1, 0, 'sekretaris', '81dc9bdb52d04dc20036dbd8313ed055', 'sekretaris', 'sekretaris@gmail.com', '085731139293', 1, 3),
(8, 7, 0, 'wakil_bupati', '81dc9bdb52d04dc20036dbd8313ed055', 'wakil_bupati', 'wabup@gmail.com', '085783746372872', 1, 4),
(9, 6, 0, 'bupati', '81dc9bdb52d04dc20036dbd8313ed055', 'bupati', 'bupati@gmail.com', '09876762867836', 1, 5),
(10, 9, 2, 'dinas1', '827ccb0eea8a706c4c34a16891f84e7b', 'dinas', 'dinas@gmail.com', '085731139293', 1, 6),
(11, 5, 6, 'dinas2', '81dc9bdb52d04dc20036dbd8313ed055', 'User Dinas 2', 'dinas2@gmail.com', '085731139293', 1, 6);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi_surat_masuk`
--
ALTER TABLE `disposisi_surat_masuk`
  ADD CONSTRAINT `disposisi_surat_masuk_ibfk_1` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_surat_masuk_ibfk_2` FOREIGN KEY (`DINAS_ID`) REFERENCES `dinas` (`DINAS_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_surat_masuk_ibfk_3` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`) ON UPDATE CASCADE;

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
