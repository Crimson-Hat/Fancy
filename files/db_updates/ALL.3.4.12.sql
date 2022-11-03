CREATE TABLE IF NOT EXISTS `sma_promos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `product2buy` int(11) NOT NULL,
  `product2get` int(11) NOT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `description` text NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
ALTER TABLE `sma_products` ADD `hide_pos` TINYINT(1) NOT NULL DEFAULT '0';
UPDATE `sma_settings` SET `version` = '3.4.12' WHERE `setting_id` = 1;
