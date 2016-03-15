-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2016 at 09:15 AM
-- Server version: 5.6.24-log
-- PHP Version: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcs_project`
--
DROP DATABASE IF EXISTS dcs_project;
CREATE DATABASE IF NOT EXISTS `dcs_project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dcs_project`;

-- --------------------------------------------------------

--
-- Table structure for table `adviser`
--

CREATE TABLE IF NOT EXISTS `adviser` (
  `faculty_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adviser`
--

INSERT INTO `adviser` (`faculty_id`) VALUES
('f200112345'),
('f200410123'),
('f201211001'),
('f201511002');

-- --------------------------------------------------------

--
-- Table structure for table `chair`
--

CREATE TABLE IF NOT EXISTS `chair` (
  `faculty_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chair`
--

INSERT INTO `chair` (`faculty_id`) VALUES
('f200410123');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `credit_units` int(11) DEFAULT NULL,
  `course_description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE IF NOT EXISTS `curriculum` (
  `curriculum_id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `curriculum_year` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `curr_subjects`
--

CREATE TABLE IF NOT EXISTS `curr_subjects` (
  `curriculum_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `curr_year` int(11) DEFAULT NULL,
  `curr_sem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(4) NOT NULL,
  `event_title` varchar(32) NOT NULL,
  `event_description` text NOT NULL,
  `event_start` datetime NOT NULL,
  `event_end` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_statistics`
--

CREATE TABLE IF NOT EXISTS `event_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `user_id` int(6) NOT NULL,
  `faculty_id` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`user_id`, `faculty_id`, `status`, `is_admin`) VALUES
(8, 'f200112345', 0, 0),
(9, 'f201511000', 0, 0),
(10, 'f201511001', 1, 0),
(11, 'f201511002', 0, 0),
(12, 'f200410123', 0, 1),
(13, 'f201211001', 0, 0),
(14, 'f201211002', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_statistics`
--

CREATE TABLE IF NOT EXISTS `faculty_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE IF NOT EXISTS `moderator` (
  `faculty_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`faculty_id`) VALUES
('f200112345');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL,
  `user_id` int(6) NOT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `details` text,
  `date_posted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news_statistics`
--

CREATE TABLE IF NOT EXISTS `news_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organization_officer`
--

