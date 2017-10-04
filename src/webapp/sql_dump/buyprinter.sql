-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 04. Okt 2017 um 23:02
-- Server Version: 5.5.57-0+deb8u1
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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ean_database`
--

CREATE TABLE IF NOT EXISTS `ean_database` (
`id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `item_ean` text NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_without_name` int(11) NOT NULL DEFAULT '0',
  `name_updated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ean_database`
--

INSERT INTO `ean_database` (`id`, `item_name`, `item_ean`, `insert_date`, `insert_without_name`, `name_updated`) VALUES
(68, 'Windowmarker, edding 4095, 2-3 mm', '4004764788002', '2017-10-04 22:24:04', 0, 0),
(69, 'Litze LiY 1 x 0.14 mmÂ² Gruen Conrad SH1902 100 m', '4016138721706', '2017-10-04 22:26:24', 0, 0),
(70, 'Pronto Classic M', '4000290001004', '2017-10-04 22:26:52', 0, 0),
(71, '10000 Blatt Universal Kopierpapier / Druckerpapier, 80g/m', '4011211029021', '2017-10-04 22:26:57', 0, 0),
(72, 'Clausthaler Extra Herb 0, 5', '4053400003504', '2017-10-04 22:35:22', 0, 0),
(73, 'FAIRY Ultra Konzentrat Zitrone', '8001090115188', '2017-10-04 22:37:59', 1, 1),
(74, 'Monin Karamell Sirup 0,7l', '4008077741518', '2017-10-04 22:38:40', 0, 0),
(75, 'Monin Vanille Sirup (1 8)', '4008077741211', '2017-10-04 22:38:57', 0, 0),
(76, 'Monin Amaretto Sirup 0,7 Ltr', '4008077741532', '2017-10-04 22:39:03', 0, 0),
(77, 'Monin Holunderblueten Sirup 0,25', '4008077744625', '2017-10-04 22:39:15', 0, 1),
(78, 'Diamant Feinster Zucker', '4008381145002', '2017-10-04 22:39:29', 0, 0),
(79, 'Diamant Weizenmehl Extra Typ 405 1kg', '4000406002758', '2017-10-04 22:40:13', 1, 1),
(80, 'Saupiquet Thunfisch Naturale', '3165957380012', '2017-10-04 22:40:36', 0, 0),
(81, 'Appel Heringsfilet Pfeffer', '4020500966091', '2017-10-04 22:41:34', 0, 0),
(82, 'Kuehne Kaeuter Condimento Baldamico Bianco Essig', '4012200168004', '2017-10-04 22:41:45', 1, 1),
(83, 'Teigwaren Lasagne  Barilla, 500 g', '8076809523738', '2017-10-04 22:42:44', 0, 0),
(84, 'Fine Life Kokosmilch 400ml', '4018905459225', '2017-10-04 22:42:55', 1, 1),
(85, 'Weihenstephan Naturjoghurt mild 3, 5% Fett', '4008452011007', '2017-10-04 22:43:33', 0, 0),
(86, 'Thomy Hollandaise, 250 g', '40056265', '2017-10-04 22:43:44', 0, 0),
(87, 'Tuffi Frische fettarme Milch 1,5% 1l', '4054700003102', '2017-10-04 22:43:56', 0, 1),
(88, 'Philadelphia Doppelrahm Kraeuter', '7622300318116', '2017-10-04 22:44:57', 0, 0),
(89, 'Kerrygold Irische Butter extra ungesalzen im Becher', '4001954165018', '2017-10-04 22:45:06', 0, 0),
(90, 'Rama 550g', '8714100750957', '2017-10-04 22:45:18', 1, 1),
(91, 'Leerdammer Original 7 Scheiben, 140g', '3073781053678', '2017-10-04 22:46:05', 0, 0),
(92, 'Heinz Tomato Ketchup 500ml', '8715700421698', '2017-10-04 22:46:14', 1, 1),
(93, 'Golden Toast Vollkorn', '4009249002482', '2017-10-04 22:46:51', 0, 0),
(94, 'Dr.Oetker Creme Fraiche Kr?uter 30% Fett', '4000521579302', '2017-10-04 22:47:03', 0, 0),
(95, 'Milfina Speisequark 250g', '22172242', '2017-10-04 22:47:23', 1, 1),
(97, 'Reichenhaller Jodsalz mit Fluor und Fols?ure', '4001475105609', '2017-10-04 22:48:53', 0, 0),
(98, 'Ferrero Nutella', '4008400404127', '2017-10-04 22:49:18', 0, 0),
(99, 'Dr.Oetker Original Pudding Schokolade 3er Packung', '4000521211011', '2017-10-04 22:49:38', 0, 0),
(100, 'Dr.Oetker Original Vanillepudding 3er Packung', '4000521200213', '2017-10-04 22:49:41', 0, 0),
(101, 'Dr.Oetker G', '4000521345303', '2017-10-04 22:49:52', 0, 0),
(102, 'Dr. Oetker Tortenguss rot 3er', '4000521165000', '2017-10-04 22:49:57', 0, 1),
(103, 'Dr.Oetker Original Backin Backpulver 10er Pk', '4000521103019', '2017-10-04 22:50:01', 0, 0),
(104, 'Dr. Oetker Blatt Gelantine Wei', '4000521741006', '2017-10-04 22:50:04', 0, 0),
(105, 'Mondamin Feine Speisest', '4046800111047', '2017-10-04 22:50:11', 0, 0),
(106, 'Diamant Weichweizengrie', '4008549045083', '2017-10-04 22:50:16', 0, 0),
(107, 'Dr. Oetker Kakao zum Backen 100g', '4000521005450', '2017-10-04 22:50:23', 0, 0),
(110, 'Corny nussvoll nuss-quartett St', '4011800548810', '2017-10-04 22:50:46', 0, 0),
(111, 'Ruf Haselnuss- Krokant Kuchen Backmischung', '4002809004346', '2017-10-04 22:50:52', 0, 0),
(113, 'Sarotti Kakao', '4030387044010', '2017-10-04 22:51:00', 0, 0),
(114, 'Mondamin Klassische Mehlschwitze dunkel', '4046800110132', '2017-10-04 22:51:04', 0, 0),
(115, 'Mondamin Fix Sossenbinder', '4046800110903', '2017-10-04 22:51:07', 0, 1),
(116, 'Bad Reichenhaller Markensalz', '4001475101601', '2017-10-04 22:51:12', 0, 0),
(117, 'Dr.Oetker Sahnesteif 5er Pk', '4000521170516', '2017-10-04 22:51:24', 0, 0),
(118, 'Dr.Oetker Butter Vanille Aroma 4er', '4000521144814', '2017-10-04 22:51:36', 0, 0),
(120, 'Dr.Oetker Creme Bullet', '4000521005641', '2017-10-04 22:51:41', 0, 1),
(121, 'Dr. Oetker Puddingpulver Sahne 3er', '4000521201319', '2017-10-04 22:51:45', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `print` int(11) NOT NULL DEFAULT '0',
  `printed` int(11) NOT NULL DEFAULT '0',
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_count` int(11) NOT NULL DEFAULT '1',
  `printerid` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `printers`
--

CREATE TABLE IF NOT EXISTS `printers` (
`id` int(11) NOT NULL,
  `printerid` int(11) NOT NULL DEFAULT '-1',
  `printername` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_printer` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `printers`
--

INSERT INTO `printers` (`id`, `printerid`, `printername`, `added`, `active_printer`) VALUES
(1, 1, 'Home', '2017-10-04 18:38:52', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ean_database`
--
ALTER TABLE `ean_database`
 ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT für Tabelle `ean_database`
--
ALTER TABLE `ean_database`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT für Tabelle `printers`
--
ALTER TABLE `printers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
