-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generaci√≥n: 14-01-2020 a las 18:14:07
-- Versi√≥n del servidor: 10.4.11-MariaDB
-- Versi√≥n de PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `guarderia_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `color` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuarioCreacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuarioModificacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaModificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id`, `color`, `usuarioCreacion`, `fechaCreacion`, `usuarioModificacion`, `fechaModificacion`) VALUES
(1, 'Amarilla', 'root@localhost', '2020-01-05 00:53:12', NULL, '2020-01-05 00:53:12'),
(2, 'Rojo', 'root@localhost', '2020-01-13 02:35:44', NULL, '2020-01-13 02:35:44'),
(3, 'Azul', 'root@localhost', '2020-01-13 02:36:02', NULL, '2020-01-13 02:36:02'),
(4, 'Verde', 'root@localhost', '2020-01-13 12:00:28', NULL, '2020-01-13 12:00:28');

--
-- Disparadores `aulas`
--
DELIMITER $$
CREATE TRIGGER `aulas_BEFORE_INSERT` BEFORE INSERT ON `aulas` FOR EACH ROW BEGIN
set new.usuarioCreacion = user();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `aulas_BEFORE_UPDATE` BEFORE UPDATE ON `aulas` FOR EACH ROW BEGIN
set new.usuarioModificacion = user();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentacuidadores`
--

CREATE TABLE `cuentacuidadores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `usuarioCreacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuarioModificacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaModificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `cuentacuidadores`
--

INSERT INTO `cuentacuidadores` (`id`, `usuario`, `password`, `usuarioCreacion`, `fechaCreacion`, `usuarioModificacion`, `fechaModificacion`, `tipo`) VALUES
(0, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'root@localhost', '2020-01-14 12:30:15', 'root@localhost', '2020-01-14 12:33:59', 'admin'),
(1, 'ryan.tho.gos', 'a1f18ddfbb56aa41d00f8c0813736ebf', 'root@localhost', '2020-01-14 12:05:55', NULL, '2020-01-14 12:05:55', ''),
(2, 'emily.jea.sto', 'a1f18ddfbb56aa41d00f8c0813736ebf', 'root@localhost', '2020-01-14 12:08:26', NULL, '2020-01-14 12:08:26', ''),
(3, 'john.rog.ste', 'a1f18ddfbb56aa41d00f8c0813736ebf', 'root@localhost', '2020-01-14 12:27:23', NULL, '2020-01-14 12:27:23', ''),
(4, 'rosemarie.bra.dew', 'a1f18ddfbb56aa41d00f8c0813736ebf', 'root@localhost', '2020-01-14 12:41:28', 'root@localhost', '2020-01-14 12:44:22', '');

--
-- Disparadores `cuentacuidadores`
--
DELIMITER $$
CREATE TRIGGER `cuentaCuidadores_BEFORE_INSERT` BEFORE INSERT ON `cuentacuidadores` FOR EACH ROW BEGIN
set new.usuarioCreacion = user();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cuentaCuidadores_BEFORE_UPDATE` BEFORE UPDATE ON `cuentacuidadores` FOR EACH ROW BEGIN
set new.usuarioModificacion = user();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentatutores`
--

CREATE TABLE `cuentatutores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `usuarioCreacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuarioModificacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaModificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `cuentatutores`
--

INSERT INTO `cuentatutores` (`id`, `usuario`, `password`, `usuarioCreacion`, `fechaCreacion`, `usuarioModificacion`, `fechaModificacion`) VALUES
(1, 'alexia.rui.bel', 'a1f18ddfbb56aa41d00f8c0813736ebf', 'root@localhost', '2020-01-14 12:57:37', NULL, '2020-01-14 12:57:37');

--
-- Disparadores `cuentatutores`
--
DELIMITER $$
CREATE TRIGGER `cuentaTutores_BEFORE_INSERT` BEFORE INSERT ON `cuentatutores` FOR EACH ROW BEGIN
set new.usuarioCreacion = user();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cuentaTutores_BEFORE_UPDATE` BEFORE UPDATE ON `cuentatutores` FOR EACH ROW BEGIN
set new.usuarioModificacion = user();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuidadores`
--

CREATE TABLE `cuidadores` (
  `id` int(11) NOT NULL,
  `dni` char(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `primerApellido` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `segundoApellido` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `usuarioCreacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuarioModificacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaModificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cuentaCuidadores_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `cuidadores`
