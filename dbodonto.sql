-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-01-2015 a las 15:17:18
-- Versión del servidor: 5.5.40-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dbodonto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `descripcion`, `telefono`, `direccion`) VALUES
(1, ' CLINICA 1', '06100000 - 0983000000', 'AVDA / BARRIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `evenement`
--

INSERT INTO `evenement` (`id`, `title`, `start`, `end`) VALUES
(29, 'Roberto', '2014-11-26 06:30:00', '2014-11-26 07:00:00'),
(28, 'Tony', '2014-11-26 06:30:00', '2014-11-26 07:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(15) NOT NULL,
  `idpa` int(11) NOT NULL,
  `nota` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `titulo`, `idpa`, `nota`, `fecha`) VALUES
(100, 'CONTROL', 1003, 'AJUSTE SUPERIOR E INFERIOR', '0000-00-00'),
(101, 'CONTROL ', 1003, 'AJUSTE SUPERIOR', '0000-00-00'),
(106, 'CONSULTA', 1003, 'AJUSTE INFERIOR', '0000-00-00'),
(105, 'AJUSTE', 1001, 'SUPERIOR', '0000-00-00'),
(107, 'DEMO', 1003, 'DENTADURA INFERIOR', '0000-00-00'),
(108, 'OTRO', 1003, 'LIMPIEZA SUPERIOR', '2014-12-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` int(11) NOT NULL DEFAULT '0',
  `abono` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `cargo`, `abono`, `tipo`, `fecha`) VALUES
(8, 150000, 0, 'ENDOPOSTE', '2014-11-26'),
(7, 150000, 0, 'ENDOPOSTE', '2014-11-26'),
(6, 100000, 0, 'RESINA BASICA', '2014-11-26'),
(5, 150000, 0, 'ENDOPOSTE', '2014-11-26'),
(9, 0, 25000, 'ABONO', '2014-11-26'),
(10, 0, 250000, 'ABONO', '2014-11-27'),
(11, 150000, 0, 'ENDOPOSTE', '2014-12-09'),
(12, 0, 20000, 'ABONO', '2014-12-09'),
(13, 0, 5000, 'ABONO', '2014-12-10'),
(14, 100000, 0, 'RESINA BASICA', '2014-12-10'),
(16, 0, 15000, 'DMEO', '2014-12-16'),
(17, 10000, 0, 'RETIRO', '2014-12-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(25) CHARACTER SET utf32 NOT NULL,
  `nombre` varchar(80) CHARACTER SET utf32 NOT NULL,
  `fechanac` date NOT NULL,
  `celular` varchar(25) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `direccion` varchar(140) NOT NULL,
  `antecedentes` varchar(100) NOT NULL,
  `sosu` varchar(45) NOT NULL,
  `sosd` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1013 ;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `ci`, `nombre`, `fechanac`, `celular`, `telefono`, `correo`, `direccion`, `antecedentes`, `sosu`, `sosd`) VALUES
(1001, '1234567', 'TONY STARK', '2014-10-01', '0981000111', '061500501', 'nada@nada.com', 'CENTRO, LOS YERBALES', 'ALERGIAS A FLORES', 'PADRE', '061-000-000'),
(1002, '606045', 'MARIA', '2014-10-23', '3232341', '232309890', 'and@aaad.com', 'AVDA DEL LAGO', 'SENSIBILIDAD', 'MADRE', '0983-000-000'),
(1003, '500', 'CECILIA', '2014-10-23', '323234', '232309890', 'and@aaad.com', 'AVDA CAMPO LARGO', 'ALERGIA ANTIBIOTICOS', 'PADRE', '0985-000-000'),
(1004, '500', 'CAROLINA ', '2014-10-23', '323234', '232309890', 'and@aaad.com', 'AVDA CAMPO LARGO', 'ALERGIA ANTIBIOTICOS', 'PADRE', '0985-000-000'),
(1012, '80', 'DEMO', '2014-12-04', '0983', '061', 'h@.com', 'DHSDJ', 'HOLA', 'OTRO', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldos`
--

CREATE TABLE IF NOT EXISTS `saldos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpaciente` int(11) NOT NULL,
  `cargo` int(11) NOT NULL DEFAULT '0',
  `abono` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `saldos`
--

INSERT INTO `saldos` (`id`, `idpaciente`, `cargo`, `abono`, `tipo`, `fecha`) VALUES
(8, 1001, 150000, 0, 'ENDOPOSTE', '2014-11-26'),
(7, 1001, 150000, 0, 'ENDOPOSTE', '2014-11-26'),
(6, 1003, 100000, 0, 'RESINA BASICA', '2014-11-26'),
(5, 1003, 150000, 0, 'ENDOPOSTE', '2014-11-26'),
(9, 1003, 0, 25000, 'ABONO', '2014-11-26'),
(10, 1001, 0, 250000, 'ABONO', '2014-11-27'),
(11, 1004, 150000, 0, 'ENDOPOSTE', '2014-12-09'),
(12, 1004, 0, 20000, 'ABONO', '2014-12-09'),
(13, 1001, 0, 5000, 'ABONO', '2014-12-10'),
(14, 1001, 100000, 0, 'RESINA BASICA', '2014-12-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE IF NOT EXISTS `tratamientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `costo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=203 ;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`id`, `tipo`, `costo`) VALUES
(200, 'ENDOPOSTE', 150000),
(201, 'RESINA BASICA', 100000),
(202, 'N/A', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(8) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `nivel` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `nivel`) VALUES
(1, 'adm', 'f7ff9e8b7bb2e09b70935a5d785e0cc5d9d0abf0', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
