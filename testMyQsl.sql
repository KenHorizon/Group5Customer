CREATE TABLE `account` (
  `id` int UNIQUE PRIMARY KEY AUTO_INCREMENT COMMENT 'Account ID++',
  `name` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `isAdmin` tinyint NOT NULL,
  `birthday` int NOT NULL
);

CREATE TABLE `membership` (
  `id` integer PRIMARY KEY,
  `name` varchar(64) NOT NULL,
  `isAdmin` tinyint,
  `time` timestamp
);

ALTER TABLE `account` ADD FOREIGN KEY (`id`) REFERENCES `membership` (`id`);

ALTER TABLE `account` ADD FOREIGN KEY (`name`) REFERENCES `membership` (`name`);

ALTER TABLE `account` ADD FOREIGN KEY (`isAdmin`) REFERENCES `membership` (`isAdmin`);
