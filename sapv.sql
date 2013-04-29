-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-04-2013 a las 02:37:48
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sapv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `Id` int(4) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `accion_realizada` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Accion` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Usuario` int(11) NOT NULL,
  `beforee` text COLLATE latin1_general_ci,
  `afterr` text COLLATE latin1_general_ci,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=186 ;

--
-- Volcar la base de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`Id`, `Fecha`, `accion_realizada`, `Accion`, `Usuario`, `beforee`, `afterr`) VALUES
(70, '2011-11-26 19:24:50', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(71, '2013-02-20 21:34:20', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(72, '2013-02-21 14:40:59', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(73, '2013-02-21 15:40:24', 'agregar', 'CREO EL SERVICIO: Lenceria', 1, '', '<b>Nombre:</b>Lenceria<br>'),
(74, '2013-02-21 15:43:31', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: Lencerias', 1, '', ''),
(75, '2013-02-21 15:43:40', '', 'ELIMINO AL SERVICIO:Array', 1, '', ''),
(76, '2013-02-21 15:44:02', 'agregar', 'CREO EL SERVICIO: Lenceria', 1, '', '<b>Nombre:</b>Lenceria<br>'),
(77, '2013-02-21 15:44:12', 'agregar', 'CREO EL SERVICIO: TV', 1, '', '<b>Nombre:</b>TV<br>'),
(78, '2013-02-21 15:44:25', 'agregar', 'CREO EL SERVICIO: Home Theater', 1, '', '<b>Nombre:</b>Home Theater<br>'),
(79, '2013-02-21 15:44:35', 'agregar', 'CREO EL SERVICIO: WI-FI', 1, '', '<b>Nombre:</b>WI-FI<br>'),
(80, '2013-02-21 15:44:44', 'agregar', 'CREO EL SERVICIO: Piscina', 1, '', '<b>Nombre:</b>Piscina<br>'),
(81, '2013-02-21 15:44:53', 'agregar', 'CREO EL SERVICIO: Secadora', 1, '', '<b>Nombre:</b>Secadora<br>'),
(82, '2013-02-21 15:45:05', 'agregar', 'CREO EL SERVICIO: Cocina Equipada', 1, '', '<b>Nombre:</b>Cocina Equipada<br>'),
(83, '2013-02-21 15:45:12', 'agregar', 'CREO EL SERVICIO: DVD', 1, '', '<b>Nombre:</b>DVD<br>'),
(84, '2013-02-21 15:45:28', 'agregar', 'CREO EL SERVICIO: SatTV', 1, '', '<b>Nombre:</b>SatTV<br>'),
(85, '2013-02-21 15:45:38', 'agregar', 'CREO EL SERVICIO: Aire Acondicionado', 1, '', '<b>Nombre:</b>Aire Acondicionado<br>'),
(86, '2013-02-21 15:45:48', 'agregar', 'CREO EL SERVICIO: Estacionamiento', 1, '', '<b>Nombre:</b>Estacionamiento<br>'),
(87, '2013-02-21 15:45:57', 'agregar', 'CREO EL SERVICIO: Teléfono', 1, '', '<b>Nombre:</b>Teléfono<br>'),
(88, '2013-02-21 15:46:19', 'agregar', 'CREO EL SERVICIO: Toallas', 1, '', '<b>Nombre:</b>Toallas<br>'),
(89, '2013-02-21 15:46:56', 'agregar', 'CREO EL SERVICIO: Blue Ray', 1, '', '<b>Nombre:</b>Blue Ray<br>'),
(90, '2013-02-21 15:47:06', 'agregar', 'CREO EL SERVICIO: Internet', 1, '', '<b>Nombre:</b>Internet<br>'),
(91, '2013-02-21 15:47:19', 'agregar', 'CREO EL SERVICIO: Calefacción', 1, '', '<b>Nombre:</b>Calefacción<br>'),
(92, '2013-02-21 15:47:35', 'agregar', 'CREO EL SERVICIO: Lavadora', 1, '', '<b>Nombre:</b>Lavadora<br>'),
(93, '2013-02-21 15:47:47', 'agregar', 'CREO EL SERVICIO: Apto para familias', 1, '', '<b>Nombre:</b>Apto para familias<br>'),
(94, '2013-02-22 19:20:01', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(95, '2013-02-22 19:28:08', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(96, '2013-02-22 19:35:28', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(97, '2013-02-22 19:47:47', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(98, '2013-02-24 11:57:11', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(99, '2013-02-24 12:25:19', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(100, '2013-02-24 12:36:11', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(101, '2013-02-24 17:51:51', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(102, '2013-02-24 19:13:06', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(103, '2013-02-27 15:37:52', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(104, '2013-03-04 20:47:29', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(105, '2013-03-05 09:59:54', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(106, '2013-03-06 15:08:01', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(107, '2013-03-06 15:24:51', 'agregar', 'CREO EL SERVICIO: ', 1, '', ''),
(108, '2013-03-06 20:13:19', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(109, '2013-03-06 20:45:49', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(110, '2013-03-06 20:48:23', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(111, '2013-03-06 21:01:00', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(112, '2013-03-06 21:02:16', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(113, '2013-03-06 21:03:06', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(114, '2013-03-07 09:22:43', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(115, '2013-03-07 10:07:59', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(116, '2013-03-07 15:36:56', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(117, '2013-03-10 11:31:46', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(118, '2013-03-10 11:57:31', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(119, '2013-03-10 12:04:29', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(120, '2013-03-10 12:15:58', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(121, '2013-03-10 12:22:34', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(122, '2013-03-10 12:27:24', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(123, '2013-03-10 12:27:46', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(124, '2013-03-10 12:35:25', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(125, '2013-03-11 21:29:00', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(126, '2013-03-11 21:29:23', 'modificar', 'MODIFICO LOS DATOS DEL TIPO DE PROPIEDAD: Apartamentos', 1, '', ''),
(127, '2013-03-11 21:29:33', 'agregar', 'CREO EL TIPO DE PROPIEDAD: Cabaña', 1, '', '<b>Nombre:</b>Cabaña<br>'),
(128, '2013-03-11 21:29:44', 'modificar', 'MODIFICO LOS DATOS DEL TIPO DE PROPIEDAD: Apartamento', 1, '', ''),
(129, '2013-03-11 21:29:51', '', 'ELIMINO AL TIPO DE PROPIEDAD:Array', 1, '', ''),
(130, '2013-03-11 21:30:26', 'agregar', 'CREO EL TIPO DE PROPIEDAD: Matrimonial e Individual', 1, '', '<b>Nombre:</b>Matrimonial e Individual<br>'),
(131, '2013-03-11 21:31:05', 'modificar', 'MODIFICO LOS DATOS DEL TIPO DE PROPIEDAD: Matrimonial y dos Individual', 1, '', ''),
(132, '2013-03-12 10:58:07', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(133, '2013-03-13 22:09:00', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(134, '2013-03-13 22:22:11', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(135, '2013-03-18 14:48:13', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(136, '2013-03-18 21:54:06', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(137, '2013-03-18 21:58:07', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(138, '2013-03-19 21:03:12', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(139, '2013-03-20 14:18:28', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(140, '2013-03-20 14:19:19', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(141, '2013-03-20 16:20:49', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(142, '2013-03-20 16:22:42', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(143, '2013-03-20 17:10:10', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(144, '2013-03-20 17:12:38', 'agregar', 'CREO EL SERVICIO: ', 1, '', ''),
(145, '2013-03-20 17:17:58', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(146, '2013-03-20 17:29:46', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(147, '2013-03-26 15:34:12', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(148, '2013-04-02 15:15:56', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(149, '2013-04-02 15:18:15', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(150, '2013-04-02 15:20:13', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(151, '2013-04-03 22:06:02', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(152, '2013-04-03 22:17:34', 'agregar', 'CREO EL TIPO DE PROPIEDAD: ', 1, '', '<b>Nombre:</b><br>'),
(153, '2013-04-03 22:18:46', 'modificar', 'MODIFICO LOS DATOS DEL TIPO DE PROPIEDAD: ', 1, '', ''),
(154, '2013-04-03 22:19:13', 'modificar', 'MODIFICO LOS DATOS DEL TIPO DE PROPIEDAD: ', 1, '', ''),
(155, '2013-04-16 19:22:16', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(156, '2013-04-16 20:14:02', 'login', 'ENTRO AL SISTEMA EL USUARIO: JESUS GRANADOS', 2, '', ''),
(157, '2013-04-16 21:10:34', 'modificar', 'CAMBIO SU CLAVE DE ACCESO DESDE OLVIDO CONTRASE&Ntilde;A: jg', 0, '', ''),
(158, '2013-04-16 21:11:36', 'login', 'ENTRO AL SISTEMA EL USUARIO: JESUS GRANADOS', 2, '', ''),
(159, '2013-04-16 21:12:22', 'modificar', 'CAMBIO SU CLAVE DE ACCESO DESDE OLVIDO CONTRASE&Ntilde;A: jg', 0, '', ''),
(160, '2013-04-16 21:13:16', 'modificar', 'CAMBIO SU CLAVE DE ACCESO DESDE OLVIDO CONTRASE&Ntilde;A: jg', 0, '', ''),
(161, '2013-04-16 21:13:46', 'login', 'ENTRO AL SISTEMA EL USUARIO: JESUS GRANADOS', 2, '', ''),
(162, '2013-04-16 21:15:32', 'login', 'ENTRO AL SISTEMA EL USUARIO: JESUS GRANADOS', 2, '', ''),
(163, '2013-04-16 21:24:23', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(164, '2013-04-17 19:57:53', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(165, '2013-04-18 09:45:03', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(166, '2013-04-18 10:59:30', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(167, '2013-04-18 12:00:59', 'agregar', 'CREO LA CONFIGURACION: Prueba', 1, '', '<b>Titulo:</b>Prueba<br><strong>Variable:</strong>PRUEBA_PRUEBA<br><strong>Valor:</strong>estambre<br>'),
(168, '2013-04-18 12:01:25', 'modificar', 'MODIFICO LA CONFIGURACION: Prue', 1, '<b>Titulo:</b>Prueba<br><strong>Variable:</strong>PRUEBA_PRUEBA<br><strong>Valor:</strong>estambre<br>', '<b>Titulo:</b>Prue<br><strong>Variable:</strong>PRUE_PRUE<br><strong>Valor:</strong>esta<br>'),
(169, '2013-04-18 12:01:37', '', 'ELIMINO LA CONFIGURACION:Array', 1, '', ''),
(170, '2013-04-18 12:11:30', 'agregar', 'CREO LA CONFIGURACION: Prueba', 1, '', '<b>Titulo:</b>Prueba<br><strong>Variable:</strong>PRUEBA_PRUEBA<br><strong>Valor:</strong>esta<br>'),
(171, '2013-04-18 12:11:36', 'eliminar', 'ELIMINO LA CONFIGURACION:Array', 1, '', ''),
(172, '2013-04-18 12:15:48', 'agregar', 'CREO LA CONFIGURACION: Prueba', 1, '', '<b>Titulo:</b>Prueba<br><strong>Variable:</strong>PRUE_PRUE<br><strong>Valor:</strong>ghjghjgj<br>'),
(173, '2013-04-18 12:15:54', 'eliminar', 'ELIMINO LA CONFIGURACION:Prueba', 1, '', ''),
(174, '2013-04-19 16:58:02', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(175, '2013-04-22 08:59:20', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(176, '2013-04-22 12:20:33', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(177, '2013-04-23 07:42:37', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(178, '2013-04-26 05:59:18', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', ''),
(179, '2013-04-26 05:59:50', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(180, '2013-04-26 06:00:24', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(181, '2013-04-26 06:06:03', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(182, '2013-04-26 06:06:52', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(183, '2013-04-26 06:07:07', 'modificar', 'MODIFICO LOS DATOS DEL SERVICIO: ', 1, '', ''),
(184, '2013-04-28 21:56:05', 'modificar', 'CAMBIO SU CLAVE DE ACCESO DESDE OLVIDO CONTRASE&Ntilde;A: admin', 0, '', ''),
(185, '2013-04-28 21:56:18', 'login', 'ENTRO AL SISTEMA EL USUARIO: SOPORTE', 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcar la base de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `email`, `telefono`) VALUES
(1, 'Victoria', 'Roche', 'vicarodi@gmail.com', '0000099i8ssss'),
(2, 'carolina', 'Diaz', 'vicarodi@hotmail.com', 'dcsdvsd'),
(3, 'asdasd', 'asdasd', 'asdasd', 'asdasd'),
(4, 'asxasx', 'asxasx', 'axsxasx', 'asxaxasx'),
(5, 'aaaa', 'aa', 'aaa', 'aaa'),
(6, 'nnnn', 'nnnn', 'jjjj', '88888'),
(7, 'gggg', 'jjjj', 'jjj', 'jjjj'),
(8, 'jjjj', 'iiiii', 'kkk', 'jjjj'),
(9, 'ooo', 'llll', 'ppp', 'jjjj'),
(10, 'ddd', 'dddd', 'ddd', 'ddd'),
(11, 'ooooo', 'o', 'o', 'o'),
(12, 'a', 'a', 'a', 'a'),
(13, 'kkkk', 'k', 'k', 'k'),
(14, 'i', 'i', 'i', 'i'),
(15, 'Vic', 'Ro', 'vica', '123123'),
(16, 'aa', 'aa', 'aa', 'aa'),
(17, 'q', 'q', 'q', 'q'),
(18, 'l', 'l', 'l', 'l'),
(19, 'p', 'p', 'p', 'p'),
(20, 'jdkajhdbkacjshbd', 'ksbkhbcdjkhb', 'hblshbasdhb', 'klsbdlhcbsd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `valor` text,
  `nombre_variable` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `titulo`, `valor`, `nombre_variable`) VALUES
(1, 'Valor del Dolar', '23', 'CAMBIO_DOLAR'),
(2, 'Monto $ del Deposito', '700', 'DEPOSITO'),
(5, 'Banco en dolares', 'Banco: xxxxxx <br />\r\nBeneficiario : xxxxxxxx<br />\r\nCuenta Corriente Nro: xxxxxxxx<br />\r\nDirecci&oacute;n: xxxxxxxxx<br />\r\nABA: xxxxxxxx<br />\r\nSWIFT: xxxxxxxxx', 'BANCO_DOLARES'),
(6, 'Banco en Bolivares', 'Banco: xxxxxx <br />\r\nBeneficiario : xxxxxxxx<br />\r\nCuenta Ahorros Nro: xxxxxxxx<br />\r\nC.I.: xxxxxxxxx<br />\r\nCorreo Electr&oacute;nico: xxxxxxxx', 'BANCO_BOLIVARES'),
(7, 'Politicas', '<ul>\r\n<li>	Si cancela entre mas de 5 y 8 semanas antes de la fecha de llegada, el propietario conservar&aacute; el 10% de la reserva por gastos administrativos y devolver&aacute; el 70% del monto adicional depositado.</li>\r\n\r\n<li>	Si cancela entre mas de 2 y 5 semanas antes de la fecha de llegada, el propietario conservar&aacute; el 10% de la reserva por gastos administrativos y devolver&aacute; el 50% del monto depositado.</li>\r\n\r\n<li>	Si cancela entre 7 y 14 d&iacute;as antes de la fecha de llegada, el propietario conservar&aacute; el 10% de la reserva por gastos administrativos y devolver&aacute; el 30% del monto depositado.</li>\r\n\r\n<li>	Si cancela con menos de 7 d&iacute;as antes de la fecha de llegada, el propietario conservar&aacute; el 10% de la reserva por gastos administrativos y devolver&aacute; el 10% del monto depositado.</li>\r\n\r\n<li>	El dep&oacute;sito en garant&iacute;a ser&aacute; devuelto siempre en su totalidad. En caso de hospedarse, se le har&aacute; el descuento respectivo por limpieza.</li>\r\n\r\n<li>	En caso de no llegar por cualquier circunstancia se retendr&aacute; el 100%. (solo ser&aacute; devuelto el dep&oacute;sito de seguridad)</li>\r\n\r\n<li>	En caso de llegar un d&iacute;a o dos d&iacute;as despu&oacute;s, el importe por dichos d&iacute;as no ser&aacute; devuelto.</li>\r\n</ul>', 'POLITICAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE IF NOT EXISTS `cotizaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_in` date DEFAULT NULL,
  `fecha_out` date DEFAULT NULL,
  `monto_diario` float DEFAULT NULL,
  `monto_total` float DEFAULT NULL,
  `limpieza` float DEFAULT NULL,
  `adultos` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `st` int(11) DEFAULT NULL,
  `ninos` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `id_propiedad` int(11) DEFAULT NULL,
  `noches` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Volcar la base de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `codigo`, `id_cliente`, `fecha_in`, `fecha_out`, `monto_diario`, `monto_total`, `limpieza`, `adultos`, `fecha_registro`, `st`, `ninos`, `nombre`, `apellido`, `email`, `telefono`, `id_propiedad`, `noches`) VALUES
(6, '27042013-1', 4, '2013-04-30', '2013-05-01', 300, 300, 200, 2, '2013-04-28 10:58:15', 0, 0, 'asxasx', 'asxasx', 'axsxasx', 'asxaxasx', 2, 1),
(9, '27042013-4', 6, '2013-04-30', '2013-05-17', 159, 2700, 200, 1, '2013-04-27 11:11:50', 0, 0, 'nnnn', 'nnnn', 'jjjj', '88888', 2, 17),
(10, '27042013-5', 7, '2013-04-30', '2013-05-17', 159, 2700, 200, 1, '2013-04-27 11:16:11', 0, 0, 'gggg', 'jjjj', 'jjj', 'jjjj', 2, 17),
(11, '27042013-6', 8, '2013-05-07', '2013-05-16', 167, 1500, 200, 1, '2013-04-27 11:19:02', 0, 0, 'jjjj', 'iiiii', 'kkk', 'jjjj', 2, 9),
(12, '27042013-7', 9, '2013-05-06', '2013-05-08', 225, 450, 200, 1, '2013-04-27 11:23:02', 0, 0, 'ooo', 'llll', 'ppp', 'jjjj', 2, 2),
(13, '27042013-8', 10, '2013-04-30', '2013-05-17', 159, 2700, 200, 1, '2013-04-27 11:27:32', 0, 0, 'ddd', 'dddd', 'ddd', 'ddd', 2, 17),
(14, '27042013-9', 11, '2013-04-30', '2013-05-17', 159, 2700, 200, 1, '2013-04-27 11:34:30', 0, 0, 'ooooo', 'o', 'o', 'o', 2, 17),
(15, '27042013-10', 12, '2013-04-30', '2013-05-17', 159, 2700, 200, 1, '2013-04-27 12:02:06', 0, 0, 'a', 'a', 'a', 'a', 2, 17),
(16, '27042013-11', 13, '2013-04-30', '2013-05-17', 159, 2700, 200, 1, '2013-04-27 12:52:11', 0, 0, 'kkkk', 'k', 'k', 'k', 2, 17),
(17, '27042013-12', 14, '2013-04-30', '2013-05-17', 159, 2700, 200, 1, '2013-04-27 12:55:50', 0, 0, 'i', 'i', 'i', 'i', 2, 17),
(18, '28042013-1', 15, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:33:21', 0, 0, 'Vic', 'Ro', 'vica', '123123', 1, 10),
(19, '28042013-2', 8, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:36:39', 0, 0, 'jj', 'kkk', 'kkk', 'jjjj', 1, 10),
(20, '28042013-3', 13, '2013-05-06', '2013-05-16', 165, 1650, 200, 1, '2013-04-28 15:38:17', 0, 0, 'k', 'k', 'k', 'k', 2, 10),
(21, '28042013-4', 16, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:47:24', 0, 0, 'aa', 'aa', 'aa', 'aa', 1, 10),
(22, '28042013-5', 12, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:48:03', 0, 0, 'a', 'a', 'a', 'a', 1, 10),
(23, '28042013-6', 17, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:49:11', 0, 0, 'q', 'q', 'q', 'q', 1, 10),
(24, '28042013-7', 12, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:49:42', 0, 0, 'a', 'a', 'a', 'a', 1, 10),
(25, '28042013-8', 18, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:51:30', 0, 0, 'l', 'l', 'l', 'l', 1, 10),
(26, '28042013-9', 17, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:53:28', 0, 0, 'q', 'q', 'q', 'q', 1, 10),
(27, '28042013-10', 19, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:54:14', 0, 0, 'p', 'p', 'p', 'p', 1, 10),
(28, '28042013-11', 19, '2013-05-06', '2013-05-16', 165, 1650, 200, 1, '2013-04-28 15:54:37', 0, 0, 'p', 'p', 'p', 'p', 2, 10),
(29, '28042013-12', 19, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:55:27', 0, 0, 'p', 'p', 'p', 'p', 1, 10),
(30, '28042013-13', 17, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 15:56:52', 0, 0, 'q', 'q', 'q', 'q', 1, 10),
(31, '28042013-14', 19, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 16:03:48', 0, 0, 'P', 'P', 'P', 'P', 1, 10),
(32, '28042013-15', 20, '2013-05-06', '2013-05-16', 143, 1430, 200, 1, '2013-04-28 16:50:46', 0, 0, 'jdkajhdbkacjshbd', 'ksbkhbcdjkhb', 'hblshbasdhb', 'klsbdlhcbsd', 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`) VALUES
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_menu`
--

CREATE TABLE IF NOT EXISTS `grupos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) NOT NULL DEFAULT '0',
  `id_menu` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`id_grupo`,`id_menu`),
  KEY `id_grupo` (`id_grupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2092 ;

--
-- Volcar la base de datos para la tabla `grupos_menu`
--

INSERT INTO `grupos_menu` (`id`, `id_grupo`, `id_menu`) VALUES
(2078, 1, 1),
(2079, 1, 38),
(2080, 1, 39),
(2081, 1, 40),
(2082, 1, 41),
(2083, 1, 42),
(2084, 1, 2),
(2085, 1, 43),
(2086, 1, 5),
(2087, 1, 29),
(2088, 1, 30),
(2089, 1, 37),
(2090, 1, 44),
(2091, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ruta` varchar(50) NOT NULL,
  `padre` varchar(20) NOT NULL,
  `titulo` int(1) DEFAULT '0',
  `nombre_titulo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Volcar la base de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `ruta`, `padre`, `titulo`, `nombre_titulo`) VALUES
(1, 'Tablas', '', '0', 0, 'Tablas'),
(2, 'Procesos', '', '0', 0, 'Procesos'),
(5, 'Configuraci&oacute;n', '', '0', 0, 'Mantenimiento'),
(7, 'Salir', 'aut_logout.php', '0', 0, 'Salir'),
(29, 'Usuarios', 'index.php?doc=usuarios', '5', 0, 'Registro de Usuarios'),
(39, 'Propiedades', 'index.php?doc=propiedades', '1', 0, NULL),
(42, 'Propietarios', 'index.php?doc=propietarios', '1', 0, NULL),
(38, 'Servicios', 'index.php?doc=servicios', '1', 0, NULL),
(30, 'Permisos a usuarios', 'index.php?doc=grupos_menu', '5', 0, 'Asignar Permisos a usuarios'),
(37, 'Cambio de Clave', 'index.php?doc=cambioclave', '5', 0, 'Cambio de Clave'),
(40, 'Tipo de propiedad', 'index.php?doc=tipo_propiedad', '1', 0, NULL),
(41, 'Tipo de camas', 'index.php?doc=tipos_camas', '1', 0, NULL),
(43, 'Cotizaciones', 'index.php?doc=cotizaciones', '2', 0, NULL),
(44, 'Variables de Configuracion', 'index.php?doc=configuracion', '5', 0, 'Variables de Configuracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `countries_id` int(11) NOT NULL AUTO_INCREMENT,
  `countries_name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`countries_id`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

--
-- Volcar la base de datos para la tabla `pais`
--

INSERT INTO `pais` (`countries_id`, `countries_name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and Barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Aruba'),
(13, 'Australia'),
(14, 'Austria'),
(15, 'Azerbaijan'),
(16, 'Bahamas'),
(17, 'Bahrain'),
(18, 'Bangladesh'),
(19, 'Barbados'),
(20, 'Belarus'),
(21, 'Belgium'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bermuda'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and Herzegowina'),
(28, 'Botswana'),
(29, 'Bouvet Island'),
(30, 'Brazil'),
(31, 'British Indian Ocean Territory'),
(32, 'Brunei Darussalam'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Christmas Island'),
(46, 'Cocos (Keeling) Islands'),
(47, 'Colombia'),
(48, 'Comoros'),
(49, 'Congo'),
(50, 'Cook Islands'),
(51, 'Costa Rica'),
(52, 'Cote D''Ivoire'),
(53, 'Croatia'),
(54, 'Cuba'),
(55, 'Cyprus'),
(56, 'Czech Republic'),
(57, 'Denmark'),
(58, 'Djibouti'),
(59, 'Dominica'),
(60, 'Dominican Republic'),
(61, 'East Timor'),
(62, 'Ecuador'),
(63, 'Egypt'),
(64, 'El Salvador'),
(65, 'Equatorial Guinea'),
(66, 'Eritrea'),
(67, 'Estonia'),
(68, 'Ethiopia'),
(69, 'Falkland Islands (Malvinas)'),
(70, 'Faroe Islands'),
(71, 'Fiji'),
(72, 'Finland'),
(73, 'France'),
(74, 'France, Metropolitan'),
(75, 'French Guiana'),
(76, 'French Polynesia'),
(77, 'French Southern Territories'),
(78, 'Gabon'),
(79, 'Gambia'),
(80, 'Georgia'),
(81, 'Germany'),
(82, 'Ghana'),
(83, 'Gibraltar'),
(84, 'Greece'),
(85, 'Greenland'),
(86, 'Grenada'),
(87, 'Guadeloupe'),
(88, 'Guam'),
(89, 'Guatemala'),
(90, 'Guinea'),
(91, 'Guinea-bissau'),
(92, 'Guyana'),
(93, 'Haiti'),
(94, 'Heard and Mc Donald Islands'),
(95, 'Honduras'),
(96, 'Hong Kong'),
(97, 'Hungary'),
(98, 'Iceland'),
(99, 'India'),
(100, 'Indonesia'),
(101, 'Iran (Islamic Republic of)'),
(102, 'Iraq'),
(103, 'Ireland'),
(104, 'Israel'),
(105, 'Italy'),
(106, 'Jamaica'),
(107, 'Japan'),
(108, 'Jordan'),
(109, 'Kazakhstan'),
(110, 'Kenya'),
(111, 'Kiribati'),
(112, 'Korea, Democratic People''s Republic of'),
(113, 'Korea, Republic of'),
(114, 'Kuwait'),
(115, 'Kyrgyzstan'),
(116, 'Lao People''s Democratic Republic'),
(117, 'Latvia'),
(118, 'Lebanon'),
(119, 'Lesotho'),
(120, 'Liberia'),
(121, 'Libyan Arab Jamahiriya'),
(122, 'Liechtenstein'),
(123, 'Lithuania'),
(124, 'Luxembourg'),
(125, 'Macau'),
(126, 'Macedonia, The Former Yugoslav Republic of'),
(127, 'Madagascar'),
(128, 'Malawi'),
(129, 'Malaysia'),
(130, 'Maldives'),
(131, 'Mali'),
(132, 'Malta'),
(133, 'Marshall Islands'),
(134, 'Martinique'),
(135, 'Mauritania'),
(136, 'Mauritius'),
(137, 'Mayotte'),
(138, 'Mexico'),
(139, 'Micronesia, Federated States of'),
(140, 'Moldova, Republic of'),
(141, 'Monaco'),
(142, 'Mongolia'),
(143, 'Montserrat'),
(144, 'Morocco'),
(145, 'Mozambique'),
(146, 'Myanmar'),
(147, 'Namibia'),
(148, 'Nauru'),
(149, 'Nepal'),
(150, 'Netherlands'),
(151, 'Netherlands Antilles'),
(152, 'New Caledonia'),
(153, 'New Zealand'),
(154, 'Nicaragua'),
(155, 'Niger'),
(156, 'Nigeria'),
(157, 'Niue'),
(158, 'Norfolk Island'),
(159, 'Northern Mariana Islands'),
(160, 'Norway'),
(161, 'Oman'),
(162, 'Pakistan'),
(163, 'Palau'),
(164, 'Panama'),
(165, 'Papua New Guinea'),
(166, 'Paraguay'),
(167, 'Peru'),
(168, 'Philippines'),
(169, 'Pitcairn'),
(170, 'Poland'),
(171, 'Portugal'),
(172, 'Puerto Rico'),
(173, 'Qatar'),
(174, 'Reunion'),
(175, 'Romania'),
(176, 'Russian Federation'),
(177, 'Rwanda'),
(178, 'Saint Kitts and Nevis'),
(179, 'Saint Lucia'),
(180, 'Saint Vincent and the Grenadines'),
(181, 'Samoa'),
(182, 'San Marino'),
(183, 'Sao Tome and Principe'),
(184, 'Saudi Arabia'),
(185, 'Senegal'),
(186, 'Seychelles'),
(187, 'Sierra Leone'),
(188, 'Singapore'),
(189, 'Slovakia (Slovak Republic)'),
(190, 'Slovenia'),
(191, 'Solomon Islands'),
(192, 'Somalia'),
(193, 'South Africa'),
(194, 'South Georgia and the South Sandwich Islands'),
(195, 'Spain'),
(196, 'Sri Lanka'),
(197, 'St. Helena'),
(198, 'St. Pierre and Miquelon'),
(199, 'Sudan'),
(200, 'Suriname'),
(201, 'Svalbard and Jan Mayen Islands'),
(202, 'Swaziland'),
(203, 'Sweden'),
(204, 'Switzerland'),
(205, 'Syrian Arab Republic'),
(206, 'Taiwan'),
(207, 'Tajikistan'),
(208, 'Tanzania, United Republic of'),
(209, 'Thailand'),
(210, 'Togo'),
(211, 'Tokelau'),
(212, 'Tonga'),
(213, 'Trinidad and Tobago'),
(214, 'Tunisia'),
(215, 'Turkey'),
(216, 'Turkmenistan'),
(217, 'Turks and Caicos Islands'),
(218, 'Tuvalu'),
(219, 'Uganda'),
(220, 'Ukraine'),
(221, 'United Arab Emirates'),
(222, 'United Kingdom'),
(223, 'United States'),
(224, 'United States Minor Outlying Islands'),
(225, 'Uruguay'),
(226, 'Uzbekistan'),
(227, 'Vanuatu'),
(228, 'Vatican City State (Holy See)'),
(229, 'Venezuela'),
(230, 'Viet Nam'),
(231, 'Virgin Islands (British)'),
(232, 'Virgin Islands (U.S.)'),
(233, 'Wallis and Futuna Islands'),
(234, 'Western Sahara'),
(235, 'Yemen'),
(236, 'Yugoslavia'),
(237, 'Zaire'),
(238, 'Zambia'),
(239, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE IF NOT EXISTS `propiedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_propietario` int(11) DEFAULT NULL,
  `id_tipo_propiedad` int(11) DEFAULT NULL,
  `direccion` text,
  `ciudad` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(255) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `habitaciones` int(11) DEFAULT NULL,
  `banos` int(11) DEFAULT NULL,
  `gps` varchar(255) DEFAULT NULL,
  `mapa_general` varchar(255) DEFAULT NULL,
  `mapa_cerrado` varchar(255) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `km_const` varchar(10) DEFAULT NULL,
  `puestos_est` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `id_propietario`, `id_tipo_propiedad`, `direccion`, `ciudad`, `estado`, `codigo_postal`, `id_pais`, `habitaciones`, `banos`, `gps`, `mapa_general`, `mapa_cerrado`, `capacidad`, `km_const`, `puestos_est`) VALUES
(1, 1, 2, '11403 NW 89th St', 'Doral', 'Florida', '33178', 206, 2, 1, '22322155', '1_lejos.png', '1_cerca.png', 6, '20', '8'),
(2, 3, 2, '11403 NW 89th St', 'Doral', 'Florida', '33178', 223, 2, 4, '334, 5543', '2_lejos.png', '2_cerca.png', 6, '50', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades_disponibilidad`
--

CREATE TABLE IF NOT EXISTS `propiedades_disponibilidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_propiedad` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `propiedades_disponibilidad`
--

INSERT INTO `propiedades_disponibilidad` (`id`, `id_propiedad`, `fecha_inicio`, `fecha_fin`) VALUES
(3, 1, '2013-05-01', '2013-05-05'),
(8, 1, '2013-03-29', '2013-03-31'),
(9, 2, '2013-05-01', '2013-05-07'),
(10, 2, '2013-05-27', '2013-05-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad_comision`
--

CREATE TABLE IF NOT EXISTS `propiedad_comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_propiedad` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `comision` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Volcar la base de datos para la tabla `propiedad_comision`
--

INSERT INTO `propiedad_comision` (`id`, `id_propiedad`, `id_usuario`, `comision`) VALUES
(60, 1, 18, 25),
(59, 1, 2, 5),
(62, 2, 18, 0),
(61, 2, 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad_habitaciones`
--

CREATE TABLE IF NOT EXISTS `propiedad_habitaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_propiedad` int(11) DEFAULT NULL,
  `hab` int(11) DEFAULT NULL,
  `id_cama` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Volcar la base de datos para la tabla `propiedad_habitaciones`
--

INSERT INTO `propiedad_habitaciones` (`id`, `id_propiedad`, `hab`, `id_cama`) VALUES
(60, 1, 2, 1),
(59, 1, 1, 2),
(62, 2, 2, 4),
(61, 2, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad_imagenes`
--

CREATE TABLE IF NOT EXISTS `propiedad_imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_propiedad` int(11) DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL,
  `imagen_principal` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Volcar la base de datos para la tabla `propiedad_imagenes`
--

INSERT INTO `propiedad_imagenes` (`id`, `id_propiedad`, `ruta_imagen`, `imagen_principal`) VALUES
(37, 2, '2adicionales_15.jpg', 0),
(36, 2, '2adicionales_9.jpg', 0),
(47, 1, '1adicionales_4.jpg', 0),
(35, 2, '2adicionales_7.jpg', 0),
(34, 2, '2adicionales_3.jpg', 0),
(46, 1, '1adicionales_3.jpg', 0),
(44, 1, '1adicionales_1.jpg', 1),
(45, 1, '1adicionales_2.jpg', 0),
(38, 2, '2adicionales_37.jpg', 0),
(39, 2, '2adicionales_14.jpg', 0),
(40, 2, '2adicionales_13.jpg', 0),
(41, 2, '2adicionales_19.jpg', 0),
(42, 2, '2adicionales_5.jpg', 1),
(43, 2, '2adicionales_16.jpg', 0),
(48, 1, '1adicionales_5.jpg', 0),
(49, 1, '1adicionales_6.jpg', 0),
(50, 1, '1adicionales_8.jpg', 0),
(51, 1, '1adicionales_10.jpg', 0),
(52, 1, '1adicionales_9.jpg', 0),
(53, 1, '1adicionales_11.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad_servicios`
--

CREATE TABLE IF NOT EXISTS `propiedad_servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_propiedad` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Volcar la base de datos para la tabla `propiedad_servicios`
--

INSERT INTO `propiedad_servicios` (`id`, `id_propiedad`, `id_servicio`) VALUES
(109, 2, 2),
(108, 2, 18),
(107, 2, 4),
(106, 2, 12),
(105, 2, 8),
(104, 1, 3),
(103, 1, 17),
(102, 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad_tarifas`
--

CREATE TABLE IF NOT EXISTS `propiedad_tarifas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_propiedad` int(11) DEFAULT NULL,
  `precio_diario` float DEFAULT NULL,
  `precio_mensual` float DEFAULT NULL,
  `limpieza` float DEFAULT NULL,
  `fecha_comienzo` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `propiedad_tarifas`
--

INSERT INTO `propiedad_tarifas` (`id`, `id_propiedad`, `precio_diario`, `precio_mensual`, `limpieza`, `fecha_comienzo`, `fecha_fin`) VALUES
(6, 1, 130, 500, 200, '2013-03-13', '2013-05-30'),
(8, 2, 150, 600, 200, '2013-04-01', '2013-05-30'),
(9, 1, 200, 900, 200, '2013-06-01', '2013-12-31'),
(10, 2, 250, 950, 200, '2013-06-01', '2013-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE IF NOT EXISTS `propietarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `st` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`id`, `nombre`, `apellido`, `email`, `telefono`, `st`) VALUES
(1, 'Vcitoria', 'Roche', 'vicarodi@gmail.com', '(0412)2222222', NULL),
(3, 'Carolina', 'Diaz', 'vicarodi@gmail.com', '(1111)1111111', NULL),
(4, 'Erika', 'Gallardo', 'erika16lozada@gmail.com', '(0412)8999999', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `st` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `st`) VALUES
(2, 'Lenceria', 1),
(3, 'TV', 1),
(4, 'Home Theater', 1),
(5, 'WI-FI', 1),
(6, 'Piscina', 1),
(7, 'Secadora', 1),
(8, 'Cocina Equipada', 1),
(9, 'DVD', 1),
(10, 'SatTV', 1),
(11, 'Aire Acondicionado', 1),
(12, 'Estacionamiento', 1),
(13, 'Teléfono', 1),
(14, 'Toallas', 1),
(15, 'Blue Ray', 1),
(16, 'Internet', 1),
(17, 'Calefacción', 1),
(18, 'Lavadora', 1),
(19, 'Apto para familias', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_camas`
--

CREATE TABLE IF NOT EXISTS `tipo_camas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `st` int(11) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `tipo_camas`
--

INSERT INTO `tipo_camas` (`id`, `nombre`, `st`, `capacidad`) VALUES
(1, 'King size', 1, 2),
(2, 'Dos Matrimoniales', 1, 4),
(3, 'Dos individuales', 1, 2),
(4, 'Matrimonial y dos Individual', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_propiedad`
--

CREATE TABLE IF NOT EXISTS `tipo_propiedad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `st` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `tipo_propiedad`
--

INSERT INTO `tipo_propiedad` (`id`, `nombre`, `st`) VALUES
(1, 'Casa', 1),
(2, 'Apartamento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_list`
--

CREATE TABLE IF NOT EXISTS `user_list` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(23) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `usuario` tinytext,
  `pass` tinytext,
  `nivel_acceso` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `user_list`
--

INSERT INTO `user_list` (`ID`, `cedula`, `email`, `nombre`, `telefono`, `usuario`, `pass`, `nivel_acceso`) VALUES
(1, '123123', 'vicarodi@gmail.com', 'SOPORTE', '000000000', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, NULL, 'jg@hotmail.com', 'Jesus Granados', NULL, 'jg', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(18, NULL, NULL, 'Carlos Perez', NULL, NULL, NULL, 1);
