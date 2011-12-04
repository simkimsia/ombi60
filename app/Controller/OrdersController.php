<?php
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
App::uses('PaymentsComponent', 'Payments.Controller/Component');
/**
 * @property mixed Order
 */
class OrdersController extends AppController {

	public $name = 'Orders';

	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Number');

	public $components = array('Permission',
				'Session', 'Paypal.Paypal', 
				'Payments.Payments',
				'Filter.Filter' => array(
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
				
				
				);
	
	
	public function beforeFilter() {

		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();
		
		$this->Auth->allow(
			'checkout', 
			'checkout_step_1', 
			'success',  
			'pay', 
			'update_prices',
			'complete_purchase', 
			'return_from_payment',
			'completed');
		
		if ($this->request->action == 'update_prices' ||
			$this->request->action == 'complete_purchase' ||
			$this->request->action == 'return_from_payment' ||
			$this->request->action == 'completed') {
		
			$this->Components->disable('Security');
		}
		
		if ($this->request->action == 'admin_index') {
			$this->Security->validatePost = false;
		}
		
		if(($this->request->action == 'checkout') AND (!empty($this->request->params['url']['uuid']))) {
			
			$uuid = $this->request->params['url']['uuid'];
			$siteTransfer = ClassRegistry::init('SiteTransfer');
			$data = $siteTransfer->findById($uuid);
			$this->Session->id($data['SiteTransfer']['sess_id']);
			$this->Session->write('Shop.' . $this->request->params['shop_id'] . '.PayPalResult.TOKEN', $data['SiteTransfer']['paypal_token']);
			// if session read write fails for paymentoption then need to re-evaluate this.
			$siteTransfer->delete($uuid);
			
		} 
		
		/** from checkout app
		$this->Auth->allow();
		
		**/
		
		// for checkout page
		$this->Security->unlockedFields[] = 'Order.fixed_delivery';

	
	}
	
	public function paypal() {
		$this->render('paypalcheckout');
	}

	public function index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

	public function admin_index() {
		
		$shop_id = Shop::get('Shop.id');
		
		$this->Order->recursive = -1;
		
		// attach Linkable behavior
		$this->Order->Behaviors->load('Linkable.Linkable');
		$this->Order->Customer->Behaviors->load('Linkable.Linkable');
		$this->Order->Customer->User->Behaviors->load('Linkable.Linkable');
		
		$this->paginate = array(
			      'conditions' => array('Order.shop_id' => $shop_id),
							
			      'link'=>array(
				 'Customer'=>array('User')),
			      'fields'=>array('User.full_name', 'Order.*'),
			      );
		

		
		$orders = $this->paginate();

		$this->set('orders', $orders);
		
	}
	
	private function checkCorrectShop($order_shop_id) {
		$shopId = Shop::get('Shop.id');
		
		return ($shopId === $order_shop_id);
	}
	
	public function admin_view($id = null) {
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid Order'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index',
					      'admin' => true));
		}
		$module_name = "";
		$order = $this->Order->getDetailed($id);
		if (!empty($order) && isset($order['Payment'][0]['shops_payment_module_id'])) {
		    $shops_payment_module_id = $order['Payment'][0]['shops_payment_module_id'];
		    $conditions = array('ShopsPaymentModule.id' => array($shops_payment_module_id));
		    $payment_module_name = $this->Order->Payment->ShopsPaymentModule->find('first', array(
                                                                                     'conditions' => $conditions,
                                                                                     'fields' => array('ShopsPaymentModule.display_name'),
                                                                                    ));            
            $module_name = $payment_module_name['ShopsPaymentModule']['display_name'];
		}
		
		if (!$this->checkCorrectShop($order['Order']['shop_id'])) {
			$this->Session->setFlash(__('You do not have the permission to view this order'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index',
					      'admin' => true));
		}
		
		$this->set(compact('order', 'module_name'));
	}
	
	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Order'), 'default', array('class'=>'flash_failure'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('order', $this->Order->read(null, $id));
	}
	
	

	public function add() {
		if (!empty($this->request->data)) {
			$this->Order->create();
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('Order has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Order could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
		}
	}
	
	public function checkout($shopId, $hash) {
		$cart = $this->Order->Customer->User->Cart;
		
		$uuid = !empty($this->request->params['url']['uuid']);
		$paypal = isset($this->request->params['url']['paypal']);
		$comingFromPayPalSite = ($uuid AND $paypal);
		
		$customerId = 0;
		$userId = 0;
		
		// check cookie and login
		// if casual surfer but has customer user_id then need to prompt for username password
		// otherwise treat as casual and carry on as normal.
		// works only for coming from cart/view page
		if ($this->checkUserIdForCustomer() &&
		    $this->request->is('get') &&
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
				$this->Session->write('Shop.' . $shopId . '.checkoutRedirect', FULL_BASE_URL . $this->request->here);
				$this->Session->write('Auth.redirect', FULL_BASE_URL . $this->request->here);
				
				$this->redirect(array('controller'=>'customers',
						      'action'    => 'login'));	
			}
			
			$customerId = User::get('Customer.id');
			
		}
		// to clear any remnant values for checkoutRedirectPass
		$this->Session->write('Shop.' . $shopId . '.checkoutRedirectPass', false);
		
		
		if ($this->request->is('get')) {
			
			// set up the countries in the form.
			$this->set('countries', $this->Order->BillingAddress->Country->find('list'));
			
			if ($comingFromPayPalSite) {
				// execute the GetExpressCheckoutDetails API for PPEC at Checkout Point
				$PayPalRequestSet = $this->executeGECD($shopId);
				
				// if executeGECD is successful
				if (!empty($PayPalRequestSet)) {
										
					if (strtoupper($PayPalRequestSet['GECDResult']['ACK']) == 'SUCCESS') {
						// extract payerid, payeremail, payername, other info to update paypal_payers
						$paypalPayer = $this->Order->Payment->PaypalPayersPayment->PaypalPayer->saveAfterGECD($PayPalRequestSet['GECDResult']);
						
						// first we need to extract the shipping address et al
						$countryId = $this->extractShippingDetails($shopId, $hash, $PayPalRequestSet);
						
						// redirection will take place within this function if successful
						$options = array('customer_id'=>$customerId,
								 'shop_id'=>$shopId,
								 'hash'=>$hash,
								 'country_id' => $countryId,
								 'paypal_payer_id' => (isset($paypalPayer['PaypalPayer']['id'])) ? $paypalPayer['PaypalPayer']['id'] : '');
						
						$this->syncAddressCustomerOrder($options, $PayPalRequestSet['PayPalRequest']);		
					}
					
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
			
		} else if (!empty($this->request->data) AND $this->request->is('post')) {
			
			// redirection will take place within this function if successful
			// actually none of the 3 params are used except for shopId
			$options = array('customer_id'=>$customerId,
					 'shop_id'=>$shopId,
					 'hash'=>$hash,
					 );
			
			if($this->request->data['Order']['fixed_delivery'] > 0) {
				$options['delivery_address_id'] = $this->request->data['Order']['fixed_delivery'];
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
	// returns the country id where the shipping goes to
	private function extractShippingDetails($shopId, $hash, $PayPalResultSet = array()) {
		$GECDFields = $PayPalResultSet['GECDResult'];
		
		$validCustomer = ($this->Auth->user()) &&
				 (User::get('User.group_id') == CUSTOMERS) &&
				 (User::get('Customer.id') > 0);
		
		// only for invalid customers, do we set the customer_id to 0
		if ($validCustomer) {
			$this->request->data['Order']['customer_id'] = User::get('Customer.id');
			$this->request->data['User']['email'] = User::get('User.email');
		} else {
			$this->request->data['Order']['customer_id'] = 0;
			$this->request->data['User']['email'] = $GECDFields['EMAIL'];
		}
		
		$this->request->data['DeliveryAddress']['same'] = true;
		$this->request->data['Order']['shop_id'] = $shopId;
		$this->request->data['Customer']['shop_id'] = $shopId;
		
		$this->request->data['Cart']['hash'] = $hash;
		
		$country = ClassRegistry::init('Country');
		$country->recursive = -1;
		// because paypal returns the 2 letter iso format for countries
		$deliveredCountry = $country->findByIso($GECDFields['SHIPTOCOUNTRYCODE']);
		$countryId = 0;
		if (isset($deliveredCountry['Country']['id'])) {
			$countryId = $deliveredCountry['Country']['id'];
		}
		
		$this->request->data['BillingAddress'][0]['full_name'] = $GECDFields['SHIPTONAME'];
		$this->request->data['BillingAddress'][0]['address'] = $GECDFields['SHIPTOSTREET'];
		$this->request->data['BillingAddress'][0]['city']    = $GECDFields['SHIPTOCITY'];
		$this->request->data['BillingAddress'][0]['region'] = isset($GECDFields['SHIPTOSTATE']) ? $GECDFields['SHIPTOSTATE'] : '';
		$this->request->data['BillingAddress'][0]['zip_code'] = $GECDFields['SHIPTOZIP'];
		$this->request->data['BillingAddress'][0]['country'] = $countryId;
		$this->request->data['BillingAddress'][0]['type'] = BILLING;
		
		return $countryId;
	}
	
	
	private function executeDECP($PayPalRequest, $shopId) {
		
		$accountEmail = $this->Order->Shop->getAccountEmailPaypal($shopId);
		
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'),
				      'APISubject' => $accountEmail);
		
		$PayPal = new PayPal($PayPalConfig);
		
		/** because in sandbox testing, we are likely to use back the same invoiceID
		 * so we need to add in datetime for sandbox testing
		 **/
		if (Configure::read('paypal.sandbox')) {
			$PayPalRequest['Payments'][0]['invnum'] = date('Ymd-Hi') . '-' . $PayPalRequest['Payments'][0]['invnum'];
		}
		
		$PayPalResult = $PayPal->DoExpressCheckoutPayment($PayPalRequest);
			
		$this->Session->write('Shop.'.$shopId.'.PayPalResult', $PayPalResult);
		
		return $PayPalResult;
	}

	
	
	public function success_orig($shop_id = null) {
		
		$paypal = isset($this->request->params['url']['paypal']);
		$tokenValueOn = isset($this->request->params['url']['token']);
		$shops_payment_module_id = $this->Order->Shop->getPayPalShopsPaymentModuleId($shop_id);
		
		/** this is for PPEC at Payment pt ONLY **/
		$orderId = $this->Session->read('Shop.'.$shop_id. '.PaypalEC.Order.id');
		
		
		if (Configure::read('debug') > 0) {
			$link = 'http://ombi60.localhost';
		} else {
			$link = $this->Order->Shop->Domain->field('domain', array('shop_id' => $shop_id,
										  'primary' => true));
		}
		
		if ($paypal) {
			// call the GECD for PPEC at Payment point
			$PayPalRequestSet = $this->executeGECD($shop_id);
			if ($PayPalRequestSet['GECDResult']['ACK'] == 'Failure') {
				$this->log('after executeGECD in line 506');
				$this->log($PayPalRequestSet);	
			}
			
			// if executeGECD is successful
			else if (strtoupper($PayPalRequestSet['GECDResult']['ACK']) == 'SUCCESS') {
				// extract payerid, payeremail, payername, other info to update paypal_payers
				$paypalPayer = $this->Order->Payment->PaypalPayersPayment->PaypalPayer->saveAfterGECD($PayPalRequestSet['GECDResult']);
				
				$tokenValue = $this->request->params['url']['token'];
				
				
				// call the DECP to complete the transaction for PPEC at Payment point
				$result = $this->executeDECP($PayPalRequestSet['PayPalRequest'], $shop_id);
				if ($result['ACK'] == 'Failure') {
					$this->log('after executeDECP in line 515');
					$this->log($result);
					
					// display failure page
					// 
					// $this->redirect('failed');
					// exit;
				} else {
					// now set the payment to complete by finding it and then saving
					// we do 2 step because we also need the payment id to do a save for
					// paypalpayerspayment table
					$this->Order->Payment->recursive = -1;
					
					
					$payment = $this->Order->Payment->find('first', array('conditions' => array('token_from_gateway' => $tokenValue,
														    'shops_payment_module_id' => $shops_payment_module_id,
														    'order_id' => $orderId)));
					
					if ($payment) {
						// this is for setting the transaction id and other Paypal related info
						$payment['Payment']['transaction_id_from_gateway'] = $result['PAYMENTS'][0]['TRANSACTIONID'];
						$payment['Payment']['ordertime_from_gateway'] = $result['PAYMENTS'][0]['ORDERTIME'];
						$payment['Payment']['currencycode_from_gateway'] = $result['PAYMENTS'][0]['CURRENCYCODE'];
						$payment['Payment']['feeamt_from_gateway'] = $result['PAYMENTS'][0]['FEEAMT'];
						$payment['Payment']['settleamt_from_gateway'] = $result['PAYMENTS'][0]['SETTLEAMT'];
						$payment['Payment']['taxamt_from_gateway'] = $result['PAYMENTS'][0]['TAXAMT'];
						$payment['Payment']['exchangerate_from_gateway'] = $result['PAYMENTS'][0]['EXCHANGERATE'];
						$payment['Payment']['paymentstatus_from_gateway'] = $result['PAYMENTS'][0]['PAYMENTSTATUS'];
						$payment['Payment']['pendingreason_from_gateway'] = $result['PAYMENTS'][0]['PENDINGREASON'];
						$payment['Payment']['reasoncode_from_gateway'] = $result['PAYMENTS'][0]['REASONCODE'];
						
						
						
						// this is for setting the status
						$payment['Payment']['status'] = PAYMENT_PAID;
						$orderData = array('Order' => array('payment_status' => PAYMENT_PAID,
										    'id' => $payment['Payment']['order_id']));
						
						$payment['Order'] = $orderData['Order'];
						
						// this is for creating the paypalpayerspayment record
						$payment['PaypalPayersPayment']['paypal_payer_id'] = $paypalPayer['PaypalPayer']['id'];
						
						
						$result = $this->Order->Payment->saveAll($payment);
						
						if ($result) {
							$this->Session->delete('Shop.' .$shop_id. '.PaypalEC.Order.id', $this->Order->id);
						}
						
						
					}	
				}
				
				
				
			}
			
		}
		$this->set('link', $link);
	}
	
	// expect $this->request->params to have cart_id, order_id, shipping_rate_id
	public function update_prices($shop_id = false, $order_uuid = false) {
		
		$successJSON = false;
		$contents = array();
		
		$this->layout = 'json';
		
		// validate for cart_id, order_id, shipping_rate_id
		if (!array_key_exists('cart_id', $this->request->data) ||
		    !$order_uuid ||
		    !array_key_exists('shipping_rate_id', $this->request->data)
		    ) {
			$successJSON = false;
			$contents['reason'] = __('Invalid parameters');
		} else if ($this->request->params['isAjax']) {
			// 1st we get Shipping price
			$price = $this->Order->Shop->ShippedToCountry->ShippingRate->field('price', array('id'=>$this->request->data['shipping_rate_id']));
			// 2nd we update Order with new shipping fee
			$this->Order->id = $order_uuid;
			$this->Order->save(array(
				'shipping_fee' => $price
			));
			// 3rd we update Cart and Order prices just in case
			$data = $this->Order->recalculateTotalWeightPrice($order_uuid);
			$this->Order->Cart->recalculateTotalWeightPrice($this->request->data['cart_id']);
			
			$successJSON = true;
			App::uses('NumberLib', 'UtilityLib.Lib');
			$contents['totalAmountWithShipping'] 	= NumberLib::currency($data['Order']['amount'] + $price, '$');
			$contents['shippingFee']				= NumberLib::currency($price, '$');
				
		}
		
		$this->set(compact('contents', 'successJSON'));
		$this->render('json/response');
		
	}
	
	public function pay($shop_id = false, $order_uuid = false) {
		$this->layout = 'default';
		
		if ($this->request->is('get')) {
			// use the given shop id to re-establish Shop data into session
			Shop::store($this->Order->Shop->getById($shop_id));
			
			
			// get Order data
			$this->Order->id 	= $order_uuid;
			// refresh prices, weights, etc
			$this->Order->recalculateTotalWeightPrice($order_uuid);
			$currentOrder 		= $this->Order->getItemsWithImages($order_uuid);
			
			// set up the shipping options
			if ($currentOrder['Order']['shipping_required']) {
				$shippedAmt 	= $currentOrder['Order']['shipped_amount'];
				$shippedWeight 	= $currentOrder['Order']['shipped_weight'];				
				$country		= $currentOrder['Order']['delivered_to_country'];
				
				$shipmentOptions = $this->Order->Shipment->getOptionsForCheckout($shippedAmt, $shippedWeight, $shop_id, $country);

				$shippingFee = $this->Order->Shipment->getPriceFromDisplayName(current($shipmentOptions));

				$currentOrder['Order']['amount'] = $currentOrder['Order']['shipped_amount'] + $shippingFee;
			}
			
			// set up the payment options
			$paymentOptions = $this->Order->Payment->getOptionsForCheckout($shop_id);
			
			// populate view vars
			$this->set(compact(
				'currentOrder', 
				'shipmentOptions', 
				'shippingFee',
				'paymentOptions'
			));
			
		}
	}
	
	/**
	*
	* this action handles the POSTBACK for the checkout process step 2
	*
	* @param integer $shop_id Shop id
	* @param string $order_uuid Order id
	* @param boolean Returns the result for all the $this->redirect
	**/
	public function complete_purchase($shop_id = false, $order_uuid = false) {
		$this->layout 		= 'default';
		$this->autoRender 	= false;
		
		if ($this->request->is('post')) {
			$orderFormData = $this->request->data;
			
			$this->Order->id = $order_uuid;
			
			// 3 Step
			// first we retrieve all relevant shipping rate data and attach the shipping rate data as shipment data
			// second we format payment & shipment data as hasMany association
			// finally we save
			
			// first retrieve the shipping rate based on shipping_rate_id
			$rate = $this->Order->Shop->ShippedToCountry->ShippingRate->read(null, $orderFormData['Shipment']['shipping_rate_id']);
			
			// format the shipping rate data into shipment data
			$result = $this->Order->extractShipmentDataFromShippingRate($rate);
			if ($result) {
				$orderFormData['Shipment'] = $result['Shipment'];
			} else {
				// something went wrong with shipment data
				// redirect user back to pay page and ask them to contact owner for assistance
			}
			
			// second, format payment data
			$order = $this->Order->find('first', array('conditions' => array('Order.id' => $order_uuid))); 
			
			//TODO Possibly we need to prepare purchase info for each payment gateway
			$accountEmail = $this->Order->Shop->getAccountEmailPaypal($shop_id);
			$options = array(
				'subject' => $accountEmail,
				'currency' => $order['Order']['currency'],
				'amount' => $orderFormData['Shipment']['price'] + $order['Order']['amount'],
				'payment_breakdown' => array(
					'item_total' => $order['Order']['amount'],
					'shipping' => $orderFormData['Shipment']['price'],
					'handling' => 0 //$order['Order']['amount']
				),
			);
			foreach ($order['OrderLineItem'] as $orderItem) {
				$options['items'][] = array(
					'description' => $orderItem['product_title'],
					'unit_price' => $orderItem['product_price'],
					'quantity' => $orderItem['product_quantity'],
					'id' => $orderItem['product_id']
				);
			}
			$ShopsPaymentModule = ClassRegistry::init('ShopsPaymentModule');
			$shopsPaymentModule = $ShopsPaymentModule->find('first', array('conditions' => array('ShopsPaymentModule.id' => $orderFormData['Payment']['shops_payment_module_id'])));
			$this->Payments->setupPurchase($shopsPaymentModule['ShopsPaymentModule']['display_name'], $options);
			$orderFormData['Payment']['token_from_gateway'] = $this->Payments->getFromResponse($shopsPaymentModule['ShopsPaymentModule']['display_name'], 'TOKEN');
			$payment = array($orderFormData['Payment']);
			$shipment = array($orderFormData['Shipment']);
			$orderFormData['Payment'] 	= $payment;
			$orderFormData['Shipment'] 	= $shipment;
			// now we are going to save the Payment and Shipment rates
			$result = $this->Order->completePurchase($orderFormData);
			if ($result) {
				if (!$this->Payments->redirect($shopsPaymentModule['ShopsPaymentModule']['display_name'])) {
					return $this->redirect(array(
									'action' => 'completed',
									'shop_id'=> $order['Order']['shop_id'],
									'order_uuid' => $order['Order']['id'],
					));
				}
				 
				//Add conditions to another payment gateways
			}else {
				// redirect user back to pay page and ask them to contact owner for assistance
			}
		}
		
	
	}
	
/**
 *
 * this action handles the POSTBACK from the payment gateway
 *
 * @param boolean Returns the result for all the $this->redirect
 **/
	public function return_from_payment() {
		$payment = $this->Order->Payment->find('first', array('conditions' => array('token_from_gateway' => $this->params->query['token'])));
		if ($this->Payments->isPaypalExpress($payment['ShopsPaymentModule']['display_name'])) {
			$accountEmail = $this->Order->Shop->getAccountEmailPaypal($payment['Order']['shop_id']);
			$purchase_opts = array(
				'subject' => $accountEmail,
			    'currency' => $payment['Order']['currency'],
				'token' => $this->params->query['token'],
				'PayerID' => $this->params->query['PayerID']
			);
			$response = $this->Payments->purchase($payment['ShopsPaymentModule']['display_name'], $purchase_opts);
			$result = $response->success();
			if ($result) {
				//TODO Check if we need to change order status to Completed
				$payment['Payment']['transaction_id_from_gateway'] = $response->__get('PAYMENTINFO_0_TRANSACTIONID');
				$payment['Payment']['ordertime_from_gateway'] = $response->__get('PAYMENTINFO_0_ORDERTIME');
				$payment['Payment']['paymentstatus_from_gateway'] = $response->__get('PAYMENTINFO_0_PAYMENTSTATUS');
				$payment['Payment']['feeamt_from_gateway'] = $response->__get('PAYMENTINFO_0_FEEAMT');
				$payment['Payment']['pendingreason_from_gateway'] = $response->__get('PAYMENTINFO_0_PENDINGREASON');
				$result = $this->Order->Payment->save($payment);
				
				// set the Order as successfully opened
				$this->Order->read(null, $payment['Payment']['order_id']);
				$this->Order->set('status', ORDER_OPENED);
				$this->Order->save();
			}
		}
				
		return $this->redirect(array(
			'action' => 'completed',
			'shop_id'=> $payment['Order']['shop_id'],
			'order_uuid' => $payment['Order']['id'],
		));
		
		
	}
	
	/**
	*
	* Displays success for order purchase completion
	*
	* @param integer $shop_id Shop id
	* @param string $order_uuid Order id
	* @return void
	**/
	public function completed($shop_id = false, $order_uuid = false) {
		$this->layout 	= 'default';
		$shop 			= $this->Order->Shop->getById($shop_id);
		$link 			= $shop['Shop']['primary_domain'];
		
		$this->set(compact('link'));
		$order = $this->Order->find('first', array('conditions' => array('Order.id' => $order_uuid)));		
		if ($this->Order->completedCheckout($order_uuid)) {
			$this->Order->sendNotification('checkout', $order);
			$this->render('success');
		} else {
			$this->render('failure');
		}
	}
	
	
	public function pay_orig($shop_id, $hash) {
		
		$payPalShopsPaymentModuleId = $this->Order->Shop->getPayPalShopsPaymentModuleId($shop_id);
		if ($this->request->is('get')) {
			$confirmPage = $this->Session->read('Shop.' .$shop_id. '.confirmPage');
			
			$PayPalRequest = $confirmPage['PayPalRequest'];
			$sessionHash = $confirmPage['hash'];
			
			// retrieve the paypal_payer_id and place it inside the ctp
			$this->set('paypal_payer_id', $confirmPage['paypal_payer_id']);
			
			// set the delivery country as default 0
			$country = 0;
			
			$order = $this->Order->findByHash($hash);
			
			
			// need this to filter the right shipping settings
			// for Paypal Express Checkout.
			if (!empty($PayPalRequest)) {
				
				// need to compare $order with confirmPage
				// if same for both paypal at checkout point and payment point
				// then remove this code block and use order directly.
				// $this->log('paypal in pay');
				// $this->log($order);
				// $this->log($confirmPage);
				
				$totalAmount = $confirmPage['amount'];
				$shippedAmt = $confirmPage['shipped_amount'];
				$shippedWeight = $confirmPage['shipped_weight'];
				$displayShipment = $confirmPage['shipping_required'];
				
				$country = $order['DeliveryAddress']['country'];
			
			// for the other payment modules
			} else {
				
				$totalAmount = $order['Order']['amount'];
				$shippedAmt = $order['Order']['shipped_amount'];
				$shippedWeight = $order['Order']['shipped_weight'];
				$displayShipment = ($order['Order']['shipped_weight'] > 0);
				
				$country = $order['DeliveryAddress']['country'];
			}
			
			
			// assumed originally same
			$totalAmountWithShipping = $totalAmount;
			
			$forPayPalAtCheckout = (($sessionHash == $hash) AND ($PayPalRequest != false));
			
			
			$paymentModuleInShop 	        = $this->Order->Payment->ShopsPaymentModule;
			$paymentModuleInShop->recursive = -1;
			
			
			$shippingRates = array();
			$defaultShipment = "";
			if ($displayShipment) {
				$shippingRatesResultSet = $this->getShipmentOptions($shippedAmt, $shippedWeight, $shop_id, $country);
				$shippingRates = $shippingRatesResultSet['display'];
				$defaultShipment = key($shippingRates);
				$shippingFee = (isset($shippingRatesResultSet['price'][$defaultShipment])) ? $shippingRatesResultSet['price'][$defaultShipment] : 0;
				
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
				$shopsPaymentModules = $paymentModuleInShop->find('list', array(
					'conditions'=>array(
						'ShopsPaymentModule.shop_id'=>$shop_id, 
						'ShopsPaymentModule.active' => true
					), 
				));
				
			    foreach ($shopsPaymentModules as $module_id => $payments) {
			        $pos = strpos($payments,'Paypal');
                    
                    if($pos === false) {
                     $test[$module_id] = $payments;
                    }
                    else {
                     $test[$module_id] = "<img src='/img/paypal.jpeg' style='float:left; margin-right: 5px;' />".$payments;
                    }
			    }
			    $shopsPaymentModules = $test;
				$defaultPayment = key($shopsPaymentModules);
			}
			
			
			$orderData          = array('Order'=>$order['Order']);
			
			
			// here we will buildPayment and buildItem for paypal
			
			$this->set(compact('orderData', 'shopsPaymentModules', 'shippingRates',
					   'hash', 'shop_id', 'displayPaymentMode', 'displayShipment',
					   'totalAmount', 'totalAmountWithShipping',
					   'defaultShipment', 'defaultPayment', 'payPalShopsPaymentModuleId'));
			
		} else if ($this->request->is('post')) {
			
			$orderStatus = ORDER_OPENED;
			$paymentStatus = PAYMENT_INITIATED;
			
			// for entry checkout point		
			$confirmPage = $this->Session->read('Shop.' .$shop_id. '.confirmPage');
			
			$PayPalRequest = $confirmPage['PayPalRequest'];
			$sessionHash = $confirmPage['hash'];
			
			$forPayPalAtCheckout = (($sessionHash == $hash) AND ($PayPalRequest != false));
			
			// get the price of shipping rate selected
			/** at this point the $this->request->data is this
			 *(
				[_Token] => Array
				    (
					[key] => fd397ad1c7ab7347d42bcc69de87b98653b086c4
					[fields] => 3f361938f55f4c2c8300753a089555d58ffff616%3An%3A4%3A%7Bv%3A0%3Bf%3A7%3A%22Pneg.vq%22%3Bv%3A1%3Bf%3A16%3A%22Cnlzrag.beqre_vq%22%3Bv%3A2%3Bf%3A31%3A%22Cnlzrag.fubcf_cnlzrag_zbqhyr_vq%22%3Bv%3A3%3Bf%3A17%3A%22Fuvczrag.beqre_vq%22%3B%7D
				    )
			    
				[Shipment] => Array
				    (
					[shipping_rate_id] => 4
					[order_id] => 3
				    )
			    
				[Payment] => Array
				    (
					[shops_payment_module_id] => 2
					[order_id] => 3
				    )
			    
				[Cart] => Array
				    (
					[id] => 7
				    )
			    
			    )
			    **/
			$shippingRateId = 0;
			$rate = false;
			if (isset($this->request->data['Shipment']['shipping_rate_id'])) {
				$shippingRateId = $this->request->data['Shipment']['shipping_rate_id'];
			}
			
			if ($shippingRateId > 0) {
				$rate = $this->Order->Shop->ShippedToCountry->ShippingRate->read(null, $this->request->data['Shipment']['shipping_rate_id']);
				
			} 
			
			if (isset($rate['ShippingRate'])) {
				$this->request->data['ShippingRate'] = $rate['ShippingRate'];
			}
			
			
			// for payment option point
			$payment 	 = $this->request->data['Payment']['shops_payment_module_id'];
			$this->Order->id = $this->request->data['Payment']['order_id'];
			
			if ($forPayPalAtCheckout) {
				
				/**
				 * at this point the $PayPalRequest is like this
				 * (
					[DECPFields] => Array
					    (
						[token] => EC-2F26074817330823D
						[payerid] => L3LUD63MGMMP4
						[returnfmfdetails] => 1
						[giftmessage] => 
						[giftreceiptenable] => 
						[giftwrapname] => 
						[giftwrapamount] => 
						[buyermarketingemail] => 
						[surveyquestion] => 
						[surveychoiceselected] => 
						[allowedpaymentmethod] => 
						[buttonsource] => 
					    )
				    
					[Payments] => Array
					    (
						[0] => Array
						    (
							[amt] => 40.00
							[currencycode] => SGD
							[itemamt] => 40.00
							[shippingamt] => 0.00
							[insuranceoptionoffered] => 
							[handlingamt] => 
							[taxamt] => 0.00
							[desc] => This is a test order.
							[custom] => 
							[invnum] => 
							[notifyurl] => 
							[shiptoname] => 
							[shiptostreet] => 
							[shiptostreet2] => 
							[shiptocity] => 
							[shiptostate] => 
							[shiptozip] => 
							[shiptocountry] => 
							[shiptophonenum] => 
							[notetext] => This is a test note before ever having left the web site.
							[allowedpaymentmethod] => 
							[paymentaction] => Sale
							[paymentrequestid] => 
							[sellerpaypalaccountid] => 
							[order_items] => Array
							    (
								[0] => Array
								    (
									[name] => product1
									[desc] => Widget 123
									[amt] => 10.00
									[number] => 3
									[qty] => 4
									[taxamt] => 
									[itemurl] => http://www.angelleye.com/products/123.php
									[itemweightvalue] => 
									[itemweightunit] => 
									[itemheightvalue] => 
									[itemheightunit] => 
									[itemwidthvalue] => 
									[itemwidthunit] => 
									[itemlengthvalue] => 
									[itemlengthunit] => 
									[ebayitemnumber] => 
									[ebayitemauctiontxnid] => 
									[ebayitemorderid] => 
									[ebayitemcartid] => 
								    )
				    
							    )
				    
						    )
				    
					    )
				    
				    )

				 * **/
				// attach the shipping amt into the paypal payment shipping_amt
				$shippingAmt = 0.00;
				
				if (isset($rate['ShippingRate']['price'])) {
					$shippingAmt = number_format($rate['ShippingRate']['price'],2,'.','');	
				}
				
				$subtotalAmt = $PayPalRequest['Payments'][0]['itemamt'];
				$totalAmt = $subtotalAmt + $shippingAmt; 
				$PayPalRequest['Payments'][0]['shippingamt'] = $shippingAmt;
				$PayPalRequest['Payments'][0]['amt'] = $totalAmt;
				
				// now set the invnum for PPEC from Checkout Point
				if (isset($this->request->data['Order']['order_no'])) {
					$PayPalRequest['Payments'][0]['invnum'] = substr($this->request->data['Order']['order_no'], 0, 127);
				}
				
				//$this->log($PayPalRequest);
				
				$orderStatus = ORDER_OPENED;
				$paymentStatus = PAYMENT_INITIATED;
				
				$result = $this->executeDECP($PayPalRequest, $shop_id);
				
				if ($result['ACK'] == 'Success') {
					
					$paymentStatus = PAYMENT_PAID;
					$this->request->data['Payment']['transaction_id_from_gateway'] = $result['PAYMENTS'][0]['TRANSACTIONID'];
					$this->request->data['Payment']['gateway_name'] = 'Paypal Express Checkout at Checkout';
					$this->request->data['Payment']['token_from_gateway'] = $result['TOKEN'];
					$this->request->data['Payment']['ordertime_from_gateway'] = $result['PAYMENTS'][0]['ORDERTIME'];
					$this->request->data['Payment']['currencycode_from_gateway'] = $result['PAYMENTS'][0]['CURRENCYCODE'];
					$this->request->data['Payment']['feeamt_from_gateway'] = $result['PAYMENTS'][0]['FEEAMT'];
					$this->request->data['Payment']['settleamt_from_gateway'] = $result['PAYMENTS'][0]['SETTLEAMT'];
					$this->request->data['Payment']['taxamt_from_gateway'] = $result['PAYMENTS'][0]['TAXAMT'];
					$this->request->data['Payment']['exchangerate_from_gateway'] = $result['PAYMENTS'][0]['EXCHANGERATE'];
					$this->request->data['Payment']['paymentstatus_from_gateway'] = $result['PAYMENTS'][0]['PAYMENTSTATUS'];
					$this->request->data['Payment']['pendingreason_from_gateway'] = $result['PAYMENTS'][0]['PENDINGREASON'];
					$this->request->data['Payment']['reasoncode_from_gateway'] = $result['PAYMENTS'][0]['REASONCODE'];
					
				} else if ($result['ACK'] == 'Failure') {
					
					$paymentStatus = PAYMENT_INITIATED;
					$this->log('DECP results line 886');
					$this->log($result);
					
				}
				
			} else if ($payment == $payPalShopsPaymentModuleId && !$forPayPalAtCheckout) {
				// read Payments from session
				$Payments = $this->Session->read('Shop.' .$shop_id. '.Payments');
				
				// read paymentAmount from session
				$paymentAmount = $this->Session->read('Shop.' .$shop_id. '.paymentAmount');
				$cancelURL =  Router::url(array('controller'=>'orders',
					       'shop_id'=>$shop_id,
					       'hash'=>$hash,
					       'action'=>'pay',), true);
				
				
				// prepare Shipping Fee
				$shippingAmt = 0.00;
				
				if (isset($rate['ShippingRate']['price'])) {
					$shippingAmt = number_format($rate['ShippingRate']['price'],2,'.','');	
				}
				
				$subtotalAmt = $Payments[0]['itemamt'];
				$totalAmt = $subtotalAmt + $shippingAmt; 
				$Payments[0]['shippingamt'] = $shippingAmt;
				$Payments[0]['amt'] = $totalAmt;
				
				// set shipping addresses
				// get delivery address by order id
				$this->Order->DeliveryAddress->recursive = -1;
				$this->Order->DeliveryAddress->Behaviors->load('Linkable.Linkable');
				$deliveryAddress = $this->Order->DeliveryAddress->find('first', array('conditions'=>array('Order.id'=>$this->Order->id,
												       'DeliveryAddress.type'=>DELIVERY),
												      'fields'=>array('DeliveryAddress.*', 'Country.iso'),
												      'link'=>array('Order', 'Country')));
				
				
				$Payments[0]['shiptoname'] = $deliveryAddress['DeliveryAddress']['full_name'];
				$Payments[0]['shiptostreet'] = substr($deliveryAddress['DeliveryAddress']['address'], 0, 100);
				if (strlen($deliveryAddress['DeliveryAddress']['address']) > 100) {
					$Payments[0]['shiptostreet2'] = substr($deliveryAddress['DeliveryAddress']['address'], 100, 100);	
				}
				$Payments[0]['shiptocity'] = substr($deliveryAddress['DeliveryAddress']['city'], 0, 40);
				$Payments[0]['shiptostate'] = substr($deliveryAddress['DeliveryAddress']['region'], 0, 40);
				$Payments[0]['shiptozip'] = substr($deliveryAddress['DeliveryAddress']['zip_code'], 0, 20);
				$Payments[0]['shiptocountrycode'] = substr($deliveryAddress['Country']['iso'], 0, 2);
							
				// now set the invnum for PPEC from Payment Point.
				if (isset($this->request->data['Order']['order_no'])) {
					$Payments[0]['invnum'] = substr($this->request->data['Order']['order_no'], 0, 127);
				}
				
				$options = array('payments'=>$Payments,
						//'uuid'=>,
						'shopId'=>$shop_id,
						'cancelURL'=>  FULL_BASE_URL . $this->referer(),
						// we want to override the shipping address from our side
						'addroverride'=> 1,
						);
				
				// now set the email for PPEC from Payment Point
				if (isset($this->request->data['Order']['contact_email'])) {
					$options['email'] = substr($this->request->data['Order']['contact_email'], 0, 127);
				}
				
				$orderStatus = ORDER_OPENED;
				$paymentStatus = PAYMENT_INITIATED;
				
				// execute SEC
				$PayPalResult = $this->prepareSEC($options,
						  $hash);
				
				if ($PayPalResult['ACK'] == 'Failure') {
					$this->log('orderspreparesec in 889');
					$this->log($PayPalResult);
					
				} else if ($PayPalResult['ACK'] == 'Success') {
					$paymentStatus = PAYMENT_PENDING;
				} 
				
				// assign unique paypal transaction id to the payment
				$this->request->data['Payment']['token_from_gateway'] = $PayPalResult['TOKEN'];
				$this->request->data['Payment']['gateway_name']       = 'Paypal Express Checkout at Payment';
				
				
				$this->request->data['Order']['status'] = $orderStatus;
				$this->request->data['Payment']['status'] =  $paymentStatus;
				
				
				// save payment and shipment data as incomplete for payment
				$result = $this->Order->savePaymentAndShipment($this->request->data);
				
				if ($result) {
					// we need to write in the order id that is processed by paypalec at payment point
					$this->Session->write('Shop.' .$shop_id. '.PaypalEC.Order.id', $this->Order->id);
					
				}
				
				// redirect to PPREDIRECTURL
				$this->redirect($PayPalResult['REDIRECTURL']);	
				
			// this one clearly is for NON paypal modules	
			} else {
				$orderStatus = ORDER_OPENED;
				$paymentStatus = PAYMENT_PENDING;
			}
			
			
			// all payment modes will reach this part except for
			// PPEC at Payment Point
			$this->request->data['Order']['status'] = $orderStatus;
			$this->request->data['Payment']['status'] =  $paymentStatus;
			
			if ($this->Order->savePaymentAndShipment($this->request->data)) {
				
				$this->Session->setFlash(__('Order has been saved'), 'default', array('class'=>'flash_success'));
				$this->redirect(array('action' => 'success',
						      'controller' => 'orders',
						      'shop_id' => $shop_id));
			}
			
		}
		
	}
	
	
	private function getShipmentOptions ($shippedAmt, $shippedWeight, $shop_id, $country) {
			$shippingRate 	         = $this->Order->Shop->ShippedToCountry->ShippingRate;
			$shippingRate->recursive = -1;
			$shippingRate->Behaviors->load('Linkable.Linkable');
			
			$shippingRate->PriceBasedRate->Behaviors->load('Linkable.Linkable');
			$shippingRate->WeightBasedRate->Behaviors->load('Linkable.Linkable');
			
			// get the suitable ShippedToCountry based on shop_id and country_id
			$this->Order->Shop->ShippedToCountry->recursive = -1;
			$shippedToCountries = $this->Order->Shop->ShippedToCountry->find('all', array('conditions'=>array('ShippedToCountry.shop_id'=>$shop_id)));
			
			$countries = Set::extract('/ShippedToCountry[country_id='.$country.']/id', $shippedToCountries);
			
			// initialize as zero which means no such thing
			$shippedToCountryId = 0;
			
			// now we look for rest of the world shipping setting
			if (empty($countries)) {
				$countries = Set::extract('/ShippedToCountry[country_id=0]/id', $shippedToCountries);
			}
			
			// either YEA!! they do ship to this country specifically or they do ship to this country via country 0
			$shippedToCountryId = $countries[0];
			
			$conditionsForPrice = array('AND' => array(array('ShippedToCountry.id'=>$shippedToCountryId),
								   array('PriceBasedRate.min_price <=' =>$shippedAmt),
								   array('OR' => array(
											array('ShippedToCountry.country_id' =>0),
											array('ShippedToCountry.country_id' =>$country)
										)
									),
								   array('OR' => array(
											array('PriceBasedRate.max_price >=' =>$shippedAmt),
											array('PriceBasedRate.max_price ' => null)
										)
									)
								)
						);
			
			$conditionsForWeight = array('AND' => array(array('ShippedToCountry.id'=>$shippedToCountryId),
								   array('WeightBasedRate.min_weight <=' =>$shippedWeight),
								   array('OR' => array(
											array('ShippedToCountry.country_id' =>0),
											array('ShippedToCountry.country_id' =>$country)
										)
									),
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
	 *
	 * this prepareSEC is for PPEC at payment point
	 * */
	
	private function prepareSEC($postFields, $hash) {
		
		$accountEmail = $this->Order->Shop->getAccountEmailPaypal($postFields['shopId']);
		
		// we need to prepare the paypalexpresscheckout portion
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'),
				      'APISubject' => $accountEmail);
		
		
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
								 'addroverride'=>isset($postFields['addroverride']) ? $postFields['addroverride'] : '',
								 'email'=>isset($postFields['email']) ? $postFields['email'] : '',
								 'maxamt'=>number_format($postFields['payments'][0]['amt'] + 1000, 2, '.', '')));
								 
		
		// we want to set the button to confirm in PAYPAL checkout page
		// this is for Payment point
		$SECFields['skipdetails'] = '1';
		
		$PayPalRequest = array(
				'SECFields' => $SECFields, 
				'SurveyChoices' => $this->Paypal->buildSurveyChoices(), 
				'Payments' => $postFields['payments']
				);
		
		
		/** because in sandbox testing, we are likely to use back the same invoiceID
		 * so we need to add in datetime for sandbox testing
		 **/
		if (Configure::read('paypal.sandbox')) {
			$PayPalRequest['Payments'][0]['invnum'] = date('Ymd-Hi') . '-' . $PayPalRequest['Payments'][0]['invnum'];
		}
		
		
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
			
		$accountEmail = $this->Order->Shop->getAccountEmailPaypal($shopId);
			
		$Payments = $this->Session->read('Shop.'.$shopId.'.Payments');
		
		$PayPalConfig = array('Sandbox' => Configure::read('paypal.sandbox'),
				      'APIUsername' => Configure::read('paypal.api.username'),
				      'APIPassword' => Configure::read('paypal.api.password'),
				      'APISignature' => Configure::read('paypal.api.signature'),
				      'APISubject' => $accountEmail);
		
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
