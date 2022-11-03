ALTER TABLE `sma_customer_groups` ADD `discount` tinyint NULL;
CREATE TABLE `sma_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` varchar(190) NOT NULL,
  `model` longtext NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
UPDATE `sma_settings` SET `version` = '3.4.40' WHERE `setting_id` = 1;
