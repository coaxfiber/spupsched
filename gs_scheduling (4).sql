-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2018 at 05:30 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

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
  `status` varchar(10) NOT NULL,
  `progname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gs_faculty`
--

INSERT INTO `gs_faculty` (`id`, `idno`, `ext`, `fname`, `mname`, `lname`, `status`, `progname`) VALUES
(1, '22', 'MR.', '2', '22', '22', 'Inactive', 'MIT');

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
(1, 'dean', 'INICIA C. BANSIG, Ph.D.'),
(2, 'vp', 'AGRIPINA MARIBBAY, Ph.D.'),
(3, 'active_year', '2017 - 2018'),
(4, 'active_term', 'Third Semester'),
(5, 'active_start', '2018-01-10');

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
(21, 'MIT-IM', 'Master in Information Technology', 'System Development'),
(22, 'MITSD', 'Master in Information Technology', 'Information Management'),
(27, 'MLIS', 'Master in Library Information Science', '');

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
  `time` varchar(30) NOT NULL,
  `room` varchar(15) NOT NULL,
  `professor` varchar(150) NOT NULL,
  `term` varchar(25) NOT NULL,
  `year` varchar(20) NOT NULL,
  `programid` int(11) NOT NULL,
  `start` date NOT NULL,
  `position` tinyint(4) NOT NULL,
  `merge` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gs_scheduling`
--

INSERT INTO `gs_scheduling` (`id`, `code`, `title`, `units`, `sched`, `time`, `room`, `professor`, `term`, `year`, `programid`, `start`, `position`, `merge`) VALUES
(83, 'MIT 301', 'Advance Operating Systems and Networking', 3, '', '', '', '', 'Third Semester', '2017 - 2018', 22, '0000-00-00', 0, ''),
(87, 'INS 201', 'Pauline Ethics', 3, '', '8:30-12/1:30-5', '', '', 'Third Semester', '2017 - 2018', 22, '0000-00-00', 0, ''),
(88, 'MIT 302', 'Advance Database System', 3, '', '8:30-12/1:30-5', '', '', 'Third Semester', '2017 - 2018', 22, '0000-00-00', 0, ''),
(89, 'MIT 303', 'Advanced Systems Design and Implementation', 3, '', '8:30-12/1:30-5', '', '', 'Third Semester', '2017 - 2018', 22, '0000-00-00', 0, ''),
(90, 'MIT 304', 'Global Information Technology &amp; Project Management', 3, '', '8:30-12/1:30-5', '', '', 'Third Semester', '2017 - 2018', 22, '0000-00-00', 0, ''),
(94, 'MIT 304', 'Global Information Technology &amp; Project Management', 3, '', '8:30-12/1:30-5', '', '', 'Third Semester', '2017 - 2018', 21, '0000-00-00', 0, '');

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
(1, 'INS 201', 'Pauline Ethics', 3, 'for Non-Paulinian Graduate', 0, 'Institutional Courses'),
(7, 'MIT 303', 'Advanced Systems Design and Implementation', 3, '', 21, 'Core Courses'),
(8, 'MIT 304', 'Global Information Technology &amp; Project Management', 3, '', 21, 'Core Courses'),
(11, 'MITCP 01', 'Capstone Project 1', 6, '', 21, 'Independent Projects'),
(15, '2234', '2', 2, '2', 22, 'Core Courses'),
(17, '3', '3', 3, '3', 27, 'Core Courses');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gs_faculty`
--
ALTER TABLE `gs_faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gs_option`
--
ALTER TABLE `gs_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `gs_program`
--
ALTER TABLE `gs_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `gs_rooms`
--
ALTER TABLE `gs_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gs_scheduling`
--
ALTER TABLE `gs_scheduling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `gs_subject`
--
ALTER TABLE `gs_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
