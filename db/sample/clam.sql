-- MySQL dump 10.13  Distrib 8.0.18, for macos10.14 (x86_64)
--
-- Host: localhost    Database: clamdb
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `assigned`
--

DROP TABLE IF EXISTS `assigned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assigned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `minutes` int(11) NOT NULL,
  `part_title` varchar(256) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `assistant_id` int(11) DEFAULT NULL,
  `aux_person_id` int(11) DEFAULT NULL,
  `aux_assistant_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part_meeting_idx` (`meeting_id`,`part_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned`
--

LOCK TABLES `assigned` WRITE;
/*!40000 ALTER TABLE `assigned` DISABLE KEYS */;
INSERT INTO `assigned` VALUES (1,4,'19:30:00',5,'Song 12 and Prayer',3,NULL,100,NULL,NULL),(2,5,'19:35:00',3,'Opening Comments — Chairman',3,73,NULL,NULL,NULL),(3,6,'19:38:00',10,'Treasures from God\'s Word',3,NULL,NULL,NULL,NULL),(4,7,'19:48:00',8,'Digging for Spiritual Gems',3,NULL,NULL,NULL,NULL),(5,12,'20:16:00',5,'Song 23',3,NULL,NULL,NULL,NULL),(6,13,'20:21:00',15,'Living as Christians Part 1',3,12,NULL,NULL,NULL),(9,16,'20:36:00',3,'Review Followed by Preview of Next Week',3,73,NULL,NULL,NULL),(10,17,'21:09:00',5,'Song 24 and Prayer',3,NULL,25,NULL,NULL),(11,4,'19:30:00',5,'Song 25 and Prayer',1,NULL,87,NULL,NULL),(12,5,'19:35:00',3,'Opening Comments — Chairman',1,25,NULL,NULL,NULL),(13,6,'19:38:00',10,'Treasures from God\'s Word',1,NULL,NULL,NULL,NULL),(14,7,'19:48:00',8,'Digging for Spiritual Gems',1,NULL,NULL,NULL,NULL),(15,12,'20:12:00',5,'Song 26',1,NULL,NULL,NULL,NULL),(17,14,'20:17:00',8,'Living as Christians Part 2',1,18,NULL,NULL,NULL),(18,15,'20:25:00',30,'Congregation Bible Study',1,NULL,NULL,NULL,NULL),(19,16,'20:55:00',3,'Review Followed by Preview of Next Week',1,25,NULL,NULL,NULL),(20,17,'20:58:00',5,'Song 27 and Prayer',1,NULL,65,NULL,NULL),(31,4,'19:30:00',5,'Song 29 and Prayer',4,NULL,8,NULL,NULL),(32,5,'19:35:00',3,'Opening Comments — Chairman',4,75,NULL,NULL,NULL),(33,6,'19:38:00',10,'Treasures from God\'s Word',4,NULL,NULL,NULL,NULL),(34,7,'19:48:00',8,'Digging for Spiritual Gems',4,NULL,NULL,NULL,NULL),(35,12,'19:56:00',5,'Song 30',4,NULL,NULL,NULL,NULL),(36,13,'20:01:00',15,'Living as Christians Part 1',4,87,NULL,NULL,NULL),(37,14,'20:16:00',8,'Living as Christians Part 2',4,5,NULL,NULL,NULL),(38,15,'20:24:00',30,'Congregation Bible Study',4,NULL,NULL,NULL,NULL),(39,16,'20:54:00',3,'Review Followed by Preview of Next Week',4,75,NULL,NULL,NULL),(40,17,'20:57:00',5,'Song 31 and Prayer',4,NULL,8,NULL,NULL),(43,19,'20:39:00',30,'Circuit Overseer Service Talk',3,18,NULL,NULL,NULL),(44,18,'19:56:00',4,'Bible Reading',3,77,NULL,8,NULL),(45,9,'20:01:00',2,'Initial Call',3,80,94,1,41),(46,20,'19:56:00',4,'Initial Call Video',1,NULL,NULL,NULL,NULL),(47,22,'20:00:00',3,'Second Return Visit',1,91,46,49,41),(48,11,'20:04:00',6,'Bible Study',1,30,100,40,81),(49,14,'20:17:00',8,'Living as Christians Part 2',0,18,NULL,NULL,NULL),(50,10,'20:04:00',3,'First Return Visit',3,91,100,74,93),(52,11,'20:08:00',6,'Bible Study',3,28,97,60,36),(53,4,'19:30:00',5,'Song {no} and Prayer',5,NULL,NULL,NULL,NULL),(54,5,'19:35:00',3,'Opening Comments — Chairman',5,NULL,NULL,NULL,NULL),(55,6,'19:38:00',10,'Treasures from God\'s Word',5,NULL,NULL,NULL,NULL),(56,7,'19:48:00',8,'Digging for Spiritual Gems',5,NULL,NULL,NULL,NULL),(57,12,'19:56:00',5,'Song {no}',5,NULL,NULL,NULL,NULL),(58,13,'20:01:00',15,'Living as Christians Part 1',5,NULL,NULL,NULL,NULL),(59,14,'20:16:00',8,'Living as Christians Part 2',5,NULL,NULL,NULL,NULL),(60,15,'20:24:00',30,'Congregation Bible Study',5,NULL,NULL,NULL,NULL),(61,16,'20:54:00',3,'Review Followed by Preview of Next Week',5,NULL,NULL,NULL,NULL),(62,17,'20:57:00',5,'Song {no} and Prayer',5,NULL,NULL,NULL,NULL),(63,4,'19:30:00',5,'Song {no} and Prayer',6,NULL,NULL,NULL,NULL),(64,5,'19:35:00',3,'Opening Comments — Chairman',6,NULL,NULL,NULL,NULL),(65,6,'19:38:00',10,'Treasures from God\'s Word',6,NULL,NULL,NULL,NULL),(66,7,'19:48:00',8,'Digging for Spiritual Gems',6,NULL,NULL,NULL,NULL),(67,12,'19:56:00',5,'Song {no}',6,NULL,NULL,NULL,NULL),(68,13,'20:01:00',15,'Living as Christians Part 1',6,NULL,NULL,NULL,NULL),(69,14,'20:16:00',8,'Living as Christians Part 2',6,NULL,NULL,NULL,NULL),(70,15,'20:24:00',30,'Congregation Bible Study',6,NULL,NULL,NULL,NULL),(71,16,'20:54:00',3,'Review Followed by Preview of Next Week',6,NULL,NULL,NULL,NULL),(72,17,'20:57:00',5,'Song {no} and Prayer',6,NULL,NULL,NULL,NULL),(73,4,'19:30:00',5,'Song {no} and Prayer',7,NULL,NULL,NULL,NULL),(74,5,'19:35:00',3,'Opening Comments — Chairman',7,NULL,NULL,NULL,NULL),(75,6,'19:38:00',10,'Treasures from God\'s Word',7,NULL,NULL,NULL,NULL),(76,7,'19:48:00',8,'Digging for Spiritual Gems',7,NULL,NULL,NULL,NULL),(77,12,'19:56:00',5,'Song {no}',7,NULL,NULL,NULL,NULL),(78,13,'20:01:00',15,'Living as Christians Part 1',7,NULL,NULL,NULL,NULL),(79,14,'20:16:00',8,'Living as Christians Part 2',7,NULL,NULL,NULL,NULL),(80,15,'20:24:00',30,'Congregation Bible Study',7,NULL,NULL,NULL,NULL),(81,16,'20:54:00',3,'Review Followed by Preview of Next Week',7,NULL,NULL,NULL,NULL),(82,17,'20:57:00',5,'Song {no} and Prayer',7,NULL,NULL,NULL,NULL),(83,4,'19:30:00',5,'Song {no} and Prayer',8,NULL,NULL,NULL,NULL),(84,5,'19:35:00',3,'Opening Comments — Chairman',8,NULL,NULL,NULL,NULL),(85,6,'19:38:00',10,'Treasures from God\'s Word',8,NULL,NULL,NULL,NULL),(86,7,'19:48:00',8,'Digging for Spiritual Gems',8,NULL,NULL,NULL,NULL),(87,12,'19:56:00',5,'Song {no}',8,NULL,NULL,NULL,NULL),(88,13,'20:01:00',15,'Living as Christians Part 1',8,NULL,NULL,NULL,NULL),(89,14,'20:16:00',8,'Living as Christians Part 2',8,NULL,NULL,NULL,NULL),(90,15,'20:24:00',30,'Congregation Bible Study',8,NULL,NULL,NULL,NULL),(91,16,'20:54:00',3,'Review Followed by Preview of Next Week',8,NULL,NULL,NULL,NULL),(92,17,'20:57:00',5,'Song {no} and Prayer',8,NULL,NULL,NULL,NULL),(93,4,'19:30:00',5,'Song {no} and Prayer',9,NULL,NULL,NULL,NULL),(94,5,'19:35:00',3,'Opening Comments — Chairman',9,NULL,NULL,NULL,NULL),(95,6,'19:38:00',10,'Treasures from God\'s Word',9,NULL,NULL,NULL,NULL),(96,7,'19:48:00',8,'Digging for Spiritual Gems',9,NULL,NULL,NULL,NULL),(97,12,'19:56:00',5,'Song {no}',9,NULL,NULL,NULL,NULL),(98,13,'20:01:00',15,'Living as Christians Part 1',9,NULL,NULL,NULL,NULL),(99,14,'20:16:00',8,'Living as Christians Part 2',9,NULL,NULL,NULL,NULL),(100,15,'20:24:00',30,'Congregation Bible Study',9,NULL,NULL,NULL,NULL),(101,16,'20:54:00',3,'Review Followed by Preview of Next Week',9,NULL,NULL,NULL,NULL),(102,17,'20:57:00',5,'Song {no} and Prayer',9,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `assigned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meeting_notes`
--

DROP TABLE IF EXISTS `meeting_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meeting_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_id` int(11) NOT NULL,
  `heading` text NOT NULL,
  `note` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meeting_notes`
