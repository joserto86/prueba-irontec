-- MySQL dump 10.13  Distrib 8.0.19, for Linux (x86_64)
--
-- Host: localhost    Database: irontec
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20210129181204','2021-01-30 13:25:56',62),('DoctrineMigrations\\Version20210130162540','2021-01-30 17:11:50',228);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shortened_url`
--

DROP TABLE IF EXISTS `shortened_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shortened_url` (
  `id` int NOT NULL AUTO_INCREMENT,
  `strategy_id` int NOT NULL,
  `hash` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visits` int NOT NULL,
  `last_visit` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_559BBCF7D5CAD932` (`strategy_id`),
  CONSTRAINT `FK_559BBCF7D5CAD932` FOREIGN KEY (`strategy_id`) REFERENCES `strategy` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shortened_url`
--

LOCK TABLES `shortened_url` WRITE;
/*!40000 ALTER TABLE `shortened_url` DISABLE KEYS */;
INSERT INTO `shortened_url` VALUES (1,1,'nmQG3P7','https://stackoverflow.com/questions/38815175/symfony-findoneby-findby',8,'2021-02-03 18:52:28'),(2,1,'KBnm8xY','https://www.doctrine-project.org/projects/doctrine-migrations/en/1.7/reference/managing_migrations.html',2,'2021-02-03 20:10:01'),(3,1,'WjW8hF4','https://www.redaccionmedica.com/secciones/sanidad-hoy/radar-covid-detecta-mas-del-doble-de-contactos-positivos-que-un-rastreador-5548',2,'2021-02-03 20:09:36'),(4,1,'VGsy5h0','https://getbootstrap.com/docs/4.0/components/forms/',1,'2021-02-02 22:26:41'),(5,1,'yNN5F6Q','https://getbootstrap.com/docs/4.0/components/forms/',6,'2021-02-03 18:53:03'),(6,1,'g0z4X3p','https://getbootstrap.com/docs/4.0/components/forms/',0,NULL),(7,1,'4YcbkFA','http://cup-coffe.blogspot.com/2012/03/el-patron-model-view-viewmodel-mvvm.html',0,NULL),(8,2,'cHDxKWW','https://stackoverflow.com/questions/48862399/including-twig-files-from-current-directory/48862895',0,NULL),(9,3,'7826378','https://www.php.net/manual/es/ref.array.php',0,NULL),(10,3,'4296877','https://stackoverflow.com/questions/9214471/count-rows-in-doctrine-querybuilder',0,NULL),(11,3,'5557045','https://www.elmundo.es/espana/2021/02/03/601a85f2fc6c83e06b8b45c0.html',0,NULL);
/*!40000 ALTER TABLE `shortened_url` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `strategy`
--

DROP TABLE IF EXISTS `strategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `strategy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `strategy`
--

LOCK TABLES `strategy` WRITE;
/*!40000 ALTER TABLE `strategy` DISABLE KEYS */;
INSERT INTO `strategy` VALUES (1,'Alfanumérico'),(2,'Sólo Letras'),(3,'Sólo Números');
/*!40000 ALTER TABLE `strategy` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-03 21:14:54
