-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2015 at 01:38 PM
-- Server version: 5.5.44-37.3-log
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `charle72_penny_drop`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `complete_survey`$$
CREATE DEFINER=`charle72`@`localhost` PROCEDURE `complete_survey`(IN `in_userid` INT, IN `in_surveyid` INT)
BEGIN
	declare to_add int;
	declare available int;
	declare current int;
 	set to_add = (select amount_earnable from survey where id = in_surveyid);
 	set available = (select available_surveys from survey where id = in_surveyid);
 	set current = (select pennies_available from user where id = in_userid);
	UPDATE user set pennies_available = current+to_add where id = in_userid;
	UPDATE survey set available_surveys = available-1 where id = in_surveyid;
	UPDATE user_survey set completion_date = NOW() where userid = in_userid and surveyid = in_surveyid;
END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `user_completed_survey`$$
CREATE DEFINER=`charle72`@`localhost` FUNCTION `user_completed_survey`(`in_userid` INT, `in_surveyid` INT) RETURNS tinyint(4)
    DETERMINISTIC
begin 
  declare question_count int;
  declare response_count int;
  declare user_survey_id int;
  set user_survey_id = (select id from user_survey where userid = in_userid and surveyid = in_surveyid);
  set question_count = (select count(*) from question where surveyid = in_surveyid);
  set response_count = (select count(*) from response where user_surveyid = user_survey_id); 
  return question_count <= response_count and (select exists(select * from user_survey where id = user_survey_id and completion_date is null));
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `charity`
--

DROP TABLE IF EXISTS `charity`;
CREATE TABLE IF NOT EXISTS `charity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

DROP TABLE IF EXISTS `donation`;
CREATE TABLE IF NOT EXISTS `donation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `charityid` bigint(20) DEFAULT NULL,
  `surveyid` bigint(20) DEFAULT NULL,
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `payment_complete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FKdonation956579` (`userid`),
  KEY `FKdonation420865` (`charityid`),
  KEY `FKdonation363513` (`surveyid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `donationid` bigint(20) NOT NULL,
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `processed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FKpayment729661` (`donationid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surveyid` bigint(20) NOT NULL,
  `question` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FKquestion352141` (`surveyid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

DROP TABLE IF EXISTS `response`;
CREATE TABLE IF NOT EXISTS `response` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_surveyid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `response` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FKresponse895189` (`questionid`),
  KEY `FKresponse568484` (`user_surveyid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Triggers `response`
--
DROP TRIGGER IF EXISTS `question_response`;
DELIMITER //
CREATE TRIGGER `question_response` AFTER INSERT ON `response`
 FOR EACH ROW begin
  declare survey_id int;
  declare user_id int;
  declare survey_complete tinyint default 0;
  declare user_survey int;
  set user_survey = (select user_surveyid from response where id = NEW.id);
  set survey_id = (select surveyid from user_survey where id = user_survey);
  set user_id = (select userid from user_survey where id = user_survey);
  set survey_complete = (select user_completed_survey(user_id, survey_id));
  if survey_complete then
    call complete_survey(user_id, survey_id);
  end if;

end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
CREATE TABLE IF NOT EXISTS `survey` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` longtext,
  `available_surveys` bigint(20) NOT NULL DEFAULT '0',
  `amount_earnable` bigint(20) NOT NULL DEFAULT '0',
  `payment_fulfilled` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `survey_costs`
--
DROP VIEW IF EXISTS `survey_costs`;
CREATE TABLE IF NOT EXISTS `survey_costs` (
`id` bigint(20)
,`total` bigint(39)
);
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `pennies_available` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_survey`
--

DROP TABLE IF EXISTS `user_survey`;
CREATE TABLE IF NOT EXISTS `user_survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `surveyid` bigint(20) NOT NULL,
  `completion_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FKuser_surve124334` (`surveyid`),
  KEY `FKuser_surve527163` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure for view `survey_costs`
--
DROP TABLE IF EXISTS `survey_costs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`charle72`@`localhost` SQL SECURITY DEFINER VIEW `survey_costs` AS select `survey`.`id` AS `id`,(`survey`.`available_surveys` * `survey`.`amount_earnable`) AS `total` from `survey`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `FKdonation363513` FOREIGN KEY (`surveyid`) REFERENCES `survey` (`id`),
  ADD CONSTRAINT `FKdonation420865` FOREIGN KEY (`charityid`) REFERENCES `charity` (`id`),
  ADD CONSTRAINT `FKdonation956579` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FKpayment729661` FOREIGN KEY (`donationid`) REFERENCES `donation` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FKquestion352141` FOREIGN KEY (`surveyid`) REFERENCES `survey` (`id`);

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `FKresponse568484` FOREIGN KEY (`user_surveyid`) REFERENCES `user_survey` (`id`),
  ADD CONSTRAINT `FKresponse895189` FOREIGN KEY (`questionid`) REFERENCES `question` (`id`);

--
-- Constraints for table `user_survey`
--
ALTER TABLE `user_survey`
  ADD CONSTRAINT `FKuser_surve527163` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FKuser_surve124334` FOREIGN KEY (`surveyid`) REFERENCES `survey` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
