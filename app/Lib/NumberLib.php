<?php

class NumberLib {
        function precision($val, $precision = 3) {
			return number_format($val, $precision, '.', '');
        }
        
}
?>