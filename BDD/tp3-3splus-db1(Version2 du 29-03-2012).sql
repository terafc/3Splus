-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 29 Mars 2012 à 04:50
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `3splus`
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
  `validated` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `paid`, `date`, `validated`) VALUES
(12, 1, 1, '2012-03-28', NULL),
(11, 1, 1, '2012-03-28', NULL);
