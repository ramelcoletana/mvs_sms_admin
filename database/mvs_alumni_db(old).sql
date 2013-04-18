-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2013 at 06:25 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mvs_alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_user`
--

CREATE TABLE IF NOT EXISTS `tbl_admin_user` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldName` varchar(255) NOT NULL,
  `fldUsername` varchar(100) NOT NULL,
  `fldPassword` varchar(100) NOT NULL,
  `fldEmailAddress` varchar(225) NOT NULL,
  `fldMobileNum` varchar(14) NOT NULL,
  `fldStatus` tinyint(4) NOT NULL,
  `fldLastLogin` datetime NOT NULL,
  PRIMARY KEY (`fldId`),
  UNIQUE KEY `fldUsername` (`fldUsername`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin_user`
--

INSERT INTO `tbl_admin_user` (`fldId`, `fldName`, `fldUsername`, `fldPassword`, `fldEmailAddress`, `fldMobileNum`, `fldStatus`, `fldLastLogin`) VALUES
(1, 'Ramel Coletana', '1', 'yakyak16', 'ramzsweet16@gmail.com', '09091289827', 1, '2013-04-12 12:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adviser_ext`
--

CREATE TABLE IF NOT EXISTS `tbl_adviser_ext` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldIdLink` int(11) NOT NULL,
  `fldTeacherId` varchar(255) NOT NULL,
  `fldAdvisoryClass` varchar(100) NOT NULL,
  `fldSubjects` varchar(100) NOT NULL,
  PRIMARY KEY (`fldId`),
  KEY `fldIdLink` (`fldIdLink`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_adviser_ext`
--

INSERT INTO `tbl_adviser_ext` (`fldId`, `fldIdLink`, `fldTeacherId`, `fldAdvisoryClass`, `fldSubjects`) VALUES
(1, 4, '1001', 'I - Daffodil', 'English ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcements`
--

CREATE TABLE IF NOT EXISTS `tbl_announcements` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldPostedBy` varchar(255) NOT NULL,
  `fldAnnouncementContent` text NOT NULL,
  `fldDatePosted` datetime NOT NULL,
  `fldStatus` varchar(10) NOT NULL,
  PRIMARY KEY (`fldId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_announcements`
--

INSERT INTO `tbl_announcements` (`fldId`, `fldPostedBy`, `fldAnnouncementContent`, `fldDatePosted`, `fldStatus`) VALUES
(1, 'Admin', 'Hello..\r\n\r\nLorem epsum...lorem epsum..\r\n\r\nlorem epsum..\r\n', '2013-04-08 16:48:22', 'active'),
(2, '', 'hahahahah<br/><br/>\r\n\r\nhahahahahah<br/>\r\nhahaha', '2013-04-09 17:19:56', 'inactive'),
(3, '', 'hahahahah<br/><br/>\r\n\r\nhahahahahah<br/>\r\nhahaha', '2013-04-09 17:20:21', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE IF NOT EXISTS `tbl_events` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldEventContent` text NOT NULL,
  `fldDateCreated` datetime NOT NULL,
  `fldCreatedBy` varchar(100) NOT NULL,
  `fldStatus` varchar(10) NOT NULL,
  PRIMARY KEY (`fldId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`fldId`, `fldEventContent`, `fldDateCreated`, `fldCreatedBy`, `fldStatus`) VALUES
(1, 'Athletic meet 2013-2013\r\n</br>\r\nApril 20, 2013\r\n</br>\r\nMerida Vocational School Puerto Bello Annex', '2013-04-09 13:56:40', 'Admin', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects_assign_teach`
--

CREATE TABLE IF NOT EXISTS `tbl_subjects_assign_teach` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldIdLink` int(11) DEFAULT NULL,
  `fldTeacherId` varchar(255) NOT NULL,
  `fldSubjectName` varchar(20) NOT NULL,
  `fldSubjectAssigned` varchar(100) NOT NULL,
  `fldYearSection` varchar(100) NOT NULL,
  PRIMARY KEY (`fldId`),
  KEY `fldIdLink` (`fldIdLink`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_subjects_assign_teach`
--

INSERT INTO `tbl_subjects_assign_teach` (`fldId`, `fldIdLink`, `fldTeacherId`, `fldSubjectName`, `fldSubjectAssigned`, `fldYearSection`) VALUES
(1, 0, '', 'English I', '', 'I - Daffodil');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects_year_level`
--

CREATE TABLE IF NOT EXISTS `tbl_subjects_year_level` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldSubjectName` varchar(255) NOT NULL,
  `fldYearLevel` varchar(100) NOT NULL,
  `fldSectionName` varchar(100) NOT NULL,
  `fldSubjectCode` varchar(100) NOT NULL,
  `fldAviStatus` varchar(5) NOT NULL,
  PRIMARY KEY (`fldId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_subjects_year_level`
--

INSERT INTO `tbl_subjects_year_level` (`fldId`, `fldSubjectName`, `fldYearLevel`, `fldSectionName`, `fldSubjectCode`, `fldAviStatus`) VALUES
(1, 'English', 'First Year', 'Rose', 'English II', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachers`
--

CREATE TABLE IF NOT EXISTS `tbl_teachers` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldTeacherId` varchar(255) NOT NULL,
  `fldName` varchar(255) NOT NULL,
  `fldAddress` varchar(255) NOT NULL,
  `fldEmail` varchar(100) NOT NULL,
  `fldMobile` varchar(13) NOT NULL,
  `fldAge` int(11) NOT NULL,
  `fldGender` varchar(10) NOT NULL,
  `fldBDate` date NOT NULL,
  `fldRank` varchar(50) NOT NULL,
  `fldTeacherType` varchar(100) NOT NULL,
  `fldProfilePic` varchar(255) NOT NULL,
  `fldStatus` varchar(20) NOT NULL,
  PRIMARY KEY (`fldId`),
  UNIQUE KEY `fldName` (`fldName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_teachers`
--

INSERT INTO `tbl_teachers` (`fldId`, `fldTeacherId`, `fldName`, `fldAddress`, `fldEmail`, `fldMobile`, `fldAge`, `fldGender`, `fldBDate`, `fldRank`, `fldTeacherType`, `fldProfilePic`, `fldStatus`) VALUES
(4, '1001', 'Cathy Coletana', 'Merida', 'fd', 'df', 10, 'df', '2013-04-13', 'Teacher I', 'Adviser', 'sdfd', ''),
(9, '2000', 'Ramel Coletana Relampagos Coletana', 'Merida, Leyte', 'ramzsweet16@gmail.com', '09091289827', 22222, 'Male', '0000-00-00', 'Head Teacher I', 'School Head', 'profile_pic_teachers/avatar.gif', 'inactive'),
(10, '343', 'Catherine Relampagos Coletana', 'Merida, Leyte', 'catherine@gmail.com', '09054545454', 20, 'Male', '2013-04-23', 'Head Teacher I', 'School Head', 'profile_pic_teachers/avatar.gif', 'inactive'),
(11, 'we', 'we wew ewew', 'ewe', 'wew', 'w', 2, 'Male', '2013-04-16', 'Head Teacher I', 'School Head', 'profile_pic_teachers/avatar.gif', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_year_sections`
--

CREATE TABLE IF NOT EXISTS `tbl_year_sections` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldYearLevel` varchar(100) NOT NULL,
  `fldSectionName` varchar(100) NOT NULL,
  `fldYSCode` varchar(100) NOT NULL,
  `fldAviStatus` varchar(5) NOT NULL,
  PRIMARY KEY (`fldId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_year_sections`
--

INSERT INTO `tbl_year_sections` (`fldId`, `fldYearLevel`, `fldSectionName`, `fldYSCode`, `fldAviStatus`) VALUES
(1, 'Second Year', 'Rose', 'II - Rose', 'yes'),
(2, 'Third Year', 'Sunflower', 'II - Sunflower', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_year_sections_assigned`
--

CREATE TABLE IF NOT EXISTS `tbl_year_sections_assigned` (
  `fldId` int(11) NOT NULL AUTO_INCREMENT,
  `fldIdLinkToYS` int(11) NOT NULL,
  `fldTeacherId` varchar(255) NOT NULL,
  `fldTeacherName` varchar(255) NOT NULL,
  `fldYearLevel` varchar(100) NOT NULL,
  `fldSectionName` varchar(100) NOT NULL,
  `fldYSCode` varchar(100) NOT NULL,
  PRIMARY KEY (`fldId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_year_sections_assigned`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_adviser_ext`
--
ALTER TABLE `tbl_adviser_ext`
  ADD CONSTRAINT `tbl_adviser_ext_ibfk_1` FOREIGN KEY (`fldIdLink`) REFERENCES `tbl_teachers` (`fldId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
