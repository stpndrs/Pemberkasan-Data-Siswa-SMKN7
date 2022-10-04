-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for berkassiswa
CREATE DATABASE IF NOT EXISTS `berkassiswa` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `berkassiswa`;

-- Dumping structure for table berkassiswa.tbberkas_berkas
CREATE TABLE IF NOT EXISTS `tbberkas_berkas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fileKK` varchar(100) NOT NULL,
  `fileAkta` varchar(100) NOT NULL,
  `fileIjazah` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table berkassiswa.tbberkas_berkas: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbberkas_berkas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbberkas_berkas` ENABLE KEYS */;

-- Dumping structure for table berkassiswa.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL,
  `kelas` int(11) NOT NULL DEFAULT '0',
  `login_terakhir` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table berkassiswa.tb_user: 5 rows
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
REPLACE INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `level`, `kelas`, `login_terakhir`) VALUES
	(105, 'RAKEIN NARAYA PUTRA', '0021834761', '7f8e0f5a848549fb05d12b32de7a8309', 4, 0, '2022-10-02 22:18:06'),
	(106, 'AFINA KHOIRI AZIZAH', '0032277549', '875ef7ef98c51237a9fbbf5c50431e89', 4, 0, '2022-10-02 17:04:12'),
	(107, 'AHMAD NAFIQ UDIN', '0046058552', 'a8130527e1059350302b529be6cfadf6', 4, 0, '2020-12-02 07:27:44'),
	(108, 'AJI DANANG KUSUMA', '0034271005', 'a530181561aebab430c70e5e503ac5b6', 4, 0, '2020-12-08 07:29:46'),
	(109, 'ALDY RULANDA FIRMANSYAH', '0028792732', '351a1a85f9ce3933e089452d16fc3271', 4, 0, '2020-11-30 07:09:37');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
