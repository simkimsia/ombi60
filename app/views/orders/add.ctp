<div class="orders form">
<?php echo $form->create('Order');?>
	<fieldset>
 		<legend><?php __('Add Order');?></legend>
	<?php
		echo $form->input('shop_id');
		echo $form->input('customer_id');
		echo $form->input('billing_address_id');
		echo $form->input('delivery_address_id');
		echo $form->input('order_no');
		echo $form->input('created');
		echo $form->input('amount');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Orders', true), array('action' => 'index'));?></li>
	</ul>
</div>
