<?php

	$allRecords = array($order['Order']);
	$this->Excel->generate($allRecords, 'order_'.$order['Order']['order_no']);

?>