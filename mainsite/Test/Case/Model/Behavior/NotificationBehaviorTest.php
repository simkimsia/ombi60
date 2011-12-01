<?php
/* Notification Test cases generated on: 2011-11-24 16:09:27 : 1322150967*/
App::uses('NotificationBehavior', 'Model/Behavior');

/**
 * NotificationBehavior Test Case
 *
 */
class NotificationBehaviorTestCase extends CakeTestCase {
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Notification = new NotificationBehavior();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notification);

		parent::tearDown();
	}

/**
 * testSendNotification method
 *
 * @return void
 */
	public function testSendNotification() {
		$order = array('Order' => array('order_no' => '00001'));
		$result = $this->Notification->sendNotification(null, 'checkout', $order, 'test');
		$this->assertTrue(!empty($result['headers']));
		$this->assertTrue(!empty($result['message']));
		
		//Testing notification not implemented
		$result = $this->Notification->sendNotification(null, 'another_notification', $order, 'test');
		$this->assertFalse($result);
	}
	
/**
 * testSendNotification method with a wrong config
 * @expectedException SocketException
 * @return void
 */
	public function testSendNotificationConfigError() {
		$order = array('Order' => array('order_no' => '00001'));
		$result = $this->Notification->sendNotification(null, 'checkout', $order, 'test_error');
		$this->fail();
	}

/**
 * testSendNotification method without config
 * @expectedException ConfigureException
 * @return void
 */
	public function testSendNotificationNoConfig() {
		$order = array('Order' => array('order_no' => '00001'));
		$result = $this->Notification->sendNotification(null, 'checkout', $order, 'wrong_config');
		$this->fail();
	}

}
