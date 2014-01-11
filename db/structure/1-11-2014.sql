-- MySQL dump 10.13  Distrib 5.6.12, for Win64 (x86_64)
--
-- Host: localhost    Database: tanguer
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
  `user_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  KEY `FK_a_dj_milonga_person_id` (`person_id`),
  KEY `FK_a_dj_milonga_user_id` (`user_id`),
  KEY `FK_a_dj_milonga_event_id` (`event_id`),
  CONSTRAINT `FK_a_dj_milonga_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_dj_milonga_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_dj_milonga_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `a_dj_practica`
--

DROP TABLE IF EXISTS `a_dj_practica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_dj_practica` (
  `event_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  KEY `FK_a_dj_practica_person_id` (`person_id`),
  KEY `FK_a_dj_practica_user_id` (`user_id`),
  KEY `FK_a_dj_practica_event_id` (`event_id`),
  CONSTRAINT `FK_a_dj_practica_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_dj_practica_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_dj_practica_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `a_instructor_class`
--

DROP TABLE IF EXISTS `a_instructor_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_instructor_class` (
  `event_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  KEY `FK_a_instructor_class_event_id` (`event_id`),
  KEY `FK_a_instructor_class_user_id` (`user_id`),
  KEY `FK_a_instructor_class_person_id` (`person_id`),
  CONSTRAINT `FK_a_instructor_class_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_instructor_class_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_instructor_class_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `a_instructor_practica`
--

DROP TABLE IF EXISTS `a_instructor_practica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_instructor_practica` (
  `event_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  KEY `FK_a_instructor_practica_event_id` (`event_id`),
  KEY `FK_a_instructor_practica_user_id` (`user_id`),
  KEY `FK_a_instructor_practica_person_id` (`person_id`),
  CONSTRAINT `FK_a_instructor_practica_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_instructor_practica_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_instructor_practica_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `a_performer_show`
--

DROP TABLE IF EXISTS `a_performer_show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_performer_show` (
  `event_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `person_id` int(10) unsigned DEFAULT NULL,
  KEY `FK_a_performer_show_event_id` (`event_id`),
  KEY `FK_a_performer_show_user_id` (`user_id`),
  KEY `FK_a_performer_show_person_id` (`person_id`),
  CONSTRAINT `FK_a_performer_show_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_performer_show_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_a_performer_show_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  UNIQUE KEY `UK_event_id` (`event_id`),
  KEY `FK_e_class_difficulty_id` (`difficulty_id`),
  CONSTRAINT `FK_e_class_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_class_difficulty_id` FOREIGN KEY (`difficulty_id`) REFERENCES `v_difficulty` (`difficulty_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `e_milonga`
--

DROP TABLE IF EXISTS `e_milonga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `e_milonga` (
  `event_id` int(10) unsigned NOT NULL,
  `min_age` tinyint(3) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `UK_event_id` (`event_id`),
  CONSTRAINT `FK_e_milonga_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  UNIQUE KEY `UK_event_id` (`event_id`),
  KEY `FK_e_practica_difficulty_id` (`difficulty_id`),
  CONSTRAINT `FK_e_practica_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_practica_difficulty_id` FOREIGN KEY (`difficulty_id`) REFERENCES `v_difficulty` (`difficulty_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `e_show`
--

DROP TABLE IF EXISTS `e_show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `e_show` (
  `event_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `UK_event_id` (`event_id`),
  CONSTRAINT `FK_e_show_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_type_id` tinyint(3) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `organizer_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `date_start` int(10) unsigned NOT NULL,
  `date_end` int(10) unsigned NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `repeats` enum('weekly','biweekly','monthly') DEFAULT NULL,
  `price` double(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`event_id`),
  KEY `FK_event_event_type_id` (`event_type_id`),
  KEY `FK_event_organizer_id` (`organizer_id`),
  KEY `FK_event_location_id` (`location_id`),
  CONSTRAINT `FK_event_location_id` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_event_event_type_id` FOREIGN KEY (`event_type_id`) REFERENCES `v_event_type` (`event_type_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_event_organizer_id` FOREIGN KEY (`organizer_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `location_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_name_id` int(10) unsigned DEFAULT NULL,
  `street_address_id` int(10) unsigned DEFAULT NULL,
  `city_id` mediumint(8) unsigned DEFAULT NULL,
  `state_id` mediumint(8) unsigned DEFAULT NULL,
  `country_id` smallint(5) unsigned DEFAULT NULL,
  `zip_id` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`location_id`),
  KEY `FK_location_place_name_id` (`place_name_id`),
  KEY `FK_location_street_address_id` (`street_address_id`),
  KEY `FK_location_city_id` (`city_id`),
  KEY `FK_location_state_id` (`state_id`),
  KEY `FK_location_country_id` (`country_id`),
  KEY `FK_location_zip_id` (`zip_id`),
  CONSTRAINT `FK_location_zip_id` FOREIGN KEY (`zip_id`) REFERENCES `v_zip` (`zip_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_location_city_id` FOREIGN KEY (`city_id`) REFERENCES `v_city` (`city_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_location_country_id` FOREIGN KEY (`country_id`) REFERENCES `v_country` (`country_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_location_place_name_id` FOREIGN KEY (`place_name_id`) REFERENCES `v_place_name` (`place_name_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_location_state_id` FOREIGN KEY (`state_id`) REFERENCES `v_state` (`state_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_location_street_address_id` FOREIGN KEY (`street_address_id`) REFERENCES `v_street_address` (`street_address_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=201426 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_user_person_id` (`person_id`),
  CONSTRAINT `FK_user_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_city`
--

DROP TABLE IF EXISTS `v_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_city` (
  `city_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(124) NOT NULL,
  `timezone_id` int(11) NOT NULL,
  PRIMARY KEY (`city_id`),
  UNIQUE KEY `city_name` (`city_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_country`
--

DROP TABLE IF EXISTS `v_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_country` (
  `country_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(64) NOT NULL,
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `country_name` (`country_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_difficulty`
--

DROP TABLE IF EXISTS `v_difficulty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_difficulty` (
  `difficulty_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `difficulty_en_US` varchar(32) NOT NULL,
  `difficulty_es_AR` varchar(32) NOT NULL,
  PRIMARY KEY (`difficulty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_event_type`
--

DROP TABLE IF EXISTS `v_event_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_event_type` (
  `event_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`event_type_id`),
  UNIQUE KEY `UK_event_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_place_name`
--

DROP TABLE IF EXISTS `v_place_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_place_name` (
  `place_name_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_name` varchar(128) NOT NULL,
  PRIMARY KEY (`place_name_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_state`
--

DROP TABLE IF EXISTS `v_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_state` (
  `state_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(124) NOT NULL,
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `state_name` (`state_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_street_address`
--

DROP TABLE IF EXISTS `v_street_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_street_address` (
  `street_address_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street_address` varchar(64) NOT NULL,
  PRIMARY KEY (`street_address_id`),
  UNIQUE KEY `street_address` (`street_address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_timezone`
--

DROP TABLE IF EXISTS `v_timezone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_timezone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timezone` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `timezone` (`timezone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `v_zip`
--

DROP TABLE IF EXISTS `v_zip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_zip` (
  `zip_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `zip` varchar(32) NOT NULL,
  PRIMARY KEY (`zip_id`),
  UNIQUE KEY `zip` (`zip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-11  1:02:36
