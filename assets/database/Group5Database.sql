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
  `uuid` integer PRIMARY KEY,
  `email` varchar(255),
  `type` tinyint(1) COMMENT '0: Basic or 1: Advance',
  `level` int DEFAULT 1,
  `category` varchar(255),
  `status` tinyint(1) DEFAULT 0,
  `expiration` integer DEFAULT 0,
  `subscription_date` integer DEFAULT 0
);

ALTER TABLE `account` ADD FOREIGN KEY (`uuid`) REFERENCES `membership` (`uuid`);

ALTER TABLE `account` ADD FOREIGN KEY (`uuid`) REFERENCES `user` (`uuid`);
