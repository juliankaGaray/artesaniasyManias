-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2018 a las 23:43:05
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tutoriales_map_rutas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tienda`
--

CREATE TABLE IF NOT EXISTS `tbl_tienda` (
  `tienda_id` int(11) NOT NULL,
  `tienda_registro` datetime NOT NULL,
  `tienda_nombre` varchar(50) NOT NULL,
  `tienda_latitud` varchar(40) NOT NULL,
  `tienda_longitud` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tienda`
--

INSERT INTO `tbl_tienda` (`tienda_id`, `tienda_registro`, `tienda_nombre`, `tienda_latitud`, `tienda_longitud`) VALUES
(1, '2018-04-25 00:00:00', 'Restaurante Polleria "El Tablon"', '-17.646427238601984', '-71.34550720453262'),
(2, '2018-04-25 00:00:00', 'Hotel de Turistas "Ilo"', '-17.625998539883344', '-71.34328365325928');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_tienda`
--
ALTER TABLE `tbl_tienda`
  ADD PRIMARY KEY (`tienda_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_tienda`
--
ALTER TABLE `tbl_tienda`
  MODIFY `tienda_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
