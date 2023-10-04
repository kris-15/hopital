-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 03 oct. 2023 à 15:49
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hopital`
--

-- --------------------------------------------------------

--
-- Structure de la table `accouchements`
--

CREATE TABLE `accouchements` (
  `id` int(11) NOT NULL,
  `id_patiente` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `observation` varchar(255) NOT NULL,
  `date_accouchement` datetime NOT NULL DEFAULT current_timestamp(),
  `voie` enum('PAS DEFINI','VOIE BASSE','CESARIENNE') NOT NULL DEFAULT 'PAS DEFINI',
  `type` enum('EUTOCIQUE','DYSTOCIQUE','PAS DEFINI') NOT NULL DEFAULT 'PAS DEFINI',
  `test_vih` enum('POSITIF','NEGATIF','PAS DEFINI') NOT NULL DEFAULT 'PAS DEFINI',
  `enfant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `accouchements`
--

INSERT INTO `accouchements` (`id`, `id_patiente`, `id_medecin`, `observation`, `date_accouchement`, `voie`, `type`, `test_vih`, `enfant_id`) VALUES
(1, 1, 4, 'Observation', '2023-09-13 00:00:00', 'VOIE BASSE', 'EUTOCIQUE', 'POSITIF', 1),
(2, 1, 4, 'Observation', '2023-09-10 00:00:00', 'VOIE BASSE', 'EUTOCIQUE', 'POSITIF', 2),
(3, 1, 4, 'Observation', '2023-09-16 00:00:00', 'VOIE BASSE', 'EUTOCIQUE', 'POSITIF', 3);

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id` int(11) NOT NULL,
  `avenue` varchar(50) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `quartier` varchar(50) NOT NULL,
  `commune` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`id`, `avenue`, `numero`, `quartier`, `commune`, `patient_id`) VALUES
(1, 'Conseil', '15', 'Nganda', 'KINTAMBO', 1),
(2, 'Conseil', '15', 'Nganda', 'KINTAMBO', 2),
(3, 'Conseil', '15', 'Nganda', 'KINTAMBO', 3),
(4, 'Conseil', '15', 'Nganda', 'KINTAMBO', 4),
(5, 'Conseil', '15', 'Nganda', 'KINTAMBO', 5),
(10, 'Kumbu', '35 A', 'Kimia', 'NGABA', 10);

-- --------------------------------------------------------

--
-- Structure de la table `certificats`
--

CREATE TABLE `certificats` (
  `id` int(11) NOT NULL,
  `enfant_id` int(11) NOT NULL,
  `date_delivre` datetime DEFAULT current_timestamp(),
  `medecin_id` int(11) NOT NULL,
  `statut` enum('DISPONIBLE','TELECHARGER') DEFAULT 'DISPONIBLE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `medecin_id` int(11) NOT NULL,
  `poids_patiente` int(11) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `tension` varchar(10) NOT NULL,
  `observation` varchar(500) NOT NULL,
  `date_consultation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consultations`
--

INSERT INTO `consultations` (`id`, `patient_id`, `medecin_id`, `poids_patiente`, `temperature`, `tension`, `observation`, `date_consultation`) VALUES
(1, 4, 4, 69, '37', '120', 'La petite observation', '2023-09-19 10:14:09'),
(2, 4, 4, 70, '37', '120', 'La deuxième observation', '2023-09-19 10:24:09'),
(3, 4, 4, 67, '38', '127', 'La troisième observation', '2023-09-19 10:26:24'),
(4, 4, 4, 67, '38', '127', 'La troisième observation', '2023-09-19 10:27:04'),
(5, 4, 4, 60, '37', '125', 'La quatrième observation', '2023-09-19 10:29:16'),
(6, 4, 4, 60, '37', '125', 'La quatrième observation', '2023-09-19 10:33:52');

-- --------------------------------------------------------

--
-- Structure de la table `enfants`
--

CREATE TABLE `enfants` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `sexe` enum('PAS DEFINI','MASCULIN','FEMININ') DEFAULT 'PAS DEFINI',
  `poids` int(11) NOT NULL,
  `date_naissance` date NOT NULL,
  `taille` varchar(50) DEFAULT NULL,
  `apgar` varchar(50) DEFAULT NULL,
  `pc` varchar(50) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `medecin_id` int(11) NOT NULL,
  `etat` enum('VIVANT','MORT') NOT NULL DEFAULT 'VIVANT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enfants`
--

