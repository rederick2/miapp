-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-10-2013 a las 01:23:59
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
(1, 'Erick David', 'Santillan Zarate', 'rederick2@hotmail.com', 'rederick2013', 'alex2002', 1, 'CAACZCd8sTU7cBAPNLv7264hwXBb5HU6Wg3lxZBPP7aThMFb4Fxo21zzmTnlIYrFRVOKYboTJC7wynC7omqOZATJKTyvmZCzSG5z9PVQphtSfaeYDzNCGAsoAZC8lIvXZC4cBlhFbChLagUFHS2AVQIw2OvL6jsBi5L4pdViJR8XHLKakOcX1wobKA5AkIaLIQZD', 'http://graph.facebook.com/100002088120582/picture?type=large'),
(6, 'Alex', 'Santillan Zarate', 'alexsantillan@hotmail.com', 'alex2013', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', ''),
(10, 'Erick ', 'Santillan Zarate', 'rederick21@hotmail.com', 'rederick2014', 'e10adc3949ba59abbe56e057f20f883e', NULL, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
