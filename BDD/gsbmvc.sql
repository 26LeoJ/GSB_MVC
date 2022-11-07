-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 19 mai 2019 à 09:34
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsbmvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` varchar(2) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('RB', 'Remboursée'),
('VA', 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

DROP TABLE IF EXISTS `fichefrais`;
CREATE TABLE IF NOT EXISTS `fichefrais` (
  `idVisiteur` varchar(5) NOT NULL,
  `mois` varchar(20) NOT NULL,
  `annee` varchar(4) NOT NULL,
  `idFiche` varchar(10) NOT NULL,
  `nbJustificatif` varchar(255) NOT NULL,
  `montantValide` int(11) NOT NULL,
  `dateModif` date NOT NULL,
  `idEtat` varchar(2) NOT NULL,
  PRIMARY KEY (`idFiche`),
  KEY `idEtat` (`idEtat`),
  KEY `idVisiteur` (`idVisiteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fichefrais`
--

INSERT INTO `fichefrais` (`idVisiteur`, `mois`, `annee`, `idFiche`, `nbJustificatif`, `montantValide`, `dateModif`, `idEtat`) VALUES
('a131', '03', '2019', 'a131032019', '0', 0, '2019-03-28', 'CR'),
('a131', '07', '2018', 'a131072018', '0', 0, '2018-07-01', 'CL'),
('a131', '08', '2018', 'a131082018', '0', 0, '2018-08-01', 'CL'),
('a131', '09', '2018', 'a131092018', '0', 0, '2018-09-01', 'CR'),
('a131', '10', '2018', 'a131102018', '0', 0, '2018-10-14', 'CR'),
('a131', '11', '2018', 'a131112018', '0', 0, '2018-11-01', 'CR'),
('a17', '07', '2018', 'a17072018', '0', 0, '2018-07-01', 'CL'),
('a17', '08', '2018', 'a17082018', '0', 0, '2018-08-01', 'CL'),
('a17', '09', '2018', 'a17092018', '0', 0, '2018-09-01', 'CR'),
('a17', '10', '2018', 'a17102018', '0', 0, '2018-10-04', 'CR'),
('a17', '11', '2018', 'a17112018', '0', 0, '2018-11-02', 'CR'),
('a311', '02', '2019', 'a311022019', '0', 0, '2019-02-22', 'CR'),
('a311', '03', '2019', 'a311032019', '0', 0, '2019-03-11', 'CR'),
('a311', '10', '2018', 'a311102018', '0', 0, '2018-10-14', 'CR'),
('a311', '11', '2018', 'a311112018', '0', 0, '2018-11-01', 'CR'),
('e52', '11', '2018', 'e52112018', '0', 0, '2018-11-01', 'CR'),
('f4', '11', '2018', 'f4112018', '0', 0, '2018-11-02', 'CR');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

DROP TABLE IF EXISTS `fraisforfait`;
CREATE TABLE IF NOT EXISTS `fraisforfait` (
  `id` varchar(3) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `montant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id`, `libelle`, `montant`) VALUES
('ETP', 'Forfait Etape', 110),
('KM', 'Frais Kilométrique', 1),
('NUI', 'Nuitée Hôtel', 80),
('REP', 'Repas Restaurant', 25);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

DROP TABLE IF EXISTS `lignefraisforfait`;
CREATE TABLE IF NOT EXISTS `lignefraisforfait` (
  `idFicheFrais` varchar(10) NOT NULL,
  `idFraisForfait` varchar(3) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idFicheFrais`,`idFraisForfait`),
  KEY `idFraisForfait` (`idFraisForfait`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`idFicheFrais`, `idFraisForfait`, `quantite`) VALUES
