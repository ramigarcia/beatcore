-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2023 a las 06:27:33
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
-- Base de datos: `beatcore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_comentarios`
--

CREATE TABLE `t_comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `texto` varchar(300) NOT NULL,
  `audio` varchar(300) NOT NULL,
  `fecha_comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_comentarios`
--

INSERT INTO `t_comentarios` (`id_comentario`, `id_usuario`, `id_publicacion`, `texto`, `audio`, `fecha_comentario`) VALUES
(9, 25, 33, 'Que buen datooo me diste campeónnn. Pero creoo que nooo te pregunteeeee', '', 2147483647),
(10, 26, 33, 'Preguntame compa', '', 2147483647),
(11, 27, 40, 'dfsdfsfsfs', '', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_guardados`
--

CREATE TABLE `t_guardados` (
  `id_guardado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_likes`
--

CREATE TABLE `t_likes` (
  `id_like` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) DEFAULT NULL,
  `id_comentario` int(11) DEFAULT NULL,
  `fecha_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_likes`
--

INSERT INTO `t_likes` (`id_like`, `id_usuario`, `id_publicacion`, `id_comentario`, `fecha_like`) VALUES
(42, 24, 33, NULL, '2023-08-17'),
(43, 25, 33, NULL, '2023-08-17'),
(44, 26, 33, NULL, '2023-08-17'),
(45, 26, NULL, 9, '2023-08-17'),
(49, 27, 42, NULL, '2023-08-18'),
(50, 27, 33, NULL, '2023-08-18'),
(51, 27, NULL, 11, '2023-08-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_publicaciones`
--

CREATE TABLE `t_publicaciones` (
  `id_publicacion` int(11) NOT NULL,
  `id_respuesta` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` varchar(300) NOT NULL,
  `audio` varchar(300) NOT NULL,
  `img1` varchar(300) NOT NULL,
  `img2` varchar(300) NOT NULL,
  `img3` varchar(300) NOT NULL,
  `img4` varchar(300) NOT NULL,
  `video` varchar(300) NOT NULL,
  `fecha_publicacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_publicaciones`
--

INSERT INTO `t_publicaciones` (`id_publicacion`, `id_respuesta`, `id_usuario`, `texto`, `audio`, `img1`, `img2`, `img3`, `img4`, `video`, `fecha_publicacion`) VALUES
(33, NULL, 24, 'Ahora tengo foto de perfil y de portada!!\r\n', '', '', '', '', '', '', '2023-08-17'),
(35, NULL, 27, 'sdfaf', '', '', '', '', '', '', '2023-08-17'),
(36, NULL, 27, 'dsadsadasdasd', '', '', '', '', '', '', '2023-08-18'),
(37, NULL, 27, 'dsadasdasd', '', '', '', '', '', '', '2023-08-18'),
(38, NULL, 27, 'Otra publicacion mas', '', '', '', '', '', '', '2023-08-18'),
(39, NULL, 27, '??', '', '', '', '', '', '', '2023-08-18'),
(40, NULL, 27, '??', '', '', '', '', '', '', '2023-08-18'),
(41, NULL, 27, '??', '', '', '', '', '', '', '2023-08-18'),
(42, NULL, 27, 'asdsabdjasd', '', '', '', '', '', '', '2023-08-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_roles`
--

CREATE TABLE `t_roles` (
  `id_rol` tinyint(4) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_roles`
--

INSERT INTO `t_roles` (`id_rol`, `rol`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_seguidores`
--

CREATE TABLE `t_seguidores` (
  `id_seguimiento` int(11) NOT NULL,
  `id_seguidor` int(11) NOT NULL,
  `id_seguido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_seguidores`
--

INSERT INTO `t_seguidores` (`id_seguimiento`, `id_seguidor`, `id_seguido`) VALUES
(24, 25, 24),
(29, 26, 24),
(28, 26, 25),
(30, 26, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `foto_perfil` varchar(300) NOT NULL,
  `foto_portada` varchar(300) NOT NULL,
  `id_rol` tinyint(4) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`id_usuario`, `usuario`, `gmail`, `telefono`, `clave`, `nombre`, `apellido`, `fecha_nacimiento`, `descripcion`, `foto_perfil`, `foto_portada`, `id_rol`, `fecha_creacion`) VALUES
(24, 'leordio_', 'nicolaslc.main@gmail.com', '', '202cb962ac59075b964b07152d234b70', 'Nicolas Leonel', 'Corbalan', '2005-06-20', 'Lele para los amigos...', '../../publico/img/foto_perfil/chica_anime.jpg', '../../publico/img/foto_portada/zapatillas.png', 1, '2023-08-17'),
(25, 'chowsen', 'chowchow@gmail.com', '', '202cb962ac59075b964b07152d234b70', '', '', '2004-07-20', '', '../../publico/img/foto_perfil/conejito.jpg', '../../publico/img/foto_portada/una_flor_para_otra_flor.jpg', 1, '2023-08-17'),
(26, 'peke', 'peke@gmail.com', '', '202cb962ac59075b964b07152d234b70', 'Ariel Axel Iván', 'Lopez Benitez', '2004-08-06', 'Pepengaa!!', '../../publico/img/foto_perfil/fantasmita_cool.jpg', '../../publico/img/foto_portada/woooooow.jpg', 1, '2023-08-17'),
(27, 'ramiii', 'rg@gmail.com', '', '7815696ecbf1c96e6894b779456d330e', '', '', '2004-05-03', '', '../../publico/img/foto_perfil/por_defecto.png', '../../publico/img/foto_portada/por_defecto.png', 1, '2023-08-17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_comentarios`
--
ALTER TABLE `t_comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`,`id_publicacion`),
  ADD KEY `comentario->publicaion` (`id_publicacion`);

--
-- Indices de la tabla `t_guardados`
--
ALTER TABLE `t_guardados`
  ADD PRIMARY KEY (`id_guardado`);

--
-- Indices de la tabla `t_likes`
--
ALTER TABLE `t_likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_usuario` (`id_usuario`,`id_publicacion`),
  ADD KEY `like_publicacion` (`id_publicacion`),
  ADD KEY `like_comentario` (`id_comentario`);

--
-- Indices de la tabla `t_publicaciones`
--
ALTER TABLE `t_publicaciones`
  ADD PRIMARY KEY (`id_publicacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_respuesta` (`id_respuesta`);

--
-- Indices de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `t_seguidores`
--
ALTER TABLE `t_seguidores`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `id_seguidor` (`id_seguidor`,`id_seguido`),
  ADD KEY `seguidores->seguido` (`id_seguido`);

--
-- Indices de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_comentarios`
--
ALTER TABLE `t_comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `t_guardados`
--
ALTER TABLE `t_guardados`
  MODIFY `id_guardado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `t_likes`
--
ALTER TABLE `t_likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `t_publicaciones`
--
ALTER TABLE `t_publicaciones`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `id_rol` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_seguidores`
--
ALTER TABLE `t_seguidores`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_comentarios`
--
ALTER TABLE `t_comentarios`
  ADD CONSTRAINT `comentario->publicaion` FOREIGN KEY (`id_publicacion`) REFERENCES `t_publicaciones` (`id_publicacion`),
  ADD CONSTRAINT `comentario->usuario` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `t_likes`
--
ALTER TABLE `t_likes`
  ADD CONSTRAINT `like_comentario` FOREIGN KEY (`id_comentario`) REFERENCES `t_comentarios` (`id_comentario`),
  ADD CONSTRAINT `like_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `t_publicaciones` (`id_publicacion`),
  ADD CONSTRAINT `likes->usuario` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `t_publicaciones`
--
ALTER TABLE `t_publicaciones`
  ADD CONSTRAINT `publicacion->respuesta` FOREIGN KEY (`id_respuesta`) REFERENCES `t_publicaciones` (`id_publicacion`),
  ADD CONSTRAINT `publicacion->usuario` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `t_seguidores`
--
ALTER TABLE `t_seguidores`
  ADD CONSTRAINT `seguidores->seguido` FOREIGN KEY (`id_seguido`) REFERENCES `t_usuarios` (`id_usuario`),
  ADD CONSTRAINT `seguidores->seguidor` FOREIGN KEY (`id_seguidor`) REFERENCES `t_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `usuario->rol` FOREIGN KEY (`id_rol`) REFERENCES `t_roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
