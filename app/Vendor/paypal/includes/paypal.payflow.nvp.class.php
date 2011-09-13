<?php
class PayFlowSession
{

	var $Sandbox = "";
	var $Verbosity = "";
	var $APIUsername = "";
	var $APIVendor = "";
	var $APIPartner = "";
	var $APIPassword = "";
	var $APIEndPoint = "";
	var $NVPCredentials = "";
	
	function PayFlowSession($DataArray)
	{
		
		$this -> Sandbox = isset($DataArray['Sandbox']) ? $DataArray['Sandbox'] : true;
		$this -> Verbosity = isset($DataArray['VERBOSITY']) ? $DataArray['VERBOSITY'] : '';  		// Enables you to botain additional processor info for a transaction.  Values are LOW (normalized values) or MEDIUM (raw response values)
		$this -> APIUsername = 'tester';
		$this -> APIVendor = 'angelleye';
		$this -> APIPartner = 'PayPal';
		$this -> APIPassword = 'passw0rd';
		
		if($this -> Sandbox)
			$this -> APIEndPoint = 'https://pilot-payflowpro.paypal.com';
		else
			$this -> APIEndPoint = 'https://payflowpro.paypal.com';
			
		$this -> NVPCredentials = 'USER=' . $this -> APIUsername . '&VENDOR=' . $this -> APIVendor . '&PARTNER=' . $this -> APIPartner . '&PWD=' . $this -> APIPassword;
		
		$this -> TransactionStateCodes = array(
												'1' => 'Error', 
												'6' => 'Settlement Pending', 
												'7' => 'Settlement in Progress', 
												'8' => 'Settlement Completed Successfully', 
												'11' => 'Settlement Failed', 
												'14' => 'Settlement Incomplete'
											);
	
	} // End function PayFlowSession()
	
	
	function GetTransactionStateCodeMessage($Code)
	{
		return $this -> TransactionStateCodes[$Code];
	}
	
	function CURLRequest($Request)
	{
	
		$unique_id = date('ymd-H').rand(1000,9999);
		
		$headers[] = "Content-Type: text/namevalue"; //or text/xml if using XMLPay.
		$headers[] = "Content-Length : " . strlen ($Request);  // Length of data to be passed 
		$headers[] = "X-VPS-Timeout: 45";
		$headers[] = "X-VPS-Request-ID:" . $unique_id;
		
		$curl = curl_init();
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($curl, CURLOPT_HEADER, 1);
				curl_setopt($curl, CURLOPT_VERBOSE, 1);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
				curl_setopt($curl, CURLOPT_TIMEOUT, 90);
				curl_setopt($curl, CURLOPT_URL, $this -> APIEndPoint);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $Request);
		
		// Try to submit the transaction up to 3 times with 5 second delay.  This can be used
		// in case of network issues.  The idea here is since you are posting via HTTPS there
		// could be general network issues, so try a few times before you tell customer there
		// is an issue.
		$i=1;
		while ($i++ <= 3) 
		{
			$Response = curl_exec($curl);
			$headers = curl_getinfo($curl);
			
			if ($headers['http_code'] != 200) {
				sleep(5);  // Let's wait 5 seconds to see if its a temporary network issue.
			}
			else if ($headers['http_code'] == 200) 
			{
					// we got a good response, drop out of loop.
					break;
			}
		}
				
		curl_close($curl);
		
