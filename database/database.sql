-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: biblioteca
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `devolucion`
--

DROP TABLE IF EXISTS `devolucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devolucion` (
  `id_devolucion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT current_timestamp(),
  `dias_prestamo` int(11) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_devolucion`),
  KEY `id_libro` (`id_libro`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `devolucion_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `devolucion_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devolucion`
--

LOCK TABLES `devolucion` WRITE;
/*!40000 ALTER TABLE `devolucion` DISABLE KEYS */;
INSERT INTO `devolucion` VALUES
(1,'2024-05-18',3,1,1),
(3,'2024-05-20',9,2,3),
(4,'2024-05-23',8,7,1);
/*!40000 ALTER TABLE `devolucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(20) DEFAULT NULL,
  `apellido_empleado` varchar(20) DEFAULT NULL,
  `cargo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES
(1,'Tomas Esneider','Marin Gallego','Auxiliar'),
(2,'Emmanuel','Madrid Cifuentes','Auxiliar'),
(3,'Elon','Musk','Coordinador'),
(4,'Juan Diego','Cuesta Salas','Gerente'),
(5,'Marta','Sanchez Ramon','Jefe'),
(6,'Juan David','Martinez Ossa','Auxiliar'),
(7,'Sofia Ana','Garcia Muñoz','Auxiliar'),
(8,'Pedro','Lopez Arquides','Catalogador'),
(9,'Carlos Henrique','Fernandez Casemiro','Catalogador'),
(10,'Karina Laura','Rodriguez Rodriguez','Auxiliar'),
(11,'Ramiro Leandro','Cordoba Nuñez','Auxiliar');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(25) DEFAULT NULL,
  `autor` varchar(25) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES
(1,'Un fantasma en el sistema','Kevin A. Mitnick',5,'Hacking'),
(2,'Cien años de soledad','Gabriel Garcia Marquez',4,'Novela'),
(3,'Cronica de una muerte','Gabriel Garcia Marquez',2,'Novela'),
(4,'El maestro ciruela','Almena Fernando',10,'Ficcion'),
(5,'Don quijote de la mancha','Miguel de Cervantes',2,'Novela'),
(6,'Clean code','Robert C. Martin',4,'Programming'),
(7,'The hacker playbook 3','Peter Kim',2,'Hacking'),
(8,'Metasploit','David Kennedy',5,'Hacking'),
(9,'Cracking the coding','Gayle Laakmann',7,'Programming'),
(10,'The pragmatic programmer','Andrew Hunt',10,'Programming'),
(11,'Hello world','Javascript',7,'Programming');
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamo` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL,
  `fecha_prestamo` datetime DEFAULT current_timestamp(),
  `id_empleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_prestamo`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_libro` (`id_libro`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamo`
--

LOCK TABLES `prestamo` WRITE;
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
INSERT INTO `prestamo` VALUES
(1,1,1,'2024-05-12 13:35:18',1),
(2,10,1,'2024-05-12 13:35:32',10),
(3,11,11,'2024-05-14 00:07:56',11),
(5,9,9,'2024-05-14 00:08:14',9),
(6,8,8,'2024-05-14 00:08:19',8);
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL,
  `fecha_reserva` datetime DEFAULT current_timestamp(),
  `id_empleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_libro` (`id_libro`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
INSERT INTO `reserva` VALUES
(1,10,10,'2024-05-12 10:53:02',10),
(2,1,2,'2024-05-11 16:52:07',1),
(3,5,5,'2024-05-12 10:53:19',5),
(4,7,7,'2024-05-12 10:53:39',7),
(5,11,11,'2024-05-14 00:09:00',11),
(7,9,9,'2024-05-14 00:09:12',9),
(9,1,7,'2024-05-23 18:38:26',2);
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(20) DEFAULT NULL,
  `apellido_usuario` varchar(20) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `multa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES
(1,'Walter Adrian','Gomez Gomez','Cra 51 #46-56 Apto 22','300-567-2738',10000),
(2,'Duvier Humberto','Toro Sepulveda','Cra 97A #65-09','304-567-2930',10000),
(3,'Rodolfo Jr','Cuesta Ramos','Cra 23 #45-34','300-283-7162',10000),
(4,'Maria Fernanda','Rodriguez Muñoz','Calle Primavera 123, 28001','123-456-7890',NULL),
(5,'Juan David','Perez Molina','Avenida Libertad, 44000','987-654-3210',NULL),
(6,'Laura Maria','Garcia Montes','Cra 7 #34-56 Apto 30','567-890-1234',NULL),
(7,'Carlos Enrique','Casemiro Jr','Avenida Paraguay, 23400','789-243-2398',NULL),
(8,'S4vitar','Corporation','Avenida Madrid, 10020','123-980-4583',NULL),
(9,'Leonel Cristiano','Messi Ronaldo Jr','Avenida Balon de Oro','999-293-0192',NULL),
(10,'Sid Emmnauel','Garcia Pedronel','Cra 51 #23-98','543-283-9283',NULL),
(11,'Radamel','Falcao Garcia','Cra 54 #45-12','650-293-2394',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-24 14:42:24
