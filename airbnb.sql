-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 juin 2020 à 13:34
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
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(35) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`email`, `mot_de_passe`, `id_admin`, `prenom`) VALUES
('jl@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 'Jean Louis');

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
  `id_publicateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `ville`, `titre`, `description`, `locataires_max`, `prix`, `id_publicateur`) VALUES
(1, 'Porto', 'appartement dans le centre ville', 'vachement cosy lorem ipsum dolor', 5, '125', 4),
(2, 'Porto', 'appart de luxe', 'la description qu\'est bien', 5, '70', 4),
(3, 'Porto', 'appart de merde', 'description', 1, '35', 5),
(4, 'Porto', 'palace avec piscine', 'desc', 7, '150', 3),
(5, 'Porto', 'Grosse maison au bord de la mer', 'C\'est une grosse maison au bord de la mer et il y a même des toilettes dedans', 12, '61', 2),
(6, 'Porto', 'Taudis dans le centre ville', 'tu vas vivre dans une poubelle jtexplik :  ^)', 1, '1', 5),
(8, 'Porto', 'Camping car', 'Camping car sur un parking très convivial avec des touristes gentils', 1, '150', 5),
(10, 'Porto', 'gros camping car gentil', 'camping car très affectueux sur son aimable parking ', 1, '200', 5),
(15, 'Porto', 'JOLI CAMPING CAR ', 'camping \r\nCAR', 2, '1', 5),
(17, 'Porto', 'Camping car bis ', 'camping car bis ', 12, '9', 5),
(18, 'Porto', 'Caravane', 'caravane de luxe', 18, '50', 5),
(19, 'Porto', 'logement social de pauvre', 'nid à sdf et a crackés du cul', 16, '6', 5),
(30, 'Paris', 'Petit appartement à paris', 'Appartement de 20m², il y a des toilettes et une salle de bains dans le couloir tu vas voir c caley', 1, '85', 5),
(64, 'Poissy', 'Appartement pisciacais', 'ATTONTION C CHÉ OIM DONK FETEZ PA LÉ KON', 3, '2', 5),
(65, 'Achères', 'Maison de caractère à 30 minutes de Paris', 'Maison en forêt qu\'est vachement bien', 6, '20', 10),
(66, 'Saint Rémy les Chevreuses', 'ANNONCE', 'AAAAAAAAAAAA', 8, '15', 5);

-- --------------------------------------------------------

--
-- Structure de la table `blocage`
--

CREATE TABLE `blocage` (
  `id_bloqueur` int(9) NOT NULL,
  `id_bloque` int(9) NOT NULL,
  `vraifaux` tinyint(1) NOT NULL DEFAULT 0,
  `id_blocage` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `blocage`
--

INSERT INTO `blocage` (`id_bloqueur`, `id_bloque`, `vraifaux`, `id_blocage`) VALUES
(5, 6, 0, 1),
(5, 6, 0, 5),
(5, 6, 0, 6),
(5, 6, 0, 7),
(5, 9, 0, 8),
(5, 6, 0, 9),
(5, 6, 0, 10),
(5, 5, 0, 11),
(5, 6, 0, 12),
(5, 6, 0, 13),
(5, 6, 0, 14),
(10, 4, 0, 15),
(5, 10, 0, 16);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `nom` varchar(500) DEFAULT NULL,
  `id_annonce_image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id_image`, `nom`, `id_annonce_image`) VALUES
(0, 'img/annonces/159222059110IMG_20190814_160424.jpg', 65),
(1, 'img/pika.jpg', 4),
(2, 'img/pika.jpg', 1),
(3, 'img/pika.jpg', 3),
(4, 'img/l\'ovni.jpg', 3),
(5, 'img/5apartment-building-1149751_1280.jpg1591718313', 30),
(43, 'img/annonces/1591726193550e84488-interracialviolentcrime.jpg', 64),
(44, 'img/annonces/15917261935apartment-building-1149751_1280.jpg', 64),
(45, 'img/annonces/15917261945couv-différences-entre-camper-et-stationner.jpg', 64),
(46, 'img/annonces/15917261945fond_de_base.jpg', 64),
(47, 'img/annonces/15917261945Inkedelizabeth 2 angleterre _LI.jpg', 64),
(48, 'img/annonces/15917261945téléchargement.jpg', 64),
(49, 'img/annonces/15917261945unknown.png', 64),
(50, 'img/annonces/159173310510114-modele-maison-individuelle-a-etage-1.jpg', 65),
(51, 'img/annonces/159173310510amenagement-interieur-04042018-1151-e1522835690753.jpg', 65),
(52, 'img/annonces/159173310510CE3.jpg', 65),
(53, 'img/annonces/159173310510maison-de-plain-pied-seloger-construire.jpg', 65),
(57, 'img/annonces/15919704155Ancienne horloge anglaise buckingham.jpg', 66),
(58, 'img/annonces/15919704165artisanat horlogerie traditionnel ancien.jpg', 66),
(59, 'img/annonces/15919704165banner-1240822_1280.jpg', 66),
(60, 'img/annonces/15919704165buckingham-palace angleterre traditionnelle artisanat savoir faire .jpg', 66),
(61, 'img/annonces/15919704165elizabeth 2 angleterre .jpg', 66),
(62, 'img/annonces/15919704165fractal-1280079_1280.jpg', 66),
(63, 'img/annonces/15919704165Horloge_abeilles_bois_2000x.jpg', 66),
(64, 'img/annonces/15919704165Horloge_vintage_retro_70_2000x.jpg', 66),
(65, 'img/annonces/15919704165jon-tyson-WaOwBKTiQcg-unsplash.jpg', 66),
(66, 'img/annonces/15919704165product-image-935686220_2000x.jpg', 66),
(67, 'img/annonces/15919704165scientific-2040795_1280.jpg', 66);

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
(4, '2020-06-05 23:59:59', '<p style = \'color : red;\'><strong><i>Ce message a été supprimé par un administrateur car il ne respecte pas les règles de la communauté.</i></strong></p>', 5, 7),
(5, '2020-06-08 23:59:59', 'petit message d\'amour <3 ', 7, 5),
(6, '2021-06-08 23:59:59', 'salut mon pote !', 5, 9),
(8, '2020-01-04 23:59:59', '<p style = \'color : red;\'><strong><i>Ce message a été supprimé par un administrateur car il ne respecte pas les règles de la communauté.</i></strong></p>', 5, 6),
(29, '2020-06-08 11:44:56', 'bonjour', 6, 5),
(35, '2020-06-09 08:53:26', 'bangz', 9, 5),
(39, '2020-06-09 14:36:19', 'BOUBOUBOUBOUBOUUUUU', 7, 5),
(42, '2020-06-09 14:57:32', 'Bonjour abc !', 2, 5),
(48, '2020-06-09 21:55:51', 'Coucou c\'est moi ', 6, 5),
(49, '2020-06-10 12:56:46', 'salut mon pote ', 2, 5),
(52, '2020-06-10 16:51:11', 'salut', 5, 10),
(54, '2020-06-15 13:11:37', 'Salut', 5, 5),
(55, '2020-06-15 13:24:52', 'yo le rap', 5, 10);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_annonce_reservee` int(9) DEFAULT NULL,
  `id_reservant` int(9) DEFAULT NULL,
  `id_reservation` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `date_annulation` date DEFAULT NULL,
  `prix_reservation` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_annonce_reservee`, `id_reservant`, `id_reservation`, `date_debut`, `date_fin`, `date_annulation`, `prix_reservation`) VALUES
(65, 5, 7, '2020-07-01', '2020-08-01', '2020-06-15', 620),
(5, 5, 8, '2020-11-01', '2021-01-01', NULL, 3721),
(15, 5, 9, '2020-08-02', '2020-08-11', '2020-06-15', 9);

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

CREATE TABLE `signalement` (
  `id_signalement` int(9) NOT NULL,
  `id_message_signale` int(9) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `motif` varchar(100) NOT NULL,
  `traitement` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `signalement`
--

INSERT INTO `signalement` (`id_signalement`, `id_message_signale`, `description`, `motif`, `traitement`) VALUES
(1, 4, 'description signalement ', 'insulte', 1),
(16, 6, 'il é pa gentil ', 'insulte', 1),
(17, 8, 'ouin ouin il é pa jonti', 'insulte', 0),
(18, 8, 'caca', 'insulte', 1),
(19, 8, 'C pas gentil ', 'harcelement', 0),
(21, 52, 'c pas bien \r\n', 'harcelement', 0);

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
  `capital` int(11) NOT NULL,
  `image_profil` varchar(500) DEFAULT NULL,
  `banni` tinyint(1) NOT NULL DEFAULT 0,
  `date_fin_exclusion` date NOT NULL DEFAULT '2000-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `prenom`, `nom`, `sexe`, `email`, `date_creation_compte`, `note`, `statut`, `mot_de_passe`, `capital`, `image_profil`, `banni`, `date_fin_exclusion`) VALUES
(1, 'alexis', 'richy', 'm', 'alexisrichy@gmail.com', '2011-12-10', 4.5, 'ambassadeur', 'd2104a400c7f629a197f33bb33fe80c0', 0, 'img/site/profil_defaut.jpg', 0, '2000-01-01'),
(2, 'abc', 'abc', 'm', 'abc@abc.abc', '2020-06-04', NULL, 'Nouvel arrivant', 'd2104a400c7f629a197f33bb33fe80c0', 0, 'img/site/profil_defaut.jpg', 0, '2000-01-01'),
(3, 'bécu', 'Juliette', 'f', 'juliettebecu@gmail.com', '2020-06-04', NULL, 'Nouvel arrivant', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'img/site/profil_defaut.jpg', 0, '2000-01-01'),
(4, 'proutent', 'jeanne charlotte ', 'f', 'jc@jc.fr', '2020-06-04', NULL, 'Nouvel arrivant', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'img/site/profil_defaut.jpg', 0, '2000-01-01'),
(5, 'Marcia', 'De Noord', 'f', 'marciadenoord@gmail.com', '2020-06-04', NULL, 'Nouvel arrivant', 'e9d3233b0e482f2e96b7a64f90a04e48', 1748, 'img/profils/15919748015', 0, '2020-06-01'),
(6, 'Precious', 'Pelenio', 'm', 'precious.pelenio@ynov.com', '2020-06-05', NULL, 'Nouvel arrivant', 'fabd6b235e04e220538807d265b92a7b', 0, 'img/site/profil_defaut.jpg', 0, '2020-06-19'),
(7, 'Girl', 'Barbie', 'f', 'barbie@barbie.com', '2020-06-05', NULL, 'Nouvel arrivant', 'f632fa6f8c3d5f551c5df867588381ab', 0, 'img/site/profil_defaut.jpg', 0, '2000-01-01'),
(8, 'Neige', 'Blanche', 'f', 'blanche@neige.com', '2020-06-05', NULL, 'Nouvel arrivant', '900150983cd24fb0d6963f7d28e17f72', 0, 'img/site/profil_defaut.jpg', 0, '2000-01-01'),
(9, 'Roi du monde', ':)', 'm', 'roidumonde@prout.com', '2020-06-05', NULL, 'Nouvel arrivant', 'd2104a400c7f629a197f33bb33fe80c0', 0, 'img/site/profil_defaut.jpg', 1, '2000-01-01'),
(10, 'Guillemette', 'Dussart', '', 'guillemette.dussart@yahoo.fr', '2020-06-09', NULL, 'Nouvel arrivant', '944de8673b0f2d1603a6ff33b18b8192', 0, 'img/profils/159222036210IMG_20190802_152925.jpg', 0, '2000-01-01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `fk_id_utilisateur` (`id_publicateur`);

--
-- Index pour la table `blocage`
--
ALTER TABLE `blocage`
  ADD PRIMARY KEY (`id_blocage`),
  ADD KEY `id_bloqueur` (`id_bloqueur`),
  ADD KEY `id_bloque` (`id_bloque`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_annonce` (`id_annonce_image`);

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
  ADD KEY `fk_reservation_annonce` (`id_annonce_reservee`),
  ADD KEY `fk_reservation_utilisateur` (`id_reservant`) USING BTREE;

--
-- Index pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD PRIMARY KEY (`id_signalement`),
  ADD KEY `id_message_signale` (`id_message_signale`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id_annonce` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `blocage`
--
ALTER TABLE `blocage`
  MODIFY `id_blocage` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `signalement`
--
ALTER TABLE `signalement`
  MODIFY `id_signalement` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `fk_id_utilisateur` FOREIGN KEY (`id_publicateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `blocage`
--
ALTER TABLE `blocage`
  ADD CONSTRAINT `blocage_ibfk_1` FOREIGN KEY (`id_bloqueur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `blocage_ibfk_2` FOREIGN KEY (`id_bloque`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_annonce_image`) REFERENCES `annonce` (`id_annonce`);

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
  ADD CONSTRAINT `fk_reservation_annonce` FOREIGN KEY (`id_annonce_reservee`) REFERENCES `annonce` (`id_annonce`),
  ADD CONSTRAINT `fk_reservation_utilisateur` FOREIGN KEY (`id_reservant`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD CONSTRAINT `signalement_ibfk_1` FOREIGN KEY (`id_message_signale`) REFERENCES `message` (`id_message`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
