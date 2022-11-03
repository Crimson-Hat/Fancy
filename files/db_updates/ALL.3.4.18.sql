ALTER TABLE `sma_returns` ADD `shipping` DECIMAL(25,4) NULL DEFAULT '0';
UPDATE `sma_settings` SET `version` = '3.4.18' WHERE `setting_id` = 1;
