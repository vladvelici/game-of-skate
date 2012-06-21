-- phpMyAdmin SQL Dump
-- version 3.3.7deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2010 at 01:52 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `horse`
--

-- --------------------------------------------------------

--
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('administrator', '1', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('administrator', 2, '', NULL, 'N;'),
('editmy', 2, 'editing my own profile and tricks', 'return Yii::app()->user->id==$params["item_id"];', 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AuthItemChild`
--


-- --------------------------------------------------------

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `game_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `game_status` tinyint(1) unsigned NOT NULL,
  `game_current_player` mediumint(8) unsigned NOT NULL,
  `game_current_trick` mediumint(8) unsigned NOT NULL,
  `game_current_position` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `game_player1` mediumint(8) unsigned NOT NULL,
  `game_player2` mediumint(8) unsigned NOT NULL,
  `game_player1_ping` int(10) unsigned NOT NULL DEFAULT '0',
  `game_player2_ping` int(10) unsigned NOT NULL DEFAULT '0',
  `game_player1_letters` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `game_player2_letters` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `position_goofy_id` tinyint(1) unsigned NOT NULL,
  `position_regular_id` tinyint(1) unsigned NOT NULL,
  `position_name` varchar(10) NOT NULL,
  PRIMARY KEY (`position_goofy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_goofy_id`, `position_regular_id`, `position_name`) VALUES
(1, 4, 'Normal'),
(2, 3, 'Fakie'),
(3, 2, 'Nollie'),
(4, 1, 'Switch');

-- --------------------------------------------------------

--
-- Table structure for table `tricks`
--

DROP TABLE IF EXISTS `tricks`;
CREATE TABLE IF NOT EXISTS `tricks` (
  `trick_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `trick_name` varchar(60) NOT NULL,
  `trick_default_stance` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `trick_stancechange` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `trick_popfoot_left` smallint(3) unsigned NOT NULL,
  `trick_popfoot_top` smallint(3) unsigned NOT NULL,
  `trick_popfoot_direction` smallint(3) unsigned NOT NULL,
  `trick_popfoot_distance` smallint(3) unsigned NOT NULL,
  `trick_frontfoot_top` smallint(3) unsigned NOT NULL,
  `trick_frontfoot_left` smallint(3) unsigned NOT NULL,
  `trick_frontfoot_direction` smallint(3) unsigned NOT NULL,
  `trick_frontfoot_distance` smallint(3) unsigned NOT NULL,
  PRIMARY KEY (`trick_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tricks`
--

INSERT INTO `tricks` (`trick_id`, `trick_name`, `trick_default_stance`, `trick_stancechange`, `trick_popfoot_left`, `trick_popfoot_top`, `trick_popfoot_direction`, `trick_popfoot_distance`, `trick_frontfoot_top`, `trick_frontfoot_left`, `trick_frontfoot_direction`, `trick_frontfoot_distance`) VALUES
(1, 'Kickflip', 1, 1, 274, 355, 333, 2, 142, 297, 61, 102),
(2, 'Varial Kickflip', 1, 1, 269, 355, 356, 91, 163, 279, 49, 95),
(3, 'Heelflip', 1, 1, 275, 351, 315, 7, 153, 239, 86, 98),
(4, 'Varial Heelflip', 1, 1, 239, 349, 183, 66, 167, 241, 93, 99),
(5, 'BS Pop Shove-it', 1, 1, 270, 351, 355, 110, 143, 276, 324, 9),
(6, 'FS Pop Shove-it', 1, 1, 274, 354, 183, 85, 153, 271, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

DROP TABLE IF EXISTS `tutorials`;
CREATE TABLE IF NOT EXISTS `tutorials` (
  `tutorial_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tutorial_trick` mediumint(8) unsigned NOT NULL,
  `tutorial_file` varchar(35) NOT NULL,
  `tutorial_text` text NOT NULL,
  `tutorial_cache` char(10) NOT NULL,
  PRIMARY KEY (`tutorial_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`tutorial_id`, `tutorial_trick`, `tutorial_file`, `tutorial_text`, `tutorial_cache`) VALUES
(1, 1, 'kickflip.mp4', 'The trick Kickflip was invented by Rodney Mullen and originally called "Magic Flip".\r\n\r\nTo do a Kickflip, you should be very confortable with The Ollie.', ''),
(2, 2, 'varialflip.mp4', 'The Varial Kickflip is a combination of the Pop Shove-it and the Kickflip.\r\n\r\nTo do this, you have to be able to pop shove-it and kickflip well.', ''),
(3, 3, 'heelflip.mp4', 'The heelflip is the same as the kickflip, but you spin the skateboard with your front heel.', ''),
(4, 4, 'varialheel.mp4', 'The Varial Heelflip is a combination of front side pop shove-it and the heelflip. The result is an amazing good-looking trick!', ''),
(5, 5, 'popshoveit.mp4', 'The back side pop shove-it is the rotating of the skateboard 180 in ccw direction.', ''),
(6, 6, 'fspopshoveit.mp4', 'The Front Site Pop Shove-it represents the 180 rotation of the skateboard in the clock direction.\r\n\r\nCombining this with the Heelflip you get the Varial Heelflip.', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` char(64) NOT NULL,
  `user_salt` char(10) NOT NULL,
  `user_email` varchar(254) NOT NULL,
  `user_points` int(7) unsigned NOT NULL,
  `user_joined` int(10) NOT NULL,
  `user_last_login` int(10) NOT NULL,
  `user_last_ip` char(16) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `validation`
--

DROP TABLE IF EXISTS `validation`;
CREATE TABLE IF NOT EXISTS `validation` (
  `validation_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `validation_user` mediumint(8) unsigned NOT NULL,
  `validation_status` tinyint(1) unsigned NOT NULL,
  `validation_trick` mediumint(8) NOT NULL,
  `validation_file` varchar(40) NOT NULL,
  PRIMARY KEY (`validation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `validation`
--

