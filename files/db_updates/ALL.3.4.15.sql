ALTER TABLE `sma_product_variants` ADD UNIQUE `unique_product_id_name` (`product_id`, `name`);
UPDATE `sma_settings` SET `version` = '3.4.15' WHERE `setting_id` = 1;
