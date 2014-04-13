CREATE DATABASE  IF NOT EXISTS `murvien_cms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `murvien_cms`;
-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: murvien_cms
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.13.10.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(50) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(20) NOT NULL,
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('55baca46570a2670c9b00de7e5bde241','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/33.0.1750.152 Chrome/33.0.1750.15',1397388906,'a:8:{s:9:\"user_data\";s:0:\"\";s:8:\"users_id\";s:1:\"2\";s:7:\"role_id\";s:1:\"4\";s:5:\"email\";s:15:\"parto@gmail.com\";s:8:\"username\";s:5:\"parto\";s:13:\"password_hash\";s:128:\"e8ad17a33da98ac26800eaf55621ecf9ead0e84039da07f17d610bf741bedee4378648bed939395e24f3e326e7ead5108835bcb754a7373245e3fc71b5dc3b8c\";s:12:\"display_name\";s:0:\"\";s:8:\"loggedin\";b:1;}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_categories`
--

DROP TABLE IF EXISTS `cms_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_categories` (
  `categories_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `categories` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `page_type_id` tinyint(3) unsigned NOT NULL,
  `language_id` tinyint(3) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`categories_id`),
  KEY `fk_categories_lang` (`language_id`),
  KEY `fk_categories_dt_type` (`page_type_id`),
  CONSTRAINT `fk_categories_dt_type` FOREIGN KEY (`page_type_id`) REFERENCES `cms_page_type` (`page_type_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_categories_lang` FOREIGN KEY (`language_id`) REFERENCES `cms_language` (`language_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_categories`
--

LOCK TABLES `cms_categories` WRITE;
/*!40000 ALTER TABLE `cms_categories` DISABLE KEYS */;
INSERT INTO `cms_categories` VALUES (1,'quote','quotes in home page',1,1,1),(2,'quote','quotes in home page',1,1,1),(3,'fact','short history about murvien at home page',1,1,1),(4,'fakta','sejarah singkat tentang murvien pada halaman beranda',1,2,1);
/*!40000 ALTER TABLE `cms_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_language`
--

DROP TABLE IF EXISTS `cms_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_language` (
  `language_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(20) NOT NULL DEFAULT 'english',
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_language`
--

LOCK TABLES `cms_language` WRITE;
/*!40000 ALTER TABLE `cms_language` DISABLE KEYS */;
INSERT INTO `cms_language` VALUES (1,'english'),(2,'indonesia');
/*!40000 ALTER TABLE `cms_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_main_config`
--

DROP TABLE IF EXISTS `cms_main_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_main_config` (
  `main_config_id` int(20) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(50) NOT NULL,
  `value` text,
  `description` text,
  PRIMARY KEY (`main_config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_main_config`
--

LOCK TABLES `cms_main_config` WRITE;
/*!40000 ALTER TABLE `cms_main_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_main_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_news`
--

DROP TABLE IF EXISTS `cms_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_news` (
  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_title` varchar(100) DEFAULT NULL,
  `news_url` varchar(100) DEFAULT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `categories_id` tinyint(3) unsigned NOT NULL,
  `description` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(120) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`news_id`),
  KEY `fk_news` (`categories_id`),
  CONSTRAINT `fk_news` FOREIGN KEY (`categories_id`) REFERENCES `cms_categories` (`categories_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_news`
--

LOCK TABLES `cms_news` WRITE;
/*!40000 ALTER TABLE `cms_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_page_type`
--

DROP TABLE IF EXISTS `cms_page_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_page_type` (
  `page_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `page_type` varchar(20) NOT NULL DEFAULT 'static',
  PRIMARY KEY (`page_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_page_type`
--

LOCK TABLES `cms_page_type` WRITE;
/*!40000 ALTER TABLE `cms_page_type` DISABLE KEYS */;
INSERT INTO `cms_page_type` VALUES (1,'static'),(2,'dynamic'),(3,'static'),(4,'dynamic'),(5,'static'),(6,'dynamic');
/*!40000 ALTER TABLE `cms_page_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_static_page`
--

DROP TABLE IF EXISTS `cms_static_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_static_page` (
  `static_page_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `static_page_title` varchar(100) DEFAULT NULL,
  `static_page_url` varchar(100) DEFAULT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `categories_id` tinyint(3) unsigned NOT NULL,
  `description` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(120) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`static_page_id`),
  KEY `fk_static_page` (`categories_id`),
  CONSTRAINT `fk_static_page` FOREIGN KEY (`categories_id`) REFERENCES `cms_categories` (`categories_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_static_page`
--

LOCK TABLES `cms_static_page` WRITE;
/*!40000 ALTER TABLE `cms_static_page` DISABLE KEYS */;
INSERT INTO `cms_static_page` VALUES (1,'','','sincerity, wise, courageus',1,'quotes in home page','2014-04-07 05:50:07','admin','','Doing business with a sense of sincerity, wise and courageous.'),(2,'','','tulus, bijaksana, keberanian',2,'quotes in home page','2014-04-07 05:53:06','admin','','Bisnis yang dilandasi dengan ketulusan, kebijaksanaan, dan keberanian.'),(3,'','','fact, history',3,'short history about murvien at home page','0000-00-00 00:00:00','admin','','Founded in mid-2013, PT Murvien Global has a vision to be a company that works with sincerity to achieve mutual success. \nPT Murvien Global is engaged in trading of commodities, mobile phone accessories importers and women\'s accessories, and digital creative.'),(4,'','','fakta, sejarah',4,'sejarah singkat tentang murvien di halaman beranda','0000-00-00 00:00:00','admin','','Didirikan pada pertengahan 2013, PT Murvien Global memiliki visi untuk menjadi perusahaan yang bekerja dengan tulus untuk mencapai kesuksesan bersama.\nPT Murvien global bergerak dalam bidang perdagangan komoditas, aksesoris ponsel importir dan aksesoris wanita, dan digital kreatif.'),(5,'Test for static page title','test-static-page-url','static',3,'test for static page description','2014-04-12 17:16:34','admin','','test for static page content'),(6,'Test again for ckeditor libraries','ckeditor-libraries','ckeditor',4,'ckeditor','2014-04-13 11:35:27','admin','','<p><strong>This is example of CKEditor</strong></p>\n\n<p>CKEditor really easy configuration for using this library</p>');
/*!40000 ALTER TABLE `cms_static_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_static_visitor_counter`
--

DROP TABLE IF EXISTS `cms_static_visitor_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_static_visitor_counter` (
  `counter_id` int(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `agent` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`counter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_static_visitor_counter`
--

LOCK TABLES `cms_static_visitor_counter` WRITE;
/*!40000 ALTER TABLE `cms_static_visitor_counter` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_static_visitor_counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_users`
--

DROP TABLE IF EXISTS `cms_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_users` (
  `users_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '4',
  `email` varchar(120) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password_hash` char(128) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(40) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` char(4) NOT NULL DEFAULT 'UM6',
  `language` varchar(20) NOT NULL DEFAULT 'english',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `password_iterations` int(4) NOT NULL,
  `force_password_reset` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`users_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_users`
--

LOCK TABLES `cms_users` WRITE;
/*!40000 ALTER TABLE `cms_users` DISABLE KEYS */;
INSERT INTO `cms_users` VALUES (2,4,'parto@gmail.com','parto','e8ad17a33da98ac26800eaf55621ecf9ead0e84039da07f17d610bf741bedee4378648bed939395e24f3e326e7ead5108835bcb754a7373245e3fc71b5dc3b8c','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,NULL,0,NULL,'',NULL,'UM6','english',0,'',0,0),(3,4,'agus@gmail.com','agus','892d87fef4ec266e00a8874f0a43b4f46642df92975e34b4eea7ffc70128049452a333009b7eb1d2eda52579738a0eae1caa9b0011bb9613f28fdd6560c4cb4d','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,NULL,0,NULL,'',NULL,'UM6','english',0,'',0,0);
/*!40000 ALTER TABLE `cms_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (0);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-13 18:51:31
