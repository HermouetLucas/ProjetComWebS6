-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 14 mai 2025 à 09:39
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `eleves` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `eleves` (`Id`, `Nom`, `Prenom`) VALUES
(123, 'Campioni', 'Alban'),
(456, 'Hermouet', 'Lucas'),
(789, 'Dufond', 'Lucia');

-- --------------------------------------------------------


CREATE TABLE `matieres` (
  `Id` int(11) NOT NULL,
  `Libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `matieres` (`Id`, `Libelle`) VALUES
(1, 'Informatique'),
(2, 'Mathématiques'),
(3, 'Signal');

-- --------------------------------------------------------

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `Note` decimal(15,3) DEFAULT NULL,
  `IdEleve` int(11) NOT NULL,
  `idMatiere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `notes` (`id`, `Note`, `IdEleve`, `idMatiere`) VALUES
(1, 18.000, 123, 2),
(2, 12.000, 789, 2),
(3, 14.000, 456, 2),
(4, 12.000, 123, 1),
(5, 7.500, 789, 1),
(6, 15.000, 456, 1);


ALTER TABLE `eleves`
  ADD PRIMARY KEY (`Id`);


ALTER TABLE `matieres`
  ADD PRIMARY KEY (`Id`);


ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notes_matiere` (`idMatiere`),
  ADD KEY `fk_notes_eleves` (`IdEleve`);



ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_eleves` FOREIGN KEY (`IdEleve`) REFERENCES `eleves` (`Id`),
  ADD CONSTRAINT `fk_notes_matiere` FOREIGN KEY (`idMatiere`) REFERENCES `matieres` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
