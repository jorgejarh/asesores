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

/*Table structure for table `cap_capacitacion` */

DROP TABLE IF EXISTS `cap_capacitacion`;

CREATE TABLE `cap_capacitacion` (
  `id_capacitacion` int(11) NOT NULL auto_increment,
  `id_tipo_capacitacion` int(11) default NULL,
  `id_estado` int(11) default NULL,
  `capacitacion` varchar(300) default NULL,
  `costo` double(6,2) default NULL,
  `punto_equilibrio` int(11) default NULL,
  `fecha_creacion` date default NULL,
  `fecha_inicio_propuesta` date default NULL,
  `fecha_fin_propuesta` date default NULL,
  `fecha_inicio_real` date default NULL,
  `fecha_fin_real` date default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_capacitacion`),
  KEY `fk_cap_capacitacion_cap_estado1` (`id_estado`),
  KEY `fk_cap_capacitacion_cap_tipo_capacitacion1` (`id_tipo_capacitacion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cap_capacitacion` */

/*Table structure for table `cap_estado` */

DROP TABLE IF EXISTS `cap_estado`;

CREATE TABLE `cap_estado` (
  `id_estado` int(11) NOT NULL auto_increment,
  `estado` varchar(50) default NULL,
  PRIMARY KEY  (`id_estado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cap_estado` */

/*Table structure for table `cap_tipo_capacitacion` */

DROP TABLE IF EXISTS `cap_tipo_capacitacion`;

CREATE TABLE `cap_tipo_capacitacion` (
  `id_tipo_capacitacion` int(11) NOT NULL auto_increment,
  `tipo_capacitacion` varchar(50) default NULL,
  PRIMARY KEY  (`id_tipo_capacitacion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cap_tipo_capacitacion` */

/*Table structure for table `causa_inf` */

DROP TABLE IF EXISTS `causa_inf`;

CREATE TABLE `causa_inf` (
  `id_causa_inf` int(11) NOT NULL auto_increment,
  `causa_inf` varchar(50) default NULL,
  PRIMARY KEY  (`id_causa_inf`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='	';

/*Data for the table `causa_inf` */

insert  into `causa_inf`(`id_causa_inf`,`causa_inf`) values (1,'Docente');

/*Table structure for table `causas` */

DROP TABLE IF EXISTS `causas`;

CREATE TABLE `causas` (
  `id_causa` int(11) NOT NULL auto_increment,
  `causa` varchar(100) default NULL,
  PRIMARY KEY  (`id_causa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `causas` */

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
  PRIMARY KEY  (`id_cooperativa`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `conf_cooperativa` */

insert  into `conf_cooperativa`(`id_cooperativa`,`cooperativa`,`ubicacion`,`telefono`,`fax`,`email`,`credito_fiscal`,`logotipo`) values (9,'ACACCIBA','Central','2618 2427',NULL,'gerencia.acacciba@fedecaces.com',NULL,'logos/logo_acacciba.png'),(6,'ACODJAR DE R.L.','Central','2333 7400','2333 7406','gerencia.acodjar@fedecaces.com',NULL,'logos/logo_acodjar.png'),(10,'ACACEMIHA DE R.L.','Central','2272 6527',NULL,'acacemiha@fedecaces.com',NULL,'logos/logo_acacemiha.png'),(19,'ACACES DE R.L.','daf','2288 2103','','info@acaces.com.sv','23',NULL);

/*Table structure for table `conf_menu` */

DROP TABLE IF EXISTS `conf_menu`;

CREATE TABLE `conf_menu` (
  `id_menu` int(11) NOT NULL auto_increment,
  `nombre_menu` varchar(200) default NULL,
  `id_padre` int(11) default '0',
  `url` varchar(150) default '#',
  `activo` int(11) default '1',
  PRIMARY KEY  (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `conf_menu` */

insert  into `conf_menu`(`id_menu`,`nombre_menu`,`id_padre`,`url`,`activo`) values (1,'Servicios',0,'#',1),(2,'Capacitaciones',1,'#',1),(3,'Curricula',2,'curriculas',1),(4,'Perfiles',2,'perfiles',1),(5,'Plan de Capacitaciones',2,'plan',1),(6,'Asesorias',1,'#',1),(7,'Asesoria 1',6,'#',1),(8,'Consultoria',1,'#',1),(9,'Consultoria 1',8,'#',1),(10,'Reportes',0,'#',1),(11,'Dashboard',10,'#',1),(12,'Pagos',10,'#',1),(13,'Configuracion del sistema',0,'#',1),(14,'Usuarios',13,'users',1),(15,'Usuarios Clientes',14,'#',1),(16,'Usuarios Internos',14,'#',1),(17,'Cooperativas',13,'cooperativas',1),(18,'Sistema',13,'conf_sistema',1),(19,'Roles',13,'roles',1),(20,'Gestion de Menu',13,'conf_menu',1),(21,'Sucursales',13,'sucursales',1);

/*Table structure for table `conf_modulo` */

DROP TABLE IF EXISTS `conf_modulo`;

CREATE TABLE `conf_modulo` (
  `id_modulo` int(11) NOT NULL auto_increment,
  `modulo` varchar(50) default NULL,
  `orden` int(11) default NULL,
  `url` varchar(50) default NULL,
  PRIMARY KEY  (`id_modulo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `conf_modulo` */

insert  into `conf_modulo`(`id_modulo`,`modulo`,`orden`,`url`) values (1,'Capacitaciones',1,NULL),(2,'Asesorias',2,NULL),(3,'Consultorias',3,NULL),(4,'Reportes',4,NULL),(5,'Configuracion del sistema',5,NULL);

/*Table structure for table `conf_opcion` */

DROP TABLE IF EXISTS `conf_opcion`;

CREATE TABLE `conf_opcion` (
  `id_opcion` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) default NULL,
  `opcion` varchar(50) default NULL,
  `url` varchar(300) default NULL,
  `estado` tinyint(1) default '1',
  PRIMARY KEY  (`id_opcion`),
  KEY `fk_conf_opcion_conf_modulo` (`id_modulo`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `conf_opcion` */

insert  into `conf_opcion`(`id_opcion`,`id_modulo`,`opcion`,`url`,`estado`) values (1,1,'Curricula','curriculas',1),(2,1,'Perfiles','perfiles',1),(3,2,'Asesoría','#',1),(4,2,'Asesoria: -2','#',1),(5,3,'Consultorias: -1','#',1),(6,3,'Consultorias: -2','#',1),(7,4,'Dashboard','#',1),(8,4,'Pagos','#',1),(9,5,'Usuarios','users',1),(10,5,'Cooperativas','cooperativas',1),(11,5,'Sistema','conf_sistema',1),(12,1,'Plan de Capacitaciones','plan',1);

/*Table structure for table `conf_recurso` */

DROP TABLE IF EXISTS `conf_recurso`;

CREATE TABLE `conf_recurso` (
  `id_recurso` int(11) NOT NULL auto_increment,
  `id_tipo_recurso` int(11) default NULL,
  `recurso` varchar(150) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_recurso`),
  KEY `fk_conf_recurso_conf_tipo_recurso1` (`id_tipo_recurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `conf_recurso` */

/*Table structure for table `conf_sucursal` */

DROP TABLE IF EXISTS `conf_sucursal`;

CREATE TABLE `conf_sucursal` (
  `id_sucursal` int(10) NOT NULL auto_increment,
  `id_cooperativa` int(10) NOT NULL,
  `sucursal` varchar(100) default NULL,
  PRIMARY KEY  (`id_sucursal`),
  KEY `fk_conf_sucursal_conf_cooperativa1` (`id_cooperativa`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `conf_sucursal` */

insert  into `conf_sucursal`(`id_sucursal`,`id_cooperativa`,`sucursal`) values (5,7,'fff111111111'),(6,6,'San Vicente');

/*Table structure for table `conf_tipo_recurso` */

DROP TABLE IF EXISTS `conf_tipo_recurso`;

CREATE TABLE `conf_tipo_recurso` (
  `id_tipo_recurso` int(11) NOT NULL auto_increment,
  `tipo_recurso` varchar(50) default NULL,
  PRIMARY KEY  (`id_tipo_recurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `conf_tipo_recurso` */

/*Table structure for table `cu_curricula` */

DROP TABLE IF EXISTS `cu_curricula`;

CREATE TABLE `cu_curricula` (
  `id_curricula` int(11) NOT NULL auto_increment,
  `curricula` varchar(100) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_curricula`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cu_curricula` */

insert  into `cu_curricula`(`id_curricula`,`curricula`,`estado`) values (5,'Curricula 2',1),(2,'Curricula General',1);

/*Table structure for table `cu_detalle_sugerenia` */

DROP TABLE IF EXISTS `cu_detalle_sugerenia`;

CREATE TABLE `cu_detalle_sugerenia` (
  `id_detalle_sugerenia` int(11) NOT NULL auto_increment,
  `id_sugerencia` int(11) default NULL,
  `id_perfil` int(11) default NULL,
  `detalle` varchar(300) default NULL,
  PRIMARY KEY  (`id_detalle_sugerenia`),
  KEY `fk_cu_detalle_sugerenia_cu_sugerencia_metodologica1` (`id_sugerencia`),
  KEY `fk_cu_detalle_sugerenia_cu_perfil1` (`id_perfil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cu_detalle_sugerenia` */

/*Table structure for table `cu_nivel_logro` */

DROP TABLE IF EXISTS `cu_nivel_logro`;

CREATE TABLE `cu_nivel_logro` (
  `id_nivel_logro` int(11) NOT NULL auto_increment,
  `id_competencia` int(11) default NULL,
  `nivel_logro` text,
  PRIMARY KEY  (`id_nivel_logro`),
  KEY `fk_cu_nivel_logro_cu_unidad_competencia1` (`id_competencia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cu_nivel_logro` */

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
  KEY `fk_cu_perfil_cu_curricula1` (`id_curricula`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil` */

insert  into `cu_perfil`(`id_perfil`,`id_curricula`,`perfil`,`aspectos_generales`,`objetivos`,`duracion`,`fecha`) values (1,2,'Cajero',NULL,NULL,NULL,'2013-01-29'),(4,2,'OFICIALES DE CREDITO',NULL,NULL,NULL,'0000-00-00');

/*Table structure for table `cu_perfil_contenido_aspectos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_aspectos`;

CREATE TABLE `cu_perfil_contenido_aspectos` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_aspectos` */

insert  into `cu_perfil_contenido_aspectos`(`id`,`nombre`,`id_perfil`) values (7,'Área de Formación: Filosofía Institucional y Servicios que presta la cooperativa',1),(8,'ASPECTO 1',4);

/*Table structure for table `cu_perfil_contenido_b_material_apoyo` */

DROP TABLE IF EXISTS `cu_perfil_contenido_b_material_apoyo`;

CREATE TABLE `cu_perfil_contenido_b_material_apoyo` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_b_material_apoyo` */

insert  into `cu_perfil_contenido_b_material_apoyo`(`id`,`nombre`,`id_perfil`) values (1,'Valores y principios cooperativos',1),(2,'Reglamento de la ley general de asociaciones cooperativas',1),(3,'Ley de intermediarios financieros no bancarios',1);

/*Table structure for table `cu_perfil_contenido_niveles_logro` */

DROP TABLE IF EXISTS `cu_perfil_contenido_niveles_logro`;

CREATE TABLE `cu_perfil_contenido_niveles_logro` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_niveles_logro` */

insert  into `cu_perfil_contenido_niveles_logro`(`id`,`nombre`,`id_perfil`) values (1,'Menciona la visión y misión de la cooperativa y como su puesto de trabajo contribuye al logro de la misma',1),(2,'Enumera cuales son los servicios que presta la cooperativa',1),(3,'Declara el nombre de la persona de cada área de la cooperativa a quien puede referir a los usuarios',1),(4,'Enumera las entidades para quienes puede recibir pagos de parte de los usuarios',1),(5,'Se encuentra actualizado con la información sobre las variaciones que pueden sufrir las tasas de interés en la cooperativa',1);

/*Table structure for table `cu_perfil_contenido_objetivos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_objetivos`;

CREATE TABLE `cu_perfil_contenido_objetivos` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_objetivos` */

insert  into `cu_perfil_contenido_objetivos`(`id`,`nombre`,`id_perfil`) values (5,'Dar a conocer la filosofía institucional que rige la cooperativa con el propósito que el nuevo miembro adopte aptitudes y valores propios del cooperativismo',1),(6,'Transmitir los principios fundamentales para establecer un modo de vida cooperativista',1),(7,'Dar a conocer los servicios que brinda la cooperativa a fin de que el participante los identifique',1);

/*Table structure for table `cu_perfil_contenido_recursos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_recursos`;

CREATE TABLE `cu_perfil_contenido_recursos` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_recursos` */

insert  into `cu_perfil_contenido_recursos`(`id`,`nombre`,`id_perfil`) values (1,'Computadora',1),(2,'Laptop',1),(3,'Puntero',1),(4,'Papelográfo',1),(6,'Pizarra Acrílica',1),(7,'Plumones',1),(8,'Presentaciones',1),(9,'Fotografía o videos',1);

/*Table structure for table `cu_perfil_contenido_sugerencias_metodologicas` */

DROP TABLE IF EXISTS `cu_perfil_contenido_sugerencias_metodologicas`;

CREATE TABLE `cu_perfil_contenido_sugerencias_metodologicas` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_sugerencias_metodologicas` */

insert  into `cu_perfil_contenido_sugerencias_metodologicas`(`id`,`nombre`,`id_perfil`) values (1,'Actividades de Inducción:',1),(2,'Se sugiere la dinámica \"corazones\" para romper el hielo',1),(3,'Desarrollo de Contenido',1);

/*Table structure for table `cu_perfil_contenido_unidades_competencia` */

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_competencia`;

CREATE TABLE `cu_perfil_contenido_unidades_competencia` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_unidades_competencia` */

insert  into `cu_perfil_contenido_unidades_competencia`(`id`,`nombre`,`id_perfil`) values (2,'Conoce la filosofía organizacional de la cooperativa',1),(3,'Domina información básica de los servicios que presta la cooperativa',1),(4,'Identifica las personas encargadas de brindar detalles sobre los servicios que proporciona la cooperativa a fin de orientar adecuadamente a los usuarios que consulten',1),(5,'Identificar las entidades clientes de la cooperativa de quienes se puede aceptar pago por parte de los usuarios',1),(6,'Dispone de información actualizada sobre las tasas de interés de la cooperativa',1);

/*Table structure for table `cu_perfil_contenido_unidades_contenido` */

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_contenido`;

CREATE TABLE `cu_perfil_contenido_unidades_contenido` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_perfil` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_unidades_contenido` */

insert  into `cu_perfil_contenido_unidades_contenido`(`id`,`nombre`,`id_perfil`) values (1,'Historia del cooperativismo en El Salvador',1),(2,'Identidad Cooperativa',1),(3,'Historia de la Federación',1),(4,'Filosofía Institucional',1),(5,'Servicios que presta la Cooperativa',1);

/*Table structure for table `cu_perfil_recurso` */

DROP TABLE IF EXISTS `cu_perfil_recurso`;

CREATE TABLE `cu_perfil_recurso` (
  `id_perfil_recurso` int(11) NOT NULL auto_increment,
  `id_perfil` int(11) default NULL,
  `id_recurso` int(11) default NULL,
  PRIMARY KEY  (`id_perfil_recurso`),
  KEY `fk_cu_perfil_recurso_cu_perfil1` (`id_perfil`),
  KEY `fk_cu_perfil_recurso_conf_recurso1` (`id_recurso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_recurso` */

/*Table structure for table `cu_sugerencia_metodologica` */

DROP TABLE IF EXISTS `cu_sugerencia_metodologica`;

CREATE TABLE `cu_sugerencia_metodologica` (
  `id_sugerencia` int(11) NOT NULL auto_increment,
  `sugerencia` varchar(300) default NULL,
  PRIMARY KEY  (`id_sugerencia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cu_sugerencia_metodologica` */

/*Table structure for table `cu_tablas_contenido` */

DROP TABLE IF EXISTS `cu_tablas_contenido`;

CREATE TABLE `cu_tablas_contenido` (
  `id_tabla_contenido` int(11) NOT NULL auto_increment,
  `nombre_tabla` varchar(100) default NULL,
  `id_tabla` varchar(100) default NULL,
  `nombre_contenido` varchar(100) default NULL,
  PRIMARY KEY  (`id_tabla_contenido`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cu_tablas_contenido` */

insert  into `cu_tablas_contenido`(`id_tabla_contenido`,`nombre_tabla`,`id_tabla`,`nombre_contenido`) values (1,'cu_perfil_contenido_aspectos','id_aspecto','Aspectos Generales'),(2,'cu_perfil_contenido_objetivos','id_objetivo','Objetivos'),(3,'cu_perfil_contenido_unidades_competencia',NULL,'Unidades de competencia'),(4,'cu_perfil_contenido_niveles_logro',NULL,'Niveles de logro'),(5,'cu_perfil_contenido_unidades_contenido',NULL,'Unidades de contenido'),(6,'cu_perfil_contenido_sugerencias_metodologicas',NULL,'Sugerencias metodologicas'),(7,'cu_perfil_contenido_recursos',NULL,'Recursos'),(8,'cu_perfil_contenido_b_material_apoyo',NULL,'Bibliografía y material de apoyo');

/*Table structure for table `cu_unidad_competencia` */

DROP TABLE IF EXISTS `cu_unidad_competencia`;

CREATE TABLE `cu_unidad_competencia` (
  `id_competencia` int(11) NOT NULL auto_increment,
  `id_perfil` int(11) default NULL,
  `competencia` varchar(300) default NULL,
  PRIMARY KEY  (`id_competencia`),
  KEY `fk_cu_unidad_competencia_cu_perfil1` (`id_perfil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cu_unidad_competencia` */

/*Table structure for table `cu_unidad_contenido` */

DROP TABLE IF EXISTS `cu_unidad_contenido`;

CREATE TABLE `cu_unidad_contenido` (
  `id_unidad` int(11) NOT NULL auto_increment,
  `id_perfil` int(11) default NULL,
  `unidad` varchar(300) default NULL,
  PRIMARY KEY  (`id_unidad`),
  KEY `fk_cu_unidad_contenido_cu_perfil1` (`id_perfil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cu_unidad_contenido` */

/*Table structure for table `encuesta` */

DROP TABLE IF EXISTS `encuesta`;

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL auto_increment,
  `retiro_ciclo` int(11) default NULL,
  `id_causa` int(11) default NULL,
  `influyo_utec` int(11) default NULL,
  `esta_ins` int(11) default NULL,
  `id_causa_inf` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `encuesta` */

/*Table structure for table `pl_plan` */

DROP TABLE IF EXISTS `pl_plan`;

CREATE TABLE `pl_plan` (
  `id_plan` int(11) NOT NULL,
  `pl_plan` varchar(45) default NULL,
  `pl_fecha` datetime default NULL,
  `pl_estado` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `pl_plan` */

/*Table structure for table `usu_permisos` */

DROP TABLE IF EXISTS `usu_permisos`;

CREATE TABLE `usu_permisos` (
  `id_permisos` int(11) NOT NULL auto_increment,
  `id_subrol` int(11) default NULL,
  `id_opcion` int(11) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_permisos`),
  KEY `fk_usu_permisos_usu_subrol1` (`id_subrol`),
  KEY `fk_usu_permisos_conf_opcion1` (`id_opcion`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `usu_permisos` */

insert  into `usu_permisos`(`id_permisos`,`id_subrol`,`id_opcion`,`estado`) values (1,1,1,1),(2,1,2,1),(3,1,3,1),(4,1,4,1),(5,1,5,1),(6,1,6,1),(7,1,7,1),(8,1,8,1),(9,1,9,1),(10,1,10,1),(11,2,7,1),(12,2,8,1),(13,3,7,1),(14,3,8,1),(15,4,7,1),(16,4,8,1),(17,1,11,1),(18,1,12,1);

/*Table structure for table `usu_permisos_menu` */

DROP TABLE IF EXISTS `usu_permisos_menu`;

CREATE TABLE `usu_permisos_menu` (
  `id_permiso` int(11) NOT NULL auto_increment,
  `id_subrol` int(11) default NULL,
  `id_menu` int(11) default NULL,
  PRIMARY KEY  (`id_permiso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `usu_permisos_menu` */

/*Table structure for table `usu_rol` */

DROP TABLE IF EXISTS `usu_rol`;

CREATE TABLE `usu_rol` (
  `id_rol` int(11) NOT NULL auto_increment,
  `rol` varchar(25) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_rol`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `usu_rol` */

insert  into `usu_rol`(`id_rol`,`rol`,`estado`) values (1,'Administrador del Sistema',1),(2,'Cliente',1),(3,'Consultor y/o Asesor',1),(4,'Administrador Curricula',1),(5,'Administrador del Plan',1);

/*Table structure for table `usu_subrol` */

DROP TABLE IF EXISTS `usu_subrol`;

CREATE TABLE `usu_subrol` (
  `id_subrol` int(11) NOT NULL auto_increment,
  `id_rol` int(11) default NULL,
  `subrol` varchar(25) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id_subrol`),
  KEY `fk_usu_subrol_usu_rol1` (`id_rol`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `usu_subrol` */

insert  into `usu_subrol`(`id_subrol`,`id_rol`,`subrol`,`estado`) values (1,1,'Admin',1),(2,2,'Federacion',1),(3,2,'Cooperativa',1),(4,2,'Sucursal',1);

/*Table structure for table `usu_usuario` */

DROP TABLE IF EXISTS `usu_usuario`;

CREATE TABLE `usu_usuario` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `id_rol` int(11) default NULL,
  `usuario` varchar(50) default NULL,
  `clave` varchar(50) default NULL,
  `nombre_completo` varchar(200) default NULL,
  `telefono` varchar(20) default NULL,
  `celular` varchar(20) default NULL,
  `direccion` text,
  `ultimo_acceso` datetime default NULL,
  `estado` int(11) default NULL,
  `id_subrol` int(11) default NULL,
  PRIMARY KEY  (`id_usuario`),
  KEY `fk_usu_usuario_usu_subrol1` (`id_rol`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `usu_usuario` */

insert  into `usu_usuario`(`id_usuario`,`id_rol`,`usuario`,`clave`,`nombre_completo`,`telefono`,`celular`,`direccion`,`ultimo_acceso`,`estado`,`id_subrol`) values (1,1,'admin','202cb962ac59075b964b07152d234b70','Admin-2','12345','12345','dkfjkdsjfk','2013-05-23 23:42:11',0,1),(2,1,'rolan','202cb962ac59075b964b07152d234b70','Rolando Medrano','43434','495849584','9re98r9488dvkfckf',NULL,0,1),(3,1,'sdoradea','1234','Sergio','434','34324',NULL,NULL,0,1),(4,2,'usu3','123','Usuario 3','','',NULL,NULL,1,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
