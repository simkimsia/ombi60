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
class AppController extends Controller {

	public $components = array(
		'Auth',
		'Acl',
		'Session',
		'Security',
		'RequestHandler',
		//'DebugKit.Toolbar',
		'Cookie',
		'RandomString.RandomString',
		'Theme',
	);

	public $helpers = array('Html', 'Form', 'Session', 'Constant', 'TimeZone.TimeZone', 'Ajax');

	//Allowed controllers with actions
	public $sslActions = array(
		'orders' => array('checkout', 'pay'),
		//'products' => array('checkout'),
	);

	public $viewClass = 'TwigView.Twig';

	public $params4GETAndNamed = array();

	public function beforeFilter() {
		//debug($this->Session->read());
		/**
		 * merge the named params and the get params into a single array
		 * with the GET params taking precedence
		 **/
		if (!isset($this->request->params['url'])) {
			$this->request->params['url'] = array();
		}
		$this->params4GETAndNamed = array_merge($this->request->params['named'], $this->request->params['url']);

		$this->Auth->authenticate = array(
				AuthComponent::ALL => array(
					'userModel' => 'User',
					'fields' => array(
						'username' => 'email',
						'password' => 'password')));

		$this->Auth->loginRedirect = array('controller' => 'shops', 'action' => 'index');
		$this->Auth->loginAction = array('controller' => 'customers', 'action' => 'login');
		$this->Auth->authError = __('Sorry, you can\'t access the page requested', true);

		if (isset($this->request->params['admin'])) {
			$this->Auth->loginAction = '/admin/login';
			$this->Auth->loginRedirect = '/admin';
			$this->Auth->logoutRedirect = '/admin/login';
			// this is to set the default layout for admin pages
			if ($this->request->is('ajax') == false) {
				$this->layout = 'admin';
			}
		} else {
			$this->layout = 'theme';
		}

		// allow non users to access register and login actions only.
		$this->Auth->allow('/register', '/admin/login');

		if (Configure::read('Auth.allowAll')) {
			$this->Auth->allow('*');
		}

		/**
		 *for Acl
		 **/
		//$this->Auth->actionPath = 'controllers/';
		$this->Auth->authorize = array(
			'Actions' => array(
				'actionPath' => 'controllers/'),
			//'Controller'
			);
		/**
		 * end of Acl
		 * */

		// worst case scenario is to use env('HTTP_HOST') if FULL_BASE_URL is not good enough
		App::uses('Shop', 'Model');
		$currentShop = $this->Session->read('CurrentShop');

		if(empty($currentShop) OR !$this->checkUrlAgainstDomain(FULL_BASE_URL, $currentShop['Domain']['domain'])) {
			$this->loadModel('Shop');
			$currentShop = $this->Shop->getByDomain(FULL_BASE_URL);
			$this->Session->write('CurrentShop', $currentShop);
		}

		if (!$currentShop) {
			$this->cakeError('noSuchDomain', array('url'=>FULL_BASE_URL));
		}

		Shop::store($currentShop);
		$shopId = Shop::get('Shop.id');
		$shopName = Shop::get('Shop.name');
		$this->Cookie->name = $shopName;
		$this->Cookie->time = '365 days';
		$this->Cookie->key  = 'qwRVVJ@#$%2#7435' . $shopId;

		/**
		 * setup the shopName_for_layout
		 **/
		$this->set('shopName_for_layout', $shopName);

		$userIdInCookie = null;

		App::uses('User', 'Model');
		$this->loadModel('User');

		$shopSetting = $currentShop['ShopSetting'];
		$this->set('shop_setting', $shopSetting);

		if (!isset($this->request->params['admin'])) {
			$userIdInSession = $this->Session->read('User.id');
			$this->log('what ever is the session over here' . $this->Session->read('User'));
			/**
			 * need to overwrite the Cookie User id
			 * from session for products checkout
			 **/
			if ($userIdInSession > 0) {
				$userIdInCookie = $userIdInSession;
				$this->Cookie->write('User.id', $userIdInCookie, true, '1 year');
				$this->log('the user id here ' . $userIdInCookie);
				$this->Session->delete('User.id');
			} else {
				$userIdInCookie = $this->Cookie->read('User.id');
			}

			$userIdInCookieIsLegit = false;

			// need to ensure this userid is legit customer or casual surfer
			if ($userIdInCookie > 0) {
				$userArray = $this->User->find('first', array(
					'conditions' => array(
						'User.id' => $userIdInCookie,
						'OR' => array(
							'User.group_id'=>CUSTOMERS,
							'User.group_id'=>CASUAL)),
					'fields'=>array('User.id')));

				$userIdInCookieIsLegit = is_array($userArray);
				if ($userIdInCookieIsLegit) {
					$userIdInCookie = $userArray['User']['id'];
				} else {
					$userIdInCookie = false;
				}
			}

			if (!$userIdInCookieIsLegit) {
				App::uses('CasualSurfer', 'Model');
				$this->loadModel('CasualSurfer');
				$randomPassword = $this->Auth->password($this->RandomString->generate());
				$randomEmail = $this->RandomString->generate() . '@ombi60.com';
				$userIdInCookie = $this->CasualSurfer->createNew($randomEmail, $randomPassword);
				$this->Cookie->write('User.id', $userIdInCookie, true, '1 year');
			}

			// fetch the main menu of the shop
			$this->loadModel('LinkList');
			$linklists = $this->LinkList->find('all', array(
				'conditions'=>array('LinkList.shop_id'=>$shopId),
				'contain' =>array(
				'Link'=>array(
				'fields'=>array('Link.id',
					'Link.name',
					'Link.route',
					'Link.model',
					'Link.action',
					'Link.order'),
				'order'=>array('Link.order ASC'))),));

			$linklists = LinkList::getTemplateVariable($linklists);

			$this->set('linklists', $linklists);

			$this->loadModel('Blog');
			$blogs = $this->Blog->find('all', array(
				'conditions'=>array('Blog.shop_id'=>$shopId),
				'contain'   =>array(
				'Post'=>array(
					'conditions' => array('Post.visible'=>true),
					'order' => array('Post.created DESC'),
					'limit' => '25'))));
			$blogs = Blog::getTemplateVariable($blogs);
			$this->set('blogs', $blogs);

			// fetch the pages
			$this->loadModel('Webpage');
			$this->Webpage->recursive = -1;
			$this->Webpage->Behaviors->load('Linkable.Linkable');

			$pages = $this->Webpage->find('all', array(
			'contain' => array(
				'Author' => array(
					'fields' => array(
						'Author.name_to_call', 'Author.id'))),
			'conditions'=>array(
				'Webpage.shop_id' => $shopId,
				'Webpage.visible' => true)));

			$pages = Webpage::getTemplateVariable($pages);
			$this->set('pages', $pages);

			// get Shop template
			$shopTemplate = Shop::getTemplateVariable();

			$this->set('shop', $shopTemplate);

			$content_for_header = ''; // we will put the shop specific header scripts
			// and also any other ombi60 stats

			$this->set('content_for_header', $content_for_header);
		}
		/**
		 *end Cookies
		 **/

		$userAuth = $this->Session->check('Auth.User');

		// if admin User Auth more important
		if(isset($this->request->params['admin'])) {
			if ($userAuth) {
				$userAuth = $this->Session->read('Auth');
				User::store($userAuth);
			}
			// else shd prompt for login inside admin

			// if not in admin pages
		} else {
			// we need to allow userIdInCookie to be more important
			if (!$userAuth && $userIdInCookie != null) {
					
				User::store($this->User->read(null, $userIdInCookie ));
					
			} else {
				// crucial if statement that will override User::store with userIdInCookie
				// taking precedence
				if ($userAuth['User']['id'] != $userIdInCookie) {
					User::store($this->User->read(null, $userIdInCookie ));
				} else {
					// since userAuth same as userIdInCookie so we reuse userAuth
					$userAuth = $this->Session->read('Auth');
					User::store($userAuth);
				}
			}

		}

		$locale_name = User::get('Language.locale_name');
		if (!$this->Session->check('Config.language')) {
			if (!$locale_name ||  !isset($locale_name) || empty($locale_name)) {
				$this->Session->write('Config.language', DEFAULT_LANGUAGE);
			} else {
				$this->Session->write('Config.language', $locale_name);
			}
		} else {
			$currentLang =$this->Session->read('Config.language');
			if (!empty($locale_name) && $locale_name != $currentLang) {
				$this->Session->write('Config.language', $locale_name);
			}
		}

		/** check if shop is cancelled
		 **/


		$denied = $currentShop['Shop']['deny_access'];
		if ($denied) {
			$this->cakeError('noSuchDomain');
		} else {

			if(!isset($this->request->params['admin'])) {
				$cart = ClassRegistry::init('Cart');
				$cartItemsCount = $cart->getCartItemsCountByCustomerId(User::get('User.id'));
				$this->set('cartItemsCount', $cartItemsCount);
			}
		}

		$localhostDomain = (strpos(FULL_BASE_URL, '.localhost') > 0);

		// if its admin or an ssl action, we want to force SSL on production or staging server
		if ((isset($this->request->params['admin']) && !$localhostDomain) || (!$localhostDomain && array_key_exists($this->request->params['controller'], $this->sslActions) && in_array($this->request->params['action'], $this->sslActions[$this->request->params['controller']]))) {
			$this->Security->blackHoleCallback = 'forceSSL';
			$this->Security->requireSecure();
		}

		// set the weight unit for shop
		App::uses('ConstantHelper', 'View/Helper');
		//@todo fix this helper call, its a MVC violation
		$constantHelper = new ConstantHelper(new View($this));
		$unitForWeight = $constantHelper->displayUnitForWeight();
		$this->set('unitForWeight', $unitForWeight);

	}

	public function forceSSL() {
		$this->redirect('https://' . env('SERVER_NAME') . $this->request->here);
	}

	protected function checkUrlAgainstDomain($fullBaseUrl, $httpDomainInDB) {
		$fullBaseUrl    = strtolower($fullBaseUrl);
		$httpDomainInDB = strtolower($httpDomainInDB);
		$httpsDomain    = str_replace('http://', 'https://', $httpDomainInDB);

		if ($fullBaseUrl === $httpDomainInDB) {
			return true;
		}

		if ($fullBaseUrl === $httpsDomain) {
			return true;
		}

		return false;

	}

	protected function createCasualInCookie() {
		App::uses('CasualSurfer', 'Model');
		$this->loadModel('CasualSurfer');

		// create new casual surfer
		$randomPassword = $this->Auth->password($this->RandomString->generate());
		$randomEmail = $this->RandomString->generate() . '@ombi60.com';
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
		$publicActions = array('Webpages' => array('view'=>'page',
							   'frontpage'=>'index'),
				       'Posts'    => array('view'=>'article',
							   'index'=>'blog'),
				       'Products' => array('view'=>'product',
							   'view_by_group'=>'collection',
							   'view_cart' => 'cart',)
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
}