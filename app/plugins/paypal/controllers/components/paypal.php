<?php
class PaypalComponent extends Object {
        
        var $components = array('Session');
        
        
        // just for s2s app because we need to handle multiple shops
        private function writeToSession ($shopId, $name, $value) {
                return $this->Session->write('Paypal.Shop'.$shopId.'.'.$name, $value);
        }
        
        private function readFromSession ($shopId, $name) {
                return $this->Session->read('Paypal.Shop'.$shopId.'.'.$name);
        }
        
        //called before Controller::beforeFilter()
        function initialize(&$controller, $settings = array()) {
                // saving the controller reference for later use
                $this->controller =& $controller;
        }
        
        
	/* An express checkout transaction starts with a token, that
	   identifies to PayPal your transaction
	   In this example, when the script sees a token, the script
	   knows that the buyer has already authorized payment through
	   paypal.  If no token was found, the action is to send the buyer
	   to PayPal to first authorize payment
	*/

	/*   
	'-------------------------------------------------------------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the SetExpressCheckout API Call.
	' Inputs:  
	'		paymentAmount:  	Total value of the shopping cart
	'		currencyCodeType: 	Currency code value the PayPal API
	'		paymentType: 		paymentType has to be one of the following values: Sale or Order or Authorization
	'		returnURL:			the page where buyers return to after they are done with the payment review on PayPal
	'		cancelURL:			the page where buyers return to when they cancel the payment review on PayPal
	'--------------------------------------------------------------------------------------------------------------------------------------------	
	*/
	function callShortcutExpressCheckout( $paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL) {
		//------------------------------------------------------------------------------------------------------------------------------------
		// Construct the parameter string that describes the SetExpressCheckout API call in the shortcut implementation
		
		$nvpstr="&Amt=". $paymentAmount;
		$nvpstr = $nvpstr . "&PAYMENTACTION=" . $paymentType;
		$nvpstr = $nvpstr . "&ReturnUrl=" . $returnURL;
		$nvpstr = $nvpstr . "&CANCELURL=" . $cancelURL;
		$nvpstr = $nvpstr . "&CURRENCYCODE=" . $currencyCodeType;
                
                // need to change this to suit app code handling multiple shops
		$shopId = Shop::get('Shop.id');
                $this->writeToSession($shopId, 'currencyCodeType', $currencyCodeType);
                $this->writeToSession($shopId, 'paymentType', $paymentType);
		


		//'--------------------------------------------------------------------------------------------------------------- 
		//' Make the API call to PayPal
		//' If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.  
		//' If an error occured, show the resulting errors
		//'---------------------------------------------------------------------------------------------------------------
	    $resArray=$this->hash_call("SetExpressCheckout", $nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{
			$token = urldecode($resArray["TOKEN"]);
                        $this->writeToSession($shopId, 'TOKEN', $token);
		}
		   
	    return $resArray;
	}

	/*   
	'-------------------------------------------------------------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the SetExpressCheckout API Call.
	' Inputs:  
	'		paymentAmount:  	Total value of the shopping cart
	'		currencyCodeType: 	Currency code value the PayPal API
	'		paymentType: 		paymentType has to be one of the following values: Sale or Order or Authorization
	'		returnURL:			the page where buyers return to after they are done with the payment review on PayPal
	'		cancelURL:			the page where buyers return to when they cancel the payment review on PayPal
	'		shipToName:		the Ship to name entered on the merchant's site
	'		shipToStreet:		the Ship to Street entered on the merchant's site
	'		shipToCity:			the Ship to City entered on the merchant's site
	'		shipToState:		the Ship to State entered on the merchant's site
	'		shipToCountryCode:	the Code for Ship to Country entered on the merchant's site
	'		shipToZip:			the Ship to ZipCode entered on the merchant's site
	'		shipToStreet2:		the Ship to Street2 entered on the merchant's site
	'		phoneNum:			the phoneNum  entered on the merchant's site
	'--------------------------------------------------------------------------------------------------------------------------------------------	
	*/
	function callMarkExpressCheckout($options) {
                /*
                $optionsNeeded = array('paymentAmount'=>'');
                $options = array_merge();
                need to look at optional and required options
                */
		//------------------------------------------------------------------------------------------------------------------------------------
		// Construct the parameter string that describes the SetExpressCheckout API call in the shortcut implementation
		
		$nvpstr="&Amt=". $options['paymentAmount'];
		$nvpstr = $nvpstr . "&PAYMENTACTION=" . $options['paymentType'];
		$nvpstr = $nvpstr . "&ReturnUrl=" . $options['returnURL'];
		$nvpstr = $nvpstr . "&CANCELURL=" . $options['cancelURL'];
		$nvpstr = $nvpstr . "&CURRENCYCODE=" . $options['currencyCodeType'];
		$nvpstr = $nvpstr . "&ADDROVERRIDE=1";
		$nvpstr = $nvpstr . "&SHIPTONAME=" . $options['shipToName'];
		$nvpstr = $nvpstr . "&SHIPTOSTREET=" . $options['shipToStreet'];
		$nvpstr = $nvpstr . "&SHIPTOSTREET2=" . $options['shipToStreet2'];
		$nvpstr = $nvpstr . "&SHIPTOCITY=" . $options['shipToCity'];
		$nvpstr = $nvpstr . "&SHIPTOSTATE=" . $options['shipToState'];
		$nvpstr = $nvpstr . "&SHIPTOCOUNTRYCODE=" . $options['shipToCountryCode'];
		$nvpstr = $nvpstr . "&SHIPTOZIP=" . $options['shipToZip'];
		$nvpstr = $nvpstr . "&PHONENUM=" . $options['phoneNum'];
                
                $shopId = Shop::get('Shop.id');
		
		$this->writeToSession($shopId, 'currencyCodeType',  $options['currencyCodeType']);
                $this->writeToSession($shopId, 'paymentType',  $options['paymentType']);	  
		

		//'--------------------------------------------------------------------------------------------------------------- 
		//' Make the API call to PayPal
		//' If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.  
		//' If an error occured, show the resulting errors
		//'---------------------------------------------------------------------------------------------------------------
	    $resArray=$this->hash_call("SetExpressCheckout", $nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{
			$token = urldecode($resArray["TOKEN"]);
			$this->writeToSession($shopId, 'TOKEN', $token);
		}
		   
	    return $resArray;
	}
	
	/*
	'-------------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the GetExpressCheckoutDetails API Call.
	'
	' Inputs:  
	'		None
	' Returns: 
	'		The NVP Collection object of the GetExpressCheckoutDetails Call Response.
	'-------------------------------------------------------------------------------------------
	*/
	function getShippingDetails( $token )
	{
                $shopId = Shop::get('Shop.id');
                
		//'--------------------------------------------------------------
		//' At this point, the buyer has completed authorizing the payment
		//' at PayPal.  The function will call PayPal to obtain the details
		//' of the authorization, incuding any shipping information of the
		//' buyer.  Remember, the authorization is not a completed transaction
		//' at this state - the buyer still needs an additional step to finalize
		//' the transaction
		//'--------------------------------------------------------------
	   
	    //'---------------------------------------------------------------------------
		//' Build a second API request to PayPal, using the token as the
		//'  ID to get the details on the payment authorization
		//'---------------------------------------------------------------------------
	    $nvpstr="&TOKEN=" . $token;

		//'---------------------------------------------------------------------------
		//' Make the API call and store the results in an array.  
		//'	If the call was a success, show the authorization details, and provide
		//' 	an action to complete the payment.  
		//'	If failed, show the error
		//'---------------------------------------------------------------------------
	    $resArray=$this->hash_call("GetExpressCheckoutDetails",$nvpstr);
	    $ack = strtoupper($resArray["ACK"]);
		if($ack == "SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{
                        $this->writeToSession($shopId, 'payer_id', $resArray['PAYERID']);
		} 
		return $resArray;
	}
	
	/*
	'-------------------------------------------------------------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the GetExpressCheckoutDetails API Call.
	'
	' Inputs:  
	'		sBNCode:	The BN code used by PayPal to track the transactions from a given shopping cart.
	' Returns: 
	'		The NVP Collection object of the GetExpressCheckoutDetails Call Response.
	'--------------------------------------------------------------------------------------------------------------------------------------------	
	*/
	function confirmPayment( $FinalPaymentAmt )
	{
		/* Gather the information to make the final call to
		   finalize the PayPal payment.  The variable nvpstr
		   holds the name value pairs
		   */
		
                $shopId = Shop::get('Shop.id');

		//Format the other parameters that were stored in the session from the previous calls	
		$token 				= urlencode($this->readFromSession($shopId, 'TOKEN'));
		$paymentType 		= urlencode($this->readFromSession($shopId, 'paymentType'));
		$currencyCodeType 	= urlencode($this->readFromSession($shopId, 'currencyCodeType'));
		$payerID 			= urlencode($this->readFromSession($shopId, 'payer_id'));

		$serverName 		= urlencode($_SERVER['SERVER_NAME']);

		$nvpstr  = '&TOKEN=' . $token . '&PAYERID=' . $payerID . '&PAYMENTACTION=' . $paymentType . '&AMT=' . $FinalPaymentAmt;
		$nvpstr .= '&CURRENCYCODE=' . $currencyCodeType . '&IPADDRESS=' . $serverName; 

		 /* Make the call to PayPal to finalize payment
		    If an error occured, show the resulting errors
		    */
		$resArray=$this->hash_call("DoExpressCheckoutPayment",$nvpstr);

		/* Display the API response back to the browser.
		   If the response from PayPal was a success, display the response parameters'
		   If the response was an error, display the errors received using APIError.php.
		   */
		$ack = strtoupper($resArray["ACK"]);

		return $resArray;
	}
	
	/*
	'-------------------------------------------------------------------------------------------------------------------------------------------
	' Purpose: 	This function makes a DoDirectPayment API call
	'
	' Inputs:  
	'		paymentType:		paymentType has to be one of the following values: Sale or Order or Authorization
	'		paymentAmount:  	total value of the shopping cart
	'		currencyCode:	 	currency code value the PayPal API
	'		firstName:			first name as it appears on credit card
	'		lastName:			last name as it appears on credit card
	'		street:				buyer's street address line as it appears on credit card
	'		city:				buyer's city
	'		state:				buyer's state
	'		countryCode:		buyer's country code
	'		zip:				buyer's zip
	'		creditCardType:		buyer's credit card type (i.e. Visa, MasterCard ... )
	'		creditCardNumber:	buyers credit card number without any spaces, dashes or any other characters
	'		expDate:			credit card expiration date
	'		cvv2:				Card Verification Value 
	'		
	'-------------------------------------------------------------------------------------------
	'		
	' Returns: 
	'		The NVP Collection object of the DoDirectPayment Call Response.
	'--------------------------------------------------------------------------------------------------------------------------------------------	
	*/


	function directPayment( $paymentType, $paymentAmount, $creditCardType, $creditCardNumber,
							$expDate, $cvv2, $firstName, $lastName, $street, $city, $state, $zip, 
							$countryCode, $currencyCode )
	{
		//Construct the parameter string that describes DoDirectPayment
		$nvpstr = "&AMT=" . $paymentAmount;
		$nvpstr = $nvpstr . "&CURRENCYCODE=" . $currencyCode;
		$nvpstr = $nvpstr . "&PAYMENTACTION=" . $paymentType;
		$nvpstr = $nvpstr . "&CREDITCARDTYPE=" . $creditCardType;
		$nvpstr = $nvpstr . "&ACCT=" . $creditCardNumber;
		$nvpstr = $nvpstr . "&EXPDATE=" . $expDate;
		$nvpstr = $nvpstr . "&CVV2=" . $cvv2;
		$nvpstr = $nvpstr . "&FIRSTNAME=" . $firstName;
		$nvpstr = $nvpstr . "&LASTNAME=" . $lastName;
		$nvpstr = $nvpstr . "&STREET=" . $street;
		$nvpstr = $nvpstr . "&CITY=" . $city;
		$nvpstr = $nvpstr . "&STATE=" . $state;
		$nvpstr = $nvpstr . "&COUNTRYCODE=" . $countryCode;
		$nvpstr = $nvpstr . "&IPADDRESS=" . $_SERVER['REMOTE_ADDR'];

		$resArray=$this->hash_call("DoDirectPayment", $nvpstr);

		return $resArray;
	}


	/**
	  '-------------------------------------------------------------------------------------------------------------------------------------------
	  * hash_call: Function to perform the API call to PayPal using API signature
	  * @methodName is name of API  method.
	  * @nvpStr is nvp string.
	  * returns an associtive array containing the response from the server.
	  '-------------------------------------------------------------------------------------------------------------------------------------------
	*/
	function hash_call($methodName,$nvpStr) {
                
		//declaring of global variables
		$API_Endpoint   = Configure::read('paypal.ApiEndpoint');
                $version        = Configure::read('paypal.Version');
                $API_UserName   = Configure::read('paypal.ApiUsername');
                $API_Password   = Configure::read('paypal.ApiPassword');
                $API_Signature  = Configure::read('paypal.ApiSignature');
                $USE_PROXY      = Configure::read('paypal.UseProxy');
                $PROXY_HOST     = Configure::read('paypal.ProxyHost');
                $PROXY_PORT     = Configure::read('paypal.ProxyPort');
		$sBNCode        = Configure::read('paypal.sBNCode');
                
                // get shop id
                $shopId = Shop::get('Shop.id');

		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
                //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
                //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		if($USE_PROXY)
			curl_setopt ($ch, CURLOPT_PROXY, $PROXY_HOST. ":" . $PROXY_PORT); 

		//NVPRequest for submitting to server
		$nvpreq="METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode($version) . "&PWD=" . urlencode($API_Password) . "&USER=" . urlencode($API_UserName) . "&SIGNATURE=" . urlencode($API_Signature) . $nvpStr . "&BUTTONSOURCE=" . urlencode($sBNCode);

		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		//getting response from server
		$response = curl_exec($ch);

		//convrting NVPResponse to an Associative Array
		$nvpResArray=$this->deformatNVP($response);
		$nvpReqArray=$this->deformatNVP($nvpreq);
		$this->writeToSession($shopId, 'nvpReqArray', $nvpReqArray);

		if (curl_errno($ch)) {
			// moving to display page to display curl errors
                        $this->writeToSession($shopId, 'curl_error_no', curl_errno($ch));
                        $this->writeToSession($shopId, 'curl_error_msg', curl_error($ch));
			
			//Execute the Error handling module to display errors. 
		} else {
			 //closing the curl
		  	curl_close($ch);
		}

		return $nvpResArray;
	}

	/*'----------------------------------------------------------------------------------
	 Purpose: Redirects to PayPal.com site.
	 Inputs:  NVP string.
	 Returns: 
	----------------------------------------------------------------------------------
	*/
	function redirectToPayPal ( $token ) {       
		$PAYPAL_URL = Configure::read('paypal.Url');
		
		// Redirect to paypal.com here
		$payPalURL = $PAYPAL_URL . $token;
                return $this->controller->redirect($payPalURL);
	}

	
	/*'----------------------------------------------------------------------------------
	 * This function will take NVPString and convert it to an Associative Array and it will decode the response.
	  * It is usefull to search for a particular key and displaying arrays.
	  * @nvpstr is NVPString.
	  * @nvpArray is Associative Array.
	   ----------------------------------------------------------------------------------
	  */
	function deformatNVP($nvpstr)
	{
		$intial=0;
	 	$nvpArray = array();

		while(strlen($nvpstr))
		{
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
                }
		return $nvpArray;
	}
        
        // this below is for angelleye code basically for building arrays for parameters used
        function buildSECFields($options = array()) {
                $domain = '';
                // default values in SetExpressCheckout
                $SECFields = array(
                        'token' => '', 								// A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
                        'maxamt' => '200.00', 						// The expected maximum total amount the order will be, including S&H and sales tax.
                        'returnurl' => $domain . 'paypal/class/DoExpressCheckoutPayment.php', 							// Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
                        'cancelurl' => $domain . 'paypal/class/cancel.php', 							// Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
                        'callback' => '', 							// URL to which the callback request from PayPal is sent.  Must start with https:// for production.
                        'callbacktimeout' => '', 					// An override for you to request more or less time to be able to process the callback request and response.  Acceptable range for override is 1-6 seconds.  If you specify greater than 6 PayPal will use default value of 3 seconds.
                        'callbackversion' => '', 					// The version of the Instant Update API you're using.  The default is the current version.							
                        'reqconfirmshipping' => '', 				// The value 1 indicates that you require that the customer's shipping address is Confirmed with PayPal.  This overrides anything in the account profile.  Possible values are 1 or 0.
                        'noshipping' => '', 						// The value 1 indiciates that on the PayPal pages, no shipping address fields should be displayed.  Maybe 1 or 0.
                        'allownote' => '1', 							// The value 1 indiciates that the customer may enter a note to the merchant on the PayPal page during checkout.  The note is returned in the GetExpresscheckoutDetails response and the DoExpressCheckoutPayment response.  Must be 1 or 0.
                        'addroverride' => '', 						// The value 1 indiciates that the PayPal pages should display the shipping address set by you in the SetExpressCheckout request, not the shipping address on file with PayPal.  This does not allow the customer to edit the address here.  Must be 1 or 0.
                        'localecode' => '', 						// Locale of pages displayed by PayPal during checkout.  Should be a 2 character country code.  You can retrive the country code by passing the country name into the class' GetCountryCode() function.
                        'pagestyle' => '', 							// Sets the Custom Payment Page Style for payment pages associated with this button/link.  
                        'hdrimg' => $domain . 'images/hdrimg.jpg', 							// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
                        'hdrbordercolor' => '', 					// Sets the border color around the header of the payment page.  The border is a 2-pixel permiter around the header space.  Default is black.  
                        'hdrbackcolor' => '', 						// Sets the background color for the header of the payment page.  Default is white.  
                        'payflowcolor' => '', 						// Sets the background color for the payment page.  Default is white.
                        'skipdetails' => '0', 						// This is a custom field not included in the PayPal documentation.  It's used to specify whether you want to skip the GetExpressCheckoutDetails part of checkout or not.  See PayPal docs for more info.
                        'email' => '', 								// Email address of the buyer as entered during checkout.  PayPal uses this value to pre-fill the PayPal sign-in page.  127 char max.
                        'solutiontype' => 'Mark', 						// Type of checkout flow.  Must be Sole (express checkout for auctions) or Mark (normal express checkout)
                        'landingpage' => 'Billing', 						// Type of PayPal page to display.  Can be Billing or Login.  If billing it shows a full credit card form.  If Login it just shows the login screen.
                        'channeltype' => '', 						// Type of channel.  Must be Merchant (non-auction seller) or eBayItem (eBay auction)
                        'giropaysuccessurl' => '', 					// The URL on the merchant site to redirect to after a successful giropay payment.  Only use this field if you are using giropay or bank transfer payment methods in Germany.
                        'giropaycancelurl' => '', 					// The URL on the merchant site to redirect to after a canceled giropay payment.  Only use this field if you are using giropay or bank transfer methods in Germany.
                        'banktxnpendingurl' => '',  				// The URL on the merchant site to transfer to after a bank transfter payment.  Use this field only if you are using giropay or bank transfer methods in Germany.
                        'brandname' => 'Angell EYE', 							// A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
                        'customerservicenumber' => '555-555-5555', 				// Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
                        'giftmessageenable' => '1', 					// Enable gift message widget on the PayPal Review page. Allowable values are 0 and 1
                        'giftreceiptenable' => '1', 					// Enable gift receipt widget on the PayPal Review page. Allowable values are 0 and 1
                        'giftwrapenable' => '1', 					// Enable gift wrap widget on the PayPal Review page.  Allowable values are 0 and 1.
                        'giftwrapname' => 'Box with Ribbon', 						// Label for the gift wrap option such as "Box with ribbon".  25 char max.
                        'giftwrapamount' => '2.50', 					// Amount charged for gift-wrap service.
                        'buyeremailoptionenable' => '1', 			// Enable buyer email opt-in on the PayPal Review page. Allowable values are 0 and 1
                        'surveyquestion' => 'Did you like this checkout?', 					// Text for the survey question on the PayPal Review page. If the survey question is present, at least 2 survey answer options need to be present.  50 char max.
                        'surveyenable' => '0', 						// Enable survey functionality. Allowable values are 0 and 1
                        'buyerid' => '', 							// The unique identifier provided by eBay for this buyer. The value may or may not be the same as the username. In the case of eBay, it is different. 255 char max.
                        'buyerusername' => '', 						// The user name of the user at the marketplaces site.
                        'buyerregistrationdate' => '',  			// Date when the user registered with the marketplace.
                        'allowpushfunding' => ''					// Whether the merchant can accept push funding.  0 = Merchant can accept push funding : 1 = Merchant cannot accept push funding.			
                );
                return array_merge($SECFields, $options);
        }
        
        function buildSurveyChoices($options = array())  {
                // Basic array of survey choices.  Nothing but the values should go in here.  
                $SurveyChoices = array('Yes', 'No');
                
                return array_merge($SurveyChoices, $options);
        }
        
        function buildPayment ($options = array()) {
                $Payment = array(
                        'amt' => '100.00', 							// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                        'currencycode' => 'USD', 					// A three-character currency code.  Default is USD.
                        'itemamt' => '80.00', 						// Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.  
                        'shippingamt' => '15.00', 					// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
                        'insuranceoptionoffered' => '', 		// If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
                        'handlingamt' => '', 					// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
                        'taxamt' => '5.00', 						// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order. 
                        'desc' => 'This is a test order.', 							// Description of items on the order.  127 char max.
                        'custom' => '', 						// Free-form field for your own use.  256 char max.
                        'invnum' => '', 						// Your own invoice or tracking number.  127 char max.
                        'notifyurl' => '',  						// URL for receiving Instant Payment Notifications
                        'shiptoname' => '', 					// Required if shipping is included.  Person's name associated with this address.  32 char max.
                        'shiptostreet' => '', 					// Required if shipping is included.  First street address.  100 char max.
                        'shiptostreet2' => '', 					// Second street address.  100 char max.
                        'shiptocity' => '', 					// Required if shipping is included.  Name of city.  40 char max.
                        'shiptostate' => '', 					// Required if shipping is included.  Name of state or province.  40 char max.
                        'shiptozip' => '', 						// Required if shipping is included.  Postal code of shipping address.  20 char max.
                        'shiptocountry' => '', 					// Required if shipping is included.  Country code of shipping address.  2 char max.
                        'shiptophonenum' => '',  				// Phone number for shipping address.  20 char max.
                        'notetext' => 'This is a test note before ever having left the web site.', 						// Note to the merchant.  255 char max.  
                        'allowedpaymentmethod' => '', 			// The payment method type.  Specify the value InstantPaymentOnly.
                        'paymentaction' => 'Sale', 					// How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order. 
                        'paymentrequestid' => '',  				// A unique identifier of the specific payment request, which is required for parallel payments. 
                        'sellerpaypalaccountid' => ''			// A unique identifier for the merchant.  For parallel payments, this field is required and must contain the Payer ID or the email address of the merchant.
                );
                
                return array_merge($Payment, $options);

        }
        
        function buildItem ($options = array()) {
                $Item = array(
			'name' => 'Widget 123', 							// Item name. 127 char max.
			'desc' => 'Widget 123', 							// Item description. 127 char max.
			'amt' => '40.00', 								// Cost of item.
			'number' => '123', 							// Item number.  127 char max.
			'qty' => '1', 								// Item qty on order.  Any positive integer.
			'taxamt' => '', 							// Item sales tax
			'itemurl' => 'http://www.angelleye.com/products/123.php', 							// URL for the item.
			'itemweightvalue' => '', 					// The weight value of the item.
			'itemweightunit' => '', 					// The weight unit of the item.
			'itemheightvalue' => '', 					// The height value of the item.
			'itemheightunit' => '', 					// The height unit of the item.
			'itemwidthvalue' => '', 					// The width value of the item.
			'itemwidthunit' => '', 					// The width unit of the item.
			'itemlengthvalue' => '', 					// The length value of the item.
			'itemlengthunit' => '',  					// The length unit of the item.
			'ebayitemnumber' => '', 					// Auction item number.  
			'ebayitemauctiontxnid' => '', 			// Auction transaction ID number.  
			'ebayitemorderid' => '',  				// Auction order ID number.
			'ebayitemcartid' => ''					// The unique identifier provided by eBay for this order from the buyer. These parameters must be ordered sequentially beginning with 0 (for example L_EBAYITEMCARTID0, L_EBAYITEMCARTID1). Character length: 255 single-byte characters
		);

                
                return array_merge($Item, $options);
        }
        
        function buildEbayBuyerDetails ($options = array()) {
                $BuyerDetails = array(
                        'buyerid' => '', 				// The unique identifier provided by eBay for this buyer.  The value may or may not be the same as the username.  In the case of eBay, it is different.  Char max 255.
                        'buyerusername' => '', 			// The username of the marketplace site.
                        'buyerregistrationdate' => ''	// The registration of the buyer with the marketplace.
                );

                return array_merge($BuyerDetails, $options);
        }
        
        function buildShippingOption ($options = array()) {
                $Option = array(
                        'l_shippingoptionisdefault' => '', 				// Shipping option.  Required if specifying the Callback URL.  true or false.  Must be only 1 default!
                        'l_shippingoptionname' => '', 					// Shipping option name.  Required if specifying the Callback URL.  50 character max.
                        'l_shippingoptionlabel' => '', 					// Shipping option label.  Required if specifying the Callback URL.  50 character max.
                        'l_shippingoptionamount' => '' 					// Shipping option amount.  Required if specifying the Callback URL.  
		);
                
                return array_merge($Option, $options);
        }
        

}
?>