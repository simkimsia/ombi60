<?php
		
	$aaData = array();
	foreach ($orders as $key=>$order) {
		$row 		= array();
		
		$status 		= $order['Order']['status'];
		if ($status == ORDER_OPENED) {
			$statusClass 	= ' open';
		} else if ($status == ORDER_CLOSED) {
			$statusClass 	= ' closed';			
		} else {
			$statusClass 	= ' cancelled';			
		}


		$checkbox = $this->Form->checkbox('Order.selected.'.$key, 
			array('value' => $order['Order']['id'], 'class' => 'checkbox' . $statusClass, 'label' => FALSE, 'div' => FALSE)
		);
		
		$row[]		= $checkbox;
		
		$row[] 	= $this->Html->link(__('#' . $order['Order']['order_no']), array('action' => 'view', $order['Order']['id']));
		$row[]		=  $this->Time->niceShort($order['Order']['created']); 
		$row[]		= $order['User']['full_name']; 
		$row[]		= $this->Constant->displayPayment($order['Order']['payment_status']);
		$row[]		= $this->Constant->displayFulfillment($order['Order']['fulfillment_status']);
		$row[]		=  $this->Number->currency($order['Order']['amount'], '$');
		
		$aaData[] 	= $row;
	}
	
	//sEcho is just some integer that is used to prevent XSS
	//iTotalRecords is total records inside teh database excluding conditions
	//iTotalDisplayRecords is total records after conditions, sorting, paging
	//aaData is array of records returned

	echo json_encode(array(
		'sEcho'					=> intval($sEcho),
		'iTotalRecords'			=> $iTotal,
		'iTotalDisplayRecords'	=> $iTotalDisplay,
		'aaData'				=> $aaData
	));


		
?>