--

LOCK TABLES `meeting_notes` WRITE;
/*!40000 ALTER TABLE `meeting_notes` DISABLE KEYS */;
INSERT INTO `meeting_notes` VALUES (1,3,'Heading 1','Note 1','2019-11-13 23:58:45','2019-11-14 09:26:01'),(2,2,'No meeting','No meeting due to Regional Convention Fri-Sun','2019-11-14 04:40:28','2019-11-14 09:26:01');
/*!40000 ALTER TABLE `meeting_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL COMMENT 'CLAM Chairman',
  `co_visit` tinyint(1) DEFAULT NULL,
  `auxiliary_counselor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (1,'2019-11-12',1,25,0,NULL),(2,'2019-11-19',1,NULL,0,NULL),(3,'2019-11-05',1,73,1,28),(4,'2019-11-26',1,75,0,NULL),(5,'2019-12-03',2,NULL,0,NULL),(6,'2019-12-10',2,NULL,0,NULL),(7,'2019-12-17',2,NULL,0,NULL),(8,'2019-12-24',2,NULL,0,NULL),(9,'2019-12-31',2,NULL,0,NULL);
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `chairman_part` tinyint(1) NOT NULL,
  `co_visit` tinyint(1) NOT NULL,
  `no_assign` tinyint(1) NOT NULL,
  `assistant` tinyint(1) NOT NULL,
  `partname` varchar(70) DEFAULT NULL,
  `replace_token` varchar(10) NOT NULL,
  `minutes` int(3) DEFAULT NULL,
  `start_time` time NOT NULL,
  `min_suffix` varchar(15) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `counsel_mins` int(11) NOT NULL,
  `link_to` int(11) DEFAULT NULL,
  `has_auxiliary` tinyint(1) DEFAULT NULL,
  `assistant_prefix` varchar(45) DEFAULT NULL,
  `school_part` tinyint(1) DEFAULT NULL,
  `not_co_visit` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts`
--

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (4,1,0,0,1,1,'Song {no} and Prayer','{no}',5,'19:30:00','min.',4,10,0,NULL,0,'Prayer:',NULL,NULL),(5,1,1,0,0,0,'Opening Comments — Chairman','',3,'19:35:00','min. or less',4,20,0,NULL,0,NULL,NULL,NULL),(6,1,0,0,0,0,'Treasures from God\'s Word','',10,'19:38:00','min.',1,30,0,NULL,0,NULL,NULL,NULL),(7,1,0,0,0,0,'Digging for Spiritual Gems','',8,'19:48:00','min.',1,40,0,NULL,0,NULL,NULL,NULL),(8,0,0,0,0,0,'Prepare This Months Presentations','',15,'20:02:00','min.',2,30,0,NULL,0,NULL,NULL,NULL),(9,1,0,0,0,1,'Initial Call','',2,'20:02:00','min. or less',2,60,1,NULL,1,'',1,NULL),(10,1,0,0,0,1,'First Return Visit','',3,'20:05:00','min. or less',2,70,1,NULL,1,'',1,NULL),(11,1,0,0,0,1,'Bible Study','',6,'20:10:00','min. or less',2,120,2,NULL,1,'',1,NULL),(12,1,0,0,1,0,'Song {no}','{no}',5,'20:17:00','min. or less',3,130,0,NULL,0,NULL,NULL,NULL),(13,1,0,0,0,0,'Living as Christians Part 1','',15,'20:22:00','min.',3,140,0,NULL,0,NULL,NULL,NULL),(14,1,0,0,0,0,'Living as Christians Part 2','',8,'20:29:00','min. ',3,150,0,NULL,0,NULL,NULL,NULL),(15,1,0,0,0,1,'Congregation Bible Study','',30,'20:37:00','min.',3,160,0,NULL,0,'Reader:',0,1),(16,1,1,0,0,0,'Review Followed by Preview of Next Week','',3,'21:07:00','min. or less',5,170,0,5,0,NULL,NULL,NULL),(17,1,0,0,1,1,'Song {no} and Prayer','{no}',5,'21:10:00','min.',5,200,0,NULL,0,'Prayer:',NULL,NULL),(18,1,0,0,0,0,'Bible Reading','',4,'19:56:00','min. or less',1,50,1,NULL,1,'',1,NULL),(19,1,0,1,0,0,'Circuit Overseer Service Talk','',30,'20:37:00','min.',5,190,0,NULL,0,NULL,NULL,NULL),(20,1,0,0,1,0,'Initial Call Video','',4,'20:02:00','min.',2,62,0,NULL,1,'',1,0),(21,1,0,0,1,0,'First Return Visit Video','',5,'20:05:00','min.',2,72,0,5,0,'',1,NULL),(22,1,0,0,0,1,'Second Return Visit','',3,'20:09:00','min. or less',2,80,1,NULL,1,'',1,NULL),(23,1,0,0,1,0,'Second Return Visit Video','',5,'20:09:00','min.',2,90,0,5,0,'',1,NULL),(24,1,0,0,0,1,'Third Return Visit','',3,'00:00:00','min. or less',2,110,1,NULL,1,'',1,NULL);
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts_roles`
--

DROP TABLE IF EXISTS `parts_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parts_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_roles`
--

LOCK TABLES `parts_roles` WRITE;
/*!40000 ALTER TABLE `parts_roles` DISABLE KEYS */;
INSERT INTO `parts_roles` VALUES (1,4,2),(2,17,2),(3,5,3),(4,16,3),(5,15,4),(6,7,6),(7,13,7),(8,14,7),(9,15,9),(12,9,12),(13,10,12),(14,11,12),(15,6,5),(16,18,13),(17,8,10),(19,8,14),(21,19,15),(23,21,3),(25,22,12),(26,23,3),(28,24,12),(29,20,16),(31,21,16),(32,23,16);
/*!40000 ALTER TABLE `parts_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brother` tinyint(1) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,0,'Abigail','Pagac','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(2,0,'Ara','Feest','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(3,0,'Bryana','Morar','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(4,1,'Milford','King','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(5,1,'Shane','Beatty','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(6,0,'Elsie','Olson','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(7,0,'Gerda','Homenick','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(8,1,'Elbert','Keeling','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(9,1,'Shayne','Rohan','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(10,1,'Emil','Kirlin','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(11,0,'Ernestina','Cruickshank','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(12,1,'Sigrid','Pouros','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(13,0,'Susie','Tillman','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(14,0,'Icie','Abshire','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(15,1,'Celestino','Bogan','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(16,0,'Lavina','Braun','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(17,1,'Roy','Rohan','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(18,1,'Winfield','Adams','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(19,1,'Milford','Pollich','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(20,0,'Charlene','Kassulke','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(21,0,'Viola','Walsh','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(22,1,'Jarrell','Cronin','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(23,1,'Lew','Wisoky','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(24,0,'Estefania','Eichmann','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(25,1,'Delaney','Toy','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(26,0,'Katrine','Becker','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(27,0,'Estel','Bogisich','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(28,1,'Gilberto','Little','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(29,1,'Arely','Mitchell','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(30,0,'Andreane','Bogisich','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(31,0,'Kaitlyn','Stark','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(32,0,'Assunta','Lang','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(33,0,'Gudrun','Carter','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(34,0,'Luz','Leannon','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(35,1,'Osbaldo','Runolfsdottir','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(36,1,'Giovani','Johnson','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(37,1,'Alex','Corkery','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(38,1,'Jarod','Walker','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(39,0,'Lupe','Padberg','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(40,0,'Alta','Carroll','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(41,0,'Aimee','Schmitt','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(42,0,'Dorris','Bergstrom','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(43,0,'Winnifred','Moore','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(44,1,'Garett','Kris','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(45,0,'Willa','Stroman','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(46,0,'Charity','Ortiz','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(47,1,'Micheal','Armstrong','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(48,0,'Marlene','Mayer','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(49,1,'Aric','White','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(50,0,'Mallie','Corkery','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(51,0,'Eveline','Gibson','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(52,0,'Athena','Stehr','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(53,0,'Kristin','Lowe','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(54,1,'Jasper','Grady','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(55,0,'Kamille','Schmeler','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(56,1,'Tyrel','Wiegand','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(57,0,'Shanon','Abshire','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(58,1,'Maximilian','Treutel','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(59,0,'Tamara','Boehm','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(60,0,'Gabriella','Miller','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(61,0,'Josefa','Fay','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(62,0,'Loraine','Maggio','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(63,0,'Olga','Rutherford','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(64,0,'Annabel','Hickle','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(65,1,'Ed','Bruen','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(66,0,'Shania','Littel','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(67,1,'Roel','Hessel','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(68,1,'Kameron','Ebert','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(69,1,'Misael','Kohler','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(70,0,'Destini','Bins','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(71,1,'Elbert','Lind','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(72,1,'Ignacio','Brakus','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(73,1,'Curt','Shields','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(74,1,'Barney','Bode','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(75,1,'Cortez','Green','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(76,0,'Lea','Hand','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(77,1,'Efrain','Hodkiewicz','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(78,1,'Jared','Abshire','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(79,0,'Matilde','Schmeler','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(80,0,'Adrianna','Little','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(81,0,'Antonina','King','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(82,1,'Ruben','Little','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(83,0,'Leann','Donnelly','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(84,0,'Jany','Gislason','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(85,1,'Kris','Auer','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(86,1,'Johnathan','O\'Kon','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(87,1,'Deondre','Deckow','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(88,0,'Zoie','Sipes','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(89,0,'Sadye','Jacobson','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(90,1,'Kale','Parker','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(91,1,'Barton','Kshlerin','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(92,1,'Arne','Metz','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(93,0,'Bettie','Von','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(94,0,'Alexandrine','Welch','2019-11-13 08:33:29','2019-11-13 11:14:41',1),(95,0,'Dominique','Heller','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(96,0,'Renee','Collier','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(97,1,'Ellis','Steuber','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(98,1,'Fletcher','Hayes','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(99,0,'Earnestine','Douglas','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(100,1,'Camden','Marks','2019-11-13 08:33:29','2019-11-13 08:33:29',1),(101,1,'Rupert','Shocking','2019-11-13 23:39:44','2019-11-14 04:42:39',1);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people_roles`
--

DROP TABLE IF EXISTS `people_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `people_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people_roles`
--

LOCK TABLES `people_roles` WRITE;
/*!40000 ALTER TABLE `people_roles` DISABLE KEYS */;
INSERT INTO `people_roles` VALUES (1,29,10),(2,37,10),(3,49,10),(4,65,10),(5,77,10),(6,92,10),(10,101,12),(11,25,3),(12,71,3),(13,73,3),(14,75,3),(15,87,3),(16,97,3),(17,28,16),(18,36,16),(19,65,16),(20,18,15),(149,1,12),(150,2,12),(151,3,12),(152,4,12),(153,5,12),(154,6,12),(155,7,12),(156,8,12),(157,9,12),(158,10,12),(159,11,12),(160,12,12),(161,13,12),(162,14,12),(163,15,12),(164,16,12),(165,17,12),(166,18,12),(167,19,12),(168,20,12),(169,21,12),(170,22,12),(171,23,12),(172,24,12),(173,25,12),(174,26,12),(175,27,12),(176,28,12),(177,29,12),(178,30,12),(179,31,12),(180,32,12),(181,33,12),(182,34,12),(183,35,12),(184,36,12),(185,37,12),(186,38,12),(187,39,12),(188,40,12),(189,41,12),(190,42,12),(191,43,12),(192,44,12),(193,45,12),(194,46,12),(195,47,12),(196,48,12),(197,49,12),(198,50,12),(199,51,12),(200,52,12),(201,53,12),(202,54,12),(203,55,12),(204,56,12),(205,57,12),(206,58,12),(207,59,12),(208,60,12),(209,61,12),(210,62,12),(211,63,12),(212,64,12),(213,65,12),(214,66,12),(215,67,12),(216,68,12),(217,69,12),(218,70,12),(219,71,12),(220,72,12),(221,73,12),(222,74,12),(223,75,12),(224,76,12),(225,77,12),(226,78,12),(227,79,12),(228,80,12),(229,81,12),(230,82,12),(231,83,12),(232,84,12),(233,85,12),(234,86,12),(235,87,12),(236,88,12),(237,89,12),(238,90,12),(239,91,12),(240,92,12),(241,93,12),(242,94,12),(243,95,12),(244,96,12),(245,97,12),(246,98,12),(247,99,12),(248,100,12),(249,101,12),(276,8,2),(277,25,2),(278,65,2),(279,71,2),(280,87,2),(281,97,2),(282,100,2),(283,5,7),(284,9,7),(285,12,7),(286,18,7),(287,25,7),(288,56,7),(289,65,7),(290,73,7),(291,87,7);
/*!40000 ALTER TABLE `people_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phinxlog`
--

DROP TABLE IF EXISTS `phinxlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phinxlog`
--

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;
INSERT INTO `phinxlog` VALUES (20171216230425,'Base','2017-12-18 02:08:55','2017-12-18 02:08:55',0),(20171216232044,'AddAuxilarySchoolToAssigned','2017-12-18 02:09:11','2017-12-18 02:09:11',0),(20171217020058,'HasAuxliary','2017-12-18 02:09:11','2017-12-18 02:09:11',0),(20171218043238,'AddActiveOnPeopleTable','2017-12-18 04:36:52','2017-12-18 04:36:52',0),(20180119015801,'TestMD','2018-01-18 14:58:01','2018-01-18 14:58:01',0),(20180121123818,'AssistantPrefix','2018-01-21 12:42:04','2018-01-21 12:42:04',0);
/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assistant` tinyint(1) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `for_brothers` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (2,1,'Prayer','2016-05-26 12:16:16','2019-11-14 04:52:12',1),(3,0,'Chairman','2016-05-26 12:18:15','2019-11-14 00:42:37',1),(4,0,'Congregation Bible Study Conductor','2016-05-26 12:24:39','2019-11-13 08:49:51',1),(5,0,'Treasures from God\'s Word','2016-05-26 12:25:01','2019-11-13 08:49:56',1),(6,0,'Digging for Spiritual Gems','2016-05-26 12:25:00','2019-11-13 08:50:27',1),(7,0,'Living as Christians','2016-05-26 12:25:25','2019-11-14 04:54:37',1),(9,1,'CBS Reader','2016-05-26 12:32:47','2019-11-13 08:50:56',1),(10,0,'Elder','2016-05-27 09:02:17','2019-11-13 23:37:15',1),(11,0,'Ministerial Servant','2016-05-27 09:02:25','2019-11-13 08:51:11',1),(12,0,'School','2016-05-27 09:02:40','2016-08-21 12:15:16',NULL),(13,0,'Bible Reading','2016-08-21 12:40:58','2019-11-14 05:09:25',1),(14,0,'Apply Yourselves to the Field Ministry','2016-08-21 12:50:26','2019-11-13 08:51:32',1),(15,0,'Circuit Overseer','2017-01-19 06:55:19','2019-11-14 00:49:09',1),(16,0,'Auxiliary Classroom Counselor','2018-01-19 02:26:49','2019-11-14 00:46:42',1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `month` varchar(10) NOT NULL,
  `comment` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,0,'2019-11-01','2019-11-30','November','Schedule for month of November'),(2,0,'2019-12-01','2020-01-05','December','Schedule for month of December');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `heading` tinyint(1) NOT NULL,
  `colour` varchar(7) NOT NULL,
  `css_class` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'Treasures from God\'s Word',30,1,'#606970','treasures'),(2,'Apply Yourself to the Field Ministry',40,1,'#c18626','apply'),(3,'Living as Christians',50,1,'#961526','living'),(4,'Pre-amble',20,0,'',''),(5,'Post-amble',60,0,'',''),(6,'Meeting Title',10,1,'','');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,37,'admin','$2y$10$mFNHdEmwAdwKW2vnTBn62OrN0XVHxN.TPEiJBgkO7zcO.vgf2.FcG',1,'2017-05-04 11:38:11','2019-11-13 23:55:17');
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

-- Dump completed on 2019-11-14 22:47:16
