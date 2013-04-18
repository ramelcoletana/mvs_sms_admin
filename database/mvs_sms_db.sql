-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2013 at 06:02 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mvs_sms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_admin_account`
--

CREATE TABLE IF NOT EXISTS `t_admin_account` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(225) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `fldUsername` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18446744073709551615 ;

--
-- Dumping data for table `t_admin_account`
--

INSERT INTO `t_admin_account` (`admin_id`, `fullname`, `username`, `password`, `email`, `status`, `last_login`) VALUES
(1, 'Ramel Coletana', '1', 'yakyak16', 'ramzsweet16@gmail.com', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_admin_infos`
--

CREATE TABLE IF NOT EXISTS `t_admin_infos` (
  `admin_infos_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `bdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_infos_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_admin_infos`
--

INSERT INTO `t_admin_infos` (`admin_infos_id`, `admin_id`, `address`, `mobile`, `age`, `bdate`, `gender`, `profile_pic`) VALUES
(1, 1, 'Merida, Leyte', 2147483647, 16, '1996-04-23', 'Male', 'dfd');

-- --------------------------------------------------------

--
-- Table structure for table `t_announcements`
--

CREATE TABLE IF NOT EXISTS `t_announcements` (
  `ann_id` int(11) NOT NULL AUTO_INCREMENT,
  `posted_by` varchar(255) NOT NULL,
  `announcement_cont` text NOT NULL,
  `date_posted` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`ann_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `t_announcements`
--

INSERT INTO `t_announcements` (`ann_id`, `posted_by`, `announcement_cont`, `date_posted`, `status`) VALUES
(1, 'Admin', 'Hello..\r\n\r\nLorem epsum...lorem epsum..\r\n\r\nlorem epsum..\r\n', '2013-04-08 16:48:22', 'active'),
(2, '', 'hahahahah<br/><br/>\r\n\r\nhahahahahah<br/>\r\nhahaha', '2013-04-09 17:19:56', 'inactive'),
(3, '', 'hahahahah<br/><br/>\r\n\r\nhahahahahah<br/>\r\nhahaha', '2013-04-09 17:20:21', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `t_current_staffs`
--

CREATE TABLE IF NOT EXISTS `t_current_staffs` (
  `cur_staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_pos_id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `position_incharge` varchar(255) NOT NULL,
  `year_start` year(4) NOT NULL,
  `year_end` year(4) NOT NULL,
  PRIMARY KEY (`cur_staff_id`),
  KEY `staff_pos_id` (`staff_pos_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t_current_staffs`
--

INSERT INTO `t_current_staffs` (`cur_staff_id`, `staff_pos_id`, `position_name`, `position_incharge`, `year_start`, `year_end`) VALUES
(1, 1, 'President', 'Ramel Coletana', 2013, 0000);

-- --------------------------------------------------------

--
-- Table structure for table `t_events`
--

CREATE TABLE IF NOT EXISTS `t_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_cont` text NOT NULL,
  `date_created` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_events`
--

INSERT INTO `t_events` (`event_id`, `event_cont`, `date_created`, `created_by`, `status`) VALUES
(1, 'Athletic meet 2013-2013\r\n</br>\r\nApril 20, 2013\r\n</br>\r\nMerida Vocational School Puerto Bello Annex', '2013-04-09 13:56:40', 'Admin', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `t_galleries`
--

CREATE TABLE IF NOT EXISTS `t_galleries` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_dir_name` varchar(255) NOT NULL,
  `date_uploaded` datetime NOT NULL,
  `uploaded_by` varchar(255) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `t_galleries`
--


-- --------------------------------------------------------

--
-- Table structure for table `t_mission_vision`
--

CREATE TABLE IF NOT EXISTS `t_mission_vision` (
  `mis_vis_id` int(11) NOT NULL AUTO_INCREMENT,
  `mission_cont` text NOT NULL,
  `vision_cont` text NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `year_start` year(4) NOT NULL,
  `year_end` year(4) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`mis_vis_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `t_mission_vision`
--


-- --------------------------------------------------------

--
-- Table structure for table `t_old_staffs`
--

CREATE TABLE IF NOT EXISTS `t_old_staffs` (
  `old_staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_pos_id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `position_incharge` varchar(255) NOT NULL,
  `year_start` year(4) NOT NULL,
  `year_end` year(4) NOT NULL,
  PRIMARY KEY (`old_staff_id`),
  KEY `staff_pos_id` (`staff_pos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_old_staffs`
--

INSERT INTO `t_old_staffs` (`old_staff_id`, `staff_pos_id`, `position_name`, `position_incharge`, `year_start`, `year_end`) VALUES
(1, 1, 'President', 'Diosdado', 2013, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `t_staff_position`
--

CREATE TABLE IF NOT EXISTS `t_staff_position` (
  `staff_pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) NOT NULL,
  `avi_status` varchar(10) NOT NULL,
  PRIMARY KEY (`staff_pos_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_staff_position`
--

INSERT INTO `t_staff_position` (`staff_pos_id`, `position_name`, `avi_status`) VALUES
(1, 'President', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `t_teachers`
--

CREATE TABLE IF NOT EXISTS `t_teachers` (
  `teach_auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `bdate` date NOT NULL,
  `rank` varchar(50) NOT NULL,
  `teacher_type` varchar(20) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`teach_auto_id`),
  UNIQUE KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t_teachers`
--

INSERT INTO `t_teachers` (`teach_auto_id`, `teacher_id`, `fullname`, `address`, `email`, `mobile`, `age`, `gender`, `bdate`, `rank`, `teacher_type`, `profile_pic`, `status`) VALUES
(2, '232', 'wewewew wewe wewe', 'wewe', 'ramelforfacebook@gmail.com', 2323, 232, 'Male', '2013-04-15', 'Head Teacher I', 'School Head', 'profile_pic_teachers/avatar.gif', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `t_year_sections`
--

CREATE TABLE IF NOT EXISTS `t_year_sections` (
  `year_sec_id` int(11) NOT NULL AUTO_INCREMENT,
  `year_level` varchar(100) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `year_sec_code` varchar(100) NOT NULL,
  `avi_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`year_sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t_year_sections`
--

INSERT INTO `t_year_sections` (`year_sec_id`, `year_level`, `section_name`, `year_sec_code`, `avi_status`) VALUES
(1, 'Second Year', 'Rose', 'II - Rose', 1),
(2, 'Second Year', 'Sunflower', 'II - Sunflower', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_year_sections_assigned`
--

CREATE TABLE IF NOT EXISTS `t_year_sections_assigned` (
  `year_sec_ass_id` int(11) NOT NULL AUTO_INCREMENT,
  `year_sec_id` int(11) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `teacher_fullname` varchar(255) NOT NULL,
  `year_level` varchar(100) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `year_sec_code` varchar(100) NOT NULL,
  PRIMARY KEY (`year_sec_ass_id`),
  KEY `year_sec_id` (`year_sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_year_sections_assigned`
--

INSERT INTO `t_year_sections_assigned` (`year_sec_ass_id`, `year_sec_id`, `teacher_id`, `teacher_fullname`, `year_level`, `section_name`, `year_sec_code`) VALUES
(1, 1, '1000', 'Ramel Relampagos Coletana', 'Second Year', 'II - Rose', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_year_sections_assigned`
--
ALTER TABLE `t_year_sections_assigned`
  ADD CONSTRAINT `t_year_sections_assigned_ibfk_1` FOREIGN KEY (`year_sec_id`) REFERENCES `t_year_sections` (`year_sec_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
