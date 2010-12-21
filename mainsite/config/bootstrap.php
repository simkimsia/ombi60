<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 *
 *  Production Mode
 **/
Configure::write('debug', 0);


/**
 * load the config file of the paypal  + paydollar plugin
 **/

Configure::load('Paypal.config');
Configure::load('Paydollar.config');


/**
 * Subscription system to be used
 * */
define('PAYPALEXPRESSCHECKOUT', 'paypalec');
define('PAYDOLLAR', 'paydollar');
Configure::write('SubscriptionUsed', PAYDOLLAR);


/**
 *
 * bootstrap.local.php file can override certain settings for local development purposes
 **/
if (file_exists(dirname(__FILE__) . '/bootstrap.local.php')) {

    require_once('bootstrap.local.php');
}

define('DEFAULT_LANGUAGE', 'eng');



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
// we need to point this to the app folder so this will be different from the usual
//define('UPLOADS_PATH', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . UPLOADS_DIR . DS);
define('UPLOADS_PATH', ROOT . DS . 'app' . DS . WEBROOT_DIR . DS . UPLOADS_DIR . DS);
define('PRODUCTS_DIR', 'products' );
define('THUMB_DIR', 'thumb' );
define('SMALL_DIR', 'small');
define('LARGE_DIR', 'large');
define('MEDIUM_DIR', 'medium');
define('ICON_DIR', 'icon');

// for pointing back to app folder www_root
define('APP_WWW_ROOT', ROOT . DS . 'app' . DS . WEBROOT_DIR . DS);
define('ORI_WWW_ROOT', ROOT . DS . 'mainsite' . DS . WEBROOT_DIR . DS);

// these will be different as well
define('PRODUCT_IMAGES_PATH', UPLOADS_PATH. PRODUCTS_DIR . DS);
define('PRODUCT_IMAGES_THUMB_PATH', UPLOADS_PATH . PRODUCTS_DIR . DS . THUMB_DIR . DS);


define('PRODUCT_IMAGES_THUMB_SMALL_PATH', PRODUCT_IMAGES_THUMB_PATH . SMALL_DIR . DS);
define('PRODUCT_IMAGES_THUMB_LARGE_PATH', PRODUCT_IMAGES_THUMB_PATH . LARGE_DIR . DS);
define('PRODUCT_IMAGES_THUMB_MEDIUM_PATH', PRODUCT_IMAGES_THUMB_PATH . MEDIUM_DIR . DS);
define('PRODUCT_IMAGES_THUMB_ICON_PATH', PRODUCT_IMAGES_THUMB_PATH . ICON_DIR . DS);
define('PRODUCT_IMAGES_THUMB_THUMB_PATH', PRODUCT_IMAGES_THUMB_PATH . THUMB_DIR . DS);

// default free theme
define('DEFAULT_FREE_THEME', 3);