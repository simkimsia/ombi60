<?php
class OrderLineItem extends AppModel {

	var $name = 'OrderLineItem';

	var $displayField = 'product_title';

	var $belongsTo = array(
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