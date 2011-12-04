<div>
<h2 align="center"><?php echo __('Orders');?></h2>
<div align="center">
    <?php echo $this->Html->link(__('Export orders'), array('action' => 'export')); ?></li>
</div>

<span class='paginator-top'>
<?php
echo $this->Paginator->counter(array(
'format' => __('Showing %current% orders out of %count% total. Page %page% of %pages%.')
));
?></span>
<?php
if ($this->Paginator->params['paging']['Order']['pageCount'] > 1) {
?> 
<span class="top-paging">
    <?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 |  <?php echo $this->Paginator->numbers();?>
    <?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</span>
<?php 
} 
?>
<br />
<br />
<table cellpadding="0" cellspacing="0" class="items-table orders-table">
	<tr>
		<th><?php echo $this->Paginator->sort('Order.order_no', 'Order');?></th>
		<th width="20%"><?php echo $this->Paginator->sort('Order.created', 'Date');?></th>
		<th><?php echo $this->Paginator->sort('User.full_name', 'Placed by');?></th>
		<th><?php echo $this->Paginator->sort('Order.payment_status', 'Payment');?></th>
		<th><?php echo $this->Paginator->sort('Order.fulfillment_status', 'Fulfillment');?></th>
		<th><?php echo $this->Paginator->sort('Order.amount', 'Amount');?></th>
		
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
			<?php echo $this->Html->link(__('#' . $order['Order']['order_no']), array('action' => 'view', $order['Order']['id'])); ?>
			
		</td>
		<td>
			<?php echo $this->Time->niceShort($order['Order']['created']); ?>
		</td>
		<td>
			<?php echo $order['User']['full_name']; ?>
		</td>
		
		<td>
			<?php echo $this->Constant->displayPayment($order['Order']['payment_status']);?>
		</td>
		<td>
			<?php echo $this->Constant->displayFulfillment($order['Order']['fulfillment_status']);?>
		</td>
		
		<td>
			<?php echo $this->Number->currency($order['Order']['amount'], '$'); ?>
		</td>
		
	</tr>
<?php endforeach; ?>
</table>
<div class="bottom-paging">
<?php
if ($this->Paginator->params['paging']['Order']['pageCount'] > 1) {
?> 
    <?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 |  <?php echo $this->Paginator->numbers();?>
    <?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</div>
<?php
}
?>
</div>
</div>

