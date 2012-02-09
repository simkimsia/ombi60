<?php
/**
 * This is email configuration file.
 *
 * Use it to configure email transports of Cake.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * In this file you set up your send email details.
 *
 * @package       cake.config
 */
/**
 * Email configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * transport => The name of a supported transport; valid options are as follows:
 *		Mail 		- Send using PHP mail function
 *		Smtp		- Send using SMTP
 *		Debug		- Do not send the email, just return the result
 *
 * You can add custom transports (or override existing transports) by adding the
 * appropriate file to app/Network/Email.  Transports should be named 'YourTransport.php',
 * where 'Your' is the name of the transport.
 *
 * from =>
 * The origin email. See CakeEmail::from() about the valid values
 *
 */
class EmailConfig {
	
	public $test = array(
		'from' => 'test@ombi60.com',
		'transport' => 'Debug'
	);
	
	public $test_error = array(
		'from' => 'WRONG_FROM',
		'transport' => 'Debug'
	);
	
	// using gmail as smtp
	public $gmail = array(
		'host' => 'ssl://smtp.gmail.com',
      	'port' => 465,
      	'from' => 'no-reply@ombi60.com',
      	'username' => 'no-reply@ombi60.com',
      	'password' => 'password4noreply',
      	'transport' => 'Smtp'
    );
	
	// using sendgrid as smtp
	public $sendgrid = array(
		'port'=> 465, 
		'timeout'=>'30',
		'host' => 'ssl://smtp.sendgrid.net',
		'from' => 'no-reply@ombi60.com',
		'username'=>'ombi60',
		'password'=>'password4sendgrid',
		//'client' => 'www.openmybusinessin60seconds.com',
		'transport' => 'Smtp'
	);
	
	public $default = array(
		'host' => 'ssl://smtp.gmail.com',
      	'port' => 465,
      	'from' => 'no-reply@ombi60.com',
      	'username' => 'no-reply@ombi60.com',
      	'password' => 'password4noreply',
      	'transport' => 'Smtp'
    );

}
