DROP DATABASE IF EXISTS `db_cell_phone`;
CREATE DATABASE `db_cell_phone`;
USE `db_cell_phone`;

CREATE TABLE `db_cell_phone`.`users` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `username` VARCHAR(255) UNIQUE,
    `password` TEXT,
    `status` ENUM('ADMIN', 'EMPLOYEE'),
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_cell_phone`.`employees` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED,
    `name` VARCHAR(255),
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`,`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

-- ITEMS
CREATE TABLE `db_cell_phone`.`item_types` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(255) UNIQUE,
    `order` INT UNSIGNED,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `db_cell_phone`.`items` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `item_type_id` BIGINT UNSIGNED,
    `name` VARCHAR(255),
    `price_buy` BIGINT UNSIGNED,
    `price_sell` BIGINT UNSIGNED,
    `stock` INT UNSIGNED,
    `description` TEXT,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`, `item_type_id`),
    FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`)
);

CREATE TABLE `db_cell_phone`.`item_in` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `item_id` BIGINT UNSIGNED,
    `count` INT UNSIGNED,
    `price_buy` BIGINT UNSIGNED,
    `in_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
);

CREATE TABLE `db_cell_phone`.`item_out` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `item_id` BIGINT UNSIGNED,
    `count` INT UNSIGNED,
    `price_sell` BIGINT UNSIGNED,
    `out_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
);

CREATE TABLE `db_cell_phone`.`credits` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(255),
    `balance` BIGINT UNSIGNED,
    `order` TINYINT UNSIGNED,
    PRIMARY KEY (`id`) 
);

CREATE TABLE `db_cell_phone`.`credit_prices` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `credit_id` BIGINT UNSIGNED,
    `amount` BIGINT UNSIGNED,
    `price` BIGINT UNSIGNED,
    `order` TINYINT UNSIGNED,
    PRIMARY KEY (`id`, `credit_id`),
    FOREIGN KEY (`credit_id`) REFERENCES `credits` (`id`)
);

CREATE TABLE `db_cell_phone`.`credit_in` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `credit_id` BIGINT UNSIGNED,
    `amount` INT UNSIGNED,
    `price_buy` BIGINT UNSIGNED,
    `in_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`credit_id`) REFERENCES `credits` (`id`)
);

CREATE TABLE `db_cell_phone`.`credit_out` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `credit_id` BIGINT UNSIGNED,
    `amount` INT UNSIGNED,
    `price_sell` BIGINT UNSIGNED,
    `out_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`credit_id`) REFERENCES `credits` (`id`)
);


CREATE TABLE `db_cell_phone`.`topups` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(255),
    `balance` BIGINT UNSIGNED,
    `order` TINYINT UNSIGNED,
    PRIMARY KEY (`id`) 
);

CREATE TABLE `db_cell_phone`.`topup_prices` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `topup_id` BIGINT UNSIGNED,
    `amount` BIGINT UNSIGNED,
    `price` BIGINT UNSIGNED,
    `order` TINYINT UNSIGNED,
    PRIMARY KEY (`id`, `topup_id`),
    FOREIGN KEY (`topup_id`) REFERENCES `topups` (`id`)
);

CREATE TABLE `db_cell_phone`.`topup_in` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `topup_id` BIGINT UNSIGNED,
    `amount` BIGINT UNSIGNED,
    `price_buy` BIGINT UNSIGNED,
    `in_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`topup_id`) REFERENCES `topups` (`id`)
);

CREATE TABLE `db_cell_phone`.`topup_out` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NULL,
    `topup_id` BIGINT UNSIGNED,
    `amount` BIGINT UNSIGNED,
    `price_sell` BIGINT UNSIGNED,
    `out_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`topup_id`) REFERENCES `topups` (`id`)
);