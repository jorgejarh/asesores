-- MySQL dump 10.13  Distrib 5.5.24, for Win32 (x86)
--
-- Host: localhost    Database: asesores
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `mante_facilitadores`
--

DROP TABLE IF EXISTS `mante_facilitadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_facilitadores` (
  `id_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `t_oficina` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `correo` varchar(15) DEFAULT NULL,
  `id_tipo_facilitador` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_facilitadores`
--

LOCK TABLES `mante_facilitadores` WRITE;
/*!40000 ALTER TABLE `mante_facilitadores` DISABLE KEYS */;
INSERT INTO `mante_facilitadores` VALUES (1,'Jorge Antonio','Rodriguez','123456','123456','132465','jarh@jarh.com',NULL,1,NULL,NULL),(2,'Carlos','Hernandez','123456789','123456789','123456789','jarh@jar.com',NULL,1,1,'2013-06-11 23:45:54');
/*!40000 ALTER TABLE `mante_facilitadores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-28 11:48:12
