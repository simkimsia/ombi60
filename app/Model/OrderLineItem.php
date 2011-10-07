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

		'OrderedVariant' => array(
			'className' => 'VariantModel',
			'foreignKey' => 'variant_id',
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
				'OrderLineItem.product_id = CoverImage.product_id',
				'CoverImage.cover = 1'
			)

		),
	);

}
?>