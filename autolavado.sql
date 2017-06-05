-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2016 a las 22:47:16
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `autolavado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor`
--

CREATE TABLE IF NOT EXISTS `conductor` (
  `id_conductor` int(11) NOT NULL,
  `nombre_conductor` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor_vehiculo`
--

CREATE TABLE IF NOT EXISTS `conductor_vehiculo` (
  `fecha` date NOT NULL,
  `vehiculo_id_vehiculo` int(11) NOT NULL,
  `conductor_id_conductor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL,
  `texto` varchar(200) DEFAULT NULL,
  `imagen` varchar(200) NOT NULL,
  `placa` varchar(45) NOT NULL,
  `revisiones_conductor_vehiculo_vehiculo_id_vehiculo` int(11) NOT NULL,
  `hora_imagen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisiones`
--

CREATE TABLE IF NOT EXISTS `revisiones` (
  `luces_delanteras` varchar(45) NOT NULL,
  `luces_traseras` varchar(45) NOT NULL,
  `antena` varchar(45) NOT NULL,
  `espejo_derecho` varchar(45) NOT NULL,
  `espejo_izquierdo` varchar(45) NOT NULL,
  `vidrios` varchar(45) NOT NULL,
  `emblema_delantero` varchar(45) NOT NULL,
  `emblema_trasero` varchar(45) NOT NULL,
  `tapones_rines` varchar(45) NOT NULL,
  `tapon_gasolina` varchar(45) NOT NULL,
  `carroceria` varchar(45) NOT NULL,
  `encendedor` varchar(45) NOT NULL,
  `espejo_retrovisor` varchar(45) NOT NULL,
  `cenicero` varchar(45) NOT NULL,
  `alfombras` varchar(45) NOT NULL,
  `forros_asientos` varchar(45) NOT NULL,
  `gato` varchar(45) NOT NULL,
  `llave_ruedas` varchar(45) NOT NULL,
  `caucho_repuesto` varchar(45) NOT NULL,
  `estuche_herramientas` varchar(45) NOT NULL,
  `triangulo_emergencia` varchar(45) NOT NULL,
  `bateria` varchar(45) NOT NULL,
  `tapa_fusilera` varchar(45) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conductor_vehiculo_vehiculo_id_vehiculo` int(11) NOT NULL,
  `conductor_vehiculo_conductor_id_conductor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision_estado`
--

CREATE TABLE IF NOT EXISTS `revision_estado` (
  `estado_id_estado` int(11) NOT NULL,
  `revisiones_conductor_vehiculo_vehiculo_id_vehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `placa` varchar(45) NOT NULL,
  `nombre_vehiculo` varchar(45) NOT NULL,
  `ano` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD PRIMARY KEY (`id_conductor`);

--
-- Indices de la tabla `conductor_vehiculo`
--
ALTER TABLE `conductor_vehiculo`
  ADD PRIMARY KEY (`vehiculo_id_vehiculo`,`conductor_id_conductor`),
  ADD KEY `fk_conductor_vehiculo_conductor1_idx` (`conductor_id_conductor`),
  ADD KEY `fk_conductor_vehiculo_vehiculo1_idx` (`vehiculo_id_vehiculo`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagenes_revisiones1_idx` (`revisiones_conductor_vehiculo_vehiculo_id_vehiculo`);

--
-- Indices de la tabla `revisiones`
--
ALTER TABLE `revisiones`
  ADD PRIMARY KEY (`conductor_vehiculo_vehiculo_id_vehiculo`),
  ADD KEY `fk_revisiones_conductor_vehiculo1_idx` (`conductor_vehiculo_vehiculo_id_vehiculo`,`conductor_vehiculo_conductor_id_conductor`);

--
-- Indices de la tabla `revision_estado`
--
ALTER TABLE `revision_estado`
  ADD KEY `fk_revision_estado_estado1_idx` (`estado_id_estado`),
  ADD KEY `fk_revision_estado_revisiones1_idx` (`revisiones_conductor_vehiculo_vehiculo_id_vehiculo`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conductor_vehiculo`
--
ALTER TABLE `conductor_vehiculo`
  MODIFY `vehiculo_id_vehiculo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `revisiones`
--
ALTER TABLE `revisiones`
  MODIFY `conductor_vehiculo_vehiculo_id_vehiculo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conductor_vehiculo`
--
ALTER TABLE `conductor_vehiculo`
  ADD CONSTRAINT `fk_conductor_vehiculo_conductor1` FOREIGN KEY (`conductor_id_conductor`) REFERENCES `conductor` (`id_conductor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_conductor_vehiculo_vehiculo1` FOREIGN KEY (`vehiculo_id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `fk_imagenes_revisiones1` FOREIGN KEY (`revisiones_conductor_vehiculo_vehiculo_id_vehiculo`) REFERENCES `revisiones` (`conductor_vehiculo_vehiculo_id_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `revisiones`
--
ALTER TABLE `revisiones`
  ADD CONSTRAINT `fk_revisiones_conductor_vehiculo1` FOREIGN KEY (`conductor_vehiculo_vehiculo_id_vehiculo`, `conductor_vehiculo_conductor_id_conductor`) REFERENCES `conductor_vehiculo` (`vehiculo_id_vehiculo`, `conductor_id_conductor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `revision_estado`
--
ALTER TABLE `revision_estado`
  ADD CONSTRAINT `fk_revision_estado_estado1` FOREIGN KEY (`estado_id_estado`) REFERENCES `estado` (`id_estado`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_revision_estado_revisiones1` FOREIGN KEY (`revisiones_conductor_vehiculo_vehiculo_id_vehiculo`) REFERENCES `revisiones` (`conductor_vehiculo_vehiculo_id_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
