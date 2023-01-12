-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Jan 2023 um 11:00
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webbrett`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `anzeige`
--

CREATE TABLE `anzeige` (
  `anzeigennummer` int(11) NOT NULL,
  `inserentennummer` int(11) NOT NULL,
  `titel` char(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `verlag` varchar(255) DEFAULT NULL,
  `isbn` int(11) DEFAULT NULL,
  `anzeigendatum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `anzeige`
--

INSERT INTO `anzeige` (`anzeigennummer`, `inserentennummer`, `titel`, `autor`, `verlag`, `isbn`, `anzeigendatum`) VALUES
(564, 246, 'Verkaufe Buch für Bmw Reperaturen', 'Linus Runde', 'Motoren Verlag', 2143542365, '2023-01-12'),
(565, 247, 'Audi Chronik 120 Euro VB', 'Franz Raue', 'Motoren Verlag', 2147483647, '2023-01-12'),
(566, 248, 'Hondas Chronik', 'Mark Mucha', 'Zeit Verlag', 769987041, '2023-01-12'),
(567, 249, 'PHP für Anfänger', 'Petra Tappert', 'Computer Verlag', 2147483647, '2023-01-12'),
(568, 250, 'SQL für Profis 100 Euro VB', 'Fritz Weißenfels', 'Computer Verlag', 2147483647, '2023-01-12'),
(569, 251, 'PHP Frameworks 100 FP', 'Kai Irmscher', 'PC Verlag', 719569333, '2023-01-12'),
(570, 252, 'Motorenpflege aller Art 120 Euro VB', 'Rosemarie Mair', 'Selbermachen Verlag', 2147483647, '2023-01-12'),
(571, 253, 'Advanced Data Structures 30 Euro VB', 'Edeltraud Jodda', 'Verlag für Nerds', 2147483647, '2023-01-12');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `inserent`
--

CREATE TABLE `inserent` (
  `inserentennummer` int(11) NOT NULL,
  `nickname` char(20) DEFAULT NULL,
  `email` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `inserent`
--

INSERT INTO `inserent` (`inserentennummer`, `nickname`, `email`) VALUES
(246, 'Hans Meier', 'Hans@mail.de'),
(247, 'Max Baudach', 'max@email.de'),
(248, 'Helmut Steuernagel', 'steuernagel@dmail.de'),
(249, 'Sabine Adrian', 'sabine@mail.de'),
(250, 'Tom Sieckmann', 'tom@dmail.de'),
(251, 'Marina Schick', 'marina@mail.de'),
(252, 'Sabrina Jones', 'sabrina@emai.de'),
(253, 'Lieselotte Vopel', 'vopel@mail.de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rubrik`
--

CREATE TABLE `rubrik` (
  `rubriknummer` int(11) NOT NULL,
  `rubrikbezeichnung` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `rubrik`
--

INSERT INTO `rubrik` (`rubriknummer`, `rubrikbezeichnung`) VALUES
(1, 'Autos'),
(2, 'Zweiräder'),
(3, 'Computer'),
(4, 'Haushaltswaren'),
(5, 'Software'),
(6, 'sonstiges');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Timo', '$2y$10$vOpn.yn7xQ/y1/2ZR5v95.Bxg3Qexj969WB2miA.NDD9QCjB4WCEG');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `veroeffentlichen`
--

CREATE TABLE `veroeffentlichen` (
  `anzeigennummer` int(11) NOT NULL,
  `rubriknummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `veroeffentlichen`
--

INSERT INTO `veroeffentlichen` (`anzeigennummer`, `rubriknummer`) VALUES
(564, 1),
(564, 2),
(565, 1),
(566, 1),
(566, 2),
(567, 3),
(567, 5),
(568, 3),
(568, 5),
(569, 3),
(569, 5),
(570, 1),
(570, 2),
(571, 3),
(571, 5);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `anzeige`
--
ALTER TABLE `anzeige`
  ADD PRIMARY KEY (`anzeigennummer`),
  ADD KEY `ix_gib_auf` (`inserentennummer`);

--
-- Indizes für die Tabelle `inserent`
--
ALTER TABLE `inserent`
  ADD PRIMARY KEY (`inserentennummer`);

--
-- Indizes für die Tabelle `rubrik`
--
ALTER TABLE `rubrik`
  ADD PRIMARY KEY (`rubriknummer`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `veroeffentlichen`
--
ALTER TABLE `veroeffentlichen`
  ADD PRIMARY KEY (`anzeigennummer`,`rubriknummer`),
  ADD KEY `ix_wird_veroeffentlicht` (`anzeigennummer`),
  ADD KEY `ix_wird_zugeordnet` (`rubriknummer`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `anzeige`
--
ALTER TABLE `anzeige`
  MODIFY `anzeigennummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=572;

--
-- AUTO_INCREMENT für Tabelle `inserent`
--
ALTER TABLE `inserent`
  MODIFY `inserentennummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT für Tabelle `rubrik`
--
ALTER TABLE `rubrik`
  MODIFY `rubriknummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `anzeige`
--
ALTER TABLE `anzeige`
  ADD CONSTRAINT `anzeige_ibfk_1` FOREIGN KEY (`inserentennummer`) REFERENCES `inserent` (`inserentennummer`);

--
-- Constraints der Tabelle `veroeffentlichen`
--
ALTER TABLE `veroeffentlichen`
  ADD CONSTRAINT `veroeffentlichen_ibfk_1` FOREIGN KEY (`anzeigennummer`) REFERENCES `anzeige` (`anzeigennummer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `veroeffentlichen_ibfk_2` FOREIGN KEY (`rubriknummer`) REFERENCES `rubrik` (`rubriknummer`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
