-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 08 juin 2020 à 14:59
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `airbnb`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id_annonce` int(6) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(700) DEFAULT NULL,
  `locataires_max` int(3) NOT NULL,
  `prix` varchar(30) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `ville`, `titre`, `description`, `locataires_max`, `prix`, `id_utilisateur`, `image`) VALUES
(1, 'Porto', 'appartement dans le centre ville', 'vachement cosy lorem ipsum dolor', 5, '125', 4, NULL),
(2, 'Porto', 'appart de luxe', 'la description qu\'est bien', 5, '70', 4, NULL),
(3, 'Porto', 'appart de merde', 'description', 1, '35', 5, NULL),
(4, 'Porto', 'palace avec piscine', 'desc', 7, '150', 3, NULL),
(5, 'Porto', 'Grosse maison au bord de la mer', 'C\'est une grosse maison au bord de la mer et il y a même des toilettes dedans', 12, '61', 2, NULL),
(6, 'Porto', 'Taudis dans le centre ville', 'tu vas vivre dans une poubelle jtexplik :  ^)', 1, '1', 5, NULL),
(8, 'Porto', 'Camping car', 'Camping car sur un parking très convivial avec des touristes gentils', 1, '150', 5, NULL),
(10, 'Porto', 'gros camping car gentil', 'camping car très affectueux sur son aimable parking ', 1, '200', 5, 'couv-différences-entre-camper-et-stationner.jpg'),
(15, 'Porto', 'JOLI CAMPING CAR ', 'camping \r\nCAR', 2, '1', 5, 'couv-différences-entre-camper-et-stationner.jpg'),
(17, 'Porto', 'Camping car bis ', 'camping car bis ', 12, '9', 5, ''),
(18, 'Porto', 'Caravane', 'caravane de luxe', 18, '50', 5, ''),
(19, 'Porto', 'logement social de pauvre', 'nid à sdf et a crackés du cul', 16, '6', 5, 'img/téléchargement.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(6) NOT NULL,
  `date_envoi` datetime NOT NULL,
  `contenu` varchar(1000) DEFAULT NULL,
  `id_destinataire` int(6) NOT NULL,
  `id_expediteur` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `date_envoi`, `contenu`, `id_destinataire`, `id_expediteur`) VALUES
(1, '2020-01-01 23:59:59', 'salut ceci est mon premier message', 6, 5),
(2, '2020-01-02 23:59:59', 'deuxieme message plus tard', 6, 5),
(3, '2020-01-03 23:59:59', 'troisieme message plus tard', 5, 6),
(4, '2020-06-05 23:59:59', 'ceci est un nouveau message de quelqu\'un d\'autre', 5, 7),
(5, '2020-06-08 23:59:59', 'petit message d\'amour <3 ', 7, 5),
(6, '2021-06-08 23:59:59', 'salut mon pote !', 5, 9),
(7, '2025-06-08 23:59:59', 'salut super message', 5, 1),
(8, '2020-01-04 23:59:59', 'quatrième message !', 5, 6),
(9, '2020-01-05 23:59:59', 'cinquième message ', 6, 5),
(10, '2020-01-06 23:59:59', 'sixième message ', 6, 5),
(11, '2020-06-08 11:36:34', 'salut mon pote!', 6, 5),
(29, '2020-06-08 11:44:56', 'bonjour', 6, 5),
(30, '2020-06-08 14:42:27', 'pétasse', 6, 5),
(31, '2020-06-08 14:54:23', 'GROS CACA', 6, 5),
(32, '2020-06-08 14:54:26', 'GROS CACA', 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_annonce` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `date_annulation` date DEFAULT NULL,
  `prix_reservation` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_annonce`, `id_utilisateur`, `id_reservation`, `date_debut`, `date_fin`, `date_annulation`, `prix_reservation`) VALUES
(1, 1, 1, '2011-12-10', '2011-12-17', NULL, 1800),
(1, 1, 2, '2011-04-15', '2011-04-22', NULL, 1800),
(1, 1, 3, '2011-06-01', '2011-07-13', NULL, 1800),
(2, 1, 4, '2004-12-10', '2006-12-10', NULL, 1500);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(6) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `sexe` enum('m','f') NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `date_creation_compte` date DEFAULT NULL,
  `note` float DEFAULT NULL,
  `statut` varchar(20) NOT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `capital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `prenom`, `nom`, `sexe`, `email`, `date_creation_compte`, `note`, `statut`, `mot_de_passe`, `capital`) VALUES
(1, 'alexis', 'richy', 'm', 'alexisrichy@gmail.com', '2011-12-10', 4.5, 'ambassadeur', 'd2104a400c7f629a197f33bb33fe80c0', 0),
(2, 'abc', 'abc', 'm', 'abc@abc.abc', '2020-06-04', NULL, 'Nouvel arrivant', 'd2104a400c7f629a197f33bb33fe80c0', 0),
(3, 'bécu', 'Juliette', 'f', 'juliettebecu@gmail.com', '2020-06-04', NULL, 'Nouvel arrivant', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(4, 'proutent', 'jeanne charlotte ', 'f', 'jc@jc.fr', '2020-06-04', NULL, 'Nouvel arrivant', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(5, 'Marcia', 'De Noord', 'f', 'marciadenoord@gmail.com', '2020-06-04', NULL, 'Nouvel arrivant', 'e9d3233b0e482f2e96b7a64f90a04e48', 0),
(6, 'Precious', 'Pelenio', 'm', 'precious.pelenio@ynov.com', '2020-06-05', NULL, 'Nouvel arrivant', 'fabd6b235e04e220538807d265b92a7b', 0),
(7, 'Girl', 'Barbie', 'f', 'barbie@barbie.com', '2020-06-05', NULL, 'Nouvel arrivant', 'f632fa6f8c3d5f551c5df867588381ab', 0),
(8, 'Neige', 'Blanche', 'f', 'blanche@neige.com', '2020-06-05', NULL, 'Nouvel arrivant', '900150983cd24fb0d6963f7d28e17f72', 0),
(9, 'du monde', 'Roi', 'm', 'roidumonde@prout.com', '2020-06-05', NULL, 'Nouvel arrivant', 'd2104a400c7f629a197f33bb33fe80c0', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `fk_id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_destinataire` (`id_destinataire`),
  ADD KEY `id_expediteur` (`id_expediteur`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `fk_reservation_utilisateur` (`id_utilisateur`),
  ADD KEY `fk_reservation_annonce` (`id_annonce`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id_annonce` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `fk_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_destinataire`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_expediteur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_annonce` FOREIGN KEY (`id_annonce`) REFERENCES `annonce` (`id_annonce`),
  ADD CONSTRAINT `fk_reservation_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
