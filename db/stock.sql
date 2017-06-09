-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 13 Décembre 2016 à 13:45
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `idfacture` int(11) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `operation_idoperation` int(11) NOT NULL,
  `operation_vendeur_idvendeur` int(11) NOT NULL,
  `operation_produit_idproduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historiquestock`
--

CREATE TABLE `historiquestock` (
  `idHS` int(11) NOT NULL,
  `idstock` int(11) NOT NULL,
  `oldqtestockee` double NOT NULL,
  `newqtestockee` double NOT NULL,
  `date` datetime NOT NULL,
  `produit_idproduit` varchar(45) NOT NULL,
  `datehisto` datetime NOT NULL,
  `userhisto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `journal`
--

CREATE TABLE `journal` (
  `idjournal` int(11) NOT NULL,
  `quantité` decimal(10,0) NOT NULL,
  `operation_idoperation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `idoperation` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantite` double NOT NULL,
  `vendeur_idvendeur` int(11) NOT NULL,
  `produit_idproduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idproduit` int(11) NOT NULL,
  `denomination` varchar(45) NOT NULL,
  `prix` double NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

CREATE TABLE `rapport` (
  `idrapport` int(11) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `facture_idfacture` int(11) NOT NULL,
  `facture_operation_idoperation` int(11) NOT NULL,
  `facture_operation_vendeur_idvendeur` int(11) NOT NULL,
  `facture_operation_produit_idproduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL,
  `qtestockee` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `produit_idproduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déclencheurs `stock`
--
DELIMITER $$
CREATE TRIGGER `after_update_stock` AFTER UPDATE ON `stock` FOR EACH ROW INSERT INTO historiquestock(
		idstock,
		oldqtestockee,
		date,
		produit_idproduit,
		datehisto,
    newqtestockee,
		userhisto)
	VALUES(
		OLD.idstock,
		OLD.qtestockee,
		OLD.date,
		OLD.produit_idproduit,
		NOW(),
        NEW.qtestockee,
		CURRENT_USER())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE `vendeur` (
  `idvendeur` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `user` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vendeur`
--

INSERT INTO `vendeur` (`idvendeur`, `nom`, `user`, `pass`) VALUES
(1, 'Vendor', 'ven', 'fcacf366e100ec0f419f6a2c3999047df8328a4c'),
(2, 'Sammy', 'sam', '4b10d006f282bb96af0101d74d02b404d9632728'),
(3, 'Francky', 'abc', 'fcacf366e100ec0f419f6a2c3999047df8328a4c'),
(5, 'Yusto', 'yus', 'a8baac10f89192539ab2807cad2bc4a232c4a261');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`idfacture`,`operation_idoperation`,`operation_vendeur_idvendeur`,`operation_produit_idproduit`),
  ADD KEY `fk_facture_operation1` (`operation_idoperation`,`operation_vendeur_idvendeur`,`operation_produit_idproduit`);

--
-- Index pour la table `historiquestock`
--
ALTER TABLE `historiquestock`
  ADD PRIMARY KEY (`idHS`);

--
-- Index pour la table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`idjournal`),
  ADD KEY `fk_journal_operation1` (`operation_idoperation`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`idoperation`,`vendeur_idvendeur`,`produit_idproduit`),
  ADD KEY `fk_operation_vendeur` (`vendeur_idvendeur`),
  ADD KEY `fk_operation_produit1` (`produit_idproduit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idproduit`);

--
-- Index pour la table `rapport`
--
ALTER TABLE `rapport`
  ADD PRIMARY KEY (`idrapport`,`facture_idfacture`,`facture_operation_idoperation`,`facture_operation_vendeur_idvendeur`,`facture_operation_produit_idproduit`),
  ADD KEY `fk_rapport_facture1` (`facture_idfacture`,`facture_operation_idoperation`,`facture_operation_vendeur_idvendeur`,`facture_operation_produit_idproduit`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idstock`,`produit_idproduit`),
  ADD KEY `fk_stock_produit1` (`produit_idproduit`);

--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`idvendeur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idfacture` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historiquestock`
--
ALTER TABLE `historiquestock`
  MODIFY `idHS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `journal`
--
ALTER TABLE `journal`
  MODIFY `idjournal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `idoperation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idproduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `rapport`
--
ALTER TABLE `rapport`
  MODIFY `idrapport` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `idstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `vendeur`
--
ALTER TABLE `vendeur`
  MODIFY `idvendeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `fk_facture_operation1` FOREIGN KEY (`operation_idoperation`,`operation_vendeur_idvendeur`,`operation_produit_idproduit`) REFERENCES `operation` (`idoperation`, `vendeur_idvendeur`, `produit_idproduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `fk_journal_operation1` FOREIGN KEY (`operation_idoperation`) REFERENCES `operation` (`idoperation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `fk_operation_produit1` FOREIGN KEY (`produit_idproduit`) REFERENCES `produit` (`idproduit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_operation_vendeur` FOREIGN KEY (`vendeur_idvendeur`) REFERENCES `vendeur` (`idvendeur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `fk_rapport_facture1` FOREIGN KEY (`facture_idfacture`,`facture_operation_idoperation`,`facture_operation_vendeur_idvendeur`,`facture_operation_produit_idproduit`) REFERENCES `facture` (`idfacture`, `operation_idoperation`, `operation_vendeur_idvendeur`, `operation_produit_idproduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_produit1` FOREIGN KEY (`produit_idproduit`) REFERENCES `produit` (`idproduit`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
