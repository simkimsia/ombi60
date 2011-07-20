<?php
class ThemesController extends AppController {

	var $name = 'Themes';
	var $helpers = array('Html', 'Form', 'Session', 'Constant', 'TimeZone.TimeZone', 'Ajax','settingsform');
	
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
		//$this->Auth->allow($this->action);
		
		if($this->action == 'admin_settings')  {
			$this->Security->enabled = false;
		}
	
	}
	
	function admin_index() {
		$this->Theme->SavedTheme->recursive = 0;

		$this->paginate = array(
			      'conditions' => array('SavedTheme.shop_id' => User::get('Merchant.shop_id')));
	
		$this->set('themes', $this->paginate());

	}
	
	function admin_settings() {
	 
	  $savedThemeId = Shop::get('Shop.saved_theme_id');
	  
	  
	  $data = $this->Theme->SavedTheme->read(null,$savedThemeId);
	  $settings_html = APP.DS.'views'.DS.'themed'.DS.$data['SavedTheme']['folder_name'].DS.'config'.DS.'settings.html';
	  $uploadFolderPath = APP.DS.'views'.DS.'themed'.DS.$data['SavedTheme']['folder_name'].DS.'webroot'.DS.'assets';
	  $json_data_file = APP.DS.'views'.DS.'themed'.DS.$data['SavedTheme']['folder_name'].DS.'config'.DS.'settings_data.json'; 
	  $asset_folder_url = DS.'theme'.DS.$data['SavedTheme']['folder_name'].DS.'assets'.DS;
	  
	  
	  if (isset($this->data) && !empty($this->data)) {
	    //print_r($this->data);
	   
	    $this->Theme->set($this->data);	  
	    if ($this->Theme->saveTemplateSettings($savedThemeId)) {
	       $this->Session->setFlash('Settings saved successfully.');
	    } else {
	       $this->Session->setFlash('Unable to save settings.');
	    }
	    
	  } 
	  if (file_exists($settings_html)) {
	   
	    App::import('Vendor', 'domparser', array('file' => 'domParser'.DS.'domparser.php'));
	
	    $doc = new domParser();
      $doc->loadHTMLFile($settings_html);
	    $this->set('HtmlArray',$doc->toArray());
	    $json_data = array();
	    if (file_exists($json_data_file)) {
	       $json_data = json_decode(file_get_contents($json_data_file));
	    }
	    $this->set('json_data',$json_data);
	    $this->set('asset_folder_url',$asset_folder_url);
	  }
	  
	}
    
 
}
?>
