-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2019 a las 01:31:27
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lingoyes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `CodigoCargo` int(10) NOT NULL,
  `CodigoUser` int(10) NOT NULL,
  `CodigoCiudad` int(10) NOT NULL,
  `rol` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`CodigoCargo`, `CodigoUser`, `CodigoCiudad`, `rol`) VALUES
(1, 3, 2, 'Docente'),
(2, 5, 1, 'Docente'),
(3, 6, 3, 'Secretaria'),
(4, 7, 3, 'administra'),
(5, 8, 2, 'Administra'),
(6, 9, 2, 'Docente'),
(7, 10, 1, 'Administrador'),
(8, 11, 1, 'Docente'),
(11, 13, 1, 'Administrador'),
(12, 14, 1, 'Secretaria/o');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `CodigoCiudad` int(10) NOT NULL,
  `NombreCiudad` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`CodigoCiudad`, `NombreCiudad`) VALUES
(1, 'YOPAL'),
(2, 'SOGAMOSO'),
(3, 'TUNJA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `CodigoDocente` int(10) NOT NULL,
  `CodigoUser` int(10) NOT NULL,
  `CodigoGrupo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`CodigoDocente`, `CodigoUser`, `CodigoGrupo`) VALUES
(7, 10, 31),
(8, 8, 33),
(10, 14, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `CodigoEstado` int(10) NOT NULL,
  `CodigoMattricula` int(10) NOT NULL,
  `NombreEstado` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Deuda` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `Cuotas` float NOT NULL,
  `CodigoEstudiante` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`CodigoEstado`, `CodigoMattricula`, `NombreEstado`, `Deuda`, `Cuotas`, `CodigoEstudiante`) VALUES
