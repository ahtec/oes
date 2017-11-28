-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 nov 2017 om 20:09
-- Serverversie: 10.1.28-MariaDB
-- PHP-versie: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oes`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `item`
--

CREATE TABLE `item` (
  `item` int(8) NOT NULL,
  `description` varchar(30) NOT NULL,
  `stock` int(8) NOT NULL,
  `minStock` int(8) NOT NULL,
  `maxStock` int(8) NOT NULL,
  `warehouse` varchar(50) NOT NULL,
  `delTime` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `item`
--

INSERT INTO `item` (`item`, `description`, `stock`, `minStock`, `maxStock`, `warehouse`, `delTime`) VALUES
(1012, 'Helium gas', 8, 2, 9999, 'Temp_controled', 0),
(1013, 'Money transfer box', 3, 2, 9999, 'Secured', 0),
(1014, '101410141014', 24, 40, 9999, 'Bulk_warehouse', 0),
(1015, 'bouten M6', 500, 200, 9999, 'Small_items_warehouse', 0),
(1016, 'M10 moeren', 8000, 5000, 9999, 'Small_items_warehouse', 0),
(1017, 'Plat ijzer 6 meter 20x6mm', 24, 13, 9999, 'Bulk_warehouse', 0),
(1018, 'staf round 20 length 6000', 1, 17, 9999, 'Small_items_warehouse', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order`
--

CREATE TABLE `order` (
  `order` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `orderDate` date NOT NULL,
  `delDate` date NOT NULL,
  `customer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `order`
--

INSERT INTO `order` (`order`, `description`, `orderDate`, `delDate`, `customer`) VALUES
(6, 'm10 bouten', '2017-11-27', '2017-11-28', 'Schiphol'),
(7, 'M10 moeren', '2017-11-27', '2017-11-30', 'KCS'),
(8, 'm8 moeren', '2017-12-10', '2017-12-13', 'KCS'),
(9, 'm4', '2017-11-29', '2017-11-30', 'Schiphol'),
(10, 'M6 Bouten ', '2017-11-29', '2017-11-30', 'KLM'),
(11, 'M12 moeren', '2017-11-22', '2017-11-30', 'Schiphol');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orderlines`
--

CREATE TABLE `orderlines` (
  `order` int(11) NOT NULL,
  `item` int(8) NOT NULL,
  `amount` int(8) NOT NULL,
  `lineText` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `orderlines`
--

INSERT INTO `orderlines` (`order`, `item`, `amount`, `lineText`) VALUES
(6, 1012, 100, '100 items voor odrer 6'),
(7, 1012, 5, ''),
(7, 1013, 5, ''),
(7, 1014, 5, ''),
(7, 1015, 5, ''),
(9, 1013, 13, 'dertien order 9'),
(9, 1015, 55, ''),
(11, 1012, 5, '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item`);

--
-- Indexen voor tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order`);

--
-- Indexen voor tabel `orderlines`
--
ALTER TABLE `orderlines`
  ADD PRIMARY KEY (`order`,`item`) USING BTREE;

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `item`
--
ALTER TABLE `item`
  MODIFY `item` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1019;

--
-- AUTO_INCREMENT voor een tabel `order`
--
ALTER TABLE `order`
  MODIFY `order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
