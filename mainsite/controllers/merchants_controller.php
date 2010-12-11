<?php
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
class MerchantsController extends AppController {

	var $name = 'Merchants';
	
	var $components = array('Paypal.Paypal');

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
		$this->Auth->allow('register', 'login', 'logout', 'confirm', 'complete', 'sec');
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
	function register($plan = null) {

		$this->set('title_for_layout', __('Signup',true));
		
		if ($plan == null) {
			$this->redirect('/pages/pricing-signup');
		}

		if ($this->RequestHandler->isPost()) {

			// hash the confirm password field so that the comparison can be done successfully
			// password is automatically hashed by the Auth component
			$this->data['User']['password_confirm'] = $this->Auth->password($this->data['User']['password_confirm']);
			
			$this->data['Invoice']['title'] = $plan;
			$this->data['Invoice']['description'] = 'Initial signup';

			if ($result = $this->Merchant->signupNewAccount($this->data)) {
				
				// so now we go to paypal
				if ($this->params['form']['submit'] == 'paypalExpressCheckout') {
					$PaypalResult = $this->prepareSEC($result['Invoice']['id']);
					
					$this->Session->write('Subscription.Paypal.TOKEN', $PaypalResult['TOKEN']);
					
					if (isset($PaypalResult['REDIRECTURL']))
						$this->redirect($PaypalResult['REDIRECTURL']);
				}
				
				$this->Session->setFlash(__('You\'ve successfully registered.',true));

			} else {
				$this->Session->setFlash(__('Sorry, the information you\'ve entered is incorrect.',true));
			}

			// regardless of success, we must blank out the password fields because we only have the hashed versions
			$this->data['User']['password_confirm'] = NULL;
			$this->data['User']['password']         = NULL;

		}

		$theme = ClassRegistry::init('Theme');
		$this->set('themes', $theme->find('list', array('conditions'=>array('price'=>'0'))));
		$this->set('errors', $this->Merchant->getAllValidationErrors());
		$this->set('plan', 	$plan);

	}
	
	function confirm() {
		// do nothing for time being.
		// by right this is to confirm payment for signups
		
		
		// must come from paypal express checkout
		if(isset($this->params['url']['paypal'])) {
			$token = $this->Session->read('Subscription.Paypal.TOKEN');
			$ppResult = $this->getECD($token);
			
			$this->prepareCRPP($token);
			
			
		}
	}
	
