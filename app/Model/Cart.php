<?php
class Cart extends AppModel {
	public $name = 'Cart';
	
	public $recursive = -1;
	
	public $actsAs    = array('Linkable.Linkable',
			       'Copyable.Copyable' => array(
					'habtm' => false,
					'recursive' => false,)
			       );

	public $belongsTo = array(
		// the reason why we assign Cart to User instead of Customer
		// is because we allow CasualSurfer to also use Cart
		// Customer are defined as people who have checked out at least once.
		// hence Customer hasMany Order
		// but User hasMany Cart
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

	public $hasMany = array(
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
	
	public $validate = array(
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
	
	public function forCustomerOrCasual($check){
		
		
		$count = $this->User->find('count', array('conditions' => array('OR' => array(array('User.group_id' => CUSTOMERS),
										     array('User.group_id' => CASUAL)),
										'AND' => array('id' => $check)
								       )));
		
		return ($count > 0);
		
	}
	
	
	public function oneLiveCartPerCustomer($check){
		
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
	public function prepareCartData($productsInCart, $options = array()) {
		
		$defaultOptions = array('user_id' => 0);
		
		$options = array_merge($defaultOptions, $options);
		
		if (!is_array($productsInCart) OR empty($productsInCart)) {
			return false;
		}
		
		
		
		$products = $this->CartItem->Variant->Product->find('all',
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
	
	public function findByHash($hash, $step = 1) {
		$this->Behaviors->load('Containable');
		
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
	public function prepareCartDataForPaypalExpressCheckout($order_items, $options = array()) {
		
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
	
	public function makeHash($data) {
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

	public function beforeSave() {
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
	
	public function afterSave($created) {
		
		// hashcode created for newly created cart
		if ($created) {
			$this->makeHash($this->data);
			
			
		}
		
		$this->sqlUpdatePriceWeightCurrencyShippingStats($this->id);
		$this->updateLiveCartOnUser();
		
	}
	
	public function updateLiveCartOnUser() {
		// update the users table on the latest live cart id
		$userID 	= User::get('User.id');
		$latestCartID 	= $this->getLiveCartIDByUserID(User::get('User.id'));
		$currentCartID 	= User::get('User.live_cart_id');
		if ($latestCartID != $currentCartID) {
			$this->User->id = $userID;
			$result = $this->User->saveField('live_cart_id', $latestCartID);
			if ($result) User::store($this->User->read(null, $userID ));
		}
	}
	
	public function afterDelete() {
		$this->updateLiveCartOnUser();
	}
	
	public function getLiveCartIDByUserID($userID) {
		$this->recursive = -1;
		$cart = $this->find('first', array('conditions'=>
						   array('Cart.user_id'=>$userID,
							 'Cart.past_checkout_point'=>false),
						   'fields'	=> array('id')
						   ));
		if (!empty($cart['Cart']['id'])) {
			return $cart['Cart']['id'];
		}
		return 0;
	}
	
	public function sqlUpdatePriceWeightCurrencyShippingStats($id = false) {
		if (!$id) {
			return false;
		}
		
		$sql = 'UPDATE carts SET amount = (SELECT SUM(product_price*product_quantity) FROM cart_items WHERE cart_id = %1$d),
				total_weight = (SELECT SUM(product_weight*product_quantity) FROM cart_items WHERE cart_id = %1$d),
				currency = (SELECT currency FROM cart_items WHERE cart_id = %1$d LIMIT 1),
				
				shipped_amount = IFNULL((SELECT SUM(product_price*product_quantity)  FROM cart_items WHERE cart_id = %1$d AND shipping_required = 1),0),
				shipped_weight = IFNULL((SELECT SUM(product_weight*product_quantity)  FROM cart_items WHERE cart_id = %1$d AND shipping_required = 1),0)

			WHERE carts.id = %1$d';
		
		App::uses('Sanitize', 'Utility');
		$id = Sanitize::escape($id);
		$escapedSql = sprintf($sql, $id);
		
		return $this->query($escapedSql);
	}

	
	public function getShippingRequired($id = false) {
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
			
			$images = $this->CartItem->Variant->Product->ProductImage->find('all',
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
	
	public function getCartItemsCountByCustomerId($user_id = false) {
		if (!$user_id) {
			return false;
		}
		
		$this->Behaviors->load('Linkable.Linkable');
		
		return $this->CartItem->find('count', array('conditions'=>
						   array('Cart.user_id'=>$user_id,
							 'Cart.past_checkout_point'=>false,
							 'CartItem.product_quantity >' => 0),
							 
						   'link' => array('Cart'),
						   
						   ));
	}
	
	public function getLiveCartByCustomerId($user_id = false, $variantIdAsKey = false, $viewCart = false) {
		if (!$user_id) {
			return false;
		}
		
		// get the most updated cart stats since we need to do this for viewCart action 
		if ($viewCart) {
			// need to set this true always if viewCart is true
			$variantIdAsKey = true;
			
			// first we get the cart_id
			$cart_id = $this->field('id', array('user_id'=>$user_id,
						 'past_checkout_point'=>false));
			
			if ($cart_id > 0) {
				$this->sqlUpdatePriceWeightCurrencyShippingStats($cart_id);
			} else {
				return false;
			}
		}
		
		$this->Behaviors->load('Containable');
		$this->recursive = -1;
		
		// to be used for the find statement
		$containableArray = array('CartItem'=>array(
						// we want only cart items with at least qty 1
						'conditions'=>array(
							'CartItem.product_quantity >'=>0),
						
						)
					);
		
		// if we want to view the cart, we need to gather a lot of data
		// from Product, ProductImage, Variant, etc
		// due to some weird reason with containable, i need to append the Variant first
		// and do the Product one cart item at a time separately.
		if ($viewCart) {
			$containVariantData = array(
						
					       'AssociatedVariant' => array(
						       'order'=>'AssociatedVariant.order ASC',
						       'VariantOption' => array(
							       'fields' => array('id', 'value', 'field'),
							       'order'  => 'VariantOption.order ASC',
						       )
					       ));
			
			$containableArray['CartItem'] = array_merge($containableArray['CartItem'], $containVariantData);
		}
		
		$cart = $this->find('first', array('conditions'=>
						   array('Cart.user_id'=>$user_id,
							 'Cart.past_checkout_point'=>false),
						   
						   'contain' => $containableArray,
						   
						   ));
		
		
		$emptyCart = empty($cart['CartItem']);
		
		if ($emptyCart) {
			return $cart;
		}
		
	
		if ($viewCart) {
			$productIDs = Set::extract('CartItem.{n}.product_id', $cart);
			$conditionsForProduct = array(
					// Product Data	
					'conditions' => array(
						'Product.visible' =>true,
						'Product.id'  	  =>$productIDs,
					),
					'contain' => array(
						'ProductImage'=>array(
						       'fields' => array('filename'),
						       'order'=>array(
								'ProductImage.cover DESC')
						),
						
						'Variant' => array(
							'order'=>'Variant.order ASC',
							'VariantOption' => array(
								'fields' => array('id', 'value', 'field', 'variant_id'),
								'order'  => 'VariantOption.order ASC',
							)
						),
						
						'ProductsInGroup'=>array(
						       'fields' => array(
								'id',
								'product_id'),
						       
						       'ProductGroup'=>array(
							       'fields' => array(
									'id', 
									'title', 'handle',
									'description', 'visible_product_count',
									'url', 'vendor_count'),
						       )
					       )
				       ),
					'link' => array('Vendor'=>array('fields'=>array('id', 'title'))),
				);
			
			/**
			 * $products is in the form of {n}=>array(Product, ProductImage, ProductsInGroup=>array(ProductGroup))
			 **/
			$products = $this->Shop->Product->find('all', $conditionsForProduct);
			
			$originalIndex = array_keys($cart['CartItem']);
			
			// then we use product_id as the index in $products to facilitate the insertion
			$products = Set::combine($products, '{n}.Product.id', '{n}');
			
			// now we insert the Product data
			foreach($cart['CartItem'] as $id=>$item) {
				$product_id = $item['product_id'];
				if (!empty($products[$product_id])) {
					$cart['CartItem'][$id]['Product'] = $products[$product_id]['Product'];
					$cart['CartItem'][$id]['ProductImage'] = $products[$product_id]['ProductImage'];
					$cart['CartItem'][$id]['ProductsInGroup'] = $products[$product_id]['ProductsInGroup'];
					$cart['CartItem'][$id]['Variant']	= $products[$product_id]['Variant'];
					$cart['CartItem'][$id]['Vendor']	= $products[$product_id]['Vendor'];
				}
			}
			
			// now we put the original index back
			$cartItems = array_values($cart['CartItem']);
			$cart['CartItem'] = array_combine($originalIndex, $cartItems);
		}
		
		$placeItemIdAsKeyInArray = (!empty($cart['CartItem']) AND $variantIdAsKey);
		
		if ($placeItemIdAsKeyInArray) {
			$cartItems = Set::combine($cart, 'CartItem.{n}.variant_id', 'CartItem.{n}');		
			$cart['CartItem'] = $cartItems;
		}
		
		return $cart;
	}
	/**
	 * $productsAndQuantities expect an array with product_id as key and quantity as value
	 * */
	public function addProductForCustomer($user_id, $productsAndQuantities = array()) {
		
		if(!$user_id || empty($productsAndQuantities)) {
			return false;
		}
		// first we get shop id
		$shop_id = Shop::get('Shop.id');
		
		// we go get the unprocessed cart of this customer
		$cart = $this->getLiveCartByCustomerId($user_id, true);
		
		$arrayOfProducts = array();
		
		// we go retrieve all the product details to insert into the cart
		foreach($productsAndQuantities as $variant_id => $quantity) {
			
			$variantModel = $this->CartItem->Variant;
			$variantModel->recursive = -1;
			$variantModel->Behaviors->attach('Linkable.Linkable');
			
			$productVariant = $this->CartItem->Variant->find('first',
						array('conditions'	=>array('Variant.id' => $variant_id),
						      'fields'		=>array('Variant.id',
										'Variant.price',
										'Variant.currency',
										'Variant.shipping_required',
										'Variant.weight',
										'Variant.product_id',
										'Variant.title'),
						      'link'		=> array('Product'   => array('fields'=>array('Product.id', 'Product.title')))
						));
			
			// we need to add in quantity so this is an illegal field in Variant model
			$productVariant['Variant']['quantity'] = $quantity;
			
			$arrayOfProducts[] = $productVariant;
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
				$data['CartItem'][] = array('product_id'=>$product['Variant']['product_id'],
					'variant_id' => $product['Variant']['id'],
					'product_quantity'=>$product['Variant']['quantity'],
					'product_price'=>$product['Variant']['price'],
					'product_title'=>$product['Product']['title'],
					'variant_title'=>$product['Variant']['title'],
					'currency'=>$product['Variant']['currency'],
					'product_weight'=>$product['Variant']['weight'],
					'shipping_required'=>$product['Variant']['shipping_required'],
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
				$product_id = $product['Variant']['id'];
				$quantity = $product['Variant']['quantity'];
				
				$extractStmt = '/CartItem[variant_id=' . $product_id . ']';
				$possibleMatches = Set::extract($extractStmt, $cart);
				
				$itemExistsInCart = (!empty($possibleMatches));
				
				if ($itemExistsInCart) {
				
					$possibleItem = $possibleMatches[0];
					$cart_item_id = $possibleItem['CartItem']['variant_id'];
					
					// we change the quantity, price, currency and title
					$cart['CartItem'][$cart_item_id]['product_quantity'] += $quantity;
					$cart['CartItem'][$cart_item_id]['product_price'] = $product['Variant']['price'];
					$cart['CartItem'][$cart_item_id]['product_title'] = $product['Product']['title'];
					$cart['CartItem'][$cart_item_id]['variant_title'] = $product['Variant']['title'];
					$cart['CartItem'][$cart_item_id]['currency'] = $product['Variant']['currency'];
				
				} else {
					
					// we just add product into cart as item
					$newItems['CartItem'][$product_id] = array('variant_id'=>$product_id,
							      'product_quantity'=>$quantity,
							      'product_price'=>$product['Variant']['price'],
							      'product_title'=>$product['Product']['title'],
							      'variant_title'=>$product['Variant']['title'],
							      'currency'=>$product['Variant']['currency'],
							      'product_weight'=>$product['Variant']['weight'],
							      'product_id' => $product['Variant']['product_id'],
							      
							      'shipping_required'=>$product['Variant']['shipping_required'],
							      // cart_id ensures put item in right cart
							      'cart_id' => $cart['Cart']['id'] 
							);
					
					
				}
				
			}
			
			$cart['CartItem'] = array_merge($cart['CartItem'], $newItems['CartItem']);
			
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

	public function updatePricesInCartAndOrder($id = false, $order_id = false) {
		
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
		$products = $this->CartItem->Variant->Product->find('all',
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
	
	public function transferCartFromUserToAnother($old_user_id, $new_user_id) {
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

	/**
	 * for use in templates for shopfront pages
	 * */
	public function getTemplateVariable($cart) {
		
		$result = array('item_count' => $cart['Cart']['cart_item_count'],
				
				'total_price' => $cart['Cart']['amount'],
				'total_weight' => $cart['Cart']['total_weight'],
				'shipped_weight' => $cart['Cart']['shipped_weight'],
				'shipped_amount' => $cart['Cart']['shipped_amount'],
				'note' => $cart['Cart']['note'],
				'attributes' => json_decode($cart['Cart']['attributes']),
				);
		
		
		$result['items'] = !empty($cart['CartItem']) ? CartItem::getTemplateVariable($cart['CartItem']) : array();
		$result['requires_shipping'] = Cart::checkCartItemForRequiredShipping($result['items']);
		
		
		return $result;
		
	}
	
	/**
	 * Checks if at least 1 Cart Item requires shipping. 
	 *
	 * @param array $cartItems a numerically indexed array of cart items.
	 * @return boolean Returns true if at least 1 such Item. False otherwise.
	 * */
	public function checkCartItemForRequiredShipping($cartItems = array()) {
		
		foreach($cartItems as $item) {
			if (isset($item['requires_shipping']) && $item['requires_shipping'] == true) {
				return true;	
			}
			if (isset($item['shipping_required']) && $item['shipping_required'] == true) {
				return true;	
			}
		}
		
		return false;
		
	}
	
	public function afterFind($results, $primary) {
		if (is_array($results)) {
			
			
			$flag = 0;
			
			foreach ($results as $key => $val) {
				if (isset($val['CartItem'])) {
					foreach($val['CartItem'] as $key => $item) {
						if(isset($item['shipping_required'])) {
							if ($item['shipping_required']) {
								$flag = 1;
								break;	
							}
						}
					}
				}
				
				$results[$key]['Cart']['shipping_required'] = $flag;
				
			}
			
			
		}
		return $results;
	}
	
	/**
	 * we are assuming that this $postData is from $_POST
	 * and that it contains updates (plural) as an array of new quantities
	 *
	 * update the cart quantities by the frontpage Customers/CasualSurfers
	 * because we want to reduce the amount of info that frontpage designs require
	 * we need to retrieve the LiveCart everytime we do a POST or GET for the cart page
	 * and we assume the order of the CartItem is always in terms of CartItem.id
	 * 
	 **/
	public function editQuantities() {
		
		$postData = $_POST;
		
		/**
		 * assume that $_POST['updates'] is not empty
		 * if empty exit this function
		 **/
		$noNeedToUpdate = empty($postData['updates']);
		if ($noNeedToUpdate) return true;
		
		// for verifying purposes
		$userId = User::get('User.id');
		
		// retrieving the cart data again. necessary to avoid overloading the form on cart page
		$cart 	= $this->getLiveCartByCustomerId($userId, true, false);
		
		// retrieving the new quantities in the cart page
		$newQuantities = (!empty($postData['updates'])) ? $postData['updates'] : array();
		
		// we are assuming that the new quantities are meant for the items in the cart in the SAME ORDER
		// if the no. of new quantities is larger than the stored items, we ignore the excess new quantities
		// if the stored items is more than the no., we change what can be changed and carry on.
		
		// if there is actually stored cart items
		if ($cart && !empty($cart['CartItem'])) {
			// if we really do have new quantities to update with
			if (!empty($newQuantities)) {
				// do we REALLY need to update the cart?
				$needToUpdate = false;
				
				foreach($cart['CartItem'] as $variant_id=>$item) {
					
					if (!empty($newQuantities)) {
						
						$newQty = array_shift($newQuantities);
						if ($newQty != $item['product_quantity']) {
							$cart['CartItem'][$variant_id]['product_quantity'] = $newQty;
							$needToUpdate = true; // at least 1 change means YES we need to update
						}
						
					}
				}
				
				if ($needToUpdate) {
					return $this->saveAll($cart);
				}
				// since no need to update might as well assume true
				return true;
				
			}
			
		}
		// since there is no Cart stored in database
		return true;
	}
	
	/**
	 *
	 * @param int $variant_id the id of the variant we want to change quantity
	 * @param int $new_quantity the new quantity must be non-negative
	 **/
	public function changeQuantityFor1Item($variant_id, $new_quantity) {
		// for verifying purposes
		$userId = User::get('User.id');
		
		// retrieving the cart data again. necessary to avoid overloading the form on cart page
		$cart 	= $this->getLiveCartByCustomerId($userId, true, false);
		
		// if there is actually stored cart items
		if ($cart && !empty($cart['CartItem'])) {
			// if we really do have new quantities to update with
			if (is_numeric($variant_id) && is_numeric($new_quantity) && ($new_quantity >= 0)) {
				// do we REALLY need to update the cart?
				$needToUpdate = false;
				
				if (!empty($cart['CartItem'][$variant_id])) {
					if ($new_quantity != $cart['CartItem'][$variant_id]['product_quantity']) {
						$cart['CartItem'][$variant_id]['product_quantity'] = $new_quantity;
						$needToUpdate = true; // at least 1 change means YES we need to update
					}
				}
				
				if ($needToUpdate) {
					return $this->saveAll($cart);
				}
				// since no need to update might as well assume true
				return true;
				
			}
		}
		// if no cart might as well return true
		return true;
	}
	
	
}
?>