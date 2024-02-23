-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2024 a las 21:25:17
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
-- Base de datos: `inventarios_transport`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `nit`, `created_at`, `updated_at`) VALUES
(1, 'COMERCIALIZADORA MAPLE WOODS COLOMBIA SAS', '900.100.000', '2024-02-21 20:33:05', '2024-02-21 20:33:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_movimientos`
--

CREATE TABLE `detalle_movimientos` (
  `id` int(11) NOT NULL,
  `movimiento_id` int(11) NOT NULL,
  `productos_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Pendiente por procesar', '2024-02-22 01:08:28', '2024-02-22 01:08:28'),
(2, 'Procesada', '2024-02-22 01:08:28', '2024-02-22 01:08:28'),
(3, 'Anulada', '2024-02-22 01:08:28', '2024-02-22 01:08:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_20_215106_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `estados_id` int(11) NOT NULL,
  `tipo` enum('ENTRADA','SALIDA') DEFAULT NULL,
  `clientes_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-02-21 02:55:33', '2024-02-21 02:55:33'),
(2, 'cliente', 'web', '2024-02-21 02:55:33', '2024-02-21 02:55:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `referencia` varchar(45) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `tipo_productos_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `clientes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `referencia`, `stock`, `tipo_productos_id`, `created_at`, `updated_at`, `clientes_id`) VALUES
(1, 'CASCO-AMATISTA-SOLID-NEGRO/LOGO HAX DORADO/-MATE_L', 'AMA-MBK-L', 12, 1, NULL, '2024-02-24 01:07:26', 0),
(2, 'CASCO-AMATISTA-SOLID-NEGRO/LOGO HAX DORADO/-MATE_M', 'AMA-MBK-M', 30, 1, NULL, '2024-02-24 01:07:26', 0),
(3, 'CASCO-AMATISTA-SOLID-NEGRO/LOGO HAX DORADO/-MATE_S', 'AMA-MBK-S', 12, 1, NULL, NULL, 0),
(4, 'CASCO-AMATISTA-SOLID-NEGRO/LOGO HAX DORADO/-MATE_XL', 'AMA-MBK-XL', 18, 1, NULL, NULL, 0),
(5, 'CASCO-AMATISTA-SOLID-MERCURIO//-MATE_L', 'AMA-MERCURY-L', 18, 1, NULL, NULL, 0),
(6, 'CASCO-AMATISTA-SOLID-MERCURIO//-MATE_M', 'AMA-MERCURY-M', 17, 1, NULL, NULL, 0),
(7, 'CASCO-AMATISTA-SOLID-MERCURIO//-MATE_S', 'AMA-MERCURY-S', 3, 1, NULL, NULL, 0),
(8, 'CASCO-AMATISTA-SOLID-MERCURIO//-MATE_XL', 'AMA-MERCURY-XL', 6, 1, NULL, NULL, 0),
(9, 'CASCO-AMATISTA-MANEKI NEKO-ROJO/NARANJA/BLANCO-BRILLO_L', 'AMA-MNKNK-ROW-L', 6, 1, NULL, NULL, 0),
(10, 'CASCO-AMATISTA-MANEKI NEKO-ROJO/NARANJA/BLANCO-BRILLO_M', 'AMA-MNKNK-ROW-M', 12, 1, NULL, NULL, 0),
(11, 'CASCO-AMATISTA-MANEKI NEKO-ROJO/NARANJA/BLANCO-BRILLO_S', 'AMA-MNKNK-ROW-S', 12, 1, NULL, NULL, 0),
(12, 'CASCO-AMATISTA-MANEKI NEKO-ROJO/NARANJA/BLANCO-BRILLO_XL', 'AMA-MNKNK-ROW-XL', 42, 1, NULL, NULL, 0),
(13, 'CASCO-FORCE-BIRDS BLISS-BLANCO/ROJO/-BRILLO_L', 'FRC-BRDSB-WR-L', 36, 1, NULL, NULL, 0),
(14, 'CASCO INTEGRAL FORCE BIRDS BLISS BLANCO ROJO BRILLO M VIS HUMO SP HUMO', 'FRC-BRDSB-WR-M', 11, 1, NULL, NULL, 0),
(15, 'CASCO-FORCE-BIRDS BLISS-BLANCO/ROJO/-BRILLO_M', 'FRC-BRDSB-WR-M', 0, 1, NULL, NULL, 0),
(16, 'CASCO-FORCE-BIRDS BLISS-BLANCO/ROJO/-BRILLO_S', 'FRC-BRDSB-WR-S', 12, 1, NULL, NULL, 0),
(17, 'CASCO INTEGRAL FORCE BIRDS BLISS BLANCO ROJO BRILLO XL VIS HUMO SP HUMO', 'FRC-BRDSB-WR-XL', 42, 1, NULL, NULL, 0),
(18, 'CASCO-FORCE-BIRDS BLISS-BLANCO/ROJO/-BRILLO_XL', 'FRC-BRDSB-WR-XL', 0, 1, NULL, NULL, 0),
(19, 'CASCO INTEGRAL FORCE SOLID NEGRO DORADO MATE L VIS DORADO SP CROMO DORADO', 'FRC-MBK-GLD-L', 30, 1, NULL, NULL, 0),
(20, 'CASCO-FORCE-SOLID-NEGRO/DORADO/-MATE_L', 'FRC-MBK-GLD-L', 0, 1, NULL, NULL, 0),
(21, 'CASCO INTEGRAL FORCE SOLID NEGRO DORADO MATE M VIS DORADO SP CROMO DORADO', 'FRC-MBK-GLD-M', 48, 1, NULL, NULL, 0),
(22, 'CASCO-FORCE-SOLID-NEGRO/DORADO/-MATE_M', 'FRC-MBK-GLD-M', 0, 1, NULL, NULL, 0),
(23, 'CASCO INTEGRAL FORCE SOLID NEGRO DORADO MATE S VIS DORADO SP CROMO DORADO', 'FRC-MBK-GLD-S', 2, 1, NULL, NULL, 0),
(24, 'CASCO-FORCE-SOLID-NEGRO/DORADO/-MATE_S', 'FRC-MBK-GLD-S', 0, 1, NULL, NULL, 0),
(25, 'CASCO INTEGRAL FORCE SOLID NEGRO DORADO MATE XL VIS DORADO SP CROMO DORADO', 'FRC-MBK-GLD-XL', 18, 1, NULL, NULL, 0),
(26, 'CASCO-FORCE-SOLID-NEGRO/DORADO/-MATE_XL', 'FRC-MBK-GLD-XL', 0, 1, NULL, NULL, 0),
(27, 'CASCO-FORCE-SHEN LONG-NEGRO/DORADO/MORADO/_L', 'FRC-SHNLG-BGP-L', 16, 1, NULL, NULL, 0),
(28, 'CASCO-FORCE-SHEN LONG-NEGRO/DORADO/MORADO/_L', 'FRC-SHNLG-BGP-L', 16, 1, NULL, NULL, 0),
(29, 'CASCO-FORCE-SHEN LONG-NEGRO/DORADO/MORADO/_M', 'FRC-SHNLG-BGP-M', 24, 1, NULL, NULL, 0),
(30, 'CASCO-FORCE-SHEN LONG-NEGRO/DORADO/MORADO/_S', 'FRC-SHNLG-BGP-S', 10, 1, NULL, NULL, 0),
(31, 'CASCO-FORCE-SHEN LONG-NEGRO/DORADO/MORADO/_S', 'FRC-SHNLG-BGP-S', 10, 1, NULL, NULL, 0),
(32, 'CASCO-FORCE-SHEN LONG-NEGRO/DORADO/MORADO/_XL', 'FRC-SHNLG-BGP-XL', 12, 1, NULL, NULL, 0),
(33, 'CASCO-FORCE-SHEN LONG-NEGRO/DORADO/MORADO/_XL', 'FRC-SHNLG-BGP-XL', 12, 1, NULL, NULL, 0),
(34, 'CASCO-OBSIDIAN-GEISHA-NEGRO/ROSADO/TURQUESA-BRILLO_L', 'OB-GSHA-BPT-L', 18, 1, NULL, NULL, 0),
(35, 'CASCO-OBSIDIAN-GEISHA-NEGRO/ROSADO/TURQUESA-BRILLO_M', 'OB-GSHA-BPT-M', 29, 1, NULL, NULL, 0),
(36, 'CASCO-OBSIDIAN-GEISHA-NEGRO/ROSADO/TURQUESA-BRILLO_S', 'OB-GSHA-BPT-S', 24, 1, NULL, NULL, 0),
(37, 'CASCO-OBSIDIAN-GEISHA-NEGRO/ROSADO/TURQUESA-BRILLO_XL', 'OB-GSHA-BPT-XL', 30, 1, NULL, NULL, 0),
(38, 'CASCO-OBSIDIAN-HUICHOL-AQUA//-MATE_L', 'OB-HUICHOL-AQA-L', 6, 1, NULL, NULL, 0),
(39, 'CASCO-OBSIDIAN-HUICHOL-AQUA//-MATE_M', 'OB-HUICHOL-AQA-M', 3, 1, NULL, NULL, 0),
(40, 'CASCO-OBSIDIAN-HUICHOL-AQUA//-MATE_S', 'OB-HUICHOL-AQA-S', 18, 1, NULL, NULL, 0),
(41, 'CASCO-OBSIDIAN-HUICHOL-AQUA//-MATE_XL', 'OB-HUICHOL-AQA-XL', 42, 1, NULL, NULL, 0),
(42, 'CASCO-OBSIDIAN-HUICHOL-DORADO//-BRILLO_L', 'OB-HUICHOL-L', 12, 1, NULL, NULL, 0),
(43, 'CASCO-OBSIDIAN-HUICHOL-DORADO//-BRILLO_M', 'OB-HUICHOL-M', 36, 1, NULL, NULL, 0),
(44, 'CASCO-OBSIDIAN-HUICHOL-DORADO//-BRILLO_XL', 'OB-HUICHOL-XL', 6, 1, NULL, NULL, 0),
(45, 'CASCO-OBSIDIAN-SOLID-NEGRO/LOGO HAX DORADO/-MATE_L', 'OB-MBK-GLD-L', 48, 1, NULL, NULL, 0),
(46, 'CASCO-OBSIDIAN-SOLID-NEGRO/LOGO HAX DORADO/-MATE_XL', 'OB-MBK-GLD-XL', 5, 1, NULL, NULL, 0),
(47, 'CASCO-OBSIDIAN-SOLID-NEGRO//-MATE_L', 'OB-MBK-L', 54, 1, NULL, NULL, 0),
(48, 'CASCO-OBSIDIAN-SOLID-NEGRO//-MATE_M', 'OB-MBK-M', 23, 1, NULL, NULL, 0),
(49, 'CASCO-OBSIDIAN-SOLID-NEGRO//-MATE_S', 'OB-MBK-S', 11, 1, NULL, NULL, 0),
(50, 'CASCO-OBSIDIAN-SOLID-NEGRO//-MATE_XL', 'OB-MBK-XL', 12, 1, NULL, NULL, 0),
(51, 'CASCO-OBSIDIAN-SAMURAI-DORADO//-BRILLO_L', 'OB-SAMURAI-GLD-L', 36, 1, NULL, NULL, 0),
(52, 'CASCO-OBSIDIAN-SAMURAI-DORADO//-BRILLO_M', 'OB-SAMURAI-GLD-M', 54, 1, NULL, NULL, 0),
(53, 'CASCO-OBSIDIAN-SAMURAI-DORADO//-BRILLO_S', 'OB-SAMURAI-GLD-S', 6, 1, NULL, NULL, 0),
(54, 'CASCO-OBSIDIAN-SAMURAI-DORADO//-BRILLO_XL', 'OB-SAMURAI-GLD-XL', 42, 1, NULL, NULL, 0),
(55, 'CASCO-OBSIDIAN-SAMURAI-ROSADO//-BRILLO_L', 'OB-SAMURAI-PNK-L', 48, 1, NULL, NULL, 0),
(56, 'CASCO-OBSIDIAN-SAMURAI-ROSADO//-BRILLO_XL', 'OB-SAMURAI-PNK-XL', 0, 1, NULL, NULL, 0),
(57, 'CASCO INTEGRAL OBSIDIAN SNAKE DEMON NEGRO MORADO BRILLO L VIS MORADO SP MORADO', 'OB-SNKDM-BPB-L', 24, 1, NULL, NULL, 0),
(58, 'CASCO OBSIDIAN SNAKE DEMON NEGRO/PURPURA/AZUL BRILLO TALLA M', 'OB-SNKDM-BPB-M', 64, 1, NULL, NULL, 0),
(59, 'CASCO INTEGRAL OBSIDIAN SNAKE DEMON NEGRO MORADO BRILLO S VIS MORADO SP MORADO', 'OB-SNKDM-BPB-S', 10, 1, NULL, NULL, 0),
(60, 'CASCO INTEGRAL OBSIDIAN SNAKE DEMON NEGRO MORADO BRILLO XL VIS MORADO SP MORADO', 'OB-SNKDM-BPB-XL', 12, 1, NULL, NULL, 0),
(61, 'CASCO INTEGRAL OBSIDIAN SNAKE DEMON NEGRO ROJO BRILLO L VIS DORADO SP DORADO', 'OB-SNKDM-BRT-L', 41, 1, NULL, NULL, 0),
(62, 'CASCO INTEGRAL OBSIDIAN SNAKE DEMON NEGRO ROJO BRILLO M VIS DORADO SP DORADO', 'OB-SNKDM-BRT-M', 59, 1, NULL, NULL, 0),
(63, 'CASCO INTEGRAL OBSIDIAN SNAKE DEMON NEGRO ROJO BRILLO S VIS DORADO SP DORADO', 'OB-SNKDM-BRT-S', 10, 1, NULL, NULL, 0),
(64, 'CASCO INTEGRAL OBSIDIAN SNAKE DEMON NEGRO ROJO BRILLO XL VIS DORADO SP DORADO', 'OB-SNKDM-BRT-XL', 36, 1, NULL, NULL, 0),
(65, 'REFRACCION VISOR', 'INERV-AMA-S', 60, 2, NULL, NULL, 0),
(66, 'REFRACCION VISOR', 'INERV-FRC-S', 60, 2, NULL, NULL, 0),
(67, 'REFRACCION VISOR', 'INERV-OB-S', 60, 2, NULL, NULL, 0),
(68, 'REFRACCION NOSE', 'NS-AMA-B', 20, 2, NULL, NULL, 0),
(69, 'REFRACCION NOSE', 'NS-FRC-B', 20, 2, NULL, NULL, 0),
(70, 'REFRACCION - NOSE', 'NS-OB-B', 20, 2, NULL, NULL, 0),
(71, 'REFRACCION SPOILER', 'S-FRC-O', 20, 2, NULL, NULL, 0),
(72, 'REFRACCION SPOILER', 'S-FRC-S', 20, 2, NULL, NULL, 0),
(73, 'REFRCCION AQUA', 'S-OB-A', 20, 2, NULL, NULL, 0),
(74, 'REFRACCIONBLACK', 'S-OB-BG', 20, 2, NULL, NULL, 0),
(75, 'REFRACCION BLACK', 'S-OB-BM', 20, 2, NULL, NULL, 0),
(76, 'REFRACCION DARK BLUE', 'S-OB-DB', 20, 2, NULL, NULL, 0),
(77, 'REFRACCION AURORA_ BLUE', 'S-OB-FB', 20, 2, NULL, NULL, 0),
(78, 'REFRACCION AURORA_GREEN', 'S-OB-FG', 20, 2, NULL, NULL, 0),
(79, 'REFRACCION SPOILER', 'S-OB-G', 20, 2, NULL, NULL, 0),
(80, 'REFRACCION SPOILER', 'S-OB-M', 20, 2, NULL, NULL, 0),
(81, 'REFRACCION SPOILER', 'S-OB-P', 20, 2, NULL, NULL, 0),
(82, 'REFRACCION PADDING', 'TAP-AMA-L', 50, 2, NULL, NULL, 0),
(83, 'REFRACCION PADDING', 'TAP-AMA-M', 50, 2, NULL, NULL, 0),
(84, 'REFRACCION PADDING', 'TAP-AMA-S', 50, 2, NULL, NULL, 0),
(85, 'REFRACCION PADDING', 'TAP-AMA-XS', 50, 2, NULL, NULL, 0),
(86, 'REFRACCION VENTS', 'VENTS-AMA', 20, 2, NULL, NULL, 0),
(87, 'REFRACCION VENTS', 'VENTS-FRC', 20, 2, NULL, NULL, 0),
(88, 'REFRACCION AQUA', 'VENTS-OB-A', 20, 2, NULL, NULL, 0),
(89, 'REFRACCION BLACK', 'VENTS-OB-BG', 20, 2, NULL, NULL, 0),
(90, 'REFRACCION BLACK', 'VENTS-OB-BM', 20, 2, NULL, NULL, 0),
(91, 'REFRACCION DARK BLUE', 'VENTS-OB-DB', 20, 2, NULL, NULL, 0),
(92, 'REFRACCION AURORA_ BLUE', 'VENTS-OB-FB', 20, 2, NULL, NULL, 0),
(93, 'REFRACCION AURORA_GREEN', 'VENTS-OB-FG', 20, 2, NULL, NULL, 0),
(94, 'REFRACCION VISOR', 'V-FRC-C', 60, 2, NULL, NULL, 0),
(95, 'REFRACCION VISOR', 'V-FRC-GD', 60, 2, NULL, NULL, 0),
(96, 'REFRACCION VISOR', 'V-FRC-IG', 60, 2, NULL, NULL, 0),
(97, 'REFRACCION VISOR', 'V-FRC-IR', 60, 2, NULL, NULL, 0),
(98, 'REFRACCION VISOR', 'V-FRC-M', 60, 2, NULL, NULL, 0),
(99, 'REFRACCION VISOR BASE', 'VSR-B-AMA', 500, 2, NULL, NULL, 0),
(100, 'REFRACCION VISOR BASE', 'VSR-B-OB', 500, 2, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-02-21 02:55:33', '2024-02-21 02:55:33'),
(2, 'ciente', 'web', '2024-02-21 02:55:33', '2024-02-21 02:55:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'CASCOS', '2024-02-21 20:33:41', '2024-02-21 20:33:41'),
(2, 'REPUESTOS CASCOS', '2024-02-21 22:04:22', '2024-02-21 22:04:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'jorge', 'jorge@transport.com', NULL, '$2y$12$vsY5uThSWEH08w/3fiptq.MW0pjdSaDbXhivbwcbR3VX0cXXjCBL6', NULL, '2024-02-21 02:58:04', '2024-02-21 02:58:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_has_clientes`
--

CREATE TABLE `users_has_clientes` (
  `id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `clientes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_movimientos`
--
ALTER TABLE `detalle_movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_movimiento_movimiento1_idx` (`movimiento_id`),
  ADD KEY `fk_detalle_movimiento_productos1_idx` (`productos_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movimiento_estados1_idx` (`estados_id`),
  ADD KEY `fk_movimiento_clientes1_idx` (`clientes_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_tipo_productos1_idx` (`tipo_productos_id`),
  ADD KEY `fk_productos_clientes1_idx` (`clientes_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `users_has_clientes`
--
ALTER TABLE `users_has_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_clientes_users1_idx` (`users_id`),
  ADD KEY `fk_users_has_clientes_clientes1_idx` (`clientes_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_movimientos`
--
ALTER TABLE `detalle_movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users_has_clientes`
--
ALTER TABLE `users_has_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_movimientos`
--
ALTER TABLE `detalle_movimientos`
  ADD CONSTRAINT `fk_detalle_movimiento_movimiento1` FOREIGN KEY (`movimiento_id`) REFERENCES `movimientos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_movimiento_productos1` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_movimiento_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimiento_estados1` FOREIGN KEY (`estados_id`) REFERENCES `estados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_tipo_productos1` FOREIGN KEY (`tipo_productos_id`) REFERENCES `tipo_productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users_has_clientes`
--
ALTER TABLE `users_has_clientes`
  ADD CONSTRAINT `fk_users_has_clientes_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_clientes_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
