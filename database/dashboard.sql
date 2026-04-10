/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.2.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: dashboard
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `cumpleanos` date DEFAULT NULL,
  `departamento` varchar(50) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES
(1,1,'Administrador del Sistema','San Salvador, Centro','2222-0000','1990-01-01','San Salvador','2026-01-01','2027-01-01'),
(2,2,'Usuario Detalle 1','Colonia Las Flores, Casa #1','7000-0001','1995-02-01','Santa Ana','2026-04-10','2027-04-10'),
(3,3,'Usuario Detalle 2','Colonia Las Flores, Casa #2','7000-0002','1995-03-01','La Libertad','2026-04-10','2027-04-10'),
(4,4,'Usuario Detalle 3','Colonia Las Flores, Casa #3','7000-0003','1995-04-01','Usulután','2026-04-10','2027-04-10'),
(5,5,'Usuario Detalle 4','Colonia Las Flores, Casa #4','7000-0004','1995-05-01','Sonsonate','2026-04-10','2027-04-10'),
(6,6,'Usuario Detalle 5','Colonia Las Flores, Casa #5','7000-0005','1995-06-01','San Miguel','2026-04-10','2027-04-10'),
(7,7,'Juan Pérez','Colonia Las Flores, Casa #6','7000-0006','1995-07-01','Santa Ana','2026-04-10','2027-04-10'),
(8,8,'Usuario Detalle 7','Colonia Las Flores, Casa #7','7000-0007','1995-08-01','La Libertad','2026-04-10','2027-04-10'),
(9,9,'Usuario Detalle 8','Colonia Las Flores, Casa #8','7000-0008','1995-09-01','Usulután','2026-04-10','2027-04-10'),
(10,10,'Usuario Detalle 9','Colonia Las Flores, Casa #9','7000-0009','1995-10-01','Sonsonate','2026-04-10','2027-04-10'),
(11,11,'Usuario Detalle 10','Colonia Las Flores, Casa #10','7000-0010','1995-11-01','San Miguel','2026-04-10','2027-04-10'),
(12,12,'Usuario Detalle 11','Colonia Las Flores, Casa #11','7000-0011','1995-12-01','Santa Ana','2026-04-10','2027-04-10'),
(13,13,'Usuario Detalle 12','Colonia Las Flores, Casa #12','7000-0012','1996-01-01','La Libertad','2026-04-10','2027-04-10'),
(14,14,'Usuario Detalle 13','Colonia Las Flores, Casa #13','7000-0013','1996-02-01','Usulután','2026-04-10','2027-04-10'),
(15,15,'Usuario Detalle 14','Colonia Las Flores, Casa #14','7000-0014','1996-03-01','Sonsonate','2026-04-10','2027-04-10'),
(16,16,'Usuario Detalle 15','Colonia Las Flores, Casa #15','7000-0015','1996-04-01','San Miguel','2026-04-10','2027-04-10'),
(17,17,'Usuario Detalle 16','Colonia Las Flores, Casa #16','7000-0016','1996-05-01','Santa Ana','2026-04-10','2027-04-10'),
(18,18,'Usuario Detalle 17','Colonia Las Flores, Casa #17','7000-0017','1996-06-01','La Libertad','2026-04-10','2027-04-10'),
(19,19,'Usuario Detalle 18','Colonia Las Flores, Casa #18','7000-0018','1996-07-01','Usulután','2026-04-10','2027-04-10'),
(20,20,'Usuario Detalle 19','Colonia Las Flores, Casa #19','7000-0019','1996-08-01','Sonsonate','2026-04-10','2027-04-10'),
(21,21,'Usuario Detalle 20','Colonia Las Flores, Casa #20','7000-0020','1996-09-01','San Miguel','2026-04-10','2027-04-10');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` enum('admin','user') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
(1,'admin','123456','admin'),
(2,'user1','123456','user'),
(3,'user2','123456','user'),
(4,'user3','123456','user'),
(5,'user4','123456','user'),
(6,'user5','123456','user'),
(7,'user6','123456','user'),
(8,'user7','123456','user'),
(9,'user8','123456','user'),
(10,'user9','123456','user'),
(11,'user10','123456','user'),
(12,'user11','123456','user'),
(13,'user12','123456','user'),
(14,'user13','123456','user'),
(15,'user14','123456','user'),
(16,'user15','123456','user'),
(17,'user16','123456','user'),
(18,'user17','123456','user'),
(19,'user18','123456','user'),
(20,'user19','123456','user'),
(21,'user20','123456','user');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-04-10  8:05:55
