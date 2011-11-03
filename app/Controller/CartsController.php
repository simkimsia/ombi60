<?php
// we use angelleye code
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));
App::uses('ShopSetting', 'Model');

class CartsController extends AppController {

	public $name = 'Carts';
	
	public $checkoutLink = '';
	
	public $helpers = array('Html', 'Form', 'Session');

	public $components = array(
		'Session', 
		'Paypal.Paypal',
		'Theme' => array(
			'view_cart',
		)
	);
	
	public $view = 'TwigView.Twig';
	
	public function beforeFilter() {
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();


		//$this->Auth->allow('checkout', 'paypalExpressCheckout', 'add');
		$this->Auth->allow(
			'add_to_cart',
			'change_qty_for_1_item_in_cart',
			'view_cart',
			'view',
			'create_order',
			'redirectem',
			'user_type',
			'catchem'
		);
		
		if ($this->request->action == 'add_to_cart' || 
			$this->request->action == 'view_cart'	||
			$this->request->action == 'create_order'
		) {
			$this->Components->disable('Security');
		}
		
	}
	
	/**
	* 
	* Add to cart action
	*
	* @param void
	* @return void
	**/
	public function add_to_cart() {

		$id = !empty($_POST['id']) ? $_POST['id'] : false;
		
		if(!$id) {
			$this->Session->setFlash(__('Invalid id for Product'), 'default', array('class'=>'flash_failure'));
			return $this->redirect($this->referer());
		}
		
		// set $qty as quantities purchased
		$qty 			= 1;
		$qtyExists 		= !empty($_POST['quantity']);
		$qtyIsPositive 	= $qtyExists ? (is_numeric($_POST['quantity']) AND ($_POST['quantity'] > 0)) : false;
		
		if ($qtyIsPositive) {
			$qty = 	$_POST['quantity'];
		}
		
		$addToCartSuccessful = $this->Cart->addProductForCustomer(User::get('User.id'), array($id=>$qty));
		
		if($addToCartSuccessful) {
			$this->Session->setFlash(__('Product added to cart'), 'default', array('class'=>'flash_success'));
			return $this->redirect(array('action' => 'view_cart'));
		} else {
			$this->Session->setFlash(__('The Product could not be added to cart. Please, try again.'), 'default', array('class'=>'flash_failure'));
			return $this->redirect($this->referer());
		}
	}
	
	
	/**
	 * 
	 * Update quantity for single item in Cart
	 *
	 * @param integer $variant_id Id of the variant 
	 * @return void
	**/
	public function change_qty_for_1_item_in_cart($variant_id = 0) {

		$paramExist = !is_blank($this->params4GETAndNamed['quantity']);

		if ($paramExist) {
			$variantIsPositive 	= is_numeric($variant_id) && ($variant_id > 0);

			$quantity 			= $this->params4GETAndNamed['quantity'];
			$qtyIsNonNegative 	= is_numeric($quantity) && ($quantity >= 0);

			$continue = $variantIsPositive && $qtyIsNonNegative;

			if ($continue) {
				$this->Cart->changeQuantityFor1Item($variant_id, $quantity);
			}

		}

		return $this->redirect(array('action' => 'view_cart'));
	}
	
	/**
	* 
	* Action for displaying form for collecting addresses.
	* This is also known as checkout process page 1
	*
	* @param integer $shop_id Shop id 
	* @param string $cart_uuid Cart id in UUID format
	* @return void
	*
	**/
	public function view($shop_id = false, $cart_uuid = false) {

		if ($this->request->is('get')) {
			$usersAccepted = $this->Session->read('CurrentShop.ShopSetting.users_accepted');
			if ($usersAccepted == ShopSetting::REGISTERED_ONLY && !$this->Auth->user()) {
				return $this->redirect(array('action' => 'user_type', 'shop_id' => $shop_id, 'cart_uuid' => $cart_uuid));
			}
			// use the given shop id to re-establish Shop data into session
			Shop::store($this->Cart->Shop->getById($shop_id));
			$shopId 	= $shop_id;

			// set up the countries, customerId, shopId in the form.
			$countries 	= $this->Cart->Order->BillingAddress->Country->find('list');
			$user = $this->Cart->User->find('first', array('contain' => array('Customer'), 'conditions' => array('User.id' => $this->Auth->user('id'))));
			$customerId = $user['Customer']['id'];
			
			// get all shipping addresses of this customer
			$shippingAddresses = array();
			if ($customerId > 0) {
				$this->Cart->Order->DeliveryAddress->recursive = -1;
				$shippingAddresses = $this->Cart->Order->DeliveryAddress->getAllByCustomer($customerId, DELIVERY);
			}
			// get Cart data
			$this->Cart->id = $cart_uuid;
			$this->Cart->recalculateTotalWeightPrice($cart_uuid);
			$currentCart 	= $this->Cart->getItemsWithImages($cart_uuid);

			// populate view vars
			$this->set(compact('user', 'countries', 'customerId', 'shopId', 'shippingAddresses', 'currentCart')
			);
		}
		
		$this->layout = 'default';
	}
	
