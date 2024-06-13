-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2024 a las 20:13:14
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hangman`
--
CREATE DATABASE IF NOT EXISTS `hangman` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `hangman`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id` int(11) NOT NULL,
  `numErrores` tinyint(4) NOT NULL,
  `palabraSecreta` varchar(80) NOT NULL,
  `palabraDescubierta` varchar(80) NOT NULL,
  `letras` varchar(10) NOT NULL,
  `maxNumErrores` tinyint(4) NOT NULL,
  `inicio` timestamp NULL DEFAULT NULL,
  `fin` timestamp NULL DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id`, `numErrores`, `palabraSecreta`, `palabraDescubierta`, `letras`, `maxNumErrores`, `inicio`, `fin`, `idUsuario`) VALUES
(56, 4, 'DEPOSAR', 'DEPOSAR', 'EPDAGHLOSX', 5, '2024-04-30 17:52:47', '2024-04-30 17:53:55', 2),
(57, 0, 'ARAMEO', '______', '', 5, '2024-04-30 17:53:55', '2024-04-30 17:54:15', 2),
(58, 5, 'BISELADOR', 'BIS__AD__', 'BIAFTPDSQM', 5, '2024-04-30 17:54:16', '2024-04-30 17:56:57', 2),
(59, 0, 'TACUARA', 'TACUARA', 'TACUR', 5, '2024-04-30 17:56:57', '2024-04-30 18:10:04', 2),
(70, 1, 'RABOPELADO', 'RABOPELADO', 'ARBPSEOLD', 5, '2024-05-01 15:00:02', '2024-05-01 15:00:41', 2),
(71, 2, 'RUFETA', 'RUFETA', 'RFAEILUT', 5, '2024-05-01 15:00:41', '2024-05-01 15:01:24', 2),
(72, 0, 'SUCESIVAMENTE', 'SU__S___M____', 'SUM', 5, '2024-05-01 15:01:24', '2024-05-01 15:01:46', 2),
(73, 1, 'ANEMOMETRICO', 'ANEMOMETRICO', 'ANEOMDCTIR', 5, '2024-05-01 15:01:46', '2024-05-01 15:02:23', 2),
(74, 3, 'CUAJAMIENTO', 'CUAJAMIENTO', 'COUAJMRWLN', 5, '2024-05-01 15:02:24', '2024-05-01 15:03:07', 2),
(75, 2, 'ARREGLISTA', 'ARREGLISTA', 'AYFREGLIST', 5, '2024-05-01 15:03:07', '2024-05-01 15:03:39', 2),
(76, 5, 'RUBICON', '_U_I_O_', 'AEIOULSP', 5, '2024-05-01 15:03:40', '2024-05-01 15:04:17', 2),
(77, 5, 'PLATABANDA', 'P_A_A_A__A', 'ARPEIOU', 5, '2024-05-01 15:04:17', '2024-05-01 15:04:46', 2),
(78, 5, 'ENTERADO', '__T__A_O', 'AFGTSJOU', 5, '2024-05-18 18:22:25', '2024-05-18 18:23:25', 1),
(79, 3, 'ENTRAMBOS', 'ENTRAMBOS', 'EOILNTJRAM', 5, '2024-05-14 18:23:35', '2024-05-14 18:25:15', 1),
(80, 5, 'MAMELLA', '_A__LLA', 'BKALVSP', 5, '2024-05-13 18:25:21', '2024-05-13 18:26:12', 1),
(81, 2, 'DESAMORTIZADOR', 'DESAMORTIZADOR', 'DESMPAKZOR', 5, '2024-05-21 18:26:12', '2024-05-21 18:27:41', 1),
(82, 4, 'PEDIDA', 'PEDIDA', 'PQEDILNSA', 5, '2024-05-17 18:27:41', '2024-05-17 18:28:29', 1),
(83, 5, 'FASTIDIO', 'FA_____O', 'FELWAOQV', 5, '2024-05-28 18:28:30', '2024-05-28 18:29:19', 1),
(84, 0, 'TRUQUIFLOR', 'TRUQUIFLOR', 'TRUQIFLO', 5, '2024-05-22 18:29:19', '2024-05-22 18:29:57', 1),
(85, 5, 'DIATOMACEO', 'D_AT__A_E_', 'DJAEUTPNS', 5, '2024-05-28 18:29:57', '2024-05-28 18:33:40', 1),
(87, 0, 'GRADUAR', '_______', '', 5, '2024-05-24 17:19:10', '2024-05-24 17:19:22', 1),
(88, 4, 'TROPOLOGIA', 'TROPOLOGIA', 'TRPHAEISLC', 5, '2024-05-29 17:19:23', '2024-05-29 17:20:29', 1),
(89, 4, 'MICROCIRUGIA', 'MICROCIRUGIA', 'SAEIOUNTRM', 5, '2024-05-29 17:20:29', '2024-05-29 17:21:36', 1),
(90, 5, 'GALATA', 'G_____', 'SGRWQP', 5, '2024-05-07 17:21:36', '2024-05-07 17:22:04', 1),
(91, 3, 'BERCIANO', 'BERCIANO', 'BRSIAPLECN', 5, '2024-05-13 17:22:05', '2024-05-13 17:23:09', 1),
(92, 3, 'GRUTESCO', 'GRUTESCO', 'AEIOUPSTCG', 5, '2024-05-24 17:23:09', '2024-05-24 17:24:00', 1),
(93, 5, 'CHICHINABO', '_______A_O', 'AEODSLR', 5, '2024-05-15 17:24:00', '2024-05-15 17:24:27', 1),
(94, 4, 'TREMEDAL', 'TREMEDAL', 'AEIOPRLDCT', 5, '2024-05-29 17:24:28', '2024-05-29 17:25:15', 1),
(95, 5, 'GUARURA', 'GUA_U_A', 'AEIOUGMD', 5, '2024-05-29 17:25:15', '2024-05-29 17:25:43', 1),
(96, 0, 'ASTURIANISMO', '____________', '', 5, '2024-06-11 14:34:45', '2024-06-11 14:34:57', 1),
(97, 1, 'EXPRESIONISMO', '_____________', 'A', 5, '2024-06-11 14:34:57', '2024-06-11 14:36:32', 1),
(98, 0, 'ALABAMIENTO', 'ALABAMIENTO', 'ALBMIENTO', 5, '2024-06-11 14:36:32', '2024-06-11 14:37:24', 1),
(99, 5, 'AMAYORAZGAR', '___________', '', 5, '2024-06-11 14:42:37', '2024-06-11 14:42:59', 1),
(100, 0, 'SUDORAL', 'SUDORAL', '', 5, '2024-06-11 14:43:05', '2024-06-11 14:43:18', 1),
(101, 0, 'REGUILETE', '_________', '', 5, '2024-06-11 14:45:52', '2024-06-11 14:45:59', 1),
(102, 0, 'GAMBUZA', '_______', '', 5, '2024-06-11 14:45:59', '2024-06-11 14:46:19', 1),
(103, 0, 'SISCA', '_____', '', 5, '2024-06-11 14:46:19', '2024-06-11 14:46:25', 1),
(104, 0, 'HANSEATICO', 'HANSEATICO', '', 5, '2024-06-11 14:46:36', '2024-06-11 14:47:13', 1),
(105, 5, 'ESBELTEZA', '_________', '', 5, '2024-06-11 14:47:25', '2024-06-11 14:47:44', 1),
(106, 5, 'ACOMODADOR', 'A_____A___', 'AS', 5, '2024-06-11 14:48:46', '2024-06-11 14:49:04', 1),
(107, 1, 'PROLETARIADO', 'PROLETARIADO', 'RM', 5, '2024-06-11 14:49:29', '2024-06-11 14:50:15', 1),
(108, 5, 'AGUIJA', '______', '', 5, '2024-06-11 16:33:39', '2024-06-11 16:39:35', 1),
(109, 5, 'BELLIDO', '_______', '', 5, '2024-06-11 16:42:46', '2024-06-11 16:43:13', 1),
(110, 5, 'BLONDA', '______', '', 5, '2024-06-11 17:03:52', '2024-06-11 17:05:46', 1),
(111, 0, 'GANDARA', '_______', '', 5, '2024-06-11 17:27:28', '2024-06-11 17:27:32', 1),
(112, 0, 'SANTAFECINO', '___________', '', 5, '2024-06-11 17:27:33', '2024-06-11 17:27:35', 1),
(113, 0, 'DOLORIMIENTO', '____________', '', 5, '2024-06-11 17:27:36', '2024-06-11 17:27:37', 1),
(114, 0, 'PARESTESIA', '__________', '', 5, '2024-06-11 17:27:37', '2024-06-11 17:27:39', 1),
(115, 0, 'EXPLOTABLE', '__________', '', 5, '2024-06-11 17:27:40', '2024-06-11 17:27:42', 1),
(116, 0, 'CUY', '___', '', 5, '2024-06-11 17:27:42', '2024-06-11 17:27:43', 1),
(117, 5, 'CICLOSTOMA', '__________', '', 5, '2024-06-11 17:27:44', '2024-06-11 17:28:38', 1),
(118, 5, 'DESMONTAJE', '__________', '', 5, '2024-06-11 17:29:06', '2024-06-11 17:29:10', 1),
(119, 5, 'FRUTILLAR', '_______A_', 'ANBSQZ', 5, '2024-06-11 17:29:14', '2024-06-11 17:29:32', 1),
(120, 0, 'LONCO', '_____', '', 5, '2024-06-11 18:02:39', '2024-06-11 18:25:52', 1),
(122, 5, 'INTOCABLE', '__T__A_L_', 'ASLQMTZW', 5, '2024-06-12 14:39:46', '2024-06-12 14:47:22', 2),
(123, 5, 'ESPANTOSO', '_________', '', 5, '2024-06-12 14:47:51', '2024-06-12 14:47:55', 2),
(125, 5, 'EXACTAMENTE', '___________', '', 5, '2024-06-13 17:56:19', '2024-06-13 17:56:25', 2),
(126, 5, 'SOCOLOR', '_______', '', 5, '2024-06-13 17:56:35', '2024-06-13 17:56:39', 2),
(127, 5, 'HECHOR', '______', '', 5, '2024-06-13 17:57:19', '2024-06-13 17:58:28', 2),
(128, 0, 'SEXCENTESIMO', '____________', '', 5, '2024-06-13 17:59:11', NULL, 2),
(129, 0, 'ARTERIOLOGIA', '____________', '', 5, '2024-06-13 18:02:05', '2024-06-13 18:05:51', 2),
(130, 5, 'LITE', '____', '', 5, '2024-06-13 18:05:51', '2024-06-13 18:06:00', 2),
(131, 5, 'PALON', '_____', '', 5, '2024-06-13 18:06:47', '2024-06-13 18:06:51', 2),
(132, 5, 'TEREBECO', '________', '', 5, '2024-06-13 18:06:54', '2024-06-13 18:06:58', 2),
(133, 5, 'MERIDENO', '________', 'AGPQZ', 5, '2024-06-13 18:07:00', '2024-06-13 18:07:21', 2),
(134, 5, 'LANIO', '_____', 'SHP', 5, '2024-06-13 18:07:22', '2024-06-13 18:07:40', 2),
(135, 5, 'ESCRIBIMIENTO', '___________T_', 'TAP', 5, '2024-06-13 18:07:42', '2024-06-13 18:07:59', 2),
(136, 3, 'RESPICE', 'RESPICE', 'AEIOSPNCR', 5, '2024-06-13 18:08:00', '2024-06-13 18:08:36', 2),
(137, 5, 'INMERITAMENTE', '_______A_____', 'SAPWQX', 5, '2024-06-13 18:08:38', '2024-06-13 18:08:55', 2),
(138, 5, 'CENICERO', '________', 'SGPQZ', 5, '2024-06-13 18:08:58', '2024-06-13 18:09:18', 2),
(139, 5, 'MUNIQUES', '________', '', 5, '2024-06-13 18:09:21', '2024-06-13 18:09:24', 2),
(140, 2, 'INDONESIO', 'INDONESIO', 'SAWEIOND', 5, '2024-06-13 18:09:26', '2024-06-13 18:09:52', 2),
(141, 4, 'PATIN', 'PATIN', 'ATRIOSLNP', 5, '2024-06-13 18:09:54', '2024-06-13 18:10:25', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `email` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `clave`, `email`) VALUES
(1, 'pepe', '123456', 'pepe@pepe.es'),
(2, 'luis', '654321', 'luis@luis.es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
