<div class="orders index">
<h2><?php __('Orders');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<?php echo $this->Form->create('Order', array('url' => array('controller' => 'orders', 'action' => 'index', 'admin' => 'true'), 'id'=>'filters')); ?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('Order', 'order_no');?></th>
		<th><?php echo $this->Paginator->sort('Date', 'created');?></th>
		<th><?php echo $this->Paginator->sort('Placed by', 'User.full_name');?></th>
		<th><?php echo $this->Paginator->sort('payment_status');?></th>
		<th><?php echo $this->Paginator->sort('fulfillment_status');?></th>
		<th><?php echo $this->Paginator->sort('amount');?></th>
		
	</tr>
		<tr>
                <th><?php echo $this->Form->input('Order.order_no', array('label'=>false)); ?></th>
		<th>--</th>
		<th><?php echo $this->Form->input('User.full_name', array('label'=>false)); ?></th>
		<th><?php echo $this->Form->input('Order.payment_status', array('options' => array('0'=>'Abandoned','1'=>'Authorized', '2'=>'Paid', '3'=>'Pending'),
										    'empty' => 'Any status',
										    'label' => false)); ?></th>
		<th><?php echo $this->Form->input('Order.fulfillment_status', array('options' => array('0'=>'Fulfilled','1'=>'NOT fulfilled', '2'=>'Partially fulfilled'),
										    'empty' => 'Any status',
										    'label' => false)); ?></th>
		<th><?php echo $this->Form->input('Order.amount', array('label'=>false)); ?></th>
                <th>
                    <button type="submit" name="data[filter]" value="filter">Filter</button>
                    <button type="submit" name="data[reset]" value="reset">Reset</button>
                </th>
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
			<?php echo $this->Html->link(__('#' . $order['Order']['order_no'], true), array('action' => 'view', $order['Order']['id'])); ?>
			
		</td>
		<td>
			<?php echo $this->Time->nice($order['Order']['created']); ?>
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
			<?php echo '$' . $order['Order']['amount']; ?>
		</td>
		
	</tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->Form->end(); ?>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>

