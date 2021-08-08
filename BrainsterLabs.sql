-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 09:18 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brainsterlabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `studentapplication`
--

DROP TABLE IF EXISTS `studentapplication`;
CREATE TABLE `studentapplication` (
  `Id` int(10) UNSIGNED NOT NULL,
  `FullName` text NOT NULL,
  `CompanyName` text NOT NULL,
  `Email` text NOT NULL,
  `Telephone` int(20) NOT NULL,
  `StudentType` text CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentapplication`
--

INSERT INTO `studentapplication` (`Id`, `FullName`, `CompanyName`, `Email`, `Telephone`, `StudentType`) VALUES
(1, 'Aleksandra Mickoska', 'Endava', 'mickoskaaleksandra1@gmail.com', 78285552, 'Студент од маркетинг'),
(4, 'Tomce Mitrov', 'Vip', 'mitrov@gmail.com', 78, 'Студент од програмирање'),
(5, 'Riste Jovanov', 'ATS', 'jovanovriste@outlook.com', 70, ''),
(6, 'Petre Petreski', 'PCOM', 'companyy@gmail.com', 987, 'Студент од програмирање'),
(10, 'Mitre', 'MIIICOM', 'mitre@gmail', 134, '');

-- --------------------------------------------------------

--
-- Table structure for table `studenttype`
--

DROP TABLE IF EXISTS `studenttype`;
CREATE TABLE `studenttype` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studenttype`
--

INSERT INTO `studenttype` (`Id`, `Type`) VALUES
(1, 'Студент од маркетинг'),
(2, 'Студент од програмирање'),
(3, 'Студент од дизајн'),
(4, 'Студент од data sciense');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentapplication`
--
ALTER TABLE `studentapplication`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `studenttype`
--
ALTER TABLE `studenttype`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentapplication`
--
ALTER TABLE `studentapplication`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studenttype`
--
ALTER TABLE `studenttype`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
