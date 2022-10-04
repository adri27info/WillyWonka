-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2022 a las 20:03:19
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `willywonka`
--

create database willywonka;

use willywonka;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bot`
--

CREATE TABLE `bot` (
  `id_bot` int(11) NOT NULL,
  `!ayuda` text NOT NULL,
  `!ajustes` varchar(100) NOT NULL,
  `!puntos` varchar(100) NOT NULL,
  `!chocolates` varchar(100) NOT NULL,
  `!golosinas` varchar(100) NOT NULL,
  `!caramelos` varchar(100) NOT NULL,
  `!nubes` varchar(100) NOT NULL,
  `!regalizes` varchar(100) NOT NULL,
  `!chicles` varchar(100) NOT NULL,
  `!aperitivos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bot`
--

INSERT INTO `bot` (`id_bot`, `!ayuda`, `!ajustes`, `!puntos`, `!chocolates`, `!golosinas`, `!caramelos`, `!nubes`, `!regalizes`, `!chicles`, `!aperitivos`) VALUES
(1, 'Hola bienvenido me llamo Ratchet y te voy a dejar por aquí en este mensaje, los siguientes comandos que podras utilizar en este chat para pedir información, etc:\n\n1: !ajutes 2: !puntos 3: !chocolate 4: !golosinas 5: !caramelos 6: !nubes 7: !regalizes 8: !chicles 9: !aperitivos 10: !ayuda\n\nEstos comandos proporcionarán información de ayuda, sobre la página en la que se encuentran las características que buscas.  Nada más y si tienes alguna duda, escribe el comando !ayuda y te volveré a mostrar los comandos citados.', 'ajustes.php', 'puntos.php', 'chocolates.php', 'golosinas.php', 'caramelos.php', 'nubes.php', 'regalizes.php', 'chicles.php', 'aperitivos.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'Chocolate'),
(2, 'Golosinas'),
(3, 'Caramelos'),
(4, 'Nubes'),
(5, 'Regalizes'),
(6, 'Chicles'),
(7, 'Aperitivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexion`
--

CREATE TABLE `conexion` (
  `id_conexion` int(11) NOT NULL,
  `estado_conexion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `conexion`
--

INSERT INTO `conexion` (`id_conexion`, `estado_conexion`) VALUES
(1, 'Conectado'),
(2, 'Desconectado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_compra` varchar(50) NOT NULL,
  `hora_compra` varchar(50) NOT NULL,
  `json_carrito` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio_producto` float NOT NULL,
  `unidades_producto` int(11) NOT NULL,
  `descripcion_producto` varchar(255) NOT NULL,
  `puntos_asignados` int(11) NOT NULL,
  `img_producto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `nombre_producto`, `precio_producto`, `unidades_producto`, `descripcion_producto`, `puntos_asignados`, `img_producto`) VALUES
