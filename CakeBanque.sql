-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 11 Octobre 2018 à 16:56
-- Version du serveur :  5.6.37
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `CakeBanque`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `body` text,
  `published` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `title`, `slug`, `body`, `published`, `created`, `modified`) VALUES
(8, 13, '287 rue de limoges', 'nvgn djasldkasdas;ld', 'ad efsdf sef ', 0, '2018-10-08 20:16:50', '2018-10-08 22:58:32');

-- --------------------------------------------------------

--
-- Structure de la table `addresses_files`
--

CREATE TABLE IF NOT EXISTS `addresses_files` (
  `id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `addresses_tags`
--

CREATE TABLE IF NOT EXISTS `addresses_tags` (
  `address_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `addresses_tags`
--

INSERT INTO `addresses_tags` (`address_id`, `tag_id`) VALUES
(8, 3);

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `customers`
--

INSERT INTO `customers` (`id`, `address_id`, `name`, `customer`, `created`, `modified`) VALUES
(4, 8, 'Oussama Youcef Bokari', '1235fgfdg', '2018-10-11 13:13:35', '2018-10-11 13:13:35');

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE IF NOT EXISTS `employes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `additional_informations` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `employes`
--

INSERT INTO `employes` (`id`, `user_id`, `name`, `adress`, `city`, `province`, `postal_code`, `region`, `additional_informations`) VALUES
(1, 33, 'michel shrerer', '', 'Laval', 'Québec', 'H7M 2Y', 'rive nord', 'il est malade mentalement le pauvre');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `created`, `modified`, `status`) VALUES
(1, 'Béjaia.jpg', 'Files/', '2018-10-08 23:46:13', '2018-10-08 23:46:13', 1),
(2, 'youc.png', 'Files/', '2018-10-11 13:35:01', '2018-10-11 13:35:01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `i18n`
--

CREATE TABLE IF NOT EXISTS `i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `i18n`
--

INSERT INTO `i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(5, 'ar', 'Addresses', 8, 'title', '287 rue de limoges');

-- --------------------------------------------------------

--
-- Structure de la table `phinxlog`
--

CREATE TABLE IF NOT EXISTS `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20181010231224, 'Initial', '2018-10-11 03:12:26', '2018-10-11 03:12:26', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `title`, `created`, `modified`) VALUES
(1, 'premier tag', '2018-09-27 14:39:31', '2018-09-27 14:39:31'),
(2, 'cvd', '2018-09-27 16:45:37', '2018-09-27 16:45:37'),
(3, 'bmbm', '2018-10-07 17:18:40', '2018-10-07 17:18:40'),
(4, 'deuxième tag', '2018-10-11 13:39:03', '2018-10-11 13:39:03');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `role` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created`, `modified`, `role`) VALUES
(13, 'youcef-pino@hotmail.fr', '$2y$10$fDghZhJLlIihmPgwealg/OUlokg815O1we58xM0d0lxJTRdz3TdA2', 9, 9, 'admin'),
(19, 'bobeponge@hotmail.com', '$2y$10$kp4q8ymbMI8/3Wha.bPBOOhOtjaEv2rOoDqKRT.MTm.vjcVJSROge', 18, 18, 'toBeCustomer'),
(20, 'cynt@bidon.com', '$2y$10$ef31Ud4bEAmKSE6bH4cZOuS4pSIYNUqm9pdpTQkt9xR7qRC/tioe6', 18, 18, 'toBeCustomer'),
(21, 'camarche@gmail.com', '$2y$10$m.UL/Ur2BldPSaC473W.kucYjgbXx9w5.9jSky6csnN8z9BErrjQy', 18, 18, 'toBeCustomer'),
(26, 'bobeponge@hotmail.dessin', '$2y$10$khjiKWDH9wgC.91mpbtI1uMr0yrcY5UKsJSQ2ZoTYdU.8agB/V3lu', 18, 18, 'toBeEmploye'),
(28, 'grr@grr.com', '$2y$10$S1GbIEVdTU1u45kGsU9wLOeE/1oDVonl2Q8m87GBhJnuP9lY/WktK', 18, 10, 'toBeEmploye'),
(29, 'vlad@mich.com', '$2y$10$yzKNptrioGdBjYuoPFNX9e8xKk4f8IUn7VoZq9lM9aNBNOq6Bj5Nm', 10, 10, 'toBeEmploye'),
(30, 'bar@bar.fr', '$2y$10$za7qCiHNtVU9g2pCK0BdlO6WLnmV8KSs4WiGwnFrJjt4XY06eXBda', 10, 10, 'toBeEmploye'),
(31, 'bar@far.fr', '$2y$10$9qbf3VYdaIRzAtuuCukT5.iiBF/X5thMt1LLSOP4MTIKbSRBq6YTG', 10, 10, 'toBeCustomer'),
(32, 'mich@outlook.fr', '$2y$10$z4wZnJjFdUoynbGvZJyvtuz7DZs0/TVFeh6AK5tU2gXKYQ06l2Z4G', 10, 10, 'toBeCustomer'),
(33, 'pavel@hotmail.com', '$2y$10$Lp0IoQdZ8lDILbGi41lQF.9G6RDqS3rCF/oBBQ47cp7HhaJLM5FeK', 10, 10, 'employe');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_key` (`user_id`) USING BTREE;

--
-- Index pour la table `addresses_files`
--
ALTER TABLE `addresses_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `file_id` (`file_id`) USING BTREE;

--
-- Index pour la table `addresses_tags`
--
ALTER TABLE `addresses_tags`
  ADD PRIMARY KEY (`address_id`,`tag_id`) USING BTREE,
  ADD KEY `tag_key` (`tag_id`) USING BTREE;

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_id` (`address_id`) USING BTREE;

--
-- Index pour la table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `i18n`
--
ALTER TABLE `i18n`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  ADD KEY `I18N_FIELD` (`model`,`foreign_key`,`field`);

--
-- Index pour la table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `addresses_files`
--
ALTER TABLE `addresses_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `employes`
--
ALTER TABLE `employes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `i18n`
--
ALTER TABLE `i18n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `addresses_files`
--
ALTER TABLE `addresses_files`
  ADD CONSTRAINT `addresses_files_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `addresses_files_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

--
-- Contraintes pour la table `addresses_tags`
--
ALTER TABLE `addresses_tags`
  ADD CONSTRAINT `addresses_tags_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `addresses_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Contraintes pour la table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

--
-- Contraintes pour la table `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `employes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
