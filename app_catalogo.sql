-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: pdb50.awardspace.net
-- Tiempo de generación: 30-10-2020 a las 06:14:29
-- Versión del servidor: 5.7.20-log
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `3460620_catalogoventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`, `estatus`) VALUES
(1, 'Hombre', 'Categorías para hombres', 1),
(2, 'Mujer', 'Categorías para mujeres', 1),
(3, 'Niños', 'Categorías para niños', 1),
(4, 'Niñas', 'Categorías para niñas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion_categoria`
--

CREATE TABLE `clasificacion_categoria` (
  `id_clasificacion_categoria` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_clasificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clasificacion_categoria`
--

INSERT INTO `clasificacion_categoria` (`id_clasificacion_categoria`, `id_producto`, `id_categoria`, `id_clasificacion`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 2, 3, 1),
(4, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id_forma_pago` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id_forma_pago`, `nombre`, `descripcion`, `estatus`) VALUES
(1, 'Tarjeta de crédito o débito', 'Pago con Tarjeta de crédito o débito', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `pantalla` varchar(255) NOT NULL,
  `fecha_accion` datetime NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  `mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `total_pagado` float DEFAULT NULL,
  `fecha_compra` datetime DEFAULT NULL,
  `nombre_comprador` varchar(255) DEFAULT NULL,
  `direccion_comprador` varchar(255) DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `codigo_pedido` varchar(255) DEFAULT NULL,
  `estatus` tinyint(4) DEFAULT NULL,
  `id_forma_pago` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `total_pagado`, `fecha_compra`, `nombre_comprador`, `direccion_comprador`, `fecha_entrega`, `codigo_pedido`, `estatus`, `id_forma_pago`, `id_usuario`) VALUES
(24, 1050, '2020-10-29 01:54:30', 'Maria Perez', 'Colima 12 B', '2020-11-05 00:00:00', NULL, 1, NULL, 1),
(25, 350, '2020-10-29 03:10:54', 'Pedro Sandoval', 'Av. Jose Alfredo No. 12', '2020-11-20 00:00:00', NULL, 1, NULL, 1),
(26, 1236, '2020-10-29 03:55:46', 'Miriam Perez', 'Mexico 14', '2020-11-19 00:00:00', NULL, 1, NULL, 1),
(27, 2472, '2020-10-29 04:22:24', 'prueba comprador', 'direccion', '2020-12-10 00:00:00', NULL, 1, NULL, 1),
(28, 350, '2020-10-30 01:58:18', 'Comprador (Prueba desde iPhone)', 'Privada de Colima No. 10 A', '2029-06-17 00:00:00', NULL, 1, NULL, 1),
(29, 2472, '2020-10-30 03:40:42', 'Celina Gonzalez Velazquez', 'Calle Sin Número', '2020-12-28 00:00:00', NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` float NOT NULL,
  `precio_venta` float NOT NULL,
  `precio_vendedor` float NOT NULL,
  `puntos` float NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `cantidad`, `descuento`, `precio_venta`, `precio_vendedor`, `puntos`, `imagen`, `marca`, `descripcion`, `estatus`) VALUES
(1, 'Perfume 212 Men De Carolina Herrera 100ml', 5, 5, 1500, 1236, 5, 'https://resources.sears.com.mx/medios-plazavip/fotos/productos_sears1/original/2841749.jpg', 'Carolina Herrera', 'Perfume 212 Men De Carolina Herrera 100ml Edt Nuevo', 1),
(2, 'Conjunto De Bolsas C/borla De Cuero Sintético', 10, 0, 395, 350, 3, 'https://http2.mlstatic.com/conjunto-de-bolsas-cborla-de-cuero-sintetico-pmujer-3-uds-D_NQ_NP_815500-MLM32345353676_092019-F.jpg', 'CKLASS', '¡Junto con una delicada decoración de borlas y textura clara!', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagen`
--

CREATE TABLE `producto_imagen` (
  `id_producto_imagen` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_imagen`
--

INSERT INTO `producto_imagen` (`id_producto_imagen`, `id_producto`, `ruta`, `principal`, `fecha_registro`) VALUES
(1, 1, 'https://images-na.ssl-images-amazon.com/images/I/41E5wS%2BRhKL.jpg', 1, '2020-09-24 00:00:00'),
(2, 1, 'https://fraguru.com/mdimg/perfume/375x500.297.jpg', 0, '2020-09-24 00:00:00'),
(5, 1, 'https://cdn.fragrancenet.com/images/photos/600x600/126544.jpg', 0, '2020-09-24 00:00:00'),
(9, 2, 'https://assets.stickpng.com/images/580b57fbd9996e24bc43bf85.png', 1, '2020-10-19 00:00:00'),
(7, 1, 'https://images-na.ssl-images-amazon.com/images/I/61S7G9mOFAL._AC_SX425_.jpg', 0, '2020-09-24 00:00:00'),
(10, 2, 'https://images.vexels.com/media/users/3/136134/isolated/preview/fd1af8b53438577c9c5a0572cc6fb6a7-bolso-mujer-moda-colorido-by-vexels.png', 0, '2020-10-19 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_pedido`
--

CREATE TABLE `producto_pedido` (
  `id_producto_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_clasificacion_categoria` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto_pedido`
--

INSERT INTO `producto_pedido` (`id_producto_pedido`, `id_producto`, `id_pedido`, `id_clasificacion_categoria`, `cantidad_producto`) VALUES
(12, 2, 24, 2, 3),
(13, 2, 25, 2, 1),
(14, 1, 26, 1, 1),
(15, 1, 27, 1, 2),
(16, 2, 28, 2, 1),
(17, 1, 29, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendar_vendedor`
--

CREATE TABLE `recomendar_vendedor` (
  `id_recomendar_vendedor` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `identification` varchar(255) DEFAULT NULL,
  `voucher` varchar(255) DEFAULT NULL,
  `estatus` tinyint(4) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clasificacion`
--

CREATE TABLE `tb_clasificacion` (
  `id_clasificacion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `estatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_clasificacion`
--

INSERT INTO `tb_clasificacion` (`id_clasificacion`, `nombre`, `descripcion`, `imagen`, `estatus`) VALUES
(1, 'Jafra', 'Jafra', 'https://i.pinimg.com/originals/0c/15/c3/0c15c353218b460d36e54a641be584cb.png', 1),
(2, 'Avon', 'Avon', 'https://1000marcas.net/wp-content/uploads/2020/03/Avon-Logo.png', 1),
(3, 'Fuller', 'Fuller', 'https://upload.wikimedia.org/wikipedia/commons/1/11/Fuller_Cosmetics.png', 1),
(4, 'Andrea', 'Andrea', 'https://static.ofertia.com.mx/comercios/andrea/profile-157457553.v25.png', 1),
(5, 'Nivea', 'Nivea', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Nivea_logo.svg/1024px-Nivea_logo.svg.png', 1),
(6, 'Cklass', 'Cklass', 'https://www.cklass.com/assets/images/logo.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `birthdate` date NOT NULL,
  `identification` varchar(255) DEFAULT NULL,
  `voucher` varchar(255) DEFAULT NULL,
  `photography` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  `points` float DEFAULT NULL,
  `estatus` tinyint(4) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_profile` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `gender`, `email`, `telephone`, `birthdate`, `identification`, `voucher`, `photography`, `role`, `level`, `points`, `estatus`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `updated_profile`) VALUES
(1, 'Eric', 'Domenzain M', 'M', 'ericdomenzain@gmail.com', '4181564578', '1994-07-30', NULL, NULL, 'o1dt0bxk.00g.jpg', '', NULL, NULL, NULL, NULL, '$2y$10$OCeGRMxsZjpuDmfMjxmpguV1qp1C6ZkS3oG2rSEQUGk5Wj0DFpcDm', NULL, NULL, NULL, '2020-10-29 23:50:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_clasificacion`
--

CREATE TABLE `usuario_clasificacion` (
  `id_usuario_marca` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_clasificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_clasificacion`
--

INSERT INTO `usuario_clasificacion` (`id_usuario_marca`, `id_usuario`, `id_clasificacion`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_forma_pago`
--

CREATE TABLE `usuario_forma_pago` (
  `id_usuario_forma_pago` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_forma_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `total_pagado` float NOT NULL,
  `precio_vendedor` float NOT NULL,
  `catalogo` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `mes_catalogo` varchar(100) NOT NULL,
  `forma_pago` varchar(255) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `fecha_entrega` datetime NOT NULL,
  `codigo_pedido` varchar(255) NOT NULL,
  `estatus` tinyint(4) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clasificacion_categoria`
--
ALTER TABLE `clasificacion_categoria`
  ADD PRIMARY KEY (`id_clasificacion_categoria`,`id_producto`,`id_categoria`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_clasificacion` (`id_clasificacion`) USING BTREE;

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id_forma_pago`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_forma_pago` (`id_forma_pago`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  ADD PRIMARY KEY (`id_producto_imagen`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `producto_pedido`
--
ALTER TABLE `producto_pedido`
  ADD PRIMARY KEY (`id_producto_pedido`,`id_producto`,`id_pedido`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_clasificacion_categoria` (`id_clasificacion_categoria`);

--
-- Indices de la tabla `recomendar_vendedor`
--
ALTER TABLE `recomendar_vendedor`
  ADD PRIMARY KEY (`id_recomendar_vendedor`),
  ADD UNIQUE KEY `recomendar_email_unique` (`email`),
  ADD UNIQUE KEY `recomendar_telephone_unique` (`telephone`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tb_clasificacion`
--
ALTER TABLE `tb_clasificacion`
  ADD PRIMARY KEY (`id_clasificacion`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_telephone_unique` (`telephone`);

--
-- Indices de la tabla `usuario_clasificacion`
--
ALTER TABLE `usuario_clasificacion`
  ADD PRIMARY KEY (`id_usuario_marca`,`id_usuario`,`id_clasificacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_catalogo` (`id_clasificacion`);

--
-- Indices de la tabla `usuario_forma_pago`
--
ALTER TABLE `usuario_forma_pago`
  ADD PRIMARY KEY (`id_usuario_forma_pago`,`id_usuario`,`id_forma_pago`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_forma_pago` (`id_forma_pago`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `clasificacion_categoria`
--
ALTER TABLE `clasificacion_categoria`
  MODIFY `id_clasificacion_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  MODIFY `id_producto_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `producto_pedido`
--
ALTER TABLE `producto_pedido`
  MODIFY `id_producto_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `recomendar_vendedor`
--
ALTER TABLE `recomendar_vendedor`
  MODIFY `id_recomendar_vendedor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_clasificacion`
--
ALTER TABLE `tb_clasificacion`
  MODIFY `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario_clasificacion`
--
ALTER TABLE `usuario_clasificacion`
  MODIFY `id_usuario_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario_forma_pago`
--
ALTER TABLE `usuario_forma_pago`
  MODIFY `id_usuario_forma_pago` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clasificacion_categoria`
--
ALTER TABLE `clasificacion_categoria`
  ADD CONSTRAINT `clasificacion_categoria_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `clasificacion_categoria_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `producto_catalogo_ibfk_3` FOREIGN KEY (`id_clasificacion`) REFERENCES `tb_clasificacion` (`id_clasificacion`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_forma_pago`) REFERENCES `forma_pago` (`id_forma_pago`);

--
-- Filtros para la tabla `producto_pedido`
--
ALTER TABLE `producto_pedido`
  ADD CONSTRAINT `producto_pedido_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `producto_pedido_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `producto_pedido_ibfk_3` FOREIGN KEY (`id_clasificacion_categoria`) REFERENCES `clasificacion_categoria` (`id_clasificacion_categoria`);

--
-- Filtros para la tabla `recomendar_vendedor`
--
ALTER TABLE `recomendar_vendedor`
  ADD CONSTRAINT `recomendar_vendedor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `usuario_clasificacion`
--
ALTER TABLE `usuario_clasificacion`
  ADD CONSTRAINT `usuario_clasificacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `usuario_clasificacion_ibfk_2` FOREIGN KEY (`id_clasificacion`) REFERENCES `tb_clasificacion` (`id_clasificacion`);

--
-- Filtros para la tabla `usuario_forma_pago`
--
ALTER TABLE `usuario_forma_pago`
  ADD CONSTRAINT `usuario_forma_pago_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `usuario_forma_pago_ibfk_2` FOREIGN KEY (`id_forma_pago`) REFERENCES `forma_pago` (`id_forma_pago`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