--

INSERT INTO `cuidadores` (`id`, `dni`, `nombre`, `primerApellido`, `segundoApellido`, `fecha_nacimiento`, `usuarioCreacion`, `fechaCreacion`, `usuarioModificacion`, `fechaModificacion`, `cuentaCuidadores_id`) VALUES
(1, '76873424L', 'Ryan', 'Thomas', 'Gosling ', '1980-12-12', 'root@localhost', '2020-01-14 12:05:55', 'root@localhost', '2020-01-14 12:06:30', 1),
(2, '89431983N', 'Emily', 'Jean', 'Stone', '1988-11-06', 'root@localhost', '2020-01-14 12:08:26', 'root@localhost', '2020-01-14 12:15:33', 2),
(3, '59784345R', 'John', 'Roger', 'Stephens', '1978-12-28', 'root@localhost', '2020-01-14 12:27:24', 'root@localhost', '2020-01-14 12:29:48', 3),
(4, '72023928L', 'Rosemarie ', 'Braddock', 'DeWitt', '1971-10-26', 'root@localhost', '2020-01-14 12:41:28', 'root@localhost', '2020-01-14 12:43:42', 4);

--
-- Disparadores `cuidadores`
--
DELIMITER $$
CREATE TRIGGER `cuidadores_BEFORE_INSERT` BEFORE INSERT ON `cuidadores` FOR EACH ROW BEGIN
set new.usuarioCreacion = user();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cuidadores_BEFORE_UPDATE` BEFORE UPDATE ON `cuidadores` FOR EACH ROW BEGIN
set new.usuarioModificacion = user();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `texto` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `texto`, `fechaCreacion`) VALUES
(1, 'La guarderÌa comienza el dÌa 25 de enero de 2020, por la tarde haremos una fiesta de bienvenida. Saludos', '2020-01-14 16:58:51'),
(2, 'El dÌa 30 de Enero de 2020 celebra en el centro el cumpleaÒos de Ryan Gosling, se agradece vuestra presencia, gracias.', '2020-01-14 17:20:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `id` int(11) NOT NULL,
  `cod_matricula` int(11) NOT NULL,
  `usuarioCreacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuarioModificacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaModificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ninos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Disparadores `matricula`
--
DELIMITER $$
CREATE TRIGGER `matricula_BEFORE_INSERT` BEFORE INSERT ON `matricula` FOR EACH ROW BEGIN
set new.usuarioCreacion = user();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `matricula_BEFORE_UPDATE` BEFORE UPDATE ON `matricula` FOR EACH ROW BEGIN
set new.usuarioModificacion = user();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ninos`
--

CREATE TABLE `ninos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `primerApellido` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `segundoApellido` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `usuarioCreacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuarioModificacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaModificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tutores_id` int(11) NOT NULL,
  `cuidadores_id` int(11) NOT NULL,
  `aulas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ninos`
--

INSERT INTO `ninos` (`id`, `nombre`, `primerApellido`, `segundoApellido`, `fecha_nacimiento`, `usuarioCreacion`, `fechaCreacion`, `usuarioModificacion`, `fechaModificacion`, `tutores_id`, `cuidadores_id`, `aulas_id`) VALUES
(1, 'Axel', 'PÈrez', 'RuÌz', '2016-07-07', 'root@localhost', '2020-01-14 14:41:39', NULL, '2020-01-14 14:41:39', 1, 1, 1);

--
-- Disparadores `ninos`
--
DELIMITER $$
CREATE TRIGGER `ninos_BEFORE_INSERT` BEFORE INSERT ON `ninos` FOR EACH ROW BEGIN
set new.usuarioCreacion = user();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ninos_BEFORE_UPDATE` BEFORE UPDATE ON `ninos` FOR EACH ROW BEGIN
set new.usuarioModificacion = user();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutores`
--

