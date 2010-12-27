<?php
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
class OrdersController extends AppController {

	var $name = 'Orders';

	var $helpers = array('Html', 'Form', 'Session', 'Time', 'Constant', 'Number');

	var $components = array('Session', 'Paypal.Paypal', 'RandomString.RandomString', 'Filter.Filter' => array(
					'actions' => array('index', 'admin_index'),
					'defaults' => array(),
					'fieldFormatting' => array(
						'string'	=> "LIKE '%%%s%%'",
						'text'		=> "LIKE '%%%s%%'",
						'datetime'	=> "LIKE '%%%s%%'"
					),
					'formOptionsDatetime' => array(),
					'paginatorParams' => array(
						'page',
						'sort',
						'direction',
						'limit'
					),
					'parsed' => false,
					'redirect' => true,
					'useTime' => false,
					'separator' => '/',
					'rangeSeparator' => '-',
					'url' => array(),
					'whitelist' => array(),
					'useSession'=>true,
					'complicatedRelation' => array('Customer'=>'User'),
					),
				'Theme' => array('actions'=>array('checkout',
								  'success',
								  'pay',
								  'checkout_step_1')),
				
				);
	
	var $view = 'Theme';
	
	function beforeFilter() {

		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();


		$this->Auth->allow('checkout', 'checkout_step_1', 'success',  'pay', 'updatePrices');
		
		if ($this->action == 'admin_index') {
			$this->Security->validatePost = false;
		}
		
		if(($this->action == 'checkout') AND (!empty($this->params['url']['uuid']))) {
			
			$uuid = $this->params['url']['uuid'];
			$siteTransfer = ClassRegistry::init('SiteTransfer');
			$data = $siteTransfer->findById($uuid);
			$this->Session->id($data['SiteTransfer']['sess_id']);
			$this->Session->write('Shop.' . $this->params['shop_id'] . '.PayPalResult.TOKEN', $data['SiteTransfer']['paypal_token']);
			// if session read write fails for paymentoption then need to re-evaluate this.
			$siteTransfer->delete($uuid);
			
		} 
		
		/** from checkout app
		$this->Auth->allow();
		
		**/
		
		// for checkout page
		$this->Security->disabledFields[] = 'Order.fixed_delivery';

	
	}
	
	function paypal() {
		$this->render('paypalcheckout');
	}

