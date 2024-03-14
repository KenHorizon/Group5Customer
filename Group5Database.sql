CREATE TABLE `account` (
  `uuid` integer,
  `name` varchar(255),
  `username` varchar(255),
  `email` varchar(255),
  `password` varchar(255),
  `age` integer,
  `birthday` integer,
  `isAdmin` bool,
  `phoneNumber` integer,
  `rank` varchar(255),
  `level` integer
);

CREATE TABLE `login` (
  `name` varchar(255),
  `username` varchar(255),
  `email` varchar(255),
  `password` varchar(255)
);

CREATE TABLE `register` (
  `uuid` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(64),
  `username` varchar(64),
  `email` varchar(64),
  `password` varchar(12),
  `birthday` integer,
  `isAdmin` bool,
  `phoneNumber` integer(11)
);

CREATE TABLE `membership` (
  `uuid` integer,
  `name` varchar(255),
  `username` varchar(255),
  `email` varchar(255),
  `password` varchar(255)
);

ALTER TABLE `register` ADD FOREIGN KEY (`uuid`) REFERENCES `account` (`uuid`);

ALTER TABLE `account` ADD FOREIGN KEY (`uuid`) REFERENCES `membership` (`uuid`);

ALTER TABLE `register` ADD FOREIGN KEY (`name`) REFERENCES `account` (`name`);

ALTER TABLE `register` ADD FOREIGN KEY (`username`) REFERENCES `account` (`username`);

ALTER TABLE `register` ADD FOREIGN KEY (`email`) REFERENCES `account` (`email`);

ALTER TABLE `register` ADD FOREIGN KEY (`password`) REFERENCES `account` (`password`);

ALTER TABLE `register` ADD FOREIGN KEY (`birthday`) REFERENCES `account` (`birthday`);

ALTER TABLE `register` ADD FOREIGN KEY (`isAdmin`) REFERENCES `account` (`isAdmin`);

ALTER TABLE `register` ADD FOREIGN KEY (`phoneNumber`) REFERENCES `account` (`phoneNumber`);

ALTER TABLE `login` ADD FOREIGN KEY (`username`) REFERENCES `account` (`username`);

ALTER TABLE `login` ADD FOREIGN KEY (`password`) REFERENCES `account` (`password`);

ALTER TABLE `login` ADD FOREIGN KEY (`name`) REFERENCES `account` (`name`);

ALTER TABLE `account` ADD FOREIGN KEY (`name`) REFERENCES `membership` (`name`);

ALTER TABLE `account` ADD FOREIGN KEY (`username`) REFERENCES `membership` (`name`);

ALTER TABLE `account` ADD FOREIGN KEY (`email`) REFERENCES `membership` (`email`);

ALTER TABLE `account` ADD FOREIGN KEY (`password`) REFERENCES `membership` (`password`);