(32, 35, 'PAGADO', '0', 0, 26),
(33, 36, 'NO PAGO', '150000', 1, 26),
(34, 37, 'NO PAGO', '250000', 1, 23),
(35, 38, 'PAGADO', '0', 0, 23),
(36, 39, 'NO PAGO', '250000', 1, 22),
(37, 40, 'NO PAGO', '150000', 1, 22),
(38, 41, 'PAGADO', '0', 0, 19),
(39, 42, 'PAGADO', '0', 0, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `CodigoEstudiante` int(20) NOT NULL,
  `cardex` int(10) NOT NULL,
  `nombre_estudiante` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `telefono1` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono2` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(15) NOT NULL,
  `nombre_foto` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `TipoId` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `Sede` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`CodigoEstudiante`, `cardex`, `nombre_estudiante`, `Fecha_Ingreso`, `telefono1`, `telefono2`, `estado`, `nombre_foto`, `TipoId`, `Sede`) VALUES
(2, 10101010, 'test 2', '0000-00-00', '2147483647', '2147483647', 0, '../FotoEstudiante/10101010.png', '', ''),
(3, 202020, 'test 3', '0000-00-00', '2147483647', '2147483647', 0, '../FotoEstudiante/202020.png', '', ''),
(4, 303030, 'test 4', '0000-00-00', '2147483647', '2147483647', 0, '../FotoEstudiante/303030.png', '', ''),
(5, 404040, 'test 4', '0000-00-00', '2147483647', '2147483647', 0, '../FotoEstudiante/404040.png', '', ''),
(6, 505050, 'test 5', '0000-00-00', '2147483647', '2147483647', 0, '../FotoEstudiante/505050.png', '', ''),
(7, 606060, 'test 6', '0000-00-00', '123', '123', 0, '../FotoEstudiante/606060.png', '', ''),
(8, 707070, 'test 7', '0000-00-00', '1234', '1234', 0, '../FotoEstudiante/707070.png', '', ''),
(9, 808080, 'test 8', '0000-00-00', '311828685', '311828685', 0, '../FotoEstudiante/808080.png', '', ''),
(10, 1010101, 'test 10', '0000-00-00', '311828685', '311828685', 0, '../FotoEstudiante/1010101.png', '', ''),
(11, 111111, 'test 11', '0000-00-00', '2147483647', '2147483647', 0, '../FotoEstudiante/estudiante.png', '', ''),
(12, 121212, 'test 12', '0000-00-00', '2147483647', '2147483647', 0, '../FotoEstudiante/121212.png', '', ''),
(13, 131313, 'test 13', '0000-00-00', '3118286851', '3118286851', 0, '../FotoEstudiante/131313.png', '', ''),
(14, 141414, 'test 14', '0000-00-00', '3118286851', '3118286851', 0, '../FotoEstudiante/141414.png', '', ''),
(15, 151515, 'test 15', '0000-00-00', '3118286851', '3118286851', 0, '../FotoEstudiante/151515.png', '', ''),
(16, 1661616, '16', '0000-00-00', '3118286851', '3118286851', 0, '../FotoEstudiante/1661616.png', '', ''),
(17, 177117, '17', '0000-00-00', '3118286851', '3118286851', 0, '../FotoEstudiante/177117.png', '', ''),
(18, 191818, '18', '2019-05-02', '3155656565', '3155656565', 0, '../FotoEstudiante/191818.png', '', ''),
(19, 15121514, 'pepe', '2019-06-10', '3118286851', '3118286851', 0, '../FotoEstudiante/15121514.png', '', 'YOPAL'),
(22, 1118582464, 'paula', '2019-03-06', '3152457896', '3152457896', 0, '../FotoEstudiante/1118582464.png', 'C.C', 'TUNJA'),
(23, 111111515, 'daniel', '2019-06-27', '3118286851', '3118286851', 0, '../FotoEstudiante/111111515.png', 'C.C', 'SOGAMOSO'),
(24, 141578981, 'esteban florez', '2019-06-30', '3118286851', '3118286851', 0, '../FotoEstudiante/141578981.png', 'T.I', 'TUNJA'),
(25, 23652023, 'paula vanessa ', '2019-06-02', '3118286851', '3118286851', 0, '../FotoEstudiante/23652023.png', 'C.D', 'YOPAL'),
(26, 118569875, 'Sandra Patricia Alvarez', '2019-05-06', '3145986598', '3145986598', 0, '../FotoEstudiante/118569875.png', 'C.D', 'SOGAMOSO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `CodigoFactura` int(15) NOT NULL,
  `CodigoMatricula` int(10) NOT NULL,
  `CodigoPago` int(10) NOT NULL,
  `CodigoUser` int(10) NOT NULL,
  `FechaFactura` date NOT NULL,
  `Deuda` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `Pago` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`CodigoFactura`, `CodigoMatricula`, `CodigoPago`, `CodigoUser`, `FechaFactura`, `Deuda`, `Pago`) VALUES
(32, 35, 32, 13, '2019-06-28', '0', '500000'),
(33, 36, 33, 13, '2019-06-28', '150000', '150000'),
(34, 37, 34, 13, '2019-06-28', '250000', '250000'),
(35, 38, 35, 13, '2019-06-28', '0', '300000'),
(36, 39, 36, 13, '2019-06-28', '250000', '250000'),
(37, 40, 37, 13, '2019-06-28', '150000', '150000'),
(38, 41, 38, 13, '2019-06-28', '0', '500000'),
(39, 42, 39, 13, '2019-06-28', '0', '300000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `CodigoGrupo` int(10) NOT NULL,
  `NombreGrupo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `FechaGrupo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `CicloGrupo` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `CodigoPrograma` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`CodigoGrupo`, `NombreGrupo`, `FechaGrupo`, `CicloGrupo`, `CodigoPrograma`) VALUES
(31, '1', '2019', 'A', 40),
(32, '2', '2019', 'A', 40),
(33, '1', '2019', 'A', 41),
(34, '1', '2019', 'A', 42),
(35, '2', '2019', 'A', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `CodigoHorario` int(10) NOT NULL,
  `dias` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `horas` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `CodigoCiudad` int(10) NOT NULL,
  `CodigoGrupo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`CodigoHorario`, `dias`, `horas`, `CodigoCiudad`, `CodigoGrupo`) VALUES
