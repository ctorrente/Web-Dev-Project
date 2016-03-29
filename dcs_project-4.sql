-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2016 at 04:10 PM
-- Server version: 10.1.11-MariaDB
-- PHP Version: 7.0.2RC1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcs_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `adviser`
--

CREATE TABLE `adviser` (
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

CREATE TABLE `chair` (
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

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `credit_units` int(11) DEFAULT NULL,
  `course_description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_name`, `credit_units`, `course_description`) VALUES
(1, 'ICST 101', 'Computing Fundamentals', 3, 'WTF'),
(2, 'ICST 102', 'Computer Programming 1', 3, 'Prog 1'),
(3, 'ICST 103', 'Computer Programming 2', 3, 'PRog 2'),
(4, 'ICSE015', 'Methods of Research', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `curriculum_id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `curriculum_year` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`curriculum_id`, `program_id`, `curriculum_year`, `date_created`, `last_modified`) VALUES
(1, 1, 2019, '2016-03-07 04:22:52', NULL),
(2, 2, 2017, '2016-03-09 05:30:41', NULL),
(3, 3, 2017, '2016-03-09 10:16:24', NULL),
(4, 1, 2017, '2016-03-09 10:18:48', NULL),
(5, 1, 2017, '2016-03-10 05:51:21', NULL),
(6, 1, 2017, '2016-03-10 05:51:29', NULL),
(7, 1, 2014, '2016-03-17 06:12:00', NULL),
(8, 3, 2020, '2016-03-17 06:18:06', NULL),
(9, 3, 2017, '2016-03-17 06:22:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_downloads`
--

CREATE TABLE `curriculum_downloads` (
  `download_count_id` int(6) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `download_count_value` int(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curriculum_downloads`
--

INSERT INTO `curriculum_downloads` (`download_count_id`, `curriculum_id`, `download_count_value`) VALUES
(1, 1, 7),
(2, 2, 0),
(3, 3, 6),
(4, 4, 2),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `curr_subjects`
--

CREATE TABLE `curr_subjects` (
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
(1, 3, 1, 2),
(4, 1, 1, 1),
(1, 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(4) NOT NULL,
  `event_title` varchar(32) NOT NULL,
  `event_description` text,
  `event_start` datetime NOT NULL,
  `event_end` datetime DEFAULT NULL,
  `event_status` enum('0','1','2','') NOT NULL,
  `event_comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_title`, `event_description`, `event_start`, `event_end`, `event_status`, `event_comment`) VALUES
(1, 'Moi\'s Birthday', 'Happy birthday Moi!', '2016-03-11 00:00:00', '2016-03-11 00:00:00', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_statistics`
--

CREATE TABLE `event_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 0, '2016-03-09'),
(13, 0, '2016-03-09'),
(14, 0, '2016-03-09'),
(15, 0, '2016-03-10'),
(16, 0, '2016-03-10'),
(17, 0, '2016-03-10'),
(18, 0, '2016-03-10'),
(19, 0, '2016-03-10'),
(20, 0, '2016-03-10'),
(21, 0, '2016-03-10'),
(22, 0, '2016-03-10'),
(23, 0, '2016-03-10'),
(24, 0, '2016-03-10'),
(25, 0, '2016-03-10'),
(26, 0, '2016-03-10'),
(27, 0, '2016-03-10'),
(28, 0, '2016-03-10'),
(29, 0, '2016-03-10'),
(30, 1, '2016-03-17'),
(31, 1, '2016-03-17'),
(32, 1, '2016-03-17'),
(33, 1, '2016-03-17'),
(34, 1, '2016-03-17'),
(35, 1, '2016-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
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

CREATE TABLE `faculty_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 10, '2016-03-09'),
(13, 10, '2016-03-09'),
(14, 10, '2016-03-09'),
(15, 10, '2016-03-10'),
(16, 10, '2016-03-10'),
(17, 10, '2016-03-10'),
(18, 10, '2016-03-10'),
(19, 10, '2016-03-10'),
(20, 11, '2016-03-10'),
(21, 11, '2016-03-10'),
(22, 11, '2016-03-10'),
(23, 11, '2016-03-10'),
(24, 11, '2016-03-10'),
(25, 11, '2016-03-10'),
(26, 11, '2016-03-10'),
(27, 11, '2016-03-10'),
(28, 11, '2016-03-10'),
(29, 11, '2016-03-10'),
(30, 11, '2016-03-17'),
(31, 11, '2016-03-17'),
(32, 11, '2016-03-17'),
(33, 12, '2016-03-17'),
(34, 13, '2016-03-17'),
(35, 13, '2016-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
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

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `user_id` int(6) NOT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `details` text,
  `date_posted` datetime DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `user_id`, `picture_id`, `title`, `details`, `date_posted`, `is_approved`) VALUES
(17, 12, 1, 'Curriculum Booklet Submission', 'Deadline: 27 April 2016 5:00pm at DCS Office', '2016-03-18 11:52:16', 1),
(18, 12, 2, 'Elective Offerings for Summer Semester', 'icse001\r\nicse002', '2016-03-18 11:56:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_statistics`
--

CREATE TABLE `news_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 1, '2016-03-09'),
(13, 1, '2016-03-09'),
(14, 1, '2016-03-09'),
(15, 2, '2016-03-10'),
(16, 2, '2016-03-10'),
(17, 2, '2016-03-10'),
(18, 2, '2016-03-10'),
(19, 2, '2016-03-10'),
(20, 3, '2016-03-10'),
(21, 3, '2016-03-10'),
(22, 3, '2016-03-10'),
(23, 3, '2016-03-10'),
(24, 3, '2016-03-10'),
(25, 3, '2016-03-10'),
(26, 3, '2016-03-10'),
(27, 3, '2016-03-10'),
(28, 4, '2016-03-10'),
(29, 4, '2016-03-10'),
(30, 4, '2016-03-17'),
(31, 4, '2016-03-17'),
(32, 4, '2016-03-17'),
(33, 10, '2016-03-17'),
(34, 11, '2016-03-17'),
(35, 11, '2016-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `organization_officer`
--

CREATE TABLE `organization_officer` (
  `officer_id` int(4) NOT NULL,
  `position` varchar(50) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(8, 'Treasurer', NULL),
(9, 'Auditor', NULL),
(10, 'Business Manager', NULL),
(11, 'Business Manager', NULL),
(12, 'Public Information Officer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `picture_id` int(11) NOT NULL,
  `file_name` varchar(32) DEFAULT NULL,
  `file_path` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`picture_id`, `file_name`, `file_path`) VALUES
(1, '1.png', 'newsPictures/1.png'),
(2, '2.png', 'newsPictures/2.png');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisite`
--

CREATE TABLE `prerequisite` (
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

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(20) DEFAULT NULL,
  `program_name` varchar(30) DEFAULT NULL,
  `program_desc` varchar(910) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `program_coordinator` (
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

CREATE TABLE `students` (
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
(19, 's200412345', 'f201511000', 4, 2004, 0),
(20, 's200412000', 'f201511002', 4, 2004, 0),
(21, 's200412001', 'f200112345', 4, 2004, 0),
(23, 's200910445', 'f201511000', 4, 2009, 0),
(26, 's201810445', 'f200410123', 1, 2018, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_statistics`
--

CREATE TABLE `students_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 9, '2016-03-09'),
(13, 9, '2016-03-09'),
(14, 9, '2016-03-09'),
(15, 9, '2016-03-10'),
(16, 9, '2016-03-10'),
(17, 9, '2016-03-10'),
(18, 9, '2016-03-10'),
(19, 9, '2016-03-10'),
(20, 9, '2016-03-10'),
(21, 9, '2016-03-10'),
(22, 9, '2016-03-10'),
(23, 9, '2016-03-10'),
(24, 9, '2016-03-10'),
(25, 9, '2016-03-10'),
(26, 9, '2016-03-10'),
(27, 9, '2016-03-10'),
(28, 9, '2016-03-10'),
(29, 9, '2016-03-10'),
(30, 9, '2016-03-17'),
(31, 9, '2016-03-17'),
(32, 9, '2016-03-17'),
(33, 10, '2016-03-17'),
(34, 11, '2016-03-17'),
(35, 11, '2016-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `gender`, `birth_date`, `address`, `major`, `gbox_acct`) VALUES
(1, 5, 's201311530', '5f4dcc3b5aa765d61d8327deb882cf99', 'Eric Xavier', 'Carreras', 'Rosales', 'M', '1990-09-19', '52 Abella Street Villa Sorabella Subdivision Naga City', 'IT', 'errosales@gbox.adnu.edu.ph'),
(2, 6, 's201310531', '219157c8dc4073b8b0839ac526a7bdc8', 'Xavier Eric', 'Carreras', 'Rosales', 'M', '1996-06-14', 'Z-1 Del Rosario, Naga City', 'CS', 'esotto@gbox.adnu.edu.ph'),
(4, 6, 's201310500', '101a6ec9f938885df0a44f20458d2eb4', 'Don', 'king', 'Tan', 'M', '2013-01-03', 'Z-1 Del Rosario, Naga City', 'IS', 'mmarlou@gbox.adnu.edu.ph'),
(5, 6, 's201310501', '4e4d6c332b6fe62a63afe56171fd3725', 'Alex', 'Saballegue', 'Billones', 'M', '2005-11-06', 'Z-1 Del Rosario, Naga City', 'CS', 'jbieber@gbox.adnu.edu.ph'),
(6, 6, 's201310502', 'd41d8cd98f00b204e9800998ecf8427e', 'John', 'King', 'Fernandez', 'F', '2016-03-06', 'Z-1 Del Rosario, Naga City', 'IS', 'mozawa@gbox.adnu.edu.ph'),
(7, 6, 's200011234', '5f4dcc3b5aa765d61d8327deb882cf99', 'Vince', 'Volter', 'Morandarte', 'M', '1996-02-02', 'BETLOG AVENUE', 'IT', 'sone@gbox.adnu.edu.ph'),
(8, 4, 'f200112345', '5f4dcc3b5aa765d61d8327deb882cf99', 'Adrian Leo', 'Tendenilla', 'Pajarillo', 'M', '1987-10-03', 'Camaligan', 'IT', 'apajarillo@gbox.adnu.edu.ph'),
(9, 4, 'f201511000', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mitchell Zachary', 'Bax', 'Imperial', 'M', '1991-03-10', 'Naga City', 'CS', 'miimperial@gbox.adnu.edu.ph'),
(10, 4, 'f201511001', '5f4dcc3b5aa765d61d8327deb882cf99', 'John Sixto', 'Jordan', 'Santos', 'M', '1990-05-06', 'Naga City', 'IT', 'johnssantos@gbox.adnu.edu.ph'),
(11, 4, 'f201511002', '5f4dcc3b5aa765d61d8327deb882cf99', 'Michelle', 'Buenagua', 'Santos', 'F', '1992-08-08', 'Naga City', 'IS', 'misantos@gbox.adnu.edu.ph'),
(12, 1, 'f200410123', '5f4dcc3b5aa765d61d8327deb882cf99', 'Frederick', 'Yamaha', 'Olano', 'M', '1967-10-03', 'Naga City', 'CS', 'fzolano@gbox.adnu.edu.ph'),
(13, 4, 'f201211001', '5f4dcc3b5aa765d61d8327deb882cf99', 'Jalea', 'Pantoja', 'Aureus', 'F', '1987-07-10', 'Naga City', 'IT', 'jaureus@gbox.adnu.edu.ph'),
(14, 2, 'f201211002', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rey', 'Man', 'Vidallo', 'M', '1982-05-03', 'Naga City', 'CS', 'rvidallo@gbox.adnu.edu.ph'),
(16, 4, 'f200811000', '5f4dcc3b5aa765d61d8327deb882cf99', 'Cecilbeth', 'Ibanez', 'Vidallo', 'F', '1984-01-03', 'Naga City', 'IT', 'cvidallo@gbox.adnu.edu.ph'),
(17, 3, 'f201311000', '5f4dcc3b5aa765d61d8327deb882cf99', 'Marianne', 'Pilao', 'Ang', 'F', '1988-05-17', 'Naga City', 'CS', 'mang@gbox.adnu.edu.ph'),
(18, 4, 'f200111000', '5f4dcc3b5aa765d61d8327deb882cf99', 'Joshua', 'Nonito', 'Martinez', 'M', '1976-08-14', 'Naga City', 'IT', 'jmartinez@gbox.adnu.edu.ph'),
(19, 6, 's200412345', '5f4dcc3b5aa765d61d8327deb882cf99', 'Patricia', 'Geronimo', 'De Leon', 'M', '1987-06-06', 'Naga City Camarines Sur', 'CS', 'ostudent@gbox.adnu.edu.ph'),
(20, 6, 's200412000', '5f4dcc3b5aa765d61d8327deb882cf99', 'Keith', 'Psy', 'Aguilar', 'M', '1987-10-14', 'Naga City Camarines Sur', 'IS', 'anstudent@gbox.adnu.edu.ph'),
(21, 6, 's200412001', '5f4dcc3b5aa765d61d8327deb882cf99', 'Joshua', 'Francisco', 'Tolentino', 'F', '1990-12-12', 'Naga City Camarines Sur', 'IT', 'jastudent@gbox.adnu.edu.ph'),
(22, 8, 's20111000', '5f4dcc3b5aa765d61d8327deb882cf99', 'Aileen', 'Ai', 'Rillon', 'F', '1980-07-19', 'Naga City Philippines', 'IS', 'arillon@gbox.adnu.edu.ph'),
(23, 8, 's200910445', '5f4dcc3b5aa765d61d8327deb882cf99', 'kevin', 'Cleofas', 'bigay', 'M', '1992-04-27', 'asdadas', 'CS', 'kbigay@gbox.adnu.edu.ph'),
(24, 0, 'f20611544', '5f4dcc3b5aa765d61d8327deb882cf99', 'Christian', 'Noel', 'Lizardo', 'M', '1989-09-09', 'slf;shflna', 'CS', 'asdjhjk@gbox.adnu.edu.ph'),
(25, 2, 'f200010000', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ron', 'Amaro', 'Orpia', 'F', '0890-10-10', 'sadsgfgkjfjsgfla', 'IT', 'ashfkhadf@gbox.adnu.edu.ph'),
(26, 8, 's201810445', '5f4dcc3b5aa765d61d8327deb882cf99', 'Shara Mae', 'Mila', 'Yu', 'M', '1999-02-07', 'fhagfkhjapsfhoah', 'CS', 'brusty@gbox.adnu.edu.ph');

-- --------------------------------------------------------

--
-- Table structure for table `users_statistics`
--

CREATE TABLE `users_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 19, '2016-03-09'),
(13, 19, '2016-03-09'),
(14, 19, '2016-03-09'),
(15, 19, '2016-03-10'),
(16, 19, '2016-03-10'),
(17, 19, '2016-03-10'),
(18, 19, '2016-03-10'),
(19, 19, '2016-03-10'),
(20, 20, '2016-03-10'),
(21, 20, '2016-03-10'),
(22, 20, '2016-03-10'),
(23, 20, '2016-03-10'),
(24, 20, '2016-03-10'),
(25, 20, '2016-03-10'),
(26, 20, '2016-03-10'),
(27, 20, '2016-03-10'),
(28, 20, '2016-03-10'),
(29, 20, '2016-03-10'),
(30, 20, '2016-03-17'),
(31, 20, '2016-03-17'),
(32, 20, '2016-03-17'),
(33, 22, '2016-03-17'),
(34, 24, '2016-03-17'),
(35, 24, '2016-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `visit_statistics`
--

CREATE TABLE `visit_statistics` (
  `id` int(6) NOT NULL,
  `value` int(9) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visit_statistics`
--

INSERT INTO `visit_statistics` (`id`, `value`, `date`) VALUES
(1, 93, '2016-03-09');

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
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `curriculum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `curriculum_downloads`
--
ALTER TABLE `curriculum_downloads`
  MODIFY `download_count_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `event_statistics`
--
ALTER TABLE `event_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `faculty_statistics`
--
ALTER TABLE `faculty_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `news_statistics`
--
ALTER TABLE `news_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `organization_officer`
--
ALTER TABLE `organization_officer`
  MODIFY `officer_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students_statistics`
--
ALTER TABLE `students_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users_statistics`
--
ALTER TABLE `users_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `visit_statistics`
--
ALTER TABLE `visit_statistics`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
