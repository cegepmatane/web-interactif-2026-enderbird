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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (1,'Single','Afterlife (from the Netflix Series \"Devil May Cry\")','2025-03-28','Evanescence','1.jpg'),(2,'Album','Empty Hands','2026-01-23','Poppy','2.jpg'),(3,'EP','The Fear of Fear','2023-11-03','Spiritbox','3.jpg'),(4,'Single','End of You','2025-09-04','Poppy','4.jpg'),(5,'Album','Waking The Fallen','2003-08-26','Avenged Sevenfold','5.jpg'),(6,'Album','Eternal Blue','2021-09-17','Spiritbox','6.jpg'),(7,'Album','Nightmare','2010-07-25','Avenged Sevenfold','7.jpg'),(8,'Album','Fallen (Deluxe Edition / Remastered 2023)','2023-11-17','Evanescence','8.jpg'),(9,'Album','The Open Door','2006-09-25','Evanescence','9.jpg'),(10,'Album','Rust in Peace','1990-09-24','Megadeth','10.jpg'),(11,'Album','SISTERHOOD','2023-06-23','Lucy Bedroque','11.jpg'),(12,'Album','The Number of the Beast','1982-03-22','Iron Maiden','12.jpg'),(13,'Single','Mile Away','2023-09-29','Universe, removeface','13.jpg'),(14,'Album','The Bitter Truth','2021-03-26','Evanescence','14.jpg'),(15,'Album','wivcore','2024-04-12','wiv','15.jpg'),(16,'Album','From Zero (Deluxe Edition)','2025-05-16','Linkin Park','16.jpg'),(17,'EP','Spiritbox','2017-10-27','Spiritbox','17.jpg'),(18,'Single','Insonamia','2025-07-24','Ronald Figo','18.jpg'),(19,'Album','Painkiller','1990-09-03','Judas Priest','19.jpg'),(20,'Album','Avenged Sevenfold','2007-10-30','Avenged Sevenfold','20.jpg'),(21,'Album','The Stage','2016-10-28','Avenged Sevenfold','21.jpg'),(22,'Album','City of Evil','2005-06-06','Avenged Sevenfold','22.jpg'),(23,'Album','Van Halen','1978-02-10','Van Halen','23.jpg'),(24,'Album','1984','1984-01-09','Van Halen','24.jpg'),(25,'Album','Seventh Son of a Seventh Son','1988-04-11','Iron Maiden','25.jpg'),(26,'Album','Evanescence (Deluxe Edition)','2011-10-12','Evanescence','26.jpg');
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collection`
--

DROP TABLE IF EXISTS `collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `collection` (
  `id_album` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_album`,`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collection`
--

LOCK TABLES `collection` WRITE;
/*!40000 ALTER TABLE `collection` DISABLE KEYS */;
INSERT INTO `collection` VALUES (1,1,'2026-02-12 01:59:48'),(5,1,'2026-02-12 02:02:30');
/*!40000 ALTER TABLE `collection` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaire`
--

LOCK TABLES `commentaire` WRITE;
/*!40000 ALTER TABLE `commentaire` DISABLE KEYS */;
INSERT INTO `commentaire` VALUES (1,1,1,'I LOVE THIS SONG SO MUCH!!!!! WOOOOOOWWW.','2026-01-29 11:37:51'),(35,5,2,'Interesting','2026-02-10 18:05:30'),(39,1,3,'mile away is a better song','2026-02-11 15:57:43'),(43,1,3,'incroyable','2026-02-11 16:09:18'),(45,12,4,'one man came, across the sea, he brought us paine, and misery, he killed our tribe, he killed our creed, he took our game for his own need, we fallen hard, we fallen well, across the plain, we gave him help, but many have came, to much the the creed, ho will we ever be set free','2026-02-11 16:17:06'),(57,1,2,'what the heeeeeeeeeelllllllllllllllllllllllll insane!!!!!!!!!!','2026-02-11 16:31:00'),(60,2,1,'Le mixing est insane :FIREEEEE:','2026-02-12 02:40:51');
/*!40000 ALTER TABLE `commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favori`
--

DROP TABLE IF EXISTS `favori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favori` (
  `id_morceau` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_morceau`,`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favori`
--

LOCK TABLES `favori` WRITE;
/*!40000 ALTER TABLE `favori` DISABLE KEYS */;
INSERT INTO `favori` VALUES (8,1,'2026-02-12 02:41:09'),(9,1,'2026-02-12 02:41:16'),(15,1,'2026-02-12 02:39:39'),(16,1,'2026-02-02 15:58:15'),(20,1,'2026-02-02 15:58:15'),(24,1,'2026-02-02 15:58:15'),(25,1,'2026-02-12 02:29:54'),(30,1,'2026-02-12 02:41:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `morceau`
--

LOCK TABLES `morceau` WRITE;
/*!40000 ALTER TABLE `morceau` DISABLE KEYS */;
INSERT INTO `morceau` VALUES (1,1,1,'Afterlife (from the Netflix Series \"Devil May Cry\")','Evanescence','00:04:09'),(2,3,2,'Jaded','Spiritbox','00:04:22'),(3,3,3,'Too Close / Too Late','Spiritbox','00:04:41'),(4,3,4,'Angel Eyes','Spiritbox','00:03:28'),(5,3,5,'The Void','Spiritbox','00:03:40'),(6,3,6,'Ultraviolet','Spiritbox','00:04:08'),(7,5,1,'Waking The Fallen','Avenged Sevenfold','00:01:42'),(8,5,2,'Unholy Confessions','Avenged Sevenfold','00:04:43'),(9,5,3,'Chapter Four','Avenged Sevenfold','00:05:42'),(10,5,4,'Remenissions','Avenged Sevenfold','00:06:06'),(11,5,5,'Desecrate Through Reverence','Avenged Sevenfold','00:05:38'),(12,5,6,'Eternal Rest','Avenged Sevenfold','00:05:12'),(13,5,7,'Second Heartbeat','Avenged Sevenfold','00:07:00'),(14,5,8,'Radiant Eclipse','Avenged Sevenfold','00:06:09'),(15,2,1,'Public Domain','Poppy','00:04:00'),(16,2,2,'Bruised Sky','Poppy','00:03:40'),(17,2,3,'Guardian','Poppy','00:03:14'),(18,2,4,'Constantly Nowhere','Poppy','00:00:28'),(19,2,5,'Unravel','Poppy','00:02:55'),(20,2,6,'Dying To Forget','Poppy','00:03:33'),(21,2,7,'Time Will Tell','Poppy','00:03:27'),(22,2,8,'Eat The Hate','Poppy','00:01:50'),(23,2,9,'The Wait','Poppy','00:01:50'),(24,2,10,'If We\'re Following The Light','Poppy','00:04:06'),(25,2,11,'Blink','Poppy','00:00:44'),(26,2,12,'Ribs','Poppy','00:03:39'),(27,2,13,'Empty Hands','Poppy','00:03:09'),(28,4,1,'End of You','Poppy, Amy Lee, Courtney LaPlante','00:03:12'),(29,3,1,'Cellar Door','Spiritbox','00:04:43'),(30,5,9,'I Won\'t See You Tonight Part 1','Avenged Sevenfold','00:08:58'),(31,5,10,'I Won\'t See You Tonight Part 2','Avenged Sevenfold','00:04:44'),(32,5,11,'Clairvoyant Disease','Avenged Sevenfold','00:04:59'),(33,5,12,'And All Things Will End','Avenged Sevenfold','00:07:40'),(34,6,1,'Sun Killer','Spiritbox','00:03:47'),(35,6,2,'Hurt You','Spiritbox','00:03:46'),(36,6,3,'Yellowjacket - feat. Sam Carter','Spiritbox, Sam Carter','00:03:18'),(37,6,4,'The Summit','Spiritbox','00:03:57'),(38,6,5,'Secret Garden','Spiritbox','00:03:39'),(39,6,6,'Silk In The String','Spiritbox','00:02:57'),(40,6,7,'Holly Roller','Spiritbox','00:02:53'),(41,6,8,'Eternal Blue','Spiritbox','00:03:59'),(42,6,9,'We Live In A Strange World','Spiritbox','00:02:48'),(43,6,10,'Halcyon','Spiritbox','00:03:40'),(44,6,11,'Circle With Me','Spiritbox','00:03:53'),(45,6,12,'Constance','Spiritbox','00:04:30'),(46,7,1,'Nightmare','Avenged Sevenfold','00:06:14'),(47,7,2,'Welcome to the Family','Avenged Sevenfold','00:04:05'),(48,7,3,'Danger Line','Avenged Sevenfold','00:05:28'),(49,7,4,'Buried Alive','Avenged Sevenfold','00:06:44'),(50,7,5,'Naturaly Born Killer','Avenged Sevenfold','00:05:15'),(51,7,6,'So Far Away','Avenged Sevenfold','00:05:26'),(52,7,7,'God Hates Us','Avenged Sevenfold','00:05:19'),(53,7,8,'Victim','Avenged Sevenfold','00:07:29'),(54,7,9,'Tonight the World Dies','Avenged Sevenfold','00:04:41'),(55,7,10,'Fiction','Avenged Sevenfold','00:05:07'),(56,7,11,'Save Me','Avenged Sevenfold','00:10:56'),(57,8,1,'Going Under (Remastered 2023)','Evanescence','00:03:35'),(58,8,2,'Bring Me To Life (Remastered 2023)','Evanescence','00:03:56'),(59,8,3,'Everybody\'s Fool (Remastered 2023)','Evanescence','00:03:16'),(60,8,4,'My Immortal (Remastered 2023)','Evanescence','00:04:23'),(61,8,5,'Haunted (Remastered 2023)','Evanescence','00:03:05'),(62,8,6,'Tourniquet (Remastered 2023)','Evanescence','00:04:38'),(63,8,7,'Imaginary (Remastered 2023)','Evanescence','00:04:16'),(64,8,8,'Taking Over Me (Remastered 2023)','Evanescence','00:03:48'),(65,8,9,'Hello (Remastered 2023)','Evanescence','00:03:41'),(66,8,10,'My Last Breath (Remastered 2023)','Evanescence','00:04:07'),(67,8,11,'Whisper (Remastered 2023)','Evanescence','00:05:27'),(68,8,12,'My Immortal (Band Version / Remastered 2023)','Evanescence','00:04:34'),(69,8,13,'Breathe No More (Remastered 2023)','Evanescence','00:03:48'),(70,8,14,'Farther Away (Remastered 2023)','Evanescence','00:03:59'),(71,8,15,'Missing (Remastered 2023)','Evanescence','00:04:18'),(72,8,16,'My Immortal (Strings Version / Remastered 2023)','Evanescence','00:04:34'),(73,8,17,'Bring Me To Life (Demo / Remastered 2023)','Evanescence','00:03:52'),(74,8,18,'Bring Me To Life (AOL Session / 2003 / Remastered)','Evanescence','00:03:38'),(75,8,19,'Going Under (Live Acoustic / 2003 / Remastered)','Evanescence','00:03:15'),(76,8,20,'Bring Me To Life (Live On Triple M Garage Session / 2020 / Remastered 2023)','Evanescence','00:03:42'),(77,8,21,'My Immortal (Live At O2 Arena / 2022 / Remastered 2023)','Evanescence','00:04:50'),(78,9,1,'Sweet Sacrifice','Evanescence','00:03:05'),(79,9,2,'Call Me When You\'re Sober','Evanescence','00:03:34'),(80,9,3,'Weight Of The World','Evanescence','00:03:37'),(81,9,4,'Lithium','Evanescence','00:03:44'),(82,9,5,'Cloud Nine','Evanescence','00:04:22'),(83,9,6,'Snow White Queen','Evanescence','00:04:22'),(84,9,7,'Lacrymosa','Evanescence','00:03:37'),(85,9,8,'Like You','Evanescence','00:04:16'),(86,9,9,'Lose Control','Evanescence','00:04:50'),(87,9,10,'The Only One','Evanescence','00:04:40'),(88,9,11,'Your Star','Evanescence','00:04:43'),(89,9,12,'All That I\'m Living For','Evanescence','00:03:48'),(90,9,13,'Good Enough','Evanescence','00:05:31'),(91,10,1,'Holy Wars... The Punishment Due','Megadeth','00:06:36'),(92,10,2,'Hangar 18','Megadeth','00:05:14'),(93,10,3,'Take No Prisoners','Megadeth','00:03:28'),(94,10,4,'Five Magics','Megadeth','00:05:41'),(95,10,5,'Poison Was The Cure','Megadeth','00:02:58'),(96,10,6,'Lucretia','Megadeth','00:03:58'),(97,10,7,'Tornado Of Souls','Megadeth','00:05:22'),(98,10,8,'Dawn Patrol','Megadeth','00:01:50'),(99,10,9,'Rust In Peace... Polaris','Megadeth','00:05:36'),(100,11,1,'GLUTGIRL66','Lucy Bedroque','00:02:30'),(101,11,2,'SORORITY','Lucy Bedroque','00:03:18'),(102,11,3,'TAKE ME BACK','Lucy Bedroque','00:02:51'),(103,11,4,'WEEP TODAY','Lucy Bedroque','00:02:29'),(104,11,5,'WALLS OF JERICHO','Lucy Bedroque','00:03:18'),(105,11,6,'HYDROXYCUT (TAKE IT ALL)','Lucy Bedroque','00:02:28'),(106,11,7,'À QUI DE DROIT','Lucy Bedroque','00:02:43'),(107,11,8,'MADAME LUCY','Lucy Bedroque','00:02:55'),(108,11,9,'KELLY KELLY','Lucy Bedroque','00:03:21'),(109,11,10,'USE YOUR WINGS','Lucy Bedroque','00:04:12'),(110,11,11,'INFINITUDE // UROBOROS','Lucy Bedroque','00:05:44'),(111,11,12,'SISTERHOOD (LOVE, HER.)','Lucy Bedroque','00:03:00'),(112,12,1,'Invaders','Iron Maiden','00:03:23'),(113,12,2,'Children of the Damned','Iron Maiden','00:04:35'),(114,12,3,'The Prisoner','Iron Maiden','00:06:02'),(115,12,4,'22 Acacia Avenue','Iron Maiden','00:06:36'),(116,12,5,'The Number of the Beast','Iron Maiden','00:04:50'),(117,12,6,'Run to the Hills','Iron Maiden','00:03:53'),(118,12,7,'Gangland','Iron Maiden','00:03:49'),(119,12,8,'Hallowed Be Thy Name','Iron Maiden','00:07:11'),(120,13,1,'Mile Away','Universe, removeface','00:03:00'),(121,14,1,'Artifact/The Turn','Evanescence','00:05:21'),(122,14,2,'Broken Pieces Shine','Evanescence','00:04:17'),(123,14,3,'The Game Is Over','Evanescence','00:03:48'),(124,14,4,'Yeah Right','Evanescence','00:03:58'),(125,14,5,'Feeding the Dark','Evanescence','00:03:32'),(126,14,6,'Wasted on You','Evanescence','00:03:47'),(127,14,7,'Better Without You','Evanescence','00:03:41'),(128,14,8,'Use My Voice','Evanescence','00:04:12'),(129,14,9,'Take Cover','Evanescence','00:03:24'),(130,14,10,'Far From Heaven','Evanescence','00:03:42'),(131,14,11,'Part of Me','Evanescence','00:04:07'),(132,14,12,'Blind Belief','Evanescence','00:03:26'),(133,15,1,'I woke up early and fainted','wiv','00:01:29'),(134,15,2,'I\'m on Jupiter','wiv, Enkei','00:01:53'),(135,15,3,'call me sometime okay?','wiv, 68+1','00:01:53'),(136,15,4,'heading home','wiv, Aeriu Ika','00:01:30'),(137,15,5,'ascendant','wiv','00:02:29'),(138,15,6,'you\'re too weak','wiv','00:02:03'),(139,15,7,'hollow','wiv','00:02:02'),(140,15,8,'KATCH ME','wiv, Gojo Satoru, 4GOTTXN','00:01:39'),(141,15,9,'turn back again','wiv','00:01:44'),(142,15,10,'the end','wiv','00:01:14'),(143,16,1,'From Zero (Intro)','Linkin Park','00:00:22'),(144,16,2,'The Emptiness Machine','Linkin Park','00:03:10'),(145,16,3,'Cut the Bridge','Linkin Park','00:03:48'),(146,16,4,'Heavy Is the Crown','Linkin Park','00:02:47'),(147,16,5,'Over Each Other','Linkin Park','00:02:50'),(148,16,6,'Casualty','Linkin Park','00:02:20'),(149,16,7,'Overflow','Linkin Park','00:03:31'),(150,16,8,'Two Faced','Linkin Park','00:03:03'),(151,16,9,'Stained','Linkin Park','00:03:05'),(152,16,10,'IGYEIH','Linkin Park','00:03:29'),(153,16,11,'Good Things Go','Linkin Park','00:03:29'),(154,16,12,'Up From the Bottom','Linkin Park','00:03:03'),(155,16,13,'Unshatter','Linkin Park','00:03:16'),(156,16,14,'Let You Fade','Linkin Park','00:03:28'),(157,17,1,'The Mara Effect, Pt. 1','Spiritbox','00:04:40'),(158,17,2,'10:16','Spiritbox','00:01:08'),(159,17,3,'The Mara Effect, Pt. 2','Spiritbox','00:03:40'),(160,17,4,'The Mara Effect, Pt. 3','Spiritbox','00:05:38'),(161,17,5,'Everything’s Eventual','Spiritbox','00:03:56'),(162,17,6,'Aphids','Spiritbox','00:04:36'),(163,17,7,'The Beauty of Suffering','Spiritbox','00:05:37'),(164,18,1,'Insonamia','Ronald Figo','00:03:01'),(165,19,1,'Painkiller','Judas Priest','00:06:05'),(166,19,2,'Hell Patrol','Judas Priest','00:03:36'),(167,19,3,'All Guns Blazing','Judas Priest','00:03:57'),(168,19,4,'Leather Rebel','Judas Priest','00:03:34'),(169,19,5,'Metal Meltdown','Judas Priest','00:04:47'),(170,19,6,'Night Crawler','Judas Priest','00:05:44'),(171,19,7,'Between the Hammer & the Anvil','Judas Priest','00:04:49'),(172,19,8,'A Touch of Evil','Judas Priest','00:05:44'),(173,19,9,'Battle Hymn','Judas Priest','00:00:56'),(174,19,10,'One Shot at Glory','Judas Priest','00:06:48'),(175,19,11,'Living Bad Dreams','Judas Priest','00:05:21'),(176,19,12,'Leather Rebel - Live','Judas Priest','00:03:39'),(177,20,1,'Critical Acclaim','Avenged Sevenfold','00:05:15'),(178,20,2,'Almost Easy','Avenged Sevenfold','00:03:54'),(179,20,3,'Scream','Avenged Sevenfold','00:04:50'),(180,20,4,'Afterlife','Avenged Sevenfold','00:05:53'),(181,20,5,'Gunslinger','Avenged Sevenfold','00:04:11'),(182,20,6,'Unbound (The Wild Ride)','Avenged Sevenfold','00:05:11'),(183,20,7,'Brompton Cocktail','Avenged Sevenfold','00:04:13'),(184,20,8,'Lost','Avenged Sevenfold','00:05:01'),(185,20,9,'A Little Piece of Heaven','Avenged Sevenfold','00:08:00'),(186,20,10,'Dear God','Avenged Sevenfold','00:06:33'),(187,21,1,'The Stage','Avenged Sevenfold','00:08:32'),(188,21,2,'Paradigm','Avenged Sevenfold','00:04:18'),(189,21,3,'Sunny Disposition','Avenged Sevenfold','00:06:41'),(190,21,4,'God Damn','Avenged Sevenfold','00:03:41'),(191,21,5,'Creating God','Avenged Sevenfold','00:05:34'),(192,21,6,'Angels','Avenged Sevenfold','00:05:40'),(193,21,7,'Simulation','Avenged Sevenfold','00:05:30'),(194,21,8,'Higher','Avenged Sevenfold','00:06:28'),(195,21,9,'Roman Sky','Avenged Sevenfold','00:05:00'),(196,21,10,'Fermi Paradox','Avenged Sevenfold','00:06:30'),(197,21,11,'Exist','Avenged Sevenfold','00:15:39'),(198,22,1,'Beast and the Harlot','Avenged Sevenfold','00:05:43'),(199,22,2,'Burn It Down','Avenged Sevenfold','00:04:58'),(200,22,3,'Blinded in Chains','Avenged Sevenfold','00:06:34'),(201,22,4,'Bat Country','Avenged Sevenfold','00:05:11'),(202,22,5,'Trashed and Scattered','Avenged Sevenfold','00:05:51'),(203,22,6,'Seize the Day','Avenged Sevenfold','00:05:34'),(204,22,7,'Sidewinder','Avenged Sevenfold','00:07:01'),(205,22,8,'The Wicked End','Avenged Sevenfold','00:07:10'),(206,22,9,'Strength of the World','Avenged Sevenfold','00:09:14'),(207,22,10,'Betrayed','Avenged Sevenfold','00:06:46'),(208,22,11,'M.I.A.','Avenged Sevenfold','00:08:46'),(209,23,1,'Runnin\' with the Devil','Van Halen','00:03:36'),(210,23,2,'Eruption','Van Halen','00:01:42'),(211,23,3,'You Really Got Me','Van Halen','00:02:38'),(212,23,4,'Ain\'t Talkin\' ’bout Love','Van Halen','00:03:50'),(213,23,5,'I\'m the One','Van Halen','00:03:47'),(214,23,6,'Jamie\'s Cryin\'','Van Halen','00:03:31'),(215,23,7,'Atomic Punk','Van Halen','00:03:02'),(216,23,8,'Feel Your Love Tonight','Van Halen','00:03:43'),(217,23,9,'Little Dreamer','Van Halen','00:03:23'),(218,23,10,'Ice Cream Man','Van Halen','00:03:20'),(219,23,11,'On Fire','Van Halen','00:03:01'),(220,24,1,'1984','Van Halen','00:01:07'),(221,24,2,'Jump','Van Halen','00:04:04'),(222,24,3,'Panama','Van Halen','00:03:32'),(223,24,4,'Top Jimmy','Van Halen','00:03:01'),(224,24,5,'Drop Dead Legs','Van Halen','00:04:14'),(225,24,6,'Hot for Teacher','Van Halen','00:04:42'),(226,24,7,'I\'ll Wait','Van Halen','00:04:40'),(227,24,8,'Girl Gone Bad','Van Halen','00:04:35'),(228,24,9,'House of Pain','Van Halen','00:03:19'),(229,25,1,'Moonchild','Iron Maiden','00:05:40'),(230,25,2,'Infinite Dreams','Iron Maiden','00:06:09'),(231,25,3,'Can I Play with Madness','Iron Maiden','00:03:31'),(232,25,4,'The Evil That Men Do','Iron Maiden','00:04:34'),(233,25,5,'Seventh Son of a Seventh Son','Iron Maiden','00:09:54'),(234,25,6,'The Prophecy','Iron Maiden','00:05:05'),(235,25,7,'The Clairvoyant','Iron Maiden','00:04:27'),(236,25,8,'Only the Good Die Young','Iron Maiden','00:04:42'),(237,26,1,'What You Want','Evanescence','00:03:41'),(238,26,2,'Made Of Stone','Evanescence','00:03:33'),(239,26,3,'The Change','Evanescence','00:03:42'),(240,26,4,'My Heart Is Broken','Evanescence','00:04:29'),(241,26,5,'The Other Side','Evanescence','00:04:05'),(242,26,6,'Erase This','Evanescence','00:03:55'),(243,26,7,'Lost In Paradise','Evanescence','00:04:42'),(244,26,8,'Sick','Evanescence','00:03:30'),(245,26,9,'The End Of The Dream','Evanescence','00:03:49'),(246,26,10,'Oceans','Evanescence','00:03:38'),(247,26,11,'Never Go Back','Evanescence','00:04:27'),(248,26,12,'Swimming Home','Evanescence','00:03:41'),(249,26,13,'A New Way To Bleed','Evanescence','00:03:46'),(250,26,14,'Say You Will','Evanescence','00:03:43'),(251,26,15,'Disappear','Evanescence','00:03:06'),(252,26,16,'Secret Door','Evanescence','00:03:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'Moi','random@random.random','admin123',NULL),(2,'notanik','cedricsimard28@gmail.com','admin123','2.jpg'),(3,'nova','nova@s0und.space','admin123',NULL),(4,'Eddie','eddie@maiden.cum','admin123',NULL);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vote` (
  `id_album` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `note` tinyint NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_album`,`id_utilisateur`),
  CONSTRAINT `vote_chk_1` CHECK ((`note` between 1 and 5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vote`
--

LOCK TABLES `vote` WRITE;
/*!40000 ALTER TABLE `vote` DISABLE KEYS */;
INSERT INTO `vote` VALUES (1,1,2,'2026-02-12 03:57:55');
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

-- Dump completed on 2026-02-12  3:59:30
