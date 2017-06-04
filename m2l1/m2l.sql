-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 28 Mars 2017 à 13:46
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `olin`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `code_postal` int(11) NOT NULL,
  `id_a` int(11) NOT NULL,
  `numero_rue` int(11) NOT NULL,
  `rue` int(11) NOT NULL,
  `ville` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`code_postal`, `id_a`, `numero_rue`, `rue`, `ville`) VALUES
(94000, 1, 11, 11, 11);

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

CREATE TABLE `commenter` (
  `id_c` int(11) NOT NULL,
  `id_s` int(11) NOT NULL,
  `id_f` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id_f` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `duree` int(255) NOT NULL,
  `cout` int(255) NOT NULL,
  `date_debut` date NOT NULL,
  `nb_place` int(255) NOT NULL,
  `contenu` text NOT NULL,
  `id_a` int(255) NOT NULL,
  `id_p` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `formation`
--

INSERT INTO `formation` (`id_f`, `titre`, `duree`, `cout`, `date_debut`, `nb_place`, `contenu`, `id_a`, `id_p`) VALUES
(1, 'math', 50, 150, '2017-03-19', 50, 'ok', 1, 1),
(2, 'foot', 7, 7, '2017-03-07', 3, 'fd', 1, 1),
(3, 'tenis', 5, 500, '2017-03-21', 9, 'okoppm', 1, 1),
(4, 'hnd', 5, 500, '2017-03-21', 7, 'okoppm', 1, 1),
(5, 'kepo', 2, 200, '2017-03-21', 10, 'pll', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `formation_valide`
--

CREATE TABLE `formation_valide` (
  `id_v` int(11) NOT NULL,
  `id_f` int(11) NOT NULL,
  `id_s` int(11) NOT NULL,
  `etat_f` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en cours de validation'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `formation_valide`
--

INSERT INTO `formation_valide` (`id_v`, `id_f`, `id_s`, `etat_f`) VALUES
(1, 2, 1, 'valider'),
(2, 2, 1, 'valider'),
(3, 3, 1, 'refusé'),
(4, 4, 1, 'valider'),
(5, 5, 1, 'refusé'),
(6, 2, 1, 'valider'),
(7, 2, 2, 'refusé'),
(8, 3, 2, 'effectuée '),
(9, 4, 2, 'valider'),
(10, 5, 2, 'en cours de validation'),
(11, 5, 1, 'refusé'),
(12, 4, 1, 'valider'),
(13, 4, 1, 'valider'),
(14, 3, 1, 'refusé');

-- --------------------------------------------------------

--
-- Structure de la table `prestataire`
--

CREATE TABLE `prestataire` (
  `id_p` int(11) NOT NULL,
  `raison_social` varchar(255) NOT NULL,
  `id_a` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `prestataire`
--

INSERT INTO `prestataire` (`id_p`, `raison_social`, `id_a`) VALUES
(1, 'detre', 1);

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

CREATE TABLE `salarie` (
  `id_s` int(11) NOT NULL,
  `nom` varchar(11) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `identifiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(55) CHARACTER SET latin1 NOT NULL,
  `credit` int(255) NOT NULL,
  `nbs_jour` int(255) NOT NULL,
  `id_a` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `salarie`
--

INSERT INTO `salarie` (`id_s`, `nom`, `prenom`, `email`, `identifiant`, `mot_de_passe`, `status`, `credit`, `nbs_jour`, `id_a`) VALUES
(1, 'ibo', 'abra', 'ab@ra', 'black', '202cb962ac59075b964b07152d234b70', 'salarié', 3300, 3, 1),
(2, 'adm', 'adm', 'adm@adm', 'adm', '202cb962ac59075b964b07152d234b70', 'chef d’équipe', 3800, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_formation`
--

CREATE TABLE `type_formation` (
  `id_t` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id_a`);

--
-- Index pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD PRIMARY KEY (`id_c`),
  ADD KEY `id_s` (`id_s`),
  ADD KEY `id_f` (`id_f`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_f`),
  ADD KEY `id_a` (`id_a`),
  ADD KEY `id_p` (`id_p`);

--
-- Index pour la table `formation_valide`
--
ALTER TABLE `formation_valide`
  ADD PRIMARY KEY (`id_v`),
  ADD KEY `id_f` (`id_f`),
  ADD KEY `id_s` (`id_s`);

--
-- Index pour la table `prestataire`
--
ALTER TABLE `prestataire`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_a` (`id_a`);

--
-- Index pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD PRIMARY KEY (`id_s`),
  ADD KEY `id_a` (`id_a`);

--
-- Index pour la table `type_formation`
--
ALTER TABLE `type_formation`
  ADD PRIMARY KEY (`id_t`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `formation_valide`
--
ALTER TABLE `formation_valide`
  MODIFY `id_v` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `prestataire`
--
ALTER TABLE `prestataire`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `type_formation`
--
ALTER TABLE `type_formation`
  MODIFY `id_t` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`id_a`) REFERENCES `adresse` (`id_a`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `formation_valide`
--
ALTER TABLE `formation_valide`
  ADD CONSTRAINT `formation_valide_ibfk_1` FOREIGN KEY (`id_s`) REFERENCES `salarie` (`id_s`),
  ADD CONSTRAINT `formation_valide_ibfk_2` FOREIGN KEY (`id_f`) REFERENCES `formation` (`id_f`);

--
-- Contraintes pour la table `prestataire`
--
ALTER TABLE `prestataire`
  ADD CONSTRAINT `prestataire_ibfk_1` FOREIGN KEY (`id_a`) REFERENCES `adresse` (`id_a`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD CONSTRAINT `salarie_ibfk_1` FOREIGN KEY (`id_a`) REFERENCES `adresse` (`id_a`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
