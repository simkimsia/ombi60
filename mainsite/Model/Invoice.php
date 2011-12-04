<?php
class Invoice extends AppModel {
	public $name = 'Invoice';
	public $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SubscriptionPlan' => array(
			'className' => 'SubscriptionPlan',
			'foreignKey' => 'title',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/* the $id is a necessity
	  * the $data is optional. if it contains ['Invoice']['created']
	  * then no retrieval need be done.
	  **/
	public function updateReference($id = null, $data = array()) {
		if ($id == null) {
			return false;
		}
		
		if (!isset($data['Invoice']['created'])) {
			$data = $this->read(null, $id);
		}
		
		$created = $data['Invoice']['created'];
		
		$array = explode(' ', $created);
		$date = $array[0];
		$time = $array[1];
		
		$timeArray = explode(':', $time);
		$newReference = $date . '-' . $timeArray[0] . $timeArray[1] . '-' . $id;
		
		
		$refData = $this->saveField('reference', $date . '-' . $timeArray[0] . $timeArray[1] . '-' . $id);
		
		if (isset($refData['Invoice'])) {
			// ensure the reference is updated with the new one.
			unset($data['Invoice']['reference']);
			$data['Invoice'] = array_merge($data['Invoice'], $refData['Invoice']);
			
			return $data;
		}
		
		return false;
		
	}
	
	
}
?>