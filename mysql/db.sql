CREATE DATABASE  IF NOT EXISTS `API_CALCULATOR` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `API_CALCULATOR`;
-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: API_CALCULATOR
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

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
-- Table structure for table `Record`
--

DROP TABLE IF EXISTS `Record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cost` double NOT NULL,
  `user_balance` double NOT NULL DEFAULT '0',
  `service_response` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_User_idx` (`user_id`),
  KEY `FK_Service_idx` (`service_id`),
  CONSTRAINT `FK_Service` FOREIGN KEY (`service_id`) REFERENCES `Service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_User` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Record`
--

LOCK TABLES `Record` WRITE;
/*!40000 ALTER TABLE `Record` DISABLE KEYS */;
INSERT INTO `Record` VALUES (1,'cde149d5-0d62-4918-86ab-56d0185aad81',4,99,5,25,'1.8','2021-04-03 23:41:53','active'),(2,'3f96d8dc-f547-49e7-b92f-8c16c6e1e439',4,4,5,20,'1.9','2021-04-03 23:38:08','inactive'),(3,'c9aae87d-1f53-4d1b-9321-865b1e0d066f',4,99,4,52,'5.75','2021-04-04 03:45:17','active'),(4,'ed7cd67f-dd14-449f-b308-0c76dbcd838b',8,99,1,51,'11','2021-04-04 03:55:36','active'),(5,'15031297-a354-4980-ab52-3bf263c44cb4',1,99,3,48,'uNbUrOvo4dj0WQCazkh32738jdnf7nSvzr1Zk13ErWqymRtzcV6etU6nFP604wY9pxISSux2XHVh1OE1','2021-04-04 03:56:47','active'),(6,'f834f1d7-5227-480d-b1f7-0a079b2e0930',1,99,3,45,'qAbAuctsUIYne9SxorK4h2qY3Nqhsx7RGYITxUynTtbizc1CzM6BDIDQ8RlR5Wa93ckHpBLrgElmK7KC','2021-04-04 03:59:20','active'),(7,'249c5684-44c7-4540-bcff-526d2ce48b6c',1,99,3,42,'folNUEQPH0pPCOvumutohOrQjObuGrIrQ2hi0moif4fJfCFnGGXdKZlOL4rqdt4B26jPyFpVrI7AP5Rs','2021-04-04 04:00:15','active'),(8,'92156d85-fcc3-4f92-9bfc-7887dcc2a843',1,99,3,39,'cnrmG2OS9qi3vNxxKHMmmquyPrMlz50z4MNuD2x7JLOuqhVpXkaa6uqYB7UYncPm6FJX6ec2umKuG6jp','2021-04-04 04:06:58','active'),(9,'b910ca35-897b-489b-a9ac-ecc12bd56658',1,99,3,36,'i4YjxvcbeLG0uQ4uBn1JXK8RL1Aukm2U6gqdjVWc0c7QvP7y3dBEQLYn2Os0yG13L4FYpoSzUtSaRFMg','2021-04-04 04:07:45','active'),(10,'f4a87f99-22ea-4e4b-90fe-489c87262899',2,99,3,33,'1','2021-04-04 04:07:55','active'),(11,'9f854434-46ee-488b-a00c-77c588a4a2c9',2,99,3,30,'2','2021-04-04 04:08:19','active'),(12,'e6bbfe22-52a7-4dd6-bf9b-14461b7184e0',4,99,4,26,'9','2021-04-04 04:08:31','active'),(13,'fe080702-2d2b-4827-8040-7da9c472de28',1,99,3,23,'57wFyKpNvMmpE6gPlfVEQ8pMEm0rI0zlA9tiqcVVxIo3x1XTWkYj2M48uUi5Q9ILKYJOG4CCvdTDD6XG','2021-04-04 04:13:17','active'),(14,'7bc749c5-2746-4a62-8432-e55279877ef6',1,99,3,20,'sKlHRXU1SXOjogYmnsEYA7uDmMn3bJ0j3rciWbmHip9bj6IC4sUo90xGn1GECaY4QtQx2WLAxzIfJLNx','2021-04-04 11:35:33','active'),(15,'9053d9a0-4d44-48c6-8ea9-b24a832bdfc6',1,99,3,17,'JmeCpqVYg1xS11ssV2g64OpG244hnsw9HQzhbzlJxPBegJ35HCyVrGu9Sbf1jUdJnV3cRBNR4RSwJZXF','2021-04-04 13:44:49','active'),(16,'d3313059-37e4-47ca-9981-00762fce1d42',1,99,3,14,'aGAIEC75uSU5zyhThUbs3HXGIzWnVF96OxrICP6iN7pHHvXpp574276tanJGjziP19kwpQltFpirdy6s','2021-04-04 13:47:39','active'),(17,'c450fef4-7093-4868-a30c-4c9aceb24fee',1,99,3,11,'9RfU02kTyXK0cPVTHNA9B8am1RIraqz9EwWNVyGAqbjL9XwQFGHjoRA8hMeXV6m7UKIWogBGoMe9mqI2','2021-04-04 13:47:44','active'),(18,'4533f700-8e64-4b76-9328-e449eddec884',1,99,3,8,'P5n9oBdmOzzr9yw9p6J04fv0QVnZe2fEYPrBvKkLNrT2f71rFd00tNhbGjLafAGxOZTc73loNpjHnrPk','2021-04-04 13:47:46','active'),(19,'8d0fb1a1-10cb-4f06-bdc2-c008bb809fee',1,99,3,5,'EwMnwwciFvYOCys5L99oayowSrFsfBfm8gyXEMMtUdNqIlpQjL5kdUcP8UqxDmGhe5zTeWdKZ1N5rkcT','2021-04-04 13:47:48','active'),(20,'24aabd8e-d5e4-432f-98ae-905886920e9b',1,99,3,2,'flHK1wFnWBNXPfzoIYU0V4wFJwNSY78YTWAQfG0udZnSGYitAx0MsFOxTXcJ9lKGBdFfRNXsVUZ1Ig2u','2021-04-04 14:04:39','active'),(21,'9127a980-8f30-4a24-a407-0dd8ea8587f0',8,99,1,1,'11','2021-04-04 14:33:45','active'),(22,'036b571c-e1b4-4b17-8bb6-8fe05d5113f0',1,99,3,997,'nRKADlVLyeFax254sw7mqM1owtuxDmBC27twiXOjf2hLglNS8wX9GDWHV7IhSaOhlpD7Yw8o4J7OwxHp','2021-04-04 14:36:56','active'),(23,'18c185a0-e25d-45c4-8552-74500735b6d1',2,99,3,994,'2','2021-04-04 14:37:04','active'),(24,'b33f8156-5739-474c-8f12-78ae8269c7c6',4,99,4,990,'9','2021-04-04 14:37:14','active'),(25,'80ebbc14-6381-4a7d-931e-4d1584393125',5,99,4,986,'2.4494897427832','2021-04-04 14:37:21','active'),(26,'5beb050f-fbeb-4928-bf2d-dd31215c506f',6,99,2,984,'54','2021-04-04 14:37:29','active'),(27,'bf0c0b3d-385d-455d-8811-d760e2cdfec5',8,99,1,983,'11','2021-04-04 14:37:39','active'),(28,'d096279a-127a-485d-b9a2-f0ce99c12728',3,99,2,981,'-1','2021-04-04 14:37:44','active'),(29,'772d152a-de24-4910-9873-21f07b495da9',3,99,2,979,'16','2021-04-04 14:38:36','active'),(30,'d46b27b3-0b2d-4c2e-9fa2-5398391512fd',3,99,2,977,'16','2021-04-04 14:38:46','active'),(31,'e3d4efd9-aad1-4bf3-9dd5-787c3e4c65be',4,99,4,973,'225','2021-04-04 14:39:20','active'),(32,'d6965303-15b0-4f5d-a7fc-385487d6406d',4,99,4,969,'225','2021-04-04 14:39:33','active'),(33,'faae7853-07b6-4fea-be8d-3961ffce3a0a',4,99,4,965,'2.7777777777778','2021-04-04 14:39:39','active'),(34,'fcda1991-d66b-4abe-bd1f-76193815c156',1,99,3,962,'eQPKKhGPCXcvlGkF0cerlL6WoFqpVSCOdyNcFZ9cd5OcflDlycYejNJ7AxxWNC9d9m24IjzyOkYBoKFY','2021-04-04 14:39:50','active'),(35,'6f3aa221-f795-4adc-b98a-6bb5197a6791',1,99,3,959,'8KPAY4R6ztRgZcXCsVhiZyM2AuYRg9FddEEOQ8Gz23PogF2nhhXnZdTHH9hcMIJTugqELB4iCeDMXQ9u','2021-04-04 14:40:03','active'),(36,'f1ae150e-cdf1-4c28-97df-fd503438c724',1,3,3,47,'GFrYtHmOxyUG9HsyYsGgFJCxKerrh8bFxZh9tx3nlqaY5fF3vhJSfNQd9odHNniOJ60H3A6eY5xgy2fX','2021-04-04 16:23:39','active'),(37,'1428319c-4381-4636-a291-cde08fd7a646',1,99,3,956,'dGA4IRMFu5N9FAbZbvWSf8Z538zl7PZvaLKwYSBSXFwqXatM1m2SZpu6XopDxm09uaFkzu6WOfyGqUFr','2021-04-05 00:12:43','active');
/*!40000 ALTER TABLE `Record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Service`
--

DROP TABLE IF EXISTS `Service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `type` enum('addition','subtraction','multiplication','division','square_root','free_form','random_string') NOT NULL,
  `cost` double NOT NULL,
  `status` enum('active','beta','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Service`
--

LOCK TABLES `Service` WRITE;
/*!40000 ALTER TABLE `Service` DISABLE KEYS */;
INSERT INTO `Service` VALUES (1,'fad1efc1-b8da-3480-a308-f8697e3e204d','random_string',3,'active'),(2,'b77b58c8-92b6-395d-9819-3e19241d5d09','division',3,'active'),(3,'2cb96814-6f3f-36ec-b219-e6fedbcec756','subtraction',2,'active'),(4,'839258fc-0f2b-35d1-8764-50fa044913f7','free_form',4,'active'),(5,'5c2f54a8-b578-3b80-a845-3a4213187dee','square_root',4,'active'),(6,'3b38ac99-bd31-34e8-a180-e8f4b351f4c1','multiplication',2,'active'),(7,'83b619af-4a2b-3338-bc26-0d23d53c97b4','addition',1,'inactive'),(8,'26f22eec-37f8-40a3-81de-6df1b0421d85','addition',1,'active');
/*!40000 ALTER TABLE `Service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `status` enum('active','trial','inactive') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (3,'9b6be909-9385-3996-bc0d-296830a96324','evalyn09@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',47,'active'),(4,'8cb0329f-f82d-320a-8889-eee8006cd1eb','qcummerata@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',20,'inactive'),(5,'18aa8c7a-b184-38ed-a404-794ab54352c8','rowan.hayes@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(6,'593bc92e-a49f-3610-8474-d4e6f939895c','mitchell.alisha@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(7,'5fdc8327-c25a-3d90-92c6-6b4b6dc64d7c','giuseppe06@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(8,'166245d2-76bf-3993-9fcb-b912fef3f944','lakin.garrick@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(9,'e25b255b-065e-30bc-9be8-af8e64619b34','viva.hilpert@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(10,'67cf2ba5-b323-384d-8b33-e0e56cc6129a','ashlee.russel@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',25,'inactive'),(11,'23cc0441-eb1e-345e-be08-91f9a39d2f26','lizeth.goyette@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(12,'f1827d02-3f95-3629-83ff-b09f953e34df','irodriguez@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(13,'3cd5e8c5-d380-3aff-a1db-b2161990622f','feeney.mittie@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(14,'28196a1e-833c-3fb4-9f42-a6b3ad6ed005','dickens.jayce@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(16,'b9402ffa-c387-32ca-9cd7-b9dc8b7f4446','dwolff@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(18,'af527b8d-f87f-33fb-82f4-4bcda45c9251','dkoss@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',26,'inactive'),(20,'07892ff6-d15d-31be-bedd-7698a83ba005','murphy.reta@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',33,'active'),(22,'d7b0cd72-dd24-3ba3-96fa-db405537bfc9','qwest@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(23,'ed6f1921-6e2c-3d05-9cd9-8e65e48d1098','chloe61@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(24,'7527b3aa-de6c-3127-be76-d93ce9f23434','dangelo.stokes@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(25,'f00ef8ed-8b6e-3da5-8e94-ad22ab6b7fbc','kiley99@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(26,'5a3079cb-d98c-38dc-b356-d4a39885240b','koelpin.amya@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(27,'c254ade7-9362-3dee-82ec-34b1d77582e3','stanton.delbert@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(29,'57b8248f-f2b5-3996-b316-05c4b2efc878','shanna85@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(31,'0384edcc-6794-39fe-b6d6-847d8be7d6fc','king.lewis@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(32,'44d00e7b-3504-335e-b4dc-698a901807f3','olga.konopelski@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(34,'9ea8bf84-6eae-354d-8518-9f135f313262','ortiz.kevin@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(37,'9c7c46e6-46ee-33c3-8260-136f62a17851','vbradtke@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(38,'df6dc7cf-d1cc-38a6-a1ec-b2743ea72194','swaniawski.lorenz@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',22,'active'),(39,'87265ce6-a2f0-3b9d-a370-718c4372b364','lwiza@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(40,'fd0a0443-475a-3068-92df-2828b096b4be','lon.shields@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(41,'8e9407fa-e3a7-3f2b-80e4-6b7debcc054c','general47@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(43,'7d1079c8-0b4d-3f70-bb30-818f5e429138','gretchen.oberbrunner@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(45,'46f6ef34-b9f7-33b2-9ddd-f175a9e2a07d','wuckert.clifford@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(46,'8b288a79-ff5d-3b20-8ff2-f3c1adf56c6a','abraham.collier@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(47,'0b044ceb-b30a-378c-89d8-f64b2a2c02e8','jerde.shyann@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(49,'a8aac4ee-3865-30fb-b97e-f66f32441b04','art.toy@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(50,'5e772cbe-be94-3cf0-83b5-d693d0ed1312','jbreitenberg@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(52,'77e302b0-747c-3178-9821-32b83a96b0f5','enos49@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(53,'18357c32-49c8-37ce-8bfc-ae49326a8462','alysa.considine@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(54,'54b8e8d0-b50a-3388-a0e0-4600c12c2ebf','doris76@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(55,'50ebf9a5-463f-39f2-941f-a0bad4903408','nannie.brakus@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(56,'0b701e22-cb34-3f47-93ed-08e29dad16bc','akeeling@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(57,'30900d25-eeb6-35f8-babf-4c379d552a10','tara97@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(61,'377f3932-32d0-3b28-aacc-f043bcb6a4ad','ifadel@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(62,'79fdc405-d28f-3d50-b0ef-15b001c1b2e6','velda45@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(63,'25fba57c-b4e3-3b6b-b92a-e0d00a80de8b','osporer@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(65,'12fab04f-eacb-3bd2-8fb0-72cf05e2802a','lgorczany@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(66,'b6fd4e4c-b054-3b8d-998e-b660744bc3e9','alexane33@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(68,'9625cbf1-ad6a-3135-a522-dc0747443929','sigrid.kulas@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(70,'c40a197c-f45f-3206-9487-7712c04b1be4','fgaylord@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(71,'0d7127b8-c6b9-3551-9766-8472c89b1cbd','jacynthe.ryan@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(72,'80b405af-cbc5-3cd1-ae6b-88ca7e90c561','heaven64@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(73,'6b8c3f4e-2340-309c-ba1c-25c07f361de7','kluettgen@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(79,'37f1f840-17e8-3f72-b759-e7a75f8d85cb','rice.matilde@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(80,'03013d7d-8491-33ca-90f0-2bd05723fe5d','duane97@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(83,'c361fe4b-3240-37b1-9283-4af06abfa9a7','rau.katelin@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(84,'44cf00d5-2548-3a9b-9943-0c46e3bc1a95','nathen43@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(86,'be5198a7-b4a3-32ba-b833-b6c1f3fa7c76','felton.lueilwitz@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(88,'0762bae9-8e7d-324e-aa3d-74fe1ee187ce','smonahan@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(89,'1dd9f9bf-8335-305a-90f9-628f17d6ebc9','graham.esther@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(90,'4d75220f-ad54-3f8d-add1-91bf2a35f642','shane50@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(93,'f2180664-87eb-3a1c-bbcc-01ce67d51d9d','juwan91@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'active'),(96,'3d493849-a2bc-3442-a8f8-e27db5db24ba','lubowitz.leilani@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'inactive'),(98,'301d446b-520b-3ba5-961f-df81e736860e','kuphal.desiree@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',50,'inactive'),(99,'caaa6257-8614-47a8-a5c7-71edfee89abb','admin@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','admin',956,'active'),(101,'39acf97c-49f6-4229-bc60-f843c5375fcd','demo@gmail.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active'),(102,'23d4627b-44b9-4ee8-8f99-b087bd975216','armandom@advancio.com','kwND/wpRN0L3k+8BJg+g7g==','user',50,'active');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-05 19:26:01
