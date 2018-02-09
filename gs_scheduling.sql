-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2018 at 09:57 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_scheduling`
--

-- --------------------------------------------------------

--
-- Table structure for table `gs_account`
--

CREATE TABLE `gs_account` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `type` varchar(6) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gs_building`
--

CREATE TABLE `gs_building` (
  `id` int(11) NOT NULL,
  `bldg` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gs_building`
--

INSERT INTO `gs_building` (`id`, `bldg`) VALUES
(9, 'asdasd'),
(11, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `gs_faculty`
--

CREATE TABLE `gs_faculty` (
  `id` int(11) NOT NULL,
  `idno` varchar(20) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gs_option`
--

CREATE TABLE `gs_option` (
  `id` int(11) NOT NULL,
  `gsoption` varchar(99) NOT NULL,
  `value` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gs_option`
--

INSERT INTO `gs_option` (`id`, `gsoption`, `value`) VALUES
(1, 'Dean', 'INICIA C. BANSIG, Ph.D.'),
(2, 'vp', 'AGRIPINA MARIBBAY, Ph.D.'),
(3, 'active_year', '2017-2018'),
(4, 'active_term', 'third semester');

-- --------------------------------------------------------

--
-- Table structure for table `gs_program`
--

CREATE TABLE `gs_program` (
  `id` int(11) NOT NULL,
  `short` varchar(10) NOT NULL,
  `program` varchar(250) NOT NULL,
  `specialization` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gs_program`
--

INSERT INTO `gs_program` (`id`, `short`, `program`, `specialization`) VALUES
(21, 'MIT', 'Master in Information Technology', 'System Development'),
(22, 'asd', 'asd', 'wwww');

-- --------------------------------------------------------

--
-- Table structure for table `gs_rooms`
--

CREATE TABLE `gs_rooms` (
  `id` int(11) NOT NULL,
  `room` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `bldg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gs_rooms`
--

INSERT INTO `gs_rooms` (`id`, `room`, `type`, `bldg`) VALUES
(6, 'werw', 'Laboratory', 2),
(7, 'wer', 'Laboratory', 2),
(8, 'werwqer', 'Lecture', 3),
(9, 'LR23', 'Laboratory', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gs_scheduling`
--

CREATE TABLE `gs_scheduling` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `units` tinyint(2) NOT NULL,
  `sched` varchar(50) NOT NULL,
  `room` varchar(15) NOT NULL,
  `professor` varchar(150) NOT NULL,
  `term` varchar(20) NOT NULL,
  `year` varchar(9) NOT NULL,
  `programid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gs_subject`
--

CREATE TABLE `gs_subject` (
  `id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `title` varchar(150) NOT NULL,
  `units` int(2) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `program` int(11) NOT NULL,
  `type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gs_subject`
--

INSERT INTO `gs_subject` (`id`, `code`, `title`, `units`, `remarks`, `program`, `type`) VALUES
(1, 'INS 201', 'Pauline Ethics', 3, 'for Non-Paulinian Graduate', 0, 'Institutional Course'),
(4, 'MIT 301', 'advance Operating Systems and Networking', 3, '', 21, 'Major Courses');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_account`
--
ALTER TABLE `gs_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_building`
--
ALTER TABLE `gs_building`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_faculty`
--
ALTER TABLE `gs_faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_option`
--
ALTER TABLE `gs_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_program`
--
ALTER TABLE `gs_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_rooms`
--
ALTER TABLE `gs_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_scheduling`
--
ALTER TABLE `gs_scheduling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_subject`
--
ALTER TABLE `gs_subject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_account`
--
ALTER TABLE `gs_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_building`
--
ALTER TABLE `gs_building`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gs_faculty`
--
ALTER TABLE `gs_faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_option`
--
ALTER TABLE `gs_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gs_program`
--
ALTER TABLE `gs_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `gs_rooms`
--
ALTER TABLE `gs_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gs_scheduling`
--
ALTER TABLE `gs_scheduling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_subject`
--
ALTER TABLE `gs_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