		return $Response;
		
	} //End CURLRequest function
	
	
	function NVPToArray($NVPString)
	{
			
		// prepare responses into array
		$proArray = array();
		while(strlen($NVPString))
		{
			// name
			$keypos= strpos($NVPString,'=');
			$keyval = substr($NVPString,0,$keypos);
			// value
			$valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
			$valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
			// decoding the respose
			$proArray[$keyval] = $valval;
			$NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
		}
		
		return $proArray;
		
	}
	
	
	function DoAuthorization($DataArray)
	{
	
		/*
	
		$DAFields = array(
							'AMT' => '', 								// Required.  Amount (US Dollars) of the transaction.  No comma separators. 
							'AUTHCODE' => '', 							// Required if using voice authorization.  AUTHCODE is the approval code obtained over the phone from the processing network. 
							'CURRENCY' => '', 							// One of the following three-character currency codes:  USD (US dollar), EUR (Euro), GBP (UK pound), CAD (Canadian dollar), JPY (Japanense Yen), AUD (Austrailian dollar)
							'COMMENT1' => '', 							// Merchant-defined value for reporting and auditing purposes.  128 char max.
							'COMMENT2' => '', 							// Merchant-defined value for reporting and auditing purposes.  128 char max.
							'CUSTREF' => '', 							// Custom reference ID field.  typically used to hold an invoice number.  Can be used with an Inquiry transaction to get data.
							'ENDTIME' => '', 							// For inquiry transactions when using CUSTREF to specify the transaction.  Must be less than 30 days after STARTTIME.
							'STARTTIME' => '', 							// For inquiry transactions when using CUSTREF to specify the transaction. 
							'ORIGID' => '' 								// The ID of the original transaction that is being referenced.  This is the PNREF returned when you do other transactions. 
							);
		
		$CCDetails = array(
								'ACCT' => '', 							// Required.  Credit card number.  No spaces or non-numeric characters.  For pinless debit TENDER type, ACCT can be the bank account number.
								'EXPDATE' => '',  						// Required.  Expiration date of the credit card.  MMYY. 
								'CVV2' => '', 							// Requirement depends on PayFlow manager settings.  Credit card security digits. 
								'NAME' => '', 							// Account holder's name.  Whole name is sent in this one field.  
								'SWIPE' => '' 							// Used to pass Track 1 or Track 2 credit card swipe data.  
							);
							
		$BillingAddress = array(
								'STREET' => '', 						// Cardholder's street address (number and name). 
								'ZIP' => ''								// Cardholder's postal code.  No spaces, dashes, or non-numeric characters.   
								);
								
		*/
	
		$DAFieldsNVP = '&TENDER=C&TRXTYPE=A';
		$CCDetailsNVP = '';
		$BillingAddressNVP = '';
		
		// DP Fields
		$DAFields = isset($DataArray['DAFields']) ? $DataArray['DAFields'] : array();
		foreach($DAFields as $DAFieldsVar => $DAFieldsVal)
			$DAFieldsNVP .= '&' . strtoupper($DAFieldsVar) . '=' . $DAFieldsVar;
			
		// CC Details
		$CCDetails = isset($DataArray['CCDetails']) ? $DataArray['CCDetails'] : array();
		foreach($CCDetails as $CCDetailsVar => $CCDetailsVal)
			$CCDetailsNVP .= '&' . strtoupper($CCDetailsVar) . '=' . $CCDetailsVal;
			
		$NVPRequest = $this -> NVPCredentials . $DAFieldsNVP . $CCDetailsNVP . $BillingAddressNVP;
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPResponse = strstr($NVPResponse, "RESULT");
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
		
		return $NVPResponseArray;
		
	
	} // End function DoAuthorization()
	
	
	
	function DoCapture($DataArray)
	{
	
		$DCFieldsNVP = '&TENDER=C&TRXTYPE=D';
		
		// DC Fields
		$DCFields = isset($DataArray['DCFields']) ? $DataArray['DCFields'] : array();
		foreach($DCFields as $DCFieldsVar => $DCFieldsVal)
			$DCFieldsNVP .= '&' . strtoupper($DCFieldsVar) . '=' . $DCFieldsVal;
			
		$NVPRequest = $this -> NVPCredentials . $DCFieldsNVP;
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPResponse = strstr($NVPResponse, "RESULT");
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
		
		return $NVPResponseArray;
		
	
	} // End function DoCapture()
	
	
	function DoDirectPayment($DataArray)
	{
	
		$DDPFieldsNVP = '&TENDER=C&TRXTYPE=S';
		$CCDetailsNVP = '';
	
		// DDP Fields
		$DDPFields = isset($DataArray['DDPFields']) ? $DataArray['DDPFields'] : array();
		foreach($DDPFields as $DDPFieldsVar => $DDPFieldsVal)
			$DDPFieldsNVP .= '&' . strtoupper($DDPFieldsVar) . '=' . $DDPFieldsVal;
			
		// CC Details
		$CCDetails = isset($DataArray['CCDetails']) ? $DataArray['CCDetails'] : array();
		foreach($CCDetails as $CCDetailsVar => $CCDetailsVal)
			$CCDetailsNVP .= '&' . strtoupper($CCDetailsVar) . '=' . $CCDetailsVal;
			
		$NVPRequest = $this -> NVPCredentials . $DDPFieldsNVP;
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPResponse = strstr($NVPResponse, "RESULT");
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
		
		return $NVPResponseArray;
		
	
	} // End function DoDirectPayment()
	
	
	function DoVoid($DataArray)
	{
	
		$DVFieldsNVP = '&TENDER=C&TRXTYPE=V';
		
		// DV Fields
		$DVFields = isset($DataArray['DVFields']) ? $DataArray['DVFields'] : array();
		foreach($DVFields as $DVFieldsVar => $DVFieldsVal)
			$DVFieldsNVP .= '&' . strtoupper($DVFieldsVar) . '=' . $DVFieldsVal;
			
		$NVPRequest = $this -> NVPCredentials . $DVFieldsNVP;
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPResponse = strstr($NVPResponse, "RESULT");
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
		
		return $NVPResponseArray;
		
	
	} // End function DoVoid()
	
	
	function DoInquiry($DataArray)
	{
	
		$DIFieldsNVP = '&TENDER=C&TRXTYPE=I';
		
		// DI Fields
		$DIFields = isset($DataArray['DIFields']) ? $DataArray['DIFields'] : array();
		foreach($DIFields as $DIFieldsVar => $DIFieldsVal)
			$DIFieldsNVP .= '&' . strtoupper($DIFieldsVar) . '=' . $DIFieldsVal;
			
		$NVPRequest = $this -> NVPCredentials . $DIFieldsNVP;
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPResponse = strstr($NVPResponse, "RESULT");
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
		
		return $NVPResponseArray;
		
	
	} // End function DoInquiry()
	
	
	function DoCredit($DataArray)
	{
	
		$DCFieldsNVP = '&TENDER=C&TRXTYPE=C';
		
		// DC Fields
		$DCFields = isset($DataArray['DCFields']) ? $DataArray['DCFields'] : array();
		foreach($DCFields as $DCFieldsVar => $DCFieldsVal)
			$DCFieldsNVP .= '&' . strtoupper($DCFieldsVar) . '=' . $DCFieldsVal;
			
		$NVPRequest = $this -> NVPCredentials . $DCFieldsNVP;
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPResponse = strstr($NVPResponse, "RESULT");
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
		
		return $NVPResponseArray;
		
	
	} // End function DoCredit()
	
	
	function CreateNewRecurringPaymentsProfile($DataArray)
	{
		
		$CNRPPFieldsNVP = '';
		
		// CNRPP Fields
		$CNRPPFields = isset($DataArray['CNRPPFields']) ? $DataArray['CNRPPFields'] : array();
		foreach($CNRPPFields as $CNRPPFieldsVar => $CNRPPFieldsVal)
			$CNRPPFieldsNVP .= '&' . strtoupper($CNRPPFieldsVar) . '=' . $CNRPPFieldsVal;
		
		$NVPRequest = $this -> NVPCredentials . $CNRPPFieldsNVP;
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPResponse = strstr($NVPResponse, "RESULT");
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
		
		return $NVPResponseArray;
		
	
	} // End function CreateNewRecurringPaymentProfile()
	
	
	function GetProfileDetails($DataArray)
	{
	
		$GPDFieldsNVP = '';
		
		// GPD Fields
		$GPDFields = isset($DataArray['GPDFields']) ? $DataArray['GPDFields'] : array();
		foreach($GPDFields as $GPDFieldsVar => $GPDFieldsVal)
			$GPDFieldsNVP .= '&' . strtoupper($GPDFieldsVar) . '=' . $GPDFieldsVal;
		
		$NVPRequest = $this -> NVPCredentials . $GPDFieldsNVP;
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPResponse = strstr($NVPResponse, "RESULT");
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$PaymentHistory = array();
		$n = 1;
		while(isset($NVPResponseArray['P_PNREF' . $n . '']))
		{
			$RefNumber = isset($NVPResponseArray['P_PNREF' . $n . '']) ? $NVPResponseArray['P_PNREF' . $n . ''] : '';
			$TransactionTime = isset($NVPResponseArray['P_TRANSTIME' . $n . '']) ? $NVPResponseArray['P_TRANSTIME' . $n . ''] : '';
			$ResultCode = isset($NVPResponseArray['P_RESULT' . $n . '']) ? $NVPResponseArray['P_RESULT' . $n . ''] : '';
			$Tender = isset($NVPResponseArray['P_TENDER' . $n . '']) ? $NVPResponseArray['P_TENDER' . $n . ''] : '';
			$Amt = isset($NVPResponseArray['P_AMT' . $n . '']) ? $NVPResponseArray['P_AMT' . $n . ''] : '';
			$TransactionStateCode = isset($NVPResponseArray['P_TRANSTATE' . $n . '']) ? $NVPResponseArray['P_TRANSTATE' . $n . ''] : '';
			$TransactionStateMessage = $this -> GetTransactionStateCodeMessage($TransactionStateCode);
			
			$CurrentItem = array(
								'P_PNREF' => $RefNumber, 
								'P_TRANSTIME' => $TransactionTime,  
								'P_RESULT' => $ResultCode, 
								'P_TENDER' => $Tender, 
								'P_AMT' => $Amt, 
								'P_TRANSTATE' => $TransactionStateCode,
								'P_TRANSSTATEMESSAGE' => $TransactionStateMessage
								);
																	
			array_push($PaymentHistory, $CurrentItem);
			$n++;
		}
		
		$NVPResponseArray['PAYMENTHISTORY'] = $PaymentHistory;
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
		
		return $NVPResponseArray;
	
	} // End function GetLastPaymentStatus()
	

} // End class PayFlowSession
?>