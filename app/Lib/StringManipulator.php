<?php

class StringManipulator {
        function wrapStringInQuotes($input) {
                $noStartsWithQuote = !self::startsWith($input, "'");
                $noEndsWithQuote   = !self::endsWith($input, "'");
                
                if ($noStartsWithQuote AND $noEndsWithQuote) {
                        
                        return "'" . $input . "'";
                }
                return $input;
        }
        
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
        
        function startsWith($haystack,$needle,$case=true) {
                if($case){return (strcmp(substr($haystack, 0, strlen($needle)),$needle)===0);}
                return (strcasecmp(substr($haystack, 0, strlen($needle)),$needle)===0);
        }

        function endsWith($haystack,$needle,$case=true) {
                if($case){return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
                return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
        }
}
?>