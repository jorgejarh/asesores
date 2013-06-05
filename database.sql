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
-- Table structure for table `cap_capacitacion`
--

DROP TABLE IF EXISTS `cap_capacitacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cap_capacitacion` (
  `id_capacitacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_capacitacion` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `capacitacion` varchar(300) DEFAULT NULL,
  `costo` double(6,2) DEFAULT NULL,
  `punto_equilibrio` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_inicio_propuesta` date DEFAULT NULL,
  `fecha_fin_propuesta` date DEFAULT NULL,
  `fecha_inicio_real` date DEFAULT NULL,
  `fecha_fin_real` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_capacitacion`),
  KEY `fk_cap_capacitacion_cap_estado1` (`id_estado`),
  KEY `fk_cap_capacitacion_cap_tipo_capacitacion1` (`id_tipo_capacitacion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cap_capacitacion`
--

LOCK TABLES `cap_capacitacion` WRITE;
/*!40000 ALTER TABLE `cap_capacitacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `cap_capacitacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cap_estado`
--

DROP TABLE IF EXISTS `cap_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cap_estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cap_estado`
--

LOCK TABLES `cap_estado` WRITE;
/*!40000 ALTER TABLE `cap_estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `cap_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cap_tipo_capacitacion`
--

DROP TABLE IF EXISTS `cap_tipo_capacitacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cap_tipo_capacitacion` (
  `id_tipo_capacitacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_capacitacion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_capacitacion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cap_tipo_capacitacion`
--

LOCK TABLES `cap_tipo_capacitacion` WRITE;
/*!40000 ALTER TABLE `cap_tipo_capacitacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `cap_tipo_capacitacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `causa_inf`
--

DROP TABLE IF EXISTS `causa_inf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `causa_inf` (
  `id_causa_inf` int(11) NOT NULL AUTO_INCREMENT,
  `causa_inf` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_causa_inf`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `causa_inf`
--

LOCK TABLES `causa_inf` WRITE;
/*!40000 ALTER TABLE `causa_inf` DISABLE KEYS */;
INSERT INTO `causa_inf` VALUES (1,'Docente');
/*!40000 ALTER TABLE `causa_inf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `causas`
--

DROP TABLE IF EXISTS `causas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `causas` (
  `id_causa` int(11) NOT NULL AUTO_INCREMENT,
  `causa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_causa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `causas`
--

LOCK TABLES `causas` WRITE;
/*!40000 ALTER TABLE `causas` DISABLE KEYS */;
/*!40000 ALTER TABLE `causas` ENABLE KEYS */;
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
  PRIMARY KEY (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_cooperativa`
--

LOCK TABLES `conf_cooperativa` WRITE;
/*!40000 ALTER TABLE `conf_cooperativa` DISABLE KEYS */;
INSERT INTO `conf_cooperativa` VALUES (6,'ACODJAR DE R.L.','Central','2333 7400','2333 7406','gerencia.acodjar@fedecaces.com',NULL,'logos/logo_acodjar.png',1),(9,'ACACCIBA','Central','2618 2427',NULL,'gerencia.acacciba@fedecaces.com',NULL,'logos/logo_acacciba.png',1),(10,'ACACEMIHA DE R.L.','Central','2272 6527',NULL,'acacemiha@fedecaces.com',NULL,'logos/logo_acacemiha.png',1),(19,'ACACES DE R.L.','daf','2288 2103','','info@acaces.com.sv','23',NULL,1);
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
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_menu`
--

LOCK TABLES `conf_menu` WRITE;
/*!40000 ALTER TABLE `conf_menu` DISABLE KEYS */;
INSERT INTO `conf_menu` VALUES (1,'Servicios',0,'',1),(2,'Capacitaciones',1,'',1),(3,'Curricula',2,'curriculas',1),(4,'Perfiles',2,'perfiles',0),(5,'Plan de Capacitaciones',2,'pl_planes',1),(6,'Asesorias',1,'',1),(7,'Asesoria 1',6,'',1),(8,'Consultoria',1,'',1),(9,'Consultoria 1',8,'',1),(10,'Reportes',0,'',1),(11,'Dashboard',10,'',1),(12,'Pagos',10,'',1),(13,'Configuracion',0,'',1),(14,'Gestion Usuarios',13,'',1),(15,'Internos',14,'usuarios_internos',1),(16,'Externos',14,'usuarios_externos',1),(17,'Cooperativas',28,'cooperativas',1),(18,'Gestion Sistema',13,'',1),(19,'Roles',14,'roles',1),(20,'Menu',18,'conf_menu',1),(21,'Sucursales',28,'sucursales',1),(26,'roles',14,'roles',0),(27,'Permisos',14,'subroles',1),(28,'Gestion Clientes',13,'',1),(29,'Respaldo',18,'conf_sistema',1),(30,'Mantenimientos',0,'',1),(31,'Modalidades',30,'mante_modalidades',1),(32,'Estados de Planes',30,'mante_estados_plan',1),(33,'Gestion de facilitadores',30,'mante_facilitadores',1),(34,'Gestion de Lugares',30,'mante_lugares',1),(35,'Costos',37,'mante_costos',1),(36,'Sub Costos',37,'mante_subcostos',1),(37,'Gestion de Costos',30,'',1);
/*!40000 ALTER TABLE `conf_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf_modulo`
--

DROP TABLE IF EXISTS `conf_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf_modulo` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(50) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_modulo`
--

LOCK TABLES `conf_modulo` WRITE;
/*!40000 ALTER TABLE `conf_modulo` DISABLE KEYS */;
INSERT INTO `conf_modulo` VALUES (1,'Capacitaciones',1,NULL),(2,'Asesorias',2,NULL),(3,'Consultorias',3,NULL),(4,'Reportes',4,NULL),(5,'Configuracion del sistema',5,NULL);
/*!40000 ALTER TABLE `conf_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf_opcion`
--

DROP TABLE IF EXISTS `conf_opcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf_opcion` (
  `id_opcion` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) DEFAULT NULL,
  `opcion` varchar(50) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_opcion`),
  KEY `fk_conf_opcion_conf_modulo` (`id_modulo`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_opcion`
--

LOCK TABLES `conf_opcion` WRITE;
/*!40000 ALTER TABLE `conf_opcion` DISABLE KEYS */;
INSERT INTO `conf_opcion` VALUES (1,1,'Curricula','curriculas',1),(2,1,'Perfiles','perfiles',1),(3,2,'Asesoría','#',1),(4,2,'Asesoria: -2','#',1),(5,3,'Consultorias: -1','#',1),(6,3,'Consultorias: -2','#',1),(7,4,'Dashboard','#',1),(8,4,'Pagos','#',1),(9,5,'Usuarios','users',1),(10,5,'Cooperativas','cooperativas',1),(11,5,'Sistema','conf_sistema',1),(12,1,'Plan de Capacitaciones','plan',1);
/*!40000 ALTER TABLE `conf_opcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf_recurso`
--

DROP TABLE IF EXISTS `conf_recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf_recurso` (
  `id_recurso` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_recurso` int(11) DEFAULT NULL,
  `recurso` varchar(150) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_recurso`),
  KEY `fk_conf_recurso_conf_tipo_recurso1` (`id_tipo_recurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_recurso`
--

LOCK TABLES `conf_recurso` WRITE;
/*!40000 ALTER TABLE `conf_recurso` DISABLE KEYS */;
/*!40000 ALTER TABLE `conf_recurso` ENABLE KEYS */;
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
  PRIMARY KEY (`id_sucursal`),
  KEY `fk_conf_sucursal_conf_cooperativa1` (`id_cooperativa`),
  CONSTRAINT `FK_conf_sucursal` FOREIGN KEY (`id_cooperativa`) REFERENCES `conf_cooperativa` (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_sucursal`
--

LOCK TABLES `conf_sucursal` WRITE;
/*!40000 ALTER TABLE `conf_sucursal` DISABLE KEYS */;
INSERT INTO `conf_sucursal` VALUES (6,6,'San Vicente');
/*!40000 ALTER TABLE `conf_sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conf_tipo_recurso`
--

DROP TABLE IF EXISTS `conf_tipo_recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf_tipo_recurso` (
  `id_tipo_recurso` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_recurso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_recurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf_tipo_recurso`
--

LOCK TABLES `conf_tipo_recurso` WRITE;
/*!40000 ALTER TABLE `conf_tipo_recurso` DISABLE KEYS */;
/*!40000 ALTER TABLE `conf_tipo_recurso` ENABLE KEYS */;
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
  `objetivo` varchar(700) DEFAULT NULL,
  `f_creacion` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_curricula`
--

LOCK TABLES `cu_curricula` WRITE;
/*!40000 ALTER TABLE `cu_curricula` DISABLE KEYS */;
INSERT INTO `cu_curricula` VALUES (2,'Curricula General',NULL,NULL,1),(5,'Curricula 2',NULL,NULL,1),(6,'Liderazgo','Prepara futuros lidres','2013-06-05',1),(7,'Cultura General','Conservar patrones culturales','2013-06-05',1);
/*!40000 ALTER TABLE `cu_curricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_detalle_sugerenia`
--

DROP TABLE IF EXISTS `cu_detalle_sugerenia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_detalle_sugerenia` (
  `id_detalle_sugerenia` int(11) NOT NULL AUTO_INCREMENT,
  `id_sugerencia` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `detalle` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_sugerenia`),
  KEY `fk_cu_detalle_sugerenia_cu_sugerencia_metodologica1` (`id_sugerencia`),
  KEY `fk_cu_detalle_sugerenia_cu_perfil1` (`id_perfil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_detalle_sugerenia`
--

LOCK TABLES `cu_detalle_sugerenia` WRITE;
/*!40000 ALTER TABLE `cu_detalle_sugerenia` DISABLE KEYS */;
/*!40000 ALTER TABLE `cu_detalle_sugerenia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_nivel_logro`
--

DROP TABLE IF EXISTS `cu_nivel_logro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_nivel_logro` (
  `id_nivel_logro` int(11) NOT NULL AUTO_INCREMENT,
  `id_competencia` int(11) DEFAULT NULL,
  `nivel_logro` text,
  PRIMARY KEY (`id_nivel_logro`),
  KEY `fk_cu_nivel_logro_cu_unidad_competencia1` (`id_competencia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_nivel_logro`
--

LOCK TABLES `cu_nivel_logro` WRITE;
/*!40000 ALTER TABLE `cu_nivel_logro` DISABLE KEYS */;
/*!40000 ALTER TABLE `cu_nivel_logro` ENABLE KEYS */;
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
  PRIMARY KEY (`id_perfil`),
  KEY `fk_cu_perfil_cu_curricula1` (`id_curricula`),
  CONSTRAINT `FK_cu_perfil` FOREIGN KEY (`id_curricula`) REFERENCES `cu_curricula` (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil`
--

LOCK TABLES `cu_perfil` WRITE;
/*!40000 ALTER TABLE `cu_perfil` DISABLE KEYS */;
INSERT INTO `cu_perfil` VALUES (1,2,'Cajero',NULL,NULL,NULL,'2013-01-29'),(4,2,'OFICIALES DE CREDITO',NULL,NULL,NULL,'0000-00-00');
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
-- Table structure for table `cu_perfil_recurso`
--

DROP TABLE IF EXISTS `cu_perfil_recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_perfil_recurso` (
  `id_perfil_recurso` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) DEFAULT NULL,
  `id_recurso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_perfil_recurso`),
  KEY `fk_cu_perfil_recurso_cu_perfil1` (`id_perfil`),
  KEY `fk_cu_perfil_recurso_conf_recurso1` (`id_recurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_perfil_recurso`
--

LOCK TABLES `cu_perfil_recurso` WRITE;
/*!40000 ALTER TABLE `cu_perfil_recurso` DISABLE KEYS */;
/*!40000 ALTER TABLE `cu_perfil_recurso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_sugerencia_metodologica`
--

DROP TABLE IF EXISTS `cu_sugerencia_metodologica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_sugerencia_metodologica` (
  `id_sugerencia` int(11) NOT NULL AUTO_INCREMENT,
  `sugerencia` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_sugerencia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_sugerencia_metodologica`
--

LOCK TABLES `cu_sugerencia_metodologica` WRITE;
/*!40000 ALTER TABLE `cu_sugerencia_metodologica` DISABLE KEYS */;
/*!40000 ALTER TABLE `cu_sugerencia_metodologica` ENABLE KEYS */;
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
-- Table structure for table `cu_unidad_competencia`
--

DROP TABLE IF EXISTS `cu_unidad_competencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_unidad_competencia` (
  `id_competencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) DEFAULT NULL,
  `competencia` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_competencia`),
  KEY `fk_cu_unidad_competencia_cu_perfil1` (`id_perfil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_unidad_competencia`
--

LOCK TABLES `cu_unidad_competencia` WRITE;
/*!40000 ALTER TABLE `cu_unidad_competencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `cu_unidad_competencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu_unidad_contenido`
--

DROP TABLE IF EXISTS `cu_unidad_contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu_unidad_contenido` (
  `id_unidad` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) DEFAULT NULL,
  `unidad` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_unidad`),
  KEY `fk_cu_unidad_contenido_cu_perfil1` (`id_perfil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu_unidad_contenido`
--

LOCK TABLES `cu_unidad_contenido` WRITE;
/*!40000 ALTER TABLE `cu_unidad_contenido` DISABLE KEYS */;
/*!40000 ALTER TABLE `cu_unidad_contenido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuesta`
--

DROP TABLE IF EXISTS `encuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `retiro_ciclo` int(11) DEFAULT NULL,
  `id_causa` int(11) DEFAULT NULL,
  `influyo_utec` int(11) DEFAULT NULL,
  `esta_ins` int(11) DEFAULT NULL,
  `id_causa_inf` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuesta`
--

LOCK TABLES `encuesta` WRITE;
/*!40000 ALTER TABLE `encuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `encuesta` ENABLE KEYS */;
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
INSERT INTO `mante_estados_planes` VALUES (1,'estado 11',1,NULL,NULL),(2,'estado2',1,NULL,NULL),(3,'estado 5',1,1,'2013-06-02 13:54:33');
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
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `t_oficina` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `correo` varchar(15) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_facilitadores`
--

LOCK TABLES `mante_facilitadores` WRITE;
/*!40000 ALTER TABLE `mante_facilitadores` DISABLE KEYS */;
INSERT INTO `mante_facilitadores` VALUES (1,'Jorge Antonio','Rodriguez','123456','123456','132465','jarh@jarh.com',1,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mante_lugares`
--

LOCK TABLES `mante_lugares` WRITE;
/*!40000 ALTER TABLE `mante_lugares` DISABLE KEYS */;
INSERT INTO `mante_lugares` VALUES (1,'Lugar 1','123456','111111111122',0,NULL,NULL);
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
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_capacitacion`),
  KEY `FK_pl_capacitaciones` (`id_plan_modalidad`),
  CONSTRAINT `FK_pl_capacitaciones` FOREIGN KEY (`id_plan_modalidad`) REFERENCES `pl_modalidades` (`id_plan_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_capacitaciones`
--

LOCK TABLES `pl_capacitaciones` WRITE;
/*!40000 ALTER TABLE `pl_capacitaciones` DISABLE KEYS */;
INSERT INTO `pl_capacitaciones` VALUES (1,4,'Gestion Crediticia Efectiva','Gestion Crediticia EfectivaGestion Crediticia EfectivaGestion Crediticia Efectiva','2013-06-02 18:19:52',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_modalidades`
--

LOCK TABLES `pl_modalidades` WRITE;
/*!40000 ALTER TABLE `pl_modalidades` DISABLE KEYS */;
INSERT INTO `pl_modalidades` VALUES (1,1,2,1,'2013-06-02 16:31:12',1),(2,1,3,1,'2013-06-02 17:22:10',1),(3,1,4,1,'2013-06-02 17:22:14',1),(4,1,5,1,'2013-06-02 17:22:20',1);
/*!40000 ALTER TABLE `pl_modalidades` ENABLE KEYS */;
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
  `nombre_modulo` varchar(100) DEFAULT NULL,
  `objetivo_modulo` varchar(300) DEFAULT NULL,
  `id_contenido` int(11) DEFAULT NULL,
  `fecha_prevista` date DEFAULT NULL,
  `fecha_prevista_fin` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_modulos`
--

LOCK TABLES `pl_modulos` WRITE;
/*!40000 ALTER TABLE `pl_modulos` DISABLE KEYS */;
INSERT INTO `pl_modulos` VALUES (1,1,'modulo 122','dddddddd22',NULL,NULL,NULL,1,'2013-06-02 19:43:26',1);
/*!40000 ALTER TABLE `pl_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pl_plan`
--

DROP TABLE IF EXISTS `pl_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pl_plan` (
  `id_plan` int(11) NOT NULL,
  `pl_plan` varchar(45) DEFAULT NULL,
  `pl_fecha` datetime DEFAULT NULL,
  `pl_estado` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_plan`
--

LOCK TABLES `pl_plan` WRITE;
/*!40000 ALTER TABLE `pl_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pl_plan` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pl_planes`
--

LOCK TABLES `pl_planes` WRITE;
/*!40000 ALTER TABLE `pl_planes` DISABLE KEYS */;
INSERT INTO `pl_planes` VALUES (1,'Plan de capacitacion 2013','2013-06-02 14:14:59',1,2,1);
/*!40000 ALTER TABLE `pl_planes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_coop_suc`
--

LOCK TABLES `usu_coop_suc` WRITE;
/*!40000 ALTER TABLE `usu_coop_suc` DISABLE KEYS */;
INSERT INTO `usu_coop_suc` VALUES (2,6,9,0),(3,4,9,0),(5,10,6,0),(6,9,6,0);
/*!40000 ALTER TABLE `usu_coop_suc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_permisos`
--

DROP TABLE IF EXISTS `usu_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_permisos` (
  `id_permisos` int(11) NOT NULL AUTO_INCREMENT,
  `id_subrol` int(11) DEFAULT NULL,
  `id_opcion` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_permisos`),
  KEY `fk_usu_permisos_usu_subrol1` (`id_subrol`),
  KEY `fk_usu_permisos_conf_opcion1` (`id_opcion`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_permisos`
--

LOCK TABLES `usu_permisos` WRITE;
/*!40000 ALTER TABLE `usu_permisos` DISABLE KEYS */;
INSERT INTO `usu_permisos` VALUES (1,1,1,1),(2,1,2,1),(3,1,3,1),(4,1,4,1),(5,1,5,1),(6,1,6,1),(7,1,7,1),(8,1,8,1),(9,1,9,1),(10,1,10,1),(11,2,7,1),(12,2,8,1),(13,3,7,1),(14,3,8,1),(15,4,7,1),(16,4,8,1),(17,1,11,1),(18,1,12,1);
/*!40000 ALTER TABLE `usu_permisos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_permisos_menu`
--

LOCK TABLES `usu_permisos_menu` WRITE;
/*!40000 ALTER TABLE `usu_permisos_menu` DISABLE KEYS */;
INSERT INTO `usu_permisos_menu` VALUES (80,1,1),(81,1,2),(82,1,3),(83,1,4),(84,1,5),(85,1,6),(86,1,7),(87,1,8),(88,1,9),(89,1,10),(90,1,11),(91,1,12),(92,1,13),(93,1,14),(94,1,15),(95,1,16),(96,1,19),(97,1,27),(98,1,18),(99,1,20),(100,1,29),(101,1,28),(102,1,17),(103,1,21),(104,1,30),(105,1,31),(106,1,32),(107,1,33),(108,1,34),(109,1,37),(110,1,35),(111,1,36);
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
  `correo` varchar(30) DEFAULT NULL,
  `direccion` text,
  `ultimo_acceso` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_subrol` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  KEY `FK_usu_usuario` (`id_subrol`),
  CONSTRAINT `FK_usu_usuario` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_usuario`
--

LOCK TABLES `usu_usuario` WRITE;
/*!40000 ALTER TABLE `usu_usuario` DISABLE KEYS */;
INSERT INTO `usu_usuario` VALUES (1,'admin','202cb962ac59075b964b07152d234b70','Admin-2','12345','12345','','dkfjkdsjfk','2013-06-05 16:24:04',0,1,1),(2,'rolan','202cb962ac59075b964b07152d234b70','Rolando Medrano1','111111','11111',NULL,'9re98r9488dvkfckf',NULL,1,1,1),(3,'sdoradea','c20ad4d76fe97759aa27a0c99bff6710','Sergio','434','34324','',NULL,NULL,0,1,1),(4,'usu3','123','Usuario 3','','',NULL,NULL,NULL,1,2,1),(5,'eeee','202cb962ac59075b964b07152d234b70','Jorge Rodriguez','22222','22222222',NULL,NULL,NULL,1,1,1),(6,'a','','a','a','a',NULL,NULL,NULL,1,2,1),(7,'sarita','','Sara melgar','65656','5656','',NULL,NULL,1,1,1),(8,'renax','c81e728d9d4c2f636f067f89cc14862c','renato','23569652','','renax@mail.ocm',NULL,NULL,1,1,1),(9,'lolita','','lola','23658569','','loli@gmail.com',NULL,NULL,1,2,1),(10,'robson','ad61ab143223efbc24c7d2583be69251','Robert','65895698','','rob@mail.com',NULL,NULL,1,2,1);
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

-- Dump completed on 2013-06-05 16:29:30
