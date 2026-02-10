-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: contracteur
-- ------------------------------------------------------
-- Server version	8.0.45-0ubuntu0.24.04.1

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
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `album` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `date_sortie` date NOT NULL,
  `artiste` varchar(150) NOT NULL,
  `fichier_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (1,'Single','Afterlife (from the Netflix Series \"Devil May Cry\")','2025-03-28','Evanescence','1.jpg'),(2,'Album','Empty Hands','2026-01-23','Poppy','2.jpg'),(3,'EP','The Fear of Fear','2023-11-03','Spiritbox','3.jpg'),(4,'Single','End of You','2025-09-04','Poppy','4.jpg'),(5,'Album','Waking The Fallen','2003-08-26','Avenged Sevenfold','5.jpg'),(6,'Album','Eternal Blue','2021-09-17','Spiritbox','6.jpg'),(7,'Album','Nightmare','2010-07-25','Avenged Sevenfold','7.jpg');
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_album` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `message` text NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaire`
--

LOCK TABLES `commentaire` WRITE;
/*!40000 ALTER TABLE `commentaire` DISABLE KEYS */;
INSERT INTO `commentaire` VALUES (1,1,1,'I LOVE THIS SONG SO MUCH!!!!! WOOOOOOWWW.','2026-01-29 11:37:51');
/*!40000 ALTER TABLE `commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favori`
--

DROP TABLE IF EXISTS `favori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_morceau` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favori`
--

LOCK TABLES `favori` WRITE;
/*!40000 ALTER TABLE `favori` DISABLE KEYS */;
INSERT INTO `favori` VALUES (1,16,1,'2026-02-02 15:58:15'),(2,20,1,'2026-02-02 15:58:15'),(3,24,1,'2026-02-02 15:58:15');
/*!40000 ALTER TABLE `favori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `morceau`
--

DROP TABLE IF EXISTS `morceau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `morceau` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_album` int NOT NULL,
  `ordre` smallint NOT NULL,
  `titre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `artiste` varchar(200) NOT NULL,
  `duree` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `morceau`
--

LOCK TABLES `morceau` WRITE;
/*!40000 ALTER TABLE `morceau` DISABLE KEYS */;
INSERT INTO `morceau` VALUES (1,1,1,'Afterlife (from the Netflix Series \"Devil May Cry\")','Evanescence','00:04:09'),(2,3,2,'Jaded','Spiritbox','00:04:22'),(3,3,3,'Too Close / Too Late','Spiritbox','00:04:41'),(4,3,4,'Angel Eyes','Spiritbox','00:03:28'),(5,3,5,'The Void','Spiritbox','00:03:40'),(6,3,6,'Ultraviolet','Spiritbox','00:04:08'),(7,5,1,'Waking The Fallen','Avenged Sevenfold','00:01:42'),(8,5,2,'Unholy Confessions','Avenged Sevenfold','00:04:43'),(9,5,3,'Chapter Four','Avenged Sevenfold','00:05:42'),(10,5,4,'Remenissions','Avenged Sevenfold','00:06:06'),(11,5,5,'Desecrate Through Reverence','Avenged Sevenfold','00:05:38'),(12,5,6,'Eternal Rest','Avenged Sevenfold','00:05:12'),(13,5,7,'Second Heartbeat','Avenged Sevenfold','00:07:00'),(14,5,8,'Radiant Eclipse','Avenged Sevenfold','00:06:09'),(15,2,1,'Public Domain','Poppy','00:04:00'),(16,2,2,'Bruised Sky','Poppy','00:03:40'),(17,2,3,'Guardian','Poppy','00:03:14'),(18,2,4,'Constantly Nowhere','Poppy','00:00:28'),(19,2,5,'Unravel','Poppy','00:02:55'),(20,2,6,'Dying To Forget','Poppy','00:03:33'),(21,2,7,'Time Will Tell','Poppy','00:03:27'),(22,2,8,'Eat The Hate','Poppy','00:01:50'),(23,2,9,'The Wait','Poppy','00:01:50'),(24,2,10,'If We\'re Following The Light','Poppy','00:04:06'),(25,2,11,'Blink','Poppy','00:00:44'),(26,2,12,'Ribs','Poppy','00:03:39'),(27,2,13,'Empty Hands','Poppy','00:03:09'),(28,4,1,'End of You','Poppy, Amy Lee, Courtney LaPlante','00:03:12'),(29,3,1,'Cellar Door','Spiritbox','00:04:43'),(30,5,9,'I Won\'t See You Tonight Part 1','Avenged Sevenfold','00:08:58'),(31,5,10,'I Won\'t See You Tonight Part 2','Avenged Sevenfold','00:04:44'),(32,5,11,'Clairvoyant Disease','Avenged Sevenfold','00:04:59'),(33,5,12,'And All Things Will End','Avenged Sevenfold','00:07:40'),(34,6,1,'Sun Killer','Spiritbox','00:03:47'),(35,6,2,'Hurt You','Spiritbox','00:03:46'),(36,6,3,'Yellowjacket - feat. Sam Carter','Spiritbox, Sam Carter','00:03:18'),(37,6,4,'The Summit','Spiritbox','00:03:57'),(38,6,5,'Secret Garden','Spiritbox','00:03:39'),(39,6,6,'Silk In The String','Spiritbox','00:02:57'),(40,6,7,'Holly Roller','Spiritbox','00:02:53'),(41,6,8,'Eternal Blue','Spiritbox','00:03:59'),(42,6,9,'We Live In A Strange World','Spiritbox','00:02:48'),(43,6,10,'Halcyon','Spiritbox','00:03:40'),(44,6,11,'Circle With Me','Spiritbox','00:03:53'),(45,6,12,'Constance','Spiritbox','00:04:30'),(46,7,1,'Nightmare','Avenged Sevenfold','00:06:14'),(47,7,2,'Welcome to the Family','Avenged Sevenfold','00:04:05'),(48,7,3,'Danger Line','Avenged Sevenfold','00:05:28'),(49,7,4,'Buried Alive','Avenged Sevenfold','00:06:44'),(50,7,5,'Naturaly Born Killer','Avenged Sevenfold','00:05:15'),(51,7,6,'So Far Away','Avenged Sevenfold','00:05:26'),(52,7,7,'God Hates Us','Avenged Sevenfold','00:05:19'),(53,7,8,'Victim','Avenged Sevenfold','00:07:29'),(54,7,9,'Tonight the World Dies','Avenged Sevenfold','00:04:41'),(55,7,10,'Fiction','Avenged Sevenfold','00:05:07'),(56,7,11,'Save Me','Avenged Sevenfold','00:10:56');
/*!40000 ALTER TABLE `morceau` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `fichier_image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'notanik','cedricsimard28@gmail.com','admin123',NULL),(2,'nova','nova@s0und.space','admin123',NULL);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_album` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `note` tinyint NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `vote_chk_1` CHECK ((`note` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vote`
--

LOCK TABLES `vote` WRITE;
/*!40000 ALTER TABLE `vote` DISABLE KEYS */;
INSERT INTO `vote` VALUES (1,1,1,5,'2026-01-29 09:56:34');
/*!40000 ALTER TABLE `vote` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-10  1:53:09
