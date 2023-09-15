-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2023 a las 05:39:06
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
  `id_publicacion` int(11) DEFAULT NULL,
  `id_respuesta` int(11) DEFAULT NULL,
  `texto` varchar(300) NOT NULL,
  `audio` varchar(300) NOT NULL,
  `fecha_comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_comentarios`
--

INSERT INTO `t_comentarios` (`id_comentario`, `id_usuario`, `id_publicacion`, `id_respuesta`, `texto`, `audio`, `fecha_comentario`) VALUES
(35, 42, 107, NULL, 'Eso ta bueno mi negro', '', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_guardados`
--

CREATE TABLE `t_guardados` (
  `id_guardado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_guardados`
--

INSERT INTO `t_guardados` (`id_guardado`, `id_usuario`, `id_publicacion`) VALUES
(26, 42, 107);

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
(114, 42, 107, NULL, '2023-09-11'),
(115, 42, NULL, 35, '2023-09-11'),
(116, 42, 108, NULL, '2023-09-11'),
(117, 40, 107, NULL, '2023-09-11');

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
(107, NULL, 40, '&iexcl;Estoy presentando!', '', '', '', '', '', '', '2023-09-11'),
(108, NULL, 42, 'BRRRR\r\n', '', '', '', '', '', '', '2023-09-11');

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
(43, 40, 42);

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
(40, 'leordio_', 'nicolaslc.main@gmail.com', '', '123', '', '', '2005-06-20', '', 'us40.jpeg', 'us40.jpeg', 1, '2023-09-11'),
(41, 'leordio__', 'gmail@gmail.com', '', 'leordio_', '', '', '2005-06-20', '', '', '', 1, '2023-09-11'),
(42, 'chowsen', 'chowchow@gmail.com', '', 'chowchow1', '', '', '2005-06-20', '', 'us42.jpeg', 'us42.jpeg', 1, '2023-09-11'),
(43, 'otro', 'otro@gmail.com', '', 'nicolitooo', '', '', '2005-06-20', '', 'us43.jpg', 'us43.jpg', 1, '2023-09-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_comentarios`
--
ALTER TABLE `t_comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`,`id_publicacion`),
  ADD KEY `comentario->publicaion` (`id_publicacion`),
  ADD KEY `comentario->comentario` (`id_respuesta`);

--
-- Indices de la tabla `t_guardados`
--
ALTER TABLE `t_guardados`
  ADD PRIMARY KEY (`id_guardado`),
  ADD KEY `t_guardados->publicacion` (`id_publicacion`);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `t_guardados`
--
ALTER TABLE `t_guardados`
  MODIFY `id_guardado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `t_likes`
--
ALTER TABLE `t_likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `t_publicaciones`
--
ALTER TABLE `t_publicaciones`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `id_rol` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_seguidores`
--
ALTER TABLE `t_seguidores`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_comentarios`
--
ALTER TABLE `t_comentarios`
  ADD CONSTRAINT `comentario->comentario` FOREIGN KEY (`id_respuesta`) REFERENCES `t_comentarios` (`id_comentario`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentario->publicaion` FOREIGN KEY (`id_publicacion`) REFERENCES `t_publicaciones` (`id_publicacion`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentario->usuario` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_guardados`
--
ALTER TABLE `t_guardados`
  ADD CONSTRAINT `t_guardados->publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `t_publicaciones` (`id_publicacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_likes`
--
ALTER TABLE `t_likes`
  ADD CONSTRAINT `like_comentario` FOREIGN KEY (`id_comentario`) REFERENCES `t_comentarios` (`id_comentario`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `t_publicaciones` (`id_publicacion`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes->usuario` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_publicaciones`
--
ALTER TABLE `t_publicaciones`
  ADD CONSTRAINT `publicacion->respuesta` FOREIGN KEY (`id_respuesta`) REFERENCES `t_publicaciones` (`id_publicacion`) ON DELETE CASCADE,
  ADD CONSTRAINT `publicacion->usuario` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_seguidores`
--
ALTER TABLE `t_seguidores`
  ADD CONSTRAINT `seguidores->seguido` FOREIGN KEY (`id_seguido`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `seguidores->seguidor` FOREIGN KEY (`id_seguidor`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `usuario->rol` FOREIGN KEY (`id_rol`) REFERENCES `t_roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
