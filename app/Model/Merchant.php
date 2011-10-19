<?php
class Merchant extends AppModel {

	public $name = 'Merchant';
	
	

	public $belongsTo = array(
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
	public function beforeSave($options = array()) {
		if (empty($this->data['Merchant']['id']) AND empty($this->data['Merchant']['owner'])) {
			$this->data['Merchant']['owner'] = true;
		}
		$this->data['User']['group_id'] = MERCHANTS;
		return true;

	}

	
	/**
	*
	* Update merchant's profile
	*
	* @param array $data Data array containing User and Shop model data
	* @return boolean Returns true if successful. False otherwise
	**/
	public function updateProfile($data = NULL) {
		$data['User']['group_id'] = MERCHANTS;
		return $this->saveAll($data, array('validate'=>'first'));
	}
	
	/**
	*
	* Retrieve Shop, User, Language model data based on User id
	*
	* @param integer $id User id
	* @return array Returns data array if successful. False otherwise
	**/	
	public function retrieveShopUserLanguageByUserId($id = false) {
		if (!$id) {
			return false;
		}
				
		$this->Behaviors->load('Linkable.Linkable');
		$result = $this->find('first', array(
			'conditions'=>array(
				'Merchant.user_id'=>$id
			),
			'link' => array(
				'User' => array(
					'Language'
				),
				'Shop'
			)
		
		));
		
		return $result;

	}

/** sign up account code more meant for mainsite **/
}
?>
