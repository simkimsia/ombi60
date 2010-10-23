<div class="orders view">
<h2><?php  __('Customer');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['User']['full_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['User']['email']; ?>
			&nbsp;
		</dd>
		
	</dl>
</div>

<div class="orders view">
<h2><?php  __('Delivery Address');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['DeliveryAddress']['full_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['DeliveryAddress']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('region'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['DeliveryAddress']['region']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('city'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['DeliveryAddress']['city'] . ' ' . $order['DeliveryAddress']['zip_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('country'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['DeliveryAddress']['country']; ?>
			&nbsp;
		</dd>
		
	</dl>
</div>

<div class="orders view">
<h2><?php  __('Billing Address');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['BillingAddress']['full_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['BillingAddress']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('region'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['BillingAddress']['region']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('city'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['BillingAddress']['city'] . ' ' . $order['BillingAddress']['zip_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('country'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $order['BillingAddress']['country']; ?>
			&nbsp;
		</dd>
		
	</dl>
</div>

<?php

	foreach ($order['Payment'] as $payment):

?>
<div>
	Payment method: <?php echo $payment['name']; ?>
</div>

<?php
	endforeach;
?>

<?php

	foreach ($order['Shipment'] as $shipment):

?>
<div>
	Shipping method: <?php echo $shipment['name']; ?>
</div>

<?php
	endforeach;
?>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo 'Product'; ?></th>
	<th><?php echo 'Price'; ?></th>
	<th><?php echo 'Quantity'; ?></th>
	<th><?php echo 'Total'; ?></th>
	
</tr>
<?php
$i = 0;

foreach ($order['OrderLineItem'] as $lineItem):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}

?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link(__($lineItem['product_title'], true),
						     array('admin'=>true,
							   'controller' => 'products',
							   'action' => 'view',
							   $lineItem['product_id'])); ?>
			
		</td>
		<td>
			<?php echo $number->currency($lineItem['product_price'], 'SGD'); ?>
		</td>
		<td>
			<?php echo $lineItem['product_quantity']; ?>
		</td>
		
		<td>
			<?php echo $number->currency($lineItem['product_quantity'] * $lineItem['product_price'], 'SGD'); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
Total amount: <?php echo $number->currency($order['Order']['amount'], 'SGD'); ?>
