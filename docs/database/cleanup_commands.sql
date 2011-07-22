TRUNCATE TABLE `vendors`;

TRUNCATE TABLE `products_in_groups`;
TRUNCATE TABLE `smart_collection_conditions`;
TRUNCATE TABLE `product_groups`;
TRUNCATE TABLE `shop_settings`;
TRUNCATE TABLE `product_types`;

DELETE FROM shops WHERE id >= 2;
ALTER TABLE shops AUTO_INCREMENT = 2;

DELETE FROM products WHERE id >= 2;
ALTER TABLE products AUTO_INCREMENT = 2;

DELETE FROM variants WHERE id >= 2;
ALTER TABLE variants AUTO_INCREMENT = 2;

DELETE FROM variant_options WHERE id >= 2;
ALTER TABLE variant_options AUTO_INCREMENT = 2;

DELETE FROM product_images WHERE id >= 2;
ALTER TABLE product_images AUTO_INCREMENT = 2;

DELETE FROM aros WHERE id >= 6;
ALTER TABLE aros AUTO_INCREMENT = 6;

DELETE FROM domains WHERE id >= 2;
ALTER TABLE domains AUTO_INCREMENT = 2;
UPDATE domains SET shop_id = 1 WHERE id = 1;

DELETE FROM aros WHERE id >= 5;
ALTER TABLE aros AUTO_INCREMENT = 5;

DELETE FROM `weight_based_rates` WHERE id >= 3;
ALTER TABLE `weight_based_rates` AUTO_INCREMENT = 3;

DELETE FROM `shipping_rates` WHERE id >= 3;
ALTER TABLE `shipping_rates` AUTO_INCREMENT = 3;

DELETE FROM `shipped_to_countries` WHERE id >= 3;
ALTER TABLE `shipped_to_countries` AUTO_INCREMENT = 3;

DELETE FROM `webpages` WHERE id >= 2;
ALTER TABLE `webpages` AUTO_INCREMENT = 2;



TRUNCATE TABLE merchants;
TRUNCATE TABLE users;
TRUNCATE TABLE casual_surfers;
TRUNCATE TABLE recurring_payment_profiles;
TRUNCATE TABLE invoices;
/*
TRUNCATE TABLE `aros_acos`;
TRUNCATE TABLE aros;
TRUNCATE TABLE `acos`;
*/
TRUNCATE TABLE `cancellations`;
TRUNCATE TABLE `saved_themes`;
TRUNCATE TABLE `paydollar_transactions`;
TRUNCATE TABLE `blogs`;
TRUNCATE TABLE `posts`;
TRUNCATE TABLE `comments`;
TRUNCATE TABLE `price_based_rates`;
TRUNCATE TABLE `custom_payment_modules`;
TRUNCATE TABLE `paypal_payment_modules`;
TRUNCATE TABLE `shops_payment_modules`;
TRUNCATE TABLE `paypal_payers_payments`;
TRUNCATE TABLE `paypal_payers`;
TRUNCATE TABLE `payments`;
TRUNCATE TABLE `shipments`;
TRUNCATE TABLE cart_items;
TRUNCATE TABLE carts;
TRUNCATE TABLE order_line_items;
TRUNCATE TABLE orders;
TRUNCATE TABLE `links`;
TRUNCATE TABLE `link_lists`;
TRUNCATE TABLE `logs`;

/*
INSERT INTO aros (model, foreign_key, alias, lft, rght) VALUES 
('Group', 1, 'administrators', 1, 2),
('Group', 2, 'editors', 3, 4),
('Group', 3, 'merchants', 5, 6),
('Group', 4, 'customers', 7, 8),
('Group', 5, 'casual', 9, 10);*/