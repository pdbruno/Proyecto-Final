-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-06-2017 a las 16:05:32
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbproyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `idActividades` int(11) UNSIGNED NOT NULL,
  `Nombre` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividades`, `Nombre`) VALUES
(1, 'Taekwon-Do'),
(2, 'Funcional'),
(3, 'Personalizado'),
(4, 'Taekwon-Do y Funcional'),
(5, 'Taekwon-Do y Personalizado'),
(6, 'Funcional y Personalizado'),
(7, 'Taekwon-Do, Funcional y Personalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategorias` int(11) UNSIGNED NOT NULL,
  `Nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategorias`, `Nombre`) VALUES
(1, 'Blanco'),
(2, 'Blanco punta amarilla'),
(3, 'Amarillo'),
(4, 'Amarillo punta verde'),
(5, 'Verde'),
(6, 'Verde punta azul'),
(7, 'Azul'),
(8, 'Azul punta roja'),
(9, 'Rojo'),
(10, 'Rojo punta negra'),
(11, '1er Dan'),
(12, '2do Dan'),
(13, '3er Dan'),
(14, '4to Dan'),
(15, '5to Dan'),
(16, '6to Dan'),
(17, 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idClientes` int(11) UNSIGNED NOT NULL,
  `Nombres` text,
  `Apellidos` text,
  `FechaNacimiento` date DEFAULT NULL,
  `DNI` int(11) DEFAULT NULL,
  `Domicilio` text,
  `IdLocalidades` int(11) UNSIGNED DEFAULT NULL,
  `CPostal` text,
  `TelCel` int(11) DEFAULT NULL,
  `Ocupacion` text,
  `Email` text,
  `Facebook` text,
  `AutorizaWeb` tinyint(1) DEFAULT NULL,
  `AptoMedico` tinyint(1) DEFAULT NULL,
  `CoberturaMedica` text,
  `NumSocioMed` text,
  `TelEmergencias` int(11) DEFAULT NULL,
  `IdGrupoFactorSanguineo` int(11) UNSIGNED DEFAULT NULL,
  `Alergia` text,
  `Patologia` text,
  `IntQuirurgica` text,
  `Lesion` text,
  `Medicacion` text,
  `Observaciones` text,
  `PadMadTut` text,
  `TelPadMadTut` int(11) DEFAULT NULL,
  `CelPadMadTut` int(11) DEFAULT NULL,
  `EmailPadMadTut` text,
  `SeVaSolo` tinyint(1) DEFAULT NULL,
  `Retirar1NomAp` text,
  `Retirar1DNI` int(11) DEFAULT NULL,
  `Retirar2NomAp` text,
  `Retirar2DNI` int(11) DEFAULT NULL,
  `Retirar3NomAp` text,
  `Retirar3DNI` int(11) DEFAULT NULL,
  `Activo` tinyint(1) DEFAULT NULL,
  `EsInstructor` tinyint(1) DEFAULT NULL,
  `IdCategorias` int(11) UNSIGNED DEFAULT NULL,
  `IdActividades` int(11) UNSIGNED DEFAULT NULL,
  `IdSedes` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idClientes`, `Nombres`, `Apellidos`, `FechaNacimiento`, `DNI`, `Domicilio`, `IdLocalidades`, `CPostal`, `TelCel`, `Ocupacion`, `Email`, `Facebook`, `AutorizaWeb`, `AptoMedico`, `CoberturaMedica`, `NumSocioMed`, `TelEmergencias`, `IdGrupoFactorSanguineo`, `Alergia`, `Patologia`, `IntQuirurgica`, `Lesion`, `Medicacion`, `Observaciones`, `PadMadTut`, `TelPadMadTut`, `CelPadMadTut`, `EmailPadMadTut`, `SeVaSolo`, `Retirar1NomAp`, `Retirar1DNI`, `Retirar2NomAp`, `Retirar2DNI`, `Retirar3NomAp`, `Retirar3DNI`, `Activo`, `EsInstructor`, `IdCategorias`, `IdActividades`, `IdSedes`) VALUES
