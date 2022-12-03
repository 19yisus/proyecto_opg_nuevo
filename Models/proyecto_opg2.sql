-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-12-2022 a las 01:18:49
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_opg2`
--
CREATE DATABASE IF NOT EXISTS `proyecto_opg2` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `proyecto_opg2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_estudiante_seccion`
--

CREATE TABLE `asignacion_estudiante_seccion` (
  `id_asignacion_estu` int(11) NOT NULL,
  `cedula_estu_asignacion` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `estatus_asig_estu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asignacion_estudiante_seccion`
--

INSERT INTO `asignacion_estudiante_seccion` (`id_asignacion_estu`, `cedula_estu_asignacion`, `id_seccion`, `id_periodo`, `estatus_asig_estu`) VALUES
(1, '2762468', 1, 1, 0),
(2, '2762468', 3, 2, 0),
(3, '2762468', 5, 3, 0),
(4, '27132642', 5, 3, 0),
(5, '30640465', 5, 3, 0),
(6, '32456479', 5, 3, 0),
(7, '1234576', 3, 2, 1),
(8, '12345699', 3, 2, 1),
(9, '88888888', 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_profesor_seccion`
--

CREATE TABLE `asignacion_profesor_seccion` (
  `id_asignacion` int(11) NOT NULL,
  `profesor_cedula` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `materia_id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `estatus_asignacion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asignacion_profesor_seccion`
--

INSERT INTO `asignacion_profesor_seccion` (`id_asignacion`, `profesor_cedula`, `materia_id`, `seccion_id`, `periodo_id`, `estatus_asignacion`) VALUES
(3, '12345678', 7, 5, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_notas`
--

CREATE TABLE `bitacora_notas` (
  `id_bitacora` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nota_id` int(11) NOT NULL,
  `fecha_bitacora` datetime NOT NULL,
  `observacion_bitacora` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `notas_antiguas` varchar(230) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bitacora_notas`
--

INSERT INTO `bitacora_notas` (`id_bitacora`, `usuario_id`, `nota_id`, `fecha_bitacora`, `observacion_bitacora`, `notas_antiguas`) VALUES
(1, 2, 1, '2022-11-27 18:46:51', 'no', 'Nuevo Registro'),
(2, 2, 2, '2022-11-27 18:46:51', 'no', 'Nuevo Registro'),
(3, 2, 3, '2022-11-27 18:46:51', 'no', 'Nuevo Registro'),
(4, 2, 4, '2022-11-27 19:01:27', 'no', 'Nuevo Registro'),
(5, 2, 5, '2022-11-27 19:01:27', 'no', 'Nuevo Registro'),
(6, 2, 6, '2022-11-27 19:17:31', 'no', 'Nuevo Registro'),
(7, 2, 7, '2022-11-27 19:17:32', 'no', 'Nuevo Registro'),
(8, 2, 8, '2022-11-27 19:17:32', 'no', 'Nuevo Registro'),
(9, 2, 9, '2022-11-27 21:25:05', 'no', 'Nuevo Registro'),
(10, 2, 10, '2022-11-27 21:25:05', 'no', 'Nuevo Registro'),
(11, 2, 11, '2022-11-27 21:25:05', 'no', 'Nuevo Registro'),
(12, 2, 12, '2022-11-27 21:27:08', 'no', 'Nuevo Registro'),
(13, 2, 13, '2022-11-27 21:27:08', 'no', 'Nuevo Registro'),
(14, 2, 14, '2022-11-27 21:27:08', 'no', 'Nuevo Registro'),
(15, 2, 15, '2022-11-27 21:27:23', 'no', 'Nuevo Registro'),
(16, 2, 16, '2022-11-27 21:27:23', 'no', 'Nuevo Registro'),
(17, 2, 17, '2022-11-27 21:27:23', 'no', 'Nuevo Registro'),
(18, 2, 15, '2022-11-27 21:27:45', 'no', 'Actualizacion de notas: recuperativo_1 = 0 => 1 | recuperativo_2 = 0 => 1 | recuperativo_3 = 0 => 1 | recuperativo_4 = 0 => 1 | '),
(19, 2, 16, '2022-11-27 21:27:45', 'no', 'Actualizacion de notas: recuperativo_1 = 0 => 1 | recuperativo_2 = 0 => 1 | recuperativo_3 = 0 => 1 | recuperativo_4 = 0 => 1 | '),
(20, 2, 17, '2022-11-27 21:27:45', 'no', 'Actualizacion de notas: recuperativo_1 = 0 => 1 | recuperativo_2 = 0 => 1 | recuperativo_3 = 0 => 1 | recuperativo_4 = 0 => 1 | '),
(21, 2, 16, '2022-11-27 21:27:57', 'no', 'Actualizacion de notas: recuperativo_3 = 1 => 2 | '),
(22, 2, 15, '2022-11-27 22:11:17', 'no', 'Actualizacion de notas: nota_final = 1 => 11 | '),
(23, 2, 16, '2022-11-27 22:11:17', 'no', 'Actualizacion de notas: nota_final = 1 => 20 | '),
(24, 2, 17, '2022-11-27 22:11:17', 'no', 'Actualizacion de notas: nota_final = 1 => 20 | '),
(25, 2, 15, '2022-11-27 22:11:26', 'no', 'Actualizacion de notas: nota_final = 11 => 8 | recuperativo_1 = 1 => 0 | recuperativo_2 = 1 => 0 | recuperativo_3 = 1 => 0 | recuperativo_4 = 1 => 0 | '),
(26, 2, 16, '2022-11-27 22:11:26', 'no', 'Actualizacion de notas: nota_final = 20 => 4 | recuperativo_1 = 1 => 0 | recuperativo_2 = 1 => 0 | recuperativo_3 = 2 => 0 | recuperativo_4 = 1 => 0 | '),
(27, 2, 17, '2022-11-27 22:11:26', 'no', 'Actualizacion de notas: nota_final = 20 => 4 | recuperativo_1 = 1 => 0 | recuperativo_2 = 1 => 0 | recuperativo_3 = 1 => 0 | recuperativo_4 = 1 => 0 | ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_sistema`
--

CREATE TABLE `bitacora_sistema` (
  `id` int(11) NOT NULL,
  `name_tabla` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `registro_id` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bitacora_sistema`
--

INSERT INTO `bitacora_sistema` (`id`, `name_tabla`, `descripcion`, `registro_id`, `fecha_hora`, `user_id`) VALUES
(2, 'periodo_escolar', 'REGISTRO', '1', '2022-11-27 17:59:04', 2),
(3, 'Institucion', 'REGISTRO', '1', '2022-11-27 18:18:20', 2),
(4, 'periodo_escolar', 'REGISTRO', '1', '2022-11-27 18:18:53', 2),
(5, 'pensum', 'REGISTRO', '1', '2022-11-27 18:31:02', 2),
(6, 'pensum', 'REGISTRO', '2', '2022-11-27 18:31:10', 2),
(7, 'pensum', 'CAMBIO DE ESTATUS', '1', '2022-11-27 18:31:57', 2),
(8, 'pensum', 'CAMBIO DE ESTATUS', '2', '2022-11-27 18:32:29', 2),
(9, 'pensum', 'CAMBIO DE ESTATUS', '2', '2022-11-27 18:32:30', 2),
(10, 'pensum', 'CAMBIO DE ESTATUS', '1', '2022-11-27 18:32:31', 2),
(11, 'pensum', 'CAMBIO DE ESTATUS', '2', '2022-11-27 18:32:32', 2),
(12, 'seccion', 'REGISTRO', '1', '2022-11-27 18:32:50', 2),
(13, 'seccion', 'REGISTRO', '2', '2022-11-27 18:32:50', 2),
(14, 'materia', 'REGISTRO', '1', '2022-11-27 18:41:54', 2),
(15, 'materia', 'REGISTRO', '2', '2022-11-27 18:42:42', 2),
(16, 'pensum', 'CAMBIO DE ESTATUS', '2', '2022-11-27 18:43:26', 2),
(17, 'materia', 'REGISTRO', '3', '2022-11-27 18:43:55', 2),
(18, 'materia', 'REGISTRO', '4', '2022-11-27 18:44:06', 2),
(19, 'materia', 'ACTUALIZACION', '4', '2022-11-27 18:44:24', 2),
(20, 'periodo_escolar', 'REGISTRO', '2', '2022-11-27 18:48:06', 2),
(21, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '1', '2022-11-27 18:48:10', 2),
(22, 'periodo_escolar', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '2', '2022-11-27 18:48:12', 2),
(23, 'pensum', 'REGISTRO', '3', '2022-11-27 18:50:35', 2),
(24, 'seccion', 'REGISTRO', '3', '2022-11-27 18:53:09', 2),
(25, 'seccion', 'REGISTRO', '4', '2022-11-27 18:53:09', 2),
(26, 'materia', 'REGISTRO', '5', '2022-11-27 18:53:52', 2),
(27, 'materia', 'REGISTRO', '6', '2022-11-27 18:54:07', 2),
(28, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '2', '2022-11-27 19:03:43', 2),
(29, 'periodo_escolar', 'REGISTRO', '3', '2022-11-27 19:03:56', 2),
(30, 'pensum', 'REGISTRO', '4', '2022-11-27 19:04:24', 2),
(31, 'seccion', 'REGISTRO', '5', '2022-11-27 19:04:45', 2),
(32, 'seccion', 'REGISTRO', '6', '2022-11-27 19:04:45', 2),
(33, 'materia', 'REGISTRO', '7', '2022-11-27 19:08:27', 2),
(34, 'materia', 'REGISTRO', '8', '2022-11-27 19:08:47', 2),
(35, 'materia', 'REGISTRO', '9', '2022-11-27 19:09:05', 2),
(36, 'materia', 'REGISTRO', '10', '2022-11-27 19:09:06', 2),
(37, 'materia', 'REGISTRO', '11', '2022-11-27 19:10:44', 2),
(38, 'materia', 'REGISTRO', '12', '2022-11-27 19:13:15', 2),
(39, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '3', '2022-11-27 19:37:36', 2),
(40, 'periodo_escolar', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '1', '2022-11-27 19:37:38', 2),
(41, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '1', '2022-11-27 19:52:11', 2),
(42, 'periodo_escolar', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '2', '2022-11-27 19:52:12', 2),
(43, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '2', '2022-11-27 19:52:35', 2),
(44, 'periodo_escolar', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '1', '2022-11-27 19:52:38', 2),
(45, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '1', '2022-11-27 19:53:04', 2),
(46, 'periodo_escolar', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '3', '2022-11-27 19:53:06', 2),
(47, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '3', '2022-11-27 21:32:22', 2),
(48, 'periodo_escolar', 'REGISTRO', '4', '2022-11-27 21:32:36', 2),
(49, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '4', '2022-11-27 21:42:41', 2),
(50, 'periodo_escolar', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '2', '2022-11-27 21:42:43', 2),
(51, 'periodo_escolar', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '2', '2022-11-27 21:56:24', 2),
(52, 'periodo_escolar', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '3', '2022-11-27 21:56:27', 2),
(53, 'institucion', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '1', '2022-11-28 07:30:19', 2),
(54, 'institucion', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '1', '2022-11-28 07:32:31', 2),
(55, 'institucion', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '1', '2022-11-28 07:32:52', 2),
(56, 'institucion', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '1', '2022-11-28 08:53:34', 2),
(57, 'institucion', 'CAMBIO DE ESTATUS (DESACTIVACION DE REGISTRO)', '1', '2022-11-28 08:53:36', 2),
(58, 'institucion', 'CAMBIO DE ESTATUS (ACTIVACION DE REGISTRO)', '1', '2022-11-28 09:05:37', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `cedula_estudiante` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `seguimiento_estudiante` int(11) NOT NULL,
  `estatus_estudiante` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`cedula_estudiante`, `seguimiento_estudiante`, `estatus_estudiante`) VALUES
('12345699', 2, 1),
('1234576', 2, 1),
('27132642', 4, 1),
('2762468', 4, 1),
('30640465', 4, 1),
('32456479', 3, 1),
('88888888', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id_institucion` int(11) NOT NULL,
  `des_institucion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_institucion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_institucion` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `municipio` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `entidad_federal` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `zona_educativa` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `estatus_institucion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_institucion`, `des_institucion`, `codigo_institucion`, `direccion_institucion`, `municipio`, `entidad_federal`, `zona_educativa`, `telefono`, `estatus_institucion`) VALUES
(1, 'uen oscar picon giacopini', '1s3sdaddfs', 'agua blanca', 'agua blanca', 'portuguesa', 'portuguesa', '02557921017', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `des_materia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estatus_materia` tinyint(1) NOT NULL,
  `id_periodo_ma` int(11) NOT NULL,
  `id_pensum_ma` int(11) NOT NULL,
  `primero` tinyint(1) NOT NULL DEFAULT 0,
  `segundo` tinyint(1) NOT NULL DEFAULT 0,
  `tercero` tinyint(1) NOT NULL DEFAULT 0,
  `cuarto` tinyint(1) NOT NULL DEFAULT 0,
  `quinto` tinyint(1) NOT NULL DEFAULT 0,
  `sexto` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `des_materia`, `estatus_materia`, `id_periodo_ma`, `id_pensum_ma`, `primero`, `segundo`, `tercero`, `cuarto`, `quinto`, `sexto`) VALUES
(1, 'materia 1', 1, 1, 1, 1, 1, 1, 0, 0, 0),
(2, 'materia2', 1, 1, 1, 1, 1, 1, 0, 0, 0),
(3, 'materia 3', 1, 1, 1, 1, 1, 1, 0, 0, 0),
(4, 'materia 5', 1, 1, 2, 0, 0, 0, 0, 0, 0),
(5, 'materia 1', 1, 2, 3, 1, 1, 1, 0, 0, 0),
(6, 'materia 2', 1, 2, 3, 1, 1, 1, 0, 0, 0),
(7, 'materia 1', 1, 3, 4, 1, 1, 1, 0, 0, 0),
(8, 'materia 2', 1, 3, 4, 1, 1, 1, 0, 0, 0),
(9, 'materia 3', 1, 3, 4, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `idNota` int(11) NOT NULL,
  `cedula_estudiante` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `periodo_escolar_id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `lapso_id` int(11) DEFAULT NULL,
  `nota_lapso1` int(2) DEFAULT NULL,
  `nota_lapso2` int(2) DEFAULT NULL,
  `nota_lapso3` int(2) DEFAULT NULL,
  `nota_final` int(2) DEFAULT NULL,
  `recuperativo_1` int(2) DEFAULT NULL,
  `recuperativo_2` int(2) DEFAULT NULL,
  `recuperativo_3` int(2) DEFAULT NULL,
  `recuperativo_4` int(2) DEFAULT NULL,
  `estatusNotas` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`idNota`, `cedula_estudiante`, `periodo_escolar_id`, `seccion_id`, `materia_id`, `lapso_id`, `nota_lapso1`, `nota_lapso2`, `nota_lapso3`, `nota_final`, `recuperativo_1`, `recuperativo_2`, `recuperativo_3`, `recuperativo_4`, `estatusNotas`) VALUES
(1, '2762468', 1, 1, 1, NULL, NULL, NULL, NULL, 10, 0, 0, 0, 0, 0),
(2, '2762468', 1, 1, 2, NULL, NULL, NULL, NULL, 10, 0, 0, 0, 0, 0),
(3, '2762468', 1, 1, 3, NULL, NULL, NULL, NULL, 20, 0, 0, 0, 0, 0),
(4, '2762468', 2, 3, 5, NULL, NULL, NULL, NULL, 20, 0, 0, 0, 0, 0),
(5, '2762468', 2, 3, 6, NULL, NULL, NULL, NULL, 20, 0, 0, 0, 0, 0),
(6, '2762468', 3, 5, 7, NULL, NULL, NULL, NULL, 20, 0, 0, 0, 0, 0),
(7, '2762468', 3, 5, 8, NULL, NULL, NULL, NULL, 20, 0, 0, 0, 0, 0),
(8, '2762468', 3, 5, 9, NULL, NULL, NULL, NULL, 20, 0, 0, 0, 0, 0),
(9, '27132642', 3, 5, 7, NULL, NULL, NULL, NULL, 15, 0, 0, 0, 0, 0),
(10, '27132642', 3, 5, 8, NULL, NULL, NULL, NULL, 15, 0, 0, 0, 0, 0),
(11, '27132642', 3, 5, 9, NULL, NULL, NULL, NULL, 15, 0, 0, 0, 0, 0),
(12, '30640465', 3, 5, 7, NULL, NULL, NULL, NULL, 16, 0, 0, 0, 0, 0),
(13, '30640465', 3, 5, 8, NULL, NULL, NULL, NULL, 14, 0, 0, 0, 0, 0),
(14, '30640465', 3, 5, 9, NULL, NULL, NULL, NULL, 13, 0, 0, 0, 0, 0),
(15, '32456479', 3, 5, 7, NULL, NULL, NULL, NULL, 8, 0, 0, 0, 0, 0),
(16, '32456479', 3, 5, 8, NULL, NULL, NULL, NULL, 4, 0, 0, 0, 0, 0),
(17, '32456479', 3, 5, 9, NULL, NULL, NULL, NULL, 4, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pensum`
--

CREATE TABLE `pensum` (
  `id` int(11) NOT NULL,
  `cod_pensum` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `anios_abarcados` enum('B','D','E') COLLATE utf8_spanish_ci NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `estatus_pensum` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pensum`
--

INSERT INTO `pensum` (`id`, `cod_pensum`, `anios_abarcados`, `periodo_id`, `estatus_pensum`) VALUES
(1, '15554', 'B', 1, 1),
(2, '15554', 'D', 1, 1),
(3, '40155', 'B', 2, 1),
(4, '14405', 'B', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_escolar`
--

CREATE TABLE `periodo_escolar` (
  `id_periodo_escolar` int(11) NOT NULL,
  `periodoescolar` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `estatus_periodo_escolar` tinyint(1) NOT NULL,
  `institucion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `periodo_escolar`
--

INSERT INTO `periodo_escolar` (`id_periodo_escolar`, `periodoescolar`, `fecha_inicio`, `fecha_cierre`, `estatus_periodo_escolar`, `institucion_id`) VALUES
(1, '1987-1988', '1987-09-01', '1988-07-28', 0, 1),
(2, '1988-1989', '1988-09-01', '1989-07-28', 0, 1),
(3, '1989-1990', '1989-09-01', '1990-07-28', 1, 1),
(4, '1990-1991', '1990-09-01', '1991-07-28', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `cedula_persona` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_persona` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_persona` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `nacionalidad_persona` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `sexo_persona` enum('F','M','O') COLLATE utf8_spanish_ci NOT NULL,
  `correo_persona` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_n_persona` date NOT NULL,
  `direccion_persona` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_persona` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion_n_persona` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`cedula_persona`, `nombre_persona`, `apellido_persona`, `nacionalidad_persona`, `sexo_persona`, `correo_persona`, `fecha_n_persona`, `direccion_persona`, `telefono_persona`, `direccion_n_persona`) VALUES
('10001231', 'fasdfasfasd', 'gsgsdgsdf', 'V', 'M', 'dadsfsdgdgdfsg@gmail.com', '1971-01-01', 'sdgsgsggfdg', '10001231', NULL),
('12332646', 'alfonsino director', 'medina', 'V', 'M', 'fasdfasdfadsfasd@gmail.com', '1971-05-10', '', NULL, NULL),
('12345678', 'Jose Manuel', 'Perez Lopez', 'V', 'M', 'asdasasdasd@gmail.com', '1971-09-01', 'asdasdasd', '12345678', NULL),
('12345699', 'asdasdasd', 'dasdasd', 'V', 'M', NULL, '1972-02-02', 'sadasdasd', '12345699', 'asdasdasd'),
('1234576', 'asdasdasd', 'asdasdad', 'V', 'M', NULL, '1971-08-11', 'asdasdas', '1234576', 'sdasdasd'),
('27132642', 'jesus', 'morales', 'V', 'M', NULL, '1977-08-29', 'fasdfasdfasd', '27132642', 'fasdfasdfasdf'),
('2762468', 'Jose Manuel', 'Perez Lopez', 'V', 'M', NULL, '1975-01-01', 'asdasdasd', '2762468', 'sadasdasd'),
('29775742', 'jesus', 'pichardo', 'V', 'M', 'muraa_mari@gmail.com', '1950-04-18', 'casaca', '29775742', NULL),
('30640465', 'nose', 'perez', 'V', 'M', NULL, '1977-08-30', 'fasdfasdfadsfadsf', '30640465', 'fasdfasdfasdf'),
('32456479', 'fasdfadfasdf', 'fasdfasdfadsf', 'V', 'M', NULL, '1977-05-01', 'fasdfasdfasdf', '32456479', 'fasdfasdfasdf'),
('45654987', 'fasdfasdfa', 'fasdfasdfasd', 'V', 'M', 'fasdfasdfasdfasdfasdf@gmail.com', '1970-05-10', 'fasdfasdfasdf', '45654987', NULL),
('88888888', 'asasdasda', 'daasdasdsa', 'V', 'M', NULL, '1972-02-02', 'asdasdasdas', '88888888', 'sdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregun` int(11) NOT NULL,
  `des_pregun` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregun`, `des_pregun`) VALUES
(1, 'Animal favorito'),
(2, 'Color favorito'),
(3, 'Lugar donde naciste'),
(4, 'Pelicula favorita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `cedula_profesor` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `estatus_profesor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`cedula_profesor`, `estatus_profesor`) VALUES
('10001231', 1),
('12332646', 1),
('12345678', 1),
('45654987', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(2) NOT NULL,
  `rol` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'SUPER ADMIN'),
(2, 'ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `idSeccion` int(11) NOT NULL,
  `id_seccion` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `ano_seguimiento` int(11) NOT NULL,
  `estatus_seccion` tinyint(1) NOT NULL,
  `id_sec_periodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`idSeccion`, `id_seccion`, `ano_seguimiento`, `estatus_seccion`, `id_sec_periodo`) VALUES
(1, '1A', 1, 1, 1),
(2, '1B', 1, 1, 1),
(3, '2A', 2, 1, 2),
(4, '2B', 2, 1, 2),
(5, '3A', 3, 1, 3),
(6, '3B', 3, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `pregunta1` int(11) NOT NULL,
  `pregunta2` int(11) NOT NULL,
  `respuesta1` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta2` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(2) NOT NULL,
  `estatus_usuario` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `pregunta1`, `pregunta2`, `respuesta1`, `respuesta2`, `id_rol`, `estatus_usuario`) VALUES
(1, '27132642', '$2y$12$9IJorIrYaVL5sw56Wn2.leFnlYLD9r.Q.TLfva0YnaC9jI7M3sEf.', 2, 1, 'azul', 'gato', 2, 1),
(2, '12345678', '$2y$12$HG5VOfKxXMpfgOXTr6Pj0.DU7djkaTLDUF17eKrrE.ZzaTImucztK', 1, 3, 'nada', 'nada', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion_estudiante_seccion`
--
ALTER TABLE `asignacion_estudiante_seccion`
  ADD PRIMARY KEY (`id_asignacion_estu`),
  ADD KEY `seccion_id` (`id_seccion`),
  ADD KEY `periodo_id` (`id_periodo`),
  ADD KEY `cedula_edu` (`cedula_estu_asignacion`);

--
-- Indices de la tabla `asignacion_profesor_seccion`
--
ALTER TABLE `asignacion_profesor_seccion`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `profesor_cedula` (`profesor_cedula`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `periodo_id` (`periodo_id`),
  ADD KEY `seccion_id` (`seccion_id`);

--
-- Indices de la tabla `bitacora_notas`
--
ALTER TABLE `bitacora_notas`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `nota_id` (`nota_id`);

--
-- Indices de la tabla `bitacora_sistema`
--
ALTER TABLE `bitacora_sistema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`cedula_estudiante`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id_institucion`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `id_periodo_ma` (`id_periodo_ma`),
  ADD KEY `id_pensum_ma` (`id_pensum_ma`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`idNota`),
  ADD KEY `periodo_escolar_id` (`periodo_escolar_id`),
  ADD KEY `cedula` (`cedula_estudiante`),
  ADD KEY `seccion` (`seccion_id`),
  ADD KEY `idAsignacion` (`materia_id`),
  ADD KEY `lapso_id` (`lapso_id`);

--
-- Indices de la tabla `pensum`
--
ALTER TABLE `pensum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `periodo_escolar`
--
ALTER TABLE `periodo_escolar`
  ADD PRIMARY KEY (`id_periodo_escolar`),
  ADD KEY `institucion_id` (`institucion_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`cedula_persona`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregun`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`cedula_profesor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`idSeccion`),
  ADD KEY `secion_periodoo` (`id_sec_periodo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `pregunta1` (`pregunta1`),
  ADD KEY `pregunta2` (`pregunta2`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion_estudiante_seccion`
--
ALTER TABLE `asignacion_estudiante_seccion`
  MODIFY `id_asignacion_estu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `asignacion_profesor_seccion`
--
ALTER TABLE `asignacion_profesor_seccion`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bitacora_notas`
--
ALTER TABLE `bitacora_notas`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `bitacora_sistema`
--
ALTER TABLE `bitacora_sistema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `idNota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `pensum`
--
ALTER TABLE `pensum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `periodo_escolar`
--
ALTER TABLE `periodo_escolar`
  MODIFY `id_periodo_escolar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion_estudiante_seccion`
--
ALTER TABLE `asignacion_estudiante_seccion`
  ADD CONSTRAINT `asignacion_estudiante_seccion_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`idSeccion`),
  ADD CONSTRAINT `estudiante_asig` FOREIGN KEY (`cedula_estu_asignacion`) REFERENCES `estudiante` (`cedula_estudiante`),
  ADD CONSTRAINT `periodo_asignacion` FOREIGN KEY (`id_periodo`) REFERENCES `periodo_escolar` (`id_periodo_escolar`);

--
-- Filtros para la tabla `asignacion_profesor_seccion`
--
ALTER TABLE `asignacion_profesor_seccion`
  ADD CONSTRAINT `asignacion_profesor_seccion_ibfk_1` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`idSeccion`),
  ADD CONSTRAINT `materia_asignacion` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id_materia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `periodo_asignacionnn` FOREIGN KEY (`periodo_id`) REFERENCES `periodo_escolar` (`id_periodo_escolar`),
  ADD CONSTRAINT `professor_asignacion` FOREIGN KEY (`profesor_cedula`) REFERENCES `profesor` (`cedula_profesor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `bitacora_notas`
--
ALTER TABLE `bitacora_notas`
  ADD CONSTRAINT `nota_bitacora` FOREIGN KEY (`nota_id`) REFERENCES `nota` (`idNota`),
  ADD CONSTRAINT `usuario_bitacora` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `bitacora_sistema`
--
ALTER TABLE `bitacora_sistema`
  ADD CONSTRAINT `bitacora_sistema_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bitacora_sistema` (`id`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_persona` FOREIGN KEY (`cedula_estudiante`) REFERENCES `personas` (`cedula_persona`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_periodooo` FOREIGN KEY (`id_periodo_ma`) REFERENCES `periodo_escolar` (`id_periodo_escolar`),
  ADD CONSTRAINT `pensum_materia_id` FOREIGN KEY (`id_pensum_ma`) REFERENCES `pensum` (`id`);

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `notas_asignacion` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `notas_estudiante` FOREIGN KEY (`cedula_estudiante`) REFERENCES `estudiante` (`cedula_estudiante`),
  ADD CONSTRAINT `nuevo_id_seccion` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`idSeccion`),
  ADD CONSTRAINT `periodo_asignacionn` FOREIGN KEY (`periodo_escolar_id`) REFERENCES `periodo_escolar` (`id_periodo_escolar`);

--
-- Filtros para la tabla `pensum`
--
ALTER TABLE `pensum`
  ADD CONSTRAINT `pensum_ibfk_1` FOREIGN KEY (`periodo_id`) REFERENCES `periodo_escolar` (`id_periodo_escolar`);

--
-- Filtros para la tabla `periodo_escolar`
--
ALTER TABLE `periodo_escolar`
  ADD CONSTRAINT `periodo_escolar_ibfk_1` FOREIGN KEY (`institucion_id`) REFERENCES `institucion` (`id_institucion`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `cedula_profesor` FOREIGN KEY (`cedula_profesor`) REFERENCES `personas` (`cedula_persona`);

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `secion_periodoo` FOREIGN KEY (`id_sec_periodo`) REFERENCES `periodo_escolar` (`id_periodo_escolar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idPregun1` FOREIGN KEY (`pregunta1`) REFERENCES `preguntas` (`id_pregun`),
  ADD CONSTRAINT `idPregun2` FOREIGN KEY (`pregunta2`) REFERENCES `preguntas` (`id_pregun`),
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
