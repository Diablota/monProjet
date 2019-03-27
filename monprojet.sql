-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 27 mars 2019 à 09:21
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `monprojet`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id` int(11) NOT NULL,
  `adresse_livraison` varchar(100) COLLATE utf8_bin NOT NULL,
  `cp_livraison` varchar(10) COLLATE utf8_bin NOT NULL,
  `ville_livraison` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `adresse_livraison`, `cp_livraison`, `ville_livraison`) VALUES
(1, 'rue du bec ', '54022', 'villers les nancy'),
(2, 'rue hache ', '54000', 'nancy'),
(3, 'rue de nimp', '55555', 'villenimp'),
(4, 'test8@live.fr', '55555', 'test8@live.fr'),
(5, 'test8@live.fr', '55555', 'test8@live.fr'),
(6, 'test8@live.fr', '55555', 'test8@live.fr'),
(7, 'test8@live.fr', '55555', 'test8@live.fr'),
(8, 'test8@live.fr', '55555', 'test8@live.fr'),
(9, 'test8@live.fr', '55555', 'test8@live.fr'),
(10, 'testdddd@live.fr', '55555', 'testdddd@live.fr'),
(11, 'rue du test 9', '56780', 'test9'),
(12, 'rue de la livraison 10', '10000', 'test10'),
(13, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(14, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(15, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(16, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(17, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(18, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(19, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(20, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(21, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(22, 'rue du test 11 L', '11111', 'ttttttt'),
(23, 'test12', '11111', 'CERFEG');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `libelle` varchar(25) COLLATE utf8_bin NOT NULL,
  `description` varchar(200) COLLATE utf8_bin NOT NULL,
  `prix` float NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  `image_src` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `libelle`, `description`, `prix`, `id_sous_categorie`, `image_src`) VALUES
(1, 'Boutons Pirate', 'Superbe boutons pirate qui plairont à vos enfants pour personnaliser leurs habits.', 1.5, 2, 'boutonsPirate'),
(2, 'Boutons Retro', 'Boutons retro', 2, 2, 'boutonsRetro'),
(3, 'Boutons Smiley', '', 2.5, 2, 'boutonsSmiley'),
(4, 'Robes Drap', 'Robes Drap', 259.99, 3, 'robesDrap'),
(5, 'Robes Courte', 'Robes courte', 150, 3, 'robesCourte'),
(6, 'Robes Longue', 'Robes Longue', 199.99, 3, 'robesLongue');

-- --------------------------------------------------------

--
-- Structure de la table `article_couleur`
--

CREATE TABLE `article_couleur` (
  `id_article` int(11) NOT NULL,
  `id_couleur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `article_couleur`
--

