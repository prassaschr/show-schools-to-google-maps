-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2013 at 01:30 ?
-- Server version: 5.5.32-log
-- PHP Version: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES greek */;

--
-- Database: `schoolschart`
--

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE IF NOT EXISTS `map` (
  `school_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `dieu` varchar(255) DEFAULT NULL,
  `nomos` varchar(255) DEFAULT NULL,
  `dimos` varchar(255) DEFAULT NULL,
  `dim_diamer` varchar(255) DEFAULT NULL,
  `orario` varchar(255) DEFAULT NULL,
  `thl` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
   PRIMARY KEY (`school_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `map`
--

INSERT INTO `map` (`school_id`, `name`, `email`, `lat`, `lng`, `type`, `addr`, `dieu`, `nomos`, `dimos`, `dim_diamer`, `orario`, `thl`, `ip`, `timestamp`, `enable`) VALUES
('2201010', '1o глеягсио цулмасио йаядитсас', 'NULL', 39.3602280203752, 21.9353304829407, 'цулмасио', 'описхем ехмийоу стадиоу TK:43100 йаядитсас', 'йаядитсас', 'йаядитсас', 'йаядитсас', 'NULL', 'глеягсио цулмасио', '2441025848', '194.63.227.166', '2012-07-11 10:14:48', 1),
('2201020', '2o глеягсио цулмасио йаядитсас', 'NULL', 39.3757716020547, 21.9092594113159, 'куйеио', 'телпомеяа м. 5 TK:43100 йаядитсас', 'йаядитсас', 'йаядитсас', 'йаядитсас', 'NULL', 'глеягсио цулмасио', '2441023976', '81.186.114.66', '2012-10-04 08:38:15', 1),
('2201030', '3o глеягсио цулмасио йаядитсас', 'NULL', 39.3596805312718, 21.9035838570404, 'мгпиацыцеио', 'дяацатсамиоу теяла TK:43100 йаядитсас', 'йаядитсас', 'йаядитсас', 'йаядитсас', 'NULL', 'глеягсио цулмасио', '2441022509', '194.63.227.174', '2012-02-23 13:34:24', 1),
('2201031', '4o глеягсио цулмасио йаядитсас', 'NULL', 39.3597303031852, 21.9359661664772, 'дглотийо', 'писы апо ехмийо стадио TK:43100 йаядитсас', 'йаядитсас', 'йаядитсас', 'йаядитсас', 'NULL', 'глеягсио цулмасио', '2441020955', '194.63.227.246', '2012-02-23 13:34:24', 1),
('2201032', '5o глеягсио цулмасио йаядитса', 'NULL', 39.3762028580826, 21.9099675144959, 'епас', 'м.телпомеяа 5 TK:43100 йаядитса', 'йаядитсас', 'йаядитсас', 'йаядитсас', 'NULL', 'глеягсио цулмасио', '2441073200', '194.63.227.230', '2012-02-23 13:34:24', 1),
('2201039', '1o глеягсио цулмасио йаядитса', 'NULL', 39.3962028580826, 21.9199675144959, 'епак', 'м.телпомеяа 5 TK:43100 йаядитса', 'йаядитсас', 'йаядитсас', 'йаядитсас', 'NULL', 'глеягсио цулмасио', '2441073200', '194.63.227.230', '2012-02-23 13:34:24', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
