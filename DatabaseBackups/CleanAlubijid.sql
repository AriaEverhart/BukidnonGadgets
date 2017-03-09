-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2016 at 03:18 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DummyAlubijid`
--

-- --------------------------------------------------------

--
-- Table structure for table `community_organization`
--

CREATE TABLE `community_organization` (
  `Community_ID` int(11) NOT NULL,
  `Community_Name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `community_organization`
--

INSERT INTO `community_organization` (`Community_ID`, `Community_Name`) VALUES
(1, 'Religious'),
(2, 'Youth'),
(3, 'Cultural'),
(4, 'Political'),
(5, 'Womens'),
(6, 'Agricultural'),
(7, 'Labor'),
(8, 'Civic'),
(9, 'Cooperatives'),
(10, 'Senior Citizens'),
(11, 'Others'),
(12, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `nutritional_status`
--

CREATE TABLE `nutritional_status` (
  `Nutrition_ID` int(11) NOT NULL,
  `Nutrition_Description` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nutritional_status`
--

INSERT INTO `nutritional_status` (`Nutrition_ID`, `Nutrition_Description`) VALUES
(1, 'Above Normal'),
(2, 'Normal'),
(3, 'Below Normal(moderate)'),
(4, 'Below Normal(severe)'),
(5, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `other_comm_orgs`
--

CREATE TABLE `other_comm_orgs` (
  `Other_ID` int(11) NOT NULL,
  `Other_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `Resident_ID` int(11) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Age` int(3) DEFAULT NULL,
  `Registered_Voter` varchar(2) DEFAULT NULL,
  `Voted` varchar(2) DEFAULT NULL,
  `Nutrition_ID` int(10) DEFAULT NULL,
  `Community_ID` int(10) DEFAULT NULL,
  `Other_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `community_organization`
--
ALTER TABLE `community_organization`
  ADD PRIMARY KEY (`Community_ID`);

--
-- Indexes for table `nutritional_status`
--
ALTER TABLE `nutritional_status`
  ADD PRIMARY KEY (`Nutrition_ID`);

--
-- Indexes for table `other_comm_orgs`
--
ALTER TABLE `other_comm_orgs`
  ADD PRIMARY KEY (`Other_ID`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`Resident_ID`),
  ADD KEY `Nutrition_ID` (`Nutrition_ID`),
  ADD KEY `Community_ID` (`Community_ID`),
  ADD KEY `Other_ID` (`Other_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `community_organization`
--
ALTER TABLE `community_organization`
  MODIFY `Community_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `nutritional_status`
--
ALTER TABLE `nutritional_status`
  MODIFY `Nutrition_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `other_comm_orgs`
--
ALTER TABLE `other_comm_orgs`
  MODIFY `Other_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `Resident_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `resident`
--
ALTER TABLE `resident`
  ADD CONSTRAINT `resident_ibfk_1` FOREIGN KEY (`Nutrition_ID`) REFERENCES `nutritional_status` (`Nutrition_ID`),
  ADD CONSTRAINT `resident_ibfk_2` FOREIGN KEY (`Community_ID`) REFERENCES `community_organization` (`Community_ID`),
  ADD CONSTRAINT `resident_ibfk_3` FOREIGN KEY (`Other_ID`) REFERENCES `other_comm_orgs` (`Other_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
