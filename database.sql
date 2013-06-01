/*
SQLyog Ultimate v9.02 
MySQL - 5.0.51b-community-nt-log : Database - asesores01
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
  PRIMARY KEY  (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `conf_cooperativa` */

insert  into `conf_cooperativa`(`id_cooperativa`,`cooperativa`,`ubicacion`,`telefono`,`fax`,`email`,`credito_fiscal`,`logotipo`,`activo`) values (6,'ACODJAR DE R.L.','Central','2333 7400','2333 7406','gerencia.acodjar@fedecaces.com',NULL,'logos/logo_acodjar.png',1),(9,'ACACCIBA','Central','2618 2427',NULL,'gerencia.acacciba@fedecaces.com',NULL,'logos/logo_acacciba.png',1),(10,'ACACEMIHA DE R.L.','Central','2272 6527',NULL,'acacemiha@fedecaces.com',NULL,'logos/logo_acacemiha.png',1),(19,'ACACES DE R.L.','daf','2288 2103','','info@acaces.com.sv','23',NULL,1);

/*Table structure for table `conf_menu` */

DROP TABLE IF EXISTS `conf_menu`;

CREATE TABLE `conf_menu` (
  `id_menu` int(11) NOT NULL auto_increment,
  `nombre_menu` varchar(200) default NULL,
  `id_padre` int(11) default '0',
  `url` varchar(150) default '#',
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `conf_menu` */

insert  into `conf_menu`(`id_menu`,`nombre_menu`,`id_padre`,`url`,`activo`) values (1,'Servicios',0,'',1),(2,'Capacitaciones',1,'',1),(3,'Curricula',2,'curriculas',1),(4,'Perfiles',2,'perfiles',1),(5,'Plan de Capacitaciones',2,'plan',1),(6,'Asesorias',1,'',1),(7,'Asesoria 1',6,'',1),(8,'Consultoria',1,'',1),(9,'Consultoria 1',8,'',1),(10,'Reportes',0,'',1),(11,'Dashboard',10,'',1),(12,'Pagos',10,'',1),(13,'Configuracion',0,'',1),(14,'Gestion Usuarios',13,'',1),(15,'Internos',14,'usuarios_internos',1),(16,'Externos',14,'usuarios_externos',1),(17,'Cooperativas',28,'cooperativas',1),(18,'Gestion Sistema',13,'',1),(19,'Roles',14,'roles',1),(20,'Menu',18,'conf_menu',1),(21,'Sucursales',28,'sucursales',1),(26,'roles',14,'roles',0),(27,'Permisos',14,'subroles',1),(28,'Gestion Clientes',13,'',1),(29,'Respaldo',18,'conf_sistema',1);

/*Table structure for table `conf_sucursal` */

DROP TABLE IF EXISTS `conf_sucursal`;

CREATE TABLE `conf_sucursal` (
  `id_sucursal` int(10) NOT NULL auto_increment,
  `id_cooperativa` int(10) NOT NULL,
  `sucursal` varchar(100) default NULL,
  PRIMARY KEY  (`id_sucursal`),
  KEY `fk_conf_sucursal_conf_cooperativa1` (`id_cooperativa`),
  CONSTRAINT `FK_conf_sucursal` FOREIGN KEY (`id_cooperativa`) REFERENCES `conf_cooperativa` (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `conf_sucursal` */

insert  into `conf_sucursal`(`id_sucursal`,`id_cooperativa`,`sucursal`) values (6,6,'San Vicente');

/*Table structure for table `cu_curricula` */

DROP TABLE IF EXISTS `cu_curricula`;

CREATE TABLE `cu_curricula` (
  `id_curricula` int(11) NOT NULL auto_increment,
  `curricula` varchar(100) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cu_curricula` */

insert  into `cu_curricula`(`id_curricula`,`curricula`,`estado`) values (2,'Curricula General',1),(5,'Curricula 2',1);

/*Table structure for table `cu_perfil` */

DROP TABLE IF EXISTS `cu_perfil`;

CREATE TABLE `cu_perfil` (
  `id_perfil` int(11) NOT NULL auto_increment,
  `id_curricula` int(11) default NULL,
  `perfil` varchar(100) default NULL,
  `aspectos_generales` text,
  `objetivos` text,
  `duracion` double(6,2) default NULL,
  `fecha` date default NULL,
  PRIMARY KEY  (`id_perfil`),
  KEY `fk_cu_perfil_cu_curricula1` (`id_curricula`),
  CONSTRAINT `FK_cu_perfil` FOREIGN KEY (`id_curricula`) REFERENCES `cu_curricula` (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil` */

insert  into `cu_perfil`(`id_perfil`,`id_curricula`,`perfil`,`aspectos_generales`,`objetivos`,`duracion`,`fecha`) values (1,2,'Cajero',NULL,NULL,NULL,'2013-01-29'),(4,2,'OFICIALES DE CREDITO',NULL,NULL,NULL,'0000-00-00');

/*Table structure for table `cu_perfil_contenido_aspectos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_aspectos`;

CREATE TABLE `cu_perfil_contenido_aspectos` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_aspectos` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_aspectos` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_aspectos` */

insert  into `cu_perfil_contenido_aspectos`(`id`,`nombre`,`id_perfil`) values (7,'Área de Formación: Filosofía Institucional y Servicios que presta la cooperativa',1),(8,'ASPECTO 1',4);

/*Table structure for table `cu_perfil_contenido_b_material_apoyo` */

DROP TABLE IF EXISTS `cu_perfil_contenido_b_material_apoyo`;

CREATE TABLE `cu_perfil_contenido_b_material_apoyo` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_b_material_apoyo` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_b_material_apoyo` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_b_material_apoyo` */

insert  into `cu_perfil_contenido_b_material_apoyo`(`id`,`nombre`,`id_perfil`) values (1,'Valores y principios cooperativos',1),(2,'Reglamento de la ley general de asociaciones cooperativas',1),(3,'Ley de intermediarios financieros no bancarios',1);

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
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_sugerencias_metodologicas` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_sugerencias_metodologicas` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_sugerencias_metodologicas` */

insert  into `cu_perfil_contenido_sugerencias_metodologicas`(`id`,`nombre`,`id_perfil`) values (1,'Actividades de Inducción:',1),(2,'Se sugiere la dinámica \"corazones\" para romper el hielo',1),(3,'Desarrollo de Contenido',1);

/*Table structure for table `cu_perfil_contenido_unidades_competencia` */

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_competencia`;

CREATE TABLE `cu_perfil_contenido_unidades_competencia` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_cu_perfil_contenido_unidades_competencia` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_unidades_competencia` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_unidades_competencia` */

insert  into `cu_perfil_contenido_unidades_competencia`(`id`,`nombre`,`id_perfil`) values (2,'Conoce la filosofía organizacional de la cooperativa',1),(3,'Domina información básica de los servicios que presta la cooperativa',1),(4,'Identifica las personas encargadas de brindar detalles sobre los servicios que proporciona la cooperativa a fin de orientar adecuadamente a los usuarios que consulten',1),(5,'Identificar las entidades clientes de la cooperativa de quienes se puede aceptar pago por parte de los usuarios',1),(6,'Dispone de información actualizada sobre las tasas de interés de la cooperativa',1);

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
  PRIMARY KEY  (`id_tabla_contenido`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cu_tablas_contenido` */

insert  into `cu_tablas_contenido`(`id_tabla_contenido`,`nombre_tabla`,`id_tabla`,`nombre_contenido`) values (1,'cu_perfil_contenido_aspectos','id_aspecto','Aspectos Generales'),(2,'cu_perfil_contenido_objetivos','id_objetivo','Objetivos'),(3,'cu_perfil_contenido_unidades_competencia',NULL,'Unidades de competencia'),(4,'cu_perfil_contenido_niveles_logro',NULL,'Niveles de logro'),(5,'cu_perfil_contenido_unidades_contenido',NULL,'Unidades de contenido'),(6,'cu_perfil_contenido_sugerencias_metodologicas',NULL,'Sugerencias metodologicas'),(7,'cu_perfil_contenido_recursos',NULL,'Recursos'),(8,'cu_perfil_contenido_b_material_apoyo',NULL,'Bibliografía y material de apoyo');

/*Table structure for table `usu_coop_suc` */

DROP TABLE IF EXISTS `usu_coop_suc`;

CREATE TABLE `usu_coop_suc` (
  `id_usu_coop` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) default NULL,
  `id_cooperativa` int(11) default NULL,
  `id_sucursal` int(11) default NULL,
  PRIMARY KEY  (`id_usu_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `usu_coop_suc` */

insert  into `usu_coop_suc`(`id_usu_coop`,`id_usuario`,`id_cooperativa`,`id_sucursal`) values (2,6,9,0),(3,4,9,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `usu_permisos_menu` */

insert  into `usu_permisos_menu`(`id_permiso`,`id_subrol`,`id_menu`) values (25,1,1),(26,1,2),(27,1,3),(28,1,4),(29,1,5),(30,1,6),(31,1,7),(32,1,8),(33,1,9),(34,1,10),(35,1,11),(36,1,12),(37,1,13),(38,1,14),(39,1,15),(40,1,16),(41,1,19),(42,1,27),(43,1,18),(44,1,20),(45,1,29),(46,1,28),(47,1,17),(48,1,21);

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
  `ultimo_acceso` datetime default NULL,
  `estado` int(11) default NULL,
  `id_subrol` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_usuario`),
  KEY `FK_usu_usuario` (`id_subrol`),
  CONSTRAINT `FK_usu_usuario` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `usu_usuario` */

insert  into `usu_usuario`(`id_usuario`,`usuario`,`clave`,`nombre_completo`,`telefono`,`celular`,`direccion`,`ultimo_acceso`,`estado`,`id_subrol`,`activo`) values (1,'admin','202cb962ac59075b964b07152d234b70','Admin-2','12345','12345','dkfjkdsjfk','2013-05-31 20:51:18',0,1,1),(2,'rolan','202cb962ac59075b964b07152d234b70','Rolando Medrano1','111111','11111','9re98r9488dvkfckf',NULL,1,1,1),(3,'sdoradea','1234','Sergio','434','34324',NULL,NULL,0,1,1),(4,'usu3','123','Usuario 3','','',NULL,NULL,1,2,1),(5,'eeee','202cb962ac59075b964b07152d234b70','Jorge Rodriguez','22222','22222222',NULL,NULL,1,1,1),(6,'a','','a','a','a',NULL,NULL,1,2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
