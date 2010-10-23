<div class="carts form">
<?php echo $this->Form->create('Cart');?>
	<fieldset>
 		<legend><?php __('Edit Cart'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('shop_id');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('amount');
		echo $this->Form->input('status');
		echo $this->Form->input('hash');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Cart.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Cart.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Carts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Customers', true), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer', true), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shops', true), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop', true), array('controller' => 'shops', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items', true), array('controller' => 'cart_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item', true), array('controller' => 'cart_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders', true), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order', true), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>