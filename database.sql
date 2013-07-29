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
-- Current Database: `asesores`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `asesores` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `asesores`;

--
-- Table structure for table `abonos_cooperativas`
--

DROP TABLE IF EXISTS `abonos_cooperativas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonos_cooperativas` (
  `id_abono` int(11) NOT NULL AUTO_INCREMENT,
  `id_cooperativa` int(11) NOT NULL,
  `id_capacitacion` int(11) NOT NULL,
  `abono` decimal(12,2) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_abono`),
  KEY `id_cooperativa` (`id_cooperativa`),
  KEY `id_capacitacion` (`id_capacitacion`),
  CONSTRAINT `abonos_cooperativas_ibfk_1` FOREIGN KEY (`id_cooperativa`) REFERENCES `conf_cooperativa` (`id_cooperativa`),
  CONSTRAINT `abonos_cooperativas_ibfk_2` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonos_cooperativas`
--

LOCK TABLES `abonos_cooperativas` WRITE;
/*!40000 ALTER TABLE `abonos_cooperativas` DISABLE KEYS */;
/*!40000 ALTER TABLE `abonos_cooperativas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf_cooperativa`
--

DROP TABLE IF EXISTS `conf_cooperativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf_cooperativa` (
  `id_cooperativa` int(10) NOT NULL AUTO_INCREMENT,
  `cooperativa` varchar(100) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `credito_fiscal` varchar(45) DEFAULT NULL,
  `logotipo` varchar(100) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_cooperativa`
--

LOCK TABLES `conf_cooperativa` WRITE;
/*!40000 ALTER TABLE `conf_cooperativa` DISABLE KEYS */;
INSERT INTO `conf_cooperativa` VALUES (6,'ACODJAR DE R.L.','Central','2333 7400','2333 7406','gerencia.acodjar@fedecaces.com','236548','logos/logo_acodjar.png',1,NULL,NULL),(9,'ACACCIBA','Central','2618 2427','2333 7406','gerencia.acacciba@fedecaces.com','236549','logos/logo_acacciba.png',1,NULL,NULL),(10,'ACACEMIHA DE R.L.','Central','2272 6527','2333 7406','acacemiha@fedecaces.com','236550','logos/logo_acacemiha.png',1,NULL,NULL),(19,'ACACES DE R.L.','daf','2288 2103','2333 7406','info@acaces.com.sv','236551',NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `conf_cooperativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf_menu`
--

DROP TABLE IF EXISTS `conf_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(200) DEFAULT NULL,
  `id_padre` int(11) DEFAULT '0',
  `url` varchar(150) DEFAULT '#',
  `activo` int(11) DEFAULT '1',
  `orden` int(11) DEFAULT '1',
  `target` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_menu`
--

LOCK TABLES `conf_menu` WRITE;
/*!40000 ALTER TABLE `conf_menu` DISABLE KEYS */;
INSERT INTO `conf_menu` VALUES (1,'Servicios',0,'',1,NULL,NULL),(2,'Capacitaciones',1,'',1,NULL,NULL),(3,'Curricula',2,'curriculas',1,NULL,NULL),(4,'Perfiles',2,'perfiles',0,NULL,NULL),(5,'Plan de Capacitaciones',2,'pl_planes',1,NULL,NULL),(6,'Asesorias',1,'',1,NULL,NULL),(7,'Asesoria 1',6,'',1,NULL,NULL),(8,'Consultoria',1,'',1,NULL,NULL),(9,'Consultoria 1',8,'',1,NULL,NULL),(10,'Reportes',0,'',1,NULL,NULL),(11,'Ingresos por cooperativa',10,'re_planes',1,NULL,NULL),(12,'Pagos',10,'',1,NULL,NULL),(13,'Configuracion',0,'',1,NULL,NULL),(14,'Gestion Usuarios',13,'',1,NULL,NULL),(15,'Internos',14,'usuarios_internos',1,NULL,NULL),(16,'Externos',14,'usuarios_externos',1,NULL,NULL),(17,'Cooperativas',28,'cooperativas',1,NULL,NULL),(18,'Gestion Sistema',13,'',1,NULL,NULL),(19,'Roles',14,'roles',1,NULL,NULL),(20,'Menu',18,'conf_menu',1,NULL,NULL),(21,'Sucursales',28,'sucursales',1,NULL,NULL),(26,'roles',14,'roles',0,NULL,NULL),(27,'Permisos',14,'subroles',1,NULL,NULL),(28,'Gestion Clientes',13,'',1,NULL,NULL),(29,'Respaldo',18,'conf_sistema',1,NULL,NULL),(30,'Mantenimientos',0,'#',0,NULL,NULL),(31,'Gestion de Modalidades',38,'mante_modalidades',1,NULL,NULL),(32,'Estados de Planes',38,'mante_estados_plan',1,NULL,NULL),(33,'Gestion de facilitadores',38,'mante_facilitadores',1,NULL,NULL),(34,'Gestion de Lugares',38,'mante_lugares',1,NULL,NULL),(35,'Costos',37,'mante_costos',0,NULL,NULL),(36,'Sub Costos',37,'mante_subcostos',0,NULL,NULL),(37,'Gestion de Costos',30,'#',0,NULL,NULL),(38,'Mantenimientos',13,'',1,1,NULL),(39,'Mantenimientos',13,'',0,1,NULL),(40,'Sericios a Cooperativas',0,'',1,1,NULL),(41,'Inscripción en Linea',40,'inscripcion_temas',1,1,NULL),(42,'Mantenimiento de tipos facilitadores',38,'mante_tipos_facilitadores',1,1,NULL),(43,'Mantenimiento de Cargos',38,'mante_cargos',1,1,NULL),(44,'Mantenimiento de rubros',38,'mante_rubros',1,1,NULL),(45,'Ver temas disponibles',40,'temas_disponibles',1,1,'_blank'),(46,'Inscripcion',2,'inscripcion',1,1,NULL);
/*!40000 ALTER TABLE `conf_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf_sucursal`
--

DROP TABLE IF EXISTS `conf_sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf_sucursal` (
  `id_sucursal` int(10) NOT NULL AUTO_INCREMENT,
  `id_cooperativa` int(10) NOT NULL,
  `sucursal` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_sucursal`),
  KEY `fk_conf_sucursal_conf_cooperativa1` (`id_cooperativa`),
  CONSTRAINT `FK_conf_sucursal` FOREIGN KEY (`id_cooperativa`) REFERENCES `conf_cooperativa` (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_sucursal`
--

LOCK TABLES `conf_sucursal` WRITE;
/*!40000 ALTER TABLE `conf_sucursal` DISABLE KEYS */;
INSERT INTO `conf_sucursal` VALUES (6,6,'San Vicente','25614589','23654913',1,'2013-06-05 21:59:23',1),(7,9,'San Salvador','23654269','23659613',1,'2013-06-05 21:59:23',1),(8,9,'Santa Ana','23698541','23651963',1,'2013-06-05 21:59:23',1),(9,6,'La Libertad','23695698','26395613',1,'2013-06-05 21:59:23',1),(10,6,'La Union','25647895','23691282',1,'2013-06-05 21:59:23',1),(11,6,'La Paz','25478956','25612569',1,'2013-06-05 21:59:23',1);
/*!40000 ALTER TABLE `conf_sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_curricula`
--

DROP TABLE IF EXISTS `cu_curricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_curricula` (
  `id_curricula` int(11) NOT NULL AUTO_INCREMENT,
  `curricula` varchar(100) DEFAULT NULL,
  `objetivo` varchar(200) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_curricula`
--

LOCK TABLES `cu_curricula` WRITE;
/*!40000 ALTER TABLE `cu_curricula` DISABLE KEYS */;
INSERT INTO `cu_curricula` VALUES (2,'Curricula General','Objetivo Curricula General',1,1,NULL,1),(5,'Curricula 2',NULL,1,1,NULL,0),(6,'curricula 3','objetivo curricula',1,1,'2013-06-05 00:00:00',0),(7,'curricula 4','objetivo curricula 4',1,1,'2013-06-05 21:20:36',0),(8,'curricula 4','objetivo curricula 4',1,1,'2013-06-05 21:20:36',0),(9,'55','asdasd',1,1,'2013-06-05 21:20:56',0),(10,'hola','hhhhhhhhhh',1,1,'2013-06-05 21:27:03',0);
/*!40000 ALTER TABLE `cu_curricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil`
--

DROP TABLE IF EXISTS `cu_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `id_curricula` int(11) DEFAULT NULL,
  `perfil` varchar(100) DEFAULT NULL,
  `aspectos_generales` text,
  `objetivos` text,
  `duracion` double(6,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_perfil`),
  KEY `fk_cu_perfil_cu_curricula1` (`id_curricula`),
  CONSTRAINT `FK_cu_perfil` FOREIGN KEY (`id_curricula`) REFERENCES `cu_curricula` (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil`
--

LOCK TABLES `cu_perfil` WRITE;
/*!40000 ALTER TABLE `cu_perfil` DISABLE KEYS */;
INSERT INTO `cu_perfil` VALUES (1,2,'Cajero',NULL,NULL,NULL,'2013-01-29',NULL,NULL,1),(4,2,'OFICIALES DE CREDITO',NULL,NULL,NULL,'0000-00-00',NULL,NULL,1),(5,5,'Perfil 1',NULL,NULL,NULL,'2013-06-05',NULL,NULL,1),(6,2,'Otro perfil',NULL,NULL,NULL,'2013-06-05',1,'2013-06-05 21:33:28',1),(7,2,'perfil 50',NULL,NULL,NULL,'2013-06-05',1,'2013-06-05 21:38:59',1);
/*!40000 ALTER TABLE `cu_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil_contenido_aspectos`
--

DROP TABLE IF EXISTS `cu_perfil_contenido_aspectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_contenido_aspectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_aspectos` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_aspectos` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_contenido_aspectos`
--

LOCK TABLES `cu_perfil_contenido_aspectos` WRITE;
/*!40000 ALTER TABLE `cu_perfil_contenido_aspectos` DISABLE KEYS */;
INSERT INTO `cu_perfil_contenido_aspectos` VALUES (7,'Área de Formación: Filosofía Institucional y Servicios que presta la cooperativa',1),(8,'ASPECTO 1',4);
/*!40000 ALTER TABLE `cu_perfil_contenido_aspectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil_contenido_b_material_apoyo`
--

DROP TABLE IF EXISTS `cu_perfil_contenido_b_material_apoyo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_contenido_b_material_apoyo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_b_material_apoyo` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_b_material_apoyo` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_contenido_b_material_apoyo`
--

LOCK TABLES `cu_perfil_contenido_b_material_apoyo` WRITE;
/*!40000 ALTER TABLE `cu_perfil_contenido_b_material_apoyo` DISABLE KEYS */;
INSERT INTO `cu_perfil_contenido_b_material_apoyo` VALUES (1,'Valores y principios cooperativos',1),(2,'Reglamento de la ley general de asociaciones cooperativas',1),(3,'Ley de intermediarios financieros no bancarios',1);
/*!40000 ALTER TABLE `cu_perfil_contenido_b_material_apoyo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil_contenido_niveles_logro`
--

DROP TABLE IF EXISTS `cu_perfil_contenido_niveles_logro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_contenido_niveles_logro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_niveles_logro` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_niveles_logro` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_contenido_niveles_logro`
--

LOCK TABLES `cu_perfil_contenido_niveles_logro` WRITE;
/*!40000 ALTER TABLE `cu_perfil_contenido_niveles_logro` DISABLE KEYS */;
INSERT INTO `cu_perfil_contenido_niveles_logro` VALUES (1,'Menciona la visión y misión de la cooperativa y como su puesto de trabajo contribuye al logro de la misma',1),(2,'Enumera cuales son los servicios que presta la cooperativa',1),(3,'Declara el nombre de la persona de cada área de la cooperativa a quien puede referir a los usuarios',1),(4,'Enumera las entidades para quienes puede recibir pagos de parte de los usuarios',1),(5,'Se encuentra actualizado con la información sobre las variaciones que pueden sufrir las tasas de interés en la cooperativa',1);
/*!40000 ALTER TABLE `cu_perfil_contenido_niveles_logro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil_contenido_objetivos`
--

DROP TABLE IF EXISTS `cu_perfil_contenido_objetivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_contenido_objetivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_contenido_objetivos`
--

LOCK TABLES `cu_perfil_contenido_objetivos` WRITE;
/*!40000 ALTER TABLE `cu_perfil_contenido_objetivos` DISABLE KEYS */;
INSERT INTO `cu_perfil_contenido_objetivos` VALUES (5,'Dar a conocer la filosofía institucional que rige la cooperativa con el propósito que el nuevo miembro adopte aptitudes y valores propios del cooperativismo',1),(6,'Transmitir los principios fundamentales para establecer un modo de vida cooperativista',1),(7,'Dar a conocer los servicios que brinda la cooperativa a fin de que el participante los identifique',1);
/*!40000 ALTER TABLE `cu_perfil_contenido_objetivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil_contenido_recursos`
--

DROP TABLE IF EXISTS `cu_perfil_contenido_recursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_contenido_recursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_recursos` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_recursos` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_contenido_recursos`
--

LOCK TABLES `cu_perfil_contenido_recursos` WRITE;
/*!40000 ALTER TABLE `cu_perfil_contenido_recursos` DISABLE KEYS */;
INSERT INTO `cu_perfil_contenido_recursos` VALUES (1,'Computadora',1),(2,'Laptop',1),(3,'Puntero',1),(4,'Papelográfo',1),(6,'Pizarra Acrílica',1),(7,'Plumones',1),(8,'Presentaciones',1),(9,'Fotografía o videos',1);
/*!40000 ALTER TABLE `cu_perfil_contenido_recursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil_contenido_sugerencias_metodologicas`
--

DROP TABLE IF EXISTS `cu_perfil_contenido_sugerencias_metodologicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_contenido_sugerencias_metodologicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_sugerencias_metodologicas` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_sugerencias_metodologicas` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_contenido_sugerencias_metodologicas`
--

LOCK TABLES `cu_perfil_contenido_sugerencias_metodologicas` WRITE;
/*!40000 ALTER TABLE `cu_perfil_contenido_sugerencias_metodologicas` DISABLE KEYS */;
INSERT INTO `cu_perfil_contenido_sugerencias_metodologicas` VALUES (1,'Actividades de Inducción:',1),(2,'Se sugiere la dinámica \"corazones\" para romper el hielo',1),(3,'Desarrollo de Contenido',1);
/*!40000 ALTER TABLE `cu_perfil_contenido_sugerencias_metodologicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil_contenido_unidades_competencia`
--

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_competencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_contenido_unidades_competencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_unidades_competencia` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_unidades_competencia` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_contenido_unidades_competencia`
--

LOCK TABLES `cu_perfil_contenido_unidades_competencia` WRITE;
/*!40000 ALTER TABLE `cu_perfil_contenido_unidades_competencia` DISABLE KEYS */;
INSERT INTO `cu_perfil_contenido_unidades_competencia` VALUES (2,'Conoce la filosofía organizacional de la cooperativa',1),(3,'Domina información básica de los servicios que presta la cooperativa',1),(4,'Identifica las personas encargadas de brindar detalles sobre los servicios que proporciona la cooperativa a fin de orientar adecuadamente a los usuarios que consulten',1),(5,'Identificar las entidades clientes de la cooperativa de quienes se puede aceptar pago por parte de los usuarios',1),(6,'Dispone de información actualizada sobre las tasas de interés de la cooperativa',1);
/*!40000 ALTER TABLE `cu_perfil_contenido_unidades_competencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_perfil_contenido_unidades_contenido`
--

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_contenido_unidades_contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_unidades_contenido` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_unidades_contenido` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_contenido_unidades_contenido`
--

LOCK TABLES `cu_perfil_contenido_unidades_contenido` WRITE;
/*!40000 ALTER TABLE `cu_perfil_contenido_unidades_contenido` DISABLE KEYS */;
INSERT INTO `cu_perfil_contenido_unidades_contenido` VALUES (1,'Historia del cooperativismo en El Salvador',1),(2,'Identidad Cooperativa',1),(3,'Historia de la Federación',1),(4,'Filosofía Institucional',1),(5,'Servicios que presta la Cooperativa',1);
/*!40000 ALTER TABLE `cu_perfil_contenido_unidades_contenido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_tablas_contenido`
--

DROP TABLE IF EXISTS `cu_tablas_contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_tablas_contenido` (
  `id_tabla_contenido` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tabla` varchar(100) DEFAULT NULL,
  `id_tabla` varchar(100) DEFAULT NULL,
  `nombre_contenido` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tabla_contenido`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_tablas_contenido`
--

LOCK TABLES `cu_tablas_contenido` WRITE;
/*!40000 ALTER TABLE `cu_tablas_contenido` DISABLE KEYS */;
INSERT INTO `cu_tablas_contenido` VALUES (1,'cu_perfil_contenido_aspectos','id_aspecto','Aspectos Generales'),(2,'cu_perfil_contenido_objetivos','id_objetivo','Objetivos'),(3,'cu_perfil_contenido_unidades_competencia',NULL,'Unidades de competencia'),(4,'cu_perfil_contenido_niveles_logro',NULL,'Niveles de logro'),(5,'cu_perfil_contenido_unidades_contenido',NULL,'Unidades de contenido'),(6,'cu_perfil_contenido_sugerencias_metodologicas',NULL,'Sugerencias metodologicas'),(7,'cu_perfil_contenido_recursos',NULL,'Recursos'),(8,'cu_perfil_contenido_b_material_apoyo',NULL,'Bibliografía y material de apoyo');
/*!40000 ALTER TABLE `cu_tablas_contenido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripcion_asistencia`
--

DROP TABLE IF EXISTS `inscripcion_asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscripcion_asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `id_inscripcion_personas` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripcion_asistencia`
--

LOCK TABLES `inscripcion_asistencia` WRITE;
/*!40000 ALTER TABLE `inscripcion_asistencia` DISABLE KEYS */;
INSERT INTO `inscripcion_asistencia` VALUES (12,1,4,'2013-07-27 21:18:41',1);
/*!40000 ALTER TABLE `inscripcion_asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripcion_temas`
--

DROP TABLE IF EXISTS `inscripcion_temas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscripcion_temas` (
  `id_inscripcion_tema` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_capacitacion` int(11) DEFAULT NULL,
  `id_cooperativa` int(11) NOT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_inscripcion_tema`),
  KEY `FK_inscripcion_temas` (`id_capacitacion`),
  KEY `id_cooperativa` (`id_cooperativa`),
  KEY `id_cooperativa_2` (`id_cooperativa`),
  CONSTRAINT `FK_inscripcion_temas` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`),
  CONSTRAINT `inscripcion_temas_ibfk_1` FOREIGN KEY (`id_cooperativa`) REFERENCES `conf_cooperativa` (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripcion_temas`
--

LOCK TABLES `inscripcion_temas` WRITE;
/*!40000 ALTER TABLE `inscripcion_temas` DISABLE KEYS */;
INSERT INTO `inscripcion_temas` VALUES (2,7,2,9,'2013-06-29 21:28:15',1),(3,7,2,9,'2013-07-10 22:08:47',1);
/*!40000 ALTER TABLE `inscripcion_temas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripcion_temas_personas`
--

DROP TABLE IF EXISTS `inscripcion_temas_personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscripcion_temas_personas` (
  `id_inscripcion_personas` int(11) NOT NULL AUTO_INCREMENT,
  `id_inscripcion_tema` int(11) NOT NULL,
  `apellidos` varchar(20) DEFAULT NULL,
  `nombres` varchar(20) DEFAULT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_inscripcion_personas`),
  KEY `FK_inscripcion_temas_personas` (`id_inscripcion_tema`),
  CONSTRAINT `FK_inscripcion_temas_personas` FOREIGN KEY (`id_inscripcion_tema`) REFERENCES `inscripcion_temas` (`id_inscripcion_tema`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripcion_temas_personas`
--

LOCK TABLES `inscripcion_temas_personas` WRITE;
/*!40000 ALTER TABLE `inscripcion_temas_personas` DISABLE KEYS */;
INSERT INTO `inscripcion_temas_personas` VALUES (4,2,'Hernandez','Jorge',8,3,7,'2013-06-29 21:43:29',1),(5,2,'Rodriguez','Carlos',7,4,7,'2013-06-29 21:43:45',1);
/*!40000 ALTER TABLE `inscripcion_temas_personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_cargos`
--

DROP TABLE IF EXISTS `mante_cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_cargos` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(100) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_cargo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_cargos`
--

LOCK TABLES `mante_cargos` WRITE;
/*!40000 ALTER TABLE `mante_cargos` DISABLE KEYS */;
INSERT INTO `mante_cargos` VALUES (1,'Cajero','2013-06-28 20:34:20',1,1),(2,'Gerente','2013-06-28 20:34:41',1,1),(3,'Secretaria','2013-06-28 20:34:53',1,1),(4,'Gestor de creditos','2013-06-28 20:35:04',1,1),(5,'Otros','2013-06-28 20:35:13',1,1);
/*!40000 ALTER TABLE `mante_cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_costos`
--

DROP TABLE IF EXISTS `mante_costos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_costos` (
  `id_costo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_costo` varchar(100) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_costo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_costos`
--

LOCK TABLES `mante_costos` WRITE;
/*!40000 ALTER TABLE `mante_costos` DISABLE KEYS */;
INSERT INTO `mante_costos` VALUES (1,'Costo 12',0,NULL,NULL),(2,'costo 3',1,NULL,NULL),(3,'costos 2',1,NULL,NULL),(4,'costo 4',1,NULL,NULL);
/*!40000 ALTER TABLE `mante_costos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_estados_planes`
--

DROP TABLE IF EXISTS `mante_estados_planes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_estados_planes` (
  `id_estado_plan` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(100) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_estado_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_estados_planes`
--

LOCK TABLES `mante_estados_planes` WRITE;
/*!40000 ALTER TABLE `mante_estados_planes` DISABLE KEYS */;
INSERT INTO `mante_estados_planes` VALUES (2,'Abierto',1,1,'2013-06-02 13:54:33'),(3,'Cerrado',1,1,'2013-06-02 13:54:33');
/*!40000 ALTER TABLE `mante_estados_planes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_facilitadores`
--

DROP TABLE IF EXISTS `mante_facilitadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_facilitadores` (
  `id_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_facilitador` int(11) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `t_oficina` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `correo` varchar(15) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_facilitador`),
  KEY `FK_mante_facilitadores` (`id_tipo_facilitador`),
  CONSTRAINT `FK_mante_facilitadores` FOREIGN KEY (`id_tipo_facilitador`) REFERENCES `mante_tipos_facilitadores` (`id_tipo_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_facilitadores`
--

LOCK TABLES `mante_facilitadores` WRITE;
/*!40000 ALTER TABLE `mante_facilitadores` DISABLE KEYS */;
INSERT INTO `mante_facilitadores` VALUES (1,1,'Jorge Antonio','Rodriguez','123456','123456','132465','jarh@jarh.com',1,1,'2013-06-11 10:00:00'),(2,1,'Carlos','Hernandez','123456789','123456789','123456789','jarh@jar.com',1,1,'2013-06-11 23:45:54');
/*!40000 ALTER TABLE `mante_facilitadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_lugares`
--

DROP TABLE IF EXISTS `mante_lugares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_lugares` (
  `id_lugar` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lugar` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_lugares`
--

LOCK TABLES `mante_lugares` WRITE;
/*!40000 ALTER TABLE `mante_lugares` DISABLE KEYS */;
INSERT INTO `mante_lugares` VALUES (2,'Lugar Nº1','123456','San Salvador',1,1,'2013-06-16 16:37:59'),(3,'Lugar 2','321654','Soyapango',1,1,'2013-06-16 16:39:00');
/*!40000 ALTER TABLE `mante_lugares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_modalidades`
--

DROP TABLE IF EXISTS `mante_modalidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_modalidades` (
  `id_modalidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modalidad` varchar(100) DEFAULT NULL,
  `objetivo` varchar(300) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_modalidades`
--

LOCK TABLES `mante_modalidades` WRITE;
/*!40000 ALTER TABLE `mante_modalidades` DISABLE KEYS */;
INSERT INTO `mante_modalidades` VALUES (1,'Modalidad 11','Objetivos Objetivos 1','2013-06-01 20:40:16',1,0),(2,'Diplomados','Diplomados, Diplomados','2013-06-01 20:54:52',1,1),(3,'Seminarios y Foros','Seminarios y Foros, Seminarios y Foros','2013-06-02 17:05:20',1,1),(4,'Talleres','Talleres, Talleres','2013-06-02 17:05:41',1,1),(5,'Congresos','Congresos, Congresos','2013-06-02 17:05:55',1,1);
/*!40000 ALTER TABLE `mante_modalidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_rubros`
--

DROP TABLE IF EXISTS `mante_rubros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_rubros` (
  `id_rubro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_rubros`
--

LOCK TABLES `mante_rubros` WRITE;
/*!40000 ALTER TABLE `mante_rubros` DISABLE KEYS */;
INSERT INTO `mante_rubros` VALUES (2,'Alimentos',1,'2013-06-19 20:53:32',1),(3,'Materiales',1,'2013-06-19 20:53:47',1);
/*!40000 ALTER TABLE `mante_rubros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_subcostos`
--

DROP TABLE IF EXISTS `mante_subcostos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_subcostos` (
  `id_subcosto` int(11) NOT NULL AUTO_INCREMENT,
  `id_costo` int(11) DEFAULT NULL,
  `nombre_subcosto` varchar(100) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_subcosto`),
  KEY `FK_mante_subcostos` (`id_costo`),
  CONSTRAINT `FK_mante_subcostos` FOREIGN KEY (`id_costo`) REFERENCES `mante_costos` (`id_costo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_subcostos`
--

LOCK TABLES `mante_subcostos` WRITE;
/*!40000 ALTER TABLE `mante_subcostos` DISABLE KEYS */;
INSERT INTO `mante_subcostos` VALUES (1,3,'sub costo 1',1,NULL,NULL);
/*!40000 ALTER TABLE `mante_subcostos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mante_tipos_facilitadores`
--

DROP TABLE IF EXISTS `mante_tipos_facilitadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mante_tipos_facilitadores` (
  `id_tipo_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_facilitador` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_tipo_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_tipos_facilitadores`
--

LOCK TABLES `mante_tipos_facilitadores` WRITE;
/*!40000 ALTER TABLE `mante_tipos_facilitadores` DISABLE KEYS */;
INSERT INTO `mante_tipos_facilitadores` VALUES (1,'Facilitador 1',1,'2013-06-28 20:28:15',1);
/*!40000 ALTER TABLE `mante_tipos_facilitadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pl_capacitaciones`
--

DROP TABLE IF EXISTS `pl_capacitaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pl_capacitaciones` (
  `id_capacitacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan_modalidad` int(11) DEFAULT NULL,
  `nombre_capacitacion` varchar(100) DEFAULT NULL,
  `objetivo` varchar(300) DEFAULT NULL,
  `cerrado` int(11) DEFAULT '0',
  `n_participantes` int(11) DEFAULT '1',
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_capacitacion`),
  KEY `FK_pl_capacitaciones` (`id_plan_modalidad`),
  CONSTRAINT `FK_pl_capacitaciones` FOREIGN KEY (`id_plan_modalidad`) REFERENCES `pl_modalidades` (`id_plan_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_capacitaciones`
--

LOCK TABLES `pl_capacitaciones` WRITE;
/*!40000 ALTER TABLE `pl_capacitaciones` DISABLE KEYS */;
INSERT INTO `pl_capacitaciones` VALUES (1,4,'V congreso de mujeres','Gestion Crediticia EfectivaGestion Crediticia EfectivaGestion Crediticia Efectiva',0,20,'2013-06-02 18:19:52',1,1),(2,3,'Gestion estrategica de agencias','Gestion estrategica de agencias',1,30,'2013-06-13 22:33:23',1,1),(3,3,'Valuos - casos practicos de campo','Tema 2 Tema 2 Tema 2',1,20,'2013-06-19 21:11:27',1,1),(4,1,'Gestion de recuperacion exitosa','Capacitacion 1',0,20,'2013-07-01 21:18:19',1,1),(5,2,'Presentacion de codigo de buenas Practicas','Seminario 1',0,30,'2013-07-01 21:19:11',1,1),(6,5,'Capacitacion 1','Capacitacion 1',0,20,'2013-07-26 19:39:07',1,1);
/*!40000 ALTER TABLE `pl_capacitaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pl_modalidades`
--

DROP TABLE IF EXISTS `pl_modalidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pl_modalidades` (
  `id_plan_modalidad` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan` int(11) DEFAULT NULL,
  `id_modalidad` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_plan_modalidad`),
  KEY `FK_pl_modalidades` (`id_plan`),
  KEY `FK_pl_modalidades2` (`id_modalidad`),
  CONSTRAINT `FK_pl_modalidades` FOREIGN KEY (`id_plan`) REFERENCES `pl_planes` (`id_plan`),
  CONSTRAINT `FK_pl_modalidades2` FOREIGN KEY (`id_modalidad`) REFERENCES `mante_modalidades` (`id_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_modalidades`
--

LOCK TABLES `pl_modalidades` WRITE;
/*!40000 ALTER TABLE `pl_modalidades` DISABLE KEYS */;
INSERT INTO `pl_modalidades` VALUES (1,1,2,1,'2013-06-02 16:31:12',1),(2,1,3,1,'2013-06-02 17:22:10',1),(3,1,4,1,'2013-06-02 17:22:14',1),(4,1,5,1,'2013-06-02 17:22:20',1),(5,2,2,1,'2013-07-26 19:35:31',1);
/*!40000 ALTER TABLE `pl_modalidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pl_modulo_facilitador`
--

DROP TABLE IF EXISTS `pl_modulo_facilitador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pl_modulo_facilitador` (
  `id_modulo_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) DEFAULT NULL,
  `id_facilitador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_modulo_facilitador`),
  KEY `FK_pl_modulo_facilitador` (`id_facilitador`),
  KEY `FK_pl_modulo_facilitador_2` (`id_modulo`),
  CONSTRAINT `FK_pl_modulo_facilitador` FOREIGN KEY (`id_facilitador`) REFERENCES `mante_facilitadores` (`id_facilitador`),
  CONSTRAINT `FK_pl_modulo_facilitador_2` FOREIGN KEY (`id_modulo`) REFERENCES `pl_modulos` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_modulo_facilitador`
--

LOCK TABLES `pl_modulo_facilitador` WRITE;
/*!40000 ALTER TABLE `pl_modulo_facilitador` DISABLE KEYS */;
INSERT INTO `pl_modulo_facilitador` VALUES (7,1,2),(8,2,1),(9,2,2),(20,3,1),(21,3,2),(22,9,2),(23,7,1),(24,7,2),(25,8,2),(26,5,2),(27,6,1);
/*!40000 ALTER TABLE `pl_modulo_facilitador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pl_modulos`
--

DROP TABLE IF EXISTS `pl_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pl_modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_capacitacion` int(11) DEFAULT NULL,
  `id_lugar` int(11) DEFAULT NULL,
  `nombre_modulo` varchar(100) DEFAULT NULL,
  `precio_venta` decimal(12,2) DEFAULT '0.00',
  `objetivo_modulo` varchar(300) DEFAULT NULL,
  `id_contenido` int(11) DEFAULT '0',
  `fecha_prevista` date DEFAULT NULL,
  `fecha_prevista_fin` date DEFAULT NULL,
  `contenido` varchar(200) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_modulo`),
  KEY `FK_pl_modulos` (`id_capacitacion`),
  KEY `FK_pl_modulos_2` (`id_lugar`),
  CONSTRAINT `FK_pl_modulos` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`),
  CONSTRAINT `FK_pl_modulos_2` FOREIGN KEY (`id_lugar`) REFERENCES `mante_lugares` (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_modulos`
--

LOCK TABLES `pl_modulos` WRITE;
/*!40000 ALTER TABLE `pl_modulos` DISABLE KEYS */;
INSERT INTO `pl_modulos` VALUES (1,2,2,'Gestion mercadologica de las agencias',10.00,'Gestion mercadologica de las agencias',0,'2013-06-16','2013-06-16','Área de Formación: Filosofía Institucional y Servicios que presta la cooperativa',1,'2013-06-13 22:34:18',1),(2,2,2,'Gestioin mercadologica de las agencias',20.00,'Gestioin mercadologica de las agencias',0,'2013-06-16','2013-06-16','Contenido 1\r\n',1,'2013-06-13 22:35:05',1),(3,2,3,'Base normativa para la apertura de agencias',40.00,'Base normativa para la apertura de agencias',0,'2013-07-10','2013-07-10','contenido 2',1,'2013-06-13 22:35:50',1),(4,2,3,'NUevo modulo',10.00,'NUevo modulo',0,'2013-06-16','2013-06-16','aaaaaaaaaaa',1,'2013-06-16 15:58:55',0),(5,3,3,'Casos de estudio en terreno',20.00,'Modulo 1 Modulo 1 ',0,'2013-07-26','2013-07-26','hola',1,'2013-06-19 21:11:56',1),(6,1,2,'V congreso de mujeres',30.00,'Modulo 1',0,'2013-07-26','2013-07-26','Modulo 1',1,'2013-07-01 21:13:20',1),(7,4,3,'Modulo 1. Aspectos legales y normativos relacionados a la mora y a la cobranza',10.00,'modulo 1',0,'2013-07-26','2013-07-26','modulo 1',1,'2013-07-01 21:18:36',1),(8,5,2,'Presentacion de codigo de buenas Practicas',40.00,'Modulo 1',0,'2013-07-26','2013-07-26','Modulo 1',1,'2013-07-01 21:19:24',1),(9,6,2,'Modulo 1',10.00,'Modulo 1',0,'2013-07-19','2013-07-19','Contenido',1,'2013-07-26 19:40:23',1);
/*!40000 ALTER TABLE `pl_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pl_planes`
--

DROP TABLE IF EXISTS `pl_planes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pl_planes` (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_plan` varchar(100) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_estado_plan` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_plan`),
  KEY `FK_pl_planes` (`id_estado_plan`),
  CONSTRAINT `FK_pl_planes` FOREIGN KEY (`id_estado_plan`) REFERENCES `mante_estados_planes` (`id_estado_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_planes`
--

LOCK TABLES `pl_planes` WRITE;
/*!40000 ALTER TABLE `pl_planes` DISABLE KEYS */;
INSERT INTO `pl_planes` VALUES (1,'Plan de capacitacion 2013','2013-06-02 14:14:59',1,2,1),(2,'Plan de capacitacion 2012','2013-06-19 21:26:23',1,2,1);
/*!40000 ALTER TABLE `pl_planes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pl_rubro`
--

DROP TABLE IF EXISTS `pl_rubro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pl_rubro` (
  `id_rubro` int(11) NOT NULL AUTO_INCREMENT,
  `id_rubro_name` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_rubro`),
  KEY `FK_pl_rubro` (`id_modulo`),
  KEY `FK_pl_rubro2` (`id_rubro_name`),
  CONSTRAINT `FK_pl_rubro` FOREIGN KEY (`id_modulo`) REFERENCES `pl_modulos` (`id_modulo`),
  CONSTRAINT `FK_pl_rubro2` FOREIGN KEY (`id_rubro_name`) REFERENCES `mante_rubros` (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_rubro`
--

LOCK TABLES `pl_rubro` WRITE;
/*!40000 ALTER TABLE `pl_rubro` DISABLE KEYS */;
INSERT INTO `pl_rubro` VALUES (1,2,3,'2013-06-13 23:11:01',1,1),(2,3,3,'2013-06-13 23:12:09',1,1),(3,2,5,'2013-06-19 21:12:06',1,1),(4,3,3,'2013-06-19 22:16:39',1,1),(5,2,6,'2013-07-01 21:13:28',1,1),(6,3,7,'2013-07-01 21:18:42',1,1),(7,2,8,'2013-07-01 21:19:29',1,1),(8,2,9,'2013-07-26 19:40:35',1,1),(9,2,2,'2013-07-26 19:43:42',1,1),(10,3,2,'2013-07-26 19:44:09',1,1),(11,3,1,'2013-07-26 19:44:26',1,1),(12,3,4,'2013-07-26 19:44:48',1,1);
/*!40000 ALTER TABLE `pl_rubro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pl_subrubro`
--

DROP TABLE IF EXISTS `pl_subrubro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pl_subrubro` (
  `id_subrubro` int(11) NOT NULL AUTO_INCREMENT,
  `id_rubro` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `unidades` int(11) DEFAULT '0',
  `costo` decimal(12,2) DEFAULT '0.00',
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_subrubro`),
  KEY `FK_pl_subrubro` (`id_rubro`),
  CONSTRAINT `FK_pl_subrubro` FOREIGN KEY (`id_rubro`) REFERENCES `pl_rubro` (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_subrubro`
--

LOCK TABLES `pl_subrubro` WRITE;
/*!40000 ALTER TABLE `pl_subrubro` DISABLE KEYS */;
INSERT INTO `pl_subrubro` VALUES (1,1,'Desayuno',20,3.00,'2013-06-13 23:11:26',1,1),(2,1,'Refrigerio',20,2.00,'2013-06-13 23:11:51',1,1),(3,2,'Folder',20,0.50,'2013-06-13 23:12:28',1,1),(4,2,'Lapiceros',20,0.10,'2013-06-13 23:12:44',1,1),(5,2,'Libreta',20,5.00,'2013-06-13 23:13:02',1,1),(6,3,'Almuerzo',10,2.00,'2013-06-19 21:12:22',1,1),(7,5,'Refrigerio',20,2.00,'2013-07-01 21:13:47',1,1),(8,6,'Cuadernos',20,3.00,'2013-07-01 21:18:52',1,1),(9,7,'Almuerzos',30,2.00,'2013-07-01 21:19:41',1,1),(10,8,'Desayuno',20,1.00,'2013-07-26 19:40:52',1,1),(11,8,'Refrijerio',20,1.00,'2013-07-26 19:41:12',1,1),(12,9,'Almuerzo',30,2.00,'2013-07-26 19:43:55',1,1),(13,10,'Folleto',30,1.00,'2013-07-26 19:44:18',1,1),(14,11,'Lapiceros',30,0.50,'2013-07-26 19:44:39',1,1),(15,12,'Folder',30,0.50,'2013-07-26 19:44:59',1,1),(16,12,'Cuadernos',30,1.00,'2013-07-26 19:45:07',1,1);
/*!40000 ALTER TABLE `pl_subrubro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitio_slider`
--

DROP TABLE IF EXISTS `sitio_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitio_slider` (
  `id_slider` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_imagen` varchar(200) DEFAULT NULL,
  `texto_aparecer` varchar(200) DEFAULT NULL,
  `nombre_archivo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitio_slider`
--

LOCK TABLES `sitio_slider` WRITE;
/*!40000 ALTER TABLE `sitio_slider` DISABLE KEYS */;
INSERT INTO `sitio_slider` VALUES (1,'Imagen 1','Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto ','slider_1.jpg'),(2,'Imagen 2','Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto ','slider_2.png'),(3,'Imagen 3','Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto ','slider_3.gif'),(4,'Imagen 4','Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto ','slider_4.jpg');
/*!40000 ALTER TABLE `sitio_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_coop_suc`
--

DROP TABLE IF EXISTS `usu_coop_suc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_coop_suc` (
  `id_usu_coop` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cooperativa` int(11) DEFAULT NULL,
  `id_sucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usu_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_coop_suc`
--

LOCK TABLES `usu_coop_suc` WRITE;
/*!40000 ALTER TABLE `usu_coop_suc` DISABLE KEYS */;
INSERT INTO `usu_coop_suc` VALUES (3,4,9,0),(6,7,9,0),(7,7,9,0),(8,6,9,0);
/*!40000 ALTER TABLE `usu_coop_suc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_permisos_menu`
--

DROP TABLE IF EXISTS `usu_permisos_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_permisos_menu` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `id_subrol` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`),
  KEY `FK_usu_permisos_menu` (`id_menu`),
  KEY `FK_usu_permisos_menu2` (`id_subrol`),
  CONSTRAINT `FK_usu_permisos_menu` FOREIGN KEY (`id_menu`) REFERENCES `conf_menu` (`id_menu`),
  CONSTRAINT `FK_usu_permisos_menu2` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=267 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_permisos_menu`
--

LOCK TABLES `usu_permisos_menu` WRITE;
/*!40000 ALTER TABLE `usu_permisos_menu` DISABLE KEYS */;
INSERT INTO `usu_permisos_menu` VALUES (229,2,40),(230,2,41),(231,2,45),(232,3,40),(233,3,41),(234,3,45),(235,1,1),(236,1,2),(237,1,3),(238,1,5),(239,1,46),(240,1,6),(241,1,7),(242,1,8),(243,1,9),(244,1,10),(245,1,11),(246,1,12),(247,1,13),(248,1,14),(249,1,15),(250,1,16),(251,1,19),(252,1,27),(253,1,18),(254,1,20),(255,1,29),(256,1,28),(257,1,17),(258,1,21),(259,1,38),(260,1,31),(261,1,32),(262,1,33),(263,1,34),(264,1,42),(265,1,43),(266,1,44);
/*!40000 ALTER TABLE `usu_permisos_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_rol`
--

DROP TABLE IF EXISTS `usu_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_usuario` int(11) DEFAULT '0',
  `rol` varchar(25) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  KEY `FK_usu_rol` (`id_tipo_usuario`),
  CONSTRAINT `FK_usu_rol` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `usu_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_rol`
--

LOCK TABLES `usu_rol` WRITE;
/*!40000 ALTER TABLE `usu_rol` DISABLE KEYS */;
INSERT INTO `usu_rol` VALUES (1,1,'Administrador del Sistema',1),(2,2,'Cliente',1),(3,1,'Consultor y/o Asesor',1),(4,1,'Administrador Curricula',1),(5,1,'Administrador del Plan',1);
/*!40000 ALTER TABLE `usu_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_subrol`
--

DROP TABLE IF EXISTS `usu_subrol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_subrol` (
  `id_subrol` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `subrol` varchar(25) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_subrol`),
  KEY `FK_usu_subrol` (`id_rol`),
  CONSTRAINT `FK_usu_subrol` FOREIGN KEY (`id_rol`) REFERENCES `usu_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_subrol`
--

LOCK TABLES `usu_subrol` WRITE;
/*!40000 ALTER TABLE `usu_subrol` DISABLE KEYS */;
INSERT INTO `usu_subrol` VALUES (1,1,'Administrador',1),(2,2,'Cooperativa',1),(3,2,'Sucursal',1);
/*!40000 ALTER TABLE `usu_subrol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_tipo_usuario`
--

DROP TABLE IF EXISTS `usu_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_usuario` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_tipo_usuario`
--

LOCK TABLES `usu_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `usu_tipo_usuario` DISABLE KEYS */;
INSERT INTO `usu_tipo_usuario` VALUES (1,'Usuario Interno'),(2,'Usuario Externo');
/*!40000 ALTER TABLE `usu_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_usuario`
--

DROP TABLE IF EXISTS `usu_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `nombre_completo` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `direccion` text,
  `correo` varchar(50) DEFAULT NULL,
  `ultimo_acceso` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_subrol` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  KEY `FK_usu_usuario` (`id_subrol`),
  CONSTRAINT `FK_usu_usuario` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_usuario`
--

LOCK TABLES `usu_usuario` WRITE;
/*!40000 ALTER TABLE `usu_usuario` DISABLE KEYS */;
INSERT INTO `usu_usuario` VALUES (1,'admin','202cb962ac59075b964b07152d234b70','Administrador 1','12345','12345','dkfjkdsjfk','','2013-07-28 21:16:00',0,1,1),(2,'rolan','202cb962ac59075b964b07152d234b70','Rolando Medrano1','111111','11111','9re98r9488dvkfckf',NULL,NULL,1,1,1),(3,'sdoradea','1234','Sergio','434','34324',NULL,NULL,NULL,0,1,1),(4,'usu3','123','Usuario 3','','',NULL,NULL,NULL,1,2,1),(5,'eeee','202cb962ac59075b964b07152d234b70','Jorge Rodriguez','22222','22222222',NULL,NULL,NULL,1,1,1),(6,'usuario1','122b738600a0f74f7c331c0ef59bc34c','Carlos Rivera','23659848','75698459',NULL,'','2013-06-29 21:57:12',1,2,1),(7,'jarh','e10adc3949ba59abbe56e057f20f883e','Jorge Rodriguez','123456','123456',NULL,'jarh@jarh.com','2013-07-28 22:01:03',1,2,1);
/*!40000 ALTER TABLE `usu_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-29  0:09:48
