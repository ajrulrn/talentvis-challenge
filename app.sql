CREATE TABLE `transactions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`category` VARCHAR(255) NOT NULL,
	`type` VARCHAR(255) NOT NULL,
	`amount` INT unsigned NOT NULL,
	`balance` INT unsigned NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);