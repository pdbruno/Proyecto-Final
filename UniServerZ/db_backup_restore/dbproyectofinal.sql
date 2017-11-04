-- MySQL dump 10.13  Distrib 5.6.35, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: dbproyectofinal
-- ------------------------------------------------------
-- Server version	5.6.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `dbproyectofinal`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `dbproyectofinal` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `dbproyectofinal`;

--
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades` (
  `idActividades` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Nombre',
  `XSemestre` tinyint(4) NOT NULL COMMENT 'Se paga por semestre',
  `idFondos` int(11) unsigned NOT NULL COMMENT 'Fondo al que aporta',
  `idCalendario` text,
  PRIMARY KEY (`idActividades`),
  KEY `idFondos` (`idFondos`),
  CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`idFondos`) REFERENCES `fondos` (`idFondos`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES (00000000004,'Taekwon-Do Inicial',1,2,NULL),(00000000006,'Taekwon-Do Infantiles A',1,3,NULL),(00000000008,'Taekwon-Do Infantiles B',1,3,NULL),(00000000010,'Taekwon-Do Juveniles y Adultos',1,3,NULL),(00000000012,'Taekwon-Do Cinturones Negros',0,3,NULL),(00000000013,'Funcional',1,3,'1q94qi39cv04kvsfpb0lpq295g@group.calendar.google.com'),(00000000016,'Personalizado',0,2,'0cpgpqdpg34dncf560i20a3ack@group.calendar.google.com'),(00000000017,'Kickboxing',0,2,NULL),(00000000018,'Jiu-Jitsu',0,2,NULL);
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actividadesaranceles`
--

