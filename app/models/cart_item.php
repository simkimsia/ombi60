<?php
class CartItem extends AppModel {

	var $name = 'CartItem';
	
	var $displayField = 'product_title';
	
	var $actsAs = array('Visible.Visible',);

	var $belongsTo = array(
		'Cart' => array(
			'className' => 'Cart',
			'foreignKey' => 'cart_id',
			'counterCache' => true,
			'counterScope' => array('CartItem.product_quantity >' => 0), // count only those with quantities > 0
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

		'Variant' => array(
			'className' => 'Variant',
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
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->virtualFields = array(
			'line_price'=>"(`{$this->alias}`.`product_price` * `{$this->alias}`.`product_quantity`)"
		);
	}
	
	function beforeSave() {
		
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
	
	function afterFind($results, $primary) {
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
						if (isset($val1['previous_price'])) {
							$results[$key]['CartItem'][$key1]['previous_price'] = number_format($results[$key]['CartItem'][$key1]['previous_price'], 2);
						}
					}
					
				}
				
			}	
		}
		
		
		return $results;
	}
	
	function refreshCart($data) {
		
		// anticipating
		//Array
		//(
		//        [CartItem] => Array
		//    (
		//        [2] => Array
		//            (
		//                [product_quantity] => 1
		//                [id] => 2
		//            )
		//	  [3] => Array
		//            (
		//                [product_quantity] => 2
		//                [id] => 3
		//            )
		//
		//    )
		//
		//
		//)
		
		if(!isset($data['CartItem'])) {
			return false;
		}
		
		return $this->saveAll($data['CartItem']);

	}
	
	/**
	 * update all the existing cart items prices and weights
	 * */
	function updatePricesAndWeights($variant_id, $newPrice, $newCurrency, $newWeight) {
		
		// first we get all the affected cart_items
		$items = $this->find('all', array('conditions'=>array('Cart.past_checkout_point'=>false,
								      'CartItem.variant_id'=>$variant_id),
						  'fields'=>array('CartItem.id')
					 ));
		
		$cartItemIdArray = Set::extract('{n}.CartItem.id', $items);
		
		return $this->updateAll(array('CartItem.product_price' => $newPrice,
				       'CartItem.currency' => "'" . $newCurrency . "'",
				       'CartItem.product_weight' => $newWeight,
				       ),
				 array('CartItem.variant_id'=>$variant_id,
				       'CartItem.id'=>$cartItemIdArray));
	}
	
	
	/**
	 * to be used in view_cart action in products controller
	 * */
	function prepareCartItemInView($items = array()) {
		
		$resultItems = array();
		foreach($items as $item) {
			$resultItems[] = array('id'=>$item['id'],
					       'cart_id'=>$item['cart_id'],
					       'price'=>$item['product_price'],
					       'quantity'=>$item['product_quantity'],
					       'visible'=>$item['visible'],
					       'title'=>$item['product_title'],
					       'weight'=>$item['product_weight'],
					       'currency'=>$item['currency'],
					       
					       'shipping_required'=>$item['shipping_required'],
					       'previous_price'=>$item['previous_price'],
					       'previous_currency'=>$item['previous_currency'],
					       'product' => array('id'=>$item['product_id'],
								  'cover_image'=>$item['ProductImage']['filename'])
					       );
		}
		
		return $resultItems;
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	function getTemplateVariable($items=array()) {
		
		$results = array();
		
		foreach($items as $key=>$item) {
			$item = (isset($item['CartItem'])) ? $item['CartItem'] : $item;
			$result = array('id' => $item['variant_id'],
					'title' => $item['product_title'],
					'price' => $item['product_price'],
					'line_price' => $item['line_price'],
					'quantity' => $item['product_quantity'],
					'requires_shipping' => $item['shipping_required'],
					'weight' => $item['product_weight'],
					);
			
			
			$result['product'] = !empty($item['Product']) ? Product::getTemplateVariable($item['Product'], false) : array();
			$result['variant'] = !empty($item['Variant']) ? Variant::getTemplateVariable($item['Variant'], false) : array();
			
			$results[] = $result;
		}
		
		return $results;
	}

}
?>