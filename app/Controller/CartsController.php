<?php
// we use angelleye code
App::import('Vendor', 'PayPal', array('file'=>'paypal'.DS.'includes'.DS.'paypal.nvp.class.php'));

class CartsController extends AppController {

	public $name = 'Carts';
	
	public $checkoutLink = '';
	
	public $helpers = array('Html', 'Form', 'Session');

	public $components = array(
		'Session', 
		'Paypal.Paypal',
		'RandomString.RandomString',
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
			'view_cart'
		);
		
		if ($this->request->action == 'add_to_cart' || 
			$this->request->action == 'view_cart'
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
			$this->redirect($this->referer());
		}
		
		$qty = 1;
		
		$qtyExists = !empty($_POST['quantity']);
		$qtyIsPositive = $qtyExists ? is_numeric($_POST['quantity']) AND ($_POST['quantity'] > 0) : false;
		if ($qtyIsPositive) {
			$qty = 	$_POST['quantity'];
		}
		
		if($this->addToCart($id, $qty)) {
			$this->Session->setFlash(__('Product added to cart'), 'default', array('class'=>'flash_success'));
			$this->redirect(array('action' => 'view_cart'));
		}
		$this->Session->setFlash(__('The Product could not be added to cart. Please, try again.'), 'default', array('class'=>'flash_failure'));
		$this->redirect($this->referer());
	}
	

	/**
	 * 
	 * Add Variant to Cart given the variant id and quantity. 
	 * Wrapper function that bridges between the public action and the model function that does the lifting.
	 *
	 * @param integer $id 
	 * @param integer $quantity
	 * @return boolean Returns true if successful.
	**/
	private function addToCart($id = null, $quantity = 1) {
		return $this->Cart->addProductForCustomer(User::get('User.id'), array($id=>$quantity));
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

		$this->redirect(array('action' => 'view_cart'));
	}
	
	/**
	* 
	* Action for displaying form for collecting addresses.
	*
	* @param integer $cart_id Cart id
	* @param string $cart_hash Unique hash that identifies the cart
	* @return void
	*
	**/
	public function view($cart_id = false, $cart_hash = false) {
		
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
			$this->redirect(array('action' => 'view_cart'));
		}
		
		
		$checkoutButtonUsed 		= isset($this->request->data['checkout']);
		$checkoutImageButtonUsed 	= isset($this->request->data['checkout_x']);
		$checkoutButtonTriggered	= ($checkoutButtonUsed OR $checkoutImageButtonUsed);
		
		
		if ($checkoutButtonTriggered) {
			$this->log('checkout button works');
			$this->redirect(array('action' => 'view_cart'));
			$this->Cart->
		}
		
		
		$products = array();
		$shop_id  = Shop::get('Shop.id');
		
		// check if shop wants to have paypal option
		//$paypalExpressOn = $this->Cart->Shop->getPaypalExpressOn($shop_id);
		$paypalExpressOn = false;
		
		// retrieve live cart of customer
		$productsInCart = $this->Cart->getLiveCartByCustomerId(User::get('User.id'), true, true);
		
		
		
		$paymentAmount = 0.00;
			
		$PaymentOrderItems = array();
		$Payments = array();
		$currency = '';	
		
		$products = (isset($productsInCart['CartItem'])) ? $productsInCart['CartItem'] : array();
		
		$prepareSessionForPaypal = !empty($productsInCart) && $paypalExpressOn;
		
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
?>