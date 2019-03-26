-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2019 a las 22:34:13
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `joyeria_xyz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `cate_id_pk` int(11) NOT NULL,
  `cate_nombre` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`cate_id_pk`, `cate_nombre`) VALUES
(1, 'anillos oro'),
(2, 'anillos plata drert'),
(3, 'oro editado lol wewreae');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory`
--

CREATE TABLE `inventory` (
  `inve_id_pk` int(11) NOT NULL,
  `inve_prod_id_pk` int(11) DEFAULT NULL,
  `inve_prod_name` varchar(200) DEFAULT NULL,
  `inve_date` datetime DEFAULT NULL,
  `inve_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventory`
--

INSERT INTO `inventory` (`inve_id_pk`, `inve_prod_id_pk`, `inve_prod_name`, `inve_date`, `inve_total`) VALUES
(2, 1, 'collar perlas doradas', '2019-03-26 00:00:00', 40),
(3, 2, 'anillo matrimonial', '2019-03-26 00:00:00', 20),
(4, 3, 'anillo Dama', '2019-03-26 00:00:00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_movements`
--

CREATE TABLE `inventory_movements` (
  `movi_id_pk` int(11) NOT NULL,
  `prod_id_fk` int(11) DEFAULT NULL,
  `movi_cantidad` int(11) DEFAULT NULL,
  `movi_fecha_modificacion` datetime DEFAULT NULL,
  `movi_tipo` varchar(45) DEFAULT 'add'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventory_movements`
--

INSERT INTO `inventory_movements` (`movi_id_pk`, `prod_id_fk`, `movi_cantidad`, `movi_fecha_modificacion`, `movi_tipo`) VALUES
(30, 1, 5, '2019-03-26 00:00:00', 'add'),
(31, 1, 1, '2019-03-26 00:00:00', 'remove'),
(32, 1, 50, '2019-03-26 00:00:00', 'add'),
(33, 1, 5, '2019-03-26 00:00:00', 'add'),
(34, 1, 2, '2019-03-26 00:00:00', 'add'),
(35, 1, 9, '2019-03-26 00:00:00', 'add'),
(36, 1, 30, '2019-03-26 00:00:00', 'remove'),
(37, 2, 20, '2019-03-26 00:00:00', 'add'),
(38, 3, 10, '2019-03-26 00:00:00', 'add'),
(39, 3, 5, '2019-03-26 00:00:00', 'remove');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `prod_id_pk` int(11) NOT NULL,
  `prod_nombre` varchar(150) DEFAULT NULL,
  `prod_imagen` varchar(250) DEFAULT NULL,
  `cate_id_fk` int(11) DEFAULT NULL,
  `prod_precio` int(11) DEFAULT '0',
  `prod_status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`prod_id_pk`, `prod_nombre`, `prod_imagen`, `cate_id_fk`, `prod_precio`, `prod_status`) VALUES
(1, 'collar perlas doradas', 'mes_que_un_club.jpg', 2, 3443434, 1),
(2, 'anillo matrimonial', 'batman.jpg', 3, 500000, 1),
(3, 'anillo Dama', 'lol.jpg', 1, 250000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `usua_id_pk` int(11) NOT NULL,
  `usua_nombres` varchar(200) DEFAULT NULL,
  `usua_nickname` varchar(45) DEFAULT NULL,
  `usua_password` varchar(45) DEFAULT NULL,
  `usua_status_account` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`usua_id_pk`, `usua_nombres`, `usua_nickname`, `usua_password`, `usua_status_account`) VALUES
(1, 'test', 'test', '81dc9bdb52d04dc20036dbd8313ed055', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id_pk`),
  ADD UNIQUE KEY `cate_id_pk_UNIQUE` (`cate_id_pk`);

--
-- Indices de la tabla `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inve_id_pk`);

--
-- Indices de la tabla `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD PRIMARY KEY (`movi_id_pk`),
  ADD KEY `fk_productos_movimientos_idx` (`prod_id_fk`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id_pk`),
  ADD KEY `fk_categorias_productos_idx` (`cate_id_fk`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usua_id_pk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inve_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventory_movements`
--
ALTER TABLE `inventory_movements`
  MODIFY `movi_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `prod_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `usua_id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD CONSTRAINT `fk_productos_movimientos` FOREIGN KEY (`prod_id_fk`) REFERENCES `products` (`prod_id_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_categorias_productos` FOREIGN KEY (`cate_id_fk`) REFERENCES `categories` (`cate_id_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
