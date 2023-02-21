-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2023 a las 08:30:18
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clientes_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `catalogado` text NOT NULL,
  `codigo` varchar(8) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` varchar(40) NOT NULL,
  `precio` float NOT NULL,
  `imagen` varchar(1000) NOT NULL,
  `stock` int(11) NOT NULL,
  `UnidadesV` int(11) NOT NULL,
  `beneficio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `catalogado`, `codigo`, `nombre`, `descripcion`, `categoria`, `precio`, `imagen`, `stock`, `UnidadesV`, `beneficio`) VALUES
(94, 'Sí', 'AAA12345', 'COOLER XBOX', 'SOPORTE LATERAL CON VENTILADORES', 'per_xbox', 19.95, 'Imgs/167691057641GvLHOJa7L._SX342_SY445_.jpg', 27, 0, 0),
(95, 'Sí', 'BAA12345', 'CARCASA SWITCH', 'CARCASA PROTECTORA PARA NINTENDO SWITCH', 'per_nintendo', 9.95, 'Imgs/167691065741YP+mtVQgL._AC_SX679_.jpg', 21, 0, 0),
(96, 'Sí', 'CAA12345', 'TECLADO LOGITECH', 'TECLADO MECáNICO LOGITECH G302', 'per_pc', 59.95, 'Imgs/167691072151HaCM8wFcL._AC_SX425_.jpg', 18, 0, 0),
(97, 'Sí', 'DAA12345', 'MICRO GAMING', 'MICRóFONO GAMING DE ALTA CALIDAD', 'per_pc', 69.85, 'Imgs/167691077151XXJS3+F5L._AC_SX679_.jpg', 5, 0, 0),
(98, 'Sí', 'EAA12345', 'MANDO XBOX', 'MANDO ERGONóMICO PARA XBOX ', 'per_xbox', 29.95, 'Imgs/167691081861FczNmfCBL._AC_SX342_SY445_.jpg', 11, 0, 0),
(99, 'Sí', 'FAA12345', 'CARGADOR MANDOS PS5', 'CARGADOR ULTRA RáPIDO DE MANDOS PARA PS5', 'per_play station', 18.75, 'Imgs/167691086861JuR0uX6+L._AC_SX679_.jpg', 13, 0, 0),
(100, 'Sí', 'GAA12345', 'AURICULAR GAMING', 'AURICULAR GAMING DE LA MARCA HACENDADO QUE POR PONER GAMING ES MáS CARO', 'per_pc', 12.95, 'Imgs/167691116861KiVOTquQL._AC_SX679_.jpg', 6, 0, 0),
(101, 'Sí', 'HAA12345', 'JOYSTICK PS5', 'JOYSTICK PARA ARCADES PS5', 'per_play station', 24.95, 'Imgs/167691122861nQ0lT5-UL._AC_SX342_SY445_.jpg', 9, 0, 0),
(102, 'Sí', 'IAA12345', 'MANDO NINTENDO', 'MANDO SUPER MARIO PARA NINTENDO SWITCH', 'per_nintendo', 36.95, 'Imgs/167691127861sUUozJvrL._AC_SX679_.jpg', 24, 0, 0),
(103, 'Sí', 'JAA12345', 'AURICULARES PS5', 'AURICULARES ESPECIALES PARA PS5', 'per_play station', 18.95, 'Imgs/167691133561tl-Fi6-uL._AC_SX679_.jpg', 201, 0, 0),
(104, 'Sí', 'KAA12345', 'AURICULARES LOGITECH', 'AURICULARES DE GRAN CALIDAD E LA MARCA LOGITECH', 'per_pc', 49.95, 'Imgs/167691142361us2rqFJOS._AC_SX679_.jpg', 16, 0, 0),
(105, 'Sí', 'LAA12345', 'MANDO PS5', 'MANDO DE GRAN CALIDAD DE COLOR ROSA PARA PS5', 'per_play station', 59.75, 'Imgs/167691146761ZqZRRn4zS._AC_SX679_.jpg', 15, 0, 0),
(106, 'Sí', 'MAA12345', 'HUB USB', 'HUB PARA CONECTAR VARIOS USB', 'per_play station', 89.95, 'Imgs/167691153471ahOtM4r3L._AC_SX679_.jpg', 29, 0, 0),
(107, 'Sí', 'NAA12345', 'VISOR RV', 'VISOR REALIDAD VIRTUAL PARA NINTENDO SWITCH', 'per_nintendo', 28.35, 'Imgs/167691157871c71pgz+kL._AC_SX679_.jpg', 0, 0, 0),
(108, 'Sí', 'OAA12345', 'TECLADO DE MANO', 'TECLADO DE MANO PARA XBOX', 'per_xbox', 26.15, 'Imgs/167691164471rhJgFpJaL._AC_SX679_.jpg', 6, 0, 0),
(109, 'Sí', 'PAA12345', 'PROTECTOR DE PANTALLA', 'PROTECTOR DE PANTALLA PARA NINTENDO SWITCH', 'per_nintendo', 5.95, 'Imgs/167691170271ZRJZhQkRL._AC_SX679_.jpg', 109, 0, 0),
(110, 'Sí', 'QAA12345', 'PROTECTOR TECLAS', 'PROTECTOR PARA DESGASTE DE TECLAS DE NINTENDO SWITCH', 'per_nintendo', 14.65, 'Imgs/1676911758617eG68geXL._AC_SX522_.jpg', 21, 0, 0),
(111, 'Sí', 'RAA12345', 'RATON MARS GAMING', 'RARTON CON GRAN RELACIóN CALIDAD-PRECIO', 'per_pc', 15.95, 'Imgs/1676911799812oyXfMihL._AC_SX679_.jpg', 9, 0, 0),
(112, 'No', 'SAA12345', 'ATOMIC HEART', 'JUEGO DE TIPO SHOOTER PARA VARIAS PLATAFORMAS', 'jg_shooter', 24.95, 'Imgs/1676911855atomic-heart-pc-juego-steam-cover.jpg', 24, 0, 0),
(113, 'Sí', 'TAA12345', 'BLOOD BOWL', 'JUEGO DE TIPO ACCIóN PARA VARIAS PLATAFORMAS', 'jg_accion', 39.95, 'Imgs/1676911924blood-bowl-3-brutal-edition-brutal-edition-pc-juego-steam-cover.jpg', 21, 0, 0),
(114, 'Sí', 'UAA12345', 'COMPANY OF HEROES', 'JUEGO DE TIPO ESTRATEGIA PARA VARIAS PLATAFORMAS', 'jg_estrategia', 19.95, 'Imgs/1676912011company-of-heroes-3-pc-juego-steam-europe-cover.jpg', 9, 0, 0),
(115, 'Sí', 'VAA12345', 'DESTINY 2', 'JUEGO DE TIPO ROL PARA VARIAS PLATAFORMAS', 'jg_rol', 38.75, 'Imgs/1676912069destiny-2-eclipse-pase-anual-pc-juego-steam-cover.jpg', 8, 0, 0),
(116, 'Sí', 'WAA12345', 'FIFA 23', 'JUEGO DE DEPORTES PARA VARIAS PLATAFORMAS', 'jg_deportes', 59.95, 'Imgs/1676912105fifa-23-pc-juego-origin-cover.jpg', 54, 0, 0),
(117, 'Sí', 'XAA12345', 'FOOTBALL MANAGER', 'JUEGO DE DEPORTES PARA VARIAS PLATAFORMAS', 'jg_deportes', 64.5, 'Imgs/1676912169football-manager-2023-pc-mac-juego-steam-europe-cover.jpg', 32, 0, 0),
(118, 'Sí', 'YAA12345', 'HOGWARTS LEGACY', 'JUEGO DE TIPO ARCADE PARA TODAS LAS PLATAFORMAS', 'jg_arcade', 59.75, 'Imgs/1676912237harry potter.jpg', 206, 0, 0),
(119, 'Sí', 'ZAA12345', 'HOKKO LIFE', 'JUEGO DE TIPO ACCIóN PARA VARIAS PLATAFORMAS', 'jg_accion', 9.95, 'Imgs/1676912273hokko-life-pc-juego-steam-cover.jpg', 8, 0, 0),
(120, 'Sí', 'ABA12345', 'LIKE A DRAGON', 'JUEGO DE TIPO ARCADE PARA VARIAS PLATAFORMAS', 'jg_arcade', 18.95, 'Imgs/1676912368like-a-dragon-ishin-digital-deluxe-digital-deluxe-pc-juego-steam-europe-cover.jpg', 19, 0, 0),
(121, 'Sí', 'ACA12345', 'SPIDER-MAN', 'JUEGO DE TIPO ACCIóN PARA VARIAS PLATAFORMAS', 'jg_accion', 45.95, 'Imgs/1676912404marvel-s-spider-man-miles-morales-pc-juego-steam-cover.jpg', 43, 0, 0),
(122, 'Sí', 'ADA12345', 'OCTOPATH', 'JUEGO DE TIPO ROL PARA VARIAS PLATAFORMAS', 'jg_rol', 29.95, 'Imgs/1676912453octopath-traveler-2-pc-juego-steam-cover.jpg', 15, 0, 0),
(123, 'Sí', 'AEA12345', 'NBA 2K23', 'JUEGO DE DEPORTES PARA VARIAS PLATAFORMAS', 'jg_deportes', 26.95, 'Imgs/1676912502nba-2k23-pc-juego-steam-europe-cover.jpg', 54, 0, 0),
(124, 'Sí', 'AGA12345', 'CIVILIZATION VI', 'JUEGO DE ESTRATEGIA PARA VARIAS PLATAFORMAS', 'jg_estrategia', 24.95, 'Imgs/1676912548pase-de-lider-de-civilization-vi-pc-mac-juego-steam-cover.jpg', 43, 0, 0),
(125, 'Sí', 'AHA12345', 'RETURNAL', 'JUEGO DE ACCIóN PARA VARIAS PLATAFORMAS', 'jg_accion', 9.95, 'Imgs/1676912590returnal-pc-juego-steam-cover.jpg', 8, 0, 0),
(126, 'Sí', 'AIA12345', 'THE SETTLERS', 'JUEGO ARCADE PARA VARIAS PLATAFORMAS', 'jg_arcade', 16.95, 'Imgs/1676912637the-settlers-new-allies-pc-juego-ubisoft-connect-europe-cover.jpg', 16, 0, 0),
(127, 'Sí', 'AJA12345', 'UNCHARTED', 'JUEGO ARCADE PARA VARIAS PLATAFORMAS', 'jg_arcade', 59.85, 'Imgs/1676912669uncharted-coleccion-legado-de-los-ladrones-pc-juego-steam-europe-cover.jpg', 59, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'jg_accion', 'VIDEOJUEGO DE ACCION'),
(2, 'jg_arcade', 'VIDEOJUEGO DE TIPO ARCADE'),
(3, 'jg_deportes', 'VIDEOJUEGO DE DEPORTES'),
(6, 'jg_estrategia', 'VIDEOJUEGO DE ESTRATEGIA'),
(7, 'jg_rol', 'VIDEOJUEGO DE ROL'),
(8, 'per_pc', 'PERIFÉRICO PARA PC'),
(9, 'per_play station', 'PERIFéRICO PARA PLAY STATION'),
(10, 'per_xbox', 'PERIFÉRICO PARA XBOX'),
(13, 'per_nintendo', 'PERIFéRICOS DE NINTENDO');

