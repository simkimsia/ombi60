<?php
/*
	**************************************************
	kimsia : www.thecopyninja.com
	PayDollar PayGate Integration Guide v3.7 : July 27 2010
	Version 10.12 (version number is given by year and month. 10.12 means 2010 DEC)
	**************************************************
	
	This class is intended to be used along-side the PayDollar PayGate Integration Guide PDF.
		
*/


class PayDollar
{

	var $APIMerchantID = '';
	
	var $APILoginID = '';
	
	var $APIPassword = '';
        
        //var $APIVersion = '';
	
	var $Sandbox = '';
	
	var $SSL = '';
        
        var $EndPointURL = '';
        
        var $UpperCaseForStringParams = '';
        
        var $UrlEncodeStringValues = '';
	
	function PayDollar($DataArray)
	{
		if(isset($DataArray['Sandbox']))
			$this -> Sandbox = $DataArray['Sandbox'];
		else
			$this -> Sandbox = true;
			
		$this -> Sandbox = isset($DataArray['Sandbox']) ? $DataArray['Sandbox'] : true;
		
		//$this -> APIVersion = isset($DataArray['APIVersion']) ? $DataArray['APIVersion'] : '10.12';
		
		$this -> SSL = $_SERVER['SERVER_PORT'] == '443' ? true : false;
                $this->UpperCaseForStringParams = isset($DataArray['UpperCaseForStringParams']) ? $DataArray['UpperCaseForStringParams'] : false;
                $this->UrlEncodeStringValues = isset($DataArray['UrlEncodeStringValues']) ? $DataArray['UrlEncodeStringValues'] : false;
		
		
		if($this -> Sandbox)
		{
                        #Sandbox
                        $this -> APIMerchantID = isset($DataArray['APIMerchantID']) && $DataArray['APIMerchantID'] != '' ? $DataArray['APIMerchantID'] : '';
			$this->APILoginID = isset($DataArray['APILoginID']) && $DataArray['APILoginID'] != '' ? $DataArray['APILoginID'] : '';
			$this->APIPassword = isset($DataArray['APIPassword']) && $DataArray['APIPassword'] != '' ? $DataArray['APIPassword'] : '';
                        $this -> EndPointURL = isset($DataArray['EndPointURL']) && $DataArray['EndPointURL'] != ''  ? $DataArray['EndPointURL'] : 'https://test.paydollar.com/b2cDemo/eng/directPay/payComp.jsp';
		}
		else
		{
			$this -> APIMerchantID = isset($DataArray['APIMerchantID']) && $DataArray['APIMerchantID'] != '' ? $DataArray['APIMerchantID'] : '';
			$this->APILoginID = isset($DataArray['APILoginID']) && $DataArray['APILoginID'] != '' ? $DataArray['APILoginID'] : '';
			$this->APIPassword = isset($DataArray['APIPassword']) && $DataArray['APIPassword'] != '' ? $DataArray['APIPassword'] : '';
                        $this -> EndPointURL = isset($DataArray['EndPointURL']) && $DataArray['EndPointURL'] != ''  ? $DataArray['EndPointURL'] : 'https://www.paydollar.com/b2c2/eng/directPay/payComp.jsp';
		}
		
		// Create the NVP credentials string which is required in DirectPay
		$this -> NVPCredentials = 'merchantId=' . $this -> APIMerchantID;
		
		// Create the full NVP credentials string which is required in all calls except for DirectPay
		$this->FullNVPCredentials = 'merchantId=' . $this -> APIMerchantID . '&loginId=' . $this->APILoginID .
						'&password=' . $this->APIPassword;
		
		$this->EndPointURLs = array('DirectPay'=>array('sandbox'=>'https://test.paydollar.com/b2cDemo/eng/directPay/payComp.jsp',
							     'live'=>'https://www.paydollar.com/b2c2/eng/directPay/payComp.jsp',),
					    'SchedulePay'=>array('sandbox'=>'https://test.paydollar.com/b2c2/eng/merchant/api/schPayApi.jsp',
							     'live'=>'https://www.paydollar.com/b2c2/eng/merchant/api/schPayApi.jsp',));
		
		$this -> Countries = array(
							'Afghanistan' => 'AF',
							'Albania' => 'AL',
							'Algeria' => 'DZ',
							'American Samoa' => 'AS',
							'Andorra' => 'AD',
							'Angola' => 'AO',
							'Anguilla' => 'AI',
							'Antarctica' => 'AQ',
							'Antigua and Barbuda' => 'AG',
							'Argentina' => 'AR',
							'Armenia' => 'AM',
							'Aruba' => 'AW',
							'Australia' => 'AU',
							'Austria' => 'AT',
							'Azerbaijan' => 'AZ',
							'Bahamas' => 'BS',
							'Bahrain' => 'BH',
							'Bangladesh' => 'BD',
							'Barbados' => 'BB',
							'Belarus' => 'BY',
							'Belgium' => 'BE',
							'Belize' => 'BZ',
							'Benin' => 'BJ',
							'Bermuda' => 'BM',
							'Bhutan' => 'BT',
							'Bolivia' => 'BO',
							'Bosnia and Herzegovina' => 'BA',
							'Botswana' => 'BW',
							'Bouvet Island' => 'BV',
							'Brazil' => 'BR',
							'British Indian Ocean Territory' => 'IO',
							'Brunei Darussalam' => 'BN',
							'Bulgaria' => 'BG',
							'Burkina Faso' => 'BF',
							'Burundi' => 'BI',
							'Cambodia' => 'KH',
							'Cameroon' => 'CM',
							'Canada' => 'CA',
							'Cape Verde' => 'CV',
							'Cayman Islands' => 'KY',
							'Central African Republic' => 'CF',
							'Chad' => 'TD',
							'Chile' => 'CL',
							'China' => 'CN',
							'Christmas Island' => 'CX',
							'Cocos (Keeling) Islands' => 'CC',
							'Colombia' => 'CO',
							'Comoros' => 'KM',
							'Congo' => 'CG',
							'Congo, The Democratic Republic of the' => 'CD',
							'Cook Islands' => 'CK',
							'Costa Rica' => 'CR',
							"Cote D'Ivoire" => 'CI',
							'Croatia' => 'HR',
							'Cuba' => 'CU',
							'Cyprus' => 'CY',
							'Czech Republic' => 'CZ',
							'Denmark' => 'DK',
							'Djibouti' => 'DJ',
							'Dominica' => 'DM',
							'Dominican Republic' => 'DO',
							'Ecuador' => 'EC',
							'Egypt' => 'EG',
							'El Salvador' => 'SV',
							'Equatorial Guinea' => 'GQ',
							'Eritrea' => 'ER',
							'Estonia' => 'EE',
							'Ethiopia' => 'ET',
							'Falkland Islands (Malvinas)' => 'FK',
							'Faroe Islands' => 'FO',
							'Fiji' => 'FJ',
							'Finland' => 'FI',
							'France' => 'FR',
							'French Guiana' => 'GF',
							'French Polynesia' => 'PF',
							'French Southern Territories' => 'TF',
							'Gabon' => 'GA',
							'Gambia' => 'GM',
							'Georgia' => 'GE',
							'Germany' => 'DE',
							'Ghana' => 'GH',
							'Gibraltar' => 'GI',
							'Greece' => 'GR',
							'Greenland' => 'GL',
							'Grenada' => 'GD',
							'Guadeloupe' => 'GP',
							'Guam' => 'GU',
							'Guatemala' => 'GT',
							'Guernsey' => 'GG',
							'Guinea' => 'GN',
							'Guinea-Bissau' => 'GW',
							'Guyana' => 'GY',
							'Haiti' => 'HT',
							'Heard Island and McDonald Islands' => 'HM',
							'Holy See (Vatican City State)' => 'VA',
							'Honduras' => 'HN',
							'Hong Kong' => 'HK',
							'Hungary' => 'HU',
							'Iceland' => 'IS',
							'India' => 'IN',
							'Indonesia' => 'ID',
							'Iran, Islamic Republic of' => 'IR',
							'Iraq' => 'IQ',
							'Ireland' => 'IE',
							'Isle of Man' => 'IM',
							'Israel' => 'IL',
							'Italy' => 'IT',
							'Jamaica' => 'JM',
							'Japan' => 'JP',
							'Jersey' => 'JE',
							'Jordan' => 'JO',
							'Kazakhstan' => 'KZ',
							'Kenya' => 'KE',
							'Kiribati' => 'KI',
							"Korea, Democratic People's Republic of" => 'KP',
							'Korea, Republic of' => 'KR',
							'Kuwait' => 'KW',
							'Kyrgyzstan' => 'KG',
							"Laos People's Democratic Republic" => 'LA',
							'Latvia' => 'LV',
							'Lebanon' => 'LB',
							'Lesotho' => 'LS',
							'Liberia' => 'LR',
							'Libyan Arab Jamahiriya' => 'LY',
							'Liechtenstein' => 'LI',
							'Lithuania' => 'LT',
							'Luxembourg' => 'LU',
							'Macao' => 'MO',
							'Macedonia, The former Yugoslav Republic of' => 'MK',
							'Madagascar' => 'MG',
							'Malawi' => 'MW',
							'Malaysia' => 'MY',
							'Maldives' => 'MV',
							'Mali' => 'ML',
							'Malta' => 'MT',
							'Marshall Islands' => 'MH',
							'Martinique' => 'MQ',
							'Mauritania' => 'MR',
							'Mauritius' => 'MU',
							'Mayotte' => 'YT',
							'Mexico' => 'MX',
							'Micronesia, Federated States of' => 'FM',
							'Moldova, Republic of' => 'MD',
							'Monaco' => 'MC',
							'Mongolia' => 'MN',
							'Montserrat' => 'MS',
							'Morocco' => 'MA',
							'Mozambique' => 'MZ',
							'Myanmar' => 'MM',
							'Namibia' => 'NA',
							'Nauru' => 'NR',
							'Nepal' => 'NP',
							'Netherlands' => 'NL',
							'Netherlands Antilles' => 'AN',
							'New Caledonia' => 'NC',
							'New Zealand' => 'NZ',
							'Nicaragua' => 'NI',
							'Niger' => 'NE',
							'Nigeria' => 'NG',
							'Niue' => 'NU',
							'Norfolk Island' => 'NF',
							'Northern Mariana Islands' => 'MP',
							'Norway' => 'NO',
							'Oman' => 'OM',
							'Pakistan' => 'PK',
							'Palau' => 'PW',
							'Palestinian Territory, Occupied' => 'PS',
							'Panama' => 'PA',
							'Papua New Guinea' => 'PG',
							'Paraguay' => 'PY',
							'Peru' => 'PE',
							'Philippines' => 'PH',
							'Pitcairn' => 'PN',
							'Poland' => 'PL',
							'Portugal' => 'PT',
							'Puerto Rico' => 'PR',
							'Qatar' => 'QA',
							'Reunion' => 'RE',
							'Romania' => 'RO',
							'Russian Federation' => 'RU',
							'Rwanda' => 'RW',
							'Saint Helena' => 'SH',
							'Saint Kitts and Nevis' => 'KN',
							'Saint Lucia' => 'LC',
							'Saint Pierre and Miquelon' => 'PM',
							'Saint Vincent and the Grenadines' => 'VC',
							'Samoa' => 'WS',
							'San Marino' => 'SM',
							'Sao Tome and Principe' => 'ST',
                                                        'Satellite Provider' => 'A2',
							'Saudi Arabia' => 'SA',
							'Senegal' => 'SN',
							'Serbia and Montenegro' => 'CS',
							'Seychelles' => 'SC',
							'Sierra Leone' => 'SL',
							'Singapore' => 'SG',
							'Slovakia' => 'SK',
							'Slovenia' => 'SI',
							'Solomon Islands' => 'SB',
							'Somalia' => 'SO',
							'South Africa' => 'ZA',
							'South Georgia and the South Sandwich Islands' => 'GS',
							'Spain' => 'ES',
							'Sri Lanka' => 'LK',
							'Sudan' => 'SD',
							'Suriname' => 'SR',
							'SValbard and Jan Mayen' => 'SJ',
							'Swaziland' => 'SZ',
							'Sweden' => 'SE',
							'Switzerland' => 'CH',
							'Syrian Arab Republic' => 'SY',
							'Taiwan, Province of China' => 'TW',
							'Tajikistan' => 'TJ',
							'Tanzania, United Republic of' => 'TZ',
							'Thailand' => 'TH',
							'Timor-Leste' => 'TL',
							'Togo' => 'TG',
							'Tokelau' => 'TK',
							'Tonga' => 'TO',
							'Trinidad and Tobago' => 'TT',
							'Tunisia' => 'TN',
							'Turkey' => 'TR',
							'Turkmenistan' => 'TM',
							'Turks and Caicos Islands' => 'TC',
							'Tuvalu' => 'TV',
							'Uganda' => 'UG',
							'Ukraine' => 'UA',
							'United Arab Emirates' => 'AE',
							'United Kingdom' => 'GB',
							'United States' => 'US',
							'United States Minor Outlying Islands' => 'UM',
							'Uruguay' => 'UY',
							'Uzbekistan' => 'UZ',
							'Vanuatu' => 'VU',
							'Venezuela' => 'VE',
							'Viet Nam' => 'VN',
							'Virgin Islands, British' => 'VG',
							'Virgin Islands, U.S.' => 'VI',
							'Wallis and Futuna' => 'WF',
							'Western Sahara' => 'EH',
							'Yemen' => 'YE',
							'Zambia' => 'ZM',
							'Zimbabwe' => 'ZW');
							
		$this -> States = array(
						'Alberta' => 'AB',
						'British Columbia' => 'BC',
						'Manitoba' => 'MB',
						'New Brunswick' => 'NB',
						'Newfoundland and Labrador' => 'NF',
						'Northwest Territories' => 'NT',
						'Nova Scotia' => 'NS',
						'Nunavut' => 'NU',
						'Ontario' => 'ON',
						'Prince Edward Island' => 'PE',
						'Quebec' => 'QC',
						'Saskatchewan' => 'SK',
						'Yukon' => 'YK',
						'Alabama' => 'AL',
						'Alaska' => 'AK',
						'American Samoa' => 'AS',
						'Arizona' => 'AZ',
						'Arkansas' => 'AR',
						'California' => 'CA',
						'Colorado' => 'CO',
						'Connecticut' => 'CT',
						'Delaware' => 'DE',
						'District of Columbia' => 'DC',
						'Federated States of Micronesia' => 'FM',
						'Florida' => 'FL',
						'Georgia' => 'GA',
						'Guam' => 'GU',
						'Hawaii' => 'HI',
						'Idaho' => 'ID',
						'Illinois' => 'IL',
						'Indiana' => 'IN',
						'Iowa' => 'IA',
						'Kansas' => 'KS',
						'Kentucky' => 'KY',
						'Louisiana' => 'LA',
						'Maine' => 'ME',
						'Marshall Islands' => 'MH',
						'Maryland' => 'MD',
						'Massachusetts' => 'MA',
						'Michigan' => 'MI',
						'Minnesota' => 'MN',
						'Mississippi' => 'MS',
						'Missouri' => 'MO',
						'Montana' => 'MT',
						'Nebraska' => 'NE',
						'Nevada' => 'NV',
						'New Hampshire' => 'NH',
						'New Jersey' => 'NJ',
						'New Mexico' => 'NM',
						'New York' => 'NY',
						'North Carolina' => 'NC',
						'North Dakota' => 'ND',
						'Northern Mariana Islands' => 'MP',
						'Ohio' => 'OH',
						'Oklahoma' => 'OK',
						'Oregon' => 'OR',
						'Palau' => 'PW',
						'Pennsylvania' => 'PA',
						'Puerto Rico' => 'PR',
						'Rhode Island' => 'RI',
						'South Carolina' => 'SC',
						'South Dakota' => 'SD',
						'Tennessee' => 'TN',
						'Texas' => 'TX',
						'Utah' => 'UT',
						'Vermont' => 'VT',
						'Virgin Islands' => 'VI',
						'Virginia' => 'VA',
						'Washington' => 'WA',
						'West Virginia' => 'WV',
						'Wisconsin' => 'WI',
						'Wyoming' => 'WY',
						'Armed Forces Americas' => 'AA',
						'Armed Forces' => 'AE',
						'Armed Forces Pacific' => 'AP');
						
		$this -> PRCodes = array("0" => "Success", 
					 "1" => "Rejected by Payment Bank", 
                                         "3" => "Rejected due to Payer Authentication", 
                                         "-1" => "Rejected due to Input Parameters Incorrect", 
                                         "-2" => "Rejected due to Server Access Error", 
                                         "-8" => "Rejected due to PayDollar Internal/Fraud Prevention Checking", 
                                         "-9" => "Rejected by Host Access Error", 
                                       );
								  
		$this -> SRCodes = array(
                                        "1" => array("01" => "Bank Decline",
                                                     "02" => "Bank Decline",
                                                     "03" => "Other",
                                                     "04" => "Other",
                                                     "05" => "Bank Decline",
                                                     "12" => "Other",
                                                     "13" => "Other",
                                                     "14" => "Input Error",
                                                     "19" => "Other",
                                                     "25" => "Other",
                                                     "30" => "Other",
                                                     "31" => "Other",
                                                     "41" => "Lost / Stolen Card",
                                                     "43" => "Lost / Stolen Card",
                                                     "51" => "Bank Decline",
                                                     "54" => "Input Error",
                                                     "55" => "Other",
                                                     "58" => "Other",
                                                     "76" => "Other",
                                                     "77" => "Other",
                                                     "78" => "Other",
                                                     "80" => "Other",
                                                     "89" => "Other",
                                                     "91" => "Other",
                                                     "94" => "Other",
                                                     "95" => "Other",
                                                     "96" => "Other",
                                                     "99" => "Other",
                                                     "2000" => "Other",
                                                     ),
					"3" => array("Any Number" => "Payer Authentication Fail"),
                                        "-1" => array("-1" => "Input Parameter Error"),
                                        "-2" => array("-2" => "Server Access Error"),
                                        "-8" => array("999" => "Other",
                                                     "1000" => "Skipped transaction",
                                                     "2000" => "Blacklist error",
                                                     "2001" => "Blacklist card by system",
                                                     "2002" => "Blacklist card by merchant",
                                                     "2003" => "Black IP by system",
                                                     "2004" => "Black IP by merchant",
                                                     "2005" => "Invalid cardholder name",
                                                     "2006" => "Same card used more than 6 times a day",
                                                     "2007" => "Duplicate merchant reference no.",
                                                     "2008" => "Empty merchant reference no.",
                                                     "2011" => "Other",
                                                     "2012" => "Card verification failed",
                                                     "2013" => "Card already registered",
                                                     "2014" => "High risk country",
                                                     "2016" => "Same payer IP attempted more than pre-defined no. a day. Same payer IP attempted more than pre-defined no. a day",
                                                     "2017" => "Invalid card number",
                                                     "2018" => "Multi-card attempt",
                                                     ),
                                        "-9" => array("-9" => "Host Access Error")
					);
								   
		$this -> CurrencyCodes = array(
                                                'AUD' => '036', 
                                                'CAD' => '124', 
                                                'EUR' => '978', 
                                                'HKD' => '344', 
                                                'JPY' => '392', 
                                                'CNY' => '156',
                                                'GBP' => '826', 
                                                'SGD' => '702', 
                                                'TWD' => '901', 
                                                'USD' => '840'
                                            );
                
                $this -> CurrencyCodesText = array(
                                                'AUD' => 'Australian Dollar', 
                                                'CAD' => 'Canadian Dollar', 
                                                'EUR' => 'Euro', 
                                                'HKD' => 'Hong Kong Dollar', 
                                                'JPY' => 'Japanese Yen', 
                                                'CNY' => 'Chinese Yuan',
                                                'GBP' => 'Pound Sterling', 
                                                'SGD' => 'Singapore Dollar', 
                                                'TWD' => 'Taiwan New Dollar', 
                                                'USD' => 'U.S. Dollar'
                                            );
		
	
	}  // End function PayDollar() constructor
	
