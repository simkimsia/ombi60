<?php

// these are constants that must stay constant regardless of environment settings

/**
 * dependent on database having a groups table and the id for
 *  administrators is 1
 *  editors is 2
 *  merchants is 3
 *  customers is 4
 **/
define('ADMINISTRATORS', 1);
define('EDITORS', 2);
define('MERCHANTS', 3);
define('CUSTOMERS', 4);
define('CASUAL', 5);

/**
 * Address type
 * billing address is 1
 * delivery address is 2
 **/
define('BILLING', 1);
define('DELIVERY', 2);

/**
 * default dummy product
 * the original copy of the product that is duplicated whenever a new shop is created.
 * the id 1 should be occupied by this default product in products table with a shop_id of 0
 * an image of this product should be stored in product_images table as well at id 1.
 **/
define('DEFAULT_PRODUCT_ID', 1);

/**
 * UPLOADS url constants
 **/
define('UPLOADS_URL', 'uploads/');
define('UP_ONE_DIR_LEVEL', '../');


define('PRODUCT_IMAGES_URL', UPLOADS_URL . 'products/');
define('PRODUCT_IMAGES_THUMB_URL', PRODUCT_IMAGES_URL . 'thumb/');
define('PRODUCT_IMAGES_THUMB_SMALL_URL', PRODUCT_IMAGES_THUMB_URL . 'small/');
define('PRODUCT_IMAGES_THUMB_MEDIUM_URL', PRODUCT_IMAGES_THUMB_URL . 'medium/');
define('PRODUCT_IMAGES_THUMB_LARGE_URL', PRODUCT_IMAGES_THUMB_URL . 'large/');
define('PRODUCT_IMAGES_THUMB_THUMB_URL', PRODUCT_IMAGES_THUMB_URL . 'thumb/');
define('PRODUCT_IMAGES_THUMB_ICON_URL', PRODUCT_IMAGES_THUMB_URL . 'icon/');

/**
 * UPLOADS directory constants
 **/
define('UPLOADS_DIR', 'uploads' );
define('UPLOADS_PATH', ROOT . DS . 'app' . DS . WEBROOT_DIR . DS . UPLOADS_DIR . DS);
define('PRODUCTS_DIR', 'products' );
define('THUMB_DIR', 'thumb' );
define('SMALL_DIR', 'small');
define('LARGE_DIR', 'large');
define('MEDIUM_DIR', 'medium');
define('ICON_DIR', 'icon');

define('PRODUCT_IMAGES_PATH', ROOT . DS . 'app' . DS . WEBROOT_DIR . DS . UPLOADS_DIR . DS . PRODUCTS_DIR . DS);
define('PRODUCT_IMAGES_THUMB_PATH', ROOT . DS . 'app' . DS . WEBROOT_DIR . DS . UPLOADS_DIR . DS . PRODUCTS_DIR . DS . THUMB_DIR . DS);
define('PRODUCT_IMAGES_THUMB_SMALL_PATH', PRODUCT_IMAGES_THUMB_PATH . SMALL_DIR . DS);
define('PRODUCT_IMAGES_THUMB_LARGE_PATH', PRODUCT_IMAGES_THUMB_PATH . LARGE_DIR . DS);
define('PRODUCT_IMAGES_THUMB_MEDIUM_PATH', PRODUCT_IMAGES_THUMB_PATH . MEDIUM_DIR . DS);
define('PRODUCT_IMAGES_THUMB_ICON_PATH', PRODUCT_IMAGES_THUMB_PATH . ICON_DIR . DS);
define('PRODUCT_IMAGES_THUMB_THUMB_PATH', PRODUCT_IMAGES_THUMB_PATH . THUMB_DIR . DS);

// SavedThemeFolder Path
define('SAVED_THEMES_DIR', ROOT . DS . 'app' . DS . 'View' . DS . 'Themed' . DS );

// default free theme
define('DEFAULT_FREE_THEME', 3);

/**
 * ORDERS fulfillment status
 **/
define('FULFILLMENT_NOT_FULFILLED', 1);
define('FULFILLMENT_PARTIAL', 2);
define('FULFILLMENT_FULFILLED', 0);

/**
 * ORDERS PAYment status
 *
 * AUTHORIZED can go to VOIDED
 * PAID can go to REFUNDED
 * ONLY AUTHORIZED and PAID can lead to CANCELLATION of ORDER
 * EVERYTHING CAN LEAD TO CLOSED ORDER
 *
 **/
define('PAYMENT_AUTHORIZED', 1);
define('PAYMENT_PENDING', 3);
define('PAYMENT_PAID', 2);
define('PAYMENT_ABANDONED', 0);
define('PAYMENT_REFUNDED', 4);
define('PAYMENT_VOIDED', 5);


/**
 * ORDERS status
 * ONLY ClOSED / CANCELLED ORDERS can be DELETED
 **/
define('ORDER_CREATED', 0); // when order is created, it means that the checkout button is pressed
define('ORDER_OPENED', 1); // when order is opened, it means that payment is at least initialized
define('ORDER_CANCELLED', 2); // when order is cancelled by customer
define('ORDER_CLOSED', 3); // when order automatically closed by system or closed by merchant
define('ORDER_DELETED', -1); // when order deleted. 



/**
 * Payment module id
 **/
define('PAYPAL_PAYMENT_MODULE', 2);
define('CUSTOM_PAYMENT_MODULE', 1);

/**
 * Collection type
**/
define('SMART_COLLECTION', 1);
define('CUSTOM_COLLECTION', 0);


/**
 * Default for variant
 ***/
define('VARIANT_DEFAULT_TITLE', 'Default Title');

/**
 * Visible, hidden or all products/collections/posts/whatever objects/entities
 * */
define('HIDDEN_ENTITY', 0);
define('VISIBLE_ENTITY', 1);
define('HIDDEN_AND_VISIBLE_ENTITY', 2);

/**
* default language 
**/
define('DEFAULT_LANGUAGE', 'eng');


/**
 * 
 * path to the temporary folder inside www_root
 */
define('WWW_ROOT_TMP', ROOT . DS . 'app' . DS . WEBROOT_DIR . DS . 'tmp' . DS);

/**
 * 
 * path to the custom prints folder inside tmp folder within www_root
 */
define('TMP_CUSTOM_PRINTS', WWW_ROOT_TMP . 'custom_prints' . DS);