-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 10:36 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbrett`
--

-- --------------------------------------------------------

--
-- Table structure for table `anzeige`
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
-- Dumping data for table `anzeige`
--

INSERT INTO `anzeige` (`anzeigennummer`, `inserentennummer`, `titel`, `autor`, `verlag`, `isbn`, `anzeigendatum`) VALUES
(501, 214, 'Mountainbike, VB 200,-', NULL, NULL, NULL, '2007-11-03'),
(502, 211, '5 Kinderbücher zu verkaufen', NULL, NULL, NULL, '2007-12-17'),
(503, 211, 'Verkaufe Harry Potter 5', NULL, NULL, NULL, '2008-02-04'),
(505, 210, 'Pippi Langstrumpf', NULL, NULL, NULL, '2008-02-06'),
(507, 210, 'Buch TCP/IP-Grundlagen', NULL, NULL, NULL, '2008-03-10'),
(508, 214, 'gebrauchtes Trekkingrad', NULL, NULL, NULL, '2008-03-29'),
(509, 215, 'Verkaufe meinen Golf 2, 155 Tkm, 55 PS Baujahr 1990 für 500€', NULL, NULL, NULL, '2018-03-22'),
(553, 240, 'Ich verkaufen Buch', NULL, NULL, NULL, '2022-09-29'),
(556, 240, 'buchtitel', NULL, NULL, NULL, '0000-00-00'),
(558, 240, 'titel', 'autor', 'verlag', 214, '2022-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `inserent`
--

CREATE TABLE `inserent` (
  `inserentennummer` int(11) NOT NULL,
  `nickname` char(20) DEFAULT NULL,
  `email` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inserent`
--

INSERT INTO `inserent` (`inserentennummer`, `nickname`, `email`) VALUES
(210, 'jens', 'jens@bv-1.de'),
(211, 'frank', 'frank@bv-1.de'),
(214, 'sissi', 'sissi@bv-1.de'),
(215, 'lisa', 'lisa@web.de'),
(240, 'Timo', 'Adresse@da.de');

-- --------------------------------------------------------

--
-- Table structure for table `rubrik`
--

CREATE TABLE `rubrik` (
  `rubriknummer` int(11) NOT NULL,
  `rubrikbezeichnung` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rubrik`
--

INSERT INTO `rubrik` (`rubriknummer`, `rubrikbezeichnung`) VALUES
(1, 'Autos'),
(2, 'Zweiräder'),
(3, 'Computer'),
(4, 'Haushaltswaren'),
(5, 'Bücher'),
(6, 'sonstiges');

-- --------------------------------------------------------

--
-- Table structure for table `veroeffentlichen`
--

CREATE TABLE `veroeffentlichen` (
  `anzeigennummer` int(11) NOT NULL,
  `rubriknummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `veroeffentlichen`
--

INSERT INTO `veroeffentlichen` (`anzeigennummer`, `rubriknummer`) VALUES
(501, 2),
(502, 5),
(505, 5),
(507, 3),
(507, 5),
(507, 6),
(508, 2),
(509, 1),
(553, 1),
(553, 5),
(556, 1),
(556, 5),
(558, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anzeige`
--
ALTER TABLE `anzeige`
  ADD PRIMARY KEY (`anzeigennummer`),
  ADD KEY `ix_gib_auf` (`inserentennummer`);

--
-- Indexes for table `inserent`
--
ALTER TABLE `inserent`
  ADD PRIMARY KEY (`inserentennummer`);

--
-- Indexes for table `rubrik`
--
ALTER TABLE `rubrik`
  ADD PRIMARY KEY (`rubriknummer`);

--
-- Indexes for table `veroeffentlichen`
--
ALTER TABLE `veroeffentlichen`
  ADD PRIMARY KEY (`anzeigennummer`,`rubriknummer`),
  ADD KEY `ix_wird_veroeffentlicht` (`anzeigennummer`),
  ADD KEY `ix_wird_zugeordnet` (`rubriknummer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anzeige`
--
ALTER TABLE `anzeige`
  MODIFY `anzeigennummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559;

--
-- AUTO_INCREMENT for table `inserent`
--
ALTER TABLE `inserent`
  MODIFY `inserentennummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `rubrik`
--
ALTER TABLE `rubrik`
  MODIFY `rubriknummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anzeige`
--
ALTER TABLE `anzeige`
  ADD CONSTRAINT `anzeige_ibfk_1` FOREIGN KEY (`inserentennummer`) REFERENCES `inserent` (`inserentennummer`);

--
-- Constraints for table `veroeffentlichen`
--
ALTER TABLE `veroeffentlichen`
  ADD CONSTRAINT `veroeffentlichen_ibfk_1` FOREIGN KEY (`anzeigennummer`) REFERENCES `anzeige` (`anzeigennummer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `veroeffentlichen_ibfk_2` FOREIGN KEY (`rubriknummer`) REFERENCES `rubrik` (`rubriknummer`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
