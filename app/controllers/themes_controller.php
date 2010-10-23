<?php
class ThemesController extends AppController {

	var $name = 'Themes';
	
	function beforeFilter() {
		
		/*
		//public & private keys for reCAPTCHA
		$this->Recaptcha->publickey = ""; 
		$this->Recaptcha->privatekey = "";
		*/
		
		// call the AppController beforeFilter method after all the $this->Auth settings have been changed.
		parent::beforeFilter();

		/**
		 * because of Auth default settings do not work for Merchant, hence alot of fields need to be overridden.
		 **/

		// allow non users to access register and login actions only.
		//$this->Auth->allow('admin_settings');
	
	}
	
	function admin_index() {
		$this->Theme->SavedTheme->recursive = 0;

		$this->paginate = array(
			      'conditions' => array('SavedTheme.shop_id' => User::get('Merchant.shop_id')));
	
		$this->set('themes', $this->paginate());

	}

}
?>