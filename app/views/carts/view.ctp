<div class="carts view">
<h2><?php echo __('Cart');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Shop'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($cart['Shop']['name'], array('controller' => 'shops', 'action' => 'view', $cart['Shop']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Customer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($cart['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $cart['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Hash'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['hash']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cart'), array('action' => 'edit', $cart['Cart']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Cart'), array('action' => 'delete', $cart['Cart']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $cart['Cart']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Carts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shops'), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop'), array('controller' => 'shops', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('controller' => 'cart_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cart Items');?></h3>
	<?php if (!empty($cart['CartItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Cart Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Product Price'); ?></th>
		<th><?php echo __('Product Quantity'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cart['CartItem'] as $cartItem):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $cartItem['id'];?></td>
			<td><?php echo $cartItem['cart_id'];?></td>
			<td><?php echo $cartItem['product_id'];?></td>
			<td><?php echo $cartItem['product_price'];?></td>
			<td><?php echo $cartItem['product_quantity'];?></td>
			<td><?php echo $cartItem['status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cart_items', 'action' => 'view', $cartItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cart_items', 'action' => 'edit', $cartItem['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'cart_items', 'action' => 'delete', $cartItem['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $cartItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Orders');?></h3>
	<?php if (!empty($cart['Order'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Shop Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Billing Address Id'); ?></th>
		<th><?php echo __('Delivery Address Id'); ?></th>
		<th><?php echo __('Order No'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Hash'); ?></th>
		<th><?php echo __('Cart Id'); ?></th>
		<th><?php echo __('Payment Status'); ?></th>
		<th><?php echo __('Fulfillment Status'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cart['Order'] as $order):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $order['id'];?></td>
			<td><?php echo $order['shop_id'];?></td>
			<td><?php echo $order['customer_id'];?></td>
			<td><?php echo $order['billing_address_id'];?></td>
			<td><?php echo $order['delivery_address_id'];?></td>
			<td><?php echo $order['order_no'];?></td>
			<td><?php echo $order['created'];?></td>
			<td><?php echo $order['amount'];?></td>
			<td><?php echo $order['status'];?></td>
			<td><?php echo $order['hash'];?></td>
			<td><?php echo $order['cart_id'];?></td>
			<td><?php echo $order['payment_status'];?></td>
			<td><?php echo $order['fulfillment_status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
