<?php
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
/**
 * @property Webpage Webpage
 * @property Blog Blog
 * @property LinkList LinkList
 * @property User User
 * @property Shop Shop
 * @property RandomStringComponent RandomString
 * @property CasualSurfer CasualSurfer
 * @property ProductImage ProductImage
 */
class AppController extends Controller {

	public $components = array(
		//'StoreSession',
        'Auth',
        'Acl',
        'Session',
        'Security',
        'RequestHandler',
        'Cookie',
        'Paginator',
	);

	public $helpers = array('Html', 'Form', 'Session');

	//Allowed controllers with actions
	public $sslActions = array(
		'orders' => array('checkout', 'pay'),
		//'products' => array('checkout'),
	);

	//public $viewClass = 'TwigView.Twig';

	public $params4GETAndNamed = array();

	public function beforeFilter() {

		$this->log('something');

		if (Configure::read('debug')) {
			$this->Toolbar = $this->Components->load('DebugKit.Toolbar');
		}
		/**
		 * merge the named params and the get params into a single array
		 * with the GET params taking precedence
		 **/
		if (!isset($this->request->params['url'])) {
			$this->request->params['url'] = array();
		}
		$this->params4GETAndNamed = array_merge($this->request->params['named'], $this->request->params['url'],$this->request->query);
		$this->Auth->authenticate = array(
	        	'Form' => array(
	        		'fields' => array('username' => 'email', 'password' => 'password'), 
					'userModel' => 'User',
					'scope' => array('User.status' => 1)
				),
		);
		$this->Auth->loginRedirect = array('controller' => 'shops', 'action' => 'index');
		$this->Auth->loginAction = array('controller' => 'customers', 'action' => 'login');
		$this->Auth->authError = __("Sorry, you can't access the page requested", true);
		//$this->Auth->authorize = 'actions';

		if (isset($this->request->params['admin'])) {
			$this->Auth->loginAction = '/admin/login';
			$this->Auth->loginRedirect = '/admin';
			$this->Auth->logoutRedirect = '/admin/login';
			// this is to set the default layout for admin pages
			if ($this->request->is('ajax') == false) {
				$this->layout = 'admin';
			}
		} else {
			 
			$this->layout = 'default';
		}

		// allow non users to access register and login actions only.
		$this->Auth->allow('/register', '/admin/login');
		if (Configure::read('Auth.allowAll')) {
			$this->Auth->allow('*');
		}
		
		/**
		 *for Acl
		 **/
		$this->Auth->actionPath = 'controllers/';
		/**
		 * end of Acl
		 * */

		$this->Cookie->name = 'OMBI60';
		$this->Cookie->time = '365 days';
		$this->Cookie->key  = 'qwRVVJ@#$%2#7435_ombi60' ;
		
		/**
		 *end Cookies
		 **/
	}

	public function forceSSL() {
		$domain1 = $_SERVER['SERVER_NAME'];
		$domain2 = env('SERVER_NAME');
		$this->redirect('https://' . $domain1 . $this->request->here);
	}

	protected function createCasualInCookie() {
		App::uses('CasualSurfer', 'Model');
		$this->loadModel('CasualSurfer');

		// create new casual surfer
		App::uses('StringLib', 'UtilityLib.Lib');
		
		$randomPassword = $this->Auth->password(StringLib::generateRandom());
		$randomEmail 	= StringLib::generateRandom() . '@ombi60.com';
		$userIdInCookie = $this->CasualSurfer->createNew($randomEmail, $randomPassword);

		$this->Cookie->write('User.id', $userIdInCookie, true, '1 year');
	}

	protected function updateAuthSessionKey($data = NULL) {
		if (!empty($data['Merchant'])) {
			$this->Session->write('Auth.Merchant', $data['Merchant']);
		} else {
			$this->Session->delete('Auth.Merchant');
		}

		if (!empty($data['Shop'])) {
			$this->Session->write('Auth.Shop', $data['Shop']);
		} else {

			$this->Session->delete('Auth.Shop');
		}

		if (!empty($data['Customer'])) {
			$this->Session->write('Auth.Customer', $data['Customer']);
		} else {

			$this->Session->delete('Auth.Customer');
		}

		if (!empty($data['User'])) {
			unset($data['User']['password']);
			$this->Session->write('Auth.User', $data['User']);
		}
	  
		if (!empty($data['Language'])) {
			$this->Session->write('Auth.Language', $data['Language']);
		} else {
			$this->Session->delete('Auth.Language');
		}

	}

