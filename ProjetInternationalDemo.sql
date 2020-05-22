-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 22 mai 2020 à 18:12
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
-- Base de données :  `projetinternational`
--

-- --------------------------------------------------------

--
-- Structure de la table `activations`
--

DROP TABLE IF EXISTS `activations`;
CREATE TABLE IF NOT EXISTS `activations` (
  `id_activation` int(11) NOT NULL AUTO_INCREMENT,
  `code_activation` varchar(30) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_activation`),
  KEY `fk_id_voyage_for_activation` (`id_voyage`)
) ENGINE=InnoDB AUTO_INCREMENT=432 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `activations`
--

INSERT INTO `activations` (`id_activation`, `code_activation`, `id_voyage`, `actif`) VALUES
(1, 'C796-BC11-D83F', 1, 0),
(2, '364A-D513-F1A2', 1, 0),
(19, 'BE9B-A161-FF87', 1, 1),
(20, 'B699-AE01-ECAD', 1, 1),
(21, '6516-FAF6-4B54', 1, 1),
(22, 'ECA1-FF6C-E61C', 1, 1),
(23, '5738-BF0F-C5AE', 1, 1),
(24, '609B-AAF7-F55E', 1, 1),
(25, 'FCA2-E5C4-0C5E', 1, 1),
(26, '998F-34D6-9BAD', 5, 1),
(27, '4997-9783-1542', 5, 1),
(28, '219C-4D95-1E56', 5, 0),
(29, 'D136-C7D8-DE43', 6, 0),
(30, '710C-A631-F275', 11, 1),
(31, 'F767-95AD-4B60', 11, 1),
(32, '27EE-F20F-2BEB', 11, 0),
(33, '9D1A-7B01-19F2', 11, 1),
(34, 'A790-F54D-A09A', 11, 1),
(35, '595B-E2AB-72E4', 13, 0),
(36, '7F98-832C-B21C', 8, 1),
(37, 'A1CD-43BA-88CB', 8, 1),
(38, 'C68B-FD4D-77C5', 8, 1),
(39, '46C0-E55C-72F2', 8, 1),
(40, '8E87-DB3B-28B4', 8, 1),
(41, 'A7F8-A021-BA0B', 8, 1),
(42, 'FE73-D421-6872', 8, 1),
(43, '339C-A205-2F38', 8, 1),
(44, '77F7-CD66-74A0', 8, 1),
(45, '382E-25FA-4299', 8, 1),
(46, '6CE0-DAB8-F5A4', 8, 1),
(47, '3684-27DC-0FC3', 8, 1),
(48, '15E4-74E4-9835', 8, 1),
(49, '1BF2-B38E-3ACB', 8, 1),
(50, 'D7E0-92F9-AD0C', 8, 1),
(51, '74EC-5EBA-4B5E', 8, 1),
(52, '1594-85F6-E217', 8, 1),
(53, 'E3D9-BEE5-4A71', 8, 1),
(54, '3656-5F0F-25BD', 8, 1),
(55, 'DAC5-1B99-622D', 8, 1),
(56, '686B-04F0-F621', 8, 1),
(57, '91A7-5E9A-6569', 8, 1),
(58, '1580-32CB-6BB7', 8, 1),
(59, 'D406-2A44-F08D', 8, 1),
(60, 'BB2F-FDD8-AD52', 8, 1),
(61, '7117-3735-6842', 8, 1),
(62, '0EBD-3160-9671', 8, 1),
(63, 'E3AF-9796-2B95', 8, 1),
(64, '38C9-D068-3806', 8, 1),
(65, '784F-09E7-0725', 8, 1),
(66, '43EA-B632-8E2B', 8, 1),
(67, 'F410-7973-7B77', 8, 1),
(68, 'A2A4-55AA-E709', 8, 1),
(69, '19C8-E1CA-0721', 8, 1),
(70, '8FF3-770C-0FB2', 8, 1),
(71, 'C315-962E-0775', 8, 1),
(72, '7434-DC5C-4DE5', 8, 1),
(73, '4C20-7882-0957', 8, 1),
(74, '7648-3053-C88F', 8, 1),
(75, '8407-7E93-A4AC', 8, 1),
(76, 'ABE0-BB3F-103B', 8, 1),
(77, 'BCE0-C57A-BAD0', 8, 1),
(78, '8BF0-5EB6-DDEA', 8, 1),
(79, 'D911-3696-9E05', 8, 1),
(80, 'CA42-FB70-1B3E', 8, 1),
(81, '9E71-AA78-F1F8', 8, 1),
(82, '56C4-1A86-18B0', 8, 1),
(83, '1756-B50B-4662', 8, 1),
(84, '59F8-03BF-0425', 8, 1),
(85, 'EB5F-DD1C-9656', 8, 1),
(86, '444C-7758-3336', 8, 1),
(87, 'A59F-1BB7-38A0', 8, 1),
(88, 'F1B9-E342-239B', 8, 1),
(89, '0605-88FA-204F', 8, 1),
(90, '6ACD-469C-9B78', 8, 1),
(91, '80FE-3D2D-7AD1', 8, 1),
(92, '50EF-EC54-AD76', 8, 1),
(93, '179E-20DF-FE47', 8, 1),
(94, '4CA9-0A95-C8EE', 8, 1),
(95, '6A63-9A60-7AE2', 8, 1),
(96, '5813-0CF4-F328', 8, 1),
(97, '5A4D-7662-C207', 8, 1),
(98, 'E59B-53AC-D567', 8, 1),
(99, 'BDDF-066B-87DD', 8, 1),
(100, '862D-6DAA-42F1', 8, 1),
(101, '8105-9190-ABE0', 8, 1),
(102, '947B-570C-5F79', 8, 1),
(103, '85D8-6248-DE5F', 8, 1),
(104, '8892-403A-F766', 8, 1),
(105, 'DF57-07B2-82D2', 8, 1),
(106, '1D8C-A2B9-4EB7', 8, 1),
(107, '3641-C614-4EDA', 8, 1),
(108, 'C98D-59AB-2103', 8, 1),
(109, '0EDE-AD82-C948', 8, 1),
(110, 'DF01-8EF8-0926', 8, 1),
(111, 'F2AF-D4C2-45C3', 8, 1),
(112, '633F-B92C-07DC', 8, 1),
(113, 'C72C-B168-C4E3', 8, 1),
(114, '34F7-A83C-EBD4', 8, 1),
(115, '24D1-2942-E542', 8, 1),
(116, '4ADE-5441-73E7', 8, 1),
(117, '1F87-E8F2-646F', 8, 1),
(118, 'F547-6F1A-8A95', 8, 1),
(119, 'CC0E-84AB-E019', 8, 1),
(120, '5140-7E28-1161', 8, 1),
(121, 'CEE5-693A-793D', 8, 1),
(122, 'C010-3390-5967', 8, 1),
(123, 'DB7A-AD25-C9F5', 8, 1),
(124, '228F-0F5F-F951', 8, 1),
(125, '106A-4348-B0D5', 8, 1),
(126, '6E76-CEE6-BB17', 8, 1),
(127, '1F31-C2B9-C92A', 8, 1),
(128, '3D06-433D-AB30', 8, 1),
(129, '4F26-4233-3434', 8, 1),
(130, '9B90-E675-3A25', 8, 1),
(131, 'ECDC-A9DE-38F0', 8, 1),
(132, '818A-D037-024F', 8, 1),
(133, '2271-1752-62F3', 8, 1),
(134, '306D-51A4-8CA6', 8, 1),
(135, 'F3D8-0F27-C91E', 8, 1),
(136, 'A3B9-8118-AE36', 8, 1),
(137, '7998-3C85-CC2F', 8, 1),
(138, '50D7-E6B5-0227', 8, 1),
(139, '50EB-6A23-3039', 8, 1),
(140, '2AFB-7AA9-96E4', 8, 1),
(141, '159C-0C40-F005', 8, 1),
(142, '3D2E-98E1-36D7', 8, 1),
(143, '51E4-0294-AB95', 8, 1),
(144, 'F7E8-3BBF-DB8F', 8, 1),
(145, '37D7-EE2F-DC1A', 8, 1),
(146, 'B728-CCBD-64B3', 8, 1),
(147, 'AA69-D7A7-F97B', 8, 1),
(148, '2973-4A81-7DB9', 8, 1),
(149, '5797-79D7-E241', 8, 1),
(150, 'F856-8786-BB0E', 8, 1),
(151, '6106-2BF5-8019', 8, 1),
(152, '22FD-5682-1C22', 8, 1),
(153, 'E4D7-B5A2-EE22', 8, 1),
(154, '18CB-A211-DBC9', 8, 1),
(155, '4D62-BD36-BAFB', 8, 1),
(156, 'D92B-EBA1-9620', 8, 1),
(157, 'AE29-7AE5-90DD', 8, 1),
(158, 'F8C8-DCB3-4732', 8, 1),
(159, 'F8C3-FBD9-14E3', 8, 1),
(160, '6D94-848A-DFDF', 8, 1),
(161, 'EA83-6297-382E', 8, 1),
(162, 'C7FF-9250-6F1A', 8, 1),
(163, 'F33B-9AA2-FFD2', 8, 1),
(164, 'ABC1-5854-DE83', 8, 1),
(165, 'A0BF-5163-6843', 8, 1),
(166, 'FA84-E17B-E250', 8, 1),
(167, '1707-A873-BCD7', 8, 1),
(168, 'B90C-AB95-C4AA', 8, 1),
(169, '52A0-3853-D38C', 8, 1),
(170, '77A5-2FFB-2D33', 8, 1),
(171, 'FB63-0E14-8EB6', 8, 1),
(172, '3E8B-2A7B-CC3C', 8, 1),
(173, '5995-598E-E9AF', 8, 1),
(174, '7CD6-6B56-B41B', 8, 1),
(175, 'CCB6-7F50-0B9C', 8, 1),
(176, 'CA68-3999-96FE', 8, 1),
(177, 'E6D3-977F-585F', 8, 1),
(178, '6DEA-7232-1C39', 8, 1),
(179, 'D18B-60D9-2A37', 8, 1),
(180, '1115-8A82-9308', 8, 1),
(181, 'CDBE-087F-00A7', 8, 1),
(182, 'CE9E-2465-5990', 8, 1),
(183, '6DC4-6A25-7B3A', 8, 1),
(184, 'DDF1-8FE7-CFE4', 8, 1),
(185, '3CE5-A725-604C', 8, 1),
(186, 'E7EB-AFE7-9C5A', 8, 1),
(187, 'DA9A-4A17-D36D', 8, 1),
(188, '6A11-4B7E-3D6D', 8, 1),
(189, '709E-09F0-EE89', 8, 1),
(190, '31CB-DD9F-B618', 8, 1),
(191, 'F051-1814-6B86', 8, 1),
(192, '0A48-B401-C9B0', 8, 1),
(193, 'DD86-67F1-5C05', 8, 1),
(194, '501E-72A4-886D', 8, 1),
(195, 'A45A-815C-CDFB', 8, 1),
(196, '0CF9-1F5D-0C89', 8, 1),
(197, 'C5FE-4777-9297', 8, 1),
(198, 'C5C0-22FC-8F98', 8, 1),
(199, '63A1-0991-01D5', 8, 1),
(200, 'D320-181B-5789', 8, 1),
(201, '0022-97FA-0D27', 8, 1),
(202, '387F-9B17-8FD3', 8, 1),
(203, '298E-EE15-46EB', 8, 1),
(204, '0F6A-44EA-D2AC', 8, 1),
(205, '8607-46E6-A6C2', 8, 1),
(206, '5EE0-9B7C-D8E5', 8, 1),
(207, 'E3A0-3BB9-38A9', 8, 1),
(208, '3F8E-5E85-407F', 8, 1),
(209, '8526-3258-3C94', 8, 1),
(210, '6DBB-9351-6300', 8, 1),
(211, 'DE2F-8661-280E', 8, 1),
(212, 'C531-C70B-8436', 8, 1),
(213, '0A2A-2D7E-9DFB', 8, 1),
(214, '6BB8-C27E-B742', 8, 1),
(215, '62BD-9A94-1214', 8, 1),
(216, '8D0C-38BE-8AD9', 8, 1),
(217, 'B55F-870A-6967', 8, 1),
(218, '87DC-0AAB-7F26', 8, 1),
(219, 'C792-0AC6-8595', 8, 1),
(220, 'FB1B-01FD-DD10', 8, 1),
(221, '49C0-91E0-B8BD', 8, 1),
(222, '414F-3783-8A1E', 8, 1),
(223, '3172-6864-C093', 8, 1),
(224, '6A80-BE19-DDE6', 8, 1),
(225, 'E9C8-0853-50C8', 8, 1),
(226, '4406-6724-0FBA', 8, 1),
(227, '61AE-0A7E-B788', 8, 1),
(228, '9ED0-7EF0-A541', 8, 1),
(229, 'EE6B-D8F6-DA1D', 8, 1),
(230, '46B2-C728-497B', 8, 1),
(231, '914E-D6E2-31B2', 8, 1),
(232, '41E6-41C4-1E7B', 8, 1),
(233, '5ADF-F9D6-049B', 8, 1),
(234, '9100-3D4B-F0F7', 8, 1),
(235, '62AB-9E15-6FEA', 8, 1),
(236, 'FD0E-6624-F0E2', 8, 1),
(237, 'FC53-D7AA-14A8', 8, 1),
(238, 'D866-819E-9843', 8, 1),
(239, '91F6-CFC7-FA8E', 8, 1),
(240, '1EE8-1930-C616', 8, 1),
(241, '5911-99A7-1A66', 8, 1),
(242, '171E-980C-86AF', 8, 1),
(243, '567C-0A1B-A4FD', 8, 1),
(244, 'CE93-968A-47B9', 8, 1),
(245, 'DA4F-A021-BD6B', 8, 1),
(246, '45FF-1E2C-DC2A', 8, 1),
(247, '049D-B1F8-3704', 8, 1),
(248, '298C-9B11-7983', 8, 1),
(249, '627F-FE81-B4E8', 8, 1),
(250, 'C599-C38C-0B59', 8, 1),
(251, '70BC-9A64-4D1E', 8, 1),
(252, '51AD-5ECA-E1CA', 8, 1),
(253, '4EC9-61D2-8D00', 8, 1),
(254, 'B282-0109-FA8D', 8, 1),
(255, '2830-0C88-53C0', 8, 1),
(256, '1398-A112-50D0', 8, 1),
(257, '6B95-4D15-827B', 8, 1),
(258, '294D-FAE8-D222', 8, 1),
(259, 'F3CC-1FC5-93F0', 8, 1),
(260, '4910-A601-B568', 8, 1),
(261, 'B544-536B-4933', 8, 1),
(262, '0CB0-6357-F33C', 8, 1),
(263, '956A-8FCF-A4C0', 8, 1),
(264, 'C84C-C9D5-3D9D', 8, 1),
(265, '6319-13D2-5301', 8, 1),
(266, 'B376-2847-8DB7', 8, 1),
(267, 'B88D-A544-4DFC', 8, 1),
(268, 'F580-C60B-374D', 8, 1),
(269, '81B6-9C6E-956D', 8, 1),
(270, '8A5B-D957-6572', 8, 1),
(271, '7ECA-62A2-DE70', 8, 1),
(272, 'F481-78D2-74CC', 8, 1),
(273, '73B7-8CC7-DB5A', 8, 1),
(274, '327B-CF82-1740', 8, 1),
(275, '8857-04D2-6929', 8, 1),
(276, '55FD-27E6-187A', 8, 1),
(277, '0AD2-8849-1292', 8, 1),
(278, 'A297-C0DE-9F5C', 8, 1),
(279, '50AA-C040-CF69', 8, 1),
(280, 'D522-5AB5-3EFB', 8, 1),
(281, '405A-5C33-1864', 8, 1),
(282, '9476-4ED5-0D63', 8, 1),
(283, 'CD9F-610F-BA2A', 8, 1),
(284, '46D8-4714-7D4F', 8, 1),
(285, '1E47-6738-1D93', 8, 1),
(286, 'ABE1-78C4-62F2', 8, 1),
(287, '1C14-FF8B-4734', 8, 1),
(288, 'C20F-E67E-AD74', 8, 1),
(289, '67AC-9E8F-1C15', 8, 1),
(290, 'D5B6-F5CB-1EA9', 8, 1),
(291, 'D254-FB1C-9617', 8, 1),
(292, '9E43-1D50-2307', 8, 1),
(293, 'A229-FAE6-259E', 8, 1),
(294, '83A1-C462-8F24', 8, 1),
(295, 'F7F7-19FF-39C8', 8, 1),
(296, '593C-8849-3D85', 8, 1),
(297, '1005-7ABD-D8D7', 8, 1),
(298, '5320-148D-9ECA', 8, 1),
(299, 'F905-FAC9-8FC3', 8, 1),
(300, 'BED4-C606-CE04', 8, 1),
(301, '84E1-80C7-8C02', 8, 1),
(302, 'D1CC-B195-87A3', 8, 1),
(303, '2B54-03F4-E863', 8, 1),
(304, '5963-6C60-473C', 8, 1),
(305, '1E01-206F-18B7', 8, 1),
(306, 'C510-E61C-03AB', 8, 1),
(307, '562B-F532-F019', 8, 1),
(308, '9C13-6B68-1D1E', 8, 1),
(309, '0438-EA0D-60C1', 8, 1),
(310, '7DD6-47D0-ECBF', 8, 1),
(311, '5F95-DD2D-9893', 8, 1),
(312, 'C4DA-E9B5-686B', 8, 1),
(313, '0F7C-CCA1-27BF', 8, 1),
(314, 'DEB7-55C8-8967', 8, 1),
(315, 'F3AC-ABD1-BE45', 8, 1),
(316, '9F81-16F8-4A27', 8, 1),
(317, 'BA3A-BC45-1FEB', 8, 1),
(318, 'C51D-DF64-53DB', 8, 1),
(319, 'B7F6-96F4-91F9', 8, 1),
(320, '9235-64CD-820D', 8, 1),
(321, 'EDA3-E728-4F10', 8, 1),
(322, '7172-1A92-762B', 8, 1),
(323, 'CE19-D236-7E9C', 8, 1),
(324, 'A015-AF52-E8CE', 8, 1),
(325, '0DFB-7B5F-8B03', 8, 1),
(326, '16B6-B6B8-687C', 8, 1),
(327, '0406-24F7-FC29', 8, 1),
(328, 'CF9B-84B3-5738', 8, 1),
(329, 'B68C-F746-5C40', 8, 1),
(330, '14AC-C806-E033', 8, 1),
(331, 'D7F8-D93D-3716', 8, 1),
(332, '88E5-CA97-2F2A', 8, 1),
(333, 'A09C-5AC9-6F84', 8, 1),
(334, '6580-34AD-0E56', 8, 1),
(335, 'A1C8-CC23-C6CA', 8, 1),
(336, 'FEBE-62BB-577B', 8, 1),
(337, 'FEA9-C18E-914C', 8, 1),
(338, 'D49F-06FA-E1C2', 8, 1),
(339, 'BC85-0287-2F5E', 8, 1),
(340, '91CE-0A9F-F909', 8, 1),
(341, 'B48B-4B43-1914', 8, 1),
(342, 'DEAA-A3C6-A0A7', 8, 1),
(343, '87FC-BE53-9383', 8, 1),
(344, '125B-D8CF-76C3', 8, 1),
(345, 'DB45-6C16-F25A', 8, 1),
(346, '63BA-7B7F-B6E4', 8, 1),
(347, '8D72-D9D9-E6B2', 8, 1),
(348, 'E1E9-DD88-5507', 8, 1),
(349, '86AA-5154-5712', 8, 1),
(350, '6A26-3260-FE5D', 8, 1),
(351, 'C1AB-5785-B885', 8, 1),
(352, '439E-DDA8-6E2F', 8, 1),
(353, 'B0CE-4454-1A94', 8, 1),
(354, 'D56B-9859-E22E', 8, 1),
(355, 'B4B2-6751-6CF6', 8, 1),
(356, '6270-43E2-8FDF', 8, 1),
(357, '676E-4387-132B', 8, 1),
(358, '1A30-FCA7-43F6', 8, 1),
(359, 'ACAD-33EC-39F5', 8, 1),
(360, '9F8B-9048-4FB9', 8, 1),
(361, 'E41A-2851-7512', 8, 1),
(362, 'FF34-364B-61E8', 8, 1),
(363, '8FF3-10C2-8AA6', 8, 1),
(364, 'DC14-D957-CEA1', 8, 1),
(365, '85D0-218D-6D59', 8, 1),
(366, '399E-CF96-BE0C', 8, 1),
(367, '8831-5C61-94D3', 8, 1),
(368, '613F-7320-C5D8', 8, 1),
(369, '2E30-25DD-D0AE', 8, 1),
(370, '82A8-6C3A-EC7F', 8, 1),
(371, 'EC9B-A40A-1CB8', 8, 1),
(372, 'F1A0-116B-CDF9', 8, 1),
(373, 'EA43-C0C2-F6D8', 8, 1),
(374, 'AFF9-9618-FB79', 8, 1),
(375, '9A20-C07D-F13F', 8, 1),
(376, 'FA60-234A-C1DE', 8, 1),
(377, 'F870-62BB-3015', 8, 1),
(378, '6854-E0B2-C341', 8, 1),
(379, '4B7F-0F07-7753', 8, 1),
(380, '38CD-EDD2-81B1', 8, 1),
(381, '5F23-95CD-93F2', 8, 1),
(382, 'C45D-5FBE-51DC', 8, 1),
(383, 'B919-122F-8A5E', 8, 1),
(384, '5787-30F7-F69E', 8, 1),
(385, '7596-7490-BFD4', 8, 1),
(386, '4BC2-7CC4-550D', 8, 1),
(387, 'EBE4-D720-32E5', 8, 1),
(388, 'F956-B400-8A54', 8, 1),
(389, '88F1-0A22-4F41', 8, 1),
(390, 'B5C3-CD67-AEDE', 8, 1),
(391, '6E0E-7B85-E53E', 8, 1),
(392, 'D88A-D36E-B3C5', 8, 1),
(393, '6DB5-F622-4886', 8, 1),
(394, '5331-4D40-5915', 8, 1),
(395, '0716-909D-3155', 8, 1),
(396, 'B8FE-2F3D-4BD1', 8, 1),
(397, '8EB4-2E2B-5297', 8, 1),
(398, '4A90-1361-1EB2', 8, 1),
(399, 'DD94-C3EF-6DC3', 8, 1),
(400, '20B8-A5AB-ED38', 8, 1),
(401, 'BC10-4AC7-3BC9', 8, 1),
(402, '1800-DF3D-604B', 8, 1),
(403, '2B0F-8C3B-A6F5', 8, 1),
(404, '0970-16E1-A648', 8, 1),
(405, '7A86-5AFF-6E32', 8, 1),
(406, '845A-55E5-8A9C', 8, 1),
(407, '96AC-D426-3EA8', 8, 1),
(408, '74F4-8C75-5568', 8, 1),
(409, '9BD4-4F47-5192', 8, 1),
(410, '2B7A-EEF1-88A1', 8, 1),
(411, '64C3-06BA-2101', 8, 1),
(412, 'D361-9F71-7B69', 8, 1),
(413, '6267-DEE4-C5FF', 8, 1),
(414, 'DE55-7FFB-F871', 8, 1),
(415, 'B0C2-65B7-1072', 8, 1),
(416, '12EE-2EE1-5059', 8, 1),
(417, 'F9C7-2BA4-4BAC', 8, 1),
(418, 'D971-F55B-DB17', 8, 1),
(419, 'AC00-BAFE-FC03', 8, 1),
(420, '2E4B-CCC2-4AF2', 8, 1),
(421, '49DA-2259-6FCA', 8, 1),
(422, '530F-43C3-4161', 8, 1),
(423, '7956-5D1D-FD09', 8, 1),
(424, '07DA-0493-294D', 8, 1),
(425, '436B-947D-0368', 8, 1),
(426, 'ACB8-8AEA-A36C', 8, 1),
(427, '6B5B-E483-2218', 8, 1),
(428, 'A7D3-07F8-06F5', 8, 1),
(429, 'E233-B6DC-0321', 8, 1),
(430, '70D1-3637-53B2', 8, 1),
(431, '6F93-92A7-E3AD', 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `id_activite` int(11) NOT NULL AUTO_INCREMENT,
  `id_proposition` int(11) NOT NULL,
  `endroit` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL,
  PRIMARY KEY (`id_activite`),
  KEY `foreign_key_id_proposition` (`id_proposition`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id_activite`, `id_proposition`, `endroit`, `description`, `date_depart`, `date_retour`) VALUES
