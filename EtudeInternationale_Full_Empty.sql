-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: SB0134-WINWEB
-- Generation Time: Mar 09, 2020 at 08:12 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `420626ri_equipe-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id_activation` int(11) NOT NULL,
  `code_activation` varchar(30) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activites`
--

CREATE TABLE `activites` (
  `id_activite` int(11) NOT NULL,
  `id_proposition` int(11) NOT NULL,
  `endroit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comptes`
--

CREATE TABLE `comptes` (
  `id_compte` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'etudiant',
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `courriel` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `id_programme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comptes_voyages`
--

CREATE TABLE `comptes_voyages` (
  `id_compte` int(11) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `date_paiement` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id_destination` int(11) NOT NULL,
  `nom_pays` varchar(50) NOT NULL,
  `actif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formulaires`
--

CREATE TABLE `formulaires` (
  `id_formulaire` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_cat_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id_programme` int(11) NOT NULL,
  `nom_programme` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `propositions`
--

CREATE TABLE `propositions` (
  `id_proposition` int(11) NOT NULL,
  `id_compte` int(11) NOT NULL,
  `nom_projet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ville` varchar(255) NOT NULL,
  `cout` decimal(10,2) NOT NULL,
  `date_depart` date NOT NULL,
  `date_limite` date NOT NULL,
  `date_retour` date NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `approuve` tinyint(1) NOT NULL DEFAULT '0',
  `msg_refus` text,
  `id_destination` int(11) NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `propositions_reponses`
--

CREATE TABLE `propositions_reponses` (
  `id_proposition` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id_question` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `question` text NOT NULL,
  `input_option` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `affichage` varchar(30) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `info_sup` text,
  `regroupement` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `valeurs`
--

CREATE TABLE `valeurs` (
  `id_compte` int(11) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voyages`
--

CREATE TABLE `voyages` (
  `id_voyage` int(11) NOT NULL,
  `id_proposition` int(11) NOT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `cout` decimal(10,2) NOT NULL,
  `date_depart` date NOT NULL,
  `date_limite` date NOT NULL,
  `date_retour` date NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `approuvee` tinyint(1) NOT NULL DEFAULT '0',
  `id_destination` int(11) NOT NULL,
  `nom_projet` varchar(30) NOT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voyages_questions`
--

CREATE TABLE `voyages_questions` (
  `id_voyage` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `regroupement` tinyint(4) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_cat_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id_activation`),
  ADD KEY `fk_id_voyage_for_activation` (`id_voyage`);

--
-- Indexes for table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id_activite`),
  ADD KEY `foreign_key_id_proposition` (`id_proposition`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Indexes for table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `fk_id_programmes_for_comptes` (`id_programme`);

--
-- Indexes for table `comptes_voyages`
--
ALTER TABLE `comptes_voyages`
  ADD PRIMARY KEY (`id_compte`,`id_voyage`),
  ADD KEY `fk_id_voyage_for_comptes_voyage` (`id_voyage`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id_destination`);

--
-- Indexes for table `formulaires`
--
ALTER TABLE `formulaires`
  ADD PRIMARY KEY (`id_formulaire`,`id_question`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id_programme`);

--
-- Indexes for table `propositions`
--
ALTER TABLE `propositions`
  ADD PRIMARY KEY (`id_proposition`),
  ADD KEY `fk_id_destination_for_propositon` (`id_destination`),
  ADD KEY `fk_proposition_id_compte` (`id_compte`);

--
-- Indexes for table `propositions_reponses`
--
ALTER TABLE `propositions_reponses`
  ADD PRIMARY KEY (`id_proposition`,`id_question`),
  ADD KEY `fk_propreponse_id_question` (`id_question`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `fk_id_categorie_for_questions` (`id_categorie`);

--
-- Indexes for table `valeurs`
--
ALTER TABLE `valeurs`
  ADD PRIMARY KEY (`id_compte`,`id_voyage`,`id_question`),
  ADD KEY `fk_id_voyage_for_valeurs` (`id_voyage`),
  ADD KEY `fk_id_question_for_valeurs` (`id_question`);

--
-- Indexes for table `voyages`
--
ALTER TABLE `voyages`
  ADD PRIMARY KEY (`id_voyage`),
  ADD KEY `fk_id_destination_for_voyages` (`id_destination`),
  ADD KEY `fk_id_proposition_for_proposition` (`id_proposition`);

--
-- Indexes for table `voyages_questions`
--
ALTER TABLE `voyages_questions`
  ADD PRIMARY KEY (`id_voyage`,`id_question`,`regroupement`),
  ADD KEY `fk_id_question_for_voyages_questions` (`id_question`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id_activation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activites`
--
ALTER TABLE `activites`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id_destination` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formulaires`
--
ALTER TABLE `formulaires`
  MODIFY `id_formulaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id_programme` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propositions`
--
ALTER TABLE `propositions`
  MODIFY `id_proposition` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voyages`
--
ALTER TABLE `voyages`
  MODIFY `id_voyage` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `fk_id_voyage_for_activation` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `foreign_key_id_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `fk_id_programmes_for_comptes` FOREIGN KEY (`id_programme`) REFERENCES `programmes` (`id_programme`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comptes_voyages`
--
ALTER TABLE `comptes_voyages`
  ADD CONSTRAINT `fk_id_compte_for_comptes_voyage` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_voyage_for_comptes_voyage` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `propositions`
--
ALTER TABLE `propositions`
  ADD CONSTRAINT `fk_id_destination_for_propositon` FOREIGN KEY (`id_destination`) REFERENCES `destinations` (`id_destination`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_proposition_id_compte` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `propositions_reponses`
--
ALTER TABLE `propositions_reponses`
  ADD CONSTRAINT `fk_propreponse_id_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_propreponse_id_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_id_categorie_for_questions` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `valeurs`
--
ALTER TABLE `valeurs`
  ADD CONSTRAINT `fk_id_compte_for_valeurs` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_question_for_valeurs` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_voyage_for_valeurs` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `voyages`
--
ALTER TABLE `voyages`
  ADD CONSTRAINT `fk_id_destination_for_voyages` FOREIGN KEY (`id_destination`) REFERENCES `destinations` (`id_destination`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_proposition_for_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `voyages_questions`
--
ALTER TABLE `voyages_questions`
  ADD CONSTRAINT `fk_id_question_for_voyages_questions` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_voyage_for_voyages_questions` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
