<?php
class Cart extends AppModel {
	var $name = 'Cart';
	
	var $recursive = -1;
	
	var $actsAs    = array('Linkable.Linkable',
			       'Copyable.Copyable' => array(
					'habtm' => false,
					'recursive' => false,)
			       );

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);

	var $hasMany = array(
		'CartItem' => array(
			'className' => 'CartItem',
			'foreignKey' => 'cart_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => true,
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'cart_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => true,
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	var $validate = array(
		'user_id' => array(
			'oneLiveCartPerCustomer' => array(
				'rule' => 'oneLiveCartPerCustomer',
				'message' => 'Cannot have more than 1 live cart per customer',
				'on' => 'create'
			),
			'forCustomerOrCasual' => array(
				'rule' => 'forCustomerOrCasual',
				'message' => 'Only customers or casual surfers are allowed to have carts',
				
			)
		),
		
	);
	
	function forCustomerOrCasual($check){
		
		
		$count = $this->User->find('count', array('conditions' => array('OR' => array(array('User.group_id' => CUSTOMERS),
										     array('User.group_id' => CASUAL)),
										'AND' => array('id' => $check)
								       )));
		
		return ($count > 0);
		
	}
	
	
	function oneLiveCartPerCustomer($check){
		
		$oneLiveCartPerCustomer = true;
		
		$thisCartIsLive = isset($this->data['Cart']['past_checkout_point']) AND
			isset($this->data['Cart']['user_id']) AND
			(!$this->data['Cart']['past_checkout_point']) AND
			($this->data['Cart']['user_id'] > 0);
			
		if ($thisCartIsLive) {
			$existingLiveCart = $this->getLiveCartByCustomerId($this->data['Cart']['user_id']);
			
			$oneLiveCartPerCustomer = !($existingLiveCart);
		}
		
		return $oneLiveCartPerCustomer;
		
	}
	
	/**
	 * this is a very specific operation where it converts the Session data
	 * into savable data array
	 *
	 * it assumes $productsInCart is in this format
	 * array([product_id] => quantity_ordered)
	 *
	 * $options is in this format
	 * array([shop_id] => compulsory_value,
	 * 	 [user_id] => compulsory_value,
	 **/
	function prepareCartData($productsInCart, $options = array()) {
		
		$defaultOptions = array('user_id' => 0);
		
		$options = array_merge($defaultOptions, $options);
		
		if (!is_array($productsInCart) OR empty($productsInCart)) {
			return false;
		}
		
		
		
		$products = $this->CartItem->Product->find('all',
			    array('conditions' => array(
							'Product.id' => array_keys($productsInCart)
						    ),
			      
			      'fields'=>array('Product.id',
					      'Product.title',
					      'Product.price',
						  'Product.shipping_required',
					      'Product.weight',
					      'Product.currency',
					      
					      ),
			      ));
		
		
		
		// cause the products is using numerical index,
		// we want to do it such that it uses the Product id as key
		$products = Set::combine($products, '{n}.Product.id', '{n}');
		
		// initial data
		$data = array('Cart' => array( 'shop_id' => $options['shop_id'],
						'user_id' => $options['user_id'],
						),
			      'CartItem' => array());
		
		$subtotal = 0;
		$totalWeight = 0;
		$shippingWeight = 0;
		$shippingAmount = 0;
		$shippingRequired = false;
		$cartWeightUnit = '';
		$cartCurrency = '';
		
		// loop thru the cart inside Session
		foreach($productsInCart as $product_id => $qty) {
			// insert the quantity in
			$subtotal = $subtotal + $products[$product_id]['Product']['price'] * $qty;
			
			// insert into CartItem
			$data['CartItem'][] = array('product_id' => $product_id,
						'product_price' => $products[$product_id]['Product']['price'],
						'product_quantity' => $qty,
						'product_title' => $products[$product_id]['Product']['title'],
						'product_weight'=> $products[$product_id]['Product']['weight'],
						'currency' => $products[$product_id]['Product']['currency'],
						
						'shipping_required' => $products[$product_id]['Product']['shipping_required'],);
			
			// if shipping_required we totaled the amount
			if ($products[$product_id]['Product']['shipping_required']) {
				$shippingAmount += $products[$product_id]['Product']['price'] * $qty;
				$shippingWeight += $products[$product_id]['Product']['weight'] * $qty;
			}
			
			// insert the weight in
			$totalWeight = $totalWeight + $products[$product_id]['Product']['weight'] * $qty;
			
			// insert the shippingRequired
			$shippingRequired = ($shippingRequired || $products[$product_id]['Product']['shipping_required']);
			
			$cartCurrency = $products[$product_id]['Product']['currency'];
			
		}
		$data['Cart']['total_weight'] = $totalWeight;
		$data['Cart']['shipped_amount'] = $shippingAmount;
		$data['Cart']['amount'] = $subtotal;
		$data['Cart']['shipped_weight'] = $shippingWeight;
		$data['Cart']['shipping_required'] = $shippingRequired;
		
		$data['Cart']['currency'] = $cartCurrency;
		
		if ($subtotal > 0 AND !empty($data['CartItem'])) {
			return $data;
		}
		return false;
	}
	
	function findByHash($hash, $step = 1) {
		$this->Behaviors->attach('Containable');
		
		$this->contain('CartItem');
		
		if ($step == 1) {
			$field = 'Cart.hash';
		}
		
		return $this->find('first', array('conditions' => array($field => $hash)));
		
	}

	/**
	 * this is a very specific operation where it converts the Session data
	 * into savable data array
	 *
	 * it assumes $productsInCart is in this format
	 * array([product_id] => quantity_ordered)
	 *
	 * $options is in this format
	 * array([shop_id] => compulsory_value,
	 * 	 [user_id] => compulsory_value,
	 **/
	function prepareCartDataForPaypalExpressCheckout($order_items, $options = array()) {
		
		$defaultOptions = array('user_id' => 0);
		
		$options = array_merge($defaultOptions, $options);
		
		if (!is_array($order_items) OR empty($order_items)) {
			return false;
		}
		
		// initial data
		$data = array('Cart' => array( 'shop_id' => $options['shop_id'],
						'user_id' => $options['user_id'],
						),
			      'CartItem' => array());
		
		$subtotal = 0;
		
		
		
		// loop thru the cart inside Session
		
			
		foreach($order_items as $key=>$item){
			// first check the name
			
			$subtotal = $subtotal + $item['amt'] * $item['qty'];
			// insert into CartItem
			$data['CartItem'][] = array(
				'product_id' => $item['number'],
				'product_price' => $item['amt'],
				'product_quantity' => $item['qty']);
			
			//remove from orderitems
			//unset($order_items[$key]);
			
			
		}
		
		
		$data['Cart']['amount'] = $subtotal;
		
		if ($subtotal > 0 AND !empty($data['CartItem'])) {
			return $data;
		}
		return false;
	}
	
	function makeHash($data) {
		if (!empty($data['Cart'])) {
			// we shall standardize to this method of hashing.
			$shop     = 'shop_' . $data['Cart']['shop_id'];
			$customer = 'user_' . $data['Cart']['user_id'];
			$cart     = 'cart_' . $this->id;
			
			
			$hash = Security::hash($cart.$shop.$customer.time().'step_1', 'sha1', true);
			
			
			return $this->save(array('hash' => $hash));

		}
		
		return false;
	}

	function beforeSave() {
		$id = 0;
		
		if (isset($this->data[$this->alias]['id'])) {
			$id = $this->data[$this->alias]['id'];	
		}
		
		
		if ($id > 0) {
			
			$value = !($this->field('past_checkout_point', array('id'=>$id)));
		
			return $value;
			
		}
		
		return true;
		
	}
	
	function afterSave($created) {
		
		// hashcode created for newly created cart
		if ($created) {
			$this->makeHash($this->data);
		}
		
		
		$this->sqlUpdatePriceWeightCurrencyShippingStats($this->id);
           

	}
	
	function sqlUpdatePriceWeightCurrencyShippingStats($id = false) {
		if (!$id) {
			return false;
		}
		
		$sql = 'UPDATE carts SET amount = (SELECT SUM(product_price*product_quantity) FROM cart_items WHERE cart_id = %1$d),
				total_weight = (SELECT SUM(product_weight*product_quantity) FROM cart_items WHERE cart_id = %1$d),
				currency = (SELECT currency FROM cart_items WHERE cart_id = %1$d LIMIT 1),
				
				shipped_amount = IFNULL((SELECT SUM(product_price*product_quantity)  FROM cart_items WHERE cart_id = %1$d AND shipping_required = 1),0),
				shipped_weight = IFNULL((SELECT SUM(product_weight*product_quantity)  FROM cart_items WHERE cart_id = %1$d AND shipping_required = 1),0)

			WHERE carts.id = %1$d';
		
		App::import('Sanitize');
		$id = Sanitize::escape($id);
		$escapedSql = sprintf($sql, $id);
		
		return $this->query($escapedSql);
	}

	
	function getShippingRequired($id = false) {
		if (!$id) {
			return false;
		}
		$shippingRequired = false;
		$this->CartItem->recursive = -1;
		$items = $this->CartItem->find('all', array('conditions'=>array('CartItem.cart_id'=>$id),
				 			    'fields'=>array('CartItem.shipping_required', 'CartItem.id')));
		
		if (!empty($items)) {
			
			foreach($items['CartItem'] as $item) {
				$shippingRequired = $item['shipping_required'];
				if ($shippingRequired) {
					break;
				}
			}
			
		}
		
		return $shippingRequired;
		
	}
	
	/**
	 * assumption is that the cart items have the cart_item_id as key
	 **/
	private function retrieveImagesOfCartItems($cart = array()) {
		
		$validCart = isset($cart['CartItem']) AND
			     is_array($cart['CartItem']) AND
			     !empty($cart['CartItem']);
			     
		if ($validCart) {
			
			$product_id_set = Set::extract('/CartItem/product_id', $cart);
			
			$images = $this->CartItem->Product->ProductImage->find('all',
				    array('conditions' => array('OR' =>
								array (
									array('ProductImage.cover'=>true),
									array('ProductImage.cover'=>null),
								),
								'AND' => array('ProductImage.product_id' => array_values($product_id_set))
							    ),
				      
				      'fields'=>array('ProductImage.product_id',
						      'ProductImage.id',
						      'ProductImage.filename',
						      'ProductImage.dir'),
				      ));
			
			
			foreach($cart['CartItem'] as $key => $cartItem) {
				foreach($images as $images_key => $image) {
					if ($image['ProductImage']['product_id'] == $cartItem['product_id']) {
						$cart['CartItem'][$key]['ProductImage'] = $image['ProductImage'];
						unset($images[$images_key]);
						break;
					}
					
				}
				$imageIsNull = !isset($cart['CartItem'][$key]['ProductImage']) OR
						!is_array($cart['CartItem'][$key]['ProductImage']);
				
				if ($imageIsNull) {
					$cart['CartItem'][$key]['ProductImage'] = array();
				}
			}
			
		}
		
		return $cart;
		
	}
	
	function getCartItemsCountByCustomerId($user_id = false) {
		if (!$user_id) {
			return false;
		}
		
		$this->Behaviors->attach('Linkable.Linkable');
		
		return $this->CartItem->find('count', array('conditions'=>
						   array('Cart.user_id'=>$user_id,
							 'Cart.past_checkout_point'=>false),
						   'link' => array('Cart'),
						   
						   ));
	}
	
	function getLiveCartByCustomerId($user_id = false, $cartItemIdAsKey = false, $viewCart = false) {
		if (!$user_id) {
			return false;
		}
		
		// get the most updated cart stats since we need to do this for viewCart action 
		if ($viewCart) {
			// need to set this true always if viewCart is true
			$cartItemIdAsKey = true;
			
			// first we get the cart_id
			$cart_id = $this->field('id', array('user_id'=>$user_id,
						 'past_checkout_point'=>false));
			
			if ($cart_id > 0) {
				$this->sqlUpdatePriceWeightCurrencyShippingStats($cart_id);
			} else {
				return false;
			}
		}
		
		$this->Behaviors->attach('Containable');
		
		$cart = $this->find('first', array('conditions'=>
						   array('Cart.user_id'=>$user_id,
							 'Cart.past_checkout_point'=>false),
						   'contain' => array('CartItem'),
						   
						   ));
		
		$placeItemIdAsKeyInArray = isset($cart['CartItem']) AND
					is_array($cart['CartItem']) AND
					!empty($cart['CartItem']) AND
					$cartItemIdAsKey;
					
	
		if ($placeItemIdAsKeyInArray) {
			$cartItems = Set::combine($cart, 'CartItem.{n}.id', 'CartItem.{n}');
			$cart['CartItem'] = $cartItems;
		}
		
		if ($viewCart) {
			$cart = $this->retrieveImagesOfCartItems($cart);
		}
		
		return $cart;
	}
	/**
	 * $productsAndQuantities expect an array with product_id as key and quantity as value
	 * */
	function addProductForCustomer($user_id, $productsAndQuantities = array()) {
		
		if(!$user_id || empty($productsAndQuantities)) {
			return false;
		}
		// first we get shop id
		$shop_id = Shop::get('Shop.id');
		
		// we go get the unprocessed cart of this customer
		$cart = $this->getLiveCartByCustomerId($user_id, true);
		
		$arrayOfProducts = array();
		
		// we go retrieve all the product details to insert into the cart
		foreach($productsAndQuantities as $product_id => $quantity) {
			$product = $this->CartItem->Product->read(array('Product.id',
								'Product.price',
								'Product.currency',
								'Product.shipping_required',
								'Product.weight',
								
								'Product.title'), $product_id);
			
			$product['Product']['quantity'] = $quantity;
			
			// we need to add in quantity so this is an illegal field in Product model
			$arrayOfProducts[] = $product;
		}
		
		$newItems = array('CartItem'=>array());
		// if its a brand new cart
		if (!$cart) {
			// make new cart
			$data = array('Cart' => array('user_id' => $user_id,
						      'shop_id' => $shop_id),
				      'CartItem'=>array(
					));
			
			foreach($arrayOfProducts as $product) {
				$data['CartItem'][] = array('product_id'=>$product['Product']['id'],
					'product_quantity'=>$product['Product']['quantity'],
					'product_price'=>$product['Product']['price'],
					'product_title'=>$product['Product']['title'],
					'currency'=>$product['Product']['currency'],
					'product_weight'=>$product['Product']['weight'],
					
					'shipping_required'=>$product['Product']['shipping_required'],
					);	
			}
			
			
			$this->create();
			$result = $this->saveAll($data);
			
			if($result){
				$this->sqlUpdatePriceWeightCurrencyShippingStats($this->id);
			}
			
			return $result;
			
		} else {
			
			// look for existing item in cart
			foreach($arrayOfProducts as $product) {
				$product_id = $product['Product']['id'];
				$quantity = $product['Product']['quantity'];
				
				$extractStmt = '/CartItem[product_id=' . $product_id . ']';
				$possibleMatches = Set::extract($extractStmt, $cart);
				
				$itemExistsInCart = (!empty($possibleMatches));
				
				if ($itemExistsInCart) {
				
					$possibleItem = $possibleMatches[0];
					$cart_item_id = $possibleItem['CartItem']['id'];
					// we change the quantity, price, currency and title
					$cart['CartItem'][$cart_item_id]['product_quantity'] += $quantity;
					$cart['CartItem'][$cart_item_id]['product_price'] = $product['Product']['price'];
					$cart['CartItem'][$cart_item_id]['product_title'] = $product['Product']['title'];
					$cart['CartItem'][$cart_item_id]['currency'] = $product['Product']['currency'];
				
				} else {
					// we just add product into cart as item
					$newItems['CartItem'][] = array('product_id'=>$product_id,
							      'product_quantity'=>$quantity,
							      'product_price'=>$product['Product']['price'],
							      'product_title'=>$product['Product']['title'],
							      'currency'=>$product['Product']['currency'],
							      'product_weight'=>$product['Product']['weight'],
							      
							      'shipping_required'=>$product['Product']['shipping_required'],
							      // cart_id ensures put item in right cart
							      'cart_id' => $cart['Cart']['id'] 
							);
				}
				
			}
			
			// to update existing items with new quantities
			
			$result = $this->saveAll($cart);
			
			if (!empty($newItems['CartItem'])) {
			
				$result = $result && $this->CartItem->saveAll($newItems['CartItem']);
			
			}
			
			
			$this->sqlUpdatePriceWeightCurrencyShippingStats($cart['Cart']['id']);
			
			
			return $result;
			
			
		}
		
		return false;
		
	}

	function updatePricesInCartAndOrder($id = false, $order_id = false) {
		
		$this->id = $id;	
		
		if (!$this->id OR !$order_id) {
			return false;
		}
		
		// get all items of this cart especially their id, product_id, quantity
		$items = $this->CartItem->find('all',
			    array('conditions' => array(
							'CartItem.cart_id' => $this->id
						    ),
				  'fields' => array('CartItem.id',
						    'CartItem.product_id',
						    'CartItem.product_quantity')
			));
		
		// cause the items is using numerical index,
		$items = Set::combine($items, '{n}.CartItem.id', '{n}');
		$products_key = Set::combine($items, '{n}.CartItem.id', '{n}.CartItem.product_id');
		
		// get live product data based on item list 
		$products = $this->CartItem->Product->find('all',
			    array('conditions' => array(
							'Product.id' => array_values($products_key)
						    ),
			      
			      'fields'=>array('Product.id',
					      'Product.title',
					      'Product.price',
					      'Product.shipping_required',
					      'Product.weight',
					      'Product.currency',
					      
					      ),
			));
		
		// cause the products is using numerical index,
		// we want to do it such that it uses the Product id as key
		$products = Set::combine($products, '{n}.Product.id', '{n}');
		
		$subtotal = 0;
		$totalWeight = 0;
		$shippingWeight = 0;
		$shippingAmount = 0;
		$shippingRequired = false;
		$cartWeightUnit = '';
		$cartCurrency = '';
		
		$data = array('Cart'=>array('id'=>$this->id),
			      'CartItem'=>array());
		
		// loop thru the cart inside Session
		foreach($items as $cart_item_id => $item) {
			$product_id = $item['CartItem']['product_id'];
			$qty = $item['CartItem']['product_quantity'];
			
			// insert the quantity in
			$subtotal = $subtotal + $products[$product_id]['Product']['price'] * $qty;
			
			// insert into CartItem
			$data['CartItem'][] = array('id' => $cart_item_id,
						'product_id' => $product_id,
						'product_price' => $products[$product_id]['Product']['price'],
						'product_quantity' => $qty,
						'product_title' => $products[$product_id]['Product']['title'],
						'product_weight'=> $products[$product_id]['Product']['weight'],
						'currency' => $products[$product_id]['Product']['currency'],
						
						'shipping_required' => $products[$product_id]['Product']['shipping_required'],);
			
			// if shipping_required we totaled the amount
			if ($products[$product_id]['Product']['shipping_required']) {
				$shippingAmount += $products[$product_id]['Product']['price'] * $qty;
				$shippingWeight += $products[$product_id]['Product']['weight'] * $qty;
			}
			
			// insert the weight in
			$totalWeight = $totalWeight + $products[$product_id]['Product']['weight'] * $qty;
			
			// insert the shippingRequired
			$shippingRequired = ($shippingRequired || $products[$product_id]['Product']['shipping_required']);
			
			$cartCurrency = $products[$product_id]['Product']['currency'];
			
		}
		$data['Cart']['total_weight'] = $totalWeight;
		$data['Cart']['shipped_amount'] = $shippingAmount;
		$data['Cart']['amount'] = $subtotal;
		$data['Cart']['shipped_weight'] = $shippingWeight;
		$data['Cart']['shipping_required'] = $shippingRequired;
		
		$data['Cart']['currency'] = $cartCurrency;
		
		if (!empty($data['CartItem'])) {
			
			if ($this->saveAll($data)) {
				
				return $this->Order->updatePrices($order_id, $data);
				
			}
		}
		
	}
	
	function transferCartFromUserToAnother($old_user_id, $new_user_id) {
		$cart = $this->getLiveCartByCustomerId($old_user_id, true);
		
		$productAndQuantities = array();
		
		if (isset($cart['CartItem'])) {
			foreach($cart['CartItem'] as $item) {
				$productAndQuantities[$item['product_id']] = $item['product_quantity'];
			}
			
			return $this->addProductForCustomer($new_user_id, $productAndQuantities);
			
		}
		
		return true;
		
	}

	
	

}
?>