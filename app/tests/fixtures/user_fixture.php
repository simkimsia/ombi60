<?php
/* User Fixture generated on: 2010-04-21 11:04:41 : 1271849081 */
class UserFixture extends CakeTestFixture {
	var $name = 'User';

	var $import = array('model' => 'User');
	
	var $records = array(
		array(
			'id' => 1,
			'email' => 'merchant1@example.com',
			'password' => '78e8f77082028fa96a619aa568aa3ca88a72ec8e',
			'group_id' => MERCHANTS,
			'full_name' => 'crash dummy',
			'name_to_call' => 'dummy',
			'last_login_on' => NULL,
			'created' => '2010-01-01 00:00:00',
			'modified' => '2010-01-01 00:00:00',
			'status' => '1',
			
		),
		array(
			'id' => 2,
			'email' => 'customer1@example.com',
			'password' => '78e8f77082028fa96a619aa568aa3ca88a72ec8e',
			'group_id' => CUSTOMERS,
			'full_name' => 'fake customer',
			'name_to_call' => 'molly',
			'last_login_on' => NULL,
			'created' => '2010-01-01 00:00:00',
			'modified' => '2010-01-01 00:00:00',
			'status' => '1',
			
		),
	);
}
?>