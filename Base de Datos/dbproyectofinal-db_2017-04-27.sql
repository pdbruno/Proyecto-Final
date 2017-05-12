-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-04-2017 a las 04:24:53
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
  `idActividades` int(11) NOT NULL,
  `Nombre` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategorias` int(11) NOT NULL,
  `Nombre` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idClientes` int(11) NOT NULL,
  `Nombres` text,
  `Apellidos` text,
  `FechaNacimiento` date DEFAULT NULL,
  `DNI` int(11) DEFAULT NULL,
  `Domicilio` text,
  `IdLocalidades` int(11) DEFAULT NULL,
  `CPostal` text,
  `Tel-Cel` int(11) DEFAULT NULL,
  `Ocupacion` text,
  `Email` text,
  `Facebook` text,
  `AutorizaWeb` tinyint(1) DEFAULT NULL,
  `AptoMedico` tinyint(1) DEFAULT NULL,
  `CoberturaMedica` text,
  `NumSocioMed` text,
  `TelEmergencias` int(11) DEFAULT NULL,
  `IdGrupoFactorSanguineo` int(11) DEFAULT NULL,
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
  `IdCategorias` int(11) DEFAULT NULL,
  `IdActividades` int(11) DEFAULT NULL,
  `IdSedes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idClientes`, `Nombres`, `Apellidos`, `FechaNacimiento`, `DNI`, `Domicilio`, `IdLocalidades`, `CPostal`, `Tel-Cel`, `Ocupacion`, `Email`, `Facebook`, `AutorizaWeb`, `AptoMedico`, `CoberturaMedica`, `NumSocioMed`, `TelEmergencias`, `IdGrupoFactorSanguineo`, `Alergia`, `Patologia`, `IntQuirurgica`, `Lesion`, `Medicacion`, `Observaciones`, `PadMadTut`, `TelPadMadTut`, `CelPadMadTut`, `EmailPadMadTut`, `SeVaSolo`, `Retirar1NomAp`, `Retirar1DNI`, `Retirar2NomAp`, `Retirar2DNI`, `Retirar3NomAp`, `Retirar3DNI`, `Activo`, `EsInstructor`, `IdCategorias`, `IdActividades`, `IdSedes`) VALUES
(2, 'Patricio', 'Bruno', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Dario', 'Bruno', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Silvia', 'Fischman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupofactorsanguineo`
--

CREATE TABLE `grupofactorsanguineo` (
  `idIdGrupoFactorSanguineo` int(11) NOT NULL,
  `Nombre` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `idLocalidades` int(11) NOT NULL,
  `Nombre` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `idSedes` int(11) NOT NULL,
  `Nombre` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_cl_nyap`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_cl_nyap` (
`Nombres` text
,`Apellidos` text
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_cl_nyap`
--
DROP TABLE IF EXISTS `v_cl_nyap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_cl_nyap`  AS  select `clientes`.`Nombres` AS `Nombres`,`clientes`.`Apellidos` AS `Apellidos` from `clientes` ;

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
  ADD PRIMARY KEY (`idIdGrupoFactorSanguineo`);

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
  MODIFY `idActividades` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategorias` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idClientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `grupofactorsanguineo`
--
ALTER TABLE `grupofactorsanguineo`
  MODIFY `idIdGrupoFactorSanguineo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `idLocalidades` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `idSedes` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_Clientes_Actividades1` FOREIGN KEY (`IdActividades`) REFERENCES `actividades` (`idActividades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clientes_Categorias1` FOREIGN KEY (`IdCategorias`) REFERENCES `categorias` (`idCategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clientes_GrupoFactorSanguineo1` FOREIGN KEY (`IdGrupoFactorSanguineo`) REFERENCES `grupofactorsanguineo` (`idIdGrupoFactorSanguineo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clientes_Localidades` FOREIGN KEY (`IdLocalidades`) REFERENCES `localidades` (`idLocalidades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clientes_Sedes1` FOREIGN KEY (`IdSedes`) REFERENCES `sedes` (`idSedes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
