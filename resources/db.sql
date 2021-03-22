-- MySQL dump 10.13  Distrib 8.0.23, for osx10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: rumsrv
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `check_process`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `check_process` (
  `id` int NOT NULL AUTO_INCREMENT,
  `node` int NOT NULL,
  `module` int NOT NULL,
  `net` int DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_C0015616857FE845` (`node`),
  KEY `IDX_C0015616C242628` (`module`),
  KEY `IDX_C0015616F2EA15FF` (`net`),
  CONSTRAINT `FK_C0015616857FE845` FOREIGN KEY (`node`) REFERENCES `node` (`id`),
  CONSTRAINT `FK_C0015616C242628` FOREIGN KEY (`module`) REFERENCES `module` (`id`),
  CONSTRAINT `FK_C0015616F2EA15FF` FOREIGN KEY (`net`) REFERENCES `ipv4class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `check_process`
--


--
-- Table structure for table `dw_f_ip`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dw_f_ip` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `hostid` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `hosts` int NOT NULL,
  `smtp` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dw_f_ip`
--


--
-- Temporary view structure for view `dw_f_ip_d`
--

SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `dw_f_ip_d` AS SELECT 
 1 AS `date`,
 1 AS `hosts`,
 1 AS `smtp25`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `dw_f_ip_m`
--

SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `dw_f_ip_m` AS SELECT 
 1 AS `date`,
 1 AS `hosts_formated`,
 1 AS `hosts`,
 1 AS `smtp25`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `host`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `host` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `n` int NOT NULL DEFAULT '1',
  `t` int NOT NULL DEFAULT '1',
  `s` int NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CF2713FD5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host`
--


--
-- Table structure for table `ipv4_reserved`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ipv4_reserved` (
  `ip` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `mask` int NOT NULL,
  PRIMARY KEY (`ip`,`mask`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipv4_reserved`
--

INSERT INTO `ipv4_reserved` VALUES ('0.0.0.0',8),('10.0.0.0',8),('100.64.0.0',10),('127.0.0.0',8),('169.254.0.0',16),('172.16.0.0',12),('192.0.0.0',24),('192.0.2.0',24),('192.168.0.0',16),('192.88.99.0',24),('198.18.0.0',15),('198.51.100.0',24),('203.0.113.0',24),('224.0.0.0',4),('240.0.0.0',4),('255.255.255.255',32);

--
-- Table structure for table `ipv4class`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ipv4class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` int DEFAULT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mask` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_81A3FCE97B00651C` (`status`),
  CONSTRAINT `FK_81A3FCE97B00651C` FOREIGN KEY (`status`) REFERENCES `ipv4class_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipv4class`
--


--
-- Table structure for table `ipv4class_status`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ipv4class_status` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_idx` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ipv4class_status`
--

INSERT INTO `ipv4class_status` VALUES (2,'finished'),(3,'on hold'),(1,'todo');

--
-- Table structure for table `module`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `result_tab` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

INSERT INTO `module` VALUES (1,'smtp','smtp'),(2,'smtp-sender','smtp_sender');

--
-- Temporary view structure for view `nlc_active_dead`
--

SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `nlc_active_dead` AS SELECT 
 1 AS `hostid`,
 1 AS `activ_nodes`,
 1 AS `dead_nodes`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `node`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `node` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` int DEFAULT NULL,
  `hid` int DEFAULT NULL,
  `cid` int NOT NULL,
  `stime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_857FE8457B00651C` (`status`),
  KEY `IDX_857FE84547653625` (`hid`),
  CONSTRAINT `FK_857FE84547653625` FOREIGN KEY (`hid`) REFERENCES `host` (`id`),
  CONSTRAINT `FK_857FE8457B00651C` FOREIGN KEY (`status`) REFERENCES `node_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--


--
-- Temporary view structure for view `node_last_check`
--

SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `node_last_check` AS SELECT 
 1 AS `host`,
 1 AS `nodeid`,
 1 AS `stime`,
 1 AS `ip`,
 1 AS `mask`,
 1 AS `lastcheck`,
 1 AS `minutes ago`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `node_status`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `node_status` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_idx` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node_status`
--

INSERT INTO `node_status` VALUES (1,'done'),(2,'incomplete'),(3,'running');

--
-- Table structure for table `smtp`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `smtp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `checkid` int NOT NULL,
  `ip` int NOT NULL,
  `port` int NOT NULL,
  `helo` longtext COLLATE utf8_unicode_ci,
  `helo_code` int DEFAULT NULL,
  `ehlo` longtext COLLATE utf8_unicode_ci,
  `ehlo_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `greetings_code` int DEFAULT NULL,
  `greetings_text` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checktime` datetime DEFAULT NULL,
  `tstart` time DEFAULT NULL,
  `tcon` time DEFAULT NULL,
  `tend` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_39745D31B6F58F` (`checkid`),
  CONSTRAINT `FK_39745D31B6F58F` FOREIGN KEY (`checkid`) REFERENCES `check_process` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smtp`
--


--
-- Table structure for table `smtp_sender`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `smtp_sender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `checkid` int NOT NULL,
  `smtpid` int NOT NULL,
  `status` int DEFAULT NULL,
  `msg` longtext COLLATE utf8_unicode_ci NOT NULL,
  `conn_log` longtext COLLATE utf8_unicode_ci,
  `create_time` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_121E7BA51B6F58F` (`checkid`),
  KEY `IDX_121E7BA5139A4704` (`smtpid`),
  KEY `IDX_121E7BA57B00651C` (`status`),
  CONSTRAINT `FK_121E7BA5139A4704` FOREIGN KEY (`smtpid`) REFERENCES `smtp` (`id`),
  CONSTRAINT `FK_121E7BA51B6F58F` FOREIGN KEY (`checkid`) REFERENCES `check_process` (`id`),
  CONSTRAINT `FK_121E7BA57B00651C` FOREIGN KEY (`status`) REFERENCES `smtp_sender_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smtp_sender`
--


--
-- Table structure for table `smtp_sender_status`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `smtp_sender_status` (
  `id` int NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_idx` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smtp_sender_status`
--

INSERT INTO `smtp_sender_status` VALUES (1,'done'),(2,'in progress');

--
-- Dumping routines for database 'rumsrv'
--
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `etl_f_ip`()
BEGIN

    declare lastcheck date; -- default 0;
    declare difference int; -- default 0;

    select `date` into lastcheck from dw_f_ip order by id desc limit 1;
    select datediff(lastcheck, curdate()) into difference;

    IF difference < -1 THEN
      INSERT INTO dw_f_ip (`date`, `hostid`, `hosts`, `smtp`)
        SELECT cast( s.checktime AS date ) AS `date`
          ,h.id as hostid
          ,count( s.id ) AS `hosts`
          ,count( s.tcon ) AS smtp
        FROM smtp s
          INNER JOIN `check` c ON s.checkid = c.id
          INNER JOIN node n ON c.node = n.id
          INNER JOIN host h ON n.hid = h.id
        WHERE s.checktime >= date_add(lastcheck, INTERVAL 1 DAY)
              AND s.checktime < curdate()
        GROUP BY cast( s.checktime AS date ), h.id;
    END IF;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `node_status_update`()
BEGIN

    -- usuniecie juz nieaktywnych nodow
    update node
    set status = 'done'
    where id in (select nodeid
                 from node_last_check
                 where `minutes ago` > 30);

    -- usuniecie bledow
    /*
    UPDATE node
      SET STATUS = 'incomplete'
    WHERE STATUS = 'running'
      AND id NOT IN (SELECT nodeid FROM `rnodes`);
    */

    -- tymczasowo tutaj
    /*
    UPDATE smtp
      SET netint = inet_aton( substring_index( `ip` , '.', 2 ))
    WHERE netint = 0;
    */
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `smtp_garbage_collector`()
BEGIN
    DELETE s
    FROM smtp s
      LEFT JOIN `check` c ON c.id = s.checkid
      LEFT JOIN ipv4class i ON c.net = i.id
    WHERE
      i.status = 'FINISHED'
      AND s.tcon IS NULL
      AND cast( s.checktime AS date )
          <= (SELECT `date` FROM dw_f_ip ORDER BY `date` DESC LIMIT 1);
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `dw_f_ip_d`
--

/*!50001 DROP VIEW IF EXISTS `dw_f_ip_d`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `dw_f_ip_d` AS select date_format(`dw_f_ip`.`date`,'%Y-%m-%d') AS `date`,format(sum(`dw_f_ip`.`hosts`),0) AS `hosts`,format(sum(`dw_f_ip`.`smtp`),0) AS `smtp25` from `dw_f_ip` group by date_format(`dw_f_ip`.`date`,'%Y-%m-%d') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `dw_f_ip_m`
--

/*!50001 DROP VIEW IF EXISTS `dw_f_ip_m`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `dw_f_ip_m` AS select date_format(`dw_f_ip`.`date`,'%Y-%m') AS `date`,format(sum(`dw_f_ip`.`hosts`),0) AS `hosts_formated`,sum(`dw_f_ip`.`hosts`) AS `hosts`,sum(`dw_f_ip`.`smtp`) AS `smtp25` from `dw_f_ip` group by date_format(`dw_f_ip`.`date`,'%Y-%m') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `nlc_active_dead`
--

/*!50001 DROP VIEW IF EXISTS `nlc_active_dead`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `nlc_active_dead` AS select `node_last_check`.`host` AS `hostid`,count(if((`node_last_check`.`minutes ago` = 0),1,NULL)) AS `activ_nodes`,count(if((`node_last_check`.`minutes ago` > 0),1,NULL)) AS `dead_nodes` from `node_last_check` group by `node_last_check`.`host` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `node_last_check`
--

/*!50001 DROP VIEW IF EXISTS `node_last_check`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `node_last_check` AS select `n`.`hid` AS `host`,`n`.`id` AS `nodeid`,`n`.`stime` AS `stime`,`i`.`ip` AS `ip`,`i`.`mask` AS `mask`,(case when (max(`s`.`checktime`) is not null) then max(`s`.`checktime`) else `n`.`stime` end) AS `lastcheck`,(case when (max(`s`.`checktime`) is not null) then timestampdiff(MINUTE,max(`s`.`checktime`),now()) else timestampdiff(MINUTE,`n`.`stime`,now()) end) AS `minutes ago` from (((`node` `n` join `check_process` `c` on((`n`.`id` = `c`.`node`))) join `ipv4class` `i` on((`c`.`net` = `i`.`id`))) left join `smtp` `s` on((`c`.`id` = `s`.`checkid`))) where (`n`.`status` = 'running') group by `n`.`hid`,`n`.`id`,`n`.`stime`,`i`.`ip`,`i`.`mask` order by (case when (max(`s`.`checktime`) is not null) then max(`s`.`checktime`) else `n`.`stime` end) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-22 10:31:10
