<?php
$sandbox = true;
$domain = $sandbox ? 'http://sandbox.angelleye.com/client-sites/kai/' : 'http://www.domain.com/';

if($sandbox)
{
	// Sandbox Credentials
	$paypal_api_username = 'sandbo_1215254764_biz_api1.angelleye.com';
	$paypal_api_password = '1215254774';
	$paypal_api_signature = 'AiKZhEEPLJjSIccz.2M.tbyW5YFwAb6E3l6my.pY9br1z2qxKx96W18v';
	$paypal_api_subject = '';
}
else
{	// Production Credentials
	$paypal_api_username = '';
	$paypal_api_password = '';
	$paypal_api_signature = '';
	$paypal_api_subject = '';
}
?>