(103, 1, 'Mesaco', 'Construction de maisons', '2020-08-11', '2020-08-11'),
(106, 31, 'Montagnes', 'Escalades', '2021-03-10', '2021-03-10'),
(107, 32, 'act1', 'desc1', '2020-03-10', '2020-03-10'),
(108, 33, 'acte', 'desc', '2020-03-10', '2020-03-10'),
(109, 34, 'Vienne', 'Retour', '2020-05-10', '2020-05-10'),
(110, 34, 'Montréal', 'Départ', '2020-05-05', '2020-05-05'),
(111, 34, 'Vienne', 'Visite', '2020-05-05', '2020-05-08'),
(112, 34, 'Vienne', 'Opéra', '2020-05-04', '2020-05-04'),
(113, 34, 'Vienne', 'Musée', '2020-05-05', '2020-05-05'),
(117, 35, 'aéroport', 'attente', '2020-05-05', '2020-05-05'),
(118, 36, 'Reykjavik', 'Retour', '2020-05-27', '2020-05-26'),
(119, 36, 'Montréal', 'Départ', '2020-05-01', '2020-05-01'),
(120, 37, 'reykjavik', 'retour', '2020-05-06', '2020-05-06'),
(121, 37, 'montréal', 'départ', '2020-05-09', '2020-05-06');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `question_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `categorie`, `actif`, `question_default`) VALUES
(2, 'Santé', 1, NULL),
(4, 'Langue', 1, NULL),
(5, 'Médications', 0, NULL),
(6, 'Transports', 1, NULL),
(7, 'Engagement', 1, NULL),
(8, 'Coordonnées', 1, NULL),
(9, 'Prévisions budgétaires', 1, NULL),
(10, 'Après le voyage', 1, NULL),
(11, 'Vaccin', 1, NULL),
(12, 'Général', 1, NULL),
(13, 'Pendant le voyage', 1, NULL),
(16, 'Appréciation', 1, NULL),
(17, 'Phobie', 1, NULL),
(18, 'Description du projet', 1, NULL),
(19, 'Présence du Cégep', 1, NULL),
(20, 'Acceptation des projets', 1, NULL),
(21, 'Recrutement des étudiants', 1, NULL),
(22, 'Documentation complémentaire', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id_compte` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(30) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'etudiant',
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `courriel` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `id_programme` int(11) NOT NULL,
  `anonyme` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_compte`),
  KEY `fk_id_programmes_for_comptes` (`id_programme`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `pseudo`, `mot_de_passe`, `type`, `actif`, `courriel`, `nom`, `prenom`, `date_naissance`, `telephone`, `id_programme`, `anonyme`) VALUES
(1, 'admin1', '$2y$10$.R.tHhGC4adNB0rXJT5RCOTuvj9EIbrh.Y4XnHVwTJpjLY6Mpk7pe', 'admin', 1, 'robinsongabriel@gmail.com', 'Robinson', 'Gabriel', '2000-09-05', '418-326-8918', 1, 1),
(11, 'acc1', '$2y$10$KbrR31ZXroYkDwk88JZa3.lhL9eGPzRAWhvnJXrnJohp8/7J0dfRS', 'prof', 1, 'accompagnateur1@gmail.com', 'Jacob', 'François', '1960-06-13', '418-326-9081', 1, 1),
(12, 'etu1', '$2y$10$.UBXP4N91KOYVGvUYSo9muz0W.7QBA46u8d.VkCqm9yejjQdRO10i', 'etudiant', 1, 'marcgerard@hotmail.com', 'Gérard', 'Marc', '1983-04-09', '518-707-9812', 22, 1),
(13, 'admin2', '$2y$10$sdoHwqDXZp2./FU6CywPROXNP4QTp4uOK6x0.ivyJC8MrEZ7129nS', 'prof', 1, 'admin@admin.com', 'admin', 'admin', '2019-03-10', '', 1, 1),
(14, 'acc2', '$2y$10$gEpBzMU9OHrq3UfexL9DPedT7E7tCvnzaUbnso1JadX.FmFipc9Ci', 'prof', 1, 'sebastienpoulain@hotmail.ca', 'acc', 'acc', '2019-03-10', '', 1, 1),
(15, 'etu2', '$2y$10$knZMTRwVHdI3WFnU52gU1e8N367..E0kQpA6o1xOBaQ83tOL9xuiq', 'etudiant', 1, 'etu@gmail.com', 'etu2', 'etu2', '2019-03-10', '', 30, 1),
(16, 'admin3', '$2y$10$cI4o06249AUBS9We6HKJfemC7qkF9.OhtpscK2Otul/egYI2/GzL.', 'admin', 1, 'julie.caron.royer@cegeptr.qc.ca', 'Caron-Royer', 'Julie', '2010-01-01', '', 1, 1),
(17, 'acc3', '$2y$10$FE0CatOr4FFiOBleHQvlP.Z/mHNXP/b1wwlT7TeyIcZf1Qxx/NKp2', 'prof', 1, 'test@gmail.com', 'Trudel', 'Janie', '2019-04-24', '', 1, 1),
(18, 'etu3', '$2y$10$D9oUKu1Cn0lbRaEBdvY1CuBV/iEFV1jolNeR/agxiFgO8F.wfiJBG', 'etudiant', 1, 'etu3@gmail.com', 'Gaulin', 'Joyce', '2019-04-24', '', 20, 1),
(19, '', '$2y$10$1YxGiKVV8Yl9JnWJdgCIxeo8Fwd5SFachuFv6QCsjursnzVF79UE.', 'etudiant', 1, '', '', '', '2019-05-22', '', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comptes_voyages`
--

