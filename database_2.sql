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

/*Table structure for table `ofertas_estados` */

DROP TABLE IF EXISTS `ofertas_estados`;

CREATE TABLE `ofertas_estados` (
  `id_estado` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ofertas_estados` */

insert  into `ofertas_estados`(`id_estado`,`nombre`,`id_usuario`,`f_creacion`) values (1,'Vigente',1,'2014-06-18 00:00:00'),(2,'Vencida',1,'2014-06-18 00:00:00'),(3,'En Proceso',1,'2014-06-18 00:00:00'),(4,'Finalizada',1,'2014-06-18 00:00:00');

/*Table structure for table `ofertas_resolucion` */

DROP TABLE IF EXISTS `ofertas_resolucion`;

CREATE TABLE `ofertas_resolucion` (
  `id_resolucion` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `id_usuario` int(11) default NULL,
  `f_creacion` datetime default NULL,
  PRIMARY KEY  (`id_resolucion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ofertas_resolucion` */

insert  into `ofertas_resolucion`(`id_resolucion`,`nombre`,`id_usuario`,`f_creacion`) values (1,'Aceptada',1,'2014-06-18 00:00:00'),(2,'Denegada',1,'2014-06-18 00:00:00'),(3,'Enviada',1,'2014-06-18 00:00:00'),(4,'Contratada',1,'2014-06-18 00:00:00');

/*Table structure for table `ofertas_servicios` */

DROP TABLE IF EXISTS `ofertas_servicios`;

CREATE TABLE `ofertas_servicios` (
  `id_servicio` int(11) NOT NULL auto_increment,
  `nombre` longtext,
  `f_creacion` datetime default NULL,
  `id_usuario` int(11) default NULL,
  PRIMARY KEY  (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ofertas_servicios` */

insert  into `ofertas_servicios`(`id_servicio`,`nombre`,`f_creacion`,`id_usuario`) values (1,'Capacitacion',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
