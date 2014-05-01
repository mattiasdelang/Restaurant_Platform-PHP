-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 01 mei 2014 om 22:55
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `rest_app`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback` text NOT NULL,
  `score` int(11) NOT NULL,
  `tijd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fshow` tinyint(1) NOT NULL DEFAULT '1',
  `rshow` tinyint(1) NOT NULL DEFAULT '1',
  `restaurantid` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Gegevens worden uitgevoerd voor tabel `feedback`
--

INSERT INTO `feedback` (`id`, `feedback`, `score`, `tijd`, `fshow`, `rshow`, `restaurantid`, `ownerid`) VALUES
(42, 'tof', 10, '2014-05-01 20:21:29', 0, 1, 3, 60),
(43, 'cdc', 10, '2014-05-01 20:21:32', 1, 1, 3, 60),
(44, 'cdc', 10, '2014-05-01 20:41:28', 1, 1, 3, 60),
(45, 'vfv', 2, '2014-05-01 20:50:34', 1, 1, 3, 60);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `prijs` decimal(5,2) NOT NULL,
  `showmenu` tinyint(1) NOT NULL DEFAULT '1',
  `restaurantid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `menu`
--

INSERT INTO `menu` (`id`, `naam`, `omschrijving`, `type`, `prijs`, `showmenu`, `restaurantid`) VALUES
(7, 'fezfezf', 'fdfsf', 'Voorgerecht', '12.00', 0, 3),
(8, 'kjg', 'h;hj;', 'Voorgerecht', '12.00', 0, 4),
(9, 'i', ':kj:jk:', 'Voorgerecht', '12.00', 1, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` text NOT NULL,
  `adres` text NOT NULL,
  `gemeente` text NOT NULL,
  `specialiteit` text NOT NULL,
  `website` text NOT NULL,
  `facebook` text NOT NULL,
  `mail` text NOT NULL,
  `telnr` text NOT NULL,
  `maandag` text NOT NULL,
  `dinsdag` text NOT NULL,
  `woensdag` text NOT NULL,
  `donderdag` text NOT NULL,
  `vrijdag` text NOT NULL,
  `zaterdag` text NOT NULL,
  `zondag` text NOT NULL,
  `restaurantownerid` int(11) NOT NULL,
  `showres` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `restaurant`
--

INSERT INTO `restaurant` (`id`, `naam`, `adres`, `gemeente`, `specialiteit`, `website`, `facebook`, `mail`, `telnr`, `maandag`, `dinsdag`, `woensdag`, `donderdag`, `vrijdag`, `zaterdag`, `zondag`, `restaurantownerid`, `showres`) VALUES
(3, 't spaans dak', 'zoetwaterdreef 12', 'oud-heverlee', 'omelet nature', 'www.spaansdak.be', 'www.facebook.com/spaansdak', 'mattiasdelang@hotmail.com', '01635926', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', 'open', 60, 1),
(4, 't spaans dak', 'zoetwaterdreef 12', 'Oud-Heverlee', 'omelet nature', 'www.spaansdak.be', 'www.facebook.com/spaansdak', 'mattiasdelang@hotmail.com', '0', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', 60, 1),
(5, 'Test', 'test', 'test', 'test', 'test', 'test', 'test@test.com', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 60, 1),
(6, 't spaans dak', 'cs', 'qc', 'c', 's', 'qc', 'mattiasdelang@hotmail.com', 'cs', 'csq', 'csqcqsc', 'csq', 'c', 'sqc', 'q', 'sq', 60, 1),
(7, 'gn', 'gfn', 'fgn', 'fgnfgn', 'fgnfg', 'nfgn', 'mattiasdelang@hotmail.com', 'fgn', 'ngfn', 'fgnfgn', 'gfn', 'nngfng', 'gf', 'n', 'gfn', 60, 1),
(8, 'vbf', 'vfdv', 'dvdfvfd', 'fdvfd', 'vdfv', 'fd', 'mattiasdelang@hotmail.com', 'vdfvdv', 'vfdvdfv', 'fdvdfv', 'fdv', 'fd', 'vfddv', 'vdv', 'fvdvdf', 60, 1),
(9, 'vbf', 'vfdv', 'dvdfvfd', 'fdvfd', 'vdfv', 'fd', 'mattiasdelang@hotmail.com', 'vdfvdv', 'vfdvdfv', 'fdvdfv', 'fdv', 'fd', 'vfddv', 'vdv', 'fvdvdf', 60, 1),
(10, 'gn', 'gfn', 'fgn', 'fgnfgn', 'fgnfg', 'nfgn', 'mattiasdelang@hotmail.com', 'fgn', 'ngfn', 'fgnfgn', 'gfn', 'nngfng', 'gf', 'n', 'gfn', 60, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `restaurantowner`
--

CREATE TABLE IF NOT EXISTS `restaurantowner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `randomnr` varchar(255) NOT NULL,
  `verif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Gegevens worden uitgevoerd voor tabel `restaurantowner`
--

INSERT INTO `restaurantowner` (`id`, `firstname`, `lastname`, `email`, `password`, `randomnr`, `verif`) VALUES
(60, 'mattias', 'delang', 'mattiasdelang@hotmail.com', '64ebaa3c197068d305d7fa4c7d186eb5', 't5a21bb59cbd6d3bce340adfc8b2b416', 1),
(61, 'mattias', 'delang', 'mattiasdelang@gmail.com', '64ebaa3c197068d305d7fa4c7d186eb5', 'Hea7146e4f7a1135f939a875ea336c30', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tafel`
--

CREATE TABLE IF NOT EXISTS `tafel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tafelnummer` int(11) NOT NULL,
  `plaatsen` int(11) NOT NULL,
  `restaurantid` int(11) NOT NULL,
  `ownerid` int(11) NOT NULL,
  `tafelshow` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Gegevens worden uitgevoerd voor tabel `tafel`
--

INSERT INTO `tafel` (`id`, `tafelnummer`, `plaatsen`, `restaurantid`, `ownerid`, `tafelshow`) VALUES
(16, 2, 5, 3, 60, 1),
(17, 3, 2, 3, 60, 0),
(18, 1, 2, 3, 60, 1),
(19, 5, 6, 3, 60, 1),
(20, 5, 6, 3, 60, 1),
(21, 2, 2, 4, 60, 0),
(22, 2, 3, 4, 60, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
