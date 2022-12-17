-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: vmsimulator
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matches` (
  `MatchID` int(11) NOT NULL,
  `RoundNumber` text,
  `Date` text,
  `Location` text,
  `Team1` varchar(45) DEFAULT NULL,
  `Team2` varchar(45) DEFAULT NULL,
  `goals1` int(11) DEFAULT NULL,
  `goals2` int(11) DEFAULT NULL,
  `winner` varchar(45) DEFAULT NULL,
  `loser` varchar(45) DEFAULT NULL,
  `played` text,
  `Team1_source` varchar(45) DEFAULT NULL,
  `Team2_source` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`MatchID`),
  KEY `winner_fk_idx` (`winner`),
  KEY `Team1_fk_idx` (`Team1`),
  KEY `Team2sdf_fk_idx` (`Team2`),
  KEY `losersdk_fk_idx` (`loser`),
  KEY `Team1_sourcesdf_fk_idx` (`Team1_source`),
  CONSTRAINT `Team1sdf_fk` FOREIGN KEY (`Team1`) REFERENCES `teams` (`Team`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Team2sdf_fk` FOREIGN KEY (`Team2`) REFERENCES `teams` (`Team`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `losersdk_fk` FOREIGN KEY (`loser`) REFERENCES `teams` (`Team`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `winnersdk_fk` FOREIGN KEY (`winner`) REFERENCES `teams` (`Team`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matches`
--

LOCK TABLES `matches` WRITE;
/*!40000 ALTER TABLE `matches` DISABLE KEYS */;
INSERT INTO `matches` VALUES (1,'1','2022-11-20 16:00:00','Al Bayt Stadium','Qatar','Ecuador',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(2,'1','2022-11-21 13:00:00','Khalifa International Stadium','England','Iran',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(3,'1','2022-11-21 16:00:00','Al Thumama Stadium','Senegal','Netherlands',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(4,'1','2022-11-21 19:00:00','Ahmad Bin Ali Stadium','USA','Wales',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(5,'1','2022-11-22 10:00:00','Lusail Stadium','Argentina','Saudi Arabia',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(6,'1','2022-11-22 13:00:00','Education City Stadium','Denmark','Tunisia',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(7,'1','2022-11-22 16:00:00','Stadium 974','Mexico','Poland',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(8,'1','2022-11-22 19:00:00','Al Janoub Stadium','France','Australia',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(9,'1','2022-11-23 10:00:00','Al Bayt Stadium','Morocco','Croatia',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(10,'1','2022-11-23 13:00:00','Khalifa International Stadium','Germany','Japan',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(11,'1','2022-11-23 16:00:00','Al Thumama Stadium','Spain','Costa Rica',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(12,'1','2022-11-23 19:00:00','Ahmad Bin Ali Stadium','Belgium','Canada',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(13,'1','2022-11-24 10:00:00','Al Janoub Stadium','Switzerland','Cameroon',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(14,'1','2022-11-24 13:00:00','Education City Stadium','Uruguay','Korea Republic',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(15,'1','2022-11-24 16:00:00','Stadium 974','Portugal','Ghana',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(16,'1','2022-11-24 19:00:00','Lusail Stadium','Brazil','Serbia',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(17,'2','2022-11-25 10:00:00','Ahmad Bin Ali Stadium','Wales','Iran',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(18,'2','2022-11-25 13:00:00','Al Thumama Stadium','Qatar','Senegal',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(19,'2','2022-11-25 16:00:00','Khalifa International Stadium','Netherlands','Ecuador',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(20,'2','2022-11-25 19:00:00','Al Bayt Stadium','England','USA',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(21,'2','2022-11-26 10:00:00','Al Janoub Stadium','Tunisia','Australia',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(22,'2','2022-11-26 13:00:00','Education City Stadium','Poland','Saudi Arabia',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(23,'2','2022-11-26 16:00:00','Stadium 974','France','Denmark',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(24,'2','2022-11-26 19:00:00','Lusail Stadium','Argentina','Mexico',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(25,'2','2022-11-27 10:00:00','Ahmad Bin Ali Stadium','Japan','Costa Rica',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(26,'2','2022-11-27 13:00:00','Al Thumama Stadium','Belgium','Morocco',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(27,'2','2022-11-27 16:00:00','Khalifa International Stadium','Croatia','Canada',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(28,'2','2022-11-27 19:00:00','Al Bayt Stadium','Spain','Germany',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(29,'2','2022-11-28 10:00:00','Al Janoub Stadium','Cameroon','Serbia',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(30,'2','2022-11-28 13:00:00','Education City Stadium','Korea Republic','Ghana',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(31,'2','2022-11-28 16:00:00','Stadium 974','Brazil','Switzerland',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(32,'2','2022-11-28 19:00:00','Lusail Stadium','Portugal','Uruguay',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(33,'3','2022-11-29 15:00:00','Khalifa International Stadium','Ecuador','Senegal',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(34,'3','2022-11-29 15:00:00','Al Bayt Stadium','Netherlands','Qatar',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(35,'3','2022-11-29 19:00:00','Ahmad Bin Ali Stadium','Wales','England',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(36,'3','2022-11-29 19:00:00','Al Thumama Stadium','Iran','USA',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(37,'3','2022-11-30 15:00:00','Al Janoub Stadium','Australia','Denmark',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(38,'3','2022-11-30 15:00:00','Education City Stadium','Tunisia','France',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(39,'3','2022-11-30 19:00:00','Stadium 974','Poland','Argentina',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(40,'3','2022-11-30 19:00:00','Lusail Stadium','Saudi Arabia','Mexico',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(41,'3','2022-12-01 15:00:00','Ahmad Bin Ali Stadium','Croatia','Belgium',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(42,'3','2022-12-01 15:00:00','Al Thumama Stadium','Canada','Morocco',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(43,'3','2022-12-01 19:00:00','Khalifa International Stadium','Japan','Spain',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(44,'3','2022-12-01 19:00:00','Al Bayt Stadium','Costa Rica','Germany',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(45,'3','2022-12-02 15:00:00','Al Janoub Stadium','Ghana','Uruguay',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(46,'3','2022-12-02 15:00:00','Education City Stadium','Korea Republic','Portugal',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(47,'3','2022-12-02 19:00:00','Stadium 974','Serbia','Switzerland',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(48,'3','2022-12-02 19:00:00','Lusail Stadium','Cameroon','Brazil',-1,-1,'TBA','TBA','0','Predefined','Predefined'),(49,'Round of 16','2022-12-03 15:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','1A','2B'),(50,'Round of 16','2022-12-03 19:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','1C','2D'),(51,'Round of 16','2022-12-04 15:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','1D','2C'),(52,'Round of 16','2022-12-04 19:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','1B','2A'),(53,'Round of 16','2022-12-05 15:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','1E','2F'),(54,'Round of 16','2022-12-05 19:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','1G','2H'),(55,'Round of 16','2022-12-06 15:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','1F','2E'),(56,'Round of 16','2022-12-06 19:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','1H','2G'),(57,'Quarter Finals','2022-12-09 15:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','W49','W50'),(58,'Quarter Finals','2022-12-09 19:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','W53','W54'),(59,'Quarter Finals','2022-12-10 15:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','W51','W52'),(60,'Quarter Finals','2022-12-10 19:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','W55','W56'),(61,'Semi Finals','2022-12-13 19:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','W57','W58'),(62,'Semi Finals','2022-12-14 19:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','W59','W60'),(63,'Finals','2022-12-17 15:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','L61','L62'),(64,'Finals','2022-12-18 15:00:00','TBA','TBA','TBA',-1,-1,'TBA','TBA','0','W61','W62');
/*!40000 ALTER TABLE `matches` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-17 15:02:49
