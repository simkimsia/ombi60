<?php
class MerchantsController extends AppController {

	var $name = 'Merchants';

	var $helpers = array('Javascript', 'Ajax');

	function beforeFilter() {

		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();

		$this->overrideAuth();

		if ($this->action == 'register') {

			// because Security component is turned on
			// hence need to disable any hidden fields that is auto changed by jQuery
			$this->Security->disabledFields[] = 'Shop.web_address';

			// in case the merchant did not turn on Js,
			if (empty($this->data['Shop']['web_address'])) {
				$this->data['Shop']['web_address'] = 'http://' . $this->data['Shop']['subdomain'] . '.myspree2shop.com';
			}


		}

		// add in the extra validation for merchant login
		// ensure that it is the right shop that they want to login to.
		if ($this->RequestHandler->isPost() AND $this->action == 'login') {
			$this->Auth->userScope = array('Merchant.shop_id' => $this->data['Merchant']['shop_id']);
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
		$this->Auth->loginError = __("Login failed. Invalid email or password or web address.", true);

		$this->Auth->loginAction    = '/admin/login';
		$this->Auth->loginRedirect  = '/admin';
		$this->Auth->logoutRedirect = '/admin/login';
	}

	/**
	 * Merchants to register a Merchant account
	 **/
	function register() {

		$this->set('title_for_layout', __('Signup',true));


		if ($this->RequestHandler->isPost()) {

			// hash the confirm password field so that the comparison can be done successfully
			// password is automatically hashed by the Auth component
			$this->data['User']['password_confirm'] = $this->Auth->password($this->data['User']['password_confirm']);

			if ($this->Merchant->signupNewAccount($this->data)) {
				$this->Session->setFlash(__('You\'ve successfully registered.',true));

			} else {
				$this->Session->setFlash(__('Sorry, the information you\'ve entered is incorrect.',true));
			}

			// regardless of success, we must blank out the password fields because we only have the hashed versions
			$this->data['User']['password_confirm'] = NULL;
			$this->data['User']['password']         = NULL;

		}


		$this->set('errors', $this->Merchant->getAllValidationErrors());

	}

	function admin_login() {

		$this->set('title_for_layout', __('Merchant Login',true));


		// to retrieve the shop id based on the url
		// set inside the hidden value of the login form
		$this->set('shop_id', Shop::get('Shop.id'));


		if ($this->Auth->user()) {
			$this->updateSession();
			$this->redirect($this->Auth->redirect());
		}
	}

	function admin_logout() {

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
	}

	private function updateSession() {
		$result = $this->Merchant->retrieveShopUserLanguageByUserId($this->Auth->user('id'));
		$this->updateAuthSessionKey($result);
		
		
	}

	/**
	 * Edit own profile
	 **/
	function admin_edit() {

		$this->set('title_for_layout', sprintf(__('Edit %s\'s profile',true),User::get('User.name_to_call')));


		if (empty($this->data)) {
			$languages = $this->Merchant->User->Language->find('list');
			$this->data = User::getInstance();
			$this->set(compact('languages'));
			return;
		}
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password_confirm'] = $this->Auth->password($this->data['User']['password_confirm']);
		}
		if ($this->Merchant->updateProfile($this->data)) {
			$this->updateSession();
			$this->Session->setFlash(__('Your profile has been saved',true), 'modal', array('class' => 'modal success'));
			$this->redirect('/admin');
		}

		$this->Session->setFlash(__('Your profile could not be saved. Please, try again.', true));

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
			$this->Session->setFlash(__('Invalid Merchant', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('merchant', $this->Merchant->read(null, $id));
	}

	/**
	 * edit 1 merchant data
	 **/
	function platform_edit() {

		if (empty($this->data)) {
			$id = Merchant::get('id');

			$this->data = $this->Merchant->read(null, $id);
			return;
		}

		if ($this->Merchant->save($this->data)) {
			$this->Session->setFlash(__('Your profile has been saved', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Your profile could not be saved. Please, try again.', true));

	}

	/**
	 * delete 1 merchant account
	 **/
	function platform_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Merchant', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Merchant->delete($id)) {
			$this->Session->setFlash(__('Merchant deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Merchant could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * End of Platform functions
	 **/

}
?>