INSERT INTO `article_couleur` (`id_article`, `id_couleur`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 6),
(4, 2),
(4, 3),
(4, 5),
(5, 1),
(5, 3),
(5, 6),
(6, 1),
(6, 2),
(6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `article_panier`
--

CREATE TABLE `article_panier` (
  `id_article` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL,
  `id_couleur` int(11) NOT NULL,
  `id_taille` int(11) NOT NULL,
  `quantite` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `article_panier`
--

INSERT INTO `article_panier` (`id_article`, `id_panier`, `id_couleur`, `id_taille`, `quantite`) VALUES
(1, 11, 1, 1, 1),
(1, 12, 1, 1, 1),
(1, 13, 1, 1, 1),
(1, 14, 1, 1, 6),
(1, 16, 1, 1, 2),
(1, 16, 1, 2, 1),
(1, 16, 4, 2, 12),
(1, 17, 1, 1, 1),
(1, 18, 1, 1, 1),
(1, 21, 1, 1, 9),
(1, 22, 1, 1, 2),
(1, 23, 1, 2, 1),
(1, 24, 1, 1, 3),
(1, 25, 1, 1, 1),
(1, 26, 1, 1, 1),
(1, 26, 1, 2, 1),
(1, 27, 1, 1, 2),
(1, 27, 2, 2, 1),
(1, 28, 1, 1, 1),
(1, 29, 1, 1, 1),
(1, 32, 1, 1, 1),
(1, 32, 1, 2, 1),
(1, 33, 1, 1, 1),
(1, 34, 1, 1, 1),
(2, 8, 1, 3, 1),
(2, 9, 1, 3, 1),
(2, 10, 1, 3, 2),
(2, 16, 1, 3, 1),
(2, 20, 1, 3, 1),
(2, 22, 1, 3, 1),
(2, 24, 1, 3, 1),
(2, 35, 1, 3, 2),
(3, 31, 1, 5, 16),
(4, 11, 2, 3, 1),
(4, 11, 2, 6, 1),
(4, 21, 2, 3, -7),
(4, 23, 2, 3, 1),
(5, 15, 1, 4, 2),
(5, 16, 3, 5, 2),
(5, 36, 1, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_taille`
--

CREATE TABLE `article_taille` (
  `id_article` int(11) NOT NULL,
  `id_taille` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `article_taille`
--

INSERT INTO `article_taille` (`id_article`, `id_taille`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 3),
(4, 6),
(5, 4),
(5, 5),
(6, 4),
(6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Vêtements'),
(2, 'Accessoires'),
(3, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id`, `message`, `date`, `id_utilisateur`) VALUES
(1, '', '0000-00-00 00:00:00', 96),
(2, 'fvgb', '0000-00-00 00:00:00', 96),
(3, 'fvgb', '0000-00-00 00:00:00', 96),
(4, 'dfghjnklkbfvx', '0000-00-00 00:00:00', 96),
(5, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(6, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(7, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(8, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(9, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(10, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(11, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(12, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(13, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(14, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(15, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(16, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(17, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(18, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(19, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(20, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(21, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(22, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(23, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(24, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(25, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(26, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(27, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(28, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(29, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(30, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(31, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(32, 'esdrftghtfdredftftggfffffffff', '0000-00-00 00:00:00', 96),
(33, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(34, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(35, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(36, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(37, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(38, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(39, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(40, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(41, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(42, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(43, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(44, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(45, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(46, 'gdfchdrfhjfgh', '0000-00-00 00:00:00', 96),
(47, 'tyyfyj\n', '0000-00-00 00:00:00', 96),
(48, 'jiuhi\n', '0000-00-00 00:00:00', 96),
(49, 'UUU', '0000-00-00 00:00:00', 98),
(50, 'AA', '0000-00-00 00:00:00', 98),
(51, 'lkjhg', '0000-00-00 00:00:00', 96),
(52, 'gh', '0000-00-00 00:00:00', 96),
(53, 'helloooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', '0000-00-00 00:00:00', 96),
(54, 'qsedrfghjkjkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk\n', '0000-00-00 00:00:00', 96),
(55, '', '0000-00-00 00:00:00', 96),
(56, '', '0000-00-00 00:00:00', 96),
(57, '', '0000-00-00 00:00:00', 96),
(58, '', '0000-00-00 00:00:00', 96),
(59, '', '0000-00-00 00:00:00', 96),
(60, '', '0000-00-00 00:00:00', 96),
(61, '', '0000-00-00 00:00:00', 96),
(62, 'oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', '0000-00-00 00:00:00', 96),
(63, 'oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', '0000-00-00 00:00:00', 96),
(64, 'ghfh', '0000-00-00 00:00:00', 96),
(65, 'A', '0000-00-00 00:00:00', 96),
(66, 'jj', '0000-00-00 00:00:00', 96),
(67, 'jj', '0000-00-00 00:00:00', 96),
(68, 'a', '0000-00-00 00:00:00', 96),
(69, 'iii', '0000-00-00 00:00:00', 96),
(70, 'ppp', '0000-00-00 00:00:00', 96),
(71, 'dfvs', '0000-00-00 00:00:00', 95),
(72, 'dfs', '0000-00-00 00:00:00', 95),
(73, 'sdcf', '0000-00-00 00:00:00', 95),
(74, 'u', '0000-00-00 00:00:00', 96),
(75, 'uu', '0000-00-00 00:00:00', 96),
(76, 'tyy', '0000-00-00 00:00:00', 96),
(77, 'a', '0000-00-00 00:00:00', 96),
(78, 'a', '0000-00-00 00:00:00', 96),
(79, 'a', '0000-00-00 00:00:00', 96),
(80, 'a', '0000-00-00 00:00:00', 96),
(81, 'A', '0000-00-00 00:00:00', 96),
(82, 'A', '0000-00-00 00:00:00', 96),
(83, 'A', '0000-00-00 00:00:00', 96),
(84, 'A', '0000-00-00 00:00:00', 96),
(85, 'B', '0000-00-00 00:00:00', 96),
(86, 'C', '0000-00-00 00:00:00', 96),
(87, 'U', '0000-00-00 00:00:00', 96),
(88, 'P', '0000-00-00 00:00:00', 96),
(89, 'T', '0000-00-00 00:00:00', 96),
(90, 'T', '0000-00-00 00:00:00', 96),
(91, 'T', '0000-00-00 00:00:00', 96),
(92, 'T', '0000-00-00 00:00:00', 96),
(93, 'T', '0000-00-00 00:00:00', 96),
(94, 'T', '0000-00-00 00:00:00', 96),
(95, 'T', '0000-00-00 00:00:00', 96),
(96, 'T', '0000-00-00 00:00:00', 96),
(97, 'hgjh', '0000-00-00 00:00:00', 96),
(98, 'salut', '0000-00-00 00:00:00', 96),
(99, 'salut jean louis', '0000-00-00 00:00:00', 96),
(100, 'Hello', '0000-00-00 00:00:00', 96),
(101, 'dhg', '2019-02-13 14:55:06', 96),
(102, 'rggxfh\n', '2019-02-13 15:11:30', 96),
(103, 'gergrthtr', '2019-02-13 15:19:24', 96),
(104, 'gergrthtr', '2019-02-13 15:20:58', 96),
(105, 'gergrthtr', '2019-02-13 15:20:58', 96),
(106, 'gergrthtr', '2019-02-13 15:20:59', 96),
(107, 'gergrthtr', '2019-02-13 15:20:59', 96),
(108, 'gergrthtr', '2019-02-13 15:20:59', 96),
(109, 'fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh', '2019-02-13 15:31:31', 96),
(110, 'fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh gfhgjkh fhgjhkikjk dfghj fhyjguhkdfghjudfg', '2019-02-13 15:33:51', 96),
(111, 'fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh gfhgjkh fhgjhkikjk dfghj fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh gfhgjkh fhgjhkikjk dfghj fhyjguhkdfghjudfg  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh gfhgjkh fhgjhkikjk dfghj fhyjguhkdfghjudfg', '2019-02-13 15:34:12', 96),
(112, 'fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh gfhgjkh fhgjhkikjk dfghj fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh gfhgjkh fhgjhkikjk dfghj fhyjguhkdfghjudfg  fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh gfhgjkh fhgjhkikjk dfghj fhyjguhkdfghjudfg fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfgch jh fxdgfcgh gfhgjkh fhgjhkikjk dfghj fhyjguhkdfghjudfg fgxhcjgvkhbljmklhfc  rh sdgfhgjhkjk dfgfhgjhkj  gdghf\ndfg', '2019-02-13 15:34:24', 96),
(113, 'fghg', '2019-02-14 09:15:00', 96),
(114, 'fttttt', '2019-02-14 20:59:21', 96),
(115, 'SALUT\n', '2019-02-25 09:05:03', 96),
(116, 'fgdfg', '2019-02-25 14:41:22', 96),
(117, 'iujyhg', '2019-02-25 14:44:33', 96),
(118, 'jhgn', '2019-02-25 14:44:50', 96),
(119, 'FVDF', '2019-02-26 10:35:29', 105),
(120, 'REGERG', '2019-02-26 14:36:55', 105),
(121, 'dfd', '2019-03-02 08:31:00', 96),
(122, 'gvj', '2019-03-13 10:53:54', 96),
(123, 'gfh', '2019-03-13 11:07:35', 96),
(124, 'Txtxt', '2019-03-13 11:53:05', 105),
(125, 'Ttttt', '2019-03-13 11:53:10', 105),
(126, 'aaa', '2019-03-13 12:23:43', 96),
(127, 'Bbb', '2019-03-13 12:23:52', 105),
(128, 'ccc', '2019-03-13 12:24:06', 96),
(129, 'Ddd', '2019-03-13 12:24:12', 105),
(130, 'Eee', '2019-03-13 12:24:17', 105),
(131, 'Hello', '2019-03-13 12:24:21', 105),
(132, 'trfutfuj', '2019-03-13 12:30:22', 96),
(133, 'hjh', '2019-03-13 12:38:14', 96),
(134, 'Bonjour!', '2019-03-13 15:59:00', 96),
(135, 'Bienvenue sur mon site!', '2019-03-13 15:59:13', 96),
(136, 'Bonjour.', '2019-03-13 15:59:24', 96),
(137, '<script>alert(\'hello\');</script>', '2019-03-21 12:01:06', 105),
(138, '<script>alert(\"Hello! I am an alert box!!\");</script>', '2019-03-21 12:02:07', 105);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

CREATE TABLE `couleur` (
  `id` int(11) NOT NULL,
  `libelle` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id`, `libelle`) VALUES
(1, 'Rouge'),
(2, 'Bleue'),
(3, 'Noir'),
(4, 'Blanc'),
(5, 'Vert'),
(6, 'Jaune');

-- --------------------------------------------------------

--
-- Structure de la table `facturation`
--

CREATE TABLE `facturation` (
  `id` int(11) NOT NULL,
  `adresse_facturation` varchar(100) COLLATE utf8_bin NOT NULL,
  `cp_facturation` varchar(10) COLLATE utf8_bin NOT NULL,
  `ville_facturation` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `facturation`
--

INSERT INTO `facturation` (`id`, `adresse_facturation`, `cp_facturation`, `ville_facturation`) VALUES
(1, 'rue de l\'etuve', '54210', 'Saint Nicolas de Port'),
(2, 'rue de Lorient', '54180', 'Heillecourt'),
(3, '', '', ''),
(4, '', '', ''),
(5, '', '', ''),
(6, '', '', ''),
(7, '', '', ''),
(8, '', '', ''),
(9, '', '', ''),
(10, '', '', ''),
(11, '', '', ''),
(12, '', '', ''),
(13, '', '', ''),
(14, '', '', ''),
(16, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(20, '7 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(21, '2 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(22, '3 rue de l\'étuve', '54210', 'Saint Nicolas de Port'),
(23, '', '', ''),
(24, '', '', ''),
(25, '', '', ''),
(26, '', '', ''),
(27, '', '', ''),
(28, '', '', ''),
(29, '', '', ''),
(30, '', '', ''),
(31, '', '', ''),
(32, '', '', ''),
(33, '', '', ''),
(34, '', '', ''),
(35, '', '', ''),
(36, '', '', ''),
(37, '', '', ''),
(38, '', '', ''),
(39, '', '', ''),
(40, '', '', ''),
(41, '', '', ''),
(42, '', '', ''),
(43, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(44, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(45, '', '', ''),
(46, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(47, '', '', ''),
(48, 'rue du test 6', '56780', 'test6'),
(49, '', '', ''),
(50, '', '', ''),
(51, '', '', ''),
(52, 'rue du test 7', '56780', 'test7'),
(53, '', '', ''),
(54, 'rue du test 7', '56780', 'test7'),
(55, 'test8@live.fr', '55555', 'test8@live.fr'),
(56, 'test8@live.fr', '55555', 'test8@live.fr'),
(57, 'test8@live.fr', '55555', 'test8@live.fr'),
(58, 'test8@live.fr', '55555', 'test8@live.fr'),
(59, 'test8@live.fr', '55555', 'test8@live.fr'),
(60, 'test8@live.fr', '55555', 'test8@live.fr'),
(61, 'test8@live.fr', '55555', 'test8@live.fr'),
(62, 'test8@live.fr', '55555', 'test8@live.fr'),
(63, 'test8@live.fr', '55555', 'test8@live.fr'),
(64, 'test8@live.fr', '55555', 'test8@live.fr'),
(65, 'test8@live.fr', '55555', 'test8@live.fr'),
(66, 'test8@live.fr', '55555', 'test8@live.fr'),
(67, 'testdddd@live.fr', '54210', 'Saint Nicolas de Port'),
(68, '', '', ''),
(69, 'rue du test 9', '56780', 'test9'),
(70, 'rue de la facturation 10', '10000', 'test10'),
(71, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(72, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(73, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(74, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(75, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(76, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(77, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(78, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(79, '7 rue de l\'étuvAAAA', '54210', 'Saint Nicolas de Port'),
(80, 'rue du test 11 F', '11111', 'FFFFF'),
(81, 'test12', '11111', 'GRGRT');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `message`) VALUES
(2, '<p>Bienvenue sur le site Diakustom, nous sommes ravis de vous acceuillir.</p>\r\n<p>N\'hésitez pas à nous contacter par le chat Live Vendeur, ou pas mail:\r\n<a href=\"mailto:diakustom@gmail.com\"> diakustom@gmail.com</a></p>');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `date`, `id_utilisateur`, `is_deleted`, `is_paid`) VALUES
(8, '0000-00-00 00:00:00', 96, 1, 1),
(9, '0000-00-00 00:00:00', 96, 1, 1),
(10, '0000-00-00 00:00:00', 96, 1, 1),
(11, '0000-00-00 00:00:00', 96, 1, 1),
(12, '0000-00-00 00:00:00', 96, 1, 1),
(13, '0000-00-00 00:00:00', 96, 1, 1),
(14, '0000-00-00 00:00:00', 96, 1, 1),
(15, '0000-00-00 00:00:00', 96, 1, 1),
(16, '0000-00-00 00:00:00', 96, 1, 1),
(17, '0000-00-00 00:00:00', 96, 1, 1),
(18, '0000-00-00 00:00:00', 96, 1, 1),
(19, '0000-00-00 00:00:00', 96, 1, 1),
(20, '0000-00-00 00:00:00', 96, 1, 1),
(21, '0000-00-00 00:00:00', 96, 1, 1),
(22, '0000-00-00 00:00:00', 96, 1, 1),
(23, '0000-00-00 00:00:00', 96, 1, 1),
(24, '0000-00-00 00:00:00', 96, 1, 1),
(25, '0000-00-00 00:00:00', 117, 1, 1),
(26, '0000-00-00 00:00:00', 117, 0, 0),
(27, '0000-00-00 00:00:00', 124, 0, 0),
(28, '0000-00-00 00:00:00', 130, 0, 0),
(29, '0000-00-00 00:00:00', 131, 1, 1),
(30, '0000-00-00 00:00:00', 96, 0, 0),
(31, '0000-00-00 00:00:00', 131, 1, 1),
(32, '0000-00-00 00:00:00', 132, 1, 1),
(33, '0000-00-00 00:00:00', 132, 1, 1),
(34, '0000-00-00 00:00:00', 132, 1, 1),
(35, '0000-00-00 00:00:00', 142, 1, 1),
(36, '0000-00-00 00:00:00', 142, 1, 1),
(37, '0000-00-00 00:00:00', 142, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

CREATE TABLE `sous_categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(25) COLLATE utf8_bin NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `libelle`, `id_categorie`) VALUES
(1, 'Ceintures', 2),
(2, 'Boutons', 2),
(3, 'Robes', 1),
(4, 'Pantalons', 1),
(5, 'Tee-Shirt', 1),
(6, 'Bijoux', 3),
(7, 'Autres', 3);

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

CREATE TABLE `taille` (
  `id` int(11) NOT NULL,
  `libelle` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `taille`
--

INSERT INTO `taille` (`id`, `libelle`) VALUES
(1, 'Petit'),
(2, 'Grand'),
(3, '36'),
(4, '38'),
(5, '40'),
(6, '42');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(25) COLLATE utf8_bin NOT NULL,
  `date_naiss` date NOT NULL,
  `pseudo` varchar(25) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(16) COLLATE utf8_bin NOT NULL,
  `mail` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_facturation` int(11) NOT NULL,
  `id_adresse` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `date_naiss`, `pseudo`, `mdp`, `mail`, `id_facturation`, `id_adresse`) VALUES
(96, 'BONNET', 'Laetitia', '1981-06-27', 'Diablota', 'a', 'snowbella@live.fr', 41, 0),
(99, 'Mathieu', 'Delivet', '0000-00-00', 'mathi', 'azertyu', 'mdelivet@gmail.com', 0, 0),
(105, '', '', '0000-00-00', 'Invité', ' s,rt;tchjgh;uk;', 'invite@live.fr', 0, 0),
(116, 'Clément', 'Manessier', '0000-00-00', 'khjh', 'azertyu', 'contact@amc-est.fr', 0, 0),
(117, 'test1', 'test1', '0000-00-00', 'test1', 'test11', 'test1@live.fr', 38, 0),
(118, 'test2', 'test2', '0000-00-00', 'test2', 'test22', 'test2@live.fr', 42, 0),
(119, 'test3', 'test3', '0000-00-00', 'test3', 'test33', 'test3@live.fr', 0, 0),
(120, 'test3', 'test3', '0000-00-00', 'test3', 'test33', 'test3@live.fr', 0, 0),
(121, 'test4', 'test4', '0000-00-00', 'test4', 'test44', 'test4@live.fr', 44, 0),
(122, 'test5', 'test5', '0000-00-00', 'test5', 'test55', 'test5@live.fr', 46, 0),
(123, 'test6', 'test6', '0000-00-00', 'test6', 'test66', 'test6@live.fr', 48, 0),
(124, 'test7', 'test7', '0000-00-00', 'test7', 'test77', 'test7@live.fr', 52, 3),
(125, 'test8@live.fr', 'test8@live.fr', '0000-00-00', 'test8@live.fr', 'test8@live.fr', 'test8@live.fr', 56, 0),
(126, 'test8@live.fr', 'test8@live.fr', '0000-00-00', 'test8@live.fr', 'test8@live.fr', 'test8@live.fr', 57, 0),
(127, 'test8@live.fr', 'test8@live.fr', '0000-00-00', 'test8@live.fr', 'test8@live.fr', 'test8@live.fr', 64, 7),
(128, 'test8@live.fr', 'test8@live.fr', '0000-00-00', 'test8@live.fr', 'test8@live.fr', 'test8@live.fr', 65, 8),
(129, 'test8@live.fr', 'test8@live.fr', '0000-00-00', 'test8@live.fr', 'test8@live.fr', 'test8@live.fr', 66, 9),
(130, 'testdddd@live.fr', 'testdddd@live.fr', '0000-00-00', 'testdddd@live.fr', 'testdddd@live.fr', 'testdddd@live.fr', 67, 10),
(131, 'test9', 'test9', '0000-00-00', 'test9', 'test99', 'test9@live.fr', 69, 11),
(132, 'test10', 'test10', '0000-00-00', 'test10', 'test10', 'test10@live.fr', 70, 12),
(141, 'test11', 'test11', '0000-00-00', 'test11', 'test11', 'test11@live.fr', 80, 22),
(142, 'test12', 'test12', '0000-00-00', 'test12', 'test12', 'test12@live.fr', 81, 23);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `article_couleur`
--
ALTER TABLE `article_couleur`
  ADD PRIMARY KEY (`id_article`,`id_couleur`);

--
-- Index pour la table `article_panier`
--
ALTER TABLE `article_panier`
  ADD PRIMARY KEY (`id_article`,`id_panier`,`id_couleur`,`id_taille`);

--
-- Index pour la table `article_taille`
--
ALTER TABLE `article_taille`
  ADD PRIMARY KEY (`id_article`,`id_taille`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `couleur`
--
ALTER TABLE `couleur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facturation`
--
ALTER TABLE `facturation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taille`
--
ALTER TABLE `taille`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT pour la table `couleur`
--
ALTER TABLE `couleur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `facturation`
--
ALTER TABLE `facturation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `taille`
--
ALTER TABLE `taille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
