-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 18 déc. 2024 à 20:08
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Contenu` text,
  `blogID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogID_fk` (`blogID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Titre` text,
  `Contenu` text,
  `DatePubli` date DEFAULT NULL,
  `IsVisible` int DEFAULT NULL,
  `userID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userID_fk` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id`, `Titre`, `Contenu`, `DatePubli`, `IsVisible`, `userID`) VALUES
(3, 'PES ou Fifa?', 'J\'aimerais avoir votre avis sur ces jeux !', '2024-12-18', 1, 1),
(4, 'Plutôt chien ou chat?', 'J\'aimerais avoir votre avis sur ces animaux !', '2024-12-18', 1, 1),
(5, 'Juste pour faire un essai', 'Ceci est un contenu de démonstration pour tester la longueur maximale qui peut être affichée sur cette page\r\n', '2024-12-18', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` text,
  `Email` text,
  `Password` text,
  `IsAdmin` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `Name`, `Email`, `Password`, `IsAdmin`) VALUES
(1, 'Cyril', 'aaa@gmail.com', 'aaa', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `blogID_fk` FOREIGN KEY (`blogID`) REFERENCES `topic` (`id`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `userID_fk` FOREIGN KEY (`userID`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
