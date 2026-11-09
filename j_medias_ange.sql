-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 04 nov. 2026 à 11:51
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `j_medias`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `type_client` enum('Particulier','Entreprise','Eglise') DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `telephone`, `email`, `type_client`, `date_creation`) VALUES
(11, 'kouame', 'jean', '0700000008', NULL, 'Entreprise', '2026-11-04 10:48:10');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `libelle` enum('Mariage','Dote','Baptême','Anniversaire','Shooting','Eglise') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_evenement`, `libelle`) VALUES
(1, 'Mariage'),
(2, 'Dote'),
(3, 'Baptême'),
(4, 'Anniversaire'),
(5, 'Shooting'),
(6, 'Eglise');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(11) NOT NULL,
  `id_reservation` int(11) DEFAULT NULL,
  `numero_facture` varchar(40) DEFAULT NULL,
  `montant_total` decimal(10,2) DEFAULT NULL,
  `montant_payer` decimal(10,2) DEFAULT NULL,
  `reste` decimal(10,2) DEFAULT NULL,
  `statut_facture` enum('Non soldé','Soldé') DEFAULT NULL,
  `date_facture` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id_offre` int(11) NOT NULL,
  `libelle_offre` enum('Basic','Medium','Premium') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id_offre`, `libelle_offre`, `description`, `prix`) VALUES
(1, 'Basic', 'Photo ,vidéo ', 150000.00),
(2, 'Medium', 'Photo , video , streaming un parck speciale pour vour .', 300000.00),
(3, 'Premium', ' Photo, vidéo ,streaming ,drone uniquement pour vous .', 700000.00);

-- --------------------------------------------------------

--
-- Structure de la table `offre_prestation`
--

CREATE TABLE `offre_prestation` (
  `id_offre_prestation` int(11) NOT NULL,
  `id_offre` int(11) DEFAULT NULL,
  `id_prestation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `id_reservation` int(11) DEFAULT NULL,
  `montant_payer` decimal(10,2) DEFAULT NULL,
  `type_paiement` enum('Acompte 50%','Deuxième paiement 30%','Solde 20%') DEFAULT NULL,
  `mode_paiement` enum('Espèce','Wave','Orange Money','MTN Money','Moov Money','Virement') DEFAULT NULL,
  `date_paiement` date NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id_prestation` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_evenement` int(11) DEFAULT NULL,
  `id_offre` int(11) DEFAULT NULL,
  `numero_reservation` varchar(30) DEFAULT NULL,
  `date_reservation` date NOT NULL,
  `date_evenement` date DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `montant_total` decimal(10,2) DEFAULT NULL,
  `montant_payer` decimal(10,2) DEFAULT NULL,
  `reste_a_payer` decimal(10,2) DEFAULT NULL,
  `statut` enum('En attente','Confirmé','Paiement partiel','Soldé','Annulé') DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `etape_paiement` enum('En attente','Acompte 50% reçu','Acompte 30% reçu','Soldé','livré') DEFAULT NULL,
  `mode_paiement` enum('Espèce','Wave','Orange Money','MTN Money','Moov Money','Virement') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_client`, `id_evenement`, `id_offre`, `numero_reservation`, `date_reservation`, `date_evenement`, `lieu`, `montant_total`, `montant_payer`, `reste_a_payer`, `statut`, `date_creation`, `etape_paiement`, `mode_paiement`) VALUES
(1, 11, 3, 1, 'RES-20261104-0001', '2026-11-04', '2026-11-12', 'COCODY', 150000.00, 0.00, 150000.00, 'En attente', '2026-11-04 10:48:10', 'En attente', 'Wave');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` enum('Administrateur','Comptable','Responsable') DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `email`, `mot_de_passe`, `role`, `date_creation`) VALUES
(1, 'ange', 'ange@gmail.com', '1234', 'Administrateur', '2026-10-05 16:51:33');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id_offre`);

--
-- Index pour la table `offre_prestation`
--
ALTER TABLE `offre_prestation`
  ADD PRIMARY KEY (`id_offre_prestation`),
  ADD KEY `id_offre` (`id_offre`),
  ADD KEY `id_prestation` (`id_prestation`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `id_reservation` (`id_reservation`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id_prestation`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_evenement` (`id_evenement`),
  ADD KEY `id_offre` (`id_offre`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `offre_prestation`
--
ALTER TABLE `offre_prestation`
  MODIFY `id_offre_prestation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id_prestation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `offre_prestation`
--
ALTER TABLE `offre_prestation`
  ADD CONSTRAINT `offre_prestation_ibfk_1` FOREIGN KEY (`id_offre`) REFERENCES `offre` (`id_offre`),
  ADD CONSTRAINT `offre_prestation_ibfk_2` FOREIGN KEY (`id_prestation`) REFERENCES `prestation` (`id_prestation`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_evenement`) REFERENCES `evenement` (`id_evenement`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_offre`) REFERENCES `offre` (`id_offre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
