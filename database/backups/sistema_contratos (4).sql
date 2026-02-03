-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 04-02-2026 a las 00:51:38
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
-- Base de datos: `sistema_contratos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adendas`
--

CREATE TABLE `adendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrato_id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(8) NOT NULL,
  `adenda_anterior_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_firma` date DEFAULT NULL,
  `numero_adenda` int(11) NOT NULL,
  `tipo_salario` enum('Mensual','Jornal','Ambos') NOT NULL DEFAULT 'Mensual',
  `salario_mensual` decimal(10,2) DEFAULT NULL,
  `salario_jornal` decimal(10,2) DEFAULT NULL,
  `horario` enum('8 horas','14x7','5x2','Otros') NOT NULL DEFAULT '8 horas',
  `tiempo_acumulado_total_meses` int(11) NOT NULL,
  `numero_adenda_contrato` varchar(50) NOT NULL,
  `url_documento_escaneado` varchar(255) DEFAULT NULL,
  `estado` enum('Borrador','Enviado a firmar','Firmado','Activo','Vencida','Cancelada') NOT NULL DEFAULT 'Borrador',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `adendas`
--

INSERT INTO `adendas` (`id`, `contrato_id`, `dni`, `adenda_anterior_id`, `fecha_inicio`, `fecha_fin`, `fecha_firma`, `numero_adenda`, `tipo_salario`, `salario_mensual`, `salario_jornal`, `horario`, `tiempo_acumulado_total_meses`, `numero_adenda_contrato`, `url_documento_escaneado`, `estado`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(15, 59, '72506477', NULL, '2026-02-06', '2026-05-06', '2026-02-05', 1, 'Mensual', 4577.00, NULL, '8 horas', 4, 'EMI-CHUN-PROY-003-A1', NULL, 'Borrador', 3, NULL, '2026-02-03 14:09:58', '2026-02-03 15:04:01'),
(16, 59, '72506477', NULL, '2026-05-07', '2026-08-07', '2026-05-06', 2, 'Mensual', 4577.00, NULL, '8 horas', 7, 'EMI-CHUN-PROY-003-A2', NULL, 'Borrador', 3, NULL, '2026-02-03 14:18:18', '2026-02-03 15:04:01'),
(17, 59, '72506477', NULL, '2026-08-08', '2026-11-08', '2026-08-07', 3, 'Mensual', 4577.00, NULL, '8 horas', 10, 'EMI-CHUN-PROY-003-A3', NULL, 'Borrador', 3, NULL, '2026-02-03 14:23:20', '2026-02-03 15:04:01'),
(18, 59, '72506477', NULL, '2026-11-09', '2027-02-09', '2026-11-08', 4, 'Mensual', 4577.00, NULL, '8 horas', 13, 'EMI-CHUN-PROY-003-A4', NULL, 'Borrador', 3, NULL, '2026-02-03 14:31:04', '2026-02-03 15:04:01'),
(19, 59, '72506477', NULL, '2027-02-10', '2027-05-10', '2027-02-09', 5, 'Mensual', 4577.00, NULL, '8 horas', 16, 'EMI-CHUN-PROY-003-A5', NULL, 'Borrador', 3, NULL, '2026-02-03 14:32:43', '2026-02-03 15:04:01'),
(20, 59, '72506477', NULL, '2027-05-11', '2027-12-11', '2027-05-10', 6, 'Mensual', 4577.00, NULL, '8 horas', 23, 'EMI-CHUN-PROY-003-A6', NULL, 'Borrador', 3, NULL, '2026-02-03 14:33:03', '2026-02-03 15:04:01'),
(21, 59, '72506477', NULL, '2027-12-12', '2028-12-12', '2027-12-11', 7, 'Mensual', 4577.00, NULL, '8 horas', 35, 'EMI-CHUN-PROY-003-A7', NULL, 'Borrador', 3, NULL, '2026-02-03 14:33:48', '2026-02-03 15:04:01'),
(22, 59, '72506477', NULL, '2028-12-13', '2029-06-13', '2028-12-12', 8, 'Mensual', 4577.00, NULL, '8 horas', 41, 'EMI-CHUN-PROY-003-A8', NULL, 'Borrador', 3, NULL, '2026-02-03 14:44:02', '2026-02-03 15:04:01'),
(23, 59, '72506477', NULL, '2029-06-14', '2030-01-01', '2029-06-13', 9, 'Mensual', 4577.00, NULL, '8 horas', 48, 'EMI-CHUN-PROY-003-A9', NULL, 'Borrador', 3, NULL, '2026-02-03 14:44:54', '2026-02-03 15:04:01'),
(24, 59, '72506477', NULL, '2030-01-02', '2030-04-02', '2030-01-01', 10, 'Mensual', 4577.00, NULL, '8 horas', 51, 'EMI-CHUN-PROY-003-A10', NULL, 'Borrador', 3, NULL, '2026-02-03 14:47:01', '2026-02-03 15:04:01'),
(25, 59, '72506477', NULL, '2030-04-03', '2030-07-03', '2030-04-02', 11, 'Mensual', 4577.00, NULL, '8 horas', 54, 'EMI-CHUN-PROY-003-A11', NULL, 'Borrador', 3, NULL, '2026-02-03 14:47:39', '2026-02-03 15:04:01'),
(29, 59, '72506477', NULL, '2030-07-04', '2030-10-04', '2030-07-03', 12, 'Mensual', 4577.00, NULL, '8 horas', 57, 'EMI-CHUN-PROY-003-A12', NULL, 'Borrador', 3, NULL, '2026-02-03 16:19:55', '2026-02-03 16:19:55'),
(32, 60, '76543217', NULL, '2026-04-02', '2026-06-02', '2026-04-01', 1, 'Mensual', 5000.00, NULL, '8 horas', 5, 'EMI-CEN-ADM-014-A1', NULL, 'Borrador', 3, NULL, '2026-02-03 21:44:05', '2026-02-03 21:44:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(8) NOT NULL,
  `contrato_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo` enum('Vencimiento de contrato','Cumpleaños','Estabilidad laboral (5 años)','Otra') NOT NULL,
  `destinatario` enum('RRHH','Bienestar','Gerencia','Multiple') NOT NULL DEFAULT 'RRHH',
  `titulo` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_alerta` date NOT NULL,
  `fecha_vencimiento_evento` date DEFAULT NULL,
  `prioridad` enum('Baja','Media','Alta','Crítica') NOT NULL DEFAULT 'Media',
  `color_indicador` enum('Verde','Amarillo','Rojo') NOT NULL DEFAULT 'Verde',
  `estado` enum('Pendiente','Enviada','Leída','Resuelta') NOT NULL DEFAULT 'Pendiente',
  `medio_notificacion` varchar(255) NOT NULL DEFAULT 'Email,Sistema',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`id`, `dni`, `contrato_id`, `tipo`, `destinatario`, `titulo`, `descripcion`, `fecha_alerta`, `fecha_vencimiento_evento`, `prioridad`, `color_indicador`, `estado`, `medio_notificacion`, `created_at`, `updated_at`) VALUES
