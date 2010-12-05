<?php
class Merchant extends AppModel {

	var $name = 'Merchant';

	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

	);

	/**
	 * override the beforeSave method in AppModel
	 * always set the group_id to MERCHANTS and to set ownership of new shop to this newly created merchant
	 *
	 * @param array $options Array of options
	 *
	 * @return boolean True so that the save operation can continue
	 *
	 **/
	function beforeSave($options = array()) {
		if (empty($this->data['Merchant']['id']) AND empty($this->data['Merchant']['owner'])) {
			$this->data['Merchant']['owner'] = true;
		}
		$this->data['User']['group_id'] = MERCHANTS;
		return true;

	}

	function signupNewAccount($data = NULL) {
		$data['User']['group_id'] = MERCHANTS;
		// now to create the domain entry

		$result = $this->saveAll($data, array('validate'=>'first'));

		if ($result) {
			return $this->afterSignUpNewAccount($data);
			
		}
		
		return $result;

	}

	function updateProfile($data = NULL) {
		$data['User']['group_id'] = MERCHANTS;
		return $this->saveAll($data, array('validate'=>'first'));
	}
	
	private function afterSignupNewAccount($data) {
		// we need to create domain entries
		$domain = $this->Shop->Domain;

		$domainData = array();

		$domainData['Domain']['domain']  = $data['Shop']['web_address'];
		$domainData['Domain']['primary'] = true;
		$domainData['Domain']['shop_id'] = $this->Shop->id;
		$domain->create();
		$domain->save($domainData);
		
		// we need to create invoice entries
		$invoice = $this->Shop->Invoice;

		$invoiceData = array();

		$invoiceData['Invoice']['title']  = $data['Invoice']['title'];
		$invoiceData['Invoice']['description'] = $data['Invoice']['description'];
		$invoiceData['Invoice']['shop_id'] = $this->Shop->id;
		$invoice->create();
		$invoiceData = $invoice->save($invoiceData);
		
		
		
		// now we create the dummy default product for this shop.
		$this->Shop->Product->duplicate(DEFAULT_PRODUCT_ID, $this->Shop->id);
		
		// now we need to populate the shops_payment_modules with available payment modules
		$paymentModule = $this->Shop->ShopsPaymentModule->PaymentModule;
		$paymentModule->recursive = -1;
		$paymentModules = $paymentModule->find('all', array('fields'=>'id'));
		$result = Set::extract('/PaymentModule/id', $paymentModules);
		$data = array('ShopsPaymentModule'=>array());
		
		foreach($result as $key => $value) {
			$data['ShopsPaymentModule'][$key]['shop_id'] = $this->Shop->id;
			$data['ShopsPaymentModule'][$key]['payment_module_id'] = $value;
		}
		
		$this->Shop->ShopsPaymentModule->saveAll($data['ShopsPaymentModule']);
		
		if ($invoice->id > 0) {
			$invoiceData['Invoice']['id'] = $invoice->id;
			return $invoiceData;	
		}
		return false;
	
	}
	
	function retrieveShopUserLanguageByUserId($id = false) {
		if (!$id) {
			return false;
		}
		
		$this->Behaviors->attach('Linkable.Linkable');
		$this->User->Behaviors->attach('Linkable.Linkable');
		
		return $this->find('first', array('conditions'=>array('Merchant.user_id'=>$id),
					   'link'=>array('Shop', 'User'=>array('Language'))));
	}

}
?>