(38, 'Lunes - Martes -     ', '08:00 - 10:00', 1, 31),
(39, '  Martes -     ', '20:00 - 01:00', 1, 32),
(40, '      Sabado - Domingo', '08:00 - 12:00', 1, 31),
(41, 'Lunes - Martes - Miercoles -', '08:00 - 10:00', 1, 33),
(42, ' Jueves - Viernes - Sabado -', '16:00 - 18:00', 1, 31),
(43, 'Lunes - Martes - Jueves - Viernes -', '06:00 - 12:00', 1, 34),
(44, 'Lunes - Viernes -', '14:00 - 18:00', 1, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_docente`
--

CREATE TABLE `informe_docente` (
  `CodigoInforme` int(10) NOT NULL,
  `CodigoDocente` int(10) NOT NULL,
  `CodigoGrupo` int(10) NOT NULL,
  `tema` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llamada`
--

CREATE TABLE `llamada` (
  `CodigoLlamada` int(10) NOT NULL,
  `CodigoEstudiante` int(10) NOT NULL,
  `CodigoUser` int(10) NOT NULL,
  `tipoLlamada` int(5) NOT NULL,
  `concepto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `anotacion` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `CodigoMatricula` int(10) NOT NULL,
  `CodigoEstudiante` int(10) NOT NULL,
  `CodigoUser` int(10) NOT NULL,
  `CodigoDocente` int(10) NOT NULL,
  `CodigoCiudad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`CodigoMatricula`, `CodigoEstudiante`, `CodigoUser`, `CodigoDocente`, `CodigoCiudad`) VALUES
(35, 26, 13, 7, 1),
(36, 26, 13, 8, 1),
(37, 23, 13, 7, 1),
(38, 23, 13, 8, 1),
(39, 22, 13, 7, 1),
(40, 22, 13, 8, 1),
(41, 19, 13, 7, 1),
(42, 19, 13, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `CodigoPago` int(10) NOT NULL,
  `concepto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `valorPagado` int(10) NOT NULL,
  `NumeroRecibo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`CodigoPago`, `concepto`, `valorPagado`, `NumeroRecibo`) VALUES
(32, 'INGLEAS A1 Grupo 1', 500000, 'num'),
(33, 'INGLES C2 Grupo 1', 150000, 'num'),
(34, 'INGLEAS A1 Grupo 1', 250000, 'num'),
(35, 'INGLES C2 Grupo 1', 300000, 'num'),
(36, 'INGLEAS A1 Grupo 1', 250000, 'num'),
(37, 'INGLES C2 Grupo 1', 150000, 'num'),
(38, 'INGLEAS A1 Grupo 1', 500000, 'num'),
(39, 'INGLES C2 Grupo 1', 300000, 'num');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesoterminado`
--

CREATE TABLE `procesoterminado` (
  `CodigoProceso` int(10) NOT NULL,
  `CodigoMatricula` int(10) NOT NULL,
  `proceso` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CodigoPrograma` int(10) NOT NULL,
  `fechaTerminacion` date NOT NULL,
  `Observacion` text COLLATE utf8_spanish2_ci NOT NULL,
  `FechaRecibido` date NOT NULL,
  `recibidoPor` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `CodigoPrograma` int(10) NOT NULL,
  `categoriaPrograma` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ValorPrograma` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`CodigoPrograma`, `categoriaPrograma`, `ValorPrograma`) VALUES
(40, 'INGLEAS A1', '500000'),
(41, 'INGLES C2', '300000'),
(42, 'INGLES D1', '100000'),
(43, 'INGLES C1', '25000'),
(44, 'CLASE INGLES A1', '250000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titular`
--

CREATE TABLE `titular` (
  `CodigoTitular` int(10) NOT NULL,
  `CodigoEstudiante` int(10) NOT NULL,
  `nombreTitular` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefonoTitular` varchar(15) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `titular`
--

INSERT INTO `titular` (`CodigoTitular`, `CodigoEstudiante`, `nombreTitular`, `telefonoTitular`) VALUES
(1, 12, 'asdasda', '3118286851'),
(2, 13, 'asdasd', '3118286851'),
(3, 14, 'asdasd', '3118286851'),
(4, 15, 'adqweqwe', '3118286851'),
(5, 16, 'adds', '3118286851'),
(6, 17, 'padresito', '6365942'),
(7, 18, 'padre', '314155418'),
(8, 19, 'samuel', '3118286851'),
(11, 22, 'pablo', '63659656'),
(12, 23, 'padres', '3118286851'),
(13, 24, 'camilo florez', '63695656'),
(14, 25, 'safia vega', '3118286852'),
(15, 26, 'Camila Alvarez', '321549875');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `CodigoUser` int(10) NOT NULL,
  `Identificacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `NombreUser` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `NombrePersonal` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `TelefonoPersonal` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`CodigoUser`, `Identificacion`, `NombreUser`, `pass`, `NombrePersonal`, `TelefonoPersonal`) VALUES
(2, '654321', 'secretarian1', 'facil123', '', ''),
(3, '10061006', 'pez1006', 'pablo123', 'pablo perez', '31564548321'),
(5, '141215', 'cami1415', 'facil123', 'camila', '321548796'),
(6, '181918', 'sof', 'qwerty', 'sofia', '3515151'),
(7, '1234565', 'vaca', 'vc123', 'vaca maldonado', '321546464'),
(8, '12121514', 'yf1215', 'asdfgh', 'yeferson', '6365989'),
(9, '456789', 'kim123', '123456', 'kim kam', '32565'),
(10, '4566578', 'capa4566', 'cami123', 'camila parada', '3255683'),
(11, '1006', 'dani1006', 'qwerty', 'daniela', '32565986'),
(13, '123456', 'adminn1', 'facil123', 'admi', '111111'),
(14, '111811181118', 'rojas1118', '123456', 'estefania rojas', '3145689551');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`CodigoCargo`),
  ADD KEY `CodigoUser` (`CodigoUser`),
  ADD KEY `CodigoCiudad` (`CodigoCiudad`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`CodigoCiudad`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`CodigoDocente`),
  ADD KEY `CodigoUser` (`CodigoUser`),
  ADD KEY `CodigoGrupo` (`CodigoGrupo`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`CodigoEstado`),
  ADD KEY `CodigoEstudiante` (`CodigoEstudiante`),
  ADD KEY `CodigoMattricula` (`CodigoMattricula`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`CodigoEstudiante`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`CodigoFactura`),
  ADD KEY `CodigoMatricula` (`CodigoMatricula`),
  ADD KEY `CodigoPago` (`CodigoPago`),
  ADD KEY `CodigoUser` (`CodigoUser`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`CodigoGrupo`),
  ADD KEY `CodigoPrograma` (`CodigoPrograma`) USING BTREE;

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`CodigoHorario`),
  ADD KEY `CodigoCiudad` (`CodigoCiudad`),
  ADD KEY `CodigoGrupo` (`CodigoGrupo`);