--
-- Disparadores `categorias`
--
DELIMITER $$
CREATE TRIGGER `update_cat_nombre` AFTER UPDATE ON `categorias` FOR EACH ROW BEGIN
    UPDATE articulos SET categoria = NEW.nombre WHERE categoria = OLD.nombre;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_articulo`
--

CREATE TABLE `categoria_articulo` (
  `id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `activa` text NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `localidad` varchar(40) NOT NULL,
  `provincia` varchar(40) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `activa`, `DNI`, `nombre`, `direccion`, `localidad`, `provincia`, `telefono`, `email`, `password`, `rol_id2`) VALUES
(81, 'Sí', '01245816K', 'CHEMA LóPEZ RUBIERA', 'ALCARAZ N35', 'ALICANTE', 'ALICANTE', '609081996', 'CHEMA@HOTMAIL.COM', '$2y$10$F4oH/0hybRfdXsuII5H0AO0CFupe5utV14BHSa3ozU..3vvgLyhA2', 'Usuario'),
(114, 'Sí', '11111111H', 'ADRIAN VEGA', 'LA ALCACHOFA N13', 'ALICANTE', 'ALICANTE', '645789852', 'ADRIAN@HOTMAIL.COM', '$2y$10$jgzGTXNBN7PbQG4.OZYL2OxJ4XuI/rDvzW5TmxdxpJEnP5ghYqYLO', 'Usuario'),
(95, 'Sí', '22222222J', 'MARIA MEDINA', 'ALBERGUE N13', 'ELCHE', 'ALICANTE', '614789579', 'MARIA@HOTMAIL.COM', '$2y$10$eC9iole85lYnnP81f5lCs.grWttfiQjLN90bS5hgiMtwgiKqcE3ua', 'Editor'),
(97, 'Sí', '44444444A', 'MARINA MAGALLóN', 'ALCATRAZ CELDA 211', 'CALIFORNIA', 'SAN FRANCISCO', '879456123', 'MARINA@HOTMAIL.COM', '$2y$10$ir2PCtNHWaYMCa9kfTDM0OhkzDtGiab1mlYbtS0/a7sfX7LRHqsJa', 'Usuario'),
(80, 'Sí', '74241001Z', 'JUAN MANUEL VAZQUEZ', 'LA CARáTULA N18', 'ELCHE', 'ALICANTE', '609081996', 'NOSTR4_88@HOTMAIL.COM', '$2y$10$RUG5bf/A1uxVvnR37UJCOeapVOGM1PIu.EMd4lg5u5bxQzKcBHuvC', 'Admin'),
(105, 'Sí', '74380287N', 'PAULA MONTOYA', 'C/ LA CARáTULA N18', 'ELCHE', 'ALICANTE', '654879457', 'PAULA@HOTMAIL.COM', '$2y$10$lmhW0ozwsqtSA5X0loRztOSkAIV4mvEnCwfVb/p/uJpSQ8KyFrK0C', 'Editor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_articulos`
--

CREATE TABLE `log_articulos` (
  `focus` varchar(20) NOT NULL,
  `accion` varchar(20) NOT NULL,
  `gestor` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_clientes`
--

CREATE TABLE `log_clientes` (
  `focus` varchar(50) NOT NULL,
  `accion` varchar(50) NOT NULL,
  `gestor` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `dni_user` varchar(11) NOT NULL,
  `cantidad_productos` int(11) NOT NULL,
  `precio_total` float NOT NULL,
  `direccion_envio` varchar(200) NOT NULL,
  `correo_pedido` varchar(50) NOT NULL,
  `fecha_pedido` datetime NOT NULL,
  `estado_pedido` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `codigo` (`codigo`) USING BTREE;

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `nombre` (`nombre`) USING HASH;

--
-- Indices de la tabla `categoria_articulo`
--
ALTER TABLE `categoria_articulo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol_id2` (`rol_id2`(768));

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `articulo_id` (`articulo_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`dni_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `categoria_articulo`
--
ALTER TABLE `categoria_articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria_articulo`
--
ALTER TABLE `categoria_articulo`
  ADD CONSTRAINT `categoria_articulo_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `categoria_articulo_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
