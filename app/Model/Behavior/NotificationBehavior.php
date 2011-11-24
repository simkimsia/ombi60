<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('ModelBehavior', 'Model');

class NotificationBehavior extends ModelBehavior {
	
/**
 * Sends a notification for a given type
 * @param unknown_type $model
 * @param unknown_type $type
 * @param unknown_type $data
 * @param unknown_type $config
 * @return boolean
 */
	function sendNotification($model, $type, $data = null, $config = 'default') {
		$email = new CakeEmail($config); //gmail configuration in app/Config/email.php (as databases)
		if ($type == 'checkout') {
			return $email->template('checkout') //template to use app/View/Emails
				->emailFormat('html')
				->subject('New order submitted!')
				->to('alejandro.ibarra@cakedc.com') //you can use data to get this 
				->viewVars(array('order' => $data)) //passing data to view
				->send(); //sending email
		} else {
			return false;
		}//TODO add notifications
		
	}
}