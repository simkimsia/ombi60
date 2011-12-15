<?php
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
require_once(ROOT. DS . 'app' . DS . 'Vendor' . DS . 'paydollar' . DS . 'includes' . DS . 'paydollar.nvp.class.php');
//App::import('Vendor', 'PayDollar', array('file'=>'paydollar'.DS.'includes'.DS.'paydollar.nvp.class.php'));
class MerchantsController extends AppController {

	public $name = 'Merchants';

	public $helpers = array(
		'Ajax',
		'Javascript',
		'Log.Log');
		
		
	public $components = array(
		'Paydollar.Paydollar'
	);

	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();

		$this->overrideAuth();

		if ($this->request->action == 'register') {
			// because Security component is turned on
			// hence need to disable any hidden fields that is auto changed by jQuery
			//$this->Security->disabledFields[] = 'Shop.primary_domain';
			$this->Security->validatePost = false;

			// in case the merchant did not turn on Js,
			if (empty($this->request->data['Shop']['primary_domain']) && $this->request->is('post')) {
				$this->request->data['Shop']['primary_domain'] = 'http://' . $this->request->data['Shop']['subdomain'] . $this->Merchant->Shop->Domain->getMainDomain();
			}
		}

		// add in the extra validation for merchant login
		// ensure that it is the right shop that they want to login to.
		if ($this->request->is('post') AND $this->request->action == 'login') {
			$this->Auth->userScope = array('Merchant.shop_id' => $this->request->data['Merchant']['shop_id']);
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
		$this->Auth->loginError = __("Login failed. Invalid email or password or web address.");

		$this->Auth->loginAction    = '/admin/login';
		$this->Auth->loginRedirect  = '/admin';
		$this->Auth->logoutRedirect = '/admin/login';

	}

	/**
	 * Merchants to register a Merchant account
	 **/
	public function register($plan = null) {
		
		if ($plan == null) {
			$this->redirect('/pages/pricing-signup');
		}
		
		$this->set('title_for_layout', __('Signup',true));
		
		$mainDomain = $this->Merchant->Shop->Domain->getMainDomain();
		
		$this->set('mainDomain', $mainDomain);

		if ($this->request->is('post')) {
			
			$this->request->data['Invoice']['title'] = $plan;
			$this->request->data['Invoice']['description'] = 'Initial signup';
			
			// set the Shop email
			$this->request->data['Shop']['email'] = $this->request->data['User']['email'];
			
			/* get price of subscription plan */
			$this->Merchant->Shop->Invoice->SubscriptionPlan->id = $plan;
			$this->request->data['Invoice']['price'] = $this->Merchant->Shop->Invoice->SubscriptionPlan->field('price');
			
			
			if (isset($this->request->data['Shop']['primary_domain'])) {
				
				$this->request->data['Shop']['primary_domain'] 	= 'http://' . $this->request->data['Shop']['subdomain'] . $mainDomain;
				$this->request->data['Shop']['url']	      	= $this->request->data['Shop']['primary_domain'];
				$this->request->data['Shop']['permanent_domain']	= $this->request->data['Shop']['subdomain'] . $mainDomain;
				
			}
			
			// backdoor code to allow signup without payment
			// this is to circumvent paydollar for time being 
			// to be used for beta users .
			// to be removed once paydollar issue resolved
			$backdoorOn = isset($this->request->query['backdoor']);
			
			if ($result = $this->Merchant->signupNewAccount($this->request->data)) {
				
				$this->request->data['Invoice']['reference'] = $result['Invoice']['reference'];
				
				// we need to write this into session.
				$this->Session->write('NewShopID', $this->Merchant->Shop->id);
				
				
				if ($backdoorOn) {
					$this->redirect('/merchants/confirm?backdoor&inv='.$result['Invoice']['reference']);
				}
				
				// so now we go to paypal
				if ($this->params['form']['submit'] == 'paypalExpressCheckout') {
					$PaypalResult = $this->prepareSEC($result['Invoice']['id']);
					
					$this->Session->write('Subscription.Paypal.TOKEN', $PaypalResult['TOKEN']);
					
					
					if (isset($PaypalResult['REDIRECTURL']))
						$this->redirect($PaypalResult['REDIRECTURL']);

				// or we go to paydollar						
				} else if ($this->request->data['Pay']['method'] == 'paydollar') {
					$PaydollarResult = $this->runAddSchPay($this->request->data);

					// means success						
					if(isset($PaydollarResult['resultCode']) && $PaydollarResult['resultCode'] == 0) {
						$this->Session->write('PaydollarResult', $PaydollarResult);
						
						$this->redirect('/merchants/confirm?paydollar&inv='.$result['Invoice']['reference']);
					} else {
						$this->log($PaydollarResult);
						$this->Session->setFlash(__('Your credit card was not accepted by Paydollar. Please try again.', true), 'default', array('class'=>'flash_failure'));
					}
				}
				
				

			} else {
				$this->Session->setFlash(__('Sorry, the information you\'ve entered is incorrect.',true));
			}

			// regardless of success, we must blank out the password fields because we only have the hashed versions
			$this->request->data['User']['password_confirm'] = NULL;
			$this->request->data['User']['password']         = NULL;

		}
		
		$theme = ClassRegistry::init('Theme');
		$this->set('themes', $theme->find('list', array('conditions'=>array('price'=>'0'))));
		$this->set('errors', $this->Merchant->getAllValidationErrors());
		$this->set('plan', 	$plan);
		

	}

