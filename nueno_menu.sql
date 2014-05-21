/*
SQLyog Job Agent Version 8.82 Copyright(c) Webyog Softworks Pvt. Ltd. All Rights Reserved.

MySQL - 5.6.16  
*********************************************************************
*/
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/* SYNC DB : asesores_viejo */ 
SET AUTOCOMMIT = 0;
/* SYNC TABLE : `conf_menu` */

	/*Start of batch : 1 */
INSERT INTO `asesores_viejo`.`conf_menu` VALUES ('67', 'Pago o Abono', '58', 'pago_abono', '1', '1', NULL);
INSERT INTO `asesores_viejo`.`conf_menu` VALUES ('65', 'Registro de Personal', '38', 'mante_personal', '1', '1', NULL);
INSERT INTO `asesores_viejo`.`conf_menu` VALUES ('66', 'Notas Cargo', '58', 'notas_cargo', '1', '1', NULL);
UPDATE `conf_menu` SET `id_menu`='62', `nombre_menu`='Evaluación del Modulo', `id_padre`='2', `url`='cal_modulo', `activo`='1', `orden`='1', `target`=NULL  WHERE (`id_menu` = 62) ;
UPDATE `conf_menu` SET `id_menu`='50', `nombre_menu`='Evaluar Modulo', `id_padre`='2', `url`='evaluar_modulo', `activo`='0', `orden`='1', `target`=NULL  WHERE (`id_menu` = 50) ;
UPDATE `conf_menu` SET `id_menu`='59', `nombre_menu`='Nota de Cargo', `id_padre`='58', `url`='nota_cargo', `activo`='0', `orden`='1', `target`=NULL  WHERE (`id_menu` = 59) ;
	/*End   of batch : 1 */

COMMIT;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
