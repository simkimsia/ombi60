<?php
class CasualSurfer extends AppModel {
	public $name = 'CasualSurfer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
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
	
	public function beforeSave($options = array()) {
		
		$this->data['User']['group_id'] = CASUAL;
		return true;

	}
	
	/**
	*
	* this method may be deprecated or refactored
	*
	**/
	public function convertCartForCustomerLogin($currentIdInCookie, $loggedInUserId) {
		
		$exists = $this->find('count', array('conditions'=>array('CasualSurfer.user_id'=>$currentIdInCookie)));
		
		if ($exists AND $loggedInUserId > 0) {
			
			$cartOfUnloggedIn = $this->User->Cart->getLiveCartByUserId($currentIdInCookie, true);
			
			$cartOfUnloggedInExists = isset($cartOfUnloggedIn['Cart']) AND is_array($cartOfUnloggedIn['Cart']) AND
						  isset($cartOfUnloggedIn['CartItem']) AND is_array($cartOfUnloggedIn['CartItem']);
									
			if ($cartOfUnloggedInExists) {
				
				$productsAndQuantities = Set::combine($cartOfUnloggedIn, 'CartItem.{n}.product_id',  'CartItem.{n}.product_quantity');
				return $this->User->Cart->addProductForCustomer($loggedInUserId, $productsAndQuantities);
				
			}
			
		}
		
		return false;
	}
	
	/**
	*
	* we will create a brand new User and CasualSurfer given a randomized email and password hash
	*
	* @param string $randomEmail Email of would be User
	* @param string $randomPassword Password hash of would be User
	* @return integer Returns User id if successful, false otherwise.
	**/
	public function createNew($randomEmail, $randomPassword) {
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