INSERT INTO `enfants` (`id`, `nom`, `sexe`, `poids`, `date_naissance`, `taille`, `apgar`, `pc`, `observation`, `parent_id`, `medecin_id`, `etat`) VALUES
(1, 'Papap', 'MASCULIN', 3020, '2023-09-13', '60', '09', '3', 'Deuxième observation', 1, 4, 'VIVANT'),
(2, 'Papap', 'MASCULIN', 3020, '2023-09-10', '60', '09', '3', 'Deuxième observation', 1, 4, 'VIVANT'),
(3, 'Papap', 'MASCULIN', 3020, '2023-09-16', '60', '09', '3', 'Deuxième observation', 1, 4, 'VIVANT');

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

CREATE TABLE `medecins` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `code` varchar(10) NOT NULL,
  `statut_compte` enum('ACTIVE','DESACTIVE','EN ATTENTE') DEFAULT 'EN ATTENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medecins`
--

INSERT INTO `medecins` (`id`, `nom`, `username`, `mot_de_passe`, `telephone`, `code`, `statut_compte`) VALUES
(1, 'Kuzanuka', 'kuz', '$2y$10$Vt1iXcvzS3P7tOCJ815pme1MTFE9qUFhwpyST/0uU61Wctobs9w7G', '827387041', '7CCEE1', 'ACTIVE'),
(4, 'Ketsia', 'keke', '$2y$10$MAAML16widoE9oQ0jZVmSO7ri3OzIjhNfIDIhz05uC4dYvIE5vJQa', '827387041', 'E0280C', 'ACTIVE'),
(5, 'Lipekene', 'ketsia', '$2y$10$JLPgnoPpKZHNzRTwlmU.LOCv/xkxCucjOazQS08RMjFdwpPFXK/iy', '+243827387041', '7B04F4', 'ACTIVE'),
(6, 'Lipekene', 'like', '$2y$10$tEdBc8ipEkPKY1.lIwldMuMMXYieUah0CcbUy0WdDYflKrjsovAsC', '+243827387041', 'DDEF2D', 'ACTIVE');

-- --------------------------------------------------------

--
-- Structure de la table `patientes`
--

CREATE TABLE `patientes` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `code` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL,
  `epoux` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patientes`
--

INSERT INTO `patientes` (`id`, `nom`, `prenom`, `telephone`, `code`, `date_naissance`, `epoux`) VALUES
(1, 'Lipekene', 'ketsia', '0827387041', '80CD83', '2000-07-12', 'Kunga'),
(2, 'Mbondo', 'Adeline', '0827387041', 'D946AB', '2000-07-12', 'Lipekene'),
(3, 'Abolia', 'Rachel', '0827387041', 'B17FA3', '2000-07-12', 'Trésor'),
(4, 'Massombo', 'Victorine', '0827387041', '379DE8', '2000-07-12', 'Victorin'),
(5, 'Libula', 'Synia', '0827387041', '86C5B6', '2000-07-12', 'Stephane'),
(10, 'Tshibuabua', 'Aimerance', '0999996666', '3C8830', '2000-08-10', 'Patrick');

-- --------------------------------------------------------

--
-- Structure de la table `receptionnistes`
--

CREATE TABLE `receptionnistes` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accouchements`
--
ALTER TABLE `accouchements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_patiente` (`id_patiente`),
  ADD KEY `id_medecin` (`id_medecin`),
  ADD KEY `enfant_id` (`enfant_id`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_id` (`patient_id`);

--
-- Index pour la table `certificats`
--
ALTER TABLE `certificats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medecin_id` (`medecin_id`),
  ADD KEY `enfant_id` (`enfant_id`);

--
-- Index pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `medecin_id` (`medecin_id`);

--
-- Index pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medecin_id` (`medecin_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Index pour la table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `patientes`
--
ALTER TABLE `patientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Index pour la table `receptionnistes`
--
ALTER TABLE `receptionnistes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accouchements`
--
ALTER TABLE `accouchements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `certificats`
--
ALTER TABLE `certificats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `enfants`
--
ALTER TABLE `enfants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `medecins`
--
ALTER TABLE `medecins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `patientes`
--
ALTER TABLE `patientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `receptionnistes`
--
ALTER TABLE `receptionnistes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accouchements`
--
ALTER TABLE `accouchements`
  ADD CONSTRAINT `accouchements_ibfk_1` FOREIGN KEY (`id_patiente`) REFERENCES `patientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accouchements_ibfk_2` FOREIGN KEY (`id_medecin`) REFERENCES `medecins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accouchements_ibfk_3` FOREIGN KEY (`enfant_id`) REFERENCES `enfants` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adresses_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patientes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `certificats`
--
ALTER TABLE `certificats`
  ADD CONSTRAINT `certificats_ibfk_1` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificats_ibfk_2` FOREIGN KEY (`enfant_id`) REFERENCES `enfants` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consultations_ibfk_2` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD CONSTRAINT `enfants_ibfk_1` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enfants_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `patientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
