<?php
/* Merchant Test cases generated on: 2010-04-17 12:04:47 : 1271507807*/
App::import('Model', 'Merchant');
require_once('app_model.test.php');

class MerchantTestCase extends AppModelTestCase {
	

	function startTest() {
		$this->Merchant =& ClassRegistry::init('Merchant');
	}

	function endTest() {
		unset($this->Merchant);
		ClassRegistry::flush();
	}

	function testRegisterNewAccount() {
		$data = array();
		$data['User']['name_to_call'] = 'ally';
		$data['User']['full_name'] = 'ally';
		$data['User']['email'] = 'ally@a.com';
		$data['User']['password'] = 'password';
		$data['User']['password_confirm'] = 'password';
		$data['Shop']['web_address'] = 'http://abc.myspree2shop.com';
		$data['Shop']['subdomain'] = 'abc';

		$this->Merchant->signupNewAccount($data);


		$this->Merchant->Behaviors->attach('Linkable.Linkable');
		$this->Merchant->User->Behaviors->attach('Linkable.Linkable');
		$this->Merchant->Shop->Behaviors->attach('Linkable.Linkable');
		$this->Merchant->Shop->Domain->Behaviors->attach('Linkable.Linkable');

		$result = $this->Merchant->find('first',
			array('link'=>array('User',
					    'Shop'=>'Domain'),
			      'fields'=>array('Merchant.*', 'User.*', 'Shop.*', 'Domain.*'),
			      'conditions'=>array(
						'Domain.domain' => 'http://abc.myspree2shop.com',
						'Domain.primary' => true,
						'User.email' => 'ally@a.com',
						'Shop.web_address' => 'http://abc.myspree2shop.com',
						'Merchant.owner' => true,
						'User.group_id' => MERCHANTS,)
			      )

		);

		$this->assertTrue(!empty($result));

		$user_details = array();
		$shop_details = array();

		if (!empty($result)) {
			$user_details = array_intersect($result['User'], $data['User']);
			$shop_details = array_intersect($result['Shop'], $data['Shop']);

			// need to unset these 2 fields because they actually do NOT exist in the database
			// they appear on the forms for UI reasons
			unset($data['User']['password_confirm']);
			unset($data['Shop']['subdomain']);
		}

		$this->assertEqual($user_details, $data['User']);
		$this->assertEqual($shop_details, $data['Shop']);

		// more checks for domain


	}

	function testGetAllValidationErrors() {
		// from the form
		$data = array();
		$data['User']['name_to_call'] = 'ally';
		$data['User']['full_name'] = 'ally';
		$data['User']['email'] = 'ally@a.com';
		$data['User']['password'] = 'password';
		$data['User']['password_confirm'] = 'password';
		$data['Shop']['web_address'] = 'http://abc.myspree2shop.com';
		$data['Shop']['subdomain'] = 'abc';


		$errors = array();

		// should be successfully saved with no errors
		$this->Merchant->signupNewAccount($data);
		$this->assertEqual($this->Merchant->getAllValidationErrors(), $errors);

		// if saved again with same data we should expect 1 error involving duplicate subdomain
		$this->Merchant->signupNewAccount($data);

		// error message taken from the web_address isUnique rule in Shop model since it will override the subdomain validation
		// due to the custom validation method validateWebAddress in Shop model
		$errors['subdomain'] = 'This web address is already used. Please choose another.';
		$this->assertEqual($this->Merchant->getAllValidationErrors(), $errors);

	}

	function testUpdateProfile() {
		$data = array();

		$result = $this->Merchant->findById(1);

		$this->assertEqual($result['Merchant']['id'], 1);

		$result['User']['full_name'] = 'Lorem ipsum';
		$result['Shop']['name'] = 'Lorem ipsum dolor';
		$result['Merchant']['owner'] = false;

		$this->Merchant->updateProfile($result);

		$result = $this->Merchant->findById(1);

		$this->assertEqual($result['User']['full_name'], 'Lorem ipsum');
		$this->assertEqual($result['Shop']['name'], 'Lorem ipsum dolor');
		$this->assertEqual($result['Merchant']['owner'], 0);

	}

}
?>