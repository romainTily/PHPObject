CREATE TABLE `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NOT NULL,
  `endDate` DATE NOT NULL,
  `beginDate` DATE NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `host` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
