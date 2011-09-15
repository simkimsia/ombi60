<div class="orders form">
<?php echo $this->Form->create('Order');?>
	<fieldset>
 		<legend><?php echo __('Add Order');?></legend>
	<?php
		echo $this->Form->input('shop_id');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('billing_address_id');
		echo $this->Form->input('delivery_address_id');
		echo $this->Form->input('order_no');
		echo $this->Form->input('created');
		echo $this->Form->input('amount');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Orders'), array('action' => 'index'));?></li>
	</ul>
</div>
