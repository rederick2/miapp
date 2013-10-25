-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-10-2013 a las 22:48:31
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `rdalive2013`
--
CREATE DATABASE IF NOT EXISTS `rdalive2013` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rdalive2013`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `id_asset` int(11) NOT NULL AUTO_INCREMENT,
  `media` varchar(500) NOT NULL,
  `credit` varchar(100) NOT NULL,
  `caption` varchar(300) NOT NULL,
  PRIMARY KEY (`id_asset`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `assets`
--

INSERT INTO `assets` (`id_asset`, `media`, `credit`, `caption`) VALUES
(1, 'http://cdn2.pedroventura.com/wp-content/uploads/2013/05/js.jpg', '', ''),
(2, 'http://youtu.be/u4XpeU9erbg', '', ''),
(3, 'http://youtu.be/u4XpeU9erbg', '', ''),
(4, 'http://youtu.be/u4XpeU9erbg', '', ''),
(5, 'http://youtu.be/MkJxQoI-hw4', '', ''),
(6, 'http://youtu.be/u4XpeU9erbg', '', ''),
(7, 'http://youtu.be/MkJxQoI-hw4', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_of_type` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id_comment`, `id_user`, `id_of_type`, `type`, `text`, `create_time`) VALUES
(1, 1, 2, 'Devos', 'Hola\n', '2013-10-25 21:56:32'),
(2, 1, 2, 'Devos', 'Hola\n', '2013-10-25 21:58:04'),
(3, 1, 2, 'Devos', 'Hola\n\n', '2013-10-25 21:58:10'),
(13, 1, 4, 'Devos', 'Hola\n', '2013-10-25 22:29:16'),
(14, 1, 1, 'Devos', 'Holas\n', '2013-10-25 22:29:28'),
(15, 1, 1, 'Devos', 'Muy Bueno (Y)\n', '2013-10-25 22:40:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dates`
--

