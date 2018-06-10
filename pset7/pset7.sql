-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: pset7
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `action` varchar(30) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `shares` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (1,9,'SELL','FREE',5,'2016-04-16 16:34:42'),(2,9,'SELL','MS',4,'2016-04-16 16:36:02'),(3,9,'SELL','WB',2,'2016-04-16 16:36:10'),(4,9,'BUY','CG',2,'2016-04-16 16:36:52'),(5,11,'BUY','MS',10,'2016-04-16 16:38:08'),(6,9,'SELL','FREE',2,'2016-04-17 07:54:55'),(7,9,'SELL','FREE',2,'2016-04-17 07:55:45');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `shares` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,9,'FREE',9),(2,9,'DM',0),(5,9,'MS',0),(7,9,'WB',4),(10,9,'CG',2),(11,11,'MS',10);
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'andi','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(2,'caesar','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(3,'eli','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(4,'hdan','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(5,'jason','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(6,'john','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(7,'levatich','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(8,'rob','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(9,'skroob','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',69.2800),(10,'zamyla','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',10000.0000),(11,'bprogyan','$2y$10$evDa3kSw20tuMcnHXcy6OuonuHTEbjn4WeyNs/MCwuwx74NnYDeqq',9742.4000);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-17  8:04:21
