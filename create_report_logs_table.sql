CREATE TABLE `report_logs` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`type_error` VARCHAR(70) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`message` TEXT NULL COLLATE 'utf8_unicode_ci',
	`trace` TEXT NULL COLLATE 'utf8_unicode_ci',
	`file` TEXT NULL COLLATE 'utf8_unicode_ci',
	`line` INT(11) NULL DEFAULT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
