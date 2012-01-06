<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	public $name = 'User';
	
	public $displayField = 'full_name';

	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'language_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'LiveCart' => array(
			'className' => 'Cart',
			'foreignKey' => 'live_cart_id',
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
	
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'author_id',
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
		'Page' => array(
			'className' => 'Webpage',
			'foreignKey' => 'author',
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

	public $hasOne = array(

		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CasualSurfer' => array(
			'className' => 'CasualSurfer',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Merchant' => array(
			'className' => 'Merchant',
			'foreignKey' => 'user_id',
			'dependent' => true,
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

	public $actsAs = array('Acl' => 'requester', 'Filter.Filter');

	public $recursive = -1;

	public $validate = array(
		'password' => array(
			'minLength' => array(
				'rule' => array('minLength', '8'),
				'message' => 'Minimum 8 characters long',
			),

			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Your password is required',
			),

		),
		'group_id' => array(
			'range' => array(
				'rule' => array('range', 0, 6),
				'message' => 'A valid group must be chosen for User. Administrator, Editor, Merchant, Customer or Casual Surfer.',
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'A group must be chosen for User',
			),

		),
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'Invalid e-mail address',
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Your email is required',
			),
			'unique' => array(
				'rule' => array('uniqueEmailInShop'),
				'on' => 'create',
				'message' => 'This email has already been used. Please choose another one.'
				
			),

		),
		'password_confirm' => array(

			'compare' => array(
				'rule' => array('identicalFieldValues', 'password' ),
				'message' => 'Please ensure your password and confirm password match',
				'on' => 'create'
			),


		),
		'new_password' => array(
			'update_password' => array(
				'rule' => array('updatePasswordValidation'),
				'message' => 'Please ensure you have entered your current password and that your new password matches with new password confirm',
				'on' => 'update'
			), 
			'new_password_length' => array(
				'rule' => array('newPasswordLengthValidation', '8'),
				'message' => 'Minimum 8 characters long for new password',
				'on' => 'update'
			)
		)
	);

	/**
	 * For Acl component
	 *
	 * retrieve the group of User
	 **/
	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		$data = $this->data;
		if (empty($this->data)) {
			$data = $this->read();
		}
		if (empty($data['User']['group_id'])) {
			return null;
		} else {
			return array('Group' => array('id' => $data['User']['group_id']));
		}
	}

	/**
	 * Static user code copied from Super Awesome Advanced CakePhp tips.
	 *
	 * http://github.com/mcurry/cakephp_static_user/
	 *
	 **/
	public function &getInstance($user = null) {
		static $instance = array();
		if ($user) {
			$instance[0] =& $user;
		}
		if (!$instance) {
			//trigger_error(__("User not set."), E_USER_WARNING);
			$user = false;
			return $user;
		}
		return $instance[0];
	}

	public static function store($user) {
		if (empty($user)) {
			return false;
		}
		User::getInstance($user);
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
		$_user =& User::getInstance();
		if (!$_user) {
			return false;
		}

		$pathArray      = explode('.', $fieldName);
		$pathArrayCount = count($pathArray);
		if ($pathArrayCount !==2 AND $pathArrayCount !== 1) {
			return false;
		}
		$fieldName = ($pathArrayCount == 1) ? $fieldName : $pathArray[1];
		$modelName = ($pathArrayCount == 1) ? 'User' : ucwords($pathArray[0]);

		$path = sprintf($modelName.'/%s', $fieldName);

		if (strpos($path, '/') !== 0) {
			$path = sprintf('/%s', $path);
		}

		$value = Set::extract($path, $_user);
		if (!$value) {
			return false;
		}
		return $value[0];
	}

	/**
	 * End of Static user code
	 *
	 **/
	
	public function uniqueEmailInShop( $field=array() )  
	{ 
		$shopId = Shop::get('Shop.id');
		// if no such shopId, most probably is at the register page
		// hence no way we can properly get the shop id based on domain
		// since it is at the register page, we should allow true, since shop is not even created yet.
		if (!$shopId) {
			return true;
		}
		
		if (isset($this->data[$this->name]['original_email']) &&
		    $this->data[$this->name]['original_email'] == $this->data[$this->name]['email']) {
			return true;
		}
		
		$count = 0;
		$group_id = $this->data[$this->name]['group_id'];
		$email = $this->data[$this->name]['email'];
		
		if ($shopId > 0 AND $group_id > 0){
			switch ($group_id) {
				case CUSTOMERS:
					
					$this->Customer->Behaviors->load('Linkable.Linkable');
					
					$count = $this->Customer->find('count', array(
						'contain' => array('User'),
						'conditions'=>array(
							'Customer.shop_id'	=> $shopId,
							'User.group_id'		=> $group_id,
							'User.email' 		=> $email,
						),
						'fields' =>'User.id',
					));
					
					break;
					
				case MERCHANTS:
				
					$this->Merchant->Behaviors->load('Linkable.Linkable');
					
					$count = $this->Merchant->find('count', array(
						'conditions'=>array(
							'User.group_id'		=>$group_id,
							'User.email' 		=> $email,
							'Merchant.shop_id'	=>$shopId
						),
						'fields' =>'User.id',
					));
					break;
				case CASUAL:
					
					
					$this->CasualSurfer->Behaviors->load('Linkable.Linkable');
					
					$count = $this->CasualSurfer->find('count', array(
						'conditions'=>array(
							'User.group_id'			=>$group_id,
							'User.email' 			=> $email,
							'CasualSurfer.shop_id'	=>$shopId
						),
						'fields' =>'User.id',
					));
					break;
				
				default:
					return false;
				
			}
			
			return ($count==0);
		}
		return false;
	}
	
	
	/**
	* this is for validation for updating passwords
	* assume current_password, new_password, new_password_confirm are all plaintext
	* assume current_password may or may not be filled in
	* to change passwords, all 3 MUST be filled in.
	* if either new_password, or new_password_confirm is non-empty, intention to change password is assumed.
	* to successfully change password, 
	* 1) the current password is correct
	* 2) the new_password and new_password_confirm are exactly the same
	* change password by hasing the new password and putting inside request->data[User][password]
	**/
	public function updatePasswordValidation($field = array()) {
		
		$currentPasswordExists		= !empty($this->data['User']['current_password']);
		$newPasswordExists			= !empty($this->data['User']['new_password']);
		$newPasswordConfirmExists	= !empty($this->data['User']['new_password_confirm']);
		
		$allPasswordExist 			= $currentPasswordExists && $newPasswordExists && $newPasswordConfirmExists;
		
		if (!$newPasswordExists && !$newPasswordConfirmExists) {
			return true;		
		}
		
		if ($allPasswordExist) {
			
			$newPassword 		= $this->data['User']['new_password'];
			$newPasswordConfirm	= $this->data['User']['new_password_confirm'];
			
			// check if the new password matches
			if ($newPassword !== $newPasswordConfirm) {
				return false;
			}
			
			$count = $this->find('count', array(
				'conditions' => array(
					'User.email' => $this->data['User']['original_email'],
					'User.password' => AuthComponent::password($this->data['User']['current_password']))
			));
			
			$userExists = ($count > 0);
			
			// check if current password is valid
			if (!$userExists) {
				return false;
			} else {
				$this->data['User']['password'] = 	$this->data['User']['new_password'];
				return true;
			}
			
			
		}
			
		return false;
	}
	
	/**
	* this is for validation for new password length
	* assume current_password, new_password, new_password_confirm are all plaintext
	* if both new_password and new_password_confirm exist and identical, length must be minimum of 8
	**/
	public function newPasswordLengthValidation($field = array(), $minLength) {
		
		$newPasswordExists			= !empty($this->data['User']['new_password']);
		$newPasswordConfirmExists	= !empty($this->data['User']['new_password_confirm']);
		
		
		if (!$newPasswordExists && !$newPasswordConfirmExists) {
			return true;		
		}
		
			
		$newPassword 		= $this->data['User']['new_password'];
		$newPasswordConfirm	= $this->data['User']['new_password_confirm'];
			
		// check if the new password matches
		if (strlen($newPassword) < $minLength) {
			return false;
		}
		return true;
		
	}
	
	/**
	* to get Merchant and User data based on User id
	*
	* used mostly for admin related pages and login
	**/
	public function getMerchantUser($id = null) {
		
		if ($id == null) {
			return false;
		}
		

		return $this->find('first', array(
			'conditions' => array(
				'User.id' => $id,
				'User.group_id' => MERCHANTS
			),
			'contain' => array('Merchant')
		));
		
	}
	
	/**
	*
	* beforeSave function
	*
	* @param $options Array
	* @return boolean Returns true if okay
	**/
	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}

		if (isset($this->data['User']['password_confirm'])) {
			$this->data['User']['password_confirm'] = AuthComponent::password($this->data['User']['password_confirm']);
		}
		

        return true;
    }
	
	
    
}
?>