('112018', 'ETP', 0),
('112018', 'KM', 0),
('112018', 'NUI', 0),
('112018', 'REP', 0),
('a131032019', 'ETP', 0),
('a131032019', 'KM', 0),
('a131032019', 'NUI', 0),
('a131032019', 'REP', 0),
('a131072018', 'ETP', 22),
('a131072018', 'KM', 15),
('a131072018', 'NUI', 12),
('a131072018', 'REP', 3),
('a131082018', 'ETP', 3),
('a131082018', 'KM', 122),
('a131082018', 'NUI', 5),
('a131082018', 'REP', 15),
('a131092018', 'ETP', 17),
('a131092018', 'KM', 150),
('a131092018', 'NUI', 7),
('a131092018', 'REP', 8),
('a131102018', 'ETP', 10),
('a131102018', 'KM', 5),
('a131102018', 'NUI', 5),
('a131102018', 'REP', 5),
('a131112018', 'ETP', 16),
('a131112018', 'KM', 50),
('a131112018', 'NUI', 10),
('a131112018', 'REP', 6),
('a17072018', 'ETP', 35),
('a17072018', 'KM', 144),
('a17072018', 'NUI', 3),
('a17072018', 'REP', 9),
('a17082018', 'ETP', 18),
('a17082018', 'KM', 254),
('a17082018', 'NUI', 22),
('a17082018', 'REP', 49),
('a17092018', 'ETP', 30),
('a17092018', 'KM', 500),
('a17092018', 'NUI', 12),
('a17092018', 'REP', 32),
('a17102018', 'ETP', 6),
('a17102018', 'KM', 10),
('a17102018', 'NUI', 10),
('a17102018', 'REP', 10),
('a17112018', 'ETP', 10),
('a17112018', 'KM', 6),
('a17112018', 'NUI', 15),
('a17112018', 'REP', 4),
('a311022019', 'ETP', 2),
('a311022019', 'KM', 56),
('a311022019', 'NUI', 6),
('a311022019', 'REP', 6),
('a311032019', 'ETP', 104),
('a311032019', 'KM', 10),
('a311032019', 'NUI', 12),
('a311032019', 'REP', 20),
('a311102018', 'ETP', 12),
('a311102018', 'KM', 16),
('a311102018', 'NUI', 20),
('a311102018', 'REP', 16),
('a311112018', 'ETP', 36),
('a311112018', 'KM', 26),
('a311112018', 'NUI', 26),
('a311112018', 'REP', 26),
('e52112018', 'ETP', 0),
('e52112018', 'KM', 0),
('e52112018', 'NUI', 0),
('e52112018', 'REP', 0),
('f4112018', 'ETP', 10),
('f4112018', 'KM', 50),
('f4112018', 'NUI', 5),
('f4112018', 'REP', 5);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

DROP TABLE IF EXISTS `lignefraishorsforfait`;
CREATE TABLE IF NOT EXISTS `lignefraishorsforfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idFicheFrais` varchar(10) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `dates` date NOT NULL,
  `montant` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFicheFrais` (`idFicheFrais`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id`, `idFicheFrais`, `libelle`, `dates`, `montant`) VALUES
