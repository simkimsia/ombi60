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

    var $components = array(
        'Auth',
        'Acl',
        'Session',
        'Security',
        'RequestHandler',
	'DebugKit.Toolbar',
	'Cookie',
	'RandomString.RandomString', );

    var $helpers = array('Html', 'Form', 'Session');

    function beforeFilter() {

        /**
         *Configure AuthComponent
         **/

        // need to override the default field names to email and password
	$this->Auth->fields = array('username' => 'email', 'password' => 'password');
        $this->Auth->authorize = 'actions';

        if (isset($this->params['admin'])) {
		$this->Auth->loginAction = '/admin/login';
		$this->Auth->loginRedirect = '/admin';
		$this->Auth->logoutRedirect = '/admin/login';

		// this is to set the default layout for admin pages
		if ($this->RequestHandler->isAjax() == false) {
			$this->layout = 'admin';
		}


        } 

        // allow non users to access register and login actions only.
        $this->Auth->allow('/register', '/admin/login');

        if (Configure::read('Auth.allowAll')) {
		$this->Auth->allow('*');
        }

        /**
         *  End of Configure AuthComponent
         **/


        /**
         *for Acl
         **/
        $this->Auth->actionPath = 'controllers/';
        /**
         * end of Acl
         * */

     
	
	// worst case scenario is to use env('HTTP_HOST') if FULL_BASE_URL is not good enough
	App::import('Model', 'Shop');
	$currentShop = $this->Session->read('CurrentShop');

	if(empty($currentShop) OR $currentShop['Domain']['domain'] != FULL_BASE_URL) {
	    $this->loadModel('Shop');
	    $currentShop = $this->Shop->getByDomain(FULL_BASE_URL);
	    $this->Session->write('CurrentShop', $currentShop);
	}
        Shop::store($currentShop);
	
	/** setup cookies
	 * */
	
	$shopId = Shop::get('Shop.id');
	$this->Cookie->name = Shop::get('Shop.name');
	$this->Cookie->time = '365 days';
	$this->Cookie->key  = 'qwRVVJ@#$%2#7435' . $shopId;
	
	$userIdInCookie = null;
	
	if(!isset($this->params['admin'])) { 
	
		$userIdInCookie = $this->Cookie->read('User.id');
		
		if (!$userIdInCookie) {
			App::import('Model', 'CasualSurfer');
			$this->loadModel('CasualSurfer');
			
			$randomPassword = $this->Auth->password($this->RandomString->generate());
			$randomEmail = $this->RandomString->generate() . '@ombi60.com';
			$userIdInCookie = $this->CasualSurfer->createNew($randomEmail, $randomPassword);
			
			$this->Cookie->write('User.id', $userIdInCookie, true, '1 year');
		}
		$this->log($userIdInCookie);
	}
	/**
	 *end Cookies
	 **/
	
	App::import('Model', 'User');
	$userAuth = $this->Session->check('Auth.User');
	if (!$userAuth && $userIdInCookie != null) {
		$this->loadModel('User');
		User::store($this->User->read(null, $userIdInCookie ));
		
	} else {
		$userAuth = $this->Session->read('Auth');
		User::store($userAuth);	
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
	    //$this->cakeError('error404');
	}
	
    }
    
    protected function createCasualInCookie() {
	App::import('Model', 'CasualSurfer');
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
    
    	function admin_change_active_status($id = null, $product_id = null) {
		if (!$id OR !$product_id) {
			$this->Session->setFlash(__('Invalid id for ProductImage', true));
			$this->redirect(array('action' => 'index'));
		}

		if ($this->ProductImage->change_active_status($id)) {
			$this->Session->setFlash(__('ProductImage status changed', true));
			$this->redirect(array('controller' => 'products',
					 'action' => 'edit',
					 'admin' => true,
					 $product_id,
					 '#' => 'images'
					));
		}
		$this->Session->setFlash(__('The status of ProductImage could not be changed. Please, try again.', true));
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
	
	protected function setClassInLayoutOrView() {
		$this->set('classForContainer', 'homepage');
		$this->set('contentElementInOverallContainer', 'homeBody');
	}


}
?>