	/*
		GENERAL CLASS FUNCTIONS
	*/
	
	function GetDirectPayUrl() {
		if ($this->Sandbox) {
			return $this->EndPointURLs['DirectPay']['sandbox'];
		} else {
			return $this->EndPointURLs['DirectPay']['live'];
		}
	}
	
	
	function GetSchedulePayUrl() {
		if ($this->Sandbox) {
			return $this->EndPointURLs['SchedulePay']['sandbox'];
		} else {
			return $this->EndPointURLs['SchedulePay']['live'];
		}
	}
	
	function GetAPIVersion()
	{
		return $this -> APIVersion;	
	}
	
	function GetCountryCode($CountryName)
	{
		return $this -> Countries[$CountryName];
	}
	
	
	function GetStateCode($StateOrProvinceName)
	{
		return $this -> States[$StateOrProvinceName];
	}
	
	function GetCountryName($CountryCode)
	{
		$Countries = array_flip($this -> Countries);
		return $Countries[$CountryCode];
	}
	
	function GetStateName($StateOrProvinceName)
	{
		$States = array_flip($this -> States);
		return $States[$StateOrProvinceName];
	}
	
	function GetPRCodeMessage($PRCode)
	{					  
		return $this -> PRCodes[$PRCode];
	}
        
	function GetSRCodeMessage($PRCode, $SRCode)
	{					  
		return $this -> SRCodes[$PRCode][$SRCode];
	}
	
