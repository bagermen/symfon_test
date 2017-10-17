-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pnp_api_tests
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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

CREATE DATABASE IF NOT EXISTS ugm_recruitment_test;

USE ugm_recruitment_test;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `country_code` varchar(5) DEFAULT NULL,
  `region_code` varchar(5) DEFAULT NULL,
  `reset_password_time` datetime DEFAULT NULL,
  `has_accepted_newsletter` tinyint(1) DEFAULT '0',
  `culture` varchar(5) DEFAULT 'en',
  `age` varchar(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `creationOrigin` varchar(40) NOT NULL DEFAULT 'unknown',
  `lastActivityDate` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `lastActivityDate` (`lastActivityDate`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (83,'test+107bfbda-35eb-1042-5576-ea6804c41200@ugroupmedia.com','test+107bfbda-35eb-1042-5576-ea6804c41200@ugroupmedia.com','123456','Martin','Poirier','M',NULL,NULL,NULL,1,'en','002',1,'unknown',NULL,'2017-01-27 20:03:58','2017-01-27 20:03:58'),(84,'test+0b106de7-676a-abd2-519c-241cb888ac56@ugroupmedia.com','test+0b106de7-676a-abd2-519c-241cb888ac56@ugroupmedia.com','123456','Martin','Poirier','M',NULL,NULL,NULL,1,'en','002',1,'unknown',NULL,'2017-02-03 15:18:21','2017-02-03 15:18:21'),(85,'test+5c80d9b3-40e5-3b94-245c-7f1b85b622ea@ugroupmedia.com','test+5c80d9b3-40e5-3b94-245c-7f1b85b622ea@ugroupmedia.com','123456','Martin','Poirier','M',NULL,NULL,NULL,1,'en','002',1,'unknown',NULL,'2017-02-03 15:19:19','2017-02-03 15:19:19'),(86,'test+5ef217ef-6132-0414-82b0-89d4b3c6ce80@ugroupmedia.com','test+5ef217ef-6132-0414-82b0-89d4b3c6ce80@ugroupmedia.com','123456','Martin','Poirier','M',NULL,NULL,NULL,1,'en','002',1,'unknown',NULL,'2017-02-03 15:58:44','2017-02-03 15:58:44');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_recipient`
--

DROP TABLE IF EXISTS `user_recipient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_recipient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_owner_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `culture` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `lastVideoBirthdayMailDate` date DEFAULT NULL,
  `createVideoBirthday` tinyint(1) NOT NULL DEFAULT '1',
  `data` longtext NOT NULL COMMENT '(DC2Type:json_array)',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_68E476AD6F2834F` (`account_owner_id`),
  KEY `video_birthday` (`createVideoBirthday`,`lastVideoBirthdayMailDate`,`birthday`),
  CONSTRAINT `FK_68E476AD6F2834F` FOREIGN KEY (`account_owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_recipient`
--

LOCK TABLES `user_recipient` WRITE;
/*!40000 ALTER TABLE `user_recipient` DISABLE KEYS */;
INSERT INTO `user_recipient` VALUES (1,84,'martin','en',NULL,NULL,0,'','2011-10-10 00:00:00','2011-10-10 00:00:00'),(2,84,'martin2','en',NULL,NULL,1,'','2012-10-10 00:00:00','2012-10-10 00:00:00'),(3,85,'julie','fr',NULL,NULL,1,'','2011-10-10 00:00:00','2011-10-10 00:00:00'),(4,85,'julie','fr',NULL,NULL,1,'','2011-12-10 00:00:00','2011-12-10 00:00:00'),(5,85,'julie','fr',NULL,NULL,1,'','2011-10-10 00:00:00','2011-10-10 00:00:00');
/*!40000 ALTER TABLE `user_recipient` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-07 16:57:49
