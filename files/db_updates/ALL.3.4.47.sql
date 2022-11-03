ALTER TABLE `sma_costing` ADD COLUMN `transfer_id` int NULL;
UPDATE `sma_settings` SET `version` = '3.4.47' WHERE `setting_id` = 1;
