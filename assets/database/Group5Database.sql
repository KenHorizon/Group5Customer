CREATE TABLE `user` (
  `uuid` integer UNIQUE,
  `email` varchar(255),
  `bio` varchar(255),
  `profile` varchar(255),
  `type` tinyint(1) COMMENT '0: User or 1: Admin'
);

CREATE TABLE `timer` (
  `uuid` integer UNIQUE,
  `email` varchar(255) UNIQUE,
  `subscription` int DEFAULT: 0,
  `session` int DEFAULT: 0,
  `banned` int DEFAULT: 0,
  `verification` int DEFAULT: 0,
  `attempt` int DEFAULT: 0
);

CREATE TABLE `account` (
  `uuid` integer UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255),
  `username` varchar(255),
  `email` varchar(255) UNIQUE,
  `password` varchar(255),
  `gender` varchar(255),
  `birthday` date,
  `created_at` timestamp,
  `activated` tinyint(1)
);

CREATE TABLE `membership` (
  `uuid` integer UNIQUE,
  `email` varchar(255) UNIQUE,
  `type` tinyint(1) COMMENT '0: Basic or 1: Advance',
  `level` int DEFAULT 1,
  `category` varchar(255)
);

ALTER TABLE `membership` ADD FOREIGN KEY (`uuid`) REFERENCES `account` (`uuid`);

ALTER TABLE `user` ADD FOREIGN KEY (`uuid`) REFERENCES `account` (`uuid`);

ALTER TABLE `timer` ADD FOREIGN KEY (`email`) REFERENCES `account` (`email`);
