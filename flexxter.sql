-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 10:56 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flexxter`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `EmployeeID` int(11) NOT NULL,
  `Surname` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`EmployeeID`, `Surname`, `Password`, `Email`) VALUES
(1, 'Sandy', 'sandy123', 'sandy125@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblmachines`
--

CREATE TABLE `tblmachines` (
  `MachineID` int(11) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `borrowed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmachines`
--

INSERT INTO `tblmachines` (`MachineID`, `Title`, `EmployeeID`, `borrowed`) VALUES
(125, 'driller', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `tblmachines`
--
ALTER TABLE `tblmachines`
  ADD PRIMARY KEY (`MachineID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblmachines`
--
ALTER TABLE `tblmachines`
  ADD CONSTRAINT `tblmachines_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `tblemployees` (`EmployeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
