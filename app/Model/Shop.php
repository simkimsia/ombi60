<?php
class Shop extends AppModel {

	public $name = 'Shop';

	public $validate = array(
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

	public $hasMany = array(
		
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
		
		'ProductGroup' => array(
			'className' => 'ProductGroup',
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
		
		'Vendor' => array(
			'className' => 'Vendor',
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

	public $belongsTo = array(
		
		'FeaturedSavedTheme' => array(
			'className' => 'SavedTheme',
			'foreignKey' => 'saved_theme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	public $hasOne = array(
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
	
	public function beforeValidate() {
		
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
	public function validateWebAddress($fields = array())
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
	public function getByDomain($url) {
		
		// to allow https url we need to do replacement where necessary.
		$url = strtolower($url);
		$url = str_replace('https://', 'http://', $url);
		
		
		$this->recursive         = -1;
		$this->Domain->recursive = -1;
		$this->ShopSetting->recursive = -1;
		
		$this->Behaviors->load('Linkable.Linkable');
		
		$result = $this->find(
				      'first',
				      array(
					   'link' => array('ShopSetting', 'Domain', ),
					   'conditions' => array('Domain.domain'=>$url),
					   'fields' => array('Shop.*', 'Domain.domain', 'Domain.id', 'ShopSetting.*'),
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
	public function &getInstance($shop = null) {
		static $instance = array();
		if ($shop) {
			$instance[0] =& $shop;
		}
		if (!$instance) {
			//trigger_error(__("Shop not set."), E_USER_WARNING);
			$shop = false;
			return $shop;
		}
		return $instance[0];
	}

	public static function store($shop) {
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
	public static function get($fieldName) {
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
	
	
	public static function getTemplateVariable() {
		$shopInstance = Shop::getInstance();
		$shop = array('name' => $shopInstance['Shop']['name'],
			      'url'  => $shopInstance['Shop']['url'] . '/',
			      'primary_domain'=> $shopInstance['Shop']['primary_domain'] . '/',
			      'permanent_domain'=>$shopInstance['Shop']['permanent_domain'] . '/',
			      'email'=>$shopInstance['Shop']['email'],
			      'products_count'=>$shopInstance['Shop']['visible_product_count'],
			      
			      'collections_count'=>$shopInstance['Shop']['product_group_count'],
			      'currency'=>$shopInstance['ShopSetting']['currency'],
			      'money_format'=>$shopInstance['ShopSetting']['money_in_html'],
			      'money_format_in_currency'=>$shopInstance['ShopSetting']['money_in_html_with_currency'],
			      
			      );
		
		return $shop;
	}

	/**
	 * End of Static user code
	 *
	 **/

	/**
	 *
	 * afterSave callback saving shop and theme data into cache under the key Shop8 for shop of id 8
	 * */
	public function afterSave($created) {

                $this->recursive = -1;
		$this->Behaviors->load('Containable');
			
		$shop = $this->find('first', array('conditions'=>array('Shop.id'=>$this->id),
							'contain'=>array('FeaturedSavedTheme')));
		

		Cache::write('Shop'.$this->id, $shop);
		
		return true;
	}
	
	public function getPaypalExpressOn($shopId) {
		if ($shopId > 0) {
			$this->ShopsPaymentModule->recursive = -1;
			$paymentModule = $this->ShopsPaymentModule->find('first',
							array('conditions'=>array(
										'shop_id'=>$shopId,
										'payment_module_id'=>PAYPAL_PAYMENT_MODULE,
										'active'=>true)));
			if (isset($paymentModule['ShopsPaymentModule']['display_name'])) {
				return (strpos($paymentModule['ShopsPaymentModule']['display_name'], 'Express Checkout') > 0);
			}
			
		}
		return false;
		
	}
	
	
	/**
	 * check if the current base is the same as the shop's main domain
	 **/
	public function isCurrentBaseThisDomain($mainUrl) {
                $baseHost = '';
                if (strpos(FULL_BASE_URL, 'http://') === 0) {
			
                    $baseHost = str_replace('http://', '', FULL_BASE_URL);    
                } else if (strpos(FULL_BASE_URL, 'https://') === 0) {
			
                    $baseHost = str_replace('https://', '', FULL_BASE_URL);    
                }
                
                return (strpos($mainUrl, $baseHost) !== false);
                
	}
	
	public function getPayPalShopsPaymentModuleId($shopId = 0) {
		if ($shopId == 0) {
			$shopId = $this->id;
		}
		
		if ($shopId > 0) {
			$this->ShopsPaymentModule->recursive = -1;
			$paymentModule = $this->ShopsPaymentModule->find('first',
							array('conditions'=>array(
										'shop_id'=>$shopId,
										'payment_module_id'=>PAYPAL_PAYMENT_MODULE,
										'active'=>true)));
			if (isset($paymentModule['ShopsPaymentModule']['display_name'])) {
				if (strpos($paymentModule['ShopsPaymentModule']['display_name'], 'Express Checkout') > 0) {
					return $paymentModule['ShopsPaymentModule']['id'];
				}
			}
			
		}
		return false;
	}
	
	public function getAccountEmailPaypal($shopId = 0) {
		if ($shopId > 0) {
			$this->ShopsPaymentModule->recursive = -1;
			$this->ShopsPaymentModule->Behaviors->attach('Linkable.Linkable');
			$paymentModule = $this->ShopsPaymentModule->find('first',
							array('conditions'=>array(
										'ShopsPaymentModule.shop_id'=>$shopId,
										'ShopsPaymentModule.payment_module_id'=>PAYPAL_PAYMENT_MODULE,
										'ShopsPaymentModule.active'=>true),
							      'link'=>array('PaypalPaymentModule'),
							      'fields'=>array('PaypalPaymentModule.account_email')));
			
			if (isset($paymentModule['PaypalPaymentModule']['account_email'])) {
				return $paymentModule['PaypalPaymentModule']['account_email'];
			}
			
			return '';
			
		}
		return '';
	}
	
	public function getAllMerchantUsersInList($id = false, $fields=array(), $sort = true) {
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