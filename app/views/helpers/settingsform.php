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
       
    }
    
    function textarea($data) {
       echo "<br>TEXT AREA DATA ";print_r($data);
       
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
       if (isset($data[0]) && !empty($data[0])) {
          $attrArr['value'] = $data[0];
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
    
    function input($data) {
       
       echo "<br><br>INPUT DATA ::: ----------------------------------<br><br>";
       print_r($data);
        foreach ($data as $key => $value) {
          
          if ($key != 'option' && substr($key,0,1) == '@') {
              $keyName = substr($key,1);
              
               echo "<br><br>KEY NAME :: ".$keyName;
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
              
              if (trim($keyName) == 'name') {
                 $tagName = trim($value);
              }                             
          }
          
          $attrArr['label'] = false;
       } 
       
       if (isset($attrArr['type']) && $attrArr['type'] == 'checkbox') {
            $attrArr['value'] = 1;
       } elseif ((isset($attrArr['type']) && $attrArr['type'] == 'radio')) {
            $defaultArr = array();
            $attrArr['options'][$attrArr['value']] = $attrArr['value'];
            if (isset($attrArr['checked'])) {
               $attrArr['checked'] = true;
               
                $defaultArr['default'] = $attrArr['value'];
                 //unset($attrArr['value']);
               //$attrArr['default'] = $attrArr['value'];
            } else {
                 $attrArr['checked'] = false;
                 $defaultArr['default'] = false;
                 //unset($attrArr['checked']);
                 //unset($attrArr['value']);
            }
       }
       
      echo "<br><br>ATTR ARRA ::: "; print_r($attrArr);
       
       $tagName = str_replace('.','dot',$tagName);
      // if (isset($tagType) && $tagType == 'file') {
      if (isset($attrArr['type']) && $attrArr['type'] == 'file') {
       
        return $this->Form->file('theme.settings.files.'.$tagName,$attrArr); 
       } elseif (isset($attrArr['type']) && $attrArr['type'] == 'radio') {
          echo "<br>---------------------------DEFAULT ARRAY :: ";print_r($defaultArr);
          return $this->Form->input('theme.settings.'.$tagName,$attrArr,$defaultArr); 
       } else {
        return $this->Form->input('theme.settings.'.$tagName,$attrArr);
       } 
       
    }
    
    function radio($tagName ,$radioData) {
        $attributes = array();
        
       
        if (isset($radioData['attr']) && !empty($radioData['attr'])) {
             
             foreach ($radioData['attr'] as $attrKey => $attrVal) {
                 
                 if (substr($attrKey,0,1) == '@') {
                     $key = substr($attrKey,1);
                     if ($key == 'id') {
                        $attrVal = 'theme_settings_'.$attrVal;                       
                     }                     
                      $attributes[$key] = $attrVal;
                 }
             }
       
        }
        
       $attributes['legend'] = false;
        
        return $this->Form->input('theme.settings.'.$tagName,array_merge($attributes,array('options' => $radioData['options'],'type' => 'radio','value' => $radioData['checked'])),array('default' => $radioData['checked'])); 
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
       if (isset($element[0]) && is_array($element[0])) {
            $radioData = array();
           foreach ($element as $eachElement) {
              //$html .= $this->$key($eachElement);    
              
              if (isset($eachElement['@type']) && $eachElement['@type'] == 'radio') {
                  $radioData[$eachElement['@name']]['options'][$eachElement['@value']] = $eachElement['@value'];
                  if (isset($eachElement['@checked']) && $eachElement['@checked'] == 'checked') {
                      $radioData[$eachElement['@name']]['checked'] = $eachElement['@value'];   
                  
                 } 
                 $tagName =  $eachElement['@name'];
                 foreach ($eachElement as $key => $value)  {
                     if (!in_array($key,array('@type','@name','@value','@checked'))) {
                       
                        $radioData[$tagName]['attr'][$key] = $value;
                     }
                 }
                 
                 $radioData['group1']['attr']['@id'] = 'id_'.++$i;
              } else {
                  $html .= $this->$key($element);    
              }
           }
           
           echo "<br>-----------------------RADIO DATA ---------------";print_r($radioData);
           if (!empty($radioData) && is_array($radioData)) {
                foreach ($radioData as $tagName => $eachRadio) {
                   $html .= $this->radio($tagName,$eachRadio);
                }
           }
       } else {
          $html .= $this->$key($element);
       }
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
          
         /* $html .= '<'.$key.' ';
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
           $html .= '</'.$key.'>'; */
           
           
            $tag = '<'.$key.' ';
           $attr = '';
           //$newhtml = '';
           $newhtml = array();
           $i = 0;
            foreach ($element as $innerTag => $innerHtml) {
                if (substr($innerTag,0,1) == '@') {
                   $attr .= substr($innerTag,1) ."=" .$innerHtml ." ";
                } else {
                   echo "<br>INNER HTML --------------$innerTag--";print_r($innerHtml); echo " ------------------- end innerhtml";
                   echo "<br>ELEMENT 0 START<br>"; print_r($element[0]); echo "<br>ELEMENT 0 end<br>";
                   if (is_array($innerHtml)) {
                      $newhtml[] = $this->buildTag($innerTag,$innerHtml,$counter);
                   } else {
                       echo "<br>in else";
                       if (is_numeric($innerTag) && trim($innerHtml) != '') {
                        $newhtml[] = $innerHtml;
                       }
                   }
                }
           }
           //$html .= $attr. '>'.$element[0].$newhtml;
           $openingTag = $tag . $attr.'>';
           $closingTag = '</'.$key.'>';
           if (!empty($newhtml) && is_array($newhtml)) {
              foreach ($newhtml as $newHtmlText) {
                  $html .= $openingTag . $newHtmlText . $closingTag;
                  echo "<br> ==== ++".$i++;
                  
              }
           } else {
              $html .= $openingTag .  $closingTag;
             // $html .= '</'.$key.'>';
            }
            
            
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
    } else {
         $html = $element;
    }
    //}
    //echo "<br>COUNTER :: $counter";
    if ($counter > 50) {
      echo "<br>in infinite loop "; exit;
    }
    return $html;
}
}

