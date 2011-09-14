<?php
class PaypalPayer extends AppModel {
	public $name = 'PaypalPayer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $hasMany = array(
		'PaypalPayersPayment' => array(
			'className' => 'PaypalPayersPayment',
			'foreignKey' => 'paypal_payer_id',
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
	
	public function saveAfterGECD($GECDFields) {
		// the Gecdfields
		//$this->log('the gecd fields');
		//$this->log($GECDFields);
		
		$payer = $this->findByPayerid($GECDFields['PAYERID']);
		
		$data = array();
		
		// the data to be saved regardless of new or edit
		$data['PaypalPayer']['payerid'] = isset($GECDFields['PAYERID']) ? $GECDFields['PAYERID'] : '';
		$data['PaypalPayer']['email'] = isset($GECDFields['EMAIL']) ? $GECDFields['EMAIL'] : '';
		$data['PaypalPayer']['payerstatus'] = isset($GECDFields['PAYERSTATUS']) ? $GECDFields['PAYERSTATUS'] : '';
		$data['PaypalPayer']['countrycode'] = isset($GECDFields['COUNTRYCODE']) ? $GECDFields['COUNTRYCODE'] : '';
		$data['PaypalPayer']['business'] = isset($GECDFields['BUSINESS']) ? $GECDFields['BUSINESS'] : '';
		
		// edit old data
		if ($payer) {
			
			$data['PaypalPayer']['id'] = $payer['PaypalPayer']['id'];
			
			$this->id = $payer['PaypalPayer']['id'];
			return $this->save($payer);
			
		// new data
		} else {
			
			$this->create();
			$result = $this->save($data);
			
			$result['PaypalPayer']['id'] = $this->id;
			return $result;
		}
	}

}
?>