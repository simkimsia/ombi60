DELETE FROM shops WHERE id >= 2;
ALTER TABLE shops AUTO_INCREMENT = 2;

DELETE FROM products WHERE id >= 2;
ALTER TABLE products AUTO_INCREMENT = 2;

DELETE FROM product_images WHERE id >= 2;
ALTER TABLE product_images AUTO_INCREMENT = 2;

DELETE FROM aros WHERE id >= 6;
ALTER TABLE aros AUTO_INCREMENT = 6;

DELETE FROM domains WHERE id >= 2;
ALTER TABLE domains AUTO_INCREMENT = 2;

DELETE FROM aros WHERE id >= 5;
ALTER TABLE aros AUTO_INCREMENT = 5;


TRUNCATE TABLE merchants;
TRUNCATE TABLE users;
TRUNCATE TABLE casual_surfers;
TRUNCATE TABLE recurring_payment_profiles;
TRUNCATE TABLE invoices;
TRUNCATE TABLE `aros_acos`;
TRUNCATE TABLE aros;
TRUNCATE TABLE `acos`;


INSERT INTO aros (model, foreign_key, alias, lft, rght) VALUES 
('Group', 1, 'administrators', 1, 2),
('Group', 2, 'editors', 3, 4),
('Group', 3, 'merchants', 5, 6),
('Group', 4, 'customers', 7, 8),
('Group', 5, 'casual', 9, 10);