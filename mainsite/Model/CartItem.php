<?php
class CartItem extends AppModel {

	public $name = 'CartItem';
	
	public $displayField = 'product_title';
	
	public $actsAs = array('Visible.Visible',);
	
	public $validate = array(
		'cart_id' => array(
			'rule' 	=> 'uniqueCombi', 
			'on'	=> 'create'),
		'variant_id'  => array(
			'rule' 	=> 'uniqueCombi',
			'on'	=> 'create')
	);

	/**
	 * Custom validation rule for checking uniqueness of composite key for cart_id and variant_id in CartItem
	 * 
	 * @param void
	 * @return boolean Returns true if cart_id and variant_id in $this->data['CartItem'] is indeed unique
	**/
	public function uniqueCombi() {
		
		if (isset($this->data[$this->alias]['cart_id'])) {
			
			$combi = array(
				"{$this->alias}.cart_id" => $this->data[$this->alias]['cart_id'],
				"{$this->alias}.variant_id"  => $this->data[$this->alias]['variant_id']
			);
			
			return $this->isUnique($combi, false);			
		}
		
		return true;
	}

	public $belongsTo = array(
		'Cart' => array(
			'className' => 'Cart',
			'foreignKey' => 'cart_id',
			'counterCache' => true,
			'counterScope' => array('CartItem.product_quantity >' => 0), // count only those with quantities > 0
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		// this is the Variant selected for purchase
		// we need to give a different alias so that when we do a view cart
		// we will be able to select this AND the other variants of the product
		'CheckedOutVariant' => array(
			'className' => 'VariantModel',
			'foreignKey' => 'variant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
	
	public $hasOne = array(
		'CoverImage' => array(
			'className' => 'ProductImage',
			'foreignKey' => false,
			'conditions' => array(
				'CartItem.product_id = CoverImage.product_id',
				'CoverImage.cover = 1'
			)
		
		),
		
	);
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->virtualFields = array(
			'line_price'=>"(`{$this->alias}`.`product_price` * `{$this->alias}`.`product_quantity`)"
		);
	}
	
	public function beforeSave() {
		
		// placeholder for current data
		$data = $this->data;
		
		// if existing cart item, we need to check for updated prices and move the old prices to fields
		// previous_price and previous_currency		
		if(isset($this->data['CartItem']['id'])) {
			
			// get previous prices
			$previousPrices = $this->read(array('product_price',
							    'currency',
							    'previous_price',
							    'previous_currency'),$this->data['CartItem']['id']);
			
			//$this->log($data);
			//
			//$currentPrice = number_format($data['CartItem']['product_price'], 4);
			//$currentCurrency = $data['CartItem']['currency'];
			//$previousPrice = number_format($previousPrices['CartItem']['previous_price'], 4);
			//$previousCurrency = $previousPrices['CartItem']['previous_currency'];
			
			// are they different?
			//if (($currentPrice != $previousPrice) OR
			//    ($currentCurrency != $previousCurrency)) {
			//	
			//	// then we populate the previous_price, previous_currency fields
			//	$data['CartItem']['previous_price'] = $previousPrices['CartItem']['product_price'];
			//	$data['CartItem']['previous_currency'] = $previousPrices['CartItem']['currency'];
			//	
			//}
			
		} else {
			// newly created item hence previous prices same as current prices
			// then we populate the previous_price, previous_currency fields
			$data['CartItem']['previous_price'] = $data['CartItem']['product_price'];
			$data['CartItem']['previous_currency'] = $data['CartItem']['currency'];
		}
		
		$this->data = $data;
		
		
		return true;
	}
	
	public function afterFind($results, $primary) {
		if (is_array($results)) {
			
			
			foreach ($results as $key => $val) {
				if (isset($val['CartItem']['product_price'])) {
					$results[$key]['CartItem']['product_price'] = number_format($results[$key]['CartItem']['product_price'], 2);
				} else if (isset($val['CartItem'])){
					foreach ($val['CartItem'] as $key1=>$val1) {
						if (isset($val1['product_price'])) {
							$results[$key]['CartItem'][$key1]['product_price'] = number_format($results[$key]['CartItem'][$key1]['product_price'], 2);
						}
					}
					
				}
				
				if (isset($val['CartItem']['previous_price'])) {
					$results[$key]['CartItem']['previous_price'] = number_format($results[$key]['CartItem']['previous_price'], 2);
				} else if (isset($val['CartItem'])) {
					foreach ($val['CartItem'] as $key1=>$val1) {
						if (isset($val1['previous_price']) && is_numeric($val1['previous_price'])) {
							$results[$key]['CartItem'][$key1]['previous_price'] = number_format($results[$key]['CartItem'][$key1]['previous_price'], 2);
						}
					}
					
				}
				
			}	
		}
		
		
		return $results;
	}
	
	/**
	 * 
	 *	Update all the existing cart items prices and weights
	 *
	 * @param integer $variant_id Variant id
	 * @param float  $newPrice New Price for the said Variant
	 * @param string $newCurrency New Currency for the said Variant
	 * @param float $newWeight New weight for the said Variant
	 * @return boolean Returns true if successful. False otherwise
	 * */
	public function updatePricesAndWeights($variant_id, $newPrice, $newCurrency, $newWeight) {
		
		// first we get all the affected cart_items
		$items = $this->find('all', array(
			'conditions'=>array(
				'Cart.past_checkout_point'	=>false,
				'CartItem.variant_id'		=>$variant_id
			),
			'fields'=>array(
				'CartItem.id',
				'CartItem.product_price',
				'CartItem.currency'
			)
		));
		
		$cartItemIdArray 		= Set::extract('{n}.CartItem.id', $items);
		$previousPriceArray 	= Set::extract('/CartItem/product_price[:first]', $items);
		$previousCurrencyArray 	= Set::extract('/CartItem/currency[:first]', $items);


		$previousPrice = $newPrice;
		if (isset($previousPriceArray[0]) && is_numeric($previousPriceArray[0])) {
			$previousPrice = $previousPriceArray[0];
		}
		
		$previousCurrency = $newCurrency;
		if (isset($previousCurrencyArray[0]) && is_string($previousCurrencyArray[0])) {
			$previousCurrency = $previousCurrencyArray[0];
		}
		
		return $this->updateAll(
			array(
				'CartItem.product_price' 		=> $newPrice,
				'CartItem.currency' 			=> "'" . $newCurrency . "'",
				'CartItem.product_weight' 		=> $newWeight,
				'CartItem.previous_price' 		=> $previousPrice,
				'CartItem.previous_currency' 	=> "'" . $previousCurrency . "'",
			),
			array(
				'CartItem.variant_id'	=> $variant_id,
				'CartItem.id'			=> $cartItemIdArray
			)
		);
	}
	
	/**
	*
	* Extract variant_id as key for CartItem array
	* 
	*
	* @param array $data Data array containing CartItem => array('0' => array(...), '1' => array(...))
	* @return array Return data array
	**/
	public function setVariantIdAsKey($data) {
		
		if (isset($data['CartItem'])) {
			$cartItems = Set::combine($data, 'CartItem.{n}.variant_id', 'CartItem.{n}');
			if (!empty($cartItems)) {
				$data['CartItem'] = $cartItems;
			}
		}
		
		return $data;
	}
	
	/**
	*
	* Get All Products related data and attach to CartItem
	*
	* @param array $data Data array containing CartItem => array('0' => array(..), '1' => array(..)) 
	* @return array Return data array
	**/
	public function attachProductData($data) {
		
		if (isset($data['CartItem'])) {
			
			$productIDs = Set::extract('CartItem.{n}.product_id', $data);
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
			$products = $this->Product->find('all', $conditionsForProduct);
			
			$originalIndex = array_keys($data['CartItem']);
			
			// then we use product_id as the index in $products to facilitate the insertion
			$products = Set::combine($products, '{n}.Product.id', '{n}');
			
			// now we insert the Product data
			foreach($data['CartItem'] as $id=>$item) {
				$product_id = $item['product_id'];
				if (!empty($products[$product_id])) {
					$data['CartItem'][$id]['Product'] = $products[$product_id]['Product'];
					$data['CartItem'][$id]['ProductImage'] = $products[$product_id]['ProductImage'];
					$data['CartItem'][$id]['ProductsInGroup'] = $products[$product_id]['ProductsInGroup'];
					$data['CartItem'][$id]['Variant']	= $products[$product_id]['Variant'];
					$data['CartItem'][$id]['Vendor']	= $products[$product_id]['Vendor'];
				}
			}
			
			// now we put the original index back
			$cartItems = array_values($data['CartItem']);
			$data['CartItem'] = array_combine($originalIndex, $cartItems);

		}
		
		return $data;
	}
	
	
	/**
	 * for use in templates for shopfront pages
	 * */
	public function getTemplateVariable($items=array()) {
		
		$results = array();
		
		foreach($items as $key=>$item) {
			$item = (isset($item['CartItem'])) ? $item['CartItem'] : $item;
			$result = array('id' => $item['variant_id'],
					
					'price' => $item['product_price'],
					'line_price' => $item['line_price'],
					'quantity' => $item['product_quantity'],
					'requires_shipping' => $item['shipping_required'],
					'weight' => $item['product_weight'],
					);
			
			
			$result['product'] = !empty($item['Product']) ? Product::getTemplateVariable($item, false) : array();
			$result['variant'] = !empty($item['CheckedOutVariant']) ? VariantModel::getTemplateVariable($item['CheckedOutVariant'], false) : array();
			
			// we get the latest product and variant title where possible
			// we also collect the sku from variant
			// collect vendor from product
			if (!empty($result['product'])) {
				$productTitle = $result['product']['title'] ;
				$vendor = $result['product']['vendor'] ;
			} else {
				$productTitle = $item['product_title'];
				$vendor = '';
			}
			
			if (!empty($result['variant'])) {
				$variantTitle = $result['variant']['title'] ;
				$variantSKU = $result['variant']['sku'] ;
			} else {
				$variantTitle = $item['variant_title'];
				$variantSKU = '';
			}
			
			
			/**
			 * for the cart item title, if there is  1 variant for the product
			 * and the variant title starts with "default" case-insensitive
			 * we just use ProductTitle
			 **/
			App::uses('StringLib', 'UtilityLib.Lib');
			if (count($result['product']['variants']) == 1) {
				if (StringLib::startsWith($variantTitle, 'default', false)) {
					$result['title'] = $productTitle;
				}
			}
			// In all other cases, we use ProductTitle - VariantTitle
			if (!isset($result['title'])) {
				$result['title'] = $productTitle . ' - ' . $variantTitle;
			}
			
			// assign the sku
			$result['sku'] = $variantSKU;
			$result['vendor'] = $vendor;
			
			
			$results[] = $result;
		}
		
		return $results;
	}

}
?>