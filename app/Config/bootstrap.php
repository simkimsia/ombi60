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

CakePlugin::loadAll();

/**
 *
 *  Production Mode
 **/
Configure::write('debug', 2);

/**
*
* Asset timestamping
*
**/
Configure::write('Asset.timestamp', 'force');

/**
 *
 * constants.php file to define constants that remain same regardless of environments
 **/
if (file_exists(APP . DS. 'Config' . DS . 'constants.php')) {

    require_once(APP . DS . 'Config' . DS . 'constants.php');
}

/**
 * production checkout link
 **/
define('CHECKOUT_LINK', 'https://checkout.ombi60.com');
define('CHECKOUT_LINK_LOCALHOST', 'https://checkout.ombi60.localhost');
if (isset($_SERVER['SERVER_NAME']) && strpos($_SERVER['SERVER_NAME'], 'localhost') !== false) {
	Configure::write('currentCheckoutLink', CHECKOUT_LINK_LOCALHOST);	
} else {
	Configure::write('currentCheckoutLink', CHECKOUT_LINK);
}



/**
 * for ease of configuration
 * to set the $this->Auth->allow('*') inside beforeFilter inside app_controller
 * set this value to true
 * otherwise set to false
 *
 * Production mode always set to false
 **/
Configure::write('Auth.allowAll', false);



Configure::write('Payment.PayPal', 2);


/**
 * load the config file of the paypal + paydollar plugin
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
 * Configure arrays in Twig to have size, first and last properties
 **/
define('TWIG_ITERATOR', false);


/**
 * for TwigView plugin
 * // change the cache for twig view from TWIG_VIEW_CACHE to TMP/cache/views
 **/
define('TWIG_VIEW_CACHE', TMP.'cache'.DS.'views');


/**
 *
 * bootstrap.local.php file can override certain settings for local development purposes
 **/
if (file_exists(dirname(__FILE__) . '/bootstrap.local.php')) {

    require_once('bootstrap.local.php');
}


/**
 * this is to include the Zend Framework files i need for Zend_Lucene
 **/

//ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . CAKE_CORE_INCLUDE_PATH . DS . 'vendors');
// function __autoload($path) {
// if (substr($path, 0, 5) == 'Zend_') {
// include str_replace('_', '/', $path) . '.php';
// }
// return $path;
// }


	
/**
 * this is to allow getting ip addresses by domains
 **/
	function is_blank($variable) {
		return (empty($variable) && !is_numeric($variable));
	}        

// debug(APP . 'Plugin' . DS .'TwigView' . DS .'vendors' . DS .'Twig' . DS .'lib' . DS .'Twig' . DS .'Autoloader.php');
define('TWIG_PLUGIN', APP . 'Plugin' . DS .'TwigView');

// we want to load the original Twig from fabpot
require_once  TWIG_PLUGIN . DS .'vendors' . DS .'Twig' . DS .'lib' . DS .'Twig' . DS .'Autoloader.php';
Twig_Autoloader::register();

// we also want to load the Twig-extensions from fabpot
require_once  TWIG_PLUGIN . DS .'vendors' . DS .'Twig-extensions' . DS .'lib' . DS .'Twig' . DS . 'Extensions' . DS . 'Autoloader.php';
Twig_Extensions_Autoloader::register();



App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
App::uses('Sanitize', 'Utility');