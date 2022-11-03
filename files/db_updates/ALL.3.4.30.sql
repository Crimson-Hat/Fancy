ALTER TABLE `sma_shop_settings` ADD `stripe` tinyint(1) DEFAULT '0';
ALTER TABLE `sma_settings` ADD `use_code_for_slug` TINYINT(1) NULL DEFAULT NULL;
UPDATE `sma_settings` SET `version` = '3.4.30' WHERE `setting_id` = 1;