(1, 'Patricio', 'Bruno', '1999-07-30', 4, 'd', 1, '24', 23, 'sdf', 'gyj', 'fth', 1, 1, 'jjj', NULL, 0, 1, NULL, 'MUCHAAAASS ENFERMEDADEES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'null', 0, 'null', 0, 'null', 0, 0, 0, 1, 1, 1),
(2, 'Dario', 'Bruno', NULL, NULL, 'AK en KSA', NULL, 'todo', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(3, 'Silvia', 'Fischman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'The Marto', 'Nais', NULL, 234567, NULL, NULL, NULL, NULL, NULL, 'HIJODEPUTA', 'yOeLIYTO dé billa ReEal #real', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 8, 1, 1),
(10, 'Alan', 'Fried', '1111-11-11', 423456, 'Ramos', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 1),
(19, 'asd', 'sad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(20, 'ASAMA', 'DALUMI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(21, 'por favor funciona', 'apaasd', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 5, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupofactorsanguineo`
--

CREATE TABLE `grupofactorsanguineo` (
  `idGrupoFactorSanguineo` int(11) UNSIGNED NOT NULL,
  `Nombre` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupofactorsanguineo`
--

INSERT INTO `grupofactorsanguineo` (`idGrupoFactorSanguineo`, `Nombre`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, '0+'),
(8, '0-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `idLocalidades` int(11) UNSIGNED NOT NULL,
  `Nombre` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`idLocalidades`, `Nombre`) VALUES
(1, 'Agronomía'),
(2, 'Almagro'),
(3, 'Balvanera'),
(4, 'Barracas'),
(5, 'Belgrano'),
(6, 'Boedo'),
(7, 'Caballito'),
(8, 'Chacarita'),
(9, 'Coghlan'),
(10, 'Colegiales'),
(11, 'Constitución'),
(12, 'La Boca'),
(13, 'La Paternal'),
(14, 'Liniers'),
(15, 'Mataderos'),
(16, 'Monte Castro'),
(17, 'Monserrat'),
(18, 'Nueva Pompeya'),
(19, 'Núñez'),
(20, 'Palermo'),
(21, 'Parque Avellaneda'),
(22, 'Parque Chacabuco'),
(23, 'Parque Chas'),
(24, 'Parque Patricios'),
(25, 'Puerto Madero'),
(26, 'Recoleta'),
(27, 'Retiro'),
(28, 'Recoleta'),
(29, 'Saavedra'),
(30, 'San Cristóbal'),
(31, 'San Nicolás'),
(32, 'San Telmo'),
(33, 'Vélez Sársfield'),
(34, 'Versalles'),
(35, 'Villa Crespo'),
(36, 'Villa del Parque'),
(37, 'Villa Devoto'),
(38, 'Villa General Mitre'),
(39, 'Villa Lugano'),
(40, 'Villa Luro'),
(41, 'Villa Ortúzar'),
(42, 'Villa Pueyrredón'),
(43, 'Villa Real'),
(44, 'Villa Riachuelo'),
(45, 'Villa Santa Rita'),
(46, 'Villa Soldati'),
(47, 'Villa Urquiza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `idSedes` int(11) UNSIGNED NOT NULL,
  `Nombre` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`idSedes`, `Nombre`) VALUES
(1, 'Sede Central'),
(2, 'Sede CIPAE'),
(3, 'Escuela Miguel Hernández'),
(4, 'Sede Adrenaline'),
(5, 'Colegio Integral Caballito'),
(6, 'ORT');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`idActividades`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategorias`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idClientes`),
  ADD KEY `fk_Clientes_Localidades_idx` (`IdLocalidades`),
  ADD KEY `fk_Clientes_Actividades1_idx` (`IdActividades`),
  ADD KEY `fk_Clientes_Categorias1_idx` (`IdCategorias`),
  ADD KEY `fk_Clientes_GrupoFactorSanguineo1_idx` (`IdGrupoFactorSanguineo`),
  ADD KEY `fk_Clientes_Sedes1_idx` (`IdSedes`);

--
-- Indices de la tabla `grupofactorsanguineo`
--
ALTER TABLE `grupofactorsanguineo`
  ADD PRIMARY KEY (`idGrupoFactorSanguineo`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`idLocalidades`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`idSedes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `idActividades` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategorias` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idClientes` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `grupofactorsanguineo`
--
ALTER TABLE `grupofactorsanguineo`
  MODIFY `idGrupoFactorSanguineo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `idLocalidades` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `idSedes` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`IdSedes`) REFERENCES `sedes` (`idSedes`),
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`IdActividades`) REFERENCES `actividades` (`idActividades`),
  ADD CONSTRAINT `clientes_ibfk_3` FOREIGN KEY (`IdLocalidades`) REFERENCES `localidades` (`idLocalidades`),
  ADD CONSTRAINT `clientes_ibfk_4` FOREIGN KEY (`IdCategorias`) REFERENCES `categorias` (`idCategorias`),
  ADD CONSTRAINT `clientes_ibfk_5` FOREIGN KEY (`IdGrupoFactorSanguineo`) REFERENCES `grupofactorsanguineo` (`idGrupoFactorSanguineo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
