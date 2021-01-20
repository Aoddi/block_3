-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(10) NOT NULL,
  `hex` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `colors` (`id`, `color`, `hex`) VALUES
(1,	'green',	'#008000'),
(2,	'yellow',	'#FFFF00'),
(3,	'black',	'#000000'),
(4,	'red',	'#B22222'),
(5,	'purple',	'#9370DB'),
(6,	'gray',	'#808080'),
(7,	'pink',	'#FF69B4');

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1,	'Registered user',	'did not pass moderation'),
(2,	'User entitled to write messages',	'passed moderation');

DROP TABLE IF EXISTS `group_user`;
CREATE TABLE `group_user` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `group_user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_user` (`group_id`, `user_id`) VALUES
(2,	1),
(2,	3),
(2,	4);

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `header` varchar(15) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `read_message_flag` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `messages_ibfk_5` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_ibfk_6` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_ibfk_8` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `messages` (`id`, `text`, `header`, `datetime`, `read_message_flag`, `section_id`, `sender_id`, `recipient_id`) VALUES
(1,	'Привет, почему не пришел на работу?',	'от Иры',	'2021-01-16 12:03:43',	1,	4,	2,	1),
(2,	'ВЫ ВЫИГРАЛИ 1000000',	'ВЫ ВЫИГРАЛИ',	'2021-01-16 12:04:52',	0,	3,	3,	1),
(8,	'Го в спб?))',	'Дороу',	'2021-01-20 11:41:03',	0,	5,	1,	1),
(9,	'вот тз',	'новый проект',	'2021-01-20 13:05:03',	1,	4,	1,	1);

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_id` int(11) DEFAULT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `color_id` (`color_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `sections_ibfk_10` FOREIGN KEY (`parent_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  CONSTRAINT `sections_ibfk_9` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sections` (`id`, `color_id`, `name`, `datetime`, `user_id`, `parent_id`) VALUES
(1,	NULL,	'Основные',	'2020-12-15 23:15:00',	1,	NULL),
(2,	NULL,	'Оповещения',	'2020-12-15 18:15:00',	1,	NULL),
(3,	NULL,	'Спам',	'2020-12-15 23:15:00',	1,	NULL),
(4,	4,	'по работе',	'2020-12-15 18:15:00',	1,	1),
(5,	NULL,	'личные',	'2021-01-16 11:26:53',	1,	1),
(6,	NULL,	'форумы',	'2021-01-16 11:27:14',	1,	2),
(7,	NULL,	'магазины',	'2021-01-16 11:27:29',	1,	2),
(8,	NULL,	'подписки',	'2021-01-16 11:27:52',	1,	2);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_flag` int(1) NOT NULL DEFAULT '0',
  `full_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email_notifications_flag` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `activity_flag`, `full_name`, `email`, `phone`, `password`, `email_notifications_flag`) VALUES
(1,	1,	'Ivanov Ivan Ivanovich',	'IvanII@ya.ru',	'9279444051',	'$2y$10$IXVKhWkWko/8PUaOX5mSJOHLSzXUuBcFdV4s90nmJHqGHNga7JmKa',	0),
(2,	0,	'Stepanov Stepan Stepanovich',	'StepanovichSS@gmail.com',	'9244567890',	'$2y$10$IXVKhWkWko/8PUaOX5mSJOHLSzXUuBcFdV4s90nmJHqGHNga7JmKa',	0),
(3,	0,	'Antonov Anton Antonovich',	'AntonovAA@mail.com',	'9876543211',	'$2y$10$IXVKhWkWko/8PUaOX5mSJOHLSzXUuBcFdV4s90nmJHqGHNga7JmKa',	0),
(4,	0,	'Mironov Miron Mironovich',	'MironovMM@glist.com',	'9123456789',	'$2y$10$IXVKhWkWko/8PUaOX5mSJOHLSzXUuBcFdV4s90nmJHqGHNga7JmKa',	0),
(5,	0,	'Mutin Vladimir Vladimirovich',	'MutinVV@ya.ru',	'9998887766',	'$2y$10$hjqXxiAM8iDNVguvfd6mQu/BShAJwvDAZc8S6QeganGK/3qNNXeCi',	0);

-- 2021-01-20 18:06:28
