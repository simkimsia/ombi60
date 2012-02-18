<?php
App::uses('AppModel', 'Model');
/**
 * Fulfillment Model
 *
 * @property Order $Order
 * @property OrderLineItem $OrderLineItem
 */
class Fulfillment extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'OrderLineItem' => array(
			'className' => 'OrderLineItem',
			'foreignKey' => 'order_line_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
