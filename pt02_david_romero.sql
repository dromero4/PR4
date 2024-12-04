-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2024 a las 21:03:58
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

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `model`, `nom`, `preu`, `correu`) VALUES
(4, 'Model', 'Nom', 20, NULL),
(6, 'a', 'a', 20, NULL),
(7, 'p', 'p', 29, NULL),
(10, 'p', 'p', 29222, NULL),
(11, 'd', 'd', 2, NULL),
(13, 'd', 'd', 2552, NULL),
(14, 'd', 'd', 25522, NULL),
(15, 'd', 'd', 255221, NULL),
(16, 'd2', 'd', 255221, NULL),
(17, 'y', 'y', 8, NULL),
(18, 'y2', 'y', 83, NULL),
(19, 'dsadas', 'dasdsa', 55, NULL),
(22, 'nox', 'nox', 90, NULL),
(23, 'probaCorreu', 'probaCorreu', 90, NULL),
(24, 'pruebacorreo1', 'pruebacorreo1', 90, NULL),
(25, 'e', 'e', 8, NULL),
(26, 'nox', 'nox', 2, NULL),
(27, 'editat', 'editat', 909, 'david@gmail.com'),
(28, 'editatMeu', 'editatMeu', 321, 'goku777@gmail.com'),
(29, '1', '1', 2, 'goku777@gmail.com'),
(30, '2', '3', 4, 'goku777@gmail.com'),
(31, '6', '6', 6, 'goku777@gmail.com'),
(32, '7', '7', 7, 'goku777@gmail.com'),
(33, '8', '8', 8, 'goku777@gmail.com'),
(34, 'articleEditatDavid', 'articleEditatDavid', 6, 'david@gmail.com'),
(35, 'pdd', 'dsda', 555, 'prueba@prueba.com'),
(36, '3', '3', 43, 'prueba@prueba.com'),
(37, 'eiwruoiewurioewur', 'ruiewuroiewurioew', 9, 'prueba@prueba.com'),
(39, 'sd', 'dsa', 32, 'prueba2@prueba.com'),
(40, '1', '2', 3, 'davidromerog765@gmail.com'),
(41, 'eqw', 'e', 231, 'prueba@prueba.com'),
(42, 'prueba', 'prueba', 432, 'prueba@prueba.com'),
(43, 'e', 'e', 2765, 'prueba@prueba.com'),
(44, 'prueba', 'prueba', 9999, 'prueba@prueba.com'),
(45, 'pruebs', 'pruebs2', 12, 'goku779@gmail.com'),
(46, '2', '2', 2, 'goku779@gmail.com'),
(47, '3', '3', 3, 'goku779@gmail.com'),
(48, '4', '4', 4, 'goku779@gmail.com'),
(49, '5', '5', 6, 'goku779@gmail.com'),
(50, '6', '6', 7, 'goku779@gmail.com');

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
  `profileImg` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`correu`, `usuari`, `contrassenya`, `token`, `token_expires`, `profileImg`) VALUES
('davidromerog765@gmail.com', 'david', '$2y$10$qoV9nBzRae0FNNY/L38DXuOl5j1FYC8OQKsaLl8PjgLajdERl7p7i', 'd059a1f43dd90a1631133256c37deec1', '2024-11-29', NULL),
('goku779@gmail.com', 'goku779', '$2y$10$etwRiUrK5lCTHkf/ByMlV.aLoH3b3Uina0F3TtYnYJQFuJyxWcTzS', NULL, NULL, NULL),
('prueba10@prueba.com', 'prueba10', '$2y$10$vD.a8BLIWqNreFPCuvOBIOE9R.gd9ykK1Wi04J2kUGmfDtXcTW71u', NULL, NULL, 'https://media.revistagq.com/photos/5f45010acb266484bb785c78/master/pass/dragon-ball-z.jpg'),
('prueba9@prueba.com', 'prueba9', '$2y$10$akRlWzOdUkW0lkwehZ0qs.rELWR05.HMc6x2N/2pbtA2Zi3Qy2iJu', NULL, NULL, 'https://elcomercio.pe/resizer/v2/6FUBT6XQXNHHNFOMCHIT7I34NA.jpg?auth=75b9cd3f5f728a5e2d90b6996b551d7e7e346d0a63104e3596036c1f214a1b77&width=1200&height=1200&quality=75&smart=true'),
('prueba@prueba.com', 'prueba', '$2y$10$7RbRt7m5jVKZjyJNo4jS4utDNkWJJpf.qLHuir9LWyLsQuUlSCBCq', NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
