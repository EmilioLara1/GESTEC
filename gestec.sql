-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2023 a las 04:16:53
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
-- Base de datos: `gestec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Correo`, `Contraseña`) VALUES
('gestec@cucea.udg.mx', 'Pass4321');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `Codigo` varchar(9) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`Codigo`, `Correo`, `Contraseña`) VALUES
('214603948', 'fatima@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `Codigo` varchar(9) NOT NULL,
  `Nombre` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `ID` int(4) NOT NULL,
  `Resguardo` int(9) NOT NULL,
  `No_Serie` varchar(35) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `Modelo` varchar(25) NOT NULL,
  `Marca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_prestamos`
--

CREATE TABLE `estatus_prestamos` (
  `Tipo_Prestamo` varchar(20) NOT NULL,
  `Estatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estatus_prestamos`
--

INSERT INTO `estatus_prestamos` (`Tipo_Prestamo`, `Estatus`) VALUES
('INTERNO', 'habilitado'),
('EXTERNO', 'habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `Folio` int(5) NOT NULL,
  `ID` int(4) NOT NULL,
  `Codigo` varchar(9) NOT NULL,
  `Fecha_Prestamo` timestamp NOT NULL DEFAULT current_timestamp(),
  `Fecha_Devolucion` timestamp NOT NULL DEFAULT current_timestamp(),
  `Tipo` varchar(7) NOT NULL,
  `Estatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`Folio`, `ID`, `Codigo`, `Fecha_Prestamo`, `Fecha_Devolucion`, `Tipo`, `Estatus`) VALUES
(23194, 0, '214603948', '2023-05-23 02:09:19', '2023-05-23 02:09:19', 'INTERNO', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Codigo` varchar(9) NOT NULL,
  `Nombres` varchar(25) NOT NULL,
  `Ape_Pat` varchar(25) NOT NULL,
  `Ape_Mat` varchar(25) NOT NULL,
  `Carrera` varchar(45) NOT NULL,
  `Domicilio` varchar(45) NOT NULL,
  `Colonia` varchar(40) NOT NULL,
  `Celular` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Codigo`, `Nombres`, `Ape_Pat`, `Ape_Mat`, `Carrera`, `Domicilio`, `Colonia`, `Celular`) VALUES
('214603948', 'Fatima', 'Montanez', 'Orozco', 'Tecnologías de la Información', 'Santo Tomas', 'Mision San', '3315740445');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`Correo`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`Folio`),
  ADD KEY `Codigo` (`Codigo`),
  ADD KEY `ID` (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`Codigo`) REFERENCES `usuarios` (`Codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`Codigo`) REFERENCES `usuarios` (`Codigo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
