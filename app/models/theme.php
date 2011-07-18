<?php
class Theme extends AppModel {
	var $name         = 'Theme';
	var $displayField = 'name';

	var $hasMany = array(
		
		'SavedTheme' => array(
			'className' => 'SavedTheme',
			'foreignKey' => 'theme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
 /**
  * Funtion to save template settings in json encoded form.
  */
 function saveTemplateSettings($savedThemeId) {
    
   
    $data = $this->SavedTheme->read(null,$savedThemeId);
	  $folderPath = APP.DS.'views'.DS.'themed'.DS.$data['SavedTheme']['folder_name'].DS.'webroot'.DS.'assets';
	   $json_data_file = APP.DS.'views'.DS.'themed'.DS.$data['SavedTheme']['folder_name'].DS.'config'.DS.'settings_data.json'; 
	  if (!$this->__uploadFiles($folderPath)) {
       return false;        
    }
           
    $fp = fopen($json_data_file,'w'); 
    fwrite($fp,json_encode(array('current' => $this->data['Theme']['theme']['settings'])));
    fclose($fp);
    return true;
 }
 
 /**
  * Function to upload files uploaded through templates settings page.
  */
 function __uploadFiles($folderPath) {
    
       if (isset($this->data['Theme']['theme']['settings']['files']['name']) && !empty($this->data['Theme']['theme']['settings']['files']['name'])) {
    
              foreach($this->data['Theme']['theme']['settings']['files']['name'] as $key => $filename) {
    
                     if ($this->data['Theme']['theme']['settings']['files']['error'][$key] == 4) {    
                        continue;
                     }
                     $imgfilename = str_replace('dot','.',$key);
                     if (is_writable($folderPath)){

                          if (move_uploaded_file($this->data['Theme']['theme']['settings']['files']['tmp_name'][$key], $folderPath .DS. $imgfilename))
                          {
                             // Store name of file in model's data
                             $this->data['Theme']['theme']['settings'][$imgfilename] = $imgfilename;
                             $this->invalidate($key,'save faild'); 
                             return false;
                             
                          } else {
                             $this->invalidate($key,'save faild'); 
                             return false;
                          }
                     } else {
                        //debug('not writable');
                     }
       }
 
       unset($this->data['Theme']['theme']['settings']['files']);
    }
    
    return true;
  }
}
?>
