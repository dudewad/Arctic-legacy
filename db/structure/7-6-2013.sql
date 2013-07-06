-- MySQL dump 10.13  Distrib 5.5.24, for Win64 (x86)
--
-- Host: localhost    Database: tanguer
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `a_dj_milonga`
--

DROP TABLE IF EXISTS `a_dj_milonga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_dj_milonga` (
  `event_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`person_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_dj_milonga`
--

LOCK TABLES `a_dj_milonga` WRITE;
/*!40000 ALTER TABLE `a_dj_milonga` DISABLE KEYS */;
/*!40000 ALTER TABLE `a_dj_milonga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_dj_practica`
--

DROP TABLE IF EXISTS `a_dj_practica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_dj_practica` (
  `event_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`person_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_dj_practica`
--

LOCK TABLES `a_dj_practica` WRITE;
/*!40000 ALTER TABLE `a_dj_practica` DISABLE KEYS */;
/*!40000 ALTER TABLE `a_dj_practica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_instructor_class`
--

DROP TABLE IF EXISTS `a_instructor_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_instructor_class` (
  `event_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`person_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_instructor_class`
--

LOCK TABLES `a_instructor_class` WRITE;
/*!40000 ALTER TABLE `a_instructor_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `a_instructor_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_instructor_practica`
--

DROP TABLE IF EXISTS `a_instructor_practica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_instructor_practica` (
  `event_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`person_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_instructor_practica`
--

LOCK TABLES `a_instructor_practica` WRITE;
/*!40000 ALTER TABLE `a_instructor_practica` DISABLE KEYS */;
/*!40000 ALTER TABLE `a_instructor_practica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_performer_show`
--

DROP TABLE IF EXISTS `a_performer_show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_performer_show` (
  `event_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`person_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_performer_show`
--

LOCK TABLES `a_performer_show` WRITE;
/*!40000 ALTER TABLE `a_performer_show` DISABLE KEYS */;
/*!40000 ALTER TABLE `a_performer_show` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_class`
--

DROP TABLE IF EXISTS `e_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `e_class` (
  `event_id` int(10) unsigned NOT NULL,
  `difficulty_id` tinyint(3) unsigned DEFAULT NULL,
  `topic` varchar(64) DEFAULT NULL,
  UNIQUE KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_class`
--

LOCK TABLES `e_class` WRITE;
/*!40000 ALTER TABLE `e_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_milonga`
--

DROP TABLE IF EXISTS `e_milonga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `e_milonga` (
  `event_id` int(10) unsigned NOT NULL,
  `min_age` tinyint(3) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_milonga`
--

LOCK TABLES `e_milonga` WRITE;
/*!40000 ALTER TABLE `e_milonga` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_milonga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_practica`
--

DROP TABLE IF EXISTS `e_practica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `e_practica` (
  `event_id` int(10) unsigned NOT NULL,
  `difficulty_id` tinyint(3) unsigned DEFAULT NULL,
  `topic` varchar(64) DEFAULT NULL,
  UNIQUE KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_practica`
--

LOCK TABLES `e_practica` WRITE;
/*!40000 ALTER TABLE `e_practica` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_practica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_show`
--

DROP TABLE IF EXISTS `e_show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `e_show` (
  `event_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_show`
--

LOCK TABLES `e_show` WRITE;
/*!40000 ALTER TABLE `e_show` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_show` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `organizer_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `date_start` int(10) unsigned NOT NULL,
  `date_end` int(10) unsigned NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `repeats` enum('weekly','biweekly','monthly') DEFAULT NULL,
  `price` double(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_name_id` int(10) unsigned NOT NULL,
  `street_address_id` int(10) unsigned NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `zip_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `person_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_city`
--

DROP TABLE IF EXISTS `v_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_city` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(124) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_name` (`city_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_city`
--

LOCK TABLES `v_city` WRITE;
/*!40000 ALTER TABLE `v_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_country`
--

DROP TABLE IF EXISTS `v_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country_name` (`country_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_country`
--

LOCK TABLES `v_country` WRITE;
/*!40000 ALTER TABLE `v_country` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_difficulty`
--

DROP TABLE IF EXISTS `v_difficulty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_difficulty` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `difficulty_en_US` varchar(32) NOT NULL,
  `difficulty_es_AR` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_difficulty`
--

LOCK TABLES `v_difficulty` WRITE;
/*!40000 ALTER TABLE `v_difficulty` DISABLE KEYS */;
INSERT INTO `v_difficulty` VALUES (1,'basic','basico'),(2,'intermediate','intermedio'),(3,'advanced','avanzado');
/*!40000 ALTER TABLE `v_difficulty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_event_type`
--

DROP TABLE IF EXISTS `v_event_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_event_type` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_event_type`
--

LOCK TABLES `v_event_type` WRITE;
/*!40000 ALTER TABLE `v_event_type` DISABLE KEYS */;
INSERT INTO `v_event_type` VALUES (2,'class'),(1,'milonga'),(3,'practica'),(4,'show');
/*!40000 ALTER TABLE `v_event_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_place_name`
--

DROP TABLE IF EXISTS `v_place_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_place_name` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_place_name`
--

LOCK TABLES `v_place_name` WRITE;
/*!40000 ALTER TABLE `v_place_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_place_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_state`
--

DROP TABLE IF EXISTS `v_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_state` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(124) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `state_name` (`state_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_state`
--

LOCK TABLES `v_state` WRITE;
/*!40000 ALTER TABLE `v_state` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_street_address`
--

DROP TABLE IF EXISTS `v_street_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_street_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street_address` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `street_address` (`street_address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_street_address`
--

LOCK TABLES `v_street_address` WRITE;
/*!40000 ALTER TABLE `v_street_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_street_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_zip`
--

DROP TABLE IF EXISTS `v_zip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_zip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zip` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `zip` (`zip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_zip`
--

LOCK TABLES `v_zip` WRITE;
/*!40000 ALTER TABLE `v_zip` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_zip` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-06 15:44:57
