-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: SB0134-WINWEB
-- Generation Time: Mar 10, 2020 at 02:05 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_categorie`, `categorie`, `actif`) VALUES
(2, 'Santé', 1),
(4, 'Langue', 1),
(5, 'Médications', 0),
(6, 'Transports', 1),
(7, 'Engagement', 1),
(8, 'Coordonnées', 1),
(9, 'Financement', 1),
(10, 'Après le voyage', 1),
(11, 'Vaccin', 1),
(12, 'Général', 1),
(13, 'Pendant le voyage', 1),
(16, 'Appréciation', 1);

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

--
-- Dumping data for table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `pseudo`, `mot_de_passe`, `type`, `actif`, `courriel`, `nom`, `prenom`, `date_naissance`, `telephone`, `id_programme`) VALUES
(1, 'admin1', '$2y$10$.R.tHhGC4adNB0rXJT5RCOTuvj9EIbrh.Y4XnHVwTJpjLY6Mpk7pe', 'admin', 1, 'robinsongabriel@gmail.com', 'Robinson', 'Gabriel', '2000-09-05', '418-326-8918', 1),
(11, 'acc1', '$2y$10$KbrR31ZXroYkDwk88JZa3.lhL9eGPzRAWhvnJXrnJohp8/7J0dfRS', 'prof', 1, 'accompagnateur1@gmail.com', 'Jacob', 'François', '1960-06-13', '418-326-9081', 1),
(12, 'etu1', '$2y$10$vOtuMFVC4r0BS/3nUim/9ubEJ02bS0sqWRInS/mXOIZZ1QMhTMIDq', 'etudiant', 1, 'marcgerard@hotmail.com', 'Gérard', 'Marc', '1983-04-09', '518-707-9812', 28);

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

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id_destination`, `nom_pays`, `actif`) VALUES
(3, 'Afghanistan', 0),
(4, 'Albanie', 1),
(5, 'Antarctique', 1),
(6, 'Algérie', 1),
(7, 'Samoa Américaines', 1),
(8, 'Andorre', 1),
(9, 'Angola', 1),
(10, 'Antigua-et-Barbuda', 1),
(11, 'Azerbaïdjan', 1),
(12, 'Argentine', 1),
(13, 'Australie', 1),
(14, 'Autriche', 1),
(15, 'Bahamas', 1),
(16, 'Bahreïn', 1),
(17, 'Bangladesh', 1),
(18, 'Arménie', 1),
(19, 'Barbade', 1),
(20, 'Belgique', 1),
(21, 'Bermudes', 1),
(22, 'Bhoutan', 1),
(23, 'Bolivie', 1),
(24, 'Bosnie-Herzégovine', 1),
(25, 'Botswana', 1),
(26, 'Île Bouvet', 1),
(27, 'Brésil', 1),
(28, 'Belize', 1),
(29, 'Île Bouvet', 1),
(30, 'Brésil', 1),
(31, 'Belize', 1),
(32, 'Territoire Britannique de Océan Indien', 1),
(33, 'Îles Salomon', 1),
(34, 'Îles Vierges Britanniques', 1),
(35, 'Brunéi Darussalam', 1),
(36, 'Bulgarie', 1),
(37, 'Myanmar', 1),
(38, 'Burundi', 1),
(39, 'Bélarus', 1),
(40, 'Cambodge', 1),
(41, 'Cameroun', 1),
(42, 'Canada', 1),
(43, 'Cap-vert', 1),
(44, 'Îles Caïmanes', 1),
(45, 'République Centrafricaine', 1),
(46, 'Sri Lanka', 1),
(47, 'Tchad', 1),
(48, 'Chili', 1),
(49, 'Chine', 1),
(50, 'Taïwan', 1),
(51, 'Île Christmas', 1),
(52, 'Îles Cocos (Keeling)', 1),
(53, 'Colombie', 1),
(54, 'Comores', 1),
(55, 'Mayotte', 1),
(56, 'République du Congo', 1),
(57, 'République Démocratique du Congo', 1),
(58, 'Îles Cook', 1),
(59, 'Costa Rica', 1),
(60, 'Croatie', 1),
(61, 'Cuba', 1),
(62, 'Chypre', 1),
(63, 'République Tchèque', 1),
(64, 'Bénin', 1),
(65, 'Danemark', 1),
(66, 'Dominique', 1),
(67, 'République Dominicaine', 1),
(68, 'Équateur', 1),
(69, 'El Salvador', 1),
(70, 'Guinée Équatoriale', 1),
(71, 'Éthiopie', 1),
(72, 'Érythrée', 1),
(73, 'Estonie', 1),
(74, 'Îles Féroé', 1),
(75, 'Îles (malvinas) Falkland', 1),
(76, 'Géorgie du Sud et les Îles Sandwich du Sud', 1),
(77, 'Fidji', 1),
(78, 'Finlande', 1),
(79, 'Îles Åland', 1),
(80, 'France', 1),
(81, 'Guyane Française', 1),
(82, 'Polynésie Française', 1),
(83, 'Terres Australes Françaises', 1),
(84, 'Djibouti', 1),
(85, 'Gabon', 1),
(86, 'Géorgie', 1),
(87, 'Gambie', 1),
(88, 'Territoire Palestinien Occupé', 1),
(89, 'Allemagne', 1),
(90, 'Ghana', 1),
(91, 'Gibraltar', 1),
(92, 'Kiribati', 1),
(93, 'Grèce', 1),
(94, 'Groenland', 1),
(95, 'Grenade', 1),
(96, 'Guadeloupe', 1),
(97, 'Guam', 1),
(98, 'Guatemala', 1),
(99, 'Guinée', 1),
(100, 'Guyana', 1),
(101, 'Haïti', 1),
(102, 'Îles Heard et Mcdonald', 1),
(103, 'Saint-Siège (état de la Cité du Vatican)', 1),
(104, 'Honduras', 1),
(105, 'Hong-Kong', 1),
(106, 'Hongrie', 1),
(107, 'Islande', 1),
(108, 'Inde', 1),
(109, 'Indonésie', 1),
(110, 'Jamaïque', 1),
(111, 'République Islamique d\'Iran', 1),
(112, 'Iraq', 1),
(113, 'Irlande', 1),
(114, 'Israël', 1),
(115, 'Italie', 1),
(116, 'Côte d\'Ivoire', 1),
(117, 'Jamaïque', 1),
(118, 'Japon', 1),
(119, 'Kazakhstan', 1),
(120, 'Jordanie', 1),
(121, 'Kenya', 1),
(122, 'République Populaire Démocratique de Corée', 1),
(123, 'République de Corée', 1),
(124, 'Koweït', 1),
(125, 'Kirghizistan', 1),
(126, 'République Démocratique Populaire Lao', 1),
(127, 'Liban', 1),
(128, 'Lesotho', 1),
(129, 'Lettonie', 1),
(130, 'Libéria', 1),
(131, 'Jamahiriya Arabe Libyenne', 1),
(132, 'Liechtenstein', 1),
(133, 'Lituanie', 1),
(134, 'Luxembourg', 1),
(135, 'Macao', 1),
(136, 'Madagascar', 1),
(137, 'Malawi', 1),
(138, 'Malaisie', 1),
(139, 'Maldives', 1),
(140, 'Mali', 1),
(141, 'Malte', 1),
(142, 'Martinique', 1),
(143, 'Mauritanie', 1),
(144, 'Maurice', 1),
(145, 'Mexique', 1),
(146, 'Monaco', 1),
(147, 'Mongolie', 1),
(148, 'République de Moldova', 1),
(149, 'Montserrat', 1),
(150, 'Maroc', 1),
(151, 'Mozambique', 1),
(152, 'Oman', 1),
(153, 'Namibie', 1),
(154, 'Nauru', 1),
(155, 'Népal', 1),
(156, 'Pays-Bas', 1),
(157, 'Antilles Néerlandaises', 1),
(158, 'Aruba', 1),
(159, 'Nouvelle-Calédonie', 1),
(160, 'Vanuatu', 1),
(161, 'Nouvelle-Zélande', 1),
(162, 'Nicaragua', 1),
(163, 'Niger', 1),
(164, 'Nigéria', 1),
(165, 'Niué', 1),
(166, 'Île Norfolk', 1),
(167, 'Norvège', 1),
(168, 'Îles Mariannes du Nord', 1),
(169, 'Îles Mineures Éloignées des États-Unis', 1),
(170, 'États Fédérés de Micronésie', 1),
(171, 'Îles Marshall', 1),
(172, 'Palaos', 1),
(173, 'Pakistan', 1),
(174, 'Panama', 1),
(175, 'Papouasie-Nouvelle-Guinée', 1),
(176, 'Paraguay', 1),
(177, 'Pérou', 1),
(178, 'Philippines', 1),
(179, 'Pitcairn', 1),
(180, 'Pologne', 1),
(181, 'Portugal', 1),
(182, 'Guinée-Bissau', 1),
(183, 'Timor-Leste', 1),
(184, 'Porto Rico', 1),
(185, 'Qatar', 1),
(186, 'Réunion', 1),
(187, 'Roumanie', 1),
(188, 'Fédération de Russie', 1),
(189, 'Rwanda', 1),
(190, 'Sainte-Hélène', 1),
(191, 'Saint-Kitts-et-Nevis', 1),
(192, 'Anguilla', 1),
(193, 'Sainte-Lucie', 1),
(194, 'Saint-Pierre-et-Miquelon', 1),
(195, 'Saint-Vincent-et-les Grenadines', 1),
(196, 'Saint-Marin', 1),
(197, 'Sao Tomé-et-Principe', 1),
(198, 'Arabie Saoudite', 1),
(199, 'Sénégal', 1),
(200, 'Seychelles', 1),
(201, 'Sierra Leone', 1),
(202, 'Singapour', 1),
(203, 'Slovaquie', 1),
(204, 'Viet Nam', 1),
(205, 'Slovénie', 1),
(206, 'Somalie', 1),
(207, 'Afrique du Sud', 1),
(208, 'Zimbabwe', 1),
(209, 'Espagne', 1),
(210, 'Sahara Occidental', 1),
(211, 'Soudan', 1),
(212, 'Suriname', 1),
(213, 'Svalbard etÎle Jan Mayen', 1),
(214, 'Swaziland', 1),
(215, 'Suède', 1),
(216, 'Suisse', 1),
(217, 'République Arabe Syrienne', 1),
(218, 'Tadjikistan', 1),
(219, 'Thaïlande', 1),
(220, 'Togo', 1),
(221, 'Tokelau', 1),
(222, 'Tonga', 1),
(223, 'Trinité-et-Tobago', 1),
(224, 'Émirats Arabes Unis', 1),
(225, 'Tunisie', 1),
(226, 'Turquie', 1),
(227, 'Turkménistan', 1),
(228, 'Îles Turks et Caïques', 1),
(229, 'Tuvalu', 1),
(230, 'Ouganda', 1),
(231, 'Ukraine', 1),
(233, 'Ex-République Yougoslave de Macédoine', 1),
(234, 'Égypte', 1),
(235, 'Royaume-Uni', 1),
(236, 'Île de Man', 1),
(237, 'République-Unie de Tanzanie', 1),
(238, 'États-Unis', 1),
(239, 'Îles Vierges des États-Unis', 1),
(240, 'Burkina Faso', 1),
(241, 'Uruguay', 1),
(242, 'Ouzbékistan', 1),
(243, 'Venezuela', 1),
(244, 'Wallis et Futuna', 1),
(245, 'Samoa', 1),
(246, 'Yémen', 1),
(247, 'Serbie-et-Monténégro', 1),
(248, 'Zambie', 1);

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

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id_programme`, `nom_programme`, `actif`) VALUES
(1, 'Personnel administratif', 1),
(15, 'Techniques de design d’intérieur', 1),
(16, 'Techniques de la documentation', 1),
(17, 'Techniques d’hygiène dentaire', 1),
(18, 'Techniques de diététique', 0),
(19, 'Techniques de soins infirmiers', 1),
(20, 'Techniques de travail social', 1),
(21, 'Techniques policières', 1),
(22, 'DEC-Bac en informatique', 1),
(23, 'Écodéveloppement et bioproduits', 1),
(24, 'Techniques de génie mécanique', 1),
(25, 'Techniques de l’informatique', 1),
(26, 'Techniques de procédés industriels', 1),
(27, 'Technologie de l’architecture', 1),
(28, 'Technologie de l’électronique', 1),
(29, 'Technologie de l’électronique industrielle', 1),
(30, 'DEC-Bac en logistique', 1),
(32, 'Technologie du génie civil', 1),
(33, 'Technologie du génie industriel', 1),
(35, 'Gestion de commerces', 1),
(36, 'Techniques de comptabilité et de gestion', 1),
(37, 'Techniques de la logistique du transport', 1),
(38, 'Tech. mécanique du bâtiment (Génie du bâtiment)', 1),
(39, 'Tech. mécanique industrielle (maintenance)', 1),
(40, 'Tech. génie métallurgique – Contrôle des matériaux', 1),
(41, 'Tech. génie métallurgique-Fabrication mécanosoudée', 1),
(42, 'Tech.génie métallurgique–Procédé de transformation', 1),
(43, 'Arts visuels', 1),
(44, 'Arts, lettres et communication', 1),
(45, 'Musique', 1),
(46, 'Histoire et civilisation', 1),
(47, 'Sciences de la nature', 1),
(48, 'Sciences humaines – Individu', 1),
(49, 'Sciences humaines – Monde', 1),
(50, 'Sciences informatiques et mathématiques', 1),
(51, 'Sciences, lettres et arts', 1),
(52, 'Sciences de la nature/Musique', 1),
(53, 'Sciences humaines/Arts visuels', 1),
(54, 'Sciences humaines/Musique', 1),
(55, 'Sciences humaines – Administration', 1),
(58, 'DEC-Bac en marketing', 1),
(59, 'DEC-Bac en sciences comptables', 1),
(60, 'Tremplin DEC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `propositions`
--

CREATE TABLE `propositions` (
  `id_proposition` int(11) NOT NULL,
  `id_compte` int(11) NOT NULL,
  `nom_projet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ville` varchar(255) NOT NULL,
  `date_depart` date NOT NULL,
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
  `date_depart` date NOT NULL,
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
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id_destination` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `formulaires`
--
ALTER TABLE `formulaires`
  MODIFY `id_formulaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id_programme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
