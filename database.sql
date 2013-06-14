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
  PRIMARY KEY  (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `conf_cooperativa` */

insert  into `conf_cooperativa`(`id_cooperativa`,`cooperativa`,`ubicacion`,`telefono`,`fax`,`email`,`credito_fiscal`,`logotipo`,`activo`,`id_usuario`,`f_creacion`) values (6,'ACODJAR DE R.L.','Central','2333 7400','2333 7406','gerencia.acodjar@fedecaces.com',NULL,'logos/logo_acodjar.png',1,NULL,NULL),(9,'ACACCIBA','Central','2618 2427',NULL,'gerencia.acacciba@fedecaces.com',NULL,'logos/logo_acacciba.png',1,NULL,NULL),(10,'ACACEMIHA DE R.L.','Central','2272 6527',NULL,'acacemiha@fedecaces.com',NULL,'logos/logo_acacemiha.png',1,NULL,NULL),(19,'ACACES DE R.L.','daf','2288 2103','','info@acaces.com.sv','23',NULL,1,NULL,NULL);

/*Table structure for table `conf_menu` */

DROP TABLE IF EXISTS `conf_menu`;

CREATE TABLE `conf_menu` (
  `id_menu` int(11) NOT NULL auto_increment,
  `nombre_menu` varchar(200) default NULL,
  `id_padre` int(11) default '0',
  `url` varchar(150) default '#',
  `activo` int(11) default '1',
  `orden` int(11) default '1',
  PRIMARY KEY  (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `conf_menu` */

insert  into `conf_menu`(`id_menu`,`nombre_menu`,`id_padre`,`url`,`activo`,`orden`) values (1,'Servicios',0,'',1,NULL),(2,'Capacitaciones',1,'',1,NULL),(3,'Curricula',2,'curriculas',1,NULL),(4,'Perfiles',2,'perfiles',0,NULL),(5,'Plan de Capacitaciones',2,'pl_planes',1,NULL),(6,'Asesorias',1,'',1,NULL),(7,'Asesoria 1',6,'',1,NULL),(8,'Consultoria',1,'',1,NULL),(9,'Consultoria 1',8,'',1,NULL),(10,'Reportes',0,'',1,NULL),(11,'Dashboard',10,'',1,NULL),(12,'Pagos',10,'',1,NULL),(13,'Configuracion',0,'',1,NULL),(14,'Gestion Usuarios',13,'',1,NULL),(15,'Internos',14,'usuarios_internos',1,NULL),(16,'Externos',14,'usuarios_externos',1,NULL),(17,'Cooperativas',28,'cooperativas',1,NULL),(18,'Gestion Sistema',13,'',1,NULL),(19,'Roles',14,'roles',1,NULL),(20,'Menu',18,'conf_menu',1,NULL),(21,'Sucursales',28,'sucursales',1,NULL),(26,'roles',14,'roles',0,NULL),(27,'Permisos',14,'subroles',1,NULL),(28,'Gestion Clientes',13,'',1,NULL),(29,'Respaldo',18,'conf_sistema',1,NULL),(30,'Mantenimientos',0,'#',0,NULL),(31,'Gestion de Modalidades',38,'mante_modalidades',1,NULL),(32,'Estados de Planes',38,'mante_estados_plan',1,NULL),(33,'Gestion de facilitadores',38,'mante_facilitadores',1,NULL),(34,'Gestion de Lugares',38,'mante_lugares',1,NULL),(35,'Costos',37,'mante_costos',0,NULL),(36,'Sub Costos',37,'mante_subcostos',0,NULL),(37,'Gestion de Costos',30,'#',0,NULL),(38,'Mantenimientos',13,'',1,1),(39,'Mantenimientos',13,'',0,1);

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

insert  into `conf_sucursal`(`id_sucursal`,`id_cooperativa`,`sucursal`,`telefono`,`fax`,`id_usuario`,`f_creacion`,`activo`) values (6,6,'San Vicente',NULL,NULL,1,'2013-06-05 21:59:23',1),(7,9,'sucursal 1',NULL,NULL,1,'2013-06-05 21:59:23',1),(8,9,'ddd','22222','333',1,'2013-06-05 21:59:23',1),(9,6,'suu 20',NULL,NULL,1,'2013-06-05 21:59:23',1),(10,6,'suu 20',NULL,NULL,1,'2013-06-05 21:59:23',1),(11,6,'sucursal 10',NULL,NULL,1,'2013-06-05 21:59:23',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `cu_curricula` */

insert  into `cu_curricula`(`id_curricula`,`curricula`,`objetivo`,`id_usuario`,`estado`,`f_creacion`,`activo`) values (2,'Curricula General',NULL,1,1,NULL,1),(5,'Curricula 2',NULL,1,1,NULL,0),(6,'curricula 3','objetivo curricula',1,1,'2013-06-05 00:00:00',0),(7,'curricula 4','objetivo curricula 4',1,1,'2013-06-05 21:20:36',0),(8,'curricula 4','objetivo curricula 4',1,1,'2013-06-05 21:20:36',0),(9,'55','asdasd',1,1,'2013-06-05 21:20:56',0),(10,'hola','hhhhhhhhhh',1,1,'2013-06-05 21:27:03',0);

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
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_perfil`),
  KEY `fk_cu_perfil_cu_curricula1` (`id_curricula`),
  CONSTRAINT `FK_cu_perfil` FOREIGN KEY (`id_curricula`) REFERENCES `cu_curricula` (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil` */

insert  into `cu_perfil`(`id_perfil`,`id_curricula`,`perfil`,`aspectos_generales`,`objetivos`,`duracion`,`fecha`,`id_usuario`,`f_creacion`,`activo`) values (1,2,'Cajero',NULL,NULL,NULL,'2013-01-29',NULL,NULL,1),(4,2,'OFICIALES DE CREDITO',NULL,NULL,NULL,'0000-00-00',NULL,NULL,1),(5,5,'Perfil 1',NULL,NULL,NULL,'2013-06-05',NULL,NULL,1),(6,2,'Otro perfil',NULL,NULL,NULL,'2013-06-05',1,'2013-06-05 21:33:28',1),(7,2,'perfil 50',NULL,NULL,NULL,'2013-06-05',1,'2013-06-05 21:38:59',1);

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

insert  into `mante_estados_planes`(`id_estado_plan`,`nombre_estado`,`activo`,`id_usuario`,`f_creacion`) values (1,'estado 11',1,NULL,NULL),(2,'estado2',1,NULL,NULL),(3,'estado 5',1,1,'2013-06-02 13:54:33');

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
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mante_facilitadores` */

insert  into `mante_facilitadores`(`id_facilitador`,`nombres`,`apellidos`,`telefono`,`t_oficina`,`celular`,`correo`,`activo`,`id_usuario`,`f_creacion`) values (1,'Jorge Antonio','Rodriguez','123456','123456','132465','jarh@jarh.com',1,NULL,NULL),(2,'Carlos','Hernandez','123456789','123456789','123456789','jarh@jar.com',1,1,'2013-06-11 23:45:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mante_lugares` */

insert  into `mante_lugares`(`id_lugar`,`nombre_lugar`,`telefono`,`ubicacion`,`activo`,`id_usuario`,`f_creacion`) values (1,'Lugar 1','123456','111111111122',0,NULL,NULL);

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

insert  into `mante_modalidades`(`id_modalidad`,`nombre_modalidad`,`objetivo`,`f_creacion`,`id_usuario`,`activo`) values (2,'Diplomados','Diplomados, Diplomados','2013-06-01 20:54:52',1,1),(3,'Seminarios y Foros','Seminarios y Foros, Seminarios y Foros','2013-06-02 17:05:20',1,1),(4,'Talleres','Talleres, Talleres','2013-06-02 17:05:41',1,1),(5,'Congresos','Congresos, Congresos','2013-06-02 17:05:55',1,1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mante_tipos_facilitadores` */

/*Table structure for table `pl_capacitaciones` */

DROP TABLE IF EXISTS `pl_capacitaciones`;

CREATE TABLE `pl_capacitaciones` (
  `id_capacitacion` int(11) NOT NULL auto_increment,
  `id_plan_modalidad` int(11) default NULL,
  `nombre_capacitacion` varchar(100) default NULL,
  `objetivo` varchar(300) default NULL,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_capacitacion`),
  KEY `FK_pl_capacitaciones` (`id_plan_modalidad`),
  CONSTRAINT `FK_pl_capacitaciones` FOREIGN KEY (`id_plan_modalidad`) REFERENCES `pl_modalidades` (`id_plan_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pl_capacitaciones` */

insert  into `pl_capacitaciones`(`id_capacitacion`,`id_plan_modalidad`,`nombre_capacitacion`,`objetivo`,`f_creacion`,`id_usuario`,`activo`) values (1,4,'Gestion Crediticia Efectiva','Gestion Crediticia EfectivaGestion Crediticia EfectivaGestion Crediticia Efectiva','2013-06-02 18:19:52',1,1),(2,3,'Gestion estrategica de agencias','Gestion estrategica de agencias','2013-06-13 22:33:23',1,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modalidades` */

insert  into `pl_modalidades`(`id_plan_modalidad`,`id_plan`,`id_modalidad`,`id_usuario`,`f_creacion`,`activo`) values (1,1,2,1,'2013-06-02 16:31:12',1),(2,1,3,1,'2013-06-02 17:22:10',1),(3,1,4,1,'2013-06-02 17:22:14',1),(4,1,5,1,'2013-06-02 17:22:20',1);

/*Table structure for table `pl_modulos` */

DROP TABLE IF EXISTS `pl_modulos`;

CREATE TABLE `pl_modulos` (
  `id_modulo` int(11) NOT NULL auto_increment,
  `id_capacitacion` int(11) default NULL,
  `nombre_modulo` varchar(100) default NULL,
  `objetivo_modulo` varchar(300) default NULL,
  `id_contenido` int(11) default '0',
  `fecha_prevista` date default NULL,
  `fecha_prevista_fin` date default NULL,
  `contenido` varchar(200) default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos` */

insert  into `pl_modulos`(`id_modulo`,`id_capacitacion`,`nombre_modulo`,`objetivo_modulo`,`id_contenido`,`fecha_prevista`,`fecha_prevista_fin`,`contenido`,`id_usuario`,`f_creacion`,`activo`) values (1,2,'Gestion mercadologica de las agencias','Gestion mercadologica de las agencias',0,'2013-06-20','2013-06-20','Área de Formación: Filosofía Institucional y Servicios que presta la cooperativa',1,'2013-06-13 22:34:18',1),(2,2,'Gestioin mercadologica de las agencias','Gestioin mercadologica de las agencias',0,'2013-06-21','2013-06-21','Contenido 1\r\n',1,'2013-06-13 22:35:05',1),(3,2,'Base normativa para la apertura de agencias','Base normativa para la apertura de agencias',0,'2013-06-26','2013-06-26','contenido 2',1,'2013-06-13 22:35:50',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pl_planes` */

insert  into `pl_planes`(`id_plan`,`nombre_plan`,`f_creacion`,`id_usuario`,`id_estado_plan`,`activo`) values (1,'Plan de capacitacion 2013','2013-06-02 14:14:59',1,2,1);

/*Table structure for table `pl_rubro` */

DROP TABLE IF EXISTS `pl_rubro`;

CREATE TABLE `pl_rubro` (
  `id_rubro` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) default NULL,
  `nombre` varchar(200) default NULL,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_rubro`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pl_rubro` */

insert  into `pl_rubro`(`id_rubro`,`id_modulo`,`nombre`,`f_creacion`,`id_usuario`,`activo`) values (1,3,'Alimentacion','2013-06-13 23:11:01',1,1),(2,3,'Materiales','2013-06-13 23:12:09',1,1);

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
  PRIMARY KEY  (`id_subrubro`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pl_subrubro` */

insert  into `pl_subrubro`(`id_subrubro`,`id_rubro`,`nombre`,`unidades`,`costo`,`f_creacion`,`id_usuario`,`activo`) values (1,1,'Desayuno',20,'3.00','2013-06-13 23:11:26',1,1),(2,1,'Refrigerio',20,'2.00','2013-06-13 23:11:51',1,1),(3,2,'Folder',20,'0.50','2013-06-13 23:12:28',1,1),(4,2,'Lapiceros',20,'0.10','2013-06-13 23:12:44',1,1),(5,2,'Libreta',20,'5.00','2013-06-13 23:13:02',1,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1;

/*Data for the table `usu_permisos_menu` */

insert  into `usu_permisos_menu`(`id_permiso`,`id_subrol`,`id_menu`) values (168,1,1),(169,1,2),(170,1,3),(171,1,5),(172,1,6),(173,1,7),(174,1,8),(175,1,9),(176,1,10),(177,1,11),(178,1,12),(179,1,13),(180,1,14),(181,1,15),(182,1,16),(183,1,19),(184,1,27),(185,1,18),(186,1,20),(187,1,29),(188,1,28),(189,1,17),(190,1,21),(191,1,38),(192,1,31),(193,1,32),(194,1,33),(195,1,34);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `usu_usuario` */

insert  into `usu_usuario`(`id_usuario`,`usuario`,`clave`,`nombre_completo`,`telefono`,`celular`,`direccion`,`correo`,`ultimo_acceso`,`estado`,`id_subrol`,`activo`) values (1,'admin','202cb962ac59075b964b07152d234b70','Admin-2','12345','12345','dkfjkdsjfk',NULL,'2013-06-13 19:57:22',0,1,1),(2,'rolan','202cb962ac59075b964b07152d234b70','Rolando Medrano1','111111','11111','9re98r9488dvkfckf',NULL,NULL,1,1,1),(3,'sdoradea','1234','Sergio','434','34324',NULL,NULL,NULL,0,1,1),(4,'usu3','123','Usuario 3','','',NULL,NULL,NULL,1,2,1),(5,'eeee','202cb962ac59075b964b07152d234b70','Jorge Rodriguez','22222','22222222',NULL,NULL,NULL,1,1,1),(6,'a','','a','a','a',NULL,NULL,NULL,1,2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
