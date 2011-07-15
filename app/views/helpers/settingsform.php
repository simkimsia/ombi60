<?php

class SettingsformHelper extends AppHelper {

    var $helpers = array('Form');
   
    function select($data) {
      /* if (isset($data['option'])) {
       
       } */
       //echo "<br>here";exit;
       //echo "<br>SELECT DATA :: ";print_r($data);
       $options = array();
       
       if (is_array($data['option']) && !empty($data['option'])) {
                  foreach ($data['option'] as $htmlOptions) {
                     $options[$htmlOptions['@value']] = $htmlOptions[0];
                  }
       }
       
       $attrArr = array();       
       foreach ($data as $key => $value) {
          
          if ($key != 'option' && substr($key,0,1) == '@') {
              $keyName = substr($key,1);
              if ($keyName != 'name') {
                if ($keyName == 'id') {
                  $value = 'theme_settings_'.$value;
                }
                $attrArr[$keyName] = $value;
              } else {
                $tagName = $value;
              }                              
          }
          
          $attrArr['label'] = false;
       }
       /*echo "<br><br>----------- SELECT OPTIONS -------------------- <br><br>";
      
       print_r(array_merge(array('options' => $options)));
       
       echo "<br><br>------------ ATTR ARR -------------------------- <br><br>";
       print_r($attrArr);
       //exit; */
       return $this->Form->input('theme.settings.'.$tagName,array_merge(array('options' => $options),$attrArr));
       return $form->input('theme.settings.'.$tagName,array_merge(array('options' => $options),$attrArr));
    }
    
    function input($data) {
        foreach ($data as $key => $value) {
          
          if ($key != 'option' && substr($key,0,1) == '@') {
              $keyName = substr($key,1);
              if ($keyName != 'name') {
                if ($keyName == 'id') {
                  $value = 'theme_settings_'.$value;
                }
                $attrArr[$keyName] = $value;
              } elseif($keyName == 'type' && $value=="file") {
                 echo "<br>here 88888888888888";
                  $tagType = $value;            
              } else {
                $tagName = $value;
              }                              
          }
          
          $attrArr['label'] = false;
       } 
       
       if (isset($attrArr['type']) && $attrArr['type'] == 'checkbox') {
            $attrArr['value'] = 1;
       }
       
       print_r($attrArr);
       
       $tagName = str_replace('.','dot',$tagName);
      // if (isset($tagType) && $tagType == 'file') {
      if (isset($attrArr['type']) && $attrArr['type'] == 'file') {
         echo "ghghgg ggg  ggg file";
        return $this->Form->file('theme.settings.files.'.$tagName,$attrArr); 
       } else {
        return $this->Form->input('theme.settings.'.$tagName,$attrArr);
       } 
       
    }
    
    
    
    function buildTag($key,$element,$counter,$html='') {
    //$html='';
    //echo "<br>here ";
 
    $_allowedFormElements = array('input','select','textarea');
    $_unallowedElements = array('form');
    $_allowedHtmlElemnts = array('legend','table','tbody','tr','td','p','div','span');
    $counter++;
    //echo "<br> ";
    /*if ($key == 'select') {
       //$html .= $this->Settingsform->select($element);
    } else { */
    //echo "<br>KEY :: ".$key; //exit;
   // if ($key === 'select') {
    if (in_array($key,$_allowedFormElements,true)) {
       //$html .= $this->select($element); 
       $html .= $this->$key($element);
    } elseif (!is_numeric($key) && !is_array($element) ) {
        //echo "<br>FIRST IF ";
        $html .= '<'.$key.'>'.$element.'</'.$key.'>';   
        
       // echo $html;                 
    }elseif(!is_numeric($key) && is_array($element) ) {
        //echo "<br>2 IF ";
       if (isset($element[0]) && !is_array($element[0])) {
          /*$tag = '<'.$key." ";
          foreach($element as $attrKey => $attrVal) {
             if (substr($attrKey,0,1) == '@') {
                  $tag .= "$attrKey=$attrVal ";
             }
          }
          $tag .= ">".$element[0]."</".$key.">";
          $html .= $tag; */
          
          $html .= '<'.$key.' ';
           $attr = '';
           $newhtml = '';
            foreach ($element as $innerTag => $innerHtml) {
                if (substr($innerTag,0,1) == '@') {
                   $attr .= substr($innerTag,1) ."=" .$innerHtml ." ";
                } else {
                   $newhtml .= $this->buildTag($innerTag,$innerHtml,$counter);
                }
           }
           $html .= $attr. '>'.$element[0].$newhtml;
           $html .= '</'.$key.'>';
       } elseif(isset($element[0]) && is_array($element[0]) ) {
           //buildTag();
          
           foreach ($element as $innerTag => $innerHtml) {
                $html .= '<'.$key.'>';
                $html .= $this->buildTag($innerTag,$innerHtml,$counter);
                $html .= '</'.$key.'>';
           }
           
       } elseif (!isset($element[0]) && is_array($element)) {
           $html .= '<'.$key.' ';
           $attr = '';
           $newhtml = '';
           foreach ($element as $innerTag => $innerHtml) {
                if (substr($innerTag,0,1) == '@') {
                   $attr .= substr($innerTag,1) ."=" .$innerHtml ." ";
                } else {
                   $newhtml .= $this->buildTag($innerTag,$innerHtml,$counter);
                }
           }
           $html .= $attr. '>'.$newhtml;
           $html .= '</'.$key.'>';
       } else {
          echo "<br>I AM HERE WITH KEY ELEMENT $key <br>";print_r($element);
       }
       //echo $html;
    } elseif (is_numeric($key) && is_array($element)) {
       // echo "<br>3 IF ";print_r($element);
            foreach ($element as $innerTag => $innerHtml) {
                 //echo "<br>innerhtml in 3rd";print_r($innerHtml);
                 
                $html .= $this->buildTag($innerTag,$innerHtml,$counter);
                //echo "<br>build html----------------- innerTag :: ".$innerTag."<br><br>".$html;
               // ;
               
                
            }
        //echo $html;    
    }
    //}
    //echo "<br>COUNTER :: $counter";
    if ($counter > 50) {
      echo "<br>in infinite loop "; exit;
    }
    return $html;
}
}

