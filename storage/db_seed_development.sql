-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Oct 30, 2021 at 07:38 PM
-- Server version: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coolbot_backend`
--

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Demo-Token', '84e52fe59acf095edc622c834829dd624c07cbd141dc662758b75b69f149a9b5', '[\"*\"]', '2021-10-30 19:37:34', '2021-10-30 19:36:56', '2021-10-30 19:37:34');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Demo User', 'user@domain.com', NULL, '$2y$10$gZs8c2N9R8Ymo/AqjFnwS.WV0AGAycIdMLC2OcUKjETXp9ZV1rRRa', NULL, '2021-10-30 19:36:54', '2021-10-30 19:36:54');
COMMIT;


--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `discord_registration_id`, `wallet`, `balance`, `created_at`, `updated_at`) VALUES
(1, 1, 25, 1375, '2021-11-01 07:51:25', '2021-11-01 08:01:47'),
(2, 2, 0, 25, '2021-11-01 07:54:11', '2021-11-01 07:54:11');

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`id`, `bank_account_id`, `type`, `target`, `amount`, `description`, `timer`, `created_at`, `updated_at`) VALUES
(1, 1, 'deposit', 'wallet', 75, 'Funds deposited through API to wallet', NULL, '2021-11-01 07:51:25', '2021-11-01 07:51:25'),
(2, 1, 'deposit', 'balance', 500, 'Funds deposited through API to balance', NULL, '2021-11-01 07:51:28', '2021-11-01 07:51:28'),
(3, 1, 'withdraw', 'balance', -75, 'Funds withdrawn from balance through API (deleted)', NULL, '2021-11-01 07:51:36', '2021-11-01 07:51:36'),
(4, 1, 'withdraw', 'wallet', -75, 'Funds withdrawn from wallet through API (deleted)', NULL, '2021-11-01 07:51:43', '2021-11-01 07:51:43'),
(5, 1, 'withdraw', 'balance', -25, 'Transfer to balance', NULL, '2021-11-01 07:51:59', '2021-11-01 07:51:59'),
(6, 1, 'deposit', 'wallet', 25, 'Transfer to balance', NULL, '2021-11-01 07:51:59', '2021-11-01 07:51:59'),
(7, 1, 'withdraw', 'balance', -25, 'Send money to Username of user created from API', NULL, '2021-11-01 07:54:11', '2021-11-01 07:54:11'),
(8, 2, 'deposit', 'balance', 25, 'Receive money from Username of user created from API', NULL, '2021-11-01 07:54:11', '2021-11-01 07:54:11'),
(9, 1, 'deposit', 'balance', 500, 'Labor done through API', 'labor', '2021-11-01 08:01:46', '2021-11-01 08:01:46'),
(10, 1, 'deposit', 'balance', 500, 'Labor done through API', 'labor', '2021-11-01 08:01:47', '2021-11-01 08:01:47');

--
-- Dumping data for table `character_sheets`
--

INSERT INTO `character_sheets` (`id`, `discord_registration_id`, `type`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'cache', '{\"CharacterClass\":\"DiloJuvS\",\"DNA\":null,\"Location_Isle_V3\":\"X=229755.078 Y=46934.441 Z=-74283.320\",\"Rotation_Isle_V3\":\"P=0.000000 Y=61.051392 R=0.000000\",\"Growth\":\"0.635001\",\"Hunger\":\"31\",\"Thirst\":\"42\",\"Stamina\":\"101\",\"Health\":\"358\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":true,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":null,\"CameraRotation_Isle_V3\":\"P=0.000000 Y=151.051468 R=0.000000\",\"CameraDistance_Isle_V3\":\"588.817688\",\"SkinPaletteSection1\":64,\"SkinPaletteSection2\":26,\"SkinPaletteSection3\":34,\"SkinPaletteSection4\":26,\"SkinPaletteSection5\":39,\"SkinPaletteSection6\":254,\"SkinPaletteVariation\":\"6.0\"}', '2021-11-01 07:51:08', '2021-11-01 07:51:08'),
(2, 1, 'injection', '{\"CharacterClass\":\"DiloJuvS\",\"DNA\":null,\"Location_Isle_V3\":\"X=229755.078 Y=46934.441 Z=-74283.320\",\"Rotation_Isle_V3\":\"P=0.000000 Y=61.051392 R=0.000000\",\"Growth\":\"0.635001\",\"Hunger\":\"31\",\"Thirst\":\"42\",\"Stamina\":\"101\",\"Health\":\"358\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":true,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":null,\"CameraRotation_Isle_V3\":\"P=0.000000 Y=151.051468 R=0.000000\",\"CameraDistance_Isle_V3\":\"588.817688\",\"SkinPaletteSection1\":64,\"SkinPaletteSection2\":26,\"SkinPaletteSection3\":34,\"SkinPaletteSection4\":26,\"SkinPaletteSection5\":39,\"SkinPaletteSection6\":254,\"SkinPaletteVariation\":\"6.0\"}', '2021-11-01 07:51:11', '2021-11-01 07:51:11');

--
-- Dumping data for table `discord_registrations`
--

INSERT INTO `discord_registrations` (`id`, `guild_id`, `member_id`, `steam_id`, `username`, `created_at`, `updated_at`) VALUES
(1, '900465453619634236', '234035403009556491', '76561100000000001', 'Username of user created from API', '2021-11-01 07:48:43', '2021-11-01 07:48:43'),
(2, '900465453619634236', '900465622218063933', '76561100000000002', 'Username of user created from API', '2021-11-01 07:54:06', '2021-11-01 07:54:06');

--
-- Dumping data for table `labor_replies`
--

INSERT INTO `labor_replies` (`id`, `discord_registration_id`, `status`, `status_updated_by_user_id`, `status_comment`, `last_status_change`, `text_before`, `text_after`, `target`, `created_at`, `updated_at`) VALUES
(1, 1, 'approved', 1, 'Approved when imported from SQL', NULL, 'You did a thing and made', 'doing nothing', 'balance', NULL, NULL),
(2, 1, 'approved', 1, 'Approved when imported from SQL', NULL, 'You found', 'on the street. Nice!', 'wallet', NULL, NULL);

--
-- Dumping data for table `option_categories`
--

INSERT INTO `option_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'General', 'General options used site wide', '2021-11-02 07:03:22', '2021-11-02 07:03:22'),
(2, 'Banking', 'Banking specific options', '2021-11-02 07:03:40', '2021-11-02 07:03:40'),
(3, 'Labor', 'Labor specific options', '2021-11-02 07:03:59', '2021-11-02 07:03:59');


--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_category_id`, `display_name`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Registration Enabled', 'registration_enabled', 'false', '2021-11-02 07:07:36', '2021-11-02 07:07:36'),
(2, 2, 'Balance Interest', 'balance_interest', '0.03', '2021-11-02 07:08:06', '2021-11-02 07:08:06'),
(3, 3, 'Minimum wage', 'minimum_wage', '100', '2021-11-02 07:08:39', '2021-11-02 07:08:39'),
(4, 3, 'Maximum wage', 'maximum_wage', '1100', '2021-11-02 07:08:53', '2021-11-02 07:08:53'),
(5, 1, 'Password Reset Enabled', 'password_reset_enabled', 'false', '2021-11-02 10:46:34', '2021-11-02 10:46:34');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
