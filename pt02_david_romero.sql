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
(44, 'prueba', 'prueba', 9999, 'prueba@prueba.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `correu` varchar(40) NOT NULL,
  `usuari` varchar(20) NOT NULL,
  `contrassenya` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expires` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`correu`, `usuari`, `contrassenya`, `token`, `token_expires`) VALUES
('davidromerog765@gmail.com', 'david', '$2y$10$qoV9nBzRae0FNNY/L38DXuOl5j1FYC8OQKsaLl8PjgLajdERl7p7i', 'cccb8dfeb3fc3f54d6d83dbc941174fe', '2024-11-25'),
('prueba@prueba.com', 'prueba', '$2y$10$7RbRt7m5jVKZjyJNo4jS4utDNkWJJpf.qLHuir9LWyLsQuUlSCBCq', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;
