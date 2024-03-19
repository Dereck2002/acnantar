-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-03-2024 a las 20:57:55
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cajaahorronantar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controlcreditos`
--

CREATE TABLE `controlcreditos` (
  `id_control` int(11) NOT NULL,
  `id_creditos` int(11) NOT NULL,
  `id_socios` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `cuota_pagada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `id_creditos` int(11) NOT NULL,
  `id_socios` int(11) NOT NULL,
  `id_garante` int(11) NOT NULL,
  `fecha_credito` date NOT NULL,
  `valor_credito` float NOT NULL,
  `destino_credito` varchar(50) NOT NULL,
  `plazo_credito` int(11) NOT NULL,
  `valor_aprobado` float NOT NULL,
  `plazo_aprobado` int(11) NOT NULL,
  `fecha_aprobacion` date NOT NULL,
  `cuota_mensual` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRoles` int(11) NOT NULL,
  `Detalle` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRoles`, `Detalle`) VALUES
(1, 'Administrador'),
(13, 'invitado2'),
(14, 'Invitado4'),
(18, 'invitado5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `Id_socio` int(11) NOT NULL,
  `Cedula_socio` varchar(10) NOT NULL,
  `Nombres_socio` varchar(100) NOT NULL,
  `Fecha_nacimiento_socio` date NOT NULL,
  `Telefono_socio` varchar(11) NOT NULL,
  `Direccion_socio` varchar(100) NOT NULL,
  `Email_socio` varchar(100) NOT NULL,
  `Ocupacion_socio` varchar(50) NOT NULL,
  `Fecha_ingreso_socio` date NOT NULL,
  `posicion` varchar(100) NOT NULL DEFAULT 'socio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`Id_socio`, `Cedula_socio`, `Nombres_socio`, `Fecha_nacimiento_socio`, `Telefono_socio`, `Direccion_socio`, `Email_socio`, `Ocupacion_socio`, `Fecha_ingreso_socio`, `posicion`) VALUES
(1, '1400373583', 'AYUY AGUANANCHI ANTONIO WILMER', '1975-07-31', '0999122053', 'SEVILLA DON BOSCO BARRIO CENTRO', 'wilmerayuy@gmail.com', 'AGRICULTOR', '2022-09-09', 'NN'),
(3, '1103004311', 'SARANGO VACACELA LAURO VICENTE', '1971-04-29', '0982682663', 'SEVILLA DON BOSCO - BARRIO CENTRO- JUNTO AL PARQUE CENTRAL', 'sarangovicente@gmail.com', 'GERENTE PROPIETARIO HOTEL YANKUAM', '2022-09-22', 'NN'),
(4, '1400261945', 'SAANT SHUAR MARIA CLEOTILDE', '1966-06-11', '0982808837', 'SEVILLA DON BOSCO - BARRIO CENTRO', 'mariasaant@gmail.com', 'DOCENTE UE. ANGEL ROUBY', '2023-08-25', 'NN'),
(5, '1400951461', 'YURANK TSAMARAINT MARIA ANGELA', '1998-05-14', '0962871389', 'SEVILLA DON BOSCO BARRIO LAS PALMERAS', '', 'EMPRENDEDORA', '2023-09-04', 'NN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id_aportes` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `fecha_aportes` date NOT NULL,
  `desc_aportes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsaurio` int(11) NOT NULL,
  `Nombres` text NOT NULL,
  `Apellidos` text NOT NULL,
  `contrasenia` text NOT NULL,
  `correo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsaurio`, `Nombres`, `Apellidos`, `contrasenia`, `correo`) VALUES
(1, 'antonio wilmer', 'ayuy aguananchi', '123', 'wilmerayuy@gmail.com'),
(14, 'Dereck', 'Jaramillo', '123', 'derekjaramillo@gmail.com'),
(15, 'Juan Carlos', 'Martinez', '1234', 'juanm@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `idUsuarios_Roles` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idRoles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`idUsuarios_Roles`, `idUsuario`, `idRoles`) VALUES
(9, 1, 1),
(16, 14, 1),
(17, 15, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `controlcreditos`
--
ALTER TABLE `controlcreditos`
  ADD PRIMARY KEY (`id_control`),
  ADD KEY `idx_creditos` (`id_creditos`),
  ADD KEY `id_socios` (`id_socios`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id_creditos`),
  ADD KEY `id_garante` (`id_garante`),
  ADD KEY `id_socios` (`id_socios`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRoles`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`Id_socio`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id_aportes`),
  ADD KEY `idx_idsocio` (`id_socio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsaurio`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`idUsuarios_Roles`),
  ADD KEY `UR_Usuarios` (`idUsuario`),
  ADD KEY `UR?Roles` (`idRoles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `controlcreditos`
--
ALTER TABLE `controlcreditos`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id_creditos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRoles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `Id_socio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_aportes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsaurio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  MODIFY `idUsuarios_Roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `controlcreditos`
--
ALTER TABLE `controlcreditos`
  ADD CONSTRAINT `controlcreditos_ibfk_1` FOREIGN KEY (`id_creditos`) REFERENCES `creditos` (`id_creditos`);

--
-- Filtros para la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD CONSTRAINT `creditos_ibfk_1` FOREIGN KEY (`id_creditos`) REFERENCES `socios` (`Id_socio`);

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`id_aportes`) REFERENCES `socios` (`Id_socio`);

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `UR?Roles` FOREIGN KEY (`idRoles`) REFERENCES `roles` (`idRoles`),
  ADD CONSTRAINT `UR_Usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsaurio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