DROP TABLE IF EXISTS `actividadesaranceles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividadesaranceles` (
  `idActividadesAranceles` int(11) NOT NULL AUTO_INCREMENT,
  `Precio` int(11) unsigned NOT NULL DEFAULT '0',
  `idActividades` int(11) unsigned zerofill NOT NULL,
  `idModosDePago` int(11) unsigned NOT NULL,
  `idModalidades` int(11) unsigned DEFAULT NULL,
  `FechaInicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idActividadesAranceles`),
  KEY `idActividades` (`idActividades`),
  KEY `idAranceles` (`idModalidades`),
  KEY `idModosDePago` (`idModosDePago`),
  CONSTRAINT `actividadesaranceles_ibfk_1` FOREIGN KEY (`idActividades`) REFERENCES `actividades` (`idActividades`),
  CONSTRAINT `actividadesaranceles_ibfk_2` FOREIGN KEY (`idModalidades`) REFERENCES `modalidades` (`idModalidades`),
  CONSTRAINT `actividadesaranceles_ibfk_3` FOREIGN KEY (`idModosDePago`) REFERENCES `modosdepago` (`idModosDePago`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividadesaranceles`
--

LOCK TABLES `actividadesaranceles` WRITE;
/*!40000 ALTER TABLE `actividadesaranceles` DISABLE KEYS */;
INSERT INTO `actividadesaranceles` VALUES (8,123,00000000004,2,1,'2017-09-08 03:00:00'),(10,321,00000000010,2,1,'2017-09-08 03:00:00'),(11,436,00000000017,2,1,'2017-09-08 03:00:00'),(12,679,00000000013,2,1,'2017-09-08 03:00:00'),(13,235,00000000006,2,2,'2017-09-08 03:00:00'),(14,734,00000000016,1,NULL,'2017-09-08 03:00:00'),(17,0,00000000008,2,2,'2017-09-04 03:00:00'),(18,23,00000000012,1,NULL,'2017-09-08 03:00:00'),(19,0,00000000008,2,1,'2017-09-09 18:17:43'),(20,0,00000000006,2,1,'2017-09-09 18:25:05'),(28,0,00000000006,1,NULL,'2017-09-22 21:07:44'),(29,0,00000000013,1,NULL,'2017-09-22 21:27:32'),(38,230,00000000010,2,2,'2017-10-13 14:31:08'),(39,100,00000000013,1,NULL,'2017-10-14 14:59:53');
/*!40000 ALTER TABLE `actividadesaranceles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencias` (
  `idAsistencias` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idClientes` int(11) unsigned NOT NULL,
  `idActividades` int(10) unsigned zerofill NOT NULL,
  `Abonado` tinyint(4) NOT NULL DEFAULT '0',
  `Fecha` date NOT NULL,
  `idSubactividades` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`idAsistencias`),
  KEY `idClientes` (`idClientes`),
  KEY `idActividades` (`idActividades`),
  KEY `idSubactividades` (`idSubactividades`),
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`idActividades`) REFERENCES `actividades` (`idActividades`),
  CONSTRAINT `asistencias_ibfk_3` FOREIGN KEY (`idSubactividades`) REFERENCES `subactividades` (`idSubactividades`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencias`
--

LOCK TABLES `asistencias` WRITE;
/*!40000 ALTER TABLE `asistencias` DISABLE KEYS */;
INSERT INTO `asistencias` VALUES (2,2,0000000012,0,'2017-08-25',NULL),(3,1,0000000012,1,'2017-08-25',NULL),(4,12,0000000017,1,'2017-08-25',NULL),(5,2,0000000010,1,'2017-08-01',NULL),(6,2,0000000010,1,'2017-08-01',NULL),(7,2,0000000010,1,'2017-08-03',NULL),(8,2,0000000010,1,'2017-08-02',NULL),(9,2,0000000010,1,'2017-08-09',NULL),(10,2,0000000010,1,'2017-08-16',NULL),(11,2,0000000010,1,'2017-08-23',NULL),(12,11,0000000010,1,'2017-09-04',NULL),(13,11,0000000010,1,'2017-09-05',NULL),(14,11,0000000010,1,'2017-09-06',NULL),(15,11,0000000010,1,'2017-09-07',NULL),(17,20,0000000016,0,'2017-09-23',NULL),(20,10,0000000013,0,'2017-09-22',5),(21,2,0000000013,0,'2017-09-22',5),(22,2,0000000012,0,'2017-09-22',NULL),(23,1,0000000012,0,'2017-09-22',NULL),(24,12,0000000017,1,'2017-10-11',NULL),(25,1,0000000010,0,'2017-10-02',NULL),(26,2,0000000010,0,'2017-10-02',NULL),(27,11,0000000010,0,'2017-10-02',NULL),(28,20,0000000010,0,'2017-10-02',NULL),(29,1,0000000010,0,'2017-10-19',NULL),(30,11,0000000010,0,'2017-10-19',NULL),(31,12,0000000017,1,'2017-10-20',NULL);
/*!40000 ALTER TABLE `asistencias` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`127.0.0.1`*/ /*!50003 TRIGGER `CheckAbonado` BEFORE INSERT ON `asistencias` FOR EACH ROW IF (SELECT COUNT(*) FROM `cobros` WHERE `idClientes` = NEW.idClientes AND `idActividades` = NEW.idActividades AND (NEW.Fecha BETWEEN `Fecha1` AND `Fecha2`)) = 0 THEN
		SET NEW.Abonado = 0;
ELSE
		SET NEW.Abonado = 1;
END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `idCategorias` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Nombre',
  `MontoXBloque` int(11) DEFAULT NULL COMMENT 'Monto por bloque',
  PRIMARY KEY (`idCategorias`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Blanco',NULL),(2,'Blanco punta amarilla',NULL),(3,'Amarillo',NULL),(4,'Amarillo punta verde',NULL),(5,'Verde',NULL),(6,'Verde punta azul',NULL),(7,'Azul',NULL),(8,'Azul punta roja',NULL),(9,'Rojo',NULL),(10,'Rojo punta negra',NULL),(11,'1er Dan',100),(12,'2do Dan',150),(13,'3er Dan',200),(14,'4to Dan',250),(15,'5to Dan',300),(16,'6to Dan',350);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idClientes` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombres` text NOT NULL COMMENT 'Nombres',
  `Apellidos` text NOT NULL COMMENT 'Apellidos',
  `FechaNacimiento` date DEFAULT NULL COMMENT 'Fecha de Nacimiento',
  `idSexos` int(11) unsigned NOT NULL COMMENT 'Sexo',
  `DNI` int(11) DEFAULT NULL COMMENT 'DNI',
  `Domicilio` text COMMENT 'Domicilio',
  `idLocalidades` int(11) unsigned DEFAULT NULL COMMENT 'Localidad',
  `CPostal` text COMMENT 'Código Postal',
  `TelCel` int(11) DEFAULT NULL COMMENT 'Télefono/Celular',
  `Ocupacion` text COMMENT 'Ocupación',
  `Email` text COMMENT 'Email',
  `Facebook` text COMMENT 'Facebook',
  `AutorizaWeb` tinyint(4) DEFAULT NULL COMMENT 'Autoriza su imagen en la web',
  `AptoMedico` tinyint(4) DEFAULT NULL COMMENT 'Entregó el apto médico',
  `CoberturaMedica` text COMMENT 'Cobertura Médica',
  `NumSocioMed` text COMMENT 'Número de socio de la cobertura',
  `TelEmergencias` int(11) DEFAULT NULL COMMENT 'Teléfono de emergencias',
  `idGrupoFactorSanguineo` int(11) unsigned DEFAULT NULL COMMENT 'Grupo y Factor Sanguíneo',
  `Alergia` text COMMENT 'Alergias',
  `Patologia` text COMMENT 'Patologías',
  `IntQuirurgica` text COMMENT 'Intervenciones quirúrgicas',
  `Lesion` text COMMENT 'Lesiones',
  `Medicacion` text COMMENT 'Medicación',
  `Observaciones` text COMMENT 'Observaciones',
  `PadMadTut` text COMMENT 'Nombre del Padre/Madre/Tutor',
  `TelPadMadTut` int(11) DEFAULT NULL COMMENT 'Teléfono del Padre/Madre/Tutor',
  `CelPadMadTut` int(11) DEFAULT NULL COMMENT 'Celular del Padre/Madre/Tutor',
  `EmailPadMadTut` text COMMENT 'Email del Padre/Madre/Tutor',
  `SeVaSolo` tinyint(4) DEFAULT NULL COMMENT 'Se va solo/a',
  `Retirar1NomAp` text COMMENT 'Autorizado a retirar 1: nombre y apellido',
  `Retirar1DNI` int(11) DEFAULT NULL COMMENT 'Autorizado a retirar 1: DNI',
  `Retirar2NomAp` text COMMENT 'Autorizado a retirar 2: nombre y apellido',
  `Retirar2DNI` int(11) DEFAULT NULL COMMENT 'Autorizado a retirar 1: DNI',
  `Retirar3NomAp` text COMMENT 'Autorizado a retirar 3: nombre y apellido',
  `Retirar3DNI` int(11) DEFAULT NULL COMMENT 'Autorizado a retirar 3: DNI',
  `Activo` tinyint(4) NOT NULL COMMENT 'Está actualmente activo',
  `EsInstructor` tinyint(4) DEFAULT NULL COMMENT 'Es Instructor',
  `idCategorias` int(11) unsigned DEFAULT NULL COMMENT 'Categoría',
  `idSedes` int(11) unsigned NOT NULL COMMENT 'Sede',
  `PagoMatricula` date DEFAULT NULL COMMENT 'Última vez que pago la matrícula',
  `SemestresRestraso` int(11) DEFAULT NULL COMMENT 'Semestres pospuestos para examen',
  PRIMARY KEY (`idClientes`),
  KEY `fk_Clientes_Localidades_idx` (`idLocalidades`),
  KEY `fk_Clientes_Categorias1_idx` (`idCategorias`),
  KEY `fk_Clientes_GrupoFactorSanguineo1_idx` (`idGrupoFactorSanguineo`),
  KEY `fk_Clientes_Sedes1_idx` (`idSedes`),
  KEY `idSexos` (`idSexos`),
  CONSTRAINT `clientes_ibfk_10` FOREIGN KEY (`idLocalidades`) REFERENCES `localidades` (`idLocalidades`),
  CONSTRAINT `clientes_ibfk_11` FOREIGN KEY (`idSedes`) REFERENCES `sedes` (`idSedes`),
  CONSTRAINT `clientes_ibfk_12` FOREIGN KEY (`idSexos`) REFERENCES `sexos` (`idSexos`),
  CONSTRAINT `clientes_ibfk_8` FOREIGN KEY (`idCategorias`) REFERENCES `categorias` (`idCategorias`),
  CONSTRAINT `clientes_ibfk_9` FOREIGN KEY (`idGrupoFactorSanguineo`) REFERENCES `grupofactorsanguineo` (`idGrupoFactorSanguineo`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Patricio','Bruno','1999-07-30',2,123,'d',NULL,'24',23,'sdf','gyj','fth',0,0,'jjj',NULL,0,NULL,NULL,'MUCHAAAASS ENFERMEDADEES',NULL,NULL,NULL,NULL,NULL,0,0,NULL,0,NULL,0,NULL,0,NULL,0,1,1,13,1,'2017-08-17',1),(2,'Dario','Bruno','1969-09-22',2,NULL,'AK en KSAsdfsdf',7,'todo',NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,1,1,11,1,'2016-11-24',2),(3,'Silvia','Fischman','1971-04-08',1,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,2,1,NULL,NULL),(5,'The Marto','Nais','2000-06-15',2,234567,NULL,1,NULL,NULL,NULL,'HIJODEPUTA','yOeLIYTO dé billa ReEal #real',0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,1,1,9,1,NULL,NULL),(10,'Alan','Fried','2000-06-08',2,423456,'Ramos',1,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,1,0,3,1,NULL,NULL),(11,'asdasd','asd','1984-06-20',2,NULL,NULL,7,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,4,1,0,2,1,NULL,NULL),(12,'Violeta','Huñis','2001-06-30',1,NULL,'33 orientalwes',2,NULL,NULL,'ahi en la esquina',NULL,'la violeXD',1,1,NULL,NULL,NULL,7,NULL,'sida, entre otras','la rodilla','la rodilla','porro','es medio boba',NULL,NULL,NULL,NULL,0,'yo',42077426,NULL,NULL,NULL,NULL,1,0,NULL,1,NULL,NULL),(20,'Test','ing',NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,1,0,3,1,NULL,NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientesactividades`
--

DROP TABLE IF EXISTS `clientesactividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientesactividades` (
  `idClientesActividades` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idClientes` int(11) unsigned NOT NULL,
  `idActividades` int(11) unsigned zerofill NOT NULL,
  `idModosDePago` int(11) unsigned NOT NULL,
  `idModalidades` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`idClientesActividades`),
  KEY `idClientes` (`idClientes`),
  KEY `idActividadesModalidadesNiveles` (`idActividades`),
  KEY `idModalidades` (`idModalidades`),
  KEY `idModosDePago` (`idModosDePago`),
  CONSTRAINT `clientesactividades_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `clientesactividades_ibfk_2` FOREIGN KEY (`idActividades`) REFERENCES `actividades` (`idActividades`),
  CONSTRAINT `clientesactividades_ibfk_3` FOREIGN KEY (`idModalidades`) REFERENCES `modalidades` (`idModalidades`),
  CONSTRAINT `clientesactividades_ibfk_4` FOREIGN KEY (`idModosDePago`) REFERENCES `modosdepago` (`idModosDePago`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientesactividades`
--

LOCK TABLES `clientesactividades` WRITE;
/*!40000 ALTER TABLE `clientesactividades` DISABLE KEYS */;
INSERT INTO `clientesactividades` VALUES (130,2,00000000010,2,1),(131,2,00000000012,1,NULL),(132,2,00000000013,2,1),(139,11,00000000010,2,2),(140,11,00000000013,2,1),(196,3,00000000016,1,NULL),(197,3,00000000013,2,1),(206,10,00000000013,2,1),(207,10,00000000008,2,2),(216,5,00000000013,2,1),(217,5,00000000006,2,2),(218,12,00000000017,2,1),(219,12,00000000013,2,1),(224,20,00000000016,1,NULL),(225,20,00000000010,2,1),(229,1,00000000010,2,1),(230,1,00000000013,2,1),(231,1,00000000012,1,NULL);
/*!40000 ALTER TABLE `clientesactividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `clientesactivos`
--

DROP TABLE IF EXISTS `clientesactivos`;
/*!50001 DROP VIEW IF EXISTS `clientesactivos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `clientesactivos` AS SELECT 
 1 AS `idClientes`,
 1 AS `Nombres`,
 1 AS `Apellidos`,
 1 AS `FechaNacimiento`,
 1 AS `idSexos`,
 1 AS `DNI`,
 1 AS `Domicilio`,
 1 AS `idLocalidades`,
 1 AS `CPostal`,
 1 AS `TelCel`,
 1 AS `Ocupacion`,
 1 AS `Email`,
 1 AS `Facebook`,
 1 AS `AutorizaWeb`,
 1 AS `AptoMedico`,
 1 AS `CoberturaMedica`,
 1 AS `NumSocioMed`,
 1 AS `TelEmergencias`,
 1 AS `idGrupoFactorSanguineo`,
 1 AS `Alergia`,
 1 AS `Patologia`,
 1 AS `IntQuirurgica`,
 1 AS `Lesion`,
 1 AS `Medicacion`,
 1 AS `Observaciones`,
 1 AS `PadMadTut`,
 1 AS `TelPadMadTut`,
 1 AS `CelPadMadTut`,
 1 AS `EmailPadMadTut`,
 1 AS `SeVaSolo`,
 1 AS `Retirar1NomAp`,
 1 AS `Retirar1DNI`,
 1 AS `Retirar2NomAp`,
 1 AS `Retirar2DNI`,
 1 AS `Retirar3NomAp`,
 1 AS `Retirar3DNI`,
 1 AS `Activo`,
 1 AS `EsInstructor`,
 1 AS `idCategorias`,
 1 AS `idSedes`,
 1 AS `PagoMatricula`,
 1 AS `SemestresRestraso`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cobros`
--

DROP TABLE IF EXISTS `cobros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cobros` (
  `idCobros` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `idClientes` int(11) unsigned NOT NULL,
  `idActividades` int(11) unsigned zerofill NOT NULL,
  `Monto` int(11) unsigned NOT NULL,
  `Fecha1` date NOT NULL,
  `Fecha2` date NOT NULL,
  PRIMARY KEY (`idCobros`),
  KEY `clientes.idClientes` (`idClientes`),
  KEY `idActividades` (`idActividades`),
  CONSTRAINT `cobros_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `cobros_ibfk_2` FOREIGN KEY (`idActividades`) REFERENCES `actividades` (`idActividades`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cobros`
--

LOCK TABLES `cobros` WRITE;
/*!40000 ALTER TABLE `cobros` DISABLE KEYS */;
INSERT INTO `cobros` VALUES (11,'2017-08-27',12,00000000017,123,'2017-08-01','2017-09-01'),(12,'2017-08-27',1,00000000012,234,'2017-08-25','2017-08-25'),(13,'2017-08-31',2,00000000010,345,'2017-08-01','2017-08-01'),(14,'2017-09-01',2,00000000010,0,'2017-08-01','2017-08-01'),(15,'2017-09-01',2,00000000010,234,'2017-08-01','2017-09-01'),(16,'2017-09-07',12,00000000017,42,'2017-10-01','2017-11-01'),(17,'2017-09-08',1,00000000010,123,'2017-09-01','2017-10-01'),(18,'2017-09-09',11,00000000010,321,'0000-00-00','0000-00-00'),(19,'2017-09-09',11,00000000010,123,'0000-00-00','0000-00-00'),(20,'2017-09-09',11,00000000010,354,'0000-00-00','0000-00-00'),(21,'2017-09-09',11,00000000010,123,'2017-09-01','2017-09-01'),(22,'2017-09-09',11,00000000010,64,'2017-09-01','2017-10-01'),(23,'2017-10-20',12,00000000017,436,'2017-10-01','2017-11-01');
/*!40000 ALTER TABLE `cobros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cobrosescuelas`
--

DROP TABLE IF EXISTS `cobrosescuelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cobrosescuelas` (
  `idCobrosEscuelas` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL COMMENT 'Fecha',
  `idSedes` int(10) unsigned NOT NULL COMMENT 'Escuela',
  `idMeses` int(10) unsigned NOT NULL COMMENT 'Mes',
  `idFondos` int(10) unsigned NOT NULL COMMENT 'Fondo al que aporta',
  `Monto` int(11) NOT NULL COMMENT 'Monto',
  PRIMARY KEY (`idCobrosEscuelas`),
  KEY `idSedes` (`idSedes`),
  KEY `idMeses` (`idMeses`),
  KEY `idFondos` (`idFondos`),
  CONSTRAINT `cobrosescuelas_ibfk_1` FOREIGN KEY (`idFondos`) REFERENCES `fondos` (`idFondos`),
  CONSTRAINT `cobrosescuelas_ibfk_2` FOREIGN KEY (`idMeses`) REFERENCES `meses` (`idMeses`),
  CONSTRAINT `cobrosescuelas_ibfk_3` FOREIGN KEY (`idSedes`) REFERENCES `sedes` (`idSedes`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cobrosescuelas`
--

LOCK TABLES `cobrosescuelas` WRITE;
/*!40000 ALTER TABLE `cobrosescuelas` DISABLE KEYS */;
INSERT INTO `cobrosescuelas` VALUES (1,'2017-10-12',3,10,3,234);
/*!40000 ALTER TABLE `cobrosescuelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `deudas`
--

DROP TABLE IF EXISTS `deudas`;
/*!50001 DROP VIEW IF EXISTS `deudas`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `deudas` AS SELECT 
 1 AS `Nombres`,
 1 AS `idActividades`,
 1 AS `Actividad`,
 1 AS `Fecha`,
 1 AS `Monto`,
 1 AS `idClientes`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `distribuidores`
--

DROP TABLE IF EXISTS `distribuidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribuidores` (
  `idDistribuidores` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Nombre',
  PRIMARY KEY (`idDistribuidores`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribuidores`
--

LOCK TABLES `distribuidores` WRITE;
/*!40000 ALTER TABLE `distribuidores` DISABLE KEYS */;
INSERT INTO `distribuidores` VALUES (2,'locuelo'),(4,'OMG');
/*!40000 ALTER TABLE `distribuidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `egresos`
--

DROP TABLE IF EXISTS `egresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `egresos` (
  `idEgresos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL COMMENT 'Fecha',
  `Monto` decimal(10,0) unsigned NOT NULL COMMENT 'Monto',
  `idFuentesDeEgresos` int(10) unsigned NOT NULL COMMENT 'Fuente de Egreso',
  `idFondos` int(10) unsigned NOT NULL COMMENT ' Fondo del que descuenta ',
  PRIMARY KEY (`idEgresos`),
  KEY `idFuentesDeEgresos` (`idFuentesDeEgresos`),
  KEY `idFondos` (`idFondos`),
  CONSTRAINT `egresos_ibfk_1` FOREIGN KEY (`idFondos`) REFERENCES `fondos` (`idFondos`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `egresos`
--

LOCK TABLES `egresos` WRITE;
/*!40000 ALTER TABLE `egresos` DISABLE KEYS */;
INSERT INTO `egresos` VALUES (1,'2017-08-24',456,1,2),(2,'2017-09-12',345,2,2),(3,'2017-09-11',568,3,2),(4,'2017-10-10',346,1,2);
/*!40000 ALTER TABLE `egresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `egresosbrutos`
--

DROP TABLE IF EXISTS `egresosbrutos`;
/*!50001 DROP VIEW IF EXISTS `egresosbrutos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `egresosbrutos` AS SELECT 
 1 AS `Nombre`,
 1 AS `Monto`,
 1 AS `Fecha`,
 1 AS `idFondos`,
 1 AS `Tipo`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `eventosinstructores`
--

DROP TABLE IF EXISTS `eventosinstructores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventosinstructores` (
  `idEventoInstructores` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idClientes` int(11) unsigned NOT NULL,
  `idActividades` int(11) unsigned zerofill NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`idEventoInstructores`),
  KEY `idClientes` (`idClientes`),
  KEY `idActividades` (`idActividades`),
  CONSTRAINT `eventosinstructores_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `eventosinstructores_ibfk_2` FOREIGN KEY (`idActividades`) REFERENCES `actividades` (`idActividades`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventosinstructores`
--

LOCK TABLES `eventosinstructores` WRITE;
/*!40000 ALTER TABLE `eventosinstructores` DISABLE KEYS */;
INSERT INTO `eventosinstructores` VALUES (2,1,00000000012,'0000-00-00'),(3,1,00000000012,'0000-00-00'),(4,1,00000000012,'0000-00-00'),(5,1,00000000012,'2017-08-25'),(6,1,00000000012,'2017-08-25'),(7,1,00000000012,'2017-08-25'),(8,1,00000000012,'2017-08-25'),(9,1,00000000012,'2017-08-25'),(10,1,00000000017,'2017-08-25'),(11,1,00000000010,'2017-08-01'),(12,1,00000000010,'2017-08-01'),(13,1,00000000010,'2017-08-03'),(14,1,00000000010,'2017-08-02'),(15,1,00000000010,'2017-08-09'),(16,1,00000000010,'2017-08-16'),(17,1,00000000010,'2017-08-23'),(18,1,00000000010,'2017-09-04'),(19,1,00000000010,'2017-09-05'),(20,1,00000000010,'2017-09-06'),(21,1,00000000010,'2017-09-07'),(25,1,00000000013,'2017-09-22'),(26,2,00000000012,'2017-09-22'),(27,2,00000000017,'2017-10-11'),(28,2,00000000010,'2017-10-19'),(29,1,00000000017,'2017-10-20');
/*!40000 ALTER TABLE `eventosinstructores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `excesoasistencia`
--

DROP TABLE IF EXISTS `excesoasistencia`;
/*!50001 DROP VIEW IF EXISTS `excesoasistencia`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `excesoasistencia` AS SELECT 
 1 AS `Nombres`,
 1 AS `idActividades`,
 1 AS `Actividad`,
 1 AS `idClientes`,
 1 AS `Fecha`,
 1 AS `Asistencias`,
 1 AS `MaxXSemana`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `fondos`
--

DROP TABLE IF EXISTS `fondos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fondos` (
  `idFondos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Nombre',
  PRIMARY KEY (`idFondos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fondos`
--

LOCK TABLES `fondos` WRITE;
/*!40000 ALTER TABLE `fondos` DISABLE KEYS */;
INSERT INTO `fondos` VALUES (1,'Competidores'),(2,'Prueba'),(3,'BBG');
/*!40000 ALTER TABLE `fondos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuentesdeegresos`
--

DROP TABLE IF EXISTS `fuentesdeegresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuentesdeegresos` (
  `idFuentesDeEgresos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  PRIMARY KEY (`idFuentesDeEgresos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuentesdeegresos`
--

LOCK TABLES `fuentesdeegresos` WRITE;
/*!40000 ALTER TABLE `fuentesdeegresos` DISABLE KEYS */;
INSERT INTO `fuentesdeegresos` VALUES (1,'Limpieza'),(2,'Telecentro'),(3,'Gas');
/*!40000 ALTER TABLE `fuentesdeegresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupofactorsanguineo`
--

DROP TABLE IF EXISTS `grupofactorsanguineo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupofactorsanguineo` (
  `idGrupoFactorSanguineo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` tinytext,
  PRIMARY KEY (`idGrupoFactorSanguineo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupofactorsanguineo`
--

LOCK TABLES `grupofactorsanguineo` WRITE;
/*!40000 ALTER TABLE `grupofactorsanguineo` DISABLE KEYS */;
INSERT INTO `grupofactorsanguineo` VALUES (1,'A+'),(2,'A-'),(3,'B+'),(4,'B-'),(5,'AB+'),(6,'AB-'),(7,'0+'),(8,'0-');
/*!40000 ALTER TABLE `grupofactorsanguineo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `ingresosbrutos`
--

DROP TABLE IF EXISTS `ingresosbrutos`;
/*!50001 DROP VIEW IF EXISTS `ingresosbrutos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ingresosbrutos` AS SELECT 
 1 AS `Nombre`,
 1 AS `Monto`,
 1 AS `Fecha`,
 1 AS `idFondos`,
 1 AS `Tipo`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `localidades`
--

DROP TABLE IF EXISTS `localidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localidades` (
  `idLocalidades` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text COMMENT 'Nombre',
  PRIMARY KEY (`idLocalidades`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localidades`
--

LOCK TABLES `localidades` WRITE;
/*!40000 ALTER TABLE `localidades` DISABLE KEYS */;
INSERT INTO `localidades` VALUES (1,'Agronomía'),(2,'Almagro'),(3,'Balvanera'),(4,'Barracas'),(5,'Belgrano'),(6,'Boedo'),(7,'Caballito'),(8,'Chacarita'),(9,'Coghlan'),(10,'Colegiales'),(11,'Constitución'),(12,'La Boca'),(13,'La Paternal'),(14,'Liniers'),(15,'Mataderos'),(16,'Monte Castro'),(17,'Monserrat'),(18,'Nueva Pompeya'),(19,'Núñez'),(20,'Palermo'),(21,'Parque Avellaneda'),(22,'Parque Chacabuco'),(23,'Parque Chas'),(24,'Parque Patricios'),(25,'Puerto Madero'),(26,'Recoleta'),(27,'Retiro'),(28,'Recoleta'),(29,'Saavedra'),(30,'San Cristóbal'),(31,'San Nicolás'),(32,'San Telmo'),(33,'Vélez Sársfield'),(34,'Versalles'),(35,'Villa Crespo'),(36,'Villa del Parque'),(37,'Villa Devoto'),(38,'Villa General Mitre'),(39,'Villa Lugano'),(40,'Villa Luro'),(41,'Villa Ortúzar'),(42,'Villa Pueyrredón'),(43,'Villa Real'),(44,'Villa Riachuelo'),(45,'Villa Santa Rita'),(46,'Villa Soldati'),(47,'Villa Urquiza'),(52,'aaa'),(53,'aaa');
/*!40000 ALTER TABLE `localidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meses`
--

DROP TABLE IF EXISTS `meses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meses` (
  `idMeses` int(10) unsigned NOT NULL,
  `Nombre` text NOT NULL,
  PRIMARY KEY (`idMeses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meses`
--

LOCK TABLES `meses` WRITE;
/*!40000 ALTER TABLE `meses` DISABLE KEYS */;
INSERT INTO `meses` VALUES (1,'Enero'),(2,'Febrero'),(3,'Marzo'),(4,'Abril'),(5,'Mayo'),(6,'Junio'),(7,'Julio'),(8,'Agosto'),(9,'Septiembre'),(10,'Octubre'),(11,'Noviembre'),(12,'Diciembre');
/*!40000 ALTER TABLE `meses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalidades`
--

DROP TABLE IF EXISTS `modalidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalidades` (
  `idModalidades` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Nombre',
  `MaxXSemana` int(11) NOT NULL COMMENT 'Máximo permitido por semana',
  PRIMARY KEY (`idModalidades`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalidades`
--

LOCK TABLES `modalidades` WRITE;
/*!40000 ALTER TABLE `modalidades` DISABLE KEYS */;
INSERT INTO `modalidades` VALUES (1,'Pase libre',100),(2,'1 a 2 veces por semana',2);
/*!40000 ALTER TABLE `modalidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modosdepago`
--

DROP TABLE IF EXISTS `modosdepago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modosdepago` (
  `idModosDePago` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  PRIMARY KEY (`idModosDePago`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modosdepago`
--

LOCK TABLES `modosdepago` WRITE;
/*!40000 ALTER TABLE `modosdepago` DISABLE KEYS */;
INSERT INTO `modosdepago` VALUES (1,'Por Clase'),(2,'Por Mes');
/*!40000 ALTER TABLE `modosdepago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagodesueldos`
--

DROP TABLE IF EXISTS `pagodesueldos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagodesueldos` (
  `idPagoDeSueldos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL COMMENT 'Fecha',
  `idFondos` int(10) unsigned NOT NULL COMMENT 'Fondo del que descuenta',
  `idClientes` int(10) unsigned NOT NULL COMMENT 'Instructor',
  `idMeses` int(10) unsigned NOT NULL COMMENT 'Mes que se paga',
  `Monto` int(11) NOT NULL COMMENT 'Monto',
  PRIMARY KEY (`idPagoDeSueldos`),
  KEY `idClientes` (`idClientes`),
  KEY `idFondos` (`idFondos`),
  KEY `idMeses` (`idMeses`),
  CONSTRAINT `pagodesueldos_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `pagodesueldos_ibfk_2` FOREIGN KEY (`idFondos`) REFERENCES `fondos` (`idFondos`),
  CONSTRAINT `pagodesueldos_ibfk_3` FOREIGN KEY (`idMeses`) REFERENCES `meses` (`idMeses`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagodesueldos`
--

LOCK TABLES `pagodesueldos` WRITE;
/*!40000 ALTER TABLE `pagodesueldos` DISABLE KEYS */;
INSERT INTO `pagodesueldos` VALUES (1,'2017-09-24',3,1,8,2600),(2,'2017-09-24',3,2,9,100);
/*!40000 ALTER TABLE `pagodesueldos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `idProductos` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Descripción',
  `idDistribuidores` int(11) unsigned NOT NULL COMMENT 'Distribuidor',
  `Precio` decimal(10,0) NOT NULL COMMENT 'Precio',
  `Stock` int(11) NOT NULL COMMENT 'Stock',
  `Avisar` int(11) NOT NULL COMMENT 'Avisar cuando el stock llegue a esta cantidad:',
  PRIMARY KEY (`idProductos`),
  KEY `idDistribuidor` (`idDistribuidores`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idDistribuidores`) REFERENCES `distribuidores` (`idDistribuidores`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (3,'Gatorade 200ml',4,769,70,15),(4,'Papota 2000',2,42453,415,10),(6,'poder',2,123,123124,2),(7,'Pito poderoso',2,123,20,2020202020);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrocompras`
--

DROP TABLE IF EXISTS `registrocompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrocompras` (
  `idRegistroCompras` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL COMMENT 'Fecha',
  `idProductos` int(10) unsigned NOT NULL COMMENT 'Producto',
  `idFondos` int(11) unsigned NOT NULL COMMENT 'Fondo del que descuenta',
  `Cantidad` int(11) unsigned NOT NULL COMMENT 'Cantidad',
  `MontoInd` int(11) unsigned NOT NULL COMMENT 'Monto Individual',
  PRIMARY KEY (`idRegistroCompras`),
  KEY `idProductos` (`idProductos`),
  KEY `idFondos` (`idFondos`),
  CONSTRAINT `registrocompras_ibfk_1` FOREIGN KEY (`idProductos`) REFERENCES `productos` (`idProductos`),
  CONSTRAINT `registrocompras_ibfk_2` FOREIGN KEY (`idFondos`) REFERENCES `fondos` (`idFondos`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrocompras`
--

LOCK TABLES `registrocompras` WRITE;
/*!40000 ALTER TABLE `registrocompras` DISABLE KEYS */;
INSERT INTO `registrocompras` VALUES (54,'2017-06-11',3,3,0,5),(55,'2017-06-08',3,3,4,44),(56,'2017-06-11',3,3,6,5),(57,'2017-06-11',3,3,70,6),(58,'2017-06-11',3,3,4,4),(59,'2017-06-11',3,3,5,5),(60,'2017-06-08',3,3,6,6),(61,'2017-06-11',3,3,6,6),(62,'2017-06-11',3,3,4,4),(63,'2017-06-08',3,3,4,44),(64,'2017-06-21',3,3,2,2),(65,'2017-06-21',3,3,123,123),(66,'2017-06-21',6,3,123123,2),(67,'2017-06-24',7,3,1000,46),(68,'2017-06-24',7,3,220,27060),(69,'2017-06-24',7,3,220,27060),(70,'2017-06-24',7,3,690,84870),(71,'2017-06-24',7,3,1380,169740),(72,'2017-06-30',4,3,100,16),(73,'2017-06-30',3,3,15,8),(74,'2017-08-04',3,3,345,345),(75,'0000-00-00',7,3,1,123),(76,'2017-08-23',3,3,5,3),(77,'2017-08-23',3,3,5,3),(78,'2017-08-23',3,3,5,3),(79,'2017-08-23',3,3,5,3),(80,'2017-08-16',3,3,500,6),(81,'2017-08-24',3,3,1000,23),(82,'2017-08-03',3,3,50,32),(83,'2017-08-24',3,3,20,34),(84,'2017-08-24',3,3,500,234),(85,'2017-08-24',3,3,70,234),(86,'2017-08-24',3,3,70,70),(87,'2017-10-18',4,2,2,123),(88,'2017-10-19',3,3,2,234);
/*!40000 ALTER TABLE `registrocompras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registroexamenes`
--

DROP TABLE IF EXISTS `registroexamenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registroexamenes` (
  `idRegistroExamenes` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idClientes` int(10) unsigned NOT NULL COMMENT 'Cliente',
  `Fecha` date NOT NULL COMMENT 'Fecha del Examen',
  `idCategorias` int(10) unsigned NOT NULL COMMENT 'Categoría obtenida',
  PRIMARY KEY (`idRegistroExamenes`),
  KEY `idClientes` (`idClientes`),
  KEY `idCategorias` (`idCategorias`),
  CONSTRAINT `registroexamenes_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`),
  CONSTRAINT `registroexamenes_ibfk_2` FOREIGN KEY (`idCategorias`) REFERENCES `categorias` (`idCategorias`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registroexamenes`
--

LOCK TABLES `registroexamenes` WRITE;
/*!40000 ALTER TABLE `registroexamenes` DISABLE KEYS */;
INSERT INTO `registroexamenes` VALUES (1,10,'2017-10-20',3),(2,11,'2017-09-29',2),(3,20,'2017-08-08',3),(4,5,'2017-02-09',9),(5,3,'2017-03-25',2),(6,1,'2017-07-21',13),(7,2,'2017-01-01',11);
/*!40000 ALTER TABLE `registroexamenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registroventas`
--

DROP TABLE IF EXISTS `registroventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registroventas` (
  `idRegistroVentas` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL COMMENT 'Fecha',
  `idProductos` int(11) unsigned NOT NULL COMMENT 'Producto',
  `idFondos` int(10) unsigned NOT NULL COMMENT 'Fondo al que aporta',
  `Cantidad` int(11) NOT NULL COMMENT 'Cantidad',
  `Monto` int(11) unsigned NOT NULL COMMENT 'Monto Total',
  PRIMARY KEY (`idRegistroVentas`),
  KEY `idProductos` (`idProductos`),
  KEY `idFondos` (`idFondos`),
  CONSTRAINT `registroventas_ibfk_1` FOREIGN KEY (`idProductos`) REFERENCES `productos` (`idProductos`),
  CONSTRAINT `registroventas_ibfk_2` FOREIGN KEY (`idFondos`) REFERENCES `productos` (`idProductos`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registroventas`
--

LOCK TABLES `registroventas` WRITE;
/*!40000 ALTER TABLE `registroventas` DISABLE KEYS */;
INSERT INTO `registroventas` VALUES (9,'2017-06-11',4,3,1,42453),(10,'2017-06-11',3,3,70,53830),(11,'2017-06-11',3,3,70,53830),(12,'2017-06-11',3,3,70,53830),(13,'2017-06-11',3,3,4,769),(14,'2017-06-11',3,3,5,769),(15,'2017-06-02',3,3,6,769),(16,'2017-06-11',3,3,6,4614),(17,'2017-06-09',3,3,3,769),(18,'2017-06-21',6,3,2,246),(19,'2017-06-24',7,3,20,234),(20,'2017-06-24',7,3,41,5043),(21,'2017-06-24',7,3,60,456),(22,'2017-06-24',7,3,85,324),(23,'2017-06-24',7,3,2,345),(24,'2017-06-24',7,3,170,2),(25,'2017-06-24',7,3,400,3),(26,'2017-06-24',7,3,2,12),(27,'2017-06-24',7,3,2000,123),(28,'2017-06-24',7,3,751,92373),(29,'2017-06-30',4,3,100,4245300),(30,'2017-08-09',3,3,-50,234),(31,'2017-08-24',3,3,-10,7690),(32,'2017-08-24',3,3,-500,384500),(33,'2017-08-24',3,3,-70,53830),(34,'2017-08-24',3,3,-7,5383),(35,'2017-08-24',3,3,-7,5383),(36,'2017-10-11',3,3,-1,769);
/*!40000 ALTER TABLE `registroventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sedes`
--

DROP TABLE IF EXISTS `sedes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sedes` (
  `idSedes` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Nombre',
  `EsEscuela` tinyint(4) NOT NULL COMMENT 'Es Escuela',
  PRIMARY KEY (`idSedes`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sedes`
--

LOCK TABLES `sedes` WRITE;
/*!40000 ALTER TABLE `sedes` DISABLE KEYS */;
INSERT INTO `sedes` VALUES (1,'Sede Central',0),(2,'Sede CIPAE',0),(3,'Escuela Miguel Hernández',1),(4,'Sede Adrenaline',0),(5,'Colegio Integral Caballito',1);
/*!40000 ALTER TABLE `sedes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sexos`
--

DROP TABLE IF EXISTS `sexos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sexos` (
  `idSexos` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  PRIMARY KEY (`idSexos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sexos`
--

LOCK TABLES `sexos` WRITE;
/*!40000 ALTER TABLE `sexos` DISABLE KEYS */;
INSERT INTO `sexos` VALUES (1,'Mujer'),(2,'Hombre'),(3,'Otro');
/*!40000 ALTER TABLE `sexos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subactividades`
--

DROP TABLE IF EXISTS `subactividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subactividades` (
  `idSubactividades` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `idActividades` int(10) unsigned zerofill NOT NULL,
  `idEvento` text NOT NULL,
  PRIMARY KEY (`idSubactividades`),
  KEY `idActividades` (`idActividades`),
  CONSTRAINT `subactividades_ibfk_1` FOREIGN KEY (`idActividades`) REFERENCES `actividades` (`idActividades`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subactividades`
--

LOCK TABLES `subactividades` WRITE;
/*!40000 ALTER TABLE `subactividades` DISABLE KEYS */;
INSERT INTO `subactividades` VALUES (4,'Funcional Mañana',0000000013,'676jqn29t9icq63g5kf0f5nhec'),(5,'Funcional Tarde',0000000013,'d2kvcoigs8le58a5qmk7cqqnic'),(6,'Funcional Noche',0000000013,'tt3r2uvvubaphe7eh57m0u9em0'),(7,'Personalizado con Cheto n1',0000000016,'ldgumatjuldh96i79odt84ps00'),(8,'Personalizado con Cheto n2',0000000016,'0ldam6oc7ol8l2dkh06smm4r44');
/*!40000 ALTER TABLE `subactividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL COMMENT 'Usuario',
  `Password` text NOT NULL COMMENT 'Contraseña',
  PRIMARY KEY (`idUsuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','$2y$10$X7bew3LWP1X7JVoxItnVeu/9FENRb3BWhLzlzzt0gysmMrtaJ6UAO'),(2,'Gerente','$2y$10$UNFY3wDAFkUnG3k/eo01CedDbeM0bWMgmTNhJFSBzOE3CWi9eOYDu'),(3,'Instructor','$2y$10$jyrm0DrUzgQzxLZRwaPi7.Rg3Tt3GqwpOtfZsdVtEbN3voH9x.XXC');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `dbproyectofinal`
--

USE `dbproyectofinal`;

--
-- Final view structure for view `clientesactivos`
--

/*!50001 DROP VIEW IF EXISTS `clientesactivos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER */
/*!50001 VIEW `clientesactivos` AS select `clientes`.`idClientes` AS `idClientes`,`clientes`.`Nombres` AS `Nombres`,`clientes`.`Apellidos` AS `Apellidos`,`clientes`.`FechaNacimiento` AS `FechaNacimiento`,`clientes`.`idSexos` AS `idSexos`,`clientes`.`DNI` AS `DNI`,`clientes`.`Domicilio` AS `Domicilio`,`clientes`.`idLocalidades` AS `idLocalidades`,`clientes`.`CPostal` AS `CPostal`,`clientes`.`TelCel` AS `TelCel`,`clientes`.`Ocupacion` AS `Ocupacion`,`clientes`.`Email` AS `Email`,`clientes`.`Facebook` AS `Facebook`,`clientes`.`AutorizaWeb` AS `AutorizaWeb`,`clientes`.`AptoMedico` AS `AptoMedico`,`clientes`.`CoberturaMedica` AS `CoberturaMedica`,`clientes`.`NumSocioMed` AS `NumSocioMed`,`clientes`.`TelEmergencias` AS `TelEmergencias`,`clientes`.`idGrupoFactorSanguineo` AS `idGrupoFactorSanguineo`,`clientes`.`Alergia` AS `Alergia`,`clientes`.`Patologia` AS `Patologia`,`clientes`.`IntQuirurgica` AS `IntQuirurgica`,`clientes`.`Lesion` AS `Lesion`,`clientes`.`Medicacion` AS `Medicacion`,`clientes`.`Observaciones` AS `Observaciones`,`clientes`.`PadMadTut` AS `PadMadTut`,`clientes`.`TelPadMadTut` AS `TelPadMadTut`,`clientes`.`CelPadMadTut` AS `CelPadMadTut`,`clientes`.`EmailPadMadTut` AS `EmailPadMadTut`,`clientes`.`SeVaSolo` AS `SeVaSolo`,`clientes`.`Retirar1NomAp` AS `Retirar1NomAp`,`clientes`.`Retirar1DNI` AS `Retirar1DNI`,`clientes`.`Retirar2NomAp` AS `Retirar2NomAp`,`clientes`.`Retirar2DNI` AS `Retirar2DNI`,`clientes`.`Retirar3NomAp` AS `Retirar3NomAp`,`clientes`.`Retirar3DNI` AS `Retirar3DNI`,`clientes`.`Activo` AS `Activo`,`clientes`.`EsInstructor` AS `EsInstructor`,`clientes`.`idCategorias` AS `idCategorias`,`clientes`.`idSedes` AS `idSedes`,`clientes`.`PagoMatricula` AS `PagoMatricula`,`clientes`.`SemestresRestraso` AS `SemestresRestraso` from `clientes` where (`clientes`.`Activo` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `deudas`
--

/*!50001 DROP VIEW IF EXISTS `deudas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER */
/*!50001 VIEW `deudas` AS select distinct concat(`clientes`.`Nombres`,' ',`clientes`.`Apellidos`) AS `Nombres`,`asistencias`.`idActividades` AS `idActividades`,`actividades`.`Nombre` AS `Actividad`,if(((select `clientesactividades`.`idModosDePago` from `clientesactividades` where ((`clientesactividades`.`idClientes` = `asistencias`.`idClientes`) and (`clientesactividades`.`idActividades` = `asistencias`.`idActividades`))) = 2),(select `meses`.`Nombre` from `meses` where (`meses`.`idMeses` = month(`asistencias`.`Fecha`))),convert(substr(`asistencias`.`Fecha`,1,10) using utf8)) AS `Fecha`,(select `actividadesaranceles`.`Precio` from `actividadesaranceles` where ((`actividadesaranceles`.`idActividades` = `asistencias`.`idActividades`) and (`actividadesaranceles`.`FechaInicio` < `asistencias`.`Fecha`) and (`actividadesaranceles`.`idModosDePago` = (select `clientesactividades`.`idModosDePago` from `clientesactividades` where ((`clientesactividades`.`idClientes` = `asistencias`.`idClientes`) and (`clientesactividades`.`idActividades` = `asistencias`.`idActividades`)))) and (`actividadesaranceles`.`idModalidades` <=> (select `clientesactividades`.`idModalidades` from `clientesactividades` where ((`clientesactividades`.`idClientes` = `asistencias`.`idClientes`) and (`clientesactividades`.`idActividades` = `asistencias`.`idActividades`))))) order by `actividadesaranceles`.`FechaInicio` desc limit 1) AS `Monto`,`asistencias`.`idClientes` AS `idClientes` from ((`asistencias` join `clientes` on((`asistencias`.`idClientes` = `clientes`.`idClientes`))) join `actividades` on((`asistencias`.`idActividades` = `actividades`.`idActividades`))) where (`asistencias`.`Abonado` = 0) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `egresosbrutos`
--

/*!50001 DROP VIEW IF EXISTS `egresosbrutos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER */
/*!50001 VIEW `egresosbrutos` AS select `fuentesdeegresos`.`Nombre` AS `Nombre`,`egresos`.`Monto` AS `Monto`,`egresos`.`Fecha` AS `Fecha`,`egresos`.`idFondos` AS `idFondos`,'Egreso' AS `Tipo` from (`egresos` join `fuentesdeegresos` on((`egresos`.`idFuentesDeEgresos` = `fuentesdeegresos`.`idFuentesDeEgresos`))) union select `productos`.`Nombre` AS `Nombre`,(`registrocompras`.`MontoInd` * `registrocompras`.`Cantidad`) AS `Monto`,`registrocompras`.`Fecha` AS `Fecha`,`registrocompras`.`idFondos` AS `idFondos`,'Compra de stock' AS `Tipo` from (`registrocompras` join `productos` on((`registrocompras`.`idProductos` = `productos`.`idProductos`))) union select concat(concat(`clientes`.`Nombres`,' ',`clientes`.`Apellidos`),' ',`meses`.`Nombre`) AS `Nombre`,`pagodesueldos`.`Monto` AS `Monto`,`pagodesueldos`.`Fecha` AS `Fecha`,`pagodesueldos`.`idFondos` AS `idFondos`,'Pago de sueldo' AS `Tipo` from ((`pagodesueldos` join `clientes` on((`clientes`.`idClientes` = `pagodesueldos`.`idClientes`))) join `meses` on((`meses`.`idMeses` = `pagodesueldos`.`idMeses`))) order by `Fecha` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `excesoasistencia`
--

/*!50001 DROP VIEW IF EXISTS `excesoasistencia`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER */
/*!50001 VIEW `excesoasistencia` AS select concat(`clientes`.`Nombres`,' ',`clientes`.`Apellidos`) AS `Nombres`,`asistencias`.`idActividades` AS `idActividades`,`actividades`.`Nombre` AS `Actividad`,`asistencias`.`idClientes` AS `idClientes`,`asistencias`.`Fecha` AS `Fecha`,count(0) AS `Asistencias`,(select `modalidades`.`MaxXSemana` from `modalidades` where (`modalidades`.`idModalidades` = (select `clientesactividades`.`idModalidades` from `clientesactividades` where ((`clientesactividades`.`idClientes` = `asistencias`.`idClientes`) and (`clientesactividades`.`idActividades` = `asistencias`.`idActividades`))))) AS `MaxXSemana` from ((`asistencias` left join `clientes` on((`asistencias`.`idClientes` = `clientes`.`idClientes`))) left join `actividades` on((`asistencias`.`idActividades` = `actividades`.`idActividades`))) where (`asistencias`.`Abonado` = 1) group by week(`asistencias`.`Fecha`,0) having (count(0) > `MaxXSemana`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ingresosbrutos`
--

/*!50001 DROP VIEW IF EXISTS `ingresosbrutos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER */
/*!50001 VIEW `ingresosbrutos` AS select concat(concat(`clientes`.`Nombres`,' ',`clientes`.`Apellidos`),' ',`actividades`.`Nombre`) AS `Nombre`,`cobros`.`Monto` AS `Monto`,`cobros`.`Fecha` AS `Fecha`,`actividades`.`idFondos` AS `idFondos`,'Cobro de actividad' AS `Tipo` from ((`cobros` join `actividades` on((`cobros`.`idActividades` = `actividades`.`idActividades`))) join `clientes` on((`cobros`.`idClientes` = `clientes`.`idClientes`))) union select `productos`.`Nombre` AS `Nombre`,`registroventas`.`Monto` AS `Monto`,`registroventas`.`Fecha` AS `Fecha`,`registroventas`.`idFondos` AS `idFondos`,'Venta de stock' AS `Tipo` from (`registroventas` join `productos` on((`registroventas`.`idProductos` = `productos`.`idProductos`))) union select concat(`sedes`.`Nombre`,' ',`meses`.`Nombre`) AS `Nombre`,`cobrosescuelas`.`Monto` AS `Monto`,`cobrosescuelas`.`Fecha` AS `Fecha`,`cobrosescuelas`.`idFondos` AS `idFondos`,'Cobro a escuela' AS `Tipo` from ((`cobrosescuelas` join `sedes` on((`sedes`.`idSedes` = `cobrosescuelas`.`idSedes`))) join `meses` on((`meses`.`idMeses` = `cobrosescuelas`.`idMeses`))) order by `Fecha` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-24  9:34:06
