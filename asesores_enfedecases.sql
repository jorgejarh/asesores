/*
SQLyog Ultimate v8.82 
MySQL - 5.6.16 : Database - asesores
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

/*Table structure for table `abono_x_cooperativa` */

DROP TABLE IF EXISTS `abono_x_cooperativa`;

CREATE TABLE `abono_x_cooperativa` (
  `id_abono` int(11) NOT NULL AUTO_INCREMENT,
  `id_cooperativa` int(11) DEFAULT NULL,
  `abono` decimal(18,2) DEFAULT '0.00',
  `fecha_creacion` datetime DEFAULT NULL,
  `id_usuario_add` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_abono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abono_x_cooperativa` */

/*Table structure for table `abono_x_cooperativa_detalle` */

DROP TABLE IF EXISTS `abono_x_cooperativa_detalle`;

CREATE TABLE `abono_x_cooperativa_detalle` (
  `id_nota_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota_cargo` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`id_nota_detalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abono_x_cooperativa_detalle` */

/*Table structure for table `abonos_cooperativas` */

DROP TABLE IF EXISTS `abonos_cooperativas`;

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
  KEY `id_capacitacion` (`id_capacitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `abonos_cooperativas` */

insert  into `abonos_cooperativas`(`id_abono`,`id_cooperativa`,`id_capacitacion`,`abono`,`f_creacion`,`id_usuario`,`activo`) values (1,9,7,'30.00','2014-03-31 15:11:18',1,1);

/*Table structure for table `asesoria_bitacora` */

DROP TABLE IF EXISTS `asesoria_bitacora`;

CREATE TABLE `asesoria_bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad` int(11) NOT NULL,
  `observaciones` longtext,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_bitacora`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_bitacora` */

insert  into `asesoria_bitacora`(`id_bitacora`,`id_actividad`,`observaciones`,`fecha_inicio`,`fecha_fin`,`id_usuario`,`f_creacion`,`activo`) values (1,1,'observacion 1','2014-03-03','2014-03-29',1,'2014-03-23 17:40:57',1),(2,1,'ffff','2014-03-14','2014-03-15',1,'2014-03-23 17:41:13',1),(3,4,'Realice trabajo de investigación y levantamiento de datos','2014-03-24','2014-03-31',1,'2014-03-31 15:08:12',1),(4,6,'- Se necesita trabajar en areas de promoción de productos','2014-04-03','2014-03-03',10,'2014-03-31 16:24:36',1),(5,6,'- No estaban listos los estados de resultados','2014-04-02','2014-04-02',10,'2014-03-31 16:26:31',1);

/*Table structure for table `asesoria_proyectos` */

DROP TABLE IF EXISTS `asesoria_proyectos`;

CREATE TABLE `asesoria_proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `nombre_proyecto` longtext,
  `cantidad_tiempo_estimado` int(11) DEFAULT NULL,
  `nombre_tiempo_estimado` varchar(200) DEFAULT NULL,
  `inversion` decimal(18,2) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_proyectos` */

insert  into `asesoria_proyectos`(`id_proyecto`,`id_servicio`,`fecha_inicio`,`fecha_fin`,`nombre_proyecto`,`cantidad_tiempo_estimado`,`nombre_tiempo_estimado`,`inversion`,`f_creacion`,`id_usuario`,`activo`) values (1,1,'2014-03-18','2014-03-28','Proyecto 1',10,'days',NULL,'2014-03-18 21:34:21',1,1),(2,1,'2014-03-22','2014-09-22','Proyecto 2',6,'months',NULL,'2014-03-18 22:27:35',1,1),(3,2,'2014-04-01','2015-04-01','Asesoría en administración y finanzas',1,'years','4200.00','2014-03-31 16:11:25',10,1);

/*Table structure for table `asesoria_proyectos_actividades` */

DROP TABLE IF EXISTS `asesoria_proyectos_actividades`;

CREATE TABLE `asesoria_proyectos_actividades` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(11) NOT NULL,
  `nombre_actividad` longtext,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `resultado_esperado` longtext,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_proyectos_actividades` */

insert  into `asesoria_proyectos_actividades`(`id_actividad`,`id_proyecto`,`nombre_actividad`,`fecha_inicio`,`fecha_fin`,`resultado_esperado`,`id_usuario`,`f_creacion`,`activo`) values (1,1,'Actividad 1','2014-04-08','2014-04-08','Terminar la Inspeccion',1,'2014-03-18 23:55:51',1),(2,1,'actividad 2','2014-03-27','1969-12-31','Otra actividad',1,'2014-03-18 23:56:48',1),(3,1,'actividad 3','2014-03-27','2014-03-31','Otra',1,'2014-03-18 23:59:33',1),(4,2,'Actividad 5','2014-03-24','2014-03-27','dddd',1,'2014-03-19 00:03:28',1),(5,2,'Actividad X','2014-03-31','2014-04-02','- Informe\r\n- Liquidación de gastos',1,'2014-03-31 15:07:08',1),(6,3,'Entrevista con el gerente','2014-04-02','2014-04-02','- Informe de planificación del proyecto.',10,'2014-03-31 16:14:57',1),(7,3,'Reforzar area de ventas','2014-05-05','2014-05-30','- Informe de refuerzo',10,'2014-03-31 16:19:14',1),(8,3,'Refuerzo area de mercadeo','2014-06-02','2014-07-31','- Informe de area de mercadeo\r\n',10,'2014-03-31 16:19:53',1);

/*Table structure for table `asesoria_recomendaciones` */

DROP TABLE IF EXISTS `asesoria_recomendaciones`;

CREATE TABLE `asesoria_recomendaciones` (
  `id_recomendacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad` int(11) NOT NULL,
  `fecha_recomendacion` date DEFAULT NULL,
  `nombre_recomendacion` longtext,
  `descripcion_recomendacion` longtext,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_recomendacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_recomendaciones` */

insert  into `asesoria_recomendaciones`(`id_recomendacion`,`id_actividad`,`fecha_recomendacion`,`nombre_recomendacion`,`descripcion_recomendacion`,`id_usuario`,`f_creacion`,`activo`) values (1,1,'2014-03-27','Recomendacion 1','Observaciones..\r\n',1,'2014-03-23 19:26:42',1),(2,7,'2014-05-02','Enfocar servicio a más areas de atencion de la cooperativa','El area de ventas no tiene personal adecuado o capacitado en al area de productos',10,'2014-03-31 16:28:33',1);

/*Table structure for table `asesoria_servicios` */

DROP TABLE IF EXISTS `asesoria_servicios`;

CREATE TABLE `asesoria_servicios` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_solicitante` int(11) NOT NULL,
  `id_cooperativa` int(11) DEFAULT '0',
  `nombre_solicitante` longtext,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_servicios` */

insert  into `asesoria_servicios`(`id_servicio`,`id_tipo_solicitante`,`id_cooperativa`,`nombre_solicitante`,`f_creacion`,`id_usuario`,`activo`) values (1,1,9,'ACACCIBA','2014-03-16 17:22:21',1,1),(2,1,20,'ACODEZO DE R.L.','2014-03-31 16:07:48',10,1);

/*Table structure for table `asesoria_tecnicos_x_proyecto` */

DROP TABLE IF EXISTS `asesoria_tecnicos_x_proyecto`;

CREATE TABLE `asesoria_tecnicos_x_proyecto` (
  `id_tecnico_asignado` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(11) NOT NULL,
  `id_facilitador` int(11) NOT NULL,
  PRIMARY KEY (`id_tecnico_asignado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_tecnicos_x_proyecto` */

insert  into `asesoria_tecnicos_x_proyecto`(`id_tecnico_asignado`,`id_proyecto`,`id_facilitador`) values (3,1,2),(4,2,2),(5,3,3),(7,2,3);

/*Table structure for table `asesoria_tipos_solicitantes` */

DROP TABLE IF EXISTS `asesoria_tipos_solicitantes`;

CREATE TABLE `asesoria_tipos_solicitantes` (
  `id_tipo_solicitante` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_solicitante` longtext NOT NULL,
  PRIMARY KEY (`id_tipo_solicitante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `asesoria_tipos_solicitantes` */

insert  into `asesoria_tipos_solicitantes`(`id_tipo_solicitante`,`tipo_solicitante`) values (1,'Afiliado'),(2,'No afiliado');

/*Table structure for table `conf_cooperativa` */

DROP TABLE IF EXISTS `conf_cooperativa`;

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
  `gerente` longtext,
  PRIMARY KEY (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `conf_cooperativa` */

insert  into `conf_cooperativa`(`id_cooperativa`,`cooperativa`,`ubicacion`,`telefono`,`fax`,`email`,`credito_fiscal`,`logotipo`,`activo`,`id_usuario`,`f_creacion`,`gerente`) values (1,'ACACYPAC NC de R.L.','Ninguna','','','gerencia.acacypac@fedecaces.com','123456','logos/ACACYPAC.JPG',1,NULL,NULL,'Carlos Tobar'),(6,'ACODJAR DE R.L.','Central','2333 7400','2333 7406','gerencia.acodjar@fedecaces.com','236548','logos/logo_acodjar.png',1,NULL,NULL,''),(9,'ACACCIBA','Central','2618 2427','2333 7406','gerencia.acacciba@fedecaces.com','236549','logos/logo_acacciba.png',1,NULL,NULL,NULL),(10,'ACACEMIHA DE R.L.','Central','2272 6527','2333 7406','acacemiha@fedecaces.com','236550','logos/logo_acacemiha.png',1,NULL,NULL,'Licda. Ana Elvia Lara de Martínez'),(19,'ACACES DE R.L.','daf','2288 2103','2333 7406','info@acaces.com.sv','236551','logos/ACACES.JPG',1,NULL,NULL,NULL),(20,'ACODEZO DE R.L.','San Miguel','26693314','','gerencia.acodezo@fedecaces.com','12','logos/utec-logo.png',1,NULL,NULL,'Ronald Beltrán'),(21,'ACAYCCOMAC DE R.L.','','','','','12345','logos/ACAYCOMA.JPG',1,NULL,NULL,'Gloria Paz'),(22,'ACOPACC DE R.L.','','','','','123','logos/ACOPACC.BMP',1,NULL,NULL,'Ena Maldonado'),(23,'ACAPRODUSCA DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(24,'ACACU DE R.L.','','','','','123','logos/ACACU.JPG',1,NULL,NULL,'Rafael Espinal'),(25,'ACACESPRO DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(26,'ACACRECOSC DE R.L.','','','','','1234',NULL,1,NULL,NULL,''),(27,'ACOPUS DE R.L.','','','','','123',NULL,1,NULL,NULL,'Lcda. de Alfaro'),(28,'COSTISSS DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(29,'COANDES DE R.L.','','','','','123',NULL,1,NULL,NULL,'Ing. Julio Portillo'),(30,'ACACEMIHA DE R.L.','','','','','123',NULL,0,NULL,NULL,'Licda. Ana Elvia de Martínez'),(31,'ACECENTA DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(32,'ACOPACTO DE R.L.','','','','','123',NULL,1,NULL,NULL,'Ing. Gallegos'),(33,'CODEZA DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sra. Clelia Sánchez'),(34,'ELECTRA DE R.L.','','','','','123',NULL,1,NULL,NULL,'Licda. Linda Funes'),(35,'ACEISPROMEIN DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(36,'EL AMATE DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(37,'ACACESPSA DE R.L.','','','','','1234',NULL,1,NULL,NULL,'Lic. Aldo Valenzuela'),(38,'ACACSEMERSA DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sr. Ricardo Vanegas'),(39,'SIHUACOOP DE R.L.','','','','','123',NULL,1,NULL,NULL,'Licda. de Martínez'),(40,'ACACI DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sra. Cecilia '),(41,'ACACME DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sr. Ricardo Morales'),(42,'ACOCOMET DE R.L.','','','','','123',NULL,1,NULL,NULL,'Sr. Miguel Clemente'),(43,'ACACEAGRO DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(44,'ACACEPOM DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(45,'ACACMA DE R.L.','','','','','123',NULL,1,NULL,NULL,''),(46,'FEDECACES DE R.L.','23 Av. Norte y 25 Calle poniente #1301, San Salvador','2555-3500','','','.',NULL,1,NULL,NULL,'Lic. Hector Córdova'),(47,'ACOMAM DE R.L.','','','','','1',NULL,1,NULL,NULL,''),(48,'ACOPACC DE R.L.','','','','','.',NULL,1,NULL,NULL,''),(49,'ACACRESCO DE R.L.','','','','','.',NULL,1,NULL,NULL,''),(50,'EL ROBLE DE R.L.','','','','','.',NULL,1,NULL,NULL,'');

/*Table structure for table `conf_menu` */

DROP TABLE IF EXISTS `conf_menu`;

CREATE TABLE `conf_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(200) DEFAULT NULL,
  `id_padre` int(11) DEFAULT '0',
  `url` varchar(150) DEFAULT '#',
  `activo` int(11) DEFAULT '1',
  `orden` int(11) DEFAULT '1',
  `target` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

/*Data for the table `conf_menu` */

insert  into `conf_menu`(`id_menu`,`nombre_menu`,`id_padre`,`url`,`activo`,`orden`,`target`) values (1,'Servicios',0,'',1,0,NULL),(2,'Capacitaciones',1,'',1,0,NULL),(3,'Curricula',2,'curriculas',1,0,NULL),(4,'Perfiles',2,'perfiles',0,0,NULL),(5,'Plan de Capacitaciones',2,'pl_planes',1,0,NULL),(6,'Asesorias',1,'',1,0,NULL),(7,'Servicios',6,'ase_servicios',1,0,NULL),(8,'Consultoria',1,'',1,0,NULL),(9,'Consultoria 1',8,'',1,0,NULL),(10,'Reportes',0,'',1,0,NULL),(11,'Ingresos por cooperativa',10,'re_planes',1,0,NULL),(12,'Pagos',10,'',1,0,NULL),(13,'Configuracion',0,'',1,0,NULL),(14,'Usuarios',13,'',1,0,NULL),(15,'Internos',14,'usuarios_internos',1,0,NULL),(16,'Externos',14,'usuarios_externos',1,0,NULL),(17,'Cooperativas',28,'cooperativas',1,0,NULL),(18,'Gestion Sistema',13,'',0,0,NULL),(19,'Roles',14,'roles',1,0,NULL),(20,'Menu',53,'conf_menu',1,0,NULL),(21,'Sucursales',28,'sucursales',1,0,NULL),(26,'roles',14,'roles',0,0,NULL),(27,'Permisos',14,'subroles',1,0,NULL),(28,'Clientes',13,'',1,0,NULL),(29,'Respaldo',53,'conf_sistema',1,0,NULL),(30,'Mantenimientos',0,'#',0,0,NULL),(31,'Modalidades',38,'mante_modalidades',1,1,NULL),(32,'Estados de Planes',38,'mante_estados_plan',0,10,NULL),(33,'Facilitadores',38,'mante_facilitadores',1,6,NULL),(34,'Lugares',38,'mante_lugares',1,2,NULL),(35,'Costos',37,'mante_costos',0,0,NULL),(36,'Sub Costos',37,'mante_subcostos',0,0,NULL),(37,'Gestion de Costos',30,'#',0,0,NULL),(38,'Mantenimientos',13,'',1,1,NULL),(39,'Mantenimientos',13,'',0,1,NULL),(40,'Servicios a Clientes',0,'',1,1,NULL),(41,'Inscripción en Linea',40,'inscripcion_temas',1,1,NULL),(42,'Mantenimiento de tipos facilitadores',38,'mante_tipos_facilitadores',0,0,NULL),(43,'Cargos',38,'mante_cargos',1,7,NULL),(44,'Rubros',38,'mante_rubros',1,8,NULL),(45,'Ver temas disponibles',40,'temas_disponibles',1,1,'_blank'),(46,'Inscripcion',2,'inscripcion',1,1,NULL),(47,'Abonos por cooperativa',2,'abonos_cooperativas',0,1,NULL),(48,'Profesiones',38,'mante_profesiones',1,4,NULL),(49,'Especialidades ',38,'mante_especialidades',1,5,NULL),(50,'Evaluar Modulo',2,'evaluar_modulo',0,1,NULL),(51,'Tipos de Evaluacion',38,'mante_tipos_evaluacion',1,3,NULL),(52,'Resultados de evaluacion',38,'mante_resultados',1,9,NULL),(53,'Programador',0,'',1,1,NULL),(54,'Facilitador',0,'',1,1,NULL),(55,'Listado',54,'f_listado',1,1,NULL),(56,'Subir Notas',54,'evaluar_modulo',1,1,NULL),(57,'Registro de Personal',40,'mante_personal',1,1,NULL),(58,'Cobros',0,'',1,1,NULL),(59,'Nota de Cargo',58,'nota_cargo',0,1,NULL),(60,'Estado de cuenta',58,'estado_cuenta',1,1,NULL),(61,'Opinión de Participantes',2,'mod_opinion',1,1,NULL),(62,'Evaluación del Modulo',2,'cal_modulo',1,1,NULL),(63,'Descuentos',58,'descuentos',1,1,NULL),(64,'Bitácoras por Actividad',6,'ase_bitacoras',1,1,NULL),(65,'Registro de Personal',38,'mante_personal',1,1,NULL),(66,'Notas Cargo',58,'notas_cargo',1,1,NULL),(67,'Pago o Abono',58,'pago_abono',1,1,NULL);

/*Table structure for table `conf_sucursal` */

DROP TABLE IF EXISTS `conf_sucursal`;

CREATE TABLE `conf_sucursal` (
  `id_sucursal` int(10) NOT NULL AUTO_INCREMENT,
  `id_cooperativa` int(10) NOT NULL,
  `sucursal` varchar(100) DEFAULT NULL,
  `gerente` longtext,
  `telefono` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_sucursal`),
  KEY `fk_conf_sucursal_conf_cooperativa1` (`id_cooperativa`),
  CONSTRAINT `FK_conf_sucursal` FOREIGN KEY (`id_cooperativa`) REFERENCES `conf_cooperativa` (`id_cooperativa`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `conf_sucursal` */

insert  into `conf_sucursal`(`id_sucursal`,`id_cooperativa`,`sucursal`,`gerente`,`telefono`,`fax`,`id_usuario`,`f_creacion`,`activo`) values (6,6,'San Vicente',NULL,'25614589','23654913',1,'2013-06-05 21:59:23',1),(7,9,'Oficina Central','','23654269','23659613',1,'2013-06-05 21:59:23',1),(8,9,'Chapeltique','','23698541','23651963',1,'2013-06-05 21:59:23',1),(9,6,'Oficina Central','.','.','',1,'2013-06-05 21:59:23',1),(10,6,'Ilobasco','.','.','.',1,'2013-06-05 21:59:23',1),(11,6,'Cojutepeque','.','.','.',1,'2013-06-05 21:59:23',1),(12,6,'Nombre de Jesus','.','.','.',8,'2014-02-16 19:15:04',1),(13,34,'Oficina Central','Linda Funes','2333333','',3,'2014-04-01 15:22:42',1),(14,26,'Oficina Central','Roberto Ángel Carrillo','22200337','',3,'2014-04-03 14:00:03',1),(15,26,'Centro Comercial Municipal','Graciela de Rodas','22222222','',3,'2014-04-03 14:00:39',1),(16,26,'Unicentro Soyapango','Alcira Yasmin Salazar','22222222','',3,'2014-04-03 14:01:12',1),(17,33,'Oficina Central','Clelia Sanchez','2222','',7,'2014-04-03 14:18:53',1),(18,21,'Agua Caliente','Lic. Paz','23939400','',7,'2014-04-04 06:58:47',1),(19,21,'Chalatenango','.','.','',7,'2014-04-04 06:59:37',1),(20,21,'El Coyolito','.','.','',7,'2014-04-04 07:00:08',1),(21,31,'Oficina Central','.','.','',7,'2014-04-04 07:01:00',1),(22,31,'Alta Vista','.','.','',7,'2014-04-04 07:01:23',1),(23,31,'Zacatecoluca','.','.','',7,'2014-04-04 07:02:05',1),(24,31,'San Jose Guayabal','.','.','',7,'2014-04-04 07:02:21',1),(25,31,'Lourdes','.','.','',7,'2014-04-04 07:02:33',1),(26,9,'San Miguel','Sergio Garcia','.','',7,'2014-04-04 07:04:22',1),(27,9,'Guatajiagua','Sergio Garcia','.','',7,'2014-04-04 07:04:44',1),(28,9,'San Francisco Gotera','Sergio Garcia','.','',7,'2014-04-04 07:05:34',1),(29,39,'Oficina Central','.','.','',7,'2014-04-04 07:14:03',1),(30,39,'Metapan','.','.','',7,'2014-04-04 07:15:19',1),(31,41,'Oficina Central','.','.','',7,'2014-04-04 07:16:27',1),(32,41,'Ahuachapan','.','.','',7,'2014-04-04 07:16:50',1),(33,46,'Oficina Central','Lic. Hector Córdova','255-3500','',7,'2014-04-04 07:21:22',1),(34,42,'Oficina Central','Lic. Miguel Clemente','.','',7,'2014-04-04 07:22:10',1),(35,37,'Oficina Central','Lic. Aldo Valenzuela','.','',7,'2014-04-04 07:23:00',1),(36,26,'Oficina Central','.','.','',7,'2014-04-04 07:23:53',1),(37,26,'Soyapango','.','.','',7,'2014-04-04 07:24:22',1),(38,19,'Oficina Central','.','.','',7,'2014-04-04 07:24:59',1),(39,24,'Oficina Central','Lic. Rafael Espinal','.','',7,'2014-04-04 07:25:38',1),(40,46,'Respaldo','Lic. Saul Antonio Nerio','2555-3556','',7,'2014-04-04 07:28:56',1),(41,6,'San Salvador','.','.','',7,'2014-04-04 07:40:01',1),(42,46,'Supervision y Auditoria Interna','Lic. Misael Barahona','2555-3529','',7,'2014-04-04 08:01:00',1),(43,47,'Oficina Central','Rene Mejia','.','',7,'2014-04-04 08:28:54',1),(44,38,'Oficina Central','.','.','.',7,'2014-04-08 12:42:25',1),(45,38,'Chalchuapa','.','.','.',7,'2014-04-08 12:42:40',1),(46,38,'Ciudad Arce','.','.','.',7,'2014-04-08 12:43:13',1),(47,38,'El Congo','.','.','.',7,'2014-04-08 12:54:21',1),(48,50,'Oficina Central','.','.','.',7,'2014-04-08 12:57:24',1),(49,49,'Oficina Central','.','.','.',7,'2014-04-08 12:57:39',1),(50,48,'Oficina Central','.','.','.',7,'2014-04-08 12:57:57',1),(51,48,'Nejapa','.','.','.',7,'2014-04-08 12:58:13',1),(52,48,'La Reina','.','.','.',7,'2014-04-08 12:58:47',1),(53,41,'San Julian','.','.','.',7,'2014-04-08 12:59:19',1),(54,48,'Tejutla','.','.','.',7,'2014-04-08 13:00:37',1),(55,24,'Usulutan','.','.','.',7,'2014-04-08 14:20:24',1),(56,24,'San Miguel','.','.','.',7,'2014-04-08 14:20:36',1),(57,24,'San Francisco Gotera','.','.','',7,'2014-04-08 14:21:02',1),(58,24,'Santa Rosa de Lima','.','.','.',7,'2014-04-08 14:29:53',1);

/*Table structure for table `cu_curricula` */

DROP TABLE IF EXISTS `cu_curricula`;

CREATE TABLE `cu_curricula` (
  `id_curricula` int(11) NOT NULL AUTO_INCREMENT,
  `curricula` varchar(100) DEFAULT NULL,
  `objetivo` varchar(200) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_curricula`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `cu_curricula` */

insert  into `cu_curricula`(`id_curricula`,`curricula`,`objetivo`,`id_usuario`,`estado`,`f_creacion`,`activo`) values (2,'Curricula General','Objetivo Curricula General',1,1,'2013-06-05 21:20:36',1),(11,'Sistema de Formación Curricular del SCFF','',1,1,'2013-07-25 16:16:25',1);

/*Table structure for table `cu_perfil` */

DROP TABLE IF EXISTS `cu_perfil`;

CREATE TABLE `cu_perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `id_curricula` int(11) DEFAULT NULL,
  `perfil` varchar(100) DEFAULT NULL,
  `id_cargo` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil` */

insert  into `cu_perfil`(`id_perfil`,`id_curricula`,`perfil`,`id_cargo`,`aspectos_generales`,`objetivos`,`duracion`,`fecha`,`id_usuario`,`f_creacion`,`activo`) values (1,2,'Cajero',1,NULL,NULL,NULL,'2013-01-29',1,'2013-06-05 21:33:28',1),(8,11,'DIRECTIVOS',2,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:24:50',1),(9,11,'GERENTES GENERALES',3,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:27:31',1),(10,11,'GERENTE DE RECURSOS HUMANOS',3,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:28:51',1),(11,11,'CONTADORES GENERALES',2,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:30:05',1),(12,11,'CAJEROS (AS)',1,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:30:59',1),(13,11,'ANALISTA DE CRÉDITOS',5,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:32:32',1),(14,11,'GESTOR DE COBROS',4,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:33:59',1),(15,11,'REFERENTE REMESAS Y RED ACTIVA',2,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:35:24',1),(16,11,'EJECUTIVO DE MERCADEO',4,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:50:32',1),(17,11,'REFERENTE TÉCNICO DE INFORMATICA',3,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:51:21',1),(18,11,'ASISTENTES - SECRETARIAS',4,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:52:27',1),(19,11,'AUXILIAR CONTABLE',5,NULL,NULL,NULL,'2013-07-25',1,'2013-07-25 16:53:30',1),(20,2,NULL,3,NULL,NULL,NULL,'2013-12-15',1,'2013-12-15 23:43:03',1);

/*Table structure for table `cu_perfil_contenido_aspectos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_aspectos`;

CREATE TABLE `cu_perfil_contenido_aspectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_aspectos` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_aspectos` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_aspectos` */

insert  into `cu_perfil_contenido_aspectos`(`id`,`nombre`,`id_perfil`) values (7,'Área de Formación: Filosofía Institucional y Servicios que presta la cooperativa',1);

/*Table structure for table `cu_perfil_contenido_b_material_apoyo` */

DROP TABLE IF EXISTS `cu_perfil_contenido_b_material_apoyo`;

CREATE TABLE `cu_perfil_contenido_b_material_apoyo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  `archivos` longtext,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_b_material_apoyo` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_b_material_apoyo` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_b_material_apoyo` */

insert  into `cu_perfil_contenido_b_material_apoyo`(`id`,`nombre`,`id_perfil`,`archivos`) values (1,'Valores y principios cooperativos',1,'[\"\"]'),(2,'Reglamento de la ley general de asociaciones cooperativas',1,NULL),(3,'Ley de intermediarios financieros no bancarios',1,NULL);

/*Table structure for table `cu_perfil_contenido_niveles_logro` */

DROP TABLE IF EXISTS `cu_perfil_contenido_niveles_logro`;

CREATE TABLE `cu_perfil_contenido_niveles_logro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_niveles_logro` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_niveles_logro` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_niveles_logro` */

insert  into `cu_perfil_contenido_niveles_logro`(`id`,`nombre`,`id_perfil`) values (1,'Menciona la visión y misión de la cooperativa y como su puesto de trabajo contribuye al logro de la misma',1),(2,'Enumera cuales son los servicios que presta la cooperativa',1),(3,'Declara el nombre de la persona de cada área de la cooperativa a quien puede referir a los usuarios',1),(4,'Enumera las entidades para quienes puede recibir pagos de parte de los usuarios',1),(5,'Se encuentra actualizado con la información sobre las variaciones que pueden sufrir las tasas de interés en la cooperativa',1);

/*Table structure for table `cu_perfil_contenido_objetivos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_objetivos`;

CREATE TABLE `cu_perfil_contenido_objetivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_objetivos` */

insert  into `cu_perfil_contenido_objetivos`(`id`,`nombre`,`id_perfil`) values (5,'Dar a conocer la filosofía institucional que rige la cooperativa con el propósito que el nuevo miembro adopte aptitudes y valores propios del cooperativismo',1),(6,'Transmitir los principios fundamentales para establecer un modo de vida cooperativista',1),(7,'Dar a conocer los servicios que brinda la cooperativa a fin de que el participante los identifique',1);

/*Table structure for table `cu_perfil_contenido_recursos` */

DROP TABLE IF EXISTS `cu_perfil_contenido_recursos`;

CREATE TABLE `cu_perfil_contenido_recursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_recursos` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_recursos` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_recursos` */

insert  into `cu_perfil_contenido_recursos`(`id`,`nombre`,`id_perfil`) values (1,'Computadora',1),(2,'Laptop',1),(3,'Puntero',1),(4,'Papelográfo',1),(6,'Pizarra Acrílica',1),(7,'Plumones',1),(8,'Presentaciones',1),(9,'Fotografía o videos',1);

/*Table structure for table `cu_perfil_contenido_sugerencias_metodologicas` */

DROP TABLE IF EXISTS `cu_perfil_contenido_sugerencias_metodologicas`;

CREATE TABLE `cu_perfil_contenido_sugerencias_metodologicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  `archivos` longtext,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_sugerencias_metodologicas` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_sugerencias_metodologicas` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_sugerencias_metodologicas` */

insert  into `cu_perfil_contenido_sugerencias_metodologicas`(`id`,`nombre`,`id_perfil`,`archivos`) values (1,'Actividades de Inducción:',1,'[]'),(2,'Se sugiere la dinámica \"corazones\" para romper el hielo',1,NULL),(3,'Desarrollo de Contenido',1,NULL);

/*Table structure for table `cu_perfil_contenido_unidades_competencia` */

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_competencia`;

CREATE TABLE `cu_perfil_contenido_unidades_competencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_unidades_competencia` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_unidades_competencia` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_unidades_competencia` */

insert  into `cu_perfil_contenido_unidades_competencia`(`id`,`nombre`,`id_perfil`) values (2,'Conoce la filosofía organizacional de la cooperativa',1),(3,'Domina información básica de los servicios que presta la cooperativa',1),(4,'Identifica las personas encargadas de brindar detalles sobre los servicios que proporciona la cooperativa a fin de orientar adecuadamente a los usuarios que consulten',1),(5,'Identificar las entidades clientes de la cooperativa de quienes se puede aceptar pago por parte de los usuarios',1),(6,'Dispone de información actualizada sobre las tasas de interés de la cooperativa',1),(7,'Analísis Financiero',13);

/*Table structure for table `cu_perfil_contenido_unidades_contenido` */

DROP TABLE IF EXISTS `cu_perfil_contenido_unidades_contenido`;

CREATE TABLE `cu_perfil_contenido_unidades_contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` longtext,
  `id_perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cu_perfil_contenido_unidades_contenido` (`id_perfil`),
  CONSTRAINT `FK_cu_perfil_contenido_unidades_contenido` FOREIGN KEY (`id_perfil`) REFERENCES `cu_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cu_perfil_contenido_unidades_contenido` */

insert  into `cu_perfil_contenido_unidades_contenido`(`id`,`nombre`,`id_perfil`) values (1,'Historia del cooperativismo en El Salvador',1),(2,'Identidad Cooperativa',1),(3,'Historia de la Federación',1),(4,'Filosofía Institucional',1),(5,'Servicios que presta la Cooperativa',1);

/*Table structure for table `cu_tablas_contenido` */

DROP TABLE IF EXISTS `cu_tablas_contenido`;

CREATE TABLE `cu_tablas_contenido` (
  `id_tabla_contenido` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tabla` varchar(100) DEFAULT NULL,
  `id_tabla` varchar(100) DEFAULT NULL,
  `nombre_contenido` varchar(100) DEFAULT NULL,
  `archivos` int(11) DEFAULT '0',
  PRIMARY KEY (`id_tabla_contenido`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cu_tablas_contenido` */

insert  into `cu_tablas_contenido`(`id_tabla_contenido`,`nombre_tabla`,`id_tabla`,`nombre_contenido`,`archivos`) values (1,'cu_perfil_contenido_aspectos','id_aspecto','Aspectos Generales',0),(2,'cu_perfil_contenido_objetivos','id_objetivo','Objetivos',0),(3,'cu_perfil_contenido_unidades_competencia',NULL,'Unidades de competencia',0),(4,'cu_perfil_contenido_niveles_logro',NULL,'Niveles de logro',0),(5,'cu_perfil_contenido_unidades_contenido',NULL,'Unidades de contenido',0),(6,'cu_perfil_contenido_sugerencias_metodologicas',NULL,'Sugerencias metodologicas',1),(7,'cu_perfil_contenido_recursos',NULL,'Recursos',0),(8,'cu_perfil_contenido_b_material_apoyo',NULL,'Bibliografía y material de apoyo',1);

/*Table structure for table `inscripcion_asistencia` */

DROP TABLE IF EXISTS `inscripcion_asistencia`;

CREATE TABLE `inscripcion_asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `id_inscripcion_personas` int(11) NOT NULL,
  `asistio` int(11) DEFAULT '1',
  `aprobado` int(11) NOT NULL DEFAULT '1',
  `fecha_creacion` datetime NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_asistencia` */

insert  into `inscripcion_asistencia`(`id_asistencia`,`id_modulo`,`id_inscripcion_personas`,`asistio`,`aprobado`,`fecha_creacion`,`id_usuario`) values (31,10,12,1,1,'2014-03-02 22:26:02',1),(32,10,13,1,1,'2014-03-02 22:26:02',1),(33,10,14,1,0,'2014-03-02 22:26:02',1),(34,10,15,1,0,'2014-03-02 22:26:02',1),(35,10,16,1,1,'2014-03-02 22:26:02',1),(36,10,17,1,1,'2014-03-02 22:26:02',1),(37,10,18,1,0,'2014-03-31 15:13:04',1),(38,15,19,1,0,'2014-04-04 08:39:57',7),(39,15,20,1,1,'2014-04-04 08:39:57',7),(40,15,21,1,1,'2014-04-04 08:39:57',7),(41,15,22,1,0,'2014-04-04 08:39:57',7),(42,15,23,1,0,'2014-04-04 08:39:57',7),(43,15,24,1,0,'2014-04-04 08:39:57',7),(44,15,25,1,1,'2014-04-04 08:39:57',7),(45,15,26,1,1,'2014-04-04 08:39:57',7),(46,15,27,1,1,'2014-04-04 08:39:58',7),(47,15,28,1,1,'2014-04-04 08:39:57',7),(48,15,29,1,1,'2014-04-04 08:39:57',7),(49,15,30,1,1,'2014-04-04 08:39:57',7),(50,15,31,1,1,'2014-04-04 08:39:57',7),(51,15,32,1,1,'2014-04-04 08:39:57',7),(52,15,33,1,1,'2014-04-04 08:39:57',7),(53,15,34,1,1,'2014-04-04 08:39:57',7),(54,15,35,1,1,'2014-04-04 08:39:57',7),(55,15,36,1,1,'2014-04-04 08:39:57',7),(56,15,37,1,1,'2014-04-04 08:39:57',7),(57,15,38,1,1,'2014-04-04 08:39:57',7),(58,15,39,1,1,'2014-04-04 08:39:57',7),(59,15,40,1,1,'2014-04-04 08:39:57',7),(60,15,41,1,1,'2014-04-04 08:39:58',7),(61,15,42,1,1,'2014-04-04 08:39:57',7),(62,15,43,1,1,'2014-04-04 08:39:57',7),(63,15,44,1,1,'2014-04-04 08:39:57',7),(64,15,45,1,1,'2014-04-04 08:39:57',7),(65,15,46,1,1,'2014-04-04 08:39:57',7),(66,15,47,1,1,'2014-04-04 08:39:57',7),(67,15,48,1,1,'2014-04-04 08:39:57',7),(68,15,49,1,1,'2014-04-04 08:39:58',7),(69,15,50,1,1,'2014-04-04 08:39:57',7),(70,15,51,1,1,'2014-04-04 08:39:57',7),(71,26,52,1,0,'2014-04-08 12:44:21',7),(72,26,53,1,0,'2014-04-08 12:46:46',7),(73,26,54,1,0,'2014-04-08 12:47:52',7),(74,26,55,1,0,'2014-04-08 12:49:05',7),(75,26,56,1,0,'2014-04-08 12:50:16',7),(76,26,57,1,0,'2014-04-08 12:52:23',7),(77,26,58,1,0,'2014-04-08 12:53:14',7),(78,26,59,1,0,'2014-04-08 13:02:16',7),(79,26,60,1,0,'2014-04-08 13:03:24',7),(80,26,61,1,0,'2014-04-08 13:06:59',7),(81,26,62,1,0,'2014-04-08 13:09:02',7),(82,26,63,1,0,'2014-04-08 13:09:55',7),(83,26,64,1,0,'2014-04-08 14:07:06',7),(84,26,65,1,0,'2014-04-08 14:11:34',7),(85,26,66,1,0,'2014-04-08 14:12:25',7),(86,26,67,1,0,'2014-04-08 14:13:15',7),(87,26,68,1,0,'2014-04-08 14:22:14',7),(88,26,69,1,0,'2014-04-08 14:23:18',7),(89,26,70,1,0,'2014-04-08 14:24:42',7),(90,26,71,1,0,'2014-04-08 14:31:44',7),(91,26,72,1,0,'2014-04-08 14:34:25',7);

/*Table structure for table `inscripcion_temas` */

DROP TABLE IF EXISTS `inscripcion_temas`;

CREATE TABLE `inscripcion_temas` (
  `id_inscripcion_tema` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT '0',
  `id_capacitacion` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_cooperativa` int(11) DEFAULT '0',
  PRIMARY KEY (`id_inscripcion_tema`),
  KEY `FK_inscripcion_temas` (`id_capacitacion`),
  CONSTRAINT `FK_inscripcion_temas` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_temas` */

insert  into `inscripcion_temas`(`id_inscripcion_tema`,`id_usuario`,`id_capacitacion`,`f_creacion`,`activo`,`id_cooperativa`) values (9,4,7,'2014-02-01 22:14:02',1,6),(10,0,7,'2014-02-26 22:03:06',1,1),(11,0,7,'2014-02-26 22:07:07',1,0),(13,3,10,'2014-04-01 14:54:48',1,NULL),(14,13,10,'2014-04-01 15:04:15',1,34),(15,14,10,'2014-04-01 15:11:29',1,1),(17,0,10,'2014-04-03 14:06:20',1,26),(18,14,10,'2014-04-03 14:20:45',1,33),(19,15,10,'2014-04-04 07:27:32',1,19),(20,0,10,'2014-04-04 07:31:47',1,41),(21,0,10,'2014-04-04 07:33:32',1,24),(22,4,10,'2014-04-04 07:41:29',1,6),(23,0,10,'2014-04-04 07:47:47',1,46),(24,0,10,'2014-04-04 07:55:10',1,39),(25,0,10,'2014-04-04 08:06:46',1,42),(26,0,10,'2014-04-04 08:11:01',1,21),(27,0,10,'2014-04-04 08:18:35',1,31),(28,0,10,'2014-04-04 08:25:31',1,37),(29,0,10,'2014-04-04 08:33:01',1,47),(31,0,13,'2014-04-08 12:44:21',1,38),(32,13,13,'2014-04-08 12:53:14',1,34),(33,0,13,'2014-04-08 13:03:24',1,42),(34,0,13,'2014-04-08 13:06:59',1,48),(35,0,13,'2014-04-08 13:09:55',1,41),(36,0,13,'2014-04-08 14:22:14',1,24),(37,6,10,'2014-05-20 11:24:35',1,9);

/*Table structure for table `inscripcion_temas_descuentos` */

DROP TABLE IF EXISTS `inscripcion_temas_descuentos`;

CREATE TABLE `inscripcion_temas_descuentos` (
  `id_descuento` int(11) NOT NULL AUTO_INCREMENT,
  `id_cooperativa` int(11) NOT NULL,
  `id_inscripcion_tema` int(11) NOT NULL,
  `descuento` decimal(5,2) DEFAULT '0.00',
  `id_usuario` int(11) DEFAULT '0',
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_descuento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_temas_descuentos` */

insert  into `inscripcion_temas_descuentos`(`id_descuento`,`id_cooperativa`,`id_inscripcion_tema`,`descuento`,`id_usuario`,`f_creacion`,`activo`) values (1,9,8,'10.00',1,'2014-03-09 10:24:07',1),(2,46,23,'10.00',7,'2014-04-04 09:20:14',1);

/*Table structure for table `inscripcion_temas_personas` */

DROP TABLE IF EXISTS `inscripcion_temas_personas`;

CREATE TABLE `inscripcion_temas_personas` (
  `id_inscripcion_personas` int(11) NOT NULL AUTO_INCREMENT,
  `id_inscripcion_tema` int(11) NOT NULL,
  `dui` varchar(20) DEFAULT NULL,
  `apellidos` varchar(20) DEFAULT NULL,
  `nombres` varchar(20) DEFAULT NULL,
  `correo` longtext,
  `tipo_persona` varchar(5) DEFAULT 'A',
  `id_sucursal` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL DEFAULT '1',
  `aprobado` int(11) DEFAULT '0',
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_inscripcion_personas`),
  KEY `FK_inscripcion_temas_personas` (`id_inscripcion_tema`),
  CONSTRAINT `FK_inscripcion_temas_personas` FOREIGN KEY (`id_inscripcion_tema`) REFERENCES `inscripcion_temas` (`id_inscripcion_tema`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

/*Data for the table `inscripcion_temas_personas` */

insert  into `inscripcion_temas_personas`(`id_inscripcion_personas`,`id_inscripcion_tema`,`dui`,`apellidos`,`nombres`,`correo`,`tipo_persona`,`id_sucursal`,`id_cargo`,`aprobado`,`id_usuario`,`f_creacion`,`activo`) values (13,9,'25689-654','Hernandez','Carlos',NULL,'A',9,2,0,1,'2014-02-01 22:14:02',1),(15,11,'123','Melendez','Mario','jarh@jarh.com','NA',0,1,0,1,'2014-02-27 23:30:01',1),(16,11,'9','Guerra','Maria','jarh@jarh.com','EX',0,1,0,1,'2014-03-02 22:12:46',1),(17,11,'7','Ramirez','Daniel','jjjjj@sad.com','EX',0,1,0,1,'2014-03-02 22:25:53',1),(19,15,'01959901-6','Mauricio Campos','Raúl Eduardo ','raul.mauricio@fedecaces.com','A',13,1,0,14,'2014-04-01 15:23:48',1),(20,14,'00250982-2','LOPEZ DE SANTOS','MIRNA SORAYA','cooperativa.electra@fedecaces.com','A',13,32,0,13,'2014-04-01 15:44:55',1),(21,14,'03628474-7','CASTELLANOS PINEDA','CESAR RAFAEL','contabilidad.electra@fedecaces.com','A',13,7,0,13,'2014-04-01 15:45:57',1),(22,17,'03454556-1','Hernández','Luciano','','A',14,6,0,7,'2014-04-03 14:06:20',1),(23,17,'01355908-4','Perdomo','Santiago ','','A',0,6,0,7,'2014-04-03 14:07:45',1),(24,17,'02594309-5','Peña','Carlos Ovidio','','A',0,6,0,7,'2014-04-03 14:08:41',1),(25,18,'03969994-1','Romero de López','Idalia Beatriz','','A',17,7,0,7,'2014-04-03 14:20:45',1),(26,18,'044889255-4','Alfaro Andrade','Ingrid Xiomara','','A',0,16,0,7,'2014-04-03 14:23:31',1),(27,19,'00454465-8','Ulin','Manuel Ernesto','','A',38,18,0,7,'2014-04-04 07:27:32',1),(28,20,'04187836-5','Chapetai Perez','Dora Esther ','','A',31,8,0,7,'2014-04-04 07:31:47',1),(29,21,'01836322-6','Sorto','Luis Armando','','A',0,7,0,7,'2014-04-04 07:33:32',1),(30,22,'01443581-9','Henriquez','Erick','','A',0,4,0,7,'2014-04-04 07:41:29',1),(31,23,'01060120-6','Quintanilla','Mario ','','A',0,34,0,7,'2014-04-04 07:47:48',1),(32,24,'00186771-4','de Nuñez','Maria Julia','','A',29,36,0,7,'2014-04-04 07:55:10',1),(33,24,'01671571-0','Diaz ','Jose Daniel','','A',0,31,0,7,'2014-04-04 07:58:13',1),(34,23,'00255731-2','Siguenza','Edwin ','','A',0,36,0,7,'2014-04-04 08:05:12',1),(35,25,'00101607-0','Basurto Menjivar','Felix Mario','','A',34,14,0,7,'2014-04-04 08:06:46',1),(36,22,'04271131-2','Cubias Lara','Ana Guadalupe','','A',9,17,0,7,'2014-04-04 08:08:06',1),(37,17,'03535301-4','Salazar de Marin','Alcira Yasmin','','A',37,2,0,7,'2014-04-04 08:09:51',1),(38,26,'03858728-0','Interiano','Dimas Audiel','','A',18,7,0,7,'2014-04-04 08:11:01',1),(39,26,'02797723-6','Paz','Gloria Elizabeth','','A',18,4,0,7,'2014-04-04 08:12:50',1),(40,22,'00224822-2','Flores','David Antonio','','A',9,14,0,7,'2014-04-04 08:14:51',1),(41,23,'00095427-5','Villatoro','Leonel','','A',42,35,0,7,'2014-04-04 08:16:15',1),(42,22,'02592801-1','Mejia','Juber Alexander','','A',9,36,0,7,'2014-04-04 08:17:19',1),(43,27,'00295928-4','Espinoza','Jose Luiz ','','A',21,36,0,7,'2014-04-04 08:18:35',1),(44,17,'01683821-7','Najera','Sandra Yanira','','A',14,7,0,7,'2014-04-04 08:20:07',1),(45,26,'01461117-2','Quijada','Susana Guadalupe','','A',19,2,0,7,'2014-04-04 08:21:13',1),(46,26,'03883534-0','Ardon','Jose Amilcar','','A',20,2,0,7,'2014-04-04 08:22:20',1),(47,24,'01389274-1','Aviles','Jaime Alfredo','','A',0,13,0,7,'2014-04-04 08:23:32',1),(48,23,'01466870-5','Quintanilla Vásquez','Ana Guadalupe','','A',42,35,0,7,'2014-04-04 08:24:25',1),(49,28,'02435500-3','Valenzuela','Aldo Mauricio ','','A',35,4,0,7,'2014-04-04 08:25:31',1),(50,19,'02058988-8','Ortiz','Mauricio Enrique','','A',0,14,0,7,'2014-04-04 08:26:30',1),(51,29,'02376507-9','Mejia','Rene','','A',43,4,0,7,'2014-04-04 08:33:01',1),(52,31,'02917946-3','Barrientos Reina','Fermin','','A',0,6,0,7,'2014-04-08 12:44:21',1),(53,31,'02393981-2','Rodriguez Peña','Edwin Norberro','','A',0,6,0,7,'2014-04-08 12:46:46',1),(54,31,'02721447-6','Agreda Martinez','Porfirio Anastacio','','A',0,6,0,7,'2014-04-08 12:47:52',1),(55,31,'02900472-0','Alvarez','Jaime','','A',0,6,0,7,'2014-04-08 12:49:05',1),(56,31,'00738253-4','Garcia Molina','Julio Anibal ','','A',0,6,0,7,'2014-04-08 12:50:16',1),(57,31,'01734451-2','Martinez Membreño','Victor Manuel ','','A',0,6,0,7,'2014-04-08 12:52:23',1),(58,32,'01818485-0','Garcia Ramirez','Ernesto Efrain','','A',0,6,0,7,'2014-04-08 12:53:14',1),(59,31,'00123947-4','Ramirez','Jose Francisco','','A',0,6,0,7,'2014-04-08 13:02:16',1),(60,33,'01572326-5','Toledo Figueroa','Jaime Humberto','','A',0,6,0,7,'2014-04-08 13:03:24',1),(61,34,'01730908-3','Melendez','Amilcar Rolando','','A',0,6,0,7,'2014-04-08 13:06:59',1),(62,34,'01859459-2','Landaverde','Omar Alexander','','A',0,6,0,7,'2014-04-08 13:09:02',1),(63,35,'01137635-9','Alfaro','Jose Roberto','','A',0,6,0,7,'2014-04-08 13:09:55',1),(64,35,'00907988-6','Cortez','Juan Carlos ','','A',0,6,0,7,'2014-04-08 14:07:06',1),(65,35,'02459254-0','Manzano','Carlos Antonio','','A',0,6,0,7,'2014-04-08 14:11:34',1),(66,35,'00917996-2','Pérez','Manuel de Jesus ','','A',0,6,0,7,'2014-04-08 14:12:25',1),(67,35,'01650180-2','Mendoza','Mario Jaime','','A',0,6,0,7,'2014-04-08 14:13:15',1),(68,36,'03073176-2','Hernández','Jose Jowanis','','A',0,6,0,7,'2014-04-08 14:22:14',1),(69,36,'03188803-3','Lizama','Jose Moises','','A',0,6,0,7,'2014-04-08 14:23:18',1),(70,36,'00189144-2','Sibrian Cuellar','Alejandro ','','A',0,6,0,7,'2014-04-08 14:24:42',1),(71,36,'04370345-1','Calderon','Alexander ','','A',0,6,0,7,'2014-04-08 14:31:44',1),(72,36,'00696201-4','Hernández','Fredis Ricardo','','A',0,6,0,7,'2014-04-08 14:34:25',1);

/*Table structure for table `mante_cargos` */

DROP TABLE IF EXISTS `mante_cargos`;

CREATE TABLE `mante_cargos` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(100) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_cargo`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `mante_cargos` */

insert  into `mante_cargos`(`id_cargo`,`nombre_cargo`,`f_creacion`,`id_usuario`,`activo`) values (1,'Jefe de Mercadeo','2013-06-28 20:34:20',1,1),(2,'Gerente de Agencia','2013-06-28 20:34:41',1,1),(3,'Asistente Administrativa','2013-06-28 20:34:53',1,1),(4,'Gerente General','2013-06-28 20:35:04',1,1),(5,'Cajero','2013-06-28 20:35:13',1,1),(6,'Vigilante','2014-04-01 13:40:18',3,1),(7,'Contador General','2014-04-01 13:40:27',3,1),(8,'Auxiliar Contable','2014-04-01 13:40:35',3,1),(9,'Jefe Departamento Jurídico','2014-04-01 13:40:47',3,1),(10,'Gestor de Cobro','2014-04-01 13:40:56',3,1),(11,'Referente de Tarjeta','2014-04-01 13:41:10',3,1),(12,'Referente de Remesas Familiares','2014-04-01 13:41:20',3,1),(13,'Jefe Departamento de Informática','2014-04-01 13:41:32',3,1),(14,'Gerente Financiero','2014-04-01 13:41:40',3,1),(15,'Gerente de Recursos Humanos','2014-04-01 13:41:49',3,1),(16,'Oficial de Cumplimiento','2014-04-01 13:42:07',3,1),(17,'Oficial de Riesgos','2014-04-01 13:42:13',3,1),(18,'Presidente de Consejo de Administración','2014-04-01 13:42:43',3,1),(19,'Secretario Consejo','2014-04-01 13:42:53',3,1),(20,'Tesorero Consejo','2014-04-01 13:43:02',3,1),(21,'Vocal Consejo','2014-04-01 13:43:13',3,1),(22,'Suplente Consejo','2014-04-01 13:43:24',3,1),(23,'Presidente Junta Vigilancia','2014-04-01 13:43:47',3,1),(24,'Secretario Junta de Vigilancia','2014-04-01 13:43:57',3,1),(25,'Vocal Junta de Vigilancia','2014-04-01 13:44:08',3,1),(26,'Suplente Junta de Vigilancia','2014-04-01 13:44:19',3,1),(27,'Ejecutivo de Crédito','2014-04-01 13:44:36',3,1),(28,'Ejecutivo de Atención al Cliente','2014-04-01 13:44:46',3,1),(29,'Cajero Contable','2014-04-01 13:44:57',3,1),(30,'Ordenanza','2014-04-01 13:45:05',3,1),(31,'Gerente Administrativo','2014-04-01 13:46:29',3,1),(32,'Jefe de Operaciones','2014-04-01 13:46:35',3,1),(33,'Asistente de Gerencia','2014-04-01 13:47:12',3,1),(36,'Auxiliar de Auditoria','2014-04-04 07:45:16',3,1),(34,'Auditor Externo','2014-04-04 07:43:42',3,1),(35,'Técnico Supervisor','2014-04-04 07:44:18',3,1);

/*Table structure for table `mante_cat_resultado` */

DROP TABLE IF EXISTS `mante_cat_resultado`;

CREATE TABLE `mante_cat_resultado` (
  `id_mante_cat_resultado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mante_cat_resultado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mante_cat_resultado` */

insert  into `mante_cat_resultado`(`id_mante_cat_resultado`,`nombre`,`activo`,`f_creacion`,`id_usuario`) values (1,'DEL INSTRUCTOR',1,'2014-01-20 23:40:32',1),(2,'DEL CURSO',1,'2014-01-20 23:47:06',1),(3,'DEL GRUPO',1,'2014-01-20 23:47:22',1),(4,'DE LA COORDINACION GENERAL',1,'2014-01-20 23:47:43',1);

/*Table structure for table `mante_cat_resultado_aspectos` */

DROP TABLE IF EXISTS `mante_cat_resultado_aspectos`;

CREATE TABLE `mante_cat_resultado_aspectos` (
  `id_aspectos_considerar` int(11) NOT NULL AUTO_INCREMENT,
  `id_mante_cat_resultado` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `activo` int(11) DEFAULT '1',
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aspectos_considerar`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `mante_cat_resultado_aspectos` */

insert  into `mante_cat_resultado_aspectos`(`id_aspectos_considerar`,`id_mante_cat_resultado`,`nombre`,`activo`,`f_creacion`,`id_usuario`) values (1,1,'Dominio del tema que impartió',1,'2014-01-21 00:05:50',1),(2,2,'Se alcanzaron los Objetivos',1,'2014-01-22 22:07:00',1),(3,3,'Los participantes se mostraron interesados',1,'2014-01-22 22:07:41',1),(4,4,'La calidad de trabajo del coordinador',1,'2014-01-22 22:08:27',1),(5,1,'Preparo sus sesiones',1,'2014-01-23 20:43:42',1),(6,3,'Compartieron sus conocimientos y experiencias',1,'2014-01-23 21:21:25',1),(7,1,'Fomento la participación del grupo',1,'2014-01-23 22:30:34',1),(8,1,'Se expreso con claridad',1,'2014-01-23 22:31:18',1),(9,1,'Cumplió con los tiempos programados',1,'2014-01-23 22:31:51',1),(10,1,'Supervisó el trabajo en equipo',1,'2014-01-23 22:33:08',1),(11,2,'El conocimiento adquirido es aplicable en su rol',1,'2014-01-23 22:35:26',1),(12,2,'El tema se desarrolló de forma teórico - práctico',1,'2014-01-23 22:36:31',1),(13,2,'Los Contenidos se abordaron con secuencia logica',1,'2014-01-23 22:37:06',1);

/*Table structure for table `mante_costos` */

DROP TABLE IF EXISTS `mante_costos`;

CREATE TABLE `mante_costos` (
  `id_costo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_costo` varchar(100) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_costo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `mante_costos` */

insert  into `mante_costos`(`id_costo`,`nombre_costo`,`activo`,`id_usuario`,`f_creacion`) values (1,'Costo 12',0,NULL,NULL),(2,'costo 3',1,NULL,NULL),(3,'costos 2',1,NULL,NULL),(4,'costo 4',1,NULL,NULL);

/*Table structure for table `mante_especialidades` */

DROP TABLE IF EXISTS `mante_especialidades`;

CREATE TABLE `mante_especialidades` (
  `id_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_especialidad` longtext NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `mante_especialidades` */

insert  into `mante_especialidades`(`id_especialidad`,`nombre_especialidad`,`id_usuario`,`f_creacion`,`activo`) values (1,'Planificación estratégica',1,'2013-12-16 21:46:18',1),(2,'Finanzas',1,'2013-12-16 22:34:43',1),(3,'Recursos Humanos',1,'2014-03-31 15:37:40',1),(4,'Mercadologo',1,'2014-03-31 15:37:54',1),(5,'Riesgos',1,'2014-03-31 15:43:56',1),(6,'Prevención de Lavado de Activos',3,'2014-04-01 13:31:18',1),(7,'Control Interno',3,'2014-04-01 13:31:25',1),(8,'Imagen ',3,'2014-04-01 13:31:38',1),(9,'Auditoría Externa',3,'2014-04-01 17:33:26',1);

/*Table structure for table `mante_especialidades_x_facilitador` */

DROP TABLE IF EXISTS `mante_especialidades_x_facilitador`;

CREATE TABLE `mante_especialidades_x_facilitador` (
  `id_especialidad_x_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `id_especialidad` int(11) NOT NULL,
  `id_facilitador` int(11) NOT NULL,
  PRIMARY KEY (`id_especialidad_x_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `mante_especialidades_x_facilitador` */

insert  into `mante_especialidades_x_facilitador`(`id_especialidad_x_facilitador`,`id_especialidad`,`id_facilitador`) values (7,2,2),(8,1,2),(14,1,4),(15,2,4),(16,5,4),(17,1,3),(18,2,3),(19,3,3),(23,6,1),(24,7,1),(25,5,1),(29,2,5),(30,1,5),(31,8,5),(32,3,5),(33,2,6),(34,5,6),(35,7,6),(36,9,8),(37,2,8),(38,7,8);

/*Table structure for table `mante_estados_planes` */

DROP TABLE IF EXISTS `mante_estados_planes`;

CREATE TABLE `mante_estados_planes` (
  `id_estado_plan` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(100) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_estado_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mante_estados_planes` */

insert  into `mante_estados_planes`(`id_estado_plan`,`nombre_estado`,`activo`,`id_usuario`,`f_creacion`) values (2,'Abierto',1,1,'2013-06-02 13:54:33'),(3,'Cerrado',1,1,'2013-06-02 13:54:33');

/*Table structure for table `mante_facilitadores` */

DROP TABLE IF EXISTS `mante_facilitadores`;

CREATE TABLE `mante_facilitadores` (
  `id_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` longtext,
  `t_oficina` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `correo` longtext,
  `nacionalidad` longtext,
  `acreditado` int(11) DEFAULT '0',
  `id_tipo_facilitador` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `mante_facilitadores` */

insert  into `mante_facilitadores`(`id_facilitador`,`nombres`,`apellidos`,`telefono`,`direccion`,`t_oficina`,`celular`,`correo`,`nacionalidad`,`acreditado`,`id_tipo_facilitador`,`activo`,`id_usuario`,`f_creacion`) values (1,'Raúl Eduardo','Mauricio Campos','','14 Avenida Norte, Pasaje 4, número 106, Colonia La Rábida, San Salvador, El Salvador','25553560','78741657','raul.mauricio@f',NULL,0,1,1,1,'2013-06-11 10:00:00'),(2,'Carlos','Hernandez','123456789','','123456789','123456789','jarh@jar.com',NULL,1,2,0,1,'2013-06-11 23:45:54'),(3,'Moris','Molina','','25 Av. Nte. y 25 Calle Pte. #1301, San Salvador','25553565','','moris.molina@fe',NULL,1,2,0,1,'2014-03-31 15:31:43'),(4,'Sergio','Doradea','','Su casa','','71279339','jsdoradea@gmail',NULL,0,2,0,1,'2014-03-31 15:42:53'),(5,'Miguel Ángel','Pérez','','','','79107236','magisterfinanci',NULL,0,1,1,3,'2014-04-01 17:12:54'),(6,'Luis','Lievano','','','','77355930','luigisalv@yahoo',NULL,0,1,1,3,'2014-04-01 17:20:54'),(7,'Alberto','Avila','','Miami','','121212343','alberto.avila@i',NULL,0,1,1,3,'2014-04-01 17:30:15'),(8,'Saúl Antonio','Nerio','','23 Avenida Norte y 25 Calle Poniente número 1303, San Salvador, El Salvador.','','77292218','saul.nerio@fede',NULL,0,1,1,3,'2014-04-01 17:32:43');

/*Table structure for table `mante_facilitadores_docs` */

DROP TABLE IF EXISTS `mante_facilitadores_docs`;

CREATE TABLE `mante_facilitadores_docs` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_facilitador` int(11) NOT NULL,
  `nombre_doc` varchar(100) NOT NULL,
  `archivo` longtext,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mante_facilitadores_docs` */

insert  into `mante_facilitadores_docs`(`id_doc`,`id_facilitador`,`nombre_doc`,`archivo`,`f_creacion`,`id_usuario`,`activo`) values (1,2,'Archivo 1','control.jsf','2014-02-13 23:06:54',1,1),(2,4,'Curriculo','CV_Sergio_Doradea_092013.pdf','2014-03-31 15:45:33',1,1),(3,1,'Curriculum Raúl Mauricio','Curriculum_Raúl_Mauricio_Agosto_2013.pdf','2014-04-02 09:49:14',3,1);

/*Table structure for table `mante_lugares` */

DROP TABLE IF EXISTS `mante_lugares`;

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

/*Data for the table `mante_lugares` */

insert  into `mante_lugares`(`id_lugar`,`nombre_lugar`,`telefono`,`ubicacion`,`activo`,`id_usuario`,`f_creacion`) values (2,'Hotel Crowne Plaza','25553561','San Salvador',1,1,'2013-06-16 16:37:59'),(3,'Centro de Capacitación del Sistema Cooperativo Financiero FEDECACES','25553561','23 Avenida Norte 1313, San Salvador, El Salvador',1,1,'2013-06-16 16:39:00');

/*Table structure for table `mante_modalidades` */

DROP TABLE IF EXISTS `mante_modalidades`;

CREATE TABLE `mante_modalidades` (
  `id_modalidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modalidad` varchar(100) DEFAULT NULL,
  `objetivo` varchar(300) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `mante_modalidades` */

insert  into `mante_modalidades`(`id_modalidad`,`nombre_modalidad`,`objetivo`,`f_creacion`,`id_usuario`,`activo`) values (2,'Diplomados','Modalidad de formación para la especialización del recurso humano de las cooperativas del sector de ahorro y crédito. Todos nuestros diplomados están respaldados por la facultad de ciencias económicas de la Universidad de El Salvador','2013-06-01 20:54:52',1,1),(3,'Seminarios','Los seminarios tienen naturaleza técnica y académica cuyo objetivo es realizar un estudio profundo de determinadas materias con un tratamiento que requiere una interactividad entre los especialistas. La ejecución de un seminario ejercita a los estudiante en el estudio personal y de equipo, los famil','2013-06-02 17:05:20',1,1),(4,'Talleres','Modalidad de formación práctica para la exposición de herramientas e insumos que contribuyan al desarrollo del sector y de su personal.','2013-06-02 17:05:41',1,1),(5,'Congresos','Modalidad que nos permite reunión a especialistas en una rama del que hacer cooperativo para la disertación de temas de actualidad y definición de líneas de trabajo estratégicas para el sector','2013-06-02 17:05:55',1,1),(6,'Eventos Corporativos','Los eventos Corporativos son un mecanismo para posicionar al sector en temas de actualidad y normalmente están diseñados según una especialidad definida. Sirven para potenciar el trabajo de los Comités de Apoyo, y áreas estratégicas de trabajo al interior de las Cooperativas, como por ejemplo: Comit','2014-04-07 08:49:20',3,1);

/*Table structure for table `mante_personal` */

DROP TABLE IF EXISTS `mante_personal`;

CREATE TABLE `mante_personal` (
  `id_personal` int(11) NOT NULL AUTO_INCREMENT,
  `id_cooperativa` int(11) NOT NULL DEFAULT '0',
  `id_sucursal` int(11) NOT NULL DEFAULT '0',
  `dui` varchar(100) DEFAULT NULL,
  `apellidos` longtext,
  `nombres` longtext,
  `correo` longtext,
  `id_cargo` int(11) DEFAULT '1',
  `tipo_persona` varchar(5) DEFAULT 'A',
  `activo` int(11) DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_personal`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

/*Data for the table `mante_personal` */

insert  into `mante_personal`(`id_personal`,`id_cooperativa`,`id_sucursal`,`dui`,`apellidos`,`nombres`,`correo`,`id_cargo`,`tipo_persona`,`activo`,`id_usuario`,`f_creacion`) values (1,9,8,'1','Rodriguez','Antonio',NULL,2,'A',0,7,'2014-02-15 22:41:49'),(2,9,8,'2','Amaya','Carlos','jarh@jarh.com',3,'A',0,7,'2014-02-25 22:33:52'),(3,1,0,'123','Melendez','Mario','jarh@jarh.com',1,'NA',1,1,'2014-02-27 23:04:33'),(4,1,0,'9','Guerra','Maria','jarh@jarh.com',1,'EX',1,1,'2014-03-02 22:12:32'),(6,1,0,'7','Ramirez','Daniel','jjjjj@sad.com',1,'EX',1,1,'2014-03-02 22:25:22'),(7,34,13,'01959901-6','Mauricio Campos','Raúl Eduardo ','raul.mauricio@fedecaces.com',1,'A',0,14,'2014-04-01 15:23:19'),(8,34,13,'03628474-7','CASTELLANOS PINEDA','CESAR RAFAEL','contabilidad.electra@fedecaces.com',7,'A',1,13,'2014-04-01 15:36:58'),(9,34,13,'00250982-2','LOPEZ DE SANTOS','MIRNA SORAYA','cooperativa.electra@fedecaces.com',32,'A',1,13,'2014-04-01 15:37:27'),(10,26,14,'03454556-1','Hernández','Luciano','',6,'A',1,7,'2014-04-03 14:05:53'),(11,26,15,'01355908-4','Perdomo','Santiago ','',6,'A',1,7,'2014-04-03 14:07:37'),(12,26,16,'02594309-5','Peña','Carlos Ovidio','',6,'A',1,7,'2014-04-03 14:08:23'),(13,33,17,'03969994-1','Romero de López','Idalia Beatriz','',7,'A',1,7,'2014-04-03 14:20:25'),(14,33,17,'044889255-4','Alfaro Andrade','Ingrid Xiomara','',16,'A',1,7,'2014-04-03 14:23:23'),(15,19,38,'00454465-8','Ulin','Manuel Ernesto','',18,'A',1,7,'2014-04-04 07:27:16'),(16,41,31,'04187836-5','Chapetai Perez','Dora Esther ','',8,'A',1,7,'2014-04-04 07:31:37'),(17,24,39,'01836322-6','Sorto','Luis Armando','',7,'A',1,7,'2014-04-04 07:33:24'),(18,6,9,'01443581-9','Henriquez','Erick','',4,'A',1,7,'2014-04-04 07:41:21'),(19,46,40,'01060120-6','Quintanilla','Mario ','',34,'A',1,7,'2014-04-04 07:47:02'),(20,39,29,'0018677-4','de Nuñez','Maria Julia','',36,'A',1,7,'2014-04-04 07:52:04'),(21,39,29,'00186771-4','de Nuñez','Maria Julia','',36,'A',1,7,'2014-04-04 07:54:48'),(22,39,29,'01671571-0','Diaz ','Jose Daniel','',31,'A',1,7,'2014-04-04 07:58:05'),(23,46,42,'00255731-2','Siguenza','Edwin ','',36,'A',1,7,'2014-04-04 08:04:38'),(24,42,34,'00101607-0','Basurto Menjivar','Felix Mario','',14,'A',1,7,'2014-04-04 08:06:37'),(25,6,9,'04271131-2','Cubias Lara','Ana Guadalupe','',17,'A',1,7,'2014-04-04 08:07:55'),(26,26,37,'03535301-4','Salazar de Marin','Alcira Yasmin','',2,'A',1,7,'2014-04-04 08:09:41'),(27,21,18,'03858728-0','Interiano','Dimas Audiel','',7,'A',1,7,'2014-04-04 08:10:51'),(28,21,18,'02797723-6','Paz','Gloria Elizabeth','',4,'A',1,7,'2014-04-04 08:12:36'),(29,6,9,'00224822-2','Flores','David Antonio','',14,'A',1,7,'2014-04-04 08:14:38'),(30,46,42,'00095427-5','Villatoro','Leonel','',35,'A',1,7,'2014-04-04 08:16:03'),(31,6,9,'02592801-1','Mejia','Juber Alexander','',36,'A',1,7,'2014-04-04 08:16:57'),(32,31,21,'00295928-4','Espinoza','Jose Luiz ','',36,'A',1,7,'2014-04-04 08:18:28'),(33,26,14,'01683821-7','Najera','Sandra Yanira','',7,'A',1,7,'2014-04-04 08:19:58'),(34,21,19,'01461117-2','Quijada','Susana Guadalupe','',2,'A',1,7,'2014-04-04 08:21:03'),(35,21,20,'03883534-0','Ardon','Jose Amilcar','',2,'A',1,7,'2014-04-04 08:22:01'),(36,39,29,'01389274-1','Aviles','Jaime Alfredo','',13,'A',1,7,'2014-04-04 08:23:25'),(37,46,42,'01466870-5','Quintanilla Vásquez','Ana Guadalupe','',35,'A',1,7,'2014-04-04 08:24:17'),(38,37,35,'02435500-3','Valenzuela','Aldo Mauricio ','',4,'A',1,7,'2014-04-04 08:25:20'),(39,19,38,'02058988-8','Ortiz','Mauricio Enrique','',14,'A',1,7,'2014-04-04 08:26:22'),(40,47,43,'02376507-9','Mejia','Rene','',4,'A',1,7,'2014-04-04 08:32:50'),(41,38,44,'02917946-3','Barrientos Reina','Fermin','',6,'A',1,7,'2014-04-08 12:44:14'),(42,38,44,'02393981-2','Rodriguez Peña','Edwin Norberro','',6,'A',1,7,'2014-04-08 12:46:40'),(43,38,44,'02721447-6','Agreda Martinez','Porfirio Anastacio','',6,'A',1,7,'2014-04-08 12:47:47'),(44,38,46,'02900472-0','Alvarez','Jaime','',6,'A',1,7,'2014-04-08 12:48:58'),(45,38,46,'00738253-4','Garcia Molina','Julio Anibal ','',6,'A',1,7,'2014-04-08 12:50:10'),(46,38,46,'01734451-2','Martinez Membreño','Victor Manuel ','',6,'A',1,7,'2014-04-08 12:51:33'),(47,34,13,'01818485-0','Garcia Ramirez','Ernesto Efrain','',6,'A',1,7,'2014-04-08 12:53:08'),(48,38,47,'00123947-4','Ramirez','Jose Francisco','',6,'A',1,7,'2014-04-08 13:02:10'),(49,42,34,'01572326-5','Toledo Figueroa','Jaime Humberto','',6,'A',1,7,'2014-04-08 13:03:09'),(50,48,50,'01730908-3','Melendez','Amilcar Rolando','',6,'A',1,7,'2014-04-08 13:06:53'),(51,48,50,'01859459-2','Landaverde','Omar Alexander','',6,'A',1,7,'2014-04-08 13:08:56'),(52,41,32,'01137635-9','Alfaro','Jose Roberto','',6,'A',1,7,'2014-04-08 13:09:50'),(53,41,32,'00907988-6','Cortez','Juan Carlos ','',6,'A',1,7,'2014-04-08 14:07:00'),(54,41,31,'02459254-0','Manzano','Carlos Antonio','',6,'A',1,7,'2014-04-08 14:11:26'),(55,41,53,'00917996-2','Pérez','Manuel de Jesus ','',6,'A',1,7,'2014-04-08 14:12:19'),(56,41,31,'01650180-2','Mendoza','Mario Jaime','',6,'A',1,7,'2014-04-08 14:13:08'),(57,24,55,'03073176-2','Hernández','Jose Jowanis','',6,'A',1,7,'2014-04-08 14:22:07'),(58,24,55,'03188803-3','Lizama','Jose Moises','',6,'A',1,7,'2014-04-08 14:23:12'),(59,24,39,'00189144-2','Sibrian Cuellar','Alejandro ','',6,'A',1,7,'2014-04-08 14:24:37'),(60,24,58,'04370345-1','Calderon','Alexander ','',6,'A',1,7,'2014-04-08 14:31:37'),(61,24,57,'00696201-4','Hernández','Fredis Ricardo','',6,'A',1,7,'2014-04-08 14:34:21');

/*Table structure for table `mante_profesion_x_facilitador` */

DROP TABLE IF EXISTS `mante_profesion_x_facilitador`;

CREATE TABLE `mante_profesion_x_facilitador` (
  `id_profesion_x_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `id_facilitador` int(11) NOT NULL,
  `id_profesion` int(11) NOT NULL,
  PRIMARY KEY (`id_profesion_x_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `mante_profesion_x_facilitador` */

insert  into `mante_profesion_x_facilitador`(`id_profesion_x_facilitador`,`id_facilitador`,`id_profesion`) values (10,2,1),(14,3,1),(15,3,4),(16,4,5),(17,4,4),(18,1,6),(19,5,16),(20,5,21),(21,6,6),(22,8,6);

/*Table structure for table `mante_profesiones` */

DROP TABLE IF EXISTS `mante_profesiones`;

CREATE TABLE `mante_profesiones` (
  `id_profesion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_profesion` longtext NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `f_creacion` datetime NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_profesion`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `mante_profesiones` */

insert  into `mante_profesiones`(`id_profesion`,`nombre_profesion`,`id_usuario`,`f_creacion`,`activo`) values (1,'Lic. en Administración de Empresas',1,'2013-12-16 21:32:41',1),(2,'Ingeniero en Sistemas',1,'2013-12-16 22:08:40',1),(3,'Lic. en Ciencias Jurídicas',1,'2014-03-31 15:35:31',1),(4,'Mastria en Administración de Empresas',1,'2014-03-31 15:36:29',1),(5,'Ingeniero Civil',1,'2014-03-31 15:41:44',1),(6,'Lic. en Contaduría Publica',3,'2014-04-01 13:26:14',1),(7,'Bachiller opción Contador',3,'2014-04-01 13:26:27',1),(8,'Bachiller General',3,'2014-04-01 13:26:35',1),(9,'Técnico informático',3,'2014-04-01 13:26:48',1),(10,'Ingeniero Industrial',3,'2014-04-01 13:27:00',1),(11,'Lic. en Mercadeo',3,'2014-04-01 13:27:08',1),(12,'Agronomo',3,'2014-04-01 13:27:35',1),(13,'Profesor',3,'2014-04-01 13:27:45',1),(14,'Lic. en Trabajo Social',3,'2014-04-01 13:28:05',1),(15,'Lic. en Psicología',3,'2014-04-01 13:28:13',1),(16,'Master en Administración Financiera',3,'2014-04-01 13:28:38',1),(17,'Arquitecto',3,'2014-04-01 13:28:44',1),(18,'Médico',3,'2014-04-01 13:28:51',1),(19,'Lic. en Enfermería',3,'2014-04-01 13:29:03',1),(20,'Lic. en Idiomas',3,'2014-04-01 13:30:05',1),(21,'Lic. en Economía',3,'2014-04-01 17:16:11',1);

/*Table structure for table `mante_rubros` */

DROP TABLE IF EXISTS `mante_rubros`;

CREATE TABLE `mante_rubros` (
  `id_rubro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `mante_rubros` */

insert  into `mante_rubros`(`id_rubro`,`nombre`,`id_usuario`,`f_creacion`,`activo`) values (2,'Alimentación Desayuno',1,'2013-06-19 20:53:32',0),(3,'Alimentación Almuerzos',1,'2013-06-19 20:53:47',0),(4,'Alimentación Refrigerios',3,'2014-04-01 13:48:58',0),(5,'Folder',3,'2014-04-01 13:49:14',0),(6,'Cartapacio',3,'2014-04-01 13:49:22',0),(7,'Lapiceros',3,'2014-04-01 13:49:34',0),(8,'Hojas membretadas',3,'2014-04-01 13:51:52',0),(9,'Libreta',3,'2014-04-01 13:52:09',0),(10,'Diploma',3,'2014-04-01 13:54:00',0),(11,'Gafete o Viñetas',3,'2014-04-01 13:54:26',0),(12,'Reproducción de Material',3,'2014-04-01 13:54:51',0),(13,'CD con funda',3,'2014-04-01 13:55:03',0),(14,'Papel bond pliego',3,'2014-04-01 13:55:33',0),(15,'Meta Plan',3,'2014-04-01 13:55:42',0),(16,'Papel bond color',3,'2014-04-01 13:55:56',0),(17,'Refrigerio AM',3,'2014-04-01 13:56:33',0),(18,'Alquiler de Salas',3,'2014-04-01 13:56:51',0),(19,'Combustible',3,'2014-04-01 13:57:04',0),(20,'Honorarios',3,'2014-04-01 13:57:13',0),(21,'Folder',3,'2014-04-01 13:57:24',0),(22,'Alojamiento',3,'2014-04-01 13:57:33',0),(23,'Taxi',3,'2014-04-01 13:57:46',0),(24,'Otros',3,'2014-04-01 13:57:57',0),(25,'Becas',3,'2014-04-01 13:58:04',0),(26,'Materiales facilitador',3,'2014-04-01 14:28:43',0),(27,'Desplazamiento',3,'2014-04-01 14:28:51',0),(28,'Honorarios',3,'2014-04-01 14:28:59',0),(29,'Apoyo Técnico',3,'2014-04-01 14:29:10',0),(30,'Alquiler local',3,'2014-04-01 14:29:28',0),(31,'Equipo',3,'2014-04-01 14:29:38',0),(32,'Refrigerio PM',3,'2014-05-19 15:27:45',0),(33,'Almuerzos',3,'2014-05-19 15:27:52',0),(34,'Desayunos',3,'2014-05-19 15:28:05',0),(35,'Paquete hotel diario',3,'2014-05-19 15:28:23',0),(36,'Cartapacio',3,'2014-05-19 15:29:16',0),(37,'Lapiceros',3,'2014-05-19 15:29:41',0),(38,'Hojas membretadas',3,'2014-05-19 15:29:52',0),(39,'Libreta',3,'2014-05-19 15:29:59',0),(40,'Diplomas',3,'2014-05-19 15:30:05',0),(41,'Gafete',3,'2014-05-19 15:30:14',0),(42,'Materiales facilitador',3,'2014-05-19 15:30:20',1),(43,'CD incluye funda',3,'2014-05-19 15:30:29',0),(44,'Papel bond pliego',3,'2014-05-19 15:31:07',0),(45,'Material METAPLAN',3,'2014-05-19 15:31:22',0),(46,'Reproducción',3,'2014-05-19 15:31:37',1),(47,'Combustible',3,'2014-05-19 15:31:50',0),(48,'Materiales participantes',3,'2014-05-19 15:32:05',1),(49,'Alojamiento',3,'2014-05-19 15:32:16',0),(50,'Alimentación',3,'2014-05-19 15:32:22',1),(51,'Promoción - descuentos',3,'2014-05-19 15:32:39',0),(52,'Alquiler local',3,'2014-05-19 15:53:25',1),(53,'Combustible',3,'2014-05-19 15:53:35',1),(54,'Honorarios',3,'2014-05-19 15:53:46',1),(55,'Viáticos',3,'2014-05-19 15:53:52',1),(56,'Alojamiento',3,'2014-05-19 15:53:59',1),(57,'Taxi',3,'2014-05-19 15:54:04',1),(58,'Promociones - descuentos',3,'2014-05-19 15:54:20',1);

/*Table structure for table `mante_subcostos` */

DROP TABLE IF EXISTS `mante_subcostos`;

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

/*Data for the table `mante_subcostos` */

insert  into `mante_subcostos`(`id_subcosto`,`id_costo`,`nombre_subcosto`,`activo`,`id_usuario`,`f_creacion`) values (1,3,'sub costo 1',1,NULL,NULL);

/*Table structure for table `mante_tipo_evaluacion` */

DROP TABLE IF EXISTS `mante_tipo_evaluacion`;

CREATE TABLE `mante_tipo_evaluacion` (
  `id_tipo_evaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_evaluacion` longtext,
  `activo` int(11) NOT NULL DEFAULT '1',
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_evaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `mante_tipo_evaluacion` */

insert  into `mante_tipo_evaluacion`(`id_tipo_evaluacion`,`nombre_tipo_evaluacion`,`activo`,`f_creacion`,`id_usuario`) values (1,'Examen',1,'2014-01-03 21:10:49',1),(4,'Laboratorio',1,'2014-01-06 22:25:53',1),(5,'Tarea Escrita',1,'2014-01-06 22:26:07',1),(6,'Asistencia',1,'2014-01-06 22:26:15',1),(7,'Participación elearning',1,'2014-04-01 13:24:12',3);

/*Table structure for table `mante_tipos_facilitadores` */

DROP TABLE IF EXISTS `mante_tipos_facilitadores`;

CREATE TABLE `mante_tipos_facilitadores` (
  `id_tipo_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_facilitador` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_tipo_facilitador`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mante_tipos_facilitadores` */

insert  into `mante_tipos_facilitadores`(`id_tipo_facilitador`,`nombre_tipo_facilitador`,`id_usuario`,`f_creacion`,`activo`) values (1,'Facilitador',1,'2013-06-28 20:28:15',1),(2,'Tecnico',1,'2013-06-28 20:28:15',1);

/*Table structure for table `notas_cargo` */

DROP TABLE IF EXISTS `notas_cargo`;

CREATE TABLE `notas_cargo` (
  `id_nota_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime NOT NULL,
  `tipo_persona` varchar(5) DEFAULT 'C',
  `cantidad_por` decimal(18,2) DEFAULT '0.00',
  `cantidad_letras` longtext,
  `id_capacitacion` int(11) NOT NULL,
  `id_cooperativa` varchar(1000) NOT NULL,
  `inversion_individual` decimal(18,2) DEFAULT NULL,
  `inversion_total` decimal(18,2) DEFAULT NULL,
  `id_usuario_creado` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_nota_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `notas_cargo` */

insert  into `notas_cargo`(`id_nota_cargo`,`fecha_creacion`,`tipo_persona`,`cantidad_por`,`cantidad_letras`,`id_capacitacion`,`id_cooperativa`,`inversion_individual`,`inversion_total`,`id_usuario_creado`,`activo`) values (1,'0000-00-00 00:00:00','C','60.00','Sesenta Dolares ',7,'9','60.00','120.00',1,1),(2,'2014-03-14 22:57:26','C','20.00','Veinte Dolares ',7,'9','60.00','180.00',1,1),(3,'2014-03-31 15:09:37','C','20.00','Veinte Dolares ',7,'9','60.00','180.00',1,1),(4,'2014-04-01 15:51:28','C','200.00','Doscientos Dolares ',10,'34','400.00','800.00',3,1),(5,'2014-04-04 09:26:54','C','1440.00','Un Mil Cuatrocientos Cuarenta Dolares ',10,'46','400.00','1600.00',7,1);

/*Table structure for table `pl_capacitaciones` */

DROP TABLE IF EXISTS `pl_capacitaciones`;

CREATE TABLE `pl_capacitaciones` (
  `id_capacitacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan_modalidad` int(11) DEFAULT NULL,
  `nombre_capacitacion` longtext,
  `objetivo` longtext,
  `dirigido` longtext,
  `cerrado` int(11) DEFAULT '0',
  `n_participantes` int(11) DEFAULT '1',
  `n_participantes_no` int(11) DEFAULT '1',
  `n_participantes_ex` int(11) DEFAULT '1',
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_capacitacion`),
  KEY `FK_pl_capacitaciones` (`id_plan_modalidad`),
  CONSTRAINT `FK_pl_capacitaciones` FOREIGN KEY (`id_plan_modalidad`) REFERENCES `pl_modalidades` (`id_plan_modalidad`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `pl_capacitaciones` */

insert  into `pl_capacitaciones`(`id_capacitacion`,`id_plan_modalidad`,`nombre_capacitacion`,`objetivo`,`dirigido`,`cerrado`,`n_participantes`,`n_participantes_no`,`n_participantes_ex`,`f_creacion`,`id_usuario`,`activo`) values (7,6,'Diplomado 1','Diplomado 1',NULL,0,20,15,20,'2014-01-31 23:16:51',8,0),(8,6,'Diplomado 2','Diplomado 2',NULL,0,0,0,0,'2014-02-01 00:04:52',8,0),(9,10,'Mejores prácticas en la gestión del riesgo de lavado de activos y financiamiento al terrorismo con aplicación en la legislación y normativa Salvadoreña','Proporcionar herramientas para la gestión del riesgo de lavado de activos y de financiamiento al terrorismo, con enfoque de aplicación en la legislación y normativa Salvadoreña, y de las mejores prácticas a nivel internacional.\n\nInstruir a los Oficiales de Cumplimiento y Comités de Prevención de Lav',NULL,0,0,0,0,'2014-04-01 14:05:29',3,1),(10,11,'Seminario sobre Normas para Bancos Cooperativos y Sociedades de Ahorro y Crédito, con enfoque de aplicación en: operaciones, administración de riesgos, contables y de regulación del Sistema Financiero','Brindar los elentos teórico - prácticos para la adopción de la normativa prudencial y contable para Bancos Cooperativos y Sociedades de Ahorro y Crédito, bajo un enfoque de regulación, brindando herramientas técnicas para su aplicación.',NULL,0,35,15,0,'2014-04-01 14:33:26',3,1),(11,11,'Seminario Taller: Proceso de certificación de Oficiales de Cumplimiento del Sistema Cooperativo Financiero FEDECACES','Al finalizar el curso los participantes contarán con la base necesaria para presentar el examen de certificación CAMS. ACAMS (Association of Certified Anti-Money Laundering Specialists)',NULL,0,25,15,0,'2014-04-01 16:22:42',3,1),(12,11,'Seminario Taller: Técnicas para la Conducción Efectiva de su Asamblea General','Contribuir al buen desarrollo de las Asambleas Generales en las Cooperativas, a través de facilitar técnicas para su desarrollo.',NULL,0,25,9,0,'2014-04-01 16:34:18',3,1),(13,11,'Seminario Taller: Capacitación básica para Agentes de Seguridad de Instituciones Financieras Cooperativas','Generar las competencias necesarias en el personal de seguridad de las Cooperativas de Ahorro y Crédito como parte de la atención integral al asociado.',NULL,0,25,5,0,'2014-04-01 16:43:35',3,1);

/*Table structure for table `pl_capacitaciones_docs` */

DROP TABLE IF EXISTS `pl_capacitaciones_docs`;

CREATE TABLE `pl_capacitaciones_docs` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_capacitacion` int(11) NOT NULL,
  `nombre_doc` varchar(100) NOT NULL,
  `archivo` longtext,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pl_capacitaciones_docs` */

/*Table structure for table `pl_modalidades` */

DROP TABLE IF EXISTS `pl_modalidades`;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modalidades` */

insert  into `pl_modalidades`(`id_plan_modalidad`,`id_plan`,`id_modalidad`,`id_usuario`,`f_creacion`,`activo`) values (6,3,2,8,'2014-01-31 23:08:47',1),(7,3,3,1,'2014-02-01 21:56:40',1),(8,3,5,3,'2014-04-01 14:01:12',1),(9,3,4,3,'2014-04-01 14:01:18',1),(10,4,2,3,'2014-04-01 14:03:00',1),(11,4,3,3,'2014-04-01 14:03:05',1),(12,4,5,3,'2014-04-01 14:03:13',1),(13,5,3,3,'2014-04-07 08:44:21',1),(14,4,6,3,'2014-04-07 08:52:36',1);

/*Table structure for table `pl_modulo_facilitador` */

DROP TABLE IF EXISTS `pl_modulo_facilitador`;

CREATE TABLE `pl_modulo_facilitador` (
  `id_modulo_facilitador` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) DEFAULT NULL,
  `id_facilitador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_modulo_facilitador`),
  KEY `FK_pl_modulo_facilitador` (`id_facilitador`),
  KEY `FK_pl_modulo_facilitador_2` (`id_modulo`),
  CONSTRAINT `FK_pl_modulo_facilitador` FOREIGN KEY (`id_facilitador`) REFERENCES `mante_facilitadores` (`id_facilitador`),
  CONSTRAINT `FK_pl_modulo_facilitador_2` FOREIGN KEY (`id_modulo`) REFERENCES `pl_modulos` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulo_facilitador` */

insert  into `pl_modulo_facilitador`(`id_modulo_facilitador`,`id_modulo`,`id_facilitador`) values (1,10,2),(3,11,2),(23,16,6),(24,15,6),(25,17,6),(26,18,6),(28,20,7),(29,19,7),(30,22,7),(31,21,7),(33,24,5),(34,25,5),(35,12,1),(36,23,8),(37,26,1),(38,27,5),(39,28,1);

/*Table structure for table `pl_modulos` */

DROP TABLE IF EXISTS `pl_modulos`;

CREATE TABLE `pl_modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_capacitacion` int(11) DEFAULT NULL,
  `id_lugar` int(11) DEFAULT NULL,
  `nombre_modulo` longtext,
  `precio_venta` decimal(12,2) DEFAULT '0.00',
  `precio_venta_no` decimal(12,2) DEFAULT '0.00',
  `precio_venta_ex` decimal(12,2) DEFAULT '0.00',
  `objetivo_modulo` varchar(300) DEFAULT NULL,
  `id_contenido` int(11) DEFAULT '0',
  `fecha_prevista` date DEFAULT NULL,
  `fecha_prevista_fin` date DEFAULT NULL,
  `contenido` varchar(200) DEFAULT NULL,
  `temas` longtext,
  `porcentaje` decimal(18,2) DEFAULT '0.00',
  `puede_evaluar` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  `es_calificado` int(11) DEFAULT '0',
  PRIMARY KEY (`id_modulo`),
  KEY `FK_pl_modulos` (`id_capacitacion`),
  KEY `FK_pl_modulos_2` (`id_lugar`),
  CONSTRAINT `FK_pl_modulos` FOREIGN KEY (`id_capacitacion`) REFERENCES `pl_capacitaciones` (`id_capacitacion`),
  CONSTRAINT `FK_pl_modulos_2` FOREIGN KEY (`id_lugar`) REFERENCES `mante_lugares` (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos` */

insert  into `pl_modulos`(`id_modulo`,`id_capacitacion`,`id_lugar`,`nombre_modulo`,`precio_venta`,`precio_venta_no`,`precio_venta_ex`,`objetivo_modulo`,`id_contenido`,`fecha_prevista`,`fecha_prevista_fin`,`contenido`,`temas`,`porcentaje`,`puede_evaluar`,`id_usuario`,`f_creacion`,`activo`,`es_calificado`) values (10,7,3,'Modulo 1','10.00','15.00','20.00','Modulo 1',0,'2014-02-19','2014-02-27','---','[\"Tema1\",\"TEMA 2\"]','50.00',0,8,'2014-01-31 23:17:35',1,1),(11,7,2,'Modulo 2','50.00','60.00','100.00','',0,'2014-03-03','2014-03-05','',NULL,'50.00',1,1,'2014-03-01 20:11:10',1,0),(12,9,3,'Modulo 1.- Actualización del Marco Legal y Normativo en materia de prevención de lavado de activos y financiamiento al terrorismo en El Salvador','100.00','200.00','250.00','Este modulo tiene por objetivo actualizar a los Oficiales de Cumplimiento del sector cooperativo de ahorro sobre las reformas a las leyes en la materia.',0,'2014-07-05','2014-07-06','- Reformas a la Ley contra el lavado de dinero y de activos\n\n- Reformas al Instructivo de la UIF\n\n- Normas para la Gestión de Riesgos emitida por el Banco Central de Reserva de El Salvador','[\"Reformas a la Ley contra el Lavado de Dinero y de Activos\",\"Reformas al instructivo de la Unidad de Investigaci\\u00f3n Financiera\",\"Normas para la Gesti\\u00f3n de Riesgos emitida por el Banco Central de Reserva de El Salvador\"]','35.00',1,3,'2014-04-01 14:10:02',1,0),(13,9,3,'Modulo 2.- Mejores prácticas en materia de prevención de lavado de activos aplicadas con base en la regulación Salvadoreña','100.00','200.00','250.00','En este modulo haremos una aplicación de las mejores prácticas a nivel internacional tomando de base la legislación nacional.',0,'2014-07-11','2014-07-12','','[\"Aplicaci\\u00f3n de las Normas KYC de Basilea\",\"Uso de software de Listas Negras\",\"Lista Negra Interna\",\"Control de PEPS\",\"Mineo de Base de Datos\",\"Control Interno y procesos\"]','35.00',1,3,'2014-04-01 14:14:28',1,0),(14,9,3,'Modulo 3.- Premisas para la construcción de las matrices de riesgo de lavado de activos y su aplicación práctica para operativizar la NRP-08','100.00','200.00','250.00','En este modulo daremos las directrices para la aplicación práctica de las normas sobre gestión de riesgos de lavado de activos',0,'2014-07-18','2014-07-19','','[\"El lavado de activos desde la gesti\\u00f3n de riesgos\",\"La matriz de riesgos\",\"Directrices para la construcci\\u00f3n de la matriz de riesgos\",\"La importancia de la base de datos para la construcci\\u00f3n de la matriz de riesgos\",\"Aplicaci\\u00f3n pr\\u00e1ctica de la matriz de riesgos\"]','30.00',1,3,'2014-04-01 14:21:41',1,0),(15,10,3,'Normas Administrativas','100.00','150.00','200.00','',0,'2014-04-04','2014-04-05','',NULL,'35.00',0,3,'2014-04-01 14:35:52',1,1),(16,10,3,'Normas de Control Financiero','100.00','150.00','200.00','',0,'2014-05-02','2014-05-03','',NULL,'35.00',1,3,'2014-04-01 14:36:46',1,0),(17,10,3,'Normas de Gestión de Riesgos','100.00','150.00','200.00','',0,'2014-05-16','2014-05-17','',NULL,'10.00',1,3,'2014-04-01 14:37:40',1,0),(18,10,3,'Normas Contables SSF','100.00','150.00','200.00','',0,'2014-05-23','2014-05-24','',NULL,'20.00',1,3,'2014-04-01 14:38:27',1,0),(19,11,3,'Primera sesión presencial','175.00','175.00','0.00','',0,'2014-02-14','2014-02-15','',NULL,'30.00',1,3,'2014-04-01 16:24:03',1,0),(20,11,3,'Primera sesión virtual','175.00','175.00','0.00','',0,'2014-03-08','2014-03-08','',NULL,'25.00',1,3,'2014-04-01 16:26:04',1,0),(21,11,3,'Segunda sesión virtual','175.00','175.00','0.00','',0,'2014-03-29','2014-03-29','',NULL,'25.00',1,3,'2014-04-01 16:28:26',1,0),(22,11,3,'Segunda sesión presencial','175.00','175.00','0.00','',0,'2014-04-25','2014-04-26','',NULL,'20.00',1,3,'2014-04-01 16:30:05',1,0),(23,12,3,'Planificación exitosa de su Asamblea General de Asociados - Aspectos Legales','85.00','100.00','0.00','',0,'2014-02-15','2014-02-15','',NULL,'35.00',1,3,'2014-04-01 16:39:31',1,0),(24,12,3,'Técnicas para la conducción efectiva de su Asamblea General - Normas Protocolarias','0.00','0.00','0.00','',0,'2014-02-16','2014-02-16','',NULL,'35.00',1,3,'2014-04-01 16:41:21',1,0),(25,12,3,'Técnicas de redacción y edición de su memoria de labores','0.00','0.00','0.00','',0,'2014-02-22','2014-02-22','',NULL,'30.00',1,3,'2014-04-01 16:42:17',1,0),(26,13,3,' Módulo 1.- Filosofía Cooperativa - Estrategia del Sistema Cooperativo Financiero FEDECACES','60.00','80.00','0.00','',0,'2014-04-06','2014-04-06','',NULL,'35.00',0,3,'2014-04-01 16:45:37',1,0),(27,13,3,'Módulo 2.- Atención al Cliente Cooperativista','60.00','80.00','0.00','',0,'2014-04-27','2014-04-27','',NULL,'35.00',0,3,'2014-04-01 16:49:20',1,0),(28,13,3,'Módulo 3.- Medidas de seguridad elementales e indispensables para una institución financiera','60.00','80.00','0.00','',0,'2014-05-04','2014-05-04','',NULL,'30.00',0,3,'2014-04-01 16:50:14',1,0);

/*Table structure for table `pl_modulos_calificacion` */

DROP TABLE IF EXISTS `pl_modulos_calificacion`;

CREATE TABLE `pl_modulos_calificacion` (
  `id_calificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_calificacion_head` int(11) DEFAULT '0',
  `id_modulo` int(11) NOT NULL,
  `id_aspecto` int(11) NOT NULL,
  `nota` decimal(5,2) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `f_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_calificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos_calificacion` */

insert  into `pl_modulos_calificacion`(`id_calificacion`,`id_calificacion_head`,`id_modulo`,`id_aspecto`,`nota`,`id_usuario`,`f_creacion`) values (27,1,15,1,'5.00',16,'2014-05-20 11:23:12'),(28,1,15,5,'5.00',16,'2014-05-20 11:23:13'),(29,1,15,7,'5.00',16,'2014-05-20 11:23:13'),(30,1,15,8,'5.00',16,'2014-05-20 11:23:13'),(31,1,15,9,'5.00',16,'2014-05-20 11:23:13'),(32,1,15,10,'5.00',16,'2014-05-20 11:23:13'),(33,1,15,2,'5.00',16,'2014-05-20 11:23:13'),(34,1,15,11,'5.00',16,'2014-05-20 11:23:13'),(35,1,15,12,'5.00',16,'2014-05-20 11:23:13'),(36,1,15,13,'5.00',16,'2014-05-20 11:23:13'),(37,1,15,3,'5.00',16,'2014-05-20 11:23:13'),(38,1,15,6,'5.00',16,'2014-05-20 11:23:13'),(39,1,15,4,'5.00',16,'2014-05-20 11:23:13');

/*Table structure for table `pl_modulos_calificacion_head` */

DROP TABLE IF EXISTS `pl_modulos_calificacion_head`;

CREATE TABLE `pl_modulos_calificacion_head` (
  `id_calificacion_head` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `f_creacion` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_calificacion_head`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos_calificacion_head` */

insert  into `pl_modulos_calificacion_head`(`id_calificacion_head`,`numero`,`id_modulo`,`f_creacion`,`id_usuario`) values (1,1,15,'2014-05-20',16);

/*Table structure for table `pl_modulos_eval` */

DROP TABLE IF EXISTS `pl_modulos_eval`;

CREATE TABLE `pl_modulos_eval` (
  `id_eval_x_mod` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `id_tipo_evaluacion` int(11) NOT NULL,
  `porcentaje` decimal(18,2) NOT NULL DEFAULT '0.00',
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_eval_x_mod`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos_eval` */

insert  into `pl_modulos_eval`(`id_eval_x_mod`,`id_modulo`,`id_tipo_evaluacion`,`porcentaje`,`f_creacion`,`id_usuario`,`activo`) values (1,11,6,'100.00','2014-03-01 22:40:24',1,1),(2,10,6,'100.00','2014-03-01 22:40:46',1,1),(3,12,1,'50.00','2014-04-01 14:10:32',3,1),(4,13,5,'50.00','2014-04-01 14:14:41',3,1),(5,13,7,'50.00','2014-04-01 14:15:41',3,1),(6,12,7,'50.00','2014-04-01 14:16:59',3,1),(7,19,6,'100.00','2014-04-01 16:24:23',3,1),(8,20,7,'50.00','2014-04-01 16:26:26',3,1),(9,20,5,'50.00','2014-04-01 16:26:53',3,1),(10,21,5,'50.00','2014-04-01 16:28:44',3,1),(11,21,7,'50.00','2014-04-01 16:29:07',3,1),(12,22,6,'50.00','2014-04-01 16:30:34',3,1),(13,22,7,'50.00','2014-04-01 16:30:42',3,1),(14,15,6,'100.00','2014-04-04 09:09:39',7,1),(15,23,6,'100.00','2014-05-19 15:48:22',3,1),(16,24,6,'100.00','2014-05-19 15:48:37',3,1),(17,25,6,'100.00','2014-05-19 15:48:56',3,1),(18,28,6,'100.00','2014-05-19 16:11:23',3,1),(19,26,6,'100.00','2014-05-19 16:11:54',3,1),(20,27,6,'100.00','2014-05-19 16:12:06',3,1);

/*Table structure for table `pl_modulos_notas` */

DROP TABLE IF EXISTS `pl_modulos_notas`;

CREATE TABLE `pl_modulos_notas` (
  `id_nota_x_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `id_inscripcion_persona` int(11) NOT NULL,
  `id_eval_x_mod` int(11) NOT NULL,
  `nota` decimal(18,2) NOT NULL,
  PRIMARY KEY (`id_nota_x_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos_notas` */

insert  into `pl_modulos_notas`(`id_nota_x_modulo`,`id_modulo`,`id_inscripcion_persona`,`id_eval_x_mod`,`nota`) values (1,10,14,2,'9.00'),(2,10,13,2,'5.00'),(3,10,15,2,'6.00'),(4,10,12,2,'8.00'),(5,10,16,2,'0.00'),(6,10,17,2,'0.00'),(7,10,18,2,'0.00'),(8,15,26,14,'10.00'),(9,15,46,14,'10.00'),(10,15,47,14,'10.00'),(11,15,35,14,'10.00'),(12,15,21,14,'10.00'),(13,15,28,14,'10.00'),(14,15,36,14,'10.00'),(15,15,32,14,'10.00'),(16,15,33,14,'10.00'),(17,15,43,14,'10.00'),(18,15,40,14,'10.00'),(19,15,30,14,'10.00'),(20,15,22,14,'0.00'),(21,15,38,14,'10.00'),(22,15,20,14,'10.00'),(23,15,19,14,'0.00'),(24,15,42,14,'10.00'),(25,15,51,14,'10.00'),(26,15,44,14,'10.00'),(27,15,50,14,'10.00'),(28,15,39,14,'10.00'),(29,15,24,14,'0.00'),(30,15,23,14,'0.00'),(31,15,45,14,'10.00'),(32,15,31,14,'10.00'),(33,15,48,14,'10.00'),(34,15,25,14,'10.00'),(35,15,37,14,'10.00'),(36,15,34,14,'10.00'),(37,15,29,14,'10.00'),(38,15,27,14,'10.00'),(39,15,49,14,'10.00'),(40,15,41,14,'10.00');

/*Table structure for table `pl_modulos_saldo` */

DROP TABLE IF EXISTS `pl_modulos_saldo`;

CREATE TABLE `pl_modulos_saldo` (
  `id_saldo` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) DEFAULT NULL,
  `id_cooperativa` int(11) DEFAULT NULL,
  `saldo` decimal(18,2) DEFAULT '0.00',
  PRIMARY KEY (`id_saldo`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `pl_modulos_saldo` */

insert  into `pl_modulos_saldo`(`id_saldo`,`id_modulo`,`id_cooperativa`,`saldo`) values (1,15,19,'200.00');

/*Table structure for table `pl_opiniones` */

DROP TABLE IF EXISTS `pl_opiniones`;

CREATE TABLE `pl_opiniones` (
  `id_opinion` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `mas_gusto` longtext,
  `menos_gusto` longtext,
  `sugerencia` longtext,
  `areas_capacitado` longtext,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_opinion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pl_opiniones` */

insert  into `pl_opiniones`(`id_opinion`,`id_modulo`,`mas_gusto`,`menos_gusto`,`sugerencia`,`areas_capacitado`,`f_creacion`,`id_usuario`,`activo`) values (1,10,'Todo','La comida','Otro lugar','- Software','2014-03-31 15:10:49',1,1);

/*Table structure for table `pl_panes_docs` */

DROP TABLE IF EXISTS `pl_panes_docs`;

CREATE TABLE `pl_panes_docs` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan` int(11) NOT NULL,
  `nombre_doc` varchar(100) NOT NULL,
  `archivo` longtext,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pl_panes_docs` */

insert  into `pl_panes_docs`(`id_doc`,`id_plan`,`nombre_doc`,`archivo`,`f_creacion`,`id_usuario`,`activo`) values (1,3,'Doc 1','photodex-presenter-install.log','2014-02-13 22:48:02',1,1),(2,11,'Seminario de Normas','Promocional_Normas.pdf','2014-04-01 14:42:26',3,1),(3,11,'Certificación ACAMS','Promocional_Certificación_ACAMS.pdf','2014-04-01 16:19:46',3,1),(4,11,'Conducción Asambleas','Promocional_Seminario_Taller_-_Conducción_de_Asambleas.pdf','2014-04-01 16:35:58',3,1),(5,11,'Seminario Agentes de Seguridad','Promocional_-_Agentes_de_Seguridad.pdf','2014-04-01 17:44:09',3,1);

/*Table structure for table `pl_planes` */

DROP TABLE IF EXISTS `pl_planes`;

CREATE TABLE `pl_planes` (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_plan` longtext,
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_estado_plan` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_plan`),
  KEY `FK_pl_planes` (`id_estado_plan`),
  CONSTRAINT `FK_pl_planes` FOREIGN KEY (`id_estado_plan`) REFERENCES `mante_estados_planes` (`id_estado_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pl_planes` */

insert  into `pl_planes`(`id_plan`,`nombre_plan`,`f_creacion`,`id_usuario`,`id_estado_plan`,`activo`) values (3,'Programa de Capacitación 2014','2014-01-31 23:08:41',8,2,0),(4,'Programa de Capacitación 2014','2014-04-01 14:02:51',3,2,1),(5,'Capacitaciones Locales 2014','2014-04-07 08:37:48',3,2,1);

/*Table structure for table `pl_rubro` */

DROP TABLE IF EXISTS `pl_rubro`;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `pl_rubro` */

insert  into `pl_rubro`(`id_rubro`,`id_rubro_name`,`id_modulo`,`f_creacion`,`id_usuario`,`activo`) values (1,2,10,'2014-02-12 21:44:26',1,1),(2,2,11,'2014-03-01 20:26:25',1,1),(3,3,11,'2014-03-01 22:36:10',1,1),(4,2,12,'2014-04-01 14:23:21',3,0),(5,28,15,'2014-04-04 08:52:33',7,0),(6,17,12,'2014-04-05 10:53:08',3,1),(7,34,23,'2014-05-19 15:49:46',3,0),(8,50,25,'2014-05-19 15:57:58',3,1),(9,46,25,'2014-05-19 16:00:06',3,1),(10,48,25,'2014-05-19 16:00:59',3,1);

/*Table structure for table `pl_subrubro` */

DROP TABLE IF EXISTS `pl_subrubro`;

CREATE TABLE `pl_subrubro` (
  `id_subrubro` int(11) NOT NULL AUTO_INCREMENT,
  `id_rubro` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `unidades` int(11) DEFAULT '0',
  `dias` int(11) DEFAULT '0',
  `costo` decimal(12,2) DEFAULT '0.00',
  `f_creacion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_subrubro`),
  KEY `FK_pl_subrubro` (`id_rubro`),
  CONSTRAINT `FK_pl_subrubro` FOREIGN KEY (`id_rubro`) REFERENCES `pl_rubro` (`id_rubro`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `pl_subrubro` */

insert  into `pl_subrubro`(`id_subrubro`,`id_rubro`,`nombre`,`unidades`,`dias`,`costo`,`f_creacion`,`id_usuario`,`activo`) values (1,1,'Almuerzo',10,0,'2.00','2014-02-12 21:44:43',1,1),(2,2,'desayuno',55,3,'2.00','2014-03-01 22:14:36',1,1),(3,3,'Cuadernos',55,3,'3.00','2014-03-01 22:36:25',1,1),(4,2,'Almuerzos',55,3,'2.00','2014-03-02 20:29:39',1,1),(5,4,'Desayuno',65,2,'2.50','2014-04-01 14:25:08',3,0),(6,6,'Desayuno',65,2,'1.75','2014-04-05 10:53:33',3,1),(7,7,'Refrigerio AM',25,1,'3.00','2014-05-19 15:56:51',3,1),(8,8,'Desayuno',25,1,'3.00','2014-05-19 15:58:31',3,1),(9,8,'Refrigerio am',25,1,'2.75','2014-05-19 15:59:05',3,1),(10,8,'Refrigerio pm',25,1,'2.75','2014-05-19 15:59:21',3,1),(11,8,'Almuyerzo',25,1,'4.50','2014-05-19 15:59:42',3,1),(12,9,'Presentación',25,1,'1.25','2014-05-19 16:00:47',3,1),(13,10,'Cartapacio',25,1,'4.97','2014-05-19 16:01:27',3,1),(14,10,'Lapiceros',25,1,'0.18','2014-05-19 16:01:49',3,1),(15,10,'Hojas membretadas',25,1,'0.11','2014-05-19 16:02:10',3,1),(16,10,'Diploma',25,1,'0.75','2014-05-19 16:02:27',3,1),(17,10,'CD incluye funda',25,1,'1.35','2014-05-19 16:02:49',3,1);

/*Table structure for table `sitio_slider` */

DROP TABLE IF EXISTS `sitio_slider`;

CREATE TABLE `sitio_slider` (
  `id_slider` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_imagen` varchar(200) DEFAULT NULL,
  `texto_aparecer` varchar(200) DEFAULT NULL,
  `nombre_archivo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `sitio_slider` */

insert  into `sitio_slider`(`id_slider`,`nombre_imagen`,`texto_aparecer`,`nombre_archivo`) values (1,'Imagen 1','Capacitación - Asesoría - Consultoría','i2.fw.png'),(2,'Imagen 2','Capacitación - Asesoría - Consultoría','i3.fw.png'),(3,'Imagen 3','Capacitación - Asesoría - Consultoría','i4.fw.png'),(4,'Imagen 4','Capacitación - Asesoría - Consultoría','i5.fw.png');

/*Table structure for table `tbl_prueba` */

DROP TABLE IF EXISTS `tbl_prueba`;

CREATE TABLE `tbl_prueba` (
  `id` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_prueba` */

insert  into `tbl_prueba`(`id`,`nombre`) values (1,'Sergio');

/*Table structure for table `usu_coop_suc` */

DROP TABLE IF EXISTS `usu_coop_suc`;

CREATE TABLE `usu_coop_suc` (
  `id_usu_coop` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cooperativa` int(11) DEFAULT NULL,
  `id_sucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usu_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `usu_coop_suc` */

insert  into `usu_coop_suc`(`id_usu_coop`,`id_usuario`,`id_cooperativa`,`id_sucursal`) values (9,4,6,0),(10,6,9,0),(11,7,9,0),(12,12,6,12),(17,15,19,0),(24,13,34,13),(25,14,33,0);

/*Table structure for table `usu_permisos_menu` */

DROP TABLE IF EXISTS `usu_permisos_menu`;

CREATE TABLE `usu_permisos_menu` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `id_subrol` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`),
  KEY `FK_usu_permisos_menu` (`id_menu`),
  KEY `FK_usu_permisos_menu2` (`id_subrol`),
  CONSTRAINT `FK_usu_permisos_menu` FOREIGN KEY (`id_menu`) REFERENCES `conf_menu` (`id_menu`),
  CONSTRAINT `FK_usu_permisos_menu2` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=1187 DEFAULT CHARSET=latin1;

/*Data for the table `usu_permisos_menu` */

insert  into `usu_permisos_menu`(`id_permiso`,`id_subrol`,`id_menu`) values (726,4,1),(727,4,2),(728,4,3),(729,4,5),(730,4,45),(731,4,54),(732,4,55),(733,4,56),(734,4,60),(735,6,1),(736,6,2),(737,6,3),(738,6,5),(739,6,46),(740,6,47),(741,6,50),(742,6,61),(743,6,62),(744,6,10),(745,6,11),(746,6,12),(747,6,40),(748,6,41),(749,6,45),(750,6,57),(751,6,54),(752,6,55),(753,6,56),(754,6,58),(755,6,59),(756,6,60),(757,6,63),(758,7,1),(759,7,2),(760,7,5),(761,7,46),(762,7,47),(763,7,50),(764,7,61),(765,7,62),(766,7,6),(767,7,7),(768,7,64),(769,7,10),(770,7,11),(771,7,12),(772,7,40),(773,7,41),(774,7,45),(775,7,57),(776,7,54),(777,7,55),(778,7,56),(779,7,58),(780,7,59),(781,7,60),(782,7,63),(793,3,40),(794,3,41),(795,3,45),(796,3,57),(797,3,58),(798,3,59),(799,3,60),(859,2,1),(860,2,6),(861,2,7),(862,2,64),(863,2,8),(864,2,9),(865,2,40),(866,2,45),(867,2,60),(1092,8,1),(1093,8,2),(1094,8,3),(1095,8,5),(1096,8,46),(1097,8,47),(1098,8,61),(1099,8,62),(1100,8,6),(1101,8,7),(1102,8,64),(1103,8,8),(1104,8,9),(1105,8,10),(1106,8,11),(1107,8,12),(1108,8,13),(1109,8,14),(1110,8,15),(1111,8,16),(1112,8,19),(1113,8,27),(1114,8,28),(1115,8,17),(1116,8,21),(1117,8,38),(1118,8,31),(1119,8,33),(1120,8,34),(1121,8,43),(1122,8,44),(1123,8,48),(1124,8,49),(1125,8,51),(1126,8,52),(1127,8,40),(1128,8,41),(1129,8,45),(1130,8,57),(1131,8,53),(1132,8,20),(1133,8,29),(1134,8,54),(1135,8,55),(1136,8,56),(1137,8,58),(1138,8,60),(1139,8,63),(1140,8,66),(1141,8,67),(1142,1,1),(1143,1,2),(1144,1,3),(1145,1,5),(1146,1,46),(1147,1,47),(1148,1,61),(1149,1,62),(1150,1,6),(1151,1,7),(1152,1,64),(1153,1,13),(1154,1,14),(1155,1,15),(1156,1,16),(1157,1,19),(1158,1,27),(1159,1,28),(1160,1,17),(1161,1,21),(1162,1,38),(1163,1,31),(1164,1,33),(1165,1,34),(1166,1,43),(1167,1,44),(1168,1,48),(1169,1,49),(1170,1,51),(1171,1,52),(1172,1,65),(1173,1,40),(1174,1,45),(1175,1,57),(1176,1,53),(1177,1,20),(1178,1,29),(1179,1,54),(1180,1,55),(1181,1,56),(1182,1,58),(1183,1,60),(1184,1,63),(1185,1,66),(1186,1,67);

/*Table structure for table `usu_rol` */

DROP TABLE IF EXISTS `usu_rol`;

CREATE TABLE `usu_rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_usuario` int(11) DEFAULT '0',
  `rol` varchar(25) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  KEY `FK_usu_rol` (`id_tipo_usuario`),
  CONSTRAINT `FK_usu_rol` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `usu_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `usu_rol` */

insert  into `usu_rol`(`id_rol`,`id_tipo_usuario`,`rol`,`estado`) values (1,1,'Administrador del Sistema',1),(2,2,'Cliente',1),(3,1,'Consultor y/o Asesor',1),(4,1,'Administrador Curricula',1),(5,1,'Administrador del Plan',1),(6,1,'Usuarios Facilitadores',1),(7,1,'Gestor de cobro y apoyo',1);

/*Table structure for table `usu_subrol` */

DROP TABLE IF EXISTS `usu_subrol`;

CREATE TABLE `usu_subrol` (
  `id_subrol` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `subrol` longtext,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_subrol`),
  KEY `FK_usu_subrol` (`id_rol`),
  CONSTRAINT `FK_usu_subrol` FOREIGN KEY (`id_rol`) REFERENCES `usu_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `usu_subrol` */

insert  into `usu_subrol`(`id_subrol`,`id_rol`,`subrol`,`estado`) values (1,1,'Administrador',1),(2,3,'Consultores y Asesores Co',1),(3,2,'Gerente',1),(4,6,'Facilitador',1),(5,7,'Asesor-Interno',0),(6,5,'Técnico Plan de Capacitac',1),(7,7,'Cobro y Apoyo',1);

/*Table structure for table `usu_tipo_usuario` */

DROP TABLE IF EXISTS `usu_tipo_usuario`;

CREATE TABLE `usu_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_usuario` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usu_tipo_usuario` */

insert  into `usu_tipo_usuario`(`id_tipo_usuario`,`nombre_tipo_usuario`) values (1,'Usuario Interno'),(2,'Usuario Externo');

/*Table structure for table `usu_usuario` */

DROP TABLE IF EXISTS `usu_usuario`;

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
  `exigir` int(11) DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  KEY `FK_usu_usuario` (`id_subrol`),
  CONSTRAINT `FK_usu_usuario` FOREIGN KEY (`id_subrol`) REFERENCES `usu_subrol` (`id_subrol`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `usu_usuario` */

insert  into `usu_usuario`(`id_usuario`,`usuario`,`clave`,`nombre_completo`,`telefono`,`celular`,`direccion`,`correo`,`ultimo_acceso`,`estado`,`id_subrol`,`activo`,`exigir`) values (1,'llievano','e10adc3949ba59abbe56e057f20f883e','Luis Lievano','22222222','','dkfjkdsjfk','','2014-04-01 11:59:44',1,4,1,1),(2,'pgarrido','e10adc3949ba59abbe56e057f20f883e','Patricia Garrido','25553563','','9re98r9488dvkfckf','patricia.garrido@fedecaces.com','2014-04-01 12:57:25',1,6,1,0),(3,'Administrador','39eb3fc79cd2425f5c80b4d86565b38e','Raúl Eduardo Mauricio Campos','25553560','78741657',NULL,'raul.mauricio@fedecaces.com','2014-05-19 15:43:53',1,1,1,0),(4,'nvasquez','e10adc3949ba59abbe56e057f20f883e','Nelson Vásquez','25553565','',NULL,'nelson.vasquez@fedecaces.com','2013-07-23 11:42:19',1,2,1,1),(5,'jnavarrete','e10adc3949ba59abbe56e057f20f883e','Jaime Arturo Navarrete','25553563','',NULL,'jaime.navarrete@fedecaces.com',NULL,1,2,1,1),(6,'srivera','e10adc3949ba59abbe56e057f20f883e','Noé Saúl Rivera','25553591','',NULL,'saul.rivera@fedecaces.com','2013-11-06 17:42:32',1,2,1,1),(7,'mvasquez','0d0433a960964d2fb5b0ceec1ebe3335','Mineth Vasquez','25553561','',NULL,'gerencia@asesoresparaeldesarrollo.com','2014-04-08 12:32:49',1,7,1,0),(8,'frivera','e10adc3949ba59abbe56e057f20f883e','Fernando Rivera','25553592','',NULL,'fernando.rivera@asesoresparaeldesarrollo.com','2014-02-16 20:14:28',1,2,1,1),(9,'glopez','e10adc3949ba59abbe56e057f20f883e','Gladis Lopez','25553564','',NULL,'gladis.lopez@asesoresparaeldesarrollo.com','2014-02-13 23:32:02',1,6,1,1),(10,'mmolina','249ba3301069177fc9380feeedb6d396','Moris Molina','25553565','',NULL,'moris.molina@fedecaces.com','2014-03-31 16:01:01',1,2,1,1),(11,'vcisneros','e10adc3949ba59abbe56e057f20f883e','Vilma del Carmen Cisneros','25553563','',NULL,'vilma.cisneros@fedecaces.com',NULL,1,4,1,1),(12,'ehenriquez','e10adc3949ba59abbe56e057f20f883e','Eric Henriquez','23339134','78599641',NULL,'gerencia.acacypac@fedecaces.com',NULL,1,3,1,1),(13,'funes1','7c687bcfb658fb63a706b4d8dba14d75','Linda Claudia Funes','22211438','79273870',NULL,'gerencia.electra@fedecaces.com','2014-04-02 10:05:17',1,3,1,0),(14,'mineth','b24bbbf00b2b4fc46ca9d32087feb573','Minetilla','22222222','',NULL,'','2014-04-01 16:13:08',1,3,1,0),(15,'cisneros','e10adc3949ba59abbe56e057f20f883e','Vilma','2222222','',NULL,'',NULL,1,3,1,1),(16,'Admin','202cb962ac59075b964b07152d234b70','Sergio Doradea',NULL,NULL,NULL,NULL,'2014-05-20 18:19:38',1,1,1,0);

/* Procedure structure for procedure `borrar_datos` */

/*!50003 DROP PROCEDURE IF EXISTS  `borrar_datos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `borrar_datos`()
BEGIN
	DELETE FROM abonos_cooperativas;
	DELETE FROM inscripcion_asistencia;
	DELETE FROM inscripcion_temas_personas;
	DELETE FROM inscripcion_temas;
	DELETE FROM mante_modalidades_docs;
	DELETE FROM pl_subrubro;
	DELETE FROM pl_rubro;
	DELETE FROM pl_modulo_facilitador;
	DELETE FROM pl_modulos_calificacion;
	DELETE FROM pl_modulos_eval;
	DELETE FROM pl_modulos_notas;
	DELETE FROM pl_modulos;
	DELETE FROM pl_capacitaciones;
	DELETE FROM pl_modalidades;
	
	DELETE FROM pl_opiniones;
	DELETE FROM pl_planes;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
