-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2016 at 09:52 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acit4850`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `Token` varchar(6) DEFAULT NULL,
  `Piece` varchar(5) DEFAULT NULL,
  `Player` varchar(20) DEFAULT NULL,
  `Datetime` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`Token`, `Piece`, `Player`, `Datetime`) VALUES
('1BB155', '11b-2', 'George', '2016.02.01-09:01:00'),
('1E654C', '11b-2', 'Mickey', '2016.02.01-09:01:02'),
('1DE9BB', '11b-2', 'Donald', '2016.02.01-09:01:04'),
('1BE8FA', '11c-0', 'George', '2016.02.01-09:01:06'),
('135745', '11a-0', 'Donald', '2016.02.01-09:01:08'),
('1A2EE5', '11c-0', 'Donald', '2016.02.01-09:01:10'),
('11F084', '11a-1', 'Donald', '2016.02.01-09:01:12'),
('1ADF71', '11a-1', 'George', '2016.02.01-09:01:14'),
('1C292C', '11b-0', 'George', '2016.02.01-09:01:16'),
('1E095A', '11c-2', 'Donald', '2016.02.01-09:01:18'),
('132956', '11c-0', 'George', '2016.02.01-09:01:20'),
('1359B6', '11a-0', 'Mickey', '2016.02.01-09:01:22'),
('139244', '11c-0', 'George', '2016.02.01-09:01:24'),
('12072C', '11c-0', 'Henry', '2016.02.01-09:01:26'),
('1C58FB', '11c-2', 'Donald', '2016.02.01-09:01:28'),
('11F0C5', '11b-1', 'George', '2016.02.01-09:01:30'),
('1AB11B', '11a-2', 'Henry', '2016.02.01-09:01:32'),
('1BB8CC', '11b-2', 'Henry', '2016.02.01-09:01:34'),
('14338A', '11c-0', 'George', '2016.02.01-09:01:36'),
('1D17DE', '11a-0', 'George', '2016.02.01-09:01:38'),
('17DC94', '11b-1', 'George', '2016.02.01-09:01:40'),
('1E5222', '11c-2', 'Donald', '2016.02.01-09:01:42'),
('19573B', '11a-2', 'Donald', '2016.02.01-09:01:44'),
('150417', '11b-2', 'Mickey', '2016.02.01-09:01:46'),
('1CA087', '11c-1', 'Mickey', '2016.02.01-09:01:48'),
('154281', '11c-0', 'Donald', '2016.02.01-09:01:50'),
('10DA3E', '11a-1', 'Mickey', '2016.02.01-09:01:52'),
('141117', '11c-2', 'Henry', '2016.02.01-09:01:54'),
('12268C', '11b-0', 'Mickey', '2016.02.01-09:01:56'),
('', '', 'khangeroo', '');

-- --------------------------------------------------------

--
-- Table structure for table `playerlogin`
--

CREATE TABLE `playerlogin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playerlogin`
--

INSERT INTO `playerlogin` (`username`, `password`, `avatar`) VALUES
('admin', 'P@$$w0rd', NULL),
('Mickey', 'bcit', NULL),
('Donald', 'bcit', NULL),
('George', 'bcit', NULL),
('Henry', 'bcit', NULL),
('khangeroo', 'bcit', NULL),
('dummy', 'bcit', NULL),
('anderson', 'bcit', 'troll'),
('trial1', 'bcit', 'troll');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `Player` varchar(20) DEFAULT NULL,
  `Peanuts` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`Player`, `Peanuts`) VALUES
('Mickey', 200),
('Donald', 35),
('George', 500),
('Henry', 100),
('khangeroo', 100),
('dummy', 100),
('anderson', 100),
('trial1', 100);

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `Series` int(2) DEFAULT NULL,
  `Description` varchar(16) DEFAULT NULL,
  `Frequency` int(3) DEFAULT NULL,
  `Value` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`Series`, `Description`, `Frequency`, `Value`) VALUES
(11, 'Basic house bots', 100, 20),
(13, 'House butlers', 50, 50),
(26, 'Home companions', 20, 200);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `DateTime` varchar(19) DEFAULT NULL,
  `Player` varchar(6) DEFAULT NULL,
  `Series` varchar(2) DEFAULT NULL,
  `Trans` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`DateTime`, `Player`, `Series`, `Trans`) VALUES
('2016.02.01-09:01:00', 'Mickey', '11', 'sell'),
('2016.02.01-09:01:05', 'Henry', 'x', 'buy'),
('2016.02.01-09:01:10', 'Mickey', 'x', 'buy'),
('2016.02.01-09:01:15', 'Donald', '13', 'sell'),
('2016.02.01-09:01:20', 'Donald', 'x', 'buy'),
('2016.02.01-09:01:25', 'Donald', 'x', 'buy'),
('2016.02.01-09:01:30', 'Donald', 'x', 'buy'),
('2016.02.01-09:01:35', 'Donald', 'x', 'buy'),
('2016.02.01-09:01:40', 'Henry', 'x', 'buy'),
('2016.02.01-09:01:45', 'Donald', '22', 'sell'),
('2016.02.01-09:01:50', 'George', '11', 'sell'),
('2016.02.01-09:01:55', 'George', 'x', 'buy'),
('2016.02.01-09:01:60', 'George', 'x', 'buy');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
