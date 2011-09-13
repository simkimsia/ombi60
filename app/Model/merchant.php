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


	
	
	

	function updateProfile($data = NULL) {
		$data['User']['group_id'] = MERCHANTS;
		return $this->saveAll($data, array('validate'=>'first'));
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

/** sign up account code more meant for mainsite **/



}
?>
