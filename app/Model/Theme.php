<?php
class Theme extends AppModel {
	public $name         = 'Theme';
	public $displayField = 'name';

	public $hasMany = array(
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
	  $folderPath = APP.DS.'View'.DS.'Themed'.DS.$data['SavedTheme']['folder_name'].DS.'webroot'.DS.'assets';
	   $json_data_file = APP.DS.'View'.DS.'Themed'.DS.$data['SavedTheme']['folder_name'].DS.'config'.DS.'settings_data.json'; 
	  if (!$this->__uploadFiles($folderPath)) {
       return false;        
    }
           
    $fp = fopen($json_data_file,'w'); 
    fwrite($fp,$this->__indent_json(json_encode(array('current' => $this->data['Theme']['theme']['settings']))));   
    fclose($fp);
    return true;
 }
 
 /**
  * Function to upload files uploaded through templates settings page.
  */
 function __uploadFiles($folderPath) {
        //debug($this->data['Theme']['theme']['settings']['files']);
        //debug($folderPath);
       if (isset($this->data['Theme']['theme']['settings']['files']['name']) && !empty($this->data['Theme']['theme']['settings']['files']['name'])) {
              
              foreach($this->data['Theme']['theme']['settings']['files']['name'] as $key => $filename) {
                     $imgfilename = str_replace('dot','.',$key);  
                     if ($this->data['Theme']['theme']['settings']['files']['error'][$key] == 4) {    
          
                       $hiddenName = '_'.$key;
                       
                       if (isset($this->data['Theme']['theme']['settings']['files'][$hiddenName]) && !empty($this->data['Theme']['theme']['settings']['files'][$hiddenName])) {
                          $this->data['Theme']['theme']['settings'][$imgfilename] = $this->data['Theme']['theme']['settings']['files'][$hiddenName];
                         
                       }
                        continue;
                     }
                   
                     if (is_writable($folderPath)){

                          if (move_uploaded_file($this->data['Theme']['theme']['settings']['files']['tmp_name'][$key], $folderPath .DS. $imgfilename))
                          {
                             // Store name of file in model's data
                             $this->data['Theme']['theme']['settings'][$imgfilename] = $imgfilename;                             
                             
                          } else {
                             $this->invalidate($key,'save_fail'); 
                             return false;
                          }
                     } else {
                        //debug('not writable');exit;
                     }
       }
 
       unset($this->data['Theme']['theme']['settings']['files']);
    }
    
    return true;
  }
  
  
  /**
 * Indents a flat JSON string to make it more human-readable.
 *
 * @param string $json The original JSON string to process.
 *
 * @return string Indented version of the original JSON string.
 */
function __indent_json($json) {

    $result      = '';
    $pos         = 0;
    $strLen      = strlen($json);
    $indentStr   = '  ';
    $newLine     = "\n";
    $prevChar    = '';
    $outOfQuotes = true;

    for ($i=0; $i<=$strLen; $i++) {

        // Grab the next character in the string.
        $char = substr($json, $i, 1);

        // Are we inside a quoted string?
        if ($char == '"' && $prevChar != '\\') {
            $outOfQuotes = !$outOfQuotes;
        
        // If this character is the end of an element, 
        // output a new line and indent the next line.
        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
            $result .= $newLine;
            $pos --;
            for ($j=0; $j<$pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        // Add the character to the result string.
        $result .= $char;

        // If the last character was the beginning of an element, 
        // output a new line and indent the next line.
        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
            $result .= $newLine;
            if ($char == '{' || $char == '[') {
                $pos ++;
            }
            
            for ($j = 0; $j < $pos; $j++) {
                $result .= $indentStr;
            }
        }
        
        $prevChar = $char;
    }

    return $result;
}
}
?>