CREATE TABLE IF NOT EXISTS `organization_officer` (
  `officer_id` int(4) NOT NULL,
  `student_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `picture_id` int(11) NOT NULL,
  `file_name` varchar(32) DEFAULT NULL,
  `file_path` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prerequisite`
--

CREATE TABLE IF NOT EXISTS `prerequisite` (
  `course_id` int(11) DEFAULT NULL,
  `course_id_pre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(20) DEFAULT NULL,
  `program_name` varchar(30) DEFAULT NULL,
  `program_desc` varchar(910) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program_coordinator`
--

CREATE TABLE IF NOT EXISTS `program_coordinator` (
  `faculty_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `user_id` int(6) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `adviser_id` varchar(10) DEFAULT NULL,
  `year_level` tinyint(1) NOT NULL,
  `year_started` int(4) NOT NULL,
  `is_alumni` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`user_id`, `student_id`, `adviser_id`, `year_level`, `year_started`, `is_alumni`) VALUES
(1, 's201311530', 'f200112345', 4, 2013, 0),
(2, 's201310531', 'f200410123', 3, 2013, 0),
(4, 's201310500', 'f201511002', 3, 2013, 0),
(5, 's201310501', 'f201511000', 3, 2013, 0),
(6, 's201310502', 'f201511002', 3, 2013, 0),
(7, 's200011234', 'f200112345', 1, 2013, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_statistics`
--

CREATE TABLE IF NOT EXISTS `students_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(6) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `middle_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `gender` char(1) NOT NULL,
  `birth_date` date NOT NULL,
  `address` text NOT NULL,
  `major` enum('IS','IT','CS','') NOT NULL,
  `gbox_acct` varchar(48) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `gender`, `birth_date`, `address`, `major`, `gbox_acct`) VALUES
(1, 1, 's201311530', 'e10adc3949ba59abbe56e057f20f883e', 'Eric Xavier', 'Carreras', 'Rosales', 'M', '1990-09-19', '52 Abella Street Villa Sorabella Subdivision Naga City', 'IT', 'errosales@gbox.adnu.edu.ph'),
(2, 1, 's201310531', 'e10adc3949ba59abbe56e057f20f883e', 'Xavier Eric', 'Carreras', 'Rosales', 'M', '1996-06-14', 'Z-1 Del Rosario, Naga City', 'CS', 'esotto@gbox.adnu.edu.ph'),
(4, 1, 's201310500', 'e10adc3949ba59abbe56e057f20f883e', 'Marlou', 'marlou', 'marlou', 'M', '2013-01-03', 'Z-1 Del Rosario, Naga City', 'IS', 'mmarlou@gbox.adnu.edu.ph'),
(5, 1, 's201310501', 'e10adc3949ba59abbe56e057f20f883e', 'justin', 'bababa', 'bieber', 'M', '2005-11-06', 'Z-1 Del Rosario, Naga City', 'CS', 'jbieber@gbox.adnu.edu.ph'),
(6, 1, 's201310502', 'e10adc3949ba59abbe56e057f20f883e', 'maria', 'sasa', 'ozawa', 'F', '2016-03-06', 'Z-1 Del Rosario, Naga City', 'IS', 'mozawa@gbox.adnu.edu.ph'),
(7, 1, 's200011234', 'e10adc3949ba59abbe56e057f20f883e', 'Student', 'Number', 'One', 'M', '1996-02-02', 'BETLOG AVENUE', 'IT', 'sone@gbox.adnu.edu.ph'),
(8, 2, 'f200112345', 'e10adc3949ba59abbe56e057f20f883e', 'Adrian Leo', 'Tendenilla', 'Pajarillo', 'M', '1987-10-03', 'Camaligan', 'IT', 'apajarillo@gbox.adnu.edu.ph'),
(9, 2, 'f201511000', 'e10adc3949ba59abbe56e057f20f883e', 'Mitchell Zachary', 'Bax', 'Imperial', 'M', '1991-03-10', 'Naga City', 'CS', 'miimperial@gbox.adnu.edu.ph'),
(10, 2, 'f201511001', 'e10adc3949ba59abbe56e057f20f883e', 'John Sixto', 'Something', 'Santos', 'M', '1990-05-06', 'Naga City', 'IT', 'johnssantos@gbox.adnu.edu.ph'),
(11, 2, 'f201511002', 'e10adc3949ba59abbe56e057f20f883e', 'Michelle', 'Buenagua', 'Santos', 'F', '1992-08-08', 'Naga City', 'IS', 'misantos@gbox.adnu.edu.ph'),
(12, 2, 'f200410123', 'e10adc3949ba59abbe56e057f20f883e', 'Frederick', 'Yamaha', 'Olano', 'M', '1967-10-03', 'Naga City', 'CS', 'fzolano@gbox.adnu.edu.ph'),
(13, 2, 'f201211001', 'e10adc3949ba59abbe56e057f20f883e', 'Jalea', 'Pantoja', 'Aureus', 'F', '1987-07-10', 'Naga City', 'IT', 'jaureus@gbox.adnu.edu.ph'),
(14, 2, 'f201211002', 'e10adc3949ba59abbe56e057f20f883e', 'Rey', 'Man', 'Vidallo', 'M', '1982-05-03', 'Naga City', 'CS', 'rvidallo@gbox.adnu.edu.ph');

-- --------------------------------------------------------

--
-- Table structure for table `users_statistics`
--

CREATE TABLE IF NOT EXISTS `users_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adviser`
--
ALTER TABLE `adviser`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `chair`
--
ALTER TABLE `chair`
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`curriculum_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `program_id_2` (`program_id`);

--
-- Indexes for table `curr_subjects`
--
ALTER TABLE `curr_subjects`
  ADD KEY `curriculum_id` (`curriculum_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_statistics`
--
ALTER TABLE `event_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `faculty_statistics`
--
ALTER TABLE `faculty_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `picture_id` (`picture_id`),
  ADD KEY `username` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `news_statistics`
--
ALTER TABLE `news_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_officer`
--
ALTER TABLE `organization_officer`
  ADD PRIMARY KEY (`officer_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picture_id`);

--
-- Indexes for table `prerequisite`
--
ALTER TABLE `prerequisite`
  ADD KEY `course_id` (`course_id`),
  ADD KEY `course_id_2` (`course_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `program_coordinator`
--
ALTER TABLE `program_coordinator`
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `adviser_id` (`adviser_id`);

--
-- Indexes for table `students_statistics`
--
ALTER TABLE `students_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_stat_id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users_statistics`
--
ALTER TABLE `users_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_stat_id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `curriculum_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_statistics`
--
ALTER TABLE `event_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faculty_statistics`
--
ALTER TABLE `faculty_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news_statistics`
--
ALTER TABLE `news_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organization_officer`
--
ALTER TABLE `organization_officer`
  MODIFY `officer_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students_statistics`
--
ALTER TABLE `students_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users_statistics`
--
ALTER TABLE `users_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adviser`
--
ALTER TABLE `adviser`
  ADD CONSTRAINT `adviser_fk` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `chair`
--
ALTER TABLE `chair`
  ADD CONSTRAINT `chair_fk` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD CONSTRAINT `curriculum_fk` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`);

--
-- Constraints for table `curr_subjects`
--
ALTER TABLE `curr_subjects`
  ADD CONSTRAINT `cs_fk1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`),
  ADD CONSTRAINT `cs_fk2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `f_reference` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `f_reference2` FOREIGN KEY (`faculty_id`) REFERENCES `users` (`username`);

--
-- Constraints for table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `moderator_fk` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_fk1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `news_fk2` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`picture_id`);

--
-- Constraints for table `organization_officer`
--
ALTER TABLE `organization_officer`
  ADD CONSTRAINT `officer_fk` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `prerequisite`
--
ALTER TABLE `prerequisite`
  ADD CONSTRAINT `prereq_fk` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `program_coordinator`
--
ALTER TABLE `program_coordinator`
  ADD CONSTRAINT `prog_coor_fk` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `adviser_reference` FOREIGN KEY (`adviser_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `s_reference` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `s_reference2` FOREIGN KEY (`student_id`) REFERENCES `users` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
