<?php
class Shop extends AppModel {

	var $name = 'Shop';

	var $validate = array(
		'primary_domain' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This web address is already used. Please choose another.'
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Your web address is required.'
			),
			
			'url' => array(
				'rule' => 'url',
				'message' => 'Web address format should be: http://example.ombi60.com OR http://example.com.'
			),
			

		),
		'subdomain' => array(
			'validateWebAddress' => array(
				'rule' => array('validateWebAddress'),
				'message' => 'this message will never get displayed'
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Your web address is required.'
			),

		),
	);

	var $hasMany = array(
		
		'RecurringPaymentProfile' => array(
			'className' => 'RecurringPaymentProfile',
			'foreignKey' => 'shop_id',
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
		
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'shop_id',
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

		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'shop_id',
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
		'Merchant' => array(
			'className' => 'Merchant',
			'foreignKey' => 'shop_id',
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
		'ShopsPaymentModule' => array(
			'className' => 'ShopsPaymentModule',
			'foreignKey' => 'shop_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => true,
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Domain' => array(
			'className' => 'Domain',
			'foreignKey' => 'shop_id',
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
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'shop_id',
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
		'Cart' => array(
			'className' => 'Cart',
			'foreignKey' => 'shop_id',
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
		'Blog' => array(
			'className' => 'Blog',
			'foreignKey' => 'shop_id',
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
		
		'Webpage' => array(
			'className' => 'Webpage',
			'foreignKey' => 'shop_id',
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
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'shop_id',
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
		
		'ShippedToCountry' => array(
			'className' => 'ShippedToCountry',
			'foreignKey' => 'shop_id',
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
		
		'LinkList' => array(
			'className' => 'LinkList',
			'foreignKey' => 'shop_id',
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

	var $belongsTo = array(
		
		'FeaturedSavedTheme' => array(
			'className' => 'SavedTheme',
			'foreignKey' => 'saved_theme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	var $hasOne = array(
		'ShopSetting' => array(
			'className' => 'ShopSetting',
			'foreignKey' => 'shop_id',
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
	
	function beforeValidate() {
		
		// for localhost we will NOT validate for url
		if(strpos(FULL_BASE_URL, '.localhost')) {
			unset($this->validate['primary_domain']['url']);
		}
		
		return true;
	}
	
	

	/**
	 *
	 * Custom validator method to validate
	 *
	 **/
	function validateWebAddress($fields = array())
	{
		$shopErrors = $this->validationErrors;

		foreach ( $shopErrors as $key => $value ) {
			if ($key == 'primary_domain') {
				$this->validationErrors['subdomain'] = $value;
				unset($this->validationErrors[$key]);
				break;
			}
		}
		return TRUE;
	}
	
	

	/**
	 *
	 * Given a url seek out the corresponding shop
	 * Returns boolean false if no such shop
	 * */
	function getByDomain($url) {
		
		// Hackish code, please change in future
		// -- Andrew
		$testdomain = '.test.myspree2shop.com';
		$realdomain = '.myspree2shop.com';
		$url = str_replace($testdomain, $realdomain, $url);
		
		$this->recursive         = -1;
		$this->Domain->recursive = -1;
		$this->Theme->recursive  = -1;

		$this->Domain->Behaviors->attach('Linkable.Linkable');
		$this->Behaviors->attach('Linkable.Linkable');
		$this->Theme->Behaviors->attach('Linkable.Linkable');

		$result = $this->find(
				      'first',
				      array(
					   'link' => array('Domain', 'Theme'),
					   'conditions' => array('Domain.domain'=>$url),
					   'fields' => array('Shop.*', 'Domain.domain', 'Domain.id', 'Theme.name'),
					   ));

		if (!empty($result)) {
			return $result;
		}

		return false;
	}

	/**
	 * Static user code copied from Super Awesome Advanced CakePhp tips.
	 *
	 * http://github.com/mcurry/cakephp_static_user/
	 *
	 **/
	function &getInstance($shop = null) {
		static $instance = array();
		if ($shop) {
			$instance[0] =& $shop;
		}
		if (!$instance) {
			//trigger_error(__("Shop not set.", true), E_USER_WARNING);
			$shop = false;
			return $shop;
		}
		return $instance[0];
	}

	function store($shop) {
		if (empty($shop)) {
			return false;
		}
		Shop::getInstance($shop);
	}

	/**
	 * this code has been changed such that we can get other model data associated with User
	 *
	 * the User instance is in the form of
	 * Array
	 * (
	 *	[User] => Array
	 *	    (
	 *		[id] => ...
	 *	    )
	 *	[Merchant] => Array
         *	  (
         *	   [id] => ..
	 *	  )
	 *  )
	 *
	 **/
	function get($fieldName) {
		$_shop =& Shop::getInstance();

		$pathArray      = explode('.', $fieldName);
		$pathArrayCount = count($pathArray);
		if ($pathArrayCount !==2 AND $pathArrayCount !== 1) {
			return false;
		}
		$fieldName = ($pathArrayCount == 1) ? $fieldName : $pathArray[1];
		$modelName = ($pathArrayCount == 1) ? 'Shop' : ucwords($pathArray[0]);

		$path = sprintf($modelName.'/%s', $fieldName);

		if (strpos($path, '/') !== 0) {
			$path = sprintf('/%s', $path);
		}

		$value = Set::extract($path, $_shop);
		if (!$value) {
			return false;
		}
		return $value[0];
	}

	/**
	 * End of Static user code
	 *
	 **/

	/**
	 *
	 * afterSave callback saving shop and theme data into cache under the key Shop8 for shop of id 8
	 * */
	function afterSave($created) {

                $this->recursive = -1;
		$this->Behaviors->attach('Containable');
			
		$shop = $this->find('first', array('conditions'=>array('Shop.id'=>$this->id),
							'contain'=>array('FeaturedSavedTheme')));
		

		Cache::write('Shop'.$this->id, $shop);
		
		return true;
	}
	
	function getPaypalExpressOn($shopId) {
		if ($shopId > 0) {
			$this->ShopsPaymentModule->recursive = -1;
			$paymentModule = $this->ShopsPaymentModule->find('first',
							array('conditions'=>array(
										'shop_id'=>$shopId,
										'payment_module_id'=>PAYPAL_PAYMENT_MODULE,
										'active'=>true)));
			
			return (!empty($paymentModule));
		}
		return false;
		
	}
	
	function getPayPalShopsPaymentModuleId($shopId = 0) {
		if ($shopId == 0) {
			$shopId = $this->id;
		}
		
		if ($shopId > 0) {
			$id = $this->ShopsPaymentModule->field('id', array('shop_id'=>$shopId,
								     'payment_module_id'=>Configure::read('Payment.PayPal')));
							       
			return $id;
		}
		
		return false;
	}
	
	
	
	function getAllMerchantUsersInList($id = false, $fields=array(), $sort = true) {
		if (!$id) {
			return false;
		}
		
		$this->Merchant->User->Behaviors->attach('Linkable.Linkable');
		
		
		
		$findOptions = array('conditions'=>array('Shop.id'=>$id),
				     'link'=>array('Merchant'=>array('Shop')));
		
		if (!empty($fields)) {
			$findOptions['fields'] = $fields;
		} else {
			$findOptions['fields'] = array('User.full_name');
		}
		
		$this->arrayPlaceHolder =  $this->Merchant->User->find('list', $findOptions);
		if ($sort) {
			$this->shiftToTop(intval(User::get('User.id')));	
		}
		
		return $this->arrayPlaceHolder;
	}

}
?>