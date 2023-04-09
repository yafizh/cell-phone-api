CREATE DATABASE `db_cell_phone`;

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
    `price` BIGINT UNSIGNED,
    `stock` INT UNSIGNED,
    `description` TEXT,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`, `item_type_id`),
    FOREIGN KEY (`item_type_id`) REFERENCES `item_types` (`id`)
);

CREATE TABLE `db_cell_phone`.`item_supplies` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `supplied_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `db_cell_phone`.`item_supply_details` (
    `item_supply_id` BIGINT UNSIGNED,
    `item_id` BIGINT UNSIGNED,
    `count` INT UNSIGNED,
    `price` BIGINT UNSIGNED,
    PRIMARY KEY (`item_supply_id`, `item_id`),
    FOREIGN KEY (`item_supply_id`) REFERENCES `item_supplies` (`id`),
    FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
);

CREATE TABLE `db_cell_phone`.`item_sales` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `employee_id` BIGINT UNSIGNED,
    `sold_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`)
);

CREATE TABLE `db_cell_phone`.`item_sale_details` (
    `item_sale_id` BIGINT UNSIGNED,
    `item_id` BIGINT UNSIGNED,
    `count` INT UNSIGNED,
    `price` BIGINT UNSIGNED,
    PRIMARY KEY (`item_sale_id`, `item_id`),
    FOREIGN KEY (`item_sale_id`) REFERENCES `item_sales` (`id`),
    FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
);