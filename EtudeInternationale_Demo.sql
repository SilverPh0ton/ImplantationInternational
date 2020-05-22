-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : SB0134-WINWEB
-- Généré le :  mar. 19 mai 2020 à 09:47
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `420626ri_equipe-2`
--

-- --------------------------------------------------------

--
-- Structure de la table `activations`
--

CREATE TABLE `activations` (
  `id_activation` int(11) NOT NULL,
  `code_activation` varchar(30) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `activations`
--

INSERT INTO `activations` (`id_activation`, `code_activation`, `id_voyage`, `actif`) VALUES
(1, ''C796-BC11-D83F'', 1, 0),
(2, ''364A-D513-F1A2'', 1, 0),
(19, ''BE9B-A161-FF87'', 1, 1),
(20, ''B699-AE01-ECAD'', 1, 1),
(21, ''6516-FAF6-4B54'', 1, 1),
(22, ''ECA1-FF6C-E61C'', 1, 1),
(23, ''5738-BF0F-C5AE'', 1, 1),
(24, ''609B-AAF7-F55E'', 1, 1),
(25, ''FCA2-E5C4-0C5E'', 1, 1),
(26, ''998F-34D6-9BAD'', 5, 1),
(27, ''4997-9783-1542'', 5, 1),
(28, ''219C-4D95-1E56'', 5, 0),
(29, ''D136-C7D8-DE43'', 6, 0),
(30, ''710C-A631-F275'', 11, 1),
(31, ''F767-95AD-4B60'', 11, 1),
(32, ''27EE-F20F-2BEB'', 11, 0),
(33, ''9D1A-7B01-19F2'', 11, 1),
(34, ''A790-F54D-A09A'', 11, 1),
(35, ''7C1D-C7CE-37D6'', 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id_activite` int(11) NOT NULL,
  `id_proposition` int(11) NOT NULL,
  `endroit` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id_activite`, `id_proposition`, `endroit`, `description`, `date_depart`, `date_retour`) VALUES
(103, 1, ''Mesaco'', ''Construction de maisons'', ''2020-08-11'', ''2020-08-11''),
(106, 31, ''Montagnes'', ''Escalades'', ''2021-03-10'', ''2021-03-10''),
(107, 32, ''act1'', ''desc1'', ''2020-03-10'', ''2020-03-10''),
(108, 33, ''acte'', ''desc'', ''2020-03-10'', ''2020-03-10''),
(109, 34, ''Vienne'', ''Retour'', ''2020-05-10'', ''2020-05-10''),
(110, 34, ''Montréal'', ''Départ'', ''2020-05-05'', ''2020-05-05''),
(111, 34, ''Vienne'', ''Visite'', ''2020-05-05'', ''2020-05-08''),
(112, 34, ''Vienne'', ''Opéra'', ''2020-05-04'', ''2020-05-04''),
(113, 34, ''Vienne'', ''Musée'', ''2020-05-05'', ''2020-05-05''),
(117, 35, ''aéroport'', ''attente'', ''2020-05-05'', ''2020-05-05''),
(118, 36, ''Reykjavik'', ''Retour'', ''2020-05-27'', ''2020-05-26''),
(119, 36, ''Montréal'', ''Départ'', ''2020-05-01'', ''2020-05-01''),
(120, 37, ''reykjavik'', ''retour'', ''2020-05-06'', ''2020-05-06''),
(121, 37, ''montréal'', ''départ'', ''2020-05-09'', ''2020-05-06'');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT ''1''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `categorie`, `actif`) VALUES
(2, ''Santé'', 1),
(4, ''Langue'', 1),
(5, ''Médications'', 0),
(6, ''Transports'', 1),
(7, ''Engagement'', 1),
(8, ''Coordonnées'', 1),
(9, ''Prévisions budgétaires'', 1),
(10, ''Après le voyage'', 1),
(11, ''Vaccin'', 1),
(12, ''Général'', 1),
(13, ''Pendant le voyage'', 1),
(16, ''Appréciation'', 1),
(17, ''Phobie'', 1),
(18, ''Description du projet'', 1),
(19, ''Présence du Cégep'', 1),
(20, ''Acceptation des projets'', 1),
(21, ''Recrutement des étudiants'', 1),
(22, ''Documentation complémentaire'', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id_compte` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT ''etudiant'',
  `actif` tinyint(1) NOT NULL DEFAULT ''1'',
  `courriel` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `id_programme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `pseudo`, `mot_de_passe`, `type`, `actif`, `courriel`, `nom`, `prenom`, `date_naissance`, `telephone`, `id_programme`) VALUES
