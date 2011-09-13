<?php
	echo $this->element('errors', array('errors' => $errors));
	echo $this->Form->create('Customer', array('action' => 'register'));
	echo $this->Form->input('User.email');
	echo $this->Form->input('User.password');
	echo $this->Form->input('User.password_confirm', array('type' => 'password'));
	echo $this->Form->input('User.full_name');
	echo $this->Form->input('User.name_to_call');
	echo $this->Form->input('Customer.shop_id', array('type' => 'hidden', 'value'=>$shop_id));
	
	//create the reCAPTCHA form. 
	//$recaptcha->display_form('echo');

	//hide an e-mail address 
	//$recaptcha->hide_mail("someuser@somdomain.tld",'echo');
	
	echo $this->Form->submit();
	echo $this->Form->end();
?>