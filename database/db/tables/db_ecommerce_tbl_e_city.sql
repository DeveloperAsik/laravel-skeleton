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
-- Table structure for table `tbl_e_city`
--

DROP TABLE IF EXISTS `tbl_e_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_e_city` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `province_id` int(32) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(32) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_e_city`
--

LOCK TABLES `tbl_e_city` WRITE;
/*!40000 ALTER TABLE `tbl_e_city` DISABLE KEYS */;
INSERT INTO `tbl_e_city` VALUES (1,'Kabupaten Administrasi Kepulauan Seribu','-',13,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'Kota Administrasi Jakarta Barat','-',13,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,'Kota Administrasi Jakarta Pusat','-',13,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(4,'Kota Administrasi Jakarta Selatan','-',13,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(5,'Kota Administrasi Jakarta Timur','-',13,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(6,'Kota Administrasi Jakarta Utara','-',13,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(7,'Kabupaten Bandung','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(8,'Kabupaten Bandung Barat','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(9,'Kabupaten Bekasi','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(10,'Kabupaten Bogor','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(11,'Kabupaten Ciamis','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(12,'Kabupaten Cianjur','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(13,'Kabupaten Cirebon','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(14,'Kabupaten Garut','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(15,'Kabupaten Indramayu','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(16,'Kabupaten Karawang','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(17,'Kabupaten Kuningan','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(18,'Kabupaten Majalengka','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(19,'Kabupaten Pangandaran','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(20,'Kabupaten Purwakarta','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(21,'Kabupaten Subang','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(22,'Kabupaten Sukabumi','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(23,'Kabupaten Sumedang','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(24,'Kabupaten Tasikmalaya','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(25,'Kota Bandung','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(26,'Kota Banjar','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(27,'Kota Bekasi','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(28,'Kota Bogor','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(29,'Kota Cimahi','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(30,'Kota Cirebon','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(31,'Kota Depok','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(32,'Kota Sukabumi','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(33,'Kota Tasikmalaya','-',28,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_e_city` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-25  0:50:52
