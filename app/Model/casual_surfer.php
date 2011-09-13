<?php
class CasualSurfer extends AppModel {
	var $name = 'CasualSurfer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeSave($options = array()) {
		
		$this->data['User']['group_id'] = CASUAL;
		return true;

	}
	
	function convertCartForCustomerLogin($currentIdInCookie, $loggedInUserId) {
		
		$exists = $this->find('count', array('conditions'=>array('CasualSurfer.user_id'=>$currentIdInCookie)));
		
		if ($exists AND $loggedInUserId > 0) {
			
			$cartOfUnloggedIn = $this->User->Cart->getLiveCartByCustomerId($currentIdInCookie, true);
			
			$cartOfUnloggedInExists = isset($cartOfUnloggedIn['Cart']) AND is_array($cartOfUnloggedIn['Cart']) AND
						  isset($cartOfUnloggedIn['CartItem']) AND is_array($cartOfUnloggedIn['CartItem']);
									
			if ($cartOfUnloggedInExists) {
				
				$productsAndQuantities = Set::combine($cartOfUnloggedIn, 'CartItem.{n}.product_id',  'CartItem.{n}.product_quantity');
				return $this->User->Cart->addProductForCustomer($loggedInUserId, $productsAndQuantities);
				
			}
			
		}
		
		return false;
	}
	
	function createNew($randomEmail, $randomPassword) {
		$this->create();
		$this->User->create();
		
		$shopId = Shop::get('Shop.id');
		
		$data = array('CasualSurfer'=>array('shop_id'=>$shopId),
			      'User'=>array('group_id'=>CASUAL,
					    'email'=> $randomEmail,
					    'full_name'=>'casual',
					    'name_to_call'=>'casual',
					    'password'=>$randomPassword));
		
		$result = $this->saveAll($data, array('validate'=>'first'));

		if ($result) {		
			return $this->User->id;
		}
		return $result;

	}
}
?>