(1, ''admin1'', ''$2y$10$.R.tHhGC4adNB0rXJT5RCOTuvj9EIbrh.Y4XnHVwTJpjLY6Mpk7pe'', ''admin'', 1, ''robinsongabriel@gmail.com'', ''Robinson'', ''Gabriel'', ''2000-09-05'', ''418-326-8918'', 1),
(11, ''acc1'', ''$2y$10$KbrR31ZXroYkDwk88JZa3.lhL9eGPzRAWhvnJXrnJohp8/7J0dfRS'', ''prof'', 1, ''accompagnateur1@gmail.com'', ''Jacob'', ''François'', ''1960-06-13'', ''418-326-9081'', 1),
(12, ''etu1'', ''$2y$10$vOtuMFVC4r0BS/3nUim/9ubEJ02bS0sqWRInS/mXOIZZ1QMhTMIDq'', ''etudiant'', 1, ''marcgerard@hotmail.com'', ''Gérard'', ''Marc'', ''1983-04-09'', ''518-707-9812'', 28),
(13, ''admin2'', ''$2y$10$sdoHwqDXZp2./FU6CywPROXNP4QTp4uOK6x0.ivyJC8MrEZ7129nS'', ''prof'', 1, ''admin@admin.com'', ''admin'', ''admin'', ''2019-03-10'', '''', 1),
(14, ''acc2'', ''$2y$10$3Ocb4JF/PnPA31r/egwNk.oE4T6vv/hJM3Z/aQGvE95IkdIEt6Jnq'', ''prof'', 1, ''acc@acc.com'', ''acc'', ''acc'', ''2019-03-10'', '''', 1),
(15, ''etu2'', ''$2y$10$knZMTRwVHdI3WFnU52gU1e8N367..E0kQpA6o1xOBaQ83tOL9xuiq'', ''etudiant'', 1, ''etu@gmail.com'', ''etu2'', ''etu2'', ''2019-03-10'', '''', 30),
(16, ''admin3'', ''$2y$10$cI4o06249AUBS9We6HKJfemC7qkF9.OhtpscK2Otul/egYI2/GzL.'', ''admin'', 1, ''julie.caron.royer@cegeptr.qc.ca'', ''Caron-Royer'', ''Julie'', ''2010-01-01'', '''', 1),
(17, ''acc3'', ''$2y$10$FE0CatOr4FFiOBleHQvlP.Z/mHNXP/b1wwlT7TeyIcZf1Qxx/NKp2'', ''prof'', 1, ''test@gmail.com'', ''Trudel'', ''Janie'', ''2019-04-24'', '''', 1),
(18, ''etu3'', ''$2y$10$D9oUKu1Cn0lbRaEBdvY1CuBV/iEFV1jolNeR/agxiFgO8F.wfiJBG'', ''etudiant'', 1, ''etu3@gmail.com'', ''Gaulin'', ''Joyce'', ''2019-04-24'', '''', 20),
(19, ''test'', ''$2y$10$Yp1LLcxBUGc0Qv8yo2NyOeg55TuvA7bmk7F7EnoQZAXGBiiQN8jCO'', ''etudiant'', 1, ''test@mail.com'', ''test'', ''test'', ''1999-03-08'', ''819-919-9999'', 1),
(20, ''test2'', ''$2y$10$DqONZ9BRtQUBsgorZ7i1dOh0E9DAH4EAe7O.gIYYQ0d96sdr1J29q'', ''etudiant'', 1, ''test2@mail.com'', ''test'', ''test'', ''1999-03-08'', ''819-919-9999'', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comptes_voyages`
--

CREATE TABLE `comptes_voyages` (
  `id_compte` int(11) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `date_paiement` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes_voyages`
--

INSERT INTO `comptes_voyages` (`id_compte`, `id_voyage`, `date_paiement`) VALUES
(1, 4, NULL),
(1, 7, NULL),
(1, 10, NULL),
(11, 1, NULL),
(11, 8, NULL),
(11, 9, NULL),
(12, 1, NULL),
(14, 5, NULL),
(14, 6, NULL),
(15, 5, NULL),
(15, 6, NULL),
(17, 11, NULL),
(18, 11, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `destinations`
--

CREATE TABLE `destinations` (
  `id_destination` int(11) NOT NULL,
  `nom_pays` varchar(50) NOT NULL,
  `actif` tinyint(4) NOT NULL DEFAULT ''1''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `destinations`
--

INSERT INTO `destinations` (`id_destination`, `nom_pays`, `actif`) VALUES
(3, ''Afghanistan'', 0),
(4, ''Albanie'', 1),
(5, ''Antarctique'', 1),
(6, ''Algérie'', 1),
(7, ''Samoa Américaines'', 1),
(8, ''Andorre'', 1),
(9, ''Angola'', 1),
(10, ''Antigua-et-Barbuda'', 1),
(11, ''Azerbaïdjan'', 1),
(12, ''Argentine'', 1),
(13, ''Australie'', 1),
(14, ''Autriche'', 1),
(15, ''Bahamas'', 1),
(16, ''Bahreïn'', 1),
(17, ''Bangladesh'', 1),
(18, ''Arménie'', 1),
(19, ''Barbade'', 1),
(20, ''Belgique'', 1),
(21, ''Bermudes'', 1),
(22, ''Bhoutan'', 1),
(23, ''Bolivie'', 1),
(24, ''Bosnie-Herzégovine'', 1),
(25, ''Botswana'', 1),
(26, ''Île Bouvet'', 1),
(27, ''Brésil'', 1),
(28, ''Belize'', 1),
(29, ''Île Bouvet'', 1),
(30, ''Brésil'', 1),
(31, ''Belize'', 1),
(32, ''Territoire Britannique de Océan Indien'', 1),
(33, ''Îles Salomon'', 1),
(34, ''Îles Vierges Britanniques'', 1),
(35, ''Brunéi Darussalam'', 1),
(36, ''Bulgarie'', 1),
(37, ''Myanmar'', 1),
(38, ''Burundi'', 1),
(39, ''Bélarus'', 1),
(40, ''Cambodge'', 1),
(41, ''Cameroun'', 1),
(42, ''Canada'', 1),
(43, ''Cap-vert'', 1),
(44, ''Îles Caïmanes'', 1),
(45, ''République Centrafricaine'', 1),
(46, ''Sri Lanka'', 1),
(47, ''Tchad'', 1),
(48, ''Chili'', 1),
(49, ''Chine'', 1),
(50, ''Taïwan'', 1),
(51, ''Île Christmas'', 1),
(52, ''Îles Cocos (Keeling)'', 1),
(53, ''Colombie'', 1),
(54, ''Comores'', 1),
(55, ''Mayotte'', 1),
(56, ''République du Congo'', 1),
(57, ''République Démocratique du Congo'', 1),
(58, ''Îles Cook'', 1),
(59, ''Costa Rica'', 1),
(60, ''Croatie'', 1),
(61, ''Cuba'', 1),
(62, ''Chypre'', 1),
(63, ''République Tchèque'', 1),
(64, ''Bénin'', 1),
(65, ''Danemark'', 1),
(66, ''Dominique'', 1),
(67, ''République Dominicaine'', 1),
(68, ''Équateur'', 1),
(69, ''El Salvador'', 1),
(70, ''Guinée Équatoriale'', 1),
(71, ''Éthiopie'', 1),
(72, ''Érythrée'', 1),
(73, ''Estonie'', 1),
(74, ''Îles Féroé'', 1),
(75, ''Îles (malvinas) Falkland'', 1),
(76, ''Géorgie du Sud et les Îles Sandwich du Sud'', 1),
(77, ''Fidji'', 1),
(78, ''Finlande'', 1),
(79, ''Îles Åland'', 1),
(80, ''France'', 1),
(81, ''Guyane Française'', 1),
(82, ''Polynésie Française'', 1),
(83, ''Terres Australes Françaises'', 1),
(84, ''Djibouti'', 1),
(85, ''Gabon'', 1),
(86, ''Géorgie'', 1),
(87, ''Gambie'', 1),
(88, ''Territoire Palestinien Occupé'', 1),
(89, ''Allemagne'', 1),
(90, ''Ghana'', 1),
(91, ''Gibraltar'', 1),
(92, ''Kiribati'', 1),
(93, ''Grèce'', 1),
(94, ''Groenland'', 1),
(95, ''Grenade'', 1),
(96, ''Guadeloupe'', 1),
(97, ''Guam'', 1),
(98, ''Guatemala'', 1),
(99, ''Guinée'', 1),
(100, ''Guyana'', 1),
(101, ''Haïti'', 1),
(102, ''Îles Heard et Mcdonald'', 1),
(103, ''Saint-Siège (état de la Cité du Vatican)'', 1),
(104, ''Honduras'', 1),
(105, ''Hong-Kong'', 1),
(106, ''Hongrie'', 1),
(107, ''Islande'', 1),
(108, ''Inde'', 1),
(109, ''Indonésie'', 1),
(110, ''Jamaïque'', 1),
(111, ''République Islamique d\''Iran'', 1),
(112, ''Iraq'', 1),
(113, ''Irlande'', 1),
(114, ''Israël'', 1),
(115, ''Italie'', 1),
(116, ''Côte d\''Ivoire'', 1),
(117, ''Jamaïque'', 1),
(118, ''Japon'', 1),
(119, ''Kazakhstan'', 1),
(120, ''Jordanie'', 1),
(121, ''Kenya'', 1),
(122, ''République Populaire Démocratique de Corée'', 1),
(123, ''République de Corée'', 1),
(124, ''Koweït'', 1),
(125, ''Kirghizistan'', 1),
(126, ''République Démocratique Populaire Lao'', 1),
(127, ''Liban'', 1),
(128, ''Lesotho'', 1),
(129, ''Lettonie'', 1),
(130, ''Libéria'', 1),
(131, ''Jamahiriya Arabe Libyenne'', 1),
(132, ''Liechtenstein'', 1),
(133, ''Lituanie'', 1),
(134, ''Luxembourg'', 1),
(135, ''Macao'', 1),
(136, ''Madagascar'', 1),
(137, ''Malawi'', 1),
(138, ''Malaisie'', 1),
(139, ''Maldives'', 1),
(140, ''Mali'', 1),
(141, ''Malte'', 1),
(142, ''Martinique'', 1),
(143, ''Mauritanie'', 1),
(144, ''Maurice'', 1),
(145, ''Mexique'', 1),
(146, ''Monaco'', 1),
(147, ''Mongolie'', 1),
(148, ''République de Moldova'', 1),
(149, ''Montserrat'', 1),
(150, ''Maroc'', 1),
(151, ''Mozambique'', 1),
(152, ''Oman'', 1),
(153, ''Namibie'', 1),
(154, ''Nauru'', 1),
(155, ''Népal'', 1),
(156, ''Pays-Bas'', 1),
(157, ''Antilles Néerlandaises'', 1),
(158, ''Aruba'', 1),
(159, ''Nouvelle-Calédonie'', 1),
(160, ''Vanuatu'', 1),
(161, ''Nouvelle-Zélande'', 1),
(162, ''Nicaragua'', 1),
(163, ''Niger'', 1),
(164, ''Nigéria'', 1),
(165, ''Niué'', 1),
(166, ''Île Norfolk'', 1),
(167, ''Norvège'', 1),
(168, ''Îles Mariannes du Nord'', 1),
(169, ''Îles Mineures Éloignées des États-Unis'', 1),
(170, ''États Fédérés de Micronésie'', 1),
(171, ''Îles Marshall'', 1),
(172, ''Palaos'', 1),
(173, ''Pakistan'', 1),
(174, ''Panama'', 1),
(175, ''Papouasie-Nouvelle-Guinée'', 1),
(176, ''Paraguay'', 1),
(177, ''Pérou'', 1),
(178, ''Philippines'', 1),
(179, ''Pitcairn'', 1),
(180, ''Pologne'', 1),
(181, ''Portugal'', 1),
(182, ''Guinée-Bissau'', 1),
(183, ''Timor-Leste'', 1),
(184, ''Porto Rico'', 1),
(185, ''Qatar'', 1),
(186, ''Réunion'', 1),
(187, ''Roumanie'', 1),
(188, ''Fédération de Russie'', 1),
(189, ''Rwanda'', 1),
(190, ''Sainte-Hélène'', 1),
(191, ''Saint-Kitts-et-Nevis'', 1),
(192, ''Anguilla'', 1),
(193, ''Sainte-Lucie'', 1),
(194, ''Saint-Pierre-et-Miquelon'', 1),
(195, ''Saint-Vincent-et-les Grenadines'', 1),
(196, ''Saint-Marin'', 1),
(197, ''Sao Tomé-et-Principe'', 1),
(198, ''Arabie Saoudite'', 1),
(199, ''Sénégal'', 1),
(200, ''Seychelles'', 1),
(201, ''Sierra Leone'', 1),
(202, ''Singapour'', 1),
(203, ''Slovaquie'', 1),
(204, ''Viet Nam'', 1),
(205, ''Slovénie'', 1),
(206, ''Somalie'', 1),
(207, ''Afrique du Sud'', 1),
(208, ''Zimbabwe'', 1),
(209, ''Espagne'', 1),
(210, ''Sahara Occidental'', 1),
(211, ''Soudan'', 1),
(212, ''Suriname'', 1),
(213, ''Svalbard etÎle Jan Mayen'', 1),
(214, ''Swaziland'', 1),
(215, ''Suède'', 1),
(216, ''Suisse'', 1),
(217, ''République Arabe Syrienne'', 1),
(218, ''Tadjikistan'', 1),
(219, ''Thaïlande'', 1),
(220, ''Togo'', 1),
(221, ''Tokelau'', 1),
(222, ''Tonga'', 1),
(223, ''Trinité-et-Tobago'', 1),
(224, ''Émirats Arabes Unis'', 1),
(225, ''Tunisie'', 1),
(226, ''Turquie'', 1),
(227, ''Turkménistan'', 1),
(228, ''Îles Turks et Caïques'', 1),
(229, ''Tuvalu'', 1),
(230, ''Ouganda'', 1),
(231, ''Ukraine'', 1),
(233, ''Ex-République Yougoslave de Macédoine'', 1),
(234, ''Égypte'', 1),
(235, ''Royaume-Uni'', 1),
(236, ''Île de Man'', 1),
(237, ''République-Unie de Tanzanie'', 1),
(238, ''États-Unis'', 1),
(239, ''Îles Vierges des États-Unis'', 1),
(240, ''Burkina Faso'', 1),
(241, ''Uruguay'', 1),
(242, ''Ouzbékistan'', 1),
(243, ''Venezuela'', 1),
(244, ''Wallis et Futuna'', 1),
(245, ''Samoa'', 1),
(246, ''Yémen'', 1),
(247, ''Serbie-et-Monténégro'', 1),
(248, ''Zambie'', 1);

-- --------------------------------------------------------

--
-- Structure de la table `formulaires`
--

CREATE TABLE `formulaires` (
  `id_formulaire` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_cat_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formulaires`
--

INSERT INTO `formulaires` (`id_formulaire`, `id_question`, `question_order`, `question_cat_order`) VALUES
(20, 5, 0, 2),
(20, 6, 0, 3),
(20, 12, 0, 4),
(20, 13, 1, 4),
(20, 14, 2, 4),
(20, 15, 0, 1),
(20, 16, 7, 1),
(20, 17, 8, 1),
(20, 18, 1, 1),
(20, 19, 0, 0),
(20, 20, 2, 1),
(20, 21, 3, 1),
(20, 22, 4, 1),
(20, 23, 5, 1),
(20, 24, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

CREATE TABLE `programmes` (
  `id_programme` int(11) NOT NULL,
  `nom_programme` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT ''1''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `programmes`
--

INSERT INTO `programmes` (`id_programme`, `nom_programme`, `actif`) VALUES
(1, ''Personnel administratif'', 1),
(15, ''Techniques de design d’intérieur'', 1),
(16, ''Techniques de la documentation'', 1),
(17, ''Techniques d’hygiène dentaire'', 1),
(18, ''Techniques de diététique'', 0),
(19, ''Techniques de soins infirmiers'', 1),
(20, ''Techniques de travail social'', 1),
(21, ''Techniques policières'', 1),
(22, ''DEC-Bac en informatique'', 1),
(23, ''Écodéveloppement et bioproduits'', 1),
(24, ''Techniques de génie mécanique'', 1),
(25, ''Techniques de l’informatique'', 1),
(26, ''Techniques de procédés industriels'', 1),
(27, ''Technologie de l’architecture'', 1),
(28, ''Technologie de l’électronique'', 1),
(29, ''Technologie de l’électronique industrielle'', 1),
(30, ''DEC-Bac en logistique'', 1),
(32, ''Technologie du génie civil'', 1),
(33, ''Technologie du génie industriel'', 1),
(35, ''Gestion de commerces'', 1),
(36, ''Techniques de comptabilité et de gestion'', 1),
(37, ''Techniques de la logistique du transport'', 1),
(38, ''Tech. mécanique du bâtiment (Génie du bâtiment)'', 1),
(39, ''Tech. mécanique industrielle (maintenance)'', 1),
(40, ''Tech. génie métallurgique – Contrôle des matériaux'', 1),
(41, ''Tech. génie métallurgique-Fabrication mécanosoudée'', 1),
(42, ''Tech.génie métallurgique–Procédé de transformation'', 1),
(43, ''Arts visuels'', 1),
(44, ''Arts, lettres et communication'', 1),
(45, ''Musique'', 1),
(46, ''Histoire et civilisation'', 1),
(47, ''Sciences de la nature'', 1),
(48, ''Sciences humaines – Individu'', 1),
(49, ''Sciences humaines – Monde'', 1),
(50, ''Sciences informatiques et mathématiques'', 1),
(51, ''Sciences, lettres et arts'', 1),
(52, ''Sciences de la nature/Musique'', 1),
(53, ''Sciences humaines/Arts visuels'', 1),
(54, ''Sciences humaines/Musique'', 1),
(55, ''Sciences humaines – Administration'', 1),
(58, ''DEC-Bac en marketing'', 1),
(59, ''DEC-Bac en sciences comptables'', 1),
(60, ''Tremplin DEC'', 1);

-- --------------------------------------------------------

--
-- Structure de la table `propositions`
--

CREATE TABLE `propositions` (
  `id_proposition` int(11) NOT NULL,
  `id_compte` int(11) NOT NULL,
  `nom_projet` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ville` varchar(255) NOT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT ''1'',
  `approuve` tinyint(1) NOT NULL DEFAULT ''0'',
  `msg_refus` mediumtext,
  `id_destination` int(11) NOT NULL,
  `note` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `propositions`
--

INSERT INTO `propositions` (`id_proposition`, `id_compte`, `nom_projet`, `ville`, `date_depart`, `date_retour`, `actif`, `approuve`, `msg_refus`, `id_destination`, `note`) VALUES
(1, 11, ''Aide Humanitaire'', ''Mogadishu'', ''2020-08-10'', ''2020-08-20'', 1, 2, ''Trop Dangereux'', 206, ''Aide humanitaire''),
(2, 11, ''Culinaire'', ''Paris'', ''2020-06-10'', ''2020-06-10'', 1, 2, NULL, 80, ''Grande École Culinaire de Paris''),
(31, 1, ''Voyage au Perou '', ''villeExemple'', ''2021-03-10'', ''2021-03-24'', 1, 2, ''qewbjqweqw'', 177, ''''),
(32, 14, ''Voyage 2021'', ''Berlin'', ''2021-04-11'', ''2021-04-28'', 1, 2, NULL, 89, ''Voyage de 2 semaines''),
(33, 14, ''Voyage2'', '''', ''2020-03-10'', ''2020-03-10'', 1, 2, NULL, 10, ''''),
(34, 1, ''Test Mai 2020'', ''Vienne'', ''2020-05-05'', ''2020-05-10'', 1, 1, ''je refuse '', 14, ''Je vais fournir plus d\''infos plus tard. Coût montant demandé au BI ?''),
(35, 1, ''test'', '''', ''2020-05-09'', ''2020-05-12'', 1, 2, NULL, 207, ''''),
(36, 17, ''Géo Islande Mai 2021'', ''Reykjavik'', ''2021-05-06'', ''2021-05-21'', 1, 1, ''test'', 107, ''''),
(37, 17, ''Géo Islande Mai 2021'', ''Reykjavik'', ''2021-05-06'', ''2021-05-14'', 1, 2, NULL, 107, ''''),
(38, 17, ''géo'', '''', ''2020-05-06'', ''2020-05-06'', 1, 1, ''test'', 207, ''''),
(39, 17, ''geo 2021'', '''', ''2020-05-06'', ''2020-05-06'', 1, 1, ''test'', 207, ''''),
(40, 11, ''geo 2021'', '''', ''2020-05-06'', ''2020-05-06'', 1, 1, ''test'', 207, '''');

-- --------------------------------------------------------

--
-- Structure de la table `propositions_reponses`
--

CREATE TABLE `propositions_reponses` (
  `id_proposition` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `propositions_reponses`
--

INSERT INTO `propositions_reponses` (`id_proposition`, `id_question`, `reponse`) VALUES
(31, 5, ''Decouverte''),
(31, 6, ''Divers engagements''),
(31, 8, ''le cegep''),
(31, 11, ''La fin''),
(32, 5, ''''),
(32, 6, ''Aucune engagements''),
(32, 8, ''''),
(32, 11, ''''),
(33, 5, ''''),
(33, 6, ''''),
(33, 8, ''''),
(33, 11, ''''),
(34, 5, ''TEST 4 ''),
(34, 12, ''test 1''),
(34, 13, ''test 2''),
(34, 14, ''test 3''),
(34, 15, ''34-15-CTR_Logo_RVB.jpg''),
(34, 16, ''''),
(34, 17, ''''),
(34, 18, ''''),
(34, 19, ''TEWST''),
(34, 20, ''34-20-Elaboration du budget 2020-2021 (002).xlsx''),
(34, 21, ''34-21-Elaboration du budget 2020-2021 (002).xlsx''),
(34, 23, ''''),
(34, 24, ''34-24-CTR_Logo_RVB.png''),
(35, 15, ''35-15-Courants_ERE_Sauv (1).pdf''),
(35, 19, ''test''),
(36, 15, ''36-15-CTR_Logo_RVB.jpg''),
(36, 18, ''Non''),
(36, 19, ''test''),
(37, 15, ''37-15-Elaboration du budget 2020-2021 (002).xlsx''),
(37, 18, ''Oui''),
(37, 19, ''ouin''),
(38, 15, ''38-15-GENDER AUDIT TOOL NC MCM GLOBAL 2019- SPANISH draft 2.docx''),
(38, 18, ''Oui''),
(38, 19, ''''),
(39, 19, ''''),
(40, 15, ''40-15-Elaboration du budget 2020-2021 (002).xlsx''),
(40, 18, ''Oui''),
(40, 19, '''');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id_question` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `question` mediumtext NOT NULL,
  `input_option` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `affichage` varchar(30) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT ''1'',
  `info_sup` mediumtext,
  `regroupement` tinyint(1) NOT NULL DEFAULT ''0''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_question`, `id_categorie`, `question`, `input_option`, `affichage`, `actif`, `info_sup`, `regroupement`) VALUES
(2, 6, ''Combien pensez-vous dépenser pour vos déplacement'', ''0;100;1'', ''Curseur'', 1, '''', 0),
(3, 22, ''Quel(s) vaccin(s) avez-vous?'', ''none'', ''ZoneTexte'', 0, ''Faire une courte liste'', 1),
(4, 22, ''Sur une note de 1 à 12. Comment avez-vous apprécié le voyage ?'', ''0;100;1'', ''Chiffre'', 1, ''Note 1 a 10'', 2),
(5, 19, ''Aucune libération ou remplacement ne sera accordée pour l’accompagnement du projet.  Si des cours sont prévus pendant la période du projet, décrivez comment vous comptez planifier votre absence. '', '''', ''ZoneTexte'', 1, ''Écrire un court texte'', 9),
(6, 7, ''Que sont vos engagement envers le projet?'', NULL, ''ZoneTexte'', 1, ''Faire un court texte'', 9),
(7, 13, ''Combien de personne serez-vous?'', NULL, ''Chiffre'', 1, '''', 2),
(8, 18, ''Quel sera la principale source de financement du voyage?'', '''', ''ZoneTexte'', 0, ''Faire une courte liste'', 9),
(9, 22, ''Coordonnées des lieux d\''hébergement'', '''', ''Fichier'', 1, '''', 1),
(11, 19, ''Quel est votre moment prefere'', '''', ''ZoneTexte'', 0, ''Aucune informations'', 9),
(12, 22, ''Décrivez brièvement le projet que vous désirez réaliser, le(s) partenaire(s) et leur(s) rôle(s), les objectifs, le contexte de réalisation et les intentions pédagogiques (cours, stages, ÉSP, etc.). '', '''', ''ZoneTexte'', 1, '''', 9),
(13, 18, ''Identifiez-vous des défis au niveau environnemental dans la préparation du séjour ou pendant sa réalisation ? Si oui, avez-vous des idées de mesures qui peuvent être appliquées ? '', NULL, ''ZoneTexte'', 1, '''', 9),
(14, 18, ''À quels étudiants s\''adresse ce projet ?'', NULL, ''ZoneTexte'', 1, ''Présenter les étudiants visés par le projet.'', 9),
(15, 22, ''Veuillez joindre le fichier Excel Élaboration du budget ici. N.B. Le Cégep ne rembourse pas les dépassements de coûts non prévus au budget accordé aux accompagnateurs (sauf pour le cas d’urgence médicale).'', '''', ''Fichier'', 1, '''', 9),
(16, 22, ''Dans le cas où le projet était appuyé, mais financé selon un pourcentage, faute de budget suffisant, envisagez-vous de faire tout de même le séjour ?'', ''Oui; Non'', ''Liste'', 1, '''', 9),
(17, 22, ''Dans le cas où le projet était appuyé, mais non financé, faute de budget suffisant, envisagez-vous de faire tout de même le séjour ?'', ''Oui; Non'', ''Liste'', 1, '''', 9),
(18, 22, ''À ce jour, avez-vous recruté les étudiants ?'', ''Oui; Non'', ''Liste'', 1, '''', 9),
(19, 21, ''Veuillez présenter vos stratégies de recrutement pour atteindre vos objectifs.'', NULL, ''ZoneTexte'', 1, '''', 9),
(20, 22, ''Veuillez joindre la résolution départementale pour les projets liés à un cours spécifique au sein d’un programme.'', NULL, ''Fichier'', 1, '''', 9),
(21, 22, ''Veuillez joindre la Résolution du comité programme pour les projets liés au programme ou pour les projets qui touchent l’épreuve synthèse de programme.'', NULL, ''Fichier'', 1, '''', 9),
(22, 22, ''Veuillez joindre la lettre de confirmation du responsable du service, si les accompagnateurs ne sont pas des enseignants.'', NULL, ''Fichier'', 1, '''', 9),
(23, 22, ''Veuillez télécharger ce fichier pour présenter votre budget provisoire. '', ''23-Elaboration du budget 2020-2021 (002).xlsx'', ''Telechargement'', 1, '''', 9),
(24, 22, ''Veuillez joindre dans un fichier les pièces justificatives de votre budget (prix des billets d\''avion, de l\''hébergement, du transport local, etc).'', NULL, ''Fichier'', 1, '''', 9),
(25, 8, ''Veuillez transmettre les coordonnées de deux personnes à joindre en cas d\''urgence (nom et # de téléphone)'', NULL, ''ZoneTexte'', 1, '''', 2),
(26, 7, ''De quelle façon comptes-tu t\''engager dans ce projet?'', NULL, ''ZoneTexte'', 1, '''', 0),
(27, 2, ''test'', NULL, ''Case'', 1, '''', 2),
(28, 2, ''test pour case à cocher'', NULL, ''Case'', 1, '''', 0),
(29, 22, ''médications à prendre '', '''', ''Case'', 1, '''', 9),
(30, 22, ''médications ? '', '''', ''Mention'', 1, '''', 9),
(31, 2, ''médications à prendre '', NULL, ''Mention'', 1, '''', 9),
(32, 22, ''quel est votre poids'', '''', ''Case'', 1, ''dfdf'', 1),
(33, 22, ''Wassup'', ''Steve;Hagrid;Harry'', ''Liste'', 1, ''Harry potter'', 0),
(34, 2, ''question test fabrice'', NULL, ''Liste'', 1, '''', 0);

-- --------------------------------------------------------

--
-- Structure de la table `valeurs`
--

CREATE TABLE `valeurs` (
  `id_compte` int(11) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `valeurs`
--

INSERT INTO `valeurs` (`id_compte`, `id_voyage`, `id_question`, `reponse`) VALUES
(12, 1, 2, ''30''),
(12, 1, 7, ''4''),
(14, 5, 7, ''11''),
(15, 5, 2, ''30''),
(15, 5, 4, ''5''),
(15, 5, 7, ''7''),
(17, 11, 7, ''11''),
(17, 11, 9, ''11-9-17-CTR_Logo_RVB.jpg''),
(17, 11, 25, ''1. john doe, 819-555-4444\r\n2. anna white, 819-555-2121''),
(17, 11, 27, ''on''),
(18, 11, 2, ''91''),
(18, 11, 7, ''7''),
(18, 11, 25, ''                                  1 2                          ''),
(18, 11, 26, ''                                               levée de fonds, publicité             ''),
(18, 11, 27, ''on'');

-- --------------------------------------------------------

--
-- Structure de la table `voyages`
--

CREATE TABLE `voyages` (
  `id_voyage` int(11) NOT NULL,
  `id_proposition` int(11) NOT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT ''1'',
  `approuvee` tinyint(1) NOT NULL DEFAULT ''0'',
  `id_destination` int(11) NOT NULL,
  `nom_projet` varchar(30) NOT NULL,
  `note` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `voyages`
--

INSERT INTO `voyages` (`id_voyage`, `id_proposition`, `ville`, `date_depart`, `date_retour`, `actif`, `approuvee`, `id_destination`, `nom_projet`, `note`) VALUES
(1, 2, ''Paris'', ''2020-05-10'', ''2020-06-10'', 0, 0, 80, ''Voyage Culinaire'', ''Grande École Culinaire de Paris''),
(4, 31, ''villeExemple'', ''2021-03-10'', ''2021-03-24'', 0, 1, 177, ''Voyage au Perou '', ''''),
(5, 32, ''Berlin'', ''2021-04-11'', ''2021-04-28'', 1, 0, 89, ''Voyage 2021'', ''Voyage de 2 semaines''),
(6, 33, '''', ''2020-03-10'', ''2020-03-10'', 1, 0, 10, ''Voyage2'', ''''),
(7, 35, '''', ''2020-05-09'', ''2020-05-12'', 1, 0, 207, ''test'', ''''),
(8, 1, ''Mogadishu'', ''2020-08-10'', ''2020-08-20'', 0, 0, 206, ''Aide Humanitaire'', ''Aide humanitaire''),
(9, 2, ''Paris'', ''2020-06-20'', ''2020-06-20'', 1, 0, 80, ''Culinaire'', ''Grande École Culinaire de Paris''),
(10, 35, '''', ''2020-05-09'', ''2020-05-12'', 1, 0, 207, ''test'', ''''),
(11, 37, ''Reykjavik'', ''2021-05-06'', ''2021-05-14'', 1, 0, 107, ''Géo Islande Mai 2021'', ''veuillez transmettre une copie de votre passeport avant le 4 novembre 2020'');

-- --------------------------------------------------------

--
-- Structure de la table `voyages_questions`
--

CREATE TABLE `voyages_questions` (
  `id_voyage` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `regroupement` tinyint(4) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_cat_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `voyages_questions`
--

INSERT INTO `voyages_questions` (`id_voyage`, `id_question`, `regroupement`, `question_order`, `question_cat_order`) VALUES
(1, 2, 0, 0, 2),
(1, 4, 0, 0, 1),
(1, 7, 0, 0, 0),
(1, 9, 1, 1, 0),
(5, 2, 0, 0, 1),
(5, 4, 0, 0, 0),
(5, 7, 1, 0, 0),
(5, 9, 1, 1, 0),
(11, 2, 0, 0, 0),
(11, 7, 0, 0, 1),
(11, 9, 1, 0, 1),
(11, 25, 0, 0, 2),
(11, 26, 0, 0, 3),
(11, 27, 0, 0, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id_activation`),
  ADD KEY `fk_id_voyage_for_activation` (`id_voyage`);

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id_activite`),
  ADD KEY `foreign_key_id_proposition` (`id_proposition`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `fk_id_programmes_for_comptes` (`id_programme`);

--
-- Index pour la table `comptes_voyages`
--
ALTER TABLE `comptes_voyages`
  ADD PRIMARY KEY (`id_compte`,`id_voyage`),
  ADD KEY `fk_id_voyage_for_comptes_voyage` (`id_voyage`);

--
-- Index pour la table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id_destination`);

--
-- Index pour la table `formulaires`
--
ALTER TABLE `formulaires`
  ADD PRIMARY KEY (`id_formulaire`,`id_question`);

--
-- Index pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id_programme`);

--
-- Index pour la table `propositions`
--
ALTER TABLE `propositions`
  ADD PRIMARY KEY (`id_proposition`),
  ADD KEY `fk_id_destination_for_propositon` (`id_destination`),
  ADD KEY `fk_proposition_id_compte` (`id_compte`);

--
-- Index pour la table `propositions_reponses`
--
ALTER TABLE `propositions_reponses`
  ADD PRIMARY KEY (`id_proposition`,`id_question`),
  ADD KEY `fk_propreponse_id_question` (`id_question`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `fk_id_categorie_for_questions` (`id_categorie`);

--
-- Index pour la table `valeurs`
--
ALTER TABLE `valeurs`
  ADD PRIMARY KEY (`id_compte`,`id_voyage`,`id_question`),
  ADD KEY `fk_id_voyage_for_valeurs` (`id_voyage`),
  ADD KEY `fk_id_question_for_valeurs` (`id_question`);

--
-- Index pour la table `voyages`
--
ALTER TABLE `voyages`
  ADD PRIMARY KEY (`id_voyage`),
  ADD KEY `fk_id_destination_for_voyages` (`id_destination`),
  ADD KEY `fk_id_proposition_for_proposition` (`id_proposition`);

--
-- Index pour la table `voyages_questions`
--
ALTER TABLE `voyages_questions`
  ADD PRIMARY KEY (`id_voyage`,`id_question`,`regroupement`),
  ADD KEY `fk_id_question_for_voyages_questions` (`id_question`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activations`
--
ALTER TABLE `activations`
  MODIFY `id_activation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id_destination` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT pour la table `formulaires`
--
ALTER TABLE `formulaires`
  MODIFY `id_formulaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id_programme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `propositions`
--
ALTER TABLE `propositions`
  MODIFY `id_proposition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `voyages`
--
ALTER TABLE `voyages`
  MODIFY `id_voyage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `fk_id_voyage_for_activation` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `foreign_key_id_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `fk_id_programmes_for_comptes` FOREIGN KEY (`id_programme`) REFERENCES `programmes` (`id_programme`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `comptes_voyages`
--
ALTER TABLE `comptes_voyages`
  ADD CONSTRAINT `fk_id_compte_for_comptes_voyage` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_voyage_for_comptes_voyage` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `propositions`
--
ALTER TABLE `propositions`
  ADD CONSTRAINT `fk_id_destination_for_propositon` FOREIGN KEY (`id_destination`) REFERENCES `destinations` (`id_destination`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_proposition_id_compte` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `propositions_reponses`
--
ALTER TABLE `propositions_reponses`
  ADD CONSTRAINT `fk_propreponse_id_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_propreponse_id_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_id_categorie_for_questions` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `valeurs`
--
ALTER TABLE `valeurs`
  ADD CONSTRAINT `fk_id_compte_for_valeurs` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_question_for_valeurs` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_voyage_for_valeurs` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `voyages`
--
ALTER TABLE `voyages`
  ADD CONSTRAINT `fk_id_destination_for_voyages` FOREIGN KEY (`id_destination`) REFERENCES `destinations` (`id_destination`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_proposition_for_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `voyages_questions`
--
ALTER TABLE `voyages_questions`
  ADD CONSTRAINT `fk_id_question_for_voyages_questions` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_voyage_for_voyages_questions` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
