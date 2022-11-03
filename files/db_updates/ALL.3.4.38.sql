ALTER TABLE `sma_purchase_items` ADD `base_unit_cost` decimal(25,4) NULL;

ALTER TABLE `sma_settings` ADD `ws_barcode_type` varchar(10) NULL DEFAULT 'weight',
  ADD `ws_barcode_chars` tinyint NULL,
  ADD `flag_chars` tinyint NULL,
  ADD `item_code_start` tinyint NULL,
  ADD `item_code_chars` tinyint NULL,
  ADD `price_start` tinyint NULL,
  ADD `price_chars` tinyint NULL,
  ADD `price_divide_by` int NULL,
  ADD `weight_start` tinyint NULL,
  ADD `weight_chars` tinyint NULL,
  ADD `weight_divide_by` int NULL;

UPDATE `sma_settings` SET `version` = '3.4.38' WHERE `setting_id` = 1;
