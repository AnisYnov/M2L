-- MySQL dump 10.13  Distrib 5.7.14, for Win64 (x86_64)
--
-- Host: localhost    Database: m2l
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adresse` (
  `code_postal` int(11) NOT NULL,
  `id_a` int(11) NOT NULL AUTO_INCREMENT,
  `numero_rue` int(11) NOT NULL,
  `rue` int(11) NOT NULL,
  `ville` int(11) NOT NULL,
  PRIMARY KEY (`id_a`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresse`
--

LOCK TABLES `adresse` WRITE;
/*!40000 ALTER TABLE `adresse` DISABLE KEYS */;
INSERT INTO `adresse` VALUES (94000,1,11,11,11);
/*!40000 ALTER TABLE `adresse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commenter`
--

DROP TABLE IF EXISTS `commenter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commenter` (
  `id_c` int(11) NOT NULL,
  `id_s` int(11) NOT NULL,
  `id_f` int(11) NOT NULL,
  PRIMARY KEY (`id_c`),
  KEY `id_s` (`id_s`),
  KEY `id_f` (`id_f`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commenter`
--

LOCK TABLES `commenter` WRITE;
/*!40000 ALTER TABLE `commenter` DISABLE KEYS */;
/*!40000 ALTER TABLE `commenter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formation`
--

DROP TABLE IF EXISTS `formation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formation` (
  `id_f` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `duree` int(255) NOT NULL,
  `cout` int(255) NOT NULL,
  `date_debut` date NOT NULL,
  `nb_place` int(255) NOT NULL,
  `contenu` text NOT NULL,
  `id_a` int(255) NOT NULL,
  `id_p` int(255) NOT NULL,
  PRIMARY KEY (`id_f`),
  KEY `id_a` (`id_a`),
  KEY `id_p` (`id_p`),
  CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`id_a`) REFERENCES `adresse` (`id_a`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formation`
--

LOCK TABLES `formation` WRITE;
/*!40000 ALTER TABLE `formation` DISABLE KEYS */;
INSERT INTO `formation` VALUES (1,'math',50,150,'2017-03-19',50,'ok',1,1),(2,'foot',7,7,'2017-03-07',2,'fd',1,1),(3,'tenis',5,500,'2017-03-21',9,'okoppm',1,1),(4,'hnd',5,500,'2017-03-21',7,'okoppm',1,1),(5,'kepo',2,200,'2017-03-21',9,'pll',1,1);
/*!40000 ALTER TABLE `formation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formation_valide`
--

DROP TABLE IF EXISTS `formation_valide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formation_valide` (
  `id_v` int(11) NOT NULL AUTO_INCREMENT,
  `id_f` int(11) NOT NULL,
  `id_s` int(11) NOT NULL,
  `etat_f` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en cours de validation',
  PRIMARY KEY (`id_v`),
  KEY `id_f` (`id_f`),
  KEY `id_s` (`id_s`),
  CONSTRAINT `formation_valide_ibfk_1` FOREIGN KEY (`id_s`) REFERENCES `salarie` (`id_s`),
  CONSTRAINT `formation_valide_ibfk_2` FOREIGN KEY (`id_f`) REFERENCES `formation` (`id_f`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formation_valide`
--

LOCK TABLES `formation_valide` WRITE;
/*!40000 ALTER TABLE `formation_valide` DISABLE KEYS */;
INSERT INTO `formation_valide` VALUES (1,2,1,'valider'),(2,2,1,'valider'),(3,3,1,'effectuée '),(4,4,1,'effectuée '),(5,5,1,'effectuée '),(6,2,1,'valider'),(7,2,2,'refusé'),(8,3,2,'effectuée '),(9,4,2,'valider'),(10,5,2,'en cours de validation'),(11,5,1,'valider'),(12,4,1,'valider'),(13,4,1,'valider'),(14,3,1,'refusé'),(15,2,2,'effectuée '),(16,5,1,'valider'),(17,5,2,'en cours de validation'),(18,5,2,'en cours de validation'),(19,5,2,'effectuée '),(20,5,2,'en cours de validation'),(21,5,2,'en cours de validation'),(22,5,1,'valider'),(23,2,2,'en cours de validation'),(24,2,1,'valider');
/*!40000 ALTER TABLE `formation_valide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestataire`
--

DROP TABLE IF EXISTS `prestataire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestataire` (
  `id_p` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `raison_social` varchar(255) NOT NULL,
  `id_a` int(11) NOT NULL,
  PRIMARY KEY (`id_p`),
  KEY `id_a` (`id_a`),
  CONSTRAINT `prestataire_ibfk_1` FOREIGN KEY (`id_a`) REFERENCES `adresse` (`id_a`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestataire`
--

LOCK TABLES `prestataire` WRITE;
/*!40000 ALTER TABLE `prestataire` DISABLE KEYS */;
INSERT INTO `prestataire` VALUES (1,NULL,'detre',1);
/*!40000 ALTER TABLE `prestataire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salarie`
--

DROP TABLE IF EXISTS `salarie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salarie` (
  `id_s` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(11) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `identifiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(55) CHARACTER SET latin1 NOT NULL,
  `credit` int(255) NOT NULL,
  `nbs_jour` int(255) NOT NULL,
  `id_a` int(255) NOT NULL,
  PRIMARY KEY (`id_s`),
  KEY `id_a` (`id_a`),
  CONSTRAINT `salarie_ibfk_1` FOREIGN KEY (`id_a`) REFERENCES `adresse` (`id_a`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salarie`
--

LOCK TABLES `salarie` WRITE;
/*!40000 ALTER TABLE `salarie` DISABLE KEYS */;
INSERT INTO `salarie` VALUES (1,'ibo','olivier','ab@ra','olivier','82e9dd1f989d339f09c629d0abd942d4','salarié',2893,11,1),(2,'adm','anis','adm@adm','anis','340969df792b7283ce86d8d427426fe8','chef d’équipe',1893,1,1),(3,'admin','admin','admin@admin','admin','vayne','admin',3,3,1);
/*!40000 ALTER TABLE `salarie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_formation`
--

DROP TABLE IF EXISTS `type_formation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_formation` (
  `id_t` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_t`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_formation`
--

LOCK TABLES `type_formation` WRITE;
/*!40000 ALTER TABLE `type_formation` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_formation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-12  9:41:33
