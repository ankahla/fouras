-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Octobre 2017 à 11:54
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS fouras;
USE fouras;
--
-- Base de données :  `fouras`
--

-- --------------------------------------------------------

--
-- Structure de la table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `budget`
--

INSERT INTO `budget` (`id`, `couple_id`, `service_id`) VALUES
(1, 1, 1),
(6, 1, 8),
(15, 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `budget_item`
--

CREATE TABLE `budget_item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estimated_amount` decimal(10,3) DEFAULT NULL,
  `actuel_amount` decimal(10,3) DEFAULT NULL,
  `paid_amount` decimal(10,3) DEFAULT NULL,
  `due_amount` decimal(10,3) DEFAULT NULL,
  `budget_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `budget_item`
--

INSERT INTO `budget_item` (`id`, `name`, `estimated_amount`, `actuel_amount`, `paid_amount`, `due_amount`, `budget_id`) VALUES
(3, 'Test3', '300.000', '0.000', '200.000', '0.000', 1),
(5, 'test5', '0.000', '0.000', '0.000', '0.000', 15),
(7, 'honey', '1000.000', '0.000', '0.000', '0.000', 6),
(10, 'kjkjjk', '0.000', '0.000', '0.000', '0.000', 1),
(11, 'rtrtrtrtrtrtrtr', '0.000', '0.000', '0.000', '0.000', 1),
(12, 'HELLO', '0.000', '0.000', '0.000', '0.000', 6),
(13, 'cvcvcv', '0.000', '0.000', '0.000', '0.000', 1);

-- --------------------------------------------------------

--
-- Structure de la table `capacity`
--

CREATE TABLE `capacity` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `capacity`
--

INSERT INTO `capacity` (`id`, `name`) VALUES
(1, 'Under 50'),
(2, 'Between 50 and 100'),
(3, 'Between 100 and 200'),
(4, 'Between 200 and 500'),
(5, 'Between 500 and 1000'),
(6, 'Over 1000');

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `city`
--

INSERT INTO `city` (`id`, `name`, `zipcode`) VALUES
(1, 'Ariana', ''),
(2, 'Béja', ''),
(3, 'Ben Arous', ''),
(4, 'Bizerte', ''),
(5, 'Gabès', ''),
(6, 'Gafsa', ''),
(7, 'Jendouba', ''),
(8, 'Kairouan', ''),
(9, 'Kasserine', ''),
(10, 'Kébili', ''),
(11, 'La Manouba', ''),
(12, 'Le Kef', ''),
(13, 'Mahdia', ''),
(14, 'Médenine', ''),
(15, 'Monastir', ''),
(16, 'Nabeul', ''),
(17, 'Sfax', ''),
(18, 'Sidi Bouzid', ''),
(19, 'Siliana', ''),
(20, 'Sousse', ''),
(21, 'Tataouine', ''),
(22, 'Tozeur', ''),
(23, 'Tunis', ''),
(24, 'Zaghouan', '');

-- --------------------------------------------------------

--
-- Structure de la table `couple`
--

CREATE TABLE `couple` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `husband_id` int(11) DEFAULT NULL,
  `wife_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `wedding_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `couple`
--

INSERT INTO `couple` (`id`, `user_id`, `husband_id`, `wife_id`, `city_id`, `wedding_date`) VALUES
(1, 1, 1, 1, 15, '2017-12-14'),
(2, 4, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `couple_url`
--

CREATE TABLE `couple_url` (
  `id` int(11) NOT NULL,
  `url_id` int(11) DEFAULT NULL,
  `couple_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `couple_url`
--

INSERT INTO `couple_url` (`id`, `url_id`, `couple_id`) VALUES
(1, 14, 1),
(2, 17, 2);

-- --------------------------------------------------------

--
-- Structure de la table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `guest`
--

INSERT INTO `guest` (`id`, `couple_id`, `description`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`) VALUES
(3, 1, 'sdsdsd kjkjkhjgkjhg_________éà', 'Kahla', 'Anouar', 'kahla.anouar@yahoo.fr', '+216 96 754 000', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `husband`
--

CREATE TABLE `husband` (
  `id` int(11) NOT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `husband`
--

INSERT INTO `husband` (`id`, `father_name`, `mother_name`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`) VALUES
(1, 'MUU', 'WSS', 'Anouar', 'Kahla', 'kahla.anouar@yahoo.f', '96754000', '96754000', 'test'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `map_icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `name`, `image`) VALUES
(1, 'Wedding Cakes', '/bundles/front/images/vendor-categories-2.jpg'),
(2, 'Wedding Dress', '/bundles/front/images/vendor-categories-3.jpg'),
(3, 'Wedding Photography', 'bundles/front/images/vendor-categories-4.jpg'),
(4, 'Jewellery', NULL),
(5, 'Ceremony', NULL),
(6, 'Clothing, Accessories & Makeup', NULL),
(7, 'Invites & Gift', NULL),
(8, 'Honeymoon', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `task`
--

INSERT INTO `task` (`id`, `user_id`, `title`, `description`, `date`, `created_at`, `updated_at`) VALUES
(5, 1, 'tache5', 'ma descriptionkkkkkkkkkkk', '2018-06-02', '2017-09-21 14:42:21', '2017-09-21 14:42:20'),
(7, 1, 'tache1', 'test testAAAAAAAAAAAAA', '2017-09-14', '2017-09-21 14:47:35', '2017-09-21 14:47:35'),
(13, 1, 'tach6', 'hello world', '2018-06-25', '2017-09-23 11:10:10', '2017-09-23 11:10:09'),
(14, 1, 'tach7', 'hello world2', '2018-06-25', '2017-09-23 11:10:33', '2017-09-23 11:10:33'),
(17, 1, 'test', 'test', '2012-01-01', '2017-09-23 11:20:00', '2017-09-23 11:20:00'),
(18, 1, 'test444', 'test444', '2012-01-01', '2017-09-23 11:23:00', '2017-09-23 11:23:00'),
(19, 1, 'test01', 'test', '2017-11-15', '2017-10-02 14:54:28', '2017-10-02 14:54:27'),
(20, 1, 'test', 'test', '2017-11-15', '2017-10-02 14:56:07', '2017-10-02 14:56:07'),
(21, 1, 'tache test', 'voyage', '2017-10-20', '2017-10-06 13:43:37', '2017-10-06 13:43:37'),
(22, 2, 'tache1', 'hello wahou', '2017-11-10', '2017-10-07 23:05:44', '2017-10-07 23:05:44');

-- --------------------------------------------------------

--
-- Structure de la table `url`
--

CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `url`
--

INSERT INTO `url` (`id`, `url`, `type`) VALUES
(12, 'http://test.fr', 'other'),
(13, 'http://facebook.com/kahla.anouar', 'facebook'),
(14, 'http://facebook.com/kahla.anouar', 'facebook'),
(16, 'http://test.Fr', 'facebook'),
(17, '', 'facebook'),
(18, NULL, 'youtube'),
(19, 'http://youtube.com', 'youtube'),
(20, NULL, NULL),
(21, NULL, NULL),
(22, NULL, NULL),
(23, NULL, 'youtube'),
(24, NULL, 'youtube');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `city_id`, `user_type_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `address`, `phone`, `mobile`, `profile_picture`) VALUES
(1, NULL, 1, 'kahla', 'kahla', 'kahla.anouar@yahoo.fr', 'kahla.anouar@yahoo.fr', 1, '5fkmxei2w44cg00s4skkwc08w0kokgc', '$2y$13$5fkmxei2w44cg00s4skkwOkDMH8Yni7H5J47Jds.Mdbttpx73oZAG', '2017-10-13 13:57:53', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:11:"ROLE_COUPLE";}', 0, NULL, 'Anouar', 'Kahla', NULL, NULL, NULL, 'ce97372417e768c78d9691b444a5ed9d.png'),
(2, NULL, 2, 'vendor', 'vendor', 'kahla.anoir@gmail.com', 'kahla.anoir@gmail.com', 1, 'tda98zxnryoc8cokws84cow0400owcg', '$2y$13$tda98zxnryoc8cokws84cesP/LoL6ZwKMLIjOR1x.5L.nUgs3G4Oe', '2017-10-13 22:06:35', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:11:"ROLE_VENDOR";}', 0, NULL, 'Vendor first name', 'vendor last name', NULL, NULL, NULL, '3dd9885c20edb757eeab88d64f35a77b.jpeg'),
(3, NULL, 2, 'John', 'john', 'hohn@demo.fr', 'hohn@demo.fr', 1, 's8k5xorzkdwcw00wcgksowcgokcwgo0', '$2y$13$s8k5xorzkdwcw00wcgksouyeqb4roRhtduD5WMEH8Ira7YNfVOsKC', '2017-10-08 13:22:26', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:11:"ROLE_VENDOR";}', 0, NULL, 'John', 'Travolta', NULL, NULL, NULL, 'http://www.gravatar.com/avatar.php?gravatar_id=dab47db918f088950221e2cd0bc06999&default=&size=260'),
(4, NULL, 1, 'couple', 'couple', 'test@test.fr', 'test@test.fr', 1, '5nyr0w6hgcwsow48w4040wscscsoss0', '$2y$13$5nyr0w6hgcwsow48w4040uteCaLn/zHDWcQ9hOGsuwps53Qwpnp9O', '2017-10-08 13:51:35', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:11:"ROLE_COUPLE";}', 0, NULL, 'test', 'test', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_group`
--

INSERT INTO `user_group` (`id`, `name`, `roles`) VALUES
(1, 'vendor', 'a:0:{}'),
(2, 'couple', 'a:0:{}'),
(3, 'test', 'a:0:{}');

-- --------------------------------------------------------

--
-- Structure de la table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'couple'),
(2, 'vendor');

