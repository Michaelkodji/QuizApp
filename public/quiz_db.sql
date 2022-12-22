-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 05 mai 2021 à 08:51
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `quiz_db`
--
CREATE DATABASE IF NOT EXISTS `quiz_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `quiz_db`;

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_word` text,
  `answer_type` varchar(20) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`answer_id`, `answer_word`, `answer_type`, `question_id`) VALUES
(1, 'thomas boni yayi', 'bad', 2),
(2, 'nicephore sogolo', 'bad', 2),
(3, 'patrice talon', 'good', 2),
(4, 'abidjan', 'bad', 1),
(5, 'dakar', 'bad', 1),
(6, 'louanda', 'good', 1),
(7, '1990', 'bad', 5),
(8, '1981', 'bad', 5),
(9, '1991', 'good', 5),
(10, '1945', 'bad', 6),
(11, '1940', 'bad', 6),
(12, '1920', 'good', 6),
(13, 'php', 'good', 7),
(14, 'ruby', 'bad', 7),
(15, 'cobol', 'bad', 7);

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(150) DEFAULT NULL,
  `member_phone` varchar(20) DEFAULT NULL,
  `member_mail` varchar(150) DEFAULT NULL,
  `member_pwd` varchar(150) DEFAULT NULL,
  `member_status` varchar(10) DEFAULT 'disabled',
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`member_id`, `member_name`, `member_phone`, `member_mail`, `member_pwd`, `member_status`) VALUES
(1, 'dupont jean', '61454647', NULL, '$2y$10$sLrlN1v7vQV056fiW7vfouu/uo/i4rLw8LxjFLQZh9YofCIIijrMe', 'disabled'),
(2, 'lelour florient', '67121314', 'flelour@tata.lan', '$2y$10$pOkcTljMoy.2CSNBrUIGtuJlxstWMAkJ.ddlltgRYQ.VXsV3x3wy6', 'disabled');

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `id_quiz` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `note_obtenu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_quiz`,`id_u`),
  KEY `id_u` (`id_u`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_word` text,
  `question_note` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `question_word`, `question_note`, `test_id`) VALUES
(1, 'quelle est la capitale de langola ?', 5, 1),
(2, 'qui est le president du benin ?', 5, 1),
(7, 'parmis les languages lequel est un language de programmation serveur ?', 3, 2),
(5, 'quelle est lannee de creation du systeme linux', 2, 1),
(6, 'quelle est lannee de creation de la sdn', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_word` text,
  `test_duration` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`test_id`, `test_word`, `test_duration`, `member_id`) VALUES
(1, 'test1', 120, 1),
(2, 'test2', 160, 1),
(3, 'test3', 180, 1),
(5, 'test5', 300, 1),
(8, 'epreuve1', 150, 2),
(9, 'epreuve2', 200, 2),
(10, 'epreuve3', 250, 2),
(11, 'epreuve4', 150, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
