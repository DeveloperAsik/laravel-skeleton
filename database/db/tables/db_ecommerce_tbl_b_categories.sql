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
-- Table structure for table `tbl_b_categories`
--

DROP TABLE IF EXISTS `tbl_b_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_b_categories` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `level` int(2) DEFAULT NULL,
  `parent_id` int(32) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(32) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_b_categories`
--

LOCK TABLES `tbl_b_categories` WRITE;
/*!40000 ALTER TABLE `tbl_b_categories` DISABLE KEYS */;
INSERT INTO `tbl_b_categories` VALUES (1,'Clothes','-',1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'Accessoris','-',1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,'Bags','-',1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(4,'Jewerly','-',1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(5,'Shoes','-',1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(6,'Underwearer','-',1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(7,'Dress','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(8,'Trousers','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(9,'Cardigan','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(10,'Blouse','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(11,'Jumpsuit','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(12,'Jeans','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(13,'Coat','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(14,'Jacket','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(15,'Skirt','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(16,'Sweater','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(17,'Shirt','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(18,'Suit','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(19,'Hoodie','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(20,'Singlet','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(21,'Polo Shirt','-',2,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(22,'Ring','-',2,2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(23,'Belt','-',2,2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(24,'Necklace','-',2,2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(25,'Bracelet','-',2,2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(26,'Pendant','-',2,2,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(27,'Suitcase','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(28,'Backpack','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(29,'Duffel','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(30,'Briefcase','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(31,'Tote Bag','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(32,'Bucket','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(33,'Messenger','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(34,'Shopper','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(35,'Baguette','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(36,'Barrel','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(37,'Pouch','-',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(38,'Parachute','-',3,16,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(39,'Woll','-',3,16,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_b_categories` ENABLE KEYS */;
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