--
-- Indices de la tabla `informe_docente`
--
ALTER TABLE `informe_docente`
  ADD PRIMARY KEY (`CodigoInforme`),
  ADD KEY `CodigoDocente` (`CodigoDocente`),
  ADD KEY `CodigoGrupo` (`CodigoGrupo`);

--
-- Indices de la tabla `llamada`
--
ALTER TABLE `llamada`
  ADD PRIMARY KEY (`CodigoLlamada`),
  ADD KEY `CodigoEstudiante` (`CodigoEstudiante`),
  ADD KEY `CodigoUser` (`CodigoUser`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`CodigoMatricula`),
  ADD KEY `CodigoEstudiante` (`CodigoEstudiante`),
  ADD KEY `CodigoUser` (`CodigoUser`),
  ADD KEY `CodigoDocente` (`CodigoDocente`),
  ADD KEY `CodigoCiudad` (`CodigoCiudad`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`CodigoPago`);

--
-- Indices de la tabla `procesoterminado`
--
ALTER TABLE `procesoterminado`
  ADD PRIMARY KEY (`CodigoProceso`),
  ADD KEY `CodigoMatricula` (`CodigoMatricula`),
  ADD KEY `CodigoPrograma` (`CodigoPrograma`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`CodigoPrograma`);

--
-- Indices de la tabla `titular`
--
ALTER TABLE `titular`
  ADD PRIMARY KEY (`CodigoTitular`),
  ADD KEY `CodigoEstudiante` (`CodigoEstudiante`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`CodigoUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `CodigoCargo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `CodigoCiudad` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `CodigoDocente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `CodigoEstado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `CodigoEstudiante` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `CodigoFactura` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `CodigoGrupo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `CodigoHorario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `informe_docente`
--
ALTER TABLE `informe_docente`
  MODIFY `CodigoInforme` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `llamada`
--
ALTER TABLE `llamada`
  MODIFY `CodigoLlamada` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `CodigoMatricula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `CodigoPago` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `procesoterminado`
--
ALTER TABLE `procesoterminado`
  MODIFY `CodigoProceso` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `CodigoPrograma` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `titular`
--
ALTER TABLE `titular`
  MODIFY `CodigoTitular` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `CodigoUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `cargo_ibfk_1` FOREIGN KEY (`CodigoUser`) REFERENCES `user` (`CodigoUser`),
  ADD CONSTRAINT `cargo_ibfk_2` FOREIGN KEY (`CodigoCiudad`) REFERENCES `ciudad` (`CodigoCiudad`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_2` FOREIGN KEY (`CodigoUser`) REFERENCES `user` (`CodigoUser`),
  ADD CONSTRAINT `docente_ibfk_3` FOREIGN KEY (`CodigoGrupo`) REFERENCES `grupo` (`CodigoGrupo`);

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`CodigoMattricula`) REFERENCES `matricula` (`CodigoMatricula`),
  ADD CONSTRAINT `estado_ibfk_2` FOREIGN KEY (`CodigoEstudiante`) REFERENCES `estudiante` (`CodigoEstudiante`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`CodigoPago`) REFERENCES `pago` (`CodigoPago`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`CodigoUser`) REFERENCES `user` (`CodigoUser`),
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`CodigoMatricula`) REFERENCES `matricula` (`CodigoMatricula`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`CodigoPrograma`) REFERENCES `programa` (`CodigoPrograma`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`CodigoCiudad`) REFERENCES `ciudad` (`CodigoCiudad`),
  ADD CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`CodigoGrupo`) REFERENCES `grupo` (`CodigoGrupo`);

--
-- Filtros para la tabla `informe_docente`
--
ALTER TABLE `informe_docente`
  ADD CONSTRAINT `informe_docente_ibfk_1` FOREIGN KEY (`CodigoGrupo`) REFERENCES `grupo` (`CodigoGrupo`),
  ADD CONSTRAINT `informe_docente_ibfk_2` FOREIGN KEY (`CodigoDocente`) REFERENCES `docente` (`CodigoDocente`);

--
-- Filtros para la tabla `llamada`
--
ALTER TABLE `llamada`
  ADD CONSTRAINT `llamada_ibfk_1` FOREIGN KEY (`CodigoEstudiante`) REFERENCES `estudiante` (`CodigoEstudiante`),
  ADD CONSTRAINT `llamada_ibfk_2` FOREIGN KEY (`CodigoUser`) REFERENCES `user` (`CodigoUser`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`CodigoEstudiante`) REFERENCES `estudiante` (`CodigoEstudiante`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`CodigoUser`) REFERENCES `user` (`CodigoUser`),
  ADD CONSTRAINT `matricula_ibfk_5` FOREIGN KEY (`CodigoDocente`) REFERENCES `docente` (`CodigoDocente`),
  ADD CONSTRAINT `matricula_ibfk_6` FOREIGN KEY (`CodigoCiudad`) REFERENCES `ciudad` (`CodigoCiudad`);

--
-- Filtros para la tabla `procesoterminado`
--
ALTER TABLE `procesoterminado`
  ADD CONSTRAINT `procesoterminado_ibfk_1` FOREIGN KEY (`CodigoMatricula`) REFERENCES `matricula` (`CodigoMatricula`),
  ADD CONSTRAINT `procesoterminado_ibfk_2` FOREIGN KEY (`CodigoPrograma`) REFERENCES `programa` (`CodigoPrograma`);

--
-- Filtros para la tabla `titular`
--
ALTER TABLE `titular`
  ADD CONSTRAINT `titular_ibfk_1` FOREIGN KEY (`CodigoEstudiante`) REFERENCES `estudiante` (`CodigoEstudiante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