-- --------------------------------------------------------

--
-- Structure de la table `user_user_group`
--

CREATE TABLE `user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `vendor`
--

INSERT INTO `vendor` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`, `city_id`) VALUES
(1, 2, 'Anouar', 'Kahla', 'kahla.anoir@gmail.com', NULL, NULL, NULL, 2),
(2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vendor_service`
--

CREATE TABLE `vendor_service` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `cost_min` decimal(10,3) DEFAULT NULL,
  `cost_max` decimal(10,3) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `capacity_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `vendor_service`
--

INSERT INTO `vendor_service` (`id`, `service_id`, `vendor_id`, `cost_min`, `cost_max`, `email`, `description`, `address`, `latitude`, `longitude`, `city_id`, `capacity_id`, `title`, `picture`) VALUES
(2, 1, 1, '1000.000', '2000.000', 'kahla.anoir@gmail.com', 'Ma description nnnnnnn', 'Téboulba', '35.6439601', '10.946793899999989', 2, 3, 'Dressing service', 'b7db5c3dc415fa0fe696c4d889ce6146.jpeg'),
(3, 1, NULL, '1000.000', '2000.000', 'kahla.anoir@gmail.com', NULL, 'mahdia rajich', '35.46754130000001', '11.042893100000015', 2, 2, 'test', '206c0d4331481377574b4003b05f93c1.gif'),
(4, 1, NULL, NULL, NULL, 'kahla.anoir@gmail.com', NULL, NULL, '34.2723275', '-118.02552129999998', 2, NULL, 'Test', '6d3e9e67962c6fed9ce53c9f1ea38392.gif'),
(5, 1, NULL, NULL, NULL, 'kahla.anoir@gmail.com', NULL, NULL, '34.2723275', '-118.02552129999998', 2, NULL, 'Test', '7a7724496209728d15763b6f42aface6.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `vendor_service_url`
--

CREATE TABLE `vendor_service_url` (
  `id` int(11) NOT NULL,
  `url_id` int(11) DEFAULT NULL,
  `vendor_service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `vendor_service_url`
--

INSERT INTO `vendor_service_url` (`id`, `url_id`, `vendor_service_id`) VALUES
(2, 19, 2),
(3, 20, 3),
(4, 21, 4),
(5, 22, 5);

-- --------------------------------------------------------

--
-- Structure de la table `vendor_url`
--

CREATE TABLE `vendor_url` (
  `id` int(11) NOT NULL,
  `url_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `vendor_url`
--

INSERT INTO `vendor_url` (`id`, `url_id`, `vendor_id`) VALUES
(7, 12, 1),
(8, 13, 1),
(10, 16, 1);

-- --------------------------------------------------------

--
-- Structure de la table `wife`
--

CREATE TABLE `wife` (
  `id` int(11) NOT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `wife`
--

INSERT INTO `wife` (`id`, `father_name`, `mother_name`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`) VALUES
(1, 'MUUU', 'WSS', 'ANNN', 'Kahla', 'kahla.anouar@yahoo.f', '96754000', '(+00) 850 850 8899', '141, Street Name, Area Name, Town, Australia.'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_73F2F77BED5CA9E6` (`service_id`),
  ADD KEY `IDX_73F2F77BF66468CA` (`couple_id`);

--
-- Index pour la table `budget_item`
--
ALTER TABLE `budget_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65DF274E36ABA6B8` (`budget_id`);

--
-- Index pour la table `capacity`
--
ALTER TABLE `capacity`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `couple`
--
ALTER TABLE `couple`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D840B549A76ED395` (`user_id`),
  ADD UNIQUE KEY `UNIQ_D840B5496D960872` (`husband_id`),
  ADD UNIQUE KEY `UNIQ_D840B54918D2F6B7` (`wife_id`),
  ADD KEY `IDX_D840B5498BAC62AF` (`city_id`);

--
-- Index pour la table `couple_url`
--
ALTER TABLE `couple_url`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E4E562FB81CFDAE7` (`url_id`),
  ADD KEY `IDX_E4E562FBF66468CA` (`couple_id`);

--
-- Index pour la table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ACB79A35F66468CA` (`couple_id`);

--
-- Index pour la table `husband`
--
ALTER TABLE `husband`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_527EDB25A76ED395` (`user_id`);

--
-- Index pour la table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD KEY `IDX_8D93D6498BAC62AF` (`city_id`),
  ADD KEY `IDX_8D93D6499D419299` (`user_type_id`);

--
-- Index pour la table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8F02BF9D5E237E06` (`name`);

--
-- Index pour la table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_user_group`
--
ALTER TABLE `user_user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `IDX_28657971A76ED395` (`user_id`),
  ADD KEY `IDX_28657971FE54D947` (`group_id`);

--
-- Index pour la table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F52233F6A76ED395` (`user_id`),
  ADD KEY `IDX_F52233F68BAC62AF` (`city_id`);

--
-- Index pour la table `vendor_service`
--
ALTER TABLE `vendor_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FFEAA2BDED5CA9E6` (`service_id`),
  ADD KEY `IDX_FFEAA2BDF603EE73` (`vendor_id`),
  ADD KEY `IDX_FFEAA2BD8BAC62AF` (`city_id`),
  ADD KEY `IDX_FFEAA2BD66B6F0BA` (`capacity_id`);

--
-- Index pour la table `vendor_service_url`
--
ALTER TABLE `vendor_service_url`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_56AB7F681CFDAE7` (`url_id`),
  ADD KEY `IDX_56AB7F677297D81` (`vendor_service_id`);

--
-- Index pour la table `vendor_url`
--
ALTER TABLE `vendor_url`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_56580E5581CFDAE7` (`url_id`),
  ADD KEY `IDX_56580E55F603EE73` (`vendor_id`);

--
-- Index pour la table `wife`
--
ALTER TABLE `wife`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `budget_item`
--
ALTER TABLE `budget_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `capacity`
--
ALTER TABLE `capacity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `couple`
--
ALTER TABLE `couple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `couple_url`
--
ALTER TABLE `couple_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `husband`
--
ALTER TABLE `husband`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `url`
--
ALTER TABLE `url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `vendor_service`
--
ALTER TABLE `vendor_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `vendor_service_url`
--
ALTER TABLE `vendor_service_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `vendor_url`
--
ALTER TABLE `vendor_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `wife`
--
ALTER TABLE `wife`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `FK_73F2F77BED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `FK_73F2F77BF66468CA` FOREIGN KEY (`couple_id`) REFERENCES `couple` (`id`);

--
-- Contraintes pour la table `budget_item`
--
ALTER TABLE `budget_item`
  ADD CONSTRAINT `FK_65DF274E36ABA6B8` FOREIGN KEY (`budget_id`) REFERENCES `budget` (`id`);

--
-- Contraintes pour la table `couple`
--
ALTER TABLE `couple`
  ADD CONSTRAINT `FK_D840B54918D2F6B7` FOREIGN KEY (`wife_id`) REFERENCES `wife` (`id`),
  ADD CONSTRAINT `FK_D840B5496D960872` FOREIGN KEY (`husband_id`) REFERENCES `husband` (`id`),
  ADD CONSTRAINT `FK_D840B5498BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `FK_D840B549A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `couple_url`
--
ALTER TABLE `couple_url`
  ADD CONSTRAINT `FK_E4E562FB81CFDAE7` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`),
  ADD CONSTRAINT `FK_E4E562FBF66468CA` FOREIGN KEY (`couple_id`) REFERENCES `couple` (`id`);

--
-- Contraintes pour la table `guest`
--
ALTER TABLE `guest`
  ADD CONSTRAINT `FK_ACB79A35F66468CA` FOREIGN KEY (`couple_id`) REFERENCES `couple` (`id`);

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6498BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `FK_8D93D6499D419299` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`);

--
-- Contraintes pour la table `user_user_group`
--
ALTER TABLE `user_user_group`
  ADD CONSTRAINT `FK_28657971A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_28657971FE54D947` FOREIGN KEY (`group_id`) REFERENCES `user_group` (`id`);

--
-- Contraintes pour la table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `FK_F52233F68BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `FK_F52233F6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `vendor_service`
--
ALTER TABLE `vendor_service`
  ADD CONSTRAINT `FK_FFEAA2BD66B6F0BA` FOREIGN KEY (`capacity_id`) REFERENCES `capacity` (`id`),
  ADD CONSTRAINT `FK_FFEAA2BD8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `FK_FFEAA2BDED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `FK_FFEAA2BDF603EE73` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Contraintes pour la table `vendor_service_url`
--
ALTER TABLE `vendor_service_url`
  ADD CONSTRAINT `FK_56AB7F677297D81` FOREIGN KEY (`vendor_service_id`) REFERENCES `vendor_service` (`id`),
  ADD CONSTRAINT `FK_56AB7F681CFDAE7` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`);

--
-- Contraintes pour la table `vendor_url`
--
ALTER TABLE `vendor_url`
  ADD CONSTRAINT `FK_56580E5581CFDAE7` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`),
  ADD CONSTRAINT `FK_56580E55F603EE73` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- UPDATE 07/08/2019
--

CREATE TABLE enquiry (id INT AUTO_INCREMENT NOT NULL, couple_id INT NOT NULL, vendor_id INT DEFAULT NULL, vendor_service_id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(50) NOT NULL, phone VARCHAR(20) NOT NULL, wedding_date DATE DEFAULT NULL, phone_call_back TINYINT(1) DEFAULT '1', email_response_back TINYINT(1) DEFAULT '1', INDEX IDX_9D996984F66468CA (couple_id), INDEX IDX_9D996984F603EE73 (vendor_id), INDEX IDX_9D99698477297D81 (vendor_service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB;
ALTER TABLE enquiry ADD CONSTRAINT FK_9D996984F66468CA FOREIGN KEY (couple_id) REFERENCES couple (id);
ALTER TABLE enquiry ADD CONSTRAINT FK_9D996984F603EE73 FOREIGN KEY (vendor_id) REFERENCES vendor (id);
ALTER TABLE enquiry ADD CONSTRAINT FK_9D99698477297D81 FOREIGN KEY (vendor_service_id) REFERENCES vendor_service (id);
ALTER TABLE user_group CHANGE name name VARCHAR(180) NOT NULL;
ALTER TABLE vendor_service ADD phone VARCHAR(20) DEFAULT NULL, ADD youtube_video_id VARCHAR(50) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL;
ALTER TABLE user DROP locked, DROP expired, DROP expires_at, DROP credentials_expired, DROP credentials_expire_at, CHANGE username username VARCHAR(180) NOT NULL, CHANGE username_canonical username_canonical VARCHAR(180) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE email_canonical email_canonical VARCHAR(180) NOT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL;
CREATE UNIQUE INDEX UNIQ_8D93D649C05FB297 ON user (confirmation_token);
ALTER TABLE budget_item DROP due_amount;