	function GetCurrencyTextFromCode($CurrencyCode)
	{
		return $this -> CurrencyCodesText[$CurrencyCode];
	}
	
	function GetCurrencyCodeFromText($CurrencyCodeText)
	{
		$CurrencyCodes = array_flip($this -> CurrencyCodesText);
		return $CurrencyCodes[$CurrencyCodeText];
	}
        
        
        function GetCurrencyCodeFromNumber($number)
	{
                $CurrencyCodes = array_flip($this -> CurrencyCodes);
		return $CurrencyCodes[$number];
	}
	
	function GetCurrencyNumberFromCode($CurrencyCode)
	{
		return $this->CurrencyCodes[$CurrencyCode];
	}
	
        function GetCurrencyNumberFromText($text)
	{
                return $this->GetCurrencyNumberFromCode($this->GetCurrencyCodeFromText($text));
	}
	
	function GetCurrencyTextFromNumber($number)
	{
		return $this->GetCurrencyTextFromCode($this->GetCurrencyCodeFromNumber($number));
	}
	
	function CURLRequest($Request)
	{
	
		$curl = curl_init();
				curl_setopt($curl, CURLOPT_VERBOSE, 1);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($curl, CURLOPT_TIMEOUT, 30);
				curl_setopt($curl, CURLOPT_URL, $this -> EndPointURL);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $Request);
                               /* curl_setopt($curl, CURLOPT_HTTPHEADER,
                                            array("Content-Type: application/x-www-form-urlencoded",
                                                  "Content-length: ".strlen($data)));*/ 
				
