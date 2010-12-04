<div class="carts view">
<h2><?php  __('Cart');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shop'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($cart['Shop']['name'], array('controller' => 'shops', 'action' => 'view', $cart['Shop']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Customer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($cart['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $cart['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hash'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cart['Cart']['hash']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cart', true), array('action' => 'edit', $cart['Cart']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Cart', true), array('action' => 'delete', $cart['Cart']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cart['Cart']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Carts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart', true), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php __('Related Cart Items');?></h3>
	<?php if (!empty($cart['CartItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Cart Id'); ?></th>
		<th><?php __('Product Id'); ?></th>
		<th><?php __('Product Price'); ?></th>
		<th><?php __('Product Quantity'); ?></th>
		<th><?php __('Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
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
				<?php echo $this->Html->link(__('View', true), array('controller' => 'cart_items', 'action' => 'view', $cartItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'cart_items', 'action' => 'edit', $cartItem['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'cart_items', 'action' => 'delete', $cartItem['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cartItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cart Item', true), array('controller' => 'cart_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Orders');?></h3>
	<?php if (!empty($cart['Order'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Shop Id'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th><?php __('Billing Address Id'); ?></th>
		<th><?php __('Delivery Address Id'); ?></th>
		<th><?php __('Order No'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Hash'); ?></th>
		<th><?php __('Cart Id'); ?></th>
		<th><?php __('Payment Status'); ?></th>
		<th><?php __('Fulfillment Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
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
				<?php echo $this->Html->link(__('View', true), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'orders', 'action' => 'delete', $order['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order', true), array('controller' => 'orders', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
