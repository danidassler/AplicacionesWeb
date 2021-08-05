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
-- Volcado de datos para la tabla `comentariosprod`
--

INSERT INTO `comentariosprod` (`idComentario`, `idProducto`, `descripcion`, `user`, `visibilidad`) VALUES
(1, 16, 'Esta iniciativa me parece increíble, juntos contra el COVID-19!', 'paulaPM', 'activo'),
(2, 13, 'Es uno de mis colores favoritos de las jordan 1', 'paulaPM', 'activo'),
(3, 30, 'Me encanta !!!', 'paulaPM', 'activo'),
(4, 5, 'Yo las tengo y son super cómodas! Ademas es el mejor color ... ', 'danidassler', 'activo'),
(5, 16, 'Si tuviese el dinero me la compraría sin pensarlo... Ademas es una colaboración !', 'danidassler', 'activo'),
(6, 26, 'Le doy un 4 y no un 5 porque el color se quita bastante con los lavados ... una pena ', 'danidassler', 'activo'),
(7, 10, 'Ojala tuvieseis mas colores! Me gustan mas las negras enteras', 'danidassler', 'activo'),
(8, 12, 'Sin duda las mejores de la pagina', 'danidassler', 'activo'),
(9, 21, 'Que gracioso', 'danidassler', 'activo'),
(10, 15, 'La tengo! super recomendable !', 'danidassler', 'activo'),
(11, 27, 'Demasiado caras, unas dunk normales las encuentras por 60€... No merece la pena pagar tanto solo por el hype de la colaboración con Travis. ', 'danidassler', 'activo'),
(12, 3, 'No se yo si lavarla seria muy buena idea con los cristales en el pecho ... Y pagar tanto dinero para no usarla o que se le caigan los cristales...', 'casado99', 'activo'),
(13, 15, 'Me gustaria mas con el camuflaje en color verde, pero muy chula !', 'casado99', 'activo'),
(14, 23, 'Me compraría una para ir con mi abuelo a juego cuando se ponga un chándal antiguo jajaja', 'casado99', 'activo'),
(15, 19, 'De los mejores TNFxSUP que hay !', 'casado99', 'activo'),
(16, 18, 'Eso es la espalda o la parte delantera de la camiseta ???', 'casado99', 'activo'),
(17, 24, 'Inceible... que pena que fuese tan limitada y ahora cueste tanto', 'casado99', 'activo'),
(18, 12, 'Parecen zapatillas de alien jajaja', 'casado99', 'activo'),
(19, 9, 'Fuegooooo ', 'casado99', 'activo'),
(20, 22, 'El abanico español de toda la vida mucho mejor que esto', 'casado99', 'activo'),
(21, 16, 'TOP', 'yisasElBueno', 'activo'),
(22, 4, 'Que el coche este bordado es un detalle buenisimo', 'yisasElBueno', 'activo'),
(23, 7, 'No me gustan nada,los materiales deberian de ser mucho mejores para lo que cuestan', 'yisasElBueno', 'activo'),
(24, 6, 'Demasiado camuflaje, aunque entiendo que es lo mas caracteristico de bape.', 'yisasElBueno', 'activo'),
(25, 14, 'El BOOST es lo mas comodo que hay! ', 'yisasElBueno', 'activo'),
(26, 20, '15€ por unas tiritas en serio?!', 'yisasElBueno', 'activo'),
(27, 17, 'Este color es muy bonito, me gusta.', 'yisasElBueno', 'activo'),
(28, 23, 'hahahaha muy top', 'yisasElBueno', 'activo'),
(29, 2, 'Imaginate estar en la montaña de la foto con el abrigo ! A juego 100%', 'yisasElBueno', 'activo'),
(30, 17, 'Me encantaaaaaaaaa', 'begooo03', 'activo'),
(31, 20, 'Las voy a comprar para cuando me haga un corte jajajaja', 'begooo03', 'activo'),
(32, 11, 'Las mejores V2 de todas', 'begooo03', 'activo'),
(33, 16, 'La mejor camiseta de la tienda ', 'begooo03', 'activo'),
(34, 26, 'Yo la tengo, la sudadera que mas me gusta de la colección.', 'begooo03', 'activo'),
(35, 25, 'Me encanta Pharrel como cantante y como diseñador!', 'begooo03', 'activo'),
(36, 28, 'In love', 'begooo03', 'activo'),
(37, 24, 'No me gusta nada el camuflaje', 'begooo03', 'activo'),
(38, 6, 'Tenéis tallas más pequeñas ? las quiero pero uso un 39 :(', 'begooo03', 'activo'),
(39, 2, 'Yo lo intente comprar en supreme cuando salio pero se agoto en 3 segundos !', 'danidassler', 'activo'),
(40, 2, 'Me gusta pero creo que hay diseños mucho mas bonitos', 'paulaPM', 'activo'),
(41, 26, 'Me encanta :)', 'paulaPM', 'activo'),
(42, 29, 'Ojala fuese mas barato :(', 'paulaPM', 'activo'),
(43, 24, 'Tendrán disponible la talla S dentro de poco?', 'paulaPM', 'activo'),
(44, 2, 'Yo lo compre cuando salio en el drop y lo revendí por 400€ mas jajaja', 'casado99', 'activo'),
(45, 7, 'me gusta mucho el color', 'casado99', 'activo'),
(46, 5, 'Las tiene mi amigo y cada vez que las veo me gustan mas', 'casado99', 'activo'),
(47, 5, 'Me gustan mas las blancas enteras, ojala estén disponibles algún día en la web', 'begooo03', 'activo'),
(48, 3, 'Wow', 'begooo03', 'activo');

