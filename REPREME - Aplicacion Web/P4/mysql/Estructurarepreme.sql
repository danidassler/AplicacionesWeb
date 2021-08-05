-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2020 a las 02:32:04
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repreme`
--
CREATE DATABASE IF NOT EXISTS `repreme` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `repreme`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentariosprod`
--

DROP TABLE IF EXISTS `comentariosprod`;
CREATE TABLE IF NOT EXISTS `comentariosprod` (
  `idComentario` int(20) NOT NULL AUTO_INCREMENT,
  `idProducto` int(20) NOT NULL,
  `descripcion` text NOT NULL,
  `user` varchar(20) NOT NULL,
  `visibilidad` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (`idComentario`),
  KEY `infousuario_ibfk_1` (`user`),
  KEY `idProducto` (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;




--
-- Estructura de tabla para la tabla `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `user` varchar(20) CHARACTER SET utf8 NOT NULL,
  `idProducto` int(20) NOT NULL,
  PRIMARY KEY (`user`,`idProducto`),
  KEY `idProducto` (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infousuario`
--

DROP TABLE IF EXISTS `infousuario`;
CREATE TABLE IF NOT EXISTS `infousuario` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pais` varchar(20) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codPostal` varchar(10) NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `dni` varchar(50) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `noticias`
--

DROP TABLE IF EXISTS `noticias`;
CREATE TABLE IF NOT EXISTS `noticias` (
  `idNoticia` int(5) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(400) CHARACTER SET utf8 NOT NULL,
  `parrafo1` text CHARACTER SET utf8 NOT NULL,
  `parrafo2` text NOT NULL,
  `parrafo3` text NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8 NOT NULL,
  `disponibilidad` enum('activa','inactiva') NOT NULL,
  PRIMARY KEY (`idNoticia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `descripcion` text NOT NULL,
  `stockDisponible` int(6) NOT NULL,
  `talla` varchar(10) NOT NULL,
  `color` varchar(20) NOT NULL,
  `categoria` enum('ropa','accesorios','sneakers') NOT NULL,
  `subcategoria` varchar(20) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `imagen2` varchar(50) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `disponibilidad` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `user` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `permisos` enum('administrador','usuario') NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

DROP TABLE IF EXISTS `valoracion`;
CREATE TABLE IF NOT EXISTS `valoracion` (
  `idValoracion` int(20) NOT NULL AUTO_INCREMENT,
  `idProducto` int(20) NOT NULL,
  `puntuacion` int(3) NOT NULL,
  `user` varchar(20) NOT NULL,
  `visibilidad` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (`idValoracion`),
  KEY `user` (`user`),
  KEY `idProducto` (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `IdVenta` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `precioTotal` decimal(10,2) NOT NULL,
  `user` varchar(20) NOT NULL,
  PRIMARY KEY (`IdVenta`),
  KEY `fk_venta` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `ventaproducto`
--

DROP TABLE IF EXISTS `ventaproducto`;
CREATE TABLE IF NOT EXISTS `ventaproducto` (
  `IdVenta` int(20) NOT NULL,
  `idProducto` int(20) NOT NULL,
  `unidades` int(6) NOT NULL,
  PRIMARY KEY (`IdVenta`,`idProducto`),
  KEY `idProducto` (`idProducto`),
  KEY `IdVenta` (`IdVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentariosprod`
--
ALTER TABLE `comentariosprod`
  ADD CONSTRAINT `comentariosprod_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `infousuario_ibfk_1` FOREIGN KEY (`user`) REFERENCES `usuario` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`user`) REFERENCES `usuario` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `infousuario`
--
ALTER TABLE `infousuario`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`user`) REFERENCES `usuario` (`user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`user`) REFERENCES `usuario` (`user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoracion_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta` FOREIGN KEY (`user`) REFERENCES `usuario` (`user`);

--
-- Filtros para la tabla `ventaproducto`
--
ALTER TABLE `ventaproducto`
  ADD CONSTRAINT `ventaproducto_ibfk_1` FOREIGN KEY (`IdVenta`) REFERENCES `venta` (`IdVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ventaproducto_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
