-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-12-2019 a las 06:40:27
-- Versión del servidor: 5.5.61-38.13-log
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `planejv5_sistema_planea_tu_bien`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_jornadas`
--

CREATE TABLE `tipos_jornadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_jornadas`
--

INSERT INTO `tipos_jornadas` (`id`, `nombre`, `codigo`, `created_at`, `updated_at`) VALUES
(1, 'Diurna', '01', '2019-10-16 13:22:41', '2019-10-16 13:22:41'),
(2, 'Nocturna', '02', '2019-10-16 13:22:41', '2019-10-16 13:22:41'),
(3, 'Mixta', '03', '2019-10-16 13:22:41', '2019-10-16 13:22:41'),
(4, 'Por hora', '04', '2019-10-16 13:22:41', '2019-10-16 13:22:41'),
(5, 'Reducida', '05', '2019-10-16 13:22:41', '2019-10-16 13:22:41'),
(6, 'Continuada', '06', '2019-10-16 13:22:41', '2019-10-16 13:22:41'),
(7, 'Partida', '07', '2019-10-16 13:22:41', '2019-10-16 13:22:41'),
(8, 'Por turnos', '08', '2019-10-16 13:22:41', '2019-10-16 13:22:41'),
(9, 'Otra jornada', '99', '2019-10-16 13:22:41', '2019-10-16 13:22:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipos_jornadas`
--
ALTER TABLE `tipos_jornadas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipos_jornadas`
--
ALTER TABLE `tipos_jornadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
