CREATE TABLE IF NOT EXISTS `sma_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `subject_type` varchar(55) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `orig_name` varchar(100) NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
UPDATE `sma_settings` SET `version` = '3.4.42' WHERE `setting_id` = 1;
