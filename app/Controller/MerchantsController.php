<?php
class MerchantsController extends AppController {

	var $name = 'Merchants';

	var $helpers = array('Javascript', 'Ajax',
			     'Log.Log');
	
	function beforeFilter() {

		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();

		$this->overrideAuth();

		if ($this->request->action == 'register') {

			// because Security component is turned on
			// hence need to disable any hidden fields that is auto changed by jQuery
			$this->Security->disabledFields[] = 'Shop.primary_domain';

			// in case the merchant did not turn on Js,
			if (empty($this->request->data['Shop']['primary_domain'])) {
				$this->request->data['Shop']['primary_domain'] = 'http://' . $this->request->data['Shop']['subdomain'] . '.myspree2shop.com';
			}


		}

		// add in the extra validation for merchant login
		// ensure that it is the right shop that they want to login to.
		if ($this->RequestHandler->isPost() AND $this->request->action == 'login') {
			$this->Auth->userScope = array('Merchant.shop_id' => $this->request->data['Merchant']['shop_id']);
		}

	}

	private function overrideAuth() {
		/**
		 * because of Auth default settings do not work for Merchant, hence alot of fields need to be overridden.
		 **/

		// allow non users to access register and login actions only.
		$this->Auth->allow('register', 'login', 'logout');
		//$this->Auth->allow('*');

		// need to set this as false so that extra logic can be done in the action login
		$this->Auth->autoRedirect = false;

		// override the default login error message
		$this->Auth->loginError = __("Login failed. Invalid email or password or web address.");

		$this->Auth->loginAction    = '/admin/login';
		$this->Auth->loginRedirect  = '/admin';
		$this->Auth->logoutRedirect = '/admin/login';
	}

	/**
	 * Merchants to register a Merchant account
	 **/
	function register() {

		$this->set('title_for_layout', __('Signup'));


		if ($this->RequestHandler->isPost()) {

			// hash the confirm password field so that the comparison can be done successfully
			// password is automatically hashed by the Auth component
			$this->request->data['User']['password_confirm'] = $this->Auth->password($this->request->data['User']['password_confirm']);

			if ($this->Merchant->signupNewAccount($this->request->data)) {
				$this->Session->setFlash(__('You\'ve successfully registered.'));

			} else {
				$this->Session->setFlash(__('Sorry, the information you\'ve entered is incorrect.'));
			}

			// regardless of success, we must blank out the password fields because we only have the hashed versions
			$this->request->data['User']['password_confirm'] = NULL;
			$this->request->data['User']['password']         = NULL;

		}


		$this->set('errors', $this->Merchant->getAllValidationErrors());

	}

	function admin_login() {

		$this->set('title_for_layout', __('Merchant Login'));


		// to retrieve the shop id based on the url
		// set inside the hidden value of the login form
		$this->set('shop_id', Shop::get('Shop.id'));


		if ($this->Auth->user()) {
			
			// this code is for the remember me when Merchant first logs in and chooses the remember me
			if (!empty($this->request->data) & $this->request->data['User']['remember_me']) {
				$cookie = array('email'    => $this->request->data['User']['email'],
						'password' => $this->request->data['User']['password'],);
				
				$this->updateCookie();
				
				unset($this->request->data['User']['remember_me']);
				
			}
			
			$this->updateSession();
			$this->redirect($this->Auth->redirect());
			
		}
		
		if (empty($this->request->data)) {

			$cookie = $this->Cookie->read('Auth.User');

			if (!is_null($cookie)) {
		
				if ($this->Auth->login($cookie)) {
		
					//  Clear auth message, just in case we use it.
			
					$this->Session->delete('Message.auth');
			
					$this->redirect($this->Auth->redirect());
		
				} else { // Delete invalid Cookie
		
					$this->Cookie->delete('Auth.User');
				}
			}
		}
		
	}

	function admin_logout() {

		$this->Cookie->delete('Auth.User');
		$this->Cookie->delete('Auth.Merchant');
		$this->Cookie->delete('Auth.Shop');
		$this->Session->delete('Auth.Merchant');
		$this->Session->delete('Auth.Shop');
		$this->redirect($this->Auth->logout());

	}

	/**
	 * Merchants admin functions
	 *
	 **/

	/**
	 * Admin dashboard page
	 **/
	function admin_index() {
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->paginate());
		$log = ClassRegistry::init('Log.Log');
		$this->set('logs', $log->find('dashboard'));
	}

	private function updateSession() {
		$result = $this->Merchant->retrieveShopUserLanguageByUserId($this->Auth->user('id'));
		$this->updateAuthSessionKey($result);
	}
	
	private function updateCookie() {
		$result = $this->Merchant->retrieveShopUserLanguageByUserId($this->Auth->user('id'));
		$this->updateAuthCookieKey($result);
	}

	/**
	 * Edit own profile
	 **/
	function admin_edit() {

		$this->set('title_for_layout', sprintf(__('Edit %s\'s profile'),User::get('User.name_to_call')));


		if (empty($this->request->data)) {
			$languages = $this->Merchant->User->Language->find('list');
			$this->request->data = User::getInstance();
			$this->set(compact('languages'));
			return;
		}
		if (isset($this->request->data['User']['password'])) {
			$this->request->data['User']['password_confirm'] = $this->Auth->password($this->request->data['User']['password_confirm']);
		}
		if ($this->Merchant->updateProfile($this->request->data)) {
			$this->updateSession();
			$this->Session->setFlash(__('Your profile has been saved'), 'modal', array('class' => 'modal success'));
			$this->redirect('/admin');
		}

		$this->Session->setFlash(__('Your profile could not be saved. Please, try again.'));

	}
	
	
	

	/**
	 * End of Merchants admin functions
	 **/

	/**
	 * Platform functions
	 **/

	/**
	 * get all merchants
	 **/
	function platform_index() {
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->paginate());
	}

	/**
	 * get 1 merchant view
	 **/
	function platform_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Merchant'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('merchant', $this->Merchant->read(null, $id));
	}

	/**
	 * edit 1 merchant data
	 **/
	function platform_edit() {

		if (empty($this->request->data)) {
			$id = Merchant::get('id');

			$this->request->data = $this->Merchant->read(null, $id);
			return;
		}

		if ($this->Merchant->save($this->request->data)) {
			$this->Session->setFlash(__('Your profile has been saved'));
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Your profile could not be saved. Please, try again.'));

	}

	/**
	 * delete 1 merchant account
	 **/
	function platform_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Merchant'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Merchant->delete($id)) {
			$this->Session->setFlash(__('Merchant deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Merchant could not be deleted. Please, try again.'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * End of Platform functions
	 **/

}
?>