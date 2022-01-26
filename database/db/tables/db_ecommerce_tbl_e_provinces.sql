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
-- Table structure for table `tbl_e_provinces`
--

DROP TABLE IF EXISTS `tbl_e_provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_e_provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `country_id` int(32) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(32) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_e_provinces`
--

LOCK TABLES `tbl_e_provinces` WRITE;
/*!40000 ALTER TABLE `tbl_e_provinces` DISABLE KEYS */;
INSERT INTO `tbl_e_provinces` VALUES (1,'Aceh','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'Bali','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,'Kepulauan Bangka Belitung','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(4,'Banten','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(5,'Bengkulu','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(6,'Jawa Tengah','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(7,'Kalimantan Tengah','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(8,'Kalimantan Timur','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(9,'Sulawesi Tengah','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(10,'Jawa Timur','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(11,'Nusa Tenggara Timur','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(12,'Gorontalo','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(13,'DKI Jakarta','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(14,'Jambi','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(15,'Lampung','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(16,'Maluku','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(17,'Kalimantan Utara','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(18,'Maluku Utara','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(19,'Sulawesi Utara','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(20,'Sumatera Utara','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(21,'Papua','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(22,'Riau','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(23,'Kepulauan Riau','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(24,'Sulawesi Tenggara','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(25,'Kalimantan Selatan','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(26,'Sulawesi Selatan','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(27,'Sumatera Selatan','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(28,'Jawa Barat','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(29,'Kalimantan Barat','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(30,'Nusa Tenggara Barat','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(31,'Papua Barat','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(32,'Sulawesi Barat','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(33,'Sumatera Barat','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(34,'Daerah Istimewa Yogyakarta','-',1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_e_provinces` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-25  0:50:54
