<?php 
/* SVN FILE: $Id$ */
/* Spree2shop schema generated on: 2010-04-22 16:04:09 : 1271954109*/
class Spree2shopSchema extends CakeSchema {
	var $name = 'Spree2shop';

	var $file = 'schema_2.php';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $addresses = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'address' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'city' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'region' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'zip_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'country' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $aros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $aros_acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'aro_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'aco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1), 'aro_id' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $cart_items = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'cart_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'product_price' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'product_quantity' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4),
		'status' => array('type' => 'string', 'null' => true, 'default' => '2', 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $carts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created_on' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'amount' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'status' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $groups = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'created_on' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified_on' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $merchants = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'owner' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'shop_web_address' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $order_line_items = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'order_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'product_price' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'product_quantity' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4),
		'status' => array('type' => 'string', 'null' => true, 'default' => '2', 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $orders = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'billing_address_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'delivery_address_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'order_no' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'created_on' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'amount' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'status' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $page_types = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $payments = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $product_images = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $products = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2'),
		'created_on' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified_on' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'status' => array('type' => 'string', 'null' => true, 'default' => '1', 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $shops = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'theme_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'web_address' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'created_on' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified_on' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'status' => array('type' => 'string', 'null' => true, 'default' => '1', 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'full_name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'name_to_call' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'last_login_on' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'status' => array('type' => 'string', 'null' => false, 'default' => '1', 'length' => 1),
		'created_on' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified_on' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $webpages = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'page_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'text' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created_on' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'modified_on' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'meta_title' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'meta_keywords' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'meta_description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	var $wishlists = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'customer_id' => array('column' => array('customer_id', 'product_id'), 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
}
?>