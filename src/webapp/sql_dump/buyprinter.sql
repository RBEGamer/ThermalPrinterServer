-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 17. Jun 2017 um 21:21
-- Server Version: 5.5.55-0+deb8u1
-- PHP-Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `buyprinter`
--
CREATE DATABASE IF NOT EXISTS `buyprinter` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `buyprinter`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
`id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `print` int(11) NOT NULL DEFAULT '0',
  `printed` int(11) NOT NULL DEFAULT '0',
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_count` int(11) NOT NULL DEFAULT '1',
  `printerid` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `printers`
--

DROP TABLE IF EXISTS `printers`;
CREATE TABLE IF NOT EXISTS `printers` (
`id` int(11) NOT NULL,
  `printerid` int(11) NOT NULL DEFAULT '-1',
  `printername` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `printers`
--
ALTER TABLE `printers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT für Tabelle `printers`
--
ALTER TABLE `printers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
