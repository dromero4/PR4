-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2024 a las 13:17:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt02_david_romero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `model` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `preu` float NOT NULL,
  `correu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `correu` varchar(40) NOT NULL,
  `usuari` varchar(20) NOT NULL,
  `contrassenya` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expires` date DEFAULT NULL,
  `profileImg` text DEFAULT NULL,
  `autenticacio` varchar(20) DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`correu`, `usuari`, `contrassenya`, `token`, `token_expires`, `profileImg`, `autenticacio`, `admin`) VALUES
('david@brandpadel.es', 'david', '$2y$10$VWOCnHhlxBmDwe9mIE4/KuzZTemcFUEzP.oXxSXLazbA.Rsk8qneC', NULL, NULL, '', NULL, 1),
('davidromerog765@gmail.com', 'dsadas', '$2y$10$BZv388JCMgS.uMhGMxMhQebbPdBx73QbecUB7EwNXubl5WsPfmrUG', NULL, NULL, '', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`correu`),
  ADD UNIQUE KEY `usuari` (`usuari`),
  ADD UNIQUE KEY `correu` (`correu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
