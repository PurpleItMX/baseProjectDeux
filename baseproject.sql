-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2018 a las 22:54:35
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baseproject`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(10) UNSIGNED NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `icono` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_order` tinyint(4) NOT NULL,
  `estatus` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_menu`, `id_parent`, `name`, `url`, `icono`, `menu_order`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 0, 'Configuración', '', 'fa fa-dashboard', 0, 1, '2018-10-23 22:31:55', '2018-10-23 22:31:55'),
(2, 1, 'nuevo usuario', 'user', 'fa fa-circle-o', 1, 1, '2018-10-26 05:00:00', '2018-10-26 05:00:00'),
(3, 1, 'usuarios', 'users', 'fa fa-circle-o', 0, 1, '2018-10-26 05:00:00', '2018-10-26 05:00:00'),
(4, 6, 'almacenes', 'warehouses', 'fa fa-circle-o', 0, 1, '2018-11-07 19:04:48', '2018-11-07 19:04:48'),
(6, 0, 'Catalogos', '', 'fa fa-tree', 0, 1, '2018-11-07 19:37:37', '2018-11-07 19:37:37'),
(8, 6, 'tipos de insumos', 'supply-types', 'fa fa-circle-o', 1, 1, '2018-11-08 16:17:17', '2018-11-08 16:17:17'),
(10, 6, 'categoria de insumos', 'supply-categories', 'fa fa-circle-o', 2, 1, '2018-11-08 16:18:13', '2018-11-08 16:18:13'),
(12, 6, 'Temporadas', 'seasons', 'fa fa-circle-o', 3, 1, '2018-11-08 22:39:27', '2018-11-08 22:39:27'),
(13, 6, 'provedores', 'providers', 'fa fa-circle-o', 4, 1, '2018-11-12 15:09:44', '2018-11-12 15:09:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_roles`
--

