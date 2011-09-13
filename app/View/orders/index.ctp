<div class="orders index">
<h2><?php echo __('Orders');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('shop_id');?></th>
	<th><?php echo $paginator->sort('customer_id');?></th>
	<th><?php echo $paginator->sort('billing_address_id');?></th>
	<th><?php echo $paginator->sort('delivery_address_id');?></th>
	<th><?php echo $paginator->sort('order_no');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('amount');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th class="actions"><?php echo __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($orders as $order):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $order['Order']['id']; ?>
		</td>
		<td>
			<?php echo $order['Order']['shop_id']; ?>
		</td>
		<td>
			<?php echo $order['Order']['customer_id']; ?>
		</td>
		<td>
			<?php echo $order['Order']['billing_address_id']; ?>
		</td>
		<td>
			<?php echo $order['Order']['delivery_address_id']; ?>
		</td>
		<td>
			<?php echo $order['Order']['order_no']; ?>
		</td>
		<td>
			<?php echo $order['Order']['created']; ?>
		</td>
		<td>
			<?php echo $order['Order']['amount']; ?>
		</td>
		<td>
			<?php echo $order['Order']['status']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $html->link(__('Delete'), array('action' => 'delete', $order['Order']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $order['Order']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Order'), array('action' => 'add')); ?></li>
	</ul>
</div>
