-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-12-2019 a las 06:38:17
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
-- Estructura de tabla para la tabla `tipo_contratos`
--

CREATE TABLE `tipo_contratos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_contratos`
--

INSERT INTO `tipo_contratos` (`id`, `nombre`, `descripcion`, `deleted_at`, `created_at`, `updated_at`, `codigo`) VALUES
(1, 'Contrato de trabajo por tiempo indeterminado', NULL, NULL, '2019-10-16 13:22:40', '2019-10-16 13:22:40', '01'),
(2, 'Contrato de trabajo para obra determinada', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '02'),
(3, 'Contrato de trabajo por tiempo determinado', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '03'),
(4, 'Contrato de trabajo por temporada', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '04'),
(5, 'Contrato de trabajo sujeto a prueba', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '05'),
(6, 'Contrato de trabajo con capacitación inicial', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '06'),
(7, 'Modalidad de contratación por pago de hora laborada', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '07'),
(8, 'Modalidad de trabajo por comisión laboral', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '08'),
(9, 'Modalidades de contratación donde no existe relación de trabajo', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '09'),
(10, 'Jubilación, pensión, retiro', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '10'),
(11, 'Otro contrato', NULL, NULL, '2019-10-16 13:22:41', '2019-10-16 13:22:41', '99');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipo_contratos`
--
ALTER TABLE `tipo_contratos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipo_contratos`
--
ALTER TABLE `tipo_contratos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
