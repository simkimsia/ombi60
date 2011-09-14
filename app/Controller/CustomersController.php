<?php
class CustomersController extends AppController {

	public $name = 'Customers';

	public $helpers = array('Html', 'Form', 'Session');

	//var $helpers = array('Html', 'Form', 'Session', 'Recaptcha');

	//var $components = array('Session', 'Recaptcha');

	public function beforeFilter() {

		/*
		 //public & private keys for reCAPTCHA
		 $this->Recaptcha->publickey = "";
		 $this->Recaptcha->privatekey = "";
		 */

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

		// $this->Auth->allow('*');
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
			$this->request->data['User']['password_confirm'] = $this->Auth->password($this->request->data['User']['password_confirm']);

			/*
			 if($this->Recaptcha->valid($this->request->params['form'])) {
				if ($this->Customer->signupNewAccount($this->request->data)) {
				$this->Session->setFlash('You\'ve successfully registered.', 'default', array('class'=>'flash_success'));

				} else {
				$this->Session->setFlash('Sorry, the information you\'ve entered is incorrect.', 'default', array('class'=>'flash_failure'));
				}
				} else {
				$this->Session->setFlash('Sorry, the captcha code you\'ve entered is incorrect.', 'default', array('class'=>'flash_failure'));
				}
			*/

			if ($this->Customer->signupNewAccount($this->request->data)) {
				$this->Session->setFlash(__('You\'ve successfully registered.'), 'default', array('class'=>'flash_success'));

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
		$this->set('title_for_layout', __('Customer Login'));

		$shopId = Shop::get('Shop.id');
		// to retrieve the shop id based on the url
		// set inside the hidden value of the login form
		$this->set('shop_id', $shopId);

		// for orders/checkout reauthenticate
		// check if coming from orders/checkout
		$comingFromOrdersCheckout = $this->Session->check('Shop.' . $shopId . '.checkoutRedirect');
		if ($comingFromOrdersCheckout) {
			if (!$this->Session->check('Auth.User')) {
				$this->render('login_for_checkout');
			}
			if ($this->request->is('get')) {
				// if come from orders/checkout we kill the Auth
				$this->logoutFunction();
			} else if ($this->request->is('post')) {
				if(isset($this->request->params['form']['loginBtn'])) {
					// proceed as normal for login -> checkout process
				} else if (isset($this->request->params['form']['checkoutBtn'])) {
					// need to clear cookies for user id
					$this->Cookie->delete('User.id');
					// kill the session by storing
					$this->Session->delete('Auth.redirect');
					// declare in Session its a pass
					$this->Session->write('Shop.' . $shopId . '.checkoutRedirectPass', true);

					// create this casual surfer in this cookie
					$this->createCasualInCookie();
					// move the cart for this casual surfer
					$newUserId = $this->Cookie->read('User.id');
					$this->Customer->User->Cart->transferCartFromUserToAnother(User::get('User.id'),
					$newUserId);
					// we need to retrieve the cart
					$cart = $this->Customer->User->Cart->getLiveCartByCustomerId($newUserId);

					$redirect = Router::url(array('controller' => 'orders',
									'action' => 'checkout',
									'hash' => $cart['Cart']['hash'],
									'shop_id' => $shopId), true);
					$this->logoutFunction();
					$this->redirect($redirect);
				}
			}
		}

		if ($this->request->is('post')) {
			$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
			if ($this->Auth->login($this->request->data['User']) && $this->Auth->user()) {

				$userIdInCookie = $this->Cookie->read('User.id');
				// take current cart of Casual Surfer and dump them for logged in Customer
				$loggedInUserId = $this->Auth->user('id');
				$this->Customer->User->CasualSurfer->convertCartForCustomerLogin($userIdInCookie, $loggedInUserId);
				$this->Cookie->write('User.id', $loggedInUserId);
				$this->updateSession();
	
				if ($comingFromOrdersCheckout) {
					// if come from orders/checkout we kill the session storing
					$this->Session->delete('Shop.' . $shopId . '.checkoutRedirect');
					// declare in Session its a pass
					$this->Session->write('Shop.' . $shopId . '.checkoutRedirectPass', true);
				}
				$this->redirect($this->Auth->redirect());
			} else {
				unset($this->request->data['User']['password']);
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