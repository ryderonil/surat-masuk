-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2012 at 09:29 PM
-- Server version: 5.0.45
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `surat_masuk2`
--

-- --------------------------------------------------------

--
-- Table structure for table `daemons`
--

CREATE TABLE IF NOT EXISTS `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_disposisi`
--

CREATE TABLE IF NOT EXISTS `detail_disposisi` (
  `DETAIL_DISPOSISI_ID` int(11) NOT NULL auto_increment,
  `DISPOSISI_ID` int(11) NOT NULL,
  `PENERIMA` int(11) NOT NULL,
  PRIMARY KEY  (`DETAIL_DISPOSISI_ID`),
  KEY `DISPOSISI_ID` (`DISPOSISI_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `detail_disposisi`
--

INSERT INTO `detail_disposisi` (`DETAIL_DISPOSISI_ID`, `DISPOSISI_ID`, `PENERIMA`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 2, 2),
(5, 2, 3),
(6, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `dinas`
--

CREATE TABLE IF NOT EXISTS `dinas` (
  `DINAS_ID` int(11) NOT NULL auto_increment,
  `NAMA_DINAS` varchar(255) collate latin1_general_ci default NULL,
  `SINGKATAN` varchar(255) collate latin1_general_ci default NULL,
  `NAMA_KEPALA` varchar(255) collate latin1_general_ci NOT NULL,
  `EMAIL_SKPD` varchar(255) collate latin1_general_ci NOT NULL,
  `HP` varchar(255) collate latin1_general_ci NOT NULL,
  `TELEPON` varchar(255) collate latin1_general_ci NOT NULL,
  `ALAMAT` text collate latin1_general_ci NOT NULL,
  `STATUS_DINAS` smallint(6) default NULL,
  `STATUS` varchar(1) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`DINAS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `dinas`
--

INSERT INTO `dinas` (`DINAS_ID`, `NAMA_DINAS`, `SINGKATAN`, `NAMA_KEPALA`, `EMAIL_SKPD`, `HP`, `TELEPON`, `ALAMAT`, `STATUS_DINAS`, `STATUS`) VALUES
(1, '-', '-', '', '', '', '', '', 1, ''),
(2, 'Asisten I', '-', '-', '-', '-', '-', '', 1, '0'),
(3, 'Asisten II', '-', '-', '-', '-', '-', '', 1, '0'),
(4, 'Asisten III', '-', '-', '-', '-', '-', '', 1, '0'),
(5, 'Sekretaris', '-', '-', '-', '-', '-', '', 1, '0'),
(6, 'Wakil Bupati', '-', '-', '-', '-', '-', '', 1, '0'),
(7, 'Bupati', '-', '-', '-', '-', '-', '-', 1, '0'),
(10, 'DINAS PEMUDA OLAHRAGA,KEBUDAYAAN DAN PARIWISATA', 'DPOKP', '-', 'dpokp@gmail.com', '085731139293', '8273889376', '-', 1, '1'),
(11, 'DINAS KESEHATAN', 'dinkes', '-', 'dinkes@gmail.com', '085731139293', '085731139293', '-', 1, '1'),
(12, 'DINAS SOSIAL,TENAGA KERJA DAN TRANSMIGRASI', 'dinsos', '-', 'dinsos@gmail.com', '085731139293', '5678654647', '-', 1, '1'),
(13, 'DINAS PERHUBUNGAN, KOMUNIKASI DAN INFORMATIKA', 'dishub', '-', 'dishub@gmail.com', '085731139293', '75647689', '-', 1, '1'),
(14, 'DINAS PEKERJAAN UMUM', 'dinaspu', '-', 'dinaspu@gmail.com', '085731139293', '085731139293', '-', 1, '1'),
(15, 'DINAS PERINDUSTRIAN, PERDAGANGAN, DAN PERINDUSTRIAN', 'disperindag', '-', 'disperindag@gmail.com', '085731139293', '1234567875', '-', 1, '1'),
(16, 'DINAS PENDAPATAN', 'dpdpt', '-', 'dpdpt@gmail.com', '085731139293', '085731139293', '-', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `disposisi_surat_masuk`
--

CREATE TABLE IF NOT EXISTS `disposisi_surat_masuk` (
  `DISPOSISI_ID` int(11) NOT NULL auto_increment,
  `SURAT_MASUK_ID` int(11) NOT NULL,
  `CATATAN_DISPOSISI` text collate latin1_general_ci NOT NULL,
  `TANGGAL_DISPOSISI` date NOT NULL,
  `FILE_DISPOSISI` varchar(255) collate latin1_general_ci NOT NULL,
  `URGENSI` varchar(1) collate latin1_general_ci NOT NULL,
  `USER_ID` int(11) NOT NULL,
  PRIMARY KEY  (`DISPOSISI_ID`),
  KEY `SURAT_MASUK_ID` (`SURAT_MASUK_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `disposisi_surat_masuk`
--

INSERT INTO `disposisi_surat_masuk` (`DISPOSISI_ID`, `SURAT_MASUK_ID`, `CATATAN_DISPOSISI`, `TANGGAL_DISPOSISI`, `FILE_DISPOSISI`, `URGENSI`, `USER_ID`) VALUES
(1, 4, 'tes', '2012-07-18', 'Buku-Pedoman-SKEM-Terbaru1.pdf', '2', 14),
(2, 3, 'saya mencoba teks sms disposisi', '2012-07-18', 'Srt_Pengumuman_Hibah_PKM_20112.pdf', '1', 14);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `file_surat_masuk`
--

INSERT INTO `file_surat_masuk` (`FILE_SURAT_MASUK_ID`, `SURAT_MASUK_ID`, `NAMA_FILE`, `PATH_FILE`) VALUES
(18, 1, 'Buku-Pedoman-SKEM-Terbaru.pdf', 'uploads/surat/Buku-Pedoman-SKEM-Terbaru.pdf'),
(19, 2, 'Srt_Pengumuman_Hibah_PKM_2011.pdf', 'uploads/surat/Srt_Pengumuman_Hibah_PKM_2011.pdf'),
(20, 3, 'Srt_Pengumuman_Hibah_PKM_20111.pdf', 'uploads/surat/Srt_Pengumuman_Hibah_PKM_20111.pdf');

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
(10),
(13);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2012-05-05 12:55:16', '2011-02-16 07:55:31', '0054006500720069006D00610020006B0061007300690068002E002000420069006100790061002000480061007200690061006E00200052007000390039002F006800610072006900200075006E00740075006B0020006D0065006E0069006B006D006100740069002000700072006F006700720061006D000D000A005400610072006900660020004500640061006E002C00200052007000390039002F006D0065006E006900740020006B0065002000730065006D007500610020006F00700065007200610074006F0072002C002000740065006C0061006800200062006500720068006100730069006C0020006B0061006D0069000D000A006B0065006E0061006B0061006E002000640061007200690020006E006F006D006F007200200061006E00640061002E00200049006E0066006F0020003200300030', '3', 'Default_No_Compression', '', '+628964011092', -1, 'Terima kasih. Biaya Harian Rp99/hari untuk menikmati program\r\nTarif Edan, Rp99/menit ke semua operator, telah berhasil kami\r\nkenakan dari nomor anda. Info 200', 1, '', 'false'),
('2012-05-05 12:55:16', '2011-02-21 10:40:16', '004B0061006D0075002000740065006C00610068002000690073006900200075006C0061006E006700200052007000200035003000300030002E002000500075006C007300610020006B0061006D007500200052007000200037003800300030002C00200061006B00740069006600200073002E0064002000300031002F00300034002F0032003000310031002E0020004400700074006B0061006E00200074006100620075006E00670061006E00200052007000350030006A0074002E0020004B006500740069006B0020005900410020006B006900720069006D0020006B006500200039003900380037', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Kamu telah isi ulang Rp 5000. Pulsa kamu Rp 7800, aktif s.d 01/04/2011. Dptkan tabungan Rp50jt. Ketik YA kirim ke 9987', 2, '', 'false'),
('2012-05-05 12:55:16', '2011-02-28 15:07:09', '00500061006B0065007400200069006E007400650072006E006500740020003500300030004D006200200028005200700032003900720062002F0062006C006E002C00200062006C006D002000500050004E002900200061006B0061006E00200064006900700065007200700061006E006A0061006E006700200035002000680061007200690020006C006100670069002E002000550074006B0020007400650074006100700020006D0065006E0069006B006D006100740069006E00790061002C002000700061007300740069006B0061006E0020006B0061006D00750020006D0065006D0069006C0069006B0069002000700075006C00730061002F006B00720065006400690074002000630075006B00750070002E', '234', 'Default_No_Compression', '', '+628964011092', -1, 'Paket internet 500Mb (Rp29rb/bln, blm PPN) akan diperpanjang 5 hari lagi. Utk tetap menikmatinya, pastikan kamu memiliki pulsa/kredit cukup.', 3, '', 'false'),
('2012-05-05 12:55:16', '2011-05-06 09:33:48', '00530065006C0061006D0061007400210020004B0061006D00750020006D0065006E006400700074006B0061006E0020004700520041005400490053002000310030004D0042002E0020004E0069006B006D0061007400690020006800610072006900200069006E006900200073002E006400200070006B002000320033002E00350039002E0020004E0069006B006D0061007400690020006A0067002000700061006B00650074002000700065006E00610077006100720061006E00200069006E007400650072006E006500740020007400650072006200610069006B0020006C00610069006E006E007900610020006400610072006900200041005800490053002000640067006E0020006D0065006E0065006C0070006F006E0020002A003100320033002A00320023002E00200049006E0066006F003800330038', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Selamat! Kamu mendptkan GRATIS 10MB. Nikmati hari ini s.d pk 23.59. Nikmati jg paket penawaran internet terbaik lainnya dari AXIS dgn menelpon *123*2#. Info838', 4, '', 'false'),
('2012-05-05 12:55:16', '2011-05-06 17:58:02', '00530065006C0061006D0061007400210020004B0061006D00750020006D0065006E006400700074006B0061006E0020004700520041005400490053002000310030004D0042002E0020004E0069006B006D0061007400690020006800610072006900200069006E006900200073002E006400200070006B002000320033002E00350039002E0020004E0069006B006D0061007400690020006A0067002000700061006B00650074002000700065006E00610077006100720061006E00200069006E007400650072006E006500740020007400650072006200610069006B0020006C00610069006E006E007900610020006400610072006900200041005800490053002000640067006E0020006D0065006E0065006C0070006F006E0020002A003100320033002A00320023002E00200049006E0066006F003800330038', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Selamat! Kamu mendptkan GRATIS 10MB. Nikmati hari ini s.d pk 23.59. Nikmati jg paket penawaran internet terbaik lainnya dari AXIS dgn menelpon *123*2#. Info838', 5, '', 'false'),
('2012-05-20 04:14:55', '2012-05-12 18:59:49', '0041006E006400610020006D00730068002000740065007200640061006600740061007200200064006C006D002000700061006B00650074002000620075006E0064006C0069006E006700200033002000620075006C0061006E002E005300610061007400200069006E006900200041006E006400610020006D0065006D006100730075006B0069002000620075006C0061006E0020006B0065002000330020006400610072006900200033002000620075006C0061006E002E0045007800700069007200650064002000740067006C002000310031002D00300036002D00320030003100320020006A0061006D002000320034003A00300030002E0049006E0066006F0020007700770077002E0078006C002E0063006F002E00690064', '86801', 'Default_No_Compression', '', '+62818445009', -1, 'Anda msh terdaftar dlm paket bundling 3 bulan.Saat ini Anda memasuki bulan ke 3 dari 3 bulan.Expired tgl 11-06-2012 jam 24:00.Info www.xl.co.id', 6, '', 'false'),
('2012-07-08 07:30:32', '2012-03-31 03:00:35', '0055007700200065006100200079002000670061002C0020006D0061006100660020006C00700061002000710077002E00200041006D0062006C00200065006C0065006B00740072006F002000650061003F00200052006E0063006E006100780020007400710020006D00770020006E0067006C006D006100720020006B006D0061006E006100200062006900730020006C0075006C00750073', '+6283846301399', 'Default_No_Compression', '', '+62855000000', -1, 'Uw ea y ga, maaf lpa qw. Ambl elektro ea? Rncnax tq mw nglmar kmana bis lulus', 7, '', 'false'),
('2012-07-08 07:30:32', '2012-04-06 12:38:13', '00550068006D002C006B006C006F002000700065007200740061006E007900610061006E0065002000640075006C007500200079006F006700200067006D006E003F000A0043007A0020006D007700200064006900620075006100740020007000700074006E0065003A0044', '+6285730444278', 'Default_No_Compression', '', '+62855000000', -1, 'Uhm,klo pertanyaane dulu yog gmn?\nCz mw dibuat pptne:D', 8, '', 'false'),
('2012-07-08 07:30:32', '2012-05-03 04:38:08', '004D00610073000A00740061006E007900610061000A00790061006E0067002000730074006100740069007300740069006B0061002000730061006D0070006C0069006E006700200064006900730074007200690062007500740069006F006E00200061006D006100200063006F006E0066006900640065006E0063006500200069006E00740065007200760061004C0020002E002E000A', '+6285649625066', 'Default_No_Compression', '', '+62855000000', -1, 'Mas\ntanyaa\nyang statistika sampling distribution ama confidence intervaL ..\n', 9, '', 'false'),
('2012-07-08 07:30:32', '2012-06-15 13:23:28', '004E007500700065006B007500200079006700200062006100720075002C0020007300610076006500200079006100610020003A0029000D00530065006C00760069006B00610020005400690079006F002000480061006E0064006100790061006E0069', '+6285785166212', 'Default_No_Compression', '', '+62855000000', -1, 'Nupeku yg baru, save yaa :)\rSelvika Tiyo Handayani', 10, '', 'false'),
('2012-07-08 09:10:02', '2012-07-08 09:10:00', '0054006500720064006100700061007400200073007500720061007400200075006E00740075006B00200041006E00640061002E0020004D006F0068006F006E00200073006500670065007200610020006400690070006500720069006B00730061002E00200054006500720069006D0061006B0061007300690068', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 11, '', 'false'),
('2012-07-08 09:15:02', '2012-07-08 09:15:00', '0054006500720064006100700061007400200073007500720061007400200075006E00740075006B00200041006E00640061002E0020004D006F0068006F006E00200073006500670065007200610020006400690070006500720069006B00730061002E00200054006500720069006D0061006B0061007300690068', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 12, '', 'false'),
('2012-07-08 09:15:08', '2012-07-08 09:15:07', '0054006500720064006100700061007400200073007500720061007400200075006E00740075006B00200041006E00640061002E0020004D006F0068006F006E00200073006500670065007200610020006400690070006500720069006B00730061002E00200054006500720069006D0061006B0061007300690068', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 13, '', 'false'),
('2012-07-08 09:21:13', '2012-07-08 09:21:12', '0054006500720064006100700061007400200073007500720061007400200075006E00740075006B00200041006E00640061002E0020004D006F0068006F006E00200073006500670065007200610020006400690070006500720069006B00730061002E00200054006500720069006D0061006B0061007300690068', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 14, '', 'false'),
('2012-07-08 09:21:18', '2012-07-08 09:21:16', '0054006500720064006100700061007400200073007500720061007400200075006E00740075006B00200041006E00640061002E0020004D006F0068006F006E00200073006500670065007200610020006400690070006500720069006B00730061002E00200054006500720069006D0061006B0061007300690068', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 15, '', 'false'),
('2012-07-08 09:33:37', '2012-07-08 09:33:36', '0054006500720064006100700061007400200073007500720061007400200075006E00740075006B00200041006E00640061002E0020004D006F0068006F006E00200073006500670065007200610020006400690070006500720069006B00730061002E00200054006500720069006D0061006B0061007300690068', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 16, '', 'false'),
('2012-07-09 03:42:57', '2012-07-09 03:42:57', '0054006500720064006100700061007400200073007500720061007400200075006E00740075006B00200041006E00640061002E0020004D006F0068006F006E00200073006500670065007200610020006400690070006500720069006B00730061002E00200054006500720069006D0061006B0061007300690068', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 17, '', 'false'),
('2012-07-18 04:15:31', '2012-07-18 04:15:43', '0063006F00620061002000740065006B007300200073006D0073', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'coba teks sms', 18, '', 'false'),
('2012-07-18 04:37:01', '2012-07-18 04:37:13', '0063006F00620061002000740065006B007300200073006D0073', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'coba teks sms', 19, '', 'false'),
('2012-07-18 04:37:03', '2012-07-18 04:37:15', '0063006F00620061002000740065006B007300200073006D0073', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'coba teks sms', 20, '', 'false'),
('2012-07-18 04:38:45', '2012-07-18 04:38:57', '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'saya mencoba teks sms disposisi', 21, '', 'false'),
('2012-07-18 04:38:47', '2012-07-18 04:38:59', '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'saya mencoba teks sms disposisi', 22, '', 'false'),
('2012-07-18 04:38:50', '2012-07-18 04:39:02', '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'saya mencoba teks sms disposisi', 23, '', 'false'),
('2012-07-18 04:41:27', '2012-07-18 04:41:39', '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'saya mencoba teks sms disposisi', 24, '', 'false'),
('2012-07-18 04:41:32', '2012-07-18 04:41:44', '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '+6285731139293', 'Default_No_Compression', '', '+62816124', -1, 'saya mencoba teks sms disposisi', 25, '', 'false');

--
-- Triggers `inbox`
--
DROP TRIGGER IF EXISTS `inbox_timestamp`;
DELIMITER //
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox`
 FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE IF NOT EXISTS `instansi` (
  `INSTANSI_ID` int(11) NOT NULL auto_increment,
  `NAMA_INSTANSI` varchar(255) collate latin1_general_ci default NULL,
  `ALAMAT_INSTANSI` text collate latin1_general_ci,
  `STATUS_INSTANSI` smallint(6) default NULL,
  PRIMARY KEY  (`INSTANSI_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`INSTANSI_ID`, `NAMA_INSTANSI`, `ALAMAT_INSTANSI`, `STATUS_INSTANSI`) VALUES
(1, 'Kapolda Jatim 2', NULL, 1),
(3, 'Dinas perhutanan', NULL, 1),
(4, 'Kapolda kutub utara', NULL, 2),
(5, 'Bos Kapak Merah', NULL, 1),
(6, 'Kapolda Jabar', NULL, 1),
(7, '3', NULL, 1),
(8, 'Kapolsek sukolilo', NULL, 1),
(9, 'Udar – Ider Corp', NULL, 1),
(10, '1', NULL, 1),
(11, 'Kemendikbud', NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`JENIS_SURAT_ID`, `NAMA_JENIS_SURAT`, `STATUS_JENIS_SURAT`) VALUES
(1, 'Surat Dinas', 1),
(2, 'Surat Nota', 1),
(4, 'Surat perintah', 1),
(5, 'Surat Ijin', 1),
(6, 'Surat Memo', 1),
(7, 'surat keterangan', 1),
(9, 'Surat dinas kunjungan kerja', 1),
(10, 'Surat Edaran', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `jumlah_surat_masuk_by_jns_surat`
--
CREATE TABLE IF NOT EXISTS `jumlah_surat_masuk_by_jns_surat` (
`tgl_terima` date
,`nama_jenis_surat` varchar(255)
,`jumlah` bigint(21)
);
-- --------------------------------------------------------

--
-- Table structure for table `komentar_disposisi`
--

CREATE TABLE IF NOT EXISTS `komentar_disposisi` (
  `KOMENTAR_DISPOSISI_ID` int(11) NOT NULL auto_increment,
  `DISPOSISI_ID` int(11) NOT NULL,
  `DINAS_ID` int(11) NOT NULL,
  `TGL_KOMENTAR` datetime NOT NULL,
  `KOMENTAR_DISPOSISI` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`KOMENTAR_DISPOSISI_ID`),
  KEY `DISPOSISI_ID` (`DISPOSISI_ID`),
  KEY `DINAS_ID` (`DINAS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `komentar_surat`
--

CREATE TABLE IF NOT EXISTS `komentar_surat` (
  `KOMENTAR_SURAT_ID` int(11) NOT NULL auto_increment,
  `SURAT_MASUK_ID` int(11) NOT NULL,
  `KOMENTATOR` int(11) NOT NULL,
  `KOMENTAR` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`KOMENTAR_SURAT_ID`),
  KEY `SURAT_MASUK_ID` (`SURAT_MASUK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `log_terima_surat`
--

CREATE TABLE IF NOT EXISTS `log_terima_surat` (
  `LOG_TERIMA_SURAT_ID` int(11) NOT NULL auto_increment,
  `SURAT_MASUK_ID` int(11) NOT NULL,
  `PENERIMA` int(11) NOT NULL,
  PRIMARY KEY  (`LOG_TERIMA_SURAT_ID`),
  KEY `SURAT_MASUK_ID` (`SURAT_MASUK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `pbk`
--

CREATE TABLE IF NOT EXISTS `pbk` (
  `GroupID` int(11) NOT NULL default '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbk_groups`
--

CREATE TABLE IF NOT EXISTS `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
('', '2012-07-18 04:47:14', '2012-07-18 04:15:27', '2012-07-18 04:47:24', 'yes', 'yes', '864593004053236', 'Gammu 1.24.92, Windows Server 2007, GCC 4.3, MinGW 3.15', 0, 0, 9, 8);

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
('2012-07-18 04:41:31', '2012-07-17 23:41:22', '2012-07-18 04:41:31', NULL, '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'saya mencoba teks sms disposisi', 53, '', 1, 'SendingOKNoReport', -1, 64, 255, ' '),
('2012-07-18 04:41:27', '2012-07-17 23:41:22', '2012-07-18 04:41:27', NULL, '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'saya mencoba teks sms disposisi', 54, '', 1, 'SendingOKNoReport', -1, 62, 255, ' '),
('2012-07-18 04:41:29', '2012-07-17 23:41:22', '2012-07-18 04:41:29', NULL, '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'saya mencoba teks sms disposisi', 55, '', 1, 'SendingOKNoReport', -1, 63, 255, ' '),
('2012-07-18 04:38:49', '2012-07-17 23:38:37', '2012-07-18 04:38:49', NULL, '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'saya mencoba teks sms disposisi', 50, '', 1, 'SendingOKNoReport', -1, 61, 255, ' '),
('2012-07-18 04:37:03', '2012-07-17 23:36:50', '2012-07-18 04:37:03', NULL, '0063006F00620061002000740065006B007300200073006D0073', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'coba teks sms', 49, '', 1, 'SendingOKNoReport', -1, 58, 255, ' '),
('2012-07-18 04:38:45', '2012-07-17 23:38:37', '2012-07-18 04:38:45', NULL, '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'saya mencoba teks sms disposisi', 51, '', 1, 'SendingOKNoReport', -1, 59, 255, ' '),
('2012-07-18 04:38:47', '2012-07-17 23:38:37', '2012-07-18 04:38:47', NULL, '00730061007900610020006D0065006E0063006F00620061002000740065006B007300200073006D007300200064006900730070006F0073006900730069', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'saya mencoba teks sms disposisi', 52, '', 1, 'SendingOKNoReport', -1, 60, 255, ' '),
('2012-07-18 04:15:31', '2012-07-17 23:14:03', '2012-07-18 04:15:31', NULL, '0063006F00620061002000740065006B007300200073006D0073', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'coba teks sms', 47, '', 1, 'SendingOKNoReport', -1, 56, 255, ' '),
('2012-07-18 04:37:01', '2012-07-17 23:36:50', '2012-07-18 04:37:01', NULL, '0063006F00620061002000740065006B007300200073006D0073', '085731139293', 'Default_No_Compression', '', '+62855000000', -1, 'coba teks sms', 48, '', 1, 'SendingOKNoReport', -1, 57, 255, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `sms_template`
--

CREATE TABLE IF NOT EXISTS `sms_template` (
  `TEMPLATE_ID` int(11) NOT NULL auto_increment,
  `TEMPLATE_SMS` text collate latin1_general_ci NOT NULL,
  `DEFAULT_KIRIM` varchar(1) collate latin1_general_ci NOT NULL,
  `DEFAULT_DISPOSISI` varchar(1) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`TEMPLATE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sms_template`
--

INSERT INTO `sms_template` (`TEMPLATE_ID`, `TEMPLATE_SMS`, `DEFAULT_KIRIM`, `DEFAULT_DISPOSISI`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada ', '0', '0'),
(2, 'coba teks sms', '1', '1');

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
  `TGL_SURAT` date default NULL,
  `PERIHAL` varchar(255) collate latin1_general_ci default NULL,
  `SIFAT` smallint(6) default NULL,
  `DATE_CREATED` datetime default NULL,
  `DATE_EDITED` datetime default NULL,
  `TGL_KIRIM` datetime default NULL,
  `CATATAN_TERIMA_SURAT_MASUK` text collate latin1_general_ci,
  PRIMARY KEY  (`SURAT_MASUK_ID`),
  KEY `INSTANSI_ID` (`INSTANSI_ID`),
  KEY `JENIS_SURAT_ID` (`JENIS_SURAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`SURAT_MASUK_ID`, `INSTANSI_ID`, `JENIS_SURAT_ID`, `NOMOR`, `TGL_TERIMA`, `LAMPIRAN`, `TGL_SURAT`, `PERIHAL`, `SIFAT`, `DATE_CREATED`, `DATE_EDITED`, `TGL_KIRIM`, `CATATAN_TERIMA_SURAT_MASUK`) VALUES
(1, 1, 1, '1', '2012-07-02', '2', '2012-07-03', 'tre', 1, '2012-07-16 22:33:20', NULL, '0000-00-00 00:00:00', 'tes'),
(2, 1, 2, '5', '2012-07-18', '2', '2012-07-18', 'tes', 1, '2012-07-18 00:48:13', NULL, '2012-07-18 06:36:50', 'tes'),
(3, 5, 4, '6', '2012-07-18', '3', '2012-07-03', 'keterangan kehilangan', 1, '2012-07-18 01:57:57', NULL, NULL, 'tes'),
(4, 1, 1, '8', '2012-07-18', '5', '2012-07-03', 'tes 2', 1, '2012-07-18 01:59:00', NULL, NULL, 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan_disposisi`
--

CREATE TABLE IF NOT EXISTS `tujuan_disposisi` (
  `TUJUAN_DISPOSISI_ID` int(11) NOT NULL,
  `DISPOSISI_ID` int(11) NOT NULL,
  `DINAS_ID` int(11) NOT NULL,
  `ROLE` int(11) NOT NULL,
  PRIMARY KEY  (`TUJUAN_DISPOSISI_ID`),
  KEY `DISPOSISI_ID` (`DISPOSISI_ID`),
  KEY `DINAS_ID` (`DINAS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tujuan_surat`
--

CREATE TABLE IF NOT EXISTS `tujuan_surat` (
  `TUJUAN_SURAT_ID` int(11) NOT NULL auto_increment,
  `SURAT_MASUK_ID` int(11) NOT NULL,
  `TUJUAN` varchar(10) collate latin1_general_ci NOT NULL,
  `STATUS_KIRIM` varchar(1) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`TUJUAN_SURAT_ID`),
  KEY `SURAT_MASUK_ID` (`SURAT_MASUK_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tujuan_surat`
--

INSERT INTO `tujuan_surat` (`TUJUAN_SURAT_ID`, `SURAT_MASUK_ID`, `TUJUAN`, `STATUS_KIRIM`) VALUES
(1, 1, '2', '1'),
(2, 1, '3', '1'),
(3, 1, '4', '1'),
(4, 2, '5', '1'),
(5, 2, '6', '1'),
(6, 2, '7', '1'),
(7, 2, '10', '1'),
(8, 2, '11', '0'),
(9, 2, '12', '0'),
(10, 2, '13', '0'),
(11, 2, '14', '0'),
(12, 2, '15', '0'),
(13, 2, '16', '0'),
(14, 3, '10', '0'),
(15, 4, '4', '0');

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
  KEY `JABATAN_ID` (`JABATAN_ID`),
  KEY `DINAS_ID` (`DINAS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `JABATAN_ID`, `DINAS_ID`, `USERNAME`, `PASSWORD`, `NAMA`, `EMAIL`, `NO_HP`, `STATUS_USER`, `ROLE`) VALUES
(5, 5, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'yoga kurniawan', 'yoga_kurn@yahoo.co.id', '085731139293', 1, 1),
(6, 8, 2, 'asisten_1', '81dc9bdb52d04dc20036dbd8313ed055', 'asisten I', 'asisten1@gmail.com', '085731139293', 1, 2),
(7, 1, 3, 'asisten_2', '81dc9bdb52d04dc20036dbd8313ed055', 'asisten II', 'asisten2@gmail.com', '085731139293', 1, 3),
(8, 7, 4, 'asisten_3', '81dc9bdb52d04dc20036dbd8313ed055', 'asisten III', 'asisten3@gmail.com', '085731139293', 1, 4),
(9, 6, 5, 'sekretaris', '81dc9bdb52d04dc20036dbd8313ed055', 'sekretaris daerah', 'sekretaris@gmail.com', '085731139293', 1, 5),
(13, 3, 6, 'wabup', '81dc9bdb52d04dc20036dbd8313ed055', 'wakil bupati', 'wabup@gmail.com', '085731139293', 1, 6),
(14, 6, 7, 'bupati', '81dc9bdb52d04dc20036dbd8313ed055', 'bupati', 'bupati@gmail.com', '085731139293', 1, 7),
(15, 5, 16, 'dinas1', '81dc9bdb52d04dc20036dbd8313ed055', 'dinas pendapatan', 'dinas1@gmail.com', '085731139293', 1, 8),
(16, 5, 11, 'dinas2', '81dc9bdb52d04dc20036dbd8313ed055', 'dinas kesehatan', 'dinkes@gmail.com', '085731139293', 1, 8),
(17, 1, 14, 'dinas3', '81dc9bdb52d04dc20036dbd8313ed055', 'dinas pekerjaan umum', 'dpu@gmail.com', '085731139293', 1, 8);

-- --------------------------------------------------------

--
-- Structure for view `jumlah_surat_masuk_by_jns_surat`
--
DROP TABLE IF EXISTS `jumlah_surat_masuk_by_jns_surat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `jumlah_surat_masuk_by_jns_surat` AS select `surat_masuk`.`TGL_TERIMA` AS `tgl_terima`,`jenis_surat`.`NAMA_JENIS_SURAT` AS `nama_jenis_surat`,count(0) AS `jumlah` from (`surat_masuk` join `jenis_surat` on((`jenis_surat`.`JENIS_SURAT_ID` = `surat_masuk`.`JENIS_SURAT_ID`))) group by `surat_masuk`.`JENIS_SURAT_ID`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_disposisi`
--
ALTER TABLE `detail_disposisi`
  ADD CONSTRAINT `detail_disposisi_ibfk_1` FOREIGN KEY (`DISPOSISI_ID`) REFERENCES `disposisi_surat_masuk` (`DISPOSISI_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `disposisi_surat_masuk`
--
ALTER TABLE `disposisi_surat_masuk`
  ADD CONSTRAINT `disposisi_surat_masuk_ibfk_1` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_surat_masuk_ibfk_3` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `file_surat_masuk`
--
ALTER TABLE `file_surat_masuk`
  ADD CONSTRAINT `file_surat_masuk_ibfk_1` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `komentar_disposisi`
--
ALTER TABLE `komentar_disposisi`
  ADD CONSTRAINT `komentar_disposisi_ibfk_1` FOREIGN KEY (`DISPOSISI_ID`) REFERENCES `disposisi_surat_masuk` (`DISPOSISI_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_disposisi_ibfk_2` FOREIGN KEY (`DINAS_ID`) REFERENCES `dinas` (`DINAS_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `komentar_surat`
--
ALTER TABLE `komentar_surat`
  ADD CONSTRAINT `komentar_surat_ibfk_1` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `log_ibfk_2` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `log_terima_surat`
--
ALTER TABLE `log_terima_surat`
  ADD CONSTRAINT `log_terima_surat_ibfk_1` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_2` FOREIGN KEY (`INSTANSI_ID`) REFERENCES `instansi` (`INSTANSI_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_masuk_ibfk_3` FOREIGN KEY (`JENIS_SURAT_ID`) REFERENCES `jenis_surat` (`JENIS_SURAT_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tujuan_disposisi`
--
ALTER TABLE `tujuan_disposisi`
  ADD CONSTRAINT `tujuan_disposisi_ibfk_1` FOREIGN KEY (`DISPOSISI_ID`) REFERENCES `disposisi_surat_masuk` (`DISPOSISI_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tujuan_disposisi_ibfk_2` FOREIGN KEY (`DINAS_ID`) REFERENCES `dinas` (`DINAS_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tujuan_surat`
--
ALTER TABLE `tujuan_surat`
  ADD CONSTRAINT `tujuan_surat_ibfk_1` FOREIGN KEY (`SURAT_MASUK_ID`) REFERENCES `surat_masuk` (`SURAT_MASUK_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`JABATAN_ID`) REFERENCES `jabatan` (`JABATAN_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`DINAS_ID`) REFERENCES `dinas` (`DINAS_ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