CREATE TABLE `menu_roles` (
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(225, '2014_10_12_000000_create_users_table', 1),
(226, '2014_10_12_100000_create_password_resets_table', 1),
(227, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(228, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(229, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(230, '2016_06_01_000004_create_oauth_clients_table', 1),
(231, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(232, '2018_10_23_165826_create_menus_table', 1),
(233, '2018_10_23_170140_create_roles_table', 1),
(234, '2018_10_23_170834_create_menu_roles_table', 1),
(235, '2018_10_23_170849_create_user_roles_table', 1),
(236, '2018_10_30_160551_create_seasons_table', 1),
(237, '2018_10_30_160913_create_products_table', 1),
(238, '2018_10_30_160931_create_supplies_warehouses_table', 1),
(239, '2018_10_30_160931_create_warehouses_table', 1),
(240, '2018_10_30_161014_create_product_types_table', 1),
(241, '2018_10_30_161034_create_product_categories_table', 1),
(242, '2018_10_30_161255_create_subrecipies_table', 1),
(243, '2018_10_30_161328_create_supply_types_table', 1),
(244, '2018_10_30_161343_create_supply_categories_table', 1),
(245, '2018_10_30_161356_create_supplies_table', 1),
(246, '2018_10_30_163826_create_providers_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(10) UNSIGNED NOT NULL,
  `clave` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `udm` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `id_product_type` int(11) NOT NULL,
  `id_product_category` int(11) NOT NULL,
  `price_sale` double(8,2) NOT NULL,
  `margen_category` double(8,2) NOT NULL,
  `margen_actually` double(8,2) NOT NULL,
  `cost_sale` double(8,2) NOT NULL,
  `expenditure_operative` double(8,2) NOT NULL,
  `utility` double(8,2) NOT NULL,
  `iva` double(8,2) NOT NULL,
  `import_iva` double(8,2) NOT NULL,
  `price_sale_iva` double(8,2) NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_types`
--

CREATE TABLE `product_types` (
  `id_product` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id_provider` int(10) UNSIGNED NOT NULL,
  `clave` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `rfc` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name_commercial` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `street` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `number_ext` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `number_int` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `colony` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`id_provider`, `clave`, `rfc`, `name`, `name_commercial`, `type`, `street`, `number_ext`, `number_int`, `colony`, `city`, `state`, `country`, `zip_code`, `phone`, `email`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Prov001', 'xhshdsuh387hd', 'jsdajbkbhb', 'hbhbhbhbhb', 0, 'jhjbkhbb', '70', NULL, 'jhjjbhbhbhb', 'hjhbkbhvv', 'vjvjvjvg', 'vjvjvjjg', '78637', NULL, 'matthew890513@gmail.com', 1, '2018-11-13 01:29:54', '2018-11-13 01:29:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seasons`
--

CREATE TABLE `seasons` (
  `id_season` int(10) UNSIGNED NOT NULL,
  `clave` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `time_initial` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `time_end` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `seasons`
--

INSERT INTO `seasons` (`id_season`, `clave`, `time_initial`, `time_end`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Primavera', '2018-11-12', '2018-11-12', 1, '2018-11-13 01:35:00', '2018-11-13 01:35:00'),
(2, 'verano', '2018-11-12', '2018-11-12', 1, '2018-11-13 01:36:37', '2018-11-13 01:36:37'),
(3, 'invierno', '2018-11-12', '2018-11-12', 1, '2018-11-13 01:36:58', '2018-11-13 01:36:58'),
(4, 'otoño', '2018-11-12', '2018-11-12', 1, '2018-11-13 01:37:42', '2018-11-13 01:37:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subrecipies`
--

CREATE TABLE `subrecipies` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplies`
--

CREATE TABLE `supplies` (
  `id_supply` int(10) UNSIGNED NOT NULL,
  `clave` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `udm` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `id_supply_category` int(11) NOT NULL,
  `id_supply_type` int(11) NOT NULL,
  `id_season` int(11) NOT NULL,
  `tolerance` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `stock_fixed` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `stock_variable` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `minimal_presentation` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `is_inventorial` smallint(6) NOT NULL,
  `is_product` smallint(6) NOT NULL,
  `is_auditable` smallint(6) NOT NULL,
  `is_direct_purchase` smallint(6) NOT NULL,
  `type` smallint(6) NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `id_provider_primary` int(11) NOT NULL,
  `id_provider_second` int(11) NOT NULL,
  `id_provider_third` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplies_warehouses`
--

CREATE TABLE `supplies_warehouses` (
  `id_warehouse` int(11) NOT NULL,
  `id_supply` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supply_categories`
--

CREATE TABLE `supply_categories` (
  `id_supply_category` int(10) UNSIGNED NOT NULL,
  `clave` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `variant` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `supply_categories`
--

INSERT INTO `supply_categories` (`id_supply_category`, `clave`, `description`, `variant`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'C001', 'Categoria 001', '10', 1, '2018-11-13 00:34:50', '2018-11-13 00:35:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supply_types`
--

CREATE TABLE `supply_types` (
  `id_supply_type` int(10) UNSIGNED NOT NULL,
  `clave` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `id_supply_category` int(11) NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `supply_types`
--

INSERT INTO `supply_types` (`id_supply_type`, `clave`, `description`, `id_supply_category`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'T001', 'Tipo insumo 001', 1, 1, '2018-11-13 00:35:28', '2018-11-13 00:35:28'),
(2, 'T002', 'Prueba 2 de tipo de insumos', 1, 1, '2018-11-13 00:59:59', '2018-11-13 00:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'matthew', 'mateo.vazquez@purpleit.com.mx', NULL, '$2y$10$bfnR3O0jsMTYA8o.jY8y2eV02BqBB.9rvvtRt73DR3DpNXEWE/IfW', 'RXjSqDwj5KuFUjaRtXnpq96dZlINkkpKvLZ4uDAts6ZwMwZpQht4nYiJZVo9', '2018-10-23 22:31:55', '2018-10-26 02:29:36'),
(2, 'Arcadio Poblete carriles', 'arcadio.poblete@purpleit.com.mx', NULL, '$2y$10$nbPII7mec8fKPLZhxlsOSO121CO01ZZs9ghGHqTcWSp/7uQTu2CU2', 'UuT8khdUzkzVE2Of1sbnGnvMZARk4uKwwmPO5rNF9svV4lkCQSY47WJ6rTMk', '2018-10-26 00:03:51', '2018-11-08 07:24:47'),
(3, 'mario carrillo leon', 'mario.carrillo@purpleit.com.mx', NULL, '$2y$10$NBT5QBHR4/OVS/ihCEM8s.xtcb4BNb6rGVt7ZzVUh0SuUmW/qcaE2', 'wSl7DqcOD3xtURArPfO04k2szmy0q7lFLLfS1vKLIPKVBrnWA2x6levF9trE', '2018-10-26 02:43:32', '2018-11-08 07:24:38'),
(4, 'pepe carriles de poblete', 'jose.carriles@purpleit.com.mx', NULL, '$2y$10$ZUfh6eMIAISwZ/NAbl1z..aoWc.sj2ThVquyjdgjZ0zwpTfrYY/Ua', 'ZJAsrS9JYBy4kIfSvFYpSjOoGyVz8nk8v5W8CgOUz4sEPvNPLNvtxkHjJd49', '2018-10-26 03:48:17', '2018-11-08 07:34:37'),
(5, 'Renato', 'rcapiteruchoc@gmail.com', NULL, '$2y$10$BTu4nmMr0YEObWc5AdIGZeYTVU245T8nxfgKxsYInPreyLa/5T.nS', '33tDknUdXyC66b17m0sSRFyGSOCTV1cmOoAfVTiwt3FOy8kzZUB8JPSjg97N', '2018-10-30 23:36:08', '2018-11-08 07:25:02'),
(6, 'mario martinez', 'mario.martinez@purpleit.com.mx', NULL, '$2y$10$M9Wd.C44aAIxyPiwzk.f6uAMjHhL9bG1ZV2ZQsaAxnlW2uREw9gIK', 'q6RIPRReW0', '2018-11-09 06:53:38', '2018-11-09 06:53:38'),
(7, 'Mario', 'themariomarvel@gmail.com', NULL, '$2y$10$HrqqGiHIJD240scVyOrsxeu1UEdnO2kUxU34RMlPgTgkW8P.Ji4IG', 'A5Cz1a8Zek', '2018-11-09 08:50:41', '2018-11-09 08:51:00'),
(9, 'Mario Martinez', 'correo', NULL, '$2y$10$5dRy7tFVUg2dYmBNP2tiLuH1Rod19lJc.uCtKLspgDrmOjn0B4w8y', 'm3aghaue3I', '2018-11-09 09:18:55', '2018-11-09 09:18:55'),
(10, 'Mario 3', 'correo de mario 3', NULL, '$2y$10$bYv1bK4YvZDSlikVnrax4ec8jcYAqVINxNXBbP9P0hWZXOZgOY.yq', 'fKqthfdkfi', '2018-11-09 09:23:33', '2018-11-09 09:23:33'),
(11, 'usuario nuevo', 'usuarionuevo@correo', NULL, '$2y$10$pkdWew1NouGx2L0ATuIOY.v31umx/0wXoiHakdam1BQrkke24u2Ue', 'tGUXkzZcfE', '2018-11-12 21:48:20', '2018-11-12 21:48:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warehouses`
--

CREATE TABLE `warehouses` (
  `id_warehouse` int(10) UNSIGNED NOT NULL,
  `clave` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `prorate` smallint(6) NOT NULL,
  `estatus` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD PRIMARY KEY (`id_menu`,`id_role`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `products_clave_unique` (`clave`);

--
-- Indices de la tabla `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id_provider`),
  ADD UNIQUE KEY `providers_clave_unique` (`clave`),
  ADD UNIQUE KEY `providers_rfc_unique` (`rfc`),
  ADD UNIQUE KEY `providers_name_unique` (`name`),
  ADD UNIQUE KEY `providers_name_commercial_unique` (`name_commercial`),
  ADD UNIQUE KEY `providers_email_unique` (`email`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id_season`),
  ADD UNIQUE KEY `seasons_clave_unique` (`clave`);

--
-- Indices de la tabla `subrecipies`
--
ALTER TABLE `subrecipies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id_supply`),
  ADD UNIQUE KEY `supplies_clave_unique` (`clave`);

--
-- Indices de la tabla `supplies_warehouses`
--
ALTER TABLE `supplies_warehouses`
  ADD PRIMARY KEY (`id_warehouse`,`id_supply`);

--
-- Indices de la tabla `supply_categories`
--
ALTER TABLE `supply_categories`
  ADD PRIMARY KEY (`id_supply_category`),
  ADD UNIQUE KEY `supply_categories_clave_unique` (`clave`);

--
-- Indices de la tabla `supply_types`
--
ALTER TABLE `supply_types`
  ADD PRIMARY KEY (`id_supply_type`),
  ADD UNIQUE KEY `supply_types_clave_unique` (`clave`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id_user`,`id_role`);

--
-- Indices de la tabla `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id_warehouse`),
  ADD UNIQUE KEY `warehouses_clave_unique` (`clave`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id_provider` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id_season` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subrecipies`
--
ALTER TABLE `subrecipies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id_supply` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `supply_categories`
--
ALTER TABLE `supply_categories`
  MODIFY `id_supply_category` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `supply_types`
--
ALTER TABLE `supply_types`
  MODIFY `id_supply_type` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id_warehouse` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
