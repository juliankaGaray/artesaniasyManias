-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 04:36:34
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
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE `detalles_venta` (
  `id` int(11) NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detalles_venta`
--

INSERT INTO `detalles_venta` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio`) VALUES
(2, 27, 8, 1, '9999.00');

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
  `existencia` decimal(50,0) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `precioVenta`, `precioCompra`, `existencia`, `imagen`, `stock`) VALUES
(8, '20', 'Collar Ansestral', '9999', '5900', '25', 'uploads/pr01.jpg', -1),
(9, '12', 'Mochila Wayuu', '100000', '59000', '15', 'uploads/bg13.jpg', 0),
(10, '13', 'Ruana Tradicional', '120000', '80000', '20', 'uploads/pr02.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_vendidos`
--

CREATE TABLE `productos_vendidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) UNSIGNED NOT NULL,
  `id_venta` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_vendidos`
--

INSERT INTO `productos_vendidos` (`id`, `id_producto`, `cantidad`, `id_venta`) VALUES
(20, 8, 1, 14);

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
  `usuarios_id` int(11) NOT NULL,
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`ID`, `nombre`, `apellido`, `edad`, `ciudad`, `celular`, `usuario`, `pass`, `usuarios_id`, `rol`) VALUES
(8, 'Julian Camilo', 'Garay Pulido', 29, 'Bogota', '3107767460', '', '', 1, 1),
(11, 'usuario0', 'prueba', 25, 'Bogota', '3105555555', '', '', 4, 2),
(12, 'usuario1', 'prueba', 25, 'bogota', '3105555555', '', '', 5, NULL),
(13, 'usuario1', 'prueba', 25, 'bogota', '3105555555', '', '', 6, NULL),
(14, 'usuario2', 'prueba', 56, 'Bogota', '3101234567', '', '', 7, NULL);

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
(1, 'jgaray04', 'jgaray04', 1, 'julcamgar@gmail.com', 'jgaray04@prueba.com', 'jgaray04', NULL, '1', NULL, NULL, NULL),
(4, 'usuario0', 'usuario0', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'usuario1', 'usuario1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'usuario1', 'usuario1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'usuario2', 'usuario2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'jleiva01', 'jleiva01', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'jzamora01', 'jzamora01', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'usuario4', 'usuario4', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(7, '2024-10-02 15:22:09', '20000.00'),
(11, '2024-10-04 17:07:48', '8000.00'),
(12, '2024-10-06 01:45:54', '23000.00'),
(13, '2024-10-15 00:25:04', '0.00'),
(14, '2024-10-15 03:23:57', '9999.00'),
(15, '2024-10-15 03:31:27', '9999.00'),
(16, '2024-10-15 03:31:31', '0.00'),
(17, '2024-10-15 03:37:34', '99999.99'),
(18, '2024-10-15 03:49:39', '9999.00'),
(24, '2024-10-15 04:15:15', '9999.00'),
(27, '0000-00-00 00:00:00', '9999.00');

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
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

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
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `detalles_venta_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

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
