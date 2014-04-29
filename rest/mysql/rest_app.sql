-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 29 apr 2014 om 19:05
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
  `showres` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `restaurant`
--

INSERT INTO `restaurant` (`id`, `naam`, `adres`, `gemeente`, `specialiteit`, `website`, `facebook`, `mail`, `telnr`, `maandag`, `dinsdag`, `woensdag`, `donderdag`, `vrijdag`, `zaterdag`, `zondag`, `restaurantownerid`, `showres`) VALUES
(3, 't spaans dak', 'zoetwaterdreef 12', 'oud-heverlee', 'omelet nature', 'www.spaansdak.be', 'www.facebook.com/spaansdak', 'mattiasdelang@hotmail.com', '01635926', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', 'gesloten', 60, 0),
(4, 't spaans dak', 'zoetwaterdreef 12', 'oud-heverlee', 'omelet nature', 'www.spaansdak.be', 'www.facebook.com/spaansdak', 'mattiasdelang@hotmail.com', '01635926', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', '10.00-12.00/15.30-21.00', 60, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Gegevens worden uitgevoerd voor tabel `restaurantowner`
--

INSERT INTO `restaurantowner` (`id`, `firstname`, `lastname`, `email`, `password`, `randomnr`, `verif`) VALUES
(60, 'mattias', 'delang', 'mattiasdelang@hotmail.com', '64ebaa3c197068d305d7fa4c7d186eb5', 't5a21bb59cbd6d3bce340adfc8b2b416', 1);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `tafel`
--

INSERT INTO `tafel` (`id`, `tafelnummer`, `plaatsen`, `restaurantid`, `ownerid`) VALUES
(1, 5, 3, 1, 1),
(2, 5, 4, 1, 1),
(3, 5, 6, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
