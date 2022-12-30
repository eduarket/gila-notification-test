-- Adminer 4.8.1 MySQL 5.5.5-10.9.2-MariaDB-1:10.9.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `notifications_logs`;
CREATE TABLE `notifications_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageType` varchar(255) NOT NULL,
  `notificationType` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPhoneNumber` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `sent` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;


-- 2022-12-30 03:40:49