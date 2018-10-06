-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2017 at 11:02 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hall`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE IF NOT EXISTS `booking_detail` (
  `booking_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `seat_no` int(11) NOT NULL,
  PRIMARY KEY (`booking_detail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`booking_detail_id`, `booking_id`, `cust_name`, `seat_no`) VALUES
(1, 2, 'Sumeet Mukherjee', 125),
(2, 3, 'Anuk Roy', 112);

-- --------------------------------------------------------

--
-- Table structure for table `booking_master`
--

CREATE TABLE IF NOT EXISTS `booking_master` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `mov_time` varchar(100) NOT NULL,
  `movdate` date NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT '1',
  `mov_id` int(11) NOT NULL,
  `ack_id` varchar(255) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `booking_master`
--

INSERT INTO `booking_master` (`booking_id`, `mp_id`, `sc_id`, `mov_time`, `movdate`, `booking_status`, `mov_id`, `ack_id`) VALUES
(1, 1, 1, '19:30:00', '2017-12-27', 1, 1, ''),
(3, 1, 1, '19:30:00', '2017-12-27', 1, 1, 'ACK201711263');

-- --------------------------------------------------------

--
-- Table structure for table `contact_master`
--

CREATE TABLE IF NOT EXISTS `contact_master` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `keep_it` text NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact_master`
--

INSERT INTO `contact_master` (`contact_id`, `full_name`, `email_id`, `keep_it`) VALUES
(1, 'Sumeet Mukherjee', 'sumeetmukherjee95@gmail.com', 'Deshbandhu Para\r\nSumit Sumona');

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE IF NOT EXISTS `login_master` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `user_type` enum('A','C') NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='1=active, 0=inactive, A= Admin, C= Customer' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`login_id`, `username`, `password`, `full_name`, `email_id`, `contact_no`, `user_type`, `user_status`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', '', '', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie_detail`
--

CREATE TABLE IF NOT EXISTS `movie_detail` (
  `md_id` int(11) NOT NULL AUTO_INCREMENT,
  `mov_id` int(11) NOT NULL,
  `mp_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  PRIMARY KEY (`md_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `movie_detail`
--

INSERT INTO `movie_detail` (`md_id`, `mov_id`, `mp_id`, `sc_id`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 2, 3),
(4, 4, 1, 1),
(5, 1, 2, 3),
(6, 5, 1, 3),
(7, 6, 1, 3),
(8, 7, 3, 1),
(10, 8, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `movie_master`
--

CREATE TABLE IF NOT EXISTS `movie_master` (
  `mov_id` int(11) NOT NULL AUTO_INCREMENT,
  `mov_name` varchar(255) NOT NULL,
  `mov_lang` varchar(100) NOT NULL,
  `mov_date` date NOT NULL,
  `mov_time` time NOT NULL,
  `mov_abt` text NOT NULL,
  `mov_status` int(11) NOT NULL,
  PRIMARY KEY (`mov_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `movie_master`
--

INSERT INTO `movie_master` (`mov_id`, `mov_name`, `mov_lang`, `mov_date`, `mov_time`, `mov_abt`, `mov_status`) VALUES
(1, 'Tron', 'ENGLISH', '2017-11-23', '18:40:00', 'Sci-Fi', 1),
(2, 'Inception', 'ENGLISH', '2017-11-23', '15:30:00', 'Sci-Fi', 1),
(3, 'The Martian', 'ENGLISH', '2017-11-23', '08:30:00', 'Space', 1),
(4, 'Spider-Man2', 'ENGLISH', '2017-11-23', '09:30:00', 'Sci-Fi', 1),
(5, 'The Dark Knight Rises', 'ENGLISH', '2017-11-23', '11:30:00', 'Sci-Fi', 1),
(6, 'Yetri Obhijaan', 'BENGALI', '2017-11-23', '15:30:00', 'Drama', 1),
(7, 'Tiger Zinda Hai', 'HINDI', '2017-11-23', '21:30:00', 'Drama,Action,Romance.', 1),
(8, 'Amazon Obhijaan', 'BENGALI', '2017-12-27', '19:30:00', 'Adventure.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `multiplex_master`
--

CREATE TABLE IF NOT EXISTS `multiplex_master` (
  `mp_id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_name` varchar(255) NOT NULL,
  `mp_address` text NOT NULL,
  `mp_contact` varchar(50) NOT NULL,
  `mp_status` int(11) NOT NULL,
  PRIMARY KEY (`mp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `multiplex_master`
--

INSERT INTO `multiplex_master` (`mp_id`, `mp_name`, `mp_address`, `mp_contact`, `mp_status`) VALUES
(1, 'Inox', 'City Centre', '9658745236', 1),
(2, 'Cinemax', 'Savin Kingdom', '9657458963', 1),
(3, 'PVR', 'Siliguri', '9574863214', 1),
(4, 'Carnival Cinemas', 'Savin Plaza', '9647364536', 1),
(5, 'Biswadeep Cinema', 'Junction, Siliguri', '9833327899', 1);

-- --------------------------------------------------------

--
-- Table structure for table `screen_master`
--

CREATE TABLE IF NOT EXISTS `screen_master` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_id` int(11) NOT NULL,
  `no_of_seat` int(11) NOT NULL,
  `sc_name` varchar(50) NOT NULL,
  `sc_status` int(11) NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `screen_master`
--

INSERT INTO `screen_master` (`sc_id`, `mp_id`, `no_of_seat`, `sc_name`, `sc_status`) VALUES
(1, 1, 139, '1', 1),
(2, 1, 124, '2', 1),
(3, 2, 109, '3', 1),
(4, 2, 94, '4', 1),
(40, 5, 139, '1', 1),
(39, 3, 94, '1', 1),
(37, 4, 139, '4', 1),
(38, 5, 94, '2', 1),
(36, 3, 124, '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seat_screen_detail`
--

CREATE TABLE IF NOT EXISTS `seat_screen_detail` (
  `ssd_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `no_of_seat` int(11) NOT NULL,
  PRIMARY KEY (`ssd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `seat_screen_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `seat_type_master`
--

CREATE TABLE IF NOT EXISTS `seat_type_master` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_name` varchar(255) NOT NULL,
  `st_status` int(11) NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `seat_type_master`
--

INSERT INTO `seat_type_master` (`st_id`, `st_name`, `st_status`) VALUES
(1, 'Royal', 1),
(2, 'Club', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_contact` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_pass`) VALUES
(1, 'Anuk Roy Chowdhury', 'anuk@gmail.com', '9856321478', 'imanuk'),
(3, 'Sulagna Dutta', 'sulagna@gmail.com', '9657458569', 'imsulagna'),
(4, 'Rupali Biswas', 'rup9083@gmail.com', '9547866696', '12345'),
(10, 'Debojit', 'deb@gmail.com', '9654788666', '12345');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