	public function admin_login() {

		$this->set('title_for_layout', __('Merchant Login'));


		// to retrieve the shop id based on the url
		// set inside the hidden value of the login form
		$this->set('shop_id', Shop::get('Shop.id'));

		if ($this->request->is('post')) {

			if ($this->Auth->login() &&$this->Auth->user()) {

				// this code is for the remember me when Merchant first logs in and chooses the remember me
				if (!empty($this->request->data) && $this->request->data['User']['remember_me']) {
					$cookie = array('email'    => $this->request->data['User']['email'],
							'password' => $this->request->data['User']['password'],);

					$this->updateCookie();

					unset($this->request->data['User']['remember_me']);	
				}

				$this->updateSession();

				$this->redirect($this->Auth->redirect());
			}
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

	public function admin_logout() {
		$this->Cookie->delete('Auth.User');
		$this->Cookie->delete('Auth.Merchant');
		$this->Cookie->delete('Auth.Shop');
		$this->Session->delete('Auth.Merchant');
		$this->Session->delete('Auth.Shop');
		$this->redirect($this->Auth->logout());
	}
	
	
	
	public function confirm() {
		// do nothing for time being.
		// by right this is to confirm payment for signups
		
		$domain = array();
		
		// must come from paypal express checkout
		if(isset($this->request->query['paypal'])) {
			$token = $this->Session->read('Subscription.Paypal.TOKEN');
			$ppResult = $this->getECD($token);
			
			$invoiceID = $this->request->query['inv'];
			$shopid = $this->Session->read('NewShopID');
			
			$options=array('PROFILEREFERENCE'=>$invoiceID);
			$crppResult = $this->prepareCRPP($token, $options);
			
			
			if (isset($crppResult['ACK']) && strtoupper($crppResult['ACK']) == 'SUCCESS') {
				$this->Merchant->Shop->RecurringPaymentProfile->create();
				$data = array('RecurringPaymentProfile' =>
					      array(
						'gateway'=>'paypal',
						'method'=>'express checkout',
						'shop_id' => $shopid,
						'gateway_reference_id' => $crppResult['PROFILEID']));
				
				$this->Merchant->Shop->RecurringPaymentProfile->save($data);
				
				
				
				
			}
			
			
			
			
		}
		
		// hackish code for backdoor
		// for beta users who are not paying
		if(isset($this->request->query['backdoor'])) {
			
			$invoiceID = $this->request->query['inv'];
			$shopid = $this->Session->read('NewShopID');
			
			$this->Merchant->Shop->RecurringPaymentProfile->create();
			$data = array('RecurringPaymentProfile' =>
					      array(
						'gateway'=>'backdoor',
						'method'=>'backdoor',
						'shop_id' => $shopid,
						'gateway_reference_id' => 'backdoor'));
				
			$this->Merchant->Shop->RecurringPaymentProfile->save($data);
			
			// retrieve the url
			$this->Merchant->Shop->recursive = -1;
			$domain = $this->Merchant->Shop->read(array('Shop.primary_domain'), $shopid);
			
		}
		
		if(isset($this->request->query['paydollar'])) {
			
			$invoiceID = $this->request->query['inv'];
			$shopid = $this->Session->read('NewShopID');
			$mSchPayId = $this->Session->read('PaydollarResult.mSchPayId');
			
			$this->Merchant->Shop->RecurringPaymentProfile->create();
			$data = array('RecurringPaymentProfile' =>
					      array(
						'gateway'=>'paydollar',
						'method'=>'AddSchPay API',
						'shop_id' => $shopid,
						'gateway_reference_id' => $mSchPayId));
				
			$this->Merchant->Shop->RecurringPaymentProfile->save($data);
			
			// retrieve the url
			$this->Merchant->Shop->recursive = -1;
			$domain = $this->Merchant->Shop->read(array('Shop.primary_domain'), $shopid);
			
			
		}
		
		$this->set('domain', $domain);
		
		$this->Session->delete('NewShopID');
		$this->Session->delete('PaydollarResult');
	}
	
	public function complete() {
		// do nothing for time being.
		// by right this is to complete payment for shop
		// more for cancel url in paypal 
	}
	

/**
 * Admin dashboard page
 **/
	public function admin_index() {
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->paginate());
		$log = ClassRegistry::init('Log.Log');
		$shopId = Shop::get('Shop.id');
		$this->set('logs', $log->findObjectGroupActions(array(
			'shop_id' => $shopId
		)));
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
	public function admin_edit() {

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
 * get all merchants
 **/
	public function platform_index() {
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->paginate());
	}

/**
 * get 1 merchant view
 **/
	public function platform_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Merchant'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('merchant', $this->Merchant->read(null, $id));
	}

/**
 * edit 1 merchant data
 **/
	public function platform_edit() {

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
	public function platform_delete($id = null) {
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
	
	private function runAddSchPay($data) {
		$PayDollarConfig = array('Sandbox' => Configure::read('paydollar.sandbox'),
                         'APIMerchantID' => Configure::read('paydollar.api.merchantid'),
                         'APILoginID' => Configure::read('paydollar.api.loginid'),
                         'APIPassword' => Configure::read('paydollar.api.password'),
                         'UrlEncodeStringValues' => true);
		
		$PayDollar = new PayDollar($PayDollarConfig);
		
		// we shall give merchants 30 day free trial
		$firstBillingCycleStartDate = date('Y-m-d', strtotime("+30 days"));
		// we will charge merchants every month but at the end of the billing cycle
		$firstBillingCycleEndDate = date("Y-m-d", strtotime($firstBillingCycleStartDate)) . " +1 month";
		
		// split card expiry into month and year
		
		$expiryMonth = $data['Paydollar']['ccExpiry']['month'];
		$expiryYear = $data['Paydollar']['ccExpiry']['year'];

		$ASPFields = $this->Paydollar->buildASPFields(array('sDay' => date('d', strtotime($firstBillingCycleEndDate)), // Required, start day of month
							'sMonth' => date('m', strtotime($firstBillingCycleEndDate)), // Required, start month
							'sYear' => date('Y', strtotime($firstBillingCycleEndDate)), // Required, start year
							'eDay' => date('d', strtotime($firstBillingCycleEndDate)), // Required, start day of month
							'eMonth' => $expiryMonth - 1, // Required, start month
							'eYear' => $expiryYear, // Required, start year
							'orderRef' => $data['Invoice']['reference'], // Required, invoice number reference Text(35)
							
							'amount' => $data['Invoice']['price'],  // Required, total amount to be charged Number(12,2)
							'name' => strtoupper('OMBI60: '. $data['Invoice']['title'] . ' plan'), // Required , name of schedule payment
							'email' => $data['User']['email'], // Required, email of schedule payment
							'orderAcct' => $data['Paydollar']['ccNumber'], // order acct of schedule payment
							'pMethod' => $data['Paydollar']['ccType'],  // Required, refers to card. possible values are (VISA, Master, Diners, JCB, AMEX)
							'epMonth' => $expiryMonth,  // Required, expiry of card month must be leading zero Number(2)
							'epYear' => $expiryYear, 	// Required, expiry of card year must be in YYYY format Number(4)
							'holderName' => $data['Paydollar']['ccName'], // Required full name of card holder
							
							'status' => 'Active', // status of schedule payment (Active, Suspend)
							'nSch' => '1', // number of Sch type
							'schType' => 'Month', // The schedule type of schedulepayment (e.g. Day,Month,Year)
							'payType' => 'N',));
		
		$PayDollarRequestData = array('ASPFields' => $ASPFields,);

		return $PayDollar->AddSchPay($PayDollarRequestData);
		
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
		
		if (!empty($invnum)) {
			$returnURL .= '&inv='.$invnum;
		}
		
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
		$invnum = $options['PROFILEREFERENCE'];
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