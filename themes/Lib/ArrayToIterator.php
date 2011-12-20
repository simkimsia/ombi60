<?php

class ArrayToIterator {
        public static function array2Iterator($array=array()) {
                $iterator = new IteratorForTwig($array);
                return $iterator;
        }
}

class IteratorForTwig extends ArrayObject {
        private $position       = 0;
        private $array          = array();
        // attributes specially added for Twig objects
        private $size           = 0;
        private $first          = NULL;
        private $last           = NULL;
        
        public function __construct($array) {
                
                parent::__construct($array);
                $this->position     = 0;
                $this->array        = $array;
                
                $this->size         = count($this->array);
                $this->first        = array_shift($array);
                $this->last         = array_pop($array);
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