<?php
class ReviewOrderComponent extends Object {
        
        var $components = array('Session', 'Paypal.CallerService');
        
        /**
         * a direct replacement of the ReviewOrder.php in the SDK
         * 
         **/
        function reviewOrder($params, $returnURL, $cancelURL) {
                
                $API_UserName=PAYPAL_API_USERNAME;

                $API_Password=PAYPAL_API_PASSWORD;

                $API_Signature=PAYPAL_API_SIGNATURE;
                
                $API_Endpoint =PAYPAL_API_ENDPOINT;
                
                $subject = PAYPAL_SUBJECT;

                /* An express checkout transaction starts with a token, that
                   identifies to PayPal your transaction
                   In this example, when the script sees a token, the script
                   knows that the buyer has already authorized payment through
                   paypal.  If no token was found, the action is to send the buyer
                   to PayPal to first authorize payment
                   */

                $token = (isset($params['url']['token'])) ? $params['url']['token'] : null;

                $getAuthModeFromConstantFile = true;
                //$getAuthModeFromConstantFile = false;
                $nvpHeader = "";

                if(!$getAuthModeFromConstantFile) {
                        //$AuthMode = "3TOKEN"; //Merchant's API 3-TOKEN Credential is required to make API Call.
                        //$AuthMode = "FIRSTPARTY"; //Only merchant Email is required to make EC Calls.
                        $AuthMode = "THIRDPARTY"; //Partner's API Credential and Merchant Email as Subject are required.
                } else {
                        if(!empty($API_UserName) && !empty($API_Password) && !empty($API_Signature) && !empty($subject)) {
                                $AuthMode = "THIRDPARTY";
                        }else if(!empty($API_UserName) && !empty($API_Password) && !empty($API_Signature)) {
                                $AuthMode = "3TOKEN";
                        }else if(!empty($subject)) {
                                $AuthMode = "FIRSTPARTY";
                        }
                }
                
                
                switch($AuthMode) {
	
                	case "3TOKEN" : 
                                $nvpHeader = "&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature);
                                break;
                        case "FIRSTPARTY" :
                                $nvpHeader = "&SUBJECT=".urlencode($subject);
                                break;
                        case "THIRDPARTY" :
                                $nvpHeader = "&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature)."&SUBJECT=".urlencode($subject);
                                break;		
	
                }

                if(! isset($token)) {

                        /*
                        The servername and serverport tells PayPal where the buyer
                        should be directed back to after authorizing payment.
                        In this case, its the local webserver that is running this script
                        Using the servername and serverport, the return URL is the first
                        portion of the URL that buyers will return to after authorizing payment
                        */
                        $serverName = $_SERVER['SERVER_NAME'];
                        $serverPort = $_SERVER['SERVER_PORT'];
                        $url=dirname('http://'.$serverName.':'.$serverPort.$params['url']['url']);
                
                
                        $currencyCodeType = isset($params['form']['currencyCodeType']) ? $params['form']['currencyCodeType'] : null;
                        $paymentType      = isset($params['form']['paymentType']) ? $params['form']['paymentType'] : null;
   

                        $personName        = isset($params['form']['PERSONNAME']) ? $params['form']['PERSONNAME'] : null;
                        $SHIPTOSTREET      = isset($params['form']['SHIPTOSTREET']) ? $params['form']['SHIPTOSTREET'] : null;
                        $SHIPTOCITY        = isset($params['form']['SHIPTOCITY']) ? $params['form']['SHIPTOCITY'] : null;
                        $SHIPTOSTATE	   = isset($params['form']['SHIPTOSTATE']) ? $params['form']['SHIPTOSTATE'] : null;
                        $SHIPTOCOUNTRYCODE = isset($params['form']['SHIPTOCOUNTRYCODE']) ? $params['form']['SHIPTOCOUNTRYCODE'] : null;
                        $SHIPTOZIP         = isset($params['form']['SHIPTOZIP']) ? $params['form']['SHIPTOZIP'] : null;
                        $L_NAME0           = isset($params['form']['L_NAME0']) ? $params['form']['L_NAME0'] : null;
                        $L_AMT0            = isset($params['form']['L_AMT0']) ? $params['form']['L_AMT0'] : null;
                        $L_QTY0            = isset($params['form']['L_QTY0']) ? $params['form']['L_QTY0'] : null;
                        $L_NAME1           = isset($params['form']['L_NAME1']) ? $params['form']['L_NAME1'] : null;
                        $L_AMT1            = isset($params['form']['L_AMT1']) ? $params['form']['L_AMT1'] : null;
                        $L_QTY1            = isset($params['form']['L_QTY1']) ? $params['form']['L_QTY1'] : null;



                        /*
                        The returnURL is the location where buyers return when a
                        payment has been succesfully authorized.
                        The cancelURL is the location buyers are sent to when they hit the
                        cancel button during authorization of payment during the PayPal flow
                        */

                        $returnURL =urlencode($url.$returnURL.'?currencyCodeType='.$currencyCodeType.'&paymentType='.$paymentType);
                        $cancelURL =urlencode($url.$cancelURL."?paymentType=$paymentType" );

                        /* Construct the parameter string that describes the PayPal payment
			the varialbes were set in the web form, and the resulting string
			is stored in $nvpstr
			*/
                        $itemamt = 0.00;
                        $itemamt = $L_QTY0*$L_AMT0+$L_AMT1*$L_QTY1;
                        $amt = 5.00+2.00+1.00+$itemamt;
                        $maxamt= $amt+25.00;
                        $nvpstr="";
		   
                        /*
                         * Setting up the Shipping address details
                         */
                        $shiptoAddress = "&SHIPTONAME=$personName&SHIPTOSTREET=$SHIPTOSTREET&SHIPTOCITY=$SHIPTOCITY&SHIPTOSTATE=$SHIPTOSTATE&SHIPTOCOUNTRYCODE=$SHIPTOCOUNTRYCODE&SHIPTOZIP=$SHIPTOZIP";
                        
                        $nvpstr="&ADDRESSOVERRIDE=1$shiptoAddress&L_NAME0=".$L_NAME0."&L_NAME1=".$L_NAME1."&L_AMT0=".$L_AMT0."&L_AMT1=".$L_AMT1."&L_QTY0=".$L_QTY0."&L_QTY1=".$L_QTY1."&MAXAMT=".(string)$maxamt."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&CALLBACKTIMEOUT=4&L_SHIPPINGOPTIONAMOUNT1=8.00&L_SHIPPINGOPTIONlABEL1=UPS Next Day Air&L_SHIPPINGOPTIONNAME1=UPS Air&L_SHIPPINGOPTIONISDEFAULT1=true&L_SHIPPINGOPTIONAMOUNT0=3.00&L_SHIPPINGOPTIONLABEL0=UPS Ground 7 Days&L_SHIPPINGOPTIONNAME0=Ground&L_SHIPPINGOPTIONISDEFAULT0=false&INSURANCEAMT=1.00&INSURANCEOPTIONOFFERED=true&CALLBACK=https://www.ppcallback.com/callback.pl&SHIPPINGAMT=8.00&SHIPDISCAMT=-3.00&TAXAMT=2.00&L_NUMBER0=1000&L_DESC0=Size: 8.8-oz&L_NUMBER1=10001&L_DESC1=Size: Two 24-piece boxes&L_ITEMWEIGHTVALUE1=0.5&L_ITEMWEIGHTUNIT1=lbs&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType;
                                
                        $nvpstr = $nvpHeader.$nvpstr;
           
		 	/* Make the call to PayPal to set the Express Checkout token
			If the API call succeded, then redirect the buyer to PayPal
			to begin to authorize payment.  If an error occured, show the
			resulting errors
			*/
                        $resArray=$this->CallerService->hash_call("SetExpressCheckout",$nvpstr);
                        
                        $this->Session->write("reshash", $resArray);
     
                        $ack = strtoupper($resArray["ACK"]);

                        if($ack=="SUCCESS"){
                                // Redirect to paypal.com here
                                $token = urldecode($resArray["TOKEN"]);
                                $payPalURL = PAYPAL_URL.$token;
                                $this->log('redirect to paypalurl');
                                //$this->redirect($payPalURL);
                        } else  {
                                //Redirecting to APIError.php to display errors.
                                $this->log('error');
                                //$this->redirect("APIError.php");
                                
                        }
                        
                } else {
		/*
                At this point, the buyer has completed in authorizing payment
                at PayPal.  The script will now call PayPal with the details
                of the authorization, incuding any shipping information of the
                buyer.  Remember, the authorization is not a completed transaction
                at this state - the buyer still needs an additional step to finalize
                the transaction
		*/

                        $token =urlencode( $token );

                        /*
                        Build a second API request to PayPal, using the token as the
			ID to get the details on the payment authorization
			*/
                        $nvpstr="&TOKEN=".$token;

                        $nvpstr = $nvpHeader.$nvpstr;
                        /*
                        Make the API call and store the results in an array.  If the
                        call was a success, show the authorization details, and provide
                        an action to complete the payment.  If failed, show the error
                        */
                        $resArray=$this->CallerService->hash_call("GetExpressCheckoutDetails",$nvpstr);
                        
                        $this->Session->write('reshash', $resArray);
                        $ack = strtoupper($resArray["ACK"]);

                        if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
                                //require_once "GetExpressCheckoutDetails.php";
                                $this->log('success');
                        } else  {
                                //Redirecting to APIError.php to display errors.
                                //$this->redirect("APIError.php");
                                $this->log('redirect to apierror');
                                
                        }
                }
        }
}
?>