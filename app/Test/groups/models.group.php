<?php

class ModelGroupTest extends TestSuite {
        var $label = 'Relevant models';
        function modelGroupTest() {
                // this is to add all files from a folder
                //TestManager::addTestCasesFromDirectory($this, APP_TEST_CASES . DS . 'models');
                // this is to add individual files
                TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'merchant.test.php');
                TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'product.test.php');
                TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'order.test.php');
        }
} 

?>