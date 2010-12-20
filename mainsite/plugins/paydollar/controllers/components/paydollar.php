<?php

// this code is to build data arrays for the vendor paypal class from angelleye
// data arrays for payment, secfields, item, surveychoices, ebaybuyerdetails, shippingoption

class PaydollarComponent extends Object {
        
        var $components = array('Session');
        
        
        // just for s2s app because we need to handle multiple shops
        private function writeToSession ($shopId, $name, $value) {
                return $this->Session->write('Paydollar.Shop'.$shopId.'.'.$name, $value);
        }
        
        private function readFromSession ($shopId, $name) {
                return $this->Session->read('Paydollar.Shop'.$shopId.'.'.$name);
        }
        
        //called before Controller::beforeFilter()
        function initialize(&$controller, $settings = array()) {
                // saving the controller reference for later use
                $this->controller =& $controller;
        }
        
        
        // this below is for angelleye code basically for building arrays for parameters used
        // build AddSchPay function required dataarray
        function buildASPFields($options = array()) {
                $domain = '';
                
                $ASPFields = array(
                    'sDay' => '9', // Required, start day of month
                    'sMonth' => '12', // Required, start month
                    'sYear' => '2010', // Required, start year
                    'eDay' => '9', // Required, start day of month
                    'eMonth' => '12', // Required, start month
                    'eYear' => '2010', // Required, start year
                    'orderRef' => 'test', // Required, invoice number reference Text(35)
                    
                    'amount' => '19.90',  // Required, total amount to be charged Number(12,2)
                    'name' => 'OMBI60: BASIC plan', // Required , name of schedule payment
                    'email' => 'tester@gmail.com', // Required, email of schedule payment
                    'orderAcct' => '4918914107195005', // order acct of schedule payment
                    'pMethod' => 'VISA',  // Required, refers to card. possible values are (VISA, Master, Diners, JCB, AMEX)
                    'epMonth' => '07',  // Required, expiry of card month must be leading zero Number(2)
                    'epYear' => '2015', 	// Required, expiry of card year must be in YYYY format Number(4)
                    'holderName' => 'Tester Testerson', // Required full name of card holder
                    'mSchPayId' => '', // optional, Master Schedule Id of anotherSchedulePay record. If this parameteris provided, the following informationwill be retrieved from previous record,pMethod,orderAcct,holderName,epMonth,epYear
                    'payRef' => '', //optional, Payment reference of anothertransaction record. If this parameter isprovided, the following information willbe retrieved from previous record,pMethod, orderAcct, holderName, epMonth, epYear
                    'status' => 'Active', // status of schedule payment (Active, Suspend)
                    'nSch' => '1', // number of Sch type
                    'schType' => 'Month', // The schedule type of schedulepayment (e.g. Day,Month,Year)
                    'payType' => 'N', // Required N for Normal Sales, H for Hold Payment (Authorize only)
                    'remark' => '', // optional 

		    );
                return array_merge($ASPFields, $options);
        }
        
        function buildDPFields($options = array()) {
                $DPFields = array(
                    'orderRef' => 'test', // Required, invoice number reference Text(35)
                    'amount' => '19.90',  // Required, total amount to be charged Number(12,2)
                    'currCode' => '702', // Required, the number code for the currency. Text(3)
                    'lang' => 'E', // Required, language code Text(1)
                    'pMethod' => 'VISA',  // Required, refers to card. possible values are (VISA, Master, Diners, JCB, AMEX)
                    'epMonth' => '07',  // Required, expiry of card month must be leading zero Number(2)
                    'epYear' => '2015', 	// Required, expiry of card year must be in YYYY format Number(4)
                    
                    'cardNo' => '4918914107195005', // Required, 16 digit card number no dashes Text(16)
                    'cardHolder' => 'Tester Testerson', // Required full name of card holder
                    'securityCode' => '123', // Required CVV2  basically. Text(4)
                    'payType' => 'N', // Required N for Normal Sales, H for Hold Payment (Authorize only)
                    'remark' => '', // optional 
		    );
                
                return array_merge($DPFields, $options);
        }
        
        function buildDSPFields($options = array()) {
                $DSPFields = array(
                    'mSchPayId' => '10553', // Required, the master schedule payment id
                    
		);
                
                return array_merge($DSPFields, $options);
        }
        
}
?>