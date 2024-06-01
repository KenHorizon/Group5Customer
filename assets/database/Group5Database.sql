CREATE TABLE `account` (
  `uuid` int(11) PRIMARY KEY NOT NULL,
  `name` varchar(255) DEFAULT null,
  `username` varchar(255) DEFAULT null,
  `email` varchar(255) DEFAULT null,
  `password` varchar(255) DEFAULT null,
  `gender` varchar(255) DEFAULT null,
  `birthday` date DEFAULT null,
  `created_at` timestamp NOT NULL DEFAULT (current_timestamp()),
  `activated` tinyint(1) DEFAULT null,
  `contact` varchar(20) DEFAULT null,
  `address` varchar(255) NOT NULL
);

CREATE TABLE `config` (
  `uuid` int(11) DEFAULT null,
  `email` varchar(255) DEFAULT null,
  `digital_clock` tinyint(1) DEFAULT 0,
  `birthday_year` tinyint(1) DEFAULT 0,
  `sensitive_information` tinyint(1) DEFAULT 0
);

CREATE TABLE `membership` (
  `uuid` int(11) DEFAULT null,
  `email` varchar(255) DEFAULT null,
  `type` tinyint(1) DEFAULT null COMMENT '0: Basic or 1: Advance',
  `level` int(11) DEFAULT 1,
  `category` varchar(255) DEFAULT null,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `expiration` int(11) NOT NULL DEFAULT 0,
  `subscription_date` int(11) NOT NULL DEFAULT 0
);

CREATE TABLE `user` (
  `uuid` int(11) DEFAULT null,
  `email` varchar(255) DEFAULT null,
  `bio` varchar(255) DEFAULT null,
  `profile` varchar(255) DEFAULT null,
  `header` varchar(255) DEFAULT null,
  `type` tinyint(1) DEFAULT null COMMENT '0: User or 1: Admin'
);

ALTER TABLE `config` ADD CONSTRAINT `config_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `account` (`uuid`);

ALTER TABLE `membership` ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `account` (`uuid`);

ALTER TABLE `user` ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `account` (`uuid`);