CREATE TABLE IF NOT EXISTS `dates` (
  `id_date` int(11) NOT NULL AUTO_INCREMENT,
  `id_timeline` int(11) NOT NULL,
  `id_asset` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `startDate` varchar(10) NOT NULL,
  `endDate` varchar(10) NOT NULL,
  `headline` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `tag` varchar(500) DEFAULT NULL,
  `classname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `dates`
--

INSERT INTO `dates` (`id_date`, `id_timeline`, `id_asset`, `id_user`, `startDate`, `endDate`, `headline`, `text`, `tag`, `classname`) VALUES
(1, 1, 3, 1, '2011,12,12', '2012,1,27', 'Fecha de Prueba', '<p>In true political fashion, his character rattles off common jargon heard from people running for office.</p>', NULL, NULL),
(2, 1, 4, 1, '2011,1,12', '2012,1,13', 'Fecha de Prueba 2', '<p>In true political fashion, his character rattles off common jargon heard from people running for office.</p>', NULL, NULL),
(5, 1, 7, 1, '2011,1,12', '2012,1,13', 'Mi cumple', 'Este fue un bonito dia <a href="/miapp/rederick2013">by rederick2013</a>', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devos`
--

CREATE TABLE IF NOT EXISTS `devos` (
  `id_devo` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `image` varchar(300) NOT NULL,
  `title` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `texto_biblico` varchar(150) NOT NULL,
  `tags` varchar(500) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id_devo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `devos`
--

INSERT INTO `devos` (`id_devo`, `id_user`, `image`, `title`, `text`, `texto_biblico`, `tags`, `create_time`, `update_time`) VALUES
(1, 1, '/images/devos/santificate.jpg', 'Santificate, es hora de hacerlo!', 'Dios nos ha revelado una descripción de la vida cristiana\nen una sola palabra: Santidad.\nPedro lo explicó de esta manera: «Como hijos obedientes,\nno os conforméis a los deseos que antes teníais en vuestra\nignorancia, sino que así como aquel que os llamó es santo, así\ntambién sed vosotros santos en toda vuestra manera de vivir»', '1 Pedro 1:14-15', 'santificate,jesus,es,hora', '2013-10-21 17:22:11', '2013-10-21 17:22:11'),
(2, 6, '/images/devos/devo2.jpg', 'Hubble, zoológicos y niños', '¿Qué tienen en común el telescopio espacial Hubble, un zoológico y unos niños cantando? Según lo que enseña el Salmo 148, la conclusión es que todos ellos apuntan a la obra magnífica de Dios en la creación.', 'Salmo 148:3', 'hubble,zoologico,niños', '2013-10-21 08:10:16', '2013-10-21 08:10:16'),
(3, 6, '/images/devos/devo3.jpg', '¿Tú también te vas? ', 'Las separaciones en las iglesias generalmente son asuntos\r\nfeos y dolorosos. La mayor parte del tiempo, las personas\r\nquedan heridas o decepcionadas. Las acusaciones se lanzan\r\nde un lado a otro como granadas. Y las personas se atrincheran\r\nen sus posiciones.', 'Juan 6:68-69', 'te vas,cielo', '2013-10-21 08:26:30', '2013-10-21 08:26:30'),
(4, 1, '/images/devos/devo4.jpg', 'Corazones descarriados', 'El otoño pasado, una carretera de la ciudad donde vivo estuvo cerrada durante varias horas porque un camión con ganado había volcado. Las vacas habían escapado y vagaban por la autopista. Ver esta noticia sobre ganado a la deriva me hizo pensar en algo que hacía poco había estudiado en Éxodo 32 sobre el pueblo de Dios que se había alejado de Él.', 'Éxodo 32:31', 'corazones,descarriados', '2013-10-21 13:11:18', '2013-10-21 13:11:18'),
(5, 1, '/images/devos/devo5.jpg', '¿Tienes hambre?', 'Ha pasado bastante tiempo desde que tuvimos bebés recién\r\nnacidos viviendo en nuestra casa, pero recuerdo la rutina\r\nbastante bien. Dormir, leche, y pañales. Dormir, leche, y\r\npañales. Más de dormir, más leche, y cambiarlos de nuevo. Logras\r\nhacer esas cosas y estás en buena forma. Falla en uno de esos\r\npuntos y, ¿qué sucede? ¡Buaaaa! — ¡en tonos cada vez más altos!\r\nPedro debió haber tenido bebés en su casa en algún\r\nmomento, porque sabía acerca de sus necesidades. Escribió,\r\n«Desead como niños recién nacidos, la leche pura de la palabra»', '1 Pedro 2:2', 'hambre,sed', '2013-10-21 08:24:29', '2013-10-21 08:24:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requestdevos`
--

CREATE TABLE IF NOT EXISTS `requestdevos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_devo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `timelines`
--

CREATE TABLE IF NOT EXISTS `timelines` (
  `id_timeline` int(11) NOT NULL AUTO_INCREMENT,
  `headline` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `id_asset` int(11) NOT NULL,
  PRIMARY KEY (`id_timeline`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `timelines`
--

INSERT INTO `timelines` (`id_timeline`, `headline`, `text`, `type`, `id_asset`) VALUES
(1, 'Historia', 'Esta es la historia', 'default', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `e_mail` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `facebook_account` int(11) DEFAULT NULL,
  `token` text NOT NULL,
  `picture` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `e_mail`, `username`, `password`, `facebook_account`, `token`, `picture`) VALUES
(1, 'Erick David', 'Santillan Zarate', 'rederick2@hotmail.com', 'rederick2013', 'alex2002', 1, 'CAACZCd8sTU7cBAPYDNXDI5fLqgmGCXpS21SaweUQZAK80XpWzTi3u70ZCkyiykjxt4IQIzskd0x4XJJrSnggJZB5fneRQ0Ig6oyj2BsyCq6ue2b5PR5ijZCOLjeWCAWww8jeaxZBnS4FN0U3wVnAfqez3QOZBazdTB4Ooi8GjF9odZA8lr68lcs8WFVNQZCmD5uDuAiBm9pkCegZDZD', 'http://graph.facebook.com/100002088120582/picture?type=large'),
(6, 'Alex', 'Santillan Zarate', 'alexsantillan@hotmail.com', 'alex2013', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', ''),
(10, 'Erick ', 'Santillan Zarate', 'rederick21@hotmail.com', 'rederick2014', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
