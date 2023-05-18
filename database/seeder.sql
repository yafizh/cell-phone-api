INSERT INTO `db_cell_phone`.`users` (
    `username`,
    `password`,
    `status` 
) VALUES 
('admin', 'admin', 'ADMIN'),
('sahrul', 'sahrul', 'EMPLOYEE');

INSERT INTO `db_cell_phone`.`employees` (
    `user_id`,
    `name` 
) VALUES 
(1, 'sahrul');

INSERT INTO `db_cell_phone`.`item_types` (
    `name`,
    `order` 
) VALUES 
('Aksesoris', 1),
('Casing HP', 2),
('Batrai HP', 3);

INSERT INTO `db_cell_phone`.`item_sales` (
    `employee_id`,
    `sold_at`
) VALUES 
(1, CURRENT_TIMESTAMP);

INSERT INTO `db_cell_phone`.`item_sale_details` (
    `item_sale_id`,
    `item_id`,
    `count`,
    `price`
) VALUES 
(1, 2, 5, 50000);