-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2020 at 07:36 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livreor`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES
(1, 'La pluie et le vent et la neige :\r\nil fait froid mais tes mix me réchauffent le coeur. Merci.', 1, '2020-11-24'),
(2, 'Nos âmes sont une âme par la fenêtre.', 4, '2020-11-24'),
(3, 'Tu seras toujours au fond de mon coeur, une plume d\'espoir insensée.', 9, '2020-11-24'),
(4, 'Je m\'entraîne seulement à te dire adieu.', 10, '2020-11-24'),
(5, 'Sous les nuages du temps, la brume matinale est aussi belle qu\'insensée.', 4, '2020-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'autumnrain', '$2y$10$TJkMp.NwrWh2eJOXstNS8eiiR2ZNtoN/n9D3ZWHtm2bXHe8pyZNKG'),
(2, 'blue', '$2y$10$6ozlePFTM/otJVNEPMsw/uhKm7uqRiO1Epz4ZtABNaXnuLX1Z2n9W'),
(3, 'red', '$2y$10$ca8F6h.fodySb2V1x/muyevFUnskGTThWNDHeUaZNcgqqROlSoNua'),
(4, 'pink', '$2y$10$oB4H7evWHwVbBACemm4/eO/i9oSUvc3i30O9wiXoluNFHv5y5s91a'),
(5, 'black', '$2y$10$BoncvLpRkIuw3uO7Dpb7B.MNZldbWV6TCL7tghq5tKox05iqtPQYe'),
(7, 'green', '$2y$10$jjB46BqbzFCDA7isgehoy.8U6CYqYJn0R/lMnzp228XWKfunxugt2'),
(9, 'noir', '$2y$10$3sBvBCMpBcKnxdeORVGtn.e.qOIpVYmUX.bowWNGaOpaI8s6teNdy'),
(10, 'yakushiji', '$2y$10$dMk4Ra4FtBuDu/BT96/XSeByejMSoUtCufbEnzOSySonzlGd1A2Su');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
