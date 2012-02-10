<?php

$this->Csv->setFilename('order_'.$order['Order']['order_no'].'.csv');

$columnHeaders = array(
	'Order No',
	'Contact Email',
	'Payment Status',
	'Fulfillment Status',
	'Currency',
	'Subtotal',
	'Shipping Fee',
	'Total',
	'Shipping Method',
	'Created at',
	'Lineitem Name', 'Lineitem Price', 'Lineitem Quantity', 
	'Billing Name',
	'Billing Address',
	'Billing Region',
	'Billing Zip Code',
	'Billing Country',
	'Billing Phone',
	'Shipping Name',
	'Shipping Address',
	'Shipping Region',
	'Shipping Zip Code',
	'Shipping Country',
	'Shipping Phone',
	'Note'
);


App::uses('CsvLib', 'UtilityLib.Lib');

$firstRow = array(
	$order['Order']['order_no'],
	$order['Order']['contact_email'],
	$this->Constant->displayPayment($order['Order']['payment_status']),
	$this->Constant->displayFulfillment($order['Order']['fulfillment_status']),
	$order['Order']['currency'],
	$order['Order']['amount'],
	$order['Order']['shipping_fee'],
	$order['Order']['net_amount'],
	$order['Shipment'][0]['name'],
	$order['Order']['created'],
	
	$order['OrderLineItem'][0]['variant_title'], $order['OrderLineItem'][0]['product_price'], $order['OrderLineItem'][0]['product_quantity'],

	$order['BillingAddress']['full_name'],
	$order['BillingAddress']['address'],
	$order['BillingAddress']['region'],
	$order['BillingAddress']['zip_code'],
	$order['BillingAddress']['Country']['printable_name'],
	$order['DeliveryAddress']['full_name'],			
	$order['DeliveryAddress']['address'],
	$order['DeliveryAddress']['region'],
	$order['DeliveryAddress']['zip_code'],
	$order['DeliveryAddress']['Country']['printable_name'],
	CsvLib::escape($order['Order']['note'])
	
);

$test_data = array(
	$columnHeaders,
	$firstRow
);

$lengthOfItems = count($order['OrderLineItem']);
if ($lengthOfItems > 1) {
	$lineItemIndex = array_search('Lineitem Name', $columnHeaders);
	$lineItemPriceIndex = $lineItemIndex + 1;
	$lineItemQuantityIndex = $lineItemIndex + 2;
	
	$counter = 1;
	while($counter < $lengthOfItems) {
		$row = array(
			0=>$order['Order']['order_no'],
			1=>$order['Order']['contact_email'],
			
		);
		// put empty columns
		for($start = 2; $start < $lineItemIndex; $start++) {
			$row[$start] = '';
		}
		
		$row[$lineItemIndex] = $order['OrderLineItem'][$counter]['variant_title'];
		$row[$lineItemPriceIndex] = $order['OrderLineItem'][$counter]['product_price'];
		$row[$lineItemQuantityIndex] = $order['OrderLineItem'][$counter]['product_quantity'];
		// now append to the test_data
		$test_data[] = $row;
		$counter++;
	}
}

foreach( $test_data as $row )
{
	$this->Csv->addRow($row);
}

$this->Csv->display();


?>