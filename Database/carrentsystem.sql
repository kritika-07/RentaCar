-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: car_rent
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agency_signup`
--

DROP TABLE IF EXISTS `agency_signup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agency_signup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agency_signup`
--

LOCK TABLES `agency_signup` WRITE;
/*!40000 ALTER TABLE `agency_signup` DISABLE KEYS */;
INSERT INTO `agency_signup` VALUES (1,'deepak','deepakm@gmail.com','123456'),(2,'Shivam','scars@gmail.com','123456'),(3,'Amisha','arentals@gmail.com','123456'),(4,'Tripathis','tripathirentals@gmail.com','$2y$10$2/1Dg2o/B7yWuuavxqBL1umwaZ02iH8myCLlqUQteoaIOwumhsT2q');
/*!40000 ALTER TABLE `agency_signup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `car_booking`
--

DROP TABLE IF EXISTS `car_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `del_address` varchar(100) DEFAULT NULL,
  `no_of_days` int(11) DEFAULT NULL,
  `start_dt` date DEFAULT NULL,
  `end_dt` date DEFAULT NULL,
  `agency` varchar(50) DEFAULT NULL,
  `car` varchar(50) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `car_id` (`car_id`),
  CONSTRAINT `car_booking_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `signup` (`id`),
  CONSTRAINT `car_booking_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car_booking`
--

LOCK TABLES `car_booking` WRITE;
/*!40000 ALTER TABLE `car_booking` DISABLE KEYS */;
INSERT INTO `car_booking` VALUES (1,'Kritika Manchanda','Kritika','9312094050','C-105 Ramesh Nagar New Delhi-15',7,'2024-08-05','2024-08-12','2',NULL,1,3),(3,'Munna Tripathi','Munna','8276901184','Tripathi House, Mblock, Sulatanpuri, Delhi-6',3,'2024-07-16','2024-07-19','1',NULL,3,2),(4,'Shanaya khanna','Shanaya','9625478945','ramesh nagar',5,'2024-07-29','2024-08-03','3',NULL,2,6),(5,'Munna Tripathi','Munna','9658472284','D-23 Sultanpuri, New Delhi-6 ',2,'2024-07-16','2024-07-18','4',NULL,3,9),(6,'Bree Van De Kamp','Bree Van de Kamp','7773334444','2345 saket new delhi',3,'2024-07-23','2024-07-26','4',NULL,8,7);
/*!40000 ALTER TABLE `car_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `car_details`
--

DROP TABLE IF EXISTS `car_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(100) NOT NULL,
  `number` varchar(50) NOT NULL,
  `seat_cap` int(11) NOT NULL,
  `rent` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`),
  KEY `agency_id` (`agency_id`),
  CONSTRAINT `car_details_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency_signup` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car_details`
--

LOCK TABLES `car_details` WRITE;
/*!40000 ALTER TABLE `car_details` DISABLE KEYS */;
INSERT INTO `car_details` VALUES (1,'MARUTI SUZUKI GRAND VITARA','DL10CX5453',5,1500,'grand_vitara.jpeg',1),(2,'HYUNDAI CRETA','DL10DB7777',5,1500,'creta.jpg',1),(3,'SKODA Slavia','DL14CD0708',5,1600,'slavia.jpg',2),(4,'MAHINDRA SCORPIO','HR26DQ5551',5,1800,'Mahindra_Scorpio.jpg',2),(5,'MG HECTOR','DL7CQ1939',7,2000,'MG-HECTOR.jpg',2),(6,'TATA SAFARI','22BH6517A',5,1600,'Tata_Safari.jpg',3),(7,'Mahindra Thar','Dl10BB9965',5,2500,'thar.jpg',4),(8,'Toyota Innova','Dl10CAE4666',7,1800,'innova.jpg',NULL),(9,'Hyundai Grand i10 NIOS','DL10CA4666',5,800,'Grandi10.jpg',4);
/*!40000 ALTER TABLE `car_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `signup`
--

DROP TABLE IF EXISTS `signup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `signup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `signup`
--

LOCK TABLES `signup` WRITE;
/*!40000 ALTER TABLE `signup` DISABLE KEYS */;
INSERT INTO `signup` VALUES (1,'Kritika','mkritika@gmail.com','$2y$10$bZHO2JMG4zpOG1VwXQRrLO1FT8lNU0Ax8bkzAXblLQvQ02/Iytqm.'),(2,'Shanaya','skhanna@gmail.com','$2y$10$x5LDFJ/q4aup7vQtg.adDegEOubKX6jsCUz87z.YPGQrChG4Imq2u'),(3,'Munna','kingofmirzapur@yahoo.com','$2y$10$LKIKo3KeNc84WfcuP1jiV.tgxV9rLF/60oudDfjLDQJEFwMFNrbGG'),(4,'Mayank','maycha@gmail.com','$2y$10$JOMtKNyph/mo6txSYW6UR.EXwyHr1tmJstGhcQ5jtu6dWP6MLa/iu'),(7,'Sameer','sam@gmail.com','$2y$10$gh89vWNWaFFY8wvoDpHjLOA6MBoUiilh7McqOz98Z.ZDtXFGmCGb.'),(8,'Bree Van de Kamp','bree@gmail.com','$2y$10$WdrWmmUsnuC.AymTIuhTSOJc5mHq6njCA7MqJQ7pjbSmf7V070bxu');
/*!40000 ALTER TABLE `signup` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-14 19:00:46
