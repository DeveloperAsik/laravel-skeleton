-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: db_bibit_cms
-- ------------------------------------------------------
-- Server version	5.7.36-log

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
-- Table structure for table `tbl_menu_a_menus`
--

DROP TABLE IF EXISTS `tbl_menu_a_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_menu_a_menus` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(32) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `badge_value` varchar(255) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `rank` tinyint(1) DEFAULT NULL,
  `parent_id` int(32) DEFAULT NULL,
  `module_id` int(32) DEFAULT NULL,
  `is_badge` tinyint(1) DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_by` int(32) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu_a_menus`
--

LOCK TABLES `tbl_menu_a_menus` WRITE;
/*!40000 ALTER TABLE `tbl_menu_a_menus` DISABLE KEYS */;
INSERT INTO `tbl_menu_a_menus` VALUES (1,'Blog','nav-icon fas fa-edit','#','badge badge-info right','total_posts',1,1,0,3,1,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(2,'Create','far fa-circle nav-icon','/blog/create',NULL,NULL,2,1,1,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(3,'View','far fa-circle nav-icon','/blog/view',NULL,NULL,2,2,1,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(4,'Archives','far fa-circle nav-icon','/blog/archives',NULL,NULL,2,3,1,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(5,'News','nav-icon fas fa-book','#','badge badge-info right','total_news',1,2,0,3,1,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(6,'Create','far fa-circle nav-icon','/news/create',NULL,NULL,2,1,5,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(7,'View','far fa-circle nav-icon','/news/view',NULL,NULL,2,2,5,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(8,'Archives','far fa-circle nav-icon','/news/archives',NULL,NULL,2,3,5,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(9,'Shop','nav-icon fas fa-shopping-cart','#','badge badge-info right','total_orders',1,3,0,3,1,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(10,'Order','far fa-circle nav-icon','#',NULL,NULL,2,1,9,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(11,'Report','far fa-circle nav-icon','#',NULL,NULL,2,2,9,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(12,'Options','far fa-circle nav-icon','#',NULL,NULL,2,3,9,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(13,'Products','far fa-circle nav-icon','#',NULL,NULL,3,1,12,3,1,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(14,'Categories','far fa-circle nav-icon','#',NULL,NULL,3,2,12,3,1,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(15,'Brands','far fa-circle nav-icon','#',NULL,NULL,3,3,12,3,1,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(16,'Prefferences','','',NULL,NULL,1,4,0,3,0,0,1,1,'2021-03-23 18:11:54','2021-03-23 18:11:54'),(17,'Settings','','',NULL,NULL,1,5,0,3,0,0,1,2,'2022-01-01 14:40:15','2022-01-01 14:40:15'),(18,'Users','','',NULL,NULL,2,1,17,3,0,0,1,2,'2022-01-01 15:23:04','2022-01-01 15:23:04'),(19,'Groups','','',NULL,NULL,2,2,17,3,0,0,1,2,'2022-01-01 15:23:55','2022-01-01 15:23:55'),(20,'Permissions','','',NULL,NULL,2,3,17,3,0,0,1,2,'2022-01-01 15:24:30','2022-01-01 15:24:30'),(21,'Group Permissions','','',NULL,NULL,2,4,17,3,0,0,1,2,'2022-01-01 15:29:24','2022-01-01 15:29:24'),(22,'Menu','','',NULL,NULL,2,1,16,3,0,0,1,2,'2022-01-01 15:42:47','2022-01-01 15:42:47'),(23,'Meta','','',NULL,NULL,2,2,16,3,0,0,1,2,'2022-01-01 15:42:48','2022-01-01 15:42:48'),(24,'View','','',NULL,NULL,3,1,22,3,0,0,1,2,'2022-01-01 15:47:30','2022-01-01 15:47:30');
/*!40000 ALTER TABLE `tbl_menu_a_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_a_devices`
--

DROP TABLE IF EXISTS `tbl_user_a_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_a_devices` (
  `id` int(32) NOT NULL,
  `fraud_scan` text NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `user_id` int(32) NOT NULL,
  `is_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `is_tablet` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(32) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_a_devices`
--

LOCK TABLES `tbl_user_a_devices` WRITE;
/*!40000 ALTER TABLE `tbl_user_a_devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_a_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_a_groups`
--

DROP TABLE IF EXISTS `tbl_user_a_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_a_groups` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(32) NOT NULL,
  `updated_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_a_groups`
--

LOCK TABLES `tbl_user_a_groups` WRITE;
/*!40000 ALTER TABLE `tbl_user_a_groups` DISABLE KEYS */;
INSERT INTO `tbl_user_a_groups` VALUES (1,'system','-',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'mobile','-',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,'administrator','-',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(4,'guest','-',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_user_a_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_a_modules`
--

DROP TABLE IF EXISTS `tbl_user_a_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_a_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `created_by` int(32) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_a_modules`
--

LOCK TABLES `tbl_user_a_modules` WRITE;
/*!40000 ALTER TABLE `tbl_user_a_modules` DISABLE KEYS */;
INSERT INTO `tbl_user_a_modules` VALUES (1,'api','-',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'frontend','-',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,'backend','-',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_user_a_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_a_permissions`
--

DROP TABLE IF EXISTS `tbl_user_a_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_a_permissions` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `url` text,
  `route` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `description` text,
  `module_id` int(32) DEFAULT NULL,
  `is_generated_view` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '0',
  `created_by` int(32) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_a_permissions`
--

LOCK TABLES `tbl_user_a_permissions` WRITE;
/*!40000 ALTER TABLE `tbl_user_a_permissions` DISABLE KEYS */;
INSERT INTO `tbl_user_a_permissions` VALUES (1,'/','/frontend','UserController','index','-',2,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'/api','/api','UserController','index','-',1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,'/extraweb','/backend','AuthController','login','-',3,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(4,'/extraweb/dashboard','/backend','DashboardController','index','-',3,1,1,2,'2021-12-13 14:52:43','2021-12-13 14:52:43');
/*!40000 ALTER TABLE `tbl_user_a_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_a_profiles`
--

DROP TABLE IF EXISTS `tbl_user_a_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_a_profiles` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `address` text,
  `lat` varchar(128) DEFAULT NULL,
  `lng` varchar(128) DEFAULT NULL,
  `zoom` int(10) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `last_education` varchar(255) DEFAULT NULL,
  `last_education_institution` varchar(255) DEFAULT NULL,
  `skill` text,
  `notes` text,
  `description` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(32) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_a_profiles`
--

LOCK TABLES `tbl_user_a_profiles` WRITE;
/*!40000 ALTER TABLE `tbl_user_a_profiles` DISABLE KEYS */;
INSERT INTO `tbl_user_a_profiles` VALUES (1,'Bogor','-','-',4,'@arifTalk','@arifTalk','@arifTalk','@arifTalk','/__media/images/user_profiles/IMG_20200215_134428.jpg','Bachelor degree','Universitas Pakuan','<p>UI Design<br>Coding<br>Javascript<br>&nbsp;PHP<br>Node.js</p>','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.','-',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_user_a_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_a_users`
--

DROP TABLE IF EXISTS `tbl_user_a_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_a_users` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `code` varchar(16) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(155) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(32) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_a_users`
--

LOCK TABLES `tbl_user_a_users` WRITE;
/*!40000 ALTER TABLE `tbl_user_a_users` DISABLE KEYS */;
INSERT INTO `tbl_user_a_users` VALUES (1,'001','sys','system','website','system.web@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$bGhKbC8wdHBJSEdUQmdIbg$uyEi0zIZ+nmwlLFc2UiNvfr5X/mJjuknCATzpqe7nDs',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'002','arifa','arif','firmansyah','ariffirmansyah.begin@gmail.com','$argon2id$v=19$m=65536,t=4,p=1$bGhKbC8wdHBJSEdUQmdIbg$uyEi0zIZ+nmwlLFc2UiNvfr5X/mJjuknCATzpqe7nDs',1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_user_a_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_b_group_permissions`
--

DROP TABLE IF EXISTS `tbl_user_b_group_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_b_group_permissions` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `group_id` int(32) NOT NULL,
  `permission_id` int(32) NOT NULL,
  `is_allowed` tinyint(1) NOT NULL DEFAULT '0',
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(32) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT '2020-03-15 16:53:09',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_b_group_permissions`
--

LOCK TABLES `tbl_user_b_group_permissions` WRITE;
/*!40000 ALTER TABLE `tbl_user_b_group_permissions` DISABLE KEYS */;
INSERT INTO `tbl_user_b_group_permissions` VALUES (1,1,1,1,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,1,2,1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,1,3,1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(4,3,1,1,1,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(5,3,2,1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(6,3,3,1,0,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(7,3,4,1,1,1,2,'2021-12-13 14:52:43','2021-12-13 14:52:43'),(8,3,4,0,1,1,2,'2021-12-13 15:04:18','2021-12-13 15:04:18');
/*!40000 ALTER TABLE `tbl_user_b_group_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_b_user_groups`
--

DROP TABLE IF EXISTS `tbl_user_b_user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_b_user_groups` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` int(32) NOT NULL,
  `group_id` int(32) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(32) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_b_user_groups`
--

LOCK TABLES `tbl_user_b_user_groups` WRITE;
/*!40000 ALTER TABLE `tbl_user_b_user_groups` DISABLE KEYS */;
INSERT INTO `tbl_user_b_user_groups` VALUES (1,2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_user_b_user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_b_user_permissions`
--

DROP TABLE IF EXISTS `tbl_user_b_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_b_user_permissions` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` int(32) NOT NULL,
  `permission_id` int(32) NOT NULL,
  `is_allowed` tinyint(1) NOT NULL DEFAULT '0',
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(32) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT '2020-03-15 16:53:09',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_b_user_permissions`
--

LOCK TABLES `tbl_user_b_user_permissions` WRITE;
/*!40000 ALTER TABLE `tbl_user_b_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_b_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_c_extraweb_sidebars`
--

DROP TABLE IF EXISTS `tbl_user_c_extraweb_sidebars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_c_extraweb_sidebars` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `is_badge` tinyint(1) NOT NULL,
  `badge` text,
  `badge_id` varchar(255) DEFAULT NULL,
  `badge_value` varchar(255) DEFAULT NULL,
  `parent_id` int(32) NOT NULL,
  `group_id` int(32) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(32) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_c_extraweb_sidebars`
--

LOCK TABLES `tbl_user_c_extraweb_sidebars` WRITE;
/*!40000 ALTER TABLE `tbl_user_c_extraweb_sidebars` DISABLE KEYS */;
INSERT INTO `tbl_user_c_extraweb_sidebars` VALUES (1,'Blog','#','<i class=\"nav-icon fas fa-edit\"></i>',1,1,'badge badge-info right','total_posts','',0,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(2,'News','#','<i class=\"nav-icon fas fa-book\"></i>',1,1,'badge badge-info right','total_news','',0,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(3,'Shop','#','<i class=\"nav-icon fas fa-shopping-cart\"></i>',1,1,'badge badge-info right','total_orders','',0,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(4,'Preferences','#','<i class=\"nav-icon fas fa-cogs\"></i>',1,0,'-','','',0,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(5,'Settings','#','<i class=\"nav-icon fas fa-cogs\"></i>',1,0,'-','','',0,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(6,'Create','/blog/create-new-post','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-','','',1,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(7,'View','/blog/view-post','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-','','',1,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(8,'Archive','/blog/archive-post','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-','','',1,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(9,'Create','/news/create-new-post','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-','','',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(10,'View','/news/view-post','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-','','',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(11,'Archive','/news/archive-post','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-','','',2,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(12,'Blog','#','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-',NULL,NULL,4,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(13,'News','#','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-',NULL,NULL,4,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(14,'Shop','#','<i class=\"far fa-circle nav-icon\"></i>',2,0,'-',NULL,NULL,4,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(15,'User','#','<i class=\"fas fa-users\"></i>',2,0,'-',NULL,NULL,5,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(16,'Group','#','<i class=\"fas fa-users-cog\"></i>',2,0,'-',NULL,NULL,5,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(17,'Permission','#','<i class=\"fas fa-lock\"></i>',2,0,'-',NULL,NULL,5,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(18,'Group permission','#','<i class=\"fas fa-passport\"></i>',2,0,'-',NULL,NULL,5,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(19,'Create','/user/create','<i class=\"fas fa-pen\"></i>',3,0,'-',NULL,NULL,15,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(20,'View','/user/view','<i class=\"fas fa-desktop\"></i>',3,0,'-',NULL,NULL,15,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(21,'Archive','/user/archive','<i class=\"fas fa-archive\"></i>',3,0,'-',NULL,NULL,15,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(22,'Create','/group/create','<i class=\"fas fa-pen\"></i>',3,0,'-',NULL,NULL,16,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(23,'View','/group/view','<i class=\"fas fa-desktop\"></i>',3,0,'-',NULL,NULL,16,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(24,'Archive','/group/archive','<i class=\"fas fa-archive\"></i>',3,0,'-',NULL,NULL,16,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(25,'Create','/permission/create','<i class=\"fas fa-pen\"></i>',3,0,'-',NULL,NULL,17,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(26,'View','/permission/view','<i class=\"fas fa-desktop\"></i>',3,0,'-',NULL,NULL,17,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(27,'Archive','/permission/archive','<i class=\"fas fa-archive\"></i>',3,0,'-',NULL,NULL,17,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(28,'Create','/group-permission/create','<i class=\"fas fa-pen\"></i>',3,0,'-',NULL,NULL,18,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(29,'View','/group-permission/view','<i class=\"fas fa-desktop\"></i>',3,0,'-',NULL,NULL,18,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02'),(30,'Archive','/group-permission/archive','<i class=\"fas fa-archive\"></i>',3,0,'-',NULL,NULL,18,3,1,1,'2021-10-19 21:30:02','2021-10-19 21:30:02');
/*!40000 ALTER TABLE `tbl_user_c_extraweb_sidebars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_c_tokens`
--

DROP TABLE IF EXISTS `tbl_user_c_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_c_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  `token_refreshed` text NOT NULL,
  `expiry_date` datetime NOT NULL,
  `is_logged_in` tinyint(1) NOT NULL DEFAULT '0',
  `is_expiry` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `profile_id` int(32) NOT NULL,
  `group_id` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  `created_by` int(32) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_c_tokens`
--

LOCK TABLES `tbl_user_c_tokens` WRITE;
/*!40000 ALTER TABLE `tbl_user_c_tokens` DISABLE KEYS */;
INSERT INTO `tbl_user_c_tokens` VALUES (7,'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoyLCJncm91cF9pZCI6MywidXNlcl9uYW1lIjoiYXJpZmEiLCJ1c2VyX2VtYWlsIjoiYXJpZmZpcm1hbnN5YWguYmVnaW5AZ21haWwuY29tIiwiY3JlYXRlX2RhdGUiOjE2NDEwNDM5MDcsImV4cGlyZWRfZGF0ZSI6MTY0MTEzMDMwN30.qjn5irv7Bc8QvMyQWARl715vNceh35X1Mfc5UJN5ebA','eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc19yZWZyZXNoIjp0cnVlLCJ1c2VyX2lkIjoyLCJncm91cF9pZCI6MywidXNlcl9uYW1lIjoiYXJpZmEiLCJ1c2VyX2VtYWlsIjoiYXJpZmZpcm1hbnN5YWguYmVnaW5AZ21haWwuY29tIiwiY3JlYXRlX2RhdGUiOjE2NDEwNDM5MDcsImV4cGlyZWRfZGF0ZSI6MTY0MTEzMDMwN30.bwxQ87zTjP9D5xy2TPrZQyHOzrZZLI0M3MGYZTiU1PU','2022-01-02 05:31:55',1,0,1,1,3,2,1,'2022-01-01 13:31:47','2022-01-01 17:31:55');
/*!40000 ALTER TABLE `tbl_user_c_tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-02  0:34:45
