<?php
class Domain extends AppModel {
	
	public $name = 'Domain';

	public $displayField = 'domain';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

	);

	public $validate = array(
			         'title' => array(
					             'isUnique' => array(
                         		                'rule' => 'isUnique',
		                             		    'message' => 'This domain is already used',
					                           ),
							     'notEmpty' => array(
							                    'rule' => 'notEmpty',
							                    'message' => 'Please enter domain name.',
							                   ),
							    )
			        );
	
	public function makeThisPrimary($id = null, $shopId = null) {
		
		if (!$id) {
			if (!$this->id) {
				return false;
			}
			$id = $this->id;
		}
		
		if (!$shopId) {
			$data = $this->read(null, $id);
			$shopId = $data['Domain']['shop_id'];
		}
		
		$result = $this->updateAll(
			// fields to change
			 array('Domain.primary' => true),
			 // conditions
			 array('Domain.id' => $id,
			       'Domain.shop_id' => $shopId)
			 );
		
		if ($result) {
			$result = $this->updateAll(
			// fields to change
			 array('Domain.primary' => intval(false)),
			 // conditions
			 array('Domain.id != ' => $id,
			       'Domain.shop_id' => $shopId)
			 );
			
		}
		
		return $result;
	}
	
	public function getMainDomain() {
		// first we determine the domains
		$productionDomain = (strpos(FULL_BASE_URL, '.com') > 0);
		$stagingDomain = (strpos(FULL_BASE_URL, '.biz') > 0);
		$localhostDomain = (strpos(FULL_BASE_URL, '.localhost') > 0);
		
		// now we set the main domain.
		$mainDomain = '.ombi60.biz';
		if ($productionDomain) {
			$mainDomain = '.ombi60.com';
		} else if ($localhostDomain) {
			$mainDomain = '.ombi60.localhost';
		}
		
		return $mainDomain;
	}
	
	
}
?>
