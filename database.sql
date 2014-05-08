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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `abonos_cooperativas` */

insert  into `abonos_cooperativas`(`id_abono`,`id_cooperativa`,`id_capacitacion`,`abono`,`f_creacion`,`id_usuario`,`activo`) values (1,9,7,'30.00','2014-03-31 15:11:18',1,1);

/*Table structure for table `asesoria_bitacora` */

DROP TABLE IF EXISTS `asesoria_bitacora`;

CREATE TABLE `asesoria_bitacora` (
  `id_bitacora` int(11) NOT NULL auto_increment,
  `id_actividad` int(11) NOT NULL,
  `observaciones` longtext,
  `fecha_inicio` date default NULL,
  `fecha_fin` date default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_bitacora`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_bitacora` */

insert  into `asesoria_bitacora`(`id_bitacora`,`id_actividad`,`observaciones`,`fecha_inicio`,`fecha_fin`,`id_usuario`,`f_creacion`,`activo`) values (1,1,'observacion 1','2014-03-03','2014-03-29',1,'2014-03-23 17:40:57',1),(2,1,'ffff','2014-03-14','2014-03-15',1,'2014-03-23 17:41:13',1),(3,4,'Realice trabajo de investigación y levantamiento de datos','2014-03-24','2014-03-31',1,'2014-03-31 15:08:12',1),(4,6,'- Se necesita trabajar en areas de promoción de productos','2014-04-03','2014-03-03',10,'2014-03-31 16:24:36',1),(5,6,'- No estaban listos los estados de resultados','2014-04-02','2014-04-02',10,'2014-03-31 16:26:31',1);

/*Table structure for table `asesoria_proyectos` */

DROP TABLE IF EXISTS `asesoria_proyectos`;

CREATE TABLE `asesoria_proyectos` (
  `id_proyecto` int(11) NOT NULL auto_increment,
  `id_servicio` int(11) NOT NULL,
  `fecha_inicio` date default NULL,
  `fecha_fin` date default NULL,
  `nombre_proyecto` longtext,
  `cantidad_tiempo_estimado` int(11) default NULL,
  `nombre_tiempo_estimado` varchar(200) default NULL,
  `inversion` decimal(18,2) default NULL,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_proyectos` */

insert  into `asesoria_proyectos`(`id_proyecto`,`id_servicio`,`fecha_inicio`,`fecha_fin`,`nombre_proyecto`,`cantidad_tiempo_estimado`,`nombre_tiempo_estimado`,`inversion`,`f_creacion`,`id_usuario`,`activo`) values (1,1,'2014-03-18','2014-03-28','Proyecto 1',10,'days',NULL,'2014-03-18 21:34:21',1,1),(2,1,'2014-03-22','2014-09-22','Proyecto 2',6,'months',NULL,'2014-03-18 22:27:35',1,1),(3,2,'2014-04-01','2015-04-01','Asesoría en administración y finanzas',1,'years','4200.00','2014-03-31 16:11:25',10,1);

/*Table structure for table `asesoria_proyectos_actividades` */

DROP TABLE IF EXISTS `asesoria_proyectos_actividades`;

CREATE TABLE `asesoria_proyectos_actividades` (
  `id_actividad` int(11) NOT NULL auto_increment,
  `id_proyecto` int(11) NOT NULL,
  `nombre_actividad` longtext,
  `fecha_inicio` date default NULL,
  `fecha_fin` date default NULL,
  `resultado_esperado` longtext,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_proyectos_actividades` */

insert  into `asesoria_proyectos_actividades`(`id_actividad`,`id_proyecto`,`nombre_actividad`,`fecha_inicio`,`fecha_fin`,`resultado_esperado`,`id_usuario`,`f_creacion`,`activo`) values (1,1,'Actividad 1','2014-03-26','1969-12-31','Terminar la Inspeccion',1,'2014-03-18 23:55:51',1),(2,1,'actividad 2','2014-03-27','1969-12-31','Otra actividad',1,'2014-03-18 23:56:48',1),(3,1,'actividad 3','2014-03-27','2014-03-31','Otra',1,'2014-03-18 23:59:33',1),(4,2,'Actividad 5','2014-03-24','2014-03-27','dddd',1,'2014-03-19 00:03:28',1),(5,2,'Actividad X','2014-03-31','2014-04-02','- Informe\r\n- Liquidación de gastos',1,'2014-03-31 15:07:08',1),(6,3,'Entrevista con el gerente','2014-04-02','2014-04-02','- Informe de planificación del proyecto.',10,'2014-03-31 16:14:57',1),(7,3,'Reforzar area de ventas','2014-05-05','2014-05-30','- Informe de refuerzo',10,'2014-03-31 16:19:14',1),(8,3,'Refuerzo area de mercadeo','2014-06-02','2014-07-31','- Informe de area de mercadeo\r\n',10,'2014-03-31 16:19:53',1);

/*Table structure for table `asesoria_recomendaciones` */

DROP TABLE IF EXISTS `asesoria_recomendaciones`;

CREATE TABLE `asesoria_recomendaciones` (
  `id_recomendacion` int(11) NOT NULL auto_increment,
  `id_actividad` int(11) NOT NULL,
  `fecha_recomendacion` date default NULL,
  `nombre_recomendacion` longtext,
  `descripcion_recomendacion` longtext,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_recomendacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_recomendaciones` */

insert  into `asesoria_recomendaciones`(`id_recomendacion`,`id_actividad`,`fecha_recomendacion`,`nombre_recomendacion`,`descripcion_recomendacion`,`id_usuario`,`f_creacion`,`activo`) values (1,1,'2014-03-27','Recomendacion 1','Observaciones..\r\n',1,'2014-03-23 19:26:42',1),(2,7,'2014-05-02','Enfocar servicio a más areas de atencion de la cooperativa','El area de ventas no tiene personal adecuado o capacitado en al area de productos',10,'2014-03-31 16:28:33',1);

/*Table structure for table `asesoria_servicios` */

DROP TABLE IF EXISTS `asesoria_servicios`;

CREATE TABLE `asesoria_servicios` (
  `id_servicio` int(11) NOT NULL auto_increment,
  `id_tipo_solicitante` int(11) NOT NULL,
  `id_cooperativa` int(11) default '0',
  `nombre_solicitante` longtext,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_servicios` */

insert  into `asesoria_servicios`(`id_servicio`,`id_tipo_solicitante`,`id_cooperativa`,`nombre_solicitante`,`f_creacion`,`id_usuario`,`activo`) values (1,1,9,'ACACCIBA','2014-03-16 17:22:21',1,1),(2,1,20,'ACODEZO DE R.L.','2014-03-31 16:07:48',10,1);

/*Table structure for table `asesoria_tecnicos_x_proyecto` */

DROP TABLE IF EXISTS `asesoria_tecnicos_x_proyecto`;

CREATE TABLE `asesoria_tecnicos_x_proyecto` (
  `id_tecnico_asignado` int(11) NOT NULL auto_increment,
  `id_proyecto` int(11) NOT NULL,
  `id_facilitador` int(11) NOT NULL,
  PRIMARY KEY  (`id_tecnico_asignado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_tecnicos_x_proyecto` */

insert  into `asesoria_tecnicos_x_proyecto`(`id_tecnico_asignado`,`id_proyecto`,`id_facilitador`) values (3,1,2),(4,2,2),(5,3,3),(7,2,3);

/*Table structure for table `asesoria_tipos_solicitantes` */

DROP TABLE IF EXISTS `asesoria_tipos_solicitantes`;

CREATE TABLE `asesoria_tipos_solicitantes` (
  `id_tipo_solicitante` int(11) NOT NULL auto_increment,
  `tipo_solicitante` longtext NOT NULL,
  PRIMARY KEY  (`id_tipo_solicitante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_tipos_solicitantes` */

insert  into `asesoria_tipos_solicitantes`(`id_tipo_solicitante`,`tipo_solicitante`) values (1,'Afiliado'),(2,'No afiliado');

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `conf_cooperativa` */

insert  into `conf_cooperativa`(`id_cooperativa`,`cooperativa`,`ubicacion`,`telefono`,`fax`,`email`,`credito_fiscal`,`logotipo`,`activo`,`id_usuario`,`f_creacion`,`gerente`) values (1,'ACACYPAC NC de R.L.','Ninguna','','','gerencia.acacypac@fedecaces.com','123456','logos/ACACYPAC.JPG',1,NULL,NULL,'Carlos Tobar'),(6,'ACODJAR DE R.L.','Central','2333 7400','2333 7406','gerencia.acodjar@fedecaces.com','236548','logos/logo_acodjar.png',1,NULL,NULL,''),(9,'ACACCIBA','Central','2618 2427','2333 7406','gerencia.acacciba@fedecaces.com','236549','logos/logo_acacciba.png',1,NULL,NULL,NULL),(10,'ACACEMIHA DE R.L.','Central','2272 6527','2333 7406','acacemiha@fedecaces.com','236550','logos/logo_acacemiha.png',1,NULL,NULL,'Licda. Ana Elvia Lara de Martínez'),(19,'ACACES DE R.L.','daf','2288 2103','2333 7406','info@acaces.com.sv','236551','logos/logo-cooperativo02.jpg',1,NULL,NULL,NULL),(20,'ACODEZO DE R.L.','San Miguel','26693314','','gerencia.acodezo@fedecaces.com','12','logos/utec-logo.png',1,NULL,NULL,'Ronald Beltrán'),(21,'ACAYCCOMAC DE R.L.','','','','','12345',NULL,1,NULL,NULL,'Gloria Paz'),(22,'ACOPACC DE R.L.','','','','','123',NULL,1,NULL,NULL,'Ena Maldonado'),(23,'ACAPRODUSCA DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(24,'ACACU DE R.L.','','','','','123',NULL,1,NULL,NULL,'Rafael Espinal'),(25,'ACACESPRO DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(26,'ACACRECOSC DE R.L.','','','','','1234',NULL,1,NULL,NULL,''),(27,'ACOPUS DE R.L.','','','','','123',NULL,1,NULL,NULL,'Lcda. de Alfaro'),(28,'COSTISSS DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(29,'COANDES DE R.L.','','','','','123',NULL,1,NULL,NULL,'Ing. Julio Portillo'),(30,'ACACEMIHA DE R.L.','','','','','123',NULL,0,NULL,NULL,'Licda. Ana Elvia de Martínez'),(31,'ACECENTA DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(32,'ACOPACTO DE R.L.','','','','','123',NULL,1,NULL,NULL,'Ing. Gallegos'),(33,'CODEZA DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sra. Clelia Sánchez'),(34,'ELECTRA DE R.L.','','','','','123',NULL,1,NULL,NULL,'Licda. Linda Funes'),(35,'ACEISPROMEIN DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(36,'EL AMATE DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(37,'ACACESPSA DE R.L.','','','','','1234',NULL,1,NULL,NULL,'Lic. Aldo Valenzuela'),(38,'ACACSEMERSA DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sr. Ricardo Vanegas'),(39,'SIHUACOOP DE R.L.','','','','','123',NULL,1,NULL,NULL,'Licda. de Martínez'),(40,'ACACI DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sra. Cecilia '),(41,'ACACME DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sr. Ricardo Morales'),(42,'ACOCOMET DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sr. Miguel Clemente'),(43,'ACACEAGRO DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(44,'ACACEPOM DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(45,'ACACMA DE R.L.','','','','','123',NULL,1,NULL,NULL,'');

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Data for the table `conf_menu` */

insert  into `conf_menu`(`id_menu`,`nombre_menu`,`id_padre`,`url`,`activo`,`orden`,`target`) values (1,'Servicios',0,'',1,0,NULL),(2,'Capacitaciones',1,'',1,0,NULL),(3,'Curricula',2,'curriculas',1,0,NULL),(4,'Perfiles',2,'perfiles',0,0,NULL),(5,'Plan de Capacitaciones',2,'pl_planes',1,0,NULL),(6,'Asesorias',1,'',1,0,NULL),(7,'Servicios',6,'ase_servicios',1,0,NULL),(8,'Consultoria',1,'',1,0,NULL),(9,'Consultoria 1',8,'',1,0,NULL),(10,'Reportes',0,'',1,0,NULL),(11,'Ingresos por cooperativa',10,'re_planes',1,0,NULL),(12,'Pagos',10,'',1,0,NULL),(13,'Configuracion',0,'',1,0,NULL),(14,'Usuarios',13,'',1,0,NULL),(15,'Internos',14,'usuarios_internos',1,0,NULL),(16,'Externos',14,'usuarios_externos',1,0,NULL),(17,'Cooperativas',28,'cooperativas',1,0,NULL),(18,'Gestion Sistema',13,'',0,0,NULL),(19,'Roles',14,'roles',1,0,NULL),(20,'Menu',53,'conf_menu',1,0,NULL),(21,'Sucursales',28,'sucursales',1,0,NULL),(26,'roles',14,'roles',0,0,NULL),(27,'Permisos',14,'subroles',1,0,NULL),(28,'Clientes',13,'',1,0,NULL),(29,'Respaldo',53,'conf_sistema',1,0,NULL),(30,'Mantenimientos',0,'#',0,0,NULL),(31,'Modalidades',38,'mante_modalidades',1,1,NULL),(32,'Estados de Planes',38,'mante_estados_plan',0,10,NULL),(33,'Facilitadores',38,'mante_facilitadores',1,6,NULL),(34,'Lugares',38,'mante_lugares',1,2,NULL),(35,'Costos',37,'mante_costos',0,0,NULL),(36,'Sub Costos',37,'mante_subcostos',0,0,NULL),(37,'Gestion de Costos',30,'#',0,0,NULL),(38,'Mantenimientos',13,'',1,1,NULL),(39,'Mantenimientos',13,'',0,1,NULL),(40,'Servicios a Clientes',0,'',1,1,NULL),(41,'Inscripción en Linea',40,'inscripcion_temas',1,1,NULL),(42,'Mantenimiento de tipos facilitadores',38,'mante_tipos_facilitadores',0,0,NULL),(43,'Cargos',38,'mante_cargos',1,7,NULL),(44,'Rubros',38,'mante_rubros',1,8,NULL),(45,'Ver temas disponibles',40,'temas_disponibles',1,1,'_blank'),(46,'Inscripcion',2,'inscripcion',1,1,NULL),(47,'Abonos por cooperativa',2,'abonos_cooperativas',1,1,NULL),(48,'Profesiones',38,'mante_profesiones',1,4,NULL),(49,'Especialidades ',38,'mante_especialidades',1,5,NULL),(50,'Evaluar Modulo',2,'evaluar_modulo',0,1,NULL),(51,'Tipos de Evaluacion',38,'mante_tipos_evaluacion',1,3,NULL),(52,'Resultados de evaluacion',38,'mante_resultados',1,9,NULL),(53,'Programador',0,'',1,1,NULL),(54,'Facilitador',0,'',1,1,NULL),(55,'Listado',54,'f_listado',1,1,NULL),(56,'Subir Notas',54,'evaluar_modulo',1,1,NULL),(57,'Registro de Personal',40,'mante_personal',1,1,NULL),(58,'Cobros',0,'',1,1,NULL),(59,'Nota de Cargo',58,'nota_cargo',1,1,NULL),(60,'Estado de cuenta',58,'estado_cuenta',1,1,NULL),(61,'Opinión de Participantes',2,'mod_opinion',1,1,NULL),(62,'Evaluación del Modulo',2,'cal_modulo',1,1,NULL),(63,'Descuentos',58,'descuentos',1,1,NULL),(64,'Bitácoras por Actividad',6,'ase_bitacoras',1,1,NULL),(65,'Registro de Personal',38,'mante_personal',1,1,NULL),(66,'Notas Cargo 2',58,'notas_cargo',1,1,NULL);

/*Table structure for table `conf_sucursal` */

DROP TABLE IF EXISTS `conf_sucursal`;

CREATE TABLE `conf_sucursal` (
  `id_sucursal` int(10) NOT NULL auto_increment,
  `id_cooperativa` int(10) NOT NULL,
  `sucursal` varchar(100) default NULL,
  `gerente` longtext,
  `telefono` varchar(15) default NULL,
  `fax` varchar(15) default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_sucursal`),
  KEY `fk_conf_sucursal_conf_cooperativa1` (`id_cooperativa`),
  CONSTRAINT `FK_conf_sucursal` FOREIGN KEY (`id_cooperativa`) REFERENCES `conf_cooperativa` (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `conf_sucursal` */

insert  into `conf_sucursal`(`id_sucursal`,`id_cooperativa`,`sucursal`,`gerente`,`telefono`,`fax`,`id_usuario`,`f_creacion`,`activo`) values (6,6,'San Vicente',NULL,'25614589','23654913',1,'2013-06-05 21:59:23',1),(7,9,'San Salvador',NULL,'23654269','23659613',1,'2013-06-05 21:59:23',1),(8,9,'Santa Ana',NULL,'23698541','23651963',1,'2013-06-05 21:59:23',1),(9,6,'La Libertad','Gerente 1','23695698','26395613',1,'2013-06-05 21:59:23',1),(10,6,'La Union',NULL,'25647895','23691282',1,'2013-06-05 21:59:23',1),(11,6,'La Paz',NULL,'25478956','25612569',1,'2013-06-05 21:59:23',1),(12,6,'Sucursal 1','ddddddddd','456','456456',8,'2014-02-16 19:15:04',1),(13,34,'Oficina Central','Linda Funes','2333333','',3,'2014-04-01 15:22:42',1);

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
  `asistio` int(11) default '1',
  `aprobado` int(11) NOT NULL default '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario` int(11) default NULL,
  PRIMARY KEY  (`id_asistencia`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_asistencia` */

insert  into `inscripcion_asistencia`(`id_asistencia`,`id_modulo`,`id_inscripcion_personas`,`asistio`,`aprobado`,`fecha_creacion`,`id_usuario`) values (31,10,12,1,1,'2014-03-02 22:26:02',1),(32,10,13,1,1,'2014-03-02 22:26:02',1),(33,10,14,1,0,'2014-03-02 22:26:02',1),(34,10,15,1,0,'2014-03-02 22:26:02',1),(35,10,16,1,1,'2014-03-02 22:26:02',1),(36,10,17,1,1,'2014-03-02 22:26:02',1),(37,10,18,1,0,'2014-03-31 15:13:04',1),(38,15,19,1,0,'2014-04-01 15:49:04',3),(39,15,20,1,1,'2014-04-01 15:49:04',3),(40,15,21,1,1,'2014-04-01 15:49:04',3),(41,14,22,1,0,'2014-04-20 22:36:16',16),(43,14,24,1,0,'2014-04-20 22:41:57',16),(50,12,29,1,1,'2014-04-27 22:33:26',16),(51,12,30,1,0,'2014-05-05 21:51:57',16),(52,12,31,1,0,'2014-05-07 20:01:52',16),(53,12,32,1,1,'2014-05-07 20:14:33',16);

/*Table structure for table `inscripcion_temas` */

DROP TABLE IF EXISTS `inscripcion_temas`;

CREATE TABLE `inscripcion_temas` (
  `id_inscripcion_tema` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) default '0',
  `id_capacitacion` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  `id_cooperativa` int(11) default '0',
  PRIMARY KEY  (`id_inscripcion_tema`),
  KEY `FK_inscripcion_temas` (`id_capacitacion`),
  CONSTRAINT `FK_inscripcion_temas` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_temas` */

insert  into `inscripcion_temas`(`id_inscripcion_tema`,`id_usuario`,`id_capacitacion`,`f_creacion`,`activo`,`id_cooperativa`) values (8,7,7,'2014-02-01 22:10:39',1,9),(9,4,7,'2014-02-01 22:14:02',1,6),(10,0,7,'2014-02-26 22:03:06',1,1),(11,0,7,'2014-02-26 22:07:07',1,0),(13,3,10,'2014-04-01 14:54:48',1,NULL),(14,13,10,'2014-04-01 15:04:15',1,34),(15,14,10,'2014-04-01 15:11:29',1,1),(16,13,9,'2014-04-20 21:50:51',1,34),(17,6,9,'2014-04-27 21:53:26',1,9),(18,12,9,'2014-05-05 20:58:23',1,6);

/*Table structure for table `inscripcion_temas_descuentos` */

DROP TABLE IF EXISTS `inscripcion_temas_descuentos`;

CREATE TABLE `inscripcion_temas_descuentos` (
  `id_descuento` int(11) NOT NULL auto_increment,
  `id_cooperativa` int(11) NOT NULL,
  `id_inscripcion_tema` int(11) NOT NULL,
  `descuento` decimal(5,2) default '0.00',
  `id_usuario` int(11) default '0',
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_descuento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_temas_descuentos` */

insert  into `inscripcion_temas_descuentos`(`id_descuento`,`id_cooperativa`,`id_inscripcion_tema`,`descuento`,`id_usuario`,`f_creacion`,`activo`) values (1,9,8,'10.00',1,'2014-03-09 10:24:07',1);

/*Table structure for table `inscripcion_temas_personas` */

DROP TABLE IF EXISTS `inscripcion_temas_personas`;

CREATE TABLE `inscripcion_temas_personas` (
  `id_inscripcion_personas` int(11) NOT NULL auto_increment,
  `id_inscripcion_tema` int(11) NOT NULL,
  `dui` varchar(20) default NULL,
  `apellidos` varchar(20) default NULL,
  `nombres` varchar(20) default NULL,
  `correo` longtext,
  `tipo_persona` varchar(5) default 'A',
  `id_sucursal` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL default '1',
  `aprobado` int(11) default '0',
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_inscripcion_personas`),
  KEY `FK_inscripcion_temas_personas` (`id_inscripcion_tema`),
  CONSTRAINT `FK_inscripcion_temas_personas` FOREIGN KEY (`id_inscripcion_tema`) REFERENCES `inscripcion_temas` (`id_inscripcion_tema`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_temas_personas` */

insert  into `inscripcion_temas_personas`(`id_inscripcion_personas`,`id_inscripcion_tema`,`dui`,`apellidos`,`nombres`,`correo`,`tipo_persona`,`id_sucursal`,`id_cargo`,`aprobado`,`id_usuario`,`f_creacion`,`activo`) values (12,8,'56985749-5','Rodriguez','Jorge','sdf','A',7,1,0,1,'2014-02-01 22:10:39',1),(13,9,'25689-654','Hernandez','Carlos',NULL,'A',9,2,0,1,'2014-02-01 22:14:02',1),(14,8,'2','Amaya','Carlos','jarh@jarh.com','A',0,3,0,1,'2014-02-26 22:56:35',1),(15,11,'123','Melendez','Mario','jarh@jarh.com','NA',0,1,0,1,'2014-02-27 23:30:01',1),(16,11,'9','Guerra','Maria','jarh@jarh.com','EX',0,1,0,1,'2014-03-02 22:12:46',1),(17,11,'7','Ramirez','Daniel','jjjjj@sad.com','EX',0,1,0,1,'2014-03-02 22:25:53',1),(18,8,'1','Rodriguez','Antonio','','A',8,2,0,7,'2014-03-05 22:07:12',1),(19,15,'01959901-6','Mauricio Campos','Raúl Eduardo ','raul.mauricio@fedecaces.com','A',13,1,0,14,'2014-04-01 15:23:48',1),(20,14,'00250982-2','LOPEZ DE SANTOS','MIRNA SORAYA','cooperativa.electra@fedecaces.com','A',13,32,0,13,'2014-04-01 15:44:55',1),(21,14,'03628474-7','CASTELLANOS PINEDA','CESAR RAFAEL','contabilidad.electra@fedecaces.com','A',13,7,0,13,'2014-04-01 15:45:57',1),(29,16,'01959901-6','Mauricio Campos','Raúl Eduardo ','raul.mauricio@fedecaces.com','A',13,1,0,16,'2014-04-27 22:33:20',1),(30,18,'3','Rodriguez','Jorge Antonio','Jarh@jarh.com','A',9,31,0,12,'2014-05-05 21:01:29',1),(31,18,'4','Hernandez','Carlos ','ahernandez@gmail.com','A',6,32,0,12,'2014-05-05 23:55:51',1),(32,16,'03628474-7','CASTELLANOS PINEDA','CESAR RAFAEL','contabilidad.electra@fedecaces.com','A',13,7,0,16,'2014-05-07 20:14:33',1);

/*Table structure for table `mante_cargos` */

DROP TABLE IF EXISTS `mante_cargos`;

CREATE TABLE `mante_cargos` (
  `id_cargo` int(11) NOT NULL auto_increment,
  `nombre_cargo` varchar(100) default NULL,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_cargo`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `mante_cargos` */

insert  into `mante_cargos`(`id_cargo`,`nombre_cargo`,`f_creacion`,`id_usuario`,`activo`) values (1,'Jefe de Mercadeo','2013-06-28 20:34:20',1,1),(2,'Gerente de Agencia','2013-06-28 20:34:41',1,1),(3,'Asistente Administrativa','2013-06-28 20:34:53',1,1),(4,'Gerente General','2013-06-28 20:35:04',1,1),(5,'Cajero','2013-06-28 20:35:13',1,1),(6,'Vigilante','2014-04-01 13:40:18',3,1),(7,'Contador General','2014-04-01 13:40:27',3,1),(8,'Auxiliar Contable','2014-04-01 13:40:35',3,1),(9,'Jefe Departamento Jurídico','2014-04-01 13:40:47',3,1),(10,'Gestor de Cobro','2014-04-01 13:40:56',3,1),(11,'Referente de Tarjeta','2014-04-01 13:41:10',3,1),(12,'Referente de Remesas Familiares','2014-04-01 13:41:20',3,1),(13,'Jefe Departamento de Informática','2014-04-01 13:41:32',3,1),(14,'Gerente Financiero','2014-04-01 13:41:40',3,1),(15,'Gerente de Recursos Humanos','2014-04-01 13:41:49',3,1),(16,'Oficial de Cumplimiento','2014-04-01 13:42:07',3,1),(17,'Oficial de Riesgos','2014-04-01 13:42:13',3,1),(18,'Presidente de Consejo de Administración','2014-04-01 13:42:43',3,1),(19,'Secretario Consejo','2014-04-01 13:42:53',3,1),(20,'Tesorero Consejo','2014-04-01 13:43:02',3,1),(21,'Vocal Consejo','2014-04-01 13:43:13',3,1),(22,'Suplente Consejo','2014-04-01 13:43:24',3,1),(23,'Presidente Junta Vigilancia','2014-04-01 13:43:47',3,1),(24,'Secretario Junta de Vigilancia','2014-04-01 13:43:57',3,1),(25,'Vocal Junta de Vigilancia','2014-04-01 13:44:08',3,1),(26,'Suplente Junta de Vigilancia','2014-04-01 13:44:19',3,1),(27,'Ejecutivo de Crédito','2014-04-01 13:44:36',3,1),(28,'Ejecutivo de Atención al Cliente','2014-04-01 13:44:46',3,1),(29,'Cajero Contable','2014-04-01 13:44:57',3,1),(30,'Ordenanza','2014-04-01 13:45:05',3,1),(31,'Gerente Administrativo','2014-04-01 13:46:29',3,1),(32,'Jefe de Operaciones','2014-04-01 13:46:35',3,1),(33,'Asistente de Gerencia','2014-04-01 13:47:12',3,1);

/*Table structure for table `mante_cat_resultado` */

DROP TABLE IF EXISTS `mante_cat_resultado`;

CREATE TABLE `mante_cat_resultado` (
  `id_mante_cat_resultado` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) NOT NULL,
  `activo` int(11) NOT NULL default '1',
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  PRIMARY KEY  (`id_mante_cat_resultado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mante_cat_resultado` */

insert  into `mante_cat_resultado`(`id_mante_cat_resultado`,`nombre`,`activo`,`f_creacion`,`id_usuario`) values (1,'DEL INSTRUCTOR',1,'2014-01-20 23:40:32',1),(2,'DEL CURSO',1,'2014-01-20 23:47:06',1),(3,'DEL GRUPO',1,'2014-01-20 23:47:22',1),(4,'DE LA COORDINACION GENERAL',1,'2014-01-20 23:47:43',1);

/*Table structure for table `mante_cat_resultado_aspectos` */

DROP TABLE IF EXISTS `mante_cat_resultado_aspectos`;

CREATE TABLE `mante_cat_resultado_aspectos` (
  `id_aspectos_considerar` int(11) NOT NULL auto_increment,
  `id_mante_cat_resultado` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `activo` int(11) default '1',
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  PRIMARY KEY  (`id_aspectos_considerar`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `mante_cat_resultado_aspectos` */

insert  into `mante_cat_resultado_aspectos`(`id_aspectos_considerar`,`id_mante_cat_resultado`,`nombre`,`activo`,`f_creacion`,`id_usuario`) values (1,1,'Dominio del tema que impartió',1,'2014-01-21 00:05:50',1),(2,2,'Se alcanzaron los Objetivos',1,'2014-01-22 22:07:00',1),(3,3,'Los participantes se mostraron interesados',1,'2014-01-22 22:07:41',1),(4,4,'La calidad de trabajo del coordinador',1,'2014-01-22 22:08:27',1),(5,1,'Preparo sus sesiones',1,'2014-01-23 20:43:42',1),(6,3,'Compartieron sus conocimientos y experiencias',1,'2014-01-23 21:21:25',1),(7,1,'Fomento la participación del grupo',1,'2014-01-23 22:30:34',1),(8,1,'Se expreso con claridad',1,'2014-01-23 22:31:18',1),(9,1,'Cumplió con los tiempos programados',1,'2014-01-23 22:31:51',1),(10,1,'Supervisó el trabajo en equipo',1,'2014-01-23 22:33:08',1),(11,2,'El conocimiento adquirido es aplicable en su rol',1,'2014-01-23 22:35:26',1),(12,2,'El tema se desarrolló de forma teórico - práctico',1,'2014-01-23 22:36:31',1),(13,2,'Los Contenidos se abordaron con secuencia logica',1,'2014-01-23 22:37:06',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `mante_especialidades` */

insert  into `mante_especialidades`(`id_especialidad`,`nombre_especialidad`,`id_usuario`,`f_creacion`,`activo`) values (1,'Planificación estratégica',1,'2013-12-16 21:46:18',1),(2,'Finanzas',1,'2013-12-16 22:34:43',1),(3,'Recursos Humanos',1,'2014-03-31 15:37:40',1),(4,'Mercadologo',1,'2014-03-31 15:37:54',1),(5,'Riesgos',1,'2014-03-31 15:43:56',1),(6,'Prevención de Lavado de Activos',3,'2014-04-01 13:31:18',1),(7,'Control Interno',3,'2014-04-01 13:31:25',1),(8,'Imagen ',3,'2014-04-01 13:31:38',1),(9,'Auditoría Externa',3,'2014-04-01 17:33:26',1);

/*Table structure for table `mante_especialidades_x_facilitador` */

DROP TABLE IF EXISTS `mante_especialidades_x_facilitador`;

CREATE TABLE `mante_especialidades_x_facilitador` (
  `id_especialidad_x_facilitador` int(11) NOT NULL auto_increment,
  `id_especialidad` int(11) NOT NULL,
  `id_facilitador` int(11) NOT NULL,
  PRIMARY KEY  (`id_especialidad_x_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `mante_especialidades_x_facilitador` */

insert  into `mante_especialidades_x_facilitador`(`id_especialidad_x_facilitador`,`id_especialidad`,`id_facilitador`) values (7,2,2),(8,1,2),(14,1,4),(15,2,4),(16,5,4),(17,1,3),(18,2,3),(19,3,3),(23,6,1),(24,7,1),(25,5,1),(29,2,5),(30,1,5),(31,8,5),(32,3,5),(33,2,6),(34,5,6),(35,7,6),(36,9,8),(37,2,8),(38,7,8);

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
  `direccion` longtext,
  `t_oficina` varchar(20) default NULL,
  `celular` varchar(20) default NULL,
  `correo` longtext,
  `nacionalidad` longtext,
  `acreditado` int(11) default '0',
  `id_tipo_facilitador` int(11) default NULL,
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `mante_facilitadores` */

insert  into `mante_facilitadores`(`id_facilitador`,`nombres`,`apellidos`,`telefono`,`direccion`,`t_oficina`,`celular`,`correo`,`nacionalidad`,`acreditado`,`id_tipo_facilitador`,`activo`,`id_usuario`,`f_creacion`) values (1,'Raúl Eduardo','Mauricio Campos','','14 Avenida Norte, Pasaje 4, número 106, Colonia La Rábida, San Salvador, El Salvador','25553560','78741657','raul.mauricio@fedecases.com','Salvadoreño',1,1,1,1,'2013-06-11 10:00:00'),(2,'Carlos','Hernandez','123456789','','123456789','123456789','jarh@jar.com',NULL,1,2,0,1,'2013-06-11 23:45:54'),(3,'Moris','Molina','','25 Av. Nte. y 25 Calle Pte. #1301, San Salvador','25553565','','moris.molina@fe',NULL,1,2,0,1,'2014-03-31 15:31:43'),(4,'Sergio','Doradea','','Su casa','','71279339','jsdoradea@gmail',NULL,0,2,0,1,'2014-03-31 15:42:53'),(5,'Miguel Ángel','Pérez','','','','79107236','magisterfinanci',NULL,0,1,1,3,'2014-04-01 17:12:54'),(6,'Luis','Lievano','','','','77355930','luigisalv@yahoo',NULL,0,1,1,3,'2014-04-01 17:20:54'),(7,'Alberto','Avila','','Miami','','121212343','alberto.avila@i',NULL,0,1,1,3,'2014-04-01 17:30:15'),(8,'Saúl Antonio','Nerio','','23 Avenida Norte y 25 Calle Poniente número 1303, San Salvador, El Salvador.','','77292218','saul.nerio@fede',NULL,0,1,1,3,'2014-04-01 17:32:43');

/*Table structure for table `mante_facilitadores_docs` */

DROP TABLE IF EXISTS `mante_facilitadores_docs`;

CREATE TABLE `mante_facilitadores_docs` (
  `id_doc` int(11) NOT NULL auto_increment,
  `id_facilitador` int(11) NOT NULL,
  `nombre_doc` varchar(100) NOT NULL,
  `archivo` longtext,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mante_facilitadores_docs` */

insert  into `mante_facilitadores_docs`(`id_doc`,`id_facilitador`,`nombre_doc`,`archivo`,`f_creacion`,`id_usuario`,`activo`) values (1,2,'Archivo 1','control.jsf','2014-02-13 23:06:54',1,1),(2,4,'Curriculo','CV_Sergio_Doradea_092013.pdf','2014-03-31 15:45:33',1,1),(3,1,'Curriculum Raúl Mauricio','Curriculum_Raúl_Mauricio_Agosto_2013.pdf','2014-04-02 09:49:14',3,1);

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

insert  into `mante_lugares`(`id_lugar`,`nombre_lugar`,`telefono`,`ubicacion`,`activo`,`id_usuario`,`f_creacion`) values (2,'Hotel Crowne Plaza','25553561','San Salvador',1,1,'2013-06-16 16:37:59'),(3,'Centro de Capacitación del Sistema Cooperativo Financiero FEDECACES','25553561','23 Avenida Norte 1313, San Salvador, El Salvador',1,1,'2013-06-16 16:39:00');

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

insert  into `mante_modalidades`(`id_modalidad`,`nombre_modalidad`,`objetivo`,`f_creacion`,`id_usuario`,`activo`) values (2,'Diplomados','Modalidad de formación para la especialización del recurso humano de las cooperativas del sector de ahorro y crédito. Todos nuestros diplomados están respaldados por la facultad de ciencias económicas de la Universidad de El Salvador','2013-06-01 20:54:52',1,1),(3,'Seminarios y Foros','Modalidad de formación que nos permite formar al personal que no interviene en el proceso de intermediación, y/o tocar temas del contexto legal y normativo sin llegar a la intensidad de un diplomado.','2013-06-02 17:05:20',1,1),(4,'Talleres','Modalidad de formación práctica para la exposición de herramientas e insumos que contribuyan al desarrollo del sector y de su personal.','2013-06-02 17:05:41',1,1),(5,'Congresos','Modalidad que nos permite reunión a especialistas en una rama del que hacer cooperativo para la disertación de temas de actualidad y definición de líneas de trabajo estratégicas para el sector','2013-06-02 17:05:55',1,1);

/*Table structure for table `mante_personal` */

DROP TABLE IF EXISTS `mante_personal`;

CREATE TABLE `mante_personal` (
  `id_personal` int(11) NOT NULL auto_increment,
  `id_cooperativa` int(11) NOT NULL default '0',
  `id_sucursal` int(11) NOT NULL default '0',
  `dui` varchar(100) default NULL,
  `apellidos` longtext,
  `nombres` longtext,
  `correo` longtext,
  `id_cargo` int(11) default '1',
  `tipo_persona` varchar(5) default 'A',
  `activo` int(11) default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_personal`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `mante_personal` */

insert  into `mante_personal`(`id_personal`,`id_cooperativa`,`id_sucursal`,`dui`,`apellidos`,`nombres`,`correo`,`id_cargo`,`tipo_persona`,`activo`,`id_usuario`,`f_creacion`) values (1,9,8,'1','Rodriguez','Antonio',NULL,2,'A',0,7,'2014-02-15 22:41:49'),(2,9,8,'2','Amaya','Carlos','jarh@jarh.com',3,'A',0,7,'2014-02-25 22:33:52'),(3,1,0,'123','Melendez','Mario','jarh@jarh.com',1,'NA',1,1,'2014-02-27 23:04:33'),(4,1,0,'9','Guerra','Maria','jarh@jarh.com',1,'EX',1,1,'2014-03-02 22:12:32'),(6,1,0,'7','Ramirez','Daniel','jjjjj@sad.com',1,'EX',1,1,'2014-03-02 22:25:22'),(7,34,13,'01959901-6','Mauricio Campos','Raúl Eduardo ','raul.mauricio@fedecaces.com',1,'A',1,14,'2014-04-01 15:23:19'),(8,34,13,'03628474-7','CASTELLANOS PINEDA','CESAR RAFAEL','contabilidad.electra@fedecaces.com',7,'A',1,13,'2014-04-01 15:36:58'),(9,34,13,'00250982-2','LOPEZ DE SANTOS','MIRNA SORAYA','cooperativa.electra@fedecaces.com',32,'A',1,13,'2014-04-01 15:37:27'),(10,6,9,'3','Rodriguez','Jorge Antonio','Jarh@jarh.com',31,'A',1,12,'2014-05-05 20:59:17'),(11,6,6,'4','Hernandez','Carlos ','ahernandez@gmail.com',32,'A',1,12,'2014-05-05 21:04:01');

/*Table structure for table `mante_profesion_x_facilitador` */

DROP TABLE IF EXISTS `mante_profesion_x_facilitador`;

CREATE TABLE `mante_profesion_x_facilitador` (
  `id_profesion_x_facilitador` int(11) NOT NULL auto_increment,
  `id_facilitador` int(11) NOT NULL,
  `id_profesion` int(11) NOT NULL,
  PRIMARY KEY  (`id_profesion_x_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `mante_profesion_x_facilitador` */

insert  into `mante_profesion_x_facilitador`(`id_profesion_x_facilitador`,`id_facilitador`,`id_profesion`) values (10,2,1),(14,3,1),(15,3,4),(16,4,5),(17,4,4),(18,1,6),(19,5,16),(20,5,21),(21,6,6),(22,8,6);

/*Table structure for table `mante_profesiones` */

DROP TABLE IF EXISTS `mante_profesiones`;

CREATE TABLE `mante_profesiones` (
  `id_profesion` int(11) NOT NULL auto_increment,
  `nombre_profesion` longtext NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_profesion`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `mante_profesiones` */

insert  into `mante_profesiones`(`id_profesion`,`nombre_profesion`,`id_usuario`,`f_creacion`,`activo`) values (1,'Lic. en Administración de Empresas',1,'2013-12-16 21:32:41',1),(2,'Ingeniero en Sistemas',1,'2013-12-16 22:08:40',1),(3,'Lic. en Ciencias Jurídicas',1,'2014-03-31 15:35:31',1),(4,'Mastria en Administración de Empresas',1,'2014-03-31 15:36:29',1),(5,'Ingeniero Civil',1,'2014-03-31 15:41:44',1),(6,'Lic. en Contaduría Publica',3,'2014-04-01 13:26:14',1),(7,'Bachiller opción Contador',3,'2014-04-01 13:26:27',1),(8,'Bachiller General',3,'2014-04-01 13:26:35',1),(9,'Técnico informático',3,'2014-04-01 13:26:48',1),(10,'Ingeniero Industrial',3,'2014-04-01 13:27:00',1),(11,'Lic. en Mercadeo',3,'2014-04-01 13:27:08',1),(12,'Agronomo',3,'2014-04-01 13:27:35',1),(13,'Profesor',3,'2014-04-01 13:27:45',1),(14,'Lic. en Trabajo Social',3,'2014-04-01 13:28:05',1),(15,'Lic. en Psicología',3,'2014-04-01 13:28:13',1),(16,'Master en Administración Financiera',3,'2014-04-01 13:28:38',1),(17,'Arquitecto',3,'2014-04-01 13:28:44',1),(18,'Médico',3,'2014-04-01 13:28:51',1),(19,'Lic. en Enfermería',3,'2014-04-01 13:29:03',1),(20,'Lic. en Idiomas',3,'2014-04-01 13:30:05',1),(21,'Lic. en Economía',3,'2014-04-01 17:16:11',1);

/*Table structure for table `mante_rubros` */

DROP TABLE IF EXISTS `mante_rubros`;

CREATE TABLE `mante_rubros` (
  `id_rubro` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `mante_rubros` */

insert  into `mante_rubros`(`id_rubro`,`nombre`,`id_usuario`,`f_creacion`,`activo`) values (2,'Alimentación Desayuno',1,'2013-06-19 20:53:32',0),(3,'Alimentación Almuerzos',1,'2013-06-19 20:53:47',0),(4,'Alimentación Refrigerios',3,'2014-04-01 13:48:58',0),(5,'Folder',3,'2014-04-01 13:49:14',0),(6,'Cartapacio',3,'2014-04-01 13:49:22',0),(7,'Lapiceros',3,'2014-04-01 13:49:34',0),(8,'Hojas membretadas',3,'2014-04-01 13:51:52',0),(9,'Libreta',3,'2014-04-01 13:52:09',0),(10,'Diploma',3,'2014-04-01 13:54:00',0),(11,'Gafete o Viñetas',3,'2014-04-01 13:54:26',0),(12,'Reproducción de Material',3,'2014-04-01 13:54:51',0),(13,'CD con funda',3,'2014-04-01 13:55:03',0),(14,'Papel bond pliego',3,'2014-04-01 13:55:33',0),(15,'Meta Plan',3,'2014-04-01 13:55:42',0),(16,'Papel bond color',3,'2014-04-01 13:55:56',0),(17,'Alimentación',3,'2014-04-01 13:56:33',1),(18,'Alquiler de Salas',3,'2014-04-01 13:56:51',0),(19,'Combustible',3,'2014-04-01 13:57:04',0),(20,'Honorarios',3,'2014-04-01 13:57:13',0),(21,'Materiales participantes',3,'2014-04-01 13:57:24',1),(22,'Alojamiento',3,'2014-04-01 13:57:33',0),(23,'Taxi',3,'2014-04-01 13:57:46',0),(24,'Otros',3,'2014-04-01 13:57:57',0),(25,'Becas',3,'2014-04-01 13:58:04',0),(26,'Materiales facilitador',3,'2014-04-01 14:28:43',1),(27,'Desplazamiento',3,'2014-04-01 14:28:51',1),(28,'Honorarios',3,'2014-04-01 14:28:59',1),(29,'Apoyo Técnico',3,'2014-04-01 14:29:10',1),(30,'Alquiler local',3,'2014-04-01 14:29:28',1),(31,'Equipo',3,'2014-04-01 14:29:38',1);

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

/*Table structure for table `mante_tipo_evaluacion` */

DROP TABLE IF EXISTS `mante_tipo_evaluacion`;

CREATE TABLE `mante_tipo_evaluacion` (
  `id_tipo_evaluacion` int(11) NOT NULL auto_increment,
  `nombre_tipo_evaluacion` longtext,
  `activo` int(11) NOT NULL default '1',
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  PRIMARY KEY  (`id_tipo_evaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `mante_tipo_evaluacion` */

insert  into `mante_tipo_evaluacion`(`id_tipo_evaluacion`,`nombre_tipo_evaluacion`,`activo`,`f_creacion`,`id_usuario`) values (1,'Examen',1,'2014-01-03 21:10:49',1),(4,'Laboratorio',1,'2014-01-06 22:25:53',1),(5,'Tarea Escrita',1,'2014-01-06 22:26:07',1),(6,'Asistencia',1,'2014-01-06 22:26:15',1),(7,'Participación elearning',1,'2014-04-01 13:24:12',3);

/*Table structure for table `mante_tipos_facilitadores` */

DROP TABLE IF EXISTS `mante_tipos_facilitadores`;

CREATE TABLE `mante_tipos_facilitadores` (
  `id_tipo_facilitador` int(11) NOT NULL auto_increment,
  `nombre_tipo_facilitador` varchar(50) default NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_tipo_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mante_tipos_facilitadores` */

insert  into `mante_tipos_facilitadores`(`id_tipo_facilitador`,`nombre_tipo_facilitador`,`id_usuario`,`f_creacion`,`activo`) values (1,'Facilitador',1,'2013-06-28 20:28:15',1),(2,'Tecnico',1,'2013-06-28 20:28:15',1);

/*Table structure for table `notas_cargo` */

DROP TABLE IF EXISTS `notas_cargo`;

CREATE TABLE `notas_cargo` (
  `id_nota_cargo` int(11) NOT NULL auto_increment,
  `fecha_creacion` datetime NOT NULL,
  `tipo_persona` varchar(5) default 'C',
  `cantidad_por` decimal(18,2) default '0.00',
  `cantidad_letras` longtext,
  `id_capacitacion` int(11) NOT NULL,
  `id_cooperativa` varchar(1000) NOT NULL,
  `inversion_individual` decimal(18,2) default NULL,
  `inversion_total` decimal(18,2) default NULL,
  `id_usuario_creado` int(11) NOT NULL,
  `activo` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_nota_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `notas_cargo` */

insert  into `notas_cargo`(`id_nota_cargo`,`fecha_creacion`,`tipo_persona`,`cantidad_por`,`cantidad_letras`,`id_capacitacion`,`id_cooperativa`,`inversion_individual`,`inversion_total`,`id_usuario_creado`,`activo`) values (1,'0000-00-00 00:00:00','C','60.00','Sesenta Dolares ',7,'9','60.00','120.00',1,1),(2,'2014-03-14 22:57:26','C','20.00','Veinte Dolares ',7,'9','60.00','180.00',1,1),(3,'2014-03-31 15:09:37','C','20.00','Veinte Dolares ',7,'9','60.00','180.00',1,1),(4,'2014-04-01 15:51:28','C','200.00','Doscientos Dolares ',10,'34','400.00','800.00',3,1);

/*Table structure for table `pl_capacitaciones` */

DROP TABLE IF EXISTS `pl_capacitaciones`;

CREATE TABLE `pl_capacitaciones` (
  `id_capacitacion` int(11) NOT NULL auto_increment,
  `id_plan_modalidad` int(11) default NULL,
  `nombre_capacitacion` longtext,
  `objetivo` longtext,
  `dirigido` longtext,
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `pl_capacitaciones` */

insert  into `pl_capacitaciones`(`id_capacitacion`,`id_plan_modalidad`,`nombre_capacitacion`,`objetivo`,`dirigido`,`cerrado`,`n_participantes`,`n_participantes_no`,`n_participantes_ex`,`f_creacion`,`id_usuario`,`activo`) values (7,6,'Diplomado 1','Diplomado 1',NULL,0,20,15,20,'2014-01-31 23:16:51',8,0),(8,6,'Diplomado 2','Diplomado 2',NULL,0,0,0,0,'2014-02-01 00:04:52',8,0),(9,10,'Mejores prácticas en la gestión del riesgo de lavado de activos y financiamiento al terrorismo con aplicación en la legislación y normativa Salvadoreña','Proporcionar herramientas para la gestión del riesgo de lavado de activos y de financiamiento al terrorismo, con enfoque de aplicación en la legislación y normativa Salvadoreña, y de las mejores prácticas a nivel internacional.\r\n\r\nInstruir a los Oficiales de Cumplimiento y Comités de Prevención de Lav','Personas',0,15,50,0,'2014-04-01 14:05:29',3,1),(10,11,'Seminario sobre Normas para Bancos Cooperativos y Sociedades de Ahorro y Crédito, con enfoque de aplicación en: operaciones, administración de riesgos, contables y de regulación del Sistema Financiero','Brindar los elentos teórico - prácticos para la adopción de la normativa prudencial y contable para Bancos Cooperativos y Sociedades de Ahorro y Crédito, bajo un enfoque de regulación, brindando herramientas técnicas para su aplicación.',NULL,0,35,15,0,'2014-04-01 14:33:26',3,1),(11,11,'Seminario Taller: Proceso de certificación de Oficiales de Cumplimiento del Sistema Cooperativo Financiero FEDECACES','Al finalizar el curso los participantes contarán con la base necesaria para presentar el examen de certificación CAMS. ACAMS (Association of Certified Anti-Money Laundering Specialists)',NULL,0,25,15,0,'2014-04-01 16:22:42',3,1),(12,11,'Seminario Taller: Técnicas para la Conducción Efectiva de su Asamblea General','Contribuir al buen desarrollo de las Asambleas Generales en las Cooperativas, a través de facilitar técnicas para su desarrollo.',NULL,0,20,5,0,'2014-04-01 16:34:18',3,1),(13,11,'Seminario Taller: Capacitación básica para Agentes de Seguridad de Instituciones Financieras Cooperativas','Generar las competencias necesarias en el personal de seguridad de las Cooperativas de Ahorro y Crédito como parte de la atención integral al asociado.',NULL,0,25,5,0,'2014-04-01 16:43:35',3,1);

/*Table structure for table `pl_capacitaciones_docs` */

DROP TABLE IF EXISTS `pl_capacitaciones_docs`;

CREATE TABLE `pl_capacitaciones_docs` (
  `id_doc` int(11) NOT NULL auto_increment,
  `id_capacitacion` int(11) NOT NULL,
  `nombre_doc` varchar(100) NOT NULL,
  `archivo` longtext,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pl_capacitaciones_docs` */

insert  into `pl_capacitaciones_docs`(`id_doc`,`id_capacitacion`,`nombre_doc`,`archivo`,`f_creacion`,`id_usuario`,`activo`) values (2,9,'fff','654.txt','2014-04-14 22:44:59',16,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modalidades` */

insert  into `pl_modalidades`(`id_plan_modalidad`,`id_plan`,`id_modalidad`,`id_usuario`,`f_creacion`,`activo`) values (6,3,2,8,'2014-01-31 23:08:47',1),(7,3,3,1,'2014-02-01 21:56:40',1),(8,3,5,3,'2014-04-01 14:01:12',1),(9,3,4,3,'2014-04-01 14:01:18',1),(10,4,2,3,'2014-04-01 14:03:00',1),(11,4,3,3,'2014-04-01 14:03:05',1),(12,4,5,3,'2014-04-01 14:03:13',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulo_facilitador` */

insert  into `pl_modulo_facilitador`(`id_modulo_facilitador`,`id_modulo`,`id_facilitador`) values (1,10,2),(3,11,2),(20,26,1),(22,28,1),(23,16,6),(24,15,6),(25,17,6),(26,18,6),(27,27,5),(28,20,7),(29,19,7),(30,22,7),(31,21,7),(32,23,8),(33,24,5),(34,25,5),(35,12,5);

/*Table structure for table `pl_modulos` */

DROP TABLE IF EXISTS `pl_modulos`;

CREATE TABLE `pl_modulos` (
  `id_modulo` int(11) NOT NULL auto_increment,
  `id_capacitacion` int(11) default NULL,
  `id_lugar` int(11) default NULL,
  `nombre_modulo` longtext,
  `precio_venta` decimal(12,2) default '0.00',
  `precio_venta_no` decimal(12,2) default '0.00',
  `precio_venta_ex` decimal(12,2) default '0.00',
  `objetivo_modulo` varchar(300) default NULL,
  `id_contenido` int(11) default '0',
  `fecha_prevista` date default NULL,
  `fecha_prevista_fin` date default NULL,
  `contenido` varchar(200) default NULL,
  `temas` longtext,
  `porcentaje` decimal(18,2) default '0.00',
  `puede_evaluar` int(11) NOT NULL default '1',
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  `activo` int(11) default '1',
  `es_calificado` int(11) default '0',
  PRIMARY KEY  (`id_modulo`),
  KEY `FK_pl_modulos` (`id_capacitacion`),
  KEY `FK_pl_modulos_2` (`id_lugar`),
  CONSTRAINT `FK_pl_modulos` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`),
  CONSTRAINT `FK_pl_modulos_2` FOREIGN KEY (`id_lugar`) REFERENCES `mante_lugares` (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos` */

insert  into `pl_modulos`(`id_modulo`,`id_capacitacion`,`id_lugar`,`nombre_modulo`,`precio_venta`,`precio_venta_no`,`precio_venta_ex`,`objetivo_modulo`,`id_contenido`,`fecha_prevista`,`fecha_prevista_fin`,`contenido`,`temas`,`porcentaje`,`puede_evaluar`,`id_usuario`,`f_creacion`,`activo`,`es_calificado`) values (10,7,3,'Modulo 1','10.00','15.00','20.00','Modulo 1',0,'2014-02-19','2014-02-27','---','[\"Tema1\",\"TEMA 2\"]','50.00',0,8,'2014-01-31 23:17:35',1,1),(11,7,2,'Modulo 2','50.00','60.00','100.00','',0,'2014-03-03','2014-03-05','',NULL,'50.00',1,1,'2014-03-01 20:11:10',1,0),(12,9,3,'Modulo 1.- Actualización del Marco Legal y Normativo en materia de prevención de lavado de activos y financiamiento al terrorismo en El Salvador','100.00','200.00','250.00','Este modulo tiene por objetivo actualizar a los Oficiales de Cumplimiento del sector cooperativo de ahorro sobre las reformas a las leyes en la materia.',0,'2014-07-05','2014-07-06','- Reformas a la Ley contra el lavado de dinero y de activos\r\n\r\n- Reformas al Instructivo de la UIF\r\n\r\n- Normas para la Gestión de Riesgos emitida por el Banco Central de Reserva de El Salvador','[\"Reformas a la Ley contra el Lavado de Dinero y de Activos\",\"Reformas al instructivo de la Unidad de Investigaci\\u00f3n Financiera\",\"Normas para la Gesti\\u00f3n de Riesgos emitida por el Banco Central de Reserva de El Salvador\"]','35.00',0,3,'2014-04-01 14:10:02',1,1),(13,9,3,'Modulo 2.- Mejores prácticas en materia de prevención de lavado de activos aplicadas con base en la regulación Salvadoreña','100.00','200.00','250.00','En este modulo haremos una aplicación de las mejores prácticas a nivel internacional tomando de base la legislación nacional.',0,'2014-07-11','2014-07-12','','[\"Aplicaci\\u00f3n de las Normas KYC de Basilea\",\"Uso de software de Listas Negras\",\"Lista Negra Interna\",\"Control de PEPS\",\"Mineo de Base de Datos\",\"Control Interno y procesos\"]','35.00',1,3,'2014-04-01 14:14:28',1,0),(14,9,3,'Modulo 3.- Premisas para la construcción de las matrices de riesgo de lavado de activos y su aplicación práctica para operativizar la NRP-08','100.00','200.00','250.00','En este modulo daremos las directrices para la aplicación práctica de las normas sobre gestión de riesgos de lavado de activos',0,'2014-07-18','2014-07-19','','[\"El lavado de activos desde la gesti\\u00f3n de riesgos\",\"La matriz de riesgos\",\"Directrices para la construcci\\u00f3n de la matriz de riesgos\",\"La importancia de la base de datos para la construcci\\u00f3n de la matriz de riesgos\",\"Aplicaci\\u00f3n pr\\u00e1ctica de la matriz de riesgos\"]','30.00',1,3,'2014-04-01 14:21:41',1,0),(15,10,3,'Normas Administrativas','100.00','150.00','200.00','',0,'2014-04-04','2014-04-05','',NULL,'35.00',1,3,'2014-04-01 14:35:52',1,0),(16,10,3,'Normas de Control Financiero','100.00','150.00','200.00','',0,'2014-05-02','2014-05-03','',NULL,'35.00',1,3,'2014-04-01 14:36:46',1,0),(17,10,3,'Normas de Gestión de Riesgos','100.00','150.00','200.00','',0,'2014-05-16','2014-05-17','',NULL,'10.00',1,3,'2014-04-01 14:37:40',1,0),(18,10,3,'Normas Contables SSF','100.00','150.00','200.00','',0,'2014-05-23','2014-05-24','',NULL,'20.00',1,3,'2014-04-01 14:38:27',1,0),(19,11,3,'Primera sesión presencial','175.00','175.00','0.00','',0,'2014-02-14','2014-02-15','',NULL,'30.00',1,3,'2014-04-01 16:24:03',1,0),(20,11,3,'Primera sesión virtual','175.00','175.00','0.00','',0,'2014-03-08','2014-03-08','',NULL,'25.00',1,3,'2014-04-01 16:26:04',1,0),(21,11,3,'Segunda sesión virtual','175.00','175.00','0.00','',0,'2014-03-29','2014-03-29','',NULL,'25.00',1,3,'2014-04-01 16:28:26',1,0),(22,11,3,'Segunda sesión presencial','175.00','175.00','0.00','',0,'2014-04-25','2014-04-26','',NULL,'20.00',1,3,'2014-04-01 16:30:05',1,0),(23,12,3,'Planificación exitosa de su Asamblea General de Asociados - Aspectos Legales','85.00','90.00','0.00','',0,'2014-02-15','2014-02-15','',NULL,'35.00',1,3,'2014-04-01 16:39:31',1,0),(24,12,3,'Técnicas para la conducción efectiva de su Asamblea General - Normas Protocolarias','0.00','0.00','0.00','',0,'2014-02-16','2014-02-16','',NULL,'35.00',1,3,'2014-04-01 16:41:21',1,0),(25,12,3,'Técnicas de redacción y edición de su memoria de labores','0.00','0.00','0.00','',0,'2014-02-22','2014-02-22','',NULL,'30.00',1,3,'2014-04-01 16:42:17',1,0),(26,13,3,'Filosofía Cooperativa - Estrategia del Sistema Cooperativo Financiero FEDECACES','60.00','80.00','0.00','',0,'2014-04-06','2014-04-06','',NULL,'35.00',0,3,'2014-04-01 16:45:37',1,0),(27,13,3,'Atención al Cliente Cooperativista','60.00','80.00','0.00','',0,'2014-04-27','2014-04-27','',NULL,'35.00',0,3,'2014-04-01 16:49:20',1,0),(28,13,3,'Medidas de seguridad elementales e indispensables para una institución financiera','60.00','80.00','0.00','',0,'2014-05-04','2014-05-04','',NULL,'30.00',0,3,'2014-04-01 16:50:14',1,0);

/*Table structure for table `pl_modulos_calificacion` */

DROP TABLE IF EXISTS `pl_modulos_calificacion`;

CREATE TABLE `pl_modulos_calificacion` (
  `id_calificacion` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) NOT NULL,
  `id_aspecto` int(11) NOT NULL,
  `nota` decimal(5,2) NOT NULL,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_calificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos_calificacion` */

insert  into `pl_modulos_calificacion`(`id_calificacion`,`id_modulo`,`id_aspecto`,`nota`,`id_usuario`,`f_creacion`) values (1,10,1,'5.00',1,'2014-02-26 20:32:51'),(2,10,5,'3.00',1,'2014-02-26 20:32:51'),(3,10,7,'5.00',1,'2014-02-26 20:32:51'),(4,10,8,'4.00',1,'2014-02-26 20:32:51'),(5,10,9,'2.00',1,'2014-02-26 20:32:51'),(6,10,10,'5.00',1,'2014-02-26 20:32:51'),(7,10,2,'4.00',1,'2014-02-26 20:32:51'),(8,10,11,'1.00',1,'2014-02-26 20:32:51'),(9,10,12,'3.00',1,'2014-02-26 20:32:51'),(10,10,13,'5.00',1,'2014-02-26 20:32:51'),(11,10,3,'1.00',1,'2014-02-26 20:32:51'),(12,10,6,'4.00',1,'2014-02-26 20:32:51'),(13,10,4,'5.00',1,'2014-02-26 20:32:51'),(14,12,1,'3.00',16,'2014-05-02 03:03:50'),(15,12,5,'3.00',16,'2014-05-02 03:03:50'),(16,12,7,'3.00',16,'2014-05-02 03:03:50'),(17,12,8,'3.00',16,'2014-05-02 03:03:50'),(18,12,9,'3.00',16,'2014-05-02 03:03:50'),(19,12,10,'3.00',16,'2014-05-02 03:03:50'),(20,12,2,'3.00',16,'2014-05-02 03:03:50'),(21,12,11,'3.00',16,'2014-05-02 03:03:50'),(22,12,12,'3.00',16,'2014-05-02 03:03:50'),(23,12,13,'3.00',16,'2014-05-02 03:03:50'),(24,12,3,'3.00',16,'2014-05-02 03:03:50'),(25,12,6,'3.00',16,'2014-05-02 03:03:50'),(26,12,4,'3.00',16,'2014-05-02 03:03:50'),(27,10,1,'3.00',16,'2014-05-02 03:04:59'),(28,10,5,'2.00',16,'2014-05-02 03:04:59'),(29,10,7,'1.00',16,'2014-05-02 03:04:59'),(30,10,8,'5.00',16,'2014-05-02 03:04:59'),(31,10,9,'4.00',16,'2014-05-02 03:04:59'),(32,10,10,'1.00',16,'2014-05-02 03:04:59'),(33,10,2,'3.00',16,'2014-05-02 03:04:59'),(34,10,11,'2.00',16,'2014-05-02 03:04:59'),(35,10,12,'4.00',16,'2014-05-02 03:04:59'),(36,10,13,'4.00',16,'2014-05-02 03:04:59'),(37,10,3,'4.00',16,'2014-05-02 03:05:00'),(38,10,6,'4.00',16,'2014-05-02 03:05:00'),(39,10,4,'4.00',16,'2014-05-02 03:05:00'),(40,12,1,'3.00',16,'2014-05-02 03:16:38'),(41,12,5,'2.00',16,'2014-05-02 03:16:38'),(42,12,7,'2.00',16,'2014-05-02 03:16:38'),(43,12,8,'3.00',16,'2014-05-02 03:16:38'),(44,12,9,'3.00',16,'2014-05-02 03:16:38'),(45,12,10,'4.00',16,'2014-05-02 03:16:38'),(46,12,2,'4.00',16,'2014-05-02 03:16:38'),(47,12,11,'1.00',16,'2014-05-02 03:16:38'),(48,12,12,'2.00',16,'2014-05-02 03:16:38'),(49,12,13,'3.00',16,'2014-05-02 03:16:38'),(50,12,3,'2.00',16,'2014-05-02 03:16:38'),(51,12,6,'1.00',16,'2014-05-02 03:16:38'),(52,12,4,'4.00',16,'2014-05-02 03:16:38'),(53,12,1,'3.00',16,'2014-05-07 20:55:27'),(54,12,5,'5.00',16,'2014-05-07 20:55:27'),(55,12,7,'2.00',16,'2014-05-07 20:55:27'),(56,12,8,'1.00',16,'2014-05-07 20:55:27'),(57,12,9,'4.00',16,'2014-05-07 20:55:27'),(58,12,10,'2.00',16,'2014-05-07 20:55:27'),(59,12,2,'3.00',16,'2014-05-07 20:55:27'),(60,12,11,'1.00',16,'2014-05-07 20:55:27'),(61,12,12,'5.00',16,'2014-05-07 20:55:27'),(62,12,13,'2.00',16,'2014-05-07 20:55:27'),(63,12,3,'3.00',16,'2014-05-07 20:55:27'),(64,12,6,'5.00',16,'2014-05-07 20:55:27'),(65,12,4,'4.00',16,'2014-05-07 20:55:27'),(66,12,1,'3.00',16,'2014-05-07 21:35:16'),(67,12,5,'3.00',16,'2014-05-07 21:35:16'),(68,12,7,'3.00',16,'2014-05-07 21:35:16'),(69,12,8,'3.00',16,'2014-05-07 21:35:16'),(70,12,9,'3.00',16,'2014-05-07 21:35:16'),(71,12,10,'3.00',16,'2014-05-07 21:35:16'),(72,12,2,'3.00',16,'2014-05-07 21:35:16'),(73,12,11,'3.00',16,'2014-05-07 21:35:16'),(74,12,12,'3.00',16,'2014-05-07 21:35:16'),(75,12,13,'3.00',16,'2014-05-07 21:35:16'),(76,12,3,'3.00',16,'2014-05-07 21:35:16'),(77,12,6,'3.00',16,'2014-05-07 21:35:16'),(78,12,4,'3.00',16,'2014-05-07 21:35:16');

/*Table structure for table `pl_modulos_eval` */

DROP TABLE IF EXISTS `pl_modulos_eval`;

CREATE TABLE `pl_modulos_eval` (
  `id_eval_x_mod` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) NOT NULL,
  `id_tipo_evaluacion` int(11) NOT NULL,
  `porcentaje` decimal(18,2) NOT NULL default '0.00',
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_eval_x_mod`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos_eval` */

insert  into `pl_modulos_eval`(`id_eval_x_mod`,`id_modulo`,`id_tipo_evaluacion`,`porcentaje`,`f_creacion`,`id_usuario`,`activo`) values (1,11,6,'100.00','2014-03-01 22:40:24',1,1),(2,10,6,'100.00','2014-03-01 22:40:46',1,1),(3,12,1,'50.00','2014-04-01 14:10:32',3,1),(4,13,5,'50.00','2014-04-01 14:14:41',3,1),(5,13,7,'50.00','2014-04-01 14:15:41',3,1),(6,12,7,'50.00','2014-04-01 14:16:59',3,1),(7,19,6,'100.00','2014-04-01 16:24:23',3,1),(8,20,7,'50.00','2014-04-01 16:26:26',3,1),(9,20,5,'50.00','2014-04-01 16:26:53',3,1),(10,21,5,'50.00','2014-04-01 16:28:44',3,1),(11,21,7,'50.00','2014-04-01 16:29:07',3,1),(12,22,6,'50.00','2014-04-01 16:30:34',3,1),(13,22,7,'50.00','2014-04-01 16:30:42',3,1);

/*Table structure for table `pl_modulos_notas` */

DROP TABLE IF EXISTS `pl_modulos_notas`;

CREATE TABLE `pl_modulos_notas` (
  `id_nota_x_modulo` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) NOT NULL,
  `id_inscripcion_persona` int(11) NOT NULL,
  `id_eval_x_mod` int(11) NOT NULL,
  `nota` decimal(18,2) NOT NULL,
  PRIMARY KEY  (`id_nota_x_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos_notas` */

insert  into `pl_modulos_notas`(`id_nota_x_modulo`,`id_modulo`,`id_inscripcion_persona`,`id_eval_x_mod`,`nota`) values (1,10,14,2,'9.00'),(2,10,13,2,'5.00'),(3,10,15,2,'6.00'),(4,10,12,2,'8.00'),(5,10,16,2,'0.00'),(6,10,17,2,'0.00'),(7,10,18,2,'0.00'),(8,12,26,3,'0.00'),(9,12,26,6,'0.00'),(10,12,27,3,'10.00'),(11,12,27,6,'10.00');

/*Table structure for table `pl_opiniones` */

DROP TABLE IF EXISTS `pl_opiniones`;

CREATE TABLE `pl_opiniones` (
  `id_opinion` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) NOT NULL,
  `mas_gusto` longtext,
  `menos_gusto` longtext,
  `sugerencia` longtext,
  `areas_capacitado` longtext,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_opinion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pl_opiniones` */

insert  into `pl_opiniones`(`id_opinion`,`id_modulo`,`mas_gusto`,`menos_gusto`,`sugerencia`,`areas_capacitado`,`f_creacion`,`id_usuario`,`activo`) values (1,10,'Todo','La comida','Otro lugar','- Software','2014-03-31 15:10:49',1,1);

/*Table structure for table `pl_panes_docs` */

DROP TABLE IF EXISTS `pl_panes_docs`;

CREATE TABLE `pl_panes_docs` (
  `id_doc` int(11) NOT NULL auto_increment,
  `id_plan` int(11) NOT NULL,
  `nombre_doc` varchar(100) NOT NULL,
  `archivo` longtext,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pl_panes_docs` */

insert  into `pl_panes_docs`(`id_doc`,`id_plan`,`nombre_doc`,`archivo`,`f_creacion`,`id_usuario`,`activo`) values (1,3,'Doc 1','photodex-presenter-install.log','2014-02-13 22:48:02',1,1),(2,11,'Seminario de Normas','Promocional_Normas.pdf','2014-04-01 14:42:26',3,1),(3,11,'Certificación ACAMS','Promocional_Certificación_ACAMS.pdf','2014-04-01 16:19:46',3,1),(4,11,'Conducción Asambleas','Promocional_Seminario_Taller_-_Conducción_de_Asambleas.pdf','2014-04-01 16:35:58',3,1),(5,11,'Seminario Agentes de Seguridad','Promocional_-_Agentes_de_Seguridad.pdf','2014-04-01 17:44:09',3,1);

/*Table structure for table `pl_planes` */

DROP TABLE IF EXISTS `pl_planes`;

CREATE TABLE `pl_planes` (
  `id_plan` int(11) NOT NULL auto_increment,
  `nombre_plan` longtext,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `id_estado_plan` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_plan`),
  KEY `FK_pl_planes` (`id_estado_plan`),
  CONSTRAINT `FK_pl_planes` FOREIGN KEY (`id_estado_plan`) REFERENCES `mante_estados_planes` (`id_estado_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `pl_planes` */

insert  into `pl_planes`(`id_plan`,`nombre_plan`,`f_creacion`,`id_usuario`,`id_estado_plan`,`activo`) values (3,'Programa de Capacitación 2014','2014-01-31 23:08:41',8,2,0),(4,'Programa de Capacitación 2014','2014-04-01 14:02:51',3,2,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `pl_rubro` */

insert  into `pl_rubro`(`id_rubro`,`id_rubro_name`,`id_modulo`,`f_creacion`,`id_usuario`,`activo`) values (1,2,10,'2014-02-12 21:44:26',1,1),(2,2,11,'2014-03-01 20:26:25',1,1),(3,3,11,'2014-03-01 22:36:10',1,1),(4,2,12,'2014-04-01 14:23:21',3,0);

/*Table structure for table `pl_subrubro` */

DROP TABLE IF EXISTS `pl_subrubro`;

CREATE TABLE `pl_subrubro` (
  `id_subrubro` int(11) NOT NULL auto_increment,
  `id_rubro` int(11) default NULL,
  `nombre` varchar(200) default NULL,
  `unidades` int(11) default '0',
  `dias` int(11) default '0',
  `costo` decimal(12,2) default '0.00',
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_subrubro`),
  KEY `FK_pl_subrubro` (`id_rubro`),
  CONSTRAINT `FK_pl_subrubro` FOREIGN KEY (`id_rubro`) REFERENCES `pl_rubro` (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pl_subrubro` */

insert  into `pl_subrubro`(`id_subrubro`,`id_rubro`,`nombre`,`unidades`,`dias`,`costo`,`f_creacion`,`id_usuario`,`activo`) values (1,1,'Almuerzo',10,0,'2.00','2014-02-12 21:44:43',1,1),(2,2,'desayuno',55,3,'2.00','2014-03-01 22:14:36',1,1),(3,3,'Cuadernos',55,3,'3.00','2014-03-01 22:36:25',1,1),(4,2,'Almuerzos',55,3,'2.00','2014-03-02 20:29:39',1,1),(5,4,'Desayuno',65,2,'2.50','2014-04-01 14:25:08',3,0);

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

insert  into `sitio_slider`(`id_slider`,`nombre_imagen`,`texto_aparecer`,`nombre_archivo`) values (1,'Imagen 1','Capacitación - Asesoría - Consultoría','i2.fw.png'),(2,'Imagen 2','Capacitación - Asesoría - Consultoría','i3.fw.png'),(3,'Imagen 3','Capacitación - Asesoría - Consultoría','i4.fw.png'),(4,'Imagen 4','Capacitación - Asesoría - Consultoría','i5.fw.png');

/*Table structure for table `usu_coop_suc` */

DROP TABLE IF EXISTS `usu_coop_suc`;

CREATE TABLE `usu_coop_suc` (
  `id_usu_coop` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) default NULL,
  `id_cooperativa` int(11) default NULL,
  `id_sucursal` int(11) default NULL,
  PRIMARY KEY  (`id_usu_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `usu_coop_suc` */

insert  into `usu_coop_suc`(`id_usu_coop`,`id_usuario`,`id_cooperativa`,`id_sucursal`) values (9,4,6,0),(10,6,9,0),(11,7,9,0),(17,15,19,0),(24,13,34,13),(25,14,33,0),(27,17,34,0),(28,12,6,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=1092 DEFAULT CHARSET=latin1;

/*Data for the table `usu_permisos_menu` */

insert  into `usu_permisos_menu`(`id_permiso`,`id_subrol`,`id_menu`) values (726,4,1),(727,4,2),(728,4,3),(729,4,5),(730,4,45),(731,4,54),(732,4,55),(733,4,56),(734,4,60),(735,6,1),(736,6,2),(737,6,3),(738,6,5),(739,6,46),(740,6,47),(741,6,50),(742,6,61),(743,6,62),(744,6,10),(745,6,11),(746,6,12),(747,6,40),(748,6,41),(749,6,45),(750,6,57),(751,6,54),(752,6,55),(753,6,56),(754,6,58),(755,6,59),(756,6,60),(757,6,63),(758,7,1),(759,7,2),(760,7,5),(761,7,46),(762,7,47),(763,7,50),(764,7,61),(765,7,62),(766,7,6),(767,7,7),(768,7,64),(769,7,10),(770,7,11),(771,7,12),(772,7,40),(773,7,41),(774,7,45),(775,7,57),(776,7,54),(777,7,55),(778,7,56),(779,7,58),(780,7,59),(781,7,60),(782,7,63),(793,3,40),(794,3,41),(795,3,45),(796,3,57),(797,3,58),(798,3,59),(799,3,60),(859,2,1),(860,2,6),(861,2,7),(862,2,64),(863,2,8),(864,2,9),(865,2,40),(866,2,45),(867,2,60),(999,1,1),(1000,1,2),(1001,1,3),(1002,1,5),(1003,1,46),(1004,1,47),(1005,1,50),(1006,1,61),(1007,1,62),(1008,1,6),(1009,1,7),(1010,1,64),(1011,1,8),(1012,1,9),(1013,1,13),(1014,1,14),(1015,1,15),(1016,1,16),(1017,1,19),(1018,1,27),(1019,1,28),(1020,1,17),(1021,1,21),(1022,1,38),(1023,1,31),(1024,1,33),(1025,1,34),(1026,1,43),(1027,1,44),(1028,1,48),(1029,1,49),(1030,1,51),(1031,1,52),(1032,1,65),(1033,1,54),(1034,1,55),(1035,1,56),(1036,1,58),(1037,1,59),(1038,1,60),(1039,1,63),(1040,1,66),(1041,8,1),(1042,8,2),(1043,8,3),(1044,8,5),(1045,8,46),(1046,8,47),(1047,8,50),(1048,8,61),(1049,8,62),(1050,8,6),(1051,8,7),(1052,8,64),(1053,8,8),(1054,8,9),(1055,8,10),(1056,8,11),(1057,8,12),(1058,8,13),(1059,8,14),(1060,8,15),(1061,8,16),(1062,8,19),(1063,8,27),(1064,8,28),(1065,8,17),(1066,8,21),(1067,8,38),(1068,8,31),(1069,8,33),(1070,8,34),(1071,8,43),(1072,8,44),(1073,8,48),(1074,8,49),(1075,8,51),(1076,8,52),(1077,8,40),(1078,8,41),(1079,8,45),(1080,8,57),(1081,8,53),(1082,8,20),(1083,8,29),(1084,8,54),(1085,8,55),(1086,8,56),(1087,8,58),(1088,8,59),(1089,8,60),(1090,8,63),(1091,8,66);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `usu_rol` */

insert  into `usu_rol`(`id_rol`,`id_tipo_usuario`,`rol`,`estado`) values (1,1,'Administrador del Sistema',1),(2,2,'Cliente',1),(3,1,'Consultor y/o Asesor',1),(4,1,'Administrador Curricula',1),(5,1,'Administrador del Plan',1),(6,1,'Usuarios Facilitadores',1),(7,1,'Gestor de cobro y apoyo',1);

/*Table structure for table `usu_subrol` */

DROP TABLE IF EXISTS `usu_subrol`;

CREATE TABLE `usu_subrol` (
  `id_subrol` int(11) NOT NULL auto_increment,
  `id_rol` int(11) default NULL,
  `subrol` longtext,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_subrol`),
  KEY `FK_usu_subrol` (`id_rol`),
  CONSTRAINT `FK_usu_subrol` FOREIGN KEY (`id_rol`) REFERENCES `usu_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `usu_subrol` */

insert  into `usu_subrol`(`id_subrol`,`id_rol`,`subrol`,`estado`) values (1,1,'Administrador',1),(2,3,'Consultores y Asesores Con',1),(3,2,'Gerente',1),(4,6,'Facilitador',1),(5,7,'Asesor-Interno',0),(6,5,'Técnico Plan de Capacitac',1),(7,7,'Cobro y Apoyo',1),(8,1,'Administrador Especial',1);

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
  `exigir` int(11) default '0',
  PRIMARY KEY  (`id_usuario`),
  KEY `FK_usu_usuario` (`id_subrol`),
  CONSTRAINT `FK_usu_usuario` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `usu_usuario` */

insert  into `usu_usuario`(`id_usuario`,`usuario`,`clave`,`nombre_completo`,`telefono`,`celular`,`direccion`,`correo`,`ultimo_acceso`,`estado`,`id_subrol`,`activo`,`exigir`) values (1,'llievano','e10adc3949ba59abbe56e057f20f883e','Luis Lievano','22222222','','dkfjkdsjfk','','2014-04-01 11:59:44',1,4,1,1),(2,'pgarrido','e10adc3949ba59abbe56e057f20f883e','Patricia Garrido','25553563','','9re98r9488dvkfckf','patricia.garrido@fedecaces.com','2014-04-01 12:57:25',1,6,1,0),(3,'Administrador','9450476b384b32d8ad8b758e76c98a69','Raúl Eduardo Mauricio Campos','25553560','78741657',NULL,'raul.mauricio@fedecaces.com','2014-04-07 22:15:17',1,1,1,0),(4,'nvasquez','e10adc3949ba59abbe56e057f20f883e','Nelson Vásquez','25553565','',NULL,'nelson.vasquez@fedecaces.com','2013-07-23 11:42:19',1,2,1,1),(5,'jnavarrete','e10adc3949ba59abbe56e057f20f883e','Jaime Arturo Navarrete','25553563','',NULL,'jaime.navarrete@fedecaces.com',NULL,1,2,1,1),(6,'srivera','e10adc3949ba59abbe56e057f20f883e','Noé Saúl Rivera','25553591','',NULL,'saul.rivera@fedecaces.com','2013-11-06 17:42:32',1,2,1,1),(7,'mvasquez','e10adc3949ba59abbe56e057f20f883e','Mineth Vasquez','25553561','',NULL,'gerencia@asesoresparaeldesarrollo.com','2014-03-05 22:02:44',1,7,1,1),(8,'frivera','e10adc3949ba59abbe56e057f20f883e','Fernando Rivera','25553592','',NULL,'fernando.rivera@asesoresparaeldesarrollo.com','2014-02-16 20:14:28',1,2,1,1),(9,'glopez','e10adc3949ba59abbe56e057f20f883e','Gladis Lopez','25553564','',NULL,'gladis.lopez@asesoresparaeldesarrollo.com','2014-02-13 23:32:02',1,6,1,1),(10,'mmolina','249ba3301069177fc9380feeedb6d396','Moris Molina','25553565','',NULL,'moris.molina@fedecaces.com','2014-03-31 16:01:01',1,2,1,1),(11,'vcisneros','e10adc3949ba59abbe56e057f20f883e','Vilma del Carmen Cisneros','25553563','',NULL,'vilma.cisneros@fedecaces.com',NULL,1,4,1,1),(12,'ehenriquez','e10adc3949ba59abbe56e057f20f883e','Eric Henriquez','23339134','78599641',NULL,'gerencia.acacypac@fedecaces.com','2014-05-05 23:55:34',1,3,1,0),(13,'funes1','7c687bcfb658fb63a706b4d8dba14d75','Linda Claudia Funes','22211438','79273870',NULL,'gerencia.electra@fedecaces.com','2014-04-02 10:05:17',1,3,1,0),(14,'mineth','b24bbbf00b2b4fc46ca9d32087feb573','Minetilla','22222222','',NULL,'','2014-04-01 16:13:08',1,3,1,0),(15,'cisneros','e10adc3949ba59abbe56e057f20f883e','Vilma','2222222','',NULL,'',NULL,1,3,1,1),(16,'Admin','202cb962ac59075b964b07152d234b70','Sergio Doradea','2358956','',NULL,'','2014-05-07 20:01:05',1,8,1,0),(17,'usudemo','e10adc3949ba59abbe56e057f20f883e','Usuario Demo','2562325','',NULL,'','2014-04-07 22:42:03',1,3,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
