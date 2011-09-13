<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {

/**
 * Behaviors
 *
 * @var array
 */
    public $actsAs = array('Containable');
    
    var $arrayPlaceHolder = array();
    
    /**
    *
    * Custom validator method for comparing 2 fields
    *
    **/
   function identicalFieldValues( $field=array(), $compare_field=null )  
   { 
        foreach( $field as $key => $value ){ 
            $v1 = $value; 
            $v2 = $this->data[$this->name][ $compare_field ];                  
            if($v1 !== $v2) { 
                return FALSE; 
            }
            else { 
                continue; 
            } 
        } 
        return TRUE; 
   }
   
   
   /**
    * Returns the validation error messages for the registration/login form
    *
    * @return array An array of error messages with the field as key eg: [fieldName] => error_message
    * 
    **/
   function getAllValidationErrors() 
   { 
           $currentModelErrors = $this->validationErrors;
           $associatedModelErrors = array();
           
           $registerFormErrors = array();
           
           // first we put in all the validation errors of the current model
           foreach($currentModelErrors as $fieldName => $err){
                if(!is_array($err)){
                        $registerFormErrors[$fieldName] = $err;
                } else {
                        $associatedModelErrors[] = $err;
                }
           }
           
           foreach ($associatedModelErrors as $fieldName => $err) {
                $registerFormErrors = array_merge($registerFormErrors, $err);
           }
           
           
           // then we put in the validation errors of the associated models
           return $registerFormErrors;
   }
   
    /**
     * useful way to get something to be top of array
     **/
    
    
    function shiftToTop($key) {
        
        $cmp = sorter($key);
        
        return uksort($this->arrayPlaceHolder, $cmp);
        
    }
    
}

function sorter($key) { 
    return function ($a, $b) use ($key) {
        
            if ($a === $b) return 0;
            if ($a === $key) return -1;
            if ($b === $key) return 1;
            return strnatcmp($a, $b);
    };
}

?>