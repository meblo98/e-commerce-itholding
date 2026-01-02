-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 18 déc. 2025 à 20:29
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `euro`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `titre`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Electromenagers', 'This is the description', '2025-12-17 14:36:57', '2025-12-17 14:36:57'),
(2, 'Climatiseur', 'Climatiseur', '2025-12-18 01:05:23', '2025-12-18 01:05:23'),
(3, 'Réfrigérateur', 'Réfrigérateur', '2025-12-18 11:45:41', '2025-12-18 11:45:41'),
(4, 'Congélateur', 'Congélateur', '2025-12-18 11:46:00', '2025-12-18 11:46:00'),
(5, 'Téléviseur', 'Téléviseur', '2025-12-18 11:46:29', '2025-12-18 11:46:29'),
(6, 'Cuisinier', 'Cuisinier', '2025-12-18 11:46:50', '2025-12-18 11:46:50'),
(7, 'Four Encastrable', 'Four Encastrable', '2025-12-18 11:47:08', '2025-12-18 11:47:08'),
(8, 'Hotte de Cuisine', 'Hotte de Cuisine', '2025-12-18 11:49:01', '2025-12-18 11:49:01'),
(9, 'Micro Onde', 'Micro Onde', '2025-12-18 11:49:20', '2025-12-18 11:49:20'),
(10, 'Plaque', 'Plaque', '2025-12-18 11:49:31', '2025-12-18 11:49:31'),
(11, 'Sèche Linge', 'Sèche Linge', '2025-12-18 11:50:24', '2025-12-18 11:50:24'),
(12, 'Fontaine', 'Fontaine', '2025-12-18 11:50:58', '2025-12-18 11:50:58'),
(13, 'Mini Four', 'Mini Four', '2025-12-18 11:51:16', '2025-12-18 11:51:16'),
(14, 'Chauffe Eau', 'Chauffe Eau', '2025-12-18 11:51:34', '2025-12-18 11:51:34'),
(15, 'Barre de Son', 'Barre de Son', '2025-12-18 11:51:51', '2025-12-18 11:51:51'),
(16, 'Home Cinema', 'Home Cinema', '2025-12-18 11:52:09', '2025-12-18 11:52:09'),
(17, 'Mini Chaine', 'Mini Chaine', '2025-12-18 11:52:29', '2025-12-18 11:52:29'),
(18, 'Chambre a Coucher', 'Chambre a Coucher', '2025-12-18 11:53:03', '2025-12-18 11:53:03'),
(19, 'Salon', 'Salon', '2025-12-18 11:53:13', '2025-12-18 11:53:13'),
(20, 'Table Téléviseur', 'Table Téléviseur', '2025-12-18 11:53:48', '2025-12-18 11:53:48'),
(21, 'Table a Manger', 'Table a Manger', '2025-12-18 11:54:06', '2025-12-18 11:54:06'),
(22, 'Table Basse', 'Table Basse', '2025-12-18 11:54:20', '2025-12-18 11:54:20'),
(23, 'Matelas', 'Matelas', '2025-12-18 11:54:32', '2025-12-18 11:54:32'),
(24, 'Mobiliers Bureau', 'Mobiliers Bureau', '2025-12-18 11:54:56', '2025-12-18 11:54:56'),
(25, 'Ordinateur', 'Ordinateur', '2025-12-18 11:56:55', '2025-12-18 11:56:55'),
(26, 'Téléphone', 'Téléphone', '2025-12-18 11:57:08', '2025-12-18 11:57:08'),
(27, 'Imprimante', 'Imprimante', '2025-12-18 11:57:25', '2025-12-18 11:57:25'),
(28, 'Oreiller', 'Oreiller', '2025-12-18 11:57:37', '2025-12-18 11:57:37'),
(29, 'Aspirateur', 'Aspirateur', '2025-12-18 11:57:48', '2025-12-18 11:57:48'),
(30, 'Blender', 'Blender', '2025-12-18 11:58:55', '2025-12-18 11:58:55'),
(31, 'Bouilloire', 'Bouilloire', '2025-12-18 11:59:12', '2025-12-18 11:59:12'),
(32, 'Extracteur de Jus', 'Extracteur de Jus', '2025-12-18 11:59:28', '2025-12-18 11:59:28'),
(33, 'Fer à Repasser', 'Fer à Repasser', '2025-12-18 11:59:48', '2025-12-18 11:59:48'),
(34, 'Grille de Pain', 'Grille de Pain', '2025-12-18 12:00:08', '2025-12-18 12:00:08'),
(35, 'Machine à Café', 'Machine à Café', '2025-12-18 12:01:50', '2025-12-18 12:01:50'),
(36, 'Ventilateur', 'Ventilateur', '2025-12-18 12:02:03', '2025-12-18 12:02:03'),
(37, 'Régulateur', 'Régulateur', '2025-12-18 12:02:24', '2025-12-18 12:02:24'),
(38, 'Support Split', 'Support Split', '2025-12-18 12:03:31', '2025-12-18 12:03:31'),
(39, 'Casques', 'Casques', '2025-12-18 12:03:45', '2025-12-18 12:03:45'),
(40, 'Support TV', 'Support TV', '2025-12-18 12:04:00', '2025-12-18 12:04:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
