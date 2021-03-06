-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 01 Avril 2012 à 14:13
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `3splus`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id_admin` int(6) NOT NULL AUTO_INCREMENT,
  `name_admin` varchar(60) NOT NULL,
  `mdp_admin` varchar(60) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin_users`
--

INSERT INTO `admin_users` (`id_admin`, `name_admin`, `mdp_admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structure de la table `carrier`
--

CREATE TABLE IF NOT EXISTS `carrier` (
  `carriers` varchar(255) NOT NULL COMMENT 'Liste des id_user des porteurs',
  `id_user` varchar(255) NOT NULL,
  `id_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT 'Permet de savoir si la commande a été récupéré'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `carrier`
--


-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'sandwich chaud'),
(2, 'viennoiserie Et Chocolat'),
(3, 'salade'),
(4, 'glace'),
(5, 'boisson'),
(6, 'sandwich froid');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `groups`
--

INSERT INTO `groups` (`id_group`, `name`, `created_at`) VALUES
(1, 'GodLike', '2012-03-19'),
(2, 'Rampage', '2012-03-02');

-- --------------------------------------------------------

--
-- Structure de la table `log_email`
--

CREATE TABLE IF NOT EXISTS `log_email` (
  `idMail` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `idConfirm` varchar(255) NOT NULL,
  `datePost` datetime NOT NULL,
  PRIMARY KEY (`idMail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `log_email`
--


-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `paid` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `orders`
--


-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `amount` tinyint(4) NOT NULL,
  `sauce` varchar(10) DEFAULT NULL COMMENT 'Sauce, si existe.'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `order_details`
--


-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `price`, `id_category`) VALUES
(7, 'pain bouchon', 'pain bouchon poulet', 2, 1),
(6, 'americain', 'americain jambon', 2.5, 1),
(13, 'thon mais', 'pain thon mais', 1.5, 6),
(14, 'fanta', 'fanta orange', 1.5, 5),
(11, 'pain poulet', 'pain poulet', 1.5, 6),
(12, 'coca', 'coca-cola canette', 1, 5),
(15, 'glace baton', 'glace baton chocolat vanille', 2, 4),
(16, 'glace cornet', 'glace cornet fraise', 2, 4),
(17, 'pain au chocolat', 'petit pain au chocolat', 1.3, 2),
(18, 'croissant', 'petit croissant', 1, 2),
(19, 'salade verte', 'salade verte sans sauce', 1, 3),
(20, 'salade de pates', 'salade de pates et crudité', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_facebook` varchar(255) NOT NULL,
  `point` float NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `lastname`, `firstname`, `email`, `id_group`, `id_facebook`, `point`) VALUES
('1', 'RIVIERE', 'Serge', 's.riviere@rt-iut.re', 1, '1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users_authorized`
--

CREATE TABLE IF NOT EXISTS `users_authorized` (
  `id_users_authorized` int(255) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_users_authorized`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `users_authorized`
--

INSERT INTO `users_authorized` (`id_users_authorized`, `lastname`, `firstname`, `email`, `status`) VALUES
(1, 'RIVIERE', 'Serge', 's.riviere@rt-iut.re', 1),
(2, 'PANCHBAYA', 'louqmane', 'l.panchbaya@rt-iut.re', 0),
(3, 'TOULCANON', 'Loïc', 'l.toulcanon@rt-iut.re', 0),
(4, 'NANDJAN', 'Clément', 'c.nandjan@rt-iut.re', 0),
(5, 'PITOY', 'Elodie', 'e.pitoy@rt-iut.re', 0);