(1, '72506477', NULL, 'Cumpleaños', 'Bienestar', 'Cumpleaños próximo: MAYTA SANTOS LUIGI RIKY', 'MAYTA SANTOS LUIGI RIKY cumple años el 05/02/2004. Giftcard pendiente de entregar.', '2026-02-02', NULL, 'Media', 'Amarillo', 'Leída', 'Email,Sistema', '2026-02-02 23:43:18', '2026-02-02 23:47:04'),
(2, '72506477', NULL, 'Cumpleaños', 'Bienestar', 'Cumpleaños próximo: MAYTA SANTOS LUIGI RIKY', 'MAYTA SANTOS LUIGI RIKY cumple años el 05/02/2004. Giftcard pendiente de entregar.', '2026-02-02', NULL, 'Media', 'Amarillo', 'Leída', 'Email,Sistema', '2026-02-02 23:48:57', '2026-02-02 23:50:44'),
(3, '76543217', NULL, 'Cumpleaños', 'Bienestar', 'Cumpleaños próximo: MAYTA SANTOS LUIGILLO', 'MAYTA SANTOS LUIGILLO cumple años el 04/02/2000. Giftcard pendiente de entregar.', '2026-02-02', NULL, 'Media', 'Amarillo', 'Pendiente', 'Email,Sistema', '2026-02-03 00:06:54', '2026-02-03 00:06:54'),
(4, '72506477', NULL, 'Cumpleaños', 'Bienestar', 'Cumpleaños próximo: MAYTA SANTOS LUIGI RIKY', 'MAYTA SANTOS LUIGI RIKY cumple años el 05/02/2004. Giftcard pendiente de entregar.', '2026-02-02', NULL, 'Media', 'Amarillo', 'Pendiente', 'Email,Sistema', '2026-02-03 00:09:46', '2026-02-03 00:09:46'),
(5, '42871896', 57, 'Vencimiento de contrato', 'RRHH', 'Contrato próximo a vencer: ALARCON GUTIERREZ ALBERT AISTEN', 'El contrato EMI-CHUN-AA-MTP-004 vence el 05/03/2026 (en 29 días). Debe renovar o finalizar.', '2026-02-03', '2026-03-05', 'Alta', 'Amarillo', 'Pendiente', 'Email,Sistema', '2026-02-03 16:48:29', '2026-02-03 16:48:29'),
(6, '71267323', 58, 'Vencimiento de contrato', 'RRHH', 'Contrato próximo a vencer: FERNANDEZ CAJACHAHUA VICTOR', 'El contrato EMI-CEN-ADM-013 vence el 05/03/2026 (en 29 días). Debe renovar o finalizar.', '2026-02-03', '2026-03-05', 'Alta', 'Amarillo', 'Pendiente', 'Email,Sistema', '2026-02-03 16:48:29', '2026-02-03 16:48:29'),
(8, '72506477', 59, 'Estabilidad laboral (5 años)', 'Multiple', '⚠️ CRÍTICO: MAYTA SANTOS LUIGI RIKY cerca de 5 años', 'El trabajador MAYTA SANTOS LUIGI RIKY tiene actualmente 59 meses acumulados. Le falta solo 1 mes(es) para cumplir 5 años de estabilidad laboral. DEBE TOMAR DECISIÓN URGENTE: Renovar como indefinido, NO renovar (cesar), o prórroga.', '2026-02-03', NULL, 'Crítica', 'Rojo', 'Pendiente', 'Email,Sistema', '2026-02-03 16:54:13', '2026-02-03 16:54:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `modelo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `detalles` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `user_id`, `accion`, `modelo`, `modelo_id`, `detalles`, `ip_address`, `fecha`, `created_at`, `updated_at`) VALUES
(1, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"Mayta Santos Luigi\"}', '127.0.0.1', '2026-01-28 21:34:34', '2026-01-28 21:34:34', '2026-01-28 21:34:34'),
(2, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"Mayta Santos Luigi\"}', '127.0.0.1', '2026-01-28 21:36:27', '2026-01-28 21:36:27', '2026-01-28 21:36:27'),
(3, 3, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"dni\":\"71267323\"}', '127.0.0.1', '2026-01-29 16:24:03', '2026-01-29 16:24:03', '2026-01-29 16:24:03'),
(4, 3, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"dni\":\"71267323\"}', '127.0.0.1', '2026-01-29 17:24:12', '2026-01-29 17:24:12', '2026-01-29 17:24:12'),
(5, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\"}', '127.0.0.1', '2026-01-29 17:25:11', '2026-01-29 17:25:11', '2026-01-29 17:25:11'),
(6, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\"}', '127.0.0.1', '2026-01-29 17:29:27', '2026-01-29 17:29:27', '2026-01-29 17:29:27'),
(7, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\"}', '127.0.0.1', '2026-01-29 17:30:08', '2026-01-29 17:30:08', '2026-01-29 17:30:08'),
(8, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\"}', '127.0.0.1', '2026-01-29 20:16:01', '2026-01-29 20:16:01', '2026-01-29 20:16:01'),
(9, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\"}', '127.0.0.1', '2026-01-29 20:16:23', '2026-01-29 20:16:23', '2026-01-29 20:16:23'),
(10, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\"}', '127.0.0.1', '2026-01-29 20:17:07', '2026-01-29 20:17:07', '2026-01-29 20:17:07'),
(11, 3, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"dni\":\"71267323\",\"cv\":\"No\"}', '127.0.0.1', '2026-01-29 20:53:17', '2026-01-29 20:53:17', '2026-01-29 20:53:17'),
(12, 3, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"dni\":\"71267323\",\"cv\":\"S\\u00ed\"}', '127.0.0.1', '2026-01-29 21:01:53', '2026-01-29 21:01:53', '2026-01-29 21:01:53'),
(13, 3, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"dni\":\"71267323\",\"cv\":\"S\\u00ed\"}', '127.0.0.1', '2026-01-29 21:07:51', '2026-01-29 21:07:51', '2026-01-29 21:07:51'),
(14, 3, 'Eliminar CV', 'Trabajador', NULL, '{\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"dni\":\"71267323\"}', '127.0.0.1', '2026-01-29 21:08:14', '2026-01-29 21:08:14', '2026-01-29 21:08:14'),
(15, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"cv\":\"Actualizado\"}', '127.0.0.1', '2026-01-29 21:08:31', '2026-01-29 21:08:31', '2026-01-29 21:08:31'),
(16, 3, 'Eliminar CV', 'Trabajador', NULL, '{\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"dni\":\"71267323\"}', '127.0.0.1', '2026-01-29 21:08:40', '2026-01-29 21:08:40', '2026-01-29 21:08:40'),
(17, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"cv\":\"Actualizado\"}', '127.0.0.1', '2026-01-29 21:12:04', '2026-01-29 21:12:04', '2026-01-29 21:12:04'),
(18, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-01-29 21:21:59', '2026-01-29 21:21:59', '2026-01-29 21:21:59'),
(19, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-01-29 21:25:06', '2026-01-29 21:25:06', '2026-01-29 21:25:06'),
(20, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"FERNANDEZ CAJACHAHUA VICTOR\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-01-29 21:35:03', '2026-01-29 21:35:03', '2026-01-29 21:35:03'),
(21, NULL, 'Actualizar Configuración Empresa', NULL, NULL, NULL, NULL, '2026-01-30 16:46:22', '2026-01-30 16:46:22', '2026-01-30 16:46:22'),
(22, NULL, 'Actualizar Configuración Empresa', NULL, NULL, NULL, NULL, '2026-01-30 16:48:25', '2026-01-30 16:48:25', '2026-01-30 16:48:25'),
(23, 3, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"ALARCON GUTIERREZ ALBERT AISTEN\",\"dni\":\"42871896\",\"cv\":\"No\"}', '127.0.0.1', '2026-01-30 20:45:41', '2026-01-30 20:45:41', '2026-01-30 20:45:41'),
(24, 3, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"ESPINOZA BARRUETA YONATAN ROY\",\"dni\":\"76551023\",\"cv\":\"No\"}', '127.0.0.1', '2026-01-30 21:35:20', '2026-01-30 21:35:20', '2026-01-30 21:35:20'),
(25, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"AGUILAR NUEVO JOSE ANTONIO\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-02-02 20:31:08', '2026-02-02 20:31:08', '2026-02-02 20:31:08'),
(26, 3, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"MAYTA SANTOS LUIGI RIKY\",\"dni\":\"72506477\",\"cv\":\"No\"}', '127.0.0.1', '2026-02-02 21:07:48', '2026-02-02 21:07:48', '2026-02-02 21:07:48'),
(27, 1, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"MAYTA SANTOS LUIGI RIKY\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-02-02 21:12:18', '2026-02-02 21:12:18', '2026-02-02 21:12:18'),
(28, 1, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"MAYTA SANTOS LUIGI RIKY\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-02-02 21:16:12', '2026-02-02 21:16:12', '2026-02-02 21:16:12'),
(29, 1, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"MAYTA SANTOS LUIGI RIKY\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-02-02 21:18:30', '2026-02-02 21:18:30', '2026-02-02 21:18:30'),
(30, 1, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"MAYTA SANTOS LUIGI RIKY\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-02-02 21:37:02', '2026-02-02 21:37:02', '2026-02-02 21:37:02'),
(31, 1, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"ALARCON GUTIERREZ ALBERT AISTEN\",\"cv\":\"Sin cambios\"}', '190.235.45.20', '2026-02-02 22:17:46', '2026-02-02 22:17:46', '2026-02-02 22:17:46'),
(32, 1, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"ALARCON GUTIERREZ ALBERT AISTEN\",\"cv\":\"Sin cambios\"}', '201.230.137.138', '2026-02-02 22:20:57', '2026-02-02 22:20:57', '2026-02-02 22:20:57'),
(33, 1, 'Crear Trabajador', 'Trabajador', NULL, '{\"nombre\":\"MAYTA SANTOS LUIGILLO\",\"dni\":\"76543217\",\"cv\":\"No\"}', '127.0.0.1', '2026-02-03 00:04:07', '2026-02-03 00:04:07', '2026-02-03 00:04:07'),
(34, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"MAYTA SANTOS LUIGI RIKY\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-02-03 14:12:48', '2026-02-03 14:12:48', '2026-02-03 14:12:48'),
(35, 3, 'Editar Trabajador', 'Trabajador', NULL, '{\"cambios\":\"Datos actualizados\",\"nombre\":\"ALARCON GUTIERREZ ALBERT AISTEN\",\"cv\":\"Sin cambios\"}', '127.0.0.1', '2026-02-03 17:15:06', '2026-02-03 17:15:06', '2026-02-03 17:15:06'),
(36, 1, 'Editar Usuario', 'Usuario', 3, '{\"nombre\":\"administracion central\",\"email\":\"administracion@emiconsath.com\",\"roles\":[\"RRHH\"]}', '127.0.0.1', '2026-02-03 20:25:03', '2026-02-03 20:25:03', '2026-02-03 20:25:03'),
(37, 1, 'Editar Usuario', 'Usuario', 4, '{\"nombre\":\"Edy\",\"email\":\"bienestar@emiconsath.com\",\"roles\":[\"Bienestar\"]}', '127.0.0.1', '2026-02-03 20:25:29', '2026-02-03 20:25:29', '2026-02-03 20:25:29'),
(38, 1, 'Editar Usuario', 'Usuario', 5, '{\"nombre\":\"Pedro Mart\\u00ednez\",\"email\":\"gerencia@emiconsath.com\",\"roles\":[\"Gerencia\"]}', '127.0.0.1', '2026-02-03 20:26:02', '2026-02-03 20:26:02', '2026-02-03 20:26:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-administrador@emiconsath.com|127.0.0.1', 'i:2;', 1770152107),
('laravel-cache-administrador@emiconsath.com|127.0.0.1:timer', 'i:1770152107;', 1770152107),
('laravel-cache-pedra@emiconsath.com|127.0.0.1', 'i:1;', 1770149798),
('laravel-cache-pedra@emiconsath.com|127.0.0.1:timer', 'i:1770149797;', 1770149797),
('laravel-cache-rrhh@emiconsath.com|127.0.0.1', 'i:1;', 1770153175),
('laravel-cache-rrhh@emiconsath.com|127.0.0.1:timer', 'i:1770153175;', 1770153175),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:45:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:17:\"view.trabajadores\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:19:\"create.trabajadores\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"edit.trabajadores\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:19:\"delete.trabajadores\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:14:\"view.contratos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:16:\"create.contratos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"edit.contratos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"delete.contratos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:23:\"view.salarios.contratos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"view.adendas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:14:\"create.adendas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:12:\"edit.adendas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:14:\"delete.adendas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:12:\"view.alertas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:14:\"create.alertas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:12:\"edit.alertas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:14:\"delete.alertas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:16:\"view.lista_negra\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:18:\"create.lista_negra\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:16:\"edit.lista_negra\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:23:\"desbloquear.lista_negra\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:15:\"view.plantillas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:17:\"create.plantillas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:15:\"edit.plantillas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:17:\"delete.plantillas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:14:\"view.clausulas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:16:\"create.clausulas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:14:\"edit.clausulas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:16:\"delete.clausulas\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:16:\"view.cumpleaños\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:18:\"create.cumpleaños\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:16:\"edit.cumpleaños\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:18:\"registrar.giftcard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:13:\"view.reportes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:21:\"export.reportes.excel\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:19:\"export.reportes.pdf\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:14:\"view.dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:13:\"view.usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:15:\"create.usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:13:\"edit.usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:15:\"delete.usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:14:\"view.auditoria\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:29:\"view.reporte_critico_estables\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:18:\"view.configuracion\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:18:\"edit.configuracion\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:4:\"RRHH\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"Bienestar\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:8:\"Gerencia\";s:1:\"c\";s:3:\"web\";}}}', 1770223720);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clausulas`
--

CREATE TABLE `clausulas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `tipo_aplicable` enum('Temporal','Por incremento de actividad','Indefinido','Practicante','Todas') NOT NULL DEFAULT 'Todas',
  `activa` tinyint(1) NOT NULL DEFAULT 1,
  `orden` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_contratos`
--

CREATE TABLE `codigo_contratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo_base` varchar(50) NOT NULL,
  `correlativo` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `codigo_contratos`
--

INSERT INTO `codigo_contratos` (`id`, `codigo_base`, `correlativo`, `created_at`, `updated_at`) VALUES
(1, 'EMI-ALP-PROY-CM', 5, '2026-01-30 15:29:22', '2026-02-01 01:36:06'),
(2, 'EMI-CEN-ADM', 14, '2026-01-30 15:29:22', '2026-02-03 21:34:05'),
(3, 'EMI-CEN-CANCHA-PB', 1, '2026-01-30 15:29:22', '2026-01-30 21:36:35'),
(4, 'EMI-CHUN-AA-MTP', 4, '2026-01-30 15:29:22', '2026-02-02 14:39:38'),
(5, 'EMI-CHUN-AA-RR', 2, '2026-01-30 15:29:22', '2026-01-31 15:49:36'),
(6, 'EMI-CHUN-ADM', 5, '2026-01-30 15:29:22', '2026-01-31 15:44:17'),
(7, 'EMI-CHUN-CM', 3, '2026-01-30 15:29:22', '2026-01-31 14:29:54'),
(8, 'EMI-CHUN-DC', 1, '2026-01-30 15:29:22', '2026-01-31 16:27:53'),
(9, 'EMI-CHUN-LA', 1, '2026-01-30 15:29:22', '2026-01-31 16:59:47'),
(10, 'EMI-CHUN-PF', 1, '2026-01-30 15:29:22', '2026-01-31 17:16:42'),
(11, 'EMI-CHUN-PROY', 3, '2026-01-30 15:29:22', '2026-02-03 13:46:38'),
(12, 'EMI-CHUN-TRNS', 1, '2026-01-30 15:29:22', '2026-01-31 17:49:16'),
(13, 'EMI-HUA-HH-ORDEN', 0, '2026-01-30 15:29:22', '2026-01-30 15:29:22'),
(14, 'EMI-ROM-PROY', 1, '2026-01-30 15:29:22', '2026-01-31 18:15:58'),
(15, 'EMI-CANCHA-PB', 5, '2026-01-30 22:20:48', '2026-02-01 03:21:24'),
(17, 'EMI-HUA-HH', 2, '2026-01-31 18:04:40', '2026-02-01 03:25:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_empresa`
--

CREATE TABLE `configuracion_empresa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `razon_social` varchar(255) NOT NULL DEFAULT 'EMICONSATH S.A.',
  `ruc` varchar(11) NOT NULL DEFAULT '20489418691',
  `direccion` text NOT NULL DEFAULT 'Mz. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima',
  `gerente_nombre` varchar(255) NOT NULL DEFAULT 'CRUZ CARHUAZ NELSON JOVINO',
  `gerente_titulo` varchar(50) DEFAULT 'Ing.',
  `gerente_dni` varchar(8) NOT NULL DEFAULT '10158128',
  `logo_path` varchar(500) DEFAULT NULL,
  `firma_digital_path` varchar(500) DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuracion_empresa`
--

INSERT INTO `configuracion_empresa` (`id`, `razon_social`, `ruc`, `direccion`, `gerente_nombre`, `gerente_titulo`, `gerente_dni`, `logo_path`, `firma_digital_path`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'EMICONSATH S.A.', '20489418691', 'Mz. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima', 'CRUZ CARHUAZ NELSON JOVINO', 'Ing.', '10158128', NULL, NULL, 1, '2026-01-30 16:34:54', '2026-01-30 16:48:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(8) NOT NULL,
  `tipo_contrato` enum('Para servicio específico','Por incremento de actividad','Otros') NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `tipo_salario` enum('Mensual','Jornal','Ambos') NOT NULL DEFAULT 'Mensual',
  `salario_mensual` decimal(10,2) DEFAULT NULL,
  `salario_jornal` decimal(10,2) DEFAULT NULL,
  `horario` enum('8 horas','14x7','5x2','Otros') NOT NULL DEFAULT '8 horas',
  `beneficios_ley_728` tinyint(1) NOT NULL DEFAULT 1,
  `beneficios_descripcion` text DEFAULT NULL,
  `plantilla_id` bigint(20) UNSIGNED DEFAULT NULL,
  `codigo_base_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Relación con tabla codigo_contratos para generar código automático',
  `numero_contrato` varchar(50) NOT NULL,
  `url_documento_escaneado` varchar(255) DEFAULT NULL,
  `estado` enum('Borrador','Enviado a firmar','Activo','Vencido','Cancelado') NOT NULL DEFAULT 'Borrador',
  `tiempo_acumulado_meses` int(11) NOT NULL DEFAULT 0,
  `alerta_estabilidad_enviada` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_alerta_estabilidad` date DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url_contrato_firmado` varchar(255) DEFAULT NULL,
  `fecha_firma` timestamp NULL DEFAULT NULL,
  `fecha_firma_manual` date DEFAULT NULL COMMENT 'Fecha de firma manual (por defecto un día antes de fecha_inicio)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `dni`, `tipo_contrato`, `fecha_inicio`, `fecha_fin`, `tipo_salario`, `salario_mensual`, `salario_jornal`, `horario`, `beneficios_ley_728`, `beneficios_descripcion`, `plantilla_id`, `codigo_base_id`, `numero_contrato`, `url_documento_escaneado`, `estado`, `tiempo_acumulado_meses`, `alerta_estabilidad_enviada`, `fecha_alerta_estabilidad`, `created_by`, `approved_by`, `created_at`, `updated_at`, `url_contrato_firmado`, `fecha_firma`, `fecha_firma_manual`) VALUES
(57, '42871896', 'Para servicio específico', '2022-01-01', '2026-03-05', 'Mensual', 4500.00, NULL, '8 horas', 1, NULL, 10, 4, 'EMI-CHUN-AA-MTP-004', 'contratos/firmados/contrato_firmado_EMI-CHUN-AA-MTP-004_1770043810.pdf', 'Activo', 9, 0, NULL, 3, NULL, '2026-02-02 14:39:38', '2026-02-03 17:16:06', NULL, '2026-02-02 14:50:10', '2021-12-31'),
(58, '71267323', 'Otros', '2026-01-01', '2026-03-05', 'Mensual', 4540.00, NULL, 'Otros', 1, NULL, 8, 2, 'EMI-CEN-ADM-013', 'contratos/firmados/contrato_firmado_EMI-CEN-ADM-013_1770050966.pdf', 'Activo', 6, 0, NULL, 1, NULL, '2026-02-02 16:49:00', '2026-02-02 17:41:06', NULL, '2026-02-02 16:49:26', '2025-12-31'),
(59, '72506477', 'Para servicio específico', '2026-01-01', '2026-02-05', 'Mensual', 4577.00, NULL, '8 horas', 1, NULL, 17, 11, 'EMI-CHUN-PROY-003', 'contratos/firmados/contrato_firmado_EMI-CHUN-PROY-003_1770128467.pdf', 'Vencido', 59, 1, '2026-02-03', 3, NULL, '2026-02-03 13:46:38', '2026-02-03 20:37:35', NULL, '2026-02-03 14:21:07', '2025-12-31'),
(60, '76543217', 'Para servicio específico', '2026-01-01', '2026-04-01', 'Mensual', 5000.00, NULL, '8 horas', 1, NULL, 7, 2, 'EMI-CEN-ADM-014', 'contratos/firmados/contrato_firmado_EMI-CEN-ADM-014_1770154842.pdf', 'Vencido', 5, 0, NULL, 3, NULL, '2026-02-03 21:34:05', '2026-02-03 21:44:05', NULL, '2026-02-03 21:40:42', '2025-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cumpleaños`
--

CREATE TABLE `cumpleaños` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(8) NOT NULL,
  `fecha_cumpleaños` date NOT NULL,
  `giftcard_entregada` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_entrega_giftcard` date DEFAULT NULL,
  `monto_giftcard` decimal(10,2) DEFAULT NULL,
  `entregado_por` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cumpleaños`
--

INSERT INTO `cumpleaños` (`id`, `dni`, `fecha_cumpleaños`, `giftcard_entregada`, `fecha_entrega_giftcard`, `monto_giftcard`, `entregado_por`, `created_at`, `updated_at`) VALUES
(2, '76648685', '2000-01-30', 1, '2026-02-02', 75.00, 4, '2026-01-28 19:54:57', '2026-02-02 23:16:23'),
(3, '42871896', '2000-01-01', 1, '2026-02-02', 50.00, 4, '2026-02-02 21:09:49', '2026-02-02 23:15:58'),
(4, '71267323', '2000-01-30', 1, '2026-02-02', 50.00, 4, '2026-02-02 21:09:49', '2026-02-02 23:39:09'),
(5, '72506477', '2004-02-05', 1, '2026-02-03', 75.00, 4, '2026-02-02 21:09:49', '2026-02-03 22:04:23'),
(6, '76551023', '2000-01-01', 1, '2026-02-02', 150.00, 4, '2026-02-02 21:09:49', '2026-02-02 23:16:14'),
(7, '76543217', '2000-02-04', 1, '2026-02-03', 100.00, 4, '2026-02-03 00:04:20', '2026-02-03 22:04:46');

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
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_negra`
--

CREATE TABLE `lista_negra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(8) NOT NULL,
  `motivo` enum('Leve','Grave') NOT NULL,
  `descripcion_motivo` text NOT NULL,
  `url_informe_escaneado` varchar(255) DEFAULT NULL,
  `puede_desbloquear` tinyint(1) NOT NULL DEFAULT 0,
  `url_carta_compromiso` varchar(255) DEFAULT NULL,
  `url_autorizacion` varchar(255) DEFAULT NULL,
  `estado` enum('Bloqueado','Desbloqueado','Resuelto') NOT NULL DEFAULT 'Bloqueado',
  `fecha_bloqueo` datetime DEFAULT NULL,
  `fecha_desbloqueo` datetime DEFAULT NULL,
  `bloqueado_por` bigint(20) UNSIGNED DEFAULT NULL,
  `desbloqueado_por` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_negra`
--

INSERT INTO `lista_negra` (`id`, `dni`, `motivo`, `descripcion_motivo`, `url_informe_escaneado`, `puede_desbloquear`, `url_carta_compromiso`, `url_autorizacion`, `estado`, `fecha_bloqueo`, `fecha_desbloqueo`, `bloqueado_por`, `desbloqueado_por`, `created_at`, `updated_at`) VALUES
(7, '76551023', 'Leve', '-', 'lista_negra/lista_negra_76551023_1770064180.pdf', 1, 'lista_negra/cartas_compromiso/carta_compromiso_76551023_1770155473.pdf', NULL, 'Desbloqueado', '2026-02-02 15:29:40', '2026-02-03 16:51:13', 3, 3, '2026-02-02 20:29:40', '2026-02-03 21:51:13'),
(8, '76648685', 'Leve', '--', 'lista_negra/lista_negra_76648685_1770155418.pdf', 1, NULL, NULL, 'Bloqueado', '2026-02-03 16:50:18', NULL, 3, NULL, '2026-02-03 21:50:18', '2026-02-03 21:50:18');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_26_163552_create_permission_tables', 1),
(5, '2026_01_26_164137_create_trabajadores_table', 1),
(6, '2026_01_26_165038_create_contratos_table', 1),
(7, '2026_01_26_165328_create_adendas_table', 1),
(8, '2026_01_26_165444_create_alertas_table', 1),
(9, '2026_01_26_165526_create_lista_negra_table', 1),
(10, '2026_01_26_165619_create_plantillas_table', 1),
(11, '2026_01_26_172817_create_clausulas_table', 1),
(12, '2026_01_26_172852_create_cumpleaños_table', 1),
(15, '2026_01_27_211956_create_auditoria_table', 2),
(16, '2026_01_28_165048_add_contrato_firmado_to_contratos', 3),
(17, '2026_01_28_152740_add_columns_to_plantillas_table', 4),
(18, '2026_01_29_153327_add_cv_path_to_trabajadores_table', 5),
(19, '2026_01_30_000001_create_codigo_contratos_table', 6),
(20, '2026_01_30_000002_add_codigo_base_to_contratos_table', 6),
(21, '2026_01_30_112624_create_configuracion_empresa_table', 7);

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

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5);

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
(1, 'view.trabajadores', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(2, 'create.trabajadores', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(3, 'edit.trabajadores', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(4, 'delete.trabajadores', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(5, 'view.contratos', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(6, 'create.contratos', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(7, 'edit.contratos', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(8, 'delete.contratos', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(9, 'view.salarios.contratos', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(10, 'view.adendas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(11, 'create.adendas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(12, 'edit.adendas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(13, 'delete.adendas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(14, 'view.alertas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(15, 'create.alertas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(16, 'edit.alertas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(17, 'delete.alertas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(18, 'view.lista_negra', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(19, 'create.lista_negra', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(20, 'edit.lista_negra', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(21, 'desbloquear.lista_negra', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(22, 'view.plantillas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(23, 'create.plantillas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(24, 'edit.plantillas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(25, 'delete.plantillas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(26, 'view.clausulas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(27, 'create.clausulas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(28, 'edit.clausulas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(29, 'delete.clausulas', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(30, 'view.cumpleaños', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(31, 'create.cumpleaños', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(32, 'edit.cumpleaños', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(33, 'registrar.giftcard', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(34, 'view.reportes', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(35, 'export.reportes.excel', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(36, 'export.reportes.pdf', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(37, 'view.dashboard', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(38, 'view.usuarios', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(39, 'create.usuarios', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(40, 'edit.usuarios', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(41, 'delete.usuarios', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(42, 'view.auditoria', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(43, 'view.reporte_critico_estables', 'web', '2026-01-28 02:33:13', '2026-01-28 02:33:13'),
(44, 'view.configuracion', 'web', '2026-01-30 16:44:47', '2026-01-30 16:44:47'),
(45, 'edit.configuracion', 'web', '2026-01-30 16:44:49', '2026-01-30 16:44:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantillas`
--

CREATE TABLE `plantillas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `codigo_prefijo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo_contrato` enum('Para servicio específico','Por incremento de actividad') NOT NULL,
  `patron_tipo` enum('A','B','C') NOT NULL DEFAULT 'A',
  `unidad` enum('Central','Chungar','Alpamarca','Huarón','Romina','Baños','Pucará','Otro') DEFAULT NULL,
  `empresa_principal` varchar(255) DEFAULT NULL,
  `ubicacion` text DEFAULT NULL,
  `contenido_html` longtext NOT NULL,
  `blade_template` varchar(255) NOT NULL DEFAULT 'contratos.templates.patron-a',
  `orden` int(11) NOT NULL DEFAULT 0,
  `clausulas_aplicables` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`clausulas_aplicables`)),
  `es_predeterminada` tinyint(1) NOT NULL DEFAULT 0,
  `activa` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plantillas`
--

INSERT INTO `plantillas` (`id`, `nombre`, `codigo_prefijo`, `descripcion`, `tipo_contrato`, `patron_tipo`, `unidad`, `empresa_principal`, `ubicacion`, `contenido_html`, `blade_template`, `orden`, `clausulas_aplicables`, `es_predeterminada`, `activa`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Contrato Temporal - 3 Meses', NULL, 'Contrato por 3 meses - Servicio determinado', 'Para servicio específico', 'A', NULL, NULL, NULL, '<h2>CONTRATO TEMPORAL</h2><p><strong>Trabajador:</strong> {{nombre_completo}}</p><p><strong>DNI:</strong> {{dni}}</p><p><strong>Cargo:</strong> {{cargo}}</p><p><strong>Fecha Inicio:</strong> {{fecha_inicio}}</p><p><strong>Fecha Fin:</strong> {{fecha_fin}}</p><p><strong>Salario:</strong> S/. {{salario_mensual}}</p><p><strong>Horario:</strong> {{horario}}</p><p>Beneficios según Ley 728: {{beneficios_ley_728}}</p>', 'contratos.templates.patron-a', 0, NULL, 1, 0, 1, 3, '2026-01-27 20:58:43', '2026-01-29 23:55:39'),
(2, 'Contrato Indefinido', NULL, 'Contrato permanente - Trabajador estable', '', 'A', NULL, NULL, NULL, '<h2>CONTRATO INDEFINIDO</h2><p><strong>Trabajador:</strong> {{nombre_completo}}</p><p><strong>DNI:</strong> {{dni}}</p><p><strong>Cargo:</strong> {{cargo}}</p><p><strong>Fecha Inicio:</strong> {{fecha_inicio}}</p><p><strong>Salario:</strong> S/. {{salario_mensual}}</p><p>Relación laboral permanente con estabilidad según ley.</p><p>Derechos: Vacaciones, CTS, Aguinaldo, Seguro de salud.</p>', 'contratos.templates.patron-a', 0, NULL, 1, 0, 1, NULL, '2026-01-27 20:58:43', '2026-01-27 20:58:43'),
(3, 'Contrato Practicante', NULL, 'Contrato para estudiantes en prácticas', '', 'A', NULL, NULL, NULL, '<h2>CONTRATO DE PRÁCTICAS</h2><p><strong>Practicante:</strong> {{nombre_completo}}</p><p><strong>DNI:</strong> {{dni}}</p><p><strong>Fecha Inicio:</strong> {{fecha_inicio}}</p><p><strong>Fecha Fin:</strong> {{fecha_fin}}</p><p><strong>Asignación:</strong> S/. {{salario_mensual}}</p><p><strong>Horario:</strong> {{horario}}</p><p>Máximo 6 meses. Sin beneficios laborales. Duración según plan de estudios.</p>', 'contratos.templates.patron-a', 0, NULL, 1, 0, 1, NULL, '2026-01-27 20:58:43', '2026-01-27 20:58:43'),
(4, 'Adenda - Renovación', NULL, 'Renovación de contrato temporal', '', 'A', NULL, NULL, NULL, '<h2>ADENDA - RENOVACIÓN</h2><p><strong>Trabajador:</strong> {{nombre_completo}}</p><p><strong>DNI:</strong> {{dni}}</p><p><strong>Nueva Fecha Inicio:</strong> {{fecha_inicio}}</p><p><strong>Nueva Fecha Fin:</strong> {{fecha_fin}}</p><p><strong>Salario:</strong> S/. {{salario_mensual}}</p><p>Se renueva el contrato por 3 meses más. Mismas condiciones del contrato original.</p><p>Beneficios Ley 728: {{beneficios_ley_728}}</p>', 'contratos.templates.patron-a', 0, NULL, 1, 0, 1, NULL, '2026-01-27 20:58:43', '2026-01-27 20:58:43'),
(5, 'Contrato por Incremento de Actividad', NULL, 'Contrato por aumento excepcional de operaciones', 'Por incremento de actividad', 'A', NULL, NULL, NULL, '<h2>CONTRATO INCREMENTO DE ACTIVIDAD</h2><p><strong>Trabajador:</strong> {{nombre_completo}}</p><p><strong>DNI:</strong> {{dni}}</p><p><strong>Cargo:</strong> {{cargo}}</p><p><strong>Causa:</strong> Aumento excepcional de actividad operacional</p><p><strong>Fecha Inicio:</strong> {{fecha_inicio}}</p><p><strong>Fecha Fin:</strong> {{fecha_fin}}</p><p><strong>Salario:</strong> S/. {{salario_mensual}}</p><p><strong>Horario:</strong> {{horario}}</p><p>Duración máxima 6 meses prorrogables.</p>', 'contratos.templates.patron-a', 0, NULL, 1, 0, 1, NULL, '2026-01-27 20:58:43', '2026-01-27 20:58:43'),
(6, 'EMI-ALP-PROY-CM', 'EMI-ALP-PROY-CM', 'Contrato para servicio específico en Alpamarca', 'Para servicio específico', 'A', 'Alpamarca', 'COMPAÑÍA MINERA CHUNGAR SAC', 'Alpamarca', 'EMI-ALP-PROY-CM-«N» CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominará LA EMPRESA; y de otra parte Don (ña) «APELLIDOS_Y_NOMBRES» con D.N.I. N° «N_DNI», domiciliado en «DIRECCIÓN», a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLAUSULA PRIMERA. – ANTECEDENTES DE LA EMPRESA LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversa índole, dedicada a brindar un servicio integral en minería superficial y subterránea tales como: obras civiles, gestión ambiental, transporte y servicios generales. de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha recibido una Orden de Servicio de “CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA” (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Alpamarca de la cual es titular, y que se encuentra ubicada en el Distrito de Santa Barbara de Carhuacayan, Provincia de Yauli y Departamento de Junín. CLAUSULA SEGUNDA. – CAUSA OBJETIVA Y NATURALEZA DE CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “«CARGO»”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA”. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLAUSULA TERCERA. – OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “«OBJETO_CARGO»”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Alpamarca, ubicada en el Distrito de Santa Barbara de Carhuacayan, Provincia de Yauli y Departamento de Junín. Tratándose de un contrato de trabajo sujeto a modalidad por servicio específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución del “CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA”. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: «ORIGEN». El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de («PERIODO») del «INICIO» al «FINAL». Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – JORNADA Y HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las partes dejan expresa cons...', 'contratos.templates.EMI-ALP-PROY-CM', 1, NULL, 0, 1, 1, 3, '2026-01-28 20:47:04', '2026-01-30 00:00:12'),
(7, 'EMI-CEN-ADM-8HORAS', 'EMI-CEN-ADM', 'Contrato para administración - 8 horas', 'Para servicio específico', 'B', 'Central', 'EMICONSATH S.A.', 'Oficina Central - Ate', 'l', 'contratos.templates.EMI-CEN-ADM-8HORAS', 2, NULL, 0, 1, 1, 3, '2026-01-28 20:47:04', '2026-01-30 16:02:05'),
(8, 'EMI-CEN-ADM-14X7', 'EMI-CEN-ADM', 'Contrato para administración - Sistema 14x7', '', 'B', 'Central', 'EMICONSATH S.A.', 'Oficina Central - Ate', 'EMI-CEN-ADM-019-2024 CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mz. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominara LA EMPRESA; y de otra parte Don (ña) ALARCON GUTIERREZ ALBERT AISTEN, identificado con D.N.I. N° 42871896, domiciliado en Jr. 7 de Abril 129, Distrito de Ayacucho, Provincia de Huamanga y Departamento de Ayacucho, a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLAUSULA PRIMERA. – ANTECEDENTES DE LA EMPRESA LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversos indoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes. CLAUSULA SEGUNDA. – CAUSA OBJETIVA Y NATURALEZA DE CONTRATACIÓN Debido a la ejecución de nuevos proyectos dentro de LA EMPRESA se generó el incremento de actividades en diferentes Áreas tales como Administración, Proyectos y Asuntos Ambientales la cual ha traído consigo una mayor producción en la Construcción en obras civiles, a la cual pertenece EL TRABAJADOR y en la que debe realizar labores en calidad de “INGENIERO DE COSTOS Y PRESUPUESTOS”, debiendo someterse al cumplimiento estricto de la labor, para lo cual ha sido contratado, bajo las directivas de sus jefes y/o instructores, y las que se impartan por necesidades del servicio. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. Asimismo, Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLAUSULA TERCERA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: 12 de Octubre del 2024. El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de (02 meses y 20 días) del 12 de Octubre del 2024 al 31 de Diciembre del 2024. Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA CUARTA. – JORNADA Y HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las partes dejan expresa constancia que la jornada de trabajo, horario de trabajo y día o días de descanso de EL TRABAJADOR no serán fijos, sino más bien flexibles. En consecuencia, ambas partes convienen en que LA EMPRESA, de acuerdo a sus necesidades operativas, productivas y administrativas, tendrán la facultad de determinar y variar los días de trabajo, el día de descanso semanal obligatorio, los horarios y jornada de trabajos, pudiendo incluso modificar, suprimir o implantar turnos rotativos y establecer jornadas atípicas, concentradas o compensatorias de trabajo y descanso. En tal sentido en razón al sistema de Operaciones de LA EMPRESA y en propio beneficio del trabajador, ambas partes acuerdan que EL TRABAJADOR, deberá prestar sus servicios en el siguiente horario Sistema (14*7), de 08:00 am a 07:37 pm. Teniendo un refrigerio de (80 minutos), que será de 12:30 pm a 1:50 pm. De igual manera queda establecido que los turnos de trabajo serán rotativos, según la programación y necesidades de LA EMPRESA, queda expresamente establecido que la modalidad de horario de trabajo puede ser modificado de acuerdo a las necesidades de la empresa. El control de los periodos de trabajo, de descanso y horario de trabajo, estará a cargo de LA EMPRESA, la cual entregará al TRABAJADOR una tarjeta de tarea diario y una papeleta de movimiento de personal para su periodo de descanso para su con...', 'contratos.templates.EMI-CEN-ADM-14X7', 3, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(9, 'EMI-CEN-CANCHA-PB', 'EMI-CANCHA-PB', 'Contrato por incremento de actividad', 'Por incremento de actividad', 'C', 'Central', 'EMICONSATH S.A.', 'Canchacucho - Huayllay - Pasco', 'EMI-CANCHA-PB-004-2024 CONTRATO DE TRABAJO SUJETO A MODALIDAD POR INCREMENTO DE ACTIVIDAD Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Incremento de Actividad, que celebran de conformidad con el Artículo 57° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominará LA EMPRESA; y de otra parte Don (ña) ESPINOZA BARRUETA YONATAN ROY, identificado con D.N.I. N° 76551023, domiciliado en Asent. H. Luz y Paz Mz. 23 Lt. 06 del Distrito de Manantay, Provincia de Coronel Portillo y Departamento de Ucayali, a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLAUSULA PRIMERA. – ANTECEDENTES DE LA EMPRESA LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversa índole, dedicada a brindar un servicio integral en minería superficial y subterránea tales como: obras civiles, gestión ambiental, transporte y servicios generales. de acuerdo a la necesidad de nuestros clientes, Asimismo. LA EMPRESA ha iniciado una nueva actividad relacionado a la fabricación de bloques de concreto para construcción y que se encuentra ubicada en el C.P. de Canchacucho, en el Distrito de Huaylllay, Provincia y Departamento de Pasco CLAUSULA SEGUNDA. – CAUSA OBJETIVA Y NATURALEZA DE CONTRATACIÓN Por el presente contrato y de conformidad con lo dispuesto por el artículo 57 del Texto Único Ordenado del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral, aprobado por el Decreto Supremo N° 003-97-TR, EL EMPLEADOR contrata a EL TRABAJADOR bajo la modalidad de Contrato de Incremento de Actividad, a fin de que desarrolle las labores de OPERADOR DE PLANTA BLOQUETERA. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLAUSULA TERCERA. – OBJETO DEL CONTRATO EL TRABAJADOR desempeñará sus labores en el cargo de OPERADOR DE PLANTA BLOQUETERA, desarrollando las labores referente a dicho cargo; sin embargo LA EMPRESA está facultado a efectuar modificaciones razonables en función a la capacidad y aptitud de EL TRABAJADOR, sin que dichas variaciones signifiquen menoscabo de remuneración, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. Queda entendido que la prestación de servicios deberá ser efectuada de manera personal, no pudiendo EL TRABAJADOR ser reemplazado ni ayudado por tercera persona. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: 01 de Junio del 2024. El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de (04 meses) del 01 de Junio del 2024 al 30 de Setiembre del 2024, en el que concluye la prestación de servicios, sin necesidad de aviso previo entre las partes. A la conclusión del contrato LA EMPRESA abonará a EL TRABAJADOR, los beneficios sociales que pudieran corresponderle de acuerdo a la legislación laboral vigente. Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. - PERIODO DE PRUEBA EL TRABAJADOR estará sujeto a 3 meses de periodo de prueba, de conformidad con lo establecido en los artículos 10 y 75 de la LPCL. CLAUSULA SEXTA. – JORNADA Y HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las partes dejan expresa constancia que la jornada de trabajo, horario de trabajo y día o días de descanso de EL TRABAJADOR no serán fijos, sino más bien flexibles. En consecuencia, ambas partes convienen en que EL EMPLEADOR, de acuerdo a sus necesidades operativas, productivas y administrativas, tendrán la facultad de determinar y variar los días de trabajo, el día de descanso semanal obligatorio, los horarios y jornada de trabajos, pudiendo incluso modificar, suprimir o implantar turnos rotativos y establecer jornadas atípicas, concentradas o compensatorias de trabajo y descanso. En tal sentido en razón al sistema de Operaciones de LA EMPRESA y en propio beneficio del trabajador, am...', 'contratos.templates.EMI-CEN-CANCHA-PB', 4, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(10, 'EMI-CHUN-AA-MTP', 'EMI-CHUN-AA-MTP', 'Contrato para servicios ambientales en Chungar', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-AA-MTP-«CÓDIGO» CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominará LA EMPRESA; y de otra parte Don (ña) «APELLIDOS_Y_NOMBRES» con D.N.I. N° «N_DNI», domiciliado en «DIRECCIÓN», a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. - ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversas índoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha celebrado un Contrato de Tercerización de “SERVICIO DE: MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA RESIDUAL INDUSTRIAL, MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA RESIDUAL DOMÉSTICA, MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA POTABLE, ORDEN Y LIMPIEZA DEL ALMACÉN QUIMACOCHA, APILAMIENTO DE RESIDUOS EN TRINCHERA SANITARIA, MONITOREO AMBIENTAL Y TRABAJOS EN CAMPO” CHUNGAR - HUAYLLAY (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “«CARGO»”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE: MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA RESIDUAL INDUSTRIAL, MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA RESIDUAL DOMÉSTICA, MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA POTABLE, ORDEN Y LIMPIEZA DEL ALMACÉN QUIMACOCHA, APILAMIENTO DE RESIDUOS EN TRINCHERA SANITARIA, MONITOREO AMBIENTAL Y TRABAJOS EN CAMPO” CHUNGAR - HUAYLLAY. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de «OBJETO_CARGO»”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Dpto. de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución de los “SERVICIO DE: MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA RESIDUAL INDUSTRIAL, MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA RESIDUAL DOMÉSTICA, MANEJO Y OPERACIÓN DE LA PLANTA DE AGUA POTABLE, ORDEN Y LIMPIEZA DEL ALMACÉN QUIMACOCHA, APILAMIENTO DE RESIDUOS EN TRINCHERA SANITARIA, MONITOREO AMBIENTAL Y TRABAJOS EN CAMPO” CHUNGAR - HUAYLLAY. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PL...', 'contratos.templates.EMI-CHUN-AA-MTP', 5, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(11, 'EMI-CHUN-AA-RR', 'EMI-CHUN-AA-RR', 'Contrato para manejo de residuos sólidos', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-AA-RR-010-2024 CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominará LA EMPRESA; y de otra parte Don (ña) VILLANUEVA CONTRERAS YERSON TITO con D.N.I. N° 71021865, domiciliado en la Jr. Garu S/N Barrio Sector 1 del distrito de Huayllay, Provincia y Departamento de Pasco, a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. - ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversas índoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes LA EMPRESA ha celebrado un Contrato de Tercerización de “SERVICIO DE MANEJO DE RESIDUOS SÓLIDOS” CHUNGAR - HUAYLLAY (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “CAPATAZ DE ASUNTOS AMBIENTALES”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE MANEJO DE RESIDUOS SÓLIDOS” CHUNGAR - HUAYLLAY. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “CAPATAZ DE ASUNTOS AMBIENTALES”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución de los “SERVICIO DE MANEJO DE RESIDUOS SÓLIDOS” CHUNGAR - HUAYLLAY. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: 07 de Marzo del 2023. El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de (03 meses) del 01 Enero del 2024 al 31 de Marzo del 2024. Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las partes dejan expres...', 'contratos.templates.EMI-CHUN-AA-RR', 6, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(12, 'EMI-CHUN-ADM', 'EMI-CHUN-ADM', 'Contrato para funciones administrativas en Chungar', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-ADM-«CÓDIGO» CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominará LA EMPRESA; y de otra parte Don (ña) «APELLIDOS_Y_NOMBRES» con D.N.I. N° «N_DNI», domiciliado en la «DIRECCIÓN», a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. - ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversas índoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha celebrado un Contrato de Tercerización de “SERVICIO DE OBRAS CIVILES, REMODELACIONES, CARPINTERÍA, MANEJO DE RESIDUOS RELACIONADOS AL MEDIO AMBIENTE Y SERVICIO DE REFORESTACIÓN EN ZONAS CIRCULANTES A LA UNIDAD DE PRODUCCIÓN.” CHUNGAR - HUAYLLAY (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “«CARGO»”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE OBRAS CIVILES, REMODELACIONES, CARPINTERÍA, MANEJO DE RESIDUOS RELACIONADOS AL MEDIO AMBIENTE Y SERVICIO DE REFORESTACIÓN EN ZONAS CIRCULANTES A LA UNIDAD DE PRODUCCIÓN.” CHUNGAR - HUAYLLAY. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “«OBJETO_CARGO»”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución del “SERVICIO DE OBRAS CIVILES, REMODELACIONES, CARPINTERÍA, MANEJO DE RESIDUOS RELACIONADOS AL MEDIO AMBIENTE Y SERVICIO DE REFORESTACIÓN EN ZONAS CIRCULANTES A LA UNIDAD DE PRODUCCIÓN.” CHUNGAR - HUAYLLAY. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: «ORIGEN». El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de («PERIODO») del «INICIO» al «FINAL». Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las partes dejan expresa constancia que la jornada de trabajo, horario de trabajo y día o días de descanso de EL TRABAJADOR no serán fijos, sino más bien flexibles. En consecuencia, ambas partes convienen en que EL EMPLEADOR, de acuerdo a sus necesidades operativas, productivas y administrativas, tendrán la facultad de determinar y variar los días de trabajo, el día de descanso semanal obligatorio, los horarios y jornada de trabajos, pudiendo incluso modificar, suprimir o im...', 'contratos.templates.EMI-CHUN-ADM', 7, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(13, 'EMI-CHUN-CM', 'EMI-CHUN-CM', 'Contrato para operadores de movimiento de tierras', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-CM-002-2024 CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominara LA EMPRESA; y de otra parte Don (ña) ARTEAGA CRISTOBAL RIVALDO JHAMES identificado con DNI Nº 73207053, con domicilio en la Cochamarca S/N, del Distrito de Vicco, Provincia y Departamento de Pasco. a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. – ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversas índoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha celebrado un Contrato de Tercerización de “SERVICIO DE MOVIMIENTO DE TIERRAS – PLANTA ANIMÓN” CHUNGAR – HUAYLLAY (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “OPERADOR DE TIPO 4”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE MOVIMIENTO DE TIERRAS – PLANTA ANIMÓN” CHUNGAR – HUAYLLAY. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “OPERADOR DE TIPO 4”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución del “SERVICIO DE MOVIMIENTO DE TIERRAS – PLANTA ANIMÓN”. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: 18 de julio del 2022. El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de (03 meses) del 01 Enero del 2024 al 31 de Marzo del 2024. Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las partes dejan expresa constancia que...', 'contratos.templates.EMI-CHUN-CM', 8, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(14, 'EMI-CHUN-DC', 'EMI-CHUN-DC', 'Contrato para auxiliares de despacho en Chungar', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-DC-005-2024 CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominara LA EMPRESA; y de otra parte Don (ña) ZEVALLOS SILVESTRE JHOMAR identificado con DNI Nº 73207034, con domicilio en la Av. Circunvalación Arenales 497, Distrito de Chaupimarca, Provincia y Departamento de Pasco. a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. – ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversas índoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha celebrado un Contrato de Tercerización de “SERVICIO DE MOVIMIENTO DE TIERRAS – PLANTA ANIMÓN” CHUNGAR – HUAYLLAY (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “AUXILIAR DE DESPACHO”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE MOVIMIENTO DE TIERRAS – PLANTA ANIMÓN” CHUNGAR – HUAYLLAY. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “AUXILIAR DE DESPACHO”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución del “SERVICIO DE MOVIMIENTO DE TIERRAS – PLANTA ANIMÓN”. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: 26 de setiembre del 2023. El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de (03 meses) del 01 Enero del 2024 al 31 de Marzo del 2024. Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las partes dejan ex...', 'contratos.templates.EMI-CHUN-DC', 9, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02');
INSERT INTO `plantillas` (`id`, `nombre`, `codigo_prefijo`, `descripcion`, `tipo_contrato`, `patron_tipo`, `unidad`, `empresa_principal`, `ubicacion`, `contenido_html`, `blade_template`, `orden`, `clausulas_aplicables`, `es_predeterminada`, `activa`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(15, 'EMI-CHUN-LA', 'EMI-CHUN-LA', 'Contrato para operadores de equipo de línea amarilla', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-LA-«CÓDIGO» CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominara LA EMPRESA; y de otra parte Don (ña) «APELLIDOS_Y_NOMBRES» identificado con DNI Nº «N_DNI», con domicilio en «DIRECCIÓN», a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. – ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversa índole, dedicada a brindar un servicio integral en minería superficial y subterránea tales como: obras civiles, gestión ambiental, transporte y servicios generales. de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha celebrado un Contrato de Tercerización de “SERVICIO DE ALQUILER DE EQUIPO DE LÍNEA AMARILLA PARA CODISPOSICIÓN RELAVE – UNIDAD CHUNGAR” (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “«CARGO»”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE OPERACIÓN DE EQUIPO DE LÍNEA AMARILLA PARA CODISPOSICIÓN RELAVE – UNIDAD CHUNGAR” Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “«OBJETO_CARGO»”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución del “SERVICIO DE ALQUILER DE EQUIPO DE LÍNEA AMARILLA PARA CODISPOSICIÓN RELAVE – UNIDAD CHUNGAR”. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: «ORIGEN». El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de («PERIODO») del «INICIO» al «FINAL». Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados se desarrollaran de acuerdo al siguiente horario Sistema (14*7), de 06:43 am a 06:00 pm. Teniendo un refrigerio de (60 minutos), que será de 12:00 m a 1:00 pm. En consec...', 'contratos.templates.EMI-CHUN-LA', 10, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(16, 'EMI-CHUN-PF', 'EMI-CHUN-PF', 'Contrato para limpieza industrial en planta de filtrado', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-PF-002 CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominara LA EMPRESA; y de otra parte Don (ña) ARTEAGA CRISTOBAL RIVALDO JHAMES identificado con DNI Nº 73207053, con domicilio en la Cochamarca S/N, del Distrito de Vicco, Provincia y Departamento de Pasco. a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. – ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversas índoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha celebrado un Contrato de Tercerización de “LIMPIEZA INDUSTRIAL EN LA PLANTA DE FILTRADO DE RELAVE - ANIMÓN” CHUNGAR – HUAYLLAY (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “OPERADOR DE TIPO 4”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “LIMPIEZA INDUSTRIAL EN LA PLANTA DE FILTRADO DE RELAVE - ANIMÓN” CHUNGAR – HUAYLLAY. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “OPERADOR DE TIPO 4”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución del “LIMPIEZA INDUSTRIAL EN LA PLANTA DE FILTRADO DE RELAVE - ANIMÓN” CHUNGAR – HUAYLLAY”. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: 18 de julio del 2022. El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de (03 meses) del 01 Enero del 2024 al 31 de Marzo del 2024. Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR presta...', 'contratos.templates.EMI-CHUN-PF', 11, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(17, 'EMI-CHUN-PROY', 'EMI-CHUN-PROY', 'Contrato para ayudantes en proyectos de obras civiles', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-PROY-034 CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominará LA EMPRESA; y de otra parte Don (ña) CARHUAS TRINIDAD ABAD SILVERIO con D.N.I. N° 44554073, domiciliado en CP Los Andes de Pucara Barrio San Pablo, Distrito de Huayllay, Provincia y Departamento de Pasco, a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. - ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversas índoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha celebrado un Contrato de Tercerización de “SERVICIO DE OBRAS CIVILES, REMODELACIONES, CARPINTERIA, MANEJO DE RESIDUOS RELACIONADOS AL MEDIO AMBIENTE Y SERVICIO DE REFORESTACION EN ZONAS CIRCULANTES A LA UNIDAD DE PRODUCCION.” CHUNGAR - HUAYLLAY (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento. de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACION A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “AYUDANTE DE OBRAS CIVILES”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE OBRAS CIVILES, REMODELACIONES, CARPINTERÍA, MANEJO DE RESIDUOS RELACIONADOS AL MEDIO AMBIENTE Y SERVICIO DE REFORESTACIÓN EN ZONAS CIRCULANTES A LA UNIDAD DE PRODUCCIÓN.” CHUNGAR – HUAYLLAY. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “AYUDANTE DE OBRAS CIVILES”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución de los “SERVICIO DE OBRAS CIVILES, REMODELACIONES, CARPINTERÍA, MANEJO DE RESIDUOS RELACIONADOS AL MEDIO AMBIENTE Y SERVICIO DE REFORESTACIÓN EN ZONAS CIRCULANTES A LA UNIDAD DE PRODUCCIÓN.” CHUNGAR – HUAYLLAY. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: 01 de Octubre del 2024. El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de (03 meses) del 01 de Octubre del 2024 al 31 de Diciembre del 2024. Las partes acuerdan que ...', 'contratos.templates.EMI-CHUN-PROY', 12, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(18, 'EMI-CHUN-TRNS', 'EMI-CHUN-TRNS', 'Contrato para conductores de transporte', '', 'A', 'Chungar', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Chungar - Huayllay - Pasco', 'EMI-CHUN-TRNS-002-2024 CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominara LA EMPRESA; y de otra parte Don (ña) HINOSTROZA ALVAREZ GYOREY EFRAIN identificado con DNI Nº 72159429, con domicilio en la Jr. Huanuco 0015, Distrito Huayllay, Provincia y Departamento de Pasco. a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLÁUSULA PRIMERA. – ANTECEDENTES LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversas índoles en minería como son la realización de obras civiles operación de sistemas medioambientales de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha celebrado un Contrato de Tercerización de “SERVICIO DE MOVIMIENTO DE TIERRA – PLANTA ANIMÓN” CHUNGAR - HUAYLLAY (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Chungar de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento de Pasco. CLÁUSULA SEGUNDA. - CAUSA OBJETIVA PARA LA CONTRATACION A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “CONDUCTOR DE TIPO 2”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE MOVIMIENTO DE TIERRA – PLANTA ANIMÓN” CHUNGAR - HUAYLLAY Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLÁUSULA TERCERA. - OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “CONDUCTOR DE TIPO 2”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Chungar, ubicada en el Distrito de Huayllay, Provincia de Pasco, Departamento de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución de los “SERVICIO DE MOVIMIENTO DE TIERRA – PLANTA ANIMÓN” CHUNGAR - HUAYLLAY. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: 11 de noviembre del 2023. El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de (01 mes y 21 días) del 01 Enero del 2024 al 31 de Marzo del 2024. Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las parte...', 'contratos.templates.EMI-CHUN-TRNS', 13, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(19, 'EMI-HUA-HH-ORDEN', 'EMI-HUA-HH', 'Contrato para servicios en Huarón', '', 'A', 'Huarón', 'PAN AMERICAN SILVER HUARON S.A.', 'UEA Huarón - Huayllay - Pasco', 'EMI-HUA-HH-«CÓDIGO» CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 Av. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominará LA EMPRESA; y de otra parte Don (ña) «APELLIDOS_Y_NOMBRES» con D.N.I. N° «N_DNI», domiciliado en el «DIRECCIÓN», a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLAUSULA PRIMERA. – ANTECEDENTES DE LA EMPRESA LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversa índole, dedicada a brindar un servicio integral en minería superficial y subterránea tales como: obras civiles, gestión ambiental, transporte y servicios generales. de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha recibido una Orden de Trabajo de “SERVICIO DE LIMPIEZA EN PLANTA CONCENTRADORA” (en adelante, Orden de trabajo) con PAN AMERICAN SILVER HUARON S.A., con el objeto de ejecutar los servicios en la UEA Huarón de la cual es titular, y que se encuentra ubicada en el Distrito de Huayllay, Provincia de Pasco, Dpto. de Pasco. CLAUSULA SEGUNDA. – CAUSA OBJETIVA Y NATURALEZA DE CONTRATACIÓN A fin de cumplir con los servicios materia de la Orden de Trabajo, LA EMPRESA requiere cubrir temporalmente el puesto de “«CARGO»”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “SERVICIO DE LIMPIEZA EN PLANTA CONCENTRADORA” Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLAUSULA TERCERA. – OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “«OBJETO_CARGO»”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Huarón, ubicada en el Distrito de Huayllay, Provincia de Pasco, Dpto. de Pasco. Tratándose de un Contrato de Trabajo sujeto a Modalidad por Servicio Específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución de de “SERVICIO DE LIMPIEZA EN PLANTA CONCENTRADORA” Para los cuales LA EMPRESA fue contratada en virtud a la Orden de Servicio suscrito con PAN AMERICAN SILVER HUARON S.A., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA PAN AMERICAN SILVER HUARON S.A. (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: «ORIGEN». El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de («PERIODO») del «INICIO» al «FINAL». Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – JORNADA Y HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados se desarrollaran de acuerdo al siguiente horario Sistema (14*7), de 07:00 am a 07:00 pm. Teniendo un refrigerio de (60 minutos), que será de 12:00 m a 1:00 pm. En consecuencia, ambas partes convienen en que LA EMPRESA, de acuerdo a sus nece...', 'contratos.templates.EMI-HUA-HH-ORDEN', 14, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02'),
(20, 'EMI-ROM-PROY', 'EMI-ROM-PROY', 'Contrato para proyectos en unidad Romina', '', 'A', 'Romina', 'COMPAÑÍA MINERA CHUNGAR SAC', 'UEA Alpamarca - Yauli - Junín', 'EMI-ROM-PROY-«CÓDIGO» CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, EMICONSATH S.A. con RUC Nº 20489418691, y domicilio en Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima, debidamente representada por su Gerente General Ing. CRUZ CARHUAZ NELSON JOVINO con D.N.I N° 10158128, a quien en adelante se le denominará LA EMPRESA; y de otra parte Don (ña) «APELLIDOS_Y_NOMBRES» con D.N.I. N° «N_DNI», domiciliado en «DIRECCIÓN», a quien en lo sucesivo se le denominará EL TRABAJADOR; en los términos y condiciones siguientes: CLAUSULA PRIMERA. – ANTECEDENTES DE LA EMPRESA LA EMPRESA es una persona jurídica cuyo objeto social es prestar servicios de diversa índole, dedicada a brindar un servicio integral en minería superficial y subterránea tales como: obras civiles, gestión ambiental, transporte y servicios generales. de acuerdo a la necesidad de nuestros clientes. LA EMPRESA ha recibido una Orden de Servicio de “(TRABAJOS CIVILES EN SUPERFICIE – ROMINA) – UNIDAD MINERA ROMINA” (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Alpamarca de la cual es titular, y que se encuentra ubicada en el Distrito de Santa Barbara de Carhuacayan, Provincia de Yauli y Departamento de Junín. CLAUSULA SEGUNDA. – CAUSA OBJETIVA Y NATURALEZA DE CONTRATACIÓN A fin de cumplir con los servicios materia del Contrato Principal, LA EMPRESA requiere cubrir temporalmente el puesto de “«CARGO»”, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de “(TRABAJOS CIVILES EN SUPERFICIE – ROMINA) – UNIDAD MINERA ROMINA”. Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, EL TRABAJADOR se encontrará subordinado de manera exclusiva a LA EMPRESA, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado. En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY. CLAUSULA TERCERA. – OBJETO DEL CONTRATO En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento LA EMPRESA contrata a plazo determinado bajo la modalidad de Servicio Específico para que EL TRABAJADOR realice las labores de “«OBJETO_CARGO»”, según perfil de puesto. Se deja constancia que EL TRABAJADOR cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Alpamarca, ubicada en el Distrito de Santa Barbara de Carhuacayan, Provincia de Yauli y Departamento de Junín. Tratándose de un contrato de trabajo sujeto a modalidad por servicio específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución del “(TRABAJOS CIVILES EN SUPERFICIE – ROMINA) – UNIDAD MINERA ROMINA”. Para los cuales LA EMPRESA fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que EL TRABAJADOR declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre LA EMPRESA y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre LA EMPRESA y EL TRABAJADOR. Se deja constancia que las funciones que desempeñara EL TRABAJADOR podrán ser modificadas en el futuro por LA EMPRESA, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que EL TRABAJADOR desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato. CLAUSULA CUARTA. - PLAZO DE VIGENCIA El inicio del acuerdo contractual es: «ORIGEN». El plazo de Vigencia del presente contrato entre EL TRABAJADOR y LA EMPRESA es por el periodo de («PERIODO») del «INICIO» al «FINAL». Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de LA LEY no interrumpirá el plazo de duración del Contrato. CLAUSULA QUINTA. – JORNADA Y HORARIO DE TRABAJO Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca LA EMPRESA en el área en que EL TRABAJADOR prestara sus servicios. Las partes dejan expresa constanc...', 'contratos.templates.EMI-ROM-PROY', 15, NULL, 0, 1, 1, NULL, '2026-01-28 20:47:04', '2026-01-28 21:34:02');

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
(1, 'Admin', 'web', '2026-01-28 02:33:12', '2026-01-28 02:33:12'),
(2, 'RRHH', 'web', '2026-01-28 02:33:12', '2026-01-28 02:33:12'),
(3, 'Bienestar', 'web', '2026-01-28 02:33:12', '2026-01-28 02:33:12'),
(4, 'Gerencia', 'web', '2026-01-28 02:33:12', '2026-01-28 02:33:12');

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
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(15, 1),
(16, 1),
(16, 2),
(16, 3),
(17, 1),
(17, 3),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(24, 1),
(24, 2),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(32, 1),
(32, 3),
(33, 1),
(33, 3),
(34, 1),
(34, 2),
(34, 4),
(35, 1),
(35, 2),
(35, 4),
(36, 1),
(37, 1),
(37, 2),
(37, 3),
(37, 4),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(43, 2),
(43, 4),
(44, 1),
(45, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lTLzcyuYANke98RaIQjhcwkGvQL4LrVyGJLDmaCo', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVcyQm9XQm1PTThkYTJzc2lUTlZsSjllY0djcFNWUzVWelVKaGZubCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1770153138),
('Sz8JcoNfviWQUDTm0OHucqPiATlCvPu0rFp9JQF9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibFVYdlVzV0pKSXdqTWRkU2ZYTnRic2pnS0NpRGNDemFteUJ3bzEyMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1770157715);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `dni` varchar(8) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `nacionalidad` varchar(50) NOT NULL DEFAULT 'Peruana',
  `cargo` varchar(100) NOT NULL,
  `area_departamento` varchar(100) DEFAULT NULL,
  `unidad` enum('Chungar','Huarón','Romina','Baños','Alpamarca','Otra','Central') NOT NULL DEFAULT 'Otra',
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion_actual` text DEFAULT NULL,
  `contacto_emergencia` varchar(150) DEFAULT NULL,
  `telefono_emergencia` varchar(15) DEFAULT NULL,
  `cuenta_bancaria` varchar(20) DEFAULT NULL,
  `cci` varchar(20) DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL COMMENT 'Ruta del CV en PDF del trabajador',
  `estado` enum('Activo','Inactivo','Suspendido') NOT NULL DEFAULT 'Activo',
  `fecha_ingreso` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`dni`, `nombre_completo`, `fecha_nacimiento`, `nacionalidad`, `cargo`, `area_departamento`, `unidad`, `telefono`, `email`, `direccion_actual`, `contacto_emergencia`, `telefono_emergencia`, `cuenta_bancaria`, `cci`, `cv_path`, `estado`, `fecha_ingreso`, `created_at`, `updated_at`) VALUES
('42871896', 'ALARCON GUTIERREZ ALBERT AISTEN', '2000-01-01', 'Peruana', 'INGENIERO DE COSTOS Y PRESUPUESTOS', NULL, 'Chungar', NULL, NULL, 'Jr. 7 de Abril 129, Distrito de Ayacucho, Provincia de Huamanga y Departamento de Ayacucho', NULL, NULL, NULL, NULL, NULL, 'Activo', '2022-01-01', '2026-01-30 20:45:41', '2026-02-03 17:15:06'),
('71267323', 'FERNANDEZ CAJACHAHUA VICTOR', '2000-01-30', 'Peruana', 'INGENIERO DE SISTEMAS', 'AYUDANTE DE RELAVE', 'Central', '975609083', '211440365@undac.edu.pe', 'pasco\r\npasco', NULL, NULL, NULL, NULL, 'trabajadores/cvs/cv_71267323_1769721124.pdf', 'Activo', '2026-01-01', '2026-01-29 21:07:51', '2026-02-02 16:49:00'),
('72506477', 'MAYTA SANTOS LUIGI RIKY', '2004-02-05', 'Peruana', 'INGENIERO DE SISTEMAS', 'SISTEMAS Y TI', 'Central', NULL, NULL, 'Pasco-Huayllay', NULL, NULL, NULL, NULL, NULL, 'Activo', '2026-01-01', '2026-02-02 21:07:48', '2026-02-03 14:12:48'),
('76543217', 'MAYTA SANTOS LUIGILLO', '2000-02-04', 'Peruana', 'PRACTICANTE', 'AYUDANTE DE RELAVE', 'Central', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', '2026-01-01', '2026-02-03 00:04:07', '2026-02-03 00:04:07'),
('76551023', 'ESPINOZA BARRUETA YONATAN ROY', '2000-01-01', 'Peruana', 'OPERADOR DE PLANTA BLOQUETERA', 'OPERADOR DE PLANTA BLOQUETERA', 'Otra', NULL, NULL, 'Asent. H. Luz y Paz Mz. 23 Lt. 06 del Distrito de Manantay, Provincia de Coronel Portillo y Departamento de Ucayali', NULL, NULL, NULL, NULL, NULL, 'Activo', '2024-06-01', '2026-01-30 21:35:20', '2026-02-03 21:51:13'),
('76648685', 'AGUILAR NUEVO JOSE ANTONIO', '2000-01-30', 'Peruana', 'AYUDANTE DE RELAVE', 'AYUDANTE DE RELAVE', 'Chungar', '987654321', '987654321@undac.edu.pe', 'pasco\r\npasco', '987654321', '975609080', NULL, NULL, NULL, 'Suspendido', '2026-01-01', '2026-01-28 19:53:43', '2026-02-03 21:50:18');

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
(1, 'Administrador', 'admin@emiconsath.com', NULL, '$2y$12$f2L4m8UWWWQrRMURGkqyW.1QcxEBrA2.8BAOl/iITRrJRiMGxQdw2', NULL, '2026-01-27 02:33:40', '2026-01-27 02:33:40'),
(3, 'administracion central', 'administracion@emiconsath.com', NULL, '$2y$12$0jsC7ErckNP2m7FalmoGJuPuSBfRTqDkBQAkALgdDrJHJ9FPiubjS', NULL, '2026-01-27 02:34:25', '2026-02-03 20:25:03'),
(4, 'Edy', 'bienestar@emiconsath.com', NULL, '$2y$12$5HzzC7ocYDAuMkHCtu7a7ebw6A.5PUTRREbhBucXS5HLeFF39uM0e', NULL, '2026-01-27 02:34:47', '2026-02-03 20:25:29'),
(5, 'Pedro Martínez', 'gerencia@emiconsath.com', NULL, '$2y$12$VcFlEpc0sea5Ompyr04WeO/j8k/Ngb.VwnnduBdgmlyUy7Ae6x83C', NULL, '2026-01-27 02:35:31', '2026-02-03 20:26:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adendas`
--
ALTER TABLE `adendas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adendas_numero_adenda_contrato_unique` (`numero_adenda_contrato`),
  ADD KEY `adendas_adenda_anterior_id_foreign` (`adenda_anterior_id`),
  ADD KEY `adendas_dni_index` (`dni`),
  ADD KEY `adendas_contrato_id_index` (`contrato_id`),
  ADD KEY `adendas_estado_index` (`estado`),
  ADD KEY `adendas_fecha_fin_index` (`fecha_fin`);

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alertas_contrato_id_foreign` (`contrato_id`),
  ADD KEY `alertas_dni_index` (`dni`),
  ADD KEY `alertas_prioridad_index` (`prioridad`),
  ADD KEY `alertas_estado_index` (`estado`),
  ADD KEY `alertas_fecha_alerta_index` (`fecha_alerta`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auditoria_user_id_foreign` (`user_id`),
  ADD KEY `auditoria_accion_index` (`accion`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `clausulas`
--
ALTER TABLE `clausulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clausulas_tipo_aplicable_index` (`tipo_aplicable`),
  ADD KEY `clausulas_activa_index` (`activa`);

--
-- Indices de la tabla `codigo_contratos`
--
ALTER TABLE `codigo_contratos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_contratos_codigo_base_unique` (`codigo_base`);

--
-- Indices de la tabla `configuracion_empresa`
--
ALTER TABLE `configuracion_empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configuracion_empresa_updated_by_foreign` (`updated_by`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contratos_numero_contrato_unique` (`numero_contrato`),
  ADD KEY `contratos_dni_index` (`dni`),
  ADD KEY `contratos_estado_index` (`estado`),
  ADD KEY `contratos_fecha_fin_index` (`fecha_fin`),
  ADD KEY `contratos_numero_contrato_index` (`numero_contrato`),
  ADD KEY `contratos_codigo_base_id_foreign` (`codigo_base_id`);

--
-- Indices de la tabla `cumpleaños`
--
ALTER TABLE `cumpleaños`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cumpleaños_entregado_por_foreign` (`entregado_por`),
  ADD KEY `cumpleaños_dni_index` (`dni`),
  ADD KEY `cumpleaños_fecha_cumpleaños_index` (`fecha_cumpleaños`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_negra`
--
ALTER TABLE `lista_negra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lista_negra_dni_unique` (`dni`),
  ADD KEY `lista_negra_bloqueado_por_foreign` (`bloqueado_por`),
  ADD KEY `lista_negra_desbloqueado_por_foreign` (`desbloqueado_por`),
  ADD KEY `lista_negra_dni_index` (`dni`),
  ADD KEY `lista_negra_estado_index` (`estado`);

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
-- Indices de la tabla `plantillas`
--
ALTER TABLE `plantillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plantillas_tipo_contrato_index` (`tipo_contrato`),
  ADD KEY `plantillas_activa_index` (`activa`);

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
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `trabajadores_nombre_completo_index` (`nombre_completo`),
  ADD KEY `trabajadores_email_index` (`email`),
  ADD KEY `trabajadores_unidad_index` (`unidad`),
  ADD KEY `trabajadores_estado_index` (`estado`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adendas`
--
ALTER TABLE `adendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `clausulas`
--
ALTER TABLE `clausulas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigo_contratos`
--
ALTER TABLE `codigo_contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `configuracion_empresa`
--
ALTER TABLE `configuracion_empresa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `cumpleaños`
--
ALTER TABLE `cumpleaños`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lista_negra`
--
ALTER TABLE `lista_negra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `plantillas`
--
ALTER TABLE `plantillas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adendas`
--
ALTER TABLE `adendas`
  ADD CONSTRAINT `adendas_adenda_anterior_id_foreign` FOREIGN KEY (`adenda_anterior_id`) REFERENCES `adendas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `adendas_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adendas_dni_foreign` FOREIGN KEY (`dni`) REFERENCES `trabajadores` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD CONSTRAINT `alertas_contrato_id_foreign` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `alertas_dni_foreign` FOREIGN KEY (`dni`) REFERENCES `trabajadores` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `configuracion_empresa`
--
ALTER TABLE `configuracion_empresa`
  ADD CONSTRAINT `configuracion_empresa_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_codigo_base_id_foreign` FOREIGN KEY (`codigo_base_id`) REFERENCES `codigo_contratos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `contratos_dni_foreign` FOREIGN KEY (`dni`) REFERENCES `trabajadores` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cumpleaños`
--
ALTER TABLE `cumpleaños`
  ADD CONSTRAINT `cumpleaños_dni_foreign` FOREIGN KEY (`dni`) REFERENCES `trabajadores` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `cumpleaños_entregado_por_foreign` FOREIGN KEY (`entregado_por`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `lista_negra`
--
ALTER TABLE `lista_negra`
  ADD CONSTRAINT `lista_negra_bloqueado_por_foreign` FOREIGN KEY (`bloqueado_por`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lista_negra_desbloqueado_por_foreign` FOREIGN KEY (`desbloqueado_por`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lista_negra_dni_foreign` FOREIGN KEY (`dni`) REFERENCES `trabajadores` (`dni`) ON DELETE CASCADE;

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
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
