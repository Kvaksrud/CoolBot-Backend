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
-- Dumping data for table `discord_registrations`
--

INSERT INTO `discord_registrations` (`id`, `guild_id`, `member_id`, `steam_id`, `username`, `created_at`, `updated_at`) VALUES
(1, '900465453619634236', '234035403009556492', '76561100000000001', 'Username of user created from API', '2021-11-01 07:48:43', '2021-11-01 07:48:43'),
(2, '900465453619634236', '900465622218063934', '76561100000000002', 'Username of user created from API', '2021-11-01 07:54:06', '2021-11-01 07:54:06');

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
(3, 'Labor', 'Labor specific options', '2021-11-02 07:03:59', '2021-11-02 07:03:59'),
(4, 'Dinosaur', 'Dinosaur releated options', '2021-11-08 15:30:44', '2021-11-08 15:30:44');

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_category_id`, `display_name`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Registration Enabled', 'registration_enabled', 'false', '2021-11-02 07:07:36', '2021-11-02 07:07:36'),
(2, 2, 'Balance Interest', 'balance_interest', '0.03', '2021-11-02 07:08:06', '2021-11-02 07:08:06'),
(3, 3, 'Minimum wage', 'minimum_wage', '100', '2021-11-02 07:08:39', '2021-11-02 07:08:39'),
(4, 3, 'Maximum wage', 'maximum_wage', '1100', '2021-11-02 07:08:53', '2021-11-02 07:08:53'),
(5, 1, 'Password Reset Enabled', 'password_reset_enabled', 'false', '2021-11-02 10:46:34', '2021-11-02 10:46:34'),
(6, 3, 'Rest time between labor', 'rest_time', '7200', '2021-11-02 11:32:01', '2021-11-02 11:32:01'),
(11, 4, 'Rest time between injections', 'injection_wait', '1800', '2021-11-08 15:30:44', '2021-11-08 15:30:44'),
(12, 4, 'Rest time between teleports', 'teleport_wait', '1800', '2021-11-08 15:30:44', '2021-11-08 15:30:44');


--
-- Dumping data for table `dinosaurs`
--

INSERT INTO `dinosaurs` (`id`, `code`, `display_name`, `cost`, `sheet`, `created_at`, `updated_at`) VALUES
(1, 'anky', 'Adult Ankylosaurus', 500, '{\"CharacterClass\":\"Anky\",\"DNA\":\"\",\"Location_Isle_V3\":\"X=-347180.500 Y=477319.313 Z=-24978.604\",\"Rotation_Isle_V3\":\"P=0.000000 Y=-78.896469 R=0.000000\",\"Growth\":\"1.0\",\"Hunger\":\"544\",\"Thirst\":\"60\",\"Stamina\":\"120\",\"Health\":\"5443\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":true,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Anky;\"}', '2021-11-07 10:43:25', '2021-11-07 10:43:25'),
(2, 'austro', 'Adult Austroraptor', 500, '{\"CharacterClass\":\"Austro\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"65\",\"Thirst\":\"45\",\"Stamina\":\"180\",\"Health\":\"250\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":true,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Austro;\"}', '2021-11-07 10:44:10', '2021-11-07 10:44:10'),
(3, 'camara', 'Adult Camarasaurus', 500, '{\"CharacterClass\":\"Camara\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"7600\",\"Thirst\":\"100\",\"Stamina\":\"350\",\"Health\":\"12000\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":true,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Camara;\"}', '2021-11-07 10:44:57', '2021-11-07 10:44:57'),
(4, 'puerta', 'Adult Puertasaurus', 500, '{\"CharacterClass\":\"Puerta\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"14968\",\"Thirst\":\"100\",\"Stamina\":\"100\",\"Health\":\"49895\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Puerta;\"}', '2021-11-07 10:45:49', '2021-11-07 10:45:49'),
(5, 'shant', 'Adult Shantungosaurus', 500, '{\"CharacterClass\":\"Shant\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"1179\",\"Thirst\":\"60\",\"Stamina\":\"140\",\"Health\":\"11793\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":true,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Shant;\"}', '2021-11-07 10:46:27', '2021-11-07 10:46:27'),
(6, 'stego', 'Adult Stegosaurus', 500, '{\"CharacterClass\":\"Stego\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"344\",\"Thirst\":\"100\",\"Stamina\":\"180\",\"Health\":\"4883\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":true,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Stego;\"}', '2021-11-07 10:47:06', '2021-11-07 10:47:06'),
(7, 'theri', 'Adult Therizinosaurus', 500, '{\"CharacterClass\":\"Theri\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"453\",\"Thirst\":\"50\",\"Stamina\":\"130\",\"Health\":\"4536\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":true,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Theri;\"}', '2021-11-07 10:47:47', '2021-11-07 10:47:47'),
(8, 'acro', 'Adult Acrocanthosaurus', 500, '{\"CharacterClass\":\"Acro\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"1197\",\"Thirst\":\"80\",\"Stamina\":\"110\",\"Health\":\"4790\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Acro;\"}', '2021-11-07 10:48:43', '2021-11-07 10:48:43'),
(9, 'alberto', 'Adult Albertosaurus', 500, '{\"CharacterClass\":\"Albert\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"900\",\"Thirst\":\"60\",\"Stamina\":\"160\",\"Health\":\"3000\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Albert;\"}', '2021-11-07 10:49:35', '2021-11-07 10:49:35'),
(10, 'bary', 'Adult Baryonyx', 500, '{\"CharacterClass\":\"Bary\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"326\",\"Thirst\":\"60\",\"Stamina\":\"135\",\"Health\":\"1450\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Bary;\"}', '2021-11-07 10:50:14', '2021-11-07 10:50:14'),
(11, 'herrera', 'Adult Herrerasaurus', 500, '{\"CharacterClass\":\"Herrera\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"60\",\"Thirst\":\"60\",\"Stamina\":\"130\",\"Health\":\"500\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Herrera;\"}', '2021-11-07 10:50:53', '2021-11-07 10:50:53'),
(12, 'spino', 'Adult Spinosaurus', 500, '{\"CharacterClass\":\"Spino\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"2721\",\"Thirst\":\"100\",\"Stamina\":\"120\",\"Health\":\"9071\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":true,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"Spino;\"}', '2021-11-07 10:51:26', '2021-11-07 10:51:26'),
(13, 'diablo', 'Adult Diabloceratops', 500, '{\"CharacterClass\":\"DiabloAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"155\",\"Thirst\":\"50\",\"Stamina\":\"100\",\"Health\":\"3250\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"DiabloAdultS;\"}', '2021-11-07 10:52:05', '2021-11-07 10:52:05'),
(14, 'dryo', 'Adult Dryosaurus', 500, '{\"CharacterClass\":\"DryoAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"80\",\"Thirst\":\"30\",\"Stamina\":\"250\",\"Health\":\"500\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"DryoAdultS;\"}', '2021-11-07 10:52:40', '2021-11-07 10:52:40'),
(15, 'galli', 'Adult Gallimimus', 500, '{\"CharacterClass\":\"GalliAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"220\",\"Thirst\":\"30\",\"Stamina\":\"400\",\"Health\":\"800\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"GalliAdultS;\"}', '2021-11-07 10:53:18', '2021-11-07 10:53:18'),
(16, 'maia', 'Adult Maiasaurus', 500, '{\"CharacterClass\":\"MaiaAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"275\",\"Thirst\":\"60\",\"Stamina\":\"180\",\"Health\":\"2868\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"MaiaAdultS;\"}', '2021-11-07 10:54:05', '2021-11-07 10:54:05'),
(17, 'pachy', 'Adult Pachysaurus', 500, '{\"CharacterClass\":\"PachyAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"110\",\"Thirst\":\"60\",\"Stamina\":\"175\",\"Health\":\"1300\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"PachyAdultS;\"}', '2021-11-07 10:54:49', '2021-11-07 10:54:49'),
(18, 'para', 'Adult Parasaurolophus', 500, '{\"CharacterClass\":\"ParaAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"840\",\"Thirst\":\"60\",\"Stamina\":\"250\",\"Health\":\"3600\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"ParaAdultS;\"}', '2021-11-07 10:55:29', '2021-11-07 10:55:29'),
(19, 'trike', 'Adult Triceratops', 500, '{\"CharacterClass\":\"TrikeAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"1500\",\"Thirst\":\"100\",\"Stamina\":\"200\",\"Health\":\"8200\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"TrikeSubS;TrikeAdultS;\"}', '2021-11-07 10:55:50', '2021-11-07 10:55:50'),
(20, 'allo', 'Adult Allosaurus', 500, '{\"CharacterClass\":\"AlloAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"816\",\"Thirst\":\"60\",\"Stamina\":\"200\",\"Health\":\"2800\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"AlloAdultS;\"}', '2021-11-07 10:56:10', '2021-11-07 10:56:10'),
(21, 'carno', 'Adult Carnotaurus', 500, '{\"CharacterClass\":\"CarnoAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"800\",\"Thirst\":\"60\",\"Stamina\":\"440\",\"Health\":\"2170\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"CarnoAdultS;\"}', '2021-11-07 10:56:50', '2021-11-07 10:56:50'),
(22, 'cerato', 'Adult Ceratosaurus', 500, '{\"CharacterClass\":\"CeratoAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"600\",\"Thirst\":\"60\",\"Stamina\":\"150\",\"Health\":\"2250\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"CeratoAdultS;\"}', '2021-11-07 10:57:27', '2021-11-07 10:57:27'),
(23, 'dilo', 'Adult Dilophosaurus', 500, '{\"CharacterClass\":\"DiloAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"350\",\"Thirst\":\"80\",\"Stamina\":\"150\",\"Health\":\"1050\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"DiloAdultS;\"}', '2021-11-07 10:57:56', '2021-11-07 10:57:56'),
(24, 'giga', 'Adult Giganotosaurus', 500, '{\"CharacterClass\":\"GigaAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"2285\",\"Thirst\":\"100\",\"Stamina\":\"100\",\"Health\":\"6000\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"GigaAdultS;\"}', '2021-11-07 10:58:25', '2021-11-07 10:58:25'),
(25, 'sucho', 'Adult Suchomimus', 500, '{\"CharacterClass\":\"SuchoAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"500\",\"Thirst\":\"60\",\"Stamina\":\"200\",\"Health\":\"3600\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"SuchoAdultS;\"}', '2021-11-07 10:59:07', '2021-11-07 10:59:07'),
(26, 'rex', 'Adult Tyrannosaurus Rex', 500, '{\"CharacterClass\":\"RexAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"2150\",\"Thirst\":\"90\",\"Stamina\":\"100\",\"Health\":\"6500\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"RexAdultS;\"}', '2021-11-07 10:59:44', '2021-11-07 10:59:44'),
(27, 'utah', 'Adult Utahraptor', 500, '{\"CharacterClass\":\"UtahAdultS\",\"DNA\":\"\",\"Growth\":\"1.0\",\"Hunger\":\"300\",\"Thirst\":\"60\",\"Stamina\":\"300\",\"Health\":\"1200\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"UtahAdultS;\"}', '2021-11-07 11:00:22', '2021-11-07 11:00:22'),
(28, 'allojuv', 'Juvenile Allosaurus', 500, '{\"CharacterClass\":\"AlloJuvS\",\"DNA\":\"\",\"Growth\":\"0.5\",\"Hunger\":\"90\",\"Thirst\":\"20\",\"Stamina\":\"60\",\"Health\":\"200\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:45:38', '2021-11-07 19:45:38'),
(29, 'carnojuv', 'Juvenile Carnotaurus', 500, '{\"CharacterClass\":\"CarnoJuvS\",\"DNA\":\"\",\"Growth\":\"0.6\",\"Hunger\":\"50\",\"Thirst\":\"60\",\"Stamina\":\"280\",\"Health\":\"120\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:46:10', '2021-11-07 19:46:10'),
(30, 'ceratojuv', 'Juvenile Ceratosaurus', 500, '{\"CharacterClass\":\"CeratoJuvS\",\"DNA\":\"\",\"Growth\":\"0.5\",\"Hunger\":\"75\",\"Thirst\":\"20\",\"Stamina\":\"60\",\"Health\":\"150\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:46:47', '2021-11-07 19:46:47'),
(31, 'diablojuv', 'Juvenile Diabloceratops', 500, '{\"CharacterClass\":\"DiabloJuvS\",\"DNA\":\"\",\"Growth\":\"0.4\",\"Hunger\":\"60\",\"Thirst\":\"30\",\"Stamina\":\"100\",\"Health\":\"350\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:47:17', '2021-11-07 19:47:17'),
(32, 'dilojuv', 'Juvenile Dilophosaurus', 500, '{\"CharacterClass\":\"DiloJuvS\",\"DNA\":\"\",\"Growth\":\"0.5\",\"Hunger\":\"83\",\"Thirst\":\"45\",\"Stamina\":\"200\",\"Health\":\"250\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:48:04', '2021-11-07 19:48:04'),
(33, 'dryojuv', 'Juvenile Dryosaurus', 500, '{\"CharacterClass\":\"DryoJuvS\",\"DNA\":\"\",\"Growth\":\"0.4\",\"Hunger\":\"15\",\"Thirst\":\"10\",\"Stamina\":\"50\",\"Health\":\"7\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:48:31', '2021-11-07 19:48:31'),
(34, 'gallijuv', 'Juvenile Gallimimus', 500, '{\"CharacterClass\":\"GalliJuvS\",\"DNA\":\"\",\"Growth\":\"0.2\",\"Hunger\":\"20\",\"Thirst\":\"20\",\"Stamina\":\"100\",\"Health\":\"260\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:49:05', '2021-11-07 19:49:05'),
(35, 'gigajuv', 'Juvenile Giganotosaurus', 500, '{\"CharacterClass\":\"GigaJuvS\",\"DNA\":\"\",\"Growth\":\"0.5\",\"Hunger\":\"80\",\"Thirst\":\"25\",\"Stamina\":\"60\",\"Health\":\"250\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:49:54', '2021-11-07 19:49:54'),
(36, 'gigasub', 'Subadult Giganotosaurus', 500, '{\"CharacterClass\":\"GigaSubS\",\"DNA\":\"\",\"Growth\":\"0.7\",\"Hunger\":\"500\",\"Thirst\":\"45\",\"Stamina\":\"130\",\"Health\":\"2000\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"GigaSubS;\"}', '2021-11-07 19:50:23', '2021-11-07 19:50:23'),
(37, 'maiajuv', 'Juvenile Maiasaurus', 500, '{\"CharacterClass\":\"MaiaJuvS\",\"DNA\":\"\",\"Growth\":\"0.3\",\"Hunger\":\"15\",\"Thirst\":\"20\",\"Stamina\":\"80\",\"Health\":\"50\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:50:49', '2021-11-07 19:50:49'),
(38, 'pachyjuv', 'Juvenile Pachysaurus', 500, '{\"CharacterClass\":\"PachyJuvS\",\"DNA\":\"\",\"Growth\":\"0.5\",\"Hunger\":\"48\",\"Thirst\":\"20\",\"Stamina\":\"100\",\"Health\":\"175\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:51:22', '2021-11-07 19:51:22'),
(39, 'parajuv', 'Juvenile Parasaurolophus', 500, '{\"CharacterClass\":\"ParaJuvS\",\"DNA\":\"\",\"Growth\":\"0.6\",\"Hunger\":\"40\",\"Thirst\":\"30\",\"Stamina\":\"80\",\"Health\":\"50\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:51:44', '2021-11-07 19:51:44'),
(40, 'rexjuv', 'Juvenile Tyrannosaurus Rex', 500, '{\"CharacterClass\":\"RexJuvS\",\"DNA\":\"\",\"Growth\":\"0.5\",\"Hunger\":\"75\",\"Thirst\":\"20\",\"Stamina\":\"60\",\"Health\":\"200\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:52:09', '2021-11-07 19:52:09'),
(41, 'rexsub', 'Subadult Tyrannosaurus Rex', 500, '{\"CharacterClass\":\"RexSubS\",\"DNA\":\"\",\"Growth\":\"0.78\",\"Hunger\":\"500\",\"Thirst\":\"40\",\"Stamina\":\"130\",\"Health\":\"2000\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"RexSubS;\"}', '2021-11-07 19:52:33', '2021-11-07 19:52:33'),
(42, 'suchojuv', 'Juvenile Suchomimus', 500, '{\"CharacterClass\":\"SuchoJuvS\",\"DNA\":\"\",\"Growth\":\"0.5\",\"Hunger\":\"70\",\"Thirst\":\"50\",\"Stamina\":\"85\",\"Health\":\"350\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:53:14', '2021-11-07 19:53:14'),
(43, 'trikejuv', 'Juvenile Triceratops', 500, '{\"CharacterClass\":\"TrikeJuvS\",\"DNA\":\"\",\"Growth\":\"0.8\",\"Hunger\":\"60\",\"Thirst\":\"30\",\"Stamina\":\"90\",\"Health\":\"400\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:54:01', '2021-11-07 19:54:01'),
(44, 'trikesub', 'Subadult Triceratops', 500, '{\"CharacterClass\":\"TrikeSubS\",\"DNA\":\"\",\"Growth\":\"0.8\",\"Hunger\":\"200\",\"Thirst\":\"30\",\"Stamina\":\"90\",\"Health\":\"1250\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"TrikeSubS;\"}', '2021-11-07 19:54:27', '2021-11-07 19:54:27'),
(45, 'utahjuv', 'Juvenile Utahraptor', 500, '{\"CharacterClass\":\"UtahJuvS\",\"DNA\":\"\",\"Growth\":\"0.6\",\"Hunger\":\"25\",\"Thirst\":\"45\",\"Stamina\":\"150\",\"Health\":\"25\",\"BleedingRate\":\"0\",\"Oxygen\":\"40\",\"bGender\":false,\"bIsResting\":false,\"bBrokenLegs\":false,\"ProgressionPoints\":\"0\",\"ProgressionTier\":\"1\",\"UnlockedCharacters\":\"\"}', '2021-11-07 19:54:55', '2021-11-07 19:54:55');

--
-- Dumping data for table `teleports`
--

INSERT INTO `teleports` (`id`, `display_name`, `code`, `cost`, `sheet`, `created_at`, `updated_at`) VALUES
(1, 'North Twin Lake', 'northtwin', 500, '{\"bIsResting\":false,\"Location_Isle_V3\":\"X=-406931.906 Y=-187515.766 Z=-72130.531\",\"Rotation_Isle_V3\":\"P=0.000000 Y=-169.899765 R=0.000000\",\"CameraRotation_Isle_V3\":\"P=0.000000 Y=-79.899704 R=0.000000\",\"CameraDistance_Isle_V3\":\"299.995544\"}', '2021-11-07 20:28:01', '2021-11-07 20:35:20'),
(2, 'Murky Pond', 'murky', 500, '{\"bIsResting\":false,\"Location_Isle_V3\":\"X=305895.844 Y=-106381.602 Z=-27718.631\",\"Rotation_Isle_V3\":\"P=0.000000 Y=5.644394 R=0.000000\",\"CameraRotation_Isle_V3\":\"P=0.000000 Y=95.644478 R=0.000000\",\"CameraDistance_Isle_V3\":\"300.000793\"}', '2021-11-07 21:23:58', '2021-11-07 21:23:58'),
(3, 'Titan\'s Lake', 'titan', 500, '{\"bIsResting\":false,\"Location_Isle_V3\":\"X=-90332.688 Y=-278700.719 Z=-65220.852\",\"Rotation_Isle_V3\":\"P=0.000000 Y=25.879328 R=0.000000\",\"CameraRotation_Isle_V3\":\"P=0.000000 Y=115.879387 R=0.000000\",\"CameraDistance_Isle_V3\":\"299.993439\"}', '2021-11-07 21:26:37', '2021-11-07 21:26:37');

--
-- Dumping data for table `discord_roles`
--

INSERT INTO `discord_roles` (`id`, `friendly_name`, `discord_id`, `modifier`, `created_at`, `updated_at`) VALUES
(1, 'Everyone', 'everyone', '1.00', '2021-11-07 12:04:04', '2021-11-07 12:39:21');

--
-- Dumping data for table `discord_roles_dinosaurs_pivot_table`
--

INSERT INTO `discord_roles_dinosaurs_pivot_table` (`id`, `discord_role_id`, `dinosaur_id`, `created_at`, `updated_at`) VALUES
(1, 1, 15, NULL, NULL),
(2, 1, 19, NULL, NULL),
(3, 1, 26, NULL, NULL),
(4, 1, 27, NULL, NULL),
(5, 1, 34, NULL, NULL),
(6, 1, 43, NULL, NULL),
(7, 1, 40, NULL, NULL),
(8, 1, 45, NULL, NULL),
(9, 1, 44, NULL, NULL),
(10, 1, 41, NULL, NULL);

--
-- Dumping data for table `discord_roles_teleports_pivot_table`
--

INSERT INTO `discord_roles_teleports_pivot_table` (`id`, `discord_role_id`, `teleport_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 3, NULL, NULL);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
