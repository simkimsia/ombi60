<?php

	$this->Csv->create('order_'.$order['Order']['order_no']);
	
	$fields = array_keys($order['Order']);
	$csvRow = 'A';
	$colCount = 1;
	foreach ($fields as $field) {
		
		$this->Csv->setCellValue($csvRow.$colCount, Inflector::humanize($field));
		$colCount ++;
	}
	
	$this->Csv->end();

?>