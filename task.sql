-- phpMyAdmin SQL Dump
-- version 4.2.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2014 at 01:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE IF NOT EXISTS `book_info` (
`bookid` int(10) NOT NULL,
  `bookname` varchar(50) NOT NULL,
  `bookcreated` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `typeid` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`bookid`, `bookname`, `bookcreated`, `typeid`) VALUES
(1, 'Harry Potter and the Philosopher''s Stone', '2013-09-04 23:00:00.000000', 1),
(2, 'Harry Potter and the Chamber of Secrets', '2014-05-13 23:00:00.000000', 1),
(3, 'Harry Potter and the Prisoner of Azkaban', '2014-06-06 23:00:00.000000', 1),
(4, 'Harry Potter and the Goblet of Fire', '2014-05-30 23:00:00.000000', 1),
(5, 'Harry Potter and the Order of the Phoenix', '2014-05-04 23:00:00.000000', 1),
(6, 'Harry Potter and the Half-Blood Prince', '2014-06-05 23:00:00.000000', 1),
(7, 'Guinness World Records 2014', '2014-06-03 23:00:00.000000', 2),
(8, 'Guinness World Records 2013', '2014-06-09 09:25:55.531046', 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_type`
--

CREATE TABLE IF NOT EXISTS `book_type` (
`typeid` int(10) NOT NULL,
  `typename` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `book_type`
--

INSERT INTO `book_type` (`typeid`, `typename`) VALUES
(1, 'Fantasy'),
(2, 'Reference');

-- --------------------------------------------------------

--
-- Table structure for table `loan_info`
--

CREATE TABLE IF NOT EXISTS `loan_info` (
`loanid` int(10) NOT NULL,
  `bookid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `loandate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `returndate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `loan_info`
--

INSERT INTO `loan_info` (`loanid`, `bookid`, `userid`, `loandate`, `returndate`) VALUES
(18, 6, 1, '2014-06-19 11:49:51', '2014-06-26 11:49:49'),
(19, 3, 1, '2014-06-19 11:52:38', '2014-06-26 11:52:36'),
(20, 5, 1, '2014-06-20 14:35:33', '2014-06-27 14:35:32'),
(21, 4, 1, '2014-06-23 08:38:31', '2014-06-30 08:38:30'),
(22, 2, 1, '2014-06-23 08:38:34', '2014-06-30 08:38:33'),
(23, 1, 1, '2014-06-23 08:55:47', '2014-06-30 08:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
`userid` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `typeid` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userid`, `username`, `password`, `typeid`) VALUES
(1, 'Admin', 'e925189133c7649bb01b60f65d6c18cd7a54e5fd', 2),
(2, 'Regular', 'e925189133c7649bb01b60f65d6c18cd7a54e5fd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
`typeid` int(10) NOT NULL,
  `typename` varchar(7) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`typeid`, `typename`) VALUES
(1, 'Student'),
(2, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_list`
--

CREATE TABLE IF NOT EXISTS `waiting_list` (
`waitingid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `bookid` int(10) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `waiting_list`
--

INSERT INTO `waiting_list` (`waitingid`, `userid`, `bookid`, `dateadded`) VALUES
(30, 2, 2, '2014-06-24 10:53:59'),
(32, 2, 5, '2014-06-24 11:34:52'),
(33, 2, 1, '2014-06-24 11:35:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
 ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `book_type`
--
ALTER TABLE `book_type`
 ADD PRIMARY KEY (`typeid`);

--
-- Indexes for table `loan_info`
--
ALTER TABLE `loan_info`
 ADD PRIMARY KEY (`loanid`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
 ADD PRIMARY KEY (`typeid`);

--
-- Indexes for table `waiting_list`
--
ALTER TABLE `waiting_list`
 ADD PRIMARY KEY (`waitingid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
MODIFY `bookid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `book_type`
--
ALTER TABLE `book_type`
MODIFY `typeid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loan_info`
--
ALTER TABLE `loan_info`
MODIFY `loanid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
MODIFY `typeid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `waiting_list`
--
ALTER TABLE `waiting_list`
MODIFY `waitingid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