	/**
	*
	* Action for creating order. Only works for POSTBACK
	* Meant for form in checkout process page 1
	*
	* @param integer $shop_id Shop id 
	* @param string $cart_uuid Cart id in UUID format
	* @return void
	*
	**/
	public function create_order($shop_id = false, $cart_uuid = false) {
		
		$this->layout = 'default';
		$this->autoRender = false;
		
		if ($this->request->is('post')) {
			
			// use the given shop id to re-establish Shop data into Session
			Shop::store($this->Cart->Shop->getById($shop_id));
			
			// we want to avoid displaying the shop id and the cart uuid inside the HTML source
			// so we need to reinsert them back into the request data
			$this->request->data['Order']['shop_id'] = $shop_id;
			$this->request->data['Order']['cart_id'] = $cart_uuid;
			
			$order_uuid = $this->Cart->Order->createFrom($this->request->data);
			
		} 
		
		return $this->redirect(array('controller'=>'orders', 'action'=>'pay', 'shop_id' => $shop_id, 'order_uuid' => $order_uuid));
		
		
		
	}


	/**
	 * 
	 * Action for viewing cart. Also handles postback for update cart and checkout.
	 *
	 * @param void
	 * @return void
	**/
	public function view_cart() {

		// need to check for POST and the Update button
		// update button is named as update (singular)
		// the update_x is to work with input type="image" for the update button
		$updateButtonUsed 		= isset($this->request->data['update']);
		$updateImageButtonUsed 	= isset($this->request->data['update_x']);
		$updateButtonTriggered	= ($updateButtonUsed OR $updateImageButtonUsed);

		if ($updateButtonTriggered) {
			$this->Cart->editQuantities();
			return $this->redirect(array('action' => 'view_cart'));
		}
		
		
		$checkoutButtonUsed 		= isset($this->request->data['checkout']);
		$checkoutImageButtonUsed 	= isset($this->request->data['checkout_x']);
		$checkoutButtonTriggered	= ($checkoutButtonUsed OR $checkoutImageButtonUsed);
		
		$userId = User::get('User.id');
		$shop_id  = Shop::get('Shop.id');
		
		if ($checkoutButtonTriggered) {
			$cart_uuid = $this->Cart->getLiveCartIDByUserID($userId);
			
			if (!empty($cart_uuid)) {
				return $this->redirect(array('action' => 'redirectem', $shop_id, $cart_uuid));
			}
		}
		
		$normalDisplayForViewCart = !$checkoutButtonTriggered && !$updateButtonTriggered;
		
		if ($normalDisplayForViewCart) {
			$products = array();

			// check if shop wants to have paypal option
			//$paypalExpressOn = $this->Cart->Shop->getPaypalExpressOn($shop_id);
			$paypalExpressOn = false;

			// retrieve live cart of customer
			$productsInCart = $this->Cart->getLiveCartForCartTemplate(User::get('User.id'));

			$paymentAmount = 0.00;

			$PaymentOrderItems = array();
			$Payments = array();
			$currency = '';	

			$products = (isset($productsInCart['CartItem'])) ? $productsInCart['CartItem'] : array();

			$prepareSessionForPaypal = !empty($productsInCart) && $paypalExpressOn;
			/*
			if ($prepareSessionForPaypal) {

				// loop thru the cart inside Session
				foreach($products as $cart_id => $product) {
					// total the amount
					$paymentAmount += $product['product_price'] * number_format($product['product_quantity'],1);

					// build the item url
					$itemUrl = $this->Product->getProductUrl($product['product_id']);

					// build the item
					$item = $this->Paypal->buildItem(array(
								       'amt'=>$product['product_price'],
								       'name'=>$product['product_title'],
								       'qty'=>$product['product_quantity'],
								       'number'=>$product['product_id'],
								       'itemurl'=>$itemUrl,
								       'itemweightvalue'=>$product['product_weight'],
								       'itemweightunit'=>'grams'));

					array_push($PaymentOrderItems, $item);

					$currency = $product['currency'];
				}

				$paymentAmount = number_format($paymentAmount, 2);

				$Payment = $this->Paypal->buildPayment(array('amt'=>$paymentAmount,
									     'currencycode'=> $currency,
									     'itemamt'=>$paymentAmount,
									     'shippingamt'=>'0.00',
									     'taxamt'=>'0.00'));

				$Payment['order_items'] = $PaymentOrderItems;
				array_push($Payments, $Payment);

				// save all the payments into session
				$this->Session->write('Shop.'.$shop_id.'.Payments', $Payments);

			}
			*/
			$this->Session->write('Shop.' . $shop_id . '.paymentAmount', $paymentAmount);
			$cart_id = $productsInCart['Cart']['id'];


			// reassign the products into items
			$cart = Cart::getTemplateVariable($productsInCart);

			$this->set(compact('cart', 'paypalExpressOn', 'paymentAmount', 'cart_id'));

			$sessionString = '';
			$mainUrl = Shop::get('Shop.primary_domain');

			//$this->log('user id in view_cart ' . User::get('User.id'));

			// now we are going to pass the session into the database for the crossover for checkout

			if (!$this->Cart->Shop->isCurrentBaseThisDomain($mainUrl)) {
				// test if we need to send User id over
				$this->Session->write('User.id', User::get('User.id'));
				//$this->log('new user id in session write ' . $this->Session->read('User.id'));
				$sessionString = '?ss='.$this->transferSession();
			}
			$this->set('sessionString', $sessionString);

			$this->render('cart');
		}
		
		
	}

/**
 * Defines checkout method (Registered or guest users)
 * @param unknown_type $shop_id
 * @param unknown_type $cart_uuid
 */	
	public function user_type($shop_id = null, $cart_uuid = null){
		$usersAccepted = $this->Session->read('CurrentShop.ShopSetting.users_accepted');
		if ($usersAccepted == ShopSetting::REGISTERED_ONLY || $usersAccepted == ShopSetting::BOTH) {
			if (!$this->Auth->user()) {
				$this->set('shop_id', (empty($shop_id) ? $this->params->named['shop_id'] : $shop_id));
				$this->set('cart_uuid', (empty($cart_uuid) ? $this->params->named['cart_uuid'] : $cart_uuid));
				$this->set('registered_only', $this->Session->read('CurrentShop.ShopSetting.users_accepted') == ShopSetting::REGISTERED_ONLY);
				$this->layout = 'default';
			} else {
				return $this->redirect(array('action' => 'view', 'shop_id' => $shop_id, 'cart_uuid' => $cart_uuid));
			}
		} else {
			return $this->redirect(array('action' => 'view', 'shop_id' => $shop_id, 'cart_uuid' => $cart_uuid));
		}
		
	}
/**
 * Retrieves session information from shop
 */	
	public function catchem() {
		if (!empty($this->params->query['shop_id']) && !empty($this->params->query['cart_uuid'])) {
			$shop_id = $this->params->query['shop_id'];
			$cart_uuid = $this->params->query['cart_uuid'];
		}
		return $this->redirect(array('action' => 'user_type', $shop_id, $cart_uuid));
	}
	
/**
 * Redirects to checkout page and saves session information
 * @param unknown_type $shop_id
 * @param unknown_type $cart_uuid
 */
	public function redirectem($shop_id, $cart_uuid) {
		$this->autoRender = false;
		App::import('Core', 'String');
		$data['SiteTransfer']['sess_id'] = $this->Session->id();
		$data['SiteTransfer']['id'] = String::uuid();
		$SiteTransfer = ClassRegistry::init('SiteTransfer');
		if($SiteTransfer->save($data)) {
			$this->redirect(
				        'https://checkout.ombi60.localhost/carts/catchem?uuid='. $SiteTransfer->id . '&shop_id=' . $shop_id . '&cart_uuid=' . $cart_uuid
			);
		}
	}


}
?>