-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2022 at 06:21 PM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ADWeeGgUDv`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_record`
--

CREATE TABLE `student_record` (
  `student_ID` int(11) NOT NULL,
  `student_EMAIL` varchar(50) NOT NULL,
  `student_FIRST_NAME` varchar(50) NOT NULL,
  `student_LAST_NAME` varchar(50) NOT NULL,
  `student_PASSWORD` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_record`
--

INSERT INTO `student_record` (`student_ID`, `student_EMAIL`, `student_FIRST_NAME`, `student_LAST_NAME`, `student_PASSWORD`, `status`) VALUES
(1, 'daman42a@gmail.com', 'Damanjot', 'Singh', '12345', 1),
(2, 'Rahulpreet936@gmail.com', 'Rahulpreet', 'Singh', '12345', 1),
(3, 'hartej@student.com', 'Hartej', 'Singh', '12345', 1),
(4, 'damansingh@gmail.com', 'Damandeep', 'Singh', '12345', 1),
(6, 'japneetsingh@gmail.com', 'Japneet', 'Singh', '12345', 1),
(7, 'jatiny@gmail.com', 'Jatin', 'Yadav', '12345', 1),
(8, 'sahilcheema@gmail.com', 'Sahil', 'Chemma', '12345', 0),
(9, 'apoorvk@gmail.com', 'Apoorv', 'Kumar', '12345', 1),
(10, 'sineshkumarr@gmail.com', 'Sinesh', 'Kumar', 'Sinesh2ele', 1),
(11, 'kkumar@student.com', 'Pankaj', 'Kumar', '12345', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_record`
--
ALTER TABLE `student_record`
  ADD PRIMARY KEY (`student_ID`),
  ADD UNIQUE KEY `student_EMAIL` (`student_EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
