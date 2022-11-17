-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-11-2022 a las 01:25:24
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `cedula_estudiante` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `seguimiento_estudiante` int(11) NOT NULL,
  `estatus_estudiante` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id_institución` int(11) NOT NULL,
  `des_institucion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_institucion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_institucion` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `nota_lapso1` int(2) NOT NULL,
  `nota_lapso2` int(2) DEFAULT NULL,
  `nota_lapso3` int(2) DEFAULT NULL,
  `nota_final` int(2) DEFAULT NULL,
  `recuperativo_1` int(2) DEFAULT NULL,
  `recuperativo_2` int(2) DEFAULT NULL,
  `recuperativo_3` int(2) DEFAULT NULL,
  `recuperativo_4` int(2) DEFAULT NULL,
  `estatusNotas` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_escolar`
--

CREATE TABLE `periodo_escolar` (
  `id_periodo_escolar` int(11) NOT NULL,
  `periodoescolar` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `estatus_periodo_escolar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
('46465456', 'hkjhjkhjkh', 'kjhkjhjkh', 'V', 'M', NULL, '1999-10-10', 'kjhjkhjkhj', '46465456', 'lkjkjkjkjl');

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
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`cedula_estudiante`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id_institución`);

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
  ADD PRIMARY KEY (`id_periodo_escolar`);

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
  MODIFY `id_asignacion_estu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asignacion_profesor_seccion`
--
ALTER TABLE `asignacion_profesor_seccion`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora_notas`
--
ALTER TABLE `bitacora_notas`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institución` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `idNota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pensum`
--
ALTER TABLE `pensum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `periodo_escolar`
--
ALTER TABLE `periodo_escolar`
  MODIFY `id_periodo_escolar` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT;

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