		//if($this -> APIMode == 'Certificate')
		//	curl_setopt($curl, CURLOPT_SSLCERT, $this -> PathToCertKeyPEM);
		
		//execute the curl POST		
		$Response = curl_exec($curl);
		
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
			$proArray[$keyval] = urldecode($valval);
			$NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
		}
		
		return $proArray;
		
	} // End function NVPToArray()
	
	
	function GetErrors($DataArray)
	{
	
		$Errors = array();
		
		if ($DataArray['successcode'] != 0) {
			$Errors[] = $DataArray['errMsg'];
		}
		
		return $Errors;
		
	} // End function GetErrors()
	
	
	function DisplayErrors($Errors)
	{
		foreach($Errors as $ErrorVar => $ErrorVal)
		{
			$CurrentError = $Errors[$ErrorVar];
			foreach($CurrentError as $CurrentErrorVar => $CurrentErrorVal)
			{
				if($CurrentErrorVar == 'L_ERRORCODE')
					$CurrentVarName = 'Error Code';
				elseif($CurrentErrorVar == 'L_SHORTMESSAGE')
					$CurrentVarName = 'Short Message';
				elseif($CurrentErrorVar == 'L_LONGMESSAGE')
					$CurrentVarName == 'Long Message';
				elseif($CurrentErrorVar == 'L_SEVERITYCODE')
					$CurrentVarName = 'Severity Code';
			
				echo $CurrentVarName . ': ' . $CurrentErrorVal . '<br />';		
			}
			echo '<br />';
		}
	} // End function DisplayErrors()
        
        function DirectPay($DataArray) {
            
                $DPFieldsNVP = '';
		
		// DP Request Fields
		$DPFields = isset($DataArray['DPFields']) ? $DataArray['DPFields'] : array();
		foreach($DPFields as $DPFieldsVar => $DPFieldsVal)
		{
                    if ($this->UpperCaseForStringParams) {
                        $DPFieldsVar = strtoupper($DPFieldsVar);
                    }
                    
                        $DPFieldsVal = urlencode($DPFieldsVal);
                    
                        $DPFieldsNVP .= '&' . $DPFieldsVar . '=' . $DPFieldsVal;
		}
		
		// set up the credentials as of this point only merchantId
                $NVPRequest = $this -> NVPCredentials . $DPFieldsNVP;
                
		// set up the correct EndPointUrl before using CURLRequest
		$this->EndPointURL = $this->GetDirectPayUrl();
		
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPRequestArray = $this -> NVPToArray($NVPRequest);
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		//
		$Errors = $this -> GetErrors($NVPResponseArray);
		
		$NVPResponseArray['ERRORS'] = $Errors;
		$NVPResponseArray['REQUESTDATA'] = $NVPRequestArray;
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
				
		return $NVPResponseArray;
        }
	
	function AddSchPay($DataArray) {
		$ASPFieldsNVP = '';
		
		// ASP Request Fields
		$ASPFields = isset($DataArray['ASPFields']) ? $DataArray['ASPFields'] : array();
		foreach($ASPFields as $ASPFieldsVar => $ASPFieldsVal)
		{
                    if ($this->UpperCaseForStringParams) {
                        $ASPFieldsVar = strtoupper($ASPFieldsVar);
                    }
                    
                        $ASPFieldsVal = urlencode($ASPFieldsVal);
                    
                        $ASPFieldsNVP .= '&' . $ASPFieldsVar . '=' . $ASPFieldsVal;
		}
		
		// set up the credentials as of this point requires merchantId, loginId, password
                $NVPRequest = $this->FullNVPCredentials . '&actionType=AddSchPay' . $ASPFieldsNVP;
                
		// set up the correct EndPointUrl before using CURLRequest
		$this->EndPointURL = $this->GetSchedulePayUrl();
		
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPRequestArray = $this -> NVPToArray($NVPRequest);
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$Errors = $this -> GetErrors($NVPResponseArray);
		
		$NVPResponseArray['ERRORS'] = $Errors;
		$NVPResponseArray['REQUESTDATA'] = $NVPRequestArray;
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
				
		return $NVPResponseArray;
	}
	
	function DeleteSchPay($DataArray) {
		$DSPFieldsNVP = '';
		
		// DSP Request Fields
		$DSPFields = isset($DataArray['DSPFields']) ? $DataArray['DSPFields'] : array();
		foreach($DSPFields as $DSPFieldsVar => $DSPFieldsVal)
		{
                    if ($this->UpperCaseForStringParams) {
                        $DSPFieldsVar = strtoupper($DSPFieldsVar);
                    }
                    
                        $DSPFieldsVal = urlencode($DSPFieldsVal);
                    
                        $DSPFieldsNVP .= '&' . $DSPFieldsVar . '=' . $DSPFieldsVal;
		}
		
		// set up the credentials as of this point requires merchantId, loginId, password
                $NVPRequest = $this->FullNVPCredentials . '&actionType=DeleteSchPay' . $DSPFieldsNVP;
                
		// set up the correct EndPointUrl before using CURLRequest
		$this->EndPointURL = $this->GetSchedulePayUrl();
		
		$NVPResponse = $this -> CURLRequest($NVPRequest);
		$NVPRequestArray = $this -> NVPToArray($NVPRequest);
		$NVPResponseArray = $this -> NVPToArray($NVPResponse);
		
		$Errors = $this -> GetErrors($NVPResponseArray);
		
		$NVPResponseArray['ERRORS'] = $Errors;
		$NVPResponseArray['REQUESTDATA'] = $NVPRequestArray;
		$NVPResponseArray['RAWREQUEST'] = $NVPRequest;
		$NVPResponseArray['RAWRESPONSE'] = $NVPResponse;
				
		return $NVPResponseArray;
	}
	
	
	function ConvertPOSTToDataFeed($GETArray) {
		$DataArray = array();
		
		$DataArray['src'] = isset($GETArray['src']) ? $GETArray['src'] : '';
		$DataArray['prc'] = isset($GETArray['prc']) ? $GETArray['prc'] : '';
		$DataArray['Ord'] = isset($GETArray['Ord']) ? $GETArray['Ord'] : '';
		$DataArray['Holder'] = isset($GETArray['Holder']) ? $GETArray['Holder'] : '';
		$DataArray['successcode'] = isset($GETArray['successcode']) ? $GETArray['successcode'] : '';
		$DataArray['Ref'] = isset($GETArray['Ref']) ? $GETArray['Ref'] : '';
		$DataArray['PayRef'] = isset($GETArray['PayRef']) ? $GETArray['PayRef'] : '';
		$DataArray['Amt'] = isset($GETArray['Amt']) ? $GETArray['Amt'] : '';
		$DataArray['mpsAmt'] = isset($GETArray['mpsAmt']) ? $GETArray['mpsAmt'] : '';
		$DataArray['mpsCur'] = isset($GETArray['mpsCur']) ? $GETArray['mpsCur'] : '';
		$DataArray['mpsForeignAmt'] = isset($GETArray['mpsForeignAmt']) ? $GETArray['mpsForeignAmt'] : '';
		$DataArray['mpsForeignCur'] = isset($GETArray['mpsForeignCur']) ? $GETArray['mpsForeignCur'] : '';
		$DataArray['mpsRate'] = isset($GETArray['mpsRate']) ? $GETArray['mpsRate'] : '';
		$DataArray['remark'] = isset($GETArray['remark']) ? $GETArray['remark'] : '';
		$DataArray['AuthId'] = isset($GETArray['AuthId']) ? $GETArray['AuthId'] : '';
		$DataArray['eci'] = isset($GETArray['eci']) ? $GETArray['eci'] : '';
		$DataArray['payerAuth'] = isset($GETArray['payerAuth']) ? $GETArray['payerAuth'] : '';
		
		$DataArray['sourceip'] = isset($GETArray['sourceip']) ? $GETArray['sourceip'] : '';
		$DataArray['ipCountry'] = isset($GETArray['ipCountry']) ? $GETArray['ipCountry'] : '';
		$DataArray['payMethod'] = isset($GETArray['payMethod']) ? $GETArray['payMethod'] : '';
		$DataArray['cardIssuingCountry'] = isset($GETArray['cardIssuingCountry']) ? $GETArray['cardIssuingCountry'] : '';
		$DataArray['secureHash'] = isset($GETArray['secureHash']) ? $GETArray['secureHash'] : '';
		
		return $DataArray;
	}
	
	
}  // End class PayDollar
?>