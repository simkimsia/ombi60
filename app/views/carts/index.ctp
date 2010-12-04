<div class="carts index">
	<h2><?php __('Carts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('shop_id');?></th>
			<th><?php echo $this->Paginator->sort('customer_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('hash');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($carts as $cart):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $cart['Cart']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cart['Shop']['name'], array('controller' => 'shops', 'action' => 'view', $cart['Shop']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cart['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $cart['Customer']['id'])); ?>
		</td>
		<td><?php echo $cart['Cart']['created']; ?>&nbsp;</td>
		<td><?php echo $cart['Cart']['amount']; ?>&nbsp;</td>
		<td><?php echo $cart['Cart']['status']; ?>&nbsp;</td>
		<td><?php echo $cart['Cart']['hash']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $cart['Cart']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $cart['Cart']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $cart['Cart']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cart['Cart']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Cart', true), array('action' => 'add')); ?></li>
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