(1, 1, 'Chips Ahoy', 10, 100, 'Chips Ahoy', 10, 'chips-ahoy.jpg'),
(2, 1, 'Barquillo Bicacao', 2.5, 10, 'Barquillo Bicacao', 20, 'barquillo-bicacao.jpg'),
(3, 1, 'Bolsa Bombon', 2, 10, 'Bolsa Bombon', 20, 'bolsa-bombon.jpg'),
(4, 1, 'Bombon de capsula', 1.8, 10, 'Bombon de capsula', 20, 'bombon-capsula-chocolate.jpg'),
(5, 1, 'Chococranch dulce azul', 3, 10, 'Chococranch dulce azul', 20, 'chococranch-deluxe-azul-bombonera.jpg'),
(6, 1, 'Chococranch dulce blanco', 3, 10, 'Chococranch dulce blanco', 20, 'chococranch-deluxe-blanco-bombonera.jpg'),
(7, 1, 'Chococranch dulce dorado', 3, 10, 'Chococranch dulce dorado', 20, 'chococranch-deluxe-dorado-bombonera.jpg'),
(8, 1, 'Corazon de chocolate con leche', 2.5, 10, 'Corazon de chocolate con leche', 20, 'corazones-chocolate-con-leche.jpg'),
(9, 1, 'Duplo', 3, 10, 'Duplo', 20, 'duplo.jpg'),
(10, 1, 'Estuche de reyes', 4.2, 10, 'Estuche de reyes', 20, 'estuche-3-reyes-una.jpg'),
(11, 1, 'Ferrero prestige', 7, 10, 'Ferrero prestige', 20, 'ferrero-prestige.jpg'),
(12, 1, 'Figura cava kinder', 2, 10, 'Figura cava kinder', 20, 'figura-cava-kinder.jpg'),
(13, 1, 'Huevo kinder sorpresa maxi', 3.5, 10, 'Huevo kinder sorpresa maxi', 20, 'huevo-kinder-sorpresa-maxi.jpg'),
(14, 1, 'Huevo chocobattle', 3.5, 10, 'Huevo chocobattle', 20, 'huevos-chocobattle-superzings.jpg'),
(15, 1, 'Huevo chocolate masha y el oso', 5, 10, 'Huevo chocolate masha y el oso', 20, 'huevos-chocolate-masha-y-el-oso.jpg'),
(16, 1, 'Huevo chocolate safari', 3, 10, 'Huevo chocolate safari', 20, 'huevos-chocolate-safari.jpg'),
(17, 1, 'Huevo chocolate sorpresa bob esponja', 5.5, 10, 'Huevo chocolate sorpresa bob esponja', 20, 'huevos-chocolate-sorpresa-bob-esponja.jpg'),
(18, 1, 'Huevo chocolate sorpresa hello kitty', 5.5, 10, 'Huevo chocolate sorpresa hello kitty', 20, 'huevos-chocolate-sorpresa-hello-kitty.jpg'),
(19, 1, 'Huevo chocolate sorpresa looney tunes', 5.5, 10, 'Huevo chocolate sorpresa looney tunes', 20, 'huevos-chocolate-sorpresa-looney-tunes.jpg'),
(20, 1, 'Huevo chocolate sorpresa princesas', 5.5, 10, 'Huevo chocolate sorpresa princesas', 20, 'huevos-chocolate-sorpresa-princesas.jpg'),
(21, 1, 'Huevo chocolate sorpresa unicornio', 5.5, 10, 'Huevo chocolate sorpresa unicornio', 20, 'huevos-de-chocolate-sorpresa-unicornio.jpg'),
(22, 1, 'Kinder bueno dark', 3.5, 10, 'Kinder bueno dark', 20, 'kinder-bueno-dark.jpg'),
(23, 1, 'Kinder chocolate con cereales', 3.5, 10, 'Kinder chocolate con cereales', 20, 'kinder-chocolate-con-cereales.jpg'),
(24, 1, 'Kinder mini bueno', 3.5, 10, 'Kinder mini bueno', 20, 'kinder-mini-bueno.jpg'),
(25, 1, 'Kinder mini bueno', 3.5, 10, 'Kinder mini bueno', 20, 'kinder-mini-bueno.jpg'),
(26, 1, 'Kinder shokobon', 3.5, 10, 'Kinder shokobon', 20, 'kinder-shokobons.jpg'),
(27, 1, 'Kit kat', 2.5, 10, 'Kit kat', 20, 'kit-kat.jpg'),
(28, 1, 'Kit kat blanco', 3.5, 10, 'Kit kat blanco', 20, 'kit-kat-blanco.jpg'),
(29, 1, 'Kit kat chunky', 3.5, 10, 'Kit kat chunky', 20, 'kit-kat-chunky.jpg'),
(30, 1, 'Kit kat dark', 3.5, 10, 'Kit kat dark', 20, 'kit-kat-dark.jpg'),
(31, 1, 'Kranch', 2, 10, 'Kranch', 20, 'kranch-color.jpg'),
(32, 1, 'Lacasitos gold', 3, 10, 'Lacasitos gold', 20, 'lacasitos2-gold.jpg'),
(33, 1, 'Lacasitos blanco', 2, 10, 'Lacasitos blanco', 20, 'lacasitos-blanco.jpg'),
(34, 1, 'Lacasitos golden', 3, 10, 'Lacasitos golden', 20, 'lacasitos-gold.jpg'),
(35, 1, 'Lata corazon piolin', 3, 10, 'Lata corazon piolin', 20, 'lata-corazon-piolin.jpg'),
(36, 1, 'Malteser', 4, 10, 'Malteser', 20, 'malteser-single.jpg'),
(37, 1, 'Mars', 2, 10, 'Mars', 20, 'mars-single.jpg'),
(38, 1, 'Milka avellanas enteras', 3.5, 10, 'Milka avellanas enteras', 20, 'milka-avellanas-enteras.jpg'),
(39, 1, 'Milka caramelo', 3.5, 10, 'Milka caramelo', 20, 'milka-caramelo.jpg'),
(40, 1, 'Milka chocogalleta', 3.5, 10, 'Milka chocogalleta', 20, 'milka-chocogalleta.jpg'),
(41, 1, 'Milka oreo sandwich', 3.5, 10, 'Milka oreo sandwich', 20, 'milka-oreo-sandwich.jpg'),
(42, 1, 'Milka triple choco', 3.5, 10, 'Milka triple choco', 20, 'milka-triple-choco.jpg'),
(43, 1, 'MMs cacahuetes', 4.5, 10, 'MMs cacahuetes', 20, 'mms-cacahuete.jpg'),
(44, 1, 'Mon cheri', 8, 10, 'Mon cheri', 20, 'mon-cheri.jpg'),
(45, 1, 'Moneda Super things', 2.2, 10, 'Moneda Super things', 20, 'moneda-super-things-38-mm.jpg'),
(46, 1, 'Nutella', 3, 10, 'Nutella', 20, 'nutella-200-grs.jpg'),
(47, 1, 'Nutella b ready', 5, 10, 'Nutella b ready', 20, 'nutella-b-ready.jpg'),
(48, 1, 'Prestige', 12, 10, 'Prestige', 20, 'prestige.jpg'),
(49, 1, 'Rafaello', 5, 10, 'Rafaello', 20, 'rafaello.jpg'),
(50, 1, 'Toblerone', 3.3, 10, 'Toblerone', 20, 'toblerone.jpg'),
(51, 2, 'American pizza', 0.7, 10, 'American pizza', 30, 'american-pizza.jpg'),
(52, 2, 'Arlequin pica', 0.25, 10, 'Arlequin pica', 30, 'arlequin-pica.jpg'),
(53, 2, 'Ataud', 0.5, 10, 'Ataud', 30, 'ataud.jpg'),
(54, 2, 'Bananas', 0.1, 10, 'Bananas', 30, 'bananas.jpg'),
(55, 2, 'Bananas rojas', 0.3, 10, 'Bananas rojas', 30, 'bananas-rojas-azucar.jpg'),
(56, 2, 'Blob', 1, 10, 'Blob', 30, 'blob.jpg'),
(57, 2, 'Bolsa cumpleaños', 2.5, 10, 'Bolsa cumpleaños', 30, 'bolsa-cumpleanos.jpg'),
(58, 2, 'Bolsa de chuches cono', 1.5, 10, 'Bolsa Bolsa de chuches cono', 30, 'bolsa-de-chuches-cono.jpg'),
(59, 2, 'Botellitas de cola', 2, 10, 'Botellitas de cola', 30, 'botella-cola.jpg'),
(60, 2, 'Canas de fresa pìcante', 1.2, 10, 'Canas de fresa pìcante', 30, 'canas-fresa-pica-envueltas.jpg'),
(61, 2, 'Canas de sandia pìcante', 1.2, 10, 'Canas de sandia pìcante', 30, 'canas-sandia-pica-envueltas.jpg'),
(62, 2, 'Canas super straws', 1.2, 10, 'Canas super straws', 30, 'canas-super-straws.jpg'),
(63, 2, 'Chelines tutti fruti', 2, 10, 'Chelines tutti fruti', 30, 'chelines-tutti-fruti-con-zumo.jpg'),
(64, 2, 'Chiles picantes', 0.8, 10, 'Chiles picantes', 30, 'chiles-picantes.jpg'),
(65, 2, 'Corazon de azucar', 0.2, 10, 'Corazon de azucar', 30, 'corazon-corazon-azucar.jpg'),
(66, 2, 'Corazon relleno de picante', 0.35, 10, 'Corazon relleno de picante', 30, 'corazones-rellenos-pica-shiny.jpg'),
(67, 2, 'Dedos picantes', 1.75, 10, 'Dedos picantes', 30, 'dedos-pica-bolsa-250-unidades.jpg'),
(68, 2, 'Delisuit de botellas de naranja', 2, 10, 'Delisuit de botellas de naranja', 30, 'delisuit-botellas-naranja-pica.jpg'),
(69, 2, 'Dentaduras', 0.2, 10, 'Dentaduras', 30, 'dentaduras-foam.jpg'),
(70, 2, 'Finipalo de fresa', 0.5, 10, 'Finipalo de fresa', 30, 'finipalo-fresa-tapa.jpg'),
(71, 2, 'Flanin jelly', 0.3, 10, 'Flanin jelly', 30, 'flanin-jelly-light.jpg'),
(72, 2, 'Flores rellenas picantes', 0.6, 10, 'Flores rellenas picantes', 30, 'flores-rellenas-pica-pica.jpg'),
(73, 2, 'Flores silvestres', 0.2, 10, 'Flores silvestres', 30, 'fresas-silvestres-brillo.jpg'),
(74, 2, 'Fresones picantes', 0.6, 10, 'Fresones picantes', 30, 'fresones-pica.jpg'),
(75, 2, 'Frutas grandes', 0.1, 10, 'Frutas grandes', 30, 'frutas-grandes-ceconsa.jpg'),
(76, 2, 'Frutman de arco iris', 1.5, 10, 'Frutman de arco iris', 30, 'frutman-xxl-arco-iris-pica.jpg'),
(77, 2, 'Frutman de arco iris brillante', 1.5, 10, 'Frutman de arco iris brillante', 30, 'frutman-xxxl-arco-iris-brillo.jpg'),
(78, 2, 'Sandias gomillenas', 0.2, 10, 'Sandias gomillenas', 30, 'gomillenas-sandia.jpg'),
(79, 2, 'Gummy candy', 0.5, 10, 'Gummy candy', 30, 'gummy-candy-sweet-tarro-800-gr.jpg'),
(80, 2, 'Gummy jellys', 0.5, 10, 'Gummy jellys', 30, 'gummy-jellys.jpg'),
(81, 2, 'Huevos fritos', 0.2, 10, 'Huevos fritos', 30, 'huevos-fritos-brillo-bolsa-250-unidades.jpg'),
(82, 2, 'Lengua de cocacola', 0.3, 10, 'Lengua de cocacola', 30, 'lenguas-cola.jpg'),
(83, 2, 'Loros negros', 0.5, 10, 'Loros negros', 30, 'loros-negros-brillo.jpg'),
(84, 2, 'Maxicavernicola', 1.5, 10, 'Maxicavernicola', 30, 'maxicavernicola-bolsa-1-kg.jpg'),
(85, 2, 'Maxi fresa', 0.5, 10, 'Maxi fresa', 30, 'maxi-fresas-pica.jpg'),
(86, 2, 'Maxi relleno de sandia picante', 1, 10, 'Maxi relleno de sandia picante', 30, 'maxi-rellepica-sandia-tapa.jpg'),
(87, 2, 'Melocotones de azucar', 0.2, 10, 'Melocotones de azucar', 30, 'melocoton-azucar.jpg'),
(88, 2, 'Mini frutas surtidas', 2, 10, 'Mini frutas surtidas', 30, 'mini-frutas-surtidas.jpg'),
(89, 2, 'Mini minimax', 2, 10, 'Mini minimax', 30, 'mini-minimax.jpg'),
(90, 2, 'Morritos almidon', 0.2, 10, 'Morritos almidon', 30, 'morritos-almidon-bolsa-250-unidades.jpg'),
(91, 2, 'Osos grandes de azucar', 0.2, 10, 'Osos grandes de azucar', 30, 'osos-azucar-grande.jpg'),
(92, 2, 'Osos pequeños de azucar', 0.1, 10, 'Osos pequeños de azucar', 30, 'osos-azucar-pequeno.jpg'),
(93, 2, 'Osos gigantes brillantes', 0.5, 10, 'Osos gigantes brillantes', 30, 'osos-gigantes-brillo.jpg'),
(94, 2, 'Parisinas con azucar', 0.5, 10, 'Parisinas con azucar', 30, 'parisinas-con-azucar.jpg'),
(95, 2, 'Lagartos de phantasia', 1, 10, 'Lagartos de phantasia', 30, 'phantasia.jpg'),
(96, 2, 'Pizza', 0.3, 10, 'Pizza', 30, 'pizza.jpg'),
(97, 2, 'Platanos con azucar', 0.1, 10, 'Platanos con azucar', 30, 'platanos-azucar.jpg'),
(98, 2, 'Ranas tropicales', 0.1, 10, 'Ranas tropicales', 30, 'ranas-tropic-rellenas.jpg'),
(99, 2, 'Sandias rellenas', 0.5, 10, 'Sandias rellenas', 30, 'sandias-rellenas.jpg'),
(100, 2, 'Tartas rellenas', 0.6, 10, 'Tartas rellenas', 30, 'tartas-rellenas-65-unidades.jpg'),
(101, 3, 'Bolsa de cumpleaños', 2, 10, 'Bolsa de cumpleaños', 40, 'bolsa-cumpleanos.jpg'),
(102, 3, 'Bolsa de chucherias', 1, 10, 'Bolsa de chucherias', 40, 'bolsa-de-chuches-cono.jpg'),
(103, 3, 'Boum dip', 3, 10, 'Boum dip', 40, 'boum-dip-n-roll.jpg'),
(104, 3, 'Cafe dry', 1, 10, 'Cafe dry', 40, 'cafe-dry-creme-sin-azucar.jpg'),
(105, 3, 'Caramelo nazareno', 0.5, 10, 'Caramelo nazareno', 40, 'caramelo-nazareno.jpg'),
(106, 3, 'Caramelo relleno de miel', 0.2, 10, 'Caramelo relleno de miel', 40, 'caramelo-relleno-de-miel.jpg'),
(107, 3, 'Caramelo nimm', 0.5, 10, 'Caramelo nimm', 40, 'caramelos-masticables-rellenos-nimm2.jpg'),
(108, 3, 'Caramelo partys', 0.2, 10, 'Caramelo partys', 40, 'caramelos-partys.jpg'),
(109, 3, 'Caramelo cuba libre', 0.2, 10, 'Caramelo cuba libre', 40, 'carmelo-cuba-libre.jpg'),
(110, 3, 'Chelines de sandia', 0.4, 10, 'Chelines de sandia', 40, 'chelines-sandia-sin-azucar.jpg'),
(111, 3, 'Chicles de huevo de toro', 0.5, 10, 'Chicles de huevo de toro', 40, 'chicle-huevos-de-toro.jpg'),
(112, 3, 'Chupa chus surprise', 1.2, 10, 'Chupa chus surprise', 40, 'chupa-chups-surprise-pj-mask-estuche-16-unidades.jpg'),
(113, 3, 'Chicles de cola light', 0.6, 10, 'Chicles de cola light', 40, 'cola-light-sin-azucar.jpg'),
(114, 3, 'Corazon de solano', 0.3, 10, 'Corazon de solano', 40, 'corazon-de-solano-sin-azucar.jpg'),
(115, 3, 'Dipper manzana', 0.5, 10, 'Dipper manzana', 40, 'dipper-xl-pinta-manzana-estuche-100-unidades.jpg'),
(116, 3, 'Finiboom', 2.5, 10, 'Finiboom', 40, 'finiboom-gum.jpg'),
(117, 3, 'Fisherman', 0.7, 10, 'Fisherman', 40, 'fisherman-sin-azucar.jpg'),
(118, 3, 'Floppy de colores', 1, 10, 'Floppy de colores', 40, 'floppy-colores.jpg'),
(119, 3, 'Fruits toy story', 2, 10, 'Fruits toy story', 40, 'fruit-snacks-betty-toy-story-4.jpg'),
(120, 3, 'Fruits betty de toy story', 2, 10, 'Fruits betty de toy story', 40, 'fruit-snacks-ventilador-betty-toy-story-4.jpg'),
(121, 3, 'Fruits buzz de toy story', 2, 10, 'Fruits betty de toy story', 40, 'fruit-snacks-ventilador-buzz-toy-story-4.jpg'),
(122, 3, 'Fruits woody de toy story', 2, 10, 'Fruits woody de toy story', 40, 'fruit-snacks-ventilador-woody-toy-story-4.jpg'),
(123, 3, 'Fruits woody 2 de toy story', 2, 10, 'Fruits woody 2 de toy story', 40, 'fruit-snacks-woody-toy-story-4.jpg'),
(124, 3, 'Fun fruit spiderman', 2, 10, 'Fun fruit spiderman', 40, 'fun-fruit-spiderman-action-set.jpg'),
(125, 3, 'Halls vita', 1.2, 10, 'Halls vita', 40, 'halls-vita-c-surtido.jpg'),
(126, 3, 'Huevos de dinosaurio', 2.5, 10, 'Huevos de dinosaurio', 40, 'huevos-dino-envase-chicle.jpg'),
(127, 3, 'Hung chaku', 4, 10, 'Hung chaku', 40, 'kung-chaku.jpg'),
(128, 3, 'Light trompeta', 1.2, 10, 'Light trompeta', 40, 'light-trompeta.jpg'),
(129, 3, 'Mentitas', 0.2, 10, 'Mentitas', 40, 'mentitas.jpg'),
(130, 3, 'Mentolin de regaliz', 0.5, 10, 'Mentolin de regaliz', 40, 'mentolin-regaliz-sin-azucar.jpg'),
(131, 3, 'Mentolin sin azucar', 0.5, 10, 'Mentolin sin azucar', 40, 'mentolin-sin-azucar.jpg'),
(132, 3, 'Paletillas pequeñas', 0.25, 10, 'Paletillas pequeñas', 40, 'paleta-pequena.jpg'),
(133, 3, 'Peladillas', 0.5, 10, 'Peladillas', 40, 'peladillas.jpg'),
(134, 3, 'Peladillas de colores', 0.6, 10, 'Peladillas de colores', 40, 'peladillas-de-colores.jpg'),
(135, 3, 'Pictolin de cereza y nata', 0.6, 10, 'Pictolin de cereza y nata', 40, 'pictolin-cereza-y-nata-sin-azucar.jpg'),
(136, 3, 'Pictolin de regaliz', 1, 10, 'Pictolin de regaliz', 40, 'pictolin-regaliz.jpg'),
(137, 3, 'Pictolin de regaliz y nata', 1, 10, 'Pictolin de regaliz y nata', 40, 'pictolin-regaliz-y-nata.jpg'),
(138, 3, 'Piruleta mini corazon', 0.2, 10, 'Piruleta mini corazon', 40, 'piruleta-mini-corazon.jpg'),
(139, 3, 'Piruleta iris pequeña', 0.5, 10, 'Piruleta iris pequeña', 40, 'piruli-iris-pequena.jpg'),
(140, 3, 'Regaliz respiral', 1, 10, 'Regaliz respiral', 40, 'respiral-regaliz.jpg'),
(141, 3, 'Regaliz respiral sin azucar', 1, 10, 'Regaliz respiral sin azucar', 40, 'respiral-sin-azucar.jpg'),
(142, 3, 'Snot licker', 2, 10, 'Snot licker', 40, 'snot-licker.jpg'),
(143, 3, 'Solano capuchino', 1, 10, 'Solano capuchino', 40, 'solano-capuchino-sin-azucar.jpg'),
(144, 3, 'Solano fresa de nata', 1, 10, 'Solano fresa de nata', 40, 'solano-fresa-nata-sin-azucar.jpg'),
(145, 3, 'Solano menta de nata', 1, 10, 'Solano menta de nata', 40, 'solano-menta-nata-sin-azucar.jpg'),
(146, 3, 'Solano de mouse de limon', 1, 10, 'Solano de mouse de limon', 40, 'solano-mousse-limon-sin-azucar.jpg'),
(147, 3, 'Sparkling', 2, 10, 'Sparkling', 40, 'sparkling.jpg'),
(148, 3, 'Spray nfizz', 1.5, 10, 'Spray nfizz', 40, 'spray-n-fizz.jpg'),
(149, 3, 'Supergun de frambuesa', 1, 10, 'Supergun de frambuesa', 40, 'supergum-frambuesa.jpg'),
(150, 3, 'Weathers original', 3, 10, 'Weathers original', 40, 'werthers-original-blando.jpg'),
(151, 4, 'Estriado envuelto', 0.2, 10, 'Estriado envuelto', 50, 'estriado-envuelto.jpg'),
(152, 4, 'Finitronc envuelto', 0.2, 10, 'Finitronc envuelto', 50, 'finitronc-estriado.jpg'),
(153, 4, 'Finitronc de flores', 0.3, 10, 'Finitronc de flores', 50, 'finitronc-flores.jpg'),
(154, 4, 'Finitronc de osos bicolores', 0.4, 10, 'Finitronc de osos bicolores', 50, 'finitronc-osos-bicolor.jpg'),
(155, 4, 'Heladitos', 0.2, 10, 'Heladitos', 50, 'heladitos.jpg'),
(156, 4, 'Marshmallows de mariposas rosas', 1, 10, 'Marshmallows de mariposas rosas', 50, 'marshmallows-mariposas-rosas.jpg'),
(157, 4, 'Marshmallows de barbacoa', 1, 10, 'Marshmallows de barbacoa', 50, 'marsmallow-barbacoa.jpg'),
(158, 4, 'Marshmallows de mariposas azules', 1, 10, 'Marshmallows de mariposas azules', 50, 'mashmallow-mariposas-azules.jpg'),
(159, 4, 'Mini heladitos', 0.8, 10, 'Mini heladitos', 50, 'mini-heladitos.jpg'),
(160, 4, 'Nubes lisas', 0.4, 10, 'Nubes lisas', 50, 'nubes-lisas.jpg'),
(161, 4, 'Nubes trenzadas tutifruti', 0.8, 10, 'Nubes trenzadas tutifruti', 50, 'nubes-trenzadas-tutifrut.jpg'),
(162, 4, 'Platanos', 0.2, 10, 'Platanos', 50, 'platanos.jpg'),
(163, 4, 'Nubes moradas', 0.3, 10, 'Nubes moradas', 50, 'top-mallow-lila-sin-envolver.jpg'),
(164, 4, 'Nubes negras', 0.3, 10, 'Nubes negras', 50, 'top-mallow-negro-sin-envolver.jpg'),
(165, 4, 'Nubes blancas', 0.3, 10, 'Nubes blancas', 50, 'top-mallows-blanco.jpg'),
(166, 4, 'Nubes de limon', 0.3, 10, 'Nubes de limon', 50, 'top-mallows-limon.jpg'),
(167, 4, 'Nubes de naranja', 0.3, 10, 'Nubes de naranja', 50, 'top-mallows-rojo.jpg'),
(168, 4, 'Mallows de lisas envueltas', 1, 10, 'Mallows de lisas envueltas', 50, 'top-mallows-lisas-envueltas.jpg'),
(169, 4, 'Mallows surtido de lisas envueltas', 2, 10, 'Mallows surtido de lisas envueltas', 50, 'top-mallow-surtido-envuelto.jpg'),
(170, 4, 'Tornado', 3, 10, 'Tornado', 50, 'tornado.jpg'),
(171, 5, 'Fini roller de fantasia', 0.5, 10, 'Fini roller de fantasia', 60, 'fini-roller-fantasia.jpg'),
(172, 5, 'Fini roller de fresa', 0.5, 10, 'Fini roller de fresa', 60, 'fini-roller-fresa.jpg'),
(173, 5, 'Jumbos de nata de fresa', 0.3, 10, 'Jumbos de nata de fresa', 60, 'jumbos-nata-fresa.jpg'),
(174, 5, 'Jumbos picantes de fresa', 0.4, 10, 'Jumbos picantes de fresa', 60, 'jumbos-pica-fresa.jpg'),
(175, 5, 'Jumbos de sandia', 0.5, 10, 'Jumbos de sandia', 60, 'jumbos-sandia-brillo.jpg'),
(176, 5, 'Jumbos tornado', 0.5, 10, 'Jumbos tornado', 60, 'jumbos-tornado-6-brillo.jpg'),
(177, 5, 'Jumbos tornado brillo', 0.7, 9, 'Jumbos tornado brillo', 60, 'jumbos-tornado-brillo-fini.jpg'),
(178, 5, 'Ladrillazo de fambruesa', 1.5, 10, 'Ladrillazo de fambruesa', 60, 'ladrillazo-frambuesa-brillo.jpg'),
(179, 5, 'Ladrillazo de fambruesa picante', 1.6, 10, 'Ladrillazo de fambruesa picante', 60, 'ladrillazo-pica-frambuesa.jpg'),
(180, 5, 'Lengua multifruti', 0.4, 10, 'Lengua multifruti', 60, 'lenguas-multifruit.jpg'),
(181, 5, 'Lengua de sandia picante', 0.7, 10, 'Lengua de sandia picante', 60, 'lenguas-sandia-pica.jpg'),
(182, 5, 'Maxi rellenos de fresa', 0.3, 10, 'Maxi rellenos de fresa', 60, 'maxi-rellenos-fresa-70-unidades.jpg'),
(183, 5, 'Maxi rellenos de fresa tarrones', 1, 10, 'Maxi rellenos de fresa tarrones', 60, 'maxi-rellenos-fresa-tarro-75-unidades.jpg'),
(184, 5, 'Mega torcidas rojas', 1.4, 10, 'Mega torcidas rojas', 60, 'mega-torcida-roja.jpg'),
(185, 5, 'Regalize big pepe', 0.9, 10, 'Mega torcidas rojas', 60, 'regaliz-big-pepe.jpg'),
(186, 5, 'Tornado picante', 0.3, 10, 'Tornado picante', 60, 'rellepica-tornado-6.jpg'),
(187, 5, 'Rolla belta picante', 1, 10, 'Rolla belta picante', 60, 'rolla-belta-pica-fresa.jpg'),
(188, 6, 'Blue explosion', 0.5, 10, 'Blue explosion', 70, 'blue-explosion.jpg'),
(189, 6, 'Bolsa de cumpleaños', 1, 10, 'Bolsa de cumpleaños', 70, 'bolsa-cumpleanos.jpg'),
(190, 6, 'Botones surtidos de chicle', 1, 10, 'Botones surtidos de chicle', 70, 'botones-surtidos-de-chicle.jpg'),
(191, 6, 'Chicle de barril pirata', 0.2, 10, 'Chicle de barril pirata', 70, 'chicle-barril-pirata.jpg'),
(192, 6, 'Chicle 3D fresa', 1.2, 10, 'Chicle 3D fresa', 70, 'chicle-clix-3d-fresa.jpg'),
(193, 6, 'Chicle 3D hierbabuena', 1.2, 10, 'Chicle 3D hierbabuena', 70, 'chicle-clix-3d-hierbabuena.jpg'),
(194, 6, 'Chicle 3D menta', 1.2, 10, 'Chicle 3D menta', 70, 'chicle-clix-3d-menta.jpg'),
(195, 6, 'Chicle 3D sandia', 1.2, 10, 'Chicle 3D sandia', 70, 'chicle-clix-3d-sandia.jpg'),
(196, 6, 'Chicle Clix One fresa', 1, 10, 'Chicle Clix One fresa', 70, 'chicle-clix-one-fresa.jpg'),
(197, 6, 'Chicle Clix One hierbabuena', 1, 10, 'Chicle Clix One hierbabuena', 70, 'chicle-clix-one-hierbabuena.jpg'),
(198, 6, 'Chicle Clix One menta', 1, 10, 'Chicle Clix One menta', 70, 'chicle-clix-one-menta.jpg'),
(199, 6, 'Chicle Clix One mojito', 1, 10, 'Chicle Clix One mojito', 70, 'chicle-clix-one-mojito.jpg'),
(200, 6, 'Chicle Clix One mora frambuesa', 1, 10, 'Chicle Clix One mora frambuesa', 70, 'chicle-clix-one-mora-frambuesa.jpg'),
(201, 6, 'Chicle Clix One passion', 1, 10, 'Chicle Clix One passion', 70, 'chicle-clix-one-passion.jpg'),
(202, 6, 'Chicle Clix One sandia', 1, 10, 'Chicle Clix One sandia', 70, 'chicle-clix-one-sandia.jpg'),
(203, 6, 'Chicle Clix One tropical', 1, 10, 'Chicle Clix One tropical', 70, 'chicle-clix-one-tropical.jpg'),
(204, 6, 'Chicle destroyer', 0.8, 10, 'Chicle destroyer', 70, 'chicle-destroyer.jpg'),
(205, 6, 'Chicle fini burguer', 0.2, 10, 'Chicle fini burguer', 70, 'chicle-fini-burger.jpg'),
(206, 6, 'Chicle de huevo de toro', 0.5, 10, 'Chicle de huevo de toro', 70, 'chicle-huevos-de-toro.jpg'),
(207, 6, 'Chicle klets de fresa', 0.3, 10, 'Chicle klets de fresa', 70, 'chicle-klets-fresa.jpg'),
(208, 6, 'Chicle klets tropical', 0.3, 10, 'Chicle klets tropical', 70, 'chicle-klets-tropical.jpg'),
(209, 6, 'Chicle klets white', 0.3, 10, 'Chicle klets white', 70, 'chicle-klets-white-sin-azucar.jpg'),
(210, 6, 'Chicle melon', 0.3, 10, 'Chicle melon', 70, 'chicle-melon-envuelto.jpg'),
(211, 6, 'Chicle relleno pannafragola', 0.6, 10, 'Chicle relleno pannafragola', 70, 'chicle-relleno-pannafragola.jpg'),
(212, 6, 'Cosmic gum', 0.2, 10, 'Cosmic gum', 70, 'cosmic-gum-tubos.jpg'),
(213, 6, 'Crazy fun conda tatoo', 1, 10, 'Crazy fun conda tatoo', 70, 'crazy-fun-a-conda-tattoo.jpg'),
(214, 6, 'Dubble bubble', 1.5, 10, 'Dubble bubble', 70, 'dubble-bubble-cry-baby.jpg'),
(215, 6, 'Dubble bubble sandia', 1.5, 10, 'Dubble bubble sandia', 70, 'dubble-bubble-sandia.jpg'),
(216, 6, 'Dubble bubble volcano', 1.5, 10, 'Dubble bubble volcano', 70, 'dubble-bubble-volcano.jpg'),
(217, 6, 'Finiboom gum', 0.5, 10, 'Finiboom gum', 70, 'finiboom-gum.jpg'),
(218, 6, 'Finiboom gum chicle', 0.5, 10, 'Finiboom gum chicle', 70, 'finiboom-gum-chicle.jpg'),
(219, 6, 'Five cobalt menta', 1.3, 10, 'Five cobalt menta', 70, 'five-cobalt-menta.jpg'),
(220, 6, 'Five cobalt hierbabuena', 1.3, 10, 'Five cobalt hierbabuena', 70, 'five-electro-hierbabuena.jpg'),
(221, 6, 'Green explosion', 0.4, 10, 'Green explosion', 70, 'green-explosion.jpg'),
(222, 6, 'Happy dent frambuesa', 0.7, 10, 'Happy dent frambuesa', 70, 'happydent-frambuesa-pintalenguas.jpg'),
(223, 6, 'Happy dent sandia', 0.7, 10, 'Happy dent sandia', 70, 'happydent-monopieza-sandia.jpg'),
(224, 6, 'Huevos dino chicle', 1, 10, 'Huevos dino chicle', 70, 'huevos-dino-envase-chicle.jpg'),
(225, 6, 'Megatron de fresa', 0.2, 10, 'Megatron de fresa', 70, 'megatron-gum-fresa.jpg'),
(226, 6, 'Orbit white', 0.6, 10, 'Orbit white', 70, 'orbit-white-menta-suave.jpg'),
(227, 6, 'Pelotas de baloncesto', 0.3, 10, 'Pelotas de baloncesto', 70, 'pelotas-baloncesto-chicle.jpg'),
(228, 6, 'Pica gums de fresa', 0.5, 10, 'Pica gums de fresa', 70, 'pica-gums-fresa.jpg'),
(229, 6, 'Ritmo chicle', 0.3, 10, 'Ritmo chicle', 70, 'ritmo-chicle.jpg'),
(230, 6, 'Supervampiro de sandria', 1, 10, 'Supervampiro de sandria', 70, 'supervampiro-sandia-con-chicle.jpg'),
(231, 6, 'Trident clorofila', 0.8, 10, 'Trident clorofila', 70, 'trident-clorofila-stick.jpg'),
(232, 6, 'Trident fresh hierbabuena', 0.8, 10, 'Trident fresh hierbabuena', 70, 'trident-fresh-hierbabuena-grag.jpg'),
(233, 6, 'Trident max fresa', 0.8, 10, 'Trident max fresa', 70, 'trident-max-fresa.jpg'),
(234, 6, 'Trident senses hierbabuena', 0.8, 10, 'Trident senses hierbabuena', 70, 'trident-senses-hierbabuena.jpg'),
(235, 6, 'Trident senses sandria', 0.8, 10, 'Trident senses sandria', 70, 'trident-senses-sandia-sl.jpg'),
(236, 6, 'Tubble color frambuesa', 2, 10, 'Tubble color frambuesa', 70, 'tubble-color-frambuesa.jpg'),
(237, 6, 'Tubble gum tutti', 2, 10, 'Tubble gum tutti', 70, 'tubble-gum-tutti.jpg'),
(238, 7, 'Almendra frita', 1.2, 10, 'Almendra frita', 80, 'almendra-frita-usa.jpg'),
(239, 7, 'Billetes oblea', 1, 10, 'Billetes oblea', 80, 'billetes-oblea-gigantes.jpg'),
(240, 7, 'Bocabits', 2, 10, 'Bocabits', 80, 'bocabits.jpg'),
(241, 7, 'Bugles 3ds', 2, 10, 'Bugles 3ds', 80, 'bugles-3ds.jpg'),
(242, 7, 'Cacahuete tostado', 1.2, 10, 'Cacahuete tostado', 80, 'cacahuete-tostado-sal.jpg'),
(243, 7, 'Cheetos gusanitos', 0.5, 10, 'Cheetos gusanitos', 80, 'cheetos-gusanitos-sal.jpg'),
(244, 7, 'Cheetos pandilla', 0.5, 10, 'Cheetos pandilla', 80, 'cheetos-pandilla.jpg'),
(245, 7, 'Cocktail tropical', 2, 10, 'Cocktail tropical', 80, 'cocktail-tropical.jpg'),
(246, 7, 'Datiles confitados', 2, 10, 'Datiles confitados', 80, 'datiles-confitados.jpg'),
(247, 7, 'Dona pipa azules', 1, 10, 'Dona pipa azules', 80, 'dona-pipa-azul.jpg'),
(248, 7, 'Dona pipa super', 1, 10, 'Dona pipa super', 80, 'dona-pipa-super.jpg'),
(249, 7, 'Doritos texmex', 1, 10, 'Doritos texmex', 80, 'doritos-tex-mex.jpg'),
(250, 7, 'Fritos barbacoa', 0.6, 10, 'Fritos barbacoa', 80, 'fritos-barbacoa.jpg'),
(251, 7, 'Kikonazo', 1.2, 10, 'Kikonazo', 80, 'kikonazo-plus.jpg'),
(252, 7, 'Lays con sal', 2, 10, 'Lays con sal', 80, 'lays-sal.jpg'),
(253, 7, 'Maiz de palomitas', 1.3, 10, 'Maiz de palomitas', 80, 'maiz-palomitas.jpg'),
(254, 7, 'Panchito crudo', 1.5, 10, 'Panchito crudo', 80, 'panchito-crudo-piel.jpg'),
(255, 7, 'Panchito frito', 1.5, 10, 'Panchito frito', 80, 'panchito-frito-repelado-125-gramos.jpg'),
(256, 7, 'Panchito tostado', 1.5, 10, 'Panchito tostado', 80, 'panchito-tostado-sal.jpg'),
(257, 7, 'Panchito calabaza', 1.5, 10, 'Panchito calabaza', 80, 'pipas-calabaza.jpg'),
(258, 7, 'Panchito calabaza 700g', 2.5, 10, 'Panchito calabaza 700g', 80, 'pipas-calabaza-700-gramos.jpg'),
(259, 7, 'Pipas con sal', 0.5, 10, 'Pipas con sal', 80, 'pipas-con-sal.jpg'),
(260, 7, 'Pipas peladas fritas', 0.5, 10, 'Pipas peladas fritas', 80, 'pipas-peladas-fritas-125-gramos.jpg'),
(261, 7, 'Piscolab junior', 0.6, 10, 'Piscolab junior', 80, 'piscolab-junior.jpg'),
(262, 7, 'Puntazos', 1, 10, 'Puntazos', 80, 'puntazos-sabor-explosivo.jpg'),
(263, 7, 'Revuelto especial', 1, 10, 'Revuelto especial', 80, 'revuelto-especial-250-gramos.jpg'),
(264, 7, 'Ruffles de jamon', 1.5, 10, 'Ruffles de jamon', 80, 'rufles-jamon.jpg'),
(265, 7, 'Ruffles de jamon york y queso', 1.5, 10, 'Ruffles de jamon york y queso', 80, 'rufles-york-queso.jpg'),
(266, 7, 'Frutos secos', 1, 10, 'Frutos secos', 80, 'uva-pasa-thompson.jpg'),
(267, 7, 'Xispazos sabor electrico', 1, 10, 'Xispazos sabor electrico', 80, 'xispazos-sabor-electrico.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'administrador'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_conexion` int(11) DEFAULT NULL,
  `id_bot` int(11) DEFAULT NULL,
  `id_visitado` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `puntos_totales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_rol`, `id_producto`, `id_conexion`, `id_bot`, `id_visitado`, `nombre`, `correo`, `password`, `imagen`, `puntos_totales`) VALUES
(1, 1, 1, 1, 1, 1, 'Willy', 'willywonka.es.tienda@gmail.com', '674f3c2c1a8a6f90461e8a66fb5550ba', 'user.jpg', 10),
(2, 2, 1, 1, 1, 0, 'Test', 'test@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'foto.jpg', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bot`
--
ALTER TABLE `bot`
  ADD PRIMARY KEY (`id_bot`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `conexion`
--
ALTER TABLE `conexion`
  ADD PRIMARY KEY (`id_conexion`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_conexion` (`id_conexion`),
  ADD KEY `id_bot` (`id_bot`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bot`
--
ALTER TABLE `bot`
  MODIFY `id_bot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `conexion`
--
ALTER TABLE `conexion`
  MODIFY `id_conexion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE SET NULL,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE SET NULL,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_conexion`) REFERENCES `conexion` (`id_conexion`) ON DELETE SET NULL,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_bot`) REFERENCES `bot` (`id_bot`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
