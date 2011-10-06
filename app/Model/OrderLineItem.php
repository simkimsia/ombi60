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

		'Variant' => array(
			'className' => 'VariantModel',
			'foreignKey' => 'variant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>