<?php
$sandbox = true;
$domain = $sandbox ? 'http://localhost/paydollar/' : 'http://www.domain.com/';

if($sandbox)
{
	// Sandbox Credentials
	$paydollar_api_merchantid = '12101198';
	$paydollar_api_loginid = 'apilogin';
	$paydollar_api_password = 'apipass4321';
}
else
{	// Production Credentials
	$paydollar_api_merchantid = '';
	$paydollar_api_loginid = '';
	$paydollar_api_password = '';
}
?>