(1, 'a131072018', 'problème voiture', '2018-07-01', 521),
(2, 'a131072018', 'Achat valise', '2018-07-18', 55),
(3, 'a131082018', 'Problème valise', '2018-08-12', 21),
(4, 'a131082018', 'Achat nouveau ordinateur', '2018-08-25', 789),
(5, 'a131092018', 'renouvellement licence', '2018-09-14', 99),
(6, 'a131092018', 'achat clé usb', '2018-09-30', 25),
(7, 'a17072018', 'achat clavier', '2018-07-15', 15),
(8, 'a17072018', 'changement pneu voiture', '2018-07-21', 352),
(9, 'a17082018', 'achat montre', '2018-08-05', 150),
(10, 'a17082018', 'achat téléphone', '2018-08-29', 480),
(11, 'a17092018', 'changement parebrise voiture', '2018-09-08', 450),
(12, 'a17092018', 'abonnement téléphone ', '2018-09-25', 39),
(15, 'a131102018', 'Achat licence Windows 7', '2018-10-31', 100),
(16, 'a131102018', 'Abonnement Antivirus', '2018-10-29', 160),
(17, 'a17102018', 'Achat casque', '2018-10-29', 160),
(18, 'a17102018', 'Achat souris', '2018-10-29', 60),
(19, 'a311102018', 'Achat ecouteurs', '2018-10-29', 30),
(20, 'a311102018', 'Achat ecran et clavier', '2018-10-29', 200),
(21, 'a311102018', 'Achat tablette graphique', '2018-10-29', 150),
(22, 'a131112018', 'Achat montre', '2018-11-02', 60),
(23, 'a17112018', 'Achat licence Windows Server', '2018-11-02', 110),
(24, 'a311112018', 'Achat disque dur 500 Go', '2018-11-02', 500),
(25, 'a131112018', 'Achat chemise', '2018-11-02', 25),
(26, 'a131112018', 'Achat licence Adobe Pro', '2018-11-02', 160),
(27, 'a131112018', 'Achat adaptateur HDMI', '2018-11-02', 60),
(28, 'a17112018', 'Entretien voiture', '2018-11-02', 360),
(29, 'a311112018', 'Achat pc fixe', '2018-11-02', 860),
(30, 'a311112018', 'Achat raquette tennis de table', '2018-11-17', 110),
(31, 'f4112018', 'test', '2018-11-17', 10),
(32, 'a311112018', 'Achat Undertale', '2018-11-23', 10),
(33, 'a311022019', 'Achat livre webmastering', '2019-02-23', 26),
(34, 'a311032019', 'Achat livre SQL Developer', '2019-03-15', 23),
(35, 'a311032019', 'Achat bouteille d eau', '2019-03-29', 6);

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `MATRICULE` char(4) NOT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `LOGIN` varchar(50) DEFAULT NULL,
  `MDP` varchar(20) DEFAULT NULL,
  `ADRESSE` varchar(50) DEFAULT NULL,
  `CODEPOSTAL` char(5) DEFAULT NULL,
  `DATEENTREE` datetime DEFAULT NULL,
  `CODEUNIT` char(4) NOT NULL,
  `NOMUNIT` varchar(50) DEFAULT NULL,
  `ville` varchar(50) NOT NULL,
  `dateEmbauche` date NOT NULL,
  PRIMARY KEY (`MATRICULE`),
  KEY `CODEPOSTAL` (`CODEPOSTAL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`MATRICULE`, `NOM`, `PRENOM`, `LOGIN`, `MDP`, `ADRESSE`, `CODEPOSTAL`, `DATEENTREE`, `CODEUNIT`, `NOMUNIT`, `ville`, `dateEmbauche`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', 'jux7g', '8 rue des Charmes', '46000', '2005-12-21 01:01:01', 'SW', 'SWISS', 'Cahors', '2005-12-21'),
('a17', 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', '46200', '1998-11-23 01:01:01', 'BO', 'BOURDIN', 'Lalbenque', '1998-11-23'),
('a311', 'Jegousse', 'Leo', 'leo', 'password', 'rue de la gare', '46512', '2018-12-02 00:00:00', 'SW', 'SWISS', 'Vannes', '2014-02-10'),
('a55', 'Bedos', 'Christian', 'cbedos', 'gmhxd', '1 rue Peranud', '46250', '1995-01-12 01:01:01', 'BO', 'BOURDIN', 'Montcuq', '1995-01-12'),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'ktp3s', '22 rue des Ternes', '46123', '2000-05-01 01:01:01', 'SW', 'SWISS', 'Gramat', '2000-05-01'),
('b13', 'Bentot', 'Pascal', 'pbentot', 'doyw1', '11 allée des Cerises', '46512', '1992-07-09 01:01:01', 'BO', 'BOURDIN', 'Bessines', '1992-07-09'),
('b16', 'Bioret', 'Luc', 'lbioret', 'hrjfs', '1 Avenue gambetta', '46000', '1998-05-11 01:01:01', 'SW', 'SWISS', 'Cahors', '1998-05-11'),
('b19', 'Bunisset', 'Francis', 'fbunisset', '4vbnd', '10 rue des Perles', '93100', '1987-10-21 01:01:01', 'BO', 'BOURDIN', 'Montreuil', '1987-10-21'),
('b25', 'Bunisset', 'Denise', 'dbunisset', 's1y1r', '23 rue Manin', '75019', '2010-12-05 01:01:01', 'SW', 'SWISS', 'paris', '2010-12-05'),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'uf7r3', '114 rue Blanche', '75017', '2009-11-12 01:01:01', 'SW', 'SWISS', 'Paris', '2009-11-12'),
('b34', 'Cadic', 'Eric', 'ecadic', '6u8dc', '123 avenue de la République', '75011', '2008-09-23 01:01:01', 'BO', 'BOURDIN', 'Paris', '2008-09-23'),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'u817o', '100 rue Petit', '75019', '2005-11-12 01:01:01', 'SW', 'SWISS', 'Paris', '2005-11-12'),
('b50', 'Clepkens', 'Christophe', 'cclepkens', 'bw1us', '12 allée des Anges', '93230', '2003-08-11 01:01:01', 'BO', 'BOURDIN', 'Romainville', '2003-08-11'),
('b59', 'Cottin', 'Vincenne', 'vcottin', '2hoh9', '36 rue Des Roches', '93100', '2001-11-18 01:01:01', 'SW', 'SWISS', 'Monteuil', '2001-11-18'),
('c14', 'Daburon', 'François', 'fdaburon', '7oqpv', '13 rue de Chanzy', '94000', '2002-02-11 01:01:01', 'SW', 'SWISS', 'Créteil', '2002-02-11'),
('c3', 'De', 'Philippe', 'pde', 'gk9kx', '13 rue Barthes', '94000', '2010-12-14 01:01:01', 'BO', 'BOURDIN', 'Créteil', '2010-12-14'),
('c54', 'Debelle', 'Michel', 'mdebelle', 'od5rt', '181 avenue Barbusse', '93210', '2006-11-23 01:01:01', 'BO', 'BOURDIN', 'Rosny', '2006-11-23'),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'nvwqq', '134 allée des Joncs', '44000', '2000-05-11 01:01:01', 'SW', 'SWISS', 'Nantes', '2000-05-11'),
('d51', 'Debroise', 'Michel', 'mdebroise', 'sghkb', '2 Bld Jourdain', '44000', '2001-04-17 01:01:01', 'BO', 'BOURDIN', 'Nantes', '2001-04-17'),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', 'f1fob', '14 Place d Arc', '45000', '2005-11-12 01:01:01', 'SW', 'SWISS', 'Orléans', '2005-11-12'),
('e24', 'Desnost', 'Pierre', 'pdesnost', '4k2o5', '16 avenue des Cèdres', '23200', '2001-02-05 01:01:01', 'BO', 'BOURDIN', 'Guéret', '2001-02-05'),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '44im8', '18 rue de l église', '23120', '2000-08-01 01:01:01', 'SW', 'SWISS', 'GrandBourg', '2000-08-01'),
('e49', 'Duncombe', 'Claude', 'cduncombe', 'qf77j', '19 rue de la tour', '23100', '1987-10-10 01:01:01', 'SW', 'SWISS', 'La souteraine', '1987-10-10'),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', 'y2qdu', '25 place de la gare', '23200', '1995-09-01 01:01:01', 'BO', 'BOURDIN', 'Gueret', '1995-09-01'),
('e52', 'Eynde', 'Valérie', 'veynde', 'i7sn3', '3 Grand Place', '13015', '1999-11-01 01:01:01', 'BO', 'BOURDIN', 'Marseille', '1999-11-01'),
('f21', 'Finck', 'Jacques', 'jfinck', 'mpb3t', '10 avenue du Prado', '13012', '2001-11-10 01:01:01', 'SW', 'SWISS', 'Marseille', '2001-11-10'),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq', '4 route de la mer', '13012', '1998-10-01 01:01:01', 'BO', 'BOURDIN', 'Allauh', '1998-10-01'),
('f4', 'Gest', 'Alain', 'agest', 'dywvt', '30 avenue de la mer', '13025', '1985-11-01 01:01:01', 'SW', 'SWISS', 'Berre', '1985-11-01');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD CONSTRAINT `fk_idEtat` FOREIGN KEY (`idEtat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `fk_idVisiteur` FOREIGN KEY (`idVisiteur`) REFERENCES `visiteur` (`MATRICULE`);

--
-- Contraintes pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD CONSTRAINT `fk_idFicheFrais` FOREIGN KEY (`idFicheFrais`) REFERENCES `fichefrais` (`idFiche`),
  ADD CONSTRAINT `fk_idFraisForfait` FOREIGN KEY (`idFraisForfait`) REFERENCES `fraisforfait` (`id`);

--
-- Contraintes pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD CONSTRAINT `fk_idFicheFrais2` FOREIGN KEY (`idFicheFrais`) REFERENCES `fichefrais` (`idFiche`);

--
-- Contraintes pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD CONSTRAINT `VISITEUR_ibfk_1` FOREIGN KEY (`CODEPOSTAL`) REFERENCES `localite` (`CODEPOSTAL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
