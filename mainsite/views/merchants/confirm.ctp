<?php
	echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
	
	if (isset($domain['Shop']['web_address'])) {
		$domain = $domain['Shop']['web_address'];
		echo 'This is your shop front. ';
		echo $this->Html->link($domain, $domain);
		echo '<br /><br />This is your shop admin. ';
		echo $this->Html->link($domain.'/admin', $domain. '/admin');
	} else {
		echo 'failed';
	}
	

?>


