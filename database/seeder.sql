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
('Power Bank', 3),
('Screen Guard', 4),
('Armband dan Smartwatch', 5),
('Tongsis', 6),
('Gameklip atau Bluetooth Gamepad', 7),
('USB OTG/Kabel USB OTG', 8),
('Pop Socket', 9),
('Speaker atau Headset Bluetooth', 10),
('Handphone Holder', 11),
('Spiral Cord', 12);

INSERT INTO `db_cell_phone`.`balances` (
    `name`,
    `balance`,
    `order` 
) VALUES (
    'APP1',
    0,
    1
);