	function index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}
	
	function admin_index() {
		
		$shop_id = Shop::get('Shop.id');
		
		$this->Order->recursive = -1;
		
		// attach Linkable behavior
		$this->Order->Behaviors->attach('Linkable.Linkable');
		$this->Order->Customer->Behaviors->attach('Linkable.Linkable');
		$this->Order->Customer->User->Behaviors->attach('Linkable.Linkable');
		
		$this->paginate = array(
			      'conditions' => array('Order.shop_id' => $shop_id),
							
			      'link'=>array(
				 'Customer'=>array('User')),
			      'fields'=>array('User.full_name', 'Order.*'),
			      );
		
		// combine the original pagination conditions with the Filter pagination
		$this->paginate['conditions'] = array_merge($this->Filter->paginate['conditions'], $this->paginate['conditions']);
		
		$orders = $this->paginate();

		$this->set('orders', $orders);
		
	}
	
	private function checkCorrectShop($order_shop_id) {
		$shopId = Shop::get('Shop.id');
		
		return ($shopId === $order_shop_id);
	}
	
	function admin_view($id = null) {
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid Order', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index',
					      'admin' => true));
		}
		
		$order = $this->Order->getDetailed($id);
		
		if (!$this->checkCorrectShop($order['Order']['shop_id'])) {
			$this->Session->setFlash(__('You do not have the permission to view this order', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index',
					      'admin' => true));
		}
		
		$this->set('order', $order);
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Order', true), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('order', $this->Order->read(null, $id));
	}
	
	

	function add() {
		if (!empty($this->data)) {
			$this->Order->create();
			if ($this->Order->save($this->data)) {
				$this->Session->setFlash(__('Order has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Order could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
		}
	}
	
	function checkout($shopId, $hash) {
		$cart = $this->Order->Customer->User->Cart;
		
		$uuid = !empty($this->params['url']['uuid']);
		$paypal = isset($this->params['url']['paypal']);
		$comingFromPayPalSite = ($uuid AND $paypal);
		
		$customerId = 0;
		$userId = 0;
		
		// check cookie and login
		// if casual surfer but has customer user_id then need to prompt for username password
		// otherwise treat as casual and carry on as normal.
		// works only for coming from cart/view page
		if ($this->checkUserIdForCustomer() &&
		    $this->RequestHandler->isGet() &&
		    !$comingFromPayPalSite) {
			// force login
			$pass = false;
			if ($this->Session->check('Shop.' . $shopId . '.checkoutRedirectPass')) {
				$pass = $this->Session->read('Shop.' . $shopId . '.checkoutRedirectPass');	
			}
			
			if ($pass) {
				$this->Session->write('Shop.' . $shopId . '.checkoutRedirectPass', false);
				$this->Session->delete('Auth.redirect');
			} else {
				$this->Session->write('Shop.' . $shopId . '.checkoutRedirect', FULL_BASE_URL . $this->here);
				$this->Session->write('Auth.redirect', FULL_BASE_URL . $this->here);
				
				$this->redirect(array('controller'=>'customers',
						      'action'    => 'login'));	
			}
			
			$customerId = User::get('Customer.id');
			
		}
		// to clear any remnant values for checkoutRedirectPass
		$this->Session->write('Shop.' . $shopId . '.checkoutRedirectPass', false);
		
		
		if ($this->RequestHandler->isGet()){
			
			if ($comingFromPayPalSite) {
				// execute the GetExpressCheckoutDetails API
				$PayPalRequestSet = $this->executeGECD($shopId);
				if (!empty($PayPalRequestSet)) {
					// first we need to extract the shipping address et al
					$this->extractShippingDetails($shopId, $hash, $PayPalRequestSet);
					// redirection will take place within this function if successful
					$options = array('customer_id'=>$customerId,
							 'shop_id'=>$shopId,
							 'hash'=>$hash);
					$this->syncAddressCustomerOrder($options, $PayPalRequestSet['PayPalRequest']);	
				}
				
			} else {
				// coming from original web app > products/checkout action				
				// so we just do normal display of the address page
				$cartData = $cart->findByHash($hash);
				
				if (!empty($cartData)) {
					$userId = $cartData['Cart']['user_id'];
				}
				
				// get all shipping addresses of this customer
				$shippingAddresses = array();
				if ($customerId > 0) {
					$this->Order->DeliveryAddress->recursive = -1;
					$shippingAddresses = $this->Order->DeliveryAddress->getAllByCustomer($customerId, DELIVERY);
				}
				
				$this->set('shippingAddresses', $shippingAddresses);
				$this->set('hash', $hash);
				$this->set('shop_id', $shopId);
				// check for customer log in
				$this->set('customer_id', $customerId);
				$this->set('user_id', $userId);
				$this->set('totalAmountWithShipping', $cartData['Cart']['amount']);
			}
			
		} else if (!empty($this->data) AND $this->RequestHandler->isPost()) {
			
			// redirection will take place within this function if successful
			// actually none of the 3 params are used except for shopId
			$options = array('customer_id'=>$customerId,
					 'shop_id'=>$shopId,
					 'hash'=>$hash,
					 );
			
			if($this->data['Order']['fixed_delivery'] > 0) {
				$options['delivery_address_id'] = $this->data['Order']['fixed_delivery'];
			}
		
			$this->syncAddressCustomerOrder($options);
			
		}
	
	}
	
	private function checkUserIdForCustomer() {
		
		$userIdInCookie = $this->Cookie->read('User.id');
		
		if ($userIdInCookie == User::get('User.id')) {
			$group_id = User::get('User.group_id');
		
			return ($group_id == CUSTOMERS);	
		}
		
		return false;
	}
	
	// currently just assumed unlogged in user
	private function extractShippingDetails($shopId, $hash, $PayPalResultSet = array()) {
		$GECDFields = $PayPalResultSet['GECDResult'];
		
		$validCustomer = ($this->Auth->user()) &&
				 (User::get('User.group_id') == CUSTOMERS) &&
				 (User::get('Customer.id') > 0);
				
		
		
		// only for invalid customers, do we set the customer_id to 0
		if ($validCustomer) {
			$this->data['Order']['customer_id'] = User::get('Customer.id');
			$this->data['User']['email'] = User::get('User.email');
		} else {
			$this->data['Order']['customer_id'] = 0;
			$this->data['User']['email'] = $GECDFields['EMAIL'];
		}
		
		$this->data['DeliveryAddress']['same'] = true;
		$this->data['Order']['shop_id'] = $shopId;
		$this->data['Customer']['shop_id'] = $shopId;
		
		$this->data['Cart']['hash'] = $hash;
		
		$this->data['BillingAddress'][0]['full_name'] = $GECDFields['SHIPTONAME'];
		$this->data['BillingAddress'][0]['address'] = $GECDFields['SHIPTOSTREET'];
		$this->data['BillingAddress'][0]['city']    = $GECDFields['SHIPTOCITY'];
		$this->data['BillingAddress'][0]['region'] = isset($GECDFields['SHIPTOSTATE']) ? $GECDFields['SHIPTOSTATE'] : '';
		$this->data['BillingAddress'][0]['zip_code'] = $GECDFields['SHIPTOZIP'];
		$this->data['BillingAddress'][0]['country'] = $GECDFields['SHIPTOCOUNTRYCODE'];
		$this->data['BillingAddress'][0]['type'] = BILLING;
		
		return true;
	}
	
	private function syncAddressCustomerOrder($options = array(), $PayPalRequest = false) {
		// $customerId, $shopId, $hash,
		$customerId = $options['customer_id'];
		$shopId = $options['shop_id'];
		$hash = $options['hash'];
		$delivery_address_id = isset($options['delivery_address_id']) ? $options['delivery_address_id'] : 0;
		
		$result = true;
		
		// instantiate the Cart model
		$cart = $this->Order->Customer->User->Cart;
		// this chunk of if-else statement is to determine customer id
		if ($this->data['Order']['customer_id'] > 0) {
			$customerId = $this->data['Order']['customer_id'];
			$this->Order->Customer->id = $customerId;
		} else {
			// check database for existing customer
			$customerId = $this->Order->Customer->getExistingByShopIdAndEmail($this->data);
		}
		
		// use existing delivery address
		if ($delivery_address_id > 0) {
			$deliveryAddressId = $delivery_address_id;
			$this->Order->Customer->id = $customerId;
			// we go retrieve the delivery address and use its details for billing address
			$billingAddressId = $this->Order->Customer->duplicateBillingAddressFromDeliveryAddress($delivery_address_id);
			
			if (!($deliveryAddressId > 0) OR !($billingAddressId > 0) OR !($customerId >0)) {
				$result = false;
			}
			
		} else {
			
			// duplicate the delivery address if same as billing address
			if ($this->data['DeliveryAddress']['same']) {
				$this->data['DeliveryAddress'] = $this->data['BillingAddress'];
				$this->data['DeliveryAddress'][0]['type'] = DELIVERY;
			}
			
			
			
			// if customer is existing in database
			if ($customerId){
				// retrieve addresses from database	
				$billingAddressId = $this->Order->Customer->getExistingBillingAddress($this->data);
				
				$deliveryAddressId = $this->Order->Customer->getExistingDeliveryAddress($this->data);
				
				// if billing address does not exist in database, we will create new billing address
				if (!$billingAddressId) {
					
					if ($this->Order->Customer->setNewBillingAddress($this->data)) {
						$billingAddressId = $this->Order->Customer->BillingAddress->id;
					} else {
						$result = false;
					}
				}
				
				// if delivery address does not exist in database, we will create new delivery address
				if (!$deliveryAddressId AND $billingAddressId) {
					if ($this->Order->Customer->setNewDeliveryAddress($this->data)) {
						$deliveryAddressId = $this->Order->Customer->DeliveryAddress->id;
					} else {
						$result = false;
					}
				}
				
				
				
			} else {
				// we need to have a fullname for the user, so we take it from the billing address
				$this->data['User']['full_name'] = $this->data['BillingAddress'][0]['full_name'];
				$this->data['User']['name_to_call'] = $this->data['BillingAddress'][0]['full_name'];
				// because we need to create brand new User so we need to create random password
				$this->data['User']['password'] = $this->Auth->password($this->RandomString->generate());
				// hackish code to pass the shop id into the uniqueEmailInShop validator
				// read first few lines of uniqueEmailInShop method in User model
				$this->data['User']['shop_id'] = $this->data['Customer']['shop_id'];
				
				$result = $this->Order->Customer->signupNewAccountDuringCheckout($this->data);
				$customerId = $this->Order->Customer->id;
				$billingAddressId = $this->Order->Customer->BillingAddress->field('id');
				$deliveryAddressId = $this->Order->Customer->DeliveryAddress->field('id');
				
			}	
		}
		
		// if at this point in time, we get a $result == false, it means something went wrong prior.
		if (!$result) {
			$this->Session->setFlash(__('The Order could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			
		} else {
		
			// since all prepartory work is done, we can now start to save Order data.
			$orderDetails = array();
			
			// store shop and customer ids
			$orderDetails['shop_id']     = $shopId;
			$orderDetails['customer_id'] = $customerId;
	
			// store the addresses id
			$orderDetails['billing_address_id']  = $billingAddressId;
			$orderDetails['delivery_address_id'] = $deliveryAddressId;
				
			// now we get the cart data again
			$cartData = $cart->findByHash($hash);
			
			$orderDetails['amount'] = $cartData['Cart']['amount'];
				
			// convert the cart data to savable order data
			$data = $this->Order->convertCart($cartData, $orderDetails);
			
			$resultSet = 	$this->Order->saveForCheckoutStep1($data);
			
			if (is_array($resultSet) AND $resultSet['result']) {
				// reconsider removing the cart data.
				// incase user press back button to change address etc.
				// or halfway user gets DC.
				//$this->Order->removeCart($cartData['Cart']['id']);
				
				$orderHash = $resultSet['hash'];
				
				// need PayPalRequest to call DoExpressCheckout API
				$this->Session->write('Shop.' . $shopId . '.confirmPage', array('PayPalRequest'=>$PayPalRequest,
												'hash'=>$orderHash,
												'amount'=>$orderDetails['amount'],
												'shipped_amount'=>$data['Order']['shipped_amount'],
												'shipped_weight'=>$data['Order']['shipped_weight'],
												'shipping_required'=>$data['Order']['shipping_required']));
				
				$this->redirect(array('action' => 'pay',
						      'controller' => 'orders',
						      'hash' => $orderHash,
						      'shop_id' => $shopId));
				
				$this->Session->setFlash(__('The Order has been saved', true), 'default', array('class'=>'flash_success'));
				
			} else {
				$this->Session->setFlash(__('The Order could not be saved. Please, try again.', true), 'default', array('class'=>'flash_failure'));
			}
			
		}
	}
	
	private function executeDECD($PayPalRequest, $shopId) {
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'));
		$PayPal = new PayPal($PayPalConfig);
		
		$PayPalResult = $PayPal->DoExpressCheckoutPayment($PayPalRequest);
			
		$this->Session->write('Shop.'.$shopId.'.PayPalResult', $PayPalResult);
	}
	
	



	function success($shop_id = null) {
		
		$paypal = isset($this->params['url']['paypal']);
		$tokenValueOn = isset($this->params['url']['token']);
		$shops_payment_module_id = $this->Order->Shop->getPayPalShopsPaymentModuleId($shop_id);
		
		if (Configure::read('debug') > 0) {
			$link = 'http://ombi60.localhost';
		} else {
			$link = $this->Order->Shop->Domain->field('domain', array('shop_id' => $shop_id,
										  'primary' => true));
		}
		
		if ($paypal) {
			// call the GECD
			$PayPalRequestSet = $this->executeGECD($shop_id);
			$tokenValue = $this->params['url']['token'];
			
			
			// call the DECD to complete the transaction
			if (!empty($PayPalRequestSet)) {
				
				$this->executeDECD($PayPalRequestSet['PayPalRequest'], $shop_id);
				
				// now set the payment to complete
				$this->Order->Payment->completeByTransaction($shops_payment_module_id, $tokenValue);
			}
		}
		$this->set('link', $link);
	}
	
	// expect $this->params to have cart_id, order_id, shipping_rate_id
	function updatePrices() {
		
		$successJSON = false;
		$contents = array();
		
		$this->layout = 'json';
		
		
		// validate for cart_id, order_id, shipping_rate_id
		if (!array_key_exists('cart_id', $this->params['form']) ||
		    !array_key_exists('order_id', $this->params['form']) ||
		    !array_key_exists('shipping_rate_id', $this->params['form'])
		    ) {
			$successJSON = false;
			$contents['reason'] = __('Invalid parameters', true);
		} else if ($this->params['isAjax']) {
			$data = $this->Order->Cart->updatePricesInCartAndOrder($this->params['form']['cart_id'], $this->params['form']['order_id']);
			
			if ($data) {
				$price = $this->Order->Shop->ShippedToCountry->ShippingRate->field('price', array('id'=>$this->params['form']['shipping_rate_id']));
				$successJSON = true;
				App::import('Helper', 'Number');
				$number = new NumberHelper();
				$contents['totalAmountWithShipping'] = $number->currency($data['Order']['amount'] + $price, 'SGD');
				
			} else {
				$contents['reason'] = __('Cannot update prices', true);
			}
			
			
		}
		
		$this->set(compact('contents', 'successJSON'));
		$this->render('json/response');
		
	}
	
	function pay($shop_id, $hash) {
		
		$payPalShopsPaymentModuleId = $this->Order->Shop->getPayPalShopsPaymentModuleId($shop_id);
		
		if ($this->RequestHandler->isGet()) {
			
			$confirmPage = $this->Session->read('Shop.' .$shop_id. '.confirmPage');
			
			$PayPalRequest = $confirmPage['PayPalRequest'];
			$sessionHash = $confirmPage['hash'];
			
			// need this to filter the right shipping settings
			$totalAmount = $confirmPage['amount'];
			$shippedAmt = $confirmPage['shipped_amount'];
			$shippedWeight = $confirmPage['shipped_weight'];
			$displayShipment = $confirmPage['shipping_required'];
			
			// assumed originally same
			$totalAmountWithShipping = $totalAmount;
			
			$forPayPalAtCheckout = (($sessionHash == $hash) AND ($PayPalRequest != false));
			
			
			$paymentModuleInShop 	        = $this->Order->Payment->ShopsPaymentModule;
			$paymentModuleInShop->recursive = -1;
			
			
			$shippingRates = array();
			$defaultShipment = '';
			if ($displayShipment) {
				
				$shippingRatesResultSet = $this->getShipmentOptions($shippedAmt, $shippedWeight, $shop_id);
				$shippingRates = $shippingRatesResultSet['display'];
				$defaultShipment = key($shippingRates);
				$shippingFee = $shippingRatesResultSet['price'][$defaultShipment];
				
				$totalAmountWithShipping = $totalAmount + $shippingFee;
			}
			
			
			$displayPaymentMode = true;
			$defaultPayment = '';
			
			if($forPayPalAtCheckout) {
				// dont display choices of payment modules because payment mode is decided already
				$shopsPaymentModules = array();
				$displayPaymentMode = false;
			} else {
				// retrieve all payment modes because payment mode is undecided
				$shopsPaymentModules = $paymentModuleInShop->find('list', array('conditions'=>array('ShopsPaymentModule.shop_id'=>$shop_id,
												 'ShopsPaymentModule.active'=>true),
									     ));
				
				$defaultPayment = key($shopsPaymentModules);
			}
			
			$this->Order->recursive = -1;
			$order          = $this->Order->findByHash($hash);
			
			
			// here we will buildPayment and buildItem for paypal
			
			$this->set(compact('order', 'shopsPaymentModules', 'shippingRates',
					   'hash', 'shop_id', 'displayPaymentMode', 'displayShipment',
					   'totalAmount', 'totalAmountWithShipping',
					   'defaultShipment', 'defaultPayment', 'payPalShopsPaymentModuleId'));
			
		} else if ($this->RequestHandler->isPost()) {
			// for entry checkout point		
			$confirmPage = $this->Session->read('Shop.' .$shop_id. '.confirmPage');
			
			$PayPalRequest = $confirmPage['PayPalRequest'];
			$sessionHash = $confirmPage['hash'];
			
			$forPayPalAtCheckout = (($sessionHash == $hash) AND ($PayPalRequest != false));
			
			if ($forPayPalAtCheckout) {
				$this->executeDECD($PayPalRequest, $shop_id);
			}
			
			// for payment option point
			$payment = $this->data['Payment']['shops_payment_module_id'];
			$this->Order->id = $this->data['Payment']['order_id'];
			
			if ($payment == $payPalShopsPaymentModuleId && !$forPayPalAtCheckout) {
				// read Payments from session
				$Payments = $this->Session->read('Shop.' .$shop_id. '.Payments');
				
				// read paymentAmount from session
				$paymentAmount = $this->Session->read('Shop.' .$shop_id. '.paymentAmount');
				$cancelURL =  Router::url(array('controller'=>'orders',
					       'shop_id'=>$shop_id,
					       'hash'=>$hash,
					       'action'=>'pay',), true);
				// execute SEC
				
				$PayPalResult = $this->prepareSEC(array('payments'=>$Payments,
							//'uuid'=>,
							'shopId'=>$shop_id,
							'cancelURL'=>  FULL_BASE_URL . $this->referer()),
						  $hash);
				//$this->log('orderspreparesec');
				//$this->log($PayPalResult);
				// assign unique paypal transaction id to the payment
				$this->data['Payment']['transaction_id_from_gateway'] = $PayPalResult['TOKEN'];
				
				// save payment and shipment data as incomplete for payment
				$this->Order->savePaymentAndShipment($this->data);
				
				// redirect to PPREDIRECTURL
				$this->redirect($PayPalResult['REDIRECTURL']);
				
			}
			
			if ($this->Order->savePaymentAndShipment($this->data)) {
				
				$this->Session->setFlash(__('Order has been saved', true), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'success',
						      'controller' => 'orders',
						      'shop_id' => $shop_id));
			}
			
		}
		
	}
	
	
	private function getShipmentOptions ($shippedAmt, $shippedWeight, $shop_id) {
			$shippingRate 	         = $this->Order->Shop->ShippedToCountry->ShippingRate;
			$shippingRate->recursive = -1;
			$shippingRate->Behaviors->attach('Linkable.Linkable');
			
			$shippingRate->PriceBasedRate->Behaviors->attach('Linkable.Linkable');
			$shippingRate->WeightBasedRate->Behaviors->attach('Linkable.Linkable');
			
			$conditionsForPrice = array('AND' => array(array('ShippedToCountry.shop_id'=>$shop_id),
								   array('PriceBasedRate.min_price <=' =>$shippedAmt),
								   array('OR' => array(
											array('PriceBasedRate.max_price >=' =>$shippedAmt),
											array('PriceBasedRate.max_price ' => null)
										)
									)
								)
						);
			
			$conditionsForWeight = array('AND' => array(array('ShippedToCountry.shop_id'=>$shop_id),
								   array('WeightBasedRate.min_weight <=' =>$shippedWeight),
								   array('OR' => array(
											array('WeightBasedRate.max_weight >=' =>$shippedWeight),
											array('WeightBasedRate.max_weight ' => null)
										)
									)
								)
						);
			
			// this is so that the virtual field works 
			$shippingRate->PriceBasedRate->virtualFields['display_name'] = $shippingRate->virtualFields['display_name'];
			
			$priceBasedRates = $shippingRate->PriceBasedRate->find('all', array('conditions'=>$conditionsForPrice,
									   'fields'=>array('ShippingRate.id', 'display_name', 'ShippingRate.price', 'PriceBasedRate.min_price', 'PriceBasedRate.max_price'),
									   'link'=>array('ShippingRate'=>array('ShippedToCountry'))));
			
			$shippingRate->WeightBasedRate->virtualFields['display_name'] = $shippingRate->virtualFields['display_name'];
			
			$weightBasedRates = $shippingRate->WeightBasedRate->find('all', array('conditions'=>$conditionsForWeight,
									   'fields'=>array('ShippingRate.id', 'display_name', 'ShippingRate.price', 'WeightBasedRate.min_weight', 'WeightBasedRate.max_weight'),
									   'link'=>array('ShippingRate'=>array('ShippedToCountry'))));
			
			
			$shippingRatesByName = Set::combine($priceBasedRates, '{n}.ShippingRate.id', '{n}.PriceBasedRate.display_name');
			$shippingRatesByPrice = Set::combine($priceBasedRates, '{n}.ShippingRate.id', '{n}.ShippingRate.price');
			
			$weightShippingRatesByName = Set::combine($weightBasedRates, '{n}.ShippingRate.id', '{n}.WeightBasedRate.display_name');
			$weightShippingRatesByPrice = Set::combine($weightBasedRates, '{n}.ShippingRate.id', '{n}.ShippingRate.price');
			
			return array('display'=> $shippingRatesByName + $weightShippingRatesByName,
				     'price' => $shippingRatesByPrice + $weightShippingRatesByPrice);
			
			
			
	}
	
	/**
	 * require uuid, cancelURL, Payments, shopId inside $postFields for checkoutOption
	 * */
	
	private function prepareSEC($postFields, $hash) {
		
		
		// we need to prepare the paypalexpresscheckout portion
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'));
		
		
		$PayPal = new PayPal($PayPalConfig);
		
		// return url refers to the page where the user sees shop page after paypal payment
		// should be the step 2 in shopify.com
		// since we redirect there from carts/checkout so we set it to carts/checkout first
		// subject to change based on security concerns
		
		
		$returnURL = Router::url(array('controller'=>'orders',
				       'shop_id'=>$postFields['shopId'],
				       'action'=>'success',), true);
		
		// we need to add this so that we can close the loop over whether this payment was successfully charged.
		$returnURL .= '?paypal';
		
		$SECFields = $this->Paypal->buildSECFields(array('returnurl'=>$returnURL,
								 'cancelurl'=>$postFields['cancelURL'],
								 'maxamt'=>$postFields['payments'][0]['amt'] * 1.2));
		
		// we want to set the button to confirm in PAYPAL checkout page
		$SECFields['skipdetails'] = '1';
		
		$PayPalRequest = array(
				'SECFields' => $SECFields, 
				'SurveyChoices' => $this->Paypal->buildSurveyChoices(), 
				'Payments' => $postFields['payments']
				);
		
		$PayPalResult = $PayPal->SetExpressCheckout($PayPalRequest);
		
		/*
			$siteTransfer = ClassRegistry::init('SiteTransfer');
			$siteTransfer->id =  $postFields['uuid'];
			$siteTransfer->saveField('paypal_token', $PayPalResult['TOKEN']);	
		*/
		
		// for the paymentOption, to pass between orders/pay and orders/success
		$this->Session->write('Shop.'.$postFields['shopId'].'.PayPalResult', $PayPalResult);
		$this->Session->write('Shop.'.$postFields['shopId'].'.Payments', $postFields['payments']);
		
		/* does not work for some mysterious reason cannot pass sessions between this action and orders/checkout
		
		*/
	
		return $PayPalResult;
	}
	
	private function executeGECD($shopId) {
			
		$Payments = $this->Session->read('Shop.'.$shopId.'.Payments');
		
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'));
		$PayPal = new PayPal($PayPalConfig);
		
		$tokenValue = $this->Session->read('Shop.'.$shopId.'.PayPalResult.TOKEN');
		
		
		$GECDResult = $PayPal->GetExpressCheckoutDetails($tokenValue);
		
		$ack = strtoupper($GECDResult['ACK']);
		
		if ($ack == 'SUCCESS' OR $ack == 'SUCCESSWITHWARNING') {
			$DECPFields = array(
					'token' => $tokenValue, 								// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
					'payerid' => $GECDResult['PAYERID'], 							// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
					'returnfmfdetails' => '1', 					// Flag to indiciate whether you want the results returned by Fraud Management Filters or not.  1 or 0.
					'giftmessage' => '', 						// The gift message entered by the buyer on the PayPal Review page.  150 char max.
					'giftreceiptenable' => '', 					// Pass true if a gift receipt was selected by the buyer on the PayPal Review page. Otherwise pass false.
					'giftwrapname' => '', 						// The gift wrap name only if the gift option on the PayPal Review page was selected by the buyer.
					'giftwrapamount' => '', 					// The amount only if the gift option on the PayPal Review page was selected by the buyer.
					'buyermarketingemail' => '', 				// The buyer email address opted in by the buyer on the PayPal Review page.
					'surveyquestion' => '', 					// The survey question on the PayPal Review page.  50 char max.
					'surveychoiceselected' => '',  				// The survey response selected by the buyer on the PayPal Review page.  15 char max.
					'allowedpaymentmethod' => '', 				// The payment method type. Specify the value InstantPaymentOnly.
					'buttonsource' => '' 						// ID code for use by third-party apps to identify transactions in PayPal. 
				);
		
			$PayPalRequest = array(
						'DECPFields' => $DECPFields, 
						'Payments' => $Payments
					);
			
			return array('PayPalRequest'=>$PayPalRequest,
				     'GECDResult'  =>$GECDResult);
		}
		return array();
	}


	

}
?>