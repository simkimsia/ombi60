<?php
/**
 * String Utility Library
 *
 * This Utility Library is for string manipulation.
 * http://github.com/simkimsia/StringUtil
 *
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2011, Sim Kim Sia
 * @link http://simkimsia.com
 * @author Sim Kim Sia (kimcity@gmail.com)
 * @package app
 * @subpackage app.Lib
 * @filesource
 * @version 0.1
 * @lastmodified 2011-10-03 
 */
class StringLib {
	
	/**
	* 
	* Checks input string does NOT have single quotes at the beginning and at the end.
	* Wraps it in single quotes.
	* E.g., $input is string. Returns 'string'
	*
	* @param string $input. Input string.
	* @return string. If string has either a single quote at front or end, it is returned unchanged.
	**/
	function wrapStringInQuotes($input) {
		$noStartsWithQuote = !self::startsWith($input, "'");
		$noEndsWithQuote   = !self::endsWith($input, "'");
          
        if ($noStartsWithQuote AND $noEndsWithQuote) {
                
			return "'" . $input . "'";
        }
        return $input;
	}
	
	/**
	* 
	* Takes input array and wraps every value-string in single quotes where applicable.a
	*
	* @param array $array. Input array.
	* @param boolean $recursive. Set true if you want the wrapping to happen at all levels of array. Default false.
	* @return array. 
	**/
	function iterateArrayWrapStringValuesInQuotes($array, $recursive = false) {
		foreach($array as $key=>$value) {
			if (is_array($value) && $recursive) {
				$array[$key] = self::iterateArrayWrapStringValuesInQuotes($value);
			} elseif (is_string($value) OR is_numeric($value)) {
				$array[$key] = self::wrapStringInQuotes($value);
			}
		}
               
		return $array;
	}
    
	/**
	* 
	* Looks inside a string and checks if it STARTS with a substring. Works for case-sensitive and case-insensitive
	*
	* @param string $haystack. The string to be searched.
	* @param string $needle. The substring we are searching at the front
	* @param boolean $case. Set to true if case-sensitive search is required
	* @return boolean. Returns true if substring is at beginning of string
	*
	**/
	function startsWith($haystack,$needle,$case=true) {
		if($case){return (strcmp(substr($haystack, 0, strlen($needle)),$needle)===0);}
        return (strcasecmp(substr($haystack, 0, strlen($needle)),$needle)===0);
	}

	/**
	* 
	* Looks inside a string and checks if it ENDS with a substring. Works for case-sensitive and case-insensitive
	*
	* @param string $haystack. The string to be searched.
	* @param string $needle. The substring we are searching at the end.
	* @param boolean $case. Set to true if case-sensitive search is required
	* @return boolean. Returns true if substring is at beginning of string
	*
	**/
	function endsWith($haystack,$needle,$case=true) {
        if($case){return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
        return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
	}
}
?>