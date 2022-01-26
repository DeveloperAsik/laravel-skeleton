-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: db_ecommerce
-- ------------------------------------------------------
-- Server version	5.7.35-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_e_districts`
--

DROP TABLE IF EXISTS `tbl_e_districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_e_districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `city_id` int(32) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(32) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_e_districts`
--

LOCK TABLES `tbl_e_districts` WRITE;
/*!40000 ALTER TABLE `tbl_e_districts` DISABLE KEYS */;
INSERT INTO `tbl_e_districts` VALUES (1,'Kepulauan Seribu Utara','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'Kepulauan Seribu Selatan','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,'Cengkareng','-',2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(4,'Grogol Petamburan','-',2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(5,'Taman Sari','-',2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(6,'Tambora','-',2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(7,'Kebon Jeruk','-',2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(8,'Kalideres','-',2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(9,'Palmerah','-',2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(10,'Kembangan','-',2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(11,'Cempaka Putih','-',3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(12,'Gambir','-',3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(13,'Johar Baru','-',3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(14,'Kemayoran','-',3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(15,'Menteng','-',3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(16,'Sawah Besar','-',3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(17,'Senen','-',3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(18,'Tanah Abang','-',3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(19,'Cilandak','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(20,'Jagakarsa','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(21,'Kebayoran Baru','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(22,'Kebayoran Lama','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(23,'Mampang Prapatan','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(24,'Pancoran','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(25,'Pasar Minggu','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(26,'Pesanggrahan','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(27,'Setiabudi','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(28,'Tebet','-',4,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(29,'Cakung','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(30,'Cipayung','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(31,'Ciracas','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(32,'Duren Sawit','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(33,'Jatinegara','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(34,'Kramat Jati','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(35,'Makasar','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(36,'Matraman','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(37,'Pasar Rebo','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(38,'Pulo Gadung','-',5,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(39,'Cilincing','-',6,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(40,'Kelapa Gading','-',6,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(41,'Koja','-',6,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(42,'Pademangan','-',6,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(43,'Penjaringan','-',6,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(44,'Tanjung Priok','-',6,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_e_districts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-25  0:50:53
