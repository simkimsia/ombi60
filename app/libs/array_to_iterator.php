<?php

class ArrayToIterator {
        function array2Iterator($array=array()) {
                $iterator = new myIterator($array);
                return $iterator;
        }
}

class myIterator implements Iterator {
        private $position       = 0;
        private $array          = array();
        // attributes specially added for Twig objects
        private $size           = 0;
        private $first          = NULL;
        private $last           = NULL;
        
        public function __construct($array) {
                $this->position     = 0;
                $this->array        = $array;
                
                $this->size         = count($this->array);
                $this->first        = array_shift($array);
                $this->last         = array_pop($array);
        }
        
        function rewind() {
            
                $this->position = 0;
        }
        
        function current() {
                return $this->array[$this->position];
        }
        
        function key() {
            
                return $this->position;
        }
        
        function next() {
                
                ++$this->position;
        }
        
        function valid() {
            
                return isset($this->array[$this->position]);
        }
        
        // special get Accessors for Size, First, Last
        function getSize() {
                return $this->size;
        }
        
        function getFirst() {
                return $this->first;
        }
        
        function getLast() {
                return $this->last;
        }
}
?>