CREATE TABLE `transactions` (
	`id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
	`category` VARCHAR(255) NOT NULL,
	`type` VARCHAR(255) NOT NULL,
	`amount` INT unsigned NOT NULL,
	`balance` INT unsigned NOT NULL,
    `note` TEXT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(255) NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO users (username, name, password) VALUES ('feon', 'Feon', '$2y$10$takgRD8aQTBeq45CK8V63uWjklHRFsK6hISJ/wecjsAOth1oTnJRK');
INSERT INTO users (username, name, password) VALUES ('vira', 'Vira', '$2y$10$takgRD8aQTBeq45CK8V63uWjklHRFsK6hISJ/wecjsAOth1oTnJRK');