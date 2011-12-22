<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('ModelBehavior', 'Model');

class NotificationBehavior extends ModelBehavior {
	
	public $mailData = array(
		'checkout' => array(
			'template' => 'checkout',
			'emailFormat' => 'html',
			'subject'	=> 'New order submitted!',
			'to' => 'admin@ombi60.com',
		)
	);
	
	
/**
 * Sends a notification for a given type
 * @param unknown_type $model
 * @param unknown_type $type
 * @param unknown_type $data
 * @param unknown_type $config
 * @return boolean
 */
	function sendNotification($model, $mailData = array(), $data = null, $config = 'default') {
		
		if (!isset($mailData['action'])) {
			return false;
		}
		
		$action = $mailData['action'];
		
		if (!isset($this->mailData[$action])) {
			return false;
		}
		
		$mailData = array_merge($this->mailData[$action], $mailData);
		
		$email = new CakeEmail($config); //gmail configuration in app/Config/email.php (as databases)

		$template 		= $mailData['template'];
		$emailFormat 	= $mailData['emailFormat'];
		$subject 		= $mailData['subject'];
		$to 			= $mailData['to'];
		

		return $email->template($template) //template to use app/View/Emails
				->emailFormat($emailFormat)
				->subject($subject)
				->to($to) //you can use data to get this 
				->viewVars(array('data' => $data)) //passing data to view
				->send(); //sending email
		
	}
	
	
}