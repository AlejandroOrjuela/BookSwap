CREATE TABLE `compra` (
  `id_c` bigint(20) UNSIGNED NOT NULL,
  `nomb_l` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `pagado` tinyint(1) DEFAULT NULL,
  `id_u` varchar(20) DEFAULT NULL,
  `id_p` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id_p` varchar(10) NOT NULL,
  `nomb_p` varchar(20) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `disp` tinyint(1) DEFAULT NULL,
  `id_u` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id_p`, `nomb_p`, `precio`, `descr`, `disp`, `id_u`) VALUES
('l001', 'Poemas dobles', 20000, 'es un libro con poemas de mi autoria', 1, 'juan'),
('l002', 'Bee a Bee', 10000, 'es un libro acerca de una abeja', 1, 'ramos'),
('l223', 'un bar', 30000, 'una mañama', 1, 'ramos'),
('l34', 'noname', 3000, 'perdido y usado', 1, 'ramos'),
('l5325', 'como volar owo', 12001200, 'pues las instrucciones para volar (solo para aves)', 1, 'ramos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_u` varchar(20) NOT NULL,
  `nomb_u` varchar(50) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `vendedor` tinyint(1) DEFAULT NULL,
  `clave` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_u`, `nomb_u`, `fecha_nac`, `vendedor`, `clave`) VALUES
('juan', 'demox', '2022-08-02', 0, '12341'),
('ramos', 'fabian', '2002-07-04', 1, '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_c`),
  ADD KEY `fk_id_u2` (`id_u`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `fk_id_u1` (`id_u`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_c` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_id_u2` FOREIGN KEY (`id_u`) REFERENCES `usuario` (`id_u`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `fk_id_u1` FOREIGN KEY (`id_u`) REFERENCES `usuario` (`id_u`);
COMMIT;
