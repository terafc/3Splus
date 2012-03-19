-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 19 Mars 2012 à 01:09
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
(1, 'Groupe 1', '2012-03-19'),
(2, 'Groupe 2', '2012-03-02');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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

INSERT INTO `order_details` (`id_order`, `id_product`, `amount`, `sauce`) VALUES
(5, 1, 1, NULL),
(5, 1, 1, NULL),
(5, 1, 1, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `price`, `id_category`) VALUES
(1, 'Pain', 'frefzefezf', 2.5, 1),
(2, 'Pain2', 'fdsqfq', 2.8, 1),
(3, 'Pain3', 'fds', 1, 1),
(4, 'Pain4', 'fdsq', 0.5, 1),
(5, 'Pain5', 'frsdq', 5, 1);

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
  `point` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `lastname`, `firstname`, `email`, `id_group`, `id_facebook`, `point`) VALUES
('1', 'RIVIERE', 'Serge', 's.riviere@rt-iut.re', 1, '1', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users_authorized`
--