	protected function updateAuthCookieKey($data = NULL) {
		if (!empty($data['Merchant'])) {
			$this->Cookie->write('Auth.Merchant', $data['Merchant'], true, '+2 weeks');
		} else {
			$this->Cookie->delete('Auth.Merchant');
		}

		if (!empty($data['Shop'])) {
			$this->Cookie->write('Auth.Shop', $data['Shop'], true, '+2 weeks');
		} else {

			$this->Cookie->delete('Auth.Shop');
		}

		if (!empty($data['Customer'])) {
			$this->Cookie->write('Auth.Customer', $data['Customer'], true, '+2 weeks');
		} else {

			$this->Cookie->delete('Auth.Customer');
		}

		if (!empty($data['User'])) {
			// we need to write in everything including the password
			$this->Cookie->write('Auth.User', $data['User'], true, '+2 weeks');
		}
	  
		if (!empty($data['Language'])) {
			$this->Cookie->write('Auth.Language', $data['Language'], true, '+2 weeks');
		} else {
			$this->Cookie->delete('Auth.Language');
		}

	}

	public function admin_change_active_status($id = null, $product_id = null) {
		if (!$id OR !$product_id) {
			$this->Session->setFlash(__('Invalid id for ProductImage'));
			$this->redirect(array('action' => 'index'));
		}

		if ($this->ProductImage->change_active_status($id)) {
			$this->Session->setFlash(__('ProductImage status changed'));
			$this->redirect(array('controller' => 'products',
					 'action' => 'edit',
					 'admin' => true,
			$product_id,
					 '#' => 'images'
					 ));
		}
		$this->Session->setFlash(__('The status of ProductImage could not be changed. Please, try again.'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * this returns the class attribute value meant for UI display in the div
 * called overallContainer found in most views
 **/
	protected function configureContainerClass($controller, $action) {
		$actions_class_values =
		array('products' => array('view_cart' => 'cart',
						  'view' => 'catalogueitem',
						  'index' => 'catalogue'));

		$controller = strtolower($controller);
		$action = strtolower($action);

		if(isset($actions_class_values[$controller][$action])) {
			return $actions_class_values[$controller][$action];
		}

		return '';
	}

	public function beforeRender() {
		$this->setViewPathForTwig();
	}

/**
 *
 * Sets the $this->viewPath to templates for public facing actions
 * which are using Twig. Also sets the template name
 *
 * Possibly consider renaming the actions so that setting template name is easier
 * */
	private function setViewPathForTwig() {
		// public actions to be set to templates
		// capitalize and pluralize the controller apparently
		// array([controllerName] => array([action]=>templatename))
		$publicActions = array(
			'Webpages'	=> array(
				'view'		=> 'page',
				'frontpage'	=> 'index'
			),
			'Posts'		=> array(
				'view'	=> 'article',
				'index'	=> 'blog'
			),
			'Products'	=> array(
				'view'				=> 'product',
				'view_by_group'		=> 'collection',
				'view_within_group' => 'product',
			),
			'Carts' 	=> array(
				'view_cart'	=> 'cart',
			)
		);
		
		$controller 	= $this->name;
		$action 	= $this->request->action;

		$validControllers = array_keys($publicActions);

		if (in_array($controller, $validControllers)) {
			$validActions = array_keys($publicActions[$controller]);
			if (in_array($action, $validActions)) {
				// set the view path
				$this->viewPath = 'templates';
				// set the template name variable
				$templateName = $publicActions[$controller][$action];
				$this->set('template', $templateName);
			}
		}
	}
	
	

/*
 @todo implement AppController::cakeError stub
	function cakeError($method, $messages = array()) {
        if (file_exists(APP . 'AppError.php')) {
				include_once (APP . 'AppError.php');
		}

		if (class_exists('AppError')) {
			$error = new AppError($method, $messages);
		}
		
	}
*/
}