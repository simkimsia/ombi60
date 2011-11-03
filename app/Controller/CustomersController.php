<?php
class CustomersController extends AppController {

	public $name = 'Customers';

	public $helpers = array('Html', 'Form', 'Session');

	//var $helpers = array('Html', 'Form', 'Session', 'Recaptcha');

	//var $components = array('Session', 'Recaptcha');

	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		/**
		 * because of Auth default settings do not work for Merchant, hence alot of fields need to be overridden.
		 **/
		// allow non users to access register and login actions only.
		$this->Auth->allow('register', 'login', 'logout');

		$this->Auth->loginAction    = '/login';
		$this->Auth->loginRedirect  = '/';
		$this->Auth->logoutRedirect = '/login';
		// need to set this as false so that extra logic can be done in the action login
		$this->Auth->autoRedirect = false;
	}


	/**
	 * Customers to register a Customers account
	 **/
	public function register() {

		$this->set('title_for_layout', __('Signup'));

		// to retrieve the shop id based on the url
		// set inside the hidden value of the login form
		$this->set('shop_id', Shop::get('Shop.id'));

		if ($this->request->is('post')) {
			// hash the confirm password field so that the comparison can be done successfully
			// password is automatically hashed by the Auth component
			$this->request->data['User']['password_confirm'] = AuthComponent::password($this->request->data['User']['password_confirm']);
			$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
				
			if ($this->Customer->signupNewAccount($this->request->data)) {
				$this->Session->setFlash(__('You\'ve successfully registered.'), 'default', array('class'=>'flash_success'));
				$this->redirect('/');

			} else {
				$this->Session->setFlash(__('Sorry, the information you\'ve entered is incorrect.'), 'default', array('class'=>'flash_failure'));
			}


			// regardless of success, we must blank out the password fields because we only have the hashed versions
			$this->request->data['User']['password_confirm'] = NULL;
			$this->request->data['User']['password'] = NULL; 	
		}

		$this->set('errors', $this->Customer->getAllValidationErrors());

	}

	public function login() {
		$shopId = Shop::get('Shop.id');
		$cartId = $this->request->data['Customer']['cart_uuid'];
		// to retrieve the shop id based on the url
		// set inside the hidden value of the login form
		$this->set('shop_id', $shopId);

		// for orders/checkout reauthenticate
		// check if coming from orders/checkout
		$comingFromOrdersCheckout = isset($this->request->data['Customer']['fromCheckout']);
		if ($comingFromOrdersCheckout) {
			if ($this->request->is('post')) {
				if ($this->request->data['User']['new_user']) {
					$this->request->data['User']['password_confirm'] = AuthComponent::password($this->request->data['User']['password_confirm']);
					$noHashedPwd = $this->request->data['User']['password'];
					$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
					if (!$this->Customer->signupNewAccount($this->request->data)) {
						debug($this->Customer->getAllValidationErrors());
						die();
						$this->Session->setFlash(__('Sorry, the information you\'ve entered is incorrect.'), 'default', array('class'=>'flash_failure'));
						$redirect = Router::url(array('controller' => 'carts',
								'action' => 'user_type',
								'shop_id' => $shopId,
								'cart_uuid' => $cartId,
						), true);
						$this->redirect($redirect);
					} 
					$this->request->data['User']['password'] = $noHashedPwd;
					
				}
				if(isset($this->request->data['loginBtn'])) {
					// proceed as normal for login -> checkout process
				} else if (isset($this->request->data['checkoutBtn'])) {
					// we need to retrieve the cart
					$redirect = Router::url(array('controller' => 'carts',
						'action' => 'view',
						'shop_id' => $shopId,
						'cart_uuid' => $cartId,
									), true);
					$this->redirect($redirect);
				}
			}
		} 

		// successfully login
		if ($this->request->is('post')) {
			if ($this->Auth->login() &&$this->Auth->user()) {
			// retrieve current id from Cookie
				$userIdInCookie = $this->Cookie->read('User.id');
				// take current cart of Casual Surfer and dump them for logged in Customer
				$loggedInUserId = $this->Auth->user('id');
				$this->Cookie->write('User.id', $loggedInUserId);
				$this->updateSession();
	
				if ($comingFromOrdersCheckout) {
					$redirect = Router::url(array('controller' => 'carts',
						'action' => 'view',
						'shop_id' => $shopId,
						'cart_uuid' => $cartId,
									), true);
					$this->redirect($redirect);
				}
				
				$this->redirect($this->Auth->redirect());
			} else {
				if ($comingFromOrdersCheckout) {
					$this->Session->setFlash(__('Sorry, the login/password combination is incorrect.'), 'default', array('class'=>'flash_failure'));
					$redirect = Router::url(array('controller' => 'carts',
											'action' => 'user_type',
											'shop_id' => $shopId,
											'cart_uuid' => $cartId,
					), true);
					$this->redirect($redirect);
				} 
			}
		}
	}

	protected function logoutFunction() {
		$this->Session->delete('Auth.Customer');
		$this->Session->delete('Auth.Shop');
		$this->Session->delete('Auth.User');

		// clear cart session data
		$this->Session->delete('Shop.' . Shop::get('Shop.id') . '.cart');
	}

	public function logout() {
		$this->logoutFunction();
		$this->redirect($this->Auth->logout());

	}

	private function updateSession() {
		$result = $this->Customer->findByUserId($this->Auth->user('id'));
		$this->updateAuthSessionKey($result);
	}
}