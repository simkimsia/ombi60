<?php

	$qtyArray = array();
			
	for($start = 1; $start<=$maximumQuantity; $start++) {
		$qtyArray[$start] = $start;
	}
			
	echo $this->Form->input($inputName, array('options' => $qtyArray, 'div'=>false));

?>