CREATE TABLE `tutores` (
  `id` int(11) NOT NULL,
  `dni` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `primerApellido` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `segundoApellido` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `usuarioCreacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuarioModificacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaModificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cuentaTutores_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tutores`
--

INSERT INTO `tutores` (`id`, `dni`, `nombre`, `primerApellido`, `segundoApellido`, `direccion`, `telefono`, `usuarioCreacion`, `fechaCreacion`, `usuarioModificacion`, `fechaModificacion`, `cuentaTutores_id`) VALUES
(1, '67281049H', 'Alexia', 'RuÌz', 'Beltr·n', 'C/ Cervantes 78 4A', 62301928, 'root@localhost', '2020-01-14 12:57:37', NULL, '2020-01-14 12:57:37', 1);

--
-- Disparadores `tutores`
--
DELIMITER $$
CREATE TRIGGER `tutores_BEFORE_INSERT` BEFORE INSERT ON `tutores` FOR EACH ROW BEGIN
set new.usuarioCreacion = user();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tutores_BEFORE_UPDATE` BEFORE UPDATE ON `tutores` FOR EACH ROW BEGIN
set new.usuarioModificacion = user();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuarioCreacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuarioModificacion` varchar(45) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fechaModificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `usuarios_BEFORE_INSERT` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN
set new.usuarioCreacion = user();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuarios_BEFORE_UPDATE` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
set new.usuarioModificacion = user();
END
$$
DELIMITER ;

--
-- √çndices para tablas volcadas
--

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `color_UNIQUE` (`color`);

--
-- Indices de la tabla `cuentacuidadores`
--
ALTER TABLE `cuentacuidadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentatutores`
--
ALTER TABLE `cuentatutores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuidadores`
--
ALTER TABLE `cuidadores`
  ADD PRIMARY KEY (`id`,`cuentaCuidadores_id`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD KEY `fk_cuidadores_cuentaCuidadores1_idx` (`cuentaCuidadores_id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id`,`ninos_id`),
  ADD UNIQUE KEY `cod_matricula_UNIQUE` (`cod_matricula`),
  ADD KEY `fk_matricula_ninos1_idx` (`ninos_id`);

--
-- Indices de la tabla `ninos`
--
ALTER TABLE `ninos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ninos_tutores_idx` (`tutores_id`),
  ADD KEY `fk_ninos_cuidadores1_idx` (`cuidadores_id`),
  ADD KEY `fk_ninos_aulas1_idx` (`aulas_id`);

--
-- Indices de la tabla `tutores`
--
ALTER TABLE `tutores`
  ADD PRIMARY KEY (`id`,`cuentaTutores_id`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD KEY `fk_tutores_cuentaTutores1_idx` (`cuentaTutores_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cuentacuidadores`
--
ALTER TABLE `cuentacuidadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cuentatutores`
--
ALTER TABLE `cuentatutores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuidadores`
--
ALTER TABLE `cuidadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ninos`
--
ALTER TABLE `ninos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tutores`
--
ALTER TABLE `tutores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuidadores`
--
ALTER TABLE `cuidadores`
  ADD CONSTRAINT `fk_cuidadores_cuentaCuidadores1` FOREIGN KEY (`cuentaCuidadores_id`) REFERENCES `cuentacuidadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_matricula_ninos1` FOREIGN KEY (`ninos_id`) REFERENCES `ninos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ninos`
--
ALTER TABLE `ninos`
  ADD CONSTRAINT `fk_ninos_aulas1` FOREIGN KEY (`aulas_id`) REFERENCES `aulas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ninos_cuidadores1` FOREIGN KEY (`cuidadores_id`) REFERENCES `cuidadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ninos_tutores` FOREIGN KEY (`tutores_id`) REFERENCES `tutores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tutores`
--
ALTER TABLE `tutores`
  ADD CONSTRAINT `fk_tutores_cuentaTutores1` FOREIGN KEY (`cuentaTutores_id`) REFERENCES `cuentatutores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
