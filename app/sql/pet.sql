DROP TABLE `type`;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE `pet`;
CREATE TABLE `pet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(1) NOT NULL,
  `sick` int(1) NOT NULL DEFAULT 0,
  `full` int(1) NOT NULL DEFAULT 0,
  `clean` int(1) NOT NULL DEFAULT 0,
  `food` int(11) NOT NULL DEFAULT 0,
  `star` int(11) NOT NULL DEFAULT 0,
  `last_feed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_bathe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_evolve` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE `cheat`;
CREATE TABLE `cheat` (
    `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `type` VALUES (1, "Egg", "Isn't it obvious enough that I'm an egg?");
INSERT INTO `type` VALUES (2, "Bird", "What did you expect? Did you think an egg will evolve into a plant?");
INSERT INTO `pet` VALUES (1, 1, 0, 3, 2, 10, 1, NOW(), NOW(), NOW(), NOW(), NOW(), NOW());
INSERT INTO `pet` VALUES (2, 2, 0, 0, 5, 3, 2, NOW(), NOW(), NOW(), NOW(), NOW(), NOW());