-- --------------------------------------------------------

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

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`user`, `idProducto`) VALUES
('begooo03', 2),
('begooo03', 25),
('casado99', 9),
('casado99', 11),
('casado99', 15),
('danidassler', 5),
('danidassler', 12),
('danidassler', 26),
('danidassler', 29),
('paulaPM', 2),
('paulaPM', 13),
('paulaPM', 16),
('paulaPM', 30),
('yisasElBueno', 19);

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
-- Volcado de datos para la tabla `infousuario`
--

INSERT INTO `infousuario` (`nombre`, `apellido`, `user`, `pais`, `direccion`, `codPostal`, `localidad`, `provincia`, `telefono`, `email`, `imagen`, `dni`) VALUES
('Aministrador', 'Repreme', 'admin', 'España', 'Calle Admin 12', '28058', 'Madrid', 'Madrid', '601741831', 'admin04@ucm.es', '', '3028391L'),
('Maria Begoña', 'Martinez', 'begooo03', 'Alemania', 'c/Frankfurt 290 1ºB', '29912', 'Berlin', 'Berlin', '609039663', 'bego@icloud.com', 'img/perfilUsuario5.jpg', '51633572H'),
('Alvaro', 'Casado', 'casado99', 'España', 'Calle Kevin 6 4H', '28046', 'Madrid', 'Madrid', '683290741', 'casdo@ucm.es', 'img/imagenPerfil.jpg', '30283916391'),
('Daniel', 'Sanz Mayo', 'danidassler', 'España', 'Calle Sepulveda 216 3G', '28011', 'Madrid', 'Madrid', '+34625134', 'dasanz04@ucm.es', 'img/imagenUsuario2.jpg', '50630672J'),
('Paula', 'Piñuela Monjas', 'paulaPM', 'España', 'Calle Los Yebenes 6 4H', '28047', 'Madrid', 'Madrid', '629100741', 'paula24@ucm.es', 'img/perfilusuario3.jpg', '57132092J'),
('Jesus', 'ElBueno', 'yisasElBueno', 'Francia', 'Torre Eiffel numero 2', '26051', 'Paris', 'Paris', '682180741', 'jjj@ucm.es', 'img/perfilUsuario4.jpg', '3629491M');

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `parrafo1`, `parrafo2`, `parrafo3`, `imagen`, `disponibilidad`) VALUES
(1, 'Pharrel Williams Outfit', 'El conocido rapero, cantante, compositor y productor estadounidense Pharrel Williams hizo una visita a la boutique de streetwear francesa Colette con motivo de el lanzamiento de sus nuevas zapatillas, las Adidas NMD ‘Human Race’ x Chanel.\r\n\r\n\r\n', 'Estas zapatillas diseñadas por el artista son una colaboración súper exclusiva entre la marca alemana Adidas que aporta su silueta NMD, y la marca francesa de lujo Chanel. Presentan un upper negro con los nombres de ‘Pharrel’ y ‘Chanel’ bordados en blanco, una mediasuela de boost y una suela de goma ‘trail’.\r\nComo se pueden ver en las imágenes, las zapatillas están customizadas por el propio Pharrel con unos dibujos y frases en la suela pero los pares que saldrán a la venta no tendrán estos curiosos detalles.', 'Pharrel también llevaba unos jeans combinados con una sudadera rosa de su propia marca de streetwear Human Made que creo junto a su amigo, el DJ y diseñador japones Nigo.\r\n\r\nLa gorra que lleva el artista también pertenece a la colección de la marca Human Made.', 'img/chanelP.jpg', 'activa'),
(2, 'Halloween Drop', 'Atencion ! Llega el esperado Halloween Drop !\r\nEl día 30 de Octubre. con motivo de la festividad de Halloween, llegarán a nuestra página nuevos lanzamientos de productos temáticos exclusivos.\r\n Estos estarán disponibles hasta fin de existencias y con precios escalofriantemente bajos en comparación con el resto de paginas de reventa para celebrar el día mas terrorífico de todo el año.\r\n', 'Los influencers mas conocidos del mundo streetwear, como @miller, ya están publicando sus outfits temáticos en sus paginas de redes sociales para empezar a calentar motores de cara al día 31.', 'La hora a la que se lanzaran los productos sera aleatoria para que este evento especial sea mas justo para todos nuestros clientes y sera avisada a través de nuestras redes sociales por lo que recomendamos activar as notificaciones para poder ser el primero en enterarse.', 'img/halloween.jpg', 'inactiva'),
(3, 'Travis Scott Outfit', 'El día 05-05-2019 en San Diego, en el toyota center durante el transcurso de las semifinales de conferencia entre los Rockets y los Warriors,  vimos al rapero Travis Scott que describe ser seguidor de los Rockets llevando una camiseta de nuestra selección de productos, en particular la camiseta box logo tee supreme en colaboración con swarovski que salió en la colección ss19, concretamente en color blanco con el box logo formado por mas de mil cristales de Swarovski en color rojo, aunque está disponible también en color negro y rojo.\r\n\r\nTambién llevaba un par de 1985 “Chicago” Air Jordans Is, zapatillas muy exclusivas que ahora mismo no están en nuestro catálogo pero próximamente estarán disponibles asi que muy atentos a nuestras redes sociales. (instagram, facebook)', 'Otro día se le vio llevando la camiseta box logo tee black on black, uno de los productos más conocidos de nuestro catálogo y que como se ve en la foto remarca su estatus social promocionando la marca, esta camiseta también disponible entre nuestros productos últimamente añadidos, en la pestaña de novedades.', 'Travis Scott ha sido visto en múltiples ocasiones vistiendo prendas de la marca supreme una de las marcas con más productos disponibles en nuestra página web, para poder conocer toda nuestra variedad de productos y prendas supreme así como otras marcas streetwear te adjuntamos el enlace a nuestras últimas novedades así como a los productos descritos en la noticia.', 'img/TS.jpg', 'activa');

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `precio`, `descripcion`, `stockDisponible`, `talla`, `color`, `categoria`, `subcategoria`, `imagen`, `imagen2`, `marca`, `disponibilidad`) VALUES
(1, 'Supreme The North Face Bandana Mountain Jacket Red', '5210.00', 'Esta Mountain Jacket es parte de la colaboración entre la marca americana de streetwear Supreme y The North Face, como parte de su colección de FW14 donde se lanzaron 3 colores (rojo, negro y navy). Esta chaqueta fue un producto muy limitado y con mucho «hype» lo que explica su actual precio de reventa.TALLA L', 4, 'L', 'rojo', 'ropa', 'jackets', 'img/bandanared.jpg', 'img/bandanared2.jpg', 'The North Face', 'inactivo'),
(2, 'Supreme The North Face Mountain Parka Blue/White', '1450.00', 'Chaqueta Mountain Parka de la marca The North Face en colaboracion con la marca streetwear Supreme como parte de su coleccion de invierno FW17', 4, 'L', 'azul', 'ropa', 'jackets', 'img/streetwear.png', 'img/parkaMountain2.jpg', 'The North Face', 'activo'),
(3, 'Supreme Swarovski Box Logo Tee White', '690.00', 'Camiseta box logo de Supreme en colaboracion con Swarovski, 100% algodon, presenta 1161 cristales de Swarovski implantados en el pecho formando el logo de supreme. Producto exclusivo creado para celebrar el 25 aniversario de la marca, perteneciente a la coleccion SS19.', 2, 'XL', 'blanco', 'ropa', 'camisetas', 'img/Swarovski.jpg', 'img/swaroski3.jpg', 'Swarovski', 'activo'),
(4, 'Supreme Cop Car Hooded Sweatshirt', '210.00', 'Forro polar de algodón grueso pesado con ilustraciones originales de AOI bordadas en el pecho. Sudadera perteneciente a la coleccion de FW19 de supreme.', 11, 'M', 'negra', 'ropa', 'sudaderas', 'img/supremecopcar.jpg', 'img/copcar2.jpg', 'supreme', 'activo'),
(5, 'Adidas Yeezy Boost 350 v2', '838.00', 'Zapatilla adidas originals Yeezy boost 350 v2 ‘bred’ colorway diseñadas por el rapero Kanye West en su colaboracion con adidas, con la ultima tecnologia boost en la suela y un upper ligero de primeknit.', 5, '44', 'negro', 'sneakers', 'yeezy', 'img/yeezybred.jpg', 'img/yeezybred22.jpg', 'adidas', 'activo'),
(6, 'Adidas NMD R1 Bape Olive Camo', '1050.00', 'Zapatilla adidas NMD en collaboracion con la marca de streetwear japonesa Bape. Un colourway con el clasico camuflaje de Bape, suela boost para maxima comodidad. Lanzamiento super exclusivo.', 10, '44', 'verde', 'sneakers', 'NMD', 'img/nmd.png', 'img/bapenmd2.jpg', 'adidas', 'activo'),
(7, 'Jordan 6 Retro Travis Scott', '825.00', 'Siguiendo la estela de sus ultimas colaboraciones, Travis Scott y Jordan Brand se unen una vez más para crear las Jordan 6 Retro Travis Scott ya disponibles en Repreme. Esta es la cuarta silueta de Air Jordan que Cactus Jack ha tocado. Esta zapatilla salio a la luz cuando Travis las saco en el escenario durante su actuación en el Super Bowl LIII y el resto es historia.', 5, '42', 'verde', 'sneakers', 'JORDAN', 'img/jordan1.jpg', 'img/jordantravis2.jpg', 'nike', 'activo'),
(8, 'Nike Air Max 98 Supreme,Snakeskin', '595.00', 'Zapatillas nike air max 98 ‘snakeskin’ en colaboracion con la marca streetwear Supreme que fue parte de un lanzamiento super exclusivo en la coleccion de SS16.', 2, '46', 'verde', 'sneakers', 'AIRMAX', 'img/airmax1.png', 'img/airmax98.jpg', 'nike', 'inactivo'),
(9, 'Supreme Logo Zippo Red', '85.00', 'Mechero de Supreme rojo con logo clasico en blanco, en colaboracion con Zippo. Accesorio perteneciente a la coleccion SS18.', 18, 'Unica', 'Rojo', 'accesorios', 'accesorios', 'img/zippo.jpg', 'img/zippo2.jpg', 'supreme', 'activo'),
(10, 'Adidas Yeezy Boost 750 Light Grey Glow In the Dark', '770.00', 'Adidas y Kanye se unen para lanzar la adidas Yeezy 750 Light Grey/Glow In the Dark. Este Yeezy 750 viene con un upper gris, entresuela de goma que brilla en la oscuridad y suela de goma y boost. Estas zapatillas se lanzaron en junio de 2016 y se vendieron por $ 350.', 10, '45', 'Gris', 'sneakers', 'Yeezy', 'img/yeezy750.jpg', 'img/boost2.jpg', 'Adidas', 'activo'),
(11, 'Adidas Yeezy 700 V2 Static', '500.00', 'Adidas y Kanye se unen para lanzar la adidas Yeezy 700 V2 Static. Esta Yeezy 700 viene con una parte superior gris con detalles en blanco, entresuela blanca y suela negra. Estas zapatillas se lanzaron en diciembre de 2018 y se vendieron por $ 300. Las 700 han sido una de las mejores figuras de adidas estos ultimos años, aprovecha para comprarlas!', 30, '42', 'Gris', 'sneakers', 'Yeezy', 'img/700.jpg', 'img/adidasYeezy700VStatic2.jpg', 'Adidas', 'activo'),
(12, 'Adidas Yeezy 700 V3 Azael', '725.00', 'Yeezy presenta una nueva variación del Boost 700 con el Yeezy Boost 700 V3 Azael. La tercera encarnación del Yeezy Boost 700 es uno de los diseños más sofisticados que hemos visto en las colaboraciones en curso, jugando con forma, línea, textura e incluso expectativas. La carcasa exterior recuerda a un auto de carreras y un traje de astronauta con una única unidad que se siente progresiva y sustancial.', 3, '45', 'Blanco', 'sneakers', 'Yeezy', 'img/azael.jpg', 'img/azael4.jpg', 'Adidas', 'activo'),
(13, 'Jordan 1 Retro High Obsidian UNC', '305.00', 'Jordan Brand agrega un nuevo colorway a su racha de lanzamientos de Jordan 1 con el Air Jordan 1 &quot;Obsidian / University Blue&quot;. Desde su debut en 1985, el Air Jordan 1 ha sido un monumento cultural, rompiendo barreras entre la cancha y las calles. Jordan Brand ha seguido arrojando nueva luz sobre esta silueta intemporal y lo hace con este lanzamiento.  Este AJ 1 presenta un diseño similar al de la &quot;Patente UNC&quot; 1 que se lanzó en febrero de 2019, solo que esta vez el colorway recibe un tratamiento completo de cuero. Esta zapatilla se lanzó en agosto de 2019 y se vendió por $ 160.', 15, '41', 'Azul', 'sneakers', 'Jordan', 'img/obsidian.jpg', 'img/obsidian3.jpg', 'Nike', 'activo'),
(14, 'Adidas Ultra Boost OG', '180.00', 'Adidas con esta zapatilla inicio el legado del boost en el mundo de las zapatillas con un gran exito. Presentan una suela completa de esta increible tecnologia y un upper de primeknit.', 30, '45', 'Negro', 'sneakers', 'UltraBoost', 'img/ultraog.jpg', 'img/ultraog2.jpg', 'Adidas', 'activo'),
(15, 'BAPE ABC Camo College Tee Black', '138.00', 'Clásica camiseta de la marca de streetwear japonesa, combina su camuflaje característico con su logo mas identificable. 100% Algodón', 48, 'M', 'Negro', 'ropa', 'Camisetas', 'img/bapetee.jpg', 'img/bapeshirt2.jpg', 'Bape', 'activo'),
(16, 'Supreme Takashi Murakami COVID-19 Relief Box Logo Tee White', '575.00', 'Supreme ha colaborado con Takashi Murakami para lanzar una camiseta exclusiva con fines benéficos, para ayudar contra el COVID-19. Repreme también se ha comprometido a donar los ingresos de Supreme COVID-19 Relief Tees para AYUDAR a los mas afectados por la pandemia. Esta camiseta presenta el logotipo de Supreme sobre la pieza &quot;Calaveras y flores rojas&quot; de Murakami que se mostró por primera vez en 2013. La camiseta se lanzó el 24 de abril de 2020 y se vendió por $60 USD.', 9, 'L', 'Blanco', 'ropa', 'Camisetas', 'img/covidboxlogo.jpg', 'img/takasi.jpg', 'Supreme', 'activo'),
(17, 'Supreme Bandana Box Logo Hooded Sweatshirt Light Blue', '633.00', 'El codiciado Box Logo de Supreme regresó en forma de sudaderas con capucha para su FW19 Week 16 Drop. Lanzadas por última vez en 2017, las sudaderas con capucha con el logotipo de Supreme presentan un diseño particularmente único esta temporada, ya que cada box logo viene en forma de bandana. Las sudaderas con capucha se lanzaron en ocho combinaciones de colores, siete de las cuales presentan colores compartidos entre la prenda y el logotipo de la caja y una combinación de colores que presenta un logotipo de caja azul en una sudadera con capucha gris. La sudadera con capucha Supreme Bandana Box Logo se lanzó el 12 de diciembre de 2019 y se vendió por $168 USD.', 23, 'XL', 'Baby Blue', 'ropa', 'Sudaderas', 'img/bandanahoodie.jpg', 'img/bandanahoodie2.jpg', 'Supreme', 'activo'),
(18, 'Anti Social Social Club x Fragment Blue Bolt Tee (FW19) Black', '105.00', 'Colaboración entre dos marcas de streetwear, la conocida Anti Social Social Club y Fragment, esta colección contó con camisetas y sudaderas en 3 diferentes colores, afortunadamente en Repreme hemos podido traer esta codiciada colaboración.', 10, 'S', 'Negro', 'ropa', 'Camisetas', 'img/assc.jpg', 'img/antisocial2.jpg', 'ASSC', 'activo'),
(19, 'Supreme The North Face Nuptse Leaves', '1204.00', 'Clásico abrigo de la marca The North Face, una colaboración donde Supreme se encarga de darle un toque diferente al conocido modelo de abrigo &quot;nuptse&quot; de la marca.', 5, 'M', 'Leave Print', 'ropa', 'Jackets', 'img/nuptse.jpg', 'img/nuptse2.jpg', 'The North Face', 'activo'),
(20, 'Supreme x Band Aid Adhesive Bandages', '15.00', 'Colaboración se Supreme con Johnson&amp;Johnson para realizar uno de los &quot;accesorios&quot; mas locos en la historia de la marca de streetwear, unas tiritas. Las cajas contienen 20 unidades.', 97, 'Unica', 'Rojo', 'accesorios', 'Accesorios', 'img/tiritas.jpg', 'img/tiritas2.jpg', 'Supreme', 'activo'),
(21, 'Palace Pal Ice Tray Tri-Ferg Blue', '65.00', 'La marca de streetwear Palace nos sorprendió con este accesorio, podrás tener el logo de la marca hasta en la bebida!', 30, 'Unica', 'Azul', 'accesorios', 'Accesorios', 'img/palice.jpg', 'img/palice2.jpg', 'Palace', 'activo'),
(22, 'BAPE ABC Camo Japanese Fan Green', '150.00', 'Bape, la marca japonesa, hace una especie de homenaje a su tierra sacando a la venta este accesorio, un abanico japones con el print de su camuflaje característico', 10, 'Unica', 'Camo', 'accesorios', 'Accesorios', 'img/abanico.jpg', 'img/abanico2.jpg', 'Bape', 'activo'),
(23, 'Palace adidas Shell Track Top Night Indigo/White', '350.00', 'Chaqueta vintage que pertenece a la colaboración ya consolidada entre las marcas de Adidas y Palace.', 29, 'M', 'Azul Marino', 'ropa', 'Jackets', 'img/palacejacket.jpg', 'img/palacejacket2.jpg', 'Palace', 'activo'),
(24, 'BAPE X adidas ABC Camo Track Jacket Green', '510.00', 'Chaqueta adidas orginals en colaboración con la marca de streetwear japonesa Bape. Presenta las clásicas rayas de la marca alemana y el clásico estampado de camuflaje de Bape. Lanzamiento muy limitado.', 10, 'M', 'Camo', 'ropa', 'Jackets', 'img/adidasBapeJacket.jpg', 'img/adidasBapeJacket2.jpg', 'Adidas', 'activo'),
(25, 'adidas NMD HU Pharrell Human Being Sharp Blue', '600.00', 'El conocido cantante y compositor Pharrel Williams colaboró con Adidas para darle un toque especial a una de siluetas más conocidas, las NMD. Este colourway fue uno de los primeros en salir, ademas de ser de los mas limitados y codiciados.', 4, '45', 'Azul', 'sneakers', 'NMD', 'img/HU.jpg', 'img/HU2.jpg', 'Adidas', 'activo'),
(26, 'Supreme Box Logo Crewneck (FW18) Fluorescent Pink', '508.00', 'Después de un paréntesis de tres años, Supreme regresa con su primer Box Logo Crewneck desde la temporada Otoño / Invierno 2015. Los íconos del box logo de la marca siempre se encuentran entre los lanzamientos de streetwear más buscados del año, aparentemente atrayendo aún más atención cada temporada. La oferta de Supreme Otoño / Invierno 2018 presenta esta combinación de colores junto con otras ocho variaciones de color. Este crewneck se vendió por $ 158 y se lanzó el 6 de diciembre de 2018 durante la caída de la semana 16 de Supreme.', 19, 'L', 'Peach', 'ropa', 'Sudaderas', 'img/crewneck.jpg', 'img/boxlogo2.jpg', 'Supreme', 'activo'),
(27, 'Nike SB Dunk Low Travis Scott', '1120.00', 'Travis Scott se asoció con Nike SB para lanzar su primera zapatilla de skate oficial, la Nike SB Dunk Low Travis Scott. Este diseño sigue una estética de diseño similar a la del Air Force 1 Low Travis Scott Cactus Jack, que presenta una variedad de materiales y estampados. A diferencia de los lanzamientos anteriores de Travis Scott, estos no estaban disponibles en SNKRS y solo estaban disponibles en los proveedores de Nike SB seleccionados.  Esta Nike SB Dunk Low está compuesta por una parte superior de ante con lona de cachemir y capas de franela a cuadros.', 10, '44', 'Beige', 'sneakers', 'Dunk SB', 'img/dunk.jpg', 'img/dunk2.jpg', 'Nike', 'activo'),
(28, 'Dior B23 High Top Logo Oblique', '1140.00', 'Estas zapatillas de la marca de lujo Dior nunca pasarán desapercibidas en tu colección, con un estilo &quot;converse&quot; y el logotipo de dior por toda la zapatilla &quot;transparente&quot; se ha convertido en una de las zapatillas mas deseadas de este año.', 19, '43', 'Blanco', 'sneakers', 'Dior', 'img/dior.jpg', 'img/dior2.jpg', 'Dior', 'activo'),
(29, 'Supreme Steiff Bear Heather Grey', '200.00', 'Uno de los accesorios Supreme más buscados de la temporada Otoño / Invierno 2018, Supreme lanzó este Steiff Bear el 20 de diciembre de 2018 por un precio minorista de $ 178. El oso Elmar presenta un relleno sintético y se pone una sudadera con capucha clásica con el logotipo de la caja en rojo sobre gris jaspeado hecha de algodón. El oso se agotó inmediatamente tanto en línea como en las tiendas Supreme a nivel mundial. Steiff se anuncia a sí mismo como el inventor del oso de peluche, y ha estado fabricando osos en Alemania durante más de 100 años. Cómpralo hoy para comprar este accesorio único de un dúo de potencias de la industria.', 30, 'Unica', 'Gris', 'accesorios', 'Accesorios', 'img/steiff.jpg', 'img/steiff2.png', 'Supreme', 'activo'),
(30, 'Comme des Garçons wallet logo', '92.00', 'Logotipo de la cartera Comme des Garcons en negro. A toda velocidad para la logomanía esta temporada, la marca japonesa Comme des Garcons presenta esta billetera monocromática para su colección. La solución de almacenamiento de dinero está estampada audazmente en el frente y el reverso con el apodo de la marca y ha sido elaborada lujosamente en España con cuero de vaca.', 77, 'Unica', 'Negro', 'accesorios', 'Accesorios', 'img/cdgpouch.jpg', 'img/cdgpouch2.jpg', 'CDG', 'activo');