	function complete() {
		// do nothing for time being.
		// by right this is to complete payment for shop
		// more for cancel url in paypal 
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
	
	
	/**
	 * require uuid, cancelURL, Payments, shopId inside $postFields for checkoutOption
	 * */
	
	
	private function getECD($token) {
		// we need to prepare the paypalexpresscheckout portion
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'));
		
		$PayPal = new PayPal($PayPalConfig);
		
		
		
		return $PayPal->GetExpressCheckoutDetails($token);
		
	}
	
	private function prepareSEC($invnum = '') {
		
		// we need to prepare the paypalexpresscheckout portion
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'));
		
		$PayPal = new PayPal($PayPalConfig);
		
		
		
		// return url refers to the page where the user sees shop page after paypal payment
		
		$returnURL = Router::url(array('controller'=>'merchants',
				       'action'=>'confirm',), true);
		
		// we need to add this so that we can close the loop over whether this payment was successfully charged.
		$returnURL .= '?paypal';
		
		$cancelURL = Router::url(array('controller'=>'merchants',
				       'action'=>'confirm',), true);
		
		// we need to add this so that we can close the loop over whether this payment was successfully charged.
		$cancelURL .= '?paypal';
		
		$SECFields = $this->Paypal->buildSECFields(array('returnurl'=>$returnURL,
								 'cancelurl'=>$cancelURL));
		
		// we want to set the button to confirm in PAYPAL checkout page
		//$SECFields['skipdetails'] = '1';
		
		
		// now we build the payment
		$Payments = array();
		$Payment = $this->Paypal->buildPayment(array('invnum'=>$invnum));
		array_push($Payments, $Payment);
		
		// now we build the recurring billing agreement
		
		$BillingAgreements = array();
		$billingAgreement = $this->Paypal->buildBillingAgreement(array('l_billingagreementdescription' => 'OMBI60: Subscription'));

		array_push($BillingAgreements, $billingAgreement);

		$PayPalRequest = array(
				'SECFields' => $SECFields, 
				'BillingAgreements' => $BillingAgreements, 
				'Payments' => $Payments,
				);
		
		$PayPalResult = $PayPal->SetExpressCheckout($PayPalRequest);
		
		return $PayPalResult;
	}
	
	private function prepareCRPP($token, $options = array()) {
		
		// we need to prepare the paypalexpresscheckout portion
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'));
		
		$PayPal = new PayPal($PayPalConfig);
		
		/*$invnum = $options['']*/
		$invnum = '12345';
		$fullname = 'Tester Testerson';
		$desc = 'OMBI60: Subscription';
		$currencyCode = 'SGD';
		$amt = '19.90';
		
		// payerinfo, payername, billingaddress, shippingaddress
		
		// Generate a GMT formatted profile start date.
		$DaysTimestamp = strtotime('now + 30 days');
		$Mo = date('m', $DaysTimestamp);
		$Day = date('d', $DaysTimestamp);
		$Year = date('Y', $DaysTimestamp);
		$StartDateGMT = $Year . '-' . $Mo . '-' . $Day . 'T00:00:00\Z';
		
		$CRPPFields = array(
					'token' => $token, 	// Token returned from PayPal SetExpressCheckout.  Can also use token returned from SetCustomerBillingAgreement.
				);
						
		$ProfileDetails = array(
						'subscribername' => $fullname, 	// Full name of the person receiving the product or service paid for by the recurring payment.  32 char max.
						'profilestartdate' => $StartDateGMT, 		// Required.  The date when the billing for this profiile begins.  Must be a valid date in UTC/GMT format.
						'profilereference' => $invnum 			// The merchant's own unique invoice number or reference ID.  127 char max.
					);
						
		$ScheduleDetails = array(
							'desc' => $desc, 								// Required.  Description of the recurring payment.  This field must match the corresponding billing agreement description included in SetExpressCheckout.
							'maxfailedpayments' => '1', 					// The number of scheduled payment periods that can fail before the profile is automatically suspended.  
							'autobillamt' => '1' 						// This field indiciates whether you would like PayPal to automatically bill the outstanding balance amount in the next billing cycle.  Values can be: NoAutoBill or AddToNextBilling
						);
						
		$BillingPeriod = array(
							'trialbillingperiod' => '', 
							'trialbillingfrequency' => '', 
							'trialtotalbillingcycles' => '', 
							'trialamt' => '', 
							'billingperiod' => 'Month', 						// Required.  Unit for billing during this subscription period.  One of the following: Day, Week, SemiMonth, Month, Year
							'billingfrequency' => '1', 					// Required.  Number of billing periods that make up one billing cycle.  The combination of billing freq. and billing period must be less than or equal to one year. 
							'totalbillingcycles' => '0', 				// the number of billing cycles for the payment period (regular or trial).  For trial period it must be greater than 0.  For regular payments 0 means indefinite...until canceled.  
							'amt' => $amt, 				// Required.  Billing amount for each billing cycle during the payment period.  This does not include shipping and tax. 
							'currencycode' => $currencyCode, 		// Required.  Three-letter currency code.
							'shippingamt' => '', 						// Shipping amount for each billing cycle during the payment period.
							'taxamt' => '' 								// Tax amount for each billing cycle during the payment period.
						);
						
		$ActivationDetails = array(
							'initamt' => '', 			// Initial non-recurring payment amount due immediatly upon profile creation.  Use an initial amount for enrolment or set-up fees.
							'failedinitamtaction' => '', 		// By default, PayPal will suspend the pending profile in the event that the initial payment fails.  You can override this.  Values are: ContinueOnFailure or CancelOnFailure
						);
						
		$PayerInfo = array(
					'email' => 'drewangell@gmail.com', 								// Email address of payer.
					'payerid' => '', 							// Unique PayPal customer ID for payer.
					'payerstatus' => '', 						// Status of payer.  Values are verified or unverified
					'countrycode' => 'US', 						// Payer's country of residence in the form of the two letter code.
					'business' => 'Testers, LLC' 							// Payer's business name.
				);
						
		$PayerName = array(
					'salutation' => '', 			// Payer's salutation.  20 char max.
					'firstname' => 'Tester', 		// Payer's first name.  25 char max.
					'middlename' => '', 			// Payer's middle name.  25 char max.
					'lastname' => 'Testerson', 		// Payer's last name.  25 char max.
					'suffix' => ''				// Payer's suffix.  12 char max.
				);
						
		$BillingAddress = array(
								'street' => '', 						// Required.  First street address.
								'street2' => '', 						// Second street address.
								'city' => '', 							// Required.  Name of City.
								'state' => '', 							// Required. Name of State or Province.
								'countrycode' => '', 					// Required.  Country code.
								'zip' => '', 							// Required.  Postal code of payer.
								'phonenum' => '' 						// Phone Number of payer.  20 char max.
							);
							
		$ShippingAddress = array(
						'shiptoname' => '', 					// Required if shipping is included.  Person's name associated with this address.  32 char max.
						'shiptostreet' => '', 					// Required if shipping is included.  First street address.  100 char max.
						'shiptostreet2' => '', 					// Second street address.  100 char max.
						'shiptocity' => '', 					// Required if shipping is included.  Name of city.  40 char max.
						'shiptostate' => '', 					// Required if shipping is included.  Name of state or province.  40 char max.
						'shiptozip' => '', 						// Required if shipping is included.  Postal code of shipping address.  20 char max.
						'shiptocountrycode' => '', 				// Required if shipping is included.  Country code of shipping address.  2 char max.
						'shiptophonenum' => ''					// Phone number for shipping address.  20 char max.
						);
						
		$PayPalRequestData = array('CRPPFields' => $CRPPFields, 'ProfileDetails' => $ProfileDetails, 'ScheduleDetails' => $ScheduleDetails, 'BillingPeriod' => $BillingPeriod, 'PayerInfo' => $PayerInfo, 'PayerName' => $PayerName);
		return $PayPal->CreateRecurringPaymentsProfile($PayPalRequestData);

	}
	
	private function sec() {
		
		$PayPalResult = $this->prepareSEC();
		$this->set(compact('PayPalResult'));
	}

}
?>