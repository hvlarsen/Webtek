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
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `Team` varchar(45) NOT NULL,
  `Teamname` varchar(45) DEFAULT NULL,
  `Groupname` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Team`),
  UNIQUE KEY `Team_UNIQUE` (`Team`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES ('Argentina','Argentina','C'),('Australia','Australia','D'),('Belgium','Belgium','F'),('Brazil','Brazil','G'),('Cameroon','Cameroon','G'),('Canada','Canada','F'),('Costa Rica','Costa Rica','E'),('Croatia','Croatia','F'),('Denmark','Denmark','D'),('Ecuador','Ecuador','A'),('England','England','B'),('France','France','D'),('Germany','Germany','E'),('Ghana','Ghana','H'),('Iran','Iran','B'),('Japan','Japan','E'),('Korea Republic','South Korea','H'),('Mexico','Mexico','C'),('Morocco','Morocco','F'),('Netherlands','Netherlands','A'),('Poland','Poland','C'),('Portugal','Portugal','H'),('Qatar','Qatar','A'),('Saudi Arabia','Saudi Arabia','C'),('Senegal','Senegal','A'),('Serbia','Serbia','G'),('Spain','Spain','E'),('Switzerland','Switzerland','G'),('TBA','TBA','N'),('Tunisia','Tunisia','D'),('Uruguay','Uruguay','H'),('USA','USA','B'),('Wales','Wales','B');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
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
