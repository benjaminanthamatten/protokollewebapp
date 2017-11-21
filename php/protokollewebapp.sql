-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Nov 2017 um 13:01
-- Server-Version: 10.1.13-MariaDB
-- PHP-Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `protokollewebapp`
--
CREATE DATABASE IF NOT EXISTS `protokollewebapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `protokollewebapp`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `protokolle`
--

CREATE TABLE `protokolle` (
  `protokollID` int(11) NOT NULL,
  `schueler` varchar(200) NOT NULL,
  `gemacht` varchar(200) NOT NULL,
  `von` varchar(200) NOT NULL,
  `bis` varchar(200) NOT NULL,
  `probleme` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schueler`
--

CREATE TABLE `schueler` (
  `schuelerID` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `passwort` varchar(200) NOT NULL,
  `klasse` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `schueler`
--

INSERT INTO `schueler` (`schuelerID`, `email`, `passwort`, `klasse`) VALUES
(5, 'max.mustermann@gmail.com', '$2y$10$a3sIgQGocbbhC8fzH2e2.O7wHl3Mf649DHcefCzxALnXFSN9MrVSG', 'ME1');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `protokolle`
--
ALTER TABLE `protokolle`
  ADD PRIMARY KEY (`protokollID`);

--
-- Indizes für die Tabelle `schueler`
--
ALTER TABLE `schueler`
  ADD PRIMARY KEY (`schuelerID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `protokolle`
--
ALTER TABLE `protokolle`
  MODIFY `protokollID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `schueler`
--
ALTER TABLE `schueler`
  MODIFY `schuelerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
