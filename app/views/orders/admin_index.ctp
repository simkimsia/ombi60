<div class="orders index">
<h2 align="center"><?php __('Orders');?></h2>
<?php echo $this->Form->create('Order', array('url' => array('controller' => 'orders', 'action' => 'index', 'admin' => 'true'), 'id'=>'filters')); ?>
<table cellpadding="0" cellspacing="0" class="search-filters">
	<tr>
		<th>Order</th>
		<th>Placed by</th>
		<th>Payment Status</th>
		<th>Fulfillment Status</th>
		<th>Amount</th>
		
	</tr>
  <tr>
    <th><?php echo $this->Form->input('Order.order_no', array('label'=>false, 'size' => 4)); ?></th>
		<th><?php echo $this->Form->input('User.full_name', array('label'=>false, 'size' => 10)); ?></th>
		<th><?php echo $this->Form->input('Order.payment_status', array('options' => array('0'=>'Abandoned','1'=>'Authorized', '2'=>'Paid', '3'=>'Pending'),
										    'empty' => 'Any status',
										    'label' => false)); ?></th>
		<th><?php echo $this->Form->input('Order.fulfillment_status', array('options' => array('0'=>'Fulfilled','1'=>'NOT fulfilled', '2'=>'Partially fulfilled'),
										    'empty' => 'Any status',
										    'label' => false)); ?></th>

		<th><?php echo $this->Form->input('Order.amount', array('label'=>false, 'size' => 4)); ?></th>
                <th>
                    <button type="submit" name="data[filter]" value="filter">Filter</button>
                    <button type="submit" name="data[reset]" value="reset">Reset</button>
                </th>
        </tr>
</table>
<br />
<?php echo $this->Form->end(); ?>
<span class='paginator-top'>
<?php
echo $this->Paginator->counter(array(
'format' => __('Showing %current% orders out of %count% total. Page %page% of %pages%.', true)
));
?></span>
<?php
if ($paginator->params['paging']['Order']['pageCount'] > 1) {
?> 
<span class="top-paging">
    <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 |  <?php echo $paginator->numbers();?>
    <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</span>
<?php 
} 
?>
<br />
<br />
<table cellpadding="0" cellspacing="0" class="items-table orders-table">
	<tr>
		<th><?php echo $this->Paginator->sort('Order', 'order_no');?></th>
		<th width="20%"><?php echo $this->Paginator->sort('Date', 'created');?></th>
		<th><?php echo $this->Paginator->sort('Placed by', 'User.full_name');?></th>
		<th><?php echo $this->Paginator->sort('payment_status');?></th>
		<th><?php echo $this->Paginator->sort('fulfillment_status');?></th>
		<th><?php echo $this->Paginator->sort('amount');?></th>
		
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
<div class="bottom-paging">
<?php
if ($paginator->params['paging']['Order']['pageCount'] > 1) {
?> 
    <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 |  <?php echo $paginator->numbers();?>
    <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<?php
}
?>
</div>
</div>

