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
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_type_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `organizer_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `date_start` int(10) unsigned NOT NULL,
  `date_end` int(10) unsigned NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `repeats` enum('weekly','biweekly','monthly') DEFAULT NULL,
  `price` double(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`event_id`)
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
  `location_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_name_id` int(10) unsigned NOT NULL,
  `street_address_id` int(10) unsigned NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `zip_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`location_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=201426 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (201376,'Melina','Juanita'),(201377,'Patricio','PerÃ³n'),(201378,'James','Juanita'),(201379,'Julieta','Esponja'),(201380,'James','Jaime'),(201381,'Kevin','Miller'),(201382,'Leandra','Esponja'),(201383,'Irene','Josero'),(201384,'Melina','Mison'),(201385,'Melina','Levalle'),(201386,'Julieta','Josero'),(201387,'Julieta','Juanita'),(201388,'Julieta','Miller'),(201389,'Irene','Levalle'),(201390,'Alejandro','Esponja'),(201391,'Anita','Jackson'),(201392,'Leonardo','Pelotudo'),(201393,'John','Pelotudo'),(201394,'Patricia','PerÃ³n'),(201395,'Leonardo','Esponja'),(201396,'Kevin','Levalle'),(201397,'John','Jaime'),(201398,'Julieta','Pelotudo'),(201399,'Juan','Pelotudo'),(201400,'Alejandro','Pelotudo'),(201401,'Juan','Josero'),(201402,'Patricio','Juanita'),(201403,'Anita','Jaime'),(201404,'Jose','Miller'),(201405,'Anita','Josero'),(201406,'Patricia','Esponja'),(201407,'Leandra','PerÃ³n'),(201408,'Melina','PerÃ³n'),(201409,'Melina','Josero'),(201410,'Anita','Esponja'),(201411,'James','Jackson'),(201412,'Leonardo','Jaime'),(201413,'Patricia','Juanita'),(201414,'Patricia','Mison'),(201415,'Patricio','Jackson'),(201416,'Juan','Juanita'),(201417,'Patricio','Miller'),(201418,'Juan','Levalle'),(201419,'John','Juanita'),(201420,'Julieta','Mison'),(201421,'Juan','PerÃ³n'),(201422,'Anita','Levalle'),(201423,'Patricia','Pelotudo'),(201424,'Kevin','Pelotudo'),(201425,'Paola','Jaime');
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
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (16,201376,'Melina.Juanita@gmail.com','sha256:1000:oEK3Rs0ablW0cZYMiUYovnjlU/ynrrEo:flsqiJDIc7LmRndE3Iim9nJ1cadsamxh'),(17,201377,'Patricio.PerÃ³n@gmail.com','sha256:1000:1LavgulsCn8iQxDRwYrbwYWx55FTHeTA:jy8b5ZcoYzyV4kr4dzoYTqs040qEOgRG'),(18,201378,'James.Juanita@gmail.com','sha256:1000:zEce9MEM52KJjg9C7CNMuo7IzqkF2yql:LEJrNh2MmtmiU+kFRzDDD38QKG/LzrLH'),(19,201379,'Julieta.Esponja@gmail.com','sha256:1000:JBuGlLuqbK7DRLEFz604qyi4UyNvke8G:QZYQFUQWbmF1wcouAxiLuyJ19RoDoOLL'),(20,201380,'James.Jaime@gmail.com','sha256:1000:2jf9XXXtAiiUs5xj1YTXVo/L22FqSz0E:yij/RixVjqby8Pg7YRs5IzuXb4Ny1kcE'),(21,201381,'Kevin.Miller@gmail.com','sha256:1000:uFtB5xl083v4E9S9NK2mFzRhG8LDFVN4:DAWrFUgJoKNLrtWxejoWBZlyzt1Owdwa'),(22,201382,'Leandra.Esponja@gmail.com','sha256:1000:ZCXeQjd7zX7V5ZaZMf3dYc8r44tOOhZK:+YbFB7dvrl6ntHF9k0DpsymvNjQ7lXkt'),(23,201383,'Irene.Josero@gmail.com','sha256:1000:6KZZ0V0tvBw3tL8VxcYcV2e+5EGH8Wqs:ad8L+C62x/o44bIU0e8eEPRtTMNU86Vs'),(24,201384,'Melina.Mison@gmail.com','sha256:1000:T+PX8mqT5rDjxm0nYWEQvjfi5Wu2Zb6o:1nl3NVB67RfHJwhwobWsZIJxJiw9DCue'),(25,201385,'Melina.Levalle@gmail.com','sha256:1000:hTaTY1O5cC+O1VRRi5VVuHK2Wa/v5JL0:b2WOOrAYdt/tpLVzIdztIdYr8VaZ+ygW'),(26,201386,'Julieta.Josero@gmail.com','sha256:1000:oIAJDY7D1m2v35TrLU/yRhShUMW6yelY:DLVykfS8lWxvSdpuMapwBee6RwpWURif'),(27,201387,'Julieta.Juanita@gmail.com','sha256:1000:ijb2CLySPo9KHLJa6kodPuzoKHTeQWZM:58wuqguD1sgD6y7yvGSmNvQK+mKwmQeP'),(28,201388,'Julieta.Miller@gmail.com','sha256:1000:EI+gbG1NvpLPm4hFv6odiwRLUUPTT2Zr:cv3zggPfXmeMykdIxy8RZ3V6yFWXESof'),(29,201389,'Irene.Levalle@gmail.com','sha256:1000:mh+y5Oz7mbn6BTWGavpMDGbD5uyk7J7m:+5Lbu/q6cDdHrEoGuRuuDI4zQSNb4kzw'),(30,201390,'Alejandro.Esponja@gmail.com','sha256:1000:eDWZWzyLvTCPhEC97OE1M87eDFDVUllT:V0hA6Jzh3W+89ko2zf7mrNhK1OVLs3R6'),(31,201391,'Anita.Jackson@gmail.com','sha256:1000:mcSUOUY1/3YawyPul7mgTjr5cC2BtyAv:dSvzragVuBST4rkVyxzWYkk9HdngWY3G'),(32,201392,'Leonardo.Pelotudo@gmail.com','sha256:1000:KdSHtG1OXZkAdj9oOcGGIKTsUAfEjeod:U+NS2MYQrQq81J/iW5fWjtTIMC6S31h8'),(33,201393,'John.Pelotudo@gmail.com','sha256:1000:QLy0LFj2O+xHem7osOairmoQqY2JA+QZ:37rj9xAb6BQ6xk/uGS3ziuWVSRo3YlDL'),(34,201394,'Patricia.PerÃ³n@gmail.com','sha256:1000:pip8blwsVZCCTAQybhSwowzi2ezQzVEn:C94MOEtVIRjlKJWVLmNopCZKsjV3tg3L'),(35,201395,'Leonardo.Esponja@gmail.com','sha256:1000:PWlsAf793KCJRVJul6T36CRfgPDtI5s3:AHu6hhReYAvpuWMWRlLN8/AtfFVq4HwR'),(36,201396,'Kevin.Levalle@gmail.com','sha256:1000:IX/tznQPi/9Qu+K3VrZCI5udKqmBA8ao:Wk7F5qq1AOWYgOJW1S1DNkStypxEPfGs'),(37,201397,'John.Jaime@gmail.com','sha256:1000:U2XlJtTxXLrlmnbh02/lnhjhbFy3FZQG:XgFJCTxaNrampnZq5usEVaJuA2Mame1e'),(38,201398,'Julieta.Pelotudo@gmail.com','sha256:1000:Q5TflB54LQWNgbcFacsF+D0K/etI6AoY:ex0EQINtPI03MqszHQ6QLVqn7TT+Eea3'),(39,201399,'Juan.Pelotudo@gmail.com','sha256:1000:T4nivu3EcXpfN9EcUaNz+gpCteiFgPfd:iCo0Mijzcx1rd5OMrLgi35DcCMAFTo+2'),(40,201400,'Alejandro.Pelotudo@gmail.com','sha256:1000:CPJM5vkDRJmnlD6ekVrj/ogEeDj/RTsl:LMWJAcbWIsXHzhc01wsFTm6N/KU+S9lO'),(41,201401,'Juan.Josero@gmail.com','sha256:1000:ReV+c6necQRROlhk1uu/vIgI1zx4sYiJ:eAJc21B1KJuVi32OOh9lBx7QUMgtxL5S'),(42,201402,'Patricio.Juanita@gmail.com','sha256:1000:aN7QCVdmIVNR0c/v7B+7NytpegMZbhCl:pi1Zuk5q2gUIN1SEZPfAubCmmntYK2hT'),(43,201403,'Anita.Jaime@gmail.com','sha256:1000:cl86ao6M3gom5IwsvG1jM9BXfPoujJV4:Ha2jMOQUKnedZk8wdekwxAC8zuZKZsWl'),(44,201404,'Jose.Miller@gmail.com','sha256:1000:iECFV2RDxSHf7IXtFZRihM2kUC+WQwTp:/bq8r9NK/zl+Kz7GWS8LeaW37ZoKuf+Q'),(45,201405,'Anita.Josero@gmail.com','sha256:1000:socygptnOMsPQl5HYjEf2qpg6D1snfR+:7zMpC21WN50Jyqj3yxYvknbC8NhcczJx'),(46,201406,'Patricia.Esponja@gmail.com','sha256:1000:0/xEAQet9KoTL9Am7FCiFQ8apX2aHNLI:ldboA//EPEJLX1cu1YPJ5i+Kh5FImHAj'),(47,201407,'Leandra.PerÃ³n@gmail.com','sha256:1000:2HdnGye2PDhAVmroQlKVtP2UVR+U+o6j:AaqaCI1+L/KrsRpU3fjP1QnKUdCxji7i'),(48,201408,'Melina.PerÃ³n@gmail.com','sha256:1000:zx9qbFnYP6tLmDdLkh1dLrKsX8ghmi4p:Xpy26h+VGng9FeCJoxs+ub+HRa+0fzD5'),(49,201409,'Melina.Josero@gmail.com','sha256:1000:Beg1HHv9qNzqZI5uNrw+wZxeJqj1sHYb:NcqiX76RGBwELwWdZ3qfVnyWGMbZHD7i'),(50,201410,'Anita.Esponja@gmail.com','sha256:1000:ttFg2JVECJp2b/XHRId0aiPpmp6QgYD6:8ItjeDAdbnfG4KUY/7nTlRkZGoil9x2h'),(51,201411,'James.Jackson@gmail.com','sha256:1000:IzJNhK5+ZVqgWLJLiqdqHjCUXeR9FdPd:x6AySjfRHNEFxZuFgUiz4CFjMR15Pec2'),(52,201412,'Leonardo.Jaime@gmail.com','sha256:1000:aRVCjK30bx2tDurUfbOuaQGnPb5WAPi5:R5bwVcg5xQffALDT3POmapAqi7jwYZ4W'),(53,201413,'Patricia.Juanita@gmail.com','sha256:1000:g5mJqjBceTYXNm3Qg64Qd5CpGmDAOtj6:nOFI8C5Y4mmnQy/8NVDd9DrIZWipofHF'),(54,201414,'Patricia.Mison@gmail.com','sha256:1000:A9piQ8BrjyurVwwqEPx6bFUbm7H7aW6h:QEcYNO+8eblyAJqnAhPsok3AweKME+AF'),(55,201415,'Patricio.Jackson@gmail.com','sha256:1000:J3A/nIznky9nt/++j2ZMpPGSqQYeWWk8:zGQ4RMk+9jIFF8jEHRmwIObJMQhVTt19'),(56,201416,'Juan.Juanita@gmail.com','sha256:1000:Ng4vbqYP0suLRR4e+fMwzbkPpASmU07g:4CEKNeJm8PZox5G6VlqX4zuRWAsdApTC'),(57,201417,'Patricio.Miller@gmail.com','sha256:1000:ZRwcZpkNGw1dQJ1rHz15xaV9ITDeuoUo:JIdOJDtEMaZ/j407oHN6RLTqCigewVhD'),(58,201418,'Juan.Levalle@gmail.com','sha256:1000:ghI+pyruaUb8LvwH72y3LmFL/cclQyvV:4dJS5I/2X8PZ/gfTtKmQDPSX0ZVzBki8'),(59,201419,'John.Juanita@gmail.com','sha256:1000:PvNBjnoANTvIni8plCe1Vq27MoRjgZ7w:wwm+s+hW7n5z/RZUw+V0/ECfJSli815c'),(60,201420,'Julieta.Mison@gmail.com','sha256:1000:W6dJr20nCZilTD1WYhL2Z2ayCXVtLN8u:ujDCRVTHPiGv6RkZo4+4x7FLs9tmjAxY'),(61,201421,'Juan.PerÃ³n@gmail.com','sha256:1000:M/0q/PkHI+SrieGay60cRkeuRgFMPxuE:NIJF9U9XGuzMnK2VgVi05dSQHTxa+DfB'),(62,201422,'Anita.Levalle@gmail.com','sha256:1000:YFnbOpbKPiEnLDKRAfxi7rx8zBupkO29:oREhPsn4vaJsQQcXmtOUdwPVzB+GPPzz'),(63,201423,'Patricia.Pelotudo@gmail.com','sha256:1000:SOSpclASNwUudT15TZh9TvST0X9JIVie:/4vVTmmHcIegjK/4NYU001WY0C9i3bHN'),(64,201424,'Kevin.Pelotudo@gmail.com','sha256:1000:MqJBBpYTNBToNPlH4YeYeNENtEdp8qRQ:NjR7lhK6vjYM2yn/agk6aOmIspk++CSS'),(65,201425,'Paola.Jaime@gmail.com','sha256:1000:TwA2h0IkTJ9hT4dB5EbcLrQuGuZPonKa:EVry6KB/wfce1HbRTlRdf1BoBqdeGYb+');
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
  `timezone_id` int(11) NOT NULL,
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
-- Dumping data for table `v_timezone`
--

LOCK TABLES `v_timezone` WRITE;
/*!40000 ALTER TABLE `v_timezone` DISABLE KEYS */;
INSERT INTO `v_timezone` VALUES (2,'America/Buenos_Aires'),(1,'America/Rosario');
/*!40000 ALTER TABLE `v_timezone` ENABLE KEYS */;
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

-- Dump completed on 2014-01-07 21:38:20
