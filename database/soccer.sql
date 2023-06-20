/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 10.4.24-MariaDB : Database - soccer
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`soccer` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `soccer`;

/*Table structure for table `klasemen` */

DROP TABLE IF EXISTS `klasemen`;

CREATE TABLE `klasemen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `main` int(10) DEFAULT NULL,
  `menang` int(10) DEFAULT NULL,
  `seri` int(10) DEFAULT NULL,
  `kalah` int(10) DEFAULT NULL,
  `gm` int(10) DEFAULT NULL,
  `gk` int(10) DEFAULT NULL,
  `point` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `klasemen` */

insert  into `klasemen`(`id`,`nama`,`kota`,`main`,`menang`,`seri`,`kalah`,`gm`,`gk`,`point`) values 
(1,'Persija','Jakarta',2,1,0,1,4,3,3),
(2,'Persib','Bandung',3,2,0,1,5,5,6),
(3,'Arema','Malang',2,0,0,2,1,5,0);

/*Table structure for table `match` */

DROP TABLE IF EXISTS `match`;

CREATE TABLE `match` (
  `id_match` int(10) NOT NULL AUTO_INCREMENT,
  `pertandingan` varchar(255) DEFAULT NULL,
  `skor_klub1` int(10) DEFAULT NULL,
  `skor_klub2` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_match`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4;

/*Data for the table `match` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
