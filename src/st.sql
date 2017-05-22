-- MySQL dump 10.13  Distrib 5.1.36, for Win32 (ia32)
--
-- Host: localhost    Database: seutube
-- ------------------------------------------------------
-- Server version	5.1.36-community-log

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
-- Table structure for table `st_favs`
--

DROP TABLE IF EXISTS `st_favs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_favs` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_friends`
--

DROP TABLE IF EXISTS `st_friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_friends` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `fuid` int(11) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_gbook`
--

DROP TABLE IF EXISTS `st_gbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_gbook` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `content` varchar(140) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_mblog`
--

DROP TABLE IF EXISTS `st_mblog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_mblog` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `t` varchar(140) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_movie`
--

DROP TABLE IF EXISTS `st_movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_movie` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `upload_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(50) NOT NULL,
  `description` varchar(140) NOT NULL,
  `pop` int(11) DEFAULT '0',
  PRIMARY KEY (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_rates`
--

DROP TABLE IF EXISTS `st_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_rates` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `rate` int(11) DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_recent`
--

DROP TABLE IF EXISTS `st_recent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_recent` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `v0` int(11) DEFAULT NULL,
  `v1` int(11) DEFAULT NULL,
  `v2` int(11) DEFAULT NULL,
  `v3` int(11) DEFAULT NULL,
  `v4` int(11) DEFAULT NULL,
  `v5` int(11) DEFAULT NULL,
  `v6` int(11) DEFAULT NULL,
  `v7` int(11) DEFAULT NULL,
  `v8` int(11) DEFAULT NULL,
  `v9` int(11) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_tags`
--

DROP TABLE IF EXISTS `st_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_tags` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) DEFAULT NULL,
  `tag` varchar(32) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_url`
--

DROP TABLE IF EXISTS `st_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_url` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(2048) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `st_user`
--

DROP TABLE IF EXISTS `st_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pop` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(255) NOT NULL,
  `video_per_page` int(11) NOT NULL DEFAULT '10',
  `score` int(11) NOT NULL DEFAULT '50',
  `reg_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_name` varchar(16) DEFAULT NULL,
  `mb_bio` varchar(140) DEFAULT NULL,
  `mb_num` int(11) DEFAULT '10',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-12-18 19:23:47
