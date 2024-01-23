-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2024 a las 21:03:23
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
-- Base de datos: `app_salonx`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_genera_servic`
--

CREATE TABLE `tab_genera_servic` (
  `id` int(11) NOT NULL,
  `nom_servic` varchar(60) NOT NULL,
  `val_servic` decimal(5,2) NOT NULL,
  `usu_creaci` varchar(60) NOT NULL,
  `fec_creaci` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tab_genera_servic`
--

INSERT INTO `tab_genera_servic` (`id`, `nom_servic`, `val_servic`, `usu_creaci`, `fec_creaci`) VALUES
(2, 'Corte de cabello Hombre', 80.00, 'administrador', '2024-01-23'),
(3, 'Corte de cabello Niño', 80.00, 'administrador', '2024-01-23'),
(4, 'Peinado Mujer', 80.00, 'administrador', '2024-01-23'),
(5, 'Peinado Hombre', 60.00, 'administrador', '2024-01-23'),
(6, 'Peinado Niño', 60.00, 'administrador', '2024-01-23'),
(7, 'Corte de Barba', 60.00, 'administrador', '2024-01-23'),
(8, 'Tinte Mujer', 60.00, 'administrador', '2024-01-23'),
(9, 'Uñas', 60.00, 'administrador', '2024-01-23'),
(10, 'Lavado de cabello', 50.00, 'administrador', '2024-01-23'),
(11, 'Tratamiento Capilar', 150.00, 'administrador', '2024-01-23'),
(12, 'Tinte de cabello', 200.00, 'leider bautista', '2024-01-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_genera_usuari`
--

CREATE TABLE `tab_genera_usuari` (
  `id` int(11) NOT NULL,
  `nom_usuari` varchar(60) NOT NULL,
  `ape_usuari` varchar(60) NOT NULL,
  `usu_email` varchar(60) NOT NULL,
  `tel_usuari` varchar(10) NOT NULL,
  `pwd_usuari` varchar(60) NOT NULL,
  `usu_confir` tinyint(1) NOT NULL,
  `usu_admin` tinyint(1) NOT NULL,
  `cod_token` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tab_genera_usuari`
--

INSERT INTO `tab_genera_usuari` (`id`, `nom_usuari`, `ape_usuari`, `usu_email`, `tel_usuari`, `pwd_usuari`, `usu_confir`, `usu_admin`, `cod_token`) VALUES
(1, 'admin', 'Administrador', 'correo@correo.com', '2344324', '$2y$10$7/KrrhpbGZlym6eekjAmV.LvCmyg2bRbHXoDI9cim1V3R5BVv5pQC', 1, 1, ''),
(5, 'cliente', 'usuario', 'correo1@correo.com', '133444', '$2y$10$Lz2ORwnkNWsY9I.gsfpaAuN5fodc8ykihzhTwLGsNtAl.dNnKtVG2', 1, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_relaci_citser`
--

CREATE TABLE `tab_relaci_citser` (
  `id` int(11) NOT NULL,
  `idx_citaxx` int(11) NOT NULL,
  `idx_servic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_usuari_citasx`
--

CREATE TABLE `tab_usuari_citasx` (
  `id` int(11) NOT NULL,
  `fec_citasx` datetime DEFAULT NULL,
  `usu_citasx` int(11) NOT NULL,
  `usu_modifi` int(11) DEFAULT NULL,
  `fec_modifi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tab_genera_servic`
--
ALTER TABLE `tab_genera_servic`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tab_genera_usuari`
--
ALTER TABLE `tab_genera_usuari`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tab_relaci_citser`
--
ALTER TABLE `tab_relaci_citser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tab_usuari_citasx_fk1` (`idx_citaxx`),
  ADD KEY `tab_usuario_servicio_fk1` (`idx_servic`);

--
-- Indices de la tabla `tab_usuari_citasx`
--
ALTER TABLE `tab_usuari_citasx`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tab_usuari_citasx_fk` (`usu_citasx`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tab_genera_servic`
--
ALTER TABLE `tab_genera_servic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tab_genera_usuari`
--
ALTER TABLE `tab_genera_usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tab_relaci_citser`
--
ALTER TABLE `tab_relaci_citser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tab_usuari_citasx`
--
ALTER TABLE `tab_usuari_citasx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tab_relaci_citser`
--
ALTER TABLE `tab_relaci_citser`
  ADD CONSTRAINT `tab_usuari_citasx_fk1` FOREIGN KEY (`idx_citaxx`) REFERENCES `tab_usuari_citasx` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tab_usuario_servicio_fk1` FOREIGN KEY (`idx_servic`) REFERENCES `tab_genera_servic` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tab_usuari_citasx`
--
ALTER TABLE `tab_usuari_citasx`
  ADD CONSTRAINT `tab_usuari_citasx_fk` FOREIGN KEY (`usu_citasx`) REFERENCES `tab_genera_usuari` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
