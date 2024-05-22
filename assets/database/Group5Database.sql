CREATE TABLE `user` (
  `uuid` integer PRIMARY KEY,
  `email` varchar(255),
  `bio` varchar(255) DEFAULT '',
  `profile` varchar(255) DEFAULT '',
  `header` varchar(255) DEFAULT '',
  `type` tinyint(1) COMMENT '0: User or 1: Admin'
);

CREATE TABLE `account` (
  `uuid` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `username` varchar(255) DEFAULT '',
  `contact` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `email` varchar(255) UNIQUE DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `gender` varchar(255) DEFAULT '',
  `birthday` date,
  `created_at` timestamp,
  `activated` tinyint(1)
);

CREATE TABLE `membership` (
  `uuid` integer PRIMARY KEY,
  `email` varchar(255) DEFAULT '',
  `type` tinyint(1) COMMENT '0: Basic or 1: Advance',
  `level` int DEFAULT 1,
  `category` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT 0,
  `expiration` integer DEFAULT 0,
  `subscription_date` integer DEFAULT 0
);

CREATE TABLE `config` (
  `uuid` integer PRIMARY KEY,
  `email` varchar(255),
  `digital_clock` tinyint(1) DEFAULT 0,
  `birthday_year` tinyint(1) DEFAULT 0,
  `sensetive_information` tinyint(1) DEFAULT 0
);

ALTER TABLE `account` ADD FOREIGN KEY (`uuid`) REFERENCES `membership` (`uuid`);

ALTER TABLE `account` ADD FOREIGN KEY (`uuid`) REFERENCES `user` (`uuid`);

ALTER TABLE `account` ADD FOREIGN KEY (`uuid`) REFERENCES `config` (`uuid`);
