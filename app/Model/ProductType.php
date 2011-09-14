<?php
class ProductType extends AppModel {
	public $name = 'ProductType';
	public $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	public $actsAs = array('Handleize.Sluggable'=> array(
				'fields' => 'title',
				'scope' => array('shop_id'),
				'conditions' => false,
				'slugfield' => 'handle',
				'separator' => '-',
				'overwrite' => false,
				'length' => 150,
				'lower' => true
			),
			    'Handleize.Handleable'=>array(
				'handleFieldName' => 'handle'
							  ));

}
?>