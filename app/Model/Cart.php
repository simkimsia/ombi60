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
				'message' => 'Only registered customers or guests are allowed to have carts',
				
			)
		),
		
	);
	
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->virtualFields['shipping_required'] = sprintf('(%s.shipped_weight > 0)', $this->alias, $this->alias);
	}
	
	
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
			$existingLiveCart = $this->getLiveCartByUserId($this->data['Cart']['user_id']);
			
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
		$this->recalculateTotalWeightPrice($this->id);
		$this->updateLiveCartOnUser();
		
	}
	
	public function updateLiveCartOnUser() {
		// update the users table on the latest live cart id
		$userID 		= User::get('User.id');
		$latestCartID 	= $this->getLiveCartIDByUserID($userID);
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
	
	/**
	*
	* Read all the CartItem and recalculate Total weight, price, etc
	*
	* @param string $id Cart id
	* @return boolean Returns true if successful. False otherwise.
	**/
	public function recalculateTotalWeightPrice($id) {
		if (!$id) {
			return false;
		}
		
		$sql = '
			UPDATE carts
			SET amount = (SELECT SUM(product_price*product_quantity) FROM cart_items WHERE cart_id = :id AND product_quantity >= 1),
				total_weight = (SELECT SUM(product_weight*product_quantity) FROM cart_items WHERE cart_id = :id AND product_quantity >= 1),
				currency = (SELECT currency FROM cart_items WHERE cart_id = :id LIMIT 1),
				shipped_amount = IFNULL((SELECT SUM(product_price*product_quantity)  FROM cart_items WHERE cart_id = :id AND shipping_required = 1 AND product_quantity >= 1),0),
				shipped_weight = IFNULL((SELECT SUM(product_weight*product_quantity)  FROM cart_items WHERE cart_id = :id AND shipping_required = 1 AND product_quantity >= 1),0)
			WHERE carts.id = :id';
		
		$result = $this->getDataSource()->fetchAll($sql, array('id' => $id));
		
		// for some weird reason this returns empty array in phpunit tests
		if ($result === true || $result === array()) {
			return true;
		}
		return false;
	}

			
	/**
	*
	* Get Live Cart data to be displayed in cart template.
	*
	* @param integer $user_id User id
	* @return array Return array
	**/
	public function getLiveCartForCartTemplate($user_id = false) {
		// 1st retrieve main Cart, CartItem and CheckedOutVariant model data
		$minimumProductQuantityOf1 = 1;
		$cart = $this->getLiveCartWithVariantByUserId($user_id, $minimumProductQuantityOf1);
		
		// 2nd if empty we return empty cart now!
		if (empty($cart['CartItem'])) return $cart;
		
		// 3rd if not empty, we attach Product data to CartItem
		$cart = $this->CartItem->attachProductData($cart);
		
		// 4th set variant_id as key for CartItem array
		$cart = $this->CartItem->setVariantIdAsKey($cart);
		
		return $cart;
	}
	
	
	/**
	* 
	* Get Live Cart data associated with User. Cart data includes CartItem. Alias for getLiveCartByUserId($user_id, $quantity, TRUE)
	*
	* @param integer $user_id User id
	* @param integer $productQuantityAtLeast. Cart Items to be retrieved need to have at least this quantity . Default 0. 
	* @return array Array of Cart, CartItem, CheckedOutVariant, VariantOption data.
	**/
	public function getLiveCartWithVariantByUserId($user_id = false, $productQuantityAtLeast = 0) {
		return $this->getLiveCartByUserId($user_id, $productQuantityAtLeast, true);
	}
	
	/**
	* 
	* Get Live Cart data associated with User. Cart data includes CartItem. 
	*
	* @param integer $user_id User id
	* @param integer $productQuantityAtLeast. Cart Items to be retrieved need to have at least this quantity . Default 0. 
	* @param boolean $includeCheckedOutVariant. Include CheckedOutVariant data Default is true.
	* @return array Array of Cart, CartItem data. May include CheckedOutVariant models data.
	**/
	public function getLiveCartByUserId($user_id = false, $productQuantityAtLeast = 0, $includeCheckedOutVariant = false) {
		if (!$user_id) {
			return false;
		}
		
		// 1st we get the cart_id
		$cart_id = $this->field('id', array('user_id'=>$user_id,
					 'past_checkout_point'=>false));
		
		// 2nd recalculate weight, price stats for Cart assuming CartItems updated
		if (!empty($cart_id)) {
			$this->recalculateTotalWeightPrice($cart_id);
		} else {
			return false;
		}
		
		// 3rd set up the minimum product quantity amount for Cart Item
		$conditionsForCartItem = array('CartItem.product_quantity >='=> $productQuantityAtLeast);
		
		$containableArray = array(
			'CartItem'=>array(
				'conditions'=>$conditionsForCartItem,
			)
		);
		
		// 4th if we need to include CheckedOutVariant
		if ($includeCheckedOutVariant) {
			$containVariantData = array(
						
					       'CheckedOutVariant' => array(
						       'order'=>'CheckedOutVariant.order ASC',
						       'VariantOption' => array(
							       'fields' => array('id', 'value', 'field'),
							       'order'  => 'VariantOption.order ASC',
						       )
					       ));
			
			$containableArray['CartItem'] = array_merge($containableArray['CartItem'], $containVariantData);
		}
		
		// 5th run the find operation
		$cart = $this->find('first', array(
			'conditions' => array(
				'Cart.user_id'				=> $user_id,
				'Cart.past_checkout_point'	=> false
			),
			'contain' => $containableArray,
		));
		
		return $cart;
	}
	
	
	/**
	 * 
	 * Add Product to Cart of said Customer via user_id
	 *
	 * @param integer $user_id User id
	 * @param array $productsAndQuantities Data array with variant_id as key and quantity as value
	 * @param boolean $increment True if we want to add onto existing quantity. False if we want to set the quantity.
	 * @return boolean Return true if successful. False otherwise.
	 * */
	public function addProductForCustomer($user_id = false, $productsAndQuantities = array(), $increment = true) {
		if (!$user_id) {
			$user_id = User::get('User.id');
		}
		
		if(empty($productsAndQuantities)) {
			return false;
		}
		// first we get shop id
		$shop_id = Shop::get('Shop.id');
		
		// we go get the unprocessed cart of this customer
		$cart = $this->getLiveCartByUserId($user_id);
		// we set the variant ids as keys for CartItem array
		$cart = $this->CartItem->setVariantIdAsKey($cart);
		
		$arrayOfProducts = array();
		
		// we go retrieve all the product details to insert into the cart
		foreach($productsAndQuantities as $variant_id => $quantity) {
			
			$variantModel = $this->CartItem->CheckedOutVariant;
			$variantModel->recursive = -1;
			$variantModel->Behaviors->load('Linkable.Linkable');
			
			$checkedOutVariant = $this->CartItem->CheckedOutVariant->find('first',
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
			$checkedOutVariant['Variant']['quantity'] = $quantity;
			$arrayOfProducts[] = $checkedOutVariant;
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
				$this->recalculateTotalWeightPrice($this->id);
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
					if ($increment) {
						$cart['CartItem'][$cart_item_id]['product_quantity'] += $quantity;
					} else {
						$cart['CartItem'][$cart_item_id]['product_quantity'] = $quantity;
					}

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
			
			$this->recalculateTotalWeightPrice($cart['Cart']['id']);
			
			return $result;
			
		}
		
		return false;
		
	}
	
	
	public function transferCartFromUserToAnother($old_user_id, $new_user_id) {
		$cart = $this->getLiveCartByUserId($old_user_id);
		// we set the variant ids as keys for CartItem array
		$cart = $this->CartItem->setVariantIdAsKey($cart);
		
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
	*
	* Close the cart
	*
	* @param string $cartId Cart id
	* @return array Returns array of saved data if successful. False otherwise.
	**/
	public function close($cartId) {
		$this->id = $cartId;

		// we use save and not saveField because saveField is not idempotent
		$result = $this->save(array(
			'past_checkout_point'=>true
		));
	
		return $result;
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
		$cart 	= $this->getLiveCartByUserId($userId);
		// we set the variant ids as keys for CartItem array
		$cart = $this->CartItem->setVariantIdAsKey($cart);
		
		// retrieving the new quantities in the cart page
		$newQuantities = (!empty($postData['updates'])) ? $postData['updates'] : array();
		
		// we are assuming that the new quantities are meant for the items in the cart in the SAME ORDER
		// if the no. of new quantities is larger than the stored items, we ignore the excess new quantities
		// if the stored items is more than the no., we change what can be changed and carry on.
		
		// if there is actually stored cart items
		if ($cart && !empty($cart['CartItem'])) {
			// if we really do have new quantities to update with
			if (!empty($newQuantities)) {
				
				$productsAndQuantities = array();
				
				foreach($cart['CartItem'] as $variant_id=>$item) {
					
					if (!empty($newQuantities)) {
						$newQty = array_shift($newQuantities);
					} else {
						$newQty = $item['product_quantity'];
					}
					
					$productsAndQuantities = array($variant_id=>$newQty);						
					
				}
				
				return $this->addProductForCustomer($userId, $productsAndQuantities, false);
				
				// since no need to update might as well assume true
				return true;
				
			}
			
		}
		// since there is no Cart stored in database
		return true;
	}
	
	/**
	 *
	 * Alias for addProductForCustomer($user_id, $productsAndQuantities, false)
	 * @param int $variant_id the id of the variant we want to change quantity
	 * @param int $new_quantity the new quantity must be non-negative
	 **/
	public function changeQuantityFor1Item($variant_id, $new_quantity) {

		return $this->addProductForCustomer(null, array($variant_id=>$new_quantity), false);

	}
	
	/**
	* 
	* Retrieve Cart data with CartItem data and CoverImage data.
	* Format of array is
	* array(
	* 	'Cart' => array('id'=>'4864-1234-1234-1111'...),
	*	'CartItem' => array(
	*		'0' => array(
	*			'id' => '1'
	*			'cart_id' => '4864-1234-1234-1111',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*		'1' => array(
	*			'id' => '2'
	*			'cart_id' => '4864-1234-1234-1111',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*	)
	* )
	*
	* @param string $cart_uuid Cart id
	* @return array Returns Cart data with CartItem data and CoverImage data
	**/
	public function getItemsWithImages($cart_uuid) {
		
		$this->CartItem->unbindModel(array(
			'belongsTo' => array(
				'Product',
				'CheckedOutVariant',
			)
		));
		
		$this->CartItem->recursive = 0;
		// We need to do this convoluted way because we had difficulty retrieving
		// the correct CoverImage when we do a $this->find('first', array(
		//	 'contain' => array('CartItem' => 'CoverImage')
		//	))
		$items = $this->CartItem->find('all', array(
			'conditions' => array(
				'CartItem.cart_id' => $cart_uuid,
				'CartItem.product_quantity >' => 0,
			),
			'link' => array('Cart', 'CoverImage')
		));

		$cartData 	= Set::extract('0.Cart', $items);
		$itemsData 	= array();
		foreach($items as $key=>$item) {
			$item['CartItem']['CoverImage'] = $item['CoverImage'];
			$itemsData[]					= $item['CartItem'];					
		}
		
		$currentCart = array(
			'Cart' => $cartData,
			'CartItem' => $itemsData
		);

		return $currentCart;
	}
	
	
}
?>