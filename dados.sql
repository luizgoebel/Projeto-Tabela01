-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Out-2020 às 21:42
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tabelaj`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados`
--

CREATE TABLE IF NOT EXISTS `dados` (
  `jogo` int(11) NOT NULL AUTO_INCREMENT,
  `placar` varchar(11) DEFAULT NULL,
  `MinT` int(11) DEFAULT NULL,
  `MaxT` int(11) DEFAULT NULL,
  `QrMin` int(11) DEFAULT NULL,
  `QrMax` int(11) DEFAULT NULL,
  `isRecord` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`jogo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `dados`
--

INSERT INTO `dados` (`jogo`, `placar`, `MinT`, `MaxT`, `QrMin`, `QrMax`, `isRecord`) VALUES
(1, '12', 12, 12, 0, 0, 1),
(2, '24', 12, 24, 0, 1, 1),
(3, '10', 10, 24, 1, 1, 1),
(4, '24', 10, 24, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
