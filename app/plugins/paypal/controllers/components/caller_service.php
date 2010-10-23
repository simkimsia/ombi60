<?php
class CallerServiceComponent extends object {
	
        var $components = array('Session');
        
	/**
        * hash_call: Function to perform the API call to PayPal using API signature
        * @methodName is name of API  method.
        * @nvpStr is nvp string.
        * returns an associtive array containing the response from the server.
        */
        function hash_call($methodName,$nvpStr)
        {
                //declaring of global variables
                $API_Endpoint = Configure::read('paypal.ApiEndpoint');
                $version = Configure::read('paypal.Version');
                $API_UserName = Configure::read('paypal.ApiUserName');
                $API_Signature = Configure::read('paypal.ApiSignature');
                $nvp_Header = Configure::read('paypal.nvpHeader');
                $subject = Configure::read('paypal.Subject');
                
                
        
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
                if(PAYPAL_USE_PROXY)
                curl_setopt ($ch, CURLOPT_PROXY, PAYPAL_PROXY_HOST.":".PAYPAL_PROXY_PORT); 
        
                //check if version is included in $nvpStr else include the version.
                if(strlen(str_replace('VERSION=', '', strtoupper($nvpStr))) == strlen($nvpStr)) {
                        $nvpStr = "&VERSION=" . urlencode($version) . $nvpStr;	
                }
                
                $nvpreq="METHOD=".urlencode($methodName).$nvpStr;
                      
                //setting the nvpreq as POST FIELD to curl
                curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
        
                //getting response from server
                $response = curl_exec($ch);
        
                //convrting NVPResponse to an Associative Array
                $nvpResArray=$this->deformatNVP($response);
                $nvpReqArray=$this->deformatNVP($nvpreq);
                $this->Session->write('nvpReqArray',$nvpReqArray);
        
                if (curl_errno($ch)) {
                        // moving to display page to display curl errors
                        $this->Session->write('curl_error_no',curl_errno($ch)) ;
                        $this->Session->write('curl_error_msg',curl_error($ch));
                        $location = "APIError.php";
                        $this->log('redirect to apierror in caller_service');
                        $this->log('error no. is ' . curl_errno($ch) );
                        $this->log('error msg is ' . curl_error($ch) );
                        
                } else {
                        //closing the curl
                        curl_close($ch);
                }
              
                return $nvpResArray;
        }
      
        /** This function will take NVPString and convert it to an Associative Array and it will decode the response.
        * It is usefull to search for a particular key and displaying arrays.
        * @nvpstr is NVPString.
        * @nvpArray is Associative Array.
        */
      
        function deformatNVP($nvpstr)
        {
        
                $intial=0;
                $nvpArray = array();
        
        
                while(strlen($nvpstr)){
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
}
?>