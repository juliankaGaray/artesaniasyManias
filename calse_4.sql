-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2024 a las 13:54:35
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calse_4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precioVenta` decimal(50,0) NOT NULL,
  `precioCompra` decimal(50,0) NOT NULL,
  `existencia` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `precioVenta`, `precioCompra`, `existencia`) VALUES
(1, '1', 'Galletas chokis', '5000', '2300', '97'),
(2, '2', 'Mermelada de fresa', '1000', '6500', '99'),
(3, '3', 'Aceite', '20000', '18000', '98'),
(4, '4', 'Palomitas de maíz', '15000', '8000', '97'),
(5, '5', 'Doritos', '8000', '5000', '97');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_vendidos`
--

CREATE TABLE `productos_vendidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` bigint(20) UNSIGNED NOT NULL,
  `id_venta` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_vendidos`
--

INSERT INTO `productos_vendidos` (`id`, `id_producto`, `cantidad`, `id_venta`) VALUES
(3, 5, 1, 3),
(4, 1, 1, 3),
(5, 2, 1, 4),
(6, 1, 1, 4),
(7, 3, 1, 4),
(8, 5, 1, 5),
(9, 3, 1, 5),
(11, 4, 1, 7),
(12, 1, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `edad` int(5) NOT NULL,
  `ciudad` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`ID`, `nombre`, `apellido`, `edad`, `ciudad`, `celular`, `usuario`, `pass`, `usuarios_id`) VALUES
(8, 'Julian Camilo', 'Garay Pulido', 29, 'Bogota', '3107767460', '', '', 1),
(11, 'usuario0', 'prueba', 25, 'Bogota', '3105555555', '', '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `estado`) VALUES
(1, 'admin', 'Administrador con acceso total', NULL, NULL, NULL, NULL),
(2, 'vendedor', 'entra a modulo  ventas', NULL, NULL, NULL, NULL),
(3, 'viewer', 'Usuario solo de lectura', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nit_ci_cliente` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `placa_auto` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_facturaciones`
--

CREATE TABLE `tb_facturaciones` (
  `id_facturacion` int(11) NOT NULL,
  `id_informacion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nro_factura` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_cliente` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_factura` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_ingreso` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `hora_ingreso` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_salida` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `hora_salida` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tiempo` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `cuviculo` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `cantidad` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `monto_total` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `monto_literal` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `user_sesion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `qr` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_informaciones`
--

CREATE TABLE `tb_informaciones` (
  `id_informacion` int(11) NOT NULL,
  `nombre_parqueo` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `actividad_empresa` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `sucursal` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `zona` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `departamento_ciudad` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_mapeos`
--

CREATE TABLE `tb_mapeos` (
  `id_map` int(11) NOT NULL,
  `nro_espacio` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado_espacio` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `obs` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_precios`
--

CREATE TABLE `tb_precios` (
  `id_precio` int(11) NOT NULL,
  `cantidad` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `detalle` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tickets`
--

CREATE TABLE `tb_tickets` (
  `id_ticket` int(11) NOT NULL,
  `nombre_cliente` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nit_ci` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `placa_auto` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `cuviculo` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_ingreso` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `hora_ingreso` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado_ticket` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `user_sesion` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email_verificado` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `password_user` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `usuario`, `pass`, `rol_id`, `email`, `email_verificado`, `password_user`, `token`, `estado`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`) VALUES
(1, 'jgaray04', 'jgaray04', 1, 'jgaray04@prueba.com', 'jgaray04@prueba.com', 'jgaray04', NULL, '1', NULL, NULL, NULL),
(4, 'usuario0', 'usuario0', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `total`) VALUES
(2, '2024-10-02 02:26:08', '0.00'),
(3, '2024-10-02 02:26:26', '13000.00'),
(4, '2024-10-02 04:15:02', '26000.00'),
(5, '2024-10-02 15:19:25', '28000.00'),
(7, '2024-10-02 15:22:09', '20000.00');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuarios` (
`ID` int(11)
,`nombre` varchar(50)
,`apellido` varchar(50)
,`edad` int(5)
,`ciudad` varchar(50)
,`celular` varchar(20)
,`usuario` varchar(50)
,`pass` varchar(50)
,`rol_nombre` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuarios`
--
DROP TABLE IF EXISTS `vista_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuarios`  AS SELECT `u`.`ID` AS `ID`, `r`.`nombre` AS `nombre`, `r`.`apellido` AS `apellido`, `r`.`edad` AS `edad`, `r`.`ciudad` AS `ciudad`, `r`.`celular` AS `celular`, `u`.`usuario` AS `usuario`, `u`.`pass` AS `pass`, `rl`.`nombre` AS `rol_nombre` FROM ((`registro` `r` join `usuarios` `u` on(`r`.`usuarios_id` = `u`.`ID`)) left join `roles` `rl` on(`u`.`rol_id` = `rl`.`id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_usuarios` (`usuarios_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tb_facturaciones`
--
ALTER TABLE `tb_facturaciones`
  ADD PRIMARY KEY (`id_facturacion`);

--
-- Indices de la tabla `tb_informaciones`
--
ALTER TABLE `tb_informaciones`
  ADD PRIMARY KEY (`id_informacion`);

--
-- Indices de la tabla `tb_mapeos`
--
ALTER TABLE `tb_mapeos`
  ADD PRIMARY KEY (`id_map`);

--
-- Indices de la tabla `tb_precios`
--
ALTER TABLE `tb_precios`
  ADD PRIMARY KEY (`id_precio`);

--
-- Indices de la tabla `tb_tickets`
--
ALTER TABLE `tb_tickets`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_rol` (`rol_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_facturaciones`
--
ALTER TABLE `tb_facturaciones`
  MODIFY `id_facturacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_informaciones`
--
ALTER TABLE `tb_informaciones`
  MODIFY `id_informacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_mapeos`
--
ALTER TABLE `tb_mapeos`
  MODIFY `id_map` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_precios`
--
ALTER TABLE `tb_precios`
  MODIFY `id_precio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_tickets`
--
ALTER TABLE `tb_tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  ADD CONSTRAINT `productos_vendidos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_vendidos_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



