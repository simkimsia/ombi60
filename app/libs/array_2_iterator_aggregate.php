<?php

class Array2IteratorAggregate {
        function a2ia($array=array()) {
                $iaObject = new myData($array);
                return $iaObject;
        }
}

class myData implements IteratorAggregate {
    
        public $_array = array();
        private $_size = 0;
        private $_first = NULL;
        private $_last = NULL;

        // constructor
        public function __construct($array) {
                $this->_array = $array;
                $this->_size = count($array);
                $this->_first = array_shift($array);
                $this->_last = array_pop($array);
        }

        public function getIterator() {
                return new ArrayIterator($this->_array);
        }
        
        public function getSize() {
                return $this->_size;
        }
        
        public function getFirst() {
                return $this->_first;
        }
        
        public function getLast() {
                return $this->_last;
        }
}
?>