DROP TABLE IF EXISTS `comptes_voyages`;
CREATE TABLE IF NOT EXISTS `comptes_voyages` (
  `id_compte` int(11) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `date_paiement` date DEFAULT NULL,
  PRIMARY KEY (`id_compte`,`id_voyage`),
  KEY `fk_id_voyage_for_comptes_voyage` (`id_voyage`)
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
(11, 12, NULL),
(11, 13, NULL),
(12, 1, NULL),
(12, 13, NULL),
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

DROP TABLE IF EXISTS `destinations`;
CREATE TABLE IF NOT EXISTS `destinations` (
  `id_destination` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pays` varchar(50) NOT NULL,
  `actif` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_destination`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `destinations`
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
-- Structure de la table `formulaires`
--

DROP TABLE IF EXISTS `formulaires`;
CREATE TABLE IF NOT EXISTS `formulaires` (
  `id_formulaire` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_cat_order` int(11) NOT NULL,
  PRIMARY KEY (`id_formulaire`,`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formulaires`
--

INSERT INTO `formulaires` (`id_formulaire`, `id_question`, `question_order`, `question_cat_order`) VALUES
(22, 43, 0, 6);

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

DROP TABLE IF EXISTS `programmes`;
CREATE TABLE IF NOT EXISTS `programmes` (
  `id_programme` int(11) NOT NULL AUTO_INCREMENT,
  `nom_programme` varchar(50) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_programme`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `programmes`
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
-- Structure de la table `propositions`
--

DROP TABLE IF EXISTS `propositions`;
CREATE TABLE IF NOT EXISTS `propositions` (
  `id_proposition` int(11) NOT NULL AUTO_INCREMENT,
  `id_compte` int(11) NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `approuve` tinyint(1) NOT NULL DEFAULT '0',
  `msg_refus` mediumtext,
  `id_destination` int(11) NOT NULL,
  `note` mediumtext,
  PRIMARY KEY (`id_proposition`),
  KEY `fk_id_destination_for_propositon` (`id_destination`),
  KEY `fk_proposition_id_compte` (`id_compte`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `propositions`
--

INSERT INTO `propositions` (`id_proposition`, `id_compte`, `nom_projet`, `ville`, `date_depart`, `date_retour`, `actif`, `approuve`, `msg_refus`, `id_destination`, `note`) VALUES
(1, 11, 'Aide Humanitaire', 'Mogadishu', '2020-08-10', '2020-08-20', 1, 2, 'Trop Dangereux', 206, 'Aide humanitaire'),
(2, 11, 'Culinaire', 'Paris', '2020-06-10', '2020-06-10', 1, 2, NULL, 80, 'Grande École Culinaire de Paris'),
(31, 1, 'Voyage au Perou ', 'villeExemple', '2021-03-10', '2021-03-24', 1, 2, 'qewbjqweqw', 177, ''),
(32, 14, 'Voyage 2021', 'Berlin', '2021-04-11', '2021-04-28', 1, 2, NULL, 89, 'Voyage de 2 semaines'),
(33, 14, 'Voyage2', '', '2020-03-10', '2020-03-10', 1, 2, NULL, 10, ''),
(34, 1, 'Test Mai 2020', 'Vienne', '2020-05-05', '2020-05-10', 1, 1, 'je refuse ', 14, 'Je vais fournir plus d\'infos plus tard. Coût montant demandé au BI ?'),
(35, 1, 'test', '', '2020-05-09', '2020-05-12', 1, 2, NULL, 207, ''),
(36, 17, 'Géo Islande Mai 2021', 'Reykjavik', '2021-05-06', '2021-05-21', 1, 1, 'test', 107, ''),
(37, 17, 'Géo Islande Mai 2021', 'Reykjavik', '2021-05-06', '2021-05-14', 1, 2, NULL, 107, ''),
(38, 17, 'géo', '', '2020-05-06', '2020-05-06', 1, 1, 'test', 207, ''),
(39, 17, 'geo 2021', '', '2020-05-06', '2020-05-06', 1, 1, 'test', 207, ''),
(40, 11, 'geo 2021', '', '2020-05-06', '2020-05-06', 1, 1, 'test', 207, ''),
(41, 11, 'test', 'trois-rivieres', '2020-05-18', '2020-05-18', 1, 0, NULL, 4, 'sdf'),
(42, 11, 'test peur', 'tet', '2020-05-19', '2020-05-19', 1, 2, NULL, 207, 'dsf'),
(43, 11, 'testtestestetsetset', 'tset', '2020-05-19', '2020-05-19', 1, 0, NULL, 207, 'set'),
(44, 11, 'sdfsdf', 'sdfsdf', '2020-05-19', '2020-05-19', 1, 0, NULL, 207, 'sdf'),
(45, 11, 'sdfsdf', 'sdfsdf', '2020-05-19', '2020-05-19', 1, 0, NULL, 207, 'sdf'),
(46, 11, 'sdfsdf', 'sdfsdf', '2020-05-19', '2020-05-19', 1, 0, NULL, 6, 'sdfsd'),
(47, 11, 'patate', 'tr', '2020-05-19', '2020-05-19', 1, 0, NULL, 81, 'tr'),
(48, 11, 'sdfsdfsdfsd', 'sdfsdfsd', '2020-05-19', '2020-05-19', 1, 0, NULL, 207, 'sdfsdf'),
(49, 11, 'sushi', 'bogo', '2039-05-19', '2042-05-19', 1, 2, NULL, 96, 'bogo'),
(50, 11, 'assasa', 'sdfsdf', '2020-05-22', '2020-05-22', 1, 4, NULL, 207, 'sdf');

-- --------------------------------------------------------

--
-- Structure de la table `propositions_reponses`
--

DROP TABLE IF EXISTS `propositions_reponses`;
CREATE TABLE IF NOT EXISTS `propositions_reponses` (
  `id_proposition` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` mediumtext NOT NULL,
  PRIMARY KEY (`id_proposition`,`id_question`),
  KEY `fk_propreponse_id_question` (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `propositions_reponses`
--

INSERT INTO `propositions_reponses` (`id_proposition`, `id_question`, `reponse`) VALUES
(31, 5, 'Decouverte'),
(31, 6, 'Divers engagements'),
(31, 8, 'le cegep'),
(31, 11, 'La fin'),
(32, 5, ''),
(32, 6, 'Aucune engagements'),
(32, 8, ''),
(32, 11, ''),
(33, 5, ''),
(33, 6, ''),
(33, 8, ''),
(33, 11, ''),
(34, 5, 'TEST 4 '),
(34, 12, 'test 1'),
(34, 13, 'test 2'),
(34, 14, 'test 3'),
(34, 15, '34-15-CTR_Logo_RVB.jpg'),
(34, 16, ''),
(34, 17, ''),
(34, 18, ''),
(34, 19, 'TEWST'),
(34, 20, '34-20-Elaboration du budget 2020-2021 (002).xlsx'),
(34, 21, '34-21-Elaboration du budget 2020-2021 (002).xlsx'),
(34, 23, ''),
(34, 24, '34-24-CTR_Logo_RVB.png'),
(35, 15, '35-15-Courants_ERE_Sauv (1).pdf'),
(35, 19, 'test'),
(36, 15, '36-15-CTR_Logo_RVB.jpg'),
(36, 18, 'Non'),
(36, 19, 'test'),
(37, 15, '37-15-Elaboration du budget 2020-2021 (002).xlsx'),
(37, 18, 'Oui'),
(37, 19, 'ouin'),
(38, 15, '38-15-GENDER AUDIT TOOL NC MCM GLOBAL 2019- SPANISH draft 2.docx'),
(38, 18, 'Oui'),
(38, 19, ''),
(39, 19, ''),
(40, 15, '40-15-Elaboration du budget 2020-2021 (002).xlsx'),
(40, 18, 'Oui'),
(40, 19, ''),
(41, 19, ''),
(43, 43, 'true;false;false'),
(49, 43, 'true;false;true'),
(50, 43, 'false');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `question` mediumtext NOT NULL,
  `input_option` mediumtext,
  `affichage` varchar(30) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `info_sup` mediumtext,
  `regroupement` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_question`),
  KEY `fk_id_categorie_for_questions` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_question`, `id_categorie`, `question`, `input_option`, `affichage`, `actif`, `info_sup`, `regroupement`) VALUES
(2, 6, 'Combien pensez-vous dépenser pour vos déplacement', '0;100;1', 'Curseur', 1, '', 0),
(3, 16, 'Quel(s) vaccin(s) avez-vous?', 'none', 'ZoneTexte', 0, 'Faire une courte liste', 0),
(4, 19, 'Sur une note de 1 à 10. Comment avez-vous apprécié le voyage ?', '0;100;1', 'Chiffre', 0, 'Note 1 a 10', 0),
(5, 19, 'Aucune libération ou remplacement ne sera accordée pour l’accompagnement du projet.  Si des cours sont prévus pendant la période du projet, décrivez comment vous comptez planifier votre absence. ', '', 'ZoneTexte', 1, 'Écrire un court texte', 9),
(6, 7, 'Que sont vos engagement envers le projet?', NULL, 'ZoneTexte', 1, 'Faire un court texte', 9),
(7, 13, 'Combien de personne serez-vous?', NULL, 'Chiffre', 1, '', 2),
(8, 18, 'Quel sera la principale source de financement du voyage?', '', 'ZoneTexte', 0, 'Faire une courte liste', 9),
(9, 22, 'Coordonnées des lieux d\'hébergement', '', 'Fichier', 1, '', 1),
(11, 19, 'Quel est votre moment prefere', '', 'ZoneTexte', 0, 'Aucune informations', 9),
(12, 18, 'Décrivez brièvement le projet que vous désirez réaliser, le(s) partenaire(s) et leur(s) rôle(s), les objectifs, le contexte de réalisation et les intentions pédagogiques (cours, stages, ÉSP, etc.). ', NULL, 'ZoneTexte', 1, '', 9),
(13, 18, 'Identifiez-vous des défis au niveau environnemental dans la préparation du séjour ou pendant sa réalisation ? Si oui, avez-vous des idées de mesures qui peuvent être appliquées ? ', NULL, 'ZoneTexte', 1, '', 9),
(14, 18, 'À quels étudiants s\'adresse ce projet ?', NULL, 'ZoneTexte', 1, 'Présenter les étudiants visés par le projet.', 9),
(15, 22, 'Veuillez joindre le fichier Excel Élaboration du budget ici. N.B. Le Cégep ne rembourse pas les dépassements de coûts non prévus au budget accordé aux accompagnateurs (sauf pour le cas d’urgence médicale).', '', 'Fichier', 1, '', 9),
(16, 22, 'Dans le cas où le projet était appuyé, mais financé selon un pourcentage, faute de budget suffisant, envisagez-vous de faire tout de même le séjour ?', 'Oui; Non', 'Liste', 1, '', 9),
(17, 22, 'Dans le cas où le projet était appuyé, mais non financé, faute de budget suffisant, envisagez-vous de faire tout de même le séjour ?', 'Oui; Non', 'Liste', 1, '', 9),
(18, 22, 'À ce jour, avez-vous recruté les étudiants ?', 'Oui; Non', 'Liste', 1, '', 9),
(19, 21, 'Veuillez présenter vos stratégies de recrutement pour atteindre vos objectifs.', NULL, 'ZoneTexte', 1, '', 9),
(20, 22, 'Veuillez joindre la résolution départementale pour les projets liés à un cours spécifique au sein d’un programme.', NULL, 'Fichier', 1, '', 9),
(21, 22, 'Veuillez joindre la Résolution du comité programme pour les projets liés au programme ou pour les projets qui touchent l’épreuve synthèse de programme.', NULL, 'Fichier', 1, '', 9),
(22, 22, 'Veuillez joindre la lettre de confirmation du responsable du service, si les accompagnateurs ne sont pas des enseignants.', NULL, 'Fichier', 1, '', 9),
(23, 22, 'Veuillez télécharger ce fichier pour présenter votre budget provisoire. ', '23-Elaboration du budget 2020-2021 (002).xlsx', 'Telechargement', 1, '', 9),
(24, 22, 'Veuillez joindre dans un fichier les pièces justificatives de votre budget (prix des billets d\'avion, de l\'hébergement, du transport local, etc).', NULL, 'Fichier', 1, '', 9),
(25, 8, 'Veuillez transmettre les coordonnées de deux personnes à joindre en cas d\'urgence (nom et # de téléphone)', NULL, 'ZoneTexte', 1, '', 2),
(26, 7, 'De quelle façon comptes-tu t\'engager dans ce projet?', NULL, 'ZoneTexte', 1, '', 0),
(27, 2, 'test', NULL, 'Case', 1, '', 2),
(28, 2, 'test pour case à cocher', NULL, 'Case', 1, '', 0),
(29, 22, 'médications à prendre ', '', 'Case', 1, '', 9),
(30, 22, 'médications ? ', '', 'Mention', 1, '', 9),
(31, 2, 'médications à prendre ', NULL, 'Mention', 1, '', 9),
(32, 2, 'quel est votre poids', NULL, 'Case', 1, 'dfdf', 0),
(33, 2, 'Wassup', NULL, 'Liste', 1, 'Harry potter', 0),
(34, 11, 'type de vaccin', NULL, 'Liste', 1, '', 0),
(35, 2, 'grandeur', NULL, 'Liste', 1, '', 0),
(36, 6, 'type de transport', 'test;test2', 'Liste', 1, 'test', 0),
(37, 6, 'transport test', NULL, 'Liste', 1, 'test', 0),
(38, 17, 'peur', 'araignÃ©es;noir;mÃ¨re', 'Liste', 1, 'test', 0),
(39, 18, 'test', '', 'Mention', 1, 'test', 0),
(40, 17, 'peur de toi', 'salut;allo;ok', 'Case', 1, 'test', 0),
(41, 22, 'race des personnes', 'patate;bas;blanc', 'Case', 1, 'test', 0),
(42, 4, 'quelle est votre langue', 'italien;francais;anglais', 'Case', 1, 'test', 2),
(43, 17, 'peurs', 'moutons;loups;vaches', 'Case', 1, 'test', 9),
(44, 17, 'peur des poules', 'coq;poule;rat', 'Case', 1, 'poules', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` char(1) NOT NULL,
  `code_projet` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `valeurs`
--

DROP TABLE IF EXISTS `valeurs`;
CREATE TABLE IF NOT EXISTS `valeurs` (
  `id_compte` int(11) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse` mediumtext NOT NULL,
  PRIMARY KEY (`id_compte`,`id_voyage`,`id_question`),
  KEY `fk_id_voyage_for_valeurs` (`id_voyage`),
  KEY `fk_id_question_for_valeurs` (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `valeurs`
--

INSERT INTO `valeurs` (`id_compte`, `id_voyage`, `id_question`, `reponse`) VALUES
(12, 1, 2, '30'),
(12, 1, 7, '4'),
(12, 13, 38, 'mÃ¨re'),
(12, 13, 40, 'false;false;true;false;false;false'),
(12, 13, 44, 'false;false;true;true;false;false'),
(14, 5, 7, '11'),
(15, 5, 2, '30'),
(15, 5, 4, '5'),
(15, 5, 7, '7'),
(17, 11, 7, '11'),
(17, 11, 9, '11-9-17-CTR_Logo_RVB.jpg'),
(17, 11, 25, '1. john doe, 819-555-4444\r\n2. anna white, 819-555-2121'),
(17, 11, 27, 'on'),
(18, 11, 2, '91'),
(18, 11, 7, '7'),
(18, 11, 25, '                                  1 2                          '),
(18, 11, 26, '                                               levée de fonds, publicité             '),
(18, 11, 27, 'on');

-- --------------------------------------------------------

--
-- Structure de la table `voyages`
--

DROP TABLE IF EXISTS `voyages`;
CREATE TABLE IF NOT EXISTS `voyages` (
  `id_voyage` int(11) NOT NULL AUTO_INCREMENT,
  `id_proposition` int(11) NOT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `approuvee` tinyint(1) NOT NULL DEFAULT '0',
  `id_destination` int(11) NOT NULL,
  `nom_projet` varchar(30) NOT NULL,
  `note` mediumtext,
  PRIMARY KEY (`id_voyage`),
  KEY `fk_id_destination_for_voyages` (`id_destination`),
  KEY `fk_id_proposition_for_proposition` (`id_proposition`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `voyages`
--

INSERT INTO `voyages` (`id_voyage`, `id_proposition`, `ville`, `date_depart`, `date_retour`, `actif`, `approuvee`, `id_destination`, `nom_projet`, `note`) VALUES
(1, 2, 'Paris', '2020-05-10', '2020-06-10', 0, 0, 80, 'Voyage Culinaire', 'Grande École Culinaire de Paris'),
(4, 31, 'villeExemple', '2021-03-10', '2021-03-24', 0, 1, 177, 'Voyage au Perou ', ''),
(5, 32, 'Berlin', '2021-04-11', '2021-04-28', 1, 0, 89, 'Voyage 2021', 'Voyage de 2 semaines'),
(6, 33, '', '2020-03-10', '2020-03-10', 1, 0, 10, 'Voyage2', ''),
(7, 35, '', '2020-05-09', '2020-05-12', 1, 0, 207, 'test', ''),
(8, 1, 'Mogadishu', '2020-08-10', '2020-08-20', 0, 0, 206, 'Aide Humanitaire', 'Aide humanitaire'),
(9, 2, 'Paris', '2020-06-10', '2020-06-10', 1, 0, 80, 'Culinaire', 'Grande École Culinaire de Paris'),
(10, 35, '', '2020-05-09', '2020-05-12', 1, 0, 207, 'test', ''),
(11, 37, 'Reykjavik', '2021-05-06', '2021-05-14', 1, 0, 107, 'Géo Islande Mai 2021', 'veuillez transmettre une copie de votre passeport avant le 4 novembre 2020'),
(12, 42, 'tet', '2020-05-19', '2020-05-19', 1, 0, 207, 'test peur', 'dsf'),
(13, 49, 'bogo', '2039-05-19', '2042-05-19', 1, 0, 96, 'sushi', 'bogo');

-- --------------------------------------------------------

--
-- Structure de la table `voyages_questions`
--

DROP TABLE IF EXISTS `voyages_questions`;
CREATE TABLE IF NOT EXISTS `voyages_questions` (
  `id_voyage` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `regroupement` tinyint(4) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_cat_order` int(11) NOT NULL,
  PRIMARY KEY (`id_voyage`,`id_question`,`regroupement`),
  KEY `fk_id_question_for_voyages_questions` (`id_question`)
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
(11, 27, 0, 0, 4),
(13, 38, 0, 0, 6),
(13, 40, 0, 1, 6),
(13, 44, 0, 2, 6);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `fk_id_voyage_for_activation` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`);

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `foreign_key_id_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`);

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `fk_id_programmes_for_comptes` FOREIGN KEY (`id_programme`) REFERENCES `programmes` (`id_programme`);

--
-- Contraintes pour la table `comptes_voyages`
--
ALTER TABLE `comptes_voyages`
  ADD CONSTRAINT `fk_id_compte_for_comptes_voyage` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`),
  ADD CONSTRAINT `fk_id_voyage_for_comptes_voyage` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`);

--
-- Contraintes pour la table `propositions`
--
ALTER TABLE `propositions`
  ADD CONSTRAINT `fk_id_destination_for_propositon` FOREIGN KEY (`id_destination`) REFERENCES `destinations` (`id_destination`),
  ADD CONSTRAINT `fk_proposition_id_compte` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`);

--
-- Contraintes pour la table `propositions_reponses`
--
ALTER TABLE `propositions_reponses`
  ADD CONSTRAINT `fk_propreponse_id_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`),
  ADD CONSTRAINT `fk_propreponse_id_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_id_categorie_for_questions` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `valeurs`
--
ALTER TABLE `valeurs`
  ADD CONSTRAINT `fk_id_compte_for_valeurs` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`),
  ADD CONSTRAINT `fk_id_question_for_valeurs` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`),
  ADD CONSTRAINT `fk_id_voyage_for_valeurs` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`);

--
-- Contraintes pour la table `voyages`
--
ALTER TABLE `voyages`
  ADD CONSTRAINT `fk_id_destination_for_voyages` FOREIGN KEY (`id_destination`) REFERENCES `destinations` (`id_destination`),
  ADD CONSTRAINT `fk_id_proposition_for_proposition` FOREIGN KEY (`id_proposition`) REFERENCES `propositions` (`id_proposition`);

--
-- Contraintes pour la table `voyages_questions`
--
ALTER TABLE `voyages_questions`
  ADD CONSTRAINT `fk_id_question_for_voyages_questions` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`),
  ADD CONSTRAINT `fk_id_voyage_for_voyages_questions` FOREIGN KEY (`id_voyage`) REFERENCES `voyages` (`id_voyage`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
