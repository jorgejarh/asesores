/*
SQLyog Ultimate v9.02 
MySQL - 5.0.51b-community-nt-log : Database - asesores
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`asesores` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `asesores`;

/*Table structure for table `abonos_cooperativas` */

DROP TABLE IF EXISTS `abonos_cooperativas`;

CREATE TABLE `abonos_cooperativas` (
  `id_abono` int(11) NOT NULL auto_increment,
  `id_cooperativa` int(11) NOT NULL,
  `id_capacitacion` int(11) NOT NULL,
  `abono` decimal(12,2) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `activo` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_abono`),
  KEY `id_cooperativa` (`id_cooperativa`),
  KEY `id_capacitacion` (`id_capacitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonos_cooperativas` */

/*Table structure for table `conf_cooperativa` */

DROP TABLE IF EXISTS `conf_cooperativa`;

CREATE TABLE `conf_cooperativa` (
  `id_cooperativa` int(10) NOT NULL auto_increment,
  `cooperativa` varchar(100) default NULL,
  `ubicacion` varchar(100) default NULL,
  `telefono` varchar(45) default NULL,
  `fax` varchar(45) default NULL,
  `email` varchar(45) default NULL,
  `credito_fiscal` varchar(45) default NULL,
  `logotipo` varchar(100) default NULL,
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `gerente` longtext,
  PRIMARY KEY  (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `conf_cooperativa` */

insert  into `conf_cooperativa`(`id_cooperativa`,`cooperativa`,`ubicacion`,`telefono`,`fax`,`email`,`credito_fiscal`,`logotipo`,`activo`,`id_usuario`,`f_creacion`,`gerente`) values (6,'ACODJAR DE R.L.','Central','2333 7400','2333 7406','gerencia.acodjar@fedecaces.com','236548','logos/logo_acodjar.png',1,NULL,NULL,NULL),(9,'ACACCIBA','Central','2618 2427','2333 7406','gerencia.acacciba@fedecaces.com','236549','logos/logo_acacciba.png',1,NULL,NULL,NULL),(10,'ACACEMIHA DE R.L.','Central','2272 6527','2333 7406','acacemiha@fedecaces.com','236550','logos/logo_acacemiha.png',1,NULL,NULL,NULL),(19,'ACACES DE R.L.','daf','2288 2103','2333 7406','info@acaces.com.sv','236551','logos/logo-cooperativo02.jpg',1,NULL,NULL,NULL);

/*Table structure for table `conf_menu` */

DROP TABLE IF EXISTS `conf_menu`;

CREATE TABLE `conf_menu` (
  `id_menu` int(11) NOT NULL auto_increment,
  `nombre_menu` varchar(200) default NULL,
  `id_padre` int(11) default '0',
  `url` varchar(150) default '#',
  `activo` int(11) default '1',
  `orden` int(11) default '1',
  `target` varchar(10) default NULL,
  PRIMARY KEY  (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `conf_menu` */

insert  into `conf_menu`(`id_menu`,`nombre_menu`,`id_padre`,`url`,`activo`,`orden`,`target`) values (1,'Servicios',0,'',1,NULL,NULL),(2,'Capacitaciones',1,'',1,NULL,NULL),(3,'Curricula',2,'curriculas',1,NULL,NULL),(4,'Perfiles',2,'perfiles',0,NULL,NULL),(5,'Plan de Capacitaciones',2,'pl_planes',1,NULL,NULL),(6,'Asesorias',1,'',1,NULL,NULL),(7,'Asesoria 1',6,'',1,NULL,NULL),(8,'Consultoria',1,'',1,NULL,NULL),(9,'Consultoria 1',8,'',1,NULL,NULL),(10,'Reportes',0,'',1,NULL,NULL),(11,'Ingresos por cooperativa',10,'re_planes',1,NULL,NULL),(12,'Pagos',10,'',1,NULL,NULL),(13,'Configuracion',0,'',1,NULL,NULL),(14,'Gestion Usuarios',13,'',1,NULL,NULL),(15,'Internos',14,'usuarios_internos',1,NULL,NULL),(16,'Externos',14,'usuarios_externos',1,NULL,NULL),(17,'Cooperativas',28,'cooperativas',1,NULL,NULL),(18,'Gestion Sistema',13,'',1,NULL,NULL),(19,'Roles',14,'roles',1,NULL,NULL),(20,'Menu',18,'conf_menu',1,NULL,NULL),(21,'Sucursales',28,'sucursales',1,NULL,NULL),(26,'roles',14,'roles',0,NULL,NULL),(27,'Permisos',14,'subroles',1,NULL,NULL),(28,'Gestion Clientes',13,'',1,NULL,NULL),(29,'Respaldo',18,'conf_sistema',1,NULL,NULL),(30,'Mantenimientos',0,'#',0,NULL,NULL),(31,'Gestion de Modalidades',38,'mante_modalidades',1,NULL,NULL),(32,'Estados de Planes',38,'mante_estados_plan',1,NULL,NULL),(33,'Gestion de facilitadores',38,'mante_facilitadores',1,NULL,NULL),(34,'Gestion de Lugares',38,'mante_lugares',1,NULL,NULL),(35,'Costos',37,'mante_costos',0,NULL,NULL),(36,'Sub Costos',37,'mante_subcostos',0,NULL,NULL),(37,'Gestion de Costos',30,'#',0,NULL,NULL),(38,'Mantenimientos',13,'',1,1,NULL),(39,'Mantenimientos',13,'',0,1,NULL),(40,'Sericios a Cooperativas',0,'',1,1,NULL),(41,'Inscripción en Linea',40,'inscripcion_temas',1,1,NULL),(42,'Mantenimiento de tipos facilitadores',38,'mante_tipos_facilitadores',0,1,NULL),(43,'Mantenimiento de Cargos',38,'mante_cargos',1,1,NULL),(44,'Mantenimiento de rubros',38,'mante_rubros',1,1,NULL),(45,'Ver temas disponibles',40,'temas_disponibles',1,1,'_blank'),(46,'Inscripcion',2,'inscripcion',1,1,NULL),(47,'Abonos por cooperativa',2,'abonos_cooperativas',1,1,NULL),(48,'Mantenimiento de Profesiones',38,'mante_profesiones',1,1,NULL),(49,'Mantenimiento de Especialidades ',38,'mante_especialidades',1,1,NULL);

/*Table structure for table `conf_sucursal` */

DROP TABLE IF EXISTS `conf_sucursal`;

CREATE TABLE `conf_sucursal` (
  `id_sucursal` int(10) NOT NULL auto_increment,
  `id_cooperativa` int(10) NOT NULL,
  `sucursal` varchar(100) default NULL,
  `telefono` varchar(15) default NULL,
  `fax` varchar(15) default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_sucursal`),
  KEY `fk_conf_sucursal_conf_cooperativa1` (`id_cooperativa`),
  CONSTRAINT `FK_conf_sucursal` FOREIGN KEY (`id_cooperativa`) REFERENCES `conf_cooperativa` (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `conf_sucursal` */

insert  into `conf_sucursal`(`id_sucursal`,`id_cooperativa`,`sucursal`,`telefono`,`fax`,`id_usuario`,`f_creacion`,`activo`) values (6,6,'San Vicente','25614589','23654913',1,'2013-06-05 21:59:23',1),(7,9,'San Salvador','23654269','23659613',1,'2013-06-05 21:59:23',1),(8,9,'Santa Ana','23698541','23651963',1,'2013-06-05 21:59:23',1),(9,6,'La Libertad','23695698','26395613',1,'2013-06-05 21:59:23',1),(10,6,'La Union','25647895','23691282',1,'2013-06-05 21:59:23',1),(11,6,'La Paz','25478956','25612569',1,'2013-06-05 21:59:23',1);

/*Table structure for table `cu_curricula` */

DROP TABLE IF EXISTS `cu_curricula`;

CREATE TABLE `cu_curricula` (
  `id_curricula` int(11) NOT NULL auto_increment,
  `curricula` varchar(100) default NULL,
  `objetivo` varchar(200) default NULL,
  `id_usuario` int(11) default NULL,
  `estado` tinyint(1) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `cu_curricula` */

insert  into `cu_curricula`(`id_curricula`,`curricula`,`objetivo`,`id_usuario`,`estado`,`f_creacion`,`activo`) values (2,'Curricula General','Objetivo Curricula General',1,1,'2013-06-05 21:20:36',1),(11,'Sistema de Formación Curricular del SCFF','',1,1,'2013-07-25 16:16:25',1);

/*Table structure for table `cu_perfil` */

DROP TABLE IF EXISTS `cu_perfil`;

CREATE TABLE `cu_perfil` (
  `id_perfil` int(11) NOT NULL auto_increment,
  `id_curricula` int(11) default NULL,
  `perfil` varchar(100) default NULL,
  `id_cargo` int(11) NOT NULL,
  `aspectos_generales` text,
  `objetivos` text,
  `duracion` double(6,2) default NULL,
  `fecha` date default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_perfil`),
  KEY `fk_cu_perfil_cu_curricula1` (`id_curricula`),
  CONSTRAINT `FK_cu_perfil` FOREIGN KEY (`id_curricula`) REFERENCES `cu_curricula` (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil` */

insert  into `cu_perfil`(`id_perfil`,`id_curricula`,`perfil`,`id_cargo`,`aspectos_generales`,`objetivos`,`duracion`,`fecha`,`id_usuario`,`f_creacion`,`activo`) values (1,2,'Cajero',1,NULL,NULL,NULL,'2013-01-29',1,'2013-06-05 21:33:28',1),(8,11,'DIRECTIVOS',2,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:24:50',1),(9,11,'GERENTES GENERALES',3,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:27:31',1),(10,11,'GERENTE DE RECURSOS HUMANOS',3,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:28:51',1),(11,11,'CONTADORES GENERALES',2,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:30:05',1),(12,11,'CAJEROS (AS)',1,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:30:59',1),(13,11,'ANALISTA DE CRÉDITOS',5,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:32:32',1),(14,11,'GESTOR DE COBROS',4,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:33:59',1),(15,11,'REFERENTE REMESAS Y RED ACTIVA',2,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:35:24',1),(16,11,'EJECUTIVO DE MERCADEO',4,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:50:32',1),(17,11,'REFERENTE TÉCNICO DE INFORMATICA',3,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:51:21',1),(18,11,'ASISTENTES - SECRETARIAS',4,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:52:27',1),(19,11,'AUXILIAR CONTABLE',5,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:53:30',1),(20,2,NULL,3,NULL,NULL,NULL,'2013-12-15',1,'2013-12-15 23:43:03',1);

/*Table structure for table `cu_perfil_contenido_aspectos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_aspectos`;

CREATE TABLE `cu_perfil_contenido_aspectos` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_aspectos` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_aspectos` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_aspectos` */

insert  into `cu_perfil_contenido_aspectos`(`id`,`nombre`,`id_perfil`) values (7,'Área de Formación: Filosofía Institucional y Servicios que presta la cooperativa',1);

/*Table structure for table `cu_perfil_contenido_b_material_apoyo` */

DROP TABLE IF EXISTS `cu_perfil_contenido_b_material_apoyo`;

CREATE TABLE `cu_perfil_contenido_b_material_apoyo` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  `archivos` longtext,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_b_material_apoyo` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_b_material_apoyo` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_b_material_apoyo` */

insert  into `cu_perfil_contenido_b_material_apoyo`(`id`,`nombre`,`id_perfil`,`archivos`) values (1,'Valores y principios cooperativos',1,'[\"\"]'),(2,'Reglamento de la ley general de asociaciones cooperativas',1,NULL),(3,'Ley de intermediarios financieros no bancarios',1,NULL);

/*Table structure for table `cu_perfil_contenido_niveles_logro` */

DROP TABLE IF EXISTS `cu_perfil_contenido_niveles_logro`;

CREATE TABLE `cu_perfil_contenido_niveles_logro` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_niveles_logro` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_niveles_logro` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_niveles_logro` */

insert  into `cu_perfil_contenido_niveles_logro`(`id`,`nombre`,`id_perfil`) values (1,'Menciona la visión y misión de la cooperativa y como su puesto de trabajo contribuye al logro de la misma',1),(2,'Enumera cuales son los servicios que presta la cooperativa',1),(3,'Declara el nombre de la persona de cada área de la cooperativa a quien puede referir a los usuarios',1),(4,'Enumera las entidades para quienes puede recibir pagos de parte de los usuarios',1),(5,'Se encuentra actualizado con la información sobre las variaciones que pueden sufrir las tasas de interés en la cooperativa',1);

/*Table structure for table `cu_perfil_contenido_objetivos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_objetivos`;

CREATE TABLE `cu_perfil_contenido_objetivos` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_objetivos` */

insert  into `cu_perfil_contenido_objetivos`(`id`,`nombre`,`id_perfil`) values (5,'Dar a conocer la filosofía institucional que rige la cooperativa con el propósito que el nuevo miembro adopte aptitudes y valores propios del cooperativismo',1),(6,'Transmitir los principios fundamentales para establecer un modo de vida cooperativista',1),(7,'Dar a conocer los servicios que brinda la cooperativa a fin de que el participante los identifique',1);

/*Table structure for table `cu_perfil_contenido_recursos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_recursos`;

CREATE TABLE `cu_perfil_contenido_recursos` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_recursos` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_recursos` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_recursos` */

insert  into `cu_perfil_contenido_recursos`(`id`,`nombre`,`id_perfil`) values (1,'Computadora',1),(2,'Laptop',1),(3,'Puntero',1),(4,'Papelográfo',1),(6,'Pizarra Acrílica',1),(7,'Plumones',1),(8,'Presentaciones',1),(9,'Fotografía o videos',1);

/*Table structure for table `cu_perfil_contenido_sugerencias_metodologicas` */

DROP TABLE IF EXISTS `cu_perfil_contenido_sugerencias_metodologicas`;

CREATE TABLE `cu_perfil_contenido_sugerencias_metodologicas` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  `archivos` longtext,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_sugerencias_metodologicas` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_sugerencias_metodologicas` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_sugerencias_metodologicas` */

insert  into `cu_perfil_contenido_sugerencias_metodologicas`(`id`,`nombre`,`id_perfil`,`archivos`) values (1,'Actividades de Inducción:',1,'[]'),(2,'Se sugiere la dinámica \"corazones\" para romper el hielo',1,NULL),(3,'Desarrollo de Contenido',1,NULL);

/*Table structure for table `cu_perfil_contenido_unidades_competencia` */

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_competencia`;

CREATE TABLE `cu_perfil_contenido_unidades_competencia` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_unidades_competencia` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_unidades_competencia` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_unidades_competencia` */

insert  into `cu_perfil_contenido_unidades_competencia`(`id`,`nombre`,`id_perfil`) values (2,'Conoce la filosofía organizacional de la cooperativa',1),(3,'Domina información básica de los servicios que presta la cooperativa',1),(4,'Identifica las personas encargadas de brindar detalles sobre los servicios que proporciona la cooperativa a fin de orientar adecuadamente a los usuarios que consulten',1),(5,'Identificar las entidades clientes de la cooperativa de quienes se puede aceptar pago por parte de los usuarios',1),(6,'Dispone de información actualizada sobre las tasas de interés de la cooperativa',1),(7,'Analísis Financiero',13);

/*Table structure for table `cu_perfil_contenido_unidades_contenido` */

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_contenido`;

CREATE TABLE `cu_perfil_contenido_unidades_contenido` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_unidades_contenido` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_unidades_contenido` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_unidades_contenido` */

insert  into `cu_perfil_contenido_unidades_contenido`(`id`,`nombre`,`id_perfil`) values (1,'Historia del cooperativismo en El Salvador',1),(2,'Identidad Cooperativa',1),(3,'Historia de la Federación',1),(4,'Filosofía Institucional',1),(5,'Servicios que presta la Cooperativa',1);

/*Table structure for table `cu_tablas_contenido` */

DROP TABLE IF EXISTS `cu_tablas_contenido`;

CREATE TABLE `cu_tablas_contenido` (
  `id_tabla_contenido` int(11) NOT NULL auto_increment,
  `nombre_tabla` varchar(100) default NULL,
  `id_tabla` varchar(100) default NULL,
  `nombre_contenido` varchar(100) default NULL,
  `archivos` int(11) default '0',
  PRIMARY KEY  (`id_tabla_contenido`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cu_tablas_contenido` */

insert  into `cu_tablas_contenido`(`id_tabla_contenido`,`nombre_tabla`,`id_tabla`,`nombre_contenido`,`archivos`) values (1,'cu_perfil_contenido_aspectos','id_aspecto','Aspectos Generales',0),(2,'cu_perfil_contenido_objetivos','id_objetivo','Objetivos',0),(3,'cu_perfil_contenido_unidades_competencia',NULL,'Unidades de competencia',0),(4,'cu_perfil_contenido_niveles_logro',NULL,'Niveles de logro',0),(5,'cu_perfil_contenido_unidades_contenido',NULL,'Unidades de contenido',0),(6,'cu_perfil_contenido_sugerencias_metodologicas',NULL,'Sugerencias metodologicas',1),(7,'cu_perfil_contenido_recursos',NULL,'Recursos',0),(8,'cu_perfil_contenido_b_material_apoyo',NULL,'Bibliografía y material de apoyo',1);

/*Table structure for table `inscripcion_asistencia` */

DROP TABLE IF EXISTS `inscripcion_asistencia`;

CREATE TABLE `inscripcion_asistencia` (
  `id_asistencia` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) NOT NULL,
  `id_inscripcion_personas` int(11) NOT NULL,
  `nota` decimal(4,2) default '0.00',
  `asistio` int(11) default '0',
  `aprobado` int(11) NOT NULL default '0',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario` int(11) default NULL,
  PRIMARY KEY  (`id_asistencia`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_asistencia` */

insert  into `inscripcion_asistencia`(`id_asistencia`,`id_modulo`,`id_inscripcion_personas`,`nota`,`asistio`,`aprobado`,`fecha_creacion`,`id_usuario`) values (9,7,1,'7.00',0,0,'2013-11-10 22:23:08',1),(10,7,2,'8.00',1,1,'2013-11-10 22:23:08',1),(11,7,3,'8.50',1,1,'2013-11-10 22:23:08',1),(12,7,4,'9.00',0,1,'2013-11-10 22:23:08',1);

/*Table structure for table `inscripcion_temas` */

DROP TABLE IF EXISTS `inscripcion_temas`;

CREATE TABLE `inscripcion_temas` (
  `id_inscripcion_tema` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) default NULL,
  `id_capacitacion` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  `id_cooperativa` int(11) default NULL,
  PRIMARY KEY  (`id_inscripcion_tema`),
  KEY `FK_inscripcion_temas` (`id_capacitacion`),
  CONSTRAINT `FK_inscripcion_temas` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_temas` */

insert  into `inscripcion_temas`(`id_inscripcion_tema`,`id_usuario`,`id_capacitacion`,`f_creacion`,`activo`,`id_cooperativa`) values (3,4,4,'2013-07-23 11:42:40',1,9),(5,7,4,'2013-11-07 21:42:06',1,9);

/*Table structure for table `inscripcion_temas_personas` */

DROP TABLE IF EXISTS `inscripcion_temas_personas`;

CREATE TABLE `inscripcion_temas_personas` (
  `id_inscripcion_personas` int(11) NOT NULL auto_increment,
  `id_inscripcion_tema` int(11) NOT NULL,
  `dui` varchar(20) default NULL,
  `apellidos` varchar(20) default NULL,
  `nombres` varchar(20) default NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `aprobado` int(11) default '0',
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_inscripcion_personas`),
  KEY `FK_inscripcion_temas_personas` (`id_inscripcion_tema`),
  CONSTRAINT `FK_inscripcion_temas_personas` FOREIGN KEY (`id_inscripcion_tema`) REFERENCES `inscripcion_temas` (`id_inscripcion_tema`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_temas_personas` */

insert  into `inscripcion_temas_personas`(`id_inscripcion_personas`,`id_inscripcion_tema`,`dui`,`apellidos`,`nombres`,`id_sucursal`,`id_cargo`,`aprobado`,`id_usuario`,`f_creacion`,`activo`) values (1,5,'58745896-1','Rodriguez','carlos',8,2,0,7,'2013-11-07 22:13:40',1),(2,5,'65651651-6','Rodriguez Hernandez','Jorge Antonio',8,4,0,7,'2013-11-10 20:23:13',1),(3,5,'16165198-1','Amaya','Rolando',8,5,0,7,'2013-11-10 20:23:39',1),(4,5,'52065695-1','Perez','Jorge',7,1,0,7,'2013-11-10 20:23:53',1);

/*Table structure for table `mante_cargos` */

DROP TABLE IF EXISTS `mante_cargos`;

CREATE TABLE `mante_cargos` (
  `id_cargo` int(11) NOT NULL auto_increment,
  `nombre_cargo` varchar(100) default NULL,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_cargo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mante_cargos` */

insert  into `mante_cargos`(`id_cargo`,`nombre_cargo`,`f_creacion`,`id_usuario`,`activo`) values (1,'Cajero','2013-06-28 20:34:20',1,1),(2,'Gerente','2013-06-28 20:34:41',1,1),(3,'Secretaria','2013-06-28 20:34:53',1,1),(4,'Gestor de creditos','2013-06-28 20:35:04',1,1),(5,'Otros','2013-06-28 20:35:13',1,1);

/*Table structure for table `mante_costos` */

DROP TABLE IF EXISTS `mante_costos`;

CREATE TABLE `mante_costos` (
  `id_costo` int(11) NOT NULL auto_increment,
  `nombre_costo` varchar(100) default NULL,
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_costo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mante_costos` */

insert  into `mante_costos`(`id_costo`,`nombre_costo`,`activo`,`id_usuario`,`f_creacion`) values (1,'Costo 12',0,NULL,NULL),(2,'costo 3',1,NULL,NULL),(3,'costos 2',1,NULL,NULL),(4,'costo 4',1,NULL,NULL);

/*Table structure for table `mante_especialidades` */

DROP TABLE IF EXISTS `mante_especialidades`;

CREATE TABLE `mante_especialidades` (
  `id_especialidad` int(11) NOT NULL auto_increment,
  `nombre_especialidad` longtext NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mante_especialidades` */

insert  into `mante_especialidades`(`id_especialidad`,`nombre_especialidad`,`id_usuario`,`f_creacion`,`activo`) values (1,'Especialidad 1',1,'2013-12-16 21:46:18',1),(2,'Especialidad 2',1,'2013-12-16 22:34:43',1);

/*Table structure for table `mante_especialidades_x_facilitador` */

DROP TABLE IF EXISTS `mante_especialidades_x_facilitador`;

CREATE TABLE `mante_especialidades_x_facilitador` (
  `id_especialidad_x_facilitador` int(11) NOT NULL auto_increment,
  `id_especialidad` int(11) NOT NULL,
  `id_facilitador` int(11) NOT NULL,
  PRIMARY KEY  (`id_especialidad_x_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `mante_especialidades_x_facilitador` */

insert  into `mante_especialidades_x_facilitador`(`id_especialidad_x_facilitador`,`id_especialidad`,`id_facilitador`) values (7,2,2),(8,1,2);

/*Table structure for table `mante_estados_planes` */

DROP TABLE IF EXISTS `mante_estados_planes`;

CREATE TABLE `mante_estados_planes` (
  `id_estado_plan` int(11) NOT NULL auto_increment,
  `nombre_estado` varchar(100) default NULL,
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_estado_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mante_estados_planes` */

insert  into `mante_estados_planes`(`id_estado_plan`,`nombre_estado`,`activo`,`id_usuario`,`f_creacion`) values (2,'Abierto',1,1,'2013-06-02 13:54:33'),(3,'Cerrado',1,1,'2013-06-02 13:54:33');

/*Table structure for table `mante_facilitadores` */

DROP TABLE IF EXISTS `mante_facilitadores`;

CREATE TABLE `mante_facilitadores` (
  `id_facilitador` int(11) NOT NULL auto_increment,
  `nombres` varchar(50) default NULL,
  `apellidos` varchar(50) default NULL,
  `telefono` varchar(20) default NULL,
  `t_oficina` varchar(20) default NULL,
  `celular` varchar(20) default NULL,
  `correo` varchar(15) default NULL,
  `acreditado` int(11) default '0',
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mante_facilitadores` */

insert  into `mante_facilitadores`(`id_facilitador`,`nombres`,`apellidos`,`telefono`,`t_oficina`,`celular`,`correo`,`acreditado`,`activo`,`id_usuario`,`f_creacion`) values (1,'Jorge Antonio','Rodriguez','123456','123456','132465','jarh@jarh.com',0,1,1,'2013-06-11 10:00:00'),(2,'Carlos','Hernandez','123456789','123456789','123456789','jarh@jar.com',1,1,1,'2013-06-11 23:45:54');

/*Table structure for table `mante_lugares` */

DROP TABLE IF EXISTS `mante_lugares`;

CREATE TABLE `mante_lugares` (
  `id_lugar` int(11) NOT NULL auto_increment,
  `nombre_lugar` varchar(100) default NULL,
  `telefono` varchar(50) default NULL,
  `ubicacion` varchar(100) default NULL,
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mante_lugares` */

insert  into `mante_lugares`(`id_lugar`,`nombre_lugar`,`telefono`,`ubicacion`,`activo`,`id_usuario`,`f_creacion`) values (2,'Lugar Nº1','123456','San Salvador',1,1,'2013-06-16 16:37:59'),(3,'Lugar 2','321654','Soyapango',1,1,'2013-06-16 16:39:00');

/*Table structure for table `mante_modalidades` */

DROP TABLE IF EXISTS `mante_modalidades`;

CREATE TABLE `mante_modalidades` (
  `id_modalidad` int(11) NOT NULL auto_increment,
  `nombre_modalidad` varchar(100) default NULL,
  `objetivo` varchar(300) default NULL,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mante_modalidades` */

insert  into `mante_modalidades`(`id_modalidad`,`nombre_modalidad`,`objetivo`,`f_creacion`,`id_usuario`,`activo`) values (1,'Modalidad 11','Objetivos Objetivos 1','2013-06-01 20:40:16',1,0),(2,'Diplomados','Diplomados, Diplomados','2013-06-01 20:54:52',1,1),(3,'Seminarios y Foros','Seminarios y Foros, Seminarios y Foros','2013-06-02 17:05:20',1,1),(4,'Talleres','Talleres, Talleres','2013-06-02 17:05:41',1,1),(5,'Congresos','Congresos, Congresos','2013-06-02 17:05:55',1,1);

/*Table structure for table `mante_modalidades_docs` */

DROP TABLE IF EXISTS `mante_modalidades_docs`;

CREATE TABLE `mante_modalidades_docs` (
  `id_doc` int(11) NOT NULL auto_increment,
  `id_modalidad` int(11) NOT NULL,
  `nombre_doc` varchar(100) NOT NULL,
  `archivo` longtext,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mante_modalidades_docs` */

insert  into `mante_modalidades_docs`(`id_doc`,`id_modalidad`,`nombre_doc`,`archivo`,`f_creacion`,`id_usuario`,`activo`) values (2,5,'Archivo 1','kkkkkkkkkkkkkkkkk.txt','2013-12-22 15:00:16',1,1),(3,5,'ffffffffff','654.txt','2013-12-22 15:09:42',1,1);

/*Table structure for table `mante_profesion_x_facilitador` */

DROP TABLE IF EXISTS `mante_profesion_x_facilitador`;

CREATE TABLE `mante_profesion_x_facilitador` (
  `id_profesion_x_facilitador` int(11) NOT NULL auto_increment,
  `id_facilitador` int(11) NOT NULL,
  `id_profesion` int(11) NOT NULL,
  PRIMARY KEY  (`id_profesion_x_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `mante_profesion_x_facilitador` */

insert  into `mante_profesion_x_facilitador`(`id_profesion_x_facilitador`,`id_facilitador`,`id_profesion`) values (10,2,1);

/*Table structure for table `mante_profesiones` */

DROP TABLE IF EXISTS `mante_profesiones`;

CREATE TABLE `mante_profesiones` (
  `id_profesion` int(11) NOT NULL auto_increment,
  `nombre_profesion` longtext NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_profesion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mante_profesiones` */

insert  into `mante_profesiones`(`id_profesion`,`nombre_profesion`,`id_usuario`,`f_creacion`,`activo`) values (1,'Profesion 1',1,'2013-12-16 21:32:41',1),(2,'Profesiones 2',1,'2013-12-16 22:08:40',1);

/*Table structure for table `mante_rubros` */

DROP TABLE IF EXISTS `mante_rubros`;

CREATE TABLE `mante_rubros` (
  `id_rubro` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mante_rubros` */

insert  into `mante_rubros`(`id_rubro`,`nombre`,`id_usuario`,`f_creacion`,`activo`) values (2,'Alimentos',1,'2013-06-19 20:53:32',1),(3,'Materiales',1,'2013-06-19 20:53:47',1);

/*Table structure for table `mante_subcostos` */

DROP TABLE IF EXISTS `mante_subcostos`;

CREATE TABLE `mante_subcostos` (
  `id_subcosto` int(11) NOT NULL auto_increment,
  `id_costo` int(11) default NULL,
  `nombre_subcosto` varchar(100) default NULL,
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_subcosto`),
  KEY `FK_mante_subcostos` (`id_costo`),
  CONSTRAINT `FK_mante_subcostos` FOREIGN KEY (`id_costo`) REFERENCES `mante_costos` (`id_costo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mante_subcostos` */

insert  into `mante_subcostos`(`id_subcosto`,`id_costo`,`nombre_subcosto`,`activo`,`id_usuario`,`f_creacion`) values (1,3,'sub costo 1',1,NULL,NULL);

/*Table structure for table `mante_tipos_facilitadores` */

DROP TABLE IF EXISTS `mante_tipos_facilitadores`;

CREATE TABLE `mante_tipos_facilitadores` (
  `id_tipo_facilitador` int(11) NOT NULL auto_increment,
  `nombre_tipo_facilitador` varchar(50) default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_tipo_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mante_tipos_facilitadores` */

insert  into `mante_tipos_facilitadores`(`id_tipo_facilitador`,`nombre_tipo_facilitador`,`id_usuario`,`f_creacion`,`activo`) values (1,'Facilitador 1',1,'2013-06-28 20:28:15',1);

/*Table structure for table `pl_capacitaciones` */

DROP TABLE IF EXISTS `pl_capacitaciones`;

CREATE TABLE `pl_capacitaciones` (
  `id_capacitacion` int(11) NOT NULL auto_increment,
  `id_plan_modalidad` int(11) default NULL,
  `nombre_capacitacion` varchar(100) default NULL,
  `objetivo` varchar(300) default NULL,
  `cerrado` int(11) default '0',
  `n_participantes` int(11) default '1',
  `n_participantes_no` int(11) default '1',
  `n_participantes_ex` int(11) default '1',
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_capacitacion`),
  KEY `FK_pl_capacitaciones` (`id_plan_modalidad`),
  CONSTRAINT `FK_pl_capacitaciones` FOREIGN KEY (`id_plan_modalidad`) REFERENCES `pl_modalidades` (`id_plan_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `pl_capacitaciones` */

insert  into `pl_capacitaciones`(`id_capacitacion`,`id_plan_modalidad`,`nombre_capacitacion`,`objetivo`,`cerrado`,`n_participantes`,`n_participantes_no`,`n_participantes_ex`,`f_creacion`,`id_usuario`,`activo`) values (1,4,'V congreso de mujeres','Gestion Crediticia EfectivaGestion Crediticia EfectivaGestion Crediticia Efectiva',0,20,1,1,'2013-06-02 18:19:52',1,1),(2,3,'Gestion estrategica de agencias','Gestion estrategica de agencias',0,30,3,3,'2013-06-13 22:33:23',1,1),(3,3,'Valuos - casos practicos de campo','Tema 2 Tema 2 Tema 2',1,20,1,1,'2013-06-19 21:11:27',1,1),(4,1,'Gestion de recuperacion exitosa','Capacitacion 1',0,20,1,1,'2013-07-01 21:18:19',1,1),(5,2,'Presentacion de codigo de buenas Practicas','Seminario 1',0,30,1,1,'2013-07-01 21:19:11',1,1),(6,5,'Capacitacion 1','Capacitacion 1',0,20,1,1,'2013-07-26 19:39:07',1,1);

/*Table structure for table `pl_modalidades` */

DROP TABLE IF EXISTS `pl_modalidades`;

CREATE TABLE `pl_modalidades` (
  `id_plan_modalidad` int(11) NOT NULL auto_increment,
  `id_plan` int(11) default NULL,
  `id_modalidad` int(11) default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_plan_modalidad`),
  KEY `FK_pl_modalidades` (`id_plan`),
  KEY `FK_pl_modalidades2` (`id_modalidad`),
  CONSTRAINT `FK_pl_modalidades` FOREIGN KEY (`id_plan`) REFERENCES `pl_planes` (`id_plan`),
  CONSTRAINT `FK_pl_modalidades2` FOREIGN KEY (`id_modalidad`) REFERENCES `mante_modalidades` (`id_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modalidades` */

insert  into `pl_modalidades`(`id_plan_modalidad`,`id_plan`,`id_modalidad`,`id_usuario`,`f_creacion`,`activo`) values (1,1,2,1,'2013-06-02 16:31:12',1),(2,1,3,1,'2013-06-02 17:22:10',1),(3,1,4,1,'2013-06-02 17:22:14',1),(4,1,5,1,'2013-06-02 17:22:20',1),(5,2,2,1,'2013-07-26 19:35:31',1);

/*Table structure for table `pl_modulo_facilitador` */

DROP TABLE IF EXISTS `pl_modulo_facilitador`;

CREATE TABLE `pl_modulo_facilitador` (
  `id_modulo_facilitador` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) default NULL,
  `id_facilitador` int(11) default NULL,
  PRIMARY KEY  (`id_modulo_facilitador`),
  KEY `FK_pl_modulo_facilitador` (`id_facilitador`),
  KEY `FK_pl_modulo_facilitador_2` (`id_modulo`),
  CONSTRAINT `FK_pl_modulo_facilitador` FOREIGN KEY (`id_facilitador`) REFERENCES `mante_facilitadores` (`id_facilitador`),
  CONSTRAINT `FK_pl_modulo_facilitador_2` FOREIGN KEY (`id_modulo`) REFERENCES `pl_modulos` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulo_facilitador` */

insert  into `pl_modulo_facilitador`(`id_modulo_facilitador`,`id_modulo`,`id_facilitador`) values (7,1,2),(8,2,1),(9,2,2),(22,9,2),(23,7,1),(24,7,2),(25,8,2),(26,5,2),(27,6,1);

/*Table structure for table `pl_modulos` */

DROP TABLE IF EXISTS `pl_modulos`;

CREATE TABLE `pl_modulos` (
  `id_modulo` int(11) NOT NULL auto_increment,
  `id_capacitacion` int(11) default NULL,
  `id_lugar` int(11) default NULL,
  `nombre_modulo` varchar(100) default NULL,
  `precio_venta` decimal(12,2) default '0.00',
  `objetivo_modulo` varchar(300) default NULL,
  `id_contenido` int(11) default '0',
  `fecha_prevista` date default NULL,
  `fecha_prevista_fin` date default NULL,
  `contenido` varchar(200) default NULL,
  `temas` longtext,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_modulo`),
  KEY `FK_pl_modulos` (`id_capacitacion`),
  KEY `FK_pl_modulos_2` (`id_lugar`),
  CONSTRAINT `FK_pl_modulos` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`),
  CONSTRAINT `FK_pl_modulos_2` FOREIGN KEY (`id_lugar`) REFERENCES `mante_lugares` (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos` */

insert  into `pl_modulos`(`id_modulo`,`id_capacitacion`,`id_lugar`,`nombre_modulo`,`precio_venta`,`objetivo_modulo`,`id_contenido`,`fecha_prevista`,`fecha_prevista_fin`,`contenido`,`temas`,`id_usuario`,`f_creacion`,`activo`) values (1,2,2,'Gestion mercadologica de las agencias','10.00','Gestion mercadologica de las agencias',0,'2013-06-16','2013-06-16','Área de Formación: Filosofía Institucional y Servicios que presta la cooperativa','[]',1,'2013-06-13 22:34:18',1),(2,2,2,'Gestioin mercadologica de las agencias','20.00','Gestioin mercadologica de las agencias',0,'2013-06-16','2013-06-16','Contenido 1\r\n','[]',1,'2013-06-13 22:35:05',0),(3,2,3,'Base normativa para la apertura de agencias','40.00','Base normativa para la apertura de agencias',0,'2013-07-10','2013-07-10','contenido 2','[]',1,'2013-06-13 22:35:50',1),(4,2,3,'NUevo modulo','10.00','NUevo modulo',0,'2013-06-16','2013-06-16','aaaaaaaaaaa','[]',1,'2013-06-16 15:58:55',0),(5,3,3,'Casos de estudio en terreno','20.00','Modulo 1 Modulo 1 ',0,'2013-07-26','2013-07-26','hola','[]',1,'2013-06-19 21:11:56',1),(6,1,2,'V congreso de mujeres','30.00','Modulo 1',0,'2013-07-26','2013-07-26','Modulo 1','[]',1,'2013-07-01 21:13:20',1),(7,4,3,'Modulo 1. Aspectos legales y normativos relacionados a la mora y a la cobranza','10.00','modulo 1',0,'2013-07-26','2013-07-26','modulo 1','[]',1,'2013-07-01 21:18:36',1),(8,5,2,'Presentacion de codigo de buenas Practicas','40.00','Modulo 1',0,'2013-07-26','2013-07-26','Modulo 1','[]',1,'2013-07-01 21:19:24',1),(9,6,2,'Modulo 1','10.00','Modulo 1',0,'2013-07-19','2013-07-19','Contenido','[]',1,'2013-07-26 19:40:23',1);

/*Table structure for table `pl_planes` */

DROP TABLE IF EXISTS `pl_planes`;

CREATE TABLE `pl_planes` (
  `id_plan` int(11) NOT NULL auto_increment,
  `nombre_plan` varchar(100) default NULL,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `id_estado_plan` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_plan`),
  KEY `FK_pl_planes` (`id_estado_plan`),
  CONSTRAINT `FK_pl_planes` FOREIGN KEY (`id_estado_plan`) REFERENCES `mante_estados_planes` (`id_estado_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pl_planes` */

insert  into `pl_planes`(`id_plan`,`nombre_plan`,`f_creacion`,`id_usuario`,`id_estado_plan`,`activo`) values (1,'Plan de capacitacion 2013','2013-06-02 14:14:59',1,2,1),(2,'Plan de capacitacion 2012','2013-06-19 21:26:23',1,2,1);

/*Table structure for table `pl_rubro` */

DROP TABLE IF EXISTS `pl_rubro`;

CREATE TABLE `pl_rubro` (
  `id_rubro` int(11) NOT NULL auto_increment,
  `id_rubro_name` int(11) default NULL,
  `id_modulo` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_rubro`),
  KEY `FK_pl_rubro` (`id_modulo`),
  KEY `FK_pl_rubro2` (`id_rubro_name`),
  CONSTRAINT `FK_pl_rubro` FOREIGN KEY (`id_modulo`) REFERENCES `pl_modulos` (`id_modulo`),
  CONSTRAINT `FK_pl_rubro2` FOREIGN KEY (`id_rubro_name`) REFERENCES `mante_rubros` (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `pl_rubro` */

insert  into `pl_rubro`(`id_rubro`,`id_rubro_name`,`id_modulo`,`f_creacion`,`id_usuario`,`activo`) values (1,2,3,'2013-06-13 23:11:01',1,1),(2,3,3,'2013-06-13 23:12:09',1,1),(3,2,5,'2013-06-19 21:12:06',1,1),(4,3,3,'2013-06-19 22:16:39',1,1),(5,2,6,'2013-07-01 21:13:28',1,1),(6,3,7,'2013-07-01 21:18:42',1,1),(7,2,8,'2013-07-01 21:19:29',1,1),(8,2,9,'2013-07-26 19:40:35',1,1),(9,2,2,'2013-07-26 19:43:42',1,1),(10,3,2,'2013-07-26 19:44:09',1,1),(11,3,1,'2013-07-26 19:44:26',1,1),(12,3,4,'2013-07-26 19:44:48',1,1);

/*Table structure for table `pl_subrubro` */

DROP TABLE IF EXISTS `pl_subrubro`;

CREATE TABLE `pl_subrubro` (
  `id_subrubro` int(11) NOT NULL auto_increment,
  `id_rubro` int(11) default NULL,
  `nombre` varchar(200) default NULL,
  `unidades` int(11) default '0',
  `costo` decimal(12,2) default '0.00',
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_subrubro`),
  KEY `FK_pl_subrubro` (`id_rubro`),
  CONSTRAINT `FK_pl_subrubro` FOREIGN KEY (`id_rubro`) REFERENCES `pl_rubro` (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `pl_subrubro` */

insert  into `pl_subrubro`(`id_subrubro`,`id_rubro`,`nombre`,`unidades`,`costo`,`f_creacion`,`id_usuario`,`activo`) values (1,1,'Desayuno',20,'3.00','2013-06-13 23:11:26',1,1),(2,1,'Refrigerio',20,'2.00','2013-06-13 23:11:51',1,1),(3,2,'Folder',20,'0.50','2013-06-13 23:12:28',1,1),(4,2,'Lapiceros',20,'0.10','2013-06-13 23:12:44',1,1),(5,2,'Libreta',20,'5.00','2013-06-13 23:13:02',1,1),(6,3,'Almuerzo',10,'2.00','2013-06-19 21:12:22',1,1),(7,5,'Refrigerio',20,'2.00','2013-07-01 21:13:47',1,1),(8,6,'Cuadernos',20,'3.00','2013-07-01 21:18:52',1,1),(9,7,'Almuerzos',30,'2.00','2013-07-01 21:19:41',1,1),(10,8,'Desayuno',20,'1.00','2013-07-26 19:40:52',1,1),(11,8,'Refrijerio',20,'1.00','2013-07-26 19:41:12',1,1),(12,9,'Almuerzo',30,'2.00','2013-07-26 19:43:55',1,1),(13,10,'Folleto',30,'1.00','2013-07-26 19:44:18',1,1),(14,11,'Lapiceros',30,'0.50','2013-07-26 19:44:39',1,1),(15,12,'Folder',30,'0.50','2013-07-26 19:44:59',1,1),(16,12,'Cuadernos',30,'1.00','2013-07-26 19:45:07',1,1);

/*Table structure for table `sitio_slider` */

DROP TABLE IF EXISTS `sitio_slider`;

CREATE TABLE `sitio_slider` (
  `id_slider` int(11) NOT NULL auto_increment,
  `nombre_imagen` varchar(200) default NULL,
  `texto_aparecer` varchar(200) default NULL,
  `nombre_archivo` varchar(200) default NULL,
  PRIMARY KEY  (`id_slider`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `sitio_slider` */

insert  into `sitio_slider`(`id_slider`,`nombre_imagen`,`texto_aparecer`,`nombre_archivo`) values (1,'Imagen 1','Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto ','slider_1.jpg'),(2,'Imagen 2','Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto ','slider_2.png'),(3,'Imagen 3','Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto ','slider_3.gif'),(4,'Imagen 4','Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto Imagen, Texto ','slider_4.jpg');

/*Table structure for table `usu_coop_suc` */

DROP TABLE IF EXISTS `usu_coop_suc`;

CREATE TABLE `usu_coop_suc` (
  `id_usu_coop` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) default NULL,
  `id_cooperativa` int(11) default NULL,
  `id_sucursal` int(11) default NULL,
  PRIMARY KEY  (`id_usu_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `usu_coop_suc` */

insert  into `usu_coop_suc`(`id_usu_coop`,`id_usuario`,`id_cooperativa`,`id_sucursal`) values (6,7,9,0),(7,7,9,0),(9,4,6,0),(10,6,9,0);

/*Table structure for table `usu_permisos_menu` */

DROP TABLE IF EXISTS `usu_permisos_menu`;

CREATE TABLE `usu_permisos_menu` (
  `id_permiso` int(11) NOT NULL auto_increment,
  `id_subrol` int(11) default NULL,
  `id_menu` int(11) default NULL,
  PRIMARY KEY  (`id_permiso`),
  KEY `FK_usu_permisos_menu` (`id_menu`),
  KEY `FK_usu_permisos_menu2` (`id_subrol`),
  CONSTRAINT `FK_usu_permisos_menu` FOREIGN KEY (`id_menu`) REFERENCES `conf_menu` (`id_menu`),
  CONSTRAINT `FK_usu_permisos_menu2` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=latin1;

/*Data for the table `usu_permisos_menu` */

insert  into `usu_permisos_menu`(`id_permiso`,`id_subrol`,`id_menu`) values (229,2,40),(230,2,41),(231,2,45),(232,3,40),(233,3,41),(234,3,45),(303,1,1),(304,1,2),(305,1,3),(306,1,5),(307,1,46),(308,1,47),(309,1,6),(310,1,7),(311,1,8),(312,1,9),(313,1,10),(314,1,11),(315,1,12),(316,1,13),(317,1,14),(318,1,15),(319,1,16),(320,1,19),(321,1,27),(322,1,18),(323,1,20),(324,1,29),(325,1,28),(326,1,17),(327,1,21),(328,1,38),(329,1,31),(330,1,32),(331,1,33),(332,1,34),(333,1,43),(334,1,44),(335,1,48),(336,1,49),(337,1,40),(338,1,41),(339,1,45);

/*Table structure for table `usu_rol` */

DROP TABLE IF EXISTS `usu_rol`;

CREATE TABLE `usu_rol` (
  `id_rol` int(11) NOT NULL auto_increment,
  `id_tipo_usuario` int(11) default '0',
  `rol` varchar(25) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_rol`),
  KEY `FK_usu_rol` (`id_tipo_usuario`),
  CONSTRAINT `FK_usu_rol` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `usu_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `usu_rol` */

insert  into `usu_rol`(`id_rol`,`id_tipo_usuario`,`rol`,`estado`) values (1,1,'Administrador del Sistema',1),(2,2,'Cliente',1),(3,1,'Consultor y/o Asesor',1),(4,1,'Administrador Curricula',1),(5,1,'Administrador del Plan',1);

/*Table structure for table `usu_subrol` */

DROP TABLE IF EXISTS `usu_subrol`;

CREATE TABLE `usu_subrol` (
  `id_subrol` int(11) NOT NULL auto_increment,
  `id_rol` int(11) default NULL,
  `subrol` varchar(25) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_subrol`),
  KEY `FK_usu_subrol` (`id_rol`),
  CONSTRAINT `FK_usu_subrol` FOREIGN KEY (`id_rol`) REFERENCES `usu_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `usu_subrol` */

insert  into `usu_subrol`(`id_subrol`,`id_rol`,`subrol`,`estado`) values (1,1,'Administrador',1),(2,2,'Cooperativa',1),(3,2,'Sucursal',1);

/*Table structure for table `usu_tipo_usuario` */

DROP TABLE IF EXISTS `usu_tipo_usuario`;

CREATE TABLE `usu_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL auto_increment,
  `nombre_tipo_usuario` varchar(200) default NULL,
  PRIMARY KEY  (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usu_tipo_usuario` */

insert  into `usu_tipo_usuario`(`id_tipo_usuario`,`nombre_tipo_usuario`) values (1,'Usuario Interno'),(2,'Usuario Externo');

/*Table structure for table `usu_usuario` */

DROP TABLE IF EXISTS `usu_usuario`;

CREATE TABLE `usu_usuario` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `usuario` varchar(50) default NULL,
  `clave` varchar(50) default NULL,
  `nombre_completo` varchar(200) default NULL,
  `telefono` varchar(20) default NULL,
  `celular` varchar(20) default NULL,
  `direccion` text,
  `correo` varchar(50) default NULL,
  `ultimo_acceso` datetime default NULL,
  `estado` int(11) default NULL,
  `id_subrol` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_usuario`),
  KEY `FK_usu_usuario` (`id_subrol`),
  CONSTRAINT `FK_usu_usuario` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `usu_usuario` */

insert  into `usu_usuario`(`id_usuario`,`usuario`,`clave`,`nombre_completo`,`telefono`,`celular`,`direccion`,`correo`,`ultimo_acceso`,`estado`,`id_subrol`,`activo`) values (1,'admin','202cb962ac59075b964b07152d234b70','Administrador 1','12345','12345','dkfjkdsjfk','','2013-12-22 13:46:07',1,1,1),(2,'rolan','202cb962ac59075b964b07152d234b70','Rolando Medrano1','111111','11111','9re98r9488dvkfckf',NULL,NULL,1,1,1),(3,'sdoradea','1234','Sergio','434','34324',NULL,NULL,NULL,0,1,1),(4,'sergio','e10adc3949ba59abbe56e057f20f883e','Sergio','22222222','',NULL,'','2013-07-23 11:42:19',1,2,1),(5,'eeee','202cb962ac59075b964b07152d234b70','Jorge Rodriguez','22222','22222222',NULL,NULL,NULL,1,1,1),(6,'usuario1','e10adc3949ba59abbe56e057f20f883e','Carlos Rivera','23659848','75698459',NULL,'','2013-11-06 17:42:32',1,2,1),(7,'jarh','e10adc3949ba59abbe56e057f20f883e','Jorge Rodriguez','123456','123456',NULL,'jarh@jarh.com','2013-12-21 23:15:00',1,2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
