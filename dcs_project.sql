/**
 * File Description: DCS site full with users and other input data Database 
 * @version 2.0
 * @authors Eric Rosales, Sotto, Charles Torrente
*/


-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2016 at 10:01 PM
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

-- ----------------------------dlasdljsal----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_name`, `credit_units`, `course_description`) VALUES
(1, 'ICST 101', 'Computing Fundamentals', 3, 'WTF'),
(2, 'ICST 102', 'Computer Programming 1', 3, 'Prog 1'),
(3, 'ICST 103', 'Computer Programming 2', 3, 'PRog 2');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`curriculum_id`, `program_id`, `curriculum_year`, `date_created`, `last_modified`) VALUES
(1, 1, 2019, '2016-03-07 04:22:52', NULL),
(2, 2, 2017, '2016-03-09 05:30:41', NULL),
(3, 3, 2017, '2016-03-09 10:16:24', NULL),
(4, 1, 2017, '2016-03-09 10:18:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_downloads`
--

CREATE TABLE IF NOT EXISTS `curriculum_downloads` (
  `download_count_id` int(6) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `download_count_value` int(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curriculum_downloads`
--

INSERT INTO `curriculum_downloads` (`download_count_id`, `curriculum_id`, `download_count_value`) VALUES
(1, 1, 1),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0);

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

--
-- Dumping data for table `curr_subjects`
--

INSERT INTO `curr_subjects` (`curriculum_id`, `course_id`, `curr_year`, `curr_sem`) VALUES
(1, 1, 1, 1),
(1, 2, 1, 1),
(1, 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(4) NOT NULL,
  `event_title` text NOT NULL,
  `event_desc` text,
  `event_start` text NOT NULL,
  `event_end` text,
  `event_status` enum('0','1','2','') NOT NULL DEFAULT '0',
  `event_comment` varchar(100) DEFAULT NULL,
  `event_color` enum('#ff1a1a','#3399ff','#33cc33','#ffff00') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_statistics`
--

CREATE TABLE IF NOT EXISTS `event_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_statistics`
--

INSERT INTO `event_statistics` (`id`, `value`, `date`) VALUES
(1, 0, '2016-03-09'),
(2, 0, '2016-03-09'),
(3, 0, '2016-03-09'),
(4, 0, '2016-03-09'),
(5, 0, '2016-03-09'),
(6, 0, '2016-03-09'),
(7, 0, '2016-03-09'),
(8, 0, '2016-03-09'),
(9, 0, '2016-03-09'),
(10, 0, '2016-03-09'),
(11, 0, '2016-03-09'),
(12, 0, '2016-03-09');

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
(14, 'f201211002', 0, 0),
(16, 'f200811000', 0, 0),
(17, 'f201311000', 0, 0),
(18, 'f200111000', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_statistics`
--

CREATE TABLE IF NOT EXISTS `faculty_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_statistics`
--

INSERT INTO `faculty_statistics` (`id`, `value`, `date`) VALUES
(1, 10, '2016-03-09'),
(2, 10, '2016-03-09'),
(3, 10, '2016-03-09'),
(4, 10, '2016-03-09'),
(5, 10, '2016-03-09'),
(6, 10, '2016-03-09'),
(7, 10, '2016-03-09'),
(8, 10, '2016-03-09'),
(9, 10, '2016-03-09'),
(10, 10, '2016-03-09'),
(11, 10, '2016-03-09'),
(12, 10, '2016-03-09');

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
  `date_posted` datetime DEFAULT NULL,
  faculties tinyint(1) DEFAULT 0,
  students tinyint(1) DEFAULT 0,
  alumnus tinyint(1) DEFAULT 0,
  guests tinyint(1) DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL,
   user_type tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `user_id`, `picture_id`, `title`, `details`, `date_posted`,faculties, students, alumnus, guests, `is_approved`, user_type) VALUES
(1, 1, 1, 'TACTICS Election', 'Vote wise!', '2016/03/09 08:52:24 am', 1, 1, 1, 1, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `news_statistics`
--

CREATE TABLE IF NOT EXISTS `news_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_statistics`
--

INSERT INTO `news_statistics` (`id`, `value`, `date`) VALUES
(1, 1, '2016-03-09'),
(2, 1, '2016-03-09'),
(3, 1, '2016-03-09'),
(4, 1, '2016-03-09'),
(5, 1, '2016-03-09'),
(6, 1, '2016-03-09'),
(7, 1, '2016-03-09'),
(8, 1, '2016-03-09'),
(9, 1, '2016-03-09'),
(10, 1, '2016-03-09'),
(11, 1, '2016-03-09'),
(12, 1, '2016-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `organization_officer`
--

CREATE TABLE IF NOT EXISTS `organization_officer` (
  `officer_id` int(4) NOT NULL,
  `position` varchar(50) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization_officer`
--

INSERT INTO `organization_officer` (`officer_id`, `position`, `student_id`) VALUES
(1, 'President', NULL),
(2, 'Internal Vice President - Information Technology', 's201311530'),
(3, 'Internal Vice President - Computer Science', NULL),
(4, 'Internal Vice President - Information Systems', NULL),
(5, 'External Vice President', NULL),
(6, 'Secretary', NULL),
(7, 'Assistant Secretary', NULL),
(8, 'Treasurer',  NULL),
(9, 'Auditor', NULL),
(10, 'Business Manager', NULL),
(11, 'Business Manager', NULL),
(12, 'Public Information Officer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `picture_id` int(11) NOT NULL,
  `file_name` varchar(32) DEFAULT NULL,
  `file_path` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`picture_id`, `file_name`, `file_path`) VALUES
(1, '1.jpg', 'newsPictures/1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisite`
--

CREATE TABLE IF NOT EXISTS `prerequisite` (
  `course_id` int(11) DEFAULT NULL,
  `course_id_pre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prerequisite`
--

INSERT INTO `prerequisite` (`course_id`, `course_id_pre`) VALUES
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(20) DEFAULT NULL,
  `program_name` varchar(30) DEFAULT NULL,
  `program_desc` varchar(910) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_code`, `program_name`, `program_desc`) VALUES
(1, 'BSIT', 'BS in Information Technology', 'Bachelor of Science in Information Technology (BSIT) is the study of utilization of computers and computer software to plan, install, customize, operate, manage, administer and maintain information technology infrastructure. The BSIT program prepares students to be IT professionals, be well versed on application installation, operation, development, maintenance and administration, and familiar with hardware installation, operation and maintenance. After satisfactorily completing all the requirements leading to a BSIT degree, students may qualify for but not limited to the following entry level positions: Applications Developer, Database Administrator, Entrepreneur in IT Industry, Information Security Administrator, Information Technology Instructor, Network Administrator, Network Engineer, Systems Analyst, Technical Support Specialist, Test Engineer, Web Administrator/Web Master and Web Developer.'),
(2, 'BSIS', 'BS in Information Systems', 'Bachelor of Science in Information Systems (BSIS) is the study of design and implementation of solutions that integrate information technology with business processes. The BSIS program prepares students to be IT professionals and be expert on design and implementation of IS for business processes. After satisfactorily completing all the requirements leading to a BSIS degree, students may qualify for but not limited to the following entry level positions: Business Process Analyst, Data Quality Specialist, Entrepreneur in IT industry, IS Instructor, Systems Auditor, Quality Assurance Analyst, Systems Implementation Officer, and Technical Support Specialist.'),
(3, 'BSCS', 'BS in Computer Science', 'Bachelor of Science in Computer Science (BSCS) is the study of concepts and theories, algorithmic foundations, implementation and application of information and computing solutions. The BSCS program prepares students to be IT professionals and researchers who are proficient in designing and developing computing solutions. After satisfactorily completing all the requirements leading to a BSCS degree, students may qualify for but not limited to the following entry level positions: Applications Developer, Computer Science Instructor, Database Programmer/Designer, Information Security Engineer, Quality Assurance Engineer, Researcher, Systems Developer, and Systems Analyst.');

-- --------------------------------------------------------

--
-- Table structure for table `program_coordinator`
--

CREATE TABLE IF NOT EXISTS `program_coordinator` (
  `faculty_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_coordinator`
--

INSERT INTO `program_coordinator` (`faculty_id`) VALUES
('f201311000');

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
(7, 's200011234', 'f200112345', 1, 2013, 0),
(19, 's200412345', NULL, 4, 2004, 0),
(20, 's200412000', NULL, 4, 2004, 0),
(21, 's200412001', NULL, 4, 2004, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_statistics`
--

CREATE TABLE IF NOT EXISTS `students_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_statistics`
--

INSERT INTO `students_statistics` (`id`, `value`, `date`) VALUES
(1, 9, '2016-03-09'),
(2, 9, '2016-03-09'),
(3, 9, '2016-03-09'),
(4, 9, '2016-03-09'),
(5, 9, '2016-03-09'),
(6, 9, '2016-03-09'),
(7, 9, '2016-03-09'),
(8, 9, '2016-03-09'),
(9, 9, '2016-03-09'),
(10, 9, '2016-03-09'),
(11, 9, '2016-03-09'),
(12, 9, '2016-03-09');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `gender`, `birth_date`, `address`, `major`, `gbox_acct`) VALUES
(1, 5, 's201311530', 'e10adc3949ba59abbe56e057f20f883e', 'Eric Xavier', 'Carreras', 'Rosales', 'M', '1990-09-19', '52 Abella Street Villa Sorabella Subdivision Naga City', 'IT', 'errosales@gbox.adnu.edu.ph'),
(2, 6, 's201310531', 'e10adc3949ba59abbe56e057f20f883e', 'Xavier Eric', 'Carreras', 'Rosales', 'M', '1996-06-14', 'Z-1 Del Rosario, Naga City', 'CS', 'esotto@gbox.adnu.edu.ph'),
(4, 6, 's201310500', 'e10adc3949ba59abbe56e057f20f883e', 'Marlou', 'marlou', 'marlou', 'M', '2013-01-03', 'Z-1 Del Rosario, Naga City', 'IS', 'mmarlou@gbox.adnu.edu.ph'),
(5, 6, 's201310501', 'e10adc3949ba59abbe56e057f20f883e', 'justin', 'bababa', 'bieber', 'M', '2005-11-06', 'Z-1 Del Rosario, Naga City', 'CS', 'jbieber@gbox.adnu.edu.ph'),
(6, 6, 's201310502', 'e10adc3949ba59abbe56e057f20f883e', 'maria', 'sasa', 'ozawa', 'F', '2016-03-06', 'Z-1 Del Rosario, Naga City', 'IS', 'mozawa@gbox.adnu.edu.ph'),
(7, 6, 's200011234', 'e10adc3949ba59abbe56e057f20f883e', 'Student', 'Number', 'One', 'M', '1996-02-02', 'BETLOG AVENUE', 'IT', 'sone@gbox.adnu.edu.ph'),
(8, 4, 'f200112345', 'e10adc3949ba59abbe56e057f20f883e', 'Adrian Leo', 'Tendenilla', 'Pajarillo', 'M', '1987-10-03', 'Camaligan', 'IT', 'apajarillo@gbox.adnu.edu.ph'),
(9, 4, 'f201511000', 'e10adc3949ba59abbe56e057f20f883e', 'Mitchell Zachary', 'Bax', 'Imperial', 'M', '1991-03-10', 'Naga City', 'CS', 'miimperial@gbox.adnu.edu.ph'),
(10, 4, 'f201511001', 'e10adc3949ba59abbe56e057f20f883e', 'John Sixto', 'Something', 'Santos', 'M', '1990-05-06', 'Naga City', 'IT', 'johnssantos@gbox.adnu.edu.ph'),
(11, 4, 'f201511002', 'e10adc3949ba59abbe56e057f20f883e', 'Michelle', 'Buenagua', 'Santos', 'F', '1992-08-08', 'Naga City', 'IS', 'misantos@gbox.adnu.edu.ph'),
(12, 1, 'f200410123', 'e10adc3949ba59abbe56e057f20f883e', 'Frederick', 'Yamaha', 'Olano', 'M', '1967-10-03', 'Naga City', 'CS', 'fzolano@gbox.adnu.edu.ph'),
(13, 4, 'f201211001', 'e10adc3949ba59abbe56e057f20f883e', 'Jalea', 'Pantoja', 'Aureus', 'F', '1987-07-10', 'Naga City', 'IT', 'jaureus@gbox.adnu.edu.ph'),
(14, 2, 'f201211002', 'e10adc3949ba59abbe56e057f20f883e', 'Rey', 'Man', 'Vidallo', 'M', '1982-05-03', 'Naga City', 'CS', 'rvidallo@gbox.adnu.edu.ph'),
(16, 4, 'f200811000', 'e10adc3949ba59abbe56e057f20f883e', 'Cecilbeth', 'Ibanez', 'Vidallo', 'F', '1984-01-03', 'Naga City', 'IT', 'cvidallo@gbox.adnu.edu.ph'),
(17, 3, 'f201311000', 'e10adc3949ba59abbe56e057f20f883e', 'Marianne', 'P-something', 'Ang', 'F', '1988-05-17', 'Naga City', 'CS', 'mang@gbox.adnu.edu.ph'),
(18, 4, 'f200111000', 'e10adc3949ba59abbe56e057f20f883e', 'Joshua', 'Something', 'Martinez', 'M', '1976-08-14', 'Naga City', 'IT', 'jmartinez@gbox.adnu.edu.ph'),
(19, 6, 's200412345', 'e10adc3949ba59abbe56e057f20f883e', 'One', 'Sample', 'Student', 'M', '1987-06-06', 'Naga City Camarines Sur', 'CS', 'ostudent@gbox.adnu.edu.ph'),
(20, 6, 's200412000', 'e10adc3949ba59abbe56e057f20f883e', 'Another', 'Sample', 'Student', 'M', '1987-10-14', 'Naga City Camarines Sur', 'IS', 'anstudent@gbox.adnu.edu.ph'),
(21, 6, 's200412001', 'e10adc3949ba59abbe56e057f20f883e', 'Just another', 'Sample', 'Student', 'F', '1990-12-12', 'Naga City Camarines Sur', 'IT', 'jastudent@gbox.adnu.edu.ph'),
(22, 8, 'guest', 'e10adc3949ba59abbe56e057f20f883e', 'Guest', 'Guest', 'Guest', 'F', '1990-12-12', 'Naga City Camarines Sur', 'IT', 'guest@gbox.adnu.edu.ph');

-- --------------------------------------------------------

--
-- Table structure for table `users_statistics`
--

CREATE TABLE IF NOT EXISTS `users_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_statistics`
--

INSERT INTO `users_statistics` (`id`, `value`, `date`) VALUES
(1, 19, '2016-03-09'),
(2, 19, '2016-03-09'),
(3, 19, '2016-03-09'),
(4, 19, '2016-03-09'),
(5, 19, '2016-03-09'),
(6, 19, '2016-03-09'),
(7, 19, '2016-03-09'),
(8, 19, '2016-03-09'),
(9, 19, '2016-03-09'),
(10, 19, '2016-03-09'),
(11, 19, '2016-03-09'),
(12, 19, '2016-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `visit_statistics`
--

CREATE TABLE IF NOT EXISTS `visit_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visit_statistics`
--

INSERT INTO `visit_statistics` (`id`, `value`, `date`) VALUES
(1, 4, '2016-03-09');

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
-- Indexes for table `curriculum_downloads`
--
ALTER TABLE `curriculum_downloads`
  ADD PRIMARY KEY (`download_count_id`),
  ADD KEY `curriculum_id` (`curriculum_id`);

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
-- Indexes for table `visit_statistics`
--
ALTER TABLE `visit_statistics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `curriculum_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `curriculum_downloads`
--
ALTER TABLE `curriculum_downloads`
  MODIFY `download_count_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_statistics`
--
ALTER TABLE `event_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `faculty_statistics`
--
ALTER TABLE `faculty_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `news_statistics`
--
ALTER TABLE `news_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `organization_officer`
--
ALTER TABLE `organization_officer`
  MODIFY `officer_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students_statistics`
--
ALTER TABLE `students_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users_statistics`
--
ALTER TABLE `users_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `visit_statistics`
--
ALTER TABLE `visit_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
-- Constraints for table `curriculum_downloads`
--
ALTER TABLE `curriculum_downloads`
  ADD CONSTRAINT `curriculum_reference` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`);

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
