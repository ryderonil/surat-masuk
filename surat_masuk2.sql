-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2012 at 10:42 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `detail_disposisi`
--

INSERT INTO `detail_disposisi` (`DETAIL_DISPOSISI_ID`, `DISPOSISI_ID`, `PENERIMA`) VALUES
(1, 1, 11),
(2, 2, 6),
(3, 3, 11),
(4, 3, 14),
(5, 3, 16),
(6, 4, 2),
(7, 4, 3),
(8, 4, 4),
(9, 4, 5),
(10, 5, 11),
(11, 5, 14),
(12, 5, 16),
(13, 6, 11),
(14, 6, 14),
(15, 6, 16),
(16, 7, 11),
(17, 7, 14),
(18, 7, 16),
(19, 8, 11),
(20, 8, 14),
(21, 8, 16),
(22, 9, 2),
(23, 9, 3),
(24, 9, 4),
(25, 10, 11),
(26, 10, 14),
(27, 10, 16),
(28, 11, 11),
(29, 11, 14),
(30, 11, 16),
(31, 12, 11),
(32, 12, 14),
(33, 12, 16),
(34, 13, 4),
(35, 13, 5),
(36, 14, 11),
(37, 14, 14),
(38, 14, 16),
(39, 15, 11),
(40, 15, 14),
(41, 15, 16),
(42, 16, 2),
(43, 16, 3),
(44, 16, 4),
(45, 16, 5),
(46, 16, 6),
(47, 17, 11),
(48, 18, 16),
(49, 19, 12);

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
(10, 'DINAS PEMUDA OLAHRAGA,KEBUDAYAAN DAN PARIWISATA', 'DPOKP', '-', 'dpokp@gmail.com', '28392737928809908', '8273889376', '-', 1, '1'),
(11, 'DINAS KESEHATAN', 'dinkes', '-', 'dinkes@gmail.com', '8278697809878', '085731139293', '-', 1, '1'),
(12, 'DINAS SOSIAL,TENAGA KERJA DAN TRANSMIGRASI', 'dinsos', '-', 'dinsos@gmail.com', '67897654678', '5678654647', '-', 1, '1'),
(13, 'DINAS PERHUBUNGAN, KOMUNIKASI DAN INFORMATIKA', 'dishub', '-', 'dishub@gmail.com', '987685789867', '75647689', '-', 1, '1'),
(14, 'DINAS PEKERJAAN UMUM', 'dinaspu', '-', 'dinaspu@gmail.com', '5678798657467', '085731139293', '-', 1, '1'),
(15, 'DINAS PERINDUSTRIAN, PERDAGANGAN, DAN PERINDUSTRIAN', 'disperindag', '-', 'disperindag@gmail.com', '2345678987', '1234567875', '-', 1, '1'),
(16, 'DINAS PENDAPATAN', 'dpdpt', '-', 'dpdpt@gmail.com', '657876856', '085731139293', '-', 1, '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `disposisi_surat_masuk`
--

INSERT INTO `disposisi_surat_masuk` (`DISPOSISI_ID`, `SURAT_MASUK_ID`, `CATATAN_DISPOSISI`, `TANGGAL_DISPOSISI`, `FILE_DISPOSISI`, `URGENSI`, `USER_ID`) VALUES
(1, 5, 'tolong dibantu ya', '2012-06-24', 'knsi2006[sholiq].pdf', '1', 6),
(2, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam laoreet risus, a ullamcorper justo cursus ut. Donec aliquam leo quis elit volutpat at gravida l', '2012-06-24', 'knsi2006[sholiq]2.pdf', '2', 14),
(3, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam laoreet risus, a ullamcorper justo cursus ut. Donec aliquam leo quis elit volutpat at gravida l', '2012-06-24', 'korespondensi-bahasa-indonesia2.pdf', '2', 8),
(4, 8, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'knsi2006[sholiq]4.pdf', '1', 14),
(5, 8, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'knsi2006[sholiq]5.pdf', '2', 6),
(6, 8, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'knsi2006[sholiq]6.pdf', '1', 7),
(7, 8, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'knsi2006[sholiq]7.pdf', '1', 7),
(8, 8, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'PEDOMAN16-SURAT-MENYURAT1.pdf', '1', 8),
(9, 9, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'knsi2006[sholiq]9.pdf', '1', 9),
(10, 9, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'knsi2006[sholiq]10.pdf', '1', 6),
(11, 9, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'knsi2006[sholiq]11.pdf', '1', 7),
(12, 9, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', '2012-06-25', 'knsi2006[sholiq]12.pdf', '1', 8),
(13, 10, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', '2012-06-27', '10.1_.1_.210_.8067_1.pdf', '1', 13),
(14, 10, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', '2012-06-27', '10.1_.1_.210_.8067_2.pdf', '1', 9),
(15, 10, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', '2012-06-27', '36.pdf', '1', 8),
(16, 11, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', '2012-06-27', '10.1_.1_.210_.8067_3.pdf', '2', 14),
(17, 11, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', '2012-06-27', '2171.pdf', '1', 6),
(18, 11, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', '2012-06-27', '361.pdf', '1', 9),
(19, 11, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', '2012-06-27', '09_Administrasi_(TATA_PERSURATAN_DAN_KEARSIPAN)1.pdf', '1', 13);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `file_surat_masuk`
--

INSERT INTO `file_surat_masuk` (`FILE_SURAT_MASUK_ID`, `SURAT_MASUK_ID`, `NAMA_FILE`, `PATH_FILE`) VALUES
(3, 5, 'PEDOMAN16-SURAT-MENYURAT.pdf', 'uploads/surat/PEDOMAN16-SURAT-MENYURAT.pdf'),
(4, 6, 'korespondensi-bahasa-indonesia.pdf', 'uploads/surat/korespondensi-bahasa-indonesia.pdf'),
(5, 7, 'korespondensi-bahasa-indonesia1.pdf', 'uploads/surat/korespondensi-bahasa-indonesia1.pdf'),
(6, 8, 'knsi2006[sholiq]3.pdf', 'uploads/surat/knsi2006[sholiq]3.pdf'),
(7, 9, 'knsi2006[sholiq]8.pdf', 'uploads/surat/knsi2006[sholiq]8.pdf'),
(8, 10, '10.1_.1_.210_.8067_.pdf', 'uploads/surat/10.1_.1_.210_.8067_.pdf'),
(9, 11, '217.pdf', 'uploads/surat/217.pdf');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2012-05-05 12:55:16', '2011-02-16 07:55:31', '0054006500720069006D00610020006B0061007300690068002E002000420069006100790061002000480061007200690061006E00200052007000390039002F006800610072006900200075006E00740075006B0020006D0065006E0069006B006D006100740069002000700072006F006700720061006D000D000A005400610072006900660020004500640061006E002C00200052007000390039002F006D0065006E006900740020006B0065002000730065006D007500610020006F00700065007200610074006F0072002C002000740065006C0061006800200062006500720068006100730069006C0020006B0061006D0069000D000A006B0065006E0061006B0061006E002000640061007200690020006E006F006D006F007200200061006E00640061002E00200049006E0066006F0020003200300030', '3', 'Default_No_Compression', '', '+628964011092', -1, 'Terima kasih. Biaya Harian Rp99/hari untuk menikmati program\r\nTarif Edan, Rp99/menit ke semua operator, telah berhasil kami\r\nkenakan dari nomor anda. Info 200', 1, '', 'false'),
('2012-05-05 12:55:16', '2011-02-21 10:40:16', '004B0061006D0075002000740065006C00610068002000690073006900200075006C0061006E006700200052007000200035003000300030002E002000500075006C007300610020006B0061006D007500200052007000200037003800300030002C00200061006B00740069006600200073002E0064002000300031002F00300034002F0032003000310031002E0020004400700074006B0061006E00200074006100620075006E00670061006E00200052007000350030006A0074002E0020004B006500740069006B0020005900410020006B006900720069006D0020006B006500200039003900380037', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Kamu telah isi ulang Rp 5000. Pulsa kamu Rp 7800, aktif s.d 01/04/2011. Dptkan tabungan Rp50jt. Ketik YA kirim ke 9987', 2, '', 'false'),
('2012-05-05 12:55:16', '2011-02-28 15:07:09', '00500061006B0065007400200069006E007400650072006E006500740020003500300030004D006200200028005200700032003900720062002F0062006C006E002C00200062006C006D002000500050004E002900200061006B0061006E00200064006900700065007200700061006E006A0061006E006700200035002000680061007200690020006C006100670069002E002000550074006B0020007400650074006100700020006D0065006E0069006B006D006100740069006E00790061002C002000700061007300740069006B0061006E0020006B0061006D00750020006D0065006D0069006C0069006B0069002000700075006C00730061002F006B00720065006400690074002000630075006B00750070002E', '234', 'Default_No_Compression', '', '+628964011092', -1, 'Paket internet 500Mb (Rp29rb/bln, blm PPN) akan diperpanjang 5 hari lagi. Utk tetap menikmatinya, pastikan kamu memiliki pulsa/kredit cukup.', 3, '', 'false'),
('2012-05-05 12:55:16', '2011-05-06 09:33:48', '00530065006C0061006D0061007400210020004B0061006D00750020006D0065006E006400700074006B0061006E0020004700520041005400490053002000310030004D0042002E0020004E0069006B006D0061007400690020006800610072006900200069006E006900200073002E006400200070006B002000320033002E00350039002E0020004E0069006B006D0061007400690020006A0067002000700061006B00650074002000700065006E00610077006100720061006E00200069006E007400650072006E006500740020007400650072006200610069006B0020006C00610069006E006E007900610020006400610072006900200041005800490053002000640067006E0020006D0065006E0065006C0070006F006E0020002A003100320033002A00320023002E00200049006E0066006F003800330038', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Selamat! Kamu mendptkan GRATIS 10MB. Nikmati hari ini s.d pk 23.59. Nikmati jg paket penawaran internet terbaik lainnya dari AXIS dgn menelpon *123*2#. Info838', 4, '', 'false'),
('2012-05-05 12:55:16', '2011-05-06 17:58:02', '00530065006C0061006D0061007400210020004B0061006D00750020006D0065006E006400700074006B0061006E0020004700520041005400490053002000310030004D0042002E0020004E0069006B006D0061007400690020006800610072006900200069006E006900200073002E006400200070006B002000320033002E00350039002E0020004E0069006B006D0061007400690020006A0067002000700061006B00650074002000700065006E00610077006100720061006E00200069006E007400650072006E006500740020007400650072006200610069006B0020006C00610069006E006E007900610020006400610072006900200041005800490053002000640067006E0020006D0065006E0065006C0070006F006E0020002A003100320033002A00320023002E00200049006E0066006F003800330038', 'AXIS', 'Default_No_Compression', '', '+628315000032', -1, 'Selamat! Kamu mendptkan GRATIS 10MB. Nikmati hari ini s.d pk 23.59. Nikmati jg paket penawaran internet terbaik lainnya dari AXIS dgn menelpon *123*2#. Info838', 5, '', 'false'),
('2012-05-20 04:14:55', '2012-05-12 18:59:49', '0041006E006400610020006D00730068002000740065007200640061006600740061007200200064006C006D002000700061006B00650074002000620075006E0064006C0069006E006700200033002000620075006C0061006E002E005300610061007400200069006E006900200041006E006400610020006D0065006D006100730075006B0069002000620075006C0061006E0020006B0065002000330020006400610072006900200033002000620075006C0061006E002E0045007800700069007200650064002000740067006C002000310031002D00300036002D00320030003100320020006A0061006D002000320034003A00300030002E0049006E0066006F0020007700770077002E0078006C002E0063006F002E00690064', '86801', 'Default_No_Compression', '', '+62818445009', -1, 'Anda msh terdaftar dlm paket bundling 3 bulan.Saat ini Anda memasuki bulan ke 3 dari 3 bulan.Expired tgl 11-06-2012 jam 24:00.Info www.xl.co.id', 6, '', 'false');

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
(3, 'Surat pemecatan', 2),
(4, 'Surat perintah', 1),
(5, 'Surat Ijin', 1),
(6, 'Surat yang belum ada', 1),
(7, 'surat keterangan', 1),
(8, '1', 1),
(9, 'Surat dinas kunjungan kerja', 1),
(10, 'Surat Edaran', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `komentar_disposisi`
--

INSERT INTO `komentar_disposisi` (`KOMENTAR_DISPOSISI_ID`, `DISPOSISI_ID`, `DINAS_ID`, `TGL_KOMENTAR`, `KOMENTAR_DISPOSISI`) VALUES
(1, 1, 2, '2012-06-24 10:15:33', 'tolong ya teman.. hehehe'),
(2, 1, 11, '2012-06-24 10:53:42', 'iya pak akan saya bantu.. hehehe'),
(3, 1, 11, '2012-06-24 10:58:54', 'o iya pak. ini saya harus ngapain ya pak ?'),
(4, 1, 11, '2012-06-24 11:00:01', 'o iya pak makasih'),
(5, 2, 7, '2012-06-24 19:25:51', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam laoreet risus, a ullamcorper justo cursus ut. Donec aliquam leo quis elit volutpat at gravida l');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `komentar_surat`
--

INSERT INTO `komentar_surat` (`KOMENTAR_SURAT_ID`, `SURAT_MASUK_ID`, `KOMENTATOR`, `KOMENTAR`) VALUES
(1, 5, 1, 'contoh komentar'),
(2, 6, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam laoreet risus, a ullamcorper justo cursus ut. Donec aliquam leo quis elit volutpat at gravida l');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `log_terima_surat`
--

INSERT INTO `log_terima_surat` (`LOG_TERIMA_SURAT_ID`, `SURAT_MASUK_ID`, `PENERIMA`) VALUES
(2, 5, 11),
(3, 5, 2),
(4, 6, 7),
(5, 7, 14),
(6, 7, 4),
(7, 8, 16),
(8, 8, 2);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `outbox`
--

INSERT INTO `outbox` (`UpdatedInDB`, `InsertIntoDB`, `SendingDateTime`, `Text`, `DestinationNumber`, `Coding`, `UDH`, `Class`, `TextDecoded`, `ID`, `MultiPart`, `RelativeValidity`, `SenderID`, `SendingTimeOut`, `DeliveryReport`, `CreatorID`) VALUES
('2012-06-24 06:59:52', '2012-06-24 01:59:52', '2012-06-24 01:59:52', NULL, '087740225564', 'Default_No_Compression', NULL, -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 3, 'false', -1, NULL, '0000-00-00 00:00:00', 'default', ' '),
('2012-06-24 07:26:59', '2012-06-24 02:26:59', '2012-06-24 02:26:59', NULL, '087740225564', 'Default_No_Compression', NULL, -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 4, 'false', -1, NULL, '0000-00-00 00:00:00', 'default', ' '),
('2012-06-24 17:03:24', '2012-06-24 12:03:24', '2012-06-24 12:03:24', NULL, '387302965479308', 'Default_No_Compression', NULL, -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 5, 'false', -1, NULL, '0000-00-00 00:00:00', 'default', ' '),
('2012-06-24 18:55:31', '2012-06-24 13:55:31', '2012-06-24 13:55:31', NULL, '085783746372872', 'Default_No_Compression', NULL, -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 6, 'false', -1, NULL, '0000-00-00 00:00:00', 'default', ' '),
('2012-06-25 09:52:09', '2012-06-25 04:52:09', '2012-06-25 04:52:09', NULL, '387302965479308', 'Default_No_Compression', NULL, -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 7, 'false', -1, NULL, '0000-00-00 00:00:00', 'default', ' '),
('2012-06-25 18:28:21', '2012-06-25 13:28:21', '2012-06-25 13:28:21', NULL, '09876762867836', 'Default_No_Compression', NULL, -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 8, 'false', -1, NULL, '0000-00-00 00:00:00', 'default', ' '),
('2012-06-27 07:10:06', '2012-06-27 02:10:06', '2012-06-27 02:10:06', NULL, '018291882839493', 'Default_No_Compression', NULL, -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 9, 'false', -1, NULL, '0000-00-00 00:00:00', 'default', ' '),
('2012-06-27 07:38:22', '2012-06-27 02:38:22', '2012-06-27 02:38:22', NULL, '387302965479308', 'Default_No_Compression', NULL, -1, 'Terdapat surat untuk Anda. Mohon segera diperiksa. Terimakasih', 10, 'false', -1, NULL, '0000-00-00 00:00:00', 'default', ' ');

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
('', '2012-05-21 23:07:52', '2012-05-21 23:05:39', '2012-05-21 23:08:02', 'yes', 'yes', '864593004053236', 'Gammu 1.24.92, Windows Server 2007, GCC 4.3, MinGW 3.15', 100, 75, 0, 0);

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
('2012-05-05 14:58:10', '2012-05-05 09:58:04', '2012-05-05 14:58:10', NULL, '0069006E006900200075006E00740075006B0020006100730069007300740065006E', '087740225564', 'Default_No_Compression', '', '+6281100000', -1, 'ini untuk asisten', 1, '', 1, 'SendingOKNoReport', -1, 11, 255, ' '),
('2012-05-05 14:58:12', '2012-05-05 09:58:04', '2012-05-05 14:58:12', NULL, '0069006E006900200075006E00740075006B002000730065006B0072006500740061007200690073', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini untuk sekretaris', 2, '', 1, 'SendingOKNoReport', -1, 12, 255, ' '),
('2012-05-05 17:14:19', '2012-05-05 12:13:55', '2012-05-05 17:14:19', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E00610073002000420061006700690061006E00200054006100740061002000500065006D006500720069006E0074006100680061006E', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas Bagian Tata Pemerintahan', 3, '', 1, 'SendingError', -1, -1, 255, ' '),
('2012-05-05 17:16:02', '2012-05-05 12:15:42', '2012-05-05 17:16:02', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E00610073002000420061006700690061006E00200054006100740061002000500065006D006500720069006E0074006100680061006E', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas Bagian Tata Pemerintahan', 4, '', 1, 'SendingError', -1, -1, 255, ' '),
('2012-05-05 17:18:51', '2012-05-05 12:18:33', '2012-05-05 17:18:51', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E00610073002000640069006E0061007300200070006500720069006B0061006E0061006E', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas dinas perikanan', 5, '', 1, 'SendingError', -1, -1, 255, ' '),
('2012-05-05 17:25:40', '2012-05-05 12:25:16', '2012-05-05 17:25:40', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E006100730020', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas ', 6, '', 1, 'SendingError', -1, -1, 255, ' '),
('2012-05-05 18:27:39', '2012-05-05 13:27:34', '2012-05-05 18:27:39', NULL, '0069006E006900200070006500730061006E00200075006E00740075006B002000640069006E006100730020', '085731139293', 'Default_No_Compression', '', '+6281100000', -1, 'ini pesan untuk dinas ', 7, '', 1, 'SendingOKNoReport', -1, 17, 255, ' ');

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
  `DATE_CREATED` datetime default NULL,
  `DATE_EDITED` datetime default NULL,
  `CATATAN_TERIMA_SURAT_MASUK` text collate latin1_general_ci,
  `KIRIM` decimal(1,0) NOT NULL default '0',
  PRIMARY KEY  (`SURAT_MASUK_ID`),
  KEY `INSTANSI_ID` (`INSTANSI_ID`),
  KEY `JENIS_SURAT_ID` (`JENIS_SURAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`SURAT_MASUK_ID`, `INSTANSI_ID`, `JENIS_SURAT_ID`, `NOMOR`, `TGL_TERIMA`, `LAMPIRAN`, `KEPADA`, `TGL_SURAT`, `PERIHAL`, `SIFAT`, `DATE_CREATED`, `DATE_EDITED`, `CATATAN_TERIMA_SURAT_MASUK`, `KIRIM`) VALUES
(5, 8, 7, 'SKTLK/B/2954/V/2012/SPKT', '2012-06-13', '1', 2, '2012-06-12', 'keterangan kehilangan', 1, '2012-06-24 09:26:34', NULL, 'Surat kehilangan berlaku sampai dengan : 21 Juni 2012', 2),
(6, 9, 8, '27/N11.8.4/DIN/KP/1.2010', '2012-06-25', '2', 7, '2012-06-19', 'Tindak Lanjut Workshop', 1, '2012-06-24 19:03:06', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam laoreet risus, a ullamcorper justo cursus ut. Donec aliquam leo quis elit volutpat at gravida', 7),
(7, 10, 9, '99/KI/M/7.2011', '2012-06-25', '2', 4, '2012-06-21', 'Kunjungan Kerja Lapangan dan Industri', 1, '2012-06-24 20:55:26', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam laoreet risus, a ullamcorper justo cursus ut. Donec aliquam leo quis elit volutpat at gravida l', 4),
(8, 1, 1, '013/SMK Plt.Jy/XII/2012', '2012-06-25', '2', 7, '2012-04-22', 'Pemberitahuan', 1, '2012-06-25 11:51:36', NULL, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', 7),
(9, 11, 10, '0677/A.A5/SE/2012', '2012-06-26', '2', 5, '2012-06-13', 'PERUBAHAN SURAT EDARAN ', 1, '2012-06-25 20:28:14', NULL, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', 5),
(10, 1, 1, '6132/fdashfdkjas/2002/fadf', '2012-06-27', '2', 6, '2012-06-19', 'tes', 1, '2012-06-27 09:09:54', NULL, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', 6),
(11, 1, 1, '1234/sdtrf/34/2001/fjthyj', '2012-06-27', '3', 7, '2012-06-18', 'tes 2', 1, '2012-06-27 09:37:45', NULL, 'Lorem ipsum dolar sit amet vitae error aut quia aut nemo sed sed, beatae inventore aut ratione eaque ab nemo enim voluptas rem beatae doloremque illo nemo quia fugit ab quia. Quiased totam ut rem inventore accusantium sit ipsam ratione sit aperiam ab voluptatem odit quasi quia sunt sed dolores omnis aspernatur architecto unde fugit fugit sit inventore ', 7);

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
(6, 8, 2, 'asisten_1', '81dc9bdb52d04dc20036dbd8313ed055', 'asisten I', 'asisten1@gmail.com', '087740225564', 1, 2),
(7, 1, 3, 'asisten_2', '81dc9bdb52d04dc20036dbd8313ed055', 'asisten II', 'asisten2@gmail.com', '085731139293', 1, 3),
(8, 7, 4, 'asisten_3', '81dc9bdb52d04dc20036dbd8313ed055', 'asisten III', 'asisten3@gmail.com', '085783746372872', 1, 4),
(9, 6, 5, 'sekretaris', '81dc9bdb52d04dc20036dbd8313ed055', 'sekretaris daerah', 'sekretaris@gmail.com', '09876762867836', 1, 5),
(13, 3, 6, 'wabup', '81dc9bdb52d04dc20036dbd8313ed055', 'wakil bupati', 'wabup@gmail.com', '018291882839493', 1, 6),
(14, 6, 7, 'bupati', '81dc9bdb52d04dc20036dbd8313ed055', 'bupati', 'bupati@gmail.com', '387302965479308', 1, 7),
(15, 5, 16, 'dinas1', '81dc9bdb52d04dc20036dbd8313ed055', 'dinas pendapatan', 'dinas1@gmail.com', '085731139293', 1, 8),
(16, 5, 11, 'dinas2', '81dc9bdb52d04dc20036dbd8313ed055', 'dinas kesehatan', 'dinkes@gmail.com', '085731139293', 1, 8),
(17, 1, 14, 'dinas3', '81dc9bdb52d04dc20036dbd8313ed055', 'dinas pekerjaan umum', 'dpu@gmail.com', '085731139293', 1, 8);

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
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`JABATAN_ID`) REFERENCES `jabatan` (`JABATAN_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`DINAS_ID`) REFERENCES `dinas` (`DINAS_ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
