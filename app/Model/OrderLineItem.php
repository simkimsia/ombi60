<?php
class OrderLineItem extends AppModel {

	public $name = 'OrderLineItem';

	public $displayField = 'product_title';

	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'counterCache' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FulfilledOrder' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'counterCache' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'fulfilled_item_count',
			'counterScope' => array('OrderLineItem.fulfillment_id >' => 0) 
		),
		
		'OrderedVariant' => array(
			'className' => 'VariantModel',
			'foreignKey' => 'variant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Fulfillment' => array(
			'className' => 'Fulfillment',
			'foreignKey' => 'fulfillment_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'order_line_item_count'
		)
	);
	

	public $hasOne = array(
		'CoverImage' => array(
			'className' => 'ProductImage',
			'foreignKey' => false,
			'conditions' => array(
				'OrderLineItem.product_id = CoverImage.product_id',
				'CoverImage.cover = 1'
			)

		),

	);
	
	/**
	 * 
	 *	Update all the existing order line items prices and weights
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
				'Order.past_checkout_point'	=>false,
				'OrderLineItem.variant_id'	=>$variant_id
			),
			'fields'=>array(
				'OrderLineItem.id',
			)
		));
		
		$cartItemIdArray 		= Set::extract('{n}.OrderLineItem.id', $items);
		
		return $this->updateAll(
			array(
				'OrderLineItem.product_price' 		=> $newPrice,
				'OrderLineItem.currency' 			=> "'" . $newCurrency . "'",
				'OrderLineItem.product_weight' 		=> $newWeight,
			),
			array(
				'OrderLineItem.variant_id'	=> $variant_id,
				'OrderLineItem.id'			=> $cartItemIdArray
			)
		);
	}
	

}
?>