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
	);
	
	public $hasMany = array(
		'OrderLineItem' => array(
			'className' => 'OrderLineItem',
			'foreignKey' => 'fulfillment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	* clean out the non-selected items
	**/
	public function fulfillItems($requestData) {
		
		// we need to remove all the zeros from the checkboxes
		$item_ids = Set::extract('/OrderLineItem[id>0]/id', $requestData);
		
		if (!empty($item_ids)) {
			$requestData['OrderLineItem'] = array();
			foreach($item_ids as $item_id) {
				$requestData['OrderLineItem'][] = array('id' => $item_id);
			}
			return $this->saveAssociated($requestData);
		}
		
		return true;

	}
}
