-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: remotemysql.com
-- Generation Time: Jun 16, 2022 at 02:35 PM
-- Server version: 8.0.13-4
-- PHP Version: 7.3.33-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `forwarded_record`
--

CREATE TABLE `forwarded_record` (
  `forward_id` int(50) NOT NULL,
  `project_ID` int(50) NOT NULL,
  `fhod_ID` int(50) DEFAULT '1',
  `hod_ID` int(50) NOT NULL,
  `project_TITLE` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `project_date` date NOT NULL,
  `project_BATCH` int(50) NOT NULL,
  `project_COURSE` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `project_COMMENT` varchar(50) CHARACTER SET utf8 COLLATE utf8mb4_general_ci NOT NULL,
  `project_STATUS` tinyint(1) NOT NULL,
  `project_file` varchar(100) COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forwarded_record`
--


-- --------------------------------------------------------

--
-- Table structure for table `hod_record`
--

CREATE TABLE `hod_record` (
  `hod_ID` int(11) NOT NULL,
  `hod_FIRST_NAME` varchar(50) NOT NULL,
  `hod_LAST_NAME` varchar(50) NOT NULL,
  `hod_EMAIL` varchar(50) NOT NULL,
  `hod_DEPT` varchar(30) NOT NULL,
  `hod_PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hod_record`
--

INSERT INTO `hod_record` (`hod_ID`, `hod_FIRST_NAME`, `hod_LAST_NAME`, `hod_EMAIL`, `hod_DEPT`, `hod_PASSWORD`) VALUES
(1, 'Anshu', 'Bhasin', 'anshubasin@hod.com', 'CSE', '1234'),
(2, 'Dinesh', 'Gupta', 'dgupta@hod.com', 'CSE', '1234'),
(3, 'Raman', 'Kumar', 'ramankumar@hod.com', 'CSE', '1234'),
(4, 'Pooja', 'Sharma', 'psharma@hod.com', 'CSE', '1234'),
(5, 'Navdeepak', 'Sandhu', 'ndeepak@hod.com', 'IIC', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `project_notification`
--

CREATE TABLE `project_notification` (
  `notification_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hod_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_notification`
--

INSERT INTO `project_notification` (`notification_id`, `project_id`, `student_id`, `hod_id`, `seen`) VALUES
(7, 1, 1, 1, 1),
(8, 3, 1, 1, 1),
(9, 3, 1, 1, 1),
(10, 1, 1, 1, 1),
(11, 3, 1, 1, 1),
(12, 5, 1, 1, 1),
(13, 3, 1, 1, 1),
(14, 5, 1, 1, 1),
(15, 5, 1, 1, 1),
(16, 5, 1, 1, 1),
(17, 5, 1, 1, 0),
(18, 5, 1, 1, 1),
(19, 5, 1, 1, 0),
(20, 5, 1, 1, 0),
(21, 5, 1, 1, 1),
(22, 5, 1, 1, 1),
(23, 7, 1, 5, 1),
(24, 6, 1, 1, 1),
(25, 6, 1, 1, 0),
(26, 8, 1, 1, 0),
(27, 8, 1, 1, 0),
(28, 5, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_record`
--

CREATE TABLE `project_record` (
  `project_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `hod_ID` int(11) NOT NULL,
  `project_TITLE` varchar(50) NOT NULL,
  `project_date` date NOT NULL,
  `project_PROFESSOR` varchar(50) DEFAULT NULL,
  `project_BATCH` int(11) NOT NULL,
  `project_COURSE` varchar(50) NOT NULL,
  `project_COMMENT` varchar(500) DEFAULT NULL,
  `project_STATUS` tinyint(1) NOT NULL DEFAULT '0',
  `project_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_record`
--



-- --------------------------------------------------------

--
-- Table structure for table `student_hod_chat`
--

CREATE TABLE `student_hod_chat` (
  `message_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hod_id` int(11) NOT NULL,
  `message_body` varchar(400) NOT NULL,
  `message_sender` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_hod_chat`
--

INSERT INTO `student_hod_chat` (`message_id`, `student_id`, `hod_id`, `message_body`, `message_sender`) VALUES
(1, 1, 1, 'Hello Sir!', 's'),
(2, 1, 1, 'Yes, How can I help you?', 'h'),
(3, 1, 1, 'Can You Please Guide me about The Project?', 's'),
(4, 1, 1, 'What Do you need my Help With?', 'h'),
(5, 1, 1, 'Can You please Tell me how do I do such things?', 's'),
(6, 2, 1, 'Can You please Enlighten me about your project?', 'h'),
(7, 2, 1, 'Hi Sir, how do you like my project?', 's'),
(8, 1, 1, 'Good Evening Sir!', 's');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_general_ci;

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
(10, 'sineshkumarr@gmail.com', 'Sinesh', 'Kumar', 'Sinesh2ele', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forwarded_record`
--
ALTER TABLE `forwarded_record`
  ADD KEY `forward_id` (`forward_id`,`project_ID`,`fhod_ID`,`hod_ID`,`project_TITLE`,`project_date`,`project_BATCH`,`project_COURSE`,`project_COMMENT`,`project_STATUS`);

--
-- Indexes for table `hod_record`
--
ALTER TABLE `hod_record`
  ADD PRIMARY KEY (`hod_ID`),
  ADD UNIQUE KEY `hod_EMAIL` (`hod_EMAIL`);

--
-- Indexes for table `project_notification`
--
ALTER TABLE `project_notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `project_record`
--
ALTER TABLE `project_record`
  ADD PRIMARY KEY (`project_ID`);

--
-- Indexes for table `student_hod_chat`
--
ALTER TABLE `student_hod_chat`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `student_record`
--
ALTER TABLE `student_record`
  ADD PRIMARY KEY (`student_ID`),
  ADD UNIQUE KEY `student_EMAIL` (`student_EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--AUTO_INCREMENT for table `forwarded_record`
ALTER TABLE `forwarded_record`
  MODIFY `forward_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;


-- AUTO_INCREMENT for table `hod_record`
--
ALTER TABLE `hod_record`
  MODIFY `hod_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_notification`
--
ALTER TABLE `project_notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `project_record`
--
ALTER TABLE `project_record`
  MODIFY `project_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `student_hod_chat`
--
ALTER TABLE `student_hod_chat`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
