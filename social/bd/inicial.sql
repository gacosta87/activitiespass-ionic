-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2018 at 05:25 PM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almacen`
--

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cuit` varchar(300) NOT NULL,
  `razon_social` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `website` varchar(200) NOT NULL,
  `direpai_id` int(11) NOT NULL,
  `direprovincia_id` int(11) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `cuit`, `razon_social`, `email`, `telefono`, `website`, `direpai_id`, `direprovincia_id`, `direccion`, `moneda_id`, `created`, `modified`) VALUES
(1, '10027270-6', 'ECSISTA ECOSISTEMAS DE TALENTO ', 'cesargiraldopersonal@gmail.com', '3107932844', 'www.ecsista,com', 2, 2, 'BogotÃ¡ Parque de la 93', 4, '2017-07-12 23:22:47', '2017-08-22 17:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `empresasurcusales`
--

CREATE TABLE `empresasurcusales` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `denominacion` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `direccion` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empresasurcusales`
--

INSERT INTO `empresasurcusales` (`id`, `empresa_id`, `denominacion`, `telefono`, `email`, `direccion`, `created`, `modified`) VALUES
(1, 1, 'sucursal1', '1', '1@1.com', '1', '2017-03-24 21:55:33', '2017-03-24 21:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `estatus`
--

CREATE TABLE `estatus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `denominacion` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estatus`
--

INSERT INTO `estatus` (`id`, `denominacion`, `created`, `modified`) VALUES
(1, 'Activo', '2016-10-21 15:02:31', '2016-10-21 15:02:31'),
(2, 'Desactivado', '2016-10-21 15:02:44', '2016-10-21 15:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

CREATE TABLE `modulos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `denominacion` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modulos`
--

INSERT INTO `modulos` (`id`, `denominacion`, `created`, `modified`) VALUES
(1, 'SISTEMA', '2016-11-16 10:56:41', '2016-11-16 10:56:41'),
(2, 'USUARIOS', '2017-01-14 00:00:00', '2017-01-14 00:00:00'),
(3, 'SUCURSALES', '2017-04-19 00:00:00', '2017-04-19 00:00:00'),
(4, 'EMPRESA', '2017-04-19 00:00:00', '2017-04-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `alias`, `created`, `modified`) VALUES
(1, 'Super root', 'Super root', '2009-04-05', '2017-11-08'),
(2, 'ROOT', 'ROOT', '2017-04-19', '2018-05-17'),
(3, 'ADMINISTRADOR', 'ADMINISTRADOR', '2017-04-21', '2017-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `rolesmodulos`
--

CREATE TABLE `rolesmodulos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolesmodulos`
--

INSERT INTO `rolesmodulos` (`id`, `role_id`, `modulo_id`, `created`, `modified`) VALUES
(181, 1, 1, '2017-11-08 15:51:42', '2017-11-08 15:51:42'),
(182, 1, 2, '2017-11-08 15:51:42', '2017-11-08 15:51:42'),
(183, 1, 3, '2017-11-08 15:51:42', '2017-11-08 15:51:42'),
(188, 3, 2, '2017-11-08 15:52:37', '2017-11-08 15:52:37'),
(189, 3, 5, '2017-11-08 15:52:37', '2017-11-08 15:52:37'),
(190, 3, 6, '2017-11-08 15:52:37', '2017-11-08 15:52:37'),
(191, 3, 7, '2017-11-08 15:52:37', '2017-11-08 15:52:37'),
(198, 2, 2, '2018-05-17 01:52:08', '2018-05-17 01:52:08'),
(199, 2, 3, '2018-05-17 01:52:08', '2018-05-17 01:52:08'),
(200, 2, 5, '2018-05-17 01:52:08', '2018-05-17 01:52:08'),
(201, 2, 4, '2018-05-17 01:52:09', '2018-05-17 01:52:09'),
(202, 2, 8, '2018-05-17 01:52:09', '2018-05-17 01:52:09'),
(203, 2, 9, '2018-05-17 01:52:09', '2018-05-17 01:52:09'),
(204, 2, 10, '2018-05-17 01:52:09', '2018-05-17 01:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `usermodulos`
--

CREATE TABLE `usermodulos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermodulos`
--

INSERT INTO `usermodulos` (`id`, `user_id`, `modulo_id`, `created`, `modified`) VALUES
(1, 1, 1, '2016-11-16 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 2, '2016-11-16 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 3, '2016-11-16 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 4, '2016-11-16 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 5, '2016-11-16 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 6, '2016-11-16 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 7, '2016-11-16 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 8, '2016-12-12 22:21:42', '2016-12-12 22:21:42'),
(9, 1, 9, '2016-12-14 15:14:27', '2016-12-14 15:14:27'),
(10, 1, 10, '2016-12-19 15:40:50', '2016-12-19 15:40:50'),
(11, 1, 11, '2017-01-14 00:00:00', '2017-01-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `empresasurcusale_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_apellido` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estatu_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `nominapersonale_id` int(11) DEFAULT NULL,
  `foto` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `modified` date DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `empresa_id`, `empresasurcusale_id`, `role_id`, `username`, `nombre_apellido`, `password`, `estatu_id`, `cliente_id`, `nominapersonale_id`, `foto`, `email`, `modified`, `created`) VALUES
(1, 0, 0, 1, 'superroot', 'SUPER ROOT', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 0, 'upload/1504987657.png', '', '2017-09-09', '2016-10-17 01:22:00'),
(8, 1, 0, 2, 'empresa1', 'ROOT 1', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 0, 'upload/1536870270.png', '', '2018-09-13', '2017-04-19 13:00:14'),
(9, 1, 1, 3, 'sucursal1', 'SUCURSAL 1', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 0, '', '', '2017-04-27', '2017-04-23 16:38:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `empresasurcusales`
--
ALTER TABLE `empresasurcusales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_alias` (`alias`);

--
-- Indexes for table `rolesmodulos`
--
ALTER TABLE `rolesmodulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `usermodulos`
--
ALTER TABLE `usermodulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `empresasurcusales`
--
ALTER TABLE `empresasurcusales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rolesmodulos`
--
ALTER TABLE `rolesmodulos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `usermodulos`
--
ALTER TABLE `usermodulos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