-- --------------------------------------------------------

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

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`user`, `password`, `permisos`) VALUES
('admin', '$2y$10$hSk3b.WL6CWTalvtquJKVuyxW6EM6W6kNanvNmTiF56whNQoSa.tC', 'administrador'),
('begooo03', '$2y$10$N4hO8qGqUfawr0sNZGbaHOHVRQpnhUSYDWUgx33tObTCHrB1KqfKK', 'usuario'),
('casado99', '$2y$10$5cIV.IKyNoSX.ZsjGQcK.ushmAl30P02Cx8gcuCtZ9BgWaJaDPqRe', 'usuario'),
('danidassler', '$2y$10$2jFX4Z5ni4Y/mN8VGiDQsu33KdKdUURNgJSWsoZZmTiJiniVp7lI2', 'usuario'),
('paulaPM', '$2y$10$PeUs9NA2MA8lyM7RV5Huau5ETHnM./IztQUFf3bpz6HuPbXUc5iBi', 'usuario'),
('yisasElBueno', '$2y$10$X35Ng.aS93B8gHLzgVsUze90sUMf6NajdXQBd0jK3HH1tvBgPng0.', 'usuario');

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
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`idValoracion`, `idProducto`, `puntuacion`, `user`, `visibilidad`) VALUES
(1, 16, 5, 'paulaPM', 'activo'),
(2, 13, 4, 'paulaPM', 'activo'),
(3, 29, 5, 'paulaPM', 'activo'),
(4, 5, 5, 'danidassler', 'activo'),
(5, 26, 4, 'danidassler', 'activo'),
(6, 29, 5, 'danidassler', 'activo'),
(7, 21, 5, 'danidassler', 'activo'),
(8, 19, 5, 'danidassler', 'activo'),
(9, 27, 3, 'danidassler', 'activo'),
(10, 3, 2, 'casado99', 'activo'),
(11, 15, 4, 'casado99', 'activo'),
(12, 23, 5, 'casado99', 'activo'),
(13, 19, 4, 'casado99', 'activo'),
(14, 24, 5, 'casado99', 'activo'),
(15, 9, 5, 'casado99', 'activo'),
(16, 22, 2, 'casado99', 'activo'),
(17, 4, 4, 'yisasElBueno', 'activo'),
(18, 7, 1, 'yisasElBueno', 'activo'),
(19, 6, 3, 'yisasElBueno', 'activo'),
(20, 14, 5, 'yisasElBueno', 'activo'),
(21, 20, 2, 'yisasElBueno', 'activo'),
(22, 9, 4, 'yisasElBueno', 'activo'),
(23, 11, 5, 'yisasElBueno', 'activo'),
(24, 24, 4, 'yisasElBueno', 'activo'),
(25, 30, 4, 'yisasElBueno', 'activo'),
(26, 3, 5, 'yisasElBueno', 'activo'),
(27, 26, 5, 'yisasElBueno', 'activo'),
(28, 2, 4, 'yisasElBueno', 'activo'),
(29, 17, 5, 'begooo03', 'activo'),
(30, 13, 5, 'begooo03', 'activo'),
(31, 20, 4, 'begooo03', 'activo'),
(32, 12, 5, 'begooo03', 'activo'),
(33, 16, 5, 'begooo03', 'activo'),
(34, 26, 5, 'begooo03', 'activo'),
(35, 25, 5, 'begooo03', 'activo'),
(36, 10, 3, 'begooo03', 'activo'),
(37, 28, 5, 'begooo03', 'activo'),
(38, 24, 2, 'begooo03', 'activo'),
(39, 21, 4, 'begooo03', 'activo'),
(40, 2, 5, 'begooo03', 'activo'),
(41, 5, 5, 'danidassler', 'activo'),
(42, 2, 4, 'danidassler', 'activo'),
(43, 2, 3, 'paulaPM', 'activo'),
(44, 26, 4, 'paulaPM', 'activo'),
(45, 24, 4, 'paulaPM', 'activo'),
(46, 7, 4, 'casado99', 'activo'),
(47, 5, 4, 'casado99', 'activo'),
(48, 5, 3, 'begooo03', 'activo'),
(49, 29, 4, 'begooo03', 'activo'),
(50, 3, 4, 'begooo03', 'activo');

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`IdVenta`, `fecha`, `precioTotal`, `user`) VALUES
(1, '2020-04-27', '243.60', 'danidassler'),
(2, '2020-04-27', '243.60', 'danidassler'),
(3, '2020-05-02', '342.20', 'casado99'),
(4, '2020-05-05', '2726.00', 'danidassler'),
(5, '2020-05-07', '1537.00', 'begooo03'),
(6, '2020-05-07', '1911.68', 'paulaPM'),
(7, '2020-05-07', '106.72', 'paulaPM'),
(8, '2020-05-07', '1119.40', 'yisasElBueno'),
(9, '2020-05-07', '320.16', 'yisasElBueno'),
(10, '2020-05-07', '2366.40', 'danidassler'),
(11, '2020-05-07', '734.28', 'danidassler'),
(12, '2020-05-07', '17.40', 'casado99'),
(13, '2020-05-07', '106.72', 'casado99');

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `ventaproducto`
--

INSERT INTO `ventaproducto` (`IdVenta`, `idProducto`, `unidades`) VALUES
(1, 4, 1),
(2, 4, 1),
(3, 4, 1),
(3, 9, 1),
(4, 2, 1),
(4, 3, 1),
(4, 4, 1),
(5, 17, 1),
(5, 25, 1),
(5, 30, 1),
(6, 26, 1),
(6, 28, 1),
(7, 30, 1),
(8, 4, 1),
(8, 12, 1),
(8, 20, 2),
(9, 15, 2),
(10, 4, 1),
(10, 12, 1),
(10, 14, 1),
(10, 16, 1),
(10, 23, 1),
(11, 17, 1),
(12, 20, 1),
(13, 30, 1);

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
