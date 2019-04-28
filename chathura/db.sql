CREATE DATABASE IF NOT EXISTS `comment_system` CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `comment_system` . `comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `message` TEXT DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;