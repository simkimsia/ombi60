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
	
	}
	
	function admin_index() {
		$this->Theme->SavedTheme->recursive = 0;

		$this->paginate = array(
			      'conditions' => array('SavedTheme.shop_id' => User::get('Merchant.shop_id')));
	
		$this->set('themes', $this->paginate());

	}
	
	function admin_settings() {
	 
	  $savedThemeId = Shop::get('Shop.saved_theme_id');
	  configure::write('debug',3);
	  
	  $data = $this->Theme->SavedTheme->read(null,$savedThemeId);
	  $settings_html = APP.DS.'views'.DS.'themed'.DS.$data['SavedTheme']['folder_name'].DS.'config'.DS.'settings.html';
	  $uploadFolderPath = APP.DS.'views'.DS.'themed'.DS.$data['SavedTheme']['folder_name'].DS.'webroot'.DS.'assets';
	
	  if (isset($this->data) && !empty($this->data)) {
	   
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
	   
	  }
	  
	}
  
  function __get_settings_html() {
    $savedThemeId = Shop::get('Shop.saved_theme_id');
	  $data = $this->Theme->SavedTheme->read(null,$savedThemeId);
	  $settings_html = APP.DS.'views'.DS.'themed'.DS.$data['SavedTheme']['folder_name'].DS.'settings.html';
	  
	  if (file_exists($settings_html)) {
	    //parse html
	    App::import('Vendor', 'domParser'.DS.'domparser');
	    $doc = new domParser();
      $doc->loadHTMLFile($settings_html);
	    $this->set('HtmlArray',$doc->toArray());
	  }
  }
  
  function __uploadFiles($folderPath) {
         
     if (isset($this->data['theme']['settings']['files']['name']) && !empty($this->data['theme']['settings']['files']['name'])) {
        foreach($this->data['theme']['settings']['files']['name'] as $key => $filename) {
               if ($this->data['theme']['settings']['files'][$key]['error'] == 4) {
                  continue;
               }
               
               if (is_writable($folderPath))
                    if (move_uploaded_file($model->data[$model->name][$field]['tmp_name'], $fullpath . $imgFilename))
                    {
                       // Store name of image file in model's data
                        $model->data[$model->name][$options['filename']] = $imgFilename;
                       // If any old image for this photo is present then delete it
                       if (isset($model->data[$model->name][$options['old_filename_field']]))
                      {
                        @unlink($fullpath . $model->data[$model->name][$options['old_filename_field']]);
                      }
                    } 
               }
        }
     }
 
}
?>
