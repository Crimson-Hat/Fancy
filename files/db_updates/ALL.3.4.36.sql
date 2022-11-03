ALTER TABLE `sma_costing` ADD `purchase_id` int NULL;
UPDATE `sma_settings` SET `version` = '3.4.36' WHERE `setting_id` = 1;
