-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 dec 2017 om 06:58
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
  `description` varchar(50) NOT NULL,
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
(1012, 'ijzer', 0, 20, 9999, 'Small_items_warehouse', 0),
(1013, 'Money box', 3411, 2, 10000, 'Secured', 0),
(1014, 'steel', 32, 38, 9999, 'Small_items_warehouse', 0),
(1015, 'bouten M6', 1002, 200, 9999, 'Small_items_warehouse', 0),
(1016, 'M10 moeren thickness 2 mm', 7600, 5000, 9999, 'Small_items_warehouse', 0),
(1017, 'Plat ijzer 6 meter 20x6mm', 26, 13, 9999, 'Bulk_warehouse', 0),
(1018, 'staf', 8920, 18, 9999, 'Small_items_warehouse', 0),
(1019, 'Laselectroden', 7975, 500, 10000, 'Temp_controled', 0),
(1020, 'washer 30 x 10 thick 4', 245, 200, 9999, 'Small_items_warehouse', 0),
(1021, 'M30 x 60 bold', 90, 55, 90, 'Bulk_warehouse', 0),
(1022, 'M22 nuts', 500, 500, 8000, 'Small_items_warehouse', 0),
(1023, 'Showval Carterpilar', 1, 1, 4, 'Bulk_warehouse', 0),
(1024, 'zand', 300, 100, 25000, 'Bulk_warehouse', 0),
(1025, 'Grind Grof', -500, 100, 9999, 'Bulk_warehouse', 0);

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
(6, 'order van veel ijzerwaren', '2017-11-27', '2017-11-28', 'Meijn'),
(7, 'ijzer', '2017-11-27', '2017-11-27', 'Meijn'),
(8, 'order voor perenboom', '2017-12-10', '2017-12-13', 'KCS'),
(9, 'Order van ijzer van jan', '2017-11-29', '2017-11-30', 'Meijn'),
(10, 'schroeven en moeren voor de achterban', '2017-11-29', '2017-12-13', 'KLM'),
(11, 'order met ijzer en helium', '2017-11-22', '2017-11-30', 'KLM'),
(12, 'Order voor belangerijke klant', '2017-11-29', '2017-12-11', 'Schiphol'),
(13, 'order voor money transfer boxes', '2017-12-04', '2017-12-06', 'Meijn'),
(14, 'nutsz', '2017-11-30', '2017-11-30', 'KCS'),
(15, 'Veel zand en grind', '2017-12-01', '2017-12-02', 'Schiphol'),
(16, 'Grind', '2017-12-01', '2017-12-08', 'Schiphol'),
(17, 'flat  steel ', '2017-12-03', '2017-12-10', 'Schiphol');

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
(7, 1012, 19, ''),
(7, 1014, 5, ''),
(7, 1015, 66, ''),
(7, 1016, 16, ''),
(7, 1017, 17, ''),
(8, 1014, 2, ''),
(9, 1013, 13, 'dertien order 9'),
(9, 1015, 55, ''),
(9, 1018, 99, ''),
(10, 1013, 14, ''),
(10, 1016, 199, ''),
(10, 1020, 5, ''),
(11, 1012, 3, ''),
(11, 1015, 85, ''),
(12, 1012, 36, ''),
(12, 1016, 200, ''),
(12, 1021, 17, ''),
(13, 1013, 8, ''),
(14, 1022, 500, ''),
(14, 1023, 1, ''),
(15, 1024, 1500, ''),
(15, 1025, 2500, '');

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
  MODIFY `item` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1026;

--
-- AUTO_INCREMENT voor een tabel `order`
--
ALTER TABLE `order